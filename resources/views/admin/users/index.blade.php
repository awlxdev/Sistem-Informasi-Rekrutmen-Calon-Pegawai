@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@push('styles')
<style>
    /* ADMIN USER MANAGEMENT — CONSISTENT WITH ADMIN DASHBOARD */
    .admin-users-page {
        width: 100%;
        min-width: 0;
        color: #26342e;
    }

    .admin-users-page .users-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 26px;
    }

    .admin-users-page .users-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #39745d;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.8px;
        margin-bottom: 10px;
    }

    .admin-users-page .users-eyebrow::before {
        content: "";
        width: 22px;
        height: 2px;
        background: #b99a62;
        border-radius: 5px;
    }

    .admin-users-page .users-title {
        color: #193c30;
        font-size: clamp(25px, 3vw, 32px);
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -.8px;
        margin: 0 0 9px;
    }

    .admin-users-page .users-description {
        max-width: 650px;
        color: #7b8780;
        font-size: 13px;
        line-height: 1.8;
        margin: 0;
    }

    .admin-users-page .users-heading-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 9px;
    }

    .admin-users-page .users-heading-actions .btn {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        padding: 9px 15px;
        font-size: 12px;
        font-weight: 700;
    }

    .admin-users-page .users-stats {
        margin-bottom: 25px;
    }

    .admin-users-page .users-stat-card,
    .admin-users-page .users-panel {
        height: 100%;
        background: #fff;
        border: 1px solid #e9ede9;
        border-radius: 15px;
        box-shadow: 0 4px 18px rgba(25, 48, 37, .055);
        transition: transform .22s ease, box-shadow .22s ease;
    }

    .admin-users-page .users-stat-card {
        padding: 19px;
        min-height: 132px;
    }

    .admin-users-page .users-stat-card:hover,
    .admin-users-page .users-panel:hover {
        box-shadow: 0 10px 26px rgba(25, 48, 37, .075);
    }

    .admin-users-page .users-stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 14px;
    }

    .admin-users-page .users-stat-label {
        color: #7b8780;
        font-size: 11px;
        font-weight: 650;
    }

    .admin-users-page .users-stat-icon {
        width: 35px;
        height: 35px;
        display: grid;
        place-items: center;
        flex: 0 0 35px;
        border-radius: 11px;
        color: #39745d;
        background: #eaf2ee;
        font-size: 17px;
    }

    .admin-users-page .users-stat-icon.gold {
        color: #9a7942;
        background: #f7f3e9;
    }

    .admin-users-page .users-stat-icon.danger {
        color: #bd4545;
        background: #fbefef;
    }

    .admin-users-page .users-stat-value {
        color: #193c30;
        font-size: 27px;
        line-height: 1.1;
        font-weight: 800;
        letter-spacing: -.6px;
        margin-bottom: 5px;
    }

    .admin-users-page .users-stat-note {
        color: #929b95;
        font-size: 10px;
    }

    .admin-users-page .users-panel {
        padding: 23px;
        margin-bottom: 20px;
    }

    .admin-users-page .users-panel-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 20px;
    }

    .admin-users-page .users-panel-title {
        color: #263d32;
        font-size: 15px;
        font-weight: 800;
        margin: 0 0 5px;
    }

    .admin-users-page .users-panel-description {
        color: #89948d;
        font-size: 11px;
        line-height: 1.6;
        margin: 0;
    }

    .admin-users-page .form-label {
        color: #405047;
        font-size: 11px;
        font-weight: 750;
        margin-bottom: 7px;
    }

    .admin-users-page .form-control,
    .admin-users-page .form-select {
        min-height: 43px;
        border: 1px solid #e1e7e2;
        border-radius: 9px;
        background-color: #fff;
        color: #26342e;
        font-size: 12px;
        box-shadow: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .admin-users-page .form-control:focus,
    .admin-users-page .form-select:focus {
        border-color: #b99a62;
        box-shadow: 0 0 0 3px rgba(185, 154, 98, .13);
    }

    .admin-users-page .users-filter-actions {
        display: flex;
        gap: 8px;
    }

    .admin-users-page .users-filter-actions .btn {
        min-height: 43px;
        border-radius: 9px;
        font-size: 11px;
        font-weight: 750;
        white-space: nowrap;
    }

    .admin-users-page .users-table-wrap {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #edf0ed;
        border-radius: 11px;
    }

    .admin-users-page .users-table {
        width: 100%;
        min-width: 950px;
        margin: 0;
        vertical-align: middle;
    }

    .admin-users-page .users-table thead th {
        padding: 14px 13px;
        background: #f7f9f7;
        color: #728078;
        border-bottom: 1px solid #e8ede9;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .65px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .admin-users-page .users-table tbody td {
        padding: 14px 13px;
        color: #526158;
        border-bottom: 1px solid #eef1ee;
        font-size: 11px;
    }

    .admin-users-page .users-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .admin-users-page .users-table tbody tr:hover td {
        background: #fbfcfa;
    }

    .admin-users-page .users-name {
        color: #263d32;
        font-size: 12px;
        font-weight: 750;
        margin-bottom: 4px;
    }

    .admin-users-page .users-meta {
        color: #929b95;
        font-size: 10px;
    }

    .admin-users-page .users-email {
        overflow-wrap: anywhere;
    }

    .admin-users-page .users-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 750;
        white-space: nowrap;
    }

    .admin-users-page .users-badge.admin {
        color: #34443b;
        background: #edf0ed;
    }

    .admin-users-page .users-badge.hrd {
        color: #315d86;
        background: #edf4fa;
    }

    .admin-users-page .users-badge.applicant {
        color: #39745d;
        background: #eaf2ee;
    }

    .admin-users-page .users-badge.active {
        color: #24734c;
        background: #eaf5ee;
    }

    .admin-users-page .users-badge.inactive {
        color: #bd4545;
        background: #fbefef;
    }

    .admin-users-page .users-badge.verified {
        color: #24734c;
        background: #eaf5ee;
    }

    .admin-users-page .users-badge.unverified {
        color: #94702f;
        background: #faf3e4;
    }

    .admin-users-page .users-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .admin-users-page .users-actions .btn {
        min-height: 31px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        padding: 5px 9px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .admin-users-page .users-empty {
        padding: 45px 15px !important;
        text-align: center;
    }

    .admin-users-page .users-empty-icon {
        display: block;
        color: #b4beb7;
        font-size: 30px;
        margin-bottom: 12px;
    }

    .admin-users-page .users-pagination {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .admin-users-page .pagination {
        margin-bottom: 0;
        gap: 4px;
    }

    .admin-users-page .page-link {
        border-radius: 7px !important;
        border-color: #e5eae5;
        color: #39745d;
        font-size: 11px;
    }

    .admin-users-page .page-item.active .page-link {
        background: #164438;
        border-color: #164438;
        color: #fff;
    }

    .admin-users-page .alert {
        border-radius: 11px;
        font-size: 12px;
    }

    @media (max-width: 767.98px) {
        .admin-users-page .users-heading {
            margin-bottom: 20px;
        }

        .admin-users-page .users-heading-actions {
            width: 100%;
        }

        .admin-users-page .users-heading-actions .btn {
            flex: 1;
        }

        .admin-users-page .users-panel {
            padding: 17px;
        }

        .admin-users-page .users-stat-card {
            padding: 15px;
            min-height: 120px;
        }

        .admin-users-page .users-stat-value {
            font-size: 23px;
        }

        .admin-users-page .users-filter-actions .btn {
            flex: 1;
        }

        .admin-users-page .users-pagination {
            justify-content: center;
            overflow-x: auto;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .admin-users-page *,
        .admin-users-page *::before,
        .admin-users-page *::after {
            transition: none !important;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid admin-users-page">

    {{-- HEADER --}}
    <header class="users-heading">
        <div>
            <div class="users-eyebrow">ADMINISTRATOR</div>
            <h1 class="users-title">Manajemen Pengguna</h1>
            <p class="users-description">
                Kelola akun administrator, HRD, dan pelamar dalam satu pusat pengelolaan.
            </p>
        </div>

        <div class="users-heading-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>

            <a href="{{ route('admin.users.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-person-plus me-1"></i>
                Tambah Pengguna
            </a>
        </div>
    </header>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- STATISTIK --}}
    <section class="users-stats" aria-label="Statistik pengguna">
        <div class="row g-3">

            <div class="col-6 col-md-4 col-xl">
                <article class="users-stat-card">
                    <div class="users-stat-top">
                        <span class="users-stat-label">Total Pengguna</span>
                        <span class="users-stat-icon"><i class="bi bi-people"></i></span>
                    </div>
                    <div class="users-stat-value">{{ number_format($statistics['total']) }}</div>
                    <div class="users-stat-note">Seluruh akun terdaftar</div>
                </article>
            </div>

            <div class="col-6 col-md-4 col-xl">
                <article class="users-stat-card">
                    <div class="users-stat-top">
                        <span class="users-stat-label">Administrator</span>
                        <span class="users-stat-icon gold"><i class="bi bi-shield-lock"></i></span>
                    </div>
                    <div class="users-stat-value">{{ number_format($statistics['admin']) }}</div>
                    <div class="users-stat-note">Akses administrator</div>
                </article>
            </div>

            <div class="col-6 col-md-4 col-xl">
                <article class="users-stat-card">
                    <div class="users-stat-top">
                        <span class="users-stat-label">HRD</span>
                        <span class="users-stat-icon"><i class="bi bi-person-workspace"></i></span>
                    </div>
                    <div class="users-stat-value">{{ number_format($statistics['hrd']) }}</div>
                    <div class="users-stat-note">Akun pengelola HRD</div>
                </article>
            </div>

            <div class="col-6 col-md-4 col-xl">
                <article class="users-stat-card">
                    <div class="users-stat-top">
                        <span class="users-stat-label">Pelamar</span>
                        <span class="users-stat-icon"><i class="bi bi-person-vcard"></i></span>
                    </div>
                    <div class="users-stat-value">{{ number_format($statistics['pelamar']) }}</div>
                    <div class="users-stat-note">Akun calon pegawai</div>
                </article>
            </div>

            <div class="col-6 col-md-4 col-xl">
                <article class="users-stat-card">
                    <div class="users-stat-top">
                        <span class="users-stat-label">Nonaktif</span>
                        <span class="users-stat-icon danger"><i class="bi bi-person-x"></i></span>
                    </div>
                    <div class="users-stat-value" style="color:#bd4545">
                        {{ number_format($statistics['inactive']) }}
                    </div>
                    <div class="users-stat-note">Akun dinonaktifkan</div>
                </article>
            </div>

        </div>
    </section>

    {{-- FILTER DAN PENCARIAN --}}
    <section class="users-panel">
        <div class="users-panel-heading">
            <div>
                <h2 class="users-panel-title">
                    <i class="bi bi-search me-2" style="color:#b99a62"></i>
                    Pencarian Pengguna
                </h2>
                <p class="users-panel-description">
                    Temukan akun berdasarkan nama, email, peran, atau status.
                </p>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.users.index') }}">
            <div class="row g-3 align-items-end">

                <div class="col-12 col-lg-5">
                    <label for="search" class="form-label">Nama atau Email</label>
                    <input
                        type="search"
                        class="form-control"
                        id="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Masukkan nama atau alamat email..."
                    >
                </div>

                <div class="col-6 col-lg-2">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role">
                        <option value="">Semua Role</option>
                        <option value="admin" @selected(request('role') === 'admin')>Administrator</option>
                        <option value="hrd" @selected(request('role') === 'hrd')>HRD</option>
                        <option value="pelamar" @selected(request('role') === 'pelamar')>Pelamar</option>
                    </select>
                </div>

                <div class="col-6 col-lg-2">
                    <label for="status" class="form-label">Status Akun</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="active" @selected(request('status') === 'active')>Aktif</option>
                        <option value="inactive" @selected(request('status') === 'inactive')>Nonaktif</option>
                    </select>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="users-filter-actions">
                        <button type="submit" class="btn btn-primary-custom flex-fill">
                            <i class="bi bi-search me-1"></i>
                            Cari
                        </button>

                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Reset
                        </a>
                    </div>
                </div>

            </div>
        </form>
    </section>

    {{-- DAFTAR PENGGUNA --}}
    <section class="users-panel">
        <div class="users-panel-heading">
            <div>
                <h2 class="users-panel-title">
                    <i class="bi bi-people me-2" style="color:#b99a62"></i>
                    Daftar Akun Pengguna
                </h2>
                <p class="users-panel-description">
                    Menampilkan {{ $users->firstItem() ?? 0 }} sampai {{ $users->lastItem() ?? 0 }}
                    dari {{ $users->total() }} pengguna.
                </p>
            </div>
            <span class="users-badge applicant">
                <i class="bi bi-person-lines-fill"></i>
                DATA PENGGUNA
            </span>
        </div>

        <div class="users-table-wrap">
            <table class="table table-hover users-table">
                <thead>
                    <tr>
                        <th style="width:60px">No.</th>
                        <th style="min-width:190px">Nama Pengguna</th>
                        <th style="min-width:220px">Alamat Email</th>
                        <th style="min-width:130px">Role</th>
                        <th style="min-width:120px">Status</th>
                        <th style="min-width:155px">Verifikasi Email</th>
                        <th style="min-width:190px">Tindakan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>

                            <td>
                                <div class="users-name">{{ $user->name }}</div>
                                <div class="users-meta">ID: {{ $user->id }}</div>
                            </td>

                            <td class="users-email">{{ $user->email }}</td>

                            <td>
                                @if($user->role === 'admin')
                                    <span class="users-badge admin">Administrator</span>
                                @elseif($user->role === 'hrd')
                                    <span class="users-badge hrd">HRD</span>
                                @else
                                    <span class="users-badge applicant">Pelamar</span>
                                @endif
                            </td>

                            <td>
                                @if($user->is_active)
                                    <span class="users-badge active">
                                        <i class="bi bi-check-circle-fill"></i>Aktif
                                    </span>
                                @else
                                    <span class="users-badge inactive">
                                        <i class="bi bi-x-circle-fill"></i>Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($user->hasVerifiedEmail())
                                    <span class="users-badge verified">
                                        <i class="bi bi-check-circle-fill"></i>Terverifikasi
                                    </span>
                                @else
                                    <span class="users-badge unverified">
                                        <i class="bi bi-clock-history"></i>Belum Terverifikasi
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="users-actions">
                                    <a
                                        href="{{ route('admin.users.edit', $user) }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        <i class="bi bi-pencil-square me-1"></i>Edit
                                    </a>

                                    @if(auth()->id() !== $user->id)
                                        <form
                                            method="POST"
                                            action="{{ route('admin.users.toggle-status', $user) }}"
                                            onsubmit="return confirm('Apakah Anda yakin ingin mengubah status akun ini?')"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="btn btn-sm {{ $user->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                            >
                                                @if($user->is_active)
                                                    <i class="bi bi-person-x me-1"></i>Nonaktifkan
                                                @else
                                                    <i class="bi bi-person-check me-1"></i>Aktifkan
                                                @endif
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="users-empty">
                                <i class="bi bi-search users-empty-icon"></i>
                                <div class="fw-bold mb-1">Pengguna tidak ditemukan</div>
                                <div class="small text-muted">
                                    Silakan ubah kata pencarian atau filter yang digunakan.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="users-pagination">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </section>

</div>
@endsection