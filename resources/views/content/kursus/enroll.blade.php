@extends('content.layouts')

@php
    $bannerUrl = $kelas->banner
        ? route('view-file', ['folder' => 'banner', 'filename' => $kelas->banner])
        : asset('assets/media/illustrations/fallback.jpg');

    $tingkatLabel =
        [
            'pemula' => 'Pemula',
            'menengah' => 'Menengah',
            'lanjutan' => 'Lanjutan',
        ][(string) $kelas->tingkat] ?? Str::title((string) $kelas->tingkat);
@endphp

@section('css')
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

        .content,
        #kt_content,
        #kt_post,
        #kt_content_container {
            background: transparent !important;
        }

        .neo-enroll-page {
            min-height: calc(100vh - 120px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 0 56px;
            position: relative;
        }

        .neo-enroll-shell {
            width: min(100%, 980px);
            margin: 0 auto;
        }

        .neo-enroll-card {
            border: 0 !important;
            border-radius: 30px !important;
            background: var(--neo-surface) !important;
            box-shadow:
                12px 12px 28px var(--neo-dark),
                -12px -12px 28px var(--neo-light) !important;
            overflow: hidden;
        }

        .neo-enroll-cover {
            position: relative;
            min-height: 420px;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
            padding: 32px;
            overflow: hidden;
        }

        .neo-enroll-cover::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(17, 24, 39, 0.12) 0%, rgba(17, 24, 39, 0.18) 36%, rgba(17, 24, 39, 0.78) 100%),
                radial-gradient(circle at 10% 10%, rgba(255, 255, 255, 0.18), transparent 42%),
                radial-gradient(circle at 100% 100%, rgba(0, 158, 247, 0.24), transparent 48%);
            z-index: 1;
        }

        .neo-enroll-cover-content {
            position: relative;
            z-index: 2;
            color: #ffffff;
        }

        .neo-enroll-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            padding: 8px 13px;
            margin-bottom: 14px;
            background: rgba(231, 229, 228, 0.18);
            color: #ffffff;
            font-size: .78rem;
            font-weight: 800;
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .neo-enroll-title {
            color: #ffffff;
            font-size: clamp(1.55rem, 3vw, 2.35rem);
            font-weight: 900;
            line-height: 1.15;
            letter-spacing: -0.04em;
            margin-bottom: 16px;
            text-shadow: 0 10px 30px rgba(0, 0, 0, .38);
        }

        .neo-enroll-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .neo-enroll-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 34px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(231, 229, 228, 0.16);
            color: rgba(255, 255, 255, .94);
            font-size: .78rem;
            font-weight: 800;
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, .10);
        }

        .neo-enroll-pill i {
            color: var(--neo-primary);
        }

        .neo-enroll-side {
            min-height: 420px;
            padding: 34px;
            display: flex;
            align-items: center;
            background:
                radial-gradient(circle at 0% 0%, rgba(255, 255, 255, 0.72), transparent 44%),
                radial-gradient(circle at 100% 100%, rgba(0, 158, 247, 0.12), transparent 50%),
                var(--neo-surface);
        }

        .neo-enroll-side-inner {
            width: 100%;
        }

        .neo-mini-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            padding: 8px 13px;
            margin-bottom: 18px;
            background: var(--neo-surface);
            color: var(--neo-primary);
            font-size: .78rem;
            font-weight: 800;
            box-shadow:
                4px 4px 10px var(--neo-dark-soft),
                -4px -4px 10px var(--neo-light);
        }

        .neo-enroll-heading {
            color: var(--neo-text);
            font-size: clamp(1.45rem, 2vw, 2rem);
            font-weight: 900;
            letter-spacing: -0.035em;
            margin-bottom: 10px;
        }

        .neo-enroll-desc {
            color: var(--neo-muted);
            font-size: .98rem;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .neo-summary-list {
            display: grid;
            gap: 12px;
            margin-bottom: 26px;
        }

        .neo-summary-item {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 14px;
            border-radius: 18px;
            background: var(--neo-surface);
            color: var(--neo-text);
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
        }

        .neo-summary-icon {
            width: 38px;
            height: 38px;
            border-radius: 14px;
            flex: 0 0 auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--neo-surface);
            color: var(--neo-primary);
            box-shadow:
                4px 4px 10px var(--neo-dark-soft),
                -4px -4px 10px var(--neo-light);
        }

        .neo-summary-icon i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            font-size: 1.15rem;
        }

        .neo-summary-item span:last-child {
            color: var(--neo-text);
            font-weight: 700;
            font-size: .9rem;
        }

        .neo-confirm-btn {
            width: 100%;
            border: 0 !important;
            border-radius: 18px !important;
            min-height: 52px;
            background: var(--neo-primary) !important;
            color: #ffffff !important;
            font-weight: 900 !important;
            font-size: .98rem;
            box-shadow:
                6px 6px 14px rgba(120, 113, 108, 0.26),
                -6px -6px 14px rgba(255, 255, 255, 0.72);
            transition: .22s ease;
        }

        .neo-confirm-btn:hover,
        .neo-confirm-btn:focus {
            background: var(--neo-primary-dark) !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        .neo-cancel-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            margin-top: 14px;
            min-height: 46px;
            border-radius: 16px;
            background: var(--neo-surface);
            color: var(--neo-muted);
            font-weight: 800;
            text-decoration: none;
            box-shadow:
                4px 4px 10px var(--neo-dark-soft),
                -4px -4px 10px var(--neo-light);
            transition: .2s ease;
        }

        .neo-cancel-link:hover {
            color: var(--neo-primary);
            transform: translateY(-1px);
        }

        .neo-note-box {
            margin-top: 20px;
            padding: 14px 15px;
            border-radius: 18px;
            background: var(--neo-surface);
            color: var(--neo-muted);
            font-size: .82rem;
            line-height: 1.6;
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
        }

        .neo-note-box i {
            color: var(--neo-primary);
        }

        @media (max-width: 991.98px) {
            .neo-enroll-page {
                padding-top: 20px;
            }

            .neo-enroll-card {
                border-radius: 26px !important;
            }

            .neo-enroll-cover {
                min-height: 320px;
            }

            .neo-enroll-side {
                min-height: auto;
            }
        }

        @media (max-width: 575.98px) {
            .neo-enroll-page {
                padding-top: 12px;
                padding-bottom: 36px;
            }

            .neo-enroll-cover {
                min-height: 280px;
                padding: 24px;
            }

            .neo-enroll-side {
                padding: 24px;
            }

            .neo-enroll-card {
                border-radius: 22px !important;
                box-shadow:
                    8px 8px 18px var(--neo-dark-soft),
                    -8px -8px 18px var(--neo-light) !important;
            }
        }
    </style>
@endsection

@section('content')
    <div class="neo-enroll-page">
        <div class="neo-enroll-shell">
            <div class="card neo-enroll-card">
                <div class="row g-0">
                    <div class="col-lg-5">
                        <div class="neo-enroll-cover" style="background-image: url('{{ $bannerUrl }}')">
                            <div class="neo-enroll-cover-content">
                                <div class="neo-enroll-badge">
                                    <i class="bi bi-stars"></i>
                                    <span>Kursus MOOC</span>
                                </div>

                                <h1 class="neo-enroll-title">
                                    {{ $kelas->judul }}
                                </h1>

                                <div class="neo-enroll-meta">
                                    <span class="neo-enroll-pill">
                                        <i class="bi bi-bar-chart-steps"></i>
                                        {{ $tingkatLabel }}
                                    </span>

                                    <span class="neo-enroll-pill">
                                        <i class="bi bi-clock"></i>
                                        {{ formatMinutes($kelas->total_durasi_menit) }}
                                    </span>

                                    <span class="neo-enroll-pill">
                                        <i class="bi bi-collection-play"></i>
                                        {{ $kelas->jumlah_materi }} Materi
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="neo-enroll-side">
                            <div class="neo-enroll-side-inner">
                                <div class="neo-mini-label">
                                    <i class="bi bi-person-check"></i>
                                    <span>Konfirmasi Pendaftaran</span>
                                </div>

                                <h2 class="neo-enroll-heading">
                                    Gabung Kursus Ini
                                </h2>

                                <p class="neo-enroll-desc">
                                    Kamu akan mendaftar ke kursus ini secara gratis. Setelah konfirmasi,
                                    kelas akan masuk ke daftar pembelajaranmu dan kamu bisa langsung mulai belajar.
                                </p>

                                <div class="neo-summary-list">
                                    <div class="neo-summary-item">
                                        <span class="neo-summary-icon">
                                            <i class="bi bi-collection-play"></i>
                                        </span>
                                        <span>Akses ke {{ $kelas->jumlah_materi }} materi pembelajaran</span>
                                    </div>

                                    @if ($kelas->sertifikat)
                                        <div class="neo-summary-item">
                                            <span class="neo-summary-icon">
                                                <i class="bi bi-patch-check-fill"></i>
                                            </span>
                                            <span>Sertifikat kelulusan setelah menyelesaikan kelas</span>
                                        </div>
                                    @endif

                                    <div class="neo-summary-item">
                                        <span class="neo-summary-icon">
                                            <i class="bi bi-person-check-fill"></i>
                                        </span>
                                        <span>Dipandu oleh mentor utama kelas</span>
                                    </div>

                                    <div class="neo-summary-item">
                                        <span class="neo-summary-icon">
                                            <i class="bi bi-clock-fill"></i>
                                        </span>
                                        <span>Akses pembelajaran tersedia kapan saja</span>
                                    </div>
                                </div>

                                <form action="{{ route('kursus.enroll-process', ['kelas' => $kelas->slug]) }}" method="POST">
                                    @csrf

                                    <button type="submit" class="btn neo-confirm-btn">
                                        Konfirmasi & Gabung Kelas
                                        <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </form>

                                <a href="{{ route('kursus.detail', ['slug' => $kelas->slug]) }}" class="neo-cancel-link">
                                    <i class="bi bi-arrow-left"></i>
                                    Batal dan kembali ke detail kursus
                                </a>

                                <div class="neo-note-box">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Pendaftaran ini akan tercatat sebagai kelas aktif di akun kamu.
                                    Pastikan kamu sudah memilih kelas yang sesuai sebelum melanjutkan.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection