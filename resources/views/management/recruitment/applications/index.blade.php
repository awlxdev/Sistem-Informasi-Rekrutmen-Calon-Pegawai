@extends('layouts.app')

@section('title', 'Data Lamaran')

@push('styles')
<style>
    /* ==========================================
       ADMIN - DATA LAMARAN
       Terisolasi agar tampilan HRD tidak berubah
    ========================================== */

    :is(.admin-applications-page, .hrd-applications-page) {
        width: 100%;
        color: #26342e;
        padding-top: 8px !important;
        padding-bottom: 30px !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 26px !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #39745d !important;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.8px;
        margin-bottom: 10px !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-eyebrow::before {
        content: "";
        width: 22px;
        height: 2px;
        background: #b99a62;
        border-radius: 5px;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-title {
        color: #193c30;
        font-size: clamp(25px, 3vw, 32px);
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -.8px;
        margin: 0 0 9px !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-description {
        max-width: 650px;
        color: #7b8780 !important;
        font-size: 13px;
        line-height: 1.8;
        margin: 0 !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-total {
        display: flex;
        flex-direction: column;
        gap: 4px;
        min-width: 155px;
        background: linear-gradient(145deg, #ffffff, #f6f8f5) !important;
        border: 1px solid #e5ebe5 !important;
        border-radius: 15px !important;
        padding: 13px 18px !important;
        box-shadow: 0 7px 20px rgba(29, 62, 46, .07) !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-total-label {
        color: #7b8780 !important;
        font-size: 11px;
        font-weight: 700;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-total-value {
        color: #193c30;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 800;
    }

    :is(.admin-applications-page, .hrd-applications-page) .alert {
        border-radius: 13px;
        border: 1px solid #d8e9dd;
        box-shadow: 0 5px 15px rgba(29, 62, 46, .05);
        font-size: 13px;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-stat-card {
        height: 100%;
        background: linear-gradient(145deg, #ffffff, #fbfcfa);
        border: 1px solid #e9eee9 !important;
        border-radius: 16px !important;
        box-shadow: 0 6px 18px rgba(29, 62, 46, .055) !important;
        transition: transform .22s ease, box-shadow .22s ease;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(29, 62, 46, .10) !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-stat-card .card-body {
        padding: 20px !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-stat-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px !important;
        box-shadow: inset 0 1px 2px rgba(255,255,255,.6),
                    0 4px 10px rgba(29,62,46,.06);
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-stat-label {
        color: #7b8780 !important;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-stat-value {
        color: #193c30;
        font-size: 25px;
        line-height: 1.2;
        font-weight: 800;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-main-card {
        overflow: hidden;
        background: #fff;
        border: 1px solid #e7ece7 !important;
        border-radius: 17px !important;
        box-shadow: 0 8px 25px rgba(29, 62, 46, .065) !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-main-card > .card-body {
        padding: 24px !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-filter {
        padding: 17px;
        margin-bottom: 24px !important;
        background: #f8faf8;
        border: 1px solid #e8eee8;
        border-radius: 14px;
    }

    :is(.admin-applications-page, .hrd-applications-page) .input-group-text {
        color: #668073;
        border-color: #e0e8e1 !important;
        background: #fff !important;
        border-radius: 10px 0 0 10px;
    }

    :is(.admin-applications-page, .hrd-applications-page) .form-control,
    :is(.admin-applications-page, .hrd-applications-page) .form-select {
        min-height: 43px;
        color: #33483d;
        font-size: 13px;
        border-color: #e0e8e1 !important;
        border-radius: 10px;
        box-shadow: none !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .input-group .form-control {
        border-radius: 0 10px 10px 0;
    }

    :is(.admin-applications-page, .hrd-applications-page) .form-control:focus,
    :is(.admin-applications-page, .hrd-applications-page) .form-select:focus {
        border-color: #b99a62 !important;
        box-shadow: 0 0 0 3px rgba(185,154,98,.13) !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .form-control::placeholder {
        color: #a0aaa3;
    }

    :is(.admin-applications-page, .hrd-applications-page) .btn {
        min-height: 40px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    :is(.admin-applications-page, .hrd-applications-page) .btn-success {
        color: #fff;
        background: linear-gradient(135deg, #286448, #174b37);
        border-color: #286448;
        box-shadow: 0 4px 10px rgba(40,100,72,.16);
    }

    :is(.admin-applications-page, .hrd-applications-page) .btn-success:hover {
        background: #123d2d;
        border-color: #123d2d;
        transform: translateY(-1px);
        box-shadow: 0 7px 14px rgba(40,100,72,.2);
    }

    :is(.admin-applications-page, .hrd-applications-page) .btn-light {
        color: #53665a;
        background: #fff;
        border-color: #dfe7df !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .btn-light:hover {
        color: #24573e;
        background: #edf4ef;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-list-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 15px !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-list-title {
        color: #193c30;
        font-size: 16px;
        font-weight: 800;
        margin: 0;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-result-count {
        color: #7b8780 !important;
        font-size: 12px;
    }

    :is(.admin-applications-page, .hrd-applications-page) .table-responsive {
        border: 1px solid #e8eee8;
        border-radius: 12px;
    }

    :is(.admin-applications-page, .hrd-applications-page) .table {
        margin-bottom: 0;
        color: #46574c;
        font-size: 12px;
        min-width: 760px;
    }

    :is(.admin-applications-page, .hrd-applications-page) .table thead th {
        padding: 15px 14px;
        color: #52685b;
        background: #f3f7f3 !important;
        border-bottom: 1px solid #e3eae3;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .65px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    :is(.admin-applications-page, .hrd-applications-page) .table tbody td {
        padding: 15px 14px;
        border-color: #edf1ed;
        vertical-align: middle;
    }

    :is(.admin-applications-page, .hrd-applications-page) .table tbody tr {
        transition: background .18s ease;
    }

    :is(.admin-applications-page, .hrd-applications-page) .table tbody tr:hover > * {
        background: #f8fbf8;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-number {
        color: #286448;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-applicant-name {
        color: #263d30;
        font-size: 12px;
        font-weight: 700;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-applicant-phone {
        display: inline-block;
        margin-top: 4px;
        color: #8a968e !important;
        font-size: 11px;
    }

    :is(.admin-applications-page, .hrd-applications-page) .badge {
        padding: 7px 11px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .1px;
    }

    :is(.admin-applications-page, .hrd-applications-page) .btn-outline-success {
        color: #286448;
        border-color: #b9d2c1;
        background: #f7fbf8;
    }

    :is(.admin-applications-page, .hrd-applications-page) .btn-outline-success:hover {
        color: #fff;
        background: #286448;
        border-color: #286448;
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(40,100,72,.15);
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-empty {
        padding: 45px 15px !important;
        color: #7b8780;
    }

    :is(.admin-applications-page, .hrd-applications-page) .admin-app-empty i {
        color: #b4c5b8 !important;
    }

    :is(.admin-applications-page, .hrd-applications-page) .pagination {
        gap: 5px;
        flex-wrap: wrap;
    }

    :is(.admin-applications-page, .hrd-applications-page) .pagination .page-link {
        color: #286448;
        border: 1px solid #e3eae3;
        border-radius: 8px !important;
        font-size: 12px;
    }

    :is(.admin-applications-page, .hrd-applications-page) .pagination .active .page-link {
        color: #fff;
        background: #286448;
        border-color: #286448;
    }

    @media (max-width: 767.98px) {
        :is(.admin-applications-page, .hrd-applications-page) {
            padding-left: 2px !important;
            padding-right: 2px !important;
        }

        :is(.admin-applications-page, .hrd-applications-page) .admin-app-heading {
            margin-bottom: 20px !important;
        }

        :is(.admin-applications-page, .hrd-applications-page) .admin-app-total {
            width: 100%;
        }

        :is(.admin-applications-page, .hrd-applications-page) .admin-app-main-card > .card-body {
            padding: 15px !important;
        }

        :is(.admin-applications-page, .hrd-applications-page) .admin-app-filter {
            padding: 12px;
        }

        :is(.admin-applications-page, .hrd-applications-page) .admin-app-filter .col-lg-3,
        :is(.admin-applications-page, .hrd-applications-page) .admin-app-filter .col-lg-6 {
            width: 100%;
        }

        :is(.admin-applications-page, .hrd-applications-page) .admin-app-stat-card .card-body {
            padding: 15px !important;
        }

        :is(.admin-applications-page, .hrd-applications-page) .admin-app-stat-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
        }

        :is(.admin-applications-page, .hrd-applications-page) .admin-app-stat-value {
            font-size: 22px;
        }
    }

    @media (max-width: 420px) {
        :is(.admin-applications-page, .hrd-applications-page) .admin-app-stat-card .card-body {
            gap: 10px !important;
        }

        :is(.admin-applications-page, .hrd-applications-page) .admin-app-stat-icon {
            width: 36px;
            height: 36px;
            min-width: 36px;
            padding: 8px !important;
        }

        :is(.admin-applications-page, .hrd-applications-page) .admin-app-stat-icon i {
            font-size: 16px !important;
        }
    }
</style>
@endpush

@section('content')
@php
    $isHrd = $routePrefix === 'hrd';
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

<div class="container-fluid py-4 px-3 px-lg-4 {{ $routePrefix === 'admin' ? 'admin-applications-page' : 'hrd-applications-page' }}">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 admin-app-heading">
        <div>
            <div class="small text-uppercase fw-semibold text-success mb-1 admin-app-eyebrow">Manajemen Rekrutmen</div>
            <h1 class="fw-bold mb-1 admin-app-title">Data Lamaran</h1>
            <p class="text-muted mb-0 admin-app-description">Pantau seluruh proses pendaftaran calon pegawai.</p>
        </div>
        <div class="rounded-3 bg-white border px-3 py-2 shadow-sm admin-app-total">
            <span class="text-muted small admin-app-total-label">Total Lamaran</span>
            <div class="fs-4 fw-bold admin-app-total-value">{{ number_format($statistics['total']) }}</div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-3 mb-4">
        @foreach([
            ['label'=>'Menunggu', 'value'=>$statistics['submitted'], 'icon'=>'bi-hourglass-split', 'color'=>'warning'],
            ['label'=>'Ditinjau', 'value'=>$statistics['reviewing'], 'icon'=>'bi-search', 'color'=>'info'],
            ['label'=>'Diterima', 'value'=>$statistics['accepted'], 'icon'=>'bi-check-circle', 'color'=>'success'],
            ['label'=>'Ditolak', 'value'=>$statistics['rejected'], 'icon'=>'bi-x-circle', 'color'=>'danger'],
        ] as $stat)
            <div class="col-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 admin-app-stat-card">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-3 bg-{{ $stat['color'] }} bg-opacity-10 text-{{ $stat['color'] }} p-3 admin-app-stat-icon">
                            <i class="bi {{ $stat['icon'] }} fs-4"></i>
                        </div>
                        <div>
                            <div class="text-muted small admin-app-stat-label">{{ $stat['label'] }}</div>
                            <div class="fs-4 fw-bold admin-app-stat-value">{{ number_format($stat['value']) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm rounded-4 admin-app-main-card">
        <div class="card-body p-3 p-lg-4">
            <form method="GET" class="row g-2 mb-4 admin-app-filter">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control bg-light border-start-0"
                            placeholder="Cari nomor lamaran, nama, NIK, telepon, atau lowongan..."
                            value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <select name="status" class="form-select bg-light">
                        <option value="">Semua Status</option>
                        @foreach($statusLabels as $key => $label)
                            <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 d-flex gap-2">
                    <button class="btn btn-success flex-grow-1"><i class="bi bi-funnel me-1"></i>Filter</button>
                    <a href="{{ route($routePrefix.'.applications.index') }}" class="btn btn-light border">Reset</a>
                </div>
            </form>

            <div class="d-flex justify-content-between align-items-center mb-3 admin-app-list-heading">
                <h5 class="fw-bold mb-0 admin-app-list-title">Daftar Pendaftaran</h5>
                <span class="text-muted small admin-app-result-count">{{ $applications->total() }} data ditemukan</span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-nowrap">Nomor Lamaran</th>
                            <th>Pelamar</th>
                            <th>Lowongan</th>
                            <th class="text-nowrap">Tanggal</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($applications as $application)
                        @php
                            $status = $application->status;
                            $color = $statusColors[$status] ?? 'secondary';
                        @endphp
                        <tr>
                            <td>
                                <span class="fw-semibold admin-app-number">{{ $application->application_number }}</span>
                            </td>
                            <td>
                                <div class="fw-semibold admin-applicant-name">{{ $application->applicant->full_name ?? 'Pelamar tidak tersedia' }}</div>
                                <small class="text-muted admin-applicant-phone">{{ $application->applicant->phone ?? '-' }}</small>
                            </td>
                            <td>{{ $application->vacancy->title ?? '-' }}</td>
                            <td class="text-nowrap">
                                {{ $application->submitted_at ? $application->submitted_at->format('d/m/Y') : '-' }}
                            </td>
                            <td>
                                <span class="badge rounded-pill text-bg-{{ $color }}">
                                    {{ $statusLabels[$status] ?? ucfirst($status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route($routePrefix.'.applications.show', $application) }}"
                                    class="btn btn-sm btn-outline-success rounded-3">
                                    <i class="bi bi-eye me-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 admin-app-empty">
                                <i class="bi bi-folder2-open fs-1 text-muted"></i>
                                <p class="fw-semibold mt-2 mb-1">Belum ada data lamaran</p>
                                <span class="text-muted small">Data pendaftaran akan tampil di halaman ini.</span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">{{ $applications->links() }}</div>
        </div>
    </div>
</div>
@endsection