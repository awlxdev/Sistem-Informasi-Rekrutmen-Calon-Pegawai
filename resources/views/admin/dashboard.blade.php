@extends('layouts.app')

@section('title', 'Dashboard Administrator')

@push('styles')
<style>
    /* ==========================================
       ADMINISTRATOR DASHBOARD
    ========================================== */

    .admin-dashboard {
        width: 100%;
        color: #26342e;
    }

    .admin-dashboard .admin-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 26px;
    }

    .admin-dashboard .admin-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #39745d;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.8px;
        margin-bottom: 10px;
    }

    .admin-dashboard .admin-eyebrow::before {
        content: "";
        width: 22px;
        height: 2px;
        background: #b99a62;
        border-radius: 5px;
    }

    .admin-dashboard .admin-title {
        font-size: clamp(25px, 3vw, 32px);
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -.8px;
        margin: 0 0 9px;
        color: #193c30;
    }

    .admin-dashboard .admin-description {
        max-width: 650px;
        color: #7b8780;
        font-size: 13px;
        line-height: 1.8;
        margin: 0;
    }

    .admin-dashboard .admin-heading-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #eaf2ee;
        border: 1px solid #dce9e1;
        color: #286448;
        border-radius: 30px;
        padding: 9px 14px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .7px;
        white-space: nowrap;
    }

    .admin-dashboard .admin-heading-badge i {
        font-size: 14px;
    }

    /* ACCESS BANNER */

    .admin-dashboard .admin-access {
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        padding: 22px 25px;
        margin-bottom: 32px;
        background: linear-gradient(115deg, #123d31, #1c5944);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 16px;
        box-shadow: 0 8px 22px rgba(20, 61, 46, .13);
    }

    .admin-dashboard .admin-access::after {
        content: "";
        position: absolute;
        width: 190px;
        height: 190px;
        border: 1px solid rgba(255,255,255,.09);
        border-radius: 50%;
        right: 8%;
        top: -110px;
        pointer-events: none;
    }

    .admin-dashboard .admin-access-info {
        display: flex;
        align-items: center;
        gap: 16px;
        position: relative;
        z-index: 1;
        min-width: 0;
    }

    .admin-dashboard .admin-access-icon {
        flex: 0 0 50px;
        width: 50px;
        height: 50px;
        display: grid;
        place-items: center;
        border-radius: 14px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.15);
        color: #e6cf9c;
        font-size: 23px;
    }

    .admin-dashboard .admin-access-title {
        color: #fff;
        font-size: 14px;
        font-weight: 750;
        margin-bottom: 5px;
    }

    .admin-dashboard .admin-access-description {
        color: rgba(255,255,255,.72);
        font-size: 11px;
        line-height: 1.7;
        margin: 0;
    }

    .admin-dashboard .admin-access-status {
        position: relative;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 30px;
        padding: 8px 13px;
        color: #e1f5e8;
        background: rgba(255,255,255,.09);
        font-size: 10px;
        font-weight: 750;
        white-space: nowrap;
    }

    .admin-dashboard .admin-access-status span {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #83d7a1;
        box-shadow: 0 0 9px rgba(131,215,161,.7);
    }

    /* SECTION */

    .admin-dashboard .admin-section {
        margin-bottom: 30px;
    }

    .admin-dashboard .admin-section-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .admin-dashboard .admin-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #263d32;
        font-size: 16px;
        font-weight: 800;
        margin: 0 0 5px;
    }

    .admin-dashboard .admin-section-title i {
        color: #b99a62;
        font-size: 18px;
    }

    .admin-dashboard .admin-section-description {
        color: #89948d;
        font-size: 11px;
        margin: 0;
        line-height: 1.6;
    }

    .admin-dashboard .admin-section-label {
        color: #9a9f99;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 1.1px;
        white-space: nowrap;
    }

    /* MENU CARDS */

    .admin-dashboard .admin-menu-card {
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
        min-height: 240px;
        padding: 21px;
        background: #fff;
        border: 1px solid #e9ede9;
        border-radius: 15px;
        box-shadow: 0 3px 13px rgba(25,48,37,.045);
        transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    }

    .admin-dashboard .admin-menu-card:hover {
        transform: translateY(-4px);
        border-color: #d3e2d8;
        box-shadow: 0 12px 28px rgba(25,48,37,.09);
    }

    .admin-dashboard .admin-card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 21px;
    }

    .admin-dashboard .admin-menu-icon {
        display: grid;
        place-items: center;
        width: 46px;
        height: 46px;
        border-radius: 13px;
        background: #edf4ef;
        border: 1px solid #e1ebe3;
        color: #286448;
        font-size: 21px;
        box-shadow: 0 3px 7px rgba(30,75,53,.05);
    }

    .admin-dashboard .admin-menu-status {
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

    .admin-dashboard .admin-menu-status i {
        font-size: 10px;
    }

    .admin-dashboard .admin-menu-title {
        color: #263c31;
        font-size: 15px;
        font-weight: 800;
        margin: 0 0 9px;
    }

    .admin-dashboard .admin-menu-description {
        color: #849087;
        font-size: 11px;
        line-height: 1.8;
        margin: 0 0 21px;
        flex-grow: 1;
    }

    .admin-dashboard .admin-menu-link {
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

    .admin-dashboard .admin-menu-link i {
        font-size: 14px;
        transition: transform .2s ease;
    }

    .admin-dashboard .admin-menu-link:hover {
        background: #174b38;
        border-color: #174b38;
        color: #fff;
    }

    .admin-dashboard .admin-menu-link:hover i {
        transform: translateX(3px);
    }

    /* PLATFORM CARD */

    .admin-dashboard .admin-platform-card {
        min-height: 170px;
    }

    .admin-dashboard .admin-platform-card .admin-menu-icon {
        background: #f7f2e8;
        border-color: #eee4d2;
        color: #a18249;
    }

    .admin-dashboard .admin-platform-card .admin-menu-link {
        background: #faf8f3;
        border-color: #eee6d7;
        color: #8b7041;
    }

    .admin-dashboard .admin-platform-card .admin-menu-link:hover {
        background: #8b7041;
        border-color: #8b7041;
        color: #fff;
    }

    /* FOOTER */

    .admin-dashboard .admin-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        padding-top: 18px;
        margin-top: 10px;
        border-top: 1px solid #e9ede9;
        color: #9aa39c;
        font-size: 10px;
    }

    @media (max-width: 767.98px) {
        .admin-dashboard .admin-heading {
            margin-bottom: 20px;
        }

        .admin-dashboard .admin-access {
            padding: 18px;
            margin-bottom: 25px;
        }

        .admin-dashboard .admin-menu-card {
            min-height: 220px;
            padding: 18px;
        }

        .admin-dashboard .admin-section {
            margin-bottom: 25px;
        }
    }

    @media (max-width: 575.98px) {
        .admin-dashboard .admin-heading-badge {
            padding: 7px 11px;
        }

        .admin-dashboard .admin-access {
            align-items: flex-start;
            flex-direction: column;
        }

        .admin-dashboard .admin-access-info {
            align-items: flex-start;
        }

        .admin-dashboard .admin-access-icon {
            flex-basis: 43px;
            width: 43px;
            height: 43px;
            font-size: 20px;
        }

        .admin-dashboard .admin-section-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .admin-dashboard .admin-menu-card {
            min-height: 205px;
        }

        .admin-dashboard .admin-footer {
            align-items: flex-start;
            flex-direction: column;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .admin-dashboard .admin-menu-card,
        .admin-dashboard .admin-menu-link,
        .admin-dashboard .admin-menu-link i {
            transition: none;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid admin-dashboard">

    {{-- HEADER --}}
    <section class="admin-heading">
        <div>
            <div class="admin-eyebrow">ADMINISTRATOR</div>
            <h1 class="admin-title">Dashboard Administrator</h1>
            <p class="admin-description">
                Selamat datang, {{ auth()->user()->name }}.
                Kelola dan pantau seluruh sistem rekrutmen melalui satu pusat kendali.
            </p>
        </div>

        <div class="admin-heading-badge">
            <i class="bi bi-shield-check"></i>
            ADMIN PANEL
        </div>
    </section>

    {{-- STATUS ADMINISTRATOR --}}
    <section class="admin-access">
        <div class="admin-access-info">
            <div class="admin-access-icon">
                <i class="bi bi-shield-lock"></i>
            </div>

            <div>
                <div class="admin-access-title">Akses Administrator</div>
                <p class="admin-access-description">
                    Pusat pengelolaan dan pemantauan sistem pendaftaran calon pegawai.
                </p>
            </div>
        </div>

        <div class="admin-access-status">
            <span></span>
            Sistem Aktif
        </div>
    </section>

    {{-- MANAJEMEN REKRUTMEN --}}
    <section class="admin-section">
        <div class="admin-section-heading">
            <div>
                <h2 class="admin-section-title">
                    <i class="bi bi-grid-1x2"></i>
                    Manajemen Rekrutmen
                </h2>
                <p class="admin-section-description">
                    Kelola pengguna, lowongan pekerjaan, jadwal, dan proses lamaran.
                </p>
            </div>

            <span class="admin-section-label">PENGELOLAAN UTAMA</span>
        </div>

        <div class="row g-3">

            {{-- PENGGUNA --}}
            <div class="col-12 col-md-6 col-xl-4">
                <article class="admin-menu-card">
                    <div class="admin-card-top">
                        <div class="admin-menu-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <span class="admin-menu-status">
                            <i class="bi bi-check-circle-fill"></i>
                            Tersedia
                        </span>
                    </div>

                    <h3 class="admin-menu-title">Manajemen Pengguna</h3>

                    <p class="admin-menu-description">
                        Kelola akun administrator, HRD, dan pelamar.
                        Atur informasi, peran, serta status akun pengguna.
                    </p>

                    <a href="{{ route('admin.users.index') }}" class="admin-menu-link">
                        <span>Buka Manajemen Pengguna</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </article>
            </div>

            {{-- LOWONGAN --}}
            <div class="col-12 col-md-6 col-xl-4">
                <article class="admin-menu-card">
                    <div class="admin-card-top">
                        <div class="admin-menu-icon">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <span class="admin-menu-status">
                            <i class="bi bi-check-circle-fill"></i>
                            Tersedia
                        </span>
                    </div>

                    <h3 class="admin-menu-title">Lowongan Pekerjaan</h3>

                    <p class="admin-menu-description">
                        Kelola posisi pekerjaan, persyaratan, kuota,
                        dan periode pendaftaran calon pegawai.
                    </p>

                    <a href="{{ route('admin.vacancies.index') }}" class="admin-menu-link">
                        <span>Buka Lowongan Pekerjaan</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </article>
            </div>

            {{-- LAMARAN --}}
            <div class="col-12 col-md-6 col-xl-4">
                <article class="admin-menu-card">
                    <div class="admin-card-top">
                        <div class="admin-menu-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <span class="admin-menu-status">
                            <i class="bi bi-check-circle-fill"></i>
                            Tersedia
                        </span>
                    </div>

                    <h3 class="admin-menu-title">Data Lamaran</h3>

                    <p class="admin-menu-description">
                        Pantau pengajuan lamaran, identitas pelamar,
                        posisi yang dilamar, dan status proses rekrutmen.
                    </p>

                    <a href="{{ route('admin.applications.index') }}" class="admin-menu-link">
                        <span>Buka Data Lamaran</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </article>
            </div>

            {{-- JADWAL --}}
            <div class="col-12 col-md-6 col-xl-4">
                <article class="admin-menu-card">
                    <div class="admin-card-top">
                        <div class="admin-menu-icon">
                            <i class="bi bi-calendar-week"></i>
                        </div>
                        <span class="admin-menu-status">
                            <i class="bi bi-check-circle-fill"></i>
                            Tersedia
                        </span>
                    </div>

                    <h3 class="admin-menu-title">Jadwal Pendaftaran</h3>

                    <p class="admin-menu-description">
                        Pantau jadwal pembukaan dan penutupan
                        pendaftaran setiap lowongan pekerjaan.
                    </p>

                    <a href="{{ route('admin.schedule') }}" class="admin-menu-link">
                        <span>Buka Jadwal Pendaftaran</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </article>
            </div>

            {{-- SELEKSI ADMINISTRASI --}}
            <div class="col-12 col-md-6 col-xl-4">
                <article class="admin-menu-card">
                    <div class="admin-card-top">
                        <div class="admin-menu-icon">
                            <i class="bi bi-clipboard-check"></i>
                        </div>
                        <span class="admin-menu-status">
                            <i class="bi bi-check-circle-fill"></i>
                            Tersedia
                        </span>
                    </div>

                    <h3 class="admin-menu-title">Seleksi Administrasi</h3>

                    <p class="admin-menu-description">
                        Pantau hasil seleksi administrasi, cari pelamar
                        berdasarkan nama atau posisi, dan cetak daftar pelamar lulus.
                    </p>

                    <a href="{{ route('admin.selection.index') }}" class="admin-menu-link">
                        <span>Buka Seleksi Administrasi</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </article>
            </div>

        </div>
    </section>

    {{-- ADMINISTRASI PLATFORM --}}
    <section class="admin-section">
        <div class="admin-section-heading">
            <div>
                <h2 class="admin-section-title">
                    <i class="bi bi-sliders"></i>
                    Administrasi Platform
                </h2>
                <p class="admin-section-description">
                    Pengelolaan informasi dan konfigurasi operasional aplikasi.
                </p>
            </div>

            <span class="admin-section-label">KONFIGURASI SISTEM</span>
        </div>

        <div class="row g-3">
            <div class="col-12 col-md-6 col-xl-3">
                <article class="admin-menu-card admin-platform-card">
                    <div class="admin-card-top">
                        <div class="admin-menu-icon">
                            <i class="bi bi-gear"></i>
                        </div>
                        <span class="admin-menu-status">
                            <i class="bi bi-check-circle-fill"></i>
                            Tersedia
                        </span>
                    </div>

                    <h3 class="admin-menu-title">Pengaturan Sistem</h3>

                    <p class="admin-menu-description">
                        Lihat informasi konfigurasi aplikasi dan
                        pengaturan operasional sistem rekrutmen.
                    </p>

                    <a href="{{ route('admin.settings.index') }}" class="admin-menu-link">
                        <span>Buka Pengaturan Sistem</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </article>
            </div>
        </div>
    </section>

{{-- FOOTER --}}
<footer class="admin-footer">
    <span>Sistem Pendaftaran Calon Pegawai</span>
    <span>Administrator Control Center</span>
    <span>
        &copy; {{ date('Y') }} <strong>AWLXDEV</strong>.
        All Rights Reserved.
    </span>
</footer>

</div>
@endsection