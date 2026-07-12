<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Reset Kata Sandi | Massive Open Online Course (MOOC)</title>

    <link rel="icon" href="{{ asset('assets/media/logos/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fonts/font.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('assets/plugins/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.bundle.css') }}">

   <style>
    :root {
        --auth-primary: #009ef7;
        --auth-primary-dark: #008bd8;
        --auth-primary-soft: #eaf6ff;
        --auth-bg: #f8fafc;
        --auth-surface: #ffffff;
        --auth-border: #e5e7eb;
        --auth-text: #111827;
        --auth-muted: #64748b;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        min-height: 100%;
        background: var(--auth-bg) !important;
        overflow-x: hidden;
    }

    body#kt_body {
        min-height: 100vh;
        background: var(--auth-bg) !important;
        color: var(--auth-text);
    }

    a {
        text-decoration: none;
    }

    .neo-auth-page {
        min-height: 100vh;
        background:
            radial-gradient(circle at 0% 0%, rgba(0, 158, 247, 0.08), transparent 34%),
            radial-gradient(circle at 100% 100%, rgba(0, 158, 247, 0.07), transparent 36%),
            var(--auth-bg);
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
        min-height: 42px;
        padding: 0 16px;
        border-radius: 999px;
        color: var(--auth-text);
        font-weight: 700;
        background: #ffffff;
        border: 1px solid var(--auth-border);
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
        transition: .18s ease;
    }

    .neo-back-floating:hover {
        color: var(--auth-primary);
        border-color: rgba(0, 158, 247, 0.28);
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
        background: linear-gradient(135deg, #ffffff 0%, #f2f9ff 100%);
        overflow: hidden;
    }

    .neo-hero-panel::before {
        content: "";
        position: absolute;
        width: 320px;
        height: 320px;
        right: -120px;
        top: -120px;
        border-radius: 50%;
        background: rgba(0, 158, 247, 0.10);
        pointer-events: none;
    }

    .neo-hero-panel::after {
        content: "";
        position: absolute;
        width: 260px;
        height: 260px;
        left: -120px;
        bottom: -120px;
        border-radius: 50%;
        background: rgba(0, 158, 247, 0.08);
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
        width: 68px;
        height: 68px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        border: 1px solid var(--auth-border);
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.06);
        overflow: hidden;
        flex-shrink: 0;
    }

    .neo-logo-box img {
        width: 50px;
        height: 50px;
        object-fit: contain;
    }

    .neo-brand-title {
        color: var(--auth-text);
        font-weight: 800;
        line-height: 1.25;
        margin-bottom: 4px;
    }

    .neo-brand-subtitle {
        color: var(--auth-muted);
        font-weight: 600;
    }

    .neo-title {
        color: var(--auth-text);
        letter-spacing: -0.035em;
        line-height: 1.12;
    }

    .neo-title .text-primary,
    .text-primary {
        color: var(--auth-primary) !important;
    }

    .neo-desc {
        color: var(--auth-muted);
        max-width: 620px;
        line-height: 1.8;
    }

    .neo-feature-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
        max-width: 680px;
    }

    .neo-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 16px;
        border-radius: 18px;
        background: #ffffff;
        border: 1px solid var(--auth-border);
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.045);
        transition: .18s ease;
    }

    .neo-feature-item:hover {
        transform: translateY(-3px);
        border-color: rgba(0, 158, 247, 0.25);
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.07);
    }

    .neo-feature-icon {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--auth-primary);
        background: var(--auth-primary-soft);
        flex-shrink: 0;
    }

    .neo-feature-title {
        color: var(--auth-text);
        font-weight: 800;
        margin-bottom: 4px;
    }

    .neo-feature-desc {
        color: var(--auth-muted);
        font-weight: 600;
        font-size: 13px;
    }

    .neo-form-panel {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--auth-bg);
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
        border-radius: 26px;
        padding: 42px;
        background: #ffffff;
        border: 1px solid var(--auth-border);
        box-shadow: 0 24px 70px rgba(15, 23, 42, 0.08);
    }

    .neo-login-title {
        color: var(--auth-text);
        letter-spacing: -0.03em;
    }

    .neo-login-subtitle {
        color: var(--auth-muted);
        line-height: 1.65;
    }

    .form-label {
        color: var(--auth-text) !important;
    }

    .neo-input-group {
        border-radius: 16px;
        background: #ffffff;
        border: 1px solid var(--auth-border);
        overflow: hidden;
        transition: .18s ease;
    }

    .neo-input-group:focus-within {
        border-color: rgba(0, 158, 247, 0.45);
        box-shadow: 0 0 0 .2rem rgba(0, 158, 247, 0.10);
    }

    .neo-input-group .input-group-text {
        border: 0 !important;
        background: transparent !important;
        color: var(--auth-primary);
        padding-left: 18px;
        padding-right: 10px;
    }

    .neo-input-group .form-control {
        border: 0 !important;
        background: transparent !important;
        color: var(--auth-text);
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
        box-shadow: none !important;
    }

    .neo-input-group .cursor-pointer,
    .neo-input-group .neo-password-toggle {
        color: var(--auth-muted);
        padding-right: 18px;
        cursor: pointer;
        transition: .18s ease;
    }

    .neo-input-group .neo-password-toggle:hover {
        color: var(--auth-primary);
    }

    .link-primary {
        color: var(--auth-primary) !important;
    }

    .link-primary:hover {
        color: var(--auth-primary-dark) !important;
    }

    .neo-btn-primary,
    .btn.btn-primary {
        border: 0 !important;
        border-radius: 16px !important;
        background: var(--auth-primary) !important;
        color: #ffffff !important;
        font-weight: 800;
        min-height: 52px;
        box-shadow: 0 14px 30px rgba(0, 158, 247, 0.24);
        transition: .18s ease;
    }

    .neo-btn-primary:hover,
    .btn.btn-primary:hover,
    .btn.btn-primary:focus {
        background: var(--auth-primary-dark) !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    .neo-login-box {
        border-radius: 16px;
        padding: 16px;
        background: var(--auth-primary-soft);
        border: 1px solid rgba(0, 158, 247, 0.12);
    }

    .alert {
        border: 1px solid var(--auth-border) !important;
        border-radius: 16px !important;
        box-shadow: none !important;
    }

    .text-danger,
    .invalid-feedback {
        font-weight: 700;
    }

    @media (max-width: 991.98px) {
        html,
        body,
        body#kt_body {
            background: var(--auth-bg) !important;
        }

        .neo-auth-page,
        .neo-auth-shell {
            min-height: 100vh;
            background:
                radial-gradient(circle at 0% 0%, rgba(0, 158, 247, 0.08), transparent 34%),
                radial-gradient(circle at 100% 100%, rgba(0, 158, 247, 0.07), transparent 36%),
                var(--auth-bg);
        }

        .neo-auth-shell {
            overflow: visible;
        }

        .neo-back-floating {
            top: 18px !important;
            left: 18px !important;
            min-height: 42px;
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
            border-radius: 24px;
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
            border-radius: 16px;
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
            border-radius: 16px;
        }

        .neo-feature-item:hover {
            transform: none;
        }

        .neo-feature-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
        }

        .neo-feature-title {
            font-size: 13px;
            margin-bottom: 2px;
        }

        .neo-feature-desc {
            font-size: 11px;
        }
    }

    @media (max-width: 575.98px) {
        .neo-back-floating {
            left: 14px !important;
            top: 14px !important;
            min-height: 40px;
            padding: 0 13px;
            font-size: 12px;
            border-radius: 999px;
        }

        .neo-form-panel {
            padding: 76px 14px 20px !important;
        }

        .neo-login-card {
            padding: 24px;
            border-radius: 22px;
        }

        .neo-login-title {
            font-size: 1.75rem !important;
        }

        .neo-login-subtitle {
            font-size: 0.95rem !important;
        }

        .neo-hero-panel {
            padding: 6px 14px 28px !important;
        }

        .neo-feature-list {
            grid-template-columns: 1fr;
        }

        .neo-feature-title {
            font-size: .92rem;
        }

        .neo-feature-desc {
            font-size: .76rem;
        }

        .neo-input-group .input-group-text {
            padding-left: 14px;
            padding-right: 8px;
        }

        .neo-input-group .form-control {
            min-height: 48px;
        }

        .neo-input-group .neo-password-toggle {
            padding-right: 14px;
        }
    }

    @media (max-width: 380px) {
        .neo-brand-box {
            gap: 10px;
        }

        .neo-logo-box {
            width: 52px;
            height: 52px;
            border-radius: 16px;
        }

        .neo-logo-box img {
            width: 38px;
            height: 38px;
        }

        .neo-brand-title {
            font-size: .92rem !important;
        }

        .neo-title {
            font-size: 1.55rem !important;
        }

        .neo-login-card {
            padding: 20px;
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
                                Amankan Akunmu,<br>
                                <span class="text-primary">Lanjutkan Belajarmu</span>
                            </h1>

                            <p class="neo-desc fs-5 fw-semibold mb-0">
                                Buat kata sandi baru agar akun MOOC kamu tetap aman dan kamu bisa kembali
                                mengakses kelas, progres belajar, kuis, serta sertifikat digital.
                            </p>
                        </div>

                        <div class="neo-feature-list">
                            <div class="neo-feature-item">
                                <div class="neo-feature-icon">
                                    <i class="bi bi-shield-lock-fill fs-2"></i>
                                </div>
                                <div>
                                    <div class="neo-feature-title">Keamanan Akun</div>
                                    <div class="neo-feature-desc">Gunakan kata sandi yang kuat</div>
                                </div>
                            </div>

                            <div class="neo-feature-item">
                                <div class="neo-feature-icon">
                                    <i class="bi bi-key-fill fs-2"></i>
                                </div>
                                <div>
                                    <div class="neo-feature-title">Reset Aman</div>
                                    <div class="neo-feature-desc">Tautan reset diverifikasi sistem</div>
                                </div>
                            </div>

                            <div class="neo-feature-item">
                                <div class="neo-feature-icon">
                                    <i class="bi bi-mortarboard-fill fs-2"></i>
                                </div>
                                <div>
                                    <div class="neo-feature-title">Akses Belajar</div>
                                    <div class="neo-feature-desc">Masuk kembali ke kelasmu</div>
                                </div>
                            </div>

                            <div class="neo-feature-item">
                                <div class="neo-feature-icon">
                                    <i class="bi bi-patch-check-fill fs-2"></i>
                                </div>
                                <div>
                                    <div class="neo-feature-title">Sertifikat</div>
                                    <div class="neo-feature-desc">Data belajarmu tetap tersimpan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="neo-form-panel w-lg-50 p-10 order-1 order-lg-2">
                    <div class="neo-form-inner">
                        <div class="neo-login-card">
                            <div class="text-center mb-10">
                                <h1 class="neo-login-title fw-bolder mb-3 fs-2x">Reset Kata Sandi</h1>
                                <div class="neo-login-subtitle fw-semibold fs-6">
                                    Masukkan kata sandi baru untuk akun kamu.
                                </div>
                            </div>

                            @include('errors.flash')

                            <form class="form w-100" method="POST"
                                action="{{ route('reset_password_db', ['id' => $user->id_pengguna, 'expires' => request('expires'), 'signature' => request('signature')]) }}">
                                @csrf

                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold mb-3">
                                        <span class="required">Kata Sandi Baru</span>
                                    </label>

                                    <div class="position-relative">
                                        <div class="input-group neo-input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-shield-lock-fill fs-3"></i>
                                            </span>

                                            <input
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                type="password" name="password" id="password"
                                                placeholder="Masukkan kata sandi baru" autocomplete="new-password">

                                            <span class="input-group-text neo-password-toggle"
                                                data-neo-password-toggle="password" role="button" tabindex="0"
                                                aria-label="Tampilkan atau sembunyikan kata sandi">
                                                <i class="bi bi-eye-slash fs-3" data-icon-hide></i>
                                                <i class="bi bi-eye fs-3 d-none" data-icon-show></i>
                                            </span>
                                        </div>
                                    </div>

                                    @error('password')
                                        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold mb-3">
                                        <span class="required">Konfirmasi Kata Sandi Baru</span>
                                    </label>

                                    <div class="position-relative">
                                        <div class="input-group neo-input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-shield-lock-fill fs-3"></i>
                                            </span>

                                            <input
                                                class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                                type="password" name="password_confirmation" id="password_confirmation"
                                                placeholder="Ulangi kata sandi baru" autocomplete="new-password">

                                            <span class="input-group-text neo-password-toggle"
                                                data-neo-password-toggle="password_confirmation" role="button" tabindex="0"
                                                aria-label="Tampilkan atau sembunyikan konfirmasi kata sandi">
                                                <i class="bi bi-eye-slash fs-3" data-icon-hide></i>
                                                <i class="bi bi-eye fs-3 d-none" data-icon-show></i>
                                            </span>
                                        </div>
                                    </div>

                                    @error('password_confirmation')
                                        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid mb-8">
                                    <button type="submit" class="btn btn-primary btn-lg neo-btn-primary">
                                        <span class="indicator-label">
                                            <i class="bi bi-check-circle me-2"></i>
                                            Simpan Kata Sandi Baru
                                        </span>
                                        <span class="indicator-progress">
                                            Mohon tunggu...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>

                                <div class="neo-login-box text-gray-600 text-center fw-semibold fs-6">
                                    Sudah ingat kata sandi?
                                    <a href="{{ route('login') }}" class="link-primary fw-bold">
                                        Kembali Masuk
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function togglePassword(toggle) {
                const targetId = toggle.getAttribute('data-neo-password-toggle');
                const input = document.getElementById(targetId);

                if (!input) return;

                const iconHide = toggle.querySelector('[data-icon-hide]');
                const iconShow = toggle.querySelector('[data-icon-show]');
                const isHidden = input.type === 'password';

                input.type = isHidden ? 'text' : 'password';

                if (iconHide && iconShow) {
                    iconHide.classList.toggle('d-none', isHidden);
                    iconShow.classList.toggle('d-none', !isHidden);
                }
            }

            document.querySelectorAll('[data-neo-password-toggle]').forEach(function (toggle) {
                toggle.addEventListener('click', function () {
                    togglePassword(this);
                });

                toggle.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter' || event.key === ' ') {
                        event.preventDefault();
                        togglePassword(this);
                    }
                });
            });
        });
    </script>
</body>

</html>
