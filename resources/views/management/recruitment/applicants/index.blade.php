@extends('layouts.app')

@push('styles')
<style nonce="{{ Vite::cspNonce() }}">
    /* =====================================================
       HRD DATA PELAMAR - PREMIUM SOFT 3D
       CSS KHUSUS HALAMAN HRD
    ===================================================== */

    .hrd-applicants-page {
        --hrd-green: #176448;
        --hrd-green-dark: #104c37;
        --hrd-gold: #c8a96b;
        --hrd-ivory: #f7f8f5;
        --hrd-muted: #75827b;
        width: 100%;
        max-width: none;
        margin: 0;
        padding: 24px 12px 40px;
        color: #26372f;
        box-sizing: border-box;
    }

    .hrd-applicants-page *,
    .hrd-applicants-page *::before,
    .hrd-applicants-page *::after {
        box-sizing: border-box;
    }

    .hrd-applicants-page .hrd-page-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 26px;
    }

    .hrd-applicants-page .hrd-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--hrd-green);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 9px;
    }

    .hrd-applicants-page .hrd-eyebrow::before {
        content: "";
        width: 23px;
        height: 2px;
        border-radius: 10px;
        background: var(--hrd-gold);
    }

    .hrd-applicants-page .hrd-page-title {
        color: #193d2e;
        font-size: clamp(25px, 3vw, 32px);
        font-weight: 800;
        letter-spacing: -1px;
        margin: 0 0 7px;
    }

    .hrd-applicants-page .hrd-page-description {
        color: var(--hrd-muted);
        font-size: 13px;
        margin: 0;
        line-height: 1.7;
    }

    .hrd-applicants-page .hrd-total-chip {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 175px;
        padding: 13px 17px;
        background: #fff;
        border: 1px solid #e8eee9;
        border-radius: 17px;
        box-shadow: 0 7px 22px rgba(28, 64, 46, .055);
    }

    .hrd-applicants-page .hrd-total-icon {
        display: grid;
        place-items: center;
        width: 43px;
        height: 43px;
        flex: 0 0 43px;
        color: var(--hrd-green);
        background: #eaf4ee;
        border-radius: 13px;
        font-size: 20px;
    }

    .hrd-applicants-page .hrd-total-label {
        display: block;
        color: var(--hrd-muted);
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .hrd-applicants-page .hrd-total-value {
        color: #193d2e;
        font-size: 22px;
        line-height: 1.2;
        font-weight: 800;
    }

    .hrd-applicants-page .hrd-stat-card {
        position: relative;
        height: 100%;
        min-height: 125px;
        overflow: hidden;
        padding: 20px;
        background: #fff;
        border: 1px solid #e9eee9;
        border-radius: 19px;
        box-shadow: 0 7px 22px rgba(28, 64, 46, .055);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .hrd-applicants-page .hrd-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 13px 28px rgba(28, 64, 46, .09);
    }

    .hrd-applicants-page .hrd-stat-card::after {
        content: "";
        position: absolute;
        width: 105px;
        height: 105px;
        right: -34px;
        bottom: -47px;
        border-radius: 50%;
        background: rgba(200, 169, 107, .09);
    }

    .hrd-applicants-page .hrd-stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 17px;
    }

    .hrd-applicants-page .hrd-stat-label {
        color: #718078;
        font-size: 12px;
        font-weight: 700;
    }

    .hrd-applicants-page .hrd-stat-icon {
        display: grid;
        place-items: center;
        width: 39px;
        height: 39px;
        border-radius: 12px;
        font-size: 18px;
    }

    .hrd-applicants-page .hrd-stat-icon.total {
        color: #176448;
        background: #eaf4ee;
    }

    .hrd-applicants-page .hrd-stat-icon.applied {
        color: #99763b;
        background: #f8f1e3;
    }

    .hrd-applicants-page .hrd-stat-icon.pending {
        color: #64748b;
        background: #eef1f5;
    }

    .hrd-applicants-page .hrd-stat-value {
        color: #203d30;
        font-size: 29px;
        font-weight: 800;
        letter-spacing: -.8px;
        line-height: 1;
    }

    .hrd-applicants-page .hrd-stat-note {
        color: #96a19a;
        font-size: 11px;
        margin-top: 7px;
    }

    .hrd-applicants-page .hrd-directory-card {
        overflow: hidden;
        background: #fff;
        border: 1px solid #e8eee9;
        border-radius: 20px;
        box-shadow: 0 8px 26px rgba(28, 64, 46, .055);
    }

    .hrd-applicants-page .hrd-directory-header {
        padding: 22px 24px 17px;
        border-bottom: 1px solid #edf1ed;
    }

    .hrd-applicants-page .hrd-directory-title {
        color: #193d2e;
        font-size: 17px;
        font-weight: 800;
        margin: 0 0 5px;
    }

    .hrd-applicants-page .hrd-directory-subtitle {
        color: #8a978f;
        font-size: 12px;
        margin: 0;
    }

    .hrd-applicants-page .hrd-search-area {
        padding: 18px 24px;
        background: #fbfcfa;
        border-bottom: 1px solid #edf1ed;
    }

    .hrd-applicants-page .hrd-search-input {
        min-height: 46px;
        padding: 10px 15px;
        color: #294236;
        background: #fff;
        border: 1px solid #e2e9e3;
        border-radius: 12px;
        font-size: 13px;
        box-shadow: 0 2px 6px rgba(20, 55, 38, .025);
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .hrd-applicants-page .hrd-search-input:focus {
        border-color: var(--hrd-gold);
        box-shadow: 0 0 0 3px rgba(200, 169, 107, .14);
        outline: none;
    }

    .hrd-applicants-page .hrd-btn-search {
        min-height: 46px;
        padding: 10px 20px;
        color: #fff;
        background: linear-gradient(135deg, #1b704e, #10543a);
        border: 0;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 700;
        box-shadow: 0 5px 12px rgba(23, 100, 72, .16);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .hrd-applicants-page .hrd-btn-search:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 8px 16px rgba(23, 100, 72, .22);
    }

    .hrd-applicants-page .hrd-btn-reset {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 46px;
        padding: 10px 17px;
        color: #64736a;
        background: #fff;
        border: 1px solid #e1e8e2;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: background .2s ease, border-color .2s ease;
    }

    .hrd-applicants-page .hrd-btn-reset:hover {
        color: var(--hrd-green);
        background: #f1f7f2;
        border-color: #c9dbce;
    }

    .hrd-applicants-page .hrd-table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .hrd-applicants-page .hrd-applicants-table {
        width: 100%;
        min-width: 790px;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .hrd-applicants-page .hrd-applicants-table thead th {
        padding: 15px 17px;
        color: #77857c;
        background: #f7f9f6;
        border-bottom: 1px solid #e9eee9;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .8px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .hrd-applicants-page .hrd-applicants-table tbody td {
        padding: 17px;
        color: #53645a;
        border-bottom: 1px solid #eff2ef;
        font-size: 12px;
        vertical-align: middle;
    }

    .hrd-applicants-page .hrd-applicants-table tbody tr {
        transition: background .18s ease;
    }

    .hrd-applicants-page .hrd-applicants-table tbody tr:hover {
        background: #f9fbf8;
    }

    .hrd-applicants-page .hrd-applicants-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .hrd-applicants-page .hrd-applicant-name {
        color: #244333;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .hrd-applicants-page .hrd-applicant-email {
        color: #96a199;
        font-size: 11px;
        overflow-wrap: anywhere;
    }

    .hrd-applicants-page .hrd-education-main {
        color: #40594a;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .hrd-applicants-page .hrd-education-sub {
        color: #97a29a;
        font-size: 11px;
    }

    .hrd-applicants-page .hrd-application-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 29px;
        padding: 0 9px;
        color: #176448;
        background: #eaf4ee;
        border: 1px solid #d9eadf;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 800;
    }

    .hrd-applicants-page .hrd-btn-profile {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 35px;
        padding: 7px 12px;
        color: #176448;
        background: #f0f7f2;
        border: 1px solid #dcebe0;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 800;
        text-decoration: none;
        white-space: nowrap;
        transition: all .2s ease;
    }

    .hrd-applicants-page .hrd-btn-profile:hover {
        color: #fff;
        background: #176448;
        border-color: #176448;
        transform: translateY(-1px);
    }

    .hrd-applicants-page .hrd-empty-state {
        padding: 55px 20px !important;
        text-align: center;
    }

    .hrd-applicants-page .hrd-empty-icon {
        display: grid;
        place-items: center;
        width: 65px;
        height: 65px;
        margin: 0 auto 15px;
        color: #799487;
        background: #eef5ef;
        border-radius: 20px;
        font-size: 28px;
    }

    .hrd-applicants-page .hrd-empty-title {
        color: #294536;
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .hrd-applicants-page .hrd-empty-description {
        color: #929e96;
        font-size: 12px;
        margin: 0;
    }

    .hrd-applicants-page .hrd-pagination {
        padding: 17px 22px;
        border-top: 1px solid #edf1ed;
    }

    .hrd-applicants-page .pagination {
        margin-bottom: 0;
        gap: 4px;
        flex-wrap: wrap;
    }

    .hrd-applicants-page .page-link {
        color: #426653;
        border-color: #e5ece6;
        border-radius: 8px;
        font-size: 12px;
    }

    .hrd-applicants-page .page-item.active .page-link {
        color: #fff;
        background: #176448;
        border-color: #176448;
    }

    .hrd-applicants-page .page-link:focus {
        box-shadow: 0 0 0 3px rgba(200, 169, 107, .15);
    }

    @media (max-width: 767.98px) {
        .hrd-applicants-page {
            padding: 19px 8px 30px;
        }

        .hrd-applicants-page .hrd-page-heading {
            align-items: flex-start;
        }

        .hrd-applicants-page .hrd-total-chip {
            width: 100%;
        }

        .hrd-applicants-page .hrd-directory-header,
        .hrd-applicants-page .hrd-search-area {
            padding-left: 16px;
            padding-right: 16px;
        }

        .hrd-applicants-page .hrd-applicants-table thead th,
        .hrd-applicants-page .hrd-applicants-table tbody td {
            padding: 13px;
        }
    }

    @media (max-width: 575.98px) {
        .hrd-applicants-page .hrd-page-title {
            font-size: 25px;
        }

        .hrd-applicants-page .hrd-stat-card {
            min-height: 112px;
            padding: 16px;
        }

        .hrd-applicants-page .hrd-directory-card {
            border-radius: 15px;
        }

        .hrd-applicants-page .hrd-directory-header {
            padding: 18px 15px;
        }

        .hrd-applicants-page .hrd-search-area {
            padding: 15px;
        }

        .hrd-applicants-page .hrd-btn-search,
        .hrd-applicants-page .hrd-btn-reset {
            padding-left: 13px;
            padding-right: 13px;
        }

        .hrd-applicants-page .hrd-pagination {
            padding: 15px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .hrd-applicants-page *,
        .hrd-applicants-page *::before,
        .hrd-applicants-page *::after {
            transition-duration: .01ms !important;
            animation-duration: .01ms !important;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid hrd-applicants-page">

    {{-- PAGE HEADING --}}
    <div class="hrd-page-heading">
        <div>
            <div class="hrd-eyebrow">Human Resource Development</div>
            <h3 class="hrd-page-title">Data Pelamar</h3>
            <p class="hrd-page-description">
                Direktori biodata calon pegawai yang terdaftar dalam sistem rekrutmen.
            </p>
        </div>

        <div class="hrd-total-chip">
            <div class="hrd-total-icon">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <span class="hrd-total-label">Total Pelamar</span>
                <div class="hrd-total-value">{{ number_format($statistics['total']) }}</div>
            </div>
        </div>
    </div>

    {{-- STATISTICS --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="hrd-stat-card">
                <div class="hrd-stat-top">
                    <span class="hrd-stat-label">Seluruh Pelamar</span>
                    <span class="hrd-stat-icon total">
                        <i class="bi bi-people"></i>
                    </span>
                </div>
                <div class="hrd-stat-value">{{ number_format($statistics['total']) }}</div>
                <div class="hrd-stat-note">Total biodata yang terdaftar</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="hrd-stat-card">
                <div class="hrd-stat-top">
                    <span class="hrd-stat-label">Sudah Melamar</span>
                    <span class="hrd-stat-icon applied">
                        <i class="bi bi-file-earmark-check"></i>
                    </span>
                </div>
                <div class="hrd-stat-value">{{ number_format($statistics['with_applications']) }}</div>
                <div class="hrd-stat-note">Pelamar yang memiliki pengajuan</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="hrd-stat-card">
                <div class="hrd-stat-top">
                    <span class="hrd-stat-label">Belum Melamar</span>
                    <span class="hrd-stat-icon pending">
                        <i class="bi bi-person-dash"></i>
                    </span>
                </div>
                <div class="hrd-stat-value">{{ number_format($statistics['without_applications']) }}</div>
                <div class="hrd-stat-note">Pelamar tanpa pengajuan lamaran</div>
            </div>
        </div>
    </div>

    {{-- APPLICANT DIRECTORY --}}
    <div class="hrd-directory-card">

        <div class="hrd-directory-header">
            <h5 class="hrd-directory-title">Direktori Pelamar</h5>
            <p class="hrd-directory-subtitle">
                Informasi biodata dan riwayat pengajuan calon pegawai.
            </p>
        </div>

        {{-- SEARCH --}}
        <div class="hrd-search-area">
            <form method="GET" action="{{ route('hrd.applicants.index') }}" class="row g-2 align-items-center">
                <div class="col-lg-9">
                    <input
                        type="text"
                        name="search"
                        class="form-control hrd-search-input"
                        placeholder="Cari nama, NIK, nomor telepon, institusi, atau jurusan..."
                        value="{{ request('search') }}"
                    >
                </div>

                <div class="col-lg-3 d-flex gap-2">
                    <button type="submit" class="btn hrd-btn-search flex-grow-1">
                        <i class="bi bi-search me-1"></i>
                        Cari
                    </button>

                    <a href="{{ route('hrd.applicants.index') }}" class="hrd-btn-reset">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- TABLE --}}
        <div class="hrd-table-wrap">
            <table class="table hrd-applicants-table align-middle">
                <thead>
                    <tr>
                        <th>Nama Pelamar</th>
                        <th>NIK</th>
                        <th>Kontak</th>
                        <th>Pendidikan</th>
                        <th class="text-center">Lamaran</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($applicants as $applicant)
                        <tr>
                            <td>
                                <div class="hrd-applicant-name">
                                    {{ $applicant->full_name }}
                                </div>
                                <div class="hrd-applicant-email">
                                    {{ $applicant->user->email ?? '-' }}
                                </div>
                            </td>

                            <td>{{ $applicant->nik ?: '-' }}</td>

                            <td>{{ $applicant->phone ?: '-' }}</td>

                            <td>
                                <div class="hrd-education-main">
                                    {{ $applicant->education_level ?: '-' }}
                                </div>
                                <div class="hrd-education-sub">
                                    {{ $applicant->institution ?: '-' }}
                                </div>
                            </td>

                            <td class="text-center">
                                <span class="hrd-application-count">
                                    {{ $applicant->applications_count }}
                                </span>
                            </td>

                            <td class="text-end">
                                <a
                                    href="{{ route('hrd.applicants.show', $applicant) }}"
                                    class="hrd-btn-profile"
                                >
                                    <i class="bi bi-person-vcard"></i>
                                    Profil
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="hrd-empty-state">
                                <div class="hrd-empty-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="hrd-empty-title">Belum ada data pelamar</div>
                                <p class="hrd-empty-description">
                                    Data akan muncul setelah pengguna melengkapi biodata.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="hrd-pagination">
            {{ $applicants->links() }}
        </div>

    </div>
</div>
@endsection