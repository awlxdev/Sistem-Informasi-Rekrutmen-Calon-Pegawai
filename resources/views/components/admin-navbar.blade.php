<nav class="navbar navbar-expand-lg navbar-main sticky-top no-print">
    <div class="container">
        <a class="brand" href="{{ route('admin.dashboard') }}">
            <span class="brand-mark"><i class="bi bi-building-gear"></i></span>
            <span>
                SISTEM REKRUTMEN
                <small>PANEL ADMINISTRATOR</small>
            </span>
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#adminNavbar"
                aria-controls="adminNavbar"
                aria-expanded="false"
                aria-label="Buka navigasi">
            <i class="bi bi-list fs-3 text-primary-custom"></i>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
            <div class="d-flex flex-column flex-lg-row align-items-lg-center
                        gap-3 gap-lg-4 ms-lg-auto py-3 py-lg-0">
                <a class="nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'fw-bold text-primary-custom' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid me-1"></i> Dashboard
                </a>

                <a class="nav-link-custom {{ request()->routeIs('admin.users.*') ? 'fw-bold text-primary-custom' : '' }}"
                   href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people me-1"></i> Pengguna
                </a>

                <a class="nav-link-custom {{ request()->routeIs('admin.vacancies.*') ? 'fw-bold text-primary-custom' : '' }}"
                   href="{{ route('admin.vacancies.index') }}">
                    <i class="bi bi-briefcase me-1"></i> Lowongan
                </a>

                <div class="d-flex align-items-center gap-2">
                    <span class="small fw-semibold text-primary-custom">
                        <i class="bi bi-person-circle me-1"></i>
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-box-arrow-right"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>