@extends('layouts.app')

@section('title', 'Pengaturan Sistem')

@push('styles')
<style>
    /* ==========================================
       ADMIN - PENGATURAN SISTEM
       Premium Soft 3D / Emerald / Ivory / Gold
    ========================================== */

    .admin-system-settings {
        width: 100%;
        color: #26342e;
        padding-top: 8px;
        padding-bottom: 30px;
    }

    .admin-system-settings .system-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 26px;
    }

    .admin-system-settings .system-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #39745d;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.8px;
        margin-bottom: 10px;
    }

    .admin-system-settings .system-eyebrow::before {
        content: "";
        width: 22px;
        height: 2px;
        background: #b99a62;
        border-radius: 5px;
    }

    .admin-system-settings .system-title {
        color: #193c30;
        font-size: clamp(25px, 3vw, 32px);
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -.8px;
        margin: 0 0 9px;
    }

    .admin-system-settings .system-description {
        max-width: 650px;
        color: #7b8780;
        font-size: 13px;
        line-height: 1.8;
        margin: 0;
    }

    .admin-system-settings .system-heading-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #eaf2ee;
        border: 1px solid #dce9e1;
        color: #286448;
        border-radius: 30px;
        padding: 10px 15px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .7px;
        white-space: nowrap;
    }

    .admin-system-settings .system-heading-badge i {
        font-size: 14px;
    }

    .admin-system-settings .system-notice {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        position: relative;
        overflow: hidden;
        padding: 21px 23px;
        margin-bottom: 25px;
        background: linear-gradient(115deg, #123d31, #1c5944);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 16px;
        color: #fff;
        box-shadow: 0 8px 22px rgba(20,61,46,.13);
    }

    .admin-system-settings .system-notice::after {
        content: "";
        position: absolute;
        width: 160px;
        height: 160px;
        right: 7%;
        top: -105px;
        border: 1px solid rgba(255,255,255,.10);
        border-radius: 50%;
        pointer-events: none;
    }

    .admin-system-settings .system-notice-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        min-width: 45px;
        border-radius: 13px;
        background: rgba(255,255,255,.12);
        color: #e5d0a2;
        font-size: 21px;
    }

    .admin-system-settings .system-notice-title {
        color: #fff;
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .admin-system-settings .system-notice-text {
        color: rgba(255,255,255,.77);
        font-size: 12px;
        line-height: 1.8;
        margin: 0;
    }

    .admin-system-settings .system-section-card {
        height: 100%;
        background: #fff;
        border: 1px solid #e7ece7;
        border-radius: 17px;
        box-shadow: 0 8px 25px rgba(29,62,46,.065);
        overflow: hidden;
    }

    .admin-system-settings .system-card-body {
        padding: 24px;
    }

    .admin-system-settings .system-card-heading {
        display: flex;
        align-items: center;
        gap: 11px;
        padding-bottom: 17px;
        margin-bottom: 19px;
        border-bottom: 1px solid #edf1ed;
    }

    .admin-system-settings .system-card-heading-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 39px;
        height: 39px;
        min-width: 39px;
        border-radius: 12px;
        color: #286448;
        background: #eaf2ee;
        font-size: 17px;
    }

    .admin-system-settings .system-card-title {
        color: #193c30;
        font-size: 15px;
        font-weight: 800;
        margin: 0;
    }

    .admin-system-settings .system-card-subtitle {
        color: #929d95;
        font-size: 11px;
        margin: 3px 0 0;
    }

    .admin-system-settings .system-info-item {
        height: 100%;
        padding: 17px;
        background: linear-gradient(145deg, #fff, #f8faf8);
        border: 1px solid #e8eee8;
        border-radius: 13px;
        transition: transform .22s ease, box-shadow .22s ease;
    }

    .admin-system-settings .system-info-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 9px 19px rgba(29,62,46,.075);
    }

    .admin-system-settings .system-info-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #7b8780;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .admin-system-settings .system-info-label i {
        color: #39745d;
        font-size: 15px;
    }

    .admin-system-settings .system-info-value {
        color: #193c30;
        font-size: 14px;
        font-weight: 800;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .admin-system-settings .system-status-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 15px 0;
        border-bottom: 1px solid #edf1ed;
    }

    .admin-system-settings .system-status-row:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .admin-system-settings .system-status-label {
        color: #66766b;
        font-size: 12px;
        font-weight: 600;
    }

    .admin-system-settings .system-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .admin-system-settings .system-status-badge i {
        font-size: 8px;
    }

    .admin-system-settings .system-status-good {
        color: #286448;
        background: #eaf4ed;
        border: 1px solid #d7e9dc;
    }

    .admin-system-settings .system-status-warning {
        color: #91651e;
        background: #fff5df;
        border: 1px solid #f0e1bd;
    }

    .admin-system-settings .system-status-neutral {
        color: #64736a;
        background: #f0f3f0;
        border: 1px solid #e1e7e1;
    }

    .admin-system-settings .system-security-card {
        background: linear-gradient(145deg, #fff, #fbfaf6);
        border: 1px solid #ece8dd;
        border-radius: 16px;
        box-shadow: 0 7px 19px rgba(29,62,46,.05);
    }

    .admin-system-settings .system-security-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: #f4eddd;
        color: #9a7b43;
        font-size: 18px;
        margin-bottom: 13px;
    }

    .admin-system-settings .system-security-title {
        color: #193c30;
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .admin-system-settings .system-security-text {
        color: #7b8780;
        font-size: 12px;
        line-height: 1.8;
        margin: 0;
    }

    @media (max-width: 767.98px) {
        .admin-system-settings {
            padding-left: 2px;
            padding-right: 2px;
        }

        .admin-system-settings .system-heading {
            margin-bottom: 20px;
        }

        .admin-system-settings .system-heading-badge {
            align-self: flex-start;
        }

        .admin-system-settings .system-notice {
            padding: 17px;
            gap: 12px;
        }

        .admin-system-settings .system-notice-icon {
            width: 39px;
            height: 39px;
            min-width: 39px;
            font-size: 18px;
        }

        .admin-system-settings .system-card-body {
            padding: 17px;
        }

        .admin-system-settings .system-info-item {
            padding: 14px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4 admin-system-settings">

    {{-- HEADER --}}
    <section class="system-heading">
        <div>
            <div class="system-eyebrow">ADMINISTRASI PLATFORM</div>
            <h1 class="system-title">Pengaturan Sistem</h1>
            <p class="system-description">
                Informasi lingkungan aplikasi dan konfigurasi teknis sistem rekrutmen.
            </p>
        </div>

        <div class="system-heading-badge">
            <i class="bi bi-sliders"></i>
            SYSTEM OVERVIEW
        </div>
    </section>

    {{-- INFORMASI KEAMANAN --}}
    <section class="system-notice">
        <div class="system-notice-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
        <div>
            <div class="system-notice-title">Pusat Informasi Sistem</div>
            <p class="system-notice-text">
                Halaman ini bersifat baca-saja. Konfigurasi sensitif seperti kredensial database,
                kunci aplikasi, dan rahasia layanan tidak ditampilkan atau dapat diubah dari halaman ini.
            </p>
        </div>
    </section>

    <div class="row g-4">

        {{-- INFORMASI APLIKASI --}}
        <div class="col-xl-8">
            <section class="system-section-card">
                <div class="system-card-body">
                    <div class="system-card-heading">
                        <div class="system-card-heading-icon">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <div>
                            <h2 class="system-card-title">Informasi Aplikasi</h2>
                            <p class="system-card-subtitle">Identitas dan lingkungan teknis aplikasi</p>
                        </div>
                    </div>

                    @php
                        $items = [
                            ['label'=>'Nama Aplikasi','value'=>$systemInformation['application_name'],'icon'=>'bi-window'],
                            ['label'=>'Environment','value'=>$systemInformation['environment'],'icon'=>'bi-layers'],
                            ['label'=>'Laravel Framework','value'=>$systemInformation['laravel_version'],'icon'=>'bi-box'],
                            ['label'=>'Versi PHP','value'=>$systemInformation['php_version'],'icon'=>'bi-code-slash'],
                            ['label'=>'Zona Waktu','value'=>$systemInformation['timezone'],'icon'=>'bi-clock'],
                            ['label'=>'Database Driver','value'=>$systemInformation['database_driver'],'icon'=>'bi-database'],
                        ];
                    @endphp

                    <div class="row g-3">
                        @foreach($items as $item)
                            <div class="col-12 col-md-6">
                                <div class="system-info-item">
                                    <div class="system-info-label">
                                        <i class="bi {{ $item['icon'] }}"></i>
                                        {{ $item['label'] }}
                                    </div>
                                    <div class="system-info-value">
                                        {{ $item['value'] ?: '-' }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>

        {{-- STATUS DAN KEAMANAN --}}
        <div class="col-xl-4">
            <section class="system-section-card mb-4">
                <div class="system-card-body">
                    <div class="system-card-heading">
                        <div class="system-card-heading-icon">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                        <div>
                            <h2 class="system-card-title">Status Aplikasi</h2>
                            <p class="system-card-subtitle">Kondisi operasional sistem</p>
                        </div>
                    </div>

                    <div class="system-status-row">
                        <span class="system-status-label">Aplikasi</span>
                        <span class="system-status-badge system-status-good">
                            <i class="bi bi-circle-fill"></i>
                            Terpasang
                        </span>
                    </div>

                    <div class="system-status-row">
                        <span class="system-status-label">Mode Maintenance</span>
                        @if($systemInformation['maintenance_mode'])
                            <span class="system-status-badge system-status-warning">
                                <i class="bi bi-circle-fill"></i>
                                Aktif
                            </span>
                        @else
                            <span class="system-status-badge system-status-good">
                                <i class="bi bi-circle-fill"></i>
                                Tidak Aktif
                            </span>
                        @endif
                    </div>

                    <div class="system-status-row">
                        <span class="system-status-label">Akses Pengaturan</span>
                        <span class="system-status-badge system-status-neutral">
                            <i class="bi bi-lock-fill"></i>
                            Read Only
                        </span>
                    </div>
                </div>
            </section>

            <section class="system-security-card">
                <div class="system-card-body">
                    <div class="system-security-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h2 class="system-security-title">Keamanan Sistem</h2>
                    <p class="system-security-text">
                        Informasi rahasia tidak ditampilkan. Perubahan environment dan kredensial
                        harus dilakukan melalui pengelolaan server yang memiliki akses resmi.
                    </p>
                </div>
            </section>
        </div>

    </div>
</div>
@endsection