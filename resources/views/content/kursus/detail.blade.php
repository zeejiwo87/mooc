@extends('content.layouts')

@php
    $bannerUrl = $kelas->banner
        ? route('view-file', ['folder' => 'banner', 'filename' => $kelas->banner])
        : asset('assets/media/illustrations/fallback.jpg');

    $videoIntro = toEmbedUrl($kelas->video_intro_url ?: $kelas->video_preview);

    $bahasaLabel =
        [
            'ID' => 'Bahasa Indonesia',
            'EN' => 'Bahasa Inggris',
            'AR' => 'Bahasa Arab',
        ][$kelas->bahasa] ?? $kelas->bahasa;

    $tingkatLabel =
        [
            'pemula' => 'Pemula',
            'menengah' => 'Menengah',
            'lanjutan' => 'Lanjutan',
        ][$kelas->tingkat] ?? Str::title($kelas->tingkat);

    $totalSections = $bagianList->count();
    $totalMaterials = (int) ($jumlahMateri ?? $kelas->jumlah_materi ?? 0);
    $totalDurationMinutes = (int) ($totalDurasiMenit ?? $kelas->total_durasi_menit ?? 0);
    $totalStudents = (int) ($kelas->total_pendaftaran ?? 0);

    $videoCount = (int) ($jumlahVideo ?? 0);
    $textCount = (int) ($jumlahText ?? 0);

    // Kuis pada sistem ini disimpan di tabel `kuis`, bukan sebagai `materi.tipe = kuis`.
    // Jadi angka latihan kuis harus memakai $jumlahKuisMateri, sedangkan jumlah soal memakai $totalSoalKuis.
    $quizExerciseCount = (int) ($jumlahKuisMateri ?? 0);
    $totalQuizQuestions = (int) ($totalSoalKuis ?? $totalSoal ?? 0);

    $previewCount = (int) ($totalPreviewMateri ?? 0);
    $finalExamQuestionCount = (int) ($totalSoalAkhir ?? 0);
@endphp

@section('css')
    <style>
        :root {
            --primary: #1d4ed8;
            --primary-light: #3b82f6;
            --primary-soft: #dbeafe;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --success: #10b981;
            --warning: #f59e0b;
            --info: #4338ca;
            --radius: 0.75rem;
        }

        html {
            scroll-behavior: smooth;
        }

        .course-page {
            background: linear-gradient(180deg, var(--gray-50) 0%, #ffffff 100%);
            min-height: 100vh;
            padding: 1.25rem 0 1rem;
            color: var(--gray-900);
            overflow-x: hidden;
        }

        .course-main-wrapper {
            width: min(1180px, calc(100% - 32px));
            margin-inline: auto;
            margin-bottom: 1.25rem !important;
        }

        .course-hero-overlay {
            background: #ffffff !important;
            border-radius: var(--radius);
            border: 1px solid var(--gray-200) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 1rem;
            overflow: hidden;
        }

        @media (min-width: 992px) {
            .course-hero-overlay {
                padding: 1.25rem;
            }
        }

        .course-sidebar-card,
        .course-main-wrapper .card,
        .modal-content {
            background: #ffffff !important;
            border-radius: var(--radius) !important;
            border: 1px solid var(--gray-200) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
            overflow: hidden;
        }

        .course-page::before,
        .course-page::after,
        .course-hero-overlay::before,
        .course-hero-overlay::after,
        .course-sidebar-card::before,
        .course-sidebar-card::after,
        .course-main-wrapper .card::before,
        .course-main-wrapper .card::after {
            display: none !important;
            content: none !important;
        }

        .sticky-sidebar {
            position: sticky;
            top: 5rem;
        }

        .fs-hero {
            font-size: 1.4rem;
            line-height: 1.3;
            font-weight: 700;
            letter-spacing: 0;
            color: var(--gray-900) !important;
            max-width: 860px;
        }

        @media (min-width: 992px) {
            .fs-hero {
                font-size: 1.75rem;
            }
        }

        .course-badge-pill {
            border-radius: 999px;
            padding: 0.25rem 0.625rem;
            min-height: auto;
            font-size: 0.6875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            line-height: 1.25;
            border: 0 !important;
            box-shadow: none !important;
        }

        .badge-primary-custom {
            background: #dbeafe !important;
            color: #1e40af !important;
        }

        .badge-success-custom {
            background: #d1fae5 !important;
            color: #065f46 !important;
        }

        .badge-info-custom {
            background: #e0e7ff !important;
            color: #4338ca !important;
        }

        .badge-warning-custom {
            background: #fef3c7 !important;
            color: #92400e !important;
        }

        .nav-course-sections {
            display: flex;
            flex-wrap: wrap;
            gap: 0.25rem;
            margin-top: 0.75rem;
            padding-left: 0;
        }

        .nav-course-sections .nav-link {
            border-radius: 999px;
            padding: 0.3rem 0.75rem;
            min-height: auto;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--gray-600);
            background: var(--gray-50);
            border: 1px solid transparent !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            transition: all 0.15s ease;
        }

        .nav-course-sections .nav-link:hover {
            background: #dbeafe;
            border-color: #93c5fd !important;
            color: var(--primary);
        }

        .nav-course-sections .nav-link.active {
            background: var(--primary);
            border-color: var(--primary) !important;
            color: #ffffff;
            box-shadow: none;
        }

        .mentor-avatar {
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 0;
            background: #ffffff;
        }

        .neo-inner-box,
        .mentor-profile-box,
        .category-context {
            background: var(--gray-50) !important;
            border-radius: 0.5rem !important;
            border: 0 !important;
            box-shadow: none !important;
        }

        .category-context {
            margin-top: 0.75rem;
            padding: 0.75rem;
            border-left: 3px solid var(--primary) !important;
        }

        .course-page .border-top {
            border-top: 1px solid var(--gray-200) !important;
        }

        .course-page .border-bottom {
            border-bottom: 1px solid var(--gray-200) !important;
        }

        .course-page .btn-primary {
            border: 0 !important;
            border-radius: 0.5rem !important;
            background: var(--primary) !important;
            color: #ffffff !important;
            font-weight: 600;
            min-height: auto;
            padding: 0.65rem 1.1rem;
            box-shadow: none !important;
            transition: all 0.2s ease;
        }

        .course-page .btn-primary:hover {
            background: #1e40af !important;
            transform: none;
        }

        .btn-outline-custom {
            background: transparent !important;
            border: 1px solid var(--gray-200) !important;
            color: var(--gray-700);
            font-weight: 500;
            padding: 0.65rem 1.1rem;
            border-radius: 0.5rem !important;
            min-height: auto;
            box-shadow: none !important;
            transition: all 0.2s ease;
        }

        .btn-outline-custom:hover {
            background: var(--gray-50) !important;
            border-color: var(--primary) !important;
            color: var(--primary);
        }

        .course-sidebar-card .card-body {
            padding: 0.875rem 1rem !important;
        }

        .course-sidebar-card .ratio {
            border-bottom: 1px solid var(--gray-200);
            overflow: hidden;
            background: var(--gray-50);
        }

        .preview-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.5));
            z-index: 3;
        }

        .preview-play-btn {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.95);
            color: var(--primary);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .preview-play-btn:hover {
            transform: scale(1.06);
            background: #ffffff;
            color: var(--primary);
        }

        .preview-play-btn i {
            margin-left: 3px;
        }

        .stats-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 0;
            font-size: 0.8125rem;
            color: var(--gray-700);
            font-weight: 400;
        }

        .stats-item i {
            color: var(--primary);
            font-size: 1rem;
            width: auto;
            height: auto;
            flex: 0 0 auto;
            border-radius: 0;
            background: transparent;
            box-shadow: none;
        }

        .section-title,
        .course-main-wrapper .card-title {
            font-size: 0.9375rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0;
            letter-spacing: 0;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .card-header,
        .course-main-wrapper .card-header {
            padding: 0.75rem 0.9rem !important;
            background: var(--gray-50) !important;
            border-bottom: 1px solid var(--gray-200) !important;
        }

        .card-body,
        .course-main-wrapper .card-body {
            padding: 0.75rem 0.9rem !important;
            background: #ffffff !important;
        }

        .accordion {
            display: block;
        }

        .accordion-item {
            border: 0 !important;
            border-bottom: 1px solid var(--gray-200) !important;
            border-radius: 0 !important;
            background: #ffffff !important;
            overflow: hidden;
            box-shadow: none !important;
        }

        .accordion-item:last-child {
            border-bottom: 0 !important;
        }

        .accordion-button {
            cursor: pointer;
            padding: 0.65rem 0.9rem !important;
            background: #ffffff !important;
            border: none !important;
            width: 100%;
            text-align: left;
            transition: background 0.15s ease;
            color: var(--gray-900) !important;
            box-shadow: none !important;
        }

        .accordion-button:hover,
        .accordion-button:not(.collapsed) {
            background: var(--gray-50) !important;
            color: var(--gray-900) !important;
        }

        .accordion-body {
            padding: 0 !important;
            background: #ffffff !important;
            border-top: 1px solid var(--gray-200);
        }

        .materi-list {
            list-style: none;
            padding: 0;
            margin: 0;
            background: #ffffff;
        }

        .materi-item {
            font-size: 0.875rem;
            padding: 0.55rem 0.9rem;
            border-radius: 0;
            background: #ffffff;
            border: 0;
            border-bottom: 1px solid var(--gray-200);
            transition: background 0.15s ease;
            box-shadow: none !important;
        }

        .materi-item:last-child {
            border-bottom: 0;
        }

        .materi-item:hover {
            background: var(--gray-50);
            border-color: var(--gray-200);
        }

        .preview-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.2rem;
            border: 0 !important;
            border-radius: 999px;
            padding: 0.25rem 0.5rem;
            color: #065f46;
            font-size: 0.6875rem;
            font-weight: 500;
            background: #d1fae5;
            box-shadow: none !important;
        }

        .custom-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .custom-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            margin-bottom: 0.4rem;
            font-size: 0.875rem;
            line-height: 1.5;
            color: var(--gray-900);
            font-weight: 400;
        }

        .custom-list li:last-child {
            margin-bottom: 0;
        }

        .custom-list-icon {
            flex-shrink: 0;
            margin-top: 0.125rem;
            font-size: 0.875rem;
            width: auto;
            height: auto;
            border-radius: 0;
            background: transparent;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .empty-state {
            min-height: auto;
            border-radius: 0.5rem;
            background: var(--gray-50);
            border: 1px dashed var(--gray-200);
            padding: 1rem;
            text-align: center;
            color: var(--gray-600);
            font-size: 0.875rem;
            line-height: 1.55;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: none !important;
        }

        .empty-state i {
            color: var(--primary);
            font-size: 1.5rem;
            width: auto;
            height: auto;
            border-radius: 0;
            display: inline-block;
            margin-bottom: 0.5rem;
            background: transparent;
        }

        .bottom-layout {
            align-items: flex-start;
        }

        .bottom-left-stack,
        .bottom-right-stack {
            height: auto;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .bottom-left-stack .card,
        .bottom-right-stack .card {
            margin-bottom: 0 !important;
            height: auto;
        }

        .bottom-info-card .card-body {
            min-height: auto;
            display: block;
        }

        .bottom-info-card .custom-list,
        .bottom-info-card .empty-state {
            flex: initial;
        }

        .mentor-profile-box {
            min-height: auto;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
        }

        .mentor-profile-box .mentor-avatar {
            width: 42px;
            height: 42px;
            flex-basis: 42px;
        }

        .mentor-profile-content {
            min-width: 0;
        }

        /* Preview Overlay, tetap pakai alur/id JS file sekarang */
        .neo-preview-overlay {
            position: fixed !important;
            inset: 0 !important;
            z-index: 2147483646 !important;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem !important;
            background: rgba(17, 24, 39, .58);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            pointer-events: auto !important;
        }

        .neo-preview-overlay.is-open {
            display: flex !important;
        }

        body.neo-preview-open {
            overflow: hidden !important;
        }

        .neo-preview-dialog {
            position: relative;
            z-index: 2147483647 !important;
            width: min(960px, calc(100vw - 32px));
            max-height: calc(100dvh - 32px);
            margin: 0 auto !important;
            pointer-events: auto !important;
        }

        .neo-preview-card {
            width: 100%;
            max-height: calc(100dvh - 32px);
            overflow: hidden;
            border-radius: var(--radius);
            background: #ffffff;
            border: 1px solid var(--gray-200);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: 2147483647 !important;
        }

        .neo-preview-header {
            min-height: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 0.9rem 1rem;
            border-bottom: 1px solid var(--gray-200);
            background: #ffffff;
            position: relative;
            z-index: 2147483647 !important;
        }

        .neo-preview-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin: 0;
            line-height: 1.35;
            padding-right: 8px;
            max-width: calc(100% - 54px);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .neo-preview-body {
            padding: 0;
            max-height: calc(100dvh - 80px);
            overflow-y: auto;
            position: relative;
            z-index: 1;
            background: #ffffff;
        }

        .neo-preview-body .ratio {
            min-height: 220px;
            max-height: calc(100dvh - 80px);
            border-radius: 0;
            overflow: hidden;
            background: #111827;
        }

        .neo-preview-body iframe {
            width: 100%;
            height: 100%;
            position: relative;
            z-index: 1;
            pointer-events: auto;
            border: 0;
        }

        .neo-preview-close,
        .neo-preview-floating-close {
            border: 1px solid var(--gray-200) !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            color: var(--gray-900) !important;
            background: #ffffff !important;
            box-shadow: none !important;
            cursor: pointer !important;
            pointer-events: auto !important;
            touch-action: manipulation;
            transition: all 0.15s ease;
        }

        .neo-preview-close {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 0.5rem;
            position: relative;
            z-index: 2147483647 !important;
        }

        .neo-preview-floating-close {
            position: fixed !important;
            top: 12px !important;
            right: 14px !important;
            z-index: 2147483647 !important;
            width: 42px;
            height: 42px;
            border-radius: 999px;
            font-size: 1rem;
        }

        .neo-preview-close:hover,
        .neo-preview-floating-close:hover {
            color: var(--primary) !important;
            background: var(--gray-50) !important;
            border-color: var(--primary) !important;
            transform: none;
        }

        body .modal-backdrop,
        .modal-backdrop {
            display: none !important;
            opacity: 0 !important;
            visibility: hidden !important;
            pointer-events: none !important;
        }

        #overview,
        #curriculum,
        #instructor {
            scroll-margin-top: 90px;
        }

        @media (max-width: 991.98px) {
            .course-page {
                padding-top: 1rem;
            }

            .course-main-wrapper {
                width: calc(100% - 24px);
                margin-bottom: 1rem !important;
            }

            .sticky-sidebar {
                position: static;
                margin-top: 0.75rem;
            }

            .course-hero-overlay {
                padding: 0.875rem;
            }

            .card-body,
            .course-main-wrapper .card-body {
                padding: 0.875rem !important;
            }

            .card-header,
            .course-main-wrapper .card-header {
                padding: 0.875rem !important;
            }

            .fs-hero {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 767.98px) {
            .course-main-wrapper {
                width: calc(100% - 18px);
            }

            .materi-row {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 0.5rem;
            }

            .materi-duration {
                margin-left: 0 !important;
                white-space: normal !important;
            }

            .neo-preview-dialog {
                width: min(680px, calc(100vw - 20px));
            }

            .neo-preview-floating-close {
                width: 40px;
                height: 40px;
                top: 10px !important;
                right: 10px !important;
            }
        }

        @media (max-width: 575.98px) {
            .course-main-wrapper {
                width: calc(100% - 14px);
            }

            .course-hero-overlay {
                padding: 0.8rem;
            }

            .course-badge-pill {
                font-size: 0.68rem;
            }

            .stats-item,
            .custom-list li {
                font-size: .84rem;
            }
        }
    </style>
@endsection


@section('content')
    <div class="course-page">
        @include('errors.flash')

        <div class="course-main-wrapper">
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="course-hero-overlay mb-3">
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            @if ($kelas->kategori_nama)
                                <span class="badge-primary-custom course-badge-pill">
                                    <i class="bi bi-folder-fill"></i>{{ $kelas->kategori_nama }}
                                </span>
                            @endif

                            @if ($kelas->kategori_sub_nama)
                                <span class="badge-info-custom course-badge-pill">
                                    <i class="bi bi-layers-fill"></i>{{ $kelas->kategori_sub_nama }}
                                </span>
                            @endif

                            <span class="badge-warning-custom course-badge-pill">
                                <i class="bi bi-bar-chart-steps"></i>{{ $tingkatLabel }}
                            </span>

                            <span class="badge-success-custom course-badge-pill">
                                <i class="bi bi-translate"></i>{{ $bahasaLabel }}
                            </span>
                        </div>

                        <h1 class="fs-hero mb-2">
                            {{ $kelas->judul }}
                        </h1>

                        @if ($kelas->deskripsi_singkat)
                            <p class="mb-3" style="font-size: 0.9375rem; color: var(--gray-700); line-height: 1.6;">
                                {{ $kelas->deskripsi_singkat }}
                            </p>
                        @endif

                        <div class="d-flex flex-wrap align-items-center gap-3 mb-3" style="font-size: 0.8125rem;">
                            <div class="d-flex align-items-center gap-1">
                                @if ($kelas->rating > 0)
                                    <span class="badge-warning-custom course-badge-pill">
                                        <i class="bi bi-star-fill"></i>{{ number_format($kelas->rating, 1) }}
                                    </span>
                                    <span style="color: var(--gray-600);">
                                        ({{ number_format($kelas->total_review ?? 0, 0, ',', '.') }} ulasan)
                                    </span>
                                @else
                                    <span style="color: var(--gray-600);">Belum ada rating</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center gap-1" style="color: var(--gray-600);">
                                <i class="bi bi-people-fill"></i>
                                <span>{{ number_format($totalStudents, 0, ',', '.') }} peserta</span>
                            </div>

                            <div class="d-flex align-items-center gap-1" style="color: var(--gray-600);">
                                <i class="bi bi-clock-history"></i>
                                <span>{{ formatMinutes($totalDurationMinutes) }}</span>
                            </div>
                        </div>

                        @if ($kelas->pemilik_nama)
                            <div class="d-flex align-items-center p-2 neo-inner-box">
                                <img src="{{ $kelas->pemilik_foto
                                    ? route('view-file', ['folder' => 'profil', 'filename' => $kelas->pemilik_foto])
                                    : asset('assets/media/avatars/default.jpg') }}"
                                    alt="{{ $kelas->pemilik_nama }}" class="mentor-avatar me-2" loading="lazy"
                                    decoding="async">

                                <div>
                                    <div class="fw-semibold" style="font-size: 0.875rem; color: var(--gray-900);">
                                        {{ $kelas->pemilik_nama }}
                                    </div>

                                    <div style="font-size: 0.75rem; color: var(--gray-600);">
                                        {{ $kelas->pemilik_spesialisasi ?? 'Mentor' }}

                                        @if ($kelas->pemilik_rating_rata > 0)
                                            • <i class="bi bi-star-fill" style="color: var(--warning);"></i>
                                            {{ number_format($kelas->pemilik_rating_rata, 1) }}
                                        @endif

                                        @if ($kelas->pemilik_total_siswa > 0)
                                            • {{ number_format($kelas->pemilik_total_siswa, 0, ',', '.') }} siswa
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        <ul class="nav nav-pills nav-course-sections">
                            <li class="nav-item">
                                <a href="#overview" class="nav-link active">
                                    <i class="bi bi-journal-text"></i>Ringkasan
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#curriculum" class="nav-link">
                                    <i class="bi bi-list-ul"></i>Kurikulum
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#instructor" class="nav-link">
                                    <i class="bi bi-person-badge"></i>Mentor
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div id="overview" class="course-hero-overlay">
                        <h2 class="section-title mb-2">
                            Tentang Kursus Ini
                        </h2>

                        @if ($kelas->deskripsi_lengkap)
                            <div style="font-size: 0.875rem; color: var(--gray-700); line-height: 1.6;">
                                {!! $kelas->deskripsi_lengkap !!}
                            </div>
                        @else
                            <div style="font-size: 0.875rem; color: var(--gray-600);">
                                Deskripsi lengkap belum tersedia.
                            </div>
                        @endif

                        @if ($kelas->kategori_deskripsi || $kelas->kategori_sub_deskripsi)
                            <div class="category-context">
                                <h6 class="fw-bold mb-2" style="font-size: 0.875rem;">
                                    <i class="bi bi-info-circle me-1"></i>Konteks Kategori
                                </h6>

                                <div style="font-size: 0.8125rem; color: var(--gray-700);">
                                    @if ($kelas->kategori_deskripsi)
                                        <p class="mb-1">
                                            <strong>{{ $kelas->kategori_nama }}:</strong>
                                            {{ $kelas->kategori_deskripsi }}
                                        </p>
                                    @endif

                                    @if ($kelas->kategori_sub_deskripsi)
                                        <p class="mb-0">
                                            <strong>{{ $kelas->kategori_sub_nama }}:</strong>
                                            {{ $kelas->kategori_sub_deskripsi }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sticky-sidebar">
                        <div class="course-sidebar-card">
                            <div class="ratio ratio-16x9 position-relative">
                                <div class="w-100 h-100"
                                    style="background: url('{{ $bannerUrl }}') center/cover no-repeat;"></div>

                                @if ($videoIntro)
                                    <div class="preview-overlay">
                                        <button type="button" class="preview-play-btn js-preview-trigger"
                                            data-video="{{ $videoIntro }}">
                                            <i class="bi bi-play-fill fs-4"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body">
                                <div class="mb-3">
                                    <span class="fw-black" style="font-size: 1.65rem; color: var(--success);">
                                        Gratis
                                    </span>
                                </div>

                                <a href="{{ route('kursus.enroll', ['kelas' => $kelas->slug]) }}"
                                    class="btn btn-primary w-100 mb-2 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-play-circle"></i>
                                    <span>Mulai Kursus</span>
                                </a>

                                @if ($videoIntro)
                                    <button class="btn btn-outline-custom w-100 mb-3 js-preview-trigger" type="button"
                                        data-video="{{ $videoIntro }}">
                                        <i class="bi bi-play-btn me-1"></i>Lihat Preview
                                    </button>
                                @endif

                                <div class="border-top pt-3">
                                    <h6 class="fw-bold mb-2" style="font-size: 0.875rem;">
                                        Yang Kamu Dapatkan:
                                    </h6>

                                    <div class="stats-list">
                                        <div class="stats-item">
                                            <i class="bi bi-collection-play"></i>
                                            <span>{{ $totalMaterials }} materi total</span>
                                        </div>

                                        <div class="stats-item">
                                            <i class="bi bi-play-circle-fill"></i>
                                            <div>
                                                {{ $videoCount }} video pembelajaran

                                                @if ($durasiVideoMenit > 0)
                                                    <span style="color: var(--gray-600);">
                                                        ({{ formatMinutes($durasiVideoMenit) }})
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="stats-item">
                                            <i class="bi bi-file-text"></i>
                                            <span>{{ $textCount }} materi teks</span>
                                        </div>

                                        <div class="stats-item">
                                            <i class="bi bi-patch-question"></i>
                                            <div>
                                                {{ $quizExerciseCount }} latihan kuis

                                                @if ($totalQuizQuestions > 0)
                                                    <span style="color: var(--gray-600);">
                                                        ({{ $totalQuizQuestions }} soal)
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        @if ($previewCount > 0)
                                            <div class="stats-item">
                                                <i class="bi bi-eye"></i>
                                                <span>{{ $previewCount }} materi preview gratis</span>
                                            </div>
                                        @endif

                                        @if ($hasFinalExam ?? false)
                                            <div class="stats-item">
                                                <i class="bi bi-journal"></i>
                                                <div>
                                                    Ujian akhir

                                                    @if ($finalExamQuestionCount > 0)
                                                        <span style="color: var(--gray-600);">
                                                            ({{ $finalExamQuestionCount }} soal)
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        @if ($kelas->sertifikat)
                                            <div class="stats-item">
                                                <i class="bi bi-patch-check-fill"></i>
                                                <span>Sertifikat kelulusan</span>
                                            </div>
                                        @endif

                                        <div class="stats-item">
                                            <i class="bi bi-bar-chart"></i>
                                            <span>Nilai minimal: {{ $kelas->nilai_lulus }}/100</span>
                                        </div>
                                    </div>
                                </div>

                                @if ($tags->count())
                                    <div class="border-top pt-3 mt-3">
                                        <h6 class="fw-bold mb-2" style="font-size: 0.875rem;">
                                            Topik Terkait:
                                        </h6>

                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($tags as $tag)
                                                <span class="course-badge-pill badge-primary-custom">
                                                    #{{ $tag->nama ?? ($tag->slug ?? 'Tag') }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if ($mentorLain->count())
                            <div class="course-sidebar-card mt-3">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3" style="font-size: 0.9rem;">
                                        Tim Pengajar
                                    </h6>

                                    @foreach ($mentorLain as $mentor)
                                        <div class="d-flex align-items-center gap-2 pb-2 mb-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                                            <img src="{{ route('view-file', ['folder' => 'profil', 'filename' => $mentor->foto_profil]) }}"
                                                class="mentor-avatar" alt="{{ $mentor->nama }}" loading="lazy"
                                                decoding="async">

                                            <div>
                                                <div class="fw-bold" style="font-size: 0.875rem; color: var(--gray-900);">
                                                    {{ $mentor->nama }}

                                                    @if ($mentor->peran)
                                                        <span style="font-size: 0.75rem; color: var(--gray-600);">
                                                            ({{ $mentor->peran }})
                                                        </span>
                                                    @endif
                                                </div>

                                                <div style="font-size: 0.75rem; color: var(--gray-600);">
                                                    {{ $mentor->spesialisasi ?? 'Mentor' }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="course-main-wrapper">
            <div class="row g-3 bottom-layout">
                <div class="col-lg-8">
                    <div class="bottom-left-stack">
                        <div id="curriculum" class="card">
                            <div class="card-header">
                                <h3 class="section-title mb-1">
                                    <i class="bi bi-list-ul" style="color: var(--primary);"></i>
                                    Kurikulum
                                </h3>

                                <div class="mt-1" style="font-size: 0.75rem; color: var(--gray-600);">
                                    {{ $totalSections }} bagian • {{ $totalMaterials }} materi •
                                    {{ formatMinutes($totalDurationMinutes) }} total
                                </div>
                            </div>

                            <div class="card-body">
                                @if ($bagianList->count())
                                    <div class="accordion" id="curriculum-accordion">
                                        @foreach ($bagianList as $index => $bagian)
                                            @php
                                                $sectionId = 'section-' . $bagian->id_bagian_kelas;
                                                $materiSection = $materiList->get($bagian->id_bagian_kelas, collect());
                                                $sectionDurationSeconds = $materiSection->sum('durasi_detik');
                                                $sectionDuration = formatSeconds($sectionDurationSeconds);
                                                $materiCount = $materiSection->count();
                                            @endphp

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading-{{ $sectionId }}">
                                                    <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-{{ $sectionId }}"
                                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                                        aria-controls="collapse-{{ $sectionId }}">
                                                        <div class="d-flex flex-column w-100">
                                                            <div class="d-flex justify-content-between align-items-center gap-2 w-100 flex-wrap">
                                                                <span class="fw-bold" style="font-size: 0.9375rem; color: var(--gray-900);">
                                                                    Bagian {{ $bagian->urutan }}: {{ $bagian->judul }}
                                                                </span>

                                                                <span style="font-size: 0.75rem; color: var(--gray-600);">
                                                                    {{ $materiCount }} materi

                                                                    @if ($sectionDuration)
                                                                        • {{ $sectionDuration }}
                                                                    @endif
                                                                </span>
                                                            </div>

                                                            @if ($bagian->deskripsi)
                                                                <div class="mt-1" style="font-size: 0.8rem; color: var(--gray-600);">
                                                                    {!! $bagian->deskripsi !!}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </button>
                                                </h2>

                                                <div id="collapse-{{ $sectionId }}"
                                                    class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                                    aria-labelledby="heading-{{ $sectionId }}"
                                                    data-bs-parent="#curriculum-accordion">
                                                    <div class="accordion-body">
                                                        @if ($materiSection->count())
                                                            <ul class="materi-list">
                                                                @foreach ($materiSection as $materi)
                                                                    @php
                                                                        $labelTipe =
                                                                            [
                                                                                'video' => 'Video',
                                                                                'text' => 'Materi Teks',
                                                                                'kuis' => 'Kuis',
                                                                            ][$materi->tipe] ?? Str::title($materi->tipe);

                                                                        $iconTipe = match ($materi->tipe) {
                                                                            'video' => 'bi-play-circle',
                                                                            'text' => 'bi-file-text',
                                                                            'kuis' => 'bi-patch-question',
                                                                            default => 'bi-file-earmark',
                                                                        };

                                                                        $iconColor = match ($materi->tipe) {
                                                                            'video' => 'var(--primary)',
                                                                            'text' => 'var(--gray-600)',
                                                                            'kuis' => 'var(--warning)',
                                                                            default => 'var(--gray-600)',
                                                                        };

                                                                        $materiEmbed = $materi->url_video
                                                                            ? toEmbedUrl($materi->url_video)
                                                                            : null;

                                                                        $isPreviewVideo =
                                                                            $materi->preview &&
                                                                            $materi->tipe === 'video' &&
                                                                            $materiEmbed;

                                                                        $materiDuration = formatSeconds($materi->durasi_detik);
                                                                    @endphp

                                                                    <li class="materi-item">
                                                                        <div class="d-flex justify-content-between align-items-center materi-row">
                                                                            <div class="d-flex align-items-center gap-2 flex-grow-1">
                                                                                <i class="bi {{ $iconTipe }}"
                                                                                    style="color: {{ $iconColor }}; font-size: 1.15rem;"></i>

                                                                                <div class="flex-grow-1">
                                                                                    <div class="fw-semibold mb-0"
                                                                                        style="font-size: 0.875rem; color: var(--gray-900);">
                                                                                        {{ $materi->judul }}

                                                                                        @if ($isPreviewVideo)
                                                                                            <button type="button"
                                                                                                class="preview-badge ms-1 js-preview-trigger"
                                                                                                style="cursor: pointer;"
                                                                                                data-video="{{ $materiEmbed }}">
                                                                                                <i class="bi bi-play-fill"></i>Preview
                                                                                            </button>
                                                                                        @elseif($materi->preview)
                                                                                            <span class="preview-badge ms-1">
                                                                                                <i class="bi bi-unlock-fill"></i>Preview
                                                                                            </span>
                                                                                        @endif
                                                                                    </div>

                                                                                    <div style="font-size: 0.75rem; color: var(--gray-600);">
                                                                                        {{ $labelTipe }}

                                                                                        @if ($materi->url_lampiran)
                                                                                            • <i class="bi bi-paperclip"></i>
                                                                                            Lampiran
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            @if ($materiDuration)
                                                                                <div class="materi-duration ms-3"
                                                                                    style="font-size: 0.75rem; color: var(--gray-600); white-space: nowrap;">
                                                                                    <i class="bi bi-clock me-1"></i>{{ $materiDuration }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <div class="empty-state">
                                                                <i class="bi bi-inbox"></i>
                                                                <span>Kurikulum belum tersedia.</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <span>Kurikulum belum tersedia.</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div id="instructor" class="card">
                            <div class="card-header">
                                <h3 class="section-title">
                                    <i class="bi bi-person-badge" style="color: var(--primary);"></i>
                                    Mentor Kursus
                                </h3>
                            </div>

                            <div class="card-body">
                                @if ($kelas->pemilik_nama)
                                    <div class="mentor-profile-box">
                                        <img src="{{ $kelas->pemilik_foto
                                            ? route('view-file', ['folder' => 'profil', 'filename' => $kelas->pemilik_foto])
                                            : asset('assets/media/avatars/default.jpg') }}"
                                            alt="{{ $kelas->pemilik_nama }}" class="mentor-avatar" loading="lazy"
                                            decoding="async">

                                        <div class="mentor-profile-content">
                                            <div class="fw-bold mb-1" style="font-size: 1rem; color: var(--gray-900);">
                                                {{ $kelas->pemilik_nama }}
                                            </div>

                                            <div style="font-size: 0.8125rem; color: var(--gray-600); line-height: 1.55;">
                                                {{ $kelas->pemilik_spesialisasi ?? 'Mentor' }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="empty-state">
                                        <i class="bi bi-person-x"></i>
                                        <span>Data mentor belum tersedia.</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bottom-right-stack">
                        <div class="card bottom-info-card">
                            <div class="card-header">
                                <h3 class="section-title">
                                    <i class="bi bi-check2-circle" style="color: var(--success);"></i>
                                    Yang Akan Kamu Pelajari
                                </h3>
                            </div>

                            <div class="card-body">
                                @if ($tujuanList->count())
                                    <ul class="custom-list">
                                        @foreach ($tujuanList as $tujuan)
                                            <li>
                                                <i class="bi bi-check-circle-fill custom-list-icon"
                                                    style="color: var(--success);"></i>
                                                <span>{{ $tujuan->tujuan }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="empty-state">
                                        <i class="bi bi-check2-circle"></i>
                                        <span>Belum ada data tujuan pembelajaran.</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card bottom-info-card">
                            <div class="card-header">
                                <h3 class="section-title">
                                    <i class="bi bi-people" style="color: var(--primary);"></i>
                                    Untuk Siapa Kursus Ini
                                </h3>
                            </div>

                            <div class="card-body">
                                @if ($targetList->count())
                                    <ul class="custom-list">
                                        @foreach ($targetList as $target)
                                            <li>
                                                <i class="bi bi-arrow-right-circle-fill custom-list-icon"
                                                    style="color: var(--primary);"></i>
                                                <span>{{ $target->target }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="empty-state">
                                        <i class="bi bi-people"></i>
                                        <span>Belum ada data target peserta.</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card bottom-info-card">
                            <div class="card-header">
                                <h3 class="section-title">
                                    <i class="bi bi-exclamation-circle" style="color: var(--warning);"></i>
                                    Persyaratan
                                </h3>
                            </div>

                            <div class="card-body">
                                @if ($persyaratanList->count())
                                    <ul class="custom-list">
                                        @foreach ($persyaratanList as $req)
                                            <li>
                                                <i class="bi bi-record-circle custom-list-icon" style="color: var(--warning);"></i>
                                                <span>{{ $req->persyaratan }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="empty-state">
                                        <i class="bi bi-shield-check"></i>
                                        <span>Tidak ada persyaratan khusus.</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="neo-preview-overlay" id="neoPreviewOverlay" aria-hidden="true">
            <button type="button" class="neo-preview-floating-close" id="neoPreviewFloatingClose" aria-label="Tutup preview">
                <i class="bi bi-x-lg"></i>
            </button>

            <div class="neo-preview-dialog" role="dialog" aria-modal="true" aria-labelledby="neoPreviewTitle">
                <div class="neo-preview-card">
                    <div class="neo-preview-header">
                        <h5 class="neo-preview-title" id="neoPreviewTitle">
                            Preview: {{ $kelas->judul }}
                        </h5>

                        <button type="button" class="neo-preview-close" id="neoPreviewClose" aria-label="Tutup preview">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>

                    <div class="neo-preview-body">
                        <div class="ratio ratio-16x9">
                            <iframe id="previewModalIframe" src="" title="Preview Kursus" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const previewOverlay = document.getElementById('neoPreviewOverlay');
            const iframe = document.getElementById('previewModalIframe');
            const previewTriggers = document.querySelectorAll('.js-preview-trigger');
            const closeButtons = document.querySelectorAll('#neoPreviewClose, #neoPreviewFloatingClose');

            if (previewOverlay && previewOverlay.parentElement !== document.body) {
                document.body.appendChild(previewOverlay);
            }

            const removeBootstrapBackdrop = function() {
                document.querySelectorAll('.modal-backdrop').forEach(function(backdrop) {
                    backdrop.remove();
                });

                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('padding-right');
            };

            const buildAutoplayUrl = function(url) {
                if (!url) {
                    return '';
                }

                const separator = url.includes('?') ? '&' : '?';

                if (url.indexOf('youtube.com/embed') !== -1 && url.indexOf('autoplay=1') === -1) {
                    return url + separator + 'autoplay=1';
                }

                return url;
            };

            const openPreview = function(videoUrl) {
                if (!previewOverlay || !iframe || !videoUrl) {
                    return;
                }

                removeBootstrapBackdrop();

                iframe.src = buildAutoplayUrl(videoUrl);
                previewOverlay.style.display = 'flex';
                previewOverlay.classList.add('is-open');
                previewOverlay.setAttribute('aria-hidden', 'false');
                document.body.classList.add('neo-preview-open');
            };

            const closePreview = function() {
                if (!previewOverlay || !iframe) {
                    return;
                }

                iframe.src = '';
                previewOverlay.classList.remove('is-open');
                previewOverlay.style.display = 'none';
                previewOverlay.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('neo-preview-open');
                removeBootstrapBackdrop();
            };

            previewTriggers.forEach(function(trigger) {
                trigger.addEventListener('click', function(event) {
                    event.preventDefault();
                    event.stopPropagation();

                    openPreview(this.getAttribute('data-video'));
                });
            });

            closeButtons.forEach(function(button) {
                ['pointerdown', 'touchstart', 'click'].forEach(function(eventName) {
                    button.addEventListener(eventName, function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                        closePreview();
                    }, { passive: false });
                });
            });

            if (previewOverlay) {
                previewOverlay.addEventListener('click', function(event) {
                    if (event.target === previewOverlay) {
                        closePreview();
                    }
                });
            }

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closePreview();
                }
            });

            removeBootstrapBackdrop();

            const navLinks = document.querySelectorAll('.nav-course-sections .nav-link');
            const sections = document.querySelectorAll('#overview, #curriculum, #instructor');

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (!targetElement) {
                        return;
                    }

                    navLinks.forEach(item => item.classList.remove('active'));
                    this.classList.add('active');

                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
            });

            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (!entry.isIntersecting) {
                            return;
                        }

                        const id = entry.target.getAttribute('id');

                        navLinks.forEach(link => {
                            link.classList.remove('active');

                            if (link.getAttribute('href') === `#${id}`) {
                                link.classList.add('active');
                            }
                        });
                    });
                }, {
                    root: null,
                    rootMargin: '-90px 0px -78% 0px',
                    threshold: 0
                });

                sections.forEach(section => observer.observe(section));
            }
        });
    </script>
@endsection