@extends('layouts.app')

@section('navbar')
    @include('components.pelamar-navbar')
@endsection

@section('title', 'Dashboard Pelamar')

@section('content')
<main class="container py-4 py-lg-5">
    <div class="page-heading">
        <div class="section-eyebrow mb-2">PORTAL PELAMAR</div>
        <h1>Dashboard Pelamar</h1>
        <p>Selamat datang, {{ auth()->user()->name }}. Lengkapi profil dan pantau proses pendaftaran Anda.</p>
    </div>

    <div class="dashboard-card p-3 p-md-4 mb-4">
        <div class="d-flex align-items-center gap-3">
            <span class="brand-mark"><i class="bi bi-person-check"></i></span>
            <div>
                <div class="fw-semibold">Akun Pelamar</div>
                <div class="text-muted small">Pastikan informasi profil Anda selalu benar dan terbaru.</div>
            </div>
            <span class="badge bg-success-subtle text-success ms-auto">Aktif</span>
        </div>
    </div>

    <h5 class="fw-bold mb-3">Menu Pelamar</h5>

    <div class="row g-3">
        <div class="col-md-6 col-lg-4">
            <div class="dashboard-card p-4 h-100 d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <span class="brand-mark"><i class="bi bi-person-vcard"></i></span>
                    <span class="badge bg-success-subtle text-success">Tersedia</span>
                </div>
                <h5 class="fw-bold">Biodata Saya</h5>
                <p class="text-muted small flex-grow-1">
                    Lengkapi identitas pribadi, informasi pendidikan,
                    nomor kontak, serta dokumen pendukung.
                </p>
                <a href="{{ route('pelamar.profile.edit') }}" class="btn btn-primary-custom w-100">
                    Lengkapi Biodata <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="dashboard-card p-4 h-100 d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <span class="brand-mark"><i class="bi bi-search"></i></span>
                    <span class="badge bg-success-subtle text-success">Tersedia</span>
                </div>
                <h5 class="fw-bold">Lowongan Pekerjaan</h5>
                <p class="text-muted small flex-grow-1">
                    Temukan informasi posisi pekerjaan, persyaratan,
                    dan periode pendaftaran yang tersedia.
                </p>
                <a href="{{ route('pelamar.vacancies.index') }}" class="btn btn-primary-custom w-100">
                    Lihat Lowongan <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="dashboard-card p-4 h-100 d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <span class="brand-mark"><i class="bi bi-file-earmark-text"></i></span>
                    <span class="badge bg-success-subtle text-success">Tersedia</span>
                </div>
                <h5 class="fw-bold">Status Lamaran</h5>
                <p class="text-muted small flex-grow-1">
                    Pantau riwayat pendaftaran, nomor lamaran,
                    dan perkembangan proses seleksi.
                </p>
                <a href="{{ route('pelamar.applications.index') }}" class="btn btn-primary-custom w-100">
                    Pantau Lamaran <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

<footer class="text-center text-muted small pt-5">
    Sistem Pendaftaran Calon Pegawai
    <br>
    &copy; {{ date('Y') }} <strong>AWLXDEV</strong>.
    All Rights Reserved.
</footer>
</main>
@endsection