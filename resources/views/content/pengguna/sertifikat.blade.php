@extends('content.pengguna.layouts')

@section('pengguna_css')
    <style>
        :root {
            --cert-primary: #009ef7;
            --cert-primary-dark: #008bd8;
            --cert-primary-soft: #eaf6ff;
            --cert-success: #22c55e;
            --cert-success-soft: #ecfdf5;
            --cert-bg: #f8fafc;
            --cert-surface: #ffffff;
            --cert-soft: #f1f5f9;
            --cert-border: #e5e7eb;
            --cert-text: #111827;
            --cert-muted: #64748b;
        }

        .certificate-page {
            min-height: calc(100vh - 160px);
            padding: 22px 0 46px;
            background: var(--cert-bg);
        }

        .certificate-shell {
            max-width: 1060px;
            margin: 0 auto;
            padding: 0 14px;
        }

        .certificate-panel {
            background: var(--cert-surface);
            border: 1px solid var(--cert-border);
            border-radius: 22px;
            padding: 20px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
        }

        .certificate-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 18px;
        }

        .cert-back-link {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--cert-text);
            text-decoration: none;
            font-weight: 800;
            font-size: 14px;
            line-height: 1;
            padding: 12px 15px;
            border-radius: 14px;
            background: #ffffff;
            border: 1px solid var(--cert-border);
            transition: .18s ease;
        }

        .cert-back-link:hover {
            color: var(--cert-primary);
            background: var(--cert-primary-soft);
            border-color: rgba(0, 158, 247, 0.24);
            text-decoration: none;
            transform: translateY(-1px);
        }

        .certificate-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            background: var(--cert-success-soft);
            color: #15803d;
            border: 1px solid rgba(34, 197, 94, 0.18);
            font-size: 13px;
            font-weight: 900;
            white-space: nowrap;
        }

        .certificate-status i {
            color: var(--cert-success);
        }

        .certificate-card {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            padding: 22px;
            background: #ffffff;
            border: 1px solid var(--cert-border);
        }

        .certificate-hero {
            display: grid;
            grid-template-columns: 78px minmax(0, 1fr);
            gap: 18px;
            align-items: center;
            border-radius: 18px;
            padding: 22px;
            margin-bottom: 20px;
            background: var(--cert-bg);
            border: 1px solid var(--cert-border);
        }

        .certificate-badge {
            width: 78px;
            height: 78px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            background: var(--cert-primary);
            color: #d13b3b;
            font-size: 38px;
            box-shadow: 0 12px 26px rgba(14, 0, 95, 0.2);
        }

        .certificate-eyebrow {
            margin: 0 0 8px;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--cert-muted);
        }

        .certificate-title {
            margin: 0;
            font-size: clamp(26px, 5vw, 42px);
            font-weight: 950;
            line-height: 1.08;
            color: var(--cert-text);
            letter-spacing: -.045em;
        }

        .certificate-accent {
            width: 120px;
            height: 4px;
            border-radius: 999px;
            margin: 14px 0 13px;
            background: var(--cert-primary);
        }

        .certificate-description {
            max-width: 720px;
            margin: 0;
            color: var(--cert-muted);
            font-size: 15px;
            line-height: 1.75;
            font-weight: 500;
        }

        .certificate-preview {
            border-radius: 18px;
            padding: 12px;
            margin-bottom: 18px;
            background: var(--cert-bg);
            border: 1px solid var(--cert-border);
        }

        .certificate-paper {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            min-height: 410px;
            padding: clamp(30px, 5vw, 54px);
            background: #ffffff;
            border: 1px solid var(--cert-border);
            text-align: center;
        }

        .certificate-paper::before,
        .certificate-paper::after {
            display: none !important;
            content: none !important;
        }

        .certificate-border-line {
            position: absolute;
            inset: 14px;
            border-radius: 12px;
            border: 2px solid var(--cert-primary);
            pointer-events: none;
            opacity: .35;
        }

        .paper-content {
            position: relative;
            z-index: 2;
        }

        .paper-logo {
            width: 64px;
            height: 64px;
            margin: 0 auto 10px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            background: #ffffff;
            border: 1px solid var(--cert-border);
            overflow: hidden;
        }

        .paper-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .paper-logo i {
            color: var(--cert-primary);
            font-size: 30px;
        }

        .paper-university {
            margin: 0;
            font-size: 15px;
            font-weight: 900;
            color: var(--cert-text);
        }

        .paper-title {
            margin: 18px 0 10px;
            font-size: clamp(28px, 6vw, 48px);
            font-weight: 950;
            letter-spacing: .04em;
            color: var(--cert-text);
            text-transform: uppercase;
            line-height: 1.1;
        }

        .paper-label {
            margin: 0;
            color: var(--cert-muted);
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .18em;
            text-transform: uppercase;
        }

        .paper-name {
            margin: 14px auto 8px;
            max-width: 760px;
            font-size: clamp(26px, 6vw, 46px);
            line-height: 1.08;
            font-weight: 950;
            color: var(--cert-text);
            letter-spacing: -.035em;
            word-break: break-word;
        }

        .paper-line {
            width: min(420px, 78%);
            height: 2px;
            margin: 18px auto;
            border-radius: 999px;
            background: var(--cert-border);
        }

        .paper-text {
            margin: 0;
            color: var(--cert-muted);
            font-size: 15px;
            line-height: 1.65;
            font-weight: 500;
        }

        .paper-course {
            margin: 8px auto 0;
            max-width: 760px;
            color: var(--cert-text);
            font-size: clamp(18px, 3vw, 26px);
            font-weight: 950;
            line-height: 1.3;
            word-break: break-word;
        }

        .certificate-meta-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 30px;
        }

        .certificate-meta-item {
            min-width: 0;
            text-align: left;
            border-radius: 14px;
            padding: 13px 14px;
            background: var(--cert-bg);
            border: 1px solid var(--cert-border);
        }

        .certificate-meta-item span {
            display: block;
            margin-bottom: 5px;
            color: var(--cert-muted);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .certificate-meta-item strong {
            display: block;
            color: var(--cert-text);
            font-size: 13px;
            font-weight: 900;
            line-height: 1.35;
            word-break: break-word;
        }

        .certificate-bottom {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 16px;
            align-items: start;
        }

        .certificate-info {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .certificate-info-item {
            border-radius: 14px;
            padding: 15px 16px;
            background: var(--cert-bg);
            border: 1px solid var(--cert-border);
            min-width: 0;
        }

        .certificate-info-item span {
            display: block;
            margin-bottom: 6px;
            color: var(--cert-muted);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .045em;
        }

        .certificate-info-item strong {
            display: block;
            color: var(--cert-text);
            font-size: 14px;
            font-weight: 900;
            line-height: 1.45;
            word-break: break-word;
        }

        .certificate-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            min-width: 220px;
        }

        .cert-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 46px;
            padding: 12px 18px;
            border-radius: 14px;
            font-weight: 900;
            font-size: 14px;
            text-decoration: none;
            border: 1px solid transparent;
            transition: .18s ease;
            white-space: nowrap;
        }

        .cert-btn:hover {
            transform: translateY(-1px);
            text-decoration: none;
        }

        .cert-btn-primary {
            background: var(--cert-primary);
            color: #ffffff;
            border-color: var(--cert-primary);
            box-shadow: 0 12px 26px rgba(0, 158, 247, 0.20);
        }

        .cert-btn-primary:hover {
            background: var(--cert-primary-dark);
            color: #ffffff;
        }

        .cert-btn-outline {
            background: #ffffff;
            color: var(--cert-text);
            border-color: var(--cert-border);
        }

        .cert-btn-outline:hover {
            color: var(--cert-primary);
            background: var(--cert-primary-soft);
            border-color: rgba(0, 158, 247, 0.24);
        }

        .certificate-verify-box {
            margin-top: 16px;
            border-radius: 14px;
            padding: 15px 16px;
            background: var(--cert-primary-soft);
            border: 1px dashed rgba(0, 158, 247, 0.32);
        }

        .certificate-verify-box span {
            display: block;
            font-size: 12px;
            font-weight: 900;
            color: var(--cert-primary);
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .certificate-verify-box p {
            margin: 0;
            color: #334155;
            word-break: break-all;
            font-size: 13px;
            line-height: 1.55;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .certificate-bottom {
                grid-template-columns: 1fr;
            }

            .certificate-actions {
                min-width: 0;
                flex-direction: row;
                flex-wrap: wrap;
            }

            .certificate-meta-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .certificate-page {
                padding: 16px 0 34px;
            }

            .certificate-panel {
                padding: 14px;
                border-radius: 20px;
            }

            .certificate-topbar {
                align-items: stretch;
                flex-direction: column;
            }

            .certificate-status {
                justify-content: center;
            }

            .certificate-card {
                padding: 16px;
                border-radius: 18px;
            }

            .certificate-hero {
                grid-template-columns: 1fr;
                gap: 16px;
                padding: 20px;
                text-align: left;
            }

            .certificate-badge {
                width: 72px;
                height: 72px;
                border-radius: 18px;
                font-size: 34px;
            }

            .certificate-paper {
                min-height: 360px;
                padding: 28px 18px;
            }

            .certificate-border-line {
                inset: 10px;
            }

            .certificate-meta-grid,
            .certificate-info {
                grid-template-columns: 1fr;
            }

            .certificate-actions {
                flex-direction: column;
            }

            .cert-btn {
                width: 100%;
            }
        }

        @media (max-width: 420px) {
            .certificate-shell {
                padding: 0 10px;
            }

            .certificate-panel {
                padding: 12px;
            }

            .certificate-card {
                padding: 14px;
            }

            .certificate-hero {
                padding: 18px;
            }

            .paper-title {
                letter-spacing: .02em;
            }
        }
    </style>
@endsection

@section('pengguna_content')
    <section class="certificate-page">
        <div class="certificate-shell">
            <div class="certificate-panel">
                <div class="certificate-topbar">
                    <a href="{{ route('pengguna.kelas_saya') }}" class="cert-back-link">
                        <i class="bi bi-arrow-left"></i>
                        <span>Kembali ke Kelas Saya</span>
                    </a>

                    <div class="certificate-status">
                        <i class="bi bi-patch-check-fill"></i>
                        <span>Sertifikat Valid</span>
                    </div>
                </div>

                <div class="certificate-card">
                    <div class="certificate-hero">
                        <div class="certificate-badge">
                            <i class="bi bi-award"></i>
                        </div>

                        <div class="certificate-header">
                            <p class="certificate-eyebrow">Sertifikat Kelulusan</p>
                            <h1 class="certificate-title">{{ $sertifikat->judul_kelas ?? 'Sertifikat Kelas' }}</h1>
                            <div class="certificate-accent"></div>
                            <p class="certificate-description">
                                Sertifikat ini diberikan kepada peserta yang telah menyelesaikan seluruh materi
                                dan evaluasi kelas.
                            </p>
                        </div>
                    </div>

                    <div class="certificate-preview">
                        <div class="certificate-paper">
                            <div class="certificate-border-line"></div>

                            <div class="paper-content">
                                <div class="paper-logo">
                                    @if (file_exists(public_path('assets/media/logos/logo.png')))
                                        <img src="{{ asset('assets/media/logos/logo.png') }}" alt="MOOC">
                                    @else
                                        <i class="bi bi-mortarboard-fill"></i>
                                    @endif
                                </div>

                                <p class="paper-university">Universitas Nurul Jadid</p>

                                <h2 class="paper-title">Sertifikat Kelulusan</h2>

                                <p class="paper-label">Diberikan kepada</p>

                                <h3 class="paper-name">{{ $sertifikat->nama_penerima ?? '-' }}</h3>

                                <div class="paper-line"></div>

                                <p class="paper-text">
                                    Atas keberhasilannya menyelesaikan kelas
                                </p>

                                <h4 class="paper-course">{{ $sertifikat->judul_kelas ?? '-' }}</h4>

                                <div class="certificate-meta-grid">
                                    <div class="certificate-meta-item">
                                        <span>Nomor</span>
                                        <strong>{{ $sertifikat->nomor_sertifikat ?? '-' }}</strong>
                                    </div>

                                    <div class="certificate-meta-item">
                                        <span>Selesai</span>
                                        <strong>{{ $formattedTanggalSelesai ?? '-' }}</strong>
                                    </div>

                                    <div class="certificate-meta-item">
                                        <span>Diterbitkan</span>
                                        <strong>{{ $formattedDiterbitkan ?? 'Belum dicetak' }}</strong>
                                    </div>

                                    <div class="certificate-meta-item">
                                        <span>Kode</span>
                                        <strong>{{ $sertifikat->kode_verifikasi ?? '-' }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="certificate-bottom">
                        <div>
                            <div class="certificate-info">
                                <div class="certificate-info-item">
                                    <span>Nama Peserta</span>
                                    <strong>{{ $sertifikat->nama_penerima ?? '-' }}</strong>
                                </div>

                                <div class="certificate-info-item">
                                    <span>Judul Kelas</span>
                                    <strong>{{ $sertifikat->judul_kelas ?? '-' }}</strong>
                                </div>

                                <div class="certificate-info-item">
                                    <span>Nomor Sertifikat</span>
                                    <strong>{{ $sertifikat->nomor_sertifikat ?? '-' }}</strong>
                                </div>

                                <div class="certificate-info-item">
                                    <span>Kode Verifikasi</span>
                                    <strong>{{ $sertifikat->kode_verifikasi ?? '-' }}</strong>
                                </div>
                            </div>

                            @if (! empty($verifikasiUrl))
                                <div class="certificate-verify-box">
                                    <span>Link Verifikasi</span>
                                    <p>{{ $verifikasiUrl }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="certificate-actions">
                            <a href="{{ $downloadUrl }}" class="cert-btn cert-btn-primary">
                                <i class="bi bi-download"></i>
                                <span>Download Sertifikat</span>
                            </a>

                            @if (! empty($verifikasiUrl))
                                <a href="{{ $verifikasiUrl }}" target="_blank" class="cert-btn cert-btn-outline">
                                    <i class="bi bi-patch-check"></i>
                                    <span>Verifikasi</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection