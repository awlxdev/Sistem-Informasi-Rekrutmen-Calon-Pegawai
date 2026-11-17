
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $downloadFileName }}</title>

    <style>
        :root {
            --emerald: #193c30;
            --emerald-dark: #103126;
            --green: #39745d;
            --gold: #b99a62;
            --ivory: #faf9f5;
            --text: #28372f;
            --muted: #718078;
            --border: #e2e8df;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 25px;
            background: #edf0eb;
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 1.55;
        }

        /* TOOLBAR */

        .toolbar {
            max-width: 850px;
            margin: 0 auto 18px;
            display: flex;
            justify-content: space-between;
            gap: 12px;
        }

        .toolbar a,
        .toolbar button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 10px 18px;
            border: 0;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .back {
            background: #fff;
            color: var(--emerald);
            border: 1px solid var(--border) !important;
        }

        .print {
            background: var(--emerald);
            color: #fff;
        }

        /* KERTAS A4 */

        .paper {
            position: relative;
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 19mm 22mm 22mm;
            background: #fff;
            box-shadow: 0 12px 40px rgba(20, 45, 32, .12);
            overflow: hidden;
        }

        .top-line {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 7px;
            background: linear-gradient(
                90deg,
                var(--emerald-dark),
                var(--green),
                var(--gold)
            );
        }

        /* KOP SURAT */

        .document-header {
            text-align: center;
            padding-bottom: 14px;
            border-bottom: 2px solid var(--gold);
        }

        .brand {
            margin: 0 0 4px;
            color: var(--emerald);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        .brand-subtitle {
            margin: 0;
            color: var(--muted);
            font-size: 9px;
            letter-spacing: .8px;
        }

        /* JUDUL */

        .document-title {
            margin: 24px 0 5px;
            color: var(--emerald);
            font-size: 20px;
            font-weight: 800;
            letter-spacing: .4px;
            text-align: center;
            text-transform: uppercase;
        }

        .document-subtitle {
            margin: 0;
            color: var(--muted);
            font-size: 10px;
            text-align: center;
        }

        .document-number {
            margin: 16px 0 19px;
            text-align: center;
            font-size: 11px;
        }

        .document-number strong {
            color: var(--emerald);
        }

        /* PEMBUKAAN */

        .opening {
            margin: 0 0 12px;
            text-align: justify;
        }

        /* FOTO PELAMAR */

        .photo-area {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 13px 0 16px;
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
            break-inside: avoid;
        }

        .photo {
            width: 72px;
            height: 88px;
            flex-shrink: 0;
            object-fit: cover;
            border: 2px solid var(--gold);
            border-radius: 4px;
        }

        .photo-placeholder {
            width: 72px;
            height: 88px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--ivory);
            border: 1px solid var(--border);
            color: var(--muted);
            font-size: 9px;
            text-align: center;
        }

        .photo-info {
            color: var(--muted);
            font-size: 10px;
        }

        .photo-info strong {
            display: block;
            margin-bottom: 4px;
            color: var(--emerald);
            font-size: 12px;
        }

        /* IDENTITAS PELAMAR */

        .identity {
            width: 100%;
            margin: 12px 0 15px;
            border-collapse: collapse;
            font-size: 11px;
        }

        .identity tr {
            break-inside: avoid;
        }

        .identity td {
            padding: 5px 4px;
            vertical-align: top;
            border-bottom: 1px solid #edf0eb;
        }

        .identity td:first-child {
            width: 165px;
            color: var(--muted);
        }

        .identity td:nth-child(2) {
            width: 15px;
            text-align: center;
        }

        .identity td:last-child {
            color: var(--emerald);
            font-weight: 700;
        }

        /* KEPUTUSAN */

        .decision {
            margin: 16px 0;
            padding: 13px 17px;
            border: 1px solid #dce8dc;
            border-left: 4px solid var(--green);
            border-radius: 7px;
            background: #f6faf6;
            text-align: justify;
            font-size: 11px;
            break-inside: avoid;
        }

        .decision strong {
            color: var(--emerald);
        }

        /* PENUTUP */

        .closing {
            margin: 15px 0 0;
            text-align: justify;
            font-size: 11px;
        }

        /* TANDA TANGAN HRD */

        .signature-area {
            display: flex;
            justify-content: flex-end;
            margin-top: 18px;
            break-inside: avoid;
        }

        .signature {
            width: 190px;
            text-align: center;
            color: var(--text);
            font-size: 10px;
        }

        .signature-date {
            margin-bottom: 5px;
            line-height: 1.5;
        }

        .signature-qr {
            display: block;
            width: 76px;
            height: 76px;
            margin: 5px auto 5px;
            object-fit: contain;
        }

        .signature strong {
            display: block;
            padding-top: 5px;
            color: var(--emerald);
            border-top: 1px solid var(--emerald);
            font-size: 11px;
        }

        .signature span {
            display: block;
            margin-top: 2px;
            color: var(--muted);
            font-size: 9px;
        }

        /* FOOTER */

        .footer {
            position: absolute;
            right: 22mm;
            bottom: 10mm;
            left: 22mm;
            padding-top: 7px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 8px;
            line-height: 1.5;
            text-align: center;
        }

        /* CETAK PDF */

        @page {
            size: A4 portrait;
            margin: 0;
        }

        @media print {
            html,
            body {
                width: 210mm;
                margin: 0;
                padding: 0;
                background: #fff;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .toolbar {
                display: none !important;
            }

            .paper {
                width: 210mm;
                min-height: 297mm;
                margin: 0;
                box-shadow: none;
                page-break-after: avoid;
                break-after: avoid;
            }
        }

        /* TAMPILAN LAYAR KECIL */

        @media screen and (max-width: 800px) {
            body {
                padding: 10px;
            }

            .paper {
                width: 100%;
                min-height: 0;
                padding: 35px 22px 90px;
            }

            .toolbar {
                flex-wrap: wrap;
            }

            .toolbar a,
            .toolbar button {
                flex: 1;
            }

            .identity td:first-child {
                width: 115px;
            }

            .footer {
                right: 22px;
                left: 22px;
            }
        }
    </style>
</head>

<body>

    <div class="toolbar">
        <a class="back"
            href="{{ route($routePrefix.'.applications.show', $application) }}">
            Kembali ke Detail Lamaran
        </a>

        <button class="print" type="button" onclick="window.print()">
            Cetak / Simpan PDF
        </button>
    </div>

    <main class="paper">

        <div class="top-line"></div>

        <!-- KOP SURAT -->

        <header class="document-header">
            <p class="brand">Sistem Informasi Manajemen Rekrutmen</p>
            <p class="brand-subtitle">
                Dokumen Resmi Hasil Seleksi Administrasi
            </p>
        </header>

        <!-- JUDUL SURAT -->

        <h1 class="document-title">
            Surat Keterangan Kelulusan
        </h1>

        <p class="document-subtitle">
            Seleksi Administrasi Penerimaan Calon Pegawai
        </p>

        <div class="document-number">
            Nomor Lamaran:
            <strong>
                {{ $application->application_number ?? '-' }}
            </strong>
        </div>

        <!-- PEMBUKAAN -->

        <p class="opening">
            Berdasarkan hasil pemeriksaan dan verifikasi administrasi
            terhadap berkas pendaftaran calon pegawai, dengan ini
            diterangkan bahwa:
        </p>

        <!-- FOTO DAN NAMA PELAMAR -->

        <div class="photo-area">
            @if($photoData)
                <img
                    class="photo"
                    src="{{ $photoData }}"
                    alt="Foto {{ $application->applicant->full_name ?? 'Pelamar' }}"
                >
            @else
                <div class="photo-placeholder">
                    Foto<br>tidak tersedia
                </div>
            @endif

            <div class="photo-info">
                <strong>
                    {{ $application->applicant->full_name ?? '-' }}
                </strong>
                Peserta seleksi administrasi calon pegawai.
            </div>
        </div>

        <!-- IDENTITAS PELAMAR -->

        <table class="identity">
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td>
                    {{ $application->applicant->full_name ?? '-' }}
                </td>
            </tr>

            <tr>
                <td>Nomor Induk Kependudukan</td>
                <td>:</td>
                <td>
                    {{ $application->applicant->nik ?? '-' }}
                </td>
            </tr>

            <tr>
                <td>Nomor Lamaran</td>
                <td>:</td>
                <td>
                    {{ $application->application_number ?? '-' }}
                </td>
            </tr>

            <tr>
                <td>Posisi yang Dilamar</td>
                <td>:</td>
                <td>
                    {{ $application->vacancy->title ?? '-' }}
                </td>
            </tr>

            <tr>
                <td>Tanggal Pendaftaran</td>
                <td>:</td>
                <td>
                    {{ $application->submitted_at
                        ? $application->submitted_at->format('d F Y')
                        : '-' }}
                </td>
            </tr>

            <tr>
                <td>Status Seleksi</td>
                <td>:</td>
                <td>DITERIMA / LULUS</td>
            </tr>
        </table>

        <!-- KEPUTUSAN KELULUSAN -->

        <div class="decision">
            Berdasarkan hasil seleksi administrasi, nama tersebut di atas
            dinyatakan <strong>LULUS SELEKSI ADMINISTRASI</strong> untuk
            posisi yang dilamar. Selanjutnya, peserta dapat mengikuti
            tahapan seleksi berikutnya sesuai dengan ketentuan dan jadwal
            yang ditetapkan oleh pihak penyelenggara rekrutmen.
        </div>

        <!-- PENUTUP -->

        <p class="closing">
            Demikian surat keterangan ini diterbitkan sebagai bukti
            hasil seleksi administrasi. Surat ini dihasilkan melalui
            Sistem Informasi Manajemen Rekrutmen.
        </p>

        <!-- TANDA TANGAN HRD DENGAN QR -->

        <div class="signature-area">
            <div class="signature">

                <div class="signature-date">
                    Dicetak pada
                    <br>
                    {{ $printedAt->translatedFormat('d F Y') }}
                </div>

                <img
                    class="signature-qr"
                    src="{{ asset('images/qr-sri-wahyuli.png') }}"
                    alt="QR Code tanda tangan HRD"
                >

                <strong>HRD</strong>

                <span>Bagian Sumber Daya Manusia</span>

            </div>
        </div>

        <!-- FOOTER -->

        <footer class="footer">
            Dokumen elektronik yang diterbitkan oleh Sistem Informasi
            Manajemen Rekrutmen.
            <br>
            Nomor lamaran:
            {{ $application->application_number ?? '-' }}
            | Waktu cetak:
            {{ $printedAt->format('d/m/Y H:i:s') }}
        </footer>

    </main>

</body>
</html>
