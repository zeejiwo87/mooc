<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Verifikasi Email | Massive Open Online Course (MOOC)</title>

    <link rel="icon" href="{{ asset('assets/media/logos/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fonts/font.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('assets/plugins/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.bundle.css') }}">

    <style>
    :root {
        --verify-primary: #009ef7;
        --verify-primary-dark: #008bd8;
        --verify-primary-soft: #eaf6ff;
        --verify-warning: #f59e0b;
        --verify-warning-soft: #fffbeb;
        --verify-bg: #f8fafc;
        --verify-surface: #ffffff;
        --verify-border: #e5e7eb;
        --verify-text: #111827;
        --verify-muted: #64748b;
    }

    html,
    body {
        min-height: 100%;
        margin: 0;
        padding: 0;
        background: var(--verify-bg) !important;
        overflow-x: hidden;
    }

    body#kt_body {
        min-height: 100dvh;
        color: var(--verify-text);
        background: var(--verify-bg) !important;
    }

    a {
        text-decoration: none;
    }

    .neo-verify-page {
        min-height: 100dvh;
        background: var(--verify-bg);
    }

    .neo-verify-grid {
        min-height: 100dvh;
        display: grid;
        grid-template-columns: minmax(0, 1.05fr) minmax(420px, .95fr);
    }

    .neo-hero-side,
    .neo-form-side {
        min-width: 0;
        padding: clamp(28px, 4.5vw, 72px);
    }

    .neo-hero-side {
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: linear-gradient(135deg, #ffffff 0%, #f2f9ff 100%);
    }

    .neo-hero-side::before,
    .neo-hero-side::after {
        display: none !important;
        content: none !important;
    }

    .neo-hero-inner {
        position: relative;
        z-index: 1;
        width: min(100%, 660px);
    }

    .neo-brand {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: clamp(26px, 4vw, 42px);
    }

    .neo-brand-logo {
        width: 68px;
        height: 68px;
        border-radius: 18px;
        object-fit: contain;
        padding: 10px;
        background: #ffffff;
        border: 1px solid var(--verify-border);
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.06);
        flex-shrink: 0;
    }

    .neo-brand-title {
        color: var(--verify-text);
        font-size: 1.15rem;
        font-weight: 900;
        line-height: 1.25;
        letter-spacing: -0.03em;
        margin-bottom: 3px;
    }

    .neo-brand-subtitle {
        color: var(--verify-muted);
        font-size: .86rem;
        font-weight: 700;
    }

    .neo-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 13px;
        margin-bottom: 18px;
        border-radius: 999px;
        background: var(--verify-primary-soft);
        color: var(--verify-primary);
        font-size: .8rem;
        font-weight: 900;
        border: 1px solid rgba(0, 158, 247, 0.12);
    }

    .neo-hero-title {
        color: var(--verify-text);
        font-size: clamp(2rem, 4vw, 3.5rem);
        line-height: 1.08;
        font-weight: 950;
        letter-spacing: -0.06em;
        margin-bottom: 18px;
    }

    .neo-hero-title span {
        color: var(--verify-primary);
    }

    .neo-hero-desc {
        color: var(--verify-muted);
        max-width: 590px;
        font-size: 1.02rem;
        line-height: 1.75;
        margin-bottom: 28px;
    }

    .neo-feature-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
        max-width: 650px;
    }

    .neo-feature-item {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 14px;
        border-radius: 18px;
        background: #ffffff;
        border: 1px solid var(--verify-border);
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.045);
    }

    .neo-feature-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--verify-primary);
        background: var(--verify-primary-soft);
    }

    .neo-feature-title {
        color: var(--verify-text);
        font-size: .88rem;
        font-weight: 900;
        margin-bottom: 2px;
    }

    .neo-feature-text {
        color: var(--verify-muted);
        font-size: .76rem;
        font-weight: 700;
        line-height: 1.35;
    }

    .neo-form-side {
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--verify-bg);
    }

    .neo-verify-card {
        width: min(100%, 540px);
        border-radius: 26px;
        padding: clamp(24px, 4vw, 40px);
        background: #ffffff;
        border: 1px solid var(--verify-border);
        box-shadow: 0 24px 70px rgba(15, 23, 42, 0.08);
    }

    .neo-main-icon {
        width: 72px;
        height: 72px;
        margin: 0 auto 20px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--verify-primary);
        background: var(--verify-primary-soft);
        border: 1px solid rgba(0, 158, 247, 0.12);
    }

    .neo-main-icon i {
        font-size: 2.25rem;
    }

    .neo-card-title {
        color: var(--verify-text);
        font-size: clamp(1.55rem, 3vw, 2rem);
        font-weight: 950;
        letter-spacing: -0.045em;
        margin-bottom: 8px;
        text-align: center;
    }

    .neo-card-desc {
        color: var(--verify-muted);
        font-size: .95rem;
        line-height: 1.65;
        text-align: center;
        margin-bottom: 24px;
    }

    .neo-info-card,
    .neo-guide-card,
    .neo-warning-box {
        border-radius: 18px;
        background: #ffffff;
        border: 1px solid var(--verify-border);
        box-shadow: none;
    }

    .neo-info-card {
        padding: 20px;
        margin-bottom: 20px;
    }

    .neo-email-row {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .neo-mini-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--verify-primary);
        background: var(--verify-primary-soft);
        flex-shrink: 0;
    }

    .neo-email-label {
        color: var(--verify-muted);
        font-size: .78rem;
        font-weight: 800;
        margin-bottom: 2px;
    }

    .neo-email-value {
        color: var(--verify-text);
        font-weight: 900;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .neo-soft-separator {
        height: 1px;
        margin: 18px 0;
        background: var(--verify-border);
    }

    .neo-status {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        color: var(--verify-muted);
        font-size: .82rem;
        font-weight: 700;
        line-height: 1.5;
        margin-bottom: 16px;
    }

    .neo-status i {
        color: var(--verify-primary);
        margin-top: 2px;
    }

    .neo-warning-box {
        padding: 14px;
        background: var(--verify-warning-soft);
        border-color: rgba(245, 158, 11, 0.18);
    }

    .neo-warning-inner {
        display: flex;
        align-items: flex-start;
        gap: 11px;
    }

    .neo-warning-inner i {
        color: var(--verify-warning);
        font-size: 1.2rem;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .neo-warning-text {
        color: var(--verify-text);
        font-size: .82rem;
        font-weight: 700;
        line-height: 1.55;
    }

    .neo-resend-btn {
        width: 100%;
        min-height: 50px;
        border: 0 !important;
        border-radius: 16px !important;
        background: var(--verify-primary) !important;
        color: #ffffff !important;
        font-weight: 950 !important;
        box-shadow: 0 14px 30px rgba(0, 158, 247, 0.22);
        transition: .18s ease;
    }

    .neo-resend-btn:hover,
    .neo-resend-btn:focus {
        background: var(--verify-primary-dark) !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    .neo-guide-card {
        padding: 18px;
        margin-bottom: 20px;
        background: #f8fafc;
    }

    .neo-guide-title {
        display: flex;
        align-items: center;
        gap: 9px;
        color: var(--verify-text);
        font-size: .98rem;
        font-weight: 950;
        margin-bottom: 12px;
    }

    .neo-guide-title i {
        color: var(--verify-primary);
    }

    .neo-guide-list {
        color: var(--verify-muted);
        font-size: .82rem;
        font-weight: 700;
        line-height: 1.65;
        padding-left: 20px;
        margin: 0;
    }

    .neo-guide-list li {
        margin-bottom: 6px;
    }

    .neo-guide-list li:last-child {
        margin-bottom: 0;
    }

    .neo-logout-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 44px;
        padding: 0 18px;
        border-radius: 999px;
        background: #ffffff;
        color: var(--verify-muted);
        font-weight: 900;
        text-decoration: none;
        border: 1px solid var(--verify-border);
        transition: .18s ease;
    }

    .neo-logout-link:hover {
        color: var(--verify-primary);
        background: var(--verify-primary-soft);
        border-color: rgba(0, 158, 247, 0.22);
        transform: translateY(-1px);
    }

    @media (max-width: 1199.98px) {
        .neo-verify-grid {
            grid-template-columns: minmax(0, 1fr) minmax(380px, .9fr);
        }

        .neo-feature-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 991.98px) {
        .neo-verify-grid {
            min-height: auto;
            grid-template-columns: 1fr;
        }

        .neo-form-side {
            order: 1;
            align-items: flex-start;
            padding: 28px 22px 16px;
        }

        .neo-hero-side {
            order: 2;
            align-items: flex-start;
            padding: 16px 22px 32px;
            background: transparent;
        }

        .neo-hero-side,
        .neo-form-side {
            min-height: auto;
        }

        .neo-verify-card {
            margin: 0 auto;
        }

        .neo-hero-inner {
            width: min(100%, 540px);
            margin: 0 auto;
        }

        .neo-brand,
        .neo-hero-badge,
        .neo-hero-title,
        .neo-hero-desc {
            display: none;
        }

        .neo-feature-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 575.98px) {
        .neo-form-side {
            padding: 18px 14px 12px;
        }

        .neo-hero-side {
            padding: 10px 14px 22px;
        }

        .neo-verify-card {
            border-radius: 22px;
            padding: 22px 18px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.07);
        }

        .neo-main-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            margin-bottom: 16px;
        }

        .neo-main-icon i {
            font-size: 1.9rem;
        }

        .neo-card-desc {
            font-size: .88rem;
            margin-bottom: 18px;
        }

        .neo-info-card {
            padding: 16px;
            margin-bottom: 16px;
        }

        .neo-email-row {
            align-items: flex-start;
        }

        .neo-guide-card {
            padding: 16px;
        }

        .neo-feature-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .neo-feature-item {
            padding: 13px;
            border-radius: 16px;
        }

        .neo-feature-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
        }
    }

    @media (max-width: 380px) {
        .neo-verify-card {
            padding: 18px 14px;
        }

        .neo-info-card,
        .neo-guide-card,
        .neo-warning-box {
            border-radius: 16px;
        }

        .neo-email-row,
        .neo-warning-inner {
            gap: 9px;
        }

        .neo-mini-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
        }

        .neo-resend-btn,
        .neo-logout-link {
            font-size: .82rem;
        }
    }
</style>
</head>

<body id="kt_body" class="bg-body">
    <div class="neo-verify-page">
        <div class="neo-verify-grid">
            <section class="neo-hero-side">
                <div class="neo-hero-inner">
                    <div class="neo-brand">
                        <img src="{{ asset('assets/media/logos/logo.webp') }}" alt="Logo MOOC" class="neo-brand-logo">

                        <div>
                            <div class="neo-brand-title">
                                Massive Open Online Course (MOOC)
                            </div>
                            <div class="neo-brand-subtitle">
                                Universitas Nurul Jadid
                            </div>
                        </div>
                    </div>

                    <div class="neo-hero-badge">
                        <i class="bi bi-envelope-check"></i>
                        <span>Verifikasi Akun</span>
                    </div>

                    <h1 class="neo-hero-title">
                        Satu langkah lagi,<br>
                        <span>akunmu siap digunakan.</span>
                    </h1>

                    <p class="neo-hero-desc">
                        Verifikasi email diperlukan agar akun kamu aman dan bisa digunakan untuk mengakses
                        seluruh fitur pembelajaran MOOC.
                    </p>

                    <div class="neo-feature-grid">
                        <div class="neo-feature-item">
                            <span class="neo-feature-icon">
                                <i class="bi bi-shield-check fs-3"></i>
                            </span>
                            <div>
                                <div class="neo-feature-title">Akun Aman</div>
                                <div class="neo-feature-text">Pastikan email benar-benar milik kamu</div>
                            </div>
                        </div>

                        <div class="neo-feature-item">
                            <span class="neo-feature-icon">
                                <i class="bi bi-collection-play fs-3"></i>
                            </span>
                            <div>
                                <div class="neo-feature-title">Akses Kelas</div>
                                <div class="neo-feature-text">Mulai belajar setelah email diverifikasi</div>
                            </div>
                        </div>

                        <div class="neo-feature-item">
                            <span class="neo-feature-icon">
                                <i class="bi bi-award-fill fs-3"></i>
                            </span>
                            <div>
                                <div class="neo-feature-title">Sertifikat</div>
                                <div class="neo-feature-text">Data akun dipakai untuk kredensial digital</div>
                            </div>
                        </div>

                        <div class="neo-feature-item">
                            <span class="neo-feature-icon">
                                <i class="bi bi-arrow-repeat fs-3"></i>
                            </span>
                            <div>
                                <div class="neo-feature-title">Kirim Ulang</div>
                                <div class="neo-feature-text">Tautan verifikasi bisa dikirim ulang</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="neo-form-side">
                <div class="neo-verify-card">
                    <div class="neo-main-icon">
                        <i class="bi bi-envelope-check"></i>
                    </div>

                    <h1 class="neo-card-title">
                        Verifikasi Email Anda
                    </h1>

                    <p class="neo-card-desc">
                        Terima kasih telah mendaftar. Kami telah mengirimkan tautan verifikasi ke email Anda.
                        Silakan cek inbox atau folder spam.
                    </p>

                    @include('errors.flash')

                    <div class="neo-info-card">
                        <div class="neo-email-row">
                            <span class="neo-mini-icon">
                                <i class="bi bi-person-circle fs-3"></i>
                            </span>

                            <div class="min-w-0">
                                <div class="neo-email-label">Email Terdaftar</div>
                                <div class="neo-email-value">{{ $user->email }}</div>
                            </div>
                        </div>

                        <div class="neo-soft-separator"></div>

                        <div class="neo-status">
                            <i class="bi bi-info-circle"></i>
                            <div>
                                <strong>Status:</strong> Menunggu Verifikasi
                            </div>
                        </div>

                        <div class="neo-warning-box">
                            <div class="neo-warning-inner">
                                <i class="bi bi-exclamation-triangle-fill"></i>

                                <div class="neo-warning-text">
                                    Anda harus memverifikasi email terlebih dahulu sebelum dapat mengakses
                                    semua fitur platform.
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('verification.send') }}" class="mb-5">
                        @csrf

                        <button type="submit" class="btn neo-resend-btn">
                            <i class="bi bi-arrow-repeat me-2"></i>
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>

                    <div class="neo-guide-card">
                        <div class="neo-guide-title">
                            <i class="bi bi-lightbulb-fill"></i>
                            Panduan Verifikasi
                        </div>

                        <ol class="neo-guide-list">
                            <li>Buka aplikasi email Anda, seperti Gmail, Outlook, atau sejenisnya.</li>
                            <li>Cari email dari <strong>{{ config('app.name') }}</strong>.</li>
                            <li>Klik tombol <strong>"Verifikasi Email"</strong> di dalam email.</li>
                            <li>Jika tidak menemukannya, cek folder <strong>Spam/Junk</strong>.</li>
                            <li>Setelah verifikasi, Anda akan diarahkan ke dashboard.</li>
                        </ol>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('logout') }}" class="neo-logout-link">
                            <i class="bi bi-box-arrow-left"></i>
                            Keluar
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
</body>

</html>
