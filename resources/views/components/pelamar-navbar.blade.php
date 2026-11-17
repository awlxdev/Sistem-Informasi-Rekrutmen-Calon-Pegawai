<nav class="applicant-navbar">
    <div class="container">
        <div class="applicant-navbar-inner">

            {{-- BRAND --}}
            <a href="{{ route('pelamar.dashboard') }}" class="applicant-brand">
                <span class="applicant-brand-icon">
                    <i class="bi bi-person-workspace"></i>
                </span>

                <span class="applicant-brand-text">
                    <strong>PORTAL PELAMAR</strong>
                    <small>SISTEM PENDAFTARAN CALON PEGAWAI</small>
                </span>
            </a>

            {{-- MOBILE TOGGLE --}}
            <button
                class="applicant-toggler" data-applicant-toggle
                type="button"
                aria-controls="applicantNavigation"
                aria-expanded="false"
                aria-label="Buka navigasi"
            >
                <i class="bi bi-list"></i>
            </button>

            {{-- NAVIGATION --}}
            <div class="applicant-collapse" id="applicantNavigation">

                <div class="applicant-menu">

                    <a href="{{ route('pelamar.dashboard') }}"
                       class="applicant-link {{ request()->routeIs('pelamar.dashboard') ? 'active' : '' }}"
                       @if(request()->routeIs('pelamar.dashboard')) aria-current="page" @endif>
                        <i class="bi bi-grid-1x2"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('pelamar.profile.edit') }}"
                       class="applicant-link {{ request()->routeIs('pelamar.profile.*') ? 'active' : '' }}"
                       @if(request()->routeIs('pelamar.profile.*')) aria-current="page" @endif>
                        <i class="bi bi-person-vcard"></i>
                        <span>Biodata Saya</span>
                    </a>

                    <a href="{{ route('pelamar.vacancies.index') }}"
                       class="applicant-link {{ request()->routeIs('pelamar.vacancies.*') ? 'active' : '' }}"
                       @if(request()->routeIs('pelamar.vacancies.*')) aria-current="page" @endif>
                        <i class="bi bi-briefcase"></i>
                        <span>Lowongan Pekerjaan</span>
                    </a>

                    <a href="{{ route('pelamar.applications.index') }}"
                       class="applicant-link {{ request()->routeIs('pelamar.applications.*') ? 'active' : '' }}"
                       @if(request()->routeIs('pelamar.applications.*')) aria-current="page" @endif>
                        <i class="bi bi-file-earmark-check"></i>
                        <span>Status Lamaran</span>
                    </a>

                </div>

                {{-- ACCOUNT --}}
                <div class="applicant-account">

                    <div class="applicant-avatar">
    @if (auth()->user()->applicant?->photo_path)
        <img
            src="{{ route('pelamar.profile.photo') }}"
            alt="Foto profil pelamar"
        >
    @else
        {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
    @endif
</div>

                    <div class="applicant-user-info">
                        <strong>{{ auth()->user()->name }}</strong>
                        <small>
                            <i class="bi bi-shield-check"></i>
                            Akun Pelamar
                        </small>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="applicant-logout">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Keluar</span>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    /* =========================================
       APPLICANT NAVBAR - PREMIUM SOFT 3D
    ========================================= */

    .applicant-navbar {
        position: sticky;
        top: 0;
        z-index: 1030;
        width: 100%;
        background: rgba(255,255,255,.96);
        border-bottom: 1px solid #e8ece7;
        box-shadow: 0 5px 22px rgba(18,55,42,.055);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }

    .applicant-navbar,
    .applicant-navbar * {
        box-sizing: border-box;
    }

    .applicant-navbar-inner {
        min-height: 82px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }

    /* BRAND */

    .applicant-brand {
        display: inline-flex;
        align-items: center;
        gap: 13px;
        flex-shrink: 0;
        text-decoration: none;
    }

    .applicant-brand-icon {
        width: 47px;
        height: 47px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
        border: 1px solid rgba(200,169,107,.55);
        border-radius: 15px;
        color: #f5e5c3;
        background: linear-gradient(145deg,#205b49,#10362d);
        box-shadow:
            0 5px 12px rgba(16,54,45,.17),
            inset 0 1px 1px rgba(255,255,255,.2);
        font-size: 21px;
    }

    .applicant-brand-text {
        display: flex;
        flex-direction: column;
        gap: 5px;
        line-height: 1.2;
    }

    .applicant-brand-text strong {
        color: #164438;
        font-size: 14px;
        font-weight: 850;
        letter-spacing: .8px;
    }

    .applicant-brand-text small {
        color: #8a968e;
        font-size: 8px;
        font-weight: 750;
        letter-spacing: 1.05px;
        white-space: nowrap;
    }

    /* DESKTOP NAVIGATION */

    .applicant-navbar .applicant-collapse {
        display: flex !important;
        align-items: center;
        justify-content: space-between;
        flex: 1 1 auto;
        min-width: 0;
        gap: 18px;
    }

    .applicant-menu {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: nowrap;
        gap: 5px;
        margin: 0 auto;
    }

    .applicant-link {
        position: relative;
        min-height: 43px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 12px;
        border: 1px solid transparent;
        border-radius: 11px;
        color: #68776e;
        font-size: 11.5px;
        font-weight: 650;
        text-decoration: none;
        white-space: nowrap;
        transition: color .2s ease, background .2s ease,
                    border-color .2s ease, transform .2s ease;
    }

    .applicant-link i {
        color: #a38a5a;
        font-size: 15px;
        transition: color .2s ease;
    }

    .applicant-link:hover {
        color: #164438;
        background: #f3f7f4;
        transform: translateY(-1px);
    }

    .applicant-link.active {
        border-color: #e2eae3;
        color: #164438;
        background: linear-gradient(145deg,#edf5ef,#e5efe8);
        box-shadow: 0 3px 9px rgba(22,68,56,.055);
        font-weight: 750;
    }

    .applicant-link.active i {
        color: #b99a62;
    }

    .applicant-link.active::after {
        position: absolute;
        right: 13px;
        bottom: -1px;
        left: 13px;
        height: 2px;
        border-radius: 5px;
        background: #b99a62;
        content: "";
    }

    /* ACCOUNT */

    .applicant-account {
        display: flex;
        align-items: center;
        flex-shrink: 0;
        gap: 10px;
        padding-left: 17px;
        border-left: 1px solid #e7ebe7;
    }

    .applicant-avatar {
        width: 39px;
        height: 39px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
        border: 1px solid #e6d6b5;
        border-radius: 13px;
        color: #f3e3bf;
        background: linear-gradient(145deg,#205b49,#10362d);
        box-shadow: 0 3px 9px rgba(22,68,56,.12);
        font-size: 15px;
        font-weight: 800;
    }

    .applicant-avatar img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    border-radius: inherit;
}

    .applicant-user-info {
        min-width: 85px;
        max-width: 145px;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .applicant-user-info strong {
        overflow: hidden;
        color: #26342e;
        font-size: 11px;
        font-weight: 750;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .applicant-user-info small {
        color: #89948d;
        font-size: 9px;
    }

    .applicant-user-info small i {
        color: #b99a62;
    }

    .applicant-account form {
        margin: 0;
    }

    .applicant-logout {
        min-height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 12px;
        border: 1px solid #eadedb;
        border-radius: 10px;
        color: #a34c45;
        background: #fff;
        font-size: 10px;
        font-weight: 750;
        transition: .2s ease;
    }

    .applicant-logout:hover {
        border-color: #d8aaa5;
        color: #913b35;
        background: #fff5f3;
        box-shadow: 0 3px 9px rgba(163,76,69,.08);
        transform: translateY(-1px);
    }

    /* MOBILE TOGGLER */

    .applicant-toggler {
        display: none;
        width: 43px;
        height: 43px;
        place-items: center;
        border: 1px solid #e2e9e2;
        border-radius: 12px;
        color: #164438;
        background: #fff;
        box-shadow: 0 3px 9px rgba(22,68,56,.05);
        font-size: 23px;
        transition: .2s ease;
    }

    .applicant-toggler:hover,
    .applicant-toggler[aria-expanded="true"] {
        border-color: #c8a96b;
        color: #164438;
        background: #f8f6ef;
    }

    /* TABLET AND MOBILE */

    @media (max-width: 1199.98px) {
        .applicant-navbar-inner {
            gap: 14px;
        }

        .applicant-link {
            gap: 6px;
            padding-right: 9px;
            padding-left: 9px;
            font-size: 10.5px;
        }

        .applicant-account {
            gap: 8px;
            padding-left: 11px;
        }

        .applicant-user-info {
            max-width: 105px;
        }

        .applicant-logout {
            padding: 0 9px;
        }
    }

    @media (max-width: 991.98px) {
        .applicant-navbar-inner {
            min-height: 72px;
            flex-wrap: wrap;
            gap: 0;
        }

        .applicant-brand-icon {
            width: 44px;
            height: 44px;
        }

        .applicant-toggler {
            display: grid;
            flex-shrink: 0;
        }

        .applicant-navbar .applicant-collapse:not(.is-open) {
            display: none !important;
        }

        .applicant-navbar .applicant-collapse.is-open,
        .applicant-navbar .applicant-collapse.is-open {
            display: flex !important;
            flex: 0 0 100%;
            flex-direction: column;
            align-items: stretch;
            gap: 13px;
            width: 100%;
            padding: 14px 0 17px;
            border-top: 1px solid #e8ece7;
        }

        .applicant-menu {
            width: 100%;
            flex-direction: column;
            align-items: stretch;
            gap: 5px;
            margin: 0;
        }

        .applicant-link {
            width: 100%;
            min-height: 45px;
            justify-content: flex-start;
            padding: 0 13px;
            font-size: 12px;
        }

        .applicant-link.active::after {
            top: 9px;
            right: auto;
            bottom: 9px;
            left: 0;
            width: 3px;
            height: auto;
        }

        .applicant-account {
            width: 100%;
            padding: 14px 0 0;
            border-top: 1px solid #e8ece7;
            border-left: 0;
        }

        .applicant-user-info {
            flex: 1;
            max-width: none;
        }

        .applicant-user-info strong {
            max-width: 100%;
        }

        .applicant-logout {
            min-width: 90px;
            min-height: 39px;
        }
    }

    @media (max-width: 575.98px) {
        .applicant-navbar .container {
            padding-right: 15px;
            padding-left: 15px;
        }

        .applicant-navbar-inner {
            min-height: 68px;
        }

        .applicant-brand {
            gap: 9px;
        }

        .applicant-brand-icon {
            width: 41px;
            height: 41px;
            border-radius: 12px;
            font-size: 19px;
        }

        .applicant-brand-text strong {
            font-size: 11.5px;
        }

        .applicant-brand-text small {
            font-size: 7px;
            letter-spacing: .55px;
        }

        .applicant-toggler {
            width: 40px;
            height: 40px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .applicant-navbar *,
        .applicant-navbar *::before,
        .applicant-navbar *::after {
            transition-duration: .01ms !important;
        }
    }
</style>

<script>
(function () {
    function initializeApplicantNavbar() {
        document.querySelectorAll(".applicant-navbar").forEach(function (navbar) {
            const toggle = navbar.querySelector("[data-applicant-toggle]");
            const menu = navbar.querySelector(".applicant-collapse");

            if (!toggle || !menu || toggle.dataset.initialized === "true") {
                return;
            }

            toggle.dataset.initialized = "true";

            toggle.addEventListener("click", function () {
                const isOpen = menu.classList.toggle("is-open");

                toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
                toggle.setAttribute(
                    "aria-label",
                    isOpen ? "Tutup navigasi" : "Buka navigasi"
                );
            });

            menu.querySelectorAll("a").forEach(function (link) {
                link.addEventListener("click", function () {
                    if (window.innerWidth <= 991.98) {
                        menu.classList.remove("is-open");
                        toggle.setAttribute("aria-expanded", "false");
                        toggle.setAttribute("aria-label", "Buka navigasi");
                    }
                });
            });

            window.addEventListener("resize", function () {
                if (window.innerWidth > 991.98) {
                    menu.classList.remove("is-open");
                    toggle.setAttribute("aria-expanded", "false");
                }
            });
        });
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initializeApplicantNavbar);
    } else {
        initializeApplicantNavbar();
    }
})();
</script>