@extends('layouts.app')

@push('styles')
<style nonce="{{ Vite::cspNonce() }}">
    /* =====================================================
       HRD SELECTION - PREMIUM SOFT 3D
       CSS HANYA AKTIF PADA HALAMAN HRD
    ===================================================== */

    .hrd-selection-page {
        --hrd-green: #176448;
        --hrd-green-dark: #104c37;
        --hrd-gold: #c8a96b;
        --hrd-muted: #849188;
        width: 100%;
        max-width: none;
        margin: 0;
        padding: 24px 12px 40px;
        color: #26372f;
        box-sizing: border-box;
    }

    .hrd-selection-page *,
    .hrd-selection-page *::before,
    .hrd-selection-page *::after {
        box-sizing: border-box;
    }

    .hrd-selection-page .hrd-selection-heading {
        margin-bottom: 22px;
    }

    .hrd-selection-page .hrd-selection-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: var(--hrd-green);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .hrd-selection-page .hrd-selection-title {
        color: #1b3e2e;
        font-size: clamp(23px, 3vw, 29px);
        font-weight: 800;
        letter-spacing: -.7px;
        margin: 0 0 7px;
    }

    .hrd-selection-page .hrd-selection-description {
        color: #849188;
        font-size: 12px;
        line-height: 1.7;
        margin: 0;
    }

    .hrd-selection-page .hrd-stat-card {
        position: relative;
        height: 100%;
        min-height: 112px;
        overflow: hidden;
        padding: 18px;
        background: #fff;
        border: 1px solid #e8eee9;
        border-radius: 17px;
        box-shadow: 0 7px 21px rgba(28,64,46,.055);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .hrd-selection-page .hrd-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(28,64,46,.09);
    }

    .hrd-selection-page .hrd-stat-label {
        color: #849188;
        font-size: 11px;
        font-weight: 700;
        line-height: 1.5;
        margin-bottom: 8px;
    }

    .hrd-selection-page .hrd-stat-value {
        color: #244333;
        font-size: 28px;
        font-weight: 800;
        line-height: 1.1;
        font-variant-numeric: tabular-nums;
    }

    .hrd-selection-page .hrd-stat-icon {
        display: grid;
        place-items: center;
        width: 43px;
        height: 43px;
        flex: 0 0 43px;
        border-radius: 13px;
        font-size: 19px;
    }

    .hrd-selection-page .hrd-stat-icon.waiting {
        color: #a47724;
        background: #fff4dc;
    }

    .hrd-selection-page .hrd-stat-icon.reviewing {
        color: #28728b;
        background: #e8f5fa;
    }

    .hrd-selection-page .hrd-stat-icon.accepted {
        color: #176448;
        background: #e8f5ec;
    }

    .hrd-selection-page .hrd-stat-icon.rejected {
        color: #a34545;
        background: #fceeee;
    }

    .hrd-selection-page .hrd-selection-panel {
        overflow: hidden;
        background: #fff;
        border: 1px solid #e8eee9;
        border-radius: 19px;
        box-shadow: 0 8px 25px rgba(28,64,46,.055);
    }

    .hrd-selection-page .hrd-panel-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 19px 21px;
        border-bottom: 1px solid #edf1ed;
    }

    .hrd-selection-page .hrd-panel-icon {
        display: grid;
        place-items: center;
        width: 41px;
        height: 41px;
        flex: 0 0 41px;
        color: var(--hrd-green);
        background: #eaf4ee;
        border-radius: 12px;
        font-size: 18px;
    }

    .hrd-selection-page .hrd-panel-title {
        color: #1c4030;
        font-size: 14px;
        font-weight: 800;
        margin: 0 0 3px;
    }

    .hrd-selection-page .hrd-panel-subtitle {
        color: #929e96;
        font-size: 10px;
        margin: 0;
    }

    .hrd-selection-page .hrd-panel-body {
        padding: 21px;
    }

    .hrd-selection-page .hrd-filter-form {
        padding: 16px;
        margin-bottom: 17px;
        background: #f8faf8;
        border: 1px solid #edf1ed;
        border-radius: 14px;
    }

    .hrd-selection-page .hrd-filter-label {
        display: block;
        color: #65766b;
        font-size: 10px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .hrd-selection-page .form-control,
    .hrd-selection-page .form-select {
        min-height: 43px;
        color: #294536;
        background-color: #fff;
        border: 1px solid #e0e9e1;
        border-radius: 10px;
        font-size: 12px;
        box-shadow: none;
    }

    .hrd-selection-page .form-control:focus,
    .hrd-selection-page .form-select:focus {
        border-color: #c8a96b;
        box-shadow: 0 0 0 3px rgba(200,169,107,.13);
    }

    .hrd-selection-page .hrd-btn-filter {
        min-height: 43px;
        color: #fff;
        background: linear-gradient(135deg, #176448, #104c37);
        border: 1px solid #176448;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 800;
        box-shadow: 0 4px 10px rgba(23,100,72,.13);
        transition: all .2s ease;
    }

    .hrd-selection-page .hrd-btn-filter:hover {
        color: #fff;
        background: #104c37;
        transform: translateY(-1px);
    }

    .hrd-selection-page .hrd-btn-reset {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 43px;
        padding: 0 15px;
        color: #617168;
        background: #fff;
        border: 1px solid #dfe8e0;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
        transition: all .2s ease;
    }

    .hrd-selection-page .hrd-btn-reset:hover {
        color: var(--hrd-green);
        border-color: var(--hrd-green);
    }

    .hrd-selection-page .hrd-info-notice {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 13px 15px;
        margin-bottom: 18px;
        color: #567361;
        background: #eff7f1;
        border: 1px solid #dcebe0;
        border-radius: 12px;
        font-size: 11px;
        line-height: 1.7;
    }

    .hrd-selection-page .hrd-info-notice i {
        color: var(--hrd-green);
        font-size: 16px;
        margin-top: 1px;
    }

    .hrd-selection-page .hrd-table-wrap {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #edf1ed;
        border-radius: 13px;
    }

    .hrd-selection-page .hrd-selection-table {
        width: 100%;
        min-width: 850px;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        vertical-align: middle;
    }

    .hrd-selection-page .hrd-selection-table thead th {
        padding: 14px 15px;
        color: #748278;
        background: #f7f9f7;
        border-bottom: 1px solid #e8eee9;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .35px;
        white-space: nowrap;
    }

    .hrd-selection-page .hrd-selection-table tbody td {
        padding: 15px;
        color: #42564a;
        border-bottom: 1px solid #edf1ed;
        font-size: 11px;
    }

    .hrd-selection-page .hrd-selection-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .hrd-selection-page .hrd-selection-table tbody tr {
        transition: background .15s ease;
    }

    .hrd-selection-page .hrd-selection-table tbody tr:hover {
        background: #fafcf9;
    }

    .hrd-selection-page .hrd-application-number {
        color: #28543d;
        font-size: 11px;
        font-weight: 800;
        overflow-wrap: anywhere;
    }

    .hrd-selection-page .hrd-applicant-name {
        color: #294536;
        font-size: 11px;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .hrd-selection-page .hrd-applicant-nik {
        color: #929e96;
        font-size: 10px;
    }

    .hrd-selection-page .hrd-vacancy-name {
        color: #52665a;
        font-size: 11px;
        font-weight: 700;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .hrd-selection-page .hrd-document-count {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        color: #587262;
        background: #f2f6f2;
        border: 1px solid #e4ebe4;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .hrd-selection-page .hrd-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .hrd-selection-page .hrd-status-badge.submitted {
        color: #946b20;
        background: #fff5dc;
        border: 1px solid #f1e2b9;
    }

    .hrd-selection-page .hrd-status-badge.reviewing {
        color: #28728b;
        background: #e8f5fa;
        border: 1px solid #d2eaf2;
    }

    .hrd-selection-page .hrd-status-badge.accepted {
        color: #176448;
        background: #e8f5ec;
        border: 1px solid #d5e9da;
    }

    .hrd-selection-page .hrd-status-badge.rejected {
        color: #a34545;
        background: #fceeee;
        border: 1px solid #f3dada;
    }

    .hrd-selection-page .hrd-status-badge.other {
        color: #68756d;
        background: #eef1ee;
        border: 1px solid #e1e7e1;
    }

    .hrd-selection-page .hrd-btn-review {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 35px;
        padding: 7px 12px;
        color: #fff;
        background: #176448;
        border: 1px solid #176448;
        border-radius: 9px;
        font-size: 10px;
        font-weight: 800;
        text-decoration: none;
        white-space: nowrap;
        transition: all .2s ease;
    }

    .hrd-selection-page .hrd-btn-review:hover {
        color: #fff;
        background: #104c37;
        border-color: #104c37;
        transform: translateY(-1px);
    }

    .hrd-selection-page .hrd-empty-state {
        padding: 42px 18px !important;
        text-align: center;
    }

    .hrd-selection-page .hrd-empty-icon {
        display: grid;
        place-items: center;
        width: 58px;
        height: 58px;
        margin: 0 auto 13px;
        color: #81958a;
        background: #edf4ee;
        border-radius: 18px;
        font-size: 25px;
    }

    .hrd-selection-page .hrd-empty-title {
        color: #294536;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .hrd-selection-page .hrd-empty-text {
        color: #929e96;
        font-size: 11px;
        margin: 0;
    }

    .hrd-selection-page .pagination {
        gap: 5px;
        flex-wrap: wrap;
        margin-bottom: 0;
    }

    .hrd-selection-page .page-link {
        color: #426653;
        border-color: #e5ece6;
        border-radius: 8px !important;
        font-size: 11px;
    }

    .hrd-selection-page .page-item.active .page-link {
        color: #fff;
        background: #176448;
        border-color: #176448;
    }

    .hrd-selection-page .page-item.disabled .page-link {
        color: #aab4ac;
        background: #f8faf8;
    }

    @media (max-width: 767.98px) {
        .hrd-selection-page {
            padding: 18px 8px 30px;
        }

        .hrd-selection-page .hrd-panel-header {
            padding: 16px;
        }

        .hrd-selection-page .hrd-panel-body {
            padding: 15px;
        }

        .hrd-selection-page .hrd-stat-card {
            padding: 15px;
        }

        .hrd-selection-page .hrd-stat-value {
            font-size: 24px;
        }
    }

    @media (max-width: 575.98px) {
        .hrd-selection-page .hrd-stat-card {
            min-height: 100px;
        }

        .hrd-selection-page .hrd-stat-icon {
            width: 36px;
            height: 36px;
            flex-basis: 36px;
            font-size: 16px;
        }

        .hrd-selection-page .hrd-filter-form {
            padding: 12px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .hrd-selection-page *,
        .hrd-selection-page *::before,
        .hrd-selection-page *::after {
            transition-duration: .01ms !important;
            animation-duration: .01ms !important;
        }
    }
</style>
@endpush

@section('content')
@php
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

<div class="container-fluid py-4 px-3 px-lg-4 hrd-selection-page">

    {{-- PAGE HEADING --}}
    <div class="hrd-selection-heading">
        <div class="hrd-selection-eyebrow">
            <i class="bi bi-shield-check"></i>
            Proses Rekrutmen
        </div>

        <h3 class="hrd-selection-title">Seleksi Administrasi</h3>

        <p class="hrd-selection-description">
            Periksa kelengkapan dokumen dan tentukan hasil seleksi calon pegawai.
        </p>

        <div class="mt-3">
            <a
                href="{{ route(request()->routeIs('admin.*') ? 'admin.selection.print' : 'hrd.selection.print') }}"
                target="_blank"
                rel="noopener"
                class="btn btn-success"
                style="border-radius: 11px; padding: 10px 17px; font-size: 12px; font-weight: 700; box-shadow: 0 5px 14px rgba(23,100,72,.16);"
            >
                <i class="bi bi-printer me-2"></i>
                Cetak Pelamar Lulus
            </a>
        </div>
    </div>

    {{-- STATISTICS --}}
    <div class="row g-3 mb-4">

        @foreach([
            [
                'label' => 'Menunggu Pemeriksaan',
                'value' => $statistics['submitted'],
                'icon' => 'bi-hourglass-split',
                'class' => 'waiting',
            ],
            [
                'label' => 'Sedang Ditinjau',
                'value' => $statistics['reviewing'],
                'icon' => 'bi-search',
                'class' => 'reviewing',
            ],
            [
                'label' => 'Diterima',
                'value' => $statistics['accepted'],
                'icon' => 'bi-check-circle',
                'class' => 'accepted',
            ],
            [
                'label' => 'Ditolak',
                'value' => $statistics['rejected'],
                'icon' => 'bi-x-circle',
                'class' => 'rejected',
            ],
        ] as $stat)
            <div class="col-6 col-xl-3">
                <div class="hrd-stat-card">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <div class="min-w-0">
                            <div class="hrd-stat-label">{{ $stat['label'] }}</div>
                            <div class="hrd-stat-value">
                                {{ number_format($stat['value']) }}
                            </div>
                        </div>

                        <div class="hrd-stat-icon {{ $stat['class'] }}">
                            <i class="bi {{ $stat['icon'] }}"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    {{-- APPLICATION LIST --}}
    <div class="hrd-selection-panel">

        <div class="hrd-panel-header">
            <div class="hrd-panel-icon">
                <i class="bi bi-clipboard2-check"></i>
            </div>

            <div>
                <h5 class="hrd-panel-title">Daftar Lamaran</h5>
                <p class="hrd-panel-subtitle">
                    Pemeriksaan administrasi calon pegawai
                </p>
            </div>
        </div>

        <div class="hrd-panel-body">

            {{-- FILTER FORM --}}
            <form method="GET" class="hrd-filter-form">
                <div class="row g-3 align-items-end">

                    <div class="col-lg-6">
                        <label class="hrd-filter-label" for="selection-search">
                            Cari Nama Pelamar atau Posisi
                        </label>

                        <input
                            id="selection-search"
                            type="text"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Masukkan nama pelamar atau posisi yang dilamar..."
                        >
                    </div>

                    <div class="col-lg-3">
                        <label class="hrd-filter-label" for="selection-status">
                            Filter Status
                        </label>

                        <select
                            id="selection-status"
                            name="status"
                            class="form-select"
                        >
                            <option value="">Menunggu dan Ditinjau</option>

                            @foreach($statusLabels as $key => $label)
                                <option
                                    value="{{ $key }}"
                                    @selected(request('status') === $key)
                                >
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn hrd-btn-filter flex-grow-1">
                                <i class="bi bi-funnel me-1"></i>
                                Filter
                            </button>

                            <a
                                href="{{ route(request()->routeIs('admin.*') ? 'admin.selection.index' : 'hrd.selection.index') }}"
                                class="hrd-btn-reset"
                            >
                                Reset
                            </a>
                        </div>
                    </div>

                </div>
            </form>

            {{-- INFORMATION --}}
            <div class="hrd-info-notice">
                <i class="bi bi-info-circle"></i>

                <div>
                    Buka detail lamaran untuk memeriksa dokumen, memberikan catatan,
                    dan memperbarui hasil seleksi administrasi.
                </div>
            </div>

            {{-- TABLE --}}
            <div class="hrd-table-wrap">
                <table class="table hrd-selection-table align-middle">
                    <thead>
                        <tr>
                            <th>Nomor Lamaran</th>
                            <th>Pelamar</th>
                            <th>Lowongan</th>
                            <th>Dokumen</th>
                            <th>Status</th>
                            <th class="text-end">Pemeriksaan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($applications as $application)
                            <tr>
                                <td>
                                    <div class="hrd-application-number">
                                        {{ $application->application_number }}
                                    </div>
                                </td>

                                <td>
                                    <div class="hrd-applicant-name">
                                        {{ $application->applicant->full_name ?? '-' }}
                                    </div>

                                    <div class="hrd-applicant-nik">
                                        {{ $application->applicant->nik ?? '-' }}
                                    </div>
                                </td>

                                <td>
                                    <div class="hrd-vacancy-name">
                                        {{ $application->vacancy->title ?? '-' }}
                                    </div>
                                </td>

                                <td>
                                    <span class="hrd-document-count">
                                        <i class="bi bi-paperclip"></i>
                                        {{ $application->documents->count() }} file
                                    </span>
                                </td>

                                <td>
                                    <span class="hrd-status-badge {{ in_array($application->status, ['submitted', 'reviewing', 'accepted', 'rejected']) ? $application->status : 'other' }}">
                                        <i class="bi bi-circle-fill" style="font-size:6px"></i>
                                        {{ $statusLabels[$application->status] ?? ucfirst($application->status) }}
                                    </span>
                                </td>

                                <td class="text-end">
                                    <a
                                        href="{{ route(request()->routeIs('admin.*') ? 'admin.applications.show' : 'hrd.applications.show', $application) }}"
                                        class="hrd-btn-review"
                                    >
                                        <i class="bi bi-clipboard-check"></i>
                                        Periksa
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="hrd-empty-state">
                                    <div class="hrd-empty-icon">
                                        <i class="bi bi-clipboard-check"></i>
                                    </div>

                                    <div class="hrd-empty-title">
                                        Tidak Ada Lamaran untuk Ditampilkan
                                    </div>

                                    <p class="hrd-empty-text">
                                        Coba ubah filter atau periksa kembali nanti.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-3">
                {{ $applications->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
