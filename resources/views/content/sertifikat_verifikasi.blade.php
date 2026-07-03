@extends('content.layouts')

@section('css')
    <style>
        :root {
            --neo-bg: #e7e5e4;
            --neo-surface: #ecebea;
            --neo-primary: #009ef7;
            --neo-primary-dark: #0085d1;
            --neo-success: #22c55e;
            --neo-danger: #ef4444;
            --neo-warning: #f59e0b;
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

        .neo-verify-page {
            position: relative;
            padding-top: 18px;
            padding-bottom: 56px;
        }

        .neo-verify-hero,
        .neo-verify-card,
        .neo-info-card,
        .neo-share-card,
        .neo-help-card {
            border: 0 !important;
            border-radius: 28px !important;
            background: var(--neo-surface) !important;
            box-shadow:
                10px 10px 24px var(--neo-dark),
                -10px -10px 24px var(--neo-light) !important;
            overflow: hidden;
        }

        .neo-verify-hero {
            position: relative;
            background:
                radial-gradient(circle at 0% 0%, rgba(255, 255, 255, 0.72), transparent 42%),
                radial-gradient(circle at 100% 0%, rgba(0, 158, 247, 0.16), transparent 48%),
                radial-gradient(circle at 100% 100%, rgba(245, 158, 11, 0.12), transparent 46%),
                var(--neo-surface) !important;
        }

        .neo-verify-hero::before {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            right: -140px;
            top: -140px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0, 158, 247, 0.18), transparent 68%);
            pointer-events: none;
        }

        .neo-verify-hero::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            left: -130px;
            bottom: -130px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.12), transparent 66%);
            pointer-events: none;
        }

        .neo-verify-hero .card-body {
            position: relative;
            z-index: 1;
        }

        .neo-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            padding: 9px 14px;
            background: var(--neo-surface);
            color: var(--neo-primary);
            font-size: .78rem;
            font-weight: 800;
            box-shadow:
                4px 4px 10px var(--neo-dark-soft),
                -4px -4px 10px var(--neo-light);
        }

        .neo-status-panel {
            border-radius: 24px;
            padding: 22px;
            background: var(--neo-surface);
            box-shadow:
                inset 5px 5px 12px var(--neo-inset-dark),
                inset -5px -5px 12px var(--neo-inset-light);
        }

        .neo-status-icon {
            width: 68px;
            height: 68px;
            border-radius: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            background: var(--neo-surface);
            box-shadow:
                7px 7px 16px var(--neo-dark-soft),
                -7px -7px 16px var(--neo-light);
        }

        .neo-status-icon i {
            font-size: 2.25rem;
            line-height: 1;
        }

        .neo-status-icon.valid {
            color: var(--neo-success);
        }

        .neo-status-icon.invalid {
            color: var(--neo-danger);
        }

        .neo-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 32px;
            padding: 7px 11px;
            border-radius: 999px;
            background: var(--neo-surface);
            color: var(--neo-muted);
            font-size: .76rem;
            font-weight: 700;
            box-shadow:
                4px 4px 10px var(--neo-dark-soft),
                -4px -4px 10px var(--neo-light);
        }

        .neo-pill i {
            color: var(--neo-primary);
        }

        .neo-pill-success {
            color: #15803d;
        }

        .neo-pill-success i {
            color: var(--neo-success);
        }

        .neo-pill-danger {
            color: #b91c1c;
        }

        .neo-pill-danger i {
            color: var(--neo-danger);
        }

        .neo-data-card {
            min-height: 118px;
            border-radius: 22px;
            padding: 18px;
            background: var(--neo-surface);
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
        }

        .neo-data-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--neo-muted);
            font-size: .76rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .035em;
            margin-bottom: 8px;
        }

        .neo-data-label i {
            color: var(--neo-primary);
        }

        .neo-data-value {
            color: var(--neo-text);
            font-size: 1rem;
            font-weight: 900;
            line-height: 1.35;
            word-break: break-word;
        }

        .neo-code-box {
            border-radius: 18px;
            padding: 13px 14px;
            background: var(--neo-surface);
            color: var(--neo-text);
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
            font-size: .82rem;
            font-weight: 800;
            word-break: break-all;
        }

        .neo-share-url {
            border-radius: 18px;
            padding: 14px;
            background: var(--neo-surface);
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
            color: var(--neo-muted);
            font-size: .78rem;
            font-weight: 700;
            word-break: break-all;
        }

        .neo-list-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 14px 0;
            border-bottom: 1px solid rgba(120, 113, 108, 0.14);
        }

        .neo-list-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .neo-list-icon {
            width: 42px;
            height: 42px;
            border-radius: 15px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            background: var(--neo-surface);
            color: var(--neo-primary);
            box-shadow:
                4px 4px 10px var(--neo-dark-soft),
                -4px -4px 10px var(--neo-light);
        }

        .neo-status-stamp {
            position: absolute;
            top: 22px;
            right: -42px;
            transform: rotate(38deg);
            min-width: 170px;
            padding: 9px 18px;
            text-align: center;
            color: #ffffff;
            font-size: .78rem;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
            box-shadow: 0 10px 22px rgba(17, 24, 39, 0.22);
        }

        .neo-status-stamp.valid {
            background: var(--neo-success);
        }

        .neo-status-stamp.invalid {
            background: var(--neo-danger);
        }

        .btn.btn-primary {
            background: var(--neo-primary) !important;
            border: 0 !important;
            color: #ffffff !important;
            border-radius: 15px !important;
            box-shadow:
                5px 5px 12px rgba(120, 113, 108, 0.24),
                -5px -5px 12px rgba(255, 255, 255, 0.68);
            transition: 0.2s ease;
        }

        .btn.btn-primary:hover,
        .btn.btn-primary:focus {
            background: var(--neo-primary-dark) !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        .btn.btn-light-primary,
        .btn.btn-light,
        .btn.btn-sm.btn-light-primary {
            border: 0 !important;
            background: var(--neo-surface) !important;
            color: var(--neo-primary) !important;
            border-radius: 15px !important;
            box-shadow:
                4px 4px 10px var(--neo-dark-soft),
                -4px -4px 10px var(--neo-light);
            transition: 0.2s ease;
        }

        .btn.btn-light-primary:hover,
        .btn.btn-light:hover,
        .btn.btn-sm.btn-light-primary:hover {
            color: var(--neo-primary-dark) !important;
            transform: translateY(-1px);
        }

        .badge.badge-light-success,
        .badge.badge-light-danger,
        .badge.badge-light-primary,
        .badge.badge-light-secondary {
            border-radius: 999px;
            background: var(--neo-surface) !important;
            box-shadow:
                3px 3px 8px var(--neo-dark-soft),
                -3px -3px 8px var(--neo-light);
            padding: 8px 12px;
        }

        .badge.badge-light-success {
            color: #15803d !important;
        }

        .badge.badge-light-danger {
            color: #b91c1c !important;
        }

        .badge.badge-light-primary {
            color: var(--neo-primary) !important;
        }

        .badge.badge-light-secondary {
            color: var(--neo-muted) !important;
        }

        .neo-mini-help {
            border-radius: 22px;
            padding: 18px;
            background: var(--neo-surface);
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
        }

        @media (max-width: 991.98px) {
            .neo-verify-page {
                padding-top: 16px;
            }

            .neo-verify-hero,
            .neo-verify-card,
            .neo-info-card,
            .neo-share-card,
            .neo-help-card {
                border-radius: 24px !important;
                box-shadow:
                    8px 8px 18px var(--neo-dark-soft),
                    -8px -8px 18px var(--neo-light) !important;
            }

            .neo-status-stamp {
                display: none;
            }
        }

        @media (max-width: 575.98px) {
            .neo-verify-page {
                padding-top: 12px;
                padding-bottom: 36px;
            }

            .neo-verify-hero .card-body,
            .neo-verify-card .card-body,
            .neo-share-card .card-body,
            .neo-help-card .card-body {
                padding: 1.35rem !important;
            }

            .neo-status-panel {
                padding: 18px;
            }

            .neo-status-panel .d-flex {
                flex-direction: column;
            }

            .neo-status-icon {
                width: 62px;
                height: 62px;
            }
        }
    </style>
@endsection

@section('content')
    @php
        $isValid = $status === 'valid' && $sertifikat;
        $verificationUrl = route('sertifikat.verifikasi', $kode);
        $checkedAt = now()->format('d M Y H:i');
        $printedStatus = $isValid && $sertifikat?->sudah_dicetak ? 'Sudah dicetak' : 'Belum dicetak';
    @endphp

    <div class="neo-verify-page">
        <div class="card neo-verify-hero mb-8 mb-lg-10">
            <div class="card-body p-8 p-lg-10">
                <div class="row g-6 align-items-center">
                    <div class="col-lg-8">
                        <span class="neo-badge mb-4">
                            <i class="bi bi-shield-check fs-5"></i>
                            Verifikasi Sertifikat
                        </span>

                        <h1 class="fw-bolder text-gray-900 mb-3">
                            Hasil Pemeriksaan Sertifikat
                        </h1>

                        <p class="fs-6 text-gray-600 mb-5 mw-750px">
                            Halaman ini digunakan untuk memastikan sertifikat MOOC benar-benar tercatat pada sistem resmi.
                            Cocokkan nama penerima, nomor sertifikat, judul kelas, dan kode verifikasi dengan dokumen yang kamu miliki.
                        </p>

                        <div class="neo-code-box">
                            <i class="bi bi-upc-scan me-2 text-primary"></i>
                            {{ $kode }}
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="neo-status-panel">
                            <div class="d-flex align-items-center gap-4">
                                <span class="neo-status-icon {{ $isValid ? 'valid' : 'invalid' }}">
                                    @if ($isValid)
                                        <i class="bi bi-patch-check-fill"></i>
                                    @else
                                        <i class="bi bi-x-circle-fill"></i>
                                    @endif
                                </span>

                                <div>
                                    <div class="fw-bolder text-gray-900 fs-4 mb-1">
                                        {{ $isValid ? 'Sertifikat Valid' : 'Sertifikat Tidak Valid' }}
                                    </div>

                                    <div class="text-gray-600 fs-7">
                                        @if ($isValid)
                                            Data sertifikat cocok dengan catatan resmi.
                                        @else
                                            Kode verifikasi tidak ditemukan atau tidak sesuai.
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2 mt-5">
                                @if ($isValid)
                                    <span class="neo-pill neo-pill-success">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Valid
                                    </span>
                                @else
                                    <span class="neo-pill neo-pill-danger">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        Perlu dicek ulang
                                    </span>
                                @endif

                                <span class="neo-pill">
                                    <i class="bi bi-clock-history"></i>
                                    {{ $checkedAt }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5 g-xl-10">
            <div class="col-lg-7">
                <div class="card neo-verify-card h-100 position-relative">
                    <div class="neo-status-stamp {{ $isValid ? 'valid' : 'invalid' }}">
                        {{ $isValid ? 'Valid' : 'Tidak Valid' }}
                    </div>

                    <div class="card-body p-6 p-lg-7">
                        <div class="mb-6">
                            <h3 class="fw-bolder text-gray-900 mb-2">
                                {{ $isValid ? 'Sertifikat Autentik' : 'Sertifikat Tidak Ditemukan' }}
                            </h3>

                            <p class="text-gray-600 mb-0">
                                @if ($isValid)
                                    Data berikut berhasil dicocokkan dengan catatan sertifikat pada sistem MOOC.
                                @else
                                    Kode yang dimasukkan belum cocok dengan data sertifikat pada sistem. Pastikan kode berasal dari QR atau tautan sertifikat resmi.
                                @endif
                            </p>
                        </div>

                        <div class="row g-4">
                            <div class="col-sm-6">
                                <div class="neo-data-card">
                                    <div class="neo-data-label">
                                        <i class="bi bi-person-badge"></i>
                                        Nama Penerima
                                    </div>
                                    <div class="neo-data-value">
                                        {{ $isValid ? $sertifikat?->nama_penerima : '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="neo-data-card">
                                    <div class="neo-data-label">
                                        <i class="bi bi-award"></i>
                                        Nomor Sertifikat
                                    </div>
                                    <div class="neo-data-value">
                                        {{ $isValid ? $sertifikat?->nomor_sertifikat : '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="neo-data-card">
                                    <div class="neo-data-label">
                                        <i class="bi bi-mortarboard"></i>
                                        Judul Kelas
                                    </div>
                                    <div class="neo-data-value">
                                        {{ $isValid ? $sertifikat?->judul_kelas : '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="neo-data-card">
                                    <div class="neo-data-label">
                                        <i class="bi bi-calendar-check"></i>
                                        Tanggal Selesai
                                    </div>
                                    <div class="neo-data-value">
                                        {{ $isValid ? ($formattedTanggalSelesai ?? '-') : '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="neo-data-card">
                                    <div class="neo-data-label">
                                        <i class="bi bi-printer"></i>
                                        Status Cetak
                                    </div>
                                    <div class="neo-data-value">
                                        @if ($isValid && $sertifikat?->sudah_dicetak)
                                            <span class="badge badge-light-success">
                                                <i class="bi bi-check-circle me-1"></i>
                                                {{ $printedStatus }}
                                            </span>
                                        @else
                                            <span class="badge badge-light-secondary">
                                                <i class="bi bi-dash-circle me-1"></i>
                                                {{ $printedStatus }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="neo-data-card">
                                    <div class="neo-data-label">
                                        <i class="bi bi-shield-lock"></i>
                                        Status Verifikasi
                                    </div>
                                    <div class="neo-data-value">
                                        @if ($isValid)
                                            <span class="badge badge-light-success">
                                                <i class="bi bi-patch-check-fill me-1"></i>
                                                Autentik
                                            </span>
                                        @else
                                            <span class="badge badge-light-danger">
                                                <i class="bi bi-x-circle-fill me-1"></i>
                                                Tidak ditemukan
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="neo-data-card">
                                    <div class="neo-data-label">
                                        <i class="bi bi-upc"></i>
                                        Catatan Verifikasi
                                    </div>

                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="neo-pill">
                                            <i class="bi bi-hash"></i>
                                            Kode: {{ $kode }}
                                        </span>

                                        <span class="neo-pill">
                                            <i class="bi bi-calendar-event"></i>
                                            Selesai: {{ $isValid ? ($formattedTanggalSelesai ?? '-') : '-' }}
                                        </span>

                                        <span class="neo-pill">
                                            <i class="bi bi-clock"></i>
                                            Terakhir cek: {{ $checkedAt }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="neo-mini-help">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="neo-list-icon me-3">
                                            <i class="bi bi-shield-check"></i>
                                        </span>

                                        <div>
                                            <div class="fw-bolder text-gray-900">Apa yang diverifikasi?</div>
                                            <div class="text-gray-600 fs-7">Sistem mencocokkan kode unik dengan data sertifikat resmi.</div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="neo-pill">
                                            <i class="bi bi-person"></i>
                                            Identitas penerima
                                        </span>
                                        <span class="neo-pill">
                                            <i class="bi bi-journal-check"></i>
                                            Judul kelas
                                        </span>
                                        <span class="neo-pill">
                                            <i class="bi bi-calendar2-check"></i>
                                            Tanggal selesai
                                        </span>
                                        <span class="neo-pill">
                                            <i class="bi bi-qr-code"></i>
                                            Kode unik
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-3 mt-6">
                            <a href="{{ route('kursus.index') }}" class="btn btn-light-primary fw-bold">
                                <i class="bi bi-collection-play me-2"></i>
                                Lihat Kursus
                            </a>

                            <a href="{{ url('/') }}" class="btn btn-light-primary fw-bold">
                                <i class="bi bi-house-door me-2"></i>
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card neo-share-card mb-5 mb-xl-8">
                    <div class="card-body p-6 p-lg-7">
                        <div class="d-flex align-items-center mb-5">
                            <span class="neo-list-icon me-3">
                                <i class="bi bi-upc-scan"></i>
                            </span>

                            <div>
                                <h4 class="fw-bolder text-gray-900 mb-1">Bagikan Verifikasi</h4>
                                <div class="text-gray-600 fs-7">
                                    Tautan ini bisa digunakan untuk memvalidasi sertifikat.
                                </div>
                            </div>
                        </div>

                        <div class="neo-share-url mb-4">
                            {{ $verificationUrl }}
                        </div>

                        <div class="d-flex flex-wrap gap-3">
                            <button type="button" class="btn btn-primary fw-bold" data-clipboard-text="{{ $verificationUrl }}">
                                <i class="bi bi-clipboard-check me-2"></i>
                                Salin Tautan
                            </button>

                            <a class="btn btn-light-primary fw-bold" target="_blank" href="{{ $verificationUrl }}">
                                <i class="bi bi-box-arrow-up-right me-2"></i>
                                Buka
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card neo-info-card mb-5 mb-xl-8">
                    <div class="card-body p-6 p-lg-7">
                        <h4 class="fw-bolder text-gray-900 mb-4">Detail Keaslian</h4>

                        <div class="neo-list-item">
                            <span class="neo-list-icon">
                                <i class="bi bi-hash"></i>
                            </span>
                            <div>
                                <div class="fw-bold text-gray-900">Kode Verifikasi</div>
                                <div class="text-gray-600 fs-7">{{ $kode }}</div>
                            </div>
                        </div>

                        <div class="neo-list-item">
                            <span class="neo-list-icon">
                                <i class="bi bi-calendar-check"></i>
                            </span>
                            <div>
                                <div class="fw-bold text-gray-900">Tanggal Selesai</div>
                                <div class="text-gray-600 fs-7">{{ $isValid ? ($formattedTanggalSelesai ?? '-') : '-' }}</div>
                            </div>
                        </div>

                        <div class="neo-list-item">
                            <span class="neo-list-icon">
                                <i class="bi bi-award"></i>
                            </span>
                            <div>
                                <div class="fw-bold text-gray-900">Judul Kelas</div>
                                <div class="text-gray-600 fs-7">{{ $isValid ? $sertifikat?->judul_kelas : '-' }}</div>
                            </div>
                        </div>

                        <div class="neo-list-item">
                            <span class="neo-list-icon">
                                <i class="bi bi-building"></i>
                            </span>
                            <div>
                                <div class="fw-bold text-gray-900">Penerbit</div>
                                <div class="text-gray-600 fs-7">Massive Open Online Course - Universitas Nurul Jadid</div>
                            </div>
                        </div>

                        <div class="neo-list-item">
                            <span class="neo-list-icon">
                                <i class="bi bi-shield-check"></i>
                            </span>
                            <div>
                                <div class="fw-bold text-gray-900">Status Pencocokan</div>
                                <div class="text-gray-600 fs-7">
                                    @if ($isValid)
                                        Seluruh data cocok dengan catatan resmi.
                                    @else
                                        Tidak ada catatan yang cocok dengan kode ini.
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card neo-help-card">
                    <div class="card-body p-6 p-lg-7">
                        <h4 class="fw-bolder text-gray-900 mb-4">Tips Memastikan Keaslian</h4>

                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-primary me-3 mt-1"></i>
                                <div class="text-gray-600 fs-7">
                                    Pastikan kode verifikasi berasal dari QR atau tautan pada sertifikat resmi.
                                </div>
                            </div>

                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-primary me-3 mt-1"></i>
                                <div class="text-gray-600 fs-7">
                                    Cocokkan nama penerima, judul kelas, dan nomor sertifikat dengan dokumen.
                                </div>
                            </div>

                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-primary me-3 mt-1"></i>
                                <div class="text-gray-600 fs-7">
                                    Jika data tidak cocok, scan ulang QR atau hubungi admin MOOC.
                                </div>
                            </div>
                        </div>

                        @if ($isValid)
                            <div class="mt-5 neo-mini-help">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-patch-check-fill text-success fs-3 me-3"></i>
                                    <div>
                                        <div class="fw-bolder text-gray-900">Verifikasi berhasil</div>
                                        <div class="text-gray-600 fs-7">
                                            Sertifikat ini tercatat pada sistem dan dapat dibagikan.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="mt-5 neo-mini-help">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-info-circle-fill text-warning fs-3 me-3"></i>
                                    <div>
                                        <div class="fw-bolder text-gray-900">Butuh bantuan?</div>
                                        <div class="text-gray-600 fs-7">
                                            Pastikan kode benar, lalu coba kembali atau hubungi admin jika tetap bermasalah.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        document.addEventListener('click', function (event) {
            const trigger = event.target.closest('[data-clipboard-text]');

            if (!trigger) {
                return;
            }

            const text = trigger.getAttribute('data-clipboard-text');
            const original = trigger.innerHTML;

            if (!navigator.clipboard) {
                const temporaryInput = document.createElement('input');
                temporaryInput.value = text;
                document.body.appendChild(temporaryInput);
                temporaryInput.select();
                document.execCommand('copy');
                document.body.removeChild(temporaryInput);

                trigger.innerHTML = '<i class="bi bi-check2 me-2"></i> Disalin';
                setTimeout(() => trigger.innerHTML = original, 1500);

                return;
            }

            navigator.clipboard.writeText(text).then(() => {
                trigger.innerHTML = '<i class="bi bi-check2 me-2"></i> Disalin';
                setTimeout(() => trigger.innerHTML = original, 1500);
            });
        });
    </script>
@endsection
