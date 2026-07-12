@extends('content.layouts')

@section('css')
    <style>
        :root {
            --pg-primary: #009ef7;
            --pg-primary-dark: #008bd8;
            --pg-primary-soft: #eaf6ff;
            --pg-bg: #f8fafc;
            --pg-surface: #ffffff;
            --pg-border: #e5e7eb;
            --pg-text: #111827;
            --pg-muted: #64748b;
        }

        .pengguna-wrapper {
            width: 100%;
            min-height: calc(100vh - 150px);
        }

        .pengguna-wrapper .flex-lg-row-fluid {
            width: 100%;
            margin-left: 0 !important;
        }

        .pengguna-gap-tight {
            gap: 1rem;
        }

        .pengguna-header-card {
            position: relative;
            overflow: hidden;
            border: 1px solid var(--pg-border) !important;
            border-radius: 22px !important;
            background: var(--pg-surface) !important;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06) !important;
            max-height: 280px;
            opacity: 1;
            transform: translateY(0) scale(1);
            transition:
                opacity .24s ease,
                transform .24s ease,
                margin .24s ease,
                max-height .28s ease,
                padding .24s ease;
        }

        .pengguna-header-card::before,
        .pengguna-header-card::after {
            display: none !important;
            content: none !important;
        }

        .pengguna-header-card.is-hidden {
            opacity: 0;
            transform: translateY(-10px) scale(.99);
            max-height: 0;
            margin-bottom: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            pointer-events: none;
        }

        .pengguna-header-card.is-showing {
            animation: penggunaWelcomeShow .28s ease both;
        }

        @keyframes penggunaWelcomeShow {
            from {
                opacity: 0;
                transform: translateY(-10px) scale(.99);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .pengguna-header-card > * {
            position: relative;
            z-index: 1;
        }

        .pengguna-header-close {
            position: absolute;
            top: 14px;
            right: 14px;
            z-index: 10;
            width: 32px;
            height: 32px;
            border: 1px solid var(--pg-border);
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--pg-muted);
            background: #ffffff;
            transition: .18s ease;
            cursor: pointer;
        }

        .pengguna-header-close:hover {
            color: var(--pg-primary);
            background: var(--pg-primary-soft);
            border-color: rgba(0, 158, 247, 0.24);
            transform: translateY(-1px);
        }

        .pengguna-header-close i {
            font-size: 14px;
        }

        .pengguna-header-avatar {
            width: 68px;
            height: 68px;
            border-radius: 999px;
            padding: 4px;
            background: #ffffff;
            border: 1px solid var(--pg-border);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
            overflow: hidden;
            flex-shrink: 0;
        }

        .pengguna-header-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 999px;
            object-fit: cover;
            display: block;
        }

        .pengguna-welcome-label {
            color: var(--pg-primary);
            font-weight: 900;
            letter-spacing: .055em;
        }

        .pengguna-welcome-title {
            color: var(--pg-text);
            font-weight: 900;
            letter-spacing: -.028em;
        }

        .pengguna-welcome-desc {
            color: var(--pg-muted);
            font-weight: 600;
            line-height: 1.6;
        }

        .pengguna-header-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: flex-start;
            padding-right: 42px;
        }

        .pengguna-btn-neo {
            min-height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 0 18px;
            border-radius: 14px !important;
            font-weight: 900 !important;
            line-height: 1;
            white-space: nowrap;
            transition: .18s ease;
            border: 1px solid transparent !important;
            box-shadow: none !important;
        }

        .pengguna-btn-neo i {
            font-size: 1.05rem;
        }

        .pengguna-btn-neo-primary {
            background: var(--pg-primary) !important;
            color: #ffffff !important;
            border-color: var(--pg-primary) !important;
            box-shadow: 0 12px 26px rgba(0, 158, 247, 0.20) !important;
        }

        .pengguna-btn-neo-primary:hover {
            background: var(--pg-primary-dark) !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        .pengguna-btn-neo-soft {
            background: #ffffff !important;
            color: var(--pg-primary) !important;
            border-color: var(--pg-border) !important;
        }

        .pengguna-btn-neo-soft:hover {
            color: var(--pg-primary-dark) !important;
            background: var(--pg-primary-soft) !important;
            border-color: rgba(0, 158, 247, 0.24) !important;
            transform: translateY(-1px);
        }

        .pengguna-card-tight {
            border: 1px solid var(--pg-border) !important;
            border-radius: 22px !important;
            background: var(--pg-surface) !important;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06) !important;
            overflow: hidden;
        }

        .pengguna-card-tight .card-body {
            padding: 0 !important;
            background: transparent !important;
        }

        .pengguna-nav-wrap {
            padding: 18px 20px 0;
        }

        .pengguna-nav {
            display: flex;
            align-items: center;
            gap: 10px !important;
            overflow-x: auto;
            white-space: nowrap;
            padding: 6px !important;
            border: 1px solid var(--pg-border) !important;
            border-radius: 18px;
            background: var(--pg-bg);
        }

        .pengguna-nav::-webkit-scrollbar {
            height: 0;
        }

        .pengguna-nav .nav-item {
            padding: 0 !important;
            flex-shrink: 0;
        }

        .pengguna-nav .nav-link {
            min-height: 44px;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px !important;
            padding: 0 18px !important;
            border: 0 !important;
            border-radius: 14px !important;
            color: var(--pg-muted) !important;
            background: transparent !important;
            font-weight: 900 !important;
            transition: .18s ease;
            box-shadow: none !important;
        }

        .pengguna-nav .nav-link i {
            font-size: 1rem;
        }

        .pengguna-nav .nav-link:hover,
        .pengguna-nav .nav-link.active {
            color: var(--pg-primary) !important;
            background: #ffffff !important;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.05) !important;
        }

        .pengguna-content-area {
            padding: 20px;
        }

        @media (max-width: 991.98px) {
            .pengguna-header-card,
            .pengguna-card-tight {
                border-radius: 20px !important;
            }

            .pengguna-header-card {
                padding: 22px !important;
                max-height: 420px;
            }

            .pengguna-header-card.is-hidden {
                max-height: 0;
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }

            .pengguna-header-actions {
                width: 100%;
                padding-right: 0;
            }

            .pengguna-header-actions .pengguna-btn-neo {
                flex: 1 1 0;
            }

            .pengguna-nav-wrap {
                padding: 16px 16px 0;
            }

            .pengguna-content-area {
                padding: 16px;
            }
        }

        @media (max-width: 767.98px) {
            .pengguna-header-card {
                padding: 18px !important;
                border-radius: 18px !important;
                max-height: 480px;
                box-shadow: 0 14px 34px rgba(15, 23, 42, 0.06) !important;
            }

            .pengguna-header-card.is-hidden {
                max-height: 0;
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }

            .pengguna-header-close {
                top: 12px;
                right: 12px;
                width: 30px;
                height: 30px;
            }

            .pengguna-header-avatar {
                width: 58px;
                height: 58px;
            }

            .pengguna-welcome-title {
                font-size: 1.15rem !important;
            }

            .pengguna-welcome-desc {
                font-size: 12px;
            }

            .pengguna-header-actions {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
            }

            .pengguna-header-actions .pengguna-btn-neo {
                width: 100%;
                min-height: 46px;
                padding-left: 10px;
                padding-right: 10px;
                border-radius: 14px !important;
            }

            .pengguna-card-tight {
                background: transparent !important;
                box-shadow: none !important;
                border: 0 !important;
                border-radius: 0 !important;
            }

            .pengguna-nav-wrap {
                padding: 0 0 14px;
            }

            .pengguna-nav {
                display: grid !important;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px !important;
                width: 100%;
                padding: 8px !important;
                border-radius: 18px;
                background: #ffffff !important;
                border: 1px solid var(--pg-border) !important;
                box-shadow: 0 12px 30px rgba(15, 23, 42, 0.05) !important;
            }

            .pengguna-nav .nav-item {
                width: 100%;
            }

            .pengguna-nav .nav-link {
                width: 100%;
                min-height: 46px;
                padding: 0 10px !important;
                background: transparent !important;
            }

            .pengguna-nav .nav-link:hover,
            .pengguna-nav .nav-link.active {
                color: var(--pg-primary) !important;
                background: var(--pg-primary-soft) !important;
                box-shadow: none !important;
            }

            .pengguna-content-area {
                padding: 0 !important;
            }
        }

        @media (max-width: 420px) {
            .pengguna-header-card {
                padding: 16px !important;
                max-height: 520px;
            }

            .pengguna-header-card.is-hidden {
                max-height: 0;
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }

            .pengguna-header-card .d-flex.align-items-center {
                align-items: flex-start !important;
            }

            .pengguna-header-avatar {
                width: 54px;
                height: 54px;
            }

            .pengguna-welcome-label {
                font-size: 10px;
            }

            .pengguna-welcome-title {
                font-size: 1.05rem !important;
            }

            .pengguna-btn-neo,
            .pengguna-nav .nav-link {
                font-size: 12px;
                gap: 6px !important;
            }
        }
    </style>

    @yield('pengguna_css')
@endsection

@section('content')
    @php
        $user = Auth::guard('pengguna')->user();

        $profil = $user->foto_profil
            ? route('view-file', ['folder' => 'profil', 'filename' => $user->foto_profil])
            : asset('assets/media/avatars/blank.png');

        $kelasBelumSelesai = \App\Models\Pendaftaran::query()
            ->where('id_pengguna', $user->id_pengguna)
            ->where('status', 'aktif')
            ->orderByRaw('terakhir_akses IS NULL')
            ->orderByDesc('terakhir_akses')
            ->orderByDesc('terdaftar_pada')
            ->first();

        $lanjutkanBelajarUrl = $kelasBelumSelesai
            ? route('pengguna.course_playing', \App\Support\IdCipher::encode($kelasBelumSelesai->id_pendaftaran))
            : route('pengguna.kelas_saya');
    @endphp

    <div class="pengguna-wrapper d-flex flex-column flex-lg-row">
        <div class="flex-lg-row-fluid">
            <div id="penggunaWelcomeCard"
                class="pengguna-header-card p-4 mb-5 d-flex flex-column flex-md-row align-items-md-center justify-content-between pengguna-gap-tight">

                <button type="button" id="penggunaWelcomeClose" class="pengguna-header-close"
                    aria-label="Tutup card selamat datang">
                    <i class="bi bi-x-lg"></i>
                </button>

                <div class="d-flex align-items-center">
                    <div class="pengguna-header-avatar me-4">
                        <img src="{{ $profil }}" alt="{{ $user->nama }}" loading="lazy" decoding="async">
                    </div>

                    <div>
                        <div class="text-uppercase small mb-1 pengguna-welcome-label">
                            Selamat Datang Kembali
                        </div>

                        <h2 class="mb-1 d-flex align-items-center gap-2 fs-4 pengguna-welcome-title">
                            {{ $user->nama }}
                        </h2>

                        <div class="small pengguna-welcome-desc">
                            Kelola progres belajar, kelas yang sedang diikuti, dan profilmu dari satu tempat.
                        </div>
                    </div>
                </div>

                <div class="pengguna-header-actions">
                    <a href="{{ $lanjutkanBelajarUrl }}"
                        class="pengguna-btn-neo pengguna-btn-neo-primary pengguna-welcome-trigger">
                        <i class="bi bi-play-circle"></i>
                        <span>Lanjutkan Belajar</span>
                    </a>

                    <a href="{{ route('pengguna.profil') }}"
                        class="pengguna-btn-neo pengguna-btn-neo-soft pengguna-welcome-trigger">
                        <i class="bi bi-person-lines-fill"></i>
                        <span>Profil</span>
                    </a>
                </div>
            </div>

            <div class="card pengguna-card-tight mb-4">
                <div class="card-body">
                    <div class="pengguna-nav-wrap">
                        <ul class="nav pengguna-nav">
                            <li class="nav-item">
                                <a class="nav-link pengguna-welcome-trigger {{ request()->routeIs('pengguna.kelas_saya', 'pengguna.course_playing') ? 'active' : '' }}"
                                    href="{{ route('pengguna.kelas_saya') }}">
                                    <i class="bi bi-journal-bookmark"></i>
                                    <span>Kelas Saya</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link pengguna-welcome-trigger {{ request()->routeIs('pengguna.profil') ? 'active' : '' }}"
                                    href="{{ route('pengguna.profil') }}">
                                    <i class="bi bi-person-circle"></i>
                                    <span>Profil</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="pengguna-content-area">
                        @yield('pengguna_content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const welcomeCard = document.getElementById('penggunaWelcomeCard');
            const welcomeClose = document.getElementById('penggunaWelcomeClose');
            const welcomeTriggers = document.querySelectorAll('.pengguna-welcome-trigger');

            function normalizePath(url) {
                const parsedUrl = new URL(url, window.location.origin);

                return parsedUrl.pathname.replace(/\/+$/, '');
            }

            function showWelcomeCard() {
                if (!welcomeCard) return;

                welcomeCard.classList.remove('is-hidden');
                welcomeCard.classList.remove('is-showing');

                void welcomeCard.offsetWidth;

                welcomeCard.classList.add('is-showing');

                setTimeout(function () {
                    welcomeCard.classList.remove('is-showing');
                }, 360);
            }

            function hideWelcomeCard() {
                if (!welcomeCard) return;

                welcomeCard.classList.remove('is-showing');
                welcomeCard.classList.add('is-hidden');
            }

            if (welcomeCard && welcomeClose) {
                welcomeClose.addEventListener('click', function () {
                    hideWelcomeCard();
                });
            }

            welcomeTriggers.forEach(function (trigger) {
                trigger.addEventListener('click', function (event) {
                    const targetUrl = this.getAttribute('href');

                    if (!targetUrl) return;

                    const currentPath = normalizePath(window.location.href);
                    const targetPath = normalizePath(targetUrl);

                    if (currentPath === targetPath) {
                        event.preventDefault();
                        showWelcomeCard();
                    }
                });
            });
        });
    </script>
@endpush