<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Massive Open Online Course (MOOC)</title>

    <link rel="icon" href="{{ asset('assets/media/logos/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fonts/font.css') }}" media="print"
        onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('assets/plugins/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.bundle.css') }}">

    <meta name="X-CSRF-TOKEN" content="{{ csrf_token() }}">

    @yield('css')
</head>

<body id="kt_body" class="app-default bg-white">
    <div class="d-flex flex-column flex-root">
        <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom m-0">
            <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header"
                data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                <div class="container">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center flex-equal">
                            <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none"
                                id="kt_landing_menu_toggle" type="button" aria-label="Buka menu navigasi">
                                <span class="svg-icon svg-icon-2x mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                            fill="black" />
                                        <path opacity="0.3"
                                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </button>

                            <img alt="Logo" src="{{ asset('assets/media/logos/logo.webp') }}"
                                class="logo-default h-60px h-lg-60px p-2 d-lg-block" />

                            <a class="fw-bolder mx-2 my-3 d-lg-none" href="{{ route('index') }}">
                                Massive Open Online Course
                            </a>

                            <a class="fw-bolder mx-2 my-3 d-none d-lg-block fs-4" href="{{ route('index') }}">
                                Massive Open Online Course
                            </a>
                        </div>

                        <div class="d-lg-block" id="kt_header_nav_wrapper">
                            <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true"
                                data-kt-drawer-name="landing-menu"
                                data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                                data-kt-drawer-width="300px" data-kt-drawer-direction="start"
                                data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true"
                                data-kt-swapper-mode="{default: 'append', lg: 'prepend'}">

                                <div id="kt_landing_menu"
                                    class="menu menu-column menu-lg-row flex-lg-nowrap align-items-lg-center menu-rounded menu-state-title-primary nav fs-6 fw-semibold gap-2 gap-lg-3"
                                    data-kt-menu="true">

                                    <div class="menu-item my-2 my-lg-0 mx-lg-1">
                                        <a href="{{ route('index') }}"
                                            class="menu-link nav-link px-3 py-2 rounded-pill text-body btn-hover-primary text-hover-white {{ request()->routeIs('index') ? 'active' : '' }}">
                                            <span class="menu-title">Beranda</span>
                                        </a>
                                    </div>

                                    <div class="menu-item my-2 my-lg-0 mx-lg-1">
                                        <a href="{{ route('kursus.index') }}"
                                            class="menu-link nav-link px-3 py-2 rounded-pill text-body btn-hover-primary text-hover-white {{ request()->routeIs('kursus.*') ? 'active' : '' }}">
                                            <span class="menu-title">Kursus</span>
                                        </a>
                                    </div>

                                    <div class="d-none d-lg-block flex-grow-1"></div>

                                    @if (Auth::guard('pengguna')->check())
                                        <div class="menu-item my-1 my-lg-0">
                                            <div class="d-flex align-items-center" id="kt_header_user_menu_toggle">
                                                <div class="cursor-pointer btn btn-primary fw-semibold px-4 px-lg-5 py-2 rounded-pill shadow-sm d-flex align-items-center"
                                                    data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                                    data-kt-menu-placement="bottom-end">
                                                    <span class="me-2">
                                                        <i class="bi bi-person-circle"></i>
                                                    </span>
                                                    <span class="fw-semibold">Dashboard</span>
                                                </div>

                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-7 w-275px"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-5">
                                                        <a href="{{ route('pengguna.kelas_saya') }}"
                                                            class="menu-link px-5">
                                                            <span class="menu-icon">
                                                                <i class="bi bi-collection-play"></i>
                                                            </span>
                                                            <span class="menu-title">Kelas Saya</span>
                                                        </a>
                                                    </div>

                                                    <div class="menu-item px-5">
                                                        <a href="{{ route('pengguna.profil') }}" class="menu-link px-5">
                                                            <span class="menu-icon">
                                                                <i class="bi bi-person-circle"></i>
                                                            </span>
                                                            <span class="menu-title">Profil</span>
                                                        </a>
                                                    </div>

                                                    <div class="separator my-3"></div>

                                                    <div class="menu-item px-5">
                                                        <a href="{{ route('logout') }}"
                                                            class="menu-link px-5 text-danger">
                                                            <span class="menu-icon">
                                                                <i class="bi bi-box-arrow-right"></i>
                                                            </span>
                                                            <span class="menu-title">Keluar Aplikasi</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="menu-item my-2 my-lg-0 mx-lg-1">
                                            <a href="{{ route('daftar') }}"
                                                class="btn btn-warning fw-semibold px-4 px-lg-5 py-2 rounded-pill shadow-sm d-flex align-items-center">
                                                <i class="bi bi-person-plus-fill me-2 d-none d-lg-inline"></i>
                                                <span>Daftar</span>
                                            </a>
                                        </div>

                                        <div class="menu-item my-2 my-lg-0 mx-lg-1">
                                            <a href="{{ route('login') }}"
                                                class="btn btn-primary fw-semibold px-4 px-lg-5 py-2 rounded-pill shadow-sm d-flex align-items-center">
                                                <i class="bi bi-box-arrow-in-right me-2 d-none d-lg-inline"></i>
                                                <span>Login</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container">
                    @yield('content')
                </div>
            </div>
        </div>

        <div class="mb-0 fs-6 landing-dark-bg mt-auto">
            <div class="container">
                <div class="d-flex justify-content-center my-2">
                    <span class="text-white pt-1 text-center">
                        © 2025 UNIVERSITAS NURUL JADID
                    </span>
                </div>
            </div>
        </div>

        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <span class="svg-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
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
