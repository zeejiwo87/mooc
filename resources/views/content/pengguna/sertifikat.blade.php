@extends('content.pengguna.layouts')

@section('pengguna_css')
    <style>
        .certificate-page {
            min-height: calc(100vh - 160px);
            padding: 22px 0 46px;
            background:
                radial-gradient(circle at top left, rgba(0, 158, 247, .10), transparent 34%),
                radial-gradient(circle at bottom right, rgba(34, 197, 94, .10), transparent 34%),
                #f3f4f6;
        }

        .certificate-shell {
            max-width: 1060px;
            margin: 0 auto;
            padding: 0 14px;
        }

        .certificate-panel {
            background: rgba(255, 255, 255, .62);
            border: 1px solid rgba(255, 255, 255, .72);
            border-radius: 28px;
            padding: 22px;
            box-shadow:
                18px 18px 40px rgba(15, 23, 42, .08),
                -14px -14px 36px rgba(255, 255, 255, .86);
            backdrop-filter: blur(14px);
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
            color: #475569;
            text-decoration: none;
            font-weight: 800;
            font-size: 14px;
            line-height: 1;
            padding: 13px 16px;
            border-radius: 16px;
            background: #f4f6f8;
            box-shadow:
                7px 7px 16px rgba(15, 23, 42, .08),
                -7px -7px 16px rgba(255, 255, 255, .88);
            transition: .22s ease;
        }

        .cert-back-link:hover {
            color: #009ef7;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .certificate-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 14px;
            border-radius: 999px;
            background: rgba(34, 197, 94, .10);
            color: #16a34a;
            font-size: 13px;
            font-weight: 900;
            white-space: nowrap;
        }

        .certificate-card {
            position: relative;
            overflow: hidden;
            border-radius: 26px;
            padding: 26px;
            background: #f7f8fa;
            box-shadow:
                inset 7px 7px 18px rgba(15, 23, 42, .045),
                inset -7px -7px 18px rgba(255, 255, 255, .92);
        }

        .certificate-hero {
            display: grid;
            grid-template-columns: 86px minmax(0, 1fr);
            gap: 22px;
            align-items: center;
            border-radius: 24px;
            padding: 24px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, .76);
            border: 1px solid rgba(226, 232, 240, .82);
            box-shadow:
                12px 12px 28px rgba(15, 23, 42, .07),
                -10px -10px 26px rgba(255, 255, 255, .88);
        }

        .certificate-badge {
            width: 86px;
            height: 86px;
            border-radius: 24px;
            display: grid;
            place-items: center;
            background:
                linear-gradient(135deg, rgba(0, 158, 247, .82), rgba(34, 197, 94, .82));
            color: #fff;
            font-size: 42px;
            box-shadow:
                0 16px 32px rgba(0, 158, 247, .20),
                inset 5px 5px 10px rgba(255, 255, 255, .22),
                inset -5px -5px 10px rgba(15, 23, 42, .10);
        }

        .certificate-eyebrow {
            margin: 0 0 8px;
            font-size: 12px;
            font-weight: 950;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: #64748b;
        }

        .certificate-title {
            margin: 0;
            font-size: clamp(28px, 5vw, 46px);
            font-weight: 950;
            line-height: 1.05;
            color: #0f172a;
            letter-spacing: -.045em;
        }

        .certificate-accent {
            width: 140px;
            height: 4px;
            border-radius: 999px;
            margin: 16px 0 14px;
            background: linear-gradient(90deg, #009ef7, #22c55e, #facc15);
        }

        .certificate-description {
            max-width: 720px;
            margin: 0;
            color: #64748b;
            font-size: 15.5px;
            line-height: 1.75;
            font-weight: 500;
        }

        .certificate-preview {
            border-radius: 24px;
            padding: 12px;
            margin-bottom: 18px;
            background: #f4f6f8;
            box-shadow:
                inset 8px 8px 18px rgba(15, 23, 42, .06),
                inset -8px -8px 18px rgba(255, 255, 255, .86);
        }

        .certificate-paper {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            min-height: 410px;
            padding: clamp(30px, 5vw, 56px);
            background:
                linear-gradient(135deg, rgba(255,255,255,.95), rgba(255,255,255,.84)),
                #ffffff;
            border: 1px solid rgba(203, 213, 225, .75);
            text-align: center;
        }

        .certificate-paper::before,
        .certificate-paper::after {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 999px;
            pointer-events: none;
        }

        .certificate-paper::before {
            top: -150px;
            left: -135px;
            background:
                radial-gradient(circle, rgba(0, 158, 247, .13), transparent 66%);
        }

        .certificate-paper::after {
            right: -140px;
            bottom: -150px;
            background:
                radial-gradient(circle, rgba(34, 197, 94, .13), transparent 66%);
        }

        .certificate-border-line {
            position: absolute;
            inset: 14px;
            border-radius: 16px;
            border: 2px solid transparent;
            background:
                linear-gradient(#fff, #fff) padding-box,
                linear-gradient(90deg, rgba(0, 158, 247, .62), rgba(34, 197, 94, .56), rgba(250, 204, 21, .56)) border-box;
            pointer-events: none;
            opacity: .86;
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
            background: rgba(255, 255, 255, .86);
            box-shadow:
                7px 7px 16px rgba(15, 23, 42, .08),
                -7px -7px 16px rgba(255, 255, 255, .94);
            overflow: hidden;
        }

        .paper-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .paper-logo i {
            color: #009ef7;
            font-size: 30px;
        }

        .paper-university {
            margin: 0;
            font-size: 15px;
            font-weight: 900;
            color: #0f172a;
        }

        .paper-title {
            margin: 18px 0 10px;
            font-size: clamp(30px, 6vw, 52px);
            font-weight: 950;
            letter-spacing: .04em;
            color: #0f172a;
            text-transform: uppercase;
            line-height: 1.1;
        }

        .paper-label {
            margin: 0;
            color: #64748b;
            font-size: 12px;
            font-weight: 950;
            letter-spacing: .18em;
            text-transform: uppercase;
        }

        .paper-name {
            margin: 14px auto 8px;
            max-width: 760px;
            font-size: clamp(28px, 6vw, 50px);
            line-height: 1.08;
            font-weight: 950;
            color: #111827;
            letter-spacing: -.035em;
            word-break: break-word;
        }

        .paper-line {
            width: min(420px, 78%);
            height: 2px;
            margin: 18px auto;
            border-radius: 999px;
            background: linear-gradient(90deg, transparent, rgba(15, 23, 42, .30), transparent);
        }

        .paper-text {
            margin: 0;
            color: #64748b;
            font-size: 15px;
            line-height: 1.65;
            font-weight: 500;
        }

        .paper-course {
            margin: 8px auto 0;
            max-width: 760px;
            color: #0f172a;
            font-size: clamp(19px, 3vw, 28px);
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
            border-radius: 16px;
            padding: 13px 14px;
            background: rgba(248, 250, 252, .82);
            border: 1px solid rgba(226, 232, 240, .82);
        }

        .certificate-meta-item span {
            display: block;
            margin-bottom: 5px;
            color: #64748b;
            font-size: 11px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .certificate-meta-item strong {
            display: block;
            color: #0f172a;
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
            border-radius: 18px;
            padding: 15px 16px;
            background: #f7f8fa;
            box-shadow:
                7px 7px 16px rgba(15, 23, 42, .06),
                -7px -7px 16px rgba(255, 255, 255, .88);
            min-width: 0;
        }

        .certificate-info-item span {
            display: block;
            margin-bottom: 6px;
            color: #64748b;
            font-size: 12px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: .045em;
        }

        .certificate-info-item strong {
            display: block;
            color: #0f172a;
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
            border-radius: 16px;
            font-weight: 950;
            font-size: 14px;
            text-decoration: none;
            border: 0;
            transition: .22s ease;
            white-space: nowrap;
        }

        .cert-btn:hover {
            transform: translateY(-1px);
            text-decoration: none;
        }

        .cert-btn-primary {
            background: linear-gradient(135deg, #009ef7, #3b82f6);
            color: #fff;
            box-shadow: 0 14px 26px rgba(0, 158, 247, .22);
        }

        .cert-btn-primary:hover {
            color: #fff;
            filter: brightness(.98);
        }

        .cert-btn-outline {
            background: #f7f8fa;
            color: #0f172a;
            box-shadow:
                7px 7px 16px rgba(15, 23, 42, .06),
                -7px -7px 16px rgba(255, 255, 255, .88);
        }

        .cert-btn-outline:hover {
            color: #009ef7;
        }

        .certificate-verify-box {
            margin-top: 16px;
            border-radius: 18px;
            padding: 15px 16px;
            background: rgba(0, 158, 247, .055);
            border: 1px dashed rgba(0, 158, 247, .32);
        }

        .certificate-verify-box span {
            display: block;
            font-size: 12px;
            font-weight: 950;
            color: #009ef7;
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
                border-radius: 24px;
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
                border-radius: 22px;
            }

            .certificate-hero {
                grid-template-columns: 1fr;
                gap: 16px;
                padding: 20px;
                text-align: left;
            }

            .certificate-badge {
                width: 74px;
                height: 74px;
                border-radius: 22px;
                font-size: 36px;
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