<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationDocument;
use App\Models\Vacancy;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class VacancyController extends Controller
{
    /**
     * Daftar lowongan yang masih menerima pendaftaran.
     */
    public function index(Request $request)
    {
        $query = Vacancy::published()
            ->withCount('applications')
            ->latest('published_at');

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('employment_type', 'like', "%{$search}%");
            });
        }

        $vacancies = $query->paginate(9)->withQueryString();

        $applicant = $request->user()->applicant;

        $appliedVacancyIds = $applicant
            ? $applicant->applications()->pluck('vacancy_id')->all()
            : [];

        return view('pelamar.vacancies.index', compact(
            'vacancies',
            'appliedVacancyIds'
        ));
    }

    /**
     * Detail lowongan aktif.
     */
    public function show(Request $request, string $slug)
    {
        $vacancy = Vacancy::published()
            ->withCount('applications')
            ->where('slug', $slug)
            ->firstOrFail();

        $applicant = $request->user()->applicant;

        $hasApplied = $applicant
            ? $applicant->applications()
                ->where('vacancy_id', $vacancy->id)
                ->exists()
            : false;

        return view('pelamar.vacancies.show', compact(
            'vacancy',
            'hasApplied'
        ));
    }

    /**
     * Mengirim lamaran menggunakan biodata dan CV yang sudah tersimpan.
     */
    public function apply(Request $request, string $slug)
    {
        $vacancy = Vacancy::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $validated = $request->validate([
            'cover_letter' => ['nullable', 'string', 'max:5000'],
            'confirmation' => ['accepted'],
        ], [
            'cover_letter.max' => 'Surat lamaran maksimal 5.000 karakter.',
            'confirmation.accepted' => 'Anda harus menyetujui pernyataan pengajuan lamaran.',
        ]);

        $applicant = $request->user()->applicant;

        if (!$applicant) {
            return redirect()
                ->route('pelamar.profile.edit')
                ->with('error', 'Silakan lengkapi biodata sebelum mengajukan lamaran.');
        }

        $requiredFields = [
            'nik',
            'full_name',
            'place_of_birth',
            'date_of_birth',
            'gender',
            'phone',
            'address',
            'education_level',
            'institution',
            'major',
            'graduation_year',
            'cv_path',
        ];

        $incompleteFields = [];

        foreach ($requiredFields as $field) {
            if (blank($applicant->{$field})) {
                $incompleteFields[] = $field;
            }
        }

        if (!empty($incompleteFields)) {
            return redirect()
                ->route('pelamar.profile.edit')
                ->with('error', 'Biodata belum lengkap. Lengkapi seluruh data wajib dan unggah CV sebelum melamar.')
                ->with('incomplete_profile_fields', $incompleteFields);
        }

        if (!Storage::disk('local')->exists($applicant->cv_path)) {
            return redirect()
                ->route('pelamar.profile.edit')
                ->with('error', 'File CV tidak ditemukan. Silakan unggah ulang CV pada halaman Biodata Saya.');
        }

        if ($applicant->applications()->where('vacancy_id', $vacancy->id)->exists()) {
            return redirect()
                ->route('pelamar.applications.index')
                ->with('error', 'Anda sudah pernah mengajukan lamaran untuk posisi ini.');
        }

        $copiedFilePath = null;

        try {
            DB::transaction(function () use (
                $applicant,
                $vacancy,
                $validated,
                &$copiedFilePath
            ) {
                $applicationNumber = $this->generateApplicationNumber();

                $application = Application::create([
                    'application_number' => $applicationNumber,
                    'applicant_id' => $applicant->id,
                    'vacancy_id' => $vacancy->id,
                    'status' => 'submitted',
                    'cover_letter' => $validated['cover_letter'] ?? null,
                    'submitted_at' => now(),
                ]);

                $extension = pathinfo(
                    $applicant->cv_path,
                    PATHINFO_EXTENSION
                );

                $copiedFilePath = 'application-documents/'
                    . $applicationNumber
                    . '/CV-' . Str::uuid()
                    . ($extension ? '.' . $extension : '');

                $copied = Storage::disk('local')->copy(
                    $applicant->cv_path,
                    $copiedFilePath
                );

                if (!$copied) {
                    throw new \RuntimeException('Gagal menyalin dokumen CV.');
                }

                ApplicationDocument::create([
                    'application_id' => $application->id,
                    'document_type' => 'cv',
                    'original_name' => basename($applicant->cv_path),
                    'file_path' => $copiedFilePath,
                    'mime_type' => Storage::disk('local')->mimeType($copiedFilePath),
                    'file_size' => Storage::disk('local')->size($copiedFilePath),
                    'verification_status' => 'pending',
                ]);
            });

        } catch (QueryException $exception) {
            if ($copiedFilePath) {
                Storage::disk('local')->delete($copiedFilePath);
            }

            if ($exception->getCode() === '23000') {
                return redirect()
                    ->route('pelamar.applications.index')
                    ->with('error', 'Lamaran untuk posisi ini sudah pernah diajukan.');
            }

            report($exception);

            return back()
                ->withInput()
                ->with('error', 'Lamaran gagal disimpan. Silakan coba kembali.');
        } catch (Throwable $exception) {
            if ($copiedFilePath) {
                Storage::disk('local')->delete($copiedFilePath);
            }

            report($exception);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengirim lamaran. Silakan coba kembali.');
        }

        return redirect()
            ->route('pelamar.applications.index')
            ->with('success', 'Lamaran berhasil dikirim. Simpan nomor lamaran Anda untuk keperluan pemantauan.');
    }

    /**
     * Riwayat lamaran milik pelamar yang sedang login.
     */
    public function applications(Request $request)
    {
        $applicant = $request->user()->applicant;

        $applications = $applicant
            ? $applicant->applications()
                ->with([
                    'vacancy',
                    'documents',
                    'interviewSchedules' => function ($query) {
                        $query->where('status', 'scheduled')
                            ->latest('scheduled_at');
                    },
                ])
                ->latest('submitted_at')
                ->paginate(10)
            : collect();

        return view('pelamar.applications.index', compact(
            'applications',
            'applicant'
        ));
    }

    /**
     * Membuat nomor lamaran unik.
     */
    private function generateApplicationNumber(): string
    {
        do {
            $number = 'LAM-' . now()->format('Ymd') . '-'
                . Str::upper(Str::random(6));
        } while (Application::where('application_number', $number)->exists());

        return $number;
    }
}