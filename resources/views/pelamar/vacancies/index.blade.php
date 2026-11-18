@extends('layouts.app')

@section('navbar')
    @include('components.pelamar-navbar')
@endsection

@section('title', 'Lowongan Pekerjaan')

@section('content')
<main class="container py-4 py-lg-5 applicant-page">

    <div class="page-heading mb-4">
        <div class="section-eyebrow mb-2">PELUANG KARIER</div>
        <h1>Lowongan Pekerjaan</h1>
        <p>Temukan posisi yang sesuai dengan kualifikasi dan kesempatan karier Anda.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-3">
            <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
        </div>
    @endif

    <section class="search-panel mb-4">
        <form method="GET" action="{{ route('pelamar.vacancies.index') }}">
            <div class="row g-2 align-items-center">
                <div class="col-lg-9">
                    <div class="search-input-wrap">
                        <i class="bi bi-search"></i>
                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Cari posisi, departemen, lokasi, atau jenis pekerjaan..."
                        >
                    </div>
                </div>
                <div class="col-lg-3 d-grid">
                    <button type="submit" class="btn btn-primary-custom">
                        Cari Lowongan
                    </button>
                </div>
            </div>
        </form>
    </section>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h5 class="fw-bold mb-1">Posisi yang Tersedia</h5>
            <div class="text-muted small">
                {{ $vacancies->total() }} lowongan ditemukan
            </div>
        </div>
        @if(request('search'))
            <a href="{{ route('pelamar.vacancies.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                <i class="bi bi-x-circle me-1"></i>Hapus pencarian
            </a>
        @endif
    </div>

    <div class="row g-3">
        @forelse($vacancies as $vacancy)
            <div class="col-md-6 col-xl-4">
                <article class="vacancy-card h-100">
                    <div class="vacancy-card-top">
                        <span class="vacancy-icon">
                            <i class="bi bi-briefcase"></i>
                        </span>
                        @if(in_array($vacancy->id, $appliedVacancyIds))
                            <span class="status-pill status-applied">
                                <i class="bi bi-check-circle me-1"></i>Sudah dilamar
                            </span>
                        @else
                            <span class="status-pill status-open">Dibuka</span>
                        @endif
                    </div>

                    <div class="vacancy-card-body">
                        <div class="vacancy-department">
                            {{ $vacancy->department ?: 'Kesempatan Karier' }}
                        </div>

                        <h5>{{ $vacancy->title }}</h5>

                        <div class="vacancy-meta">
                            @if($vacancy->location)
                                <span><i class="bi bi-geo-alt"></i>{{ $vacancy->location }}</span>
                            @endif

                            @if($vacancy->employment_type)
                                <span><i class="bi bi-clock"></i>{{ $vacancy->employment_type }}</span>
                            @endif

                            <span><i class="bi bi-people"></i>{{ $vacancy->quota }} posisi</span>
                        </div>

                        <p class="vacancy-description">
                            {{ \Illuminate\Support\Str::limit(strip_tags($vacancy->description), 135) }}
                        </p>
                    </div>

                    <div class="vacancy-card-footer">
                        <div class="closing-info">
                            <small>Batas pendaftaran</small>
                            <strong>
                                {{ $vacancy->closing_date ? $vacancy->closing_date->format('d M Y') : 'Tidak ditentukan' }}
                            </strong>
                        </div>

                        <a href="{{ route('pelamar.vacancies.show', $vacancy->slug) }}"
                           class="btn btn-primary-custom btn-sm px-3">
                            Detail <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </article>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-icon"><i class="bi bi-briefcase"></i></div>
                    <h5>Belum Ada Lowongan</h5>
                    <p>
                        @if(request('search'))
                            Tidak ditemukan lowongan yang sesuai dengan kata kunci pencarian Anda.
                        @else
                            Saat ini belum ada lowongan yang dipublikasikan. Silakan periksa kembali nanti.
                        @endif
                    </p>
                    @if(request('search'))
                        <a href="{{ route('pelamar.vacancies.index') }}" class="btn btn-primary-custom">
                            Lihat Semua Lowongan
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    @if($vacancies->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $vacancies->links() }}
        </div>
    @endif

</main>
@endsection

@push('styles')
<style nonce="{{ Vite::cspNonce() }}">
.applicant-page { color:#26342e; }
.search-panel {
    padding:20px;
    background:#fff;
    border:1px solid #e7ebe7;
    border-radius:17px;
    box-shadow:0 8px 25px rgba(25,48,37,.045);
}
.search-input-wrap { position:relative; }
.search-input-wrap i {
    position:absolute; left:15px; top:50%;
    transform:translateY(-50%); color:#89948d;
}
.search-input-wrap input {
    min-height:47px; padding-left:43px;
    border:1px solid #e2e8e3; border-radius:11px;
}
.search-input-wrap input:focus {
    border-color:#b99a62;
    box-shadow:0 0 0 3px rgba(185,154,98,.12);
}
.vacancy-card {
    display:flex; flex-direction:column;
    padding:21px; background:#fff;
    border:1px solid #e8ece8; border-radius:17px;
    box-shadow:0 7px 22px rgba(25,48,37,.045);
    transition:transform .2s ease,box-shadow .2s ease;
}
.vacancy-card:hover {
    transform:translateY(-3px);
    box-shadow:0 13px 30px rgba(25,48,37,.09);
}
.vacancy-card-top {
    display:flex; align-items:center;
    justify-content:space-between; gap:10px; margin-bottom:19px;
}
.vacancy-icon,.empty-icon {
    width:46px;height:46px;display:grid;place-items:center;
    border-radius:13px;background:#eaf2ee;color:#164438;font-size:20px;
}
.status-pill {
    padding:6px 10px;border-radius:30px;font-size:10px;font-weight:700;
}
.status-open { background:#eaf2ee;color:#246347; }
.status-applied { background:#f7f3e9;color:#8d713c; }
.vacancy-department {
    color:#a1844e;font-size:10px;font-weight:800;
    letter-spacing:1px;text-transform:uppercase;margin-bottom:7px;
}
.vacancy-card h5 {
    color:#164438;font-size:18px;font-weight:800;line-height:1.4;margin-bottom:13px;
}
.vacancy-meta { display:flex;flex-direction:column;gap:7px;margin-bottom:15px; }
.vacancy-meta span {
    display:flex;align-items:center;gap:8px;color:#78857d;font-size:12px;
}
.vacancy-meta i { width:15px;color:#a1844e; }
.vacancy-description {
    color:#7b8780;font-size:12px;line-height:1.8;margin:0 0 20px;
}
.vacancy-card-footer {
    display:flex;align-items:center;justify-content:space-between;
    gap:10px;margin-top:auto;padding-top:15px;border-top:1px solid #edf0ed;
}
.closing-info { display:flex;flex-direction:column;gap:4px; }
.closing-info small { color:#89948d;font-size:10px; }
.closing-info strong { color:#26342e;font-size:12px; }
.empty-state {
    text-align:center;padding:55px 20px;background:#fff;
    border:1px dashed #dce4dd;border-radius:17px;
}
.empty-icon { margin:0 auto 15px;width:58px;height:58px;font-size:25px; }
.empty-state h5 { color:#164438;font-weight:800; }
.empty-state p { color:#89948d;font-size:13px;max-width:480px;margin:8px auto 20px; }
@media(max-width:575px) {
    .search-panel { padding:14px; }
    .vacancy-card { padding:17px; }
}
</style>
@endpush