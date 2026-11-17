@extends('layouts.app')

@section('navbar')
    @include('components.pelamar-navbar')
@endsection

@section('title', 'Status Lamaran')

@section('content')
<main class="container py-4 py-lg-5 applicant-page">

    <div class="page-heading mb-4">
        <div class="section-eyebrow mb-2">PEMANTAUAN PENDAFTARAN</div>
        <h1>Status Lamaran</h1>
        <p>Pantau riwayat pengajuan dan informasi proses seleksi Anda.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-3 shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 rounded-3 shadow-sm">
            <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
        </div>
    @endif

    @if(!$applicant)
        <div class="application-empty">
            <div class="empty-icon"><i class="bi bi-person-vcard"></i></div>
            <h5>Biodata Belum Dibuat</h5>
            <p>Lengkapi biodata terlebih dahulu untuk mulai mengajukan lamaran pekerjaan.</p>
            <a href="{{ route('pelamar.profile.edit') }}" class="btn btn-primary-custom">
                Lengkapi Biodata
            </a>
        </div>
    @elseif($applications->isEmpty())
        <div class="application-empty">
            <div class="empty-icon"><i class="bi bi-file-earmark-text"></i></div>
            <h5>Belum Ada Lamaran</h5>
            <p>Anda belum mengajukan lamaran pada lowongan pekerjaan yang tersedia.</p>
            <a href="{{ route('pelamar.vacancies.index') }}" class="btn btn-primary-custom">
                <i class="bi bi-search me-2"></i>Cari Lowongan
            </a>
        </div>
    @else
        <div class="application-summary mb-4">
            <div class="summary-icon"><i class="bi bi-folder-check"></i></div>
            <div>
                <strong>{{ $applications->total() }}</strong>
                <span>Total lamaran yang telah Anda ajukan</span>
            </div>
        </div>

        <div class="application-list">
            @foreach($applications as $application)
                @php
                    $statusLabels = [
                        'submitted' => 'Terkirim',
                        'reviewing' => 'Sedang Ditinjau',
                        'under_review' => 'Sedang Ditinjau',
                        'accepted' => 'Diterima',
                        'rejected' => 'Tidak Lolos',
                    ];

                    $statusLabel = $statusLabels[$application->status]
                        ?? \Illuminate\Support\Str::headline($application->status);

                    $statusClass = match($application->status) {
                        'accepted' => 'status-success',
                        'rejected' => 'status-danger',
                        'reviewing', 'under_review' => 'status-review',
                        default => 'status-pending',
                    };
                @endphp

                <article class="application-card">
                    <div class="application-card-head">
                        <div class="application-job-icon">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div class="application-job-title">
                            <h5>{{ $application->vacancy?->title ?? 'Lowongan tidak tersedia' }}</h5>
                            <span>{{ $application->vacancy?->department ?: 'Pendaftaran Pegawai' }}</span>
                        </div>
                        <span class="application-status {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                    </div>

                    <div class="application-details">
                        <div>
                            <small>Nomor Lamaran</small>
                            <strong class="application-number">{{ $application->application_number }}</strong>
                        </div>
                        <div>
                            <small>Tanggal Pengajuan</small>
                            <strong>{{ $application->submitted_at ? $application->submitted_at->format('d M Y, H:i') : '-' }}</strong>
                        </div>
                        <div>
                            <small>Dokumen Terlampir</small>
                            <strong>{{ $application->documents->count() }} dokumen</strong>
                        </div>
                    </div>

                    @if($application->cover_letter)
                        <div class="application-cover">
                            <small>Surat Pengantar</small>
                            <p>{{ \Illuminate\Support\Str::limit($application->cover_letter, 180) }}</p>
                        </div>
                    @endif

                    <div class="application-card-footer">
                        <span>
                            <i class="bi bi-shield-check me-1"></i>
                            Simpan nomor lamaran untuk referensi Anda.
                        </span>
                    </div>
                </article>
            @endforeach
        </div>

        @if(method_exists($applications, 'links') && $applications->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                {{ $applications->links() }}
            </div>
        @endif
    @endif

</main>
@endsection

@push('styles')
<style>
.applicant-page { color:#26342e; }
.application-summary {
    display:flex;align-items:center;gap:14px;padding:17px 20px;
    background:#fff;border:1px solid #e7ebe7;border-radius:15px;
    box-shadow:0 7px 22px rgba(25,48,37,.04);
}
.summary-icon {
    width:45px;height:45px;display:grid;place-items:center;
    border-radius:13px;background:#eaf2ee;color:#164438;font-size:20px;
}
.application-summary strong { display:block;color:#164438;font-size:21px;font-weight:800; }
.application-summary span { display:block;color:#89948d;font-size:11px; }
.application-list { display:flex;flex-direction:column;gap:15px; }
.application-card {
    padding:21px;background:#fff;border:1px solid #e7ebe7;
    border-radius:16px;box-shadow:0 7px 22px rgba(25,48,37,.045);
}
.application-card-head { display:flex;align-items:center;gap:13px; }
.application-job-icon {
    width:45px;height:45px;display:grid;place-items:center;flex-shrink:0;
    border-radius:12px;background:#eaf2ee;color:#164438;font-size:19px;
}
.application-job-title { min-width:0;flex:1; }
.application-job-title h5 {
    color:#164438;font-size:15px;font-weight:800;margin:0 0 4px;
}
.application-job-title span { color:#89948d;font-size:11px; }
.application-status {
    display:inline-flex;align-items:center;justify-content:center;
    padding:7px 11px;border-radius:30px;font-size:10px;font-weight:800;
    white-space:nowrap;
}
.status-pending { background:#f7f3e9;color:#8b713e; }
.status-review { background:#edf2fa;color:#48658f; }
.status-success { background:#e8f4ec;color:#287345; }
.status-danger { background:#faecea;color:#a64e46; }
.application-details {
    display:grid;grid-template-columns:repeat(3,minmax(0,1fr));
    gap:15px;margin-top:20px;padding:15px 0;
    border-top:1px solid #edf0ed;border-bottom:1px solid #edf0ed;
}
.application-details div { display:flex;flex-direction:column;gap:5px;min-width:0; }
.application-details small,.application-cover small {
    color:#89948d;font-size:10px;
}
.application-details strong {
    color:#34473d;font-size:11px;overflow-wrap:anywhere;
}
.application-number { color:#927744!important; }
.application-cover { padding-top:14px; }
.application-cover p {
    color:#718078;font-size:12px;line-height:1.7;margin:6px 0 0;
}
.application-card-footer {
    margin-top:14px;color:#89948d;font-size:10px;
}
.application-empty {
    padding:55px 20px;text-align:center;background:#fff;
    border:1px dashed #dce4dd;border-radius:17px;
}
.empty-icon {
    width:58px;height:58px;display:grid;place-items:center;
    margin:0 auto 15px;border-radius:15px;
    background:#eaf2ee;color:#164438;font-size:25px;
}
.application-empty h5 { color:#164438;font-weight:800; }
.application-empty p {
    max-width:440px;margin:8px auto 20px;
    color:#89948d;font-size:12px;line-height:1.8;
}
@media(max-width:575px) {
    .application-card { padding:16px; }
    .application-card-head { flex-wrap:wrap; }
    .application-status { margin-left:58px; }
    .application-details { grid-template-columns:1fr 1fr; }
}
</style>
@endpush