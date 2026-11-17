@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@push('styles')
<style>
    .admin-user-form-page {
        --user-emerald: #193c30;
        --user-emerald-dark: #10362b;
        --user-champagne: #b99a62;
        --user-ivory: #f7f8f4;
        width: 100%;
        max-width: 100%;
        margin-inline: auto;
        color: #26372f;
    }

    .admin-user-form-page .admin-user-heading {
        margin-bottom: 25px;
    }

    .admin-user-form-page .admin-user-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 9px;
        color: #39745d;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .admin-user-form-page .admin-user-title {
        margin: 0 0 7px;
        color: var(--user-emerald);
        font-size: clamp(25px, 3vw, 32px);
        font-weight: 800;
        letter-spacing: -.8px;
    }

    .admin-user-form-page .admin-user-description {
        max-width: 680px;
        margin: 0;
        color: #7b8780;
        font-size: 13px;
        line-height: 1.7;
    }

    .admin-user-form-page .admin-user-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 17px;
        color: #557064;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: color .2s ease, transform .2s ease;
    }

    .admin-user-form-page .admin-user-back:hover {
        color: var(--user-emerald);
        transform: translateX(-3px);
    }

    .admin-user-form-page .dashboard-card {
        padding: clamp(19px, 3vw, 30px);
        border: 1px solid #e8ece6;
        border-radius: 19px;
        background: #fff;
        box-shadow: 0 8px 28px rgba(25, 60, 48, .055),
                    0 2px 6px rgba(25, 60, 48, .025);
        transition: box-shadow .2s ease, transform .2s ease;
    }

    .admin-user-form-page .dashboard-card:hover {
        box-shadow: 0 13px 34px rgba(25, 60, 48, .075),
                    0 3px 8px rgba(25, 60, 48, .03);
    }

    .admin-user-form-page .admin-user-icon {
        width: 50px;
        height: 50px;
        display: inline-flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(185, 154, 98, .24);
        border-radius: 15px;
        background: linear-gradient(145deg, #f2f5ef, #e5eee7);
        color: var(--user-emerald);
        box-shadow: 0 4px 10px rgba(25, 60, 48, .07);
    }

    .admin-user-form-page .admin-user-section-title {
        color: var(--user-emerald);
        font-size: 15px;
        font-weight: 800;
    }

    .admin-user-form-page .form-label {
        color: #43564b;
        font-size: 12px;
        font-weight: 700 !important;
    }

    .admin-user-form-page .form-control,
    .admin-user-form-page .form-select {
        min-height: 45px;
        border: 1px solid #dfe7df;
        border-radius: 11px;
        background-color: #fff;
        color: #26372f;
        font-size: 13px;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .admin-user-form-page .form-control:focus,
    .admin-user-form-page .form-select:focus {
        border-color: var(--user-champagne);
        box-shadow: 0 0 0 4px rgba(185, 154, 98, .13);
    }

    .admin-user-form-page .form-control::placeholder {
        color: #a3ada5;
    }

    .admin-user-form-page .form-text {
        color: #7b8780;
        font-size: 11px;
    }

    .admin-user-form-page hr {
        border-color: #e8ece6;
        opacity: 1;
    }

    .admin-user-form-page .alert {
        border-radius: 12px;
        font-size: 12px;
    }

    .admin-user-form-page .btn {
        min-height: 41px;
        padding: 9px 17px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
        transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .admin-user-form-page .btn-primary-custom {
        border: 1px solid var(--user-emerald);
        background: linear-gradient(135deg, #286448, #193c30);
        color: #fff;
        box-shadow: 0 4px 10px rgba(25, 60, 48, .16);
    }

    .admin-user-form-page .btn-primary-custom:hover {
        border-color: var(--user-emerald-dark);
        background: var(--user-emerald-dark);
        color: #fff;
        box-shadow: 0 7px 15px rgba(25, 60, 48, .2);
        transform: translateY(-2px);
    }

    .admin-user-form-page .btn-outline-secondary {
        border-color: #dce4dc;
        background: #fff;
        color: #52645a;
    }

    .admin-user-form-page .btn-outline-secondary:hover {
        border-color: #c5d2c8;
        background: #f4f7f3;
        color: var(--user-emerald);
    }

    .admin-user-form-page .badge {
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
    }

    .admin-user-form-page .admin-user-profile {
        min-width: 0;
    }

    .admin-user-form-page .admin-user-profile-name {
        overflow-wrap: anywhere;
        color: var(--user-emerald);
        font-size: 17px;
        font-weight: 800;
    }

    @media (max-width: 767.98px) {
        .admin-user-form-page {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .admin-user-form-page .dashboard-card {
            padding: 18px;
            border-radius: 15px;
        }

        .admin-user-form-page .admin-user-heading {
            margin-bottom: 19px;
        }

        .admin-user-form-page .admin-user-title {
            font-size: 25px;
        }

        .admin-user-form-page .admin-user-actions {
            display: flex;
            flex-direction: column;
        }

        .admin-user-form-page .admin-user-actions .btn {
            width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .admin-user-form-page *,
        .admin-user-form-page *::before,
        .admin-user-form-page *::after {
            transition: none !important;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4 admin-user-form-page">

    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-muted small">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Manajemen Pengguna
        </a>

        <div class="mt-3">
            <div class="small text-uppercase fw-semibold text-success mb-2">
                Administrator
            </div>
            <h2 class="fw-bold mb-1">Tambah Pengguna</h2>
            <p class="text-muted mb-0">
                Buat akun baru untuk administrator, HRD, atau pelamar.
            </p>
        </div>
    </div>

    <div class="dashboard-card">

        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="rounded-3 d-flex align-items-center justify-content-center"
                 style="width:48px;height:48px;background:var(--primary-soft);color:var(--primary)">
                <i class="bi bi-person-plus fs-4"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1">Informasi Akun</h5>
                <p class="small text-muted mb-0">Lengkapi informasi pengguna baru.</p>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <div class="fw-semibold mb-1">Periksa kembali data Anda.</div>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                    <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        required
                        maxlength="255"
                        autocomplete="name"
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label fw-semibold">Alamat Email</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        required
                        maxlength="255"
                        autocomplete="email"
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="role" class="form-label fw-semibold">Peran Pengguna</label>
                    <select
                        class="form-select @error('role') is-invalid @enderror"
                        id="role"
                        name="role"
                        required
                    >
                        <option value="">Pilih peran pengguna</option>
                        <option value="admin" @selected(old('role') === 'admin')>Administrator</option>
                        <option value="hrd" @selected(old('role') === 'hrd')>HRD</option>
                        <option value="pelamar" @selected(old('role') === 'pelamar')>Pelamar</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <hr class="my-2">
                    <h6 class="fw-bold mb-1">Keamanan Akun</h6>
                    <p class="small text-muted mb-0">
                        Buat kata sandi minimal 8 karakter.
                    </p>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label fw-semibold">Kata Sandi</label>
                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        required
                        minlength="8"
                        autocomplete="new-password"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label fw-semibold">
                        Konfirmasi Kata Sandi
                    </label>
                    <input
                        type="password"
                        class="form-control"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Ulangi kata sandi"
                        required
                        minlength="8"
                        autocomplete="new-password"
                    >
                </div>

            </div>

            <div class="alert alert-info mt-4 mb-0">
                <i class="bi bi-info-circle me-2"></i>
                Akun baru dibuat dalam status aktif. Pengguna tetap perlu menyelesaikan
                verifikasi email sebelum dapat mengakses dashboard.
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-lg me-1"></i>Simpan Pengguna
                </button>

                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>
@endsection