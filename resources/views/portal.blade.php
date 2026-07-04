<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Massive Open Online Course (MOOC)</title>

    <link rel="icon" href="{{ asset('assets/media/logos/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fonts/font.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('assets/plugins/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.bundle.css') }}">

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
            --neo-inset-dark: rgba(120, 113, 108, 0.16);
            --neo-inset-light: rgba(255, 255, 255, 0.78);
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            background: var(--neo-bg) !important;
            overflow-x: hidden;
        }

        body#kt_body {
            min-height: 100vh;
            background: var(--neo-bg) !important;
            color: var(--neo-text);
        }

        a {
            text-decoration: none;
        }

        .neo-auth-page {
            min-height: 100vh;
            background:
                radial-gradient(circle at 0% 0%, rgba(255, 255, 255, 0.72), transparent 34%),
                radial-gradient(circle at 100% 0%, rgba(0, 158, 247, 0.10), transparent 32%),
                radial-gradient(circle at 50% 100%, rgba(255, 255, 255, 0.52), transparent 38%),
                var(--neo-bg);
            padding: 0;
        }

        .neo-auth-shell {
            width: 100%;
            min-height: 100vh;
            background: transparent;
            overflow: hidden;
        }

        .neo-back-floating {
            position: fixed !important;
            top: 22px !important;
            left: 24px !important;
            z-index: 99999 !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 44px;
            padding: 0 18px;
            border-radius: 16px;
            color: var(--neo-text);
            font-weight: 700;
            background: var(--neo-surface);
            box-shadow:
                6px 6px 14px var(--neo-dark-soft),
                -6px -6px 14px var(--neo-light);
            transition: 0.2s ease;
        }

        .neo-back-floating:hover {
            color: var(--neo-primary);
            transform: translateY(-1px);
        }

        .neo-hero-panel,
        .neo-form-panel {
            min-height: 100vh;
        }

        .neo-hero-panel {
            position: relative;
            display: flex;
            align-items: center;
            background:
                radial-gradient(circle at 10% 10%, rgba(255, 255, 255, 0.75), transparent 32%),
                radial-gradient(circle at 90% 90%, rgba(0, 158, 247, 0.10), transparent 36%),
                transparent;
            overflow: hidden;
        }

        .neo-hero-panel::before {
            content: "";
            position: absolute;
            width: 360px;
            height: 360px;
            right: -160px;
            top: -150px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0, 158, 247, 0.14), transparent 68%);
            pointer-events: none;
        }

        .neo-hero-panel::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            left: -190px;
            bottom: -190px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.72), transparent 64%);
            pointer-events: none;
        }

        .neo-hero-content {
            position: relative;
            z-index: 1;
            width: 100%;
        }

        .neo-brand-box {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .neo-logo-box {
            width: 72px;
            height: 72px;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--neo-surface);
            box-shadow:
                8px 8px 18px var(--neo-dark-soft),
                -8px -8px 18px var(--neo-light);
            overflow: hidden;
            flex-shrink: 0;
        }

        .neo-logo-box img {
            width: 52px;
            height: 52px;
            object-fit: contain;
        }

        .neo-brand-title {
            color: var(--neo-text);
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 4px;
        }

        .neo-brand-subtitle {
            color: var(--neo-muted);
            font-weight: 600;
        }

        .neo-title {
            color: var(--neo-text);
            letter-spacing: -0.035em;
            line-height: 1.12;
        }

        .neo-title .text-primary {
            color: var(--neo-primary) !important;
        }

        .neo-desc {
            color: var(--neo-muted);
            max-width: 620px;
            line-height: 1.8;
        }

        .neo-feature-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            max-width: 680px;
        }

        .neo-feature-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 18px;
            border-radius: 22px;
            background: var(--neo-surface);
            box-shadow:
                8px 8px 18px var(--neo-dark-soft),
                -8px -8px 18px var(--neo-light);
            transition: 0.2s ease;
        }

        .neo-feature-item:hover {
            transform: translateY(-3px);
            box-shadow:
                10px 10px 24px var(--neo-dark),
                -10px -10px 24px var(--neo-light);
        }

        .neo-feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--neo-primary);
            background: var(--neo-surface);
            box-shadow:
                inset 4px 4px 9px var(--neo-inset-dark),
                inset -4px -4px 9px var(--neo-inset-light);
            flex-shrink: 0;
        }

        .neo-feature-title {
            color: var(--neo-text);
            font-weight: 800;
            margin-bottom: 4px;
        }

        .neo-feature-desc {
            color: var(--neo-muted);
            font-weight: 600;
            font-size: 13px;
        }

        .neo-form-panel {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
        }

        .neo-form-inner {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .neo-login-card {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            border-radius: 30px;
            padding: 42px;
            background: var(--neo-surface);
            box-shadow:
                10px 10px 24px var(--neo-dark),
                -10px -10px 24px var(--neo-light);
        }

        .neo-login-title {
            color: var(--neo-text);
            letter-spacing: -0.03em;
        }

        .neo-login-subtitle {
            color: var(--neo-muted);
        }

        .neo-input-group {
            border-radius: 17px;
            background: var(--neo-surface);
            box-shadow:
                inset 5px 5px 12px var(--neo-inset-dark),
                inset -5px -5px 12px var(--neo-inset-light);
            overflow: hidden;
            padding: 2px;
        }

        .neo-input-group .input-group-text {
            border: 0 !important;
            background: transparent !important;
            color: var(--neo-primary);
            padding-left: 18px;
            padding-right: 10px;
        }

        .neo-input-group .form-control {
            border: 0 !important;
            background: transparent !important;
            color: var(--neo-text);
            box-shadow: none !important;
            min-height: 52px;
            font-weight: 600;
        }

        .neo-input-group .form-control::placeholder {
            color: #94a3b8;
            font-weight: 500;
        }

        .neo-input-group .form-control:focus {
            background: transparent !important;
        }

        .neo-input-group .cursor-pointer {
            color: var(--neo-muted);
            padding-right: 18px;
        }

        .form-label {
            color: var(--neo-text) !important;
        }

        .form-check-input {
            border: 0 !important;
            background-color: var(--neo-surface) !important;
            box-shadow:
                inset 3px 3px 7px var(--neo-inset-dark),
                inset -3px -3px 7px var(--neo-inset-light) !important;
        }

        .form-check-input:checked {
            background-color: var(--neo-primary) !important;
            box-shadow:
                3px 3px 8px var(--neo-dark-soft),
                -3px -3px 8px var(--neo-light) !important;
        }

        .link-primary {
            color: var(--neo-primary) !important;
        }

        .link-primary:hover {
            color: var(--neo-primary-dark) !important;
        }

        .neo-btn-primary,
        .btn.btn-primary {
            border: 0 !important;
            border-radius: 16px !important;
            background: var(--neo-primary) !important;
            color: #ffffff !important;
            font-weight: 800;
            min-height: 52px;
            box-shadow:
                6px 6px 14px rgba(120, 113, 108, 0.28),
                -6px -6px 14px rgba(255, 255, 255, 0.72);
            transition: 0.2s ease;
        }

        .neo-btn-primary:hover,
        .btn.btn-primary:hover,
        .btn.btn-primary:focus {
            background: var(--neo-primary-dark) !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        .neo-register-box {
            border-radius: 18px;
            padding: 16px;
            background: var(--neo-surface);
            box-shadow:
                inset 4px 4px 10px rgba(120, 113, 108, 0.13),
                inset -4px -4px 10px rgba(255, 255, 255, 0.76);
        }

        .alert {
            border: 0 !important;
            border-radius: 18px !important;
            box-shadow:
                5px 5px 12px var(--neo-dark-soft),
                -5px -5px 12px var(--neo-light);
        }

        @media (max-width: 991.98px) {
            html,
            body,
            body#kt_body {
                background: var(--neo-bg) !important;
            }

            .neo-auth-page,
            .neo-auth-shell {
                min-height: 100vh;
                background:
                    radial-gradient(circle at 0% 0%, rgba(255, 255, 255, 0.72), transparent 34%),
                    radial-gradient(circle at 100% 0%, rgba(0, 158, 247, 0.10), transparent 32%),
                    radial-gradient(circle at 50% 100%, rgba(255, 255, 255, 0.52), transparent 38%),
                    var(--neo-bg);
            }

            .neo-auth-shell {
                overflow: visible;
            }

            .neo-back-floating {
                top: 18px !important;
                left: 18px !important;
                min-height: 42px;
                box-shadow:
                    5px 5px 14px var(--neo-dark-soft),
                    -5px -5px 14px var(--neo-light);
            }

            .neo-form-panel {
                width: 100% !important;
                min-height: auto;
                padding: 86px 22px 24px !important;
                display: flex;
                align-items: center;
                justify-content: center;
                background: transparent;
                order: 1 !important;
            }

            .neo-form-inner {
                min-height: auto;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 0;
            }

            .neo-login-card {
                max-width: 500px;
                padding: 34px;
                border-radius: 26px;
                background: var(--neo-surface);
                box-shadow:
                    10px 10px 24px var(--neo-dark),
                    -10px -10px 24px var(--neo-light);
            }

            .neo-hero-panel {
                width: 100% !important;
                min-height: auto;
                display: flex !important;
                padding: 10px 22px 34px !important;
                background: transparent;
                overflow: visible;
                order: 2 !important;
            }

            .neo-hero-panel::before,
            .neo-hero-panel::after {
                display: none;
            }

            .neo-hero-content {
                max-width: 500px;
                margin: 0 auto;
            }

            .neo-hero-content > .mb-10:first-child {
                margin-bottom: 1.5rem !important;
            }

            .neo-brand-box {
                align-items: center;
                gap: 14px;
            }

            .neo-logo-box {
                width: 58px;
                height: 58px;
                border-radius: 20px;
                background: var(--neo-surface);
                box-shadow:
                    6px 6px 16px var(--neo-dark-soft),
                    -6px -6px 16px var(--neo-light);
            }

            .neo-logo-box img {
                width: 42px;
                height: 42px;
            }

            .neo-brand-title {
                font-size: 1rem !important;
            }

            .neo-brand-subtitle {
                opacity: 0.85;
            }

            .neo-title {
                font-size: 1.85rem !important;
                margin-bottom: 1rem !important;
            }

            .neo-desc {
                font-size: 0.98rem !important;
                line-height: 1.65;
            }

            .neo-feature-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
                max-width: 500px;
            }

            .neo-feature-item {
                padding: 14px;
                border-radius: 18px;
                background: var(--neo-surface);
                box-shadow:
                    6px 6px 16px var(--neo-dark-soft),
                    -6px -6px 16px var(--neo-light);
            }

            .neo-feature-item:hover {
                transform: none;
                box-shadow:
                    6px 6px 16px var(--neo-dark-soft),
                    -6px -6px 16px var(--neo-light);
            }

            .neo-feature-icon {
                width: 42px;
                height: 42px;
                border-radius: 14px;
                color: var(--neo-primary);
                background: var(--neo-surface);
                box-shadow:
                    inset 3px 3px 8px var(--neo-inset-dark),
                    inset -3px -3px 8px var(--neo-inset-light);
            }

            .neo-feature-title {
                font-size: 13px;
                margin-bottom: 2px;
            }

            .neo-feature-desc {
                font-size: 11px;
            }
        }

        @media (max-width: 767.98px) {
            .neo-form-panel {
                padding: 82px 18px 22px !important;
            }

            .neo-hero-panel {
                padding: 8px 18px 30px !important;
            }

            .neo-login-card {
                padding: 26px;
                border-radius: 22px;
            }

            .neo-feature-list {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }
        }

        @media (max-width: 575.98px) {
            .neo-back-floating {
                top: 16px !important;
                left: 16px !important;
            }

            .neo-form-panel {
                padding: 78px 16px 20px !important;
            }

            .neo-hero-panel {
                padding: 8px 16px 26px !important;
            }

            .neo-brand-box {
                align-items: flex-start;
            }

            .neo-title {
                font-size: 1.55rem !important;
            }

            .neo-desc {
                font-size: 0.93rem !important;
            }

            .neo-feature-list {
                grid-template-columns: 1fr;
            }

            .neo-feature-item {
                padding: 13px;
            }

            .neo-login-card {
                padding: 22px;
                border-radius: 20px;
            }

            .neo-login-title {
                font-size: 1.65rem !important;
            }

            .neo-login-subtitle {
                font-size: 0.95rem !important;
            }

            .neo-input-group .form-control {
                min-height: 50px;
            }

            .neo-btn-primary,
            .btn.btn-primary {
                min-height: 50px;
            }

            .d-flex.flex-stack.flex-wrap {
                align-items: flex-start !important;
            }
        }

        @media (max-width: 420px) {
            .neo-back-floating {
                min-height: 40px;
                padding: 0 14px;
                font-size: 13px;
                border-radius: 14px;
            }
        }

        @media (max-width: 360px) {
            .neo-back-floating {
                top: 12px !important;
                left: 12px !important;
                padding: 0 12px;
                font-size: 12px;
            }

            .neo-form-panel {
                padding: 70px 12px 18px !important;
            }

            .neo-hero-panel {
                padding: 6px 12px 24px !important;
            }

            .neo-login-card {
                padding: 18px;
            }
        }
    </style>
</head>

<body id="kt_body" class="app-default">
    <a href="{{ route('index') }}" class="neo-back-floating">
        <i class="bi bi-arrow-left"></i>
        <span>Kembali ke Beranda</span>
    </a>

    <div class="neo-auth-page">
        <div class="neo-auth-shell">
            <div class="d-flex flex-column flex-lg-row min-vh-100">

                <div class="neo-hero-panel w-lg-50 p-10 p-lg-15 order-2 order-lg-1">
                    <div class="neo-hero-content">
                        <div class="mb-10">
                            <div class="neo-brand-box mb-10">
                                <div class="neo-logo-box">
                                    <img src="{{ asset('assets/media/logos/logo.webp') }}" alt="Logo">
                                </div>

                                <div>
                                    <h2 class="neo-brand-title fs-3 mb-0">
                                        Massive Open Online Course (MOOC)
                                    </h2>
                                    <span class="neo-brand-subtitle fs-7">
                                        Universitas Nurul Jadid
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-10">
                            <h1 class="neo-title fw-bolder mb-5 display-5">
                                Belajar Tanpa Batas,<br>
                                <span class="text-primary">Kapan Saja, Di Mana Saja</span>
                            </h1>

                            <p class="neo-desc fs-5 fw-semibold mb-0">
                                Platform pembelajaran daring terpadu dengan akses ke ribuan materi berkualitas,
                                sistem penilaian otomatis, dan sertifikasi digital.
                            </p>
                        </div>

                        <div class="neo-feature-list">
                            <div class="neo-feature-item">
                                <div class="neo-feature-icon">
                                    <i class="bi bi-play-circle-fill fs-2"></i>
                                </div>
                                <div>
                                    <div class="neo-feature-title">Video Interaktif</div>
                                    <div class="neo-feature-desc">Pembelajaran multimedia</div>
                                </div>
                            </div>

                            <div class="neo-feature-item">
                                <div class="neo-feature-icon">
                                    <i class="bi bi-people-fill fs-2"></i>
                                </div>
                                <div>
                                    <div class="neo-feature-title">Kolaborasi</div>
                                    <div class="neo-feature-desc">Diskusi & forum online</div>
                                </div>
                            </div>

                            <div class="neo-feature-item">
                                <div class="neo-feature-icon">
                                    <i class="bi bi-award-fill fs-2"></i>
                                </div>
                                <div>
                                    <div class="neo-feature-title">Sertifikat</div>
                                    <div class="neo-feature-desc">Kredensial terverifikasi</div>
                                </div>
                            </div>

                            <div class="neo-feature-item">
                                <div class="neo-feature-icon">
                                    <i class="bi bi-bar-chart-fill fs-2"></i>
                                </div>
                                <div>
                                    <div class="neo-feature-title">Progress Tracking</div>
                                    <div class="neo-feature-desc">Monitor pembelajaran</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="neo-form-panel w-lg-50 p-10 order-1 order-lg-2">
                    <div class="neo-form-inner">
                        <div class="neo-login-card">
                            <div class="text-center mb-10">
                                <h1 class="neo-login-title fw-bolder mb-3 fs-2x">Selamat Datang Kembali</h1>
                                <div class="neo-login-subtitle fw-semibold fs-6">
                                    Masuk untuk melanjutkan pembelajaranmu
                                </div>
                            </div>

                            @include('errors.flash')

                            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
                                action="{{ route('logindb') }}">
                                @csrf

                                <input type="hidden" name="recaptcha_token" id="recaptcha_token">

                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold mb-3">
                                        <span class="required">Email</span>
                                    </label>

                                    <div class="input-group neo-input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-person-fill fs-3"></i>
                                        </span>
                                        <input type="email" placeholder="Masukkan Email" name="email"
                                            autocomplete="username" class="form-control form-control-lg"
                                            value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="fv-row mb-8" data-kt-password-meter="true">
                                    <label class="form-label fs-6 fw-bold mb-3">
                                        <span class="required">Kata Sandi</span>
                                    </label>

                                    <div class="position-relative">
                                        <div class="input-group neo-input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-shield-lock-fill fs-3"></i>
                                            </span>
                                            <input class="form-control form-control-lg" type="password"
                                                placeholder="Masukkan kata sandi" name="password" autocomplete="current-password">
                                            <span class="input-group-text cursor-pointer"
                                                data-kt-password-meter-control="visibility">
                                                <i class="bi bi-eye-slash fs-3"></i>
                                                <i class="bi bi-eye fs-3 d-none"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" id="remember"
                                            name="remember">
                                        <label class="form-check-label text-gray-700" for="remember">
                                            Ingat Saya
                                        </label>
                                    </div>

                                    <a href="{{ route('lupa_password') }}" class="link-primary fw-bold">
                                        Lupa Kata Sandi?
                                    </a>
                                </div>

                                <div class="d-grid mb-8">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary btn-lg neo-btn-primary">
                                        <span class="indicator-label">
                                            <i class="bi bi-box-arrow-in-right me-2"></i>
                                            Masuk ke Platform
                                        </span>
                                        <span class="indicator-progress">
                                            Mohon tunggu...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>

                                <div class="neo-register-box text-gray-600 text-center fw-semibold fs-6">
                                    Belum punya akun?
                                    <a href="{{ route('daftar') }}" class="link-primary fw-bold">
                                        Daftar Sekarang
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
</body>

</html>