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
            --enroll-primary: #009ef7;
            --enroll-primary-dark: #008bd8;
            --enroll-primary-soft: #eaf6ff;
            --enroll-bg: #f8fafc;
            --enroll-surface: #ffffff;
            --enroll-border: #e5e7eb;
            --enroll-text: #111827;
            --enroll-muted: #64748b;
            --enroll-success: #10b981;
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
            background: var(--enroll-bg);
        }

        .neo-enroll-shell {
            width: min(100%, 980px);
            margin: 0 auto;
            padding: 0 16px;
        }

        .neo-enroll-card {
            border: 1px solid var(--enroll-border) !important;
            border-radius: 1.5rem !important;
            background: var(--enroll-surface) !important;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06) !important;
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
            background: linear-gradient(
                180deg,
                rgba(15, 23, 42, 0.10) 0%,
                rgba(15, 23, 42, 0.22) 45%,
                rgba(15, 23, 42, 0.72) 100%
            );
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
            background: rgba(255, 255, 255, 0.16);
            color: #ffffff;
            font-size: .78rem;
            font-weight: 800;
            border: 1px solid rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(10px);
        }

        .neo-enroll-title {
            color: #ffffff;
            font-size: clamp(1.55rem, 3vw, 2.35rem);
            font-weight: 900;
            line-height: 1.15;
            letter-spacing: -0.04em;
            margin-bottom: 16px;
            text-shadow: 0 8px 24px rgba(0, 0, 0, .32);
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
            background: rgba(255, 255, 255, 0.14);
            color: rgba(255, 255, 255, .95);
            font-size: .78rem;
            font-weight: 800;
            border: 1px solid rgba(255, 255, 255, .16);
            backdrop-filter: blur(10px);
        }

        .neo-enroll-pill i {
            color: #ffffff;
        }

        .neo-enroll-side {
            min-height: 420px;
            padding: 34px;
            display: flex;
            align-items: center;
            background: #ffffff;
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
            background: var(--enroll-primary-soft);
            color: var(--enroll-primary);
            font-size: .78rem;
            font-weight: 800;
            border: 1px solid rgba(0, 158, 247, 0.12);
        }

        .neo-enroll-heading {
            color: var(--enroll-text);
            font-size: clamp(1.45rem, 2vw, 2rem);
            font-weight: 900;
            letter-spacing: -0.035em;
            margin-bottom: 10px;
        }

        .neo-enroll-desc {
            color: var(--enroll-muted);
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
            border-radius: 1rem;
            background: #ffffff;
            color: var(--enroll-text);
            border: 1px solid var(--enroll-border);
        }

        .neo-summary-icon {
            width: 38px;
            height: 38px;
            border-radius: .85rem;
            flex: 0 0 auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--enroll-primary-soft);
            color: var(--enroll-primary);
        }

        .neo-summary-icon i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            font-size: 1.15rem;
        }

        .neo-summary-item span:last-child {
            color: var(--enroll-text);
            font-weight: 700;
            font-size: .9rem;
        }

        .neo-confirm-btn {
            width: 100%;
            border: 0 !important;
            border-radius: 1rem !important;
            min-height: 52px;
            background: var(--enroll-primary) !important;
            color: #ffffff !important;
            font-weight: 900 !important;
            font-size: .98rem;
            box-shadow: 0 14px 30px rgba(0, 158, 247, 0.22);
            transition: .18s ease;
        }

        .neo-confirm-btn:hover,
        .neo-confirm-btn:focus {
            background: var(--enroll-primary-dark) !important;
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
            border-radius: 1rem;
            background: #ffffff;
            color: var(--enroll-muted);
            font-weight: 800;
            text-decoration: none;
            border: 1px solid var(--enroll-border);
            transition: .18s ease;
        }

        .neo-cancel-link:hover {
            color: var(--enroll-primary);
            background: var(--enroll-primary-soft);
            border-color: rgba(0, 158, 247, 0.22);
            transform: translateY(-1px);
        }

        .neo-note-box {
            margin-top: 20px;
            padding: 14px 15px;
            border-radius: 1rem;
            background: #f8fafc;
            color: var(--enroll-muted);
            font-size: .82rem;
            line-height: 1.6;
            border: 1px solid var(--enroll-border);
        }

        .neo-note-box i {
            color: var(--enroll-primary);
        }

        @media (max-width: 991.98px) {
            .neo-enroll-page {
                padding-top: 20px;
            }

            .neo-enroll-card {
                border-radius: 1.35rem !important;
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

            .neo-enroll-shell {
                padding: 0 12px;
            }

            .neo-enroll-cover {
                min-height: 280px;
                padding: 24px;
            }

            .neo-enroll-side {
                padding: 24px;
            }

            .neo-enroll-card {
                border-radius: 1.15rem !important;
                box-shadow: 0 14px 34px rgba(15, 23, 42, 0.06) !important;
            }

            .neo-enroll-title {
                font-size: 1.45rem;
            }

            .neo-summary-item {
                align-items: flex-start;
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