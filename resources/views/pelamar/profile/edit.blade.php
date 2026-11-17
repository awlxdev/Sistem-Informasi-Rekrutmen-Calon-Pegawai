@extends('layouts.app')

@section('navbar')
    @include('components.pelamar-navbar')
@endsection

@section('title', 'Biodata Pelamar')

@section('styles')
<style>
    :root {
        --profile-primary: #073b3a;
        --profile-primary-dark: #052c2b;
        --profile-secondary: #0c5a50;
        --profile-gold: #c8a96b;
        --profile-ivory: #f8f6f0;
        --profile-border: #e8e7e1;
        --profile-muted: #78827f;
    }

    body {
        background: #f5f6f3;
    }

    .profile-navbar {
        background: rgba(255,255,255,.96);
        border-bottom: 1px solid var(--profile-border);
        min-height: 72px;
    }

    .profile-brand {
        color: var(--profile-primary);
        font-size: 17px;
        font-weight: 800;
        letter-spacing: .7px;
        text-decoration: none;
    }

    .profile-brand-mark {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: var(--profile-primary);
        color: #fff;
        margin-right: 10px;
    }

    .profile-page {
        max-width: 1180px;
        margin: 0 auto;
    }

    .profile-hero {
        position: relative;
        overflow: hidden;
        color: #fff;
        border-radius: 22px;
        padding: 32px;
        background:
            radial-gradient(circle at 90% 10%, rgba(200,169,107,.25), transparent 30%),
            linear-gradient(120deg, #052c2b 0%, #073b3a 55%, #0c5a50 100%);
        box-shadow: 0 12px 35px rgba(7,59,58,.12);
    }

    .profile-hero::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        border: 1px solid rgba(255,255,255,.09);
        border-radius: 50%;
        right: -75px;
        bottom: -135px;
        box-shadow: 0 0 0 25px rgba(255,255,255,.025),
                    0 0 0 50px rgba(255,255,255,.02);
    }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #e8d7b3;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .profile-hero h1 {
        font-size: clamp(25px, 4vw, 34px);
        font-weight: 800;
        letter-spacing: -.8px;
        margin-bottom: 10px;
    }

    .profile-hero p {
        color: rgba(255,255,255,.76);
        max-width: 650px;
        line-height: 1.7;
        margin-bottom: 0;
    }

    .hero-account {
        position: relative;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 10px 14px;
        border: 1px solid rgba(255,255,255,.2);
        background: rgba(255,255,255,.08);
        border-radius: 12px;
        color: #fff;
        font-size: 12px;
    }

    .profile-layout {
        display: grid;
        grid-template-columns: 255px minmax(0, 1fr);
        gap: 22px;
        align-items: start;
        margin-top: 24px;
    }

    .profile-sidebar {
        position: sticky;
        top: 18px;
    }

    .sidebar-card,
    .profile-section,
    .completion-card {
        background: #fff;
        border: 1px solid var(--profile-border);
        border-radius: 17px;
        box-shadow: 0 5px 22px rgba(24,39,36,.035);
    }

    .sidebar-card {
        padding: 20px;
        margin-bottom: 16px;
    }

.profile-avatar {
    width: 66px;
    height: 66px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border-radius: 19px;
    background: linear-gradient(145deg, #e9e2d4, #f8f6f0);
    color: var(--profile-primary);
    font-size: 26px;
    margin-bottom: 14px;
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

    .sidebar-name {
        color: #1e302d;
        font-size: 15px;
        font-weight: 800;
        overflow-wrap: anywhere;
    }

    .sidebar-email {
        color: var(--profile-muted);
        font-size: 12px;
        overflow-wrap: anywhere;
    }

    .completion-card {
        padding: 19px;
        margin-bottom: 16px;
    }

    .completion-number {
        color: var(--profile-primary);
        font-size: 27px;
        font-weight: 800;
    }

    .completion-track {
        height: 8px;
        overflow: hidden;
        border-radius: 20px;
        background: #edf0ec;
        margin: 12px 0 10px;
    }

    .completion-fill {
        height: 100%;
        border-radius: inherit;
        background: linear-gradient(90deg, #0c5a50, #c8a96b);
        transition: width .3s ease;
    }

    .sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .sidebar-nav a {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 11px 12px;
        color: #65716e;
        border-radius: 10px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: .2s ease;
    }

    .sidebar-nav a:hover,
    .sidebar-nav a.active {
        color: var(--profile-primary);
        background: #edf4f1;
    }

    .sidebar-nav a i {
        font-size: 16px;
    }

    .profile-section {
        padding: 25px;
        margin-bottom: 18px;
        scroll-margin-top: 20px;
    }

    .section-heading {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding-bottom: 20px;
        margin-bottom: 22px;
        border-bottom: 1px solid #eff0eb;
    }

    .section-icon {
        flex: 0 0 43px;
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        color: var(--profile-primary);
        background: #edf4f1;
        font-size: 19px;
    }

    .section-heading h3 {
        color: #183b35;
        font-size: 17px;
        font-weight: 800;
        margin: 1px 0 5px;
    }

    .section-heading p {
        color: var(--profile-muted);
        font-size: 12px;
        margin: 0;
        line-height: 1.6;
    }

    .form-label {
        color: #34413f;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .required-mark {
        color: #d94d4d;
    }

    .optional-label {
        color: #929b97;
        font-size: 10px;
        font-weight: 500;
        margin-left: 4px;
    }

    .form-control,
    .form-select {
        min-height: 45px;
        padding: 10px 13px;
        color: #263b36;
        background-color: #fff;
        border: 1px solid #dfe4df;
        border-radius: 10px;
        font-size: 13px;
        transition: border-color .2s, box-shadow .2s;
    }

    textarea.form-control {
        min-height: 112px;
        resize: vertical;
    }

    .form-control::placeholder {
        color: #a5aeaa;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--profile-gold);
        box-shadow: 0 0 0 3px rgba(200,169,107,.15);
    }

    .form-hint {
        display: block;
        color: #89938f;
        font-size: 11px;
        margin-top: 7px;
        line-height: 1.5;
    }

    .invalid-feedback {
        font-size: 11px;
    }

    .document-card {
        height: 100%;
        padding: 18px;
        border: 1px dashed #cfd9d1;
        border-radius: 14px;
        background: #fbfcfa;
        transition: .2s ease;
    }

    .document-card:focus-within {
        border-color: var(--profile-gold);
        background: #fffdf8;
    }

    .document-icon {
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #edf4f1;
        color: var(--profile-primary);
        font-size: 20px;
        margin-bottom: 12px;
    }

    .document-title {
        color: #263b36;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .document-description {
        color: #89938f;
        font-size: 11px;
        line-height: 1.6;
        margin-bottom: 13px;
    }

    .document-status {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 9px 10px;
        border-radius: 9px;
        background: #edf7f0;
        color: #267348;
        font-size: 11px;
        font-weight: 600;
        margin-top: 12px;
    }

    .document-status.pending {
        background: #f7f3e9;
        color: #94743a;
    }

    .form-control[type="file"] {
        min-height: auto;
        padding: 9px;
        background: #fff;
        font-size: 11px;
    }

    .form-control[type="file"]::file-selector-button {
        padding: 7px 10px;
        margin: -3px 10px -3px -3px;
        border: 0;
        border-radius: 7px;
        background: #edf4f1;
        color: var(--profile-primary);
        font-weight: 700;
        font-size: 11px;
    }

    .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 19px 22px;
        background: #fff;
        border: 1px solid var(--profile-border);
        border-radius: 15px;
        box-shadow: 0 7px 25px rgba(24,39,36,.05);
        margin-bottom: 35px;
    }

    .btn-save {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 45px;
        padding: 11px 23px;
        border: 0;
        border-radius: 10px;
        color: #fff;
        background: linear-gradient(135deg, #073b3a, #0c5a50);
        font-size: 13px;
        font-weight: 700;
        box-shadow: 0 5px 13px rgba(7,59,58,.16);
        transition: .2s ease;
    }

    .btn-save:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(7,59,58,.2);
    }

    .btn-back {
        min-height: 39px;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 13px;
        border: 1px solid #dfe4df;
        border-radius: 9px;
        color: #50605a;
        background: #fff;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-back:hover {
        background: #f5f7f4;
        color: var(--profile-primary);
    }

    .alert {
        border-radius: 12px;
        font-size: 13px;
    }

    .profile-footer {
        color: #929b97;
        font-size: 11px;
        text-align: center;
        padding: 0 0 25px;
    }

    @media (max-width: 991px) {
        .profile-layout {
            grid-template-columns: 1fr;
        }

        .profile-sidebar {
            position: static;
        }

        .sidebar-nav {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 575px) {
        .profile-hero {
            padding: 23px 20px;
            border-radius: 16px;
        }

        .profile-section {
            padding: 19px 16px;
        }

        .sidebar-card {
            padding: 16px;
        }

        .form-footer {
            align-items: stretch;
            flex-direction: column;
            padding: 16px;
        }

        .form-footer .btn-save {
            width: 100%;
        }

        .sidebar-nav {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-4 py-md-5">
    <div class="profile-page">

        <header class="profile-hero">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-4 align-items-md-center">
                <div>
                    <div class="hero-eyebrow">
                        <i class="bi bi-shield-check"></i>
                        AREA PERSONAL PELAMAR
                    </div>
                    <h1>Profil & Biodata</h1>
                    <p>
                        Lengkapi informasi diri, riwayat pendidikan, dan dokumen
                        pendukung agar proses administrasi lamaran Anda berjalan
                        dengan baik.
                    </p>
                </div>

                <div class="hero-account">
                    <i class="bi bi-person-check"></i>
                    Akun Pelamar Aktif
                </div>
            </div>
        </header>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mt-4" role="alert">
                <div class="fw-bold mb-2">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Data belum dapat disimpan.
                </div>
                <ul class="mb-0 ps-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            $profileFields = [
                $applicant->full_name,
                $applicant->nik,
                $applicant->place_of_birth,
                $applicant->date_of_birth,
                $applicant->gender,
                $applicant->phone,
                $applicant->address,
                $applicant->education_level,
                $applicant->institution,
                $applicant->major,
                $applicant->graduation_year,
                $applicant->cv_path,
                $applicant->photo_path,
            ];

            $filledFields = collect($profileFields)
                ->filter(fn ($value) => filled($value))
                ->count();

            $completion = (int) round(($filledFields / count($profileFields)) * 100);
        @endphp

        <div class="profile-layout">

            <aside class="profile-sidebar">
                <div class="sidebar-card">
<div class="profile-avatar" id="profileAvatar">
    @if ($applicant->photo_path)
        <img
            src="{{ route('pelamar.profile.photo') }}"
            alt="Foto profil pelamar"
            id="profileAvatarImage"
        >
    @else
        <i class="bi bi-person-fill" id="profileAvatarFallback"></i>
    @endif
</div>

                    <div class="sidebar-name">{{ $applicant->full_name ?: auth()->user()->name }}</div>
                    <div class="sidebar-email">{{ auth()->user()->email }}</div>

                    <div class="mt-3 pt-3 border-top">
                        <span class="badge rounded-pill text-bg-success">
                            <i class="bi bi-patch-check-fill me-1"></i>
                            Akun Terverifikasi
                        </span>
                    </div>
                </div>

                <div class="completion-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="small fw-bold text-secondary">Kelengkapan Profil</span>
                        <span class="completion-number">{{ $completion }}%</span>
                    </div>

                    <div class="completion-track">
                        <<div
    class="completion-fill"
    style="--completion-width: {{ (int) $completion }}%;"
></div>
                    </div>

                    <p class="small text-secondary mb-0">
                        {{ $filledFields }} dari {{ count($profileFields) }} informasi telah diisi.
                    </p>
                </div>

                <div class="sidebar-card">
                    <div class="small fw-bold text-secondary mb-3">
                        NAVIGASI FORMULIR
                    </div>

                    <div class="sidebar-nav">
                        <a href="#identitas" class="active">
                            <i class="bi bi-person-vcard"></i>
                            Identitas
                        </a>
                        <a href="#kontak">
                            <i class="bi bi-telephone"></i>
                            Kontak
                        </a>
                        <a href="#pendidikan">
                            <i class="bi bi-mortarboard"></i>
                            Pendidikan
                        </a>
                        <a href="#dokumen">
                            <i class="bi bi-folder2-open"></i>
                            Dokumen
                        </a>
                    </div>
                </div>
            </aside>

            <main>
                <form method="POST"
                      action="{{ route('pelamar.profile.update') }}"
                      enctype="multipart/form-data"
                      id="profileForm">
                    @csrf
                    @method('PUT')

                    <section class="profile-section" id="identitas">
                        <div class="section-heading">
                            <div class="section-icon">
                                <i class="bi bi-person-vcard"></i>
                            </div>
                            <div>
                                <h3>Informasi Identitas</h3>
                                <p>Masukkan identitas sesuai dokumen kependudukan yang berlaku.</p>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="full_name" class="form-label">
                                    Nama Lengkap <span class="required-mark">*</span>
                                </label>
                                <input type="text"
                                       id="full_name"
                                       name="full_name"
                                       class="form-control @error('full_name') is-invalid @enderror"
                                       value="{{ old('full_name', $applicant->full_name) }}"
                                       maxlength="150"
                                       placeholder="Masukkan nama lengkap sesuai identitas"
                                       autocomplete="name"
                                       required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="nik" class="form-label">
                                    Nomor Induk Kependudukan (NIK)
                                </label>
                                <input type="text"
                                       id="nik"
                                       name="nik"
                                       class="form-control @error('nik') is-invalid @enderror"
                                       value="{{ old('nik', $applicant->nik) }}"
                                       inputmode="numeric"
                                       pattern="[0-9]{16}"
                                       maxlength="16"
                                       placeholder="Masukkan 16 digit NIK">
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-hint">NIK terdiri dari 16 digit angka.</small>
                            </div>

                            <div class="col-md-6">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select id="gender"
                                        name="gender"
                                        class="form-select @error('gender') is-invalid @enderror">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="Laki-laki"
                                        @selected(old('gender', $applicant->gender) === 'Laki-laki')>
                                        Laki-laki
                                    </option>
                                    <option value="Perempuan"
                                        @selected(old('gender', $applicant->gender) === 'Perempuan')>
                                        Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="place_of_birth" class="form-label">Tempat Lahir</label>
                                <input type="text"
                                       id="place_of_birth"
                                       name="place_of_birth"
                                       class="form-control @error('place_of_birth') is-invalid @enderror"
                                       value="{{ old('place_of_birth', $applicant->place_of_birth) }}"
                                       maxlength="100"
                                       placeholder="Contoh: Sorong">
                                @error('place_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                                <input type="date"
                                       id="date_of_birth"
                                       name="date_of_birth"
                                       class="form-control @error('date_of_birth') is-invalid @enderror"
                                       value="{{ old('date_of_birth', $applicant->date_of_birth?->format('Y-m-d')) }}"
                                       max="{{ now()->format('Y-m-d') }}">
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <section class="profile-section" id="kontak">
                        <div class="section-heading">
                            <div class="section-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div>
                                <h3>Informasi Kontak & Alamat</h3>
                                <p>Gunakan nomor dan alamat aktif agar mudah dihubungi oleh pihak rekrutmen.</p>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Nomor Telepon / WhatsApp</label>
                                <input type="tel"
                                       id="phone"
                                       name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone', $applicant->phone) }}"
                                       maxlength="20"
                                       placeholder="Contoh: 08xxxxxxxxxx"
                                       autocomplete="tel">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-hint">Pastikan nomor telepon dapat dihubungi.</small>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Alamat Domisili Lengkap</label>
                                <textarea id="address"
                                          name="address"
                                          class="form-control @error('address') is-invalid @enderror"
                                          rows="4"
                                          maxlength="5000"
                                          placeholder="Masukkan jalan, RT/RW, kelurahan, distrik/kecamatan, kota/kabupaten, dan provinsi">{{ old('address', $applicant->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-hint">Tuliskan alamat domisili saat ini secara lengkap.</small>
                            </div>
                        </div>
                    </section>

                    <section class="profile-section" id="pendidikan">
                        <div class="section-heading">
                            <div class="section-icon">
                                <i class="bi bi-mortarboard"></i>
                            </div>
                            <div>
                                <h3>Riwayat Pendidikan</h3>
                                <p>Lengkapi informasi pendidikan terakhir yang telah ditempuh.</p>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="education_level" class="form-label">Pendidikan Terakhir</label>
                                <select id="education_level"
                                        name="education_level"
                                        class="form-select @error('education_level') is-invalid @enderror">
                                    <option value="">Pilih jenjang pendidikan</option>
                                    @foreach (['SD', 'SMP', 'SMA/SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'] as $level)
                                        <option value="{{ $level }}"
                                            @selected(old('education_level', $applicant->education_level) === $level)>
                                            {{ $level }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('education_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="graduation_year" class="form-label">Tahun Kelulusan</label>
                                <input type="number"
                                       id="graduation_year"
                                       name="graduation_year"
                                       class="form-control @error('graduation_year') is-invalid @enderror"
                                       value="{{ old('graduation_year', $applicant->graduation_year) }}"
                                       min="1950"
                                       max="{{ now()->year + 1 }}"
                                       placeholder="Contoh: {{ now()->year }}">
                                @error('graduation_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="institution" class="form-label">Nama Sekolah / Perguruan Tinggi</label>
                                <input type="text"
                                       id="institution"
                                       name="institution"
                                       class="form-control @error('institution') is-invalid @enderror"
                                       value="{{ old('institution', $applicant->institution) }}"
                                       maxlength="150"
                                       placeholder="Contoh: Universitas Muhammadiyah Sorong">
                                @error('institution')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="major" class="form-label">Jurusan / Program Studi</label>
                                <input type="text"
                                       id="major"
                                       name="major"
                                       class="form-control @error('major') is-invalid @enderror"
                                       value="{{ old('major', $applicant->major) }}"
                                       maxlength="150"
                                       placeholder="Contoh: Teknik Informatika">
                                @error('major')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <section class="profile-section" id="dokumen">
                        <div class="section-heading">
                            <div class="section-icon">
                                <i class="bi bi-folder2-open"></i>
                            </div>
                            <div>
                                <h3>Dokumen Pendukung</h3>
                                <p>Unggah dokumen yang dibutuhkan untuk melengkapi profil pendaftaran.</p>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="document-card">
                                    <div class="document-icon">
                                        <i class="bi bi-person-bounding-box"></i>
                                    </div>

                                    <div class="document-title">Pas Foto Pelamar</div>
                                    <p class="document-description">
                                        Gunakan foto terbaru dengan wajah terlihat jelas.
                                        Format JPG, JPEG, atau PNG. Maksimal 2 MB.
                                    </p>

                                    <label for="photo" class="form-label">Pilih File Foto</label>
                                    <input type="file"
                                           id="photo"
                                           name="photo"
                                           class="form-control @error('photo') is-invalid @enderror"
                                           accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                                    @error('photo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                    <small id="photoFileName" class="form-hint">
                                        Belum ada file baru dipilih.
                                    </small>

                                    @if ($applicant->photo_path)
                                        <div class="document-status">
                                            <i class="bi bi-check-circle-fill"></i>
                                            Foto sebelumnya sudah tersimpan.
                                        </div>
                                    @else
                                        <div class="document-status pending">
                                            <i class="bi bi-info-circle-fill"></i>
                                            Foto belum diunggah.
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="document-card">
                                    <div class="document-icon">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </div>

                                    <div class="document-title">Curriculum Vitae (CV)</div>
                                    <p class="document-description">
                                        Unggah CV terbaru yang memuat informasi diri,
                                        pendidikan, pengalaman, dan keterampilan.
                                        Format PDF, DOC, atau DOCX. Maksimal 5 MB.
                                    </p>

                                    <label for="cv" class="form-label">Pilih File CV</label>
                                    <input type="file"
                                           id="cv"
                                           name="cv"
                                           class="form-control @error('cv') is-invalid @enderror"
                                           accept=".pdf,.doc,.docx,application/pdf">
                                    @error('cv')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                    <small id="cvFileName" class="form-hint">
                                        Belum ada file baru dipilih.
                                    </small>

                                    @if ($applicant->cv_path)
                                        <div class="document-status">
                                            <i class="bi bi-check-circle-fill"></i>
                                            CV sebelumnya sudah tersimpan.
                                        </div>
                                    @else
                                        <div class="document-status pending">
                                            <i class="bi bi-info-circle-fill"></i>
                                            CV belum diunggah.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-light border mt-3 mb-0">
                            <i class="bi bi-lock-fill text-success me-2"></i>
                            <span class="small text-secondary">
                                Dokumen disimpan pada penyimpanan privat aplikasi dan tidak
                                ditampilkan sebagai tautan publik.
                            </span>
                        </div>
                    </section>

                    <div class="form-footer">
                        <div>
                            <div class="fw-bold text-dark small">
                                <i class="bi bi-shield-check text-success me-1"></i>
                                Periksa kembali informasi Anda
                            </div>
                            <div class="text-secondary" style="font-size:11px;">
                                Pastikan seluruh data benar sebelum disimpan.
                            </div>
                        </div>

                        <button type="submit" class="btn-save" id="saveButton">
                            <i class="bi bi-floppy"></i>
                            Simpan Biodata
                        </button>
                    </div>
                </form>
            </main>
        </div>

<footer class="profile-footer">
    SISTEM REKRUTMEN · PORTAL PELAMAR
    <br>
    Informasi pribadi Anda digunakan untuk keperluan proses rekrutmen.
    <br>
    &copy; {{ date('Y') }} <strong>AWLXDEV</strong>. All Rights Reserved.
</footer>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const photoInput = document.getElementById('photo');
    const cvInput = document.getElementById('cv');
    const photoName = document.getElementById('photoFileName');
    const cvName = document.getElementById('cvFileName');
    const form = document.getElementById('profileForm');
    const saveButton = document.getElementById('saveButton');

if (photoInput) {
    photoInput.addEventListener('change', function () {
        photoName.textContent = this.files.length
            ? 'File dipilih: ' + this.files[0].name
            : 'Belum ada file baru dipilih.';

        if (!this.files.length) {
            return;
        }

        const file = this.files[0];

        if (!file.type.startsWith('image/')) {
            return;
        }

        const previewUrl = URL.createObjectURL(file);
        const avatar = document.getElementById('profileAvatar');

        let image = document.getElementById('profileAvatarImage');

        if (!image) {
            avatar.innerHTML = '';

            image = document.createElement('img');
            image.id = 'profileAvatarImage';
            image.alt = 'Pratinjau foto profil';

            avatar.appendChild(image);
        }

        image.src = previewUrl;
    });
}

    if (cvInput) {
        cvInput.addEventListener('change', function () {
            cvName.textContent = this.files.length
                ? 'File dipilih: ' + this.files[0].name
                : 'Belum ada file baru dipilih.';
        });
    }

    document.querySelectorAll('.sidebar-nav a').forEach(function (link) {
        link.addEventListener('click', function () {
            document.querySelectorAll('.sidebar-nav a').forEach(function (item) {
                item.classList.remove('active');
            });

            this.classList.add('active');
        });
    });

    if (form && saveButton) {
        form.addEventListener('submit', function () {
            if (!form.checkValidity()) {
                return;
            }

            saveButton.disabled = true;
            saveButton.innerHTML =
                '<span class="spinner-border spinner-border-sm"></span> Menyimpan...';
        });
    }
});
</script>
@endsection