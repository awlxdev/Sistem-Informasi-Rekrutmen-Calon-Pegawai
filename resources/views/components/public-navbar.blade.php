
<nav class="navbar navbar-expand-lg navbar-main sticky-top">
    <div class="container">
        <a class="brand" href="{{ url('/') }}">
            <span class="brand-mark">
                <i class="bi bi-buildings"></i>
            </span>
            <span>
                PORTAL REKRUTMEN
                <small>PENDAFTARAN CALON PEGAWAI</small>
            </span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNavigation"
                aria-controls="mainNavigation" aria-expanded="false"
                aria-label="Buka navigasi">
            <i class="bi bi-list fs-2 text-success"></i>
        </button>

        <div class="collapse navbar-collapse" id="mainNavigation">
            <div class="ms-auto d-flex flex-column flex-lg-row align-items-lg-center gap-3 gap-lg-4 py-3 py-lg-0">

                <a class="nav-link-custom" href="{{ url('/#beranda') }}">Beranda</a>
                <a class="nav-link-custom" href="{{ url('/#keunggulan') }}">Keunggulan</a>
                <a class="nav-link-custom" href="{{ url('/#alur') }}">Alur Pendaftaran</a>

                @auth
                    @php
                        $user = auth()->user();

                        $dashboardUrl = match ($user->role) {
                            \App\Models\User::ROLE_ADMIN => route('admin.dashboard'),
                            \App\Models\User::ROLE_HRD => route('hrd.dashboard'),
                            \App\Models\User::ROLE_PELAMAR => route('pelamar.dashboard'),
                            default => null,
                        };
                    @endphp

                    <div class="text-lg-end">
                        <span class="d-block fw-bold text-dark small">
                            {{ $user->name }}
                        </span>
                        <small class="text-secondary">
                            {{ ucfirst($user->role ?? 'Pengguna') }}
                        </small>
                    </div>

                    @if ($dashboardUrl)
                        <a href="{{ $dashboardUrl }}" class="btn-primary-custom">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-outline-custom w-100">
                            <i class="bi bi-box-arrow-right"></i>
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-outline-custom">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk
                    </a>

                    <a href="{{ route('register') }}" class="btn-primary-custom">
                        Daftar Sekarang <i class="bi bi-arrow-right"></i>
                    </a>
                @endauth

            </div>
        </div>
    </div>
</nav>
