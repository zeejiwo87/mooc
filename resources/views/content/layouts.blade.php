<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Massive Open Online Course (MOOC)</title>

    <link rel="icon" href="{{ asset('assets/media/logos/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fonts/font.css') }}" media="print"
        onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('assets/plugins/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.bundle.css') }}">

    <meta name="X-CSRF-TOKEN" content="{{ csrf_token() }}">

    <style>
        :root {
            --neo-bg: #e7e5e4;
            --neo-surface: #ecebea;
            --neo-primary: #009ef7;
            --neo-primary-dark: #0085d1;
            --neo-text: #1f2937;
            --neo-muted: #6b7280;
            --neo-light: rgba(255, 255, 255, 0.92);
            --neo-dark: rgba(120, 113, 108, 0.22);
            --neo-dark-soft: rgba(120, 113, 108, 0.14);
        }

        html {
            scroll-behavior: smooth;
        }

        html,
        body {
            overflow-x: hidden;
            background: var(--neo-bg) !important;
        }

        body#kt_body {
            background: var(--neo-bg) !important;
            color: var(--neo-text);
            min-height: 100vh;
        }

        a {
            text-decoration: none;
        }

        .neo-page {
            min-height: 100vh;
            background: var(--neo-bg);
            padding-top: 100px;
        }

        .neo-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            z-index: 2147483000 !important;
            padding: 14px 0;
            background: transparent !important;
            box-shadow: none !important;
            pointer-events: none;
            transform: none !important;
            will-change: auto !important;
        }

        .neo-header .container {
            position: relative;
            z-index: 2147483001 !important;
            pointer-events: auto;
        }

        .neo-navbar {
            height: 72px;
            padding: 10px 16px;
            border-radius: 22px;
            background: var(--neo-surface);
            box-shadow:
                8px 8px 18px var(--neo-dark),
                -8px -8px 18px var(--neo-light);
            position: relative;
            z-index: 2147483002 !important;
        }

        .neo-navbar-inner {
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .neo-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
            color: var(--neo-text);
        }

        .neo-brand:hover {
            color: var(--neo-primary);
        }

        .neo-logo {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--neo-surface);
            box-shadow:
                5px 5px 12px var(--neo-dark-soft),
                -5px -5px 12px var(--neo-light);
            overflow: hidden;
            flex-shrink: 0;
        }

        .neo-logo img {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        .neo-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
            min-width: 0;
        }

        .neo-brand-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--neo-text);
            white-space: nowrap;
        }

        .neo-brand-subtitle {
            margin-top: 2px;
            font-size: 12px;
            font-weight: 500;
            color: var(--neo-muted);
            white-space: nowrap;
            display: block;
        }

        .neo-menu-toggle {
            width: 44px;
            height: 44px;
            display: none;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 14px;
            background: var(--neo-surface);
            color: var(--neo-text);
            box-shadow:
                5px 5px 11px var(--neo-dark-soft),
                -5px -5px 11px var(--neo-light);
            transition: 0.2s ease;
            flex-shrink: 0;
        }

        .neo-menu-toggle:hover {
            color: var(--neo-primary);
        }

        .neo-menu-toggle span {
            position: relative;
            width: 22px;
            height: 2px;
            display: block;
            border-radius: 999px;
            background: currentColor;
            transition: 0.22s ease;
        }

        .neo-menu-toggle span::before,
        .neo-menu-toggle span::after {
            content: "";
            position: absolute;
            left: 0;
            width: 22px;
            height: 2px;
            border-radius: 999px;
            background: currentColor;
            transition: 0.22s ease;
        }

        .neo-menu-toggle span::before {
            top: -7px;
        }

        .neo-menu-toggle span::after {
            top: 7px;
        }

        .neo-menu-toggle.is-open span {
            background: transparent;
        }

        .neo-menu-toggle.is-open span::before {
            top: 0;
            transform: rotate(45deg);
        }

        .neo-menu-toggle.is-open span::after {
            top: 0;
            transform: rotate(-45deg);
        }

        .neo-menu-area {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            flex: 1;
        }

        .neo-menu {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .neo-menu-item {
            margin: 0;
            padding: 0;
        }

        .neo-menu-link {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 16px;
            border-radius: 14px;
            color: var(--neo-text);
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .neo-menu-link:hover,
        .neo-menu-link.active {
            color: var(--neo-primary);
            box-shadow:
                inset 4px 4px 8px rgba(120, 113, 108, 0.18),
                inset -4px -4px 8px rgba(255, 255, 255, 0.8);
        }

        .neo-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: 8px;
        }

        .neo-btn {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 18px;
            border: 0;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            line-height: 1;
            transition: 0.2s ease;
        }

        .neo-btn-soft {
            background: var(--neo-surface);
            color: var(--neo-text);
            box-shadow:
                5px 5px 11px var(--neo-dark-soft),
                -5px -5px 11px var(--neo-light);
        }

        .neo-btn-soft:hover {
            color: var(--neo-primary);
            transform: translateY(-1px);
        }

        .neo-btn-primary {
            background: var(--neo-primary);
            color: #ffffff;
            box-shadow:
                5px 5px 11px rgba(120, 113, 108, 0.24),
                -5px -5px 11px rgba(255, 255, 255, 0.65);
        }

        .neo-btn-primary:hover {
            background: var(--neo-primary-dark);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .neo-user-wrapper {
            position: relative;
            display: inline-block;
            z-index: 30;
            border-radius: 16px;
        }

        .neo-user-bg {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 42px;
            border-radius: 14px;
            background: var(--neo-primary);
            box-shadow:
                5px 5px 11px rgba(120, 113, 108, 0.24),
                -5px -5px 11px rgba(255, 255, 255, 0.65);
            transition:
                height 0.32s cubic-bezier(.22, .61, .36, 1),
                border-radius 0.24s ease,
                background 0.2s ease;
            z-index: 1;
        }

        .neo-user-wrapper.is-open .neo-user-bg {
            height: 196px;
            border-radius: 14px 14px 20px 20px;
            background: var(--neo-primary);
        }

        .neo-dashboard-toggle {
            cursor: pointer;
            position: relative;
            z-index: 3;
            width: 100%;
            box-shadow: none !important;
            user-select: none;
            background: transparent !important;
        }

        .neo-dashboard-toggle:hover {
            background: transparent !important;
        }

        .neo-dashboard-toggle .neo-dashboard-chevron {
            font-size: 12px;
            transition: transform 0.22s ease;
        }

        .neo-user-wrapper.is-open .neo-dashboard-chevron {
            transform: rotate(180deg);
        }

        .neo-user-dropdown {
            position: absolute;
            top: 44px;
            left: 0;
            right: 0;
            z-index: 2;
            width: 100%;
            padding: 6px 8px 10px;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(-18px);
            transition:
                transform 0.28s cubic-bezier(.22, .61, .36, 1),
                opacity 0.18s ease,
                visibility 0.18s ease;
            overflow: hidden;
        }

        .neo-user-wrapper.is-open .neo-user-dropdown {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateY(0);
        }

        .neo-user-dropdown-link {
            min-height: 42px;
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 0 11px;
            border-radius: 12px;
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            transition: 0.18s ease;
        }

        .neo-user-dropdown-link i {
            color: #ffffff;
            font-size: 17px;
            opacity: 0.95;
        }

        .neo-user-dropdown-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.16);
        }

        .neo-user-dropdown-link.text-danger {
            color: #ffffff !important;
        }

        .neo-user-dropdown-link.text-danger i {
            color: #ffffff;
        }

        .neo-user-dropdown-divider {
            height: 1px;
            margin: 7px 6px;
            background: rgba(255, 255, 255, 0.28);
        }

        .neo-content {
            padding-top: 14px;
            padding-bottom: 48px;
            position: relative;
            z-index: 1;
        }

        .neo-footer {
            background: var(--neo-bg);
            padding: 18px 0 22px;
            position: relative;
            z-index: 1;
        }

        .neo-footer-card {
            padding: 13px 18px;
            border-radius: 18px;
            text-align: center;
            color: var(--neo-muted);
            background: var(--neo-surface);
            font-size: 13px;
            font-weight: 600;
            box-shadow:
                inset 4px 4px 9px rgba(120, 113, 108, 0.14),
                inset -4px -4px 9px rgba(255, 255, 255, 0.78);
        }

        .scrolltop {
            background: var(--neo-surface) !important;
            box-shadow:
                5px 5px 11px var(--neo-dark-soft),
                -5px -5px 11px var(--neo-light);
        }

        .scrolltop svg path,
        .scrolltop svg rect {
            fill: var(--neo-primary);
        }

        @media (max-width: 991.98px) {
            .neo-page {
                padding-top: 94px;
            }

            .neo-header {
                padding: 10px 0;
                background: transparent !important;
            }

            .neo-navbar {
                height: 68px;
                padding: 10px 12px;
                border-radius: 18px;
            }

            .neo-navbar-inner {
                height: 48px;
            }

            .neo-content {
                padding-top: 10px;
            }

            .neo-menu-toggle {
                display: inline-flex;
            }

            .neo-logo {
                width: 44px;
                height: 44px;
                border-radius: 14px;
            }

            .neo-logo img {
                width: 32px;
                height: 32px;
            }

            .neo-brand-title {
                max-width: 230px;
                font-size: 14px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .neo-brand-subtitle {
                max-width: 230px;
                display: block;
                font-size: 11px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .neo-menu-area {
                position: absolute;
                top: calc(100% + 10px);
                left: 12px;
                right: 12px;
                z-index: 2147483003 !important;

                display: flex;
                flex-direction: column;
                align-items: stretch;
                justify-content: flex-start;
                gap: 12px;

                padding: 14px;
                border-radius: 18px;
                background: var(--neo-surface);
                box-shadow:
                    8px 8px 18px var(--neo-dark),
                    -8px -8px 18px var(--neo-light);

                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px) scale(0.98);
                pointer-events: none;
                transition: 0.22s ease;
            }

            .neo-menu-area.is-open {
                opacity: 1;
                visibility: visible;
                transform: translateY(0) scale(1);
                pointer-events: auto;
            }

            .neo-menu {
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                justify-content: flex-start;
                gap: 12px;
            }

            .neo-menu-link {
                width: 100%;
                min-height: 44px;
            }

            .neo-actions {
                width: 100%;
                margin-left: 0;
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }

            .neo-btn {
                width: 100%;
                min-height: 44px;
            }

            .neo-user-wrapper {
                width: 100%;
                display: block;
            }

            .neo-user-bg {
                height: 44px;
                border-radius: 14px;
            }

            .neo-user-wrapper.is-open .neo-user-bg {
                height: 198px;
                border-radius: 14px 14px 20px 20px;
            }

            .neo-user-dropdown {
                top: 46px;
            }
        }

        @media (max-width: 575.98px) {
            .neo-page {
                padding-top: 92px;
            }

            .neo-header {
                padding: 10px 0;
            }

            .neo-brand-title {
                max-width: 145px;
                font-size: 13px;
            }

            .neo-brand-subtitle {
                display: block !important;
                max-width: 145px;
                font-size: 10px;
            }

            .neo-content {
                padding-top: 10px;
            }
        }

        @media (max-width: 380px) {
            .neo-brand-title {
                max-width: 118px;
            }

            .neo-brand-subtitle {
                max-width: 118px;
                font-size: 9.5px;
            }

            .neo-logo {
                width: 40px;
                height: 40px;
            }

            .neo-logo img {
                width: 30px;
                height: 30px;
            }

            .neo-menu-toggle {
                width: 40px;
                height: 40px;
            }
        }
    </style>

    @yield('css')
</head>

<body id="kt_body" class="app-default">
    <div class="neo-header">
        <div class="container">
            <div class="neo-navbar">
                <div class="neo-navbar-inner">
                    <a class="neo-brand" href="{{ route('index') }}">
                        <span class="neo-logo">
                            <img alt="Logo" src="{{ asset('assets/media/logos/logo.webp') }}">
                        </span>

                        <span class="neo-brand-text">
                            <span class="neo-brand-title">MOOC</span>
                            <span class="neo-brand-subtitle">Universitas Nurul Jadid</span>
                        </span>
                    </a>

                    <button class="neo-menu-toggle" id="neoMenuToggle" type="button" aria-label="Buka menu"
                        aria-expanded="false">
                        <span></span>
                    </button>

                    <div class="neo-menu-area" id="neoMenuArea">
                        <ul class="neo-menu">
                            <li class="neo-menu-item">
                                <a href="{{ route('index') }}"
                                    class="neo-menu-link {{ request()->routeIs('index') ? 'active' : '' }}">
                                    Beranda
                                </a>
                            </li>

                            <li class="neo-menu-item">
                                <a href="{{ route('kursus.index') }}"
                                    class="neo-menu-link {{ request()->routeIs('kursus.*') ? 'active' : '' }}">
                                    Kursus
                                </a>
                            </li>

                            @if (Auth::guard('pengguna')->check())
                                <li class="neo-menu-item">
                                    <div class="neo-user-wrapper" id="neoUserWrapper">
                                        <span class="neo-user-bg"></span>

                                        <button class="neo-btn neo-btn-primary neo-dashboard-toggle"
                                            id="neoDashboardToggle" type="button" aria-expanded="false">
                                            <i class="bi bi-person-circle"></i>
                                            <span>Dashboard</span>
                                            <i class="bi bi-chevron-down neo-dashboard-chevron"></i>
                                        </button>

                                        <div class="neo-user-dropdown" id="neoUserDropdown">
                                            <a href="{{ route('pengguna.kelas_saya') }}"
                                                class="neo-user-dropdown-link">
                                                <i class="bi bi-collection-play"></i>
                                                <span>Kelas Saya</span>
                                            </a>

                                            <a href="{{ route('pengguna.profil') }}"
                                                class="neo-user-dropdown-link">
                                                <i class="bi bi-person-circle"></i>
                                                <span>Profil</span>
                                            </a>

                                            <div class="neo-user-dropdown-divider"></div>

                                            <a href="{{ route('logout') }}"
                                                class="neo-user-dropdown-link text-danger">
                                                <i class="bi bi-box-arrow-right"></i>
                                                <span>Keluar Aplikasi</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @else
                                <li class="neo-menu-item">
                                    <div class="neo-actions">
                                        <a href="{{ route('daftar') }}" class="neo-btn neo-btn-soft">
                                            Daftar
                                        </a>

                                        <a href="{{ route('login') }}" class="neo-btn neo-btn-primary">
                                            Login
                                        </a>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column flex-root neo-page">
        <div class="content d-flex flex-column flex-column-fluid neo-content" id="kt_content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container">
                    @yield('content')
                </div>
            </div>
        </div>

        <div class="neo-footer mt-auto">
            <div class="container">
                <div class="neo-footer-card">
                    © 2025 UNIVERSITAS NURUL JADID
                </div>
            </div>
        </div>

        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <span class="svg-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                        transform="rotate(90 13 6)" fill="black" />
                    <path
                        d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                        fill="black" />
                </svg>
            </span>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuToggle = document.getElementById('neoMenuToggle');
            const menuArea = document.getElementById('neoMenuArea');
            const userWrapper = document.getElementById('neoUserWrapper');
            const dashboardToggle = document.getElementById('neoDashboardToggle');

            function closeDashboardMenu() {
                if (!userWrapper || !dashboardToggle) return;

                userWrapper.classList.remove('is-open');
                dashboardToggle.setAttribute('aria-expanded', 'false');
            }

            function closeMobileMenu() {
                if (!menuToggle || !menuArea) return;

                menuArea.classList.remove('is-open');
                menuToggle.classList.remove('is-open');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'Buka menu');
                closeDashboardMenu();
            }

            if (menuToggle && menuArea) {
                menuToggle.addEventListener('click', function () {
                    const isOpen = menuArea.classList.toggle('is-open');

                    menuToggle.classList.toggle('is-open', isOpen);
                    menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                    menuToggle.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');

                    if (!isOpen) {
                        closeDashboardMenu();
                    }
                });

                const menuLinks = menuArea.querySelectorAll('a');

                menuLinks.forEach(function (link) {
                    link.addEventListener('click', function () {
                        if (window.innerWidth <= 991) {
                            closeMobileMenu();
                        } else {
                            closeDashboardMenu();
                        }
                    });
                });
            }

            if (dashboardToggle && userWrapper) {
                dashboardToggle.addEventListener('click', function (event) {
                    event.preventDefault();
                    event.stopPropagation();

                    const isOpen = userWrapper.classList.toggle('is-open');
                    dashboardToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            }

            document.addEventListener('click', function (event) {
                const clickedInsideNavbar = event.target.closest('.neo-header');
                const clickedInsideDashboard = event.target.closest('.neo-user-wrapper');

                if (!clickedInsideDashboard) {
                    closeDashboardMenu();
                }

                if (!clickedInsideNavbar && window.innerWidth <= 991) {
                    closeMobileMenu();
                }
            });

            window.addEventListener('resize', function () {
                closeDashboardMenu();

                if (window.innerWidth >= 992) {
                    closeMobileMenu();
                }
            });
        });
    </script>

    @if(session()->has('successlogin') && session()->get('successlogin'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session()->get('successlogin') }}",
                timer: 1500,
                showConfirmButton: false,
                timerProgressBar: true,
                allowOutsideClick: false,
                allowEscapeKey: false
            });
        </script>
    @endif

    @yield('javascript')
    @stack('scripts')
</body>

</html>