@extends('layouts.app')

@section('title', 'Login')

@section('navbar')
<style>
    .navbar-main {
        display: none !important;
    }
</style>
@endsection

@push('styles')
<style>
    body:has(.auth-premium-page) {
        background: #f5f3ec !important;
        min-height: 100vh;
    }

    .auth-premium-page {
        --auth-emerald: #075b4b;
        --auth-emerald-dark: #064638;
        --auth-gold: #c8a96b;
        --auth-ivory: #f8f6f0;
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 42px 20px;
        overflow: hidden;
        position: relative;
        background:
            radial-gradient(circle at 12% 15%, rgba(200,169,107,.16), transparent 28%),
            radial-gradient(circle at 90% 85%, rgba(7,91,75,.12), transparent 30%),
            linear-gradient(135deg, #f8f6f0 0%, #f0eee6 100%);
        box-sizing: border-box;
    }

    .auth-premium-page *,
    .auth-premium-page *::before,
    .auth-premium-page *::after {
        box-sizing: border-box;
    }

    .auth-premium-page::before,
    .auth-premium-page::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        filter: blur(1px);
    }

    .auth-premium-page::before {
        width: 280px;
        height: 280px;
        top: -120px;
        right: -70px;
        border: 1px solid rgba(200,169,107,.28);
    }

    .auth-premium-page::after {
        width: 220px;
        height: 220px;
        bottom: -100px;
        left: -65px;
        border: 1px solid rgba(7,91,75,.16);
    }

    .auth-premium-container {
        width: 100%;
        max-width: 465px;
        position: relative;
        z-index: 1;
        margin: auto;
    }

    .auth-brand {
        text-align: center;
        margin-bottom: 27px;
    }

    .auth-brand-mark {
        width: 66px;
        height: 66px;
        margin: 0 auto 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 21px;
        color: #fff;
        font-size: 25px;
        font-weight: 800;
        letter-spacing: -1px;
        background: linear-gradient(145deg, #08745e, #064638);
        box-shadow:
            0 12px 25px rgba(6,70,56,.23),
            inset 0 1px 1px rgba(255,255,255,.25);
        border: 1px solid rgba(200,169,107,.7);
    }

    .auth-brand h1 {
        color: #173c34;
        font-size: clamp(21px, 4vw, 25px);
        font-weight: 800;
        letter-spacing: -.65px;
        margin: 0 0 6px;
    }

    .auth-brand p {
        color: #78827d;
        font-size: 13px;
        margin: 0;
        letter-spacing: .25px;
    }

    .auth-premium-card {
        background: rgba(255,255,255,.96);
        border: 1px solid rgba(222,218,204,.9);
        border-radius: 25px;
        padding: 34px;
        box-shadow:
            0 22px 55px rgba(34,54,45,.09),
            0 5px 15px rgba(34,54,45,.035),
            inset 0 1px 0 rgba(255,255,255,.95);
    }

    .auth-card-heading {
        margin-bottom: 25px;
    }

    .auth-card-heading h2 {
        color: #203d34;
        font-size: 21px;
        font-weight: 800;
        letter-spacing: -.4px;
        margin-bottom: 7px;
    }

    .auth-card-heading p {
        color: #89918c;
        font-size: 13px;
        margin: 0;
        line-height: 1.6;
    }

    .auth-premium-page .form-label {
        color: #344d43;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 9px;
    }

    .auth-input-wrap {
        position: relative;
    }

    .auth-input-wrap > i {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        color: #8a9b91;
        font-size: 16px;
        pointer-events: none;
        z-index: 2;
    }

    .auth-premium-page .form-control {
        width: 100%;
        min-height: 49px;
        border: 1px solid #e2e7e1;
        border-radius: 12px;
        background: #fbfcfa;
        color: #243c32;
        padding: 12px 14px 12px 43px;
        font-size: 13px;
        box-shadow: inset 0 1px 2px rgba(25,55,40,.025);
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .auth-premium-page .form-control::placeholder {
        color: #aab3ad;
    }

    .auth-premium-page .form-control:focus {
        background: #fff;
        border-color: #b99a5c;
        box-shadow: 0 0 0 4px rgba(200,169,107,.15);
        outline: none;
    }

    .auth-premium-page .form-check {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .auth-premium-page .form-check-input {
        width: 17px;
        height: 17px;
        margin: 0;
        border-color: #cbd5cd;
        cursor: pointer;
    }

    .auth-premium-page .form-check-input:checked {
        background-color: var(--auth-emerald);
        border-color: var(--auth-emerald);
    }

    .auth-premium-page .form-check-label {
        font-size: 13px;
        cursor: pointer;
    }

    .auth-captcha-panel {
        padding: 15px;
        border: 1px solid #e6e2d5;
        border-radius: 14px;
        background: linear-gradient(145deg, #faf9f4, #f4f5ef);
    }

    .auth-captcha-question {
        min-height: 43px;
        display: flex;
        align-items: center;
        padding: 9px 13px;
        border-radius: 9px;
        background: #fff;
        border: 1px dashed #d8c69d;
        color: #075b4b;
        letter-spacing: .3px;
    }

    .auth-refresh-captcha {
        border: 0;
        background: transparent;
        color: #08735d;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 0;
    }

    .auth-refresh-captcha:hover {
        color: #b18d4d;
    }

    .auth-submit-btn {
        width: 100%;
        min-height: 51px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        border: 1px solid rgba(200,169,107,.55);
        border-radius: 13px;
        background: linear-gradient(135deg, #08735d, #064638);
        color: #fff;
        font-size: 14px;
        font-weight: 800;
        letter-spacing: .25px;
        box-shadow: 0 9px 18px rgba(6,70,56,.19);
        transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
    }

    .auth-submit-btn:hover {
        color: #fff;
        filter: brightness(1.08);
        transform: translateY(-2px);
        box-shadow: 0 13px 23px rgba(6,70,56,.23);
    }

    .auth-submit-btn:active {
        transform: translateY(0);
    }

    .auth-register-link {
        color: #08735d;
        font-weight: 800;
        text-decoration: none;
    }

    .auth-register-link:hover {
        color: #b18d4d;
        text-decoration: underline;
    }

    .auth-premium-footer {
        color: #929a93;
        font-size: 11px;
        text-align: center;
        margin-top: 22px;
    }

    .auth-premium-page .alert {
        border-radius: 12px;
        font-size: 13px;
        border: 0;
    }

    @media (max-width: 575.98px) {
        .auth-premium-page {
            padding: 27px 15px;
            align-items: center;
        }

        .auth-premium-container {
            max-width: 430px;
        }

        .auth-premium-card {
            padding: 25px 20px;
            border-radius: 20px;
        }

        .auth-brand {
            margin-bottom: 22px;
        }

        .auth-brand-mark {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            font-size: 22px;
        }

        .auth-card-heading h2 {
            font-size: 19px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .auth-premium-page *,
        .auth-premium-page *::before,
        .auth-premium-page *::after {
            transition: none !important;
        }
    }
</style>
@endpush

@section('content')
<main class="auth-premium-page">
    <div class="auth-premium-container">

        <header class="auth-brand">
            <div class="auth-brand-mark">CP</div>
            <h1>Pendaftaran Calon Pegawai</h1>
            <p>Sistem Informasi Rekrutmen Pegawai</p>
        </header>

        <section class="auth-premium-card">
            <div class="auth-card-heading">
                <h2>Selamat Datang Kembali</h2>
                <p>Masuk menggunakan email dan password akun Anda untuk melanjutkan.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('warning') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong><i class="bi bi-exclamation-circle me-1"></i> Login belum berhasil.</strong>
                    <ul class="mb-0 mt-2 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <div class="auth-input-wrap">
                        <i class="bi bi-envelope"></i>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            autocomplete="username"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="auth-input-wrap">
                        <i class="bi bi-lock"></i>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <label for="captcha_answer" class="form-label mb-0">
                            Verifikasi CAPTCHA
                        </label>

                        <button
                            type="button"
                            class="auth-refresh-captcha"
                            id="refreshCaptcha"
                        >
                            <i class="bi bi-arrow-clockwise me-1"></i>Ganti soal
                        </button>
                    </div>

                    <div class="auth-captcha-panel mb-2">
                        <div class="small text-muted mb-2">
                            Ketik nama daerah berikut:
                        </div>
                        <div
                            class="auth-captcha-question fw-bold fs-5"
                            id="captchaQuestion"
                            aria-live="polite"
                         data-captcha-url="{{ route('captcha.generate') }}">
                            Memuat CAPTCHA...
                        </div>
                    </div>

                    <div class="auth-input-wrap">
                        <i class="bi bi-shield-check"></i>
                        <input
                            id="captcha_answer"
                            type="text"
                            name="captcha_answer"
                            class="form-control"
                            placeholder="Ketik nama daerah"
                            autocomplete="off"
                            required
                        >
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="remember"
                        value="1"
                        id="remember"
                    >
                    <label class="form-check-label text-muted" for="remember">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="auth-submit-btn">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Masuk ke Sistem
                </button>
            </form>

            <div class="text-center mt-4 pt-3 border-top">
                <span class="text-muted small">Belum memiliki akun?</span>
                <a href="{{ route('register') }}" class="auth-register-link ms-1">
                    Daftar sekarang
                </a>
            </div>
        </section>

<footer class="auth-premium-footer">
    &copy; {{ date('Y') }} <strong>AWLXDEV</strong>.
    All Rights Reserved.
    <div class="mt-1">Secure Recruitment Information System</div>
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

        if (!question || !answer) {
            return;
        }

        question.textContent = 'Memuat CAPTCHA...';

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
                throw new Error('Data CAPTCHA tidak valid');
            }

            question.textContent = data.question;
            answer.value = '';
        } catch (error) {
            question.textContent = 'CAPTCHA tidak tersedia. Muat ulang halaman.';
        }
    }

    const refreshCaptchaButton = document.getElementById('refreshCaptcha');

    if (refreshCaptchaButton) {
        refreshCaptchaButton.addEventListener('click', loadCaptcha);
    }

    loadCaptcha();
</script>
@endpush