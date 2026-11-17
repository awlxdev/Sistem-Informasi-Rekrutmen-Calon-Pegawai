<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Pendaftaran Calon Pegawai') | Sistem Rekrutmen</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #164438;
            --primary-dark: #10362d;
            --primary-soft: #eaf2ee;
            --accent: #b99a62;
            --accent-soft: #f7f3e9;

            --background: #f7f8f6;
            --surface: #ffffff;
            --border: #e7ebe7;

            --text: #26342e;
            --muted: #7b8780;
            --success: #24734c;
            --danger: #bd4545;

            --radius: 12px;
            --shadow: 0 3px 14px rgba(25, 48, 37, .045);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background: var(--background);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: var(--primary);
            text-decoration: none;
        }

        a:hover {
            color: var(--primary-dark);
        }

        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        /* BRAND */

        .brand-mark {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 11px;
            background: var(--primary);
            color: #fff;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: -.7px;
        }

        .navbar-brand {
            color: var(--primary);
            font-weight: 800;
            letter-spacing: -.4px;
        }

        /* SURFACE */

        .auth-card,
        .dashboard-card {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background: var(--surface);
            box-shadow: var(--shadow);
        }

        /* FORM */

        .form-label {
            margin-bottom: 7px;
            color: #46554d;
            font-size: 13px;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            min-height: 43px;
            border: 1px solid #dfe5e0;
            border-radius: 9px;
            background-color: #fff;
            color: var(--text);
            font-size: 13px;
            box-shadow: none;
        }

        textarea.form-control {
            min-height: 105px;
        }

        .form-control::placeholder {
            color: #a4ada7;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(185, 154, 98, .12);
        }

        .form-text {
            color: var(--muted);
            font-size: 12px;
        }

        /* BUTTONS */

        .btn {
            min-height: 38px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            transition: background .18s ease, border-color .18s ease;
        }

        .btn-primary-custom,
        .btn-primary {
            border: 1px solid var(--primary);
            background: var(--primary);
            color: #fff;
        }

        .btn-primary-custom:hover,
        .btn-primary:hover {
            border-color: var(--primary-dark);
            background: var(--primary-dark);
            color: #fff;
        }

        .btn-outline-primary {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-outline-primary:hover {
            border-color: var(--primary);
            background: var(--primary);
            color: #fff;
        }

        /* TEXT */

        .text-primary-custom {
            color: var(--primary) !important;
        }

        .text-muted-custom {
            color: var(--muted) !important;
        }

        .section-eyebrow {
            color: var(--accent);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.1px;
            text-transform: uppercase;
        }

        /* TABLE */

        .table {
            --bs-table-bg: transparent;
            margin-bottom: 0;
            font-size: 13px;
            vertical-align: middle;
        }

        .table thead th {
            padding: 12px 14px;
            border-bottom: 1px solid var(--border);
            background: #f8faf8;
            color: #68766e;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .35px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 13px 14px;
            border-color: var(--border);
        }

        .table tbody tr:last-child td {
            border-bottom: 0;
        }

        /* BADGES */

        .badge {
            padding: 6px 9px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        /* ALERT */

        .alert {
            border: 1px solid var(--border);
            border-radius: 9px;
            font-size: 13px;
        }

        /* CAPTCHA */

        .captcha-box {
            padding: 13px;
            border: 1px dashed #d5c49f;
            border-radius: 9px;
            background: var(--accent-soft);
        }

        /* UTILITIES */

        .page-heading {
            margin-bottom: 22px;
        }

        .page-heading h1 {
            margin-bottom: 5px;
            color: var(--primary);
            font-size: 23px;
            font-weight: 700;
            letter-spacing: -.6px;
        }

        .page-heading p {
            margin-bottom: 0;
            color: var(--muted);
            font-size: 13px;
        }

        .divider-soft {
            border-color: var(--border);
            opacity: 1;
        }

        .icon-soft {
            color: var(--primary);
        }

        /* RESPONSIVE */

        @media (max-width: 768px) {
            body {
                font-size: 13px;
            }

            .page-heading h1 {
                font-size: 20px;
            }

            .auth-card,
            .dashboard-card {
                border-radius: 10px;
            }

            .table-responsive {
                border-radius: 8px;
            }
        }

        @media print {
            body {
                background: #fff;
            }

            .no-print {
                display: none !important;
            }
        }

        /* =====================================================
           PUBLIC NAVBAR - SHARED DESIGN
           Sinkron dengan navbar halaman Beranda
        ====================================================== */

        .navbar-main {
            min-height: 78px;
            background: rgba(255,255,255,.96);
            border-bottom: 1px solid var(--border);
        }

        .navbar-main .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--primary);
            font-size: 15px;
            font-weight: 800;
            letter-spacing: .4px;
            text-decoration: none;
        }

        .navbar-main .brand-mark {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 13px;
            color: #fff;
            background: var(--primary);
            font-size: 20px;
            box-shadow: 0 5px 12px rgba(22,68,56,.15);
        }

        .navbar-main .brand small {
            display: block;
            margin-top: 2px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 1.5px;
        }

        .navbar-main .nav-link-custom {
            color: #58655e;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: color .2s ease;
        }

        .navbar-main .nav-link-custom:hover {
            color: var(--primary);
        }

        .navbar-main .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 12px 21px;
            border: 1px solid var(--primary);
            border-radius: 10px;
            background: var(--primary);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .navbar-main .btn-primary-custom:hover {
            transform: translateY(-2px);
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #fff;
            box-shadow: 0 8px 18px rgba(22,68,56,.16);
        }

        .navbar-main .btn-outline-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 20px;
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--primary);
            background: #fff;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .navbar-main .btn-outline-custom:hover {
            border-color: var(--primary);
            background: var(--primary-soft);
            color: var(--primary);
        }

        .navbar-main .navbar-toggler {
            padding: 4px 8px;
        }

        @media (max-width: 991.98px) {
            .navbar-main {
                min-height: 70px;
            }

            .navbar-main .navbar-collapse {
                border-top: 1px solid var(--border);
                margin-top: 12px;
            }

            .navbar-main .navbar-collapse > div {
                align-items: stretch !important;
                padding-top: 18px !important;
                padding-bottom: 18px !important;
            }

            .navbar-main .nav-link-custom {
                padding: 5px 0;
            }

            .navbar-main .btn-primary-custom,
            .navbar-main .btn-outline-custom {
                width: 100%;
            }
        }


        /* =====================================================
           ADMIN & HRD PANEL
        ====================================================== */

        body.panel-mode {
            background: #f4f6f3;
        }

        .panel-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1040;
            width: 260px;
            display: flex;
            flex-direction: column;
            padding: 24px 17px;
            color: #eaf1ec;
            background: linear-gradient(165deg, #164438 0%, #10362d 58%, #0b2923 100%);
            box-shadow: 8px 0 30px rgba(16, 54, 45, .08);
            transition: transform .25s ease;
        }

        .panel-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 2px 9px 25px;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }

        .panel-brand-mark {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border: 1px solid rgba(200,169,107,.55);
            border-radius: 13px;
            color: #f0d9a8;
            background: rgba(255,255,255,.08);
            font-size: 20px;
        }

        .panel-brand-name {
            color: #fff;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 1.1px;
        }

        .panel-brand-caption {
            margin-top: 2px;
            color: #b9c9bf;
            font-size: 9px;
            letter-spacing: 1.5px;
        }

        .panel-nav-label {
            margin: 25px 10px 10px;
            color: #a8bcb0;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .panel-nav {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .panel-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 44px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 10px;
            color: #d5e0d9;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: .2s ease;
        }

        .panel-nav-link i {
            width: 18px;
            color: #c8a96b;
            font-size: 16px;
            text-align: center;
        }

        .panel-nav-link:hover,
        .panel-nav-link.active {
            border-color: rgba(200,169,107,.2);
            color: #fff;
            background: rgba(255,255,255,.105);
        }

        .panel-nav-link.active {
            box-shadow: inset 3px 0 #c8a96b;
        }

        .panel-nav-disabled {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 44px;
            padding: 10px 12px;
            color: #91a69a;
            font-size: 12px;
            font-weight: 500;
            opacity: .72;
        }

        .panel-nav-disabled i {
            width: 18px;
            color: #b7a071;
            font-size: 15px;
            text-align: center;
        }

        .panel-coming {
            margin-left: auto;
            padding: 3px 6px;
            border-radius: 5px;
            color: #e8d4a8;
            background: rgba(200,169,107,.13);
            font-size: 8px;
            font-weight: 700;
        }

        .panel-sidebar-bottom {
            margin-top: auto;
            padding: 15px 9px 0;
            border-top: 1px solid rgba(255,255,255,.12);
        }

        .panel-user {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 13px;
        }

        .panel-user-avatar {
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            border-radius: 11px;
            color: #f2dfb8;
            background: rgba(255,255,255,.1);
            font-weight: 800;
        }

        .panel-user-name {
            overflow: hidden;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .panel-user-role {
            color: #a8bcb0;
            font-size: 9px;
        }

        .panel-logout {
            width: 100%;
            min-height: 39px;
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 9px;
            color: #f0d9d9;
            background: rgba(255,255,255,.055);
            font-size: 11px;
            font-weight: 600;
        }

        .panel-logout:hover {
            border-color: rgba(255,255,255,.3);
            color: #fff;
            background: rgba(255,255,255,.11);
        }

        .panel-main {
            min-height: 100vh;
            margin-left: 260px;
        }

        .panel-topbar {
            position: sticky;
            top: 0;
            z-index: 1020;
            min-height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 12px 32px;
            border-bottom: 1px solid #e7ebe7;
            background: rgba(255,255,255,.94);
            backdrop-filter: blur(14px);
        }

        .panel-topbar-title {
            color: #26342e;
            font-size: 14px;
            font-weight: 700;
        }

        .panel-topbar-subtitle {
            margin-top: 2px;
            color: #89948d;
            font-size: 10px;
        }

        .panel-topbar-role {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 11px;
            border: 1px solid #e6eadf;
            border-radius: 20px;
            color: #164438;
            background: #f7faf7;
            font-size: 10px;
            font-weight: 700;
        }

        .panel-topbar-role i {
            color: #b99a62;
        }

        .panel-content {
            padding: 28px 32px 40px;
        }

        .panel-mobile-toggle {
            display: none;
            width: 39px;
            height: 39px;
            border: 1px solid #e3e9e3;
            border-radius: 10px;
            color: #164438;
            background: #fff;
        }

        .panel-overlay {
            display: none;
        }

        @media (max-width: 991.98px) {
            .panel-sidebar {
                transform: translateX(-100%);
            }

            body.panel-sidebar-open .panel-sidebar {
                transform: translateX(0);
            }

            .panel-main {
                margin-left: 0;
            }

            .panel-mobile-toggle {
                display: inline-grid;
                place-items: center;
                flex-shrink: 0;
            }

            .panel-topbar {
                min-height: 65px;
                padding: 10px 17px;
            }

            .panel-content {
                padding: 22px 17px 32px;
            }

            .panel-overlay {
                position: fixed;
                inset: 0;
                z-index: 1030;
                background: rgba(9, 25, 19, .45);
            }

            body.panel-sidebar-open .panel-overlay {
                display: block;
            }
        }

        @media (max-width: 575.98px) {
            .panel-topbar-role {
                padding: 6px 8px;
                font-size: 9px;
            }

            .panel-content {
                padding: 18px 13px 28px;
            }
        }


        /*
        ======================================================
           PANEL CONTENT ALIGNMENT FIX 2026
           Menyamakan lebar konten Admin dan HRD
        ======================================================
        */

        .panel-main {
            min-width: 0;
            width: auto;
        }

        .panel-content {
            width: 100%;
            min-width: 0;
            box-sizing: border-box;
        }

        .panel-content > .container,
        .panel-content > .container-fluid {
            width: 100% !important;
            max-width: none !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            padding-left: 12px !important;
            padding-right: 12px !important;
            box-sizing: border-box;
        }

        .panel-content > .container > .row,
        .panel-content > .container-fluid > .row {
            --bs-gutter-x: 1.5rem;
        }

        .panel-content img,
        .panel-content table {
            max-width: 100%;
        }

        @media (max-width: 991.98px) {
            .panel-main {
                width: 100%;
            }

            .panel-content > .container,
            .panel-content > .container-fluid {
                max-width: none !important;
            }
        }

        @media (max-width: 575.98px) {
            .panel-content > .container,
            .panel-content > .container-fluid {
                padding-left: 8px !important;
                padding-right: 8px !important;
            }
        }

        /*
        ======================================================
           PANEL VERTICAL SPACING FIX 2026
           Jarak header ke konten diseragamkan
        ======================================================
        */

        .panel-content {
            padding-top: 24px !important;
        }

        .panel-content > .container,
        .panel-content > .container-fluid {
            padding-top: 0 !important;
        }

        @media (max-width: 991.98px) {
            .panel-content {
                padding-top: 20px !important;
            }
        }

        @media (max-width: 575.98px) {
            .panel-content {
                padding-top: 16px !important;
            }
        }

        /*
        ======================================================
           SHARED UI COMPONENTS UPGRADE 2026
           Standarisasi komponen visual seluruh halaman
        ======================================================
        */

        /* CARD */
        .card {
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 3px 14px rgba(25, 48, 37, .045);
        }

        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            background: #fff;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
        }

        .card-body {
            padding: 20px;
        }

        .card-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--border);
            background: #fbfcfb;
        }

        /* PAGE TITLES */
        .page-heading {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 24px;
        }

        .page-heading h1,
        .page-heading h2 {
            color: var(--primary);
            font-weight: 750;
            letter-spacing: -.55px;
        }

        .page-heading p {
            max-width: 720px;
            line-height: 1.7;
        }

        /* FORMS */
        .form-control,
        .form-select {
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(185, 154, 98, .13);
        }

        .form-label {
            color: #43534a;
            font-weight: 650;
        }

        .input-group-text {
            border-color: #dfe5e0;
            background: #f8faf8;
            color: #718077;
        }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: transform .18s ease, box-shadow .18s ease,
                        background .18s ease, border-color .18s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary:hover,
        .btn-primary-custom:hover {
            box-shadow: 0 5px 13px rgba(22, 68, 56, .15);
        }

        .btn:active {
            transform: translateY(0);
        }

        /* TABLES */
        .table-responsive {
            border: 1px solid var(--border);
            border-radius: 11px;
            background: #fff;
        }

        .table {
            --bs-table-color: var(--text);
            --bs-table-hover-bg: #f7faf7;
        }

        .table thead th {
            vertical-align: middle;
        }

        .table tbody tr {
            transition: background .15s ease;
        }

        .table tbody tr:hover {
            background: #f8faf8;
        }

        /* STATUS AND ALERTS */
        .alert {
            padding: 13px 16px;
            line-height: 1.65;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            line-height: 1.35;
        }

        /* FILTER AND ACTION AREAS */
        .filter-card,
        .filter-panel {
            padding: 18px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: #fff;
            box-shadow: var(--shadow);
        }

        .action-group {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
        }

        /* PANEL CONTENT */
        .panel-content {
            color: var(--text);
        }

        .panel-content > * {
            min-width: 0;
        }

        .panel-content .card + .card {
            margin-top: 18px;
        }

        /* RESPONSIVE */
        @media (max-width: 767.98px) {
            .card-body {
                padding: 16px;
            }

            .card-header,
            .card-footer {
                padding: 13px 16px;
            }

            .page-heading {
                margin-bottom: 18px;
            }

            .filter-card,
            .filter-panel {
                padding: 14px;
            }

            .action-group .btn {
                flex: 1 1 auto;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .btn,
            .table tbody tr,
            .form-control,
            .form-select {
                transition: none !important;
            }
        }

    </style>

    @yield('styles')
    @stack('styles')
</head>

<body class="@auth @if(auth()->user()->isAdmin() || auth()->user()->isHrd()) panel-mode @endif @endauth">

    @auth
        @if(auth()->user()->isAdmin() || auth()->user()->isHrd())
            <aside class="panel-sidebar no-print" id="panelSidebar">
                <div class="panel-brand">
                    <div class="panel-brand-mark"><i class="bi bi-building-check"></i></div>
                    <div>
                        <div class="panel-brand-name">REKRUTMEN</div>
                        <div class="panel-brand-caption">MANAGEMENT PANEL</div>
                    </div>
                </div>

                <div class="panel-nav-label">Menu Utama</div>
                <nav class="panel-nav">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                           class="panel-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid-1x2"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.users.index') }}"
                           class="panel-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="bi bi-people"></i> Manajemen Pengguna
                        </a>
                        <a href="{{ route('admin.vacancies.index') }}"
                           class="panel-nav-link {{ request()->routeIs('admin.vacancies.*') ? 'active' : '' }}">
                            <i class="bi bi-briefcase"></i> Lowongan Pekerjaan
                        </a>
                        <a href="{{ route('admin.schedule') }}"
                           class="panel-nav-link {{ request()->routeIs('admin.schedule') ? 'active' : '' }}">
                            <i class="bi bi-calendar3"></i> Jadwal Pendaftaran
                        </a>
                        <a href="{{ route('admin.applications.index') }}"
                           class="panel-nav-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
                            <i class="bi bi-file-earmark-text"></i> Data Lamaran
                        </a>                        <a href="{{ route('admin.selection.index') }}"
                           class="panel-nav-link {{ request()->routeIs('admin.selection.*') ? 'active' : '' }}">
                            <i class="bi bi-clipboard-check"></i> Seleksi Administrasi
                        </a>
                        <a href="{{ route('admin.settings.index') }}"
                           class="panel-nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <i class="bi bi-gear"></i> Pengaturan Sistem
                        </a>
                    @elseif(auth()->user()->isHrd())
                        <a href="{{ route('hrd.dashboard') }}"
                           class="panel-nav-link {{ request()->routeIs('hrd.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid-1x2"></i> Dashboard
                        </a>
                        <a href="{{ route('hrd.vacancies.index') }}"
                           class="panel-nav-link {{ request()->routeIs('hrd.vacancies.*') ? 'active' : '' }}">
                            <i class="bi bi-briefcase"></i> Lowongan Pekerjaan
                        </a>
                        <a href="{{ route('hrd.schedule') }}"
                           class="panel-nav-link {{ request()->routeIs('hrd.schedule') ? 'active' : '' }}">
                            <i class="bi bi-calendar3"></i> Jadwal Pendaftaran
                        </a>
                        <a href="{{ route('hrd.applicants.index') }}"
                           class="panel-nav-link {{ request()->routeIs('hrd.applicants.*') ? 'active' : '' }}">
                            <i class="bi bi-person-lines-fill"></i> Data Pelamar
                        </a>
                        <a href="{{ route('hrd.selection.index') }}"
                           class="panel-nav-link {{ request()->routeIs('hrd.selection.*') ? 'active' : '' }}">
                            <i class="bi bi-clipboard-check"></i> Seleksi Administrasi
                        </a>
                        <a href="{{ route('hrd.applications.index') }}"
                           class="panel-nav-link {{ request()->routeIs('hrd.applications.*') ? 'active' : '' }}">
                            <i class="bi bi-file-earmark-text"></i> Data Lamaran
                        </a>
                    @endif
                </nav>

                <div class="panel-sidebar-bottom">
                    <div class="panel-user">
                        <div class="panel-user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-grow-1 min-w-0">
                            <div class="panel-user-name">{{ auth()->user()->name }}</div>
                            <div class="panel-user-role">
                                {{ auth()->user()->isAdmin() ? 'Administrator' : 'Human Resources' }}
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="panel-logout">
                            <i class="bi bi-box-arrow-left me-2"></i> Keluar dari Sistem
                        </button>
                    </form>
                </div>
            </aside>

            <div class="panel-overlay" id="panelOverlay"></div>

            <div class="panel-main">
                <header class="panel-topbar no-print">
                    <div class="d-flex align-items-center gap-3">
                        <button type="button" class="panel-mobile-toggle" id="panelToggle"
                                aria-label="Buka menu navigasi" aria-controls="panelSidebar">
                            <i class="bi bi-list fs-5"></i>
                        </button>
                        <div>
                            <div class="panel-topbar-title">
                                {{ auth()->user()->isAdmin() ? 'Administrator Panel' : 'HRD Panel' }}
                            </div>
                            <div class="panel-topbar-subtitle">Sistem Pendaftaran Calon Pegawai</div>
                        </div>
                    </div>
                    <span class="panel-topbar-role">
                        <i class="bi bi-shield-check"></i>
                        {{ auth()->user()->isAdmin() ? 'ADMINISTRATOR' : 'HRD' }}
                    </span>
                </header>

                <div class="panel-content">
                    @yield('content')
                </div>
            </div>
        @else
            @hasSection('navbar')
                @yield('navbar')
            @else
                @include('components.public-navbar')
            @endif
            @yield('content')
        @endif
    @else
        @hasSection('navbar')
            @yield('navbar')
        @else
            @include('components.public-navbar')
        @endif
        @yield('content')
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('panelToggle');
            const overlay = document.getElementById('panelOverlay');

            if (!toggle || !overlay) return;

            toggle.addEventListener('click', function () {
                document.body.classList.toggle('panel-sidebar-open');
            });

            overlay.addEventListener('click', function () {
                document.body.classList.remove('panel-sidebar-open');
            });

            document.querySelectorAll('#panelSidebar a').forEach(function (link) {
                link.addEventListener('click', function () {
                    document.body.classList.remove('panel-sidebar-open');
                });
            });
        });
    </script>

    @yield('scripts')
    @stack('scripts')

</body>
</html>