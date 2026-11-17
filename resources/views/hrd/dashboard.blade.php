@extends('layouts.app')

@section('title', 'Dashboard HRD')

@push('styles')
<style>
    /* HRD PAGE SHELL - KONSISTENSI AREA KONTEN */
    .panel-content > .container-fluid.hrd-page-shell {
        width: 100% !important;
        max-width: none !important;
        margin: 0 !important;
        padding: 0 12px !important;
        box-sizing: border-box !important;
    }

    .panel-content > .container-fluid.hrd-page-shell > * {
        min-width: 0;
    }

    @media (max-width: 575.98px) {
        .panel-content > .container-fluid.hrd-page-shell {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }
    }
    .hrd-dashboard {
        width: 100%;
        color: #26342e;
    }

    .hrd-dashboard .hrd-heading {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 25px;
    }

    .hrd-dashboard .hrd-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 9px;
        color: #39745d;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.7px;
    }

    .hrd-dashboard .hrd-eyebrow::before {
        content: "";
        width: 22px;
        height: 2px;
        border-radius: 5px;
        background: #b99a62;
    }

    .hrd-dashboard .hrd-title {
        margin: 0 0 8px;
        color: #193c30;
        font-size: clamp(25px, 3vw, 32px);
        font-weight: 800;
        letter-spacing: -.8px;
        line-height: 1.2;
    }

    .hrd-dashboard .hrd-description {
        max-width: 650px;
        margin: 0;
        color: #7b8780;
        font-size: 13px;
        line-height: 1.8;
    }

    .hrd-dashboard .hrd-role {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        border: 1px solid #dce9e1;
        border-radius: 30px;
        background: #eaf2ee;
        color: #286448;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .6px;
        white-space: nowrap;
    }

    /* WELCOME BANNER */
    .hrd-dashboard .hrd-banner {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        padding: 23px 25px;
        margin-bottom: 30px;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 16px;
        background: linear-gradient(115deg, #123d31, #1c5944);
        box-shadow: 0 8px 22px rgba(20,61,46,.13);
    }

    .hrd-dashboard .hrd-banner::after {
        content: "";
        position: absolute;
        top: -100px;
        right: 8%;
        width: 190px;
        height: 190px;
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 50%;
        pointer-events: none;
    }

    .hrd-dashboard .hrd-banner-info {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 0;
    }

    .hrd-dashboard .hrd-banner-icon {
        display: grid;
        place-items: center;
        flex: 0 0 50px;
        width: 50px;
        height: 50px;
        border: 1px solid rgba(255,255,255,.15);
        border-radius: 14px;
        background: rgba(255,255,255,.12);
        color: #e6cf9c;
        font-size: 23px;
    }

    .hrd-dashboard .hrd-banner-title {
        margin-bottom: 5px;
        color: #fff;
        font-size: 14px;
        font-weight: 750;
    }

    .hrd-dashboard .hrd-banner-text {
        margin: 0;
        color: rgba(255,255,255,.74);
        font-size: 11px;
        line-height: 1.7;
    }

    .hrd-dashboard .hrd-status {
        position: relative;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 13px;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 30px;
        background: rgba(255,255,255,.09);
        color: #e1f5e8;
        font-size: 10px;
        font-weight: 750;
        white-space: nowrap;
    }

    .hrd-dashboard .hrd-status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #83d7a1;
        box-shadow: 0 0 9px rgba(131,215,161,.7);
    }

    /* SECTION */
    .hrd-dashboard .hrd-section {
        margin-bottom: 28px;
    }

    .hrd-dashboard .hrd-section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 16px;
    }

    .hrd-dashboard .hrd-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 0 5px;
        color: #263d32;
        font-size: 16px;
        font-weight: 800;
    }

    .hrd-dashboard .hrd-section-title i {
        color: #b99a62;
        font-size: 18px;
    }

    .hrd-dashboard .hrd-section-description {
        margin: 0;
        color: #89948d;
        font-size: 11px;
        line-height: 1.6;
    }

    .hrd-dashboard .hrd-section-label {
        color: #9a9f99;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 1.1px;
    }

    /* MENU CARDS */
    .hrd-dashboard .hrd-menu-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        min-height: 230px;
        padding: 21px;
        border: 1px solid #e9ede9;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 3px 13px rgba(25,48,37,.045);
        transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    }

    .hrd-dashboard .hrd-menu-card:hover {
        transform: translateY(-4px);
        border-color: #d3e2d8;
        box-shadow: 0 12px 28px rgba(25,48,37,.09);
    }

    .hrd-dashboard .hrd-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 20px;
    }

    .hrd-dashboard .hrd-menu-icon {
        display: grid;
        place-items: center;
        width: 46px;
        height: 46px;
        border: 1px solid #e1ebe3;
        border-radius: 13px;
        background: #edf4ef;
        color: #286448;
        font-size: 21px;
    }

    .hrd-dashboard .hrd-menu-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border-radius: 30px;
        background: #edf6ef;
        color: #34724d;
        font-size: 9px;
        font-weight: 750;
        white-space: nowrap;
    }

    .hrd-dashboard .hrd-menu-title {
        margin: 0 0 9px;
        color: #263c31;
        font-size: 15px;
        font-weight: 800;
    }

    .hrd-dashboard .hrd-menu-description {
        flex-grow: 1;
        margin: 0 0 20px;
        color: #849087;
        font-size: 11px;
        line-height: 1.8;
    }

    .hrd-dashboard .hrd-menu-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        width: 100%;
        padding: 11px 13px;
        border: 1px solid #e3eae5;
        border-radius: 9px;
        background: #f8faf8;
        color: #245640;
        text-decoration: none;
        font-size: 10px;
        font-weight: 750;
        transition: all .2s ease;
    }

    .hrd-dashboard .hrd-menu-link i {
        font-size: 14px;
        transition: transform .2s ease;
    }

    .hrd-dashboard .hrd-menu-link:hover {
        border-color: #174b38;
        background: #174b38;
        color: #fff;
    }

    .hrd-dashboard .hrd-menu-link:hover i {
        transform: translateX(3px);
    }

    /* FOOTER */
    .hrd-dashboard .hrd-footer {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
        padding-top: 18px;
        margin-top: 10px;
        border-top: 1px solid #e9ede9;
        color: #9aa39c;
        font-size: 10px;
    }

    @media (max-width: 767.98px) {
        .hrd-dashboard .hrd-banner {
            padding: 18px;
            margin-bottom: 24px;
        }

        .hrd-dashboard .hrd-menu-card {
            min-height: 215px;
            padding: 18px;
        }
    }

    @media (max-width: 575.98px) {
        .hrd-dashboard .hrd-banner {
            align-items: flex-start;
            flex-direction: column;
        }

        .hrd-dashboard .hrd-banner-info {
            align-items: flex-start;
        }

        .hrd-dashboard .hrd-banner-icon {
            flex-basis: 43px;
            width: 43px;
            height: 43px;
            font-size: 20px;
        }

        .hrd-dashboard .hrd-section-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .hrd-dashboard .hrd-footer {
            flex-direction: column;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .hrd-dashboard .hrd-menu-card,
        .hrd-dashboard .hrd-menu-link,
        .hrd-dashboard .hrd-menu-link i {
            transition: none;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid hrd-page-shell hrd-dashboard">

    {{-- PAGE HEADER --}}
    <section class="hrd-heading">
        <div>
            <div class="hrd-eyebrow">HUMAN RESOURCE DEVELOPMENT</div>
            <h1 class="hrd-title">Dashboard HRD</h1>
            <p class="hrd-description">
                Selamat datang, {{ auth()->user()->name }}.
                Kelola proses rekrutmen dan seleksi calon pegawai melalui pusat kendali HRD.
            </p>
        </div>

        <div class="hrd-role">
            <i class="bi bi-person-workspace"></i>
            HRD CONTROL PANEL
        </div>
    </section>

    {{-- ACCESS BANNER --}}
    <section class="hrd-banner">
        <div class="hrd-banner-info">
            <div class="hrd-banner-icon">
                <i class="bi bi-person-workspace"></i>
            </div>
            <div>
                <div class="hrd-banner-title">Panel Pengelolaan HRD</div>
                <p class="hrd-banner-text">
                    Pusat pengelolaan data pelamar, lowongan, seleksi administrasi,
                    lamaran, dan jadwal rekrutmen.
                </p>
            </div>
        </div>

        <div class="hrd-status">
            <span class="hrd-status-dot"></span>
            Sistem Aktif
        </div>
    </section>

    {{-- RECRUITMENT MENU --}}
    <section class="hrd-section">
        <div class="hrd-section-heading">
            <div>
                <h2 class="hrd-section-title">
                    <i class="bi bi-grid-1x2"></i>
                    Manajemen Rekrutmen
                </h2>
                <p class="hrd-section-description">
                    Pilih modul yang ingin Anda kelola sesuai kewenangan HRD.
                </p>
            </div>

            <span class="hrd-section-label">5 MODUL PENGELOLAAN</span>
        </div>

        <div class="row g-3">

            {{-- DATA PELAMAR --}}
            <div class="col-12 col-md-6 col-xl-4">
                <article class="hrd-menu-card">
                    <div class="hrd-card-top">
                        <div class="hrd-menu-icon">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                        <span class="hrd-menu-status">
                            <i class="bi bi-check-circle-fill"></i>
                            Tersedia
                        </span>
                    </div>

                    <h3 class="hrd-menu-title">Data Pelamar</h3>
                    <p class="hrd-menu-description">
                        Melihat, mencari, dan memeriksa informasi calon pegawai
                        berdasarkan nama serta data pelamar.
                    </p>

                    <a href="{{ route('hrd.applicants.index') }}" class="hrd-menu-link">
                        <span>Buka Data Pelamar</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </article>
            </div>

            {{-- LOWONGAN --}}
            <div class="col-12 col-md-6 col-xl-4">
                <article class="hrd-menu-card">
                    <div class="hrd-card-top">
                        <div class="hrd-menu-icon">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <span class="hrd-menu-status">
                            <i class="bi bi-check-circle-fill"></i>
                            Tersedia
                        </span>
                    </div>

                    <h3 class="hrd-menu-title">Lowongan Pekerjaan</h3>
                    <p class="hrd-menu-description">
                        Melihat informasi posisi pekerjaan, persyaratan,
                        kuota, dan periode pendaftaran.
                    </p>

                    <a href="{{ route('hrd.vacancies.index') }}" class="hrd-menu-link">
                        <span>Buka Lowongan Pekerjaan</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </article>
            </div>

            {{-- SELEKSI --}}
            <div class="col-12 col-md-6 col-xl-4">
                <article class="hrd-menu-card">
                    <div class="hrd-card-top">
                        <div class="hrd-menu-icon">
                            <i class="bi bi-clipboard-check"></i>
                        </div>
                        <span class="hrd-menu-status">
                            <i class="bi bi-check-circle-fill"></i>
                            Tersedia
                        </span>
                    </div>

                    <h3 class="hrd-menu-title">Seleksi Administrasi</h3>
                    <p class="hrd-menu-description">
                        Memeriksa kelengkapan dokumen, memberikan catatan,
                        dan memperbarui status lamaran.
                    </p>

                    <a href="{{ route('hrd.selection.index') }}" class="hrd-menu-link">
                        <span>Buka Seleksi Administrasi</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </article>
            </div>

            {{-- DATA LAMARAN --}}
            <div class="col-12 col-md-6 col-xl-4">
                <article class="hrd-menu-card">
                    <div class="hrd-card-top">
                        <div class="hrd-menu-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <span class="hrd-menu-status">
                            <i class="bi bi-check-circle-fill"></i>
                            Tersedia
                        </span>
                    </div>

                    <h3 class="hrd-menu-title">Data Lamaran</h3>
                    <p class="hrd-menu-description">
                        Melihat daftar pengajuan lamaran, nomor registrasi,
                        posisi yang dilamar, dan status proses rekrutmen.
                    </p>

                    <a href="{{ route('hrd.applications.index') }}" class="hrd-menu-link">
                        <span>Buka Data Lamaran</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </article>
            </div>

            {{-- JADWAL --}}
            <div class="col-12 col-md-6 col-xl-4">
                <article class="hrd-menu-card">
                    <div class="hrd-card-top">
                        <div class="hrd-menu-icon">
                            <i class="bi bi-calendar-week"></i>
                        </div>
                        <span class="hrd-menu-status">
                            <i class="bi bi-check-circle-fill"></i>
                            Tersedia
                        </span>
                    </div>

                    <h3 class="hrd-menu-title">Jadwal Pendaftaran</h3>
                    <p class="hrd-menu-description">
                        Memantau jadwal pembukaan dan penutupan
                        pendaftaran setiap lowongan pekerjaan.
                    </p>

                    <a href="{{ route('hrd.schedule') }}" class="hrd-menu-link">
                        <span>Buka Jadwal Pendaftaran</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </article>
            </div>

        </div>
    </section>

{{-- FOOTER --}}
<footer class="hrd-footer">
    <span>Sistem Pendaftaran Calon Pegawai</span>
    <span>Human Resource Development Control Center</span>
    <span>
        &copy; {{ date('Y') }} <strong>AWLXDEV</strong>.
        All Rights Reserved.
    </span>
</footer>

</div>
@endsection