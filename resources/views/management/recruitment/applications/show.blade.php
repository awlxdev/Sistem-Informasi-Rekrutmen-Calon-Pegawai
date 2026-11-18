@extends('layouts.app')

@push('styles')
<style nonce="{{ Vite::cspNonce() }}">
    :is(.admin-application-detail-page, .hrd-application-detail-page) {
        --detail-emerald: #193c30;
        --detail-dark: #10362b;
        --detail-green: #39745d;
        --detail-gold: #b99a62;
        width: 100%;
        max-width: 100%;
        margin-inline: auto;
        color: #26372f;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .detail-heading {
        margin-bottom: 26px;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .detail-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        min-height: 39px;
        padding: 8px 14px;
        border: 1px solid #e1e8e1;
        border-radius: 10px;
        background: #fff;
        color: #52685b;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s ease;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .detail-back:hover {
        border-color: var(--detail-gold);
        color: var(--detail-emerald);
        transform: translateX(-2px);
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .detail-eyebrow {
        margin-bottom: 7px;
        color: var(--detail-green);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .detail-number {
        overflow-wrap: anywhere;
        color: var(--detail-emerald);
        font-size: clamp(22px, 3vw, 29px);
        font-weight: 800;
        letter-spacing: -.5px;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .detail-description {
        color: #7b8780;
        font-size: 13px;
        line-height: 1.7;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .card {
        overflow: hidden;
        border: 1px solid #e8ece6 !important;
        border-radius: 17px !important;
        background: #fff;
        box-shadow: 0 8px 25px rgba(25, 60, 48, .055),
                    0 2px 6px rgba(25, 60, 48, .025) !important;
        transition: box-shadow .2s ease, transform .2s ease;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .card:hover {
        box-shadow: 0 12px 30px rgba(25, 60, 48, .075),
                    0 3px 8px rgba(25, 60, 48, .03) !important;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .card-body {
        padding: clamp(18px, 2.5vw, 25px) !important;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) h5,
    :is(.admin-application-detail-page, .hrd-application-detail-page) h6 {
        color: var(--detail-emerald);
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .card-body > h5 {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 20px !important;
        font-size: 15px;
        font-weight: 800;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .card-body > h5 i {
        color: var(--detail-green) !important;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .text-muted {
        color: #849087 !important;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .row.g-3 > div > small {
        margin-bottom: 5px;
        font-size: 11px;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .row.g-3 > div > strong,
    :is(.admin-application-detail-page, .hrd-application-detail-page) .card-body > strong {
        display: inline-block;
        color: #34483c;
        font-size: 13px;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .badge {
        padding: 8px 13px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 750;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .border.rounded-3.p-3 {
        border-color: #e5ebe4 !important;
        border-radius: 13px !important;
        background: #fbfcfa;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .border-top {
        border-color: #e8ece6 !important;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) hr {
        margin: 17px 0;
        border-color: #e8ece6;
        opacity: 1;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .form-label {
        color: #43564b;
        font-size: 11px;
        font-weight: 750 !important;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .form-control,
    :is(.admin-application-detail-page, .hrd-application-detail-page) .form-select {
        min-height: 41px;
        border: 1px solid #dfe7df;
        border-radius: 10px;
        color: #26372f;
        font-size: 12px;
        box-shadow: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) textarea.form-control {
        min-height: 115px;
        line-height: 1.7;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .form-control:focus,
    :is(.admin-application-detail-page, .hrd-application-detail-page) .form-select:focus {
        border-color: var(--detail-gold);
        box-shadow: 0 0 0 4px rgba(185, 154, 98, .13);
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .btn {
        min-height: 37px;
        padding: 8px 13px;
        border-radius: 9px !important;
        font-size: 11px;
        font-weight: 700;
        transition: .2s ease;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .btn-success {
        border-color: var(--detail-emerald);
        background: linear-gradient(135deg, #286448, #193c30);
        color: #fff;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .btn-success:hover {
        border-color: var(--detail-dark);
        background: var(--detail-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .btn-outline-success {
        border-color: #b8cbbd;
        color: var(--detail-green);
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .btn-outline-success:hover {
        border-color: var(--detail-emerald);
        background: var(--detail-emerald);
        color: #fff;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .alert {
        border-radius: 12px;
        font-size: 12px;
        line-height: 1.7;
    }

    :is(.admin-application-detail-page, .hrd-application-detail-page) .text-break {
        color: #43564b;
        font-size: 12px;
        line-height: 1.8;
        overflow-wrap: anywhere;
    }

    @media (max-width: 767.98px) {
        :is(.admin-application-detail-page, .hrd-application-detail-page) {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        :is(.admin-application-detail-page, .hrd-application-detail-page) .detail-heading {
            margin-bottom: 20px;
        }

        :is(.admin-application-detail-page, .hrd-application-detail-page) .card {
            border-radius: 14px !important;
        }

        :is(.admin-application-detail-page, .hrd-application-detail-page) .card-body {
            padding: 17px !important;
        }

        :is(.admin-application-detail-page, .hrd-application-detail-page) .detail-number {
            font-size: 22px;
        }

        :is(.admin-application-detail-page, .hrd-application-detail-page) .badge {
            font-size: 9px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        :is(.admin-application-detail-page, .hrd-application-detail-page) *,
        :is(.admin-application-detail-page, .hrd-application-detail-page) *::before,
        :is(.admin-application-detail-page, .hrd-application-detail-page) *::after {
            transition: none !important;
        }
    }
</style>
@endpush

@section('content')
@php
    $statusLabels = [
        'submitted' => 'Menunggu Pemeriksaan',
        'reviewing' => 'Sedang Ditinjau',
        'accepted' => 'Diterima',
        'rejected' => 'Ditolak',
    ];
    $statusColors = [
        'submitted' => 'warning',
        'reviewing' => 'info',
        'accepted' => 'success',
        'rejected' => 'danger',
    ];
    $documentLabels = [
        'pending' => 'Menunggu Verifikasi',
        'verified' => 'Terverifikasi',
        'rejected' => 'Ditolak',
    ];
@endphp

<div class="container-fluid py-4 px-3 px-lg-4 {{ $routePrefix === 'admin' ? 'admin-application-detail-page' : 'hrd-application-detail-page' }}">

    <div class="mb-4">
        <a href="{{ route($routePrefix.'.applications.index') }}" class="btn btn-light border rounded-3 mb-3 detail-back">
            <i class="bi bi-arrow-left me-1"></i>Kembali ke Data Lamaran
        </a>
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div>
                <div class="small text-uppercase text-success fw-semibold mb-1">Detail Pendaftaran</div>
                <h3 class="fw-bold mb-1">{{ $application->application_number }}</h3>
                <p class="text-muted mb-0">Informasi pelamar, lowongan, dan dokumen persyaratan.</p>
            </div>
            <span class="badge rounded-pill text-bg-{{ $statusColors[$application->status] ?? 'secondary' }} fs-6 px-3 py-2">
                {{ $statusLabels[$application->status] ?? ucfirst($application->status) }}
            </span>

            @if($application->status === 'accepted')
                <a href="{{ route($routePrefix.'.applications.acceptance-print', $application) }}"
                    target="_blank"
                    rel="noopener"
                    class="btn btn-success rounded-3 shadow-sm">
                    <i class="bi bi-file-earmark-pdf me-1"></i>
                    Cetak Bukti Lulus Seleksi
                </a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger rounded-3">
            <strong>Periksa kembali isian:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-person-vcard text-success me-2"></i>Informasi Pelamar</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Nama Lengkap</small>
                            <strong>{{ $application->applicant->full_name ?? '-' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">NIK</small>
                            <strong>{{ $application->applicant->nik ?? '-' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Nomor Telepon</small>
                            <strong>{{ $application->applicant->phone ?? '-' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Email Akun</small>
                            <strong>{{ $application->applicant->user->email ?? '-' }}</strong>
                        </div>
                        <div class="col-12">
                            <small class="text-muted d-block">Alamat</small>
                            <strong>{{ $application->applicant->address ?? '-' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Pendidikan</small>
                            <strong>{{ $application->applicant->education_level ?? '-' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Institusi / Jurusan</small>
                            <strong>{{ $application->applicant->institution ?? '-' }} / {{ $application->applicant->major ?? '-' }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-briefcase text-success me-2"></i>Informasi Lowongan</h5>
                    <h6 class="fw-bold">{{ $application->vacancy->title ?? '-' }}</h6>
                    <div class="text-muted small">
                        {{ $application->vacancy->department ?? '-' }} ·
                        {{ $application->vacancy->employment_type ?? '-' }} ·
                        {{ $application->vacancy->location ?? '-' }}
                    </div>
                    <hr>
                    <small class="text-muted d-block mb-1">Tanggal Pendaftaran</small>
                    <strong>{{ $application->submitted_at ? $application->submitted_at->format('d F Y, H:i') : '-' }}</strong>
                    <hr>
                    <small class="text-muted d-block mb-1">Surat Lamaran</small>
                    <div class="text-break">{{ $application->cover_letter ?: 'Tidak ada surat lamaran tambahan.' }}</div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-folder-check text-success me-2"></i>Dokumen Persyaratan</h5>

                    @forelse($application->documents as $document)
                        @php
                            $docColor = ['pending'=>'warning','verified'=>'success','rejected'=>'danger'][$document->verification_status] ?? 'secondary';
                        @endphp
                        <div class="border rounded-3 p-3 mb-3">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                <div>
                                    <div class="fw-semibold">{{ ucwords(str_replace('_', ' ', $document->document_type)) }}</div>
                                    <small class="text-muted">{{ $document->original_name }} · {{ number_format(($document->file_size ?? 0) / 1024, 1) }} KB</small>
                                </div>
                                <span class="badge text-bg-{{ $docColor }}">
                                    {{ $documentLabels[$document->verification_status] ?? ucfirst($document->verification_status) }}
                                </span>
                            </div>

                            <div class="mt-3 d-flex flex-wrap gap-2">
                                <a href="{{ route($routePrefix.'.applications.documents.download', [$application, $document]) }}"
                                    class="btn btn-sm btn-outline-success rounded-3">
                                    <i class="bi bi-download me-1"></i>Unduh Dokumen
                                </a>
                            </div>

                            @if($document->verification_notes)
                                <div class="small text-muted mt-2">Catatan: {{ $document->verification_notes }}</div>
                            @endif

                            @if($allowReview)
                                <form method="POST"
                                    action="{{ route('hrd.applications.documents.verify', [$application, $document]) }}"
                                    class="border-top mt-3 pt-3">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <label class="form-label small fw-semibold">Hasil Verifikasi</label>
                                            <select name="verification_status" class="form-select form-select-sm" required>
                                                <option value="pending" @selected($document->verification_status === 'pending')>Menunggu</option>
                                                <option value="verified" @selected($document->verification_status === 'verified')>Valid / Terverifikasi</option>
                                                <option value="rejected" @selected($document->verification_status === 'rejected')>Tidak Valid / Ditolak</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-semibold">Catatan Verifikasi</label>
                                            <input type="text" name="verification_notes" class="form-control form-control-sm"
                                                maxlength="3000" value="{{ $document->verification_notes }}"
                                                placeholder="Catatan untuk dokumen ini...">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button class="btn btn-success btn-sm w-100">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-file-earmark-x fs-2"></i>
                            <p class="mb-0 mt-2">Belum ada dokumen terlampir.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            @if($allowReview)
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-clipboard-check text-success me-2"></i>Keputusan Seleksi</h5>
                        <form method="POST" action="{{ route('hrd.applications.review', $application) }}">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Status Lamaran</label>
                                <select name="status" class="form-select" required>
                                    <option value="reviewing" @selected($application->status === 'reviewing')>Sedang Ditinjau</option>
                                    <option value="accepted" @selected($application->status === 'accepted')>Diterima</option>
                                    <option value="rejected" @selected($application->status === 'rejected')>Ditolak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Catatan HRD</label>
                                <textarea name="admin_notes" rows="5" maxlength="5000" class="form-control"
                                    placeholder="Tuliskan hasil pemeriksaan atau alasan keputusan...">{{ old('admin_notes', $application->admin_notes) }}</textarea>
                            </div>

                            <button class="btn btn-success w-100 rounded-3">
                                <i class="bi bi-save me-1"></i>Simpan Hasil Seleksi
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            @if($allowReview && in_array($application->status, ['reviewing', 'accepted'], true))
                @php
                    $activeInterview = $application->interviewSchedules
                        ->firstWhere('status', 'scheduled');

                    $interviewDateValue = $activeInterview
                        ? substr($activeInterview->getRawOriginal('scheduled_at'), 0, 16)
                        : '';
                @endphp

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-2">
                            <i class="bi bi-calendar2-check text-success me-2"></i>
                            Jadwalkan Interview
                        </h5>

                        <p class="text-muted small mb-3">
                            Atur jadwal wawancara pelamar. Seluruh waktu menggunakan WIT (Asia/Jayapura).
                        </p>

                        @if($activeInterview)
                            <div class="alert alert-info rounded-3 small">
                                <strong>Jadwal aktif saat ini</strong><br>
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $activeInterview->getRawOriginal('scheduled_at'), 'Asia/Jayapura')->format('d M Y, H:i') }} WIT
                                <br>
                                Metode: {{ $activeInterview->method === 'online' ? 'Online' : 'Tatap muka' }}
                            </div>
                        @endif

                        <form method="POST"
                              action="{{ route('hrd.applications.interviews.store', $application) }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tanggal dan Waktu (WIT)</label>
                                <input
                                    type="datetime-local"
                                    name="scheduled_at"
                                    class="form-control"
                                    value="{{ old('scheduled_at', $interviewDateValue) }}"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Metode Interview</label>
                                <select name="method" id="interviewMethod" class="form-select" required>
                                    <option value="offline" @selected(old('method', $activeInterview?->method) === 'offline')>
                                        Tatap muka / Offline
                                    </option>
                                    <option value="online" @selected(old('method', $activeInterview?->method) === 'online')>
                                        Online
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3" id="interviewLocationGroup">
                                <label class="form-label fw-semibold">Lokasi Interview</label>
                                <input
                                    type="text"
                                    name="location"
                                    class="form-control"
                                    maxlength="255"
                                    value="{{ old('location', $activeInterview?->location) }}"
                                    placeholder="Contoh: Ruang Rapat Kantor"
                                >
                            </div>

                            <div class="mb-3" id="interviewMeetingGroup">
                                <label class="form-label fw-semibold">Link Meeting</label>
                                <input
                                    type="url"
                                    name="meeting_url"
                                    class="form-control"
                                    maxlength="2048"
                                    value="{{ old('meeting_url', $activeInterview?->meeting_url) }}"
                                    placeholder="https://meet.google.com/..."
                                >
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Catatan untuk Pelamar</label>
                                <textarea
                                    name="notes"
                                    rows="3"
                                    maxlength="3000"
                                    class="form-control"
                                    placeholder="Tuliskan arahan atau persiapan interview..."
                                >{{ old('notes', $activeInterview?->notes) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success w-100 rounded-3">
                                <i class="bi bi-calendar-check me-1"></i>
                                {{ $activeInterview ? 'Perbarui Jadwal Interview' : 'Simpan Jadwal Interview' }}
                            </button>
                        </form>
                    </div>
                </div>
            @endif
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Riwayat Pemeriksaan</h6>
                    <small class="text-muted d-block">Terakhir diperiksa</small>
                    <strong>{{ $application->reviewed_at ? $application->reviewed_at->format('d/m/Y H:i') : 'Belum diperiksa' }}</strong>
                    <hr>
                    <small class="text-muted d-block">Petugas pemeriksa</small>
                    <strong>{{ $application->reviewer->name ?? '-' }}</strong>
                    <hr>
                    <small class="text-muted d-block">Catatan</small>
                    <div class="text-break">{{ $application->admin_notes ?: 'Belum ada catatan pemeriksaan.' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection