<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAFTAR PELAMAR LULUS SELEKSI ADMINISTRASI</title>

    <style nonce="{{ Vite::cspNonce() }}">
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 28px;
            background: #f3f5f3;
            color: #26372f;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .print-toolbar {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            max-width: 1100px;
            margin: 0 auto 18px;
        }

        .print-button {
            border: 0;
            border-radius: 8px;
            padding: 11px 18px;
            background: #176448;
            color: white;
            font-weight: 700;
            cursor: pointer;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            border: 1px solid #dce5de;
            border-radius: 8px;
            padding: 11px 18px;
            background: white;
            color: #385446;
            text-decoration: none;
            font-weight: 700;
        }

        .document {
            max-width: 1100px;
            margin: 0 auto;
            padding: 38px;
            background: white;
            border: 1px solid #e5eae6;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(25, 55, 38, .06);
        }

        .document-header {
            padding-bottom: 22px;
            border-bottom: 3px solid #176448;
            text-align: center;
        }

        .document-brand {
            margin: 0 0 8px;
            color: #176448;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            color: #1d392b;
            font-size: 21px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .document-subtitle {
            margin-top: 9px;
            color: #758279;
            font-size: 11px;
        }

        .summary {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin: 24px 0 17px;
        }

        .summary-item {
            flex: 1;
            padding: 13px 15px;
            border: 1px solid #e5ece6;
            border-radius: 9px;
            background: #f8faf8;
        }

        .summary-label {
            display: block;
            margin-bottom: 5px;
            color: #7a887e;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .summary-value {
            color: #176448;
            font-size: 17px;
            font-weight: 800;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        thead {
            display: table-header-group;
        }

        th {
            padding: 12px 9px;
            border: 1px solid #dce6de;
            background: #176448;
            color: white;
            font-size: 10px;
            text-align: left;
        }

        td {
            padding: 11px 9px;
            border: 1px solid #e3e9e4;
            color: #34483b;
            font-size: 10px;
            vertical-align: top;
        }

        tbody tr:nth-child(even) {
            background: #f8faf8;
        }

        .text-center {
            text-align: center;
        }
        .applicant-photo {
            display: block;
            width: 52px;
            height: 64px;
            margin: 0 auto;
            object-fit: cover;
            border: 1px solid #dce6de;
            border-radius: 5px;
            background: #f8faf8;
        }

        .photo-placeholder {
            display: flex;
            width: 52px;
            height: 64px;
            margin: 0 auto;
            align-items: center;
            justify-content: center;
            border: 1px dashed #b9c8bd;
            border-radius: 5px;
            color: #7a887e;
            background: #f8faf8;
            font-size: 8px;
            text-align: center;
        }

        .signature-area {
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
            gap: 22px;
        }

        .signature {
            width: 175px;
            flex-shrink: 0;
            text-align: center;
            color: #34483b;
        }

        .signature-space {
            height: 65px;
        }

        .signature-qr {
            display: block;
            width: 86px;
            height: 86px;
            margin: 8px auto 5px;
            object-fit: contain;
        }

        .secretary-name {
            display: block;
            margin-top: 3px;
            color: #176448;
            font-size: 11px;
            font-weight: 800;
        }

        .empty-state {
            padding: 30px;
            color: #7a887e;
            text-align: center;
        }

        .document-footer {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            margin-top: 42px;
            color: #65746a;
            font-size: 10px;
        }

        .signature {
            width: 220px;
            text-align: center;
        }

        .signature-space {
            height: 65px;
        }

        @page {
            size: A4 landscape;
            margin: 12mm;
        }

        @media print {
            body {
                padding: 0;
                background: white;
            .applicant-photo,
            .photo-placeholder,
            .signature-qr {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .signature-area {
                break-inside: avoid;
                page-break-inside: avoid;
            }
            }

            .print-toolbar {
                display: none !important;
            }

            .document {
                max-width: none;
                padding: 0;
                border: 0;
                border-radius: 0;
                box-shadow: none;
            }

            .summary-item {
                background: white;
            }

            tr {
                page-break-inside: avoid;
            }
        }

        @media screen and (max-width: 700px) {
            body {
                padding: 10px;
            }

            .document {
                padding: 18px;
            }

            .summary {
                flex-direction: column;
            }

            .table-wrap {
                overflow-x: auto;
            }

            table {
                min-width: 750px;
            }
        }
    </style>
</head>

<body>

    <div class="print-toolbar">
        <a href="{{ route(request()->routeIs('admin.*') ? 'admin.selection.index' : 'hrd.selection.index') }}" class="back-button">
            Kembali
        </a>

        <button type="button" class="print-button" data-print>
            Cetak / Simpan PDF
        </button>
    </div>

    <main class="document">

        <header class="document-header">
            <p class="document-brand">
                Sistem Informasi Manajemen Rekrutmen
            </p>

            <h1>Daftar Pelamar Lulus Seleksi Administrasi</h1>

            <div class="document-subtitle">
                Dokumen daftar pelamar dengan status diterima pada seleksi administrasi
            </div>
        </header>

        <section class="summary">


            <div class="summary-item">
                <span class="summary-label">Status Seleksi</span>
                <span class="summary-value">Diterima</span>
            </div>

            <div class="summary-item">
                <span class="summary-label">Tanggal Cetak</span>
                <span class="summary-value" style="font-size: 13px;">
                    {{ $printedAt->format('d/m/Y H:i') }}
                </span>
            </div>
        </section>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th class="text-center" style="width: 38px;">No.</th>
                        <th style="width: 145px;">Nomor Lamaran</th>
                        <th>Nama Pelamar</th>
                        <th style="width: 135px;">NIK</th>
                        <th class="text-center" style="width: 75px;">Foto Pelamar</th>
                        <th>Posisi yang Dilamar</th>
                        <th style="width: 115px;">Tanggal Pengajuan</th>
                        <th style="width: 85px;">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($applications as $index => $application)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>

                            <td>
                                {{ $application->application_number ?? '-' }}
                            </td>

                            <td>
                                <strong>
                                    {{ $application->applicant->full_name ?? '-' }}
                                </strong>
                            </td>

                            <td>
                                {{ $application->applicant->nik ?? '-' }}
                            </td>

                            <td class="text-center">
                                @php($applicantPhoto = $photoData[$application->id] ?? null)
                                @if($applicantPhoto)
                                    <img
                                        src="{{ $applicantPhoto }}"
                                        alt="Foto {{ $application->applicant->full_name ?? 'Pelamar' }}"
                                        class="applicant-photo"
                                    >
                                @else
                                    <div class="photo-placeholder">
                                        Foto<br>tidak ada
                                    </div>
                                @endif
                            </td>

                            <td>
                                {{ $application->vacancy->title ?? '-' }}
                            </td>

                            <td>
                                {{ $application->submitted_at
                                    ? \Illuminate\Support\Carbon::parse($application->submitted_at)->format('d/m/Y')
                                    : '-' }}
                            </td>

                            <td>
                                DITERIMA
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-state">
                                Belum terdapat pelamar yang lulus seleksi administrasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <footer class="document-footer">
            <div>
                Dokumen ini dihasilkan oleh sistem rekrutmen.
                <br>
                Dicetak pada {{ $printedAt->format('d/m/Y H:i:s') }}.
            </div>

            <div class="signature">
                Mengetahui,<br>
                HRD
                <img
                    src="{{ asset('images/qr-sri-wahyuli.png') }}"
                    alt="QR tanda tangan Sri Wahyuli"
                    class="signature-qr"
                >
                <strong class="secretary-name">Sri Wahyuli</strong>
            </div>
        </footer>

    </main>

</body>
</html>
