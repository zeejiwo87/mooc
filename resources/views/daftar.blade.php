<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Daftar Akun - Massive Open Online Course (MOOC)</title>

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

        @media (min-width: 992px) {
            html,
            body {
                min-height: 100%;
                overflow-x: hidden;
                overflow-y: auto;
            }
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
            position: fixed;
            top: 22px;
            left: 24px;
            z-index: 100;
        }

        .neo-back-link {
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

        .neo-back-link:hover {
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

        .neo-register-card {
            width: 100%;
            max-width: 620px;
            margin: 0 auto;
            border-radius: 30px;
            padding: 34px;
            background: var(--neo-surface);
            box-shadow:
                10px 10px 24px var(--neo-dark),
                -10px -10px 24px var(--neo-light);
        }

        .neo-register-title {
            color: var(--neo-text);
            letter-spacing: -0.03em;
        }

        .neo-register-subtitle {
            color: var(--neo-muted);
        }

        .neo-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .neo-form-full {
            grid-column: 1 / -1;
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
            padding-left: 16px;
            padding-right: 8px;
        }

        .neo-input-group .form-control {
            border: 0 !important;
            background: transparent !important;
            color: var(--neo-text);
            box-shadow: none !important;
            min-height: 48px;
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
            padding-right: 16px;
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
            min-height: 50px;
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

        .neo-login-box {
            border-radius: 18px;
            padding: 14px;
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

        .text-danger {
            font-weight: 600;
        }

        @media (min-width: 992px) {
            .neo-auth-page,
            .neo-auth-shell,
            .neo-auth-shell > .d-flex {
                min-height: 100vh;
                height: auto;
                max-height: none;
                overflow: visible;
            }

            .neo-hero-panel,
            .neo-form-panel {
                min-height: 100vh;
                height: auto;
                max-height: none;
            }

            .neo-hero-panel {
                overflow: hidden;
                padding: 76px 56px 42px !important;
            }

            .neo-form-panel {
                overflow: visible;
            }

            .neo-form-panel {
                padding: 52px 56px 34px !important;
            }

            .neo-brand-box {
                margin-bottom: 2.25rem !important;
            }

            .neo-title {
                font-size: 2.65rem !important;
                margin-bottom: 1.25rem !important;
            }

            .neo-desc {
                font-size: 1.05rem !important;
                margin-bottom: 2rem !important;
            }

            .neo-feature-list {
                gap: 14px;
            }

            .neo-feature-item {
                padding: 15px;
            }

            .neo-feature-icon {
                width: 42px;
                height: 42px;
                border-radius: 14px;
            }

            .neo-feature-title {
                font-size: 13px;
            }

            .neo-feature-desc {
                font-size: 11px;
            }

            .neo-register-card {
                max-height: none;
                overflow: visible;
            }

            .neo-register-card .text-center {
                margin-bottom: 1.6rem !important;
            }

            .neo-register-title {
                font-size: 1.8rem !important;
            }

            .neo-register-subtitle {
                font-size: 0.95rem !important;
            }

            .fv-row {
                margin-bottom: 1rem !important;
            }

            .form-label {
                margin-bottom: .45rem !important;
            }

            .neo-input-group .form-control {
                min-height: 44px;
            }

            .neo-btn-primary,
            .btn.btn-primary {
                min-height: 46px;
            }

            .neo-login-box {
                padding: 12px;
            }
        }



        @media (min-width: 992px) and (max-height: 760px) {
            .neo-hero-panel {
                padding: 64px 42px 30px !important;
            }

            .neo-form-panel {
                padding: 34px 42px 28px !important;
            }

            .neo-brand-box {
                margin-bottom: 1.5rem !important;
            }

            .neo-title {
                font-size: 2.25rem !important;
                margin-bottom: 1rem !important;
            }

            .neo-desc {
                font-size: 0.98rem !important;
                line-height: 1.6;
                margin-bottom: 1.45rem !important;
            }

            .neo-feature-list {
                gap: 12px;
            }

            .neo-feature-item {
                padding: 13px;
            }

            .neo-register-card {
                padding: 28px;
                border-radius: 26px;
            }

            .neo-register-card .text-center {
                margin-bottom: 1.25rem !important;
            }

            .neo-register-title {
                font-size: 1.62rem !important;
            }

            .neo-register-subtitle {
                font-size: 0.9rem !important;
            }

            .neo-form-grid {
                gap: 14px;
            }

            .fv-row {
                margin-bottom: 0 !important;
            }

            .form-label {
                margin-bottom: .35rem !important;
            }

            .neo-input-group .form-control {
                min-height: 42px;
            }

            .neo-btn-primary,
            .btn.btn-primary {
                min-height: 44px;
            }

            .neo-login-box {
                padding: 10px;
            }
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
                top: 18px;
                left: 18px;
            }

            .neo-back-floating .neo-back-link {
                min-height: 42px;
                background: var(--neo-surface);
                color: var(--neo-text);
                box-shadow:
                    5px 5px 14px var(--neo-dark-soft),
                    -5px -5px 14px var(--neo-light);
            }

            .neo-form-panel {
                width: 100% !important;
                min-height: auto;
                padding: 92px 22px 30px !important;
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

            .neo-register-card {
                max-width: 540px;
                padding: 34px;
                border-radius: 26px;
                background: var(--neo-surface);
                box-shadow:
                    10px 10px 24px var(--neo-dark),
                    -10px -10px 24px var(--neo-light);
            }

            .neo-register-card .text-center {
                margin-bottom: 2rem !important;
            }

            .neo-form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .neo-form-grid .fv-row {
                margin-bottom: 0 !important;
            }

            .form-label {
                margin-bottom: 0.65rem !important;
            }

            .neo-input-group {
                border-radius: 18px;
            }

            .neo-input-group .form-control {
                min-height: 54px;
            }

            .neo-input-group .input-group-text {
                padding-left: 18px;
                padding-right: 10px;
            }

            .neo-input-group .cursor-pointer {
                padding-right: 18px;
            }

            .neo-hero-panel {
                width: 100% !important;
                min-height: auto;
                display: flex !important;
                padding: 16px 22px 38px !important;
                background: transparent;
                overflow: visible;
                order: 2 !important;
            }

            .neo-hero-panel::before,
            .neo-hero-panel::after {
                display: none;
            }

            .neo-hero-content {
                max-width: 540px;
                margin: 0 auto;
            }

            .neo-brand-box {
                align-items: center;
                gap: 14px;
                margin-bottom: 2rem !important;
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
                gap: 14px;
                max-width: 540px;
            }

            .neo-feature-item {
                padding: 15px;
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
                padding: 88px 20px 30px !important;
            }

            .neo-hero-panel {
                padding: 16px 20px 34px !important;
            }

            .neo-register-card {
                padding: 30px;
                border-radius: 24px;
            }

            .neo-form-grid {
                gap: 19px;
            }

            .neo-feature-list {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }
        }

        @media (max-width: 575.98px) {
            .neo-back-floating {
                top: 16px;
                left: 16px;
            }

            .neo-form-panel {
                padding: 84px 18px 28px !important;
            }

            .neo-hero-panel {
                padding: 14px 18px 32px !important;
            }

            .neo-register-card {
                padding: 26px 22px;
                border-radius: 22px;
            }

            .neo-register-card .text-center {
                margin-bottom: 1.75rem !important;
            }

            .neo-register-title {
                font-size: 1.65rem !important;
            }

            .neo-register-subtitle {
                font-size: 0.95rem !important;
                line-height: 1.55;
            }

            .neo-form-grid {
                gap: 18px;
            }

            .form-label {
                margin-bottom: 0.6rem !important;
            }

            .neo-input-group .form-control {
                min-height: 52px;
            }

            .neo-btn-primary,
            .btn.btn-primary {
                min-height: 52px;
            }

            .neo-login-box {
                padding: 16px 14px;
                line-height: 1.5;
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
                gap: 12px;
            }

            .neo-feature-item {
                padding: 14px;
            }
        }

        @media (max-width: 420px) {
            .neo-back-floating .neo-back-link {
                min-height: 40px;
                padding: 0 14px;
                font-size: 13px;
                border-radius: 14px;
            }

            .neo-form-panel {
                padding-top: 78px !important;
            }

            .neo-register-card {
                padding: 24px 18px;
            }

            .neo-form-grid {
                gap: 17px;
            }
        }

        @media (max-width: 360px) {
            .neo-back-floating {
                top: 12px;
                left: 12px;
            }

            .neo-form-panel {
                padding: 72px 12px 24px !important;
            }

            .neo-hero-panel {
                padding: 12px 12px 28px !important;
            }

            .neo-register-card {
                padding: 22px 16px;
                border-radius: 20px;
            }

            .neo-back-link {
                padding: 0 12px;
                font-size: 12px;
            }

            .neo-input-group .form-control {
                min-height: 50px;
            }
        }
    </style>
</head>

<body id="kt_body" class="app-default">
    <div class="neo-auth-page">
        <div class="neo-auth-shell">
            <a href="{{ route('index') }}" class="neo-back-link neo-back-floating">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Beranda</span>
            </a>

            <div class="d-flex flex-column flex-lg-row min-vh-100">

                <div class="neo-hero-panel w-lg-50 p-10 p-lg-15 order-2 order-lg-1">
                    <div class="neo-hero-content">
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
                                    <i class="bi bi-graph-up-arrow fs-2"></i>
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
                        <div class="neo-register-card">
                            <div class="text-center mb-10">
                                <h1 class="neo-register-title fw-bolder mb-3 fs-2x">Daftar Akun Baru</h1>
                                <div class="neo-register-subtitle fw-semibold fs-6">
                                    Lengkapi data Anda untuk membuat akun
                                </div>
                            </div>

                            @include('errors.flash')

                            <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="POST"
                                action="{{ route('daftardb') }}">
                                @csrf

                                <input type="hidden" name="recaptcha_token" id="recaptcha_token">

                                <div class="neo-form-grid">
                                    <div class="fv-row">
                                        <label class="form-label fs-6 fw-bold">
                                            <span class="required">Nama Lengkap</span>
                                        </label>

                                        <div class="input-group neo-input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-person-fill fs-3"></i>
                                            </span>
                                            <input type="text" placeholder="Nama lengkap" name="nama"
                                                value="{{ old('nama') }}" autocomplete="off"
                                                class="form-control form-control-lg @error('nama') is-invalid @enderror">
                                        </div>

                                        @error('nama')
                                            <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label fs-6 fw-bold">
                                            <span class="required">Email</span>
                                        </label>

                                        <div class="input-group neo-input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-envelope-fill fs-3"></i>
                                            </span>
                                            <input type="email" placeholder="Email" name="email"
                                                value="{{ old('email') }}" autocomplete="off"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror">
                                        </div>

                                        @error('email')
                                            <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label fs-6 fw-bold">
                                            <span class="required">Nomor Telepon</span>
                                        </label>

                                        <div class="input-group neo-input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-telephone-fill fs-3"></i>
                                            </span>
                                            <input type="tel" placeholder="08123456789" name="telepon"
                                                value="{{ old('telepon') }}" autocomplete="off"
                                                class="form-control form-control-lg @error('telepon') is-invalid @enderror">
                                        </div>

                                        @error('telepon')
                                            <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="fv-row" data-kt-password-meter="true">
                                        <label class="form-label fs-6 fw-bold">
                                            <span class="required">Kata Sandi</span>
                                        </label>

                                        <div class="position-relative">
                                            <div class="input-group neo-input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-shield-lock-fill fs-3"></i>
                                                </span>
                                                <input class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                    type="password" placeholder="Minimal 8 karakter" name="password"
                                                    autocomplete="off" id="password">
                                                <span class="input-group-text cursor-pointer"
                                                    data-neo-password-toggle="true">
                                                    <i class="bi bi-eye-slash fs-3"></i>
                                                    <i class="bi bi-eye fs-3 d-none"></i>
                                                </span>
                                            </div>
                                        </div>

                                        @error('password')
                                            <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="fv-row neo-form-full">
                                        <label class="form-label fs-6 fw-bold">
                                            <span class="required">Konfirmasi Kata Sandi</span>
                                        </label>

                                        <div class="position-relative">
                                            <div class="input-group neo-input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-shield-lock-fill fs-3"></i>
                                                </span>
                                                <input class="form-control form-control-lg" type="password"
                                                    placeholder="Ulangi kata sandi" name="password_confirmation"
                                                    autocomplete="off" id="password_confirmation">
                                                <span class="input-group-text cursor-pointer"
                                                    data-neo-password-toggle="true">
                                                    <i class="bi bi-eye-slash fs-3"></i>
                                                    <i class="bi bi-eye fs-3 d-none"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="fv-row neo-form-full">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" id="terms"
                                                name="terms" {{ old('terms') ? 'checked' : '' }} required>
                                            <label class="form-check-label text-gray-700" for="terms">
                                                Saya menyetujui
                                                <a href="#" class="link-primary fw-bold">Syarat & Ketentuan</a>
                                            </label>
                                        </div>

                                        @error('terms')
                                            <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="neo-form-full">
                                        <div class="d-grid mb-5">
                                            <button type="submit" id="kt_sign_up_submit"
                                                class="btn btn-primary btn-lg neo-btn-primary">
                                                <span class="indicator-label">
                                                    <i class="bi bi-person-plus-fill me-2"></i>
                                                    Daftar Sekarang
                                                </span>
                                                <span class="indicator-progress">
                                                    Mohon tunggu...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>

                                        <div class="neo-login-box text-gray-600 text-center fw-semibold fs-6">
                                            Sudah punya akun?
                                            <a href="{{ route('login') }}" class="link-primary fw-bold">
                                                Masuk Sekarang
                                            </a>
                                        </div>
                                    </div>
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

    <script>
        document.querySelectorAll('[data-neo-password-toggle="true"]').forEach(function(toggle) {
            toggle.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();

                const group = this.closest('.input-group');
                if (!group) {
                    return;
                }

                const input = group.querySelector('input[type="password"], input[type="text"]');
                const eyeSlash = this.querySelector('.bi-eye-slash');
                const eye = this.querySelector('.bi-eye');

                if (!input || !eyeSlash || !eye) {
                    return;
                }

                const showPassword = input.type === 'password';
                input.type = showPassword ? 'text' : 'password';
                eyeSlash.classList.toggle('d-none', showPassword);
                eye.classList.toggle('d-none', !showPassword);
            });
        });
    </script>
</body>

</html>