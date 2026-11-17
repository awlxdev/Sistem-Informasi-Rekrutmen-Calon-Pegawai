<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal resmi Pendaftaran Calon Pegawai. Daftar, lengkapi biodata, dan ikuti proses rekrutmen secara online.">

    <title>Portal Pendaftaran Calon Pegawai</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #164438;
            --primary-dark: #10362d;
            --primary-soft: #eaf2ee;
            --accent: #b99a62;
            --accent-soft: #f7f3e9;
            --ivory: #f7f8f6;
            --surface: #ffffff;
            --border: #e7ebe7;
            --text: #26342e;
            --muted: #7b8780;
            --font-body: "DM Sans", sans-serif;
            --font-display: "Playfair Display", serif;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: var(--ivory);
            color: var(--text);
            font-family: var(--font-body);
            -webkit-font-smoothing: antialiased;
        }

        a {
            text-decoration: none;
        }

        .navbar-main {
            min-height: 78px;
            background: rgba(255,255,255,.96);
            border-bottom: 1px solid var(--border);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--primary);
            font-size: 15px;
            font-weight: 800;
            letter-spacing: .4px;
        }

        .brand-mark {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            color: #fff;
            background: var(--primary);
            font-size: 20px;
            box-shadow: 0 5px 12px rgba(22,68,56,.15);
        }

        .brand small {
            display: block;
            margin-top: 2px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 1.5px;
        }

        .nav-link-custom {
            color: #58655e;
            font-size: 13px;
            font-weight: 600;
            transition: color .2s ease;
        }

        .nav-link-custom:hover {
            color: var(--primary);
        }

        .btn-primary-custom {
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
            transition: .2s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #fff;
            box-shadow: 0 8px 18px rgba(22,68,56,.16);
        }

        .btn-outline-custom {
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
            transition: .2s ease;
        }

        .btn-outline-custom:hover {
            border-color: var(--primary);
            background: var(--primary-soft);
            color: var(--primary);
        }

        .hero {
            position: relative;
            overflow: hidden;
            padding: 95px 0 90px;
            background:
                radial-gradient(circle at 85% 15%, rgba(185,154,98,.15), transparent 26%),
                linear-gradient(135deg, #f7f8f6 0%, #eef3ef 100%);
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 430px;
            height: 430px;
            right: -170px;
            bottom: -260px;
            border: 1px solid rgba(22,68,56,.09);
            border-radius: 50%;
            box-shadow: 0 0 0 35px rgba(22,68,56,.025),
                        0 0 0 75px rgba(22,68,56,.02);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 8px 13px;
            border: 1px solid #dce8e0;
            border-radius: 50px;
            background: #fff;
            color: var(--primary);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .eyebrow span {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--accent);
        }

        .hero h1 {
            max-width: 720px;
            margin: 25px 0 20px;
            color: var(--primary-dark);
            font-family: var(--font-display);
            font-size: clamp(37px, 5.5vw, 64px);
            font-weight: 700;
            line-height: 1.15;
            letter-spacing: -.8px;
        }

        .hero h1 em {
            color: var(--accent);
            font-weight: 600;
        }

        .hero-description {
            max-width: 590px;
            color: #6d7a72;
            font-size: 15px;
            line-height: 1.9;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 30px;
        }

        .hero-note {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 30px;
            color: var(--muted);
            font-size: 11px;
        }

        .hero-note i {
            color: var(--primary);
            font-size: 16px;
        }

        .visual-panel {
            position: relative;
            min-height: 355px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .visual-main {
            position: relative;
            width: min(100%, 390px);
            padding: 35px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.8);
            border-radius: 25px;
            background: linear-gradient(145deg, #ffffff, #edf3ef);
            box-shadow: 0 25px 65px rgba(22,68,56,.12);
            transform: rotate(2deg);
        }

        .visual-main::after {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            right: -75px;
            top: -75px;
            border-radius: 50%;
            background: rgba(185,154,98,.13);
        }

        .visual-icon {
            position: relative;
            z-index: 1;
            width: 82px;
            height: 82px;
            display: grid;
            place-items: center;
            margin-bottom: 28px;
            border-radius: 23px;
            background: var(--primary);
            color: #fff;
            font-size: 35px;
            box-shadow: 0 12px 25px rgba(22,68,56,.2);
        }

        .visual-main h3 {
            position: relative;
            z-index: 1;
            color: var(--primary);
            font-family: var(--font-display);
            font-size: 27px;
            font-weight: 700;
        }

        .visual-main p {
            position: relative;
            z-index: 1;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
        }

        .visual-tag {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: 15px;
            padding: 9px 13px;
            border-radius: 9px;
            background: var(--accent-soft);
            color: #8b7042;
            font-size: 10px;
            font-weight: 800;
        }

        .section {
            padding: 78px 0;
        }

        .section-heading {
            max-width: 620px;
            margin: 0 auto 42px;
            text-align: center;
        }

        .section-label {
            color: var(--accent);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .section-heading h2 {
            margin: 12px 0;
            color: var(--primary-dark);
            font-family: var(--font-display);
            font-size: clamp(28px, 4vw, 39px);
            font-weight: 700;
        }

        .section-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .feature-card {
            height: 100%;
            padding: 27px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 5px 20px rgba(24,39,36,.025);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 30px rgba(24,39,36,.07);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            margin-bottom: 20px;
            border-radius: 14px;
            background: var(--primary-soft);
            color: var(--primary);
            font-size: 21px;
        }

        .feature-card h3 {
            margin-bottom: 9px;
            color: var(--text);
            font-size: 15px;
            font-weight: 800;
        }

        .feature-card p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
        }

        .steps-section {
            background: #fff;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .step-card {
            position: relative;
            height: 100%;
            padding: 25px;
            border: 1px solid var(--border);
            border-radius: 15px;
            background: var(--ivory);
        }

        .step-number {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            margin-bottom: 17px;
            border-radius: 11px;
            background: var(--primary);
            color: #fff;
            font-size: 13px;
            font-weight: 800;
        }

        .step-card h3 {
            color: var(--primary);
            font-size: 14px;
            font-weight: 800;
        }

        .step-card p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
        }

        .cta-panel {
            position: relative;
            overflow: hidden;
            padding: 48px;
            border-radius: 22px;
            background:
                radial-gradient(circle at 90% 0%, rgba(185,154,98,.2), transparent 30%),
                linear-gradient(120deg, #10362d, #164438);
            color: #fff;
            box-shadow: 0 15px 35px rgba(16,54,45,.12);
        }

        .cta-panel h2 {
            max-width: 600px;
            font-family: var(--font-display);
            font-size: clamp(27px, 4vw, 38px);
            font-weight: 700;
        }

        .cta-panel p {
            max-width: 570px;
            color: rgba(255,255,255,.72);
            font-size: 13px;
            line-height: 1.8;
        }

        .cta-panel .btn-light {
            padding: 12px 20px;
            border-radius: 10px;
            color: var(--primary);
            font-size: 13px;
            font-weight: 800;
        }

        .footer {
            padding: 30px 0;
            border-top: 1px solid var(--border);
            background: #fff;
        }

        .footer-brand {
            color: var(--primary);
            font-size: 13px;
            font-weight: 800;
        }

        .footer p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 11px;
        }

        .footer-copy {
            color: var(--muted);
            font-size: 11px;
        }

        @media (max-width: 767px) {
            .hero {
                padding: 65px 0 55px;
            }

            .visual-panel {
                min-height: 300px;
                margin-top: 25px;
            }

            .visual-main {
                padding: 27px;
            }

            .section {
                padding: 60px 0;
            }

            .cta-panel {
                padding: 30px 23px;
            }

            .hero-actions > a {
                width: 100%;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
                animation-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>

@include('components.public-navbar')

<main>
    <section class="hero" id="beranda">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <div class="hero-content">
                        <div class="eyebrow">
                            <span></span>
                            SISTEM PENDAFTARAN ONLINE
                        </div>

                        <h1>
                            Awali Langkah Karier Anda dengan <em>Kesempatan Baru.</em>
                        </h1>

                        <p class="hero-description">
                            Selamat datang di Portal Pendaftaran Calon Pegawai.
                            Lengkapi data diri, siapkan dokumen persyaratan, dan
                            ikuti proses pendaftaran secara online melalui satu
                            sistem yang terintegrasi.
                        </p>

                        <div class="hero-actions">
                            <a href="{{ route('register') }}" class="btn-primary-custom">
                                Mulai Pendaftaran
                                <i class="bi bi-arrow-right"></i>
                            </a>

                            <a href="{{ route('login') }}" class="btn-outline-custom">
                                <i class="bi bi-person-circle"></i>
                                Sudah Punya Akun?
                            </a>
                        </div>

                        <div class="hero-note">
                            <i class="bi bi-shield-check"></i>
                            <span>Proses pendaftaran dilakukan melalui portal online.</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="visual-panel">
                        <div class="visual-main">
                            <div class="visual-icon">
                                <i class="bi bi-person-workspace"></i>
                            </div>

                            <h3>Bangun Masa Depan Anda</h3>

                            <p>
                                Satu portal untuk mengelola pendaftaran,
                                informasi pribadi, dan dokumen pendukung
                                dalam proses rekrutmen.
                            </p>

                            <div class="visual-tag">
                                <i class="bi bi-patch-check-fill"></i>
                                PORTAL PELAMAR
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="keunggulan">
        <div class="container">
            <div class="section-heading">
                <div class="section-label">LAYANAN PORTAL</div>
                <h2>Pendaftaran Lebih Terstruktur</h2>
                <p>
                    Kelola kebutuhan administrasi pendaftaran melalui
                    sistem yang dirancang sederhana, jelas, dan mudah digunakan.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-person-vcard"></i>
                        </div>
                        <h3>Profil Pelamar</h3>
                        <p>
                            Lengkapi identitas, informasi kontak, alamat,
                            serta riwayat pendidikan dalam satu halaman profil.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-folder-check"></i>
                        </div>
                        <h3>Dokumen Digital</h3>
                        <p>
                            Unggah foto dan CV sebagai dokumen pendukung
                            pendaftaran melalui formulir online.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-clipboard2-check"></i>
                        </div>
                        <h3>Informasi Pendaftaran</h3>
                        <p>
                            Gunakan akun pelamar untuk mengakses halaman
                            dan informasi yang tersedia sesuai hak akses.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section steps-section" id="alur">
        <div class="container">
            <div class="section-heading">
                <div class="section-label">LANGKAH PENDAFTARAN</div>
                <h2>Mulai dengan Empat Langkah</h2>
                <p>
                    Ikuti tahapan berikut untuk memulai proses pendaftaran
                    sebagai calon pegawai.
                </p>
            </div>

            <div class="row g-3">
                <div class="col-md-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-number">01</div>
                        <h3>Buat Akun</h3>
                        <p>
                            Daftarkan akun menggunakan nama, email,
                            dan kata sandi.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-number">02</div>
                        <h3>Verifikasi Email</h3>
                        <p>
                            Selesaikan verifikasi alamat email
                            sesuai petunjuk sistem.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-number">03</div>
                        <h3>Lengkapi Biodata</h3>
                        <p>
                            Isi identitas, informasi kontak,
                            pendidikan, dan dokumen pendukung.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-number">04</div>
                        <h3>Ikuti Proses</h3>
                        <p>
                            Pantau informasi dan tahapan
                            pendaftaran melalui akun Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="cta-panel">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <div class="section-label mb-3">LANGKAH PERTAMA ANDA</div>
                        <h2>Siap Memulai Proses Pendaftaran?</h2>
                        <p class="mt-3 mb-0">
                            Buat akun sekarang dan lengkapi informasi
                            diri Anda melalui Portal Pendaftaran Calon Pegawai.
                        </p>
                    </div>

                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('register') }}" class="btn btn-light">
                            Daftar Akun
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="footer">
    <div class="container">
        <div class="row align-items-center g-3">
            <div class="col-md-7">
                <div class="footer-brand">
                    <i class="bi bi-buildings me-2"></i>
                    PORTAL PENDAFTARAN CALON PEGAWAI
                </div>
                <p>Sistem informasi pendaftaran calon pegawai berbasis online.</p>
            </div>

            <div class="col-md-5 text-md-end">
                <{{-- FOOTER --}}
<footer class="admin-footer">
    <span>Sistem Pendaftaran Calon Pegawai</span>
    <span>Administrator Control Center</span>
    <span>
        &copy; {{ date('Y') }} <strong>AWLXDEV</strong>.
        All Rights Reserved.
    </span>
</footer>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>