@extends('layouts.app')

@section('title', 'Verifikasi Email')

@section('content')
<main class="container py-5">
    <div class="row min-vh-75 align-items-center justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <section class="auth-card p-4 p-md-5 text-center">

                <div class="brand-mark mx-auto mb-4">
                    <i class="bi bi-envelope-check"></i>
                </div>

                <h1 class="h4 fw-bold text-primary-custom mb-2">
                    Verifikasi Email
                </h1>

                <p class="text-muted mb-4">
                    Satu langkah lagi untuk menyelesaikan aktivasi akun Anda.
                </p>

                @if(session('success'))
                    <div class="alert alert-success text-start" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('warning'))
                    <div class="alert alert-warning text-start" role="alert">
                        {{ session('warning') }}
                    </div>
                @endif

                @if(session('status') === 'verification-link-sent')
                    <div class="alert alert-success text-start" role="alert">
                        Tautan verifikasi baru telah dikirim.
                    </div>
                @endif

                <div class="text-start p-3 rounded-3 mb-4"
                     style="background: var(--primary-soft); border: 1px solid var(--border);">
                    <div class="fw-semibold text-primary-custom mb-2">
                        <i class="bi bi-info-circle me-2"></i>Periksa email Anda
                    </div>
                    <p class="text-muted mb-0">
                        Kami telah mengirim tautan verifikasi ke alamat email
                        yang Anda gunakan saat mendaftar. Klik tautan tersebut
                        untuk menyelesaikan verifikasi.
                    </p>
                </div>

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button type="submit" class="btn btn-primary-custom w-100">
                        <i class="bi bi-envelope-arrow-up me-2"></i>
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <p class="text-muted small mt-3 mb-4">
                    Belum menerima email? Periksa folder Spam atau Junk.
                </p>

                <hr class="divider-soft">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-box-arrow-left me-2"></i>
                        Keluar dari Akun
                    </button>
                </form>

            </section>

<footer class="text-center text-muted small mt-4">
    &copy; {{ date('Y') }} <strong>AWLXDEV</strong>.
    All Rights Reserved.
    <br>
    Developed by AWLXDEV
</footer>
        </div>
    </div>
</main>
@endsection