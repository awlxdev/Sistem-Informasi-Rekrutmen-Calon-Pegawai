@extends('layouts.app')

@section('title', 'Jadwal Pendaftaran')

@section('styles')
<style nonce="{{ Vite::cspNonce() }}">
/* HRD PAGE SHELL - KONSISTENSI AREA KONTEN */
.panel-content > .container-fluid.hrd-page-shell.hrd-schedule-page {
    width: 100% !important;
    max-width: none !important;
    min-width: 0 !important;
    margin: 0 !important;
    padding: 0 12px !important;
    box-sizing: border-box !important;
}

.panel-content > .container-fluid.hrd-page-shell.hrd-schedule-page > * {
    min-width: 0;
}

@media (max-width: 575.98px) {
    .panel-content > .container-fluid.hrd-page-shell.hrd-schedule-page {
        padding-left: 8px !important;
        padding-right: 8px !important;
    }
}

    :is(.admin-schedule-page, .hrd-schedule-page) {
        width: 100%;
        min-width: 0;
        color: #26342e;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .page-heading {
        margin-bottom: 26px;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .section-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #39745d;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.8px;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .section-eyebrow::before {
        content: "";
        width: 22px;
        height: 2px;
        border-radius: 5px;
        background: #b99a62;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .page-heading h1 {
        margin: 0 0 9px;
        color: #193c30;
        font-size: clamp(25px, 3vw, 32px);
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -.8px;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .page-heading p {
        max-width: 650px;
        margin: 0;
        color: #7b8780;
        font-size: 13px;
        line-height: 1.8;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .page-heading > a {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 17px;
        border: 1px solid #dce7df;
        border-radius: 10px;
        background: #fff;
        color: #245c43;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 3px 10px rgba(25, 48, 37, .04);
        transition: .2s ease;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .page-heading > a:hover {
        border-color: #b99a62;
        background: #f8f6f0;
        transform: translateY(-2px);
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .dashboard-card {
        height: 100%;
        overflow: hidden;
        border: 1px solid #e9ede9;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 4px 18px rgba(25, 48, 37, .055);
        transition: box-shadow .22s ease, transform .22s ease;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .dashboard-card:hover {
        box-shadow: 0 10px 26px rgba(25, 48, 37, .075);
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .row.g-3.mb-4 > div > .dashboard-card {
        padding: 19px !important;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .row.g-3.mb-4 .small {
        color: #7b8780 !important;
        font-size: 11px;
        font-weight: 650;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .row.g-3.mb-4 i {
        font-size: 19px;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .row.g-3.mb-4 .fs-3 {
        margin-top: 13px !important;
        color: #193c30;
        font-size: 27px !important;
        font-weight: 800;
        letter-spacing: -.6px;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .dashboard-card > .border-bottom,
    :is(.admin-schedule-page, .hrd-schedule-page) .dashboard-card > .border-top {
        border-color: #edf0ed !important;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .dashboard-card h5 {
        color: #193c30;
        font-size: 15px;
        font-weight: 800;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .dashboard-card p {
        color: #7b8780;
        font-size: 11px;
        line-height: 1.7;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .dashboard-card > div > .badge {
        padding: 7px 10px;
        border: 1px solid #e9ede9;
        border-radius: 8px;
        background: #f8faf8 !important;
        color: #526158 !important;
        font-size: 10px;
        font-weight: 700;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .table-responsive {
        width: 100%;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .table {
        min-width: 850px;
        margin-bottom: 0;
        vertical-align: middle;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .table thead th {
        padding: 15px 17px;
        border-bottom: 1px solid #e9ede9;
        background: #f8faf8;
        color: #68776e;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .4px;
        white-space: nowrap;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .table tbody td {
        padding: 17px;
        border-bottom: 1px solid #eef1ee;
        color: #526158;
        font-size: 11px;
        white-space: nowrap;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .table tbody tr:last-child td {
        border-bottom: 0;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .table tbody tr:hover td {
        background: #fbfcfb;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .table tbody td:first-child {
        min-width: 210px;
        white-space: normal;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .table tbody td:first-child .fw-semibold {
        color: #193c30 !important;
        font-size: 12px;
        font-weight: 750;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .table tbody td .badge {
        padding: 7px 10px;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 700;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .pagination {
        margin-bottom: 0;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .page-link {
        border-color: #e7ebe7;
        color: #286448;
        font-size: 11px;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .page-item.active .page-link {
        border-color: #164438;
        background: #164438;
        color: #fff;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .table .text-center {
        white-space: normal;
    }

    :is(.admin-schedule-page, .hrd-schedule-page) .table .text-center .btn {
        min-height: 38px;
        padding: 8px 14px;
        border-radius: 9px;
        font-size: 11px;
        font-weight: 700;
    }

    @media (max-width: 767.98px) {
        :is(.admin-schedule-page, .hrd-schedule-page) .page-heading {
            align-items: stretch !important;
            gap: 15px !important;
            margin-bottom: 21px;
        }

        :is(.admin-schedule-page, .hrd-schedule-page) .page-heading > a {
            width: 100%;
        }

        :is(.admin-schedule-page, .hrd-schedule-page) .row.g-3.mb-4 > div > .dashboard-card {
            padding: 15px !important;
        }

        :is(.admin-schedule-page, .hrd-schedule-page) .dashboard-card > .border-bottom {
            padding: 17px !important;
        }

        :is(.admin-schedule-page, .hrd-schedule-page) .table thead th,
        :is(.admin-schedule-page, .hrd-schedule-page) .table tbody td {
            padding: 13px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        :is(.admin-schedule-page, .hrd-schedule-page) *,
        :is(.admin-schedule-page, .hrd-schedule-page) *::before,
        :is(.admin-schedule-page, .hrd-schedule-page) *::after {
            transition-duration: .01ms !important;
            animation-duration: .01ms !important;
        }
    }
</style>
@endsection
@section('content')
<main class="{{ $routePrefix === 'admin' ? 'container-fluid admin-schedule-page' : 'container-fluid hrd-page-shell hrd-schedule-page' }}">
<div class="page-heading d-flex flex-wrap align-items-start justify-content-between gap-3">
    <div>
        <div class="section-eyebrow mb-2">MANAJEMEN REKRUTMEN</div>
        <h1>Jadwal Pendaftaran</h1>
        <p>Pantau periode pembukaan dan penutupan setiap lowongan pekerjaan.</p>
    </div>
    <a href="{{ route($routePrefix . '.vacancies.index') }}" class="btn btn-outline-primary">
        <i class="bi bi-briefcase me-1"></i> Manajemen Lowongan
    </a>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="dashboard-card p-3 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <span class="text-muted small">Total Lowongan</span>
                <i class="bi bi-briefcase text-primary-custom"></i>
            </div>
            <div class="fs-3 fw-bold mt-2">{{ $statistics['total'] }}</div>
            <div class="text-muted small">Seluruh data lowongan</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="dashboard-card p-3 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <span class="text-muted small">Diterbitkan</span>
                <i class="bi bi-check-circle text-success"></i>
            </div>
            <div class="fs-3 fw-bold mt-2 text-success">{{ $statistics['published'] }}</div>
            <div class="text-muted small">Status published</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="dashboard-card p-3 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <span class="text-muted small">Draft</span>
                <i class="bi bi-pencil-square text-warning"></i>
            </div>
            <div class="fs-3 fw-bold mt-2 text-warning">{{ $statistics['draft'] }}</div>
            <div class="text-muted small">Belum diterbitkan</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="dashboard-card p-3 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <span class="text-muted small">Ditutup</span>
                <i class="bi bi-lock text-secondary"></i>
            </div>
            <div class="fs-3 fw-bold mt-2 text-secondary">{{ $statistics['closed'] }}</div>
            <div class="text-muted small">Pendaftaran ditutup</div>
        </div>
    </div>
</div>

<div class="dashboard-card overflow-hidden">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-3 p-md-4 border-bottom">
        <div>
            <h5 class="fw-bold mb-1">Kalender Periode Pendaftaran</h5>
            <p class="text-muted small mb-0">Informasi tanggal publikasi dan batas akhir pendaftaran.</p>
        </div>
        <span class="badge bg-light text-dark border">
            {{ $vacancies->total() }} data
        </span>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Lowongan</th>
                    <th>Tanggal Dibuka</th>
                    <th>Batas Pendaftaran</th>
                    <th>Kuota</th>
                    <th>Jumlah Lamaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vacancies as $vacancy)
                    @php
                        $scheduleStatus = $vacancy->status;

                        if (
                            $scheduleStatus === 'published' &&
                            $vacancy->closing_date &&
                            $vacancy->closing_date->lt(today())
                        ) {
                            $scheduleStatus = 'expired';
                        }
                    @endphp
                    <tr>
                        <td>
                            <div class="fw-semibold text-dark">{{ $vacancy->title }}</div>
                            <div class="text-muted small">
                                {{ $vacancy->department ?: 'Departemen belum ditentukan' }}
                            </div>
                        </td>
                        <td>
                            <span class="fw-semibold">
                                {{ $vacancy->published_at?->format('d M Y') ?? 'Belum ditentukan' }}
                            </span>
                        </td>
                        <td>
                            <span class="fw-semibold">
                                {{ $vacancy->closing_date?->format('d M Y') ?? 'Tidak ditentukan' }}
                            </span>
                        </td>
                        <td>{{ number_format($vacancy->quota, 0, ',', '.') }} orang</td>
                        <td>{{ number_format($vacancy->applications_count, 0, ',', '.') }}</td>
                        <td>
                            @if($scheduleStatus === 'published')
                                <span class="badge bg-success-subtle text-success">Berlangsung</span>
                            @elseif($scheduleStatus === 'expired')
                                <span class="badge bg-danger-subtle text-danger">Melewati Batas</span>
                            @elseif($scheduleStatus === 'draft')
                                <span class="badge bg-warning-subtle text-warning-emphasis">Draft</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">Ditutup</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-calendar-x fs-2 text-muted d-block mb-2"></i>
                            <div class="fw-semibold">Belum ada jadwal pendaftaran</div>
                            <div class="text-muted small mt-1">
                                Buat lowongan pekerjaan terlebih dahulu untuk menampilkan jadwal.
                            </div>
                            <a href="{{ route($routePrefix . '.vacancies.create') }}"
                               class="btn btn-primary-custom btn-sm mt-3">
                                <i class="bi bi-plus-lg me-1"></i> Buat Lowongan
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($vacancies->hasPages())
        <div class="p-3 border-top">
            {{ $vacancies->links() }}
        </div>
    @endif
</div>
</main>
@endsection