@extends('layouts.app')

@section('title', 'Registrasi Pelamar')

@section('navbar')
<style>
    .navbar-main {
        display: none !important;
    }
</style>
@endsection

@push('styles')
<style>
    .register-premium-page {
        --register-emerald: #08745c;
        --register-emerald-dark: #075746;
        --register-gold: #c8a96b;
        --register-ivory: #f8f7f1;
        --register-text: #24352f;
        --register-muted: #7b8982;

        min-height: 100vh;
        width: 100%;
        padding: 42px 20px 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(circle at 12% 15%, rgba(200,169,107,.15), transparent 28%),
            radial-gradient(circle at 90% 82%, rgba(8,116,92,.12), transparent 30%),
            linear-gradient(135deg, #f5f3e9 0%, #fbfaf6 48%, #edf4ef 100%);
        font-family: inherit;
        color: var(--register-text);
    }

    .register-premium-page *,
    .register-premium-page *::before,
    .register-premium-page *::after {
        box-sizing: border-box;
    }

    .register-premium-page::before,
    .register-premium-page::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        filter: blur(1px);
    }

    .register-premium-page::before {
        width: 300px;
        height: 300px;
        top: -150px;
        right: -90px;
        background: rgba(8,116,92,.055);
    }

    .register-premium-page::after {
        width: 250px;
        height: 250px;
        bottom: -125px;
        left: -70px;
        background: rgba(200,169,107,.10);
    }

    .register-premium-wrapper {
        width: 100%;
        max-width: 570px;
        margin: auto;
        position: relative;
        z-index: 1;
    }

    .register-brand-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .register-brand-mark {
        width: 64px;
        height: 64px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 21px;
        color: #fff;
        font-size: 21px;
        font-weight: 800;
        letter-spacing: 1px;
        background: linear-gradient(145deg, #0c866b, #064d40);
        border: 1px solid rgba(255,255,255,.55);
        box-shadow:
            0 12px 25px rgba(7,87,70,.22),
            inset 0 1px 1px rgba(255,255,255,.35);
    }

    .register-brand-title {
        margin: 15px 0 6px;
        color: #174b3d;
        font-size: clamp(21px, 4vw, 27px);
        font-weight: 800;
        letter-spacing: -.6px;
    }

    .register-brand-subtitle {
        margin: 0;
        color: var(--register-muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .register-premium-card {
        padding: 34px 38px;
        border: 1px solid rgba(255,255,255,.9);
        border-radius: 25px;
        background: rgba(255,255,255,.94);
        box-shadow:
            0 22px 55px rgba(32,62,48,.10),
            0 5px 15px rgba(32,62,48,.045),
            inset 0 1px 0 rgba(255,255,255,.95);
        backdrop-filter: blur(12px);
    }

    .register-card-heading {
        margin-bottom: 25px;
        padding-bottom: 19px;
        border-bottom: 1px solid #edf0eb;
    }

    .register-card-heading h2 {
        margin: 0 0 7px;
        color: #23483b;
        font-size: 20px;
        font-weight: 800;
    }

    .register-card-heading p {
        margin: 0;
        color: #849087;
        font-size: 13px;
        line-height: 1.6;
    }

    .register-section-label {
        display: flex;
        align-items: center;
        gap: 9px;
        margin: 22px 0 15px;
        color: #17664f;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .65px;
        text-transform: uppercase;
    }

    .register-section-label:first-of-type {
        margin-top: 0;
    }

    .register-section-label::before {
        content: "";
        width: 4px;
        height: 17px;
        border-radius: 5px;
        background: linear-gradient(180deg, #c8a96b, #9f8046);
    }

    .register-field {
        margin-bottom: 17px;
    }

    .register-field label {
        display: block;
        margin-bottom: 8px;
        color: #43554b;
        font-size: 12px;
        font-weight: 700;
    }

    .register-input-wrap {
        position: relative;
    }

    .register-input-wrap > i {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        color: #8a9b90;
        font-size: 15px;
        pointer-events: none;
        transition: color .2s ease;
    }

    .register-input {
        width: 100%;
        min-height: 48px;
        padding: 11px 14px 11px 43px;
        border: 1px solid #e3e9e3;
        border-radius: 12px;
        outline: none;
        background: #fbfcfa;
        color: #263a30;
        font-size: 13px;
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .register-input::placeholder {
        color: #a8b1aa;
    }

    .register-input:focus {
        border-color: #b69a61;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(200,169,107,.13), 0 5px 13px rgba(25,75,55,.045);
    }

    .register-input-wrap:focus-within > i {
        color: var(--register-emerald);
    }

    .register-helper {
        display: block;
        margin-top: 7px;
        color: #89958d;
        font-size: 11px;
        line-height: 1.5;
    }

    .register-captcha-panel {
        padding: 17px;
        border: 1px solid #e8e5d8;
        border-radius: 15px;
        background: linear-gradient(135deg, #fbfaf5, #f5f7f1);
    }

    .register-captcha-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 13px;
    }

    .register-captcha-title {
        color: #526257;
        font-size: 12px;
        font-weight: 700;
    }

    .register-refresh-btn {
        padding: 5px 9px;
        border: 0;
        border-radius: 8px;
        background: rgba(8,116,92,.08);
        color: #08745c;
        font-size: 11px;
        font-weight: 700;
        transition: background .2s ease, transform .2s ease;
    }

    .register-refresh-btn:hover {
        background: rgba(8,116,92,.15);
        transform: translateY(-1px);
    }

    .register-captcha-question {
        min-height: 43px;
        display: flex;
        align-items: center;
        padding: 10px 13px;
        border: 1px dashed #d8d4c4;
        border-radius: 10px;
        background: rgba(255,255,255,.78);
        color: #17664f;
        font-size: 17px;
        font-weight: 800;
        letter-spacing: .3px;
    }

    .register-captcha-input {
        margin-top: 12px;
    }

    .register-agreement {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin: 20px 0 23px;
        padding: 13px 14px;
        border: 1px solid #edf0e9;
        border-radius: 12px;
        background: #fafbf8;
    }

    .register-agreement input {
        width: 16px;
        height: 16px;
        margin-top: 2px;
        flex: 0 0 auto;
        accent-color: #08745c;
    }

    .register-agreement label {
        color: #69766d;
        font-size: 11px;
        line-height: 1.65;
        cursor: pointer;
    }

    .register-submit-btn {
        width: 100%;
        min-height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        border: 0;
        border-radius: 13px;
        background: linear-gradient(135deg, #0b8065, #075542);
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: .2px;
        box-shadow: 0 9px 18px rgba(7,87,70,.19), inset 0 1px 0 rgba(255,255,255,.2);
        transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
    }

    .register-submit-btn:hover {
        color: #fff;
        filter: brightness(1.05);
        transform: translateY(-2px);
        box-shadow: 0 13px 23px rgba(7,87,70,.23);
    }

    .register-submit-btn:active {
        transform: translateY(0);
    }

    .register-login-link {
        margin-top: 23px;
        padding-top: 19px;
        border-top: 1px solid #edf0eb;
        text-align: center;
        color: #849087;
        font-size: 12px;
    }

    .register-login-link a {
        margin-left: 4px;
        color: #08745c;
        font-weight: 800;
        text-decoration: none;
    }

    .register-login-link a:hover {
        color: #c09c58;
        text-decoration: underline;
    }

    .register-footer {
        margin-top: 23px;
        color: #929d94;
        font-size: 11px;
        text-align: center;
    }

    .register-premium-page .alert {
        border-radius: 12px;
        font-size: 12px;
    }

    .register-premium-page .alert ul {
        padding-left: 18px;
    }

    @media (max-width: 576px) {
        .register-premium-page {
            min-height: 100vh;
            padding: 27px 13px;
            align-items: flex-start;
        }

        .register-brand-header {
            margin-bottom: 19px;
        }

        .register-brand-mark {
            width: 56px;
            height: 56px;
            border-radius: 18px;
        }

        .register-brand-title {
            font-size: 21px;
        }

        .register-premium-card {
            padding: 25px 19px;
            border-radius: 20px;
        }

        .register-card-heading {
            margin-bottom: 21px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .register-premium-page *,
        .register-premium-page *::before,
        .register-premium-page *::after {
            scroll-behavior: auto !important;
            transition-duration: .01ms !important;
        }
    }
</style>
@endpush

@section('content')
<main class="register-premium-page">
    <div class="register-premium-wrapper">

        <header class="register-brand-header">
            <div class="register-brand-mark">CP</div>
            <h1 class="register-brand-title">Pendaftaran Calon Pegawai</h1>
            <p class="register-brand-subtitle">
                Buat akun untuk mengikuti proses rekrutmen secara online.
            </p>
        </header>

        <section class="register-premium-card">

            <div class="register-card-heading">
                <h2>Buat Akun Pelamar</h2>
                <p>Lengkapi informasi berikut dengan data yang benar.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>Periksa kembali data Anda.</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}">
                @csrf

                <div class="register-section-label">Informasi Identitas</div>

                <div class="register-field">
                    <label for="name">Nama Lengkap</label>
                    <div class="register-input-wrap">
                        <i class="bi bi-person"></i>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            class="register-input"
                            value="{{ old('name') }}"
                            placeholder="Masukkan nama lengkap"
                            maxlength="150"
                            autocomplete="name"
                            required
                        >
                    </div>
                </div>

                <div class="register-field">
                    <label for="email">Alamat Email</label>
                    <div class="register-input-wrap">
                        <i class="bi bi-envelope"></i>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="register-input"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            autocomplete="email"
                            required
                        >
                    </div>
                    <small class="register-helper">
                        Gunakan alamat email yang aktif dan dapat diakses.
                    </small>
                </div>

                <div class="register-section-label">Keamanan Akun</div>

                <div class="register-field">
                    <label for="password">Password</label>
                    <div class="register-input-wrap">
                        <i class="bi bi-lock"></i>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="register-input"
                            placeholder="Minimal 8 karakter"
                            autocomplete="new-password"
                            minlength="8"
                            required
                        >
                    </div>
                    <small class="register-helper">
                        Gunakan password minimal 8 karakter.
                    </small>
                </div>

                <div class="register-field">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="register-input-wrap">
                        <i class="bi bi-shield-lock"></i>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            class="register-input"
                            placeholder="Ulangi password Anda"
                            autocomplete="new-password"
                            required
                        >
                    </div>
                </div>

                <div class="register-section-label">Verifikasi Pendaftaran</div>

                <div class="register-captcha-panel">
                    <div class="register-captcha-top">
                        <span class="register-captcha-title">
                            <i class="bi bi-patch-check me-1"></i>
                            Verifikasi CAPTCHA
                        </span>

                        <button
                            type="button"
                            class="register-refresh-btn"
                            id="refreshCaptcha"
                        >
                            <i class="bi bi-arrow-clockwise me-1"></i>
                            Ganti soal
                        </button>
                    </div>

                    <div class="small text-muted mb-2">
                        Ketik nama daerah yang ditampilkan berikut:
                    </div>

                    <div
                        class="register-captcha-question"
                        id="captchaQuestion"
                        aria-live="polite"
                     data-captcha-url="{{ route('captcha.generate') }}">
                        Memuat CAPTCHA...
                    </div>

                    <div class="register-input-wrap register-captcha-input">
                        <i class="bi bi-pencil-square"></i>
                        <input
                            id="captcha_answer"
                            type="text"
                            name="captcha_answer"
                            class="register-input"
                            placeholder="Ketik nama daerah"
                            autocomplete="off"
                            required
                        >
                    </div>
                </div>

                <div class="register-agreement">
                    <input
                        type="checkbox"
                        id="agreement"
                        required
                    >
                    <label for="agreement">
                        Saya menyatakan bahwa data yang diberikan benar dan
                        dapat dipertanggungjawabkan.
                    </label>
                </div>

                <button type="submit" class="register-submit-btn">
                    <i class="bi bi-person-plus"></i>
                    Buat Akun Pelamar
                </button>
            </form>

            <div class="register-login-link">
                Sudah memiliki akun?
                <a href="{{ route('login') }}">Login sekarang</a>
            </div>
        </section>

<footer class="register-footer">
    &copy; {{ date('Y') }} <strong>AWLXDEV</strong>.
    All Rights Reserved.
    <div class="mt-1">Developed by AWLXDEV</div>
</footer>

    </div>
</main>
@endsection

@push('scripts')
<script>
    async function loadCaptcha() {
        const question = document.getElementById('captchaQuestion');
        const answer = document.getElementById('captcha_answer');
        const refreshButton = document.getElementById('refreshCaptcha');

        if (!question || !answer) {
            return;
        }

        question.textContent = 'Memuat CAPTCHA...';

        if (refreshButton) {
            refreshButton.disabled = true;
        }

        try {
            const response = await fetch(question.dataset.captchaUrl, {
                method: 'GET',
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil CAPTCHA');
            }

            const data = await response.json();

            if (!data || !data.question) {
                throw new Error('Format CAPTCHA tidak valid');
            }

            question.textContent = data.question;
            answer.value = '';
        } catch (error) {
            question.textContent = 'CAPTCHA tidak tersedia. Muat ulang halaman.';
        } finally {
            if (refreshButton) {
                refreshButton.disabled = false;
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const refreshButton = document.getElementById('refreshCaptcha');

        if (refreshButton) {
            refreshButton.addEventListener('click', loadCaptcha);
        }

        loadCaptcha();
    });
</script>
@endpush