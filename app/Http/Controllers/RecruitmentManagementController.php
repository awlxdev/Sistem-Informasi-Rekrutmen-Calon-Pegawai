<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Application;
use App\Models\ApplicationDocument;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecruitmentManagementController extends Controller
{
    private function prefix(Request $request): string
    {
        return str_starts_with(
            $request->route()->getName() ?? '',
            'hrd.'
        ) ? 'hrd' : 'admin';
    }

    private function pageData(Request $request): array
    {
        return [
            'routePrefix' => $this->prefix($request),
        ];
    }

    private function applicationQuery()
    {
        return Application::query()
            ->with([
                'applicant.user',
                'vacancy',
                'documents.verifier',
                'reviewer',
            ]);
    }

    private function applyApplicationFilters(Builder $query, Request $request): void
    {
        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($builder) use ($search) {
                $builder->where('application_number', 'like', "%{$search}%")
                    ->orWhereHas('applicant', function ($applicantQuery) use ($search) {
                        $applicantQuery
                            ->where('full_name', 'like', "%{$search}%")
                            ->orWhere('nik', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    })
                    ->orWhereHas('vacancy', function ($vacancyQuery) use ($search) {
                        $vacancyQuery->where('title', 'like', "%{$search}%");
                    });
            });
        }

        $allowedStatuses = [
            'submitted',
            'reviewing',
            'accepted',
            'rejected',
        ];

        if (
            $request->filled('status') &&
            in_array($request->input('status'), $allowedStatuses, true)
        ) {
            $query->where('status', $request->input('status'));
        }
    }

    public function applications(Request $request)
    {
        $query = $this->applicationQuery()->latest('submitted_at');

        $this->applyApplicationFilters($query, $request);

        $applications = $query->paginate(15)->withQueryString();

        $statistics = [
            'total' => Application::count(),
            'submitted' => Application::where('status', 'submitted')->count(),
            'reviewing' => Application::where('status', 'reviewing')->count(),
            'accepted' => Application::where('status', 'accepted')->count(),
            'rejected' => Application::where('status', 'rejected')->count(),
        ];

        return view(
            'management.recruitment.applications.index',
            array_merge(
                $this->pageData($request),
                compact('applications', 'statistics')
            )
        );
    }

    public function applicationShow(Request $request, Application $application)
    {
        $application->load([
            'applicant.user',
            'vacancy',
            'documents.verifier',
            'reviewer',
            'interviewSchedules.creator',
        ]);

        return view(
            'management.recruitment.applications.show',
            array_merge(
                $this->pageData($request),
                [
                    'application' => $application,
                    'allowReview' => $request->user()->isHrd(),
                ]
            )
        );
    }

    public function applicants(Request $request)
    {
        $query = Applicant::query()
            ->with('user')
            ->withCount('applications')
            ->latest();

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($builder) use ($search) {
                $builder->where('full_name', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('institution', 'like', "%{$search}%")
                    ->orWhere('major', 'like', "%{$search}%");
            });
        }

        $applicants = $query->paginate(15)->withQueryString();

        $statistics = [
            'total' => Applicant::count(),
            'with_applications' => Applicant::has('applications')->count(),
            'without_applications' => Applicant::doesntHave('applications')->count(),
        ];

        return view(
            'management.recruitment.applicants.index',
            array_merge(
                $this->pageData($request),
                compact('applicants', 'statistics')
            )
        );
    }

    public function applicantShow(Request $request, Applicant $applicant)
    {
        $applicant->load([
            'user',
            'applications.vacancy',
            'applications.documents',
        ]);

        return view(
            'management.recruitment.applicants.show',
            array_merge(
                $this->pageData($request),
                compact('applicant')
            )
        );
    }

    public function selection(Request $request)
    {
        $query = $this->applicationQuery()->latest('submitted_at');

        if (!$request->filled('status')) {
            $query->whereIn('status', ['submitted', 'reviewing']);
        } else {
            $this->applyApplicationFilters($query, $request);
        }

        if ($request->filled('search')) {
            $this->applyApplicationFilters($query, $request);
        }

        $applications = $query->paginate(15)->withQueryString();

        $statistics = [
            'submitted' => Application::where('status', 'submitted')->count(),
            'reviewing' => Application::where('status', 'reviewing')->count(),
            'accepted' => Application::where('status', 'accepted')->count(),
            'rejected' => Application::where('status', 'rejected')->count(),
        ];

        return view(
            'management.recruitment.selection.index',
            array_merge(
                $this->pageData($request),
                compact('applications', 'statistics')
            )
        );
    }


    /**
     * Cetak daftar pelamar yang lulus seleksi administrasi.
     */
    public function printAcceptedApplicants(Request $request)
    {
        $applications = Application::query()
            ->with([
                'applicant',
                'vacancy',
            ])
            ->where('status', 'accepted')
            ->orderByDesc('submitted_at')
            ->get();

        // Foto tetap diambil dari penyimpanan privat.
        // Foto dikirim ke halaman cetak sebagai data URI.
        $photoData = [];
        $disk = Storage::disk('local');

        foreach ($applications as $application) {
            $photoPath = $application->applicant?->photo_path;

            if (!$photoPath || !$disk->exists($photoPath)) {
                continue;
            }

            $photoContents = $disk->get($photoPath);
            $mimeType = (new \finfo(FILEINFO_MIME_TYPE))->buffer($photoContents);

            if (!in_array($mimeType, ['image/jpeg', 'image/png'], true)) {
                continue;
            }


            if ($photoContents !== false) {
                $photoData[$application->id] =
                    'data:' . $mimeType . ';base64,' . base64_encode($photoContents);
            }
        }

        return view(
            'management.recruitment.selection.print',
            [
                'applications' => $applications,
                'photoData' => $photoData,
                'printedAt' => now(),
                'routePrefix' => $this->prefix($request),
            ]
        );
    }

    /**
     * Cetak surat keterangan kelulusan seleksi administrasi individual.
     * Hanya Admin dan HRD yang dapat mengakses fitur ini.
     */
    public function printAcceptanceLetter(Request $request, Application $application)
    {
        abort_unless(
            $request->routeIs(
                'admin.applications.acceptance-print',
                'hrd.applications.acceptance-print',
                'pelamar.applications.acceptance-print'
            ),
            403
        );

        // Surat hanya dapat diterbitkan untuk pelamar yang diterima.
        abort_unless($application->status === 'accepted', 403);

        $application->load([
            'applicant.user',
            'vacancy',
            'reviewer',
        ]);


        // Pelamar hanya boleh membuka surat milik akun sendiri.
        if ($request->routeIs('pelamar.applications.acceptance-print')) {
            abort_unless(
                $application->applicant?->user_id === $request->user()->id,
                403
            );
        }
// Ambil foto dari penyimpanan privat jika tersedia.
        $photoData = null;
        $photoPath = $application->applicant?->photo_path;

        if ($photoPath) {
            $disk = Storage::disk('local');

            if ($disk->exists($photoPath)) {
                $photoContents = $disk->get($photoPath);
            $mimeType = (new \finfo(FILEINFO_MIME_TYPE))->buffer($photoContents);

                if (in_array($mimeType, ['image/jpeg', 'image/png'], true)) {

                    if ($photoContents !== false) {
                        $photoData = 'data:' . $mimeType . ';base64,' .
                            base64_encode($photoContents);
                    }
                }
            }
        }

        $applicantName = trim(
            $application->applicant?->full_name ?? 'PELAMAR'
        );

        // Nama aman untuk judul dokumen dan nama file PDF.
        $safeName = preg_replace(
            '/[^\pL\pN ._-]+/u',
            '-',
            $applicantName
        );

        $safeName = preg_replace('/\s+/', ' ', trim($safeName));

        $safeName = function_exists('mb_strtoupper')
            ? mb_strtoupper($safeName, 'UTF-8')
            : strtoupper($safeName);

        $downloadFileName = $safeName .
            ' - LULUS SELEKSI ADMINISTRASI';

        return view(
            'management.recruitment.applications.acceptance-print',
            [
                'application' => $application,
                'photoData' => $photoData,
                'printedAt' => now(),
                'downloadFileName' => $downloadFileName,
                'routePrefix' => str_starts_with(
                    $request->route()->getName() ?? '',
                    'pelamar.'
                ) ? 'pelamar' : (
                    str_starts_with(
                        $request->route()->getName() ?? '',
                        'hrd.'
                    ) ? 'hrd' : 'admin'
                ),
            ]
        );
    }
    public function review(Request $request, Application $application)
    {
        abort_unless($request->user()->isHrd(), 403);

        $validated = $request->validate([
            'status' => [
                'required',
                'in:reviewing,accepted,rejected',
            ],
            'admin_notes' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ], [
            'status.required' => 'Status seleksi wajib dipilih.',
            'status.in' => 'Status seleksi tidak valid.',
            'admin_notes.max' => 'Catatan maksimal 5.000 karakter.',
        ]);

        $application->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? null,
            'reviewed_at' => now(),
            'reviewed_by' => $request->user()->id,
        ]);

        return back()->with(
            'success',
            'Hasil pemeriksaan lamaran berhasil diperbarui.'
        );
    }


    /**
     * Simpan jadwal interview pelamar menggunakan zona waktu WIT.
     */
    public function storeInterviewSchedule(
        Request $request,
        Application $application
    ) {
        abort_unless(
            $request->user() && $request->user()->isHrd(),
            403
        );

        if (!in_array($application->status, ['reviewing', 'accepted'], true)) {
            return back()
                ->withErrors([
                    'application' => 'Jadwal interview hanya dapat dibuat untuk lamaran yang sedang ditinjau atau sudah diterima.',
                ])
                ->withInput();
        }

        $validated = $request->validate([
            'scheduled_at' => [
                'required',
                'date_format:Y-m-d\TH:i',
            ],
            'method' => [
                'required',
                'in:online,offline',
            ],
            'location' => [
                'nullable',
                'required_if:method,offline',
                'string',
                'max:255',
            ],
            'meeting_url' => [
                'nullable',
                'required_if:method,online',
                'url',
                'max:2048',
            ],
            'notes' => [
                'nullable',
                'string',
                'max:3000',
            ],
        ], [
            'scheduled_at.required' => 'Tanggal dan waktu interview wajib diisi.',
            'scheduled_at.date_format' => 'Format tanggal dan waktu interview tidak valid.',
            'method.required' => 'Metode interview wajib dipilih.',
            'method.in' => 'Metode interview tidak valid.',
            'location.required_if' => 'Lokasi interview wajib diisi untuk metode offline.',
            'meeting_url.required_if' => 'Link meeting wajib diisi untuk metode online.',
            'meeting_url.url' => 'Link meeting harus berupa URL yang valid.',
            'notes.max' => 'Catatan maksimal 3.000 karakter.',
        ]);

        $scheduledAt = \Carbon\Carbon::createFromFormat(
            'Y-m-d\TH:i',
            $validated['scheduled_at'],
            'Asia/Jayapura'
        );

        if (!$scheduledAt->isAfter(now('Asia/Jayapura'))) {
            return back()
                ->withErrors([
                    'scheduled_at' => 'Jadwal interview harus berada di waktu mendatang berdasarkan WIT.',
                ])
                ->withInput();
        }

        \Illuminate\Support\Facades\DB::transaction(function () use (
            $application,
            $validated,
            $scheduledAt,
            $request
        ) {
            $previousSchedule = $application
                ->interviewSchedules()
                ->where('status', 'scheduled')
                ->reorder()
                ->latest('id')
                ->first();

            if ($previousSchedule) {
                $previousSchedule->update([
                    'status' => 'rescheduled',
                ]);
            }

            $application->interviewSchedules()->create([
                'scheduled_at' => $scheduledAt->format('Y-m-d H:i:s'),
                'timezone' => 'Asia/Jayapura',
                'method' => $validated['method'],
                'location' => $validated['location'] ?? null,
                'meeting_url' => $validated['meeting_url'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'status' => 'scheduled',
                'created_by' => $request->user()->id,
            ]);
        });

        return back()->with(
            'success',
            'Jadwal interview berhasil disimpan menggunakan waktu WIT.'
        );
    }
    public function verifyDocument(
        Request $request,
        Application $application,
        ApplicationDocument $document
    ) {
        abort_unless($request->user()->isHrd(), 403);
        abort_unless($document->application_id === $application->id, 404);

        $validated = $request->validate([
            'verification_status' => [
                'required',
                'in:verified,rejected,pending',
            ],
            'verification_notes' => [
                'nullable',
                'string',
                'max:3000',
            ],
        ]);

        $document->update([
            'verification_status' => $validated['verification_status'],
            'verification_notes' => $validated['verification_notes'] ?? null,
            'verified_by' => $request->user()->id,
            'verified_at' => now(),
        ]);

        return back()->with(
            'success',
            'Status verifikasi dokumen berhasil diperbarui.'
        );
    }

    public function downloadDocument(
        Request $request,
        Application $application,
        ApplicationDocument $document
    ) {
        abort_unless(
            $document->application_id === $application->id,
            404
        );

        abort_unless(
            $request->user()->isAdmin() || $request->user()->isHrd(),
            403
        );

        $disk = Storage::disk('local');

        abort_unless(
            $disk->exists($document->file_path),
            404,
            'File dokumen tidak ditemukan.'
        );

        $application->loadMissing('applicant');

        $applicantName = (string) (
            $application->applicant?->full_name ?: 'Pelamar'
        );

        $downloadName = preg_replace(
            '/[^\pL\pN ._-]/u',
            '',
            $applicantName
        );

        $downloadName = trim(
            preg_replace('/\s+/u', ' ', $downloadName),
            " ._-"
        );

        if ($downloadName === '') {
            $downloadName = 'Pelamar';
        }

        $documentType = strtolower((string) $document->document_type);

        $extension = pathinfo(
            $document->original_name ?: $document->file_path,
            PATHINFO_EXTENSION
        );

        if ($documentType === 'cv') {
            if ($extension === '') {
                $extension = match (strtolower((string) $document->mime_type)) {
                    'application/pdf' => 'pdf',
                    'application/msword' => 'doc',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
                    default => 'bin',
                };
            }

            $downloadName .= ' CV.' . strtolower($extension);
        } elseif (str_contains($documentType, 'lulus')) {
            $downloadName .= ' Lulus Seleksi.pdf';
        } else {
            $downloadName = $document->original_name ?: basename($document->file_path);
        }

        return response()->streamDownload(
            function () use ($disk, $document): void {
                echo $disk->get($document->file_path);
            },
            $downloadName
        );
    }

    public function settings(Request $request)
    {
        $systemInformation = [
            'application_name' => config('app.name'),
            'environment' => app()->environment(),
            'laravel_version' => app()->version(),
            'php_version' => PHP_VERSION,
            'timezone' => config('app.timezone'),
            'database_driver' => config('database.default'),
            'maintenance_mode' => app()->isDownForMaintenance(),
        ];

        return view(
            'management.settings.index',
            array_merge(
                $this->pageData($request),
                compact('systemInformation')
            )
        );
    }
}