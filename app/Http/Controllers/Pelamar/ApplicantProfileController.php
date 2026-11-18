<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Validation\ValidationException;

class ApplicantProfileController extends Controller
{
    public function edit(Request $request)
    {
        $applicant = $request->user()->applicant()->firstOrCreate(
            [],
            ['full_name' => $request->user()->name]
        );

        return view('pelamar.profile.edit', compact('applicant'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $applicant = $user->applicant()->firstOrCreate(
            [],
            ['full_name' => $user->name]
        );

        $validated = $request->validate([
            'nik' => [
                'nullable',
                'digits:16',
                Rule::unique('applicants', 'nik')->ignore($applicant->id),
            ],
            'full_name' => ['required', 'string', 'max:150'],
            'place_of_birth' => ['nullable', 'string', 'max:100'],
            'date_of_birth' => ['nullable', 'date', 'before_or_equal:today'],
            'gender' => ['nullable', Rule::in(['Laki-laki', 'Perempuan'])],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:5000'],
            'education_level' => ['nullable', 'string', 'max:50'],
            'institution' => ['nullable', 'string', 'max:150'],
            'major' => ['nullable', 'string', 'max:150'],
            'graduation_year' => [
                'nullable',
                'integer',
                'min:1950',
                'max:' . (now()->year + 1),
            ],
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ], [
            'nik.digits' => 'NIK harus terdiri dari tepat 16 angka.',
            'nik.unique' => 'NIK tersebut sudah digunakan akun lain.',
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'date_of_birth.before_or_equal' => 'Tanggal lahir tidak boleh melebihi hari ini.',
            'gender.in' => 'Jenis kelamin tidak valid.',
            'graduation_year.min' => 'Tahun kelulusan tidak valid.',
            'graduation_year.max' => 'Tahun kelulusan tidak boleh melebihi tahun depan.',
            'cv.mimes' => 'CV harus berformat PDF, DOC, atau DOCX.',
            'cv.max' => 'Ukuran CV maksimal 5 MB.',
            'photo.image' => 'File foto harus berupa gambar.',
            'photo.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
            'photo.max' => 'Ukuran foto maksimal 5 MB.',
        ]);

        // Pemeriksaan signature dan struktur dokumen CV.
        if ($request->hasFile('cv')) {
            $cvFile = $request->file('cv');
            $cvPath = $cvFile->getRealPath();
            $cvExtension = strtolower($cvFile->guessExtension() ?? '');

            if (!$cvPath || !is_file($cvPath)) {
                throw ValidationException::withMessages([
                    'cv' => 'File CV tidak dapat dibaca.',
                ]);
            }

            if ($cvExtension === 'pdf') {
                $signature = file_get_contents($cvPath, false, null, 0, 5);

                if ($signature !== '%PDF-') {
                    throw ValidationException::withMessages([
                        'cv' => 'Isi file tidak sesuai dengan format PDF.',
                    ]);
                }
            } elseif ($cvExtension === 'doc') {
                $signature = file_get_contents($cvPath, false, null, 0, 8);

                if ($signature === false ||
                    bin2hex($signature) !== 'd0cf11e0a1b11ae1') {
                    throw ValidationException::withMessages([
                        'cv' => 'Isi file tidak sesuai dengan format DOC.',
                    ]);
                }
            } elseif ($cvExtension === 'docx') {
                $zip = new \ZipArchive();

                if ($zip->open($cvPath, \ZipArchive::RDONLY) !== true) {
                    throw ValidationException::withMessages([
                        'cv' => 'Struktur dokumen DOCX tidak valid.',
                    ]);
                }

                $validDocx = false;

                try {
                    if ($zip->numFiles <= 5000) {
                        $contentTypesStat = $zip->statName('[Content_Types].xml');
                        $documentStat = $zip->statName('word/document.xml');

                        if ($contentTypesStat !== false &&
                            $documentStat !== false &&
                            $contentTypesStat['size'] <= 20971520 &&
                            $documentStat['size'] <= 20971520) {

                            $contentTypes = $zip->getFromName('[Content_Types].xml');
                            $documentXml = $zip->getFromName('word/document.xml');

                            $validDocx = false;

                            if (is_string($contentTypes) &&
                                is_string($documentXml) &&
                                !preg_match('/<!DOCTYPE/i', $contentTypes . $documentXml)) {

                                $previousLibxmlSetting = libxml_use_internal_errors(true);

                                try {
                                    $contentTypesDom = new \DOMDocument();
                                    $contentTypesDom->resolveExternals = false;
                                    $contentTypesDom->substituteEntities = false;

                                    $documentDom = new \DOMDocument();
                                    $documentDom->resolveExternals = false;
                                    $documentDom->substituteEntities = false;

                                    $contentTypesLoaded = $contentTypesDom->loadXML(
                                        $contentTypes,
                                        LIBXML_NONET | LIBXML_NOBLANKS
                                    );

                                    $documentLoaded = $documentDom->loadXML(
                                        $documentXml,
                                        LIBXML_NONET | LIBXML_NOBLANKS
                                    );

                                    $contentTypesRoot = $contentTypesDom->documentElement;
                                    $documentRoot = $documentDom->documentElement;

                                    $validDocx =
                                        $contentTypesLoaded &&
                                        $documentLoaded &&
                                        $contentTypesDom->doctype === null &&
                                        $documentDom->doctype === null &&
                                        $contentTypesRoot !== null &&
                                        $documentRoot !== null &&
                                        $contentTypesRoot->localName === 'Types' &&
                                        $contentTypesRoot->namespaceURI ===
                                            'http://schemas.openxmlformats.org/package/2006/content-types' &&
                                        $documentRoot->localName === 'document' &&
                                        $documentRoot->namespaceURI ===
                                            'http://schemas.openxmlformats.org/wordprocessingml/2006/main';
                                } finally {
                                    libxml_clear_errors();
                                    libxml_use_internal_errors($previousLibxmlSetting);
                                }
                            }
                        }
                    }
                } finally {
                    $zip->close();
                }

                if (!$validDocx) {
                    throw ValidationException::withMessages([
                        'cv' => 'Struktur dokumen DOCX tidak valid.',
                    ]);
                }
            } else {
                throw ValidationException::withMessages([
                    'cv' => 'Format CV tidak didukung.',
                ]);
            }
        }

        // Pastikan foto benar-benar dapat dibaca sebagai JPEG atau PNG.
        if ($request->hasFile('photo')) {
            $photoFile = $request->file('photo');
            $photoPath = $photoFile->getRealPath();
            $imageInfo = $photoPath ? @getimagesize($photoPath) : false;

            if ($imageInfo === false ||
                !in_array(
                    $imageInfo['mime'] ?? '',
                    ['image/jpeg', 'image/png'],
                    true
                )) {
                throw ValidationException::withMessages([
                    'photo' => 'Isi file foto bukan gambar JPEG atau PNG yang valid.',
                ]);
            }
        }

        $oldCv = $applicant->cv_path;
        $oldPhoto = $applicant->photo_path;
        $newFiles = [];

        try {
            if ($request->hasFile('cv')) {
                $storedPath = $request->file('cv')
                    ->store('applicants/cv', 'local');

                if ($storedPath === false) {
                    throw new \RuntimeException('Gagal menyimpan file CV.');
                }

                $newFiles['cv_path'] = $storedPath;
            }

            if ($request->hasFile('photo')) {
                $storedPath = $request->file('photo')
                    ->store('applicants/photos', 'local');

                if ($storedPath === false) {
                    throw new \RuntimeException('Gagal menyimpan foto profil.');
                }

                $newFiles['photo_path'] = $storedPath;
            }

            DB::transaction(function () use ($applicant, $user, $validated, $newFiles) {
                $applicant->fill([
                    'nik' => $validated['nik'] ?? null,
                    'full_name' => $validated['full_name'],
                    'place_of_birth' => $validated['place_of_birth'] ?? null,
                    'date_of_birth' => $validated['date_of_birth'] ?? null,
                    'gender' => $validated['gender'] ?? null,
                    'phone' => $validated['phone'] ?? null,
                    'address' => $validated['address'] ?? null,
                    'education_level' => $validated['education_level'] ?? null,
                    'institution' => $validated['institution'] ?? null,
                    'major' => $validated['major'] ?? null,
                    'graduation_year' => $validated['graduation_year'] ?? null,
                ]);

                foreach ($newFiles as $field => $path) {
                    $applicant->{$field} = $path;
                }

                $applicant->save();

                $user->name = $validated['full_name'];
                $user->save();
            });

            if (isset($newFiles['cv_path']) && $oldCv) {
                Storage::disk('local')->delete($oldCv);
            }

            if (isset($newFiles['photo_path']) && $oldPhoto) {
                Storage::disk('local')->delete($oldPhoto);
            }

        } catch (Throwable $exception) {
            foreach ($newFiles as $path) {
                Storage::disk('local')->delete($path);
            }

            report($exception);

            return back()
                ->withInput()
                ->withErrors(['system' => 'Biodata gagal disimpan. Silakan coba kembali.']);
        }

        return redirect()
            ->route('pelamar.profile.edit')
            ->with('success', 'Biodata berhasil diperbarui.');
    }
public function photo(Request $request)
{
    $applicant = $request->user()->applicant;

    if (
        !$applicant ||
        !$applicant->photo_path ||
        !Storage::disk('local')->exists($applicant->photo_path)
    ) {
        abort(404);
    }

    $path = Storage::disk('local')->path($applicant->photo_path);

    return response()->file($path, [
        'Cache-Control' => 'private, no-store, max-age=0',
        'X-Content-Type-Options' => 'nosniff',
    ]);
}
}