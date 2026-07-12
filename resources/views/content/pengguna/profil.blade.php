@extends('content.pengguna.layouts')

@section('pengguna_css')
    <style>
        :root {
            --profile-primary: #009ef7;
            --profile-primary-dark: #008bd8;
            --profile-primary-soft: #eaf6ff;
            --profile-bg: #f8fafc;
            --profile-surface: #ffffff;
            --profile-soft: #f1f5f9;
            --profile-border: #e5e7eb;
            --profile-text: #111827;
            --profile-muted: #64748b;
            --profile-success: #22c55e;
        }

        .neo-profile-page {
            width: 100%;
            color: var(--profile-text);
        }

        .neo-profile-shell {
            width: 100%;
            border-radius: 24px;
            background: var(--profile-surface);
            border: 1px solid var(--profile-border);
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
            overflow: hidden;
            position: relative;
        }

        .neo-profile-shell::before,
        .neo-profile-shell::after {
            display: none !important;
            content: none !important;
        }

        .neo-profile-inner {
            position: relative;
            z-index: 1;
        }

        .neo-profile-hero {
            padding: 34px 36px 28px;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 340px;
            gap: 32px;
            align-items: center;
            background: #ffffff;
        }

        .neo-profile-main {
            display: flex;
            align-items: center;
            gap: 24px;
            min-width: 0;
        }

        .neo-avatar-form {
            flex-shrink: 0;
        }

        .neo-avatar-box {
            width: 132px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .neo-avatar-wrap {
            position: relative;
            width: 112px;
            height: 112px;
            border-radius: 999px;
            padding: 6px;
            background: #ffffff;
            border: 1px solid var(--profile-border);
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.07);
        }

        .neo-avatar-preview {
            width: 100%;
            height: 100%;
            border-radius: 999px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border: 1px solid var(--profile-border);
        }

        .neo-avatar-edit {
            position: absolute;
            right: 4px;
            bottom: 8px;
            width: 30px;
            height: 30px;
            border: 1px solid var(--profile-border);
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--profile-primary);
            background: #ffffff;
            cursor: pointer;
            transition: .18s ease;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.10);
        }

        .neo-avatar-edit i {
            font-size: 12px !important;
        }

        .neo-avatar-edit:hover {
            color: var(--profile-primary-dark);
            background: var(--profile-primary-soft);
            border-color: rgba(0, 158, 247, 0.25);
            transform: translateY(-1px);
        }

        .neo-avatar-edit input {
            display: none;
        }

        .neo-avatar-save {
            width: auto;
            min-width: 104px;
            min-height: 32px !important;
            margin-top: 11px;
            padding: 0 10px !important;
            border-radius: 999px !important;
            font-size: 11px !important;
            line-height: 1 !important;
            white-space: nowrap !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 5px !important;
            color: var(--profile-primary) !important;
            background: #ffffff !important;
            border: 1px solid var(--profile-border) !important;
            box-shadow: none !important;
            transition: .18s ease;
        }

        .neo-avatar-save i {
            font-size: 11px !important;
            margin-right: 0 !important;
        }

        .neo-avatar-save:hover {
            color: var(--profile-primary-dark) !important;
            background: var(--profile-primary-soft) !important;
            border-color: rgba(0, 158, 247, 0.24) !important;
            transform: translateY(-1px);
        }

        .neo-profile-name {
            color: var(--profile-text);
            font-weight: 900;
            letter-spacing: -.035em;
            margin-bottom: 8px;
            line-height: 1.15;
        }

        .neo-profile-email {
            color: var(--profile-muted);
            font-weight: 700;
            overflow-wrap: anywhere;
            margin-bottom: 12px;
        }

        .neo-profile-bio {
            color: var(--profile-muted);
            font-weight: 600;
            line-height: 1.72;
            max-width: 720px;
            margin-bottom: 0;
        }

        .neo-profile-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 30px;
            padding: 0 12px;
            border-radius: 999px;
            color: #15803d;
            background: #ecfdf5;
            border: 1px solid rgba(34, 197, 94, 0.18);
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .04em;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        .neo-profile-status i {
            color: var(--profile-success);
        }

        .neo-profile-summary {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .neo-summary-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            min-height: 58px;
            padding: 0 18px;
            border-radius: 16px;
            background: var(--profile-bg);
            border: 1px solid var(--profile-border);
        }

        .neo-summary-label {
            color: var(--profile-muted);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .045em;
        }

        .neo-summary-value {
            color: var(--profile-text);
            font-weight: 900;
            text-align: right;
            line-height: 1.35;
        }

        .neo-divider {
            height: 1px;
            background: var(--profile-border);
            margin: 0 36px;
        }

        .neo-tabs-area {
            padding: 18px 36px 0;
            background: #ffffff;
        }

        .neo-tabs {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px;
            border-radius: 18px;
            background: var(--profile-bg);
            border: 1px solid var(--profile-border);
            overflow-x: auto;
            white-space: nowrap;
        }

        .neo-tabs::-webkit-scrollbar {
            height: 0;
        }

        .neo-tabs .nav-item {
            flex-shrink: 0;
        }

        .neo-tabs .nav-link {
            min-height: 44px;
            padding: 0 18px;
            border: 0 !important;
            border-radius: 14px;
            color: var(--profile-muted);
            font-weight: 900;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: transparent;
            transition: .18s ease;
        }

        .neo-tabs .nav-link:hover,
        .neo-tabs .nav-link.active {
            color: var(--profile-primary);
            background: #ffffff;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.05);
        }

        .neo-profile-content {
            padding: 30px 36px 36px;
            background: #ffffff;
        }

        .neo-form-section {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 32px;
        }

        .neo-section-title {
            color: var(--profile-text);
            font-weight: 900;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: -.015em;
        }

        .neo-section-title i {
            color: var(--profile-primary);
        }

        .neo-form-label {
            color: var(--profile-text);
            font-weight: 900;
            margin-bottom: 9px;
        }

        .neo-input-group {
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid var(--profile-border);
            overflow: hidden;
            padding: 0;
            transition: .18s ease;
        }

        .neo-input-group:focus-within {
            border-color: rgba(0, 158, 247, 0.45);
            box-shadow: 0 0 0 .2rem rgba(0, 158, 247, 0.10);
        }

        .neo-input-group .input-group-text {
            border: 0 !important;
            background: transparent !important;
            color: var(--profile-primary);
            padding-left: 18px;
            padding-right: 10px;
        }

        .neo-input-group .form-control {
            border: 0 !important;
            background: transparent !important;
            color: var(--profile-text);
            box-shadow: none !important;
            min-height: 54px;
            font-weight: 700;
        }

        .neo-input-group textarea.form-control {
            min-height: 146px;
            padding-top: 15px;
            resize: vertical;
        }

        .neo-input-group .form-control::placeholder {
            color: #94a3b8;
            font-weight: 600;
        }

        .neo-input-group .form-control:focus {
            background: transparent !important;
            box-shadow: none !important;
        }

        .neo-input-group .cursor-pointer {
            color: var(--profile-muted);
            padding-right: 18px;
            cursor: pointer;
            transition: .18s ease;
        }

        .neo-input-group .cursor-pointer:hover {
            color: var(--profile-primary);
        }

        .neo-form-note {
            margin-top: 16px;
            color: var(--profile-muted);
            font-weight: 650;
            line-height: 1.68;
        }

        .neo-security-note {
            border-radius: 18px;
            padding: 22px;
            background: var(--profile-bg);
            border: 1px solid var(--profile-border);
        }

        .neo-security-list {
            margin: 0;
            padding-left: 1.15rem;
            color: var(--profile-muted);
            font-weight: 700;
            line-height: 1.85;
        }

        .neo-security-list li {
            margin-bottom: 8px;
        }

        .neo-security-list li:last-child {
            margin-bottom: 0;
        }

        .neo-form-actions {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
        }

        .neo-profile-page .neo-btn-primary, 
        .neo-profile-page .btn.btn-primary {
            border: 0 !important;
            border-radius: 14px !important;
            background: var(--profile-primary) !important;
            color: #ffffff !important;
            min-height: 50px;
            padding-left: 22px;
            padding-right: 22px;
            font-weight: 900;
            box-shadow: 0 12px 26px rgba(0, 158, 247, 0.20);
            transition: .18s ease;
        }

        .neo-profile-page .neo-btn-primary:hover,
        .neo-profile-page .btn.btn-primary:hover {
            background: var(--profile-primary-dark) !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        .neo-profile-page .btn.btn-light-primary,
        .neo-profile-page .btn.btn-outline-primary {
            border: 1px solid var(--profile-border) !important;
            border-radius: 14px !important;
            background: #ffffff !important;
            color: var(--profile-primary) !important;
            min-height: 48px;
            padding-left: 18px;
            padding-right: 18px;
            font-weight: 900;
            box-shadow: none !important;
            transition: .18s ease;
        }

        .neo-profile-page .btn.btn-light-primary:hover,
        .neo-profile-page .btn.btn-outline-primary:hover {
            color: var(--profile-primary-dark) !important;
            background: var(--profile-primary-soft) !important;
            border-color: rgba(0, 158, 247, 0.22) !important;
            transform: translateY(-1px);
        }

        .alert {
            border: 1px solid var(--profile-border) !important;
            border-radius: 16px !important;
            box-shadow: none !important;
        }

        .invalid-feedback {
            font-weight: 700;
        }

        @media (max-width: 1199.98px) {
            .neo-profile-hero {
                grid-template-columns: 1fr;
            }

            .neo-profile-summary {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 991.98px) {
            .neo-profile-shell {
                border-radius: 22px;
            }

            .neo-profile-hero {
                padding: 30px 30px 24px;
                gap: 28px;
            }

            .neo-tabs-area {
                padding: 18px 30px 0;
            }

            .neo-divider {
                margin: 0 30px;
            }

            .neo-profile-content {
                padding: 30px;
            }

            .neo-form-section {
                grid-template-columns: 1fr;
                gap: 28px;
            }
        }

        @media (max-width: 767.98px) {
            .neo-profile-shell {
                border-radius: 20px;
            }

            .neo-profile-hero {
                padding: 26px 22px 22px;
            }

            .neo-profile-main {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 20px;
            }

            .neo-profile-bio {
                max-width: 100%;
            }

            .neo-profile-summary {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .neo-profile-summary .neo-summary-row:nth-child(3) {
                grid-column: 1 / -1;
            }

            .neo-summary-row {
                min-height: 56px;
                padding: 0 14px;
            }

            .neo-summary-label {
                font-size: 10px;
            }

            .neo-summary-value {
                font-size: 13px;
            }

            .neo-tabs-area {
                padding: 16px 22px 0;
            }

            .neo-divider {
                margin: 0 22px;
            }

            .neo-tabs {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px;
                width: 100%;
            }

            .neo-tabs .nav-item {
                width: 100%;
            }

            .neo-tabs .nav-link {
                width: 100%;
                min-width: 0;
                padding-left: 10px;
                padding-right: 10px;
                font-size: 13px;
            }

            .neo-profile-content {
                padding: 26px 22px 28px;
            }

            .neo-form-actions {
                justify-content: stretch;
            }

            .neo-form-actions .btn {
                width: 100%;
            }

            .neo-input-group .form-control {
                min-height: 52px;
            }

            .neo-input-group textarea.form-control {
                min-height: 138px;
            }
        }

        @media (max-width: 575.98px) {
            .neo-profile-shell {
                border-radius: 18px;
            }

            .neo-profile-hero {
                padding: 24px 16px 20px;
            }

            .neo-avatar-wrap {
                width: 106px;
                height: 106px;
            }

            .neo-avatar-edit {
                width: 28px;
                height: 28px;
                right: 7px;
                bottom: 9px;
            }

            .neo-avatar-save {
                min-width: 104px;
                min-height: 32px !important;
                padding: 0 10px !important;
                font-size: 11px !important;
                white-space: nowrap !important;
            }

            .neo-profile-name {
                font-size: 1.45rem;
            }

            .neo-profile-email,
            .neo-profile-bio {
                font-size: 13px;
            }

            .neo-tabs-area {
                padding: 14px 14px 0;
            }

            .neo-divider {
                margin: 0 14px;
            }

            .neo-tabs {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px;
            }

            .neo-tabs .nav-item,
            .neo-tabs .nav-link {
                width: 100%;
            }

            .neo-profile-content {
                padding: 24px 16px 24px;
            }

            .neo-section-title {
                font-size: 1rem;
            }

            .neo-summary-row {
                min-height: 54px;
                padding: 0 12px;
            }

            .neo-security-note {
                padding: 18px;
                border-radius: 16px;
            }
        }

        @media (max-width: 380px) {
            .neo-profile-hero {
                padding: 22px 14px 18px;
            }

            .neo-profile-content {
                padding: 22px 14px;
            }

            .neo-input-group .input-group-text {
                padding-left: 13px;
                padding-right: 7px;
            }

            .neo-input-group .cursor-pointer {
                padding-right: 13px;
            }

            .neo-input-group .form-control {
                font-size: 13px;
            }

            .neo-tabs .nav-link {
                font-size: 12px;
                gap: 6px;
            }
        }
    </style>
@endsection

@section('pengguna_content')
    @php
        $user = Auth::guard('pengguna')->user();

        $fotoUrl = $user->foto_profil
            ? route('view-file', ['folder' => 'profil', 'filename' => $user->foto_profil])
            : asset('assets/media/avatars/blank.png');

        $totalKelasSelesai = $totalKelasSelesai ?? 0;
        $totalKelas = $totalKelas ?? 0;
        $lastLogin = $lastLogin ?? ($user->last_login ?? null);
    @endphp

    <div class="neo-profile-page">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-6" role="alert">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-check-circle-fill fs-3"></i>
                    <div class="fw-bold">{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-6" role="alert">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-exclamation-triangle-fill fs-3"></i>
                    <div class="fw-bold">{{ $errors->first() }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="neo-profile-shell">
            <div class="neo-profile-inner">
                <div class="neo-profile-hero">
                    <div class="neo-profile-main">
                        <form action="{{ route('pengguna.profil.foto') }}" method="POST" enctype="multipart/form-data"
                            class="neo-avatar-form">
                            @csrf

                            <div class="neo-avatar-box">
                                <div class="neo-avatar-wrap">
                                    <div id="neoAvatarPreview" class="neo-avatar-preview"
                                        style="background-image: url('{{ $fotoUrl }}');"></div>

                                    <label class="neo-avatar-edit" title="Ganti foto">
                                        <i class="bi bi-pencil-fill"></i>
                                        <input type="file" id="foto_profil" name="foto_profil" accept=".jpg,.jpeg,.png">
                                        <input type="hidden" name="foto_remove">
                                    </label>
                                </div>

                                <button type="submit" id="btn_simpan_foto"
                                    class="btn btn-light-primary btn-sm neo-avatar-save">
                                    <i class="bi bi-upload"></i>
                                    <span>Simpan Foto</span>
                                </button>
                            </div>
                        </form>

                        <div class="min-w-0">
                            <div class="neo-profile-status">
                                <i class="bi bi-patch-check-fill"></i>
                                Pengguna Aktif
                            </div>

                            <h2 class="neo-profile-name">{{ $user->nama }}</h2>

                            <div class="neo-profile-email">
                                <i class="bi bi-envelope-fill me-2 text-primary"></i>
                                {{ $user->email }}
                            </div>

                            @if ($user->bio)
                                <p class="neo-profile-bio">{{ $user->bio }}</p>
                            @else
                                <p class="neo-profile-bio fst-italic">
                                    Tambahkan bio agar profilmu terlihat lebih lengkap dan profesional.
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="neo-profile-summary">
                        <div class="neo-summary-row">
                            <span class="neo-summary-label">Selesai</span>
                            <span class="neo-summary-value">{{ $totalKelasSelesai }}</span>
                        </div>

                        <div class="neo-summary-row">
                            <span class="neo-summary-label">Total Kelas</span>
                            <span class="neo-summary-value">{{ $totalKelas }}</span>
                        </div>

                        <div class="neo-summary-row">
                            <span class="neo-summary-label">Login</span>
                            <span class="neo-summary-value">
                                @if ($lastLogin)
                                    {{ \Carbon\Carbon::parse($lastLogin)->locale('id')->diffForHumans() }}
                                @else
                                    Baru saja
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <div class="neo-divider"></div>

                <div class="neo-tabs-area">
                    <ul class="nav neo-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tab_profil" role="tab">
                                <i class="bi bi-person-lines-fill"></i>
                                Biodata
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab_keamanan" role="tab">
                                <i class="bi bi-shield-lock-fill"></i>
                                Keamanan Akun
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content neo-profile-content">
                    <div class="tab-pane fade show active" id="tab_profil" role="tabpanel">
                        <form action="{{ route('pengguna.profil.biodata') }}" method="POST">
                            @csrf

                            <div class="neo-form-section">
                                <div>
                                    <h5 class="neo-section-title">
                                        <i class="bi bi-person-badge-fill"></i>
                                        Informasi Dasar
                                    </h5>

                                    <div class="mb-5">
                                        <label class="neo-form-label required">Nama Lengkap</label>

                                        <div class="input-group neo-input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-person-fill fs-4"></i>
                                            </span>
                                            <input type="text" id="nama" name="nama"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                maxlength="100" value="{{ old('nama', $user->nama) }}"
                                                placeholder="Masukkan nama lengkap" required>
                                        </div>

                                        @error('nama')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-5">
                                        <label class="neo-form-label required">Email</label>

                                        <div class="input-group neo-input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-envelope-fill fs-4"></i>
                                            </span>
                                            <input type="email" id="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                maxlength="100" value="{{ old('email', $user->email) }}"
                                                placeholder="Masukkan alamat email" required>
                                        </div>

                                        @error('email')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-0">
                                        <label class="neo-form-label">Telepon</label>

                                        <div class="input-group neo-input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-telephone-fill fs-4"></i>
                                            </span>
                                            <input type="text" id="telepon" name="telepon"
                                                class="form-control @error('telepon') is-invalid @enderror"
                                                maxlength="20" value="{{ old('telepon', $user->telepon) }}"
                                                placeholder="Masukkan nomor telepon">
                                        </div>

                                        @error('telepon')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <h5 class="neo-section-title">
                                        <i class="bi bi-chat-left-text-fill"></i>
                                        Tentang Kamu
                                    </h5>

                                    <div class="mb-0">
                                        <label class="neo-form-label">Bio</label>

                                        <div class="input-group neo-input-group">
                                            <span class="input-group-text align-items-start pt-4">
                                                <i class="bi bi-chat-left-text-fill fs-4"></i>
                                            </span>
                                            <textarea id="bio" name="bio"
                                                class="form-control @error('bio') is-invalid @enderror"
                                                rows="5" maxlength="1000"
                                                placeholder="Ceritakan tentang minat, pengalaman, atau hal yang sedang kamu pelajari...">{{ old('bio', $user->bio) }}</textarea>
                                        </div>

                                        @error('bio')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror

                                        <div class="neo-form-note">
                                            Bio yang jelas membantu mentor dan pengguna lain memahami fokus belajarmu.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="neo-form-actions">
                                <button type="submit" id="btn_simpan_profil" class="btn btn-primary neo-btn-primary">
                                    <i class="bi bi-save me-2"></i>
                                    Simpan Perubahan Biodata
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="tab_keamanan" role="tabpanel">
                        <form action="{{ route('pengguna.profil.password') }}" method="POST">
                            @csrf

                            <div class="neo-form-section">
                                <div>
                                    <h5 class="neo-section-title">
                                        <i class="bi bi-shield-lock-fill"></i>
                                        Ubah Password
                                    </h5>

                                    <div class="mb-5">
                                        <label class="neo-form-label">Password Lama</label>

                                        <div class="input-group neo-input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-lock-fill fs-4"></i>
                                            </span>
                                            <input class="form-control @error('password_lama') is-invalid @enderror"
                                                type="password" placeholder="Masukkan password lama" name="password_lama"
                                                id="password_lama" autocomplete="off">
                                            <span class="input-group-text cursor-pointer neo-password-toggle">
                                                <i class="bi bi-eye-slash fs-4"></i>
                                                <i class="bi bi-eye fs-4 d-none"></i>
                                            </span>
                                        </div>

                                        @error('password_lama')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-5">
                                        <label class="neo-form-label">Password Baru</label>

                                        <div class="input-group neo-input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-shield-lock-fill fs-4"></i>
                                            </span>
                                            <input class="form-control @error('password_baru') is-invalid @enderror"
                                                type="password" placeholder="Minimal 8 karakter" name="password_baru"
                                                id="password_baru" autocomplete="off">
                                            <span class="input-group-text cursor-pointer neo-password-toggle">
                                                <i class="bi bi-eye-slash fs-4"></i>
                                                <i class="bi bi-eye fs-4 d-none"></i>
                                            </span>
                                        </div>

                                        @error('password_baru')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-0">
                                        <label class="neo-form-label">Konfirmasi Password Baru</label>

                                        <div class="input-group neo-input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-shield-check fs-4"></i>
                                            </span>
                                            <input class="form-control @error('password_konfirmasi') is-invalid @enderror"
                                                type="password" placeholder="Ulangi password baru"
                                                name="password_konfirmasi" id="password_konfirmasi" autocomplete="off">
                                            <span class="input-group-text cursor-pointer neo-password-toggle">
                                                <i class="bi bi-eye-slash fs-4"></i>
                                                <i class="bi bi-eye fs-4 d-none"></i>
                                            </span>
                                        </div>

                                        @error('password_konfirmasi')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <h5 class="neo-section-title">
                                        <i class="bi bi-patch-check-fill"></i>
                                        Tips Keamanan
                                    </h5>

                                    <div class="neo-security-note">
                                        <ul class="neo-security-list">
                                            <li>Gunakan password yang berbeda dari akun lain.</li>
                                            <li>Jangan bagikan password kepada siapapun.</li>
                                            <li>Kombinasikan huruf besar, huruf kecil, angka, dan simbol.</li>
                                            <li>Ganti password secara berkala untuk menjaga keamanan akun.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="neo-form-actions">
                                <button type="submit" id="btn_simpan_password" class="btn btn-outline-primary">
                                    <i class="bi bi-shield-lock me-2"></i>
                                    Simpan Password Baru
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fotoInput = document.getElementById('foto_profil');
            const avatarPreview = document.getElementById('neoAvatarPreview');

            if (fotoInput && avatarPreview) {
                fotoInput.addEventListener('change', function () {
                    const file = this.files && this.files[0];

                    if (!file) return;

                    const reader = new FileReader();

                    reader.onload = function (event) {
                        avatarPreview.style.backgroundImage = `url('${event.target.result}')`;
                    };

                    reader.readAsDataURL(file);
                });
            }

            document.querySelectorAll('.neo-password-toggle').forEach(function (toggle) {
                toggle.addEventListener('click', function () {
                    const input = this.closest('.input-group').querySelector('input');
                    const eyeSlash = this.querySelector('.bi-eye-slash');
                    const eye = this.querySelector('.bi-eye');

                    if (!input || !eyeSlash || !eye) return;

                    if (input.type === 'password') {
                        input.type = 'text';
                        eyeSlash.classList.add('d-none');
                        eye.classList.remove('d-none');
                    } else {
                        input.type = 'password';
                        eyeSlash.classList.remove('d-none');
                        eye.classList.add('d-none');
                    }
                });
            });
        });
    </script>
@endsection