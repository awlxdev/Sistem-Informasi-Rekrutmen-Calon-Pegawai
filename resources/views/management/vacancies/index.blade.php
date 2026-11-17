@extends('layouts.app')

@section('title', 'Manajemen Lowongan Pekerjaan')

@section('navbar')
    @if ($routePrefix === 'hrd')
        @include('components.hrd-navbar')
    @else
        @include('components.admin-navbar')
    @endif
@endsection

@section('styles')
<style>
    .panel-content > .container-fluid.hrd-page-shell.hrd-vacancies-page {
        width: 100% !important;
        max-width: none !important;
        min-width: 0 !important;
        margin: 0 !important;
        padding: 0 12px !important;
        box-sizing: border-box !important;
    }

    .panel-content > .container-fluid.hrd-page-shell.hrd-vacancies-page > * {
        min-width: 0;
    }

    @media (max-width: 575.98px) {
        .panel-content > .container-fluid.hrd-page-shell.hrd-vacancies-page {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }
    }

    .vacancy-stat {
        position: relative;
        overflow: hidden;
        min-height: 112px;
        border: 1px solid var(--border);
        border-radius: 13px;
        background: #fff;
        box-shadow: var(--shadow);
    }

    .vacancy-stat .stat-icon {
        width: 43px;
        height: 43px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        background: var(--primary-soft);
        color: var(--primary);
        font-size: 19px;
    }

    .vacancy-stat .stat-number {
        color: var(--primary);
        font-size: 25px;
        font-weight: 800;
        line-height: 1.2;
    }

    .vacancy-table-title {
        color: var(--primary);
        font-weight: 700;
    }

    .vacancy-actions {
        display: flex;
        align-items: center;
        gap: 5px;
        flex-wrap: wrap;
    }

    .vacancy-actions .btn {
        min-width: 34px;
        min-height: 32px;
        padding: 5px 8px;
    }

    .filter-card {
        border: 1px solid var(--border);
        border-radius: 12px;
        background: #fff;
        box-shadow: var(--shadow);
    }

    /* ADMIN VACANCIES - CONSISTENT WITH ADMIN DASHBOARD */

    :is(.admin-vacancies-page, .hrd-vacancies-page) {
        width: 100%;
        min-width: 0;
        color: #26342e;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .page-heading {
        margin-bottom: 26px;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .section-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #39745d;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.8px;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .section-eyebrow::before {
        content: "";
        width: 22px;
        height: 2px;
        border-radius: 5px;
        background: #b99a62;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .page-heading h1 {
        margin: 0 0 9px;
        color: #193c30;
        font-size: clamp(25px, 3vw, 32px);
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -.8px;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .page-heading p {
        max-width: 650px;
        margin: 0;
        color: #7b8780;
        font-size: 13px;
        line-height: 1.8;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .page-heading > a {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .vacancy-stat,
    :is(.admin-vacancies-page, .hrd-vacancies-page) .filter-card,
    :is(.admin-vacancies-page, .hrd-vacancies-page) .dashboard-card {
        border: 1px solid #e9ede9;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 4px 18px rgba(25, 48, 37, .055);
        transition: box-shadow .22s ease;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .vacancy-stat {
        min-height: 132px;
        padding: 19px !important;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .vacancy-stat:hover,
    :is(.admin-vacancies-page, .hrd-vacancies-page) .filter-card:hover,
    :is(.admin-vacancies-page, .hrd-vacancies-page) .dashboard-card:hover {
        box-shadow: 0 10px 26px rgba(25, 48, 37, .075);
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .vacancy-stat .small {
        color: #7b8780 !important;
        font-size: 11px;
        font-weight: 650;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .vacancy-stat .stat-icon {
        width: 37px;
        height: 37px;
        flex: 0 0 37px;
        border-radius: 11px;
        background: #eaf2ee;
        color: #39745d;
        font-size: 17px;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .vacancy-stat .stat-number {
        margin-top: 12px;
        color: #193c30;
        font-size: 27px;
        font-weight: 800;
        letter-spacing: -.6px;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .filter-card {
        padding: 23px !important;
        margin-bottom: 20px !important;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .form-label {
        margin-bottom: 7px;
        color: #405047;
        font-size: 11px;
        font-weight: 700;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .form-control,
    :is(.admin-vacancies-page, .hrd-vacancies-page) .form-select,
    :is(.admin-vacancies-page, .hrd-vacancies-page) .input-group-text {
        min-height: 42px;
        border-color: #e3e9e4;
        border-radius: 9px;
        font-size: 12px;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .form-control:focus,
    :is(.admin-vacancies-page, .hrd-vacancies-page) .form-select:focus {
        border-color: #b99a62;
        box-shadow: 0 0 0 3px rgba(185, 154, 98, .13);
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .filter-card .btn {
        min-height: 42px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .dashboard-card {
        overflow: hidden;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .dashboard-card h5 {
        color: #193c30;
        font-size: 15px;
        font-weight: 800;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .dashboard-card .border-bottom,
    :is(.admin-vacancies-page, .hrd-vacancies-page) .dashboard-card .border-top {
        border-color: #edf0ed !important;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .table-responsive {
        width: 100%;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .table {
        min-width: 1050px;
        margin-bottom: 0;
        vertical-align: middle;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .table thead th {
        padding: 14px 13px;
        border-bottom: 1px solid #e9ede9;
        background: #f8faf8;
        color: #68776e;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .4px;
        white-space: nowrap;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .table tbody td {
        padding: 15px 13px;
        border-bottom: 1px solid #eef1ee;
        color: #526158;
        font-size: 11px;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .table tbody tr:last-child td {
        border-bottom: 0;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .table tbody tr:hover td {
        background: #fbfcfb;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .vacancy-table-title {
        color: #193c30;
        font-size: 12px;
        font-weight: 750;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .vacancy-actions {
        gap: 6px;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .vacancy-actions .btn {
        min-width: 35px;
        min-height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .badge {
        padding: 6px 9px;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 700;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .pagination {
        margin-bottom: 0;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .page-link {
        border-color: #e7ebe7;
        color: #286448;
        font-size: 11px;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) .page-item.active .page-link {
        border-color: #164438;
        background: #164438;
        color: #fff;
    }

    :is(.admin-vacancies-page, .hrd-vacancies-page) footer {
        color: #89948d !important;
        font-size: 11px;
    }

    @media (max-width: 767.98px) {
        :is(.admin-vacancies-page, .hrd-vacancies-page) .page-heading {
            align-items: stretch !important;
            gap: 15px !important;
            margin-bottom: 21px;
        }

        :is(.admin-vacancies-page, .hrd-vacancies-page) .page-heading > a {
            width: 100%;
        }

        :is(.admin-vacancies-page, .hrd-vacancies-page) .filter-card {
            padding: 16px !important;
        }

        :is(.admin-vacancies-page, .hrd-vacancies-page) .dashboard-card > div:first-child {
            padding: 17px !important;
        }

        :is(.admin-vacancies-page, .hrd-vacancies-page) .vacancy-stat {
            min-height: 120px;
            padding: 15px !important;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        :is(.admin-vacancies-page, .hrd-vacancies-page) *,
        :is(.admin-vacancies-page, .hrd-vacancies-page) *::before,
        :is(.admin-vacancies-page, .hrd-vacancies-page) *::after {
            transition-duration: .01ms !important;
            animation-duration: .01ms !important;
        }
    }
</style>
@endsection

@section('content')
<main class="{{ $routePrefix === 'admin' ? 'container-fluid admin-vacancies-page' : 'container-fluid hrd-page-shell hrd-vacancies-page' }}">

    <div class="page-heading d-flex flex-column flex-md-row
                align-items-md-center justify-content-between gap-3">
        <div>
            <div class="section-eyebrow mb-2">MANAJEMEN REKRUTMEN</div>
            <h1>Lowongan Pekerjaan</h1>
            <p>Kelola informasi posisi, persyaratan, kuota, dan periode pendaftaran.</p>
        </div>

        <a href="{{ route($routePrefix . '.vacancies.create') }}"
           class="btn btn-primary-custom px-4">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Lowongan
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="vacancy-stat p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small text-muted">Total Lowongan</span>
                    <span class="stat-icon"><i class="bi bi-briefcase"></i></span>
                </div>
                <div class="stat-number">{{ $statistics['total'] }}</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="vacancy-stat p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small text-muted">Draft</span>
                    <span class="stat-icon"><i class="bi bi-file-earmark"></i></span>
                </div>
                <div class="stat-number">{{ $statistics['draft'] }}</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="vacancy-stat p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small text-muted">Diterbitkan</span>
                    <span class="stat-icon"><i class="bi bi-megaphone"></i></span>
                </div>
                <div class="stat-number">{{ $statistics['published'] }}</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="vacancy-stat p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small text-muted">Ditutup</span>
                    <span class="stat-icon"><i class="bi bi-lock"></i></span>
                </div>
                <div class="stat-number">{{ $statistics['closed'] }}</div>
            </div>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="filter-card p-3 p-md-4 mb-4">
        <form method="GET" action="{{ route($routePrefix . '.vacancies.index') }}">
            <div class="row g-2 align-items-end">
                <div class="col-lg-6">
                    <label class="form-label">Cari Lowongan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="search"
                               name="search"
                               class="form-control"
                               placeholder="Nama posisi, departemen, atau lokasi..."
                               value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-lg-3">
                    <label class="form-label">Status Lowongan</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                        <option value="published" @selected(request('status') === 'published')>Diterbitkan</option>
                        <option value="closed" @selected(request('status') === 'closed')>Ditutup</option>
                    </select>
                </div>

                <div class="col-lg-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom flex-grow-1">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                    <a href="{{ route($routePrefix . '.vacancies.index') }}"
                       class="btn btn-outline-secondary">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- TABEL --}}
    <div class="dashboard-card overflow-hidden">
        <div class="d-flex flex-column flex-md-row align-items-md-center
                    justify-content-between gap-2 p-3 p-md-4 border-bottom">
            <div>
                <h5 class="fw-bold mb-1">Daftar Lowongan</h5>
                <p class="text-muted small mb-0">
                    Menampilkan {{ $vacancies->count() }} dari {{ $vacancies->total() }} data.
                </p>
            </div>
            <span class="badge bg-success-subtle text-success">
                <i class="bi bi-shield-check me-1"></i>
                Akses {{ strtoupper($routePrefix) }}
            </span>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:55px">No.</th>
                        <th>Posisi / Departemen</th>
                        <th>Lokasi</th>
                        <th>Kuota</th>
                        <th>Pelamar</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th style="min-width:190px">Tindakan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($vacancies as $vacancy)
                        <tr>
                            <td class="text-muted">
                                {{ $vacancies->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <div class="vacancy-table-title">
                                    {{ $vacancy->title }}
                                </div>
                                <div class="small text-muted">
                                    {{ $vacancy->department ?: 'Departemen belum ditentukan' }}
                                    @if ($vacancy->employment_type)
                                        · {{ $vacancy->employment_type }}
                                    @endif
                                </div>
                            </td>

                            <td>{{ $vacancy->location ?: '-' }}</td>

                            <td>{{ number_format($vacancy->quota, 0, ',', '.') }} orang</td>

                            <td>
                                <span class="badge bg-primary-subtle text-primary">
                                    {{ $vacancy->applications_count }} pelamar
                                </span>
                            </td>

                            <td class="small">
                                <div>
                                    Publikasi:
                                    {{ $vacancy->published_at?->format('d/m/Y') ?? '-' }}
                                </div>
                                <div class="text-muted">
                                    Tutup:
                                    {{ $vacancy->closing_date?->format('d/m/Y') ?? 'Tidak ditentukan' }}
                                </div>
                            </td>

                            <td>
                                @if ($vacancy->status === 'published')
                                    <span class="badge bg-success-subtle text-success">Diterbitkan</span>
                                @elseif ($vacancy->status === 'closed')
                                    <span class="badge bg-danger-subtle text-danger">Ditutup</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary">Draft</span>
                                @endif
                            </td>

                            <td>
                                <div class="vacancy-actions">
                                    <a href="{{ route($routePrefix . '.vacancies.edit', $vacancy) }}"
                                       class="btn btn-outline-primary"
                                       title="Edit lowongan">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    @if ($vacancy->status !== 'published')
                                        <form method="POST"
                                              action="{{ route($routePrefix . '.vacancies.publish', $vacancy) }}"
                                              onsubmit="return confirm('Terbitkan lowongan ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-outline-success"
                                                    type="submit"
                                                    title="Terbitkan">
                                                <i class="bi bi-megaphone"></i>
                                            </button>
                                        </form>
                                    @endif

                                    @if ($vacancy->status === 'published')
                                        <form method="POST"
                                              action="{{ route($routePrefix . '.vacancies.close', $vacancy) }}"
                                              onsubmit="return confirm('Tutup pendaftaran lowongan ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-outline-warning"
                                                    type="submit"
                                                    title="Tutup lowongan">
                                                <i class="bi bi-lock"></i>
                                            </button>
                                        </form>
                                    @endif

                                    @if ($vacancy->applications_count === 0)
                                        <form method="POST"
                                              action="{{ route($routePrefix . '.vacancies.destroy', $vacancy) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus lowongan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger"
                                                    type="submit"
                                                    title="Hapus lowongan">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-outline-secondary"
                                                type="button"
                                                disabled
                                                title="Lowongan memiliki riwayat lamaran">
                                            <i class="bi bi-shield-lock"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="mb-3">
                                    <i class="bi bi-briefcase text-muted" style="font-size:38px"></i>
                                </div>
                                <div class="fw-semibold">Belum ada lowongan pekerjaan</div>
                                <p class="text-muted small mb-3">
                                    Tambahkan lowongan pertama untuk memulai proses rekrutmen.
                                </p>
                                <a href="{{ route($routePrefix . '.vacancies.create') }}"
                                   class="btn btn-primary-custom">
                                    <i class="bi bi-plus-lg me-1"></i>
                                    Tambah Lowongan
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($vacancies->hasPages())
            <div class="p-3 border-top">
                {{ $vacancies->links() }}
            </div>
        @endif
    </div>

<footer class="text-center text-muted small pt-5">
    Sistem Pendaftaran Calon Pegawai
    <br>
    &copy; {{ date('Y') }} <strong>AWLXDEV</strong>. All Rights Reserved.
</footer>
</main>
@endsection