@extends('layouts.app')

@section('title', 'Tambah Lowongan Pekerjaan')

@push('styles')
<style>
    .panel-content > .container-fluid.hrd-page-shell.hrd-vacancy-form-page {
        width: 100% !important;
        max-width: none !important;
        min-width: 0 !important;
        margin: 0 !important;
        padding-left: 12px !important;
        padding-right: 12px !important;
        box-sizing: border-box !important;
    }

    .panel-content > .container-fluid.hrd-page-shell.hrd-vacancy-form-page > * {
        min-width: 0;
    }

    @media (max-width: 575.98px) {
        .panel-content > .container-fluid.hrd-page-shell.hrd-vacancy-form-page {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) {
        --vacancy-emerald: #193c30;
        --vacancy-dark: #10362b;
        --vacancy-green: #39745d;
        --vacancy-gold: #b99a62;
        width: 100%;
        max-width: 100%;
        margin-inline: auto;
        color: #26372f;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .page-heading {
        margin-bottom: 25px;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .section-eyebrow {
        color: var(--vacancy-green);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.6px;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .page-heading h1 {
        margin-bottom: 8px;
        color: var(--vacancy-emerald);
        font-size: clamp(25px, 3vw, 32px);
        font-weight: 800;
        letter-spacing: -.7px;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .page-heading p {
        max-width: 700px;
        margin-bottom: 0;
        color: #7b8780;
        font-size: 13px;
        line-height: 1.7;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .dashboard-card {
        padding: clamp(20px, 3vw, 32px) !important;
        border: 1px solid #e8ece6;
        border-radius: 19px;
        background: #fff;
        box-shadow: 0 8px 28px rgba(25, 60, 48, .055),
                    0 2px 6px rgba(25, 60, 48, .025);
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .dashboard-card form {
        width: 100%;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .form-label {
        margin-bottom: 8px;
        color: #43564b;
        font-size: 12px;
        font-weight: 750;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .form-control,
    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .form-select {
        min-height: 45px;
        border: 1px solid #dfe7df;
        border-radius: 11px;
        background-color: #fff;
        color: #26372f;
        font-size: 13px;
        box-shadow: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) textarea.form-control {
        min-height: 125px;
        padding: 12px 14px;
        line-height: 1.7;
        resize: vertical;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .form-control:focus,
    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .form-select:focus {
        border-color: var(--vacancy-gold);
        box-shadow: 0 0 0 4px rgba(185, 154, 98, .13);
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .form-control::placeholder {
        color: #a3ada5;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .form-text {
        margin-top: 7px;
        color: #7b8780;
        font-size: 11px;
        line-height: 1.6;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .divider-soft,
    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) hr {
        border-color: #e8ece6;
        opacity: 1;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .alert {
        border-radius: 12px;
        font-size: 12px;
        line-height: 1.7;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .btn {
        min-height: 42px;
        padding: 10px 18px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
        transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .btn-primary-custom {
        border: 1px solid var(--vacancy-emerald);
        background: linear-gradient(135deg, #286448, #193c30);
        color: #fff;
        box-shadow: 0 4px 11px rgba(25, 60, 48, .16);
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .btn-primary-custom:hover {
        border-color: var(--vacancy-dark);
        background: var(--vacancy-dark);
        color: #fff;
        box-shadow: 0 7px 16px rgba(25, 60, 48, .2);
        transform: translateY(-2px);
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .btn-outline-secondary {
        border-color: #dce4dc;
        background: #fff;
        color: #52645a;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .btn-outline-secondary:hover {
        border-color: #c5d2c8;
        background: #f4f7f3;
        color: var(--vacancy-emerald);
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .text-primary-custom {
        color: var(--vacancy-emerald) !important;
    }

    :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .admin-vacancy-form-actions {
        gap: 12px;
    }

    @media (max-width: 767.98px) {
        :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .dashboard-card {
            padding: 18px !important;
            border-radius: 15px;
        }

        :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .page-heading {
            margin-bottom: 19px;
        }

        :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .page-heading h1 {
            font-size: 25px;
        }

        :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .admin-vacancy-form-actions {
            flex-direction: column;
        }

        :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) .admin-vacancy-form-actions .btn {
            width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) *,
        :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) *::before,
        :is(.admin-vacancy-form-page, .hrd-vacancy-form-page) *::after {
            transition: none !important;
        }
    }
</style>
@endpush

@section('navbar')
    @if ($routePrefix === 'hrd')
        @include('components.hrd-navbar')
    @else
        @include('components.admin-navbar')
    @endif
@endsection

@section('content')
<main class="container-fluid py-4 py-lg-5 px-3 px-lg-4 {{ $routePrefix === 'admin' ? 'admin-vacancy-form-page' : 'hrd-page-shell hrd-vacancy-form-page' }}">
    <div class="page-heading">
        <div class="section-eyebrow mb-2">MANAJEMEN REKRUTMEN</div>
        <h1>Tambah Lowongan</h1>
        <p>Buat informasi lowongan pekerjaan baru untuk proses rekrutmen.</p>
    </div>

    @include('management.vacancies._form', [
        'vacancy' => null,
        'formAction' => route($routePrefix . '.vacancies.store'),
        'formMethod' => 'POST',
        'submitLabel' => 'Simpan Lowongan',
    ])
</main>
@endsection