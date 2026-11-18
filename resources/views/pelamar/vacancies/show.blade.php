@extends('layouts.app')

@section('navbar')
    @include('components.pelamar-navbar')
@endsection

@section('title', 'Detail Lowongan')

@section('content')
<main class="container py-4 py-lg-5 applicant-page">

    <a href="{{ route('pelamar.vacancies.index') }}" class="back-link">
        <i class="bi bi-arrow-left"></i> Kembali ke daftar lowongan
    </a>

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-3 mt-3">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 rounded-3 mt-3">{{ session('error') }}</div>
    @endif

    <section class="detail-hero mt-3">
        <div class="detail-hero-icon"><i class="bi bi-briefcase"></i></div>
        <div class="section-eyebrow mb-2">INFORMASI KARIER</div>
        <h1>{{ $vacancy->title }}</h1>
        <p>{{ $vacancy->department ?: 'Kesempatan Bergabung' }}</p>

        <div class="detail-tags">
            @if($vacancy->location)
                <span><i class="bi bi-geo-alt"></i>{{ $vacancy->location }}</span>
            @endif
            @if($vacancy->employment_type)
                <span><i class="bi bi-clock"></i>{{ $vacancy->employment_type }}</span>
            @endif
            <span><i class="bi bi-people"></i>{{ $vacancy->quota }} posisi</span>
        </div>
    </section>

    <div class="row g-4 mt-1">
        <div class="col-lg-8">

            <section class="detail-panel mb-3">
                <h5><i class="bi bi-file-text"></i> Deskripsi Pekerjaan</h5>
                <div class="detail-copy">{!! nl2br(e($vacancy->description)) !!}</div>
            </section>

            @if($vacancy->responsibilities)
                <section class="detail-panel mb-3">
                    <h5><i class="bi bi-list-check"></i> Tanggung Jawab</h5>
                    <div class="detail-copy">{!! nl2br(e($vacancy->responsibilities)) !!}</div>
                </section>
            @endif

            @if($vacancy->requirements)
                <section class="detail-panel mb-3">
                    <h5><i class="bi bi-clipboard-check"></i> Persyaratan</h5>
                    <div class="detail-copy">{!! nl2br(e($vacancy->requirements)) !!}</div>
                </section>
            @endif

        </div>

        <div class="col-lg-4">
            <aside class="detail-panel application-panel">
                <h5><i class="bi bi-info-circle"></i> Informasi Lowongan</h5>

                <div class="info-row">
                    <span>Departemen</span>
                    <strong>{{ $vacancy->department ?: '-' }}</strong>
                </div>
                <div class="info-row">
                    <span>Lokasi</span>
                    <strong>{{ $vacancy->location ?: '-' }}</strong>
                </div>
                <div class="info-row">
                    <span>Jenis pekerjaan</span>
                    <strong>{{ $vacancy->employment_type ?: '-' }}</strong>
                </div>
                <div class="info-row">
                    <span>Kuota posisi</span>
                    <strong>{{ $vacancy->quota }} orang</strong>
                </div>
                <div class="info-row">
                    <span>Dipublikasikan</span>
                    <strong>{{ $vacancy->published_at ? $vacancy->published_at->format('d M Y') : '-' }}</strong>
                </div>
                <div class="info-row">
                    <span>Batas pendaftaran</span>
                    <strong>{{ $vacancy->closing_date ? $vacancy->closing_date->format('d M Y') : 'Tidak ditentukan' }}</strong>
                </div>

                <hr>

                @if($hasApplied)
                    <div class="already-applied">
                        <i class="bi bi-check-circle-fill"></i>
                        <strong>Lamaran Sudah Dikirim</strong>
                        <p>Anda telah mengajukan lamaran untuk posisi ini. Pantau perkembangannya melalui halaman Status Lamaran.</p>
                        <a href="{{ route('pelamar.applications.index') }}" class="btn btn-primary-custom w-100">
                            Lihat Status Lamaran
                        </a>
                    </div>
                @else
                    <h6 class="fw-bold mb-2">Ajukan Lamaran</h6>
                    <p class="text-muted small">
                        Pastikan biodata dan CV Anda sudah lengkap sebelum mengirim lamaran.
                    </p>

                    <a href="{{ route('pelamar.profile.edit') }}" class="profile-reminder mb-3">
                        <i class="bi bi-person-vcard"></i>
                        <span>Periksa kelengkapan Biodata Saya</span>
                        <i class="bi bi-arrow-up-right ms-auto"></i>
                    </a>

                    <form method="POST" action="{{ route('pelamar.vacancies.apply', $vacancy->slug) }}">
                        @csrf

                        <label for="cover_letter" class="form-label fw-semibold small">
                            Surat Pengantar <span class="text-muted">(Opsional)</span>
                        </label>
                        <textarea
                            name="cover_letter"
                            id="cover_letter"
                            rows="5"
                            maxlength="5000"
                            class="form-control cover-letter"
                            placeholder="Tuliskan alasan dan ketertarikan Anda pada posisi ini..."
                        >{{ old('cover_letter') }}</textarea>
                        @error('cover_letter')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror

                        <label class="confirmation-check mt-3">
                            <input type="checkbox" name="confirmation" value="1" {{ old('confirmation') ? 'checked' : '' }}>
                            <span>Saya menyatakan bahwa informasi dan dokumen yang saya berikan adalah benar serta dapat dipertanggungjawabkan.</span>
                        </label>
                        @error('confirmation')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-primary-custom w-100 mt-3">
                            <i class="bi bi-send me-2"></i>Kirim Lamaran
                        </button>
                    </form>
                @endif
            </aside>
        </div>
    </div>
</main>
@endsection

@push('styles')
<style nonce="{{ Vite::cspNonce() }}">
.applicant-page { color:#26342e; }
.back-link {
    display:inline-flex;align-items:center;gap:8px;
    color:#527265;text-decoration:none;font-size:13px;font-weight:700;
}
.back-link:hover { color:#164438; }
.detail-hero {
    padding:30px;background:linear-gradient(135deg,#164438,#10362d);
    color:#fff;border-radius:19px;box-shadow:0 12px 30px rgba(16,54,45,.14);
}
.detail-hero-icon {
    width:49px;height:49px;display:grid;place-items:center;
    margin-bottom:18px;border:1px solid rgba(255,255,255,.2);
    border-radius:14px;background:rgba(255,255,255,.1);font-size:22px;
}
.detail-hero .section-eyebrow { color:#d8bd83; }
.detail-hero h1 { font-size:clamp(24px,4vw,34px);font-weight:800;margin-bottom:7px; }
.detail-hero p { color:rgba(255,255,255,.75);margin-bottom:17px; }
.detail-tags { display:flex;flex-wrap:wrap;gap:9px; }
.detail-tags span {
    padding:7px 11px;border:1px solid rgba(255,255,255,.17);
    border-radius:30px;color:#fff;font-size:11px;
}
.detail-tags i { margin-right:6px;color:#e2c88f; }
.detail-panel {
    padding:23px;background:#fff;border:1px solid #e7ebe7;
    border-radius:16px;box-shadow:0 7px 22px rgba(25,48,37,.045);
}
.detail-panel h5 {
    display:flex;align-items:center;gap:10px;
    color:#164438;font-size:16px;font-weight:800;margin-bottom:18px;
}
.detail-panel h5 i { color:#a1844e; }
.detail-copy { color:#64736a;font-size:13px;line-height:1.9;overflow-wrap:anywhere; }
.info-row {
    display:flex;flex-direction:column;gap:4px;
    padding:11px 0;border-bottom:1px solid #edf0ed;
}
.info-row span { color:#89948d;font-size:10px; }
.info-row strong { color:#26342e;font-size:12px; }
.application-panel hr { border-color:#e7ebe7;margin:18px 0; }
.profile-reminder {
    display:flex;align-items:center;gap:9px;padding:11px;
    border:1px solid #e7e2d4;border-radius:10px;
    background:#faf8f2;color:#79643d;text-decoration:none;font-size:11px;font-weight:700;
}
.profile-reminder:hover { background:#f7f3e9;color:#5e4b2a; }
.cover-letter { border-color:#e2e8e3;border-radius:10px;font-size:12px; }
.cover-letter:focus {
    border-color:#b99a62;box-shadow:0 0 0 3px rgba(185,154,98,.12);
}
.confirmation-check {
    display:flex;align-items:flex-start;gap:9px;
    color:#64736a;font-size:11px;line-height:1.7;
}
.confirmation-check input { margin-top:3px;accent-color:#164438; }
.already-applied {
    padding:15px;background:#f7f3e9;border-radius:12px;text-align:center;
}
.already-applied > i { display:block;color:#927744;font-size:27px;margin-bottom:8px; }
.already-applied strong { display:block;color:#604e2d;font-size:13px; }
.already-applied p { color:#82765e;font-size:11px;line-height:1.7;margin:8px 0 14px; }
@media(max-width:575px) { .detail-hero,.detail-panel { padding:19px; } }
</style>
@endpush