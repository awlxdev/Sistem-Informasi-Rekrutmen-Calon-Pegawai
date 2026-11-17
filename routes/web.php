<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\EmailVerificationController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Pelamar\ApplicantProfileController;
use App\Http\Controllers\Pelamar\VacancyController;
use App\Http\Controllers\VacancyManagementController;



Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        // Pengguna yang belum memverifikasi email
        // diarahkan ke halaman verifikasi.
if (is_null($user->email_verified_at)) {
    return redirect()->route('verification.notice');
}

        // Arahkan pengguna sesuai role masing-masing.
        return match ($user->role) {
            User::ROLE_ADMIN => redirect()->route('admin.dashboard'),
            User::ROLE_HRD => redirect()->route('hrd.dashboard'),
            User::ROLE_PELAMAR => redirect()->route('pelamar.dashboard'),
            default => abort(403, 'Role pengguna tidak dikenali.'),
        };
    }

    // Pengunjung yang belum login tetap melihat halaman utama.
    return view('welcome');
})->name('home');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:20,1')
        ->name('login.submit');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])
        ->middleware('throttle:20,1')
        ->name('register.submit');

    Route::get('/captcha', [CaptchaController::class, 'generate'])
        ->middleware('throttle:30,1')
        ->name('captcha.generate');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

Route::prefix('admin')->name('admin.')->middleware(['role:admin', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Manajemen pengguna
    Route::get('/users', [UserManagementController::class, 'index'])
        ->name('users.index');

    Route::get('/users/create', [UserManagementController::class, 'create'])
        ->name('users.create');

    Route::post('/users', [UserManagementController::class, 'store'])
        ->name('users.store');

    Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])
        ->name('users.edit');

    Route::put('/users/{user}', [UserManagementController::class, 'update'])
        ->name('users.update');

    Route::patch('/users/{user}/toggle-status', [UserManagementController::class, 'toggleStatus'])
        ->name('users.toggle-status');
});

    Route::prefix('hrd')->name('hrd.')->middleware(['role:hrd', 'verified'])->group(function () {
        Route::get('/dashboard', function () {
            return view('hrd.dashboard');
        })->name('dashboard');
    });

    Route::prefix('pelamar')->name('pelamar.')->middleware(['role:pelamar', 'verified'])->group(function () {
        Route::get('/dashboard', function () {
            return view('pelamar.dashboard');
        })->name('dashboard');

        Route::get('/profil', [ApplicantProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profil', [ApplicantProfileController::class, 'update'])
            ->name('profile.update');

        // Lowongan pekerjaan untuk pelamar
        Route::get('/lowongan', [VacancyController::class, 'index'])
            ->name('vacancies.index');

        Route::get('/lowongan/{slug}', [VacancyController::class, 'show'])
            ->name('vacancies.show');

        Route::post('/lowongan/{slug}/lamar', [VacancyController::class, 'apply'])
            ->middleware('throttle:10,1')
            ->name('vacancies.apply');

        // Riwayat dan status lamaran
        Route::get('/lamaran', [VacancyController::class, 'applications'])
            ->name('applications.index');

            Route::get('/foto-profil', [ApplicantProfileController::class, 'photo'])
    ->name('profile.photo');
    });

});


/*
|--------------------------------------------------------------------------
| MANAJEMEN LOWONGAN PEKERJAAN
|--------------------------------------------------------------------------
| Modul bersama untuk Administrator dan HRD.
*/


Route::middleware(['auth', 'role:admin', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/jadwal-pendaftaran', [VacancyManagementController::class, 'schedule'])
            ->name('schedule');

        Route::get('/vacancies', [VacancyManagementController::class, 'index'])
            ->name('vacancies.index');

        Route::get('/vacancies/create', [VacancyManagementController::class, 'create'])
            ->name('vacancies.create');

        Route::post('/vacancies', [VacancyManagementController::class, 'store'])
            ->name('vacancies.store');

        Route::get('/vacancies/{vacancy}/edit', [VacancyManagementController::class, 'edit'])
            ->name('vacancies.edit');

        Route::put('/vacancies/{vacancy}', [VacancyManagementController::class, 'update'])
            ->name('vacancies.update');

        Route::patch('/vacancies/{vacancy}/publish', [VacancyManagementController::class, 'publish'])
            ->name('vacancies.publish');

        Route::patch('/vacancies/{vacancy}/close', [VacancyManagementController::class, 'close'])
            ->name('vacancies.close');

        Route::delete('/vacancies/{vacancy}', [VacancyManagementController::class, 'destroy'])
            ->name('vacancies.destroy');
    });

Route::middleware(['auth', 'role:hrd', 'verified'])
    ->prefix('hrd')
    ->name('hrd.')
    ->group(function () {
        Route::get('/jadwal-pendaftaran', [VacancyManagementController::class, 'schedule'])
            ->name('schedule');

        Route::get('/vacancies', [VacancyManagementController::class, 'index'])
            ->name('vacancies.index');

        Route::get('/vacancies/create', [VacancyManagementController::class, 'create'])
            ->name('vacancies.create');

        Route::post('/vacancies', [VacancyManagementController::class, 'store'])
            ->name('vacancies.store');

        Route::get('/vacancies/{vacancy}/edit', [VacancyManagementController::class, 'edit'])
            ->name('vacancies.edit');

        Route::put('/vacancies/{vacancy}', [VacancyManagementController::class, 'update'])
            ->name('vacancies.update');

        Route::patch('/vacancies/{vacancy}/publish', [VacancyManagementController::class, 'publish'])
            ->name('vacancies.publish');

        Route::patch('/vacancies/{vacancy}/close', [VacancyManagementController::class, 'close'])
            ->name('vacancies.close');

        Route::delete('/vacancies/{vacancy}', [VacancyManagementController::class, 'destroy'])
            ->name('vacancies.destroy');
    });

// ======================================================================
// MODUL REKRUTMEN - ADMIN
// ======================================================================

Route::middleware(['auth', 'role:admin', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/applications', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'applications'
        ])->name('applications.index');

        Route::get('/applications/{application}', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'applicationShow'
        ])->name('applications.show');
        Route::get('/applications/{application}/surat-kelulusan', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'printAcceptanceLetter'
        ])->name('applications.acceptance-print');

        Route::get('/applications/{application}/documents/{document}/download', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'downloadDocument'
        ])->name('applications.documents.download');

        Route::get('/pengaturan-sistem', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'settings'
        ])->name('settings.index');
        // Seleksi administrasi untuk Admin.
        // Admin dapat melihat, mencari, memfilter, dan mencetak.
        Route::get('/seleksi-administrasi', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'selection'
        ])->name('selection.index');

        Route::get('/seleksi-administrasi/cetak', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'printAcceptedApplicants'
        ])->name('selection.print');

        // Seleksi administrasi - Admin dapat melihat, mencari,
        // memfilter, dan mencetak pelamar yang lulus.
        Route::get('/seleksi-administrasi', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'selection'
        ])->name('selection.index');

        Route::get('/seleksi-administrasi/cetak', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'printAcceptedApplicants'
        ])->name('selection.print');
    });

// ======================================================================
// MODUL REKRUTMEN - HRD
// ======================================================================

Route::middleware(['auth', 'role:hrd', 'verified'])
    ->prefix('hrd')
    ->name('hrd.')
    ->group(function () {
        Route::get('/data-pelamar', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'applicants'
        ])->name('applicants.index');

        Route::get('/data-pelamar/{applicant}', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'applicantShow'
        ])->name('applicants.show');

        Route::get('/applications', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'applications'
        ])->name('applications.index');

        Route::get('/applications/{application}', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'applicationShow'
        ])->name('applications.show');
        Route::get('/applications/{application}/surat-kelulusan', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'printAcceptanceLetter'
        ])->name('applications.acceptance-print');

        Route::get('/applications/{application}/documents/{document}/download', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'downloadDocument'
        ])->name('applications.documents.download');

        Route::get('/seleksi-administrasi', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'selection'
        ])->name('selection.index');
        Route::get('/seleksi-administrasi/cetak', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'printAcceptedApplicants'
        ])->name('selection.print');

        Route::patch('/applications/{application}/review', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'review'
        ])->name('applications.review');

        Route::patch('/applications/{application}/documents/{document}/verify', [
            \App\Http\Controllers\RecruitmentManagementController::class,
            'verifyDocument'
        ])->name('applications.documents.verify');
    });