@extends('layouts.app')

@push('styles')
<style nonce="{{ Vite::cspNonce() }}">
    /* =====================================================
       HRD APPLICANT DETAIL - PREMIUM SOFT 3D
       CSS TERBATAS UNTUK HALAMAN DETAIL PELAMAR
    ===================================================== */

    .hrd-applicant-detail-page {
        --hrd-green: #176448;
        --hrd-green-dark: #104c37;
        --hrd-gold: #c8a96b;
        --hrd-muted: #78867e;
        width: 100%;
        max-width: none;
        margin: 0;
        padding: 24px 12px 40px;
        color: #26372f;
        box-sizing: border-box;
    }

    .hrd-applicant-detail-page *,
    .hrd-applicant-detail-page *::before,
    .hrd-applicant-detail-page *::after {
        box-sizing: border-box;
    }

    .hrd-applicant-detail-page .hrd-back-link {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 10px 15px;
        margin-bottom: 20px;
        color: #426653;
        background: #fff;
        border: 1px solid #e5ece6;
        border-radius: 11px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 4px 13px rgba(28, 64, 46, .04);
        transition: all .2s ease;
    }

    .hrd-applicant-detail-page .hrd-back-link:hover {
        color: #fff;
        background: var(--hrd-green);
        border-color: var(--hrd-green);
        transform: translateX(-2px);
    }

    .hrd-applicant-detail-page .hrd-profile-banner {
        position: relative;
        overflow: hidden;
        padding: 27px;
        margin-bottom: 22px;
        color: #fff;
        background: linear-gradient(115deg, #123d31, #1c5944);
        border: 1px solid rgba(200, 169, 107, .2);
        border-radius: 21px;
        box-shadow: 0 12px 28px rgba(16, 76, 55, .13);
    }

    .hrd-applicant-detail-page .hrd-profile-banner::before {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        top: -130px;
        right: -50px;
        border: 1px solid rgba(255,255,255,.09);
        border-radius: 50%;
        box-shadow: 0 0 0 24px rgba(255,255,255,.025),
                    0 0 0 48px rgba(255,255,255,.02);
        pointer-events: none;
    }

    .hrd-applicant-detail-page .hrd-profile-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 19px;
    }

    .hrd-applicant-detail-page .hrd-profile-avatar {
        display: grid;
        place-items: center;
        width: 76px;
        height: 76px;
        flex: 0 0 76px;
        color: #f2dfb8;
        background: rgba(255,255,255,.11);
        border: 1px solid rgba(200,169,107,.55);
        border-radius: 22px;
        font-size: 35px;
        box-shadow: inset 0 1px 0 rgba(255,255,255,.12);
    }

    .hrd-applicant-detail-page .hrd-profile-eyebrow {
        color: #e4c98f;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.6px;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .hrd-applicant-detail-page .hrd-profile-name {
        color: #fff;
        font-size: clamp(22px, 3vw, 29px);
        font-weight: 800;
        letter-spacing: -.7px;
        margin: 0 0 7px;
        overflow-wrap: anywhere;
    }

    .hrd-applicant-detail-page .hrd-profile-email {
        color: rgba(255,255,255,.73);
        font-size: 12px;
        overflow-wrap: anywhere;
    }

    .hrd-applicant-detail-page .hrd-profile-tag {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 12px;
        padding: 6px 11px;
        color: #f0dfba;
        background: rgba(200,169,107,.13);
        border: 1px solid rgba(200,169,107,.3);
        border-radius: 30px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .5px;
    }

    .hrd-applicant-detail-page .hrd-detail-card {
        height: 100%;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e8eee9;
        border-radius: 19px;
        box-shadow: 0 8px 25px rgba(28, 64, 46, .055);
    }

    .hrd-applicant-detail-page .hrd-detail-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 19px 21px;
        border-bottom: 1px solid #edf1ed;
    }

    .hrd-applicant-detail-page .hrd-section-icon {
        display: grid;
        place-items: center;
        width: 40px;
        height: 40px;
        flex: 0 0 40px;
        color: var(--hrd-green);
        background: #eaf4ee;
        border-radius: 12px;
        font-size: 18px;
    }

    .hrd-applicant-detail-page .hrd-section-icon.gold {
        color: #99763b;
        background: #f8f1e3;
    }

    .hrd-applicant-detail-page .hrd-section-title {
        color: #1c4030;
        font-size: 15px;
        font-weight: 800;
        margin: 0 0 3px;
    }

    .hrd-applicant-detail-page .hrd-section-subtitle {
        color: #929e96;
        font-size: 11px;
        margin: 0;
    }

    .hrd-applicant-detail-page .hrd-detail-card-body {
        padding: 21px;
    }

    .hrd-applicant-detail-page .hrd-info-item {
        min-width: 0;
        padding: 12px 13px;
        margin-bottom: 10px;
        background: #fafbf9;
        border: 1px solid #eff2ed;
        border-radius: 12px;
    }

    .hrd-applicant-detail-page .hrd-info-label {
        display: block;
        color: #8a978f;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .4px;
        margin-bottom: 6px;
    }

    .hrd-applicant-detail-page .hrd-info-value {
        color: #294536;
        font-size: 12px;
        font-weight: 700;
        line-height: 1.65;
        overflow-wrap: anywhere;
    }

    .hrd-applicant-detail-page .hrd-education-item {
        height: 100%;
        min-height: 90px;
        padding: 15px;
        background: #fafbf9;
        border: 1px solid #edf1ed;
        border-radius: 13px;
    }

    .hrd-applicant-detail-page .hrd-education-label {
        display: block;
        color: #8a978f;
        font-size: 10px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .hrd-applicant-detail-page .hrd-education-value {
        color: #294536;
        font-size: 13px;
        font-weight: 800;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .hrd-applicant-detail-page .hrd-history-count {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        color: #176448;
        background: #eaf4ee;
        border: 1px solid #dcebe0;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .hrd-applicant-detail-page .hrd-application-item {
        padding: 18px;
        margin-bottom: 13px;
        background: #fbfcfa;
        border: 1px solid #e9eee9;
        border-radius: 15px;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .hrd-applicant-detail-page .hrd-application-item:hover {
        border-color: #d3e3d7;
        box-shadow: 0 6px 17px rgba(28, 64, 46, .045);
    }

    .hrd-applicant-detail-page .hrd-vacancy-title {
        color: #244333;
        font-size: 13px;
        font-weight: 800;
        line-height: 1.6;
        margin-bottom: 5px;
        overflow-wrap: anywhere;
    }

    .hrd-applicant-detail-page .hrd-application-number {
        color: #929e96;
        font-size: 10px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .hrd-applicant-detail-page .hrd-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .hrd-applicant-detail-page .hrd-status-badge.submitted {
        color: #946b20;
        background: #fff5dc;
        border: 1px solid #f1e2b9;
    }

    .hrd-applicant-detail-page .hrd-status-badge.reviewing {
        color: #28728b;
        background: #e8f5fa;
        border: 1px solid #d2eaf2;
    }

    .hrd-applicant-detail-page .hrd-status-badge.accepted {
        color: #176448;
        background: #e8f5ec;
        border: 1px solid #d5e9da;
    }

    .hrd-applicant-detail-page .hrd-status-badge.rejected {
        color: #a34545;
        background: #fceeee;
        border: 1px solid #f3dada;
    }

    .hrd-applicant-detail-page .hrd-status-badge.other {
        color: #68756d;
        background: #eef1ee;
        border: 1px solid #e1e7e1;
    }

    .hrd-applicant-detail-page .hrd-application-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px 18px;
        margin-top: 14px;
        padding-top: 12px;
        border-top: 1px solid #edf1ed;
        color: #87948b;
        font-size: 11px;
    }

    .hrd-applicant-detail-page .hrd-application-meta span {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .hrd-applicant-detail-page .hrd-btn-application {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 37px;
        margin-top: 14px;
        padding: 8px 13px;
        color: #176448;
        background: #eff7f1;
        border: 1px solid #dcebe0;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 800;
        text-decoration: none;
        transition: all .2s ease;
    }

    .hrd-applicant-detail-page .hrd-btn-application:hover {
        color: #fff;
        background: #176448;
        border-color: #176448;
        transform: translateY(-1px);
    }

    .hrd-applicant-detail-page .hrd-empty-history {
        padding: 35px 18px;
        text-align: center;
        background: #fafbf9;
        border: 1px dashed #dce5dc;
        border-radius: 14px;
    }

    .hrd-applicant-detail-page .hrd-empty-history-icon {
        display: grid;
        place-items: center;
        width: 55px;
        height: 55px;
        margin: 0 auto 13px;
        color: #81958a;
        background: #edf4ee;
        border-radius: 17px;
        font-size: 24px;
    }

    .hrd-applicant-detail-page .hrd-empty-history-title {
        color: #294536;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .hrd-applicant-detail-page .hrd-empty-history-text {
        color: #929e96;
        font-size: 11px;
        margin: 0;
    }

    @media (max-width: 767.98px) {
        .hrd-applicant-detail-page {
            padding: 18px 8px 30px;
        }

        .hrd-applicant-detail-page .hrd-profile-banner {
            padding: 21px;
            border-radius: 17px;
        }

        .hrd-applicant-detail-page .hrd-detail-card-header {
            padding: 16px;
        }

        .hrd-applicant-detail-page .hrd-detail-card-body {
            padding: 16px;
        }
    }

    @media (max-width: 575.98px) {
        .hrd-applicant-detail-page .hrd-profile-content {
            align-items: flex-start;
            gap: 14px;
        }

        .hrd-applicant-detail-page .hrd-profile-avatar {
            width: 61px;
            height: 61px;
            flex-basis: 61px;
            border-radius: 17px;
            font-size: 28px;
        }

        .hrd-applicant-detail-page .hrd-profile-name {
            font-size: 22px;
        }

        .hrd-applicant-detail-page .hrd-application-item {
            padding: 14px;
        }

        .hrd-applicant-detail-page .hrd-status-badge {
            margin-top: 8px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .hrd-applicant-detail-page *,
        .hrd-applicant-detail-page *::before,
        .hrd-applicant-detail-page *::after {
            transition-duration: .01ms !important;
            animation-duration: .01ms !important;
        }
    }
</style>
@endpush

@section('content')
@php
    $genderLabels = [
        'male' => 'Laki-laki',
        'female' => 'Perempuan',
    ];

    $statusLabels = [
        'submitted' => 'Menunggu Pemeriksaan',
        'reviewing' => 'Sedang Ditinjau',
        'accepted' => 'Diterima',
        'rejected' => 'Ditolak',
    ];

    $statusColors = [
        'submitted' => 'warning',
        'reviewing' => 'info',
        'accepted' => 'success',
        'rejected' => 'danger',
    ];
@endphp

<div class="container-fluid hrd-applicant-detail-page">

    {{-- BACK BUTTON --}}
    <a href="{{ route('hrd.applicants.index') }}" class="hrd-back-link">
        <i class="bi bi-arrow-left"></i>
        Kembali ke Data Pelamar
    </a>

    {{-- PROFILE HEADER --}}
    <div class="hrd-profile-banner">
        <div class="hrd-profile-content">
            <div class="hrd-profile-avatar">
                <i class="bi bi-person"></i>
            </div>

            <div>
                <div class="hrd-profile-eyebrow">Human Resource Development</div>
                <h3 class="hrd-profile-name">{{ $applicant->full_name }}</h3>
                <div class="hrd-profile-email">
                    <i class="bi bi-envelope me-1"></i>
                    {{ $applicant->user->email ?? '-' }}
                </div>
                <div class="hrd-profile-tag">
                    <i class="bi bi-person-vcard"></i>
                    PROFIL PELAMAR
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        {{-- PERSONAL BIODATA --}}
        <div class="col-xl-5">
            <div class="hrd-detail-card">

                <div class="hrd-detail-card-header">
                    <div class="hrd-section-icon">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <div>
                        <h5 class="hrd-section-title">Biodata Pribadi</h5>
                        <p class="hrd-section-subtitle">Informasi identitas calon pegawai</p>
                    </div>
                </div>

                <div class="hrd-detail-card-body">
                    @foreach([
                        'NIK' => $applicant->nik,
                        'Tempat Lahir' => $applicant->place_of_birth,
                        'Tanggal Lahir' => $applicant->date_of_birth ? \Illuminate\Support\Carbon::parse($applicant->date_of_birth)->format('d F Y') : null,
                        'Jenis Kelamin' => $genderLabels[$applicant->gender] ?? $applicant->gender,
                        'Nomor Telepon' => $applicant->phone,
                        'Alamat' => $applicant->address,
                    ] as $label => $value)
                        <div class="hrd-info-item">
                            <span class="hrd-info-label">{{ $label }}</span>
                            <div class="hrd-info-value">{{ $value ?: '-' }}</div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        {{-- EDUCATION AND APPLICATION HISTORY --}}
        <div class="col-xl-7">

            {{-- EDUCATION --}}
            <div class="hrd-detail-card mb-4">

                <div class="hrd-detail-card-header">
                    <div class="hrd-section-icon gold">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <div>
                        <h5 class="hrd-section-title">Pendidikan</h5>
                        <p class="hrd-section-subtitle">Riwayat pendidikan terakhir pelamar</p>
                    </div>
                </div>

                <div class="hrd-detail-card-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="hrd-education-item">
                                <span class="hrd-education-label">Jenjang Pendidikan</span>
                                <div class="hrd-education-value">
                                    {{ $applicant->education_level ?: '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="hrd-education-item">
                                <span class="hrd-education-label">Tahun Lulus</span>
                                <div class="hrd-education-value">
                                    {{ $applicant->graduation_year ?: '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="hrd-education-item">
                                <span class="hrd-education-label">Institusi</span>
                                <div class="hrd-education-value">
                                    {{ $applicant->institution ?: '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="hrd-education-item">
                                <span class="hrd-education-label">Jurusan</span>
                                <div class="hrd-education-value">
                                    {{ $applicant->major ?: '-' }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            {{-- APPLICATION HISTORY --}}
            <div class="hrd-detail-card">

                <div class="hrd-detail-card-header">
                    <div class="hrd-section-icon">
                        <i class="bi bi-folder2-open"></i>
                    </div>

                    <div class="flex-grow-1">
                        <h5 class="hrd-section-title">Riwayat Lamaran</h5>
                        <p class="hrd-section-subtitle">Daftar pengajuan pekerjaan pelamar</p>
                    </div>

                    <span class="hrd-history-count">
                        <i class="bi bi-file-earmark-check"></i>
                        {{ $applicant->applications->count() }} Lamaran
                    </span>
                </div>

                <div class="hrd-detail-card-body">

                    @forelse($applicant->applications as $application)
                        <div class="hrd-application-item">

                            <div class="d-flex flex-wrap justify-content-between align-items-start gap-2">

                                <div class="flex-grow-1">
                                    <div class="hrd-vacancy-title">
                                        {{ $application->vacancy->title ?? 'Lowongan tidak tersedia' }}
                                    </div>

                                    <div class="hrd-application-number">
                                        {{ $application->application_number }}
                                    </div>
                                </div>

                                <span class="hrd-status-badge {{ $application->status }}">
                                    <i class="bi bi-circle-fill" style="font-size:6px"></i>
                                    {{ $statusLabels[$application->status] ?? ucfirst($application->status) }}
                                </span>

                            </div>

                            <div class="hrd-application-meta">
                                <span>
                                    <i class="bi bi-calendar3"></i>
                                    Dikirim:
                                    {{ $application->submitted_at ? $application->submitted_at->format('d F Y H:i') : '-' }}
                                </span>

                                <span>
                                    <i class="bi bi-paperclip"></i>
                                    {{ $application->documents->count() }} dokumen
                                </span>
                            </div>

                            <a
                                href="{{ route('hrd.applications.show', $application) }}"
                                class="hrd-btn-application"
                            >
                                Lihat Detail Lamaran
                                <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>
                    @empty

                        <div class="hrd-empty-history">
                            <div class="hrd-empty-history-icon">
                                <i class="bi bi-inbox"></i>
                            </div>
                            <div class="hrd-empty-history-title">
                                Belum Ada Riwayat Lamaran
                            </div>
                            <p class="hrd-empty-history-text">
                                Pelamar ini belum mengirim lamaran pekerjaan.
                            </p>
                        </div>

                    @endforelse

                </div>
            </div>

        </div>
    </div>
</div>
@endsection