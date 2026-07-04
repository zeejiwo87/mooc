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
            --neo-bg: #e7e5e4;
            --neo-surface: #e7e5e4;
            --neo-surface-soft: #ebe9e7;
            --neo-primary: #009ef7;
            --neo-primary-dark: #0085d1;
            --neo-success: #10b981;
            --neo-warning: #f59e0b;
            --neo-text: #1f2937;
            --neo-muted: #6b7280;
            --neo-light: rgba(255, 255, 255, 0.86);
            --neo-dark: rgba(120, 113, 108, 0.20);
            --neo-dark-soft: rgba(120, 113, 108, 0.13);
            --neo-inset-dark: rgba(120, 113, 108, 0.15);
            --neo-inset-light: rgba(255, 255, 255, 0.72);
            --neo-radius-lg: 30px;
            --neo-radius-md: 22px;
            --neo-radius-sm: 16px;

            --primary: var(--neo-primary);
            --primary-light: #67c7ff;
            --gray-50: var(--neo-bg);
            --gray-100: var(--neo-bg);
            --gray-200: rgba(120, 113, 108, 0.18);
            --gray-600: var(--neo-muted);
            --gray-700: #4b5563;
            --gray-800: #374151;
            --gray-900: var(--neo-text);
            --success: var(--neo-success);
            --warning: var(--neo-warning);
            --radius: var(--neo-radius-md);
        }

        html {
            scroll-behavior: smooth;
        }

        .course-page {
            min-height: 100vh;
            padding: 28px 0 34px;
            color: var(--neo-text);
            background: var(--neo-bg);
            position: relative;
            overflow-x: hidden;
        }

        .course-main-wrapper {
            width: min(1180px, calc(100% - 32px));
            margin-inline: auto;
            margin-bottom: 22px !important;
        }

        .course-hero-overlay,
        .course-sidebar-card,
        .course-main-wrapper .card,
        .modal-content {
            border: 0 !important;
            border-radius: var(--neo-radius-lg);
            background: var(--neo-bg);
            box-shadow:
                10px 10px 24px var(--neo-dark),
                -10px -10px 24px var(--neo-light);
            overflow: hidden;
            position: relative;
        }

        .course-hero-overlay::before,
        .course-sidebar-card::before,
        .course-main-wrapper .card::before {
            display: none;
        }

        .course-hero-overlay > *,
        .course-sidebar-card > *,
        .course-main-wrapper .card > * {
            position: relative;
            z-index: 1;
        }

        .course-hero-overlay {
            padding: 30px;
        }

        .sticky-sidebar {
            position: sticky;
            top: 88px;
        }

        .course-badge-pill {
            min-height: 30px;
            border-radius: 999px;
            padding: 0 12px;
            font-size: 0.74rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            line-height: 1;
            border: 0 !important;
            background: var(--neo-bg) !important;
            box-shadow:
                inset 3px 3px 7px var(--neo-inset-dark),
                inset -3px -3px 7px var(--neo-inset-light);
        }

        .badge-primary-custom {
            color: var(--neo-primary) !important;
        }

        .badge-success-custom {
            color: var(--neo-success) !important;
        }

        .badge-info-custom {
            color: #6366f1 !important;
        }

        .badge-warning-custom {
            color: var(--neo-warning) !important;
        }

        .fs-hero {
            font-size: clamp(1.55rem, 2.45vw, 2.38rem);
            line-height: 1.14;
            font-weight: 900;
            letter-spacing: -.04em;
            color: var(--neo-text) !important;
            max-width: 860px;
        }

        .nav-course-sections {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .nav-course-sections .nav-item,
        .nav-course-sections .nav-link {
            width: 100%;
        }

        .nav-course-sections .nav-link {
            min-height: 44px;
            border-radius: 999px;
            padding: 0 16px;
            font-size: 0.84rem;
            font-weight: 850;
            color: var(--neo-muted);
            background: var(--neo-bg);
            border: 0 !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            box-shadow:
                6px 6px 13px var(--neo-dark-soft),
                -6px -6px 13px var(--neo-light);
            transition: .22s ease;
        }

        .nav-course-sections .nav-link:hover {
            color: var(--neo-primary);
            transform: translateY(-1px);
        }

        .nav-course-sections .nav-link.active {
            color: var(--neo-primary);
            background: var(--neo-bg);
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
        }

        .mentor-avatar {
            width: 58px;
            height: 58px;
            flex: 0 0 58px;
            border-radius: 999px;
            object-fit: cover;
            padding: 5px;
            background: var(--neo-bg);
            border: 0;
            box-shadow:
                6px 6px 13px var(--neo-dark-soft),
                -6px -6px 13px var(--neo-light);
        }

        .neo-inner-box {
            border-radius: var(--neo-radius-md);
            background: var(--neo-bg);
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
        }

        .course-page .border-top {
            border-top: 1px solid rgba(120, 113, 108, .16) !important;
        }

        .course-page .border-bottom {
            border-bottom: 1px solid rgba(120, 113, 108, .16) !important;
        }

        .course-page .btn-primary {
            min-height: 46px;
            border: 0 !important;
            border-radius: 16px !important;
            color: #ffffff !important;
            font-weight: 900;
            letter-spacing: -.01em;
            background: linear-gradient(135deg, var(--neo-primary), var(--neo-primary-dark)) !important;
            box-shadow:
                8px 8px 18px rgba(120, 113, 108, .20),
                -8px -8px 18px rgba(255, 255, 255, .78),
                inset 1px 1px 0 rgba(255, 255, 255, .42);
            transition: .22s ease;
        }

        .course-page .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow:
                10px 10px 22px rgba(120, 113, 108, .24),
                -10px -10px 22px rgba(255, 255, 255, .82);
        }

        .btn-outline-custom {
            min-height: 44px;
            border: 0 !important;
            border-radius: 16px !important;
            color: #57534e;
            font-weight: 900;
            background: var(--neo-bg) !important;
            box-shadow:
                6px 6px 13px var(--neo-dark-soft),
                -6px -6px 13px var(--neo-light);
            transition: .22s ease;
        }

        .btn-outline-custom:hover {
            color: var(--neo-primary);
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
        }

        .course-sidebar-card .ratio {
            border-radius: var(--neo-radius-lg) var(--neo-radius-lg) 24px 24px;
            overflow: hidden;
        }

        .course-sidebar-card .ratio::after {
            content: "";
            position: absolute;
            inset: 12px;
            border-radius: 22px;
            pointer-events: none;
            box-shadow:
                inset 5px 5px 12px rgba(0, 0, 0, .16),
                inset -5px -5px 12px rgba(255, 255, 255, .28);
            z-index: 2;
        }

        .preview-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, rgba(31, 41, 55, .08), rgba(31, 41, 55, .48));
            z-index: 3;
        }

        .preview-play-btn {
            width: 64px;
            height: 64px;
            border-radius: 999px;
            border: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--neo-primary);
            background: rgba(231, 229, 228, .96);
            box-shadow:
                8px 8px 18px rgba(31, 41, 55, .28),
                -8px -8px 18px rgba(255, 255, 255, .42),
                inset 1px 1px 0 rgba(255, 255, 255, .8);
            transition: .22s ease;
        }

        .preview-play-btn:hover {
            transform: scale(1.06);
            color: var(--neo-primary-dark);
            box-shadow:
                inset 4px 4px 10px rgba(120, 113, 108, .18),
                inset -4px -4px 10px rgba(255, 255, 255, .78);
        }

        .preview-play-btn i {
            margin-left: 4px;
        }

        .stats-item {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 8px 0;
            font-size: .88rem;
            color: var(--neo-text);
            font-weight: 650;
        }

        .stats-item i,
        .custom-list-icon {
            width: 32px;
            height: 32px;
            flex: 0 0 32px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--neo-bg);
            box-shadow:
                inset 3px 3px 7px var(--neo-inset-dark),
                inset -3px -3px 7px var(--neo-inset-light);
        }

        .stats-item i {
            color: var(--neo-primary);
        }

        .section-title {
            font-size: 1.05rem;
            font-weight: 900;
            letter-spacing: -.02em;
            color: var(--neo-text);
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 0;
        }

        .card-header {
            padding: 20px 24px !important;
            background: transparent !important;
            border-bottom: 1px solid rgba(120, 113, 108, .16) !important;
        }

        .card-body {
            padding: 24px !important;
            background: transparent !important;
        }

        .category-context {
            margin-top: 16px;
            padding: 15px;
            border-radius: var(--neo-radius-sm);
            background: var(--neo-bg);
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
        }

        .accordion {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .accordion-item {
            border: 0 !important;
            border-radius: var(--neo-radius-md) !important;
            background: var(--neo-bg) !important;
            overflow: hidden;
            box-shadow:
                inset 4px 4px 10px rgba(120, 113, 108, .12),
                inset -4px -4px 10px rgba(255, 255, 255, .70);
        }

        .accordion-button {
            padding: 17px 19px !important;
            border: 0 !important;
            background: transparent !important;
            color: var(--neo-text) !important;
            box-shadow: none !important;
        }

        .accordion-button:not(.collapsed) {
            color: var(--neo-primary) !important;
        }

        .accordion-body {
            padding: 0 14px 14px !important;
            background: transparent !important;
        }

        .materi-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .materi-item {
            border-radius: 17px;
            padding: 14px 16px;
            background: var(--neo-bg);
            box-shadow:
                6px 6px 13px var(--neo-dark-soft),
                -6px -6px 13px var(--neo-light);
            transition: .2s ease;
        }

        .materi-item:hover {
            transform: translateY(-1px);
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
        }

        .preview-badge {
            border: 0;
            border-radius: 999px;
            padding: 5px 9px;
            color: var(--neo-success);
            font-size: .68rem;
            font-weight: 900;
            background: var(--neo-bg);
            box-shadow:
                inset 2px 2px 5px rgba(120, 113, 108, .13),
                inset -2px -2px 5px rgba(255, 255, 255, .74);
        }

        .custom-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .custom-list li {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            font-size: .88rem;
            line-height: 1.55;
            color: var(--neo-text);
            font-weight: 620;
        }

        .custom-list li + li {
            margin-top: 12px;
        }

        .empty-state {
            min-height: 146px;
            border-radius: var(--neo-radius-md);
            background: var(--neo-bg);
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 22px 16px;
            text-align: center;
            color: var(--gray-600);
            font-size: 0.875rem;
            line-height: 1.55;
        }

        .empty-state i {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            color: var(--neo-primary);
            background: var(--neo-bg);
            box-shadow:
                5px 5px 12px var(--neo-dark-soft),
                -5px -5px 12px var(--neo-light);
            font-size: 1.25rem;
        }

        .bottom-layout {
            align-items: stretch;
        }

        .bottom-left-stack,
        .bottom-right-stack {
            height: 100%;
            display: grid;
            gap: 18px;
        }

        .bottom-left-stack {
            grid-template-rows: auto auto;
        }

        .bottom-right-stack {
            grid-template-rows: repeat(3, minmax(0, 1fr));
        }

        .bottom-left-stack .card,
        .bottom-right-stack .card {
            margin-bottom: 0 !important;
            height: 100%;
        }

        .bottom-info-card .card-body {
            min-height: 178px;
            display: flex;
            flex-direction: column;
        }

        .bottom-info-card .custom-list,
        .bottom-info-card .empty-state {
            flex: 1;
        }

        .mentor-profile-box {
            min-height: 124px;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px;
            border-radius: var(--neo-radius-md);
            background: var(--neo-bg);
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
        }

        .mentor-profile-box .mentor-avatar {
            width: 62px;
            height: 62px;
            flex-basis: 62px;
        }

        .mentor-profile-content {
            min-width: 0;
        }

        .modal-content {
            background: var(--neo-bg);
            box-shadow:
                14px 14px 32px rgba(79, 70, 62, .28),
                -14px -14px 32px rgba(255, 255, 255, .82);
        }

        .modal-header {
            border-bottom: 1px solid rgba(120, 113, 108, .16) !important;
            padding: 18px 22px;
        }

        .modal-body {
            padding: 14px;
        }

        .modal-body .ratio {
            border-radius: 22px;
            overflow: hidden;
        }


        .neo-preview-overlay {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            z-index: 2147483646 !important;
            display: none;
            align-items: flex-start;
            justify-content: center;
            padding: 14px 16px !important;
            background: rgba(17, 24, 39, .58);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
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
            width: min(740px, calc(100vw - 32px));
            max-height: calc(100dvh - 28px);
            margin: 0 auto !important;
            pointer-events: auto !important;
        }

        .neo-preview-card {
            width: 100%;
            max-height: calc(100dvh - 28px);
            overflow: hidden;
            border-radius: 22px;
            background: var(--neo-bg);
            box-shadow:
                18px 18px 42px rgba(0, 0, 0, .38),
                -8px -8px 20px rgba(255, 255, 255, .16);
            position: relative;
            z-index: 2147483647 !important;
        }

        .neo-preview-header {
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 14px;
            border-bottom: 1px solid rgba(120, 113, 108, .16);
            background: var(--neo-bg);
            position: relative;
            z-index: 2147483647 !important;
        }

        .neo-preview-title {
            font-size: .92rem;
            font-weight: 900;
            color: var(--neo-text);
            margin: 0;
            line-height: 1.35;
            padding-right: 8px;
            max-width: calc(100% - 54px);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .neo-preview-body {
            padding: 10px;
            max-height: calc(100dvh - 78px);
            overflow-y: auto;
            position: relative;
            z-index: 1;
        }

        .neo-preview-body .ratio {
            min-height: 220px;
            max-height: calc(100dvh - 98px);
            border-radius: 18px;
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
            border: 0 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            color: var(--neo-text) !important;
            background: var(--neo-bg) !important;
            box-shadow:
                6px 6px 14px rgba(120, 113, 108, .22),
                -6px -6px 14px rgba(255, 255, 255, .72) !important;
            cursor: pointer !important;
            pointer-events: auto !important;
            touch-action: manipulation;
        }

        .neo-preview-close {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            border-radius: 13px;
            position: relative;
            z-index: 2147483647 !important;
        }

        .neo-preview-floating-close {
            position: fixed !important;
            top: 12px !important;
            right: 14px !important;
            z-index: 2147483647 !important;
            width: 46px;
            height: 46px;
            border-radius: 999px;
            font-size: 1.05rem;
        }

        .neo-preview-close:hover,
        .neo-preview-floating-close:hover {
            color: var(--neo-primary) !important;
            transform: translateY(-1px);
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
            scroll-margin-top: 100px;
        }

        @media (min-width: 992px) {
            .course-main-wrapper > .row {
                align-items: flex-start;
            }

            .course-main-wrapper .col-lg-8 {
                width: 68%;
            }

            .course-main-wrapper .col-lg-4 {
                width: 32%;
            }

            .course-hero-overlay {
                min-height: auto;
            }

            #overview.course-hero-overlay {
                padding: 26px 30px;
            }

            .course-sidebar-card .card-body {
                padding: 22px !important;
            }

            .card-header {
                padding: 20px 26px !important;
            }

            .card-body {
                padding: 24px 26px !important;
            }

            .bottom-layout {
                align-items: stretch;
            }

            .bottom-layout > .col-lg-8,
            .bottom-layout > .col-lg-4 {
                display: flex;
                flex-direction: column;
            }

            .bottom-left-stack,
            .bottom-right-stack {
                flex: 1;
                height: 100%;
            }

            .bottom-left-stack {
                grid-template-rows: minmax(430px, auto) minmax(220px, auto);
            }

            .bottom-right-stack {
                grid-template-rows: repeat(3, minmax(202px, 1fr));
            }

            .bottom-info-card .card-header {
                min-height: 66px;
                display: flex;
                align-items: center;
            }

            .bottom-info-card .card-body {
                min-height: 136px;
            }

            #curriculum .card-body {
                min-height: 358px;
                display: flex;
                flex-direction: column;
            }

            #curriculum .empty-state {
                min-height: 300px;
                flex: 1;
            }

            #instructor .card-body {
                min-height: 280px;
                display: flex;
                align-items: stretch;
            }

            #instructor .mentor-profile-box,
            #instructor .empty-state {
                flex: 1;
            }

            .mentor-profile-box {
                min-height: 252px;
            }
        }

        @media (max-width: 991.98px) {
            .course-page {
                padding-top: 20px;
            }

            .course-main-wrapper {
                width: calc(100% - 24px);
            }

            .sticky-sidebar {
                position: static;
            }

            .course-hero-overlay,
            .course-sidebar-card,
            .course-main-wrapper .card {
                border-radius: 26px;
                box-shadow:
                    8px 8px 20px rgba(120, 113, 108, .18),
                    -8px -8px 20px rgba(255, 255, 255, .82);
            }

            .course-hero-overlay {
                padding: 22px;
            }

            .card-body {
                padding: 20px !important;
            }

            .card-header {
                padding: 18px 20px !important;
            }

            .mentor-avatar {
                width: 50px;
                height: 50px;
                flex-basis: 50px;
            }

            .bottom-left-stack,
            .bottom-right-stack {
                display: flex;
                flex-direction: column;
                gap: 16px;
            }

            .bottom-info-card .card-body {
                min-height: auto;
            }

            .empty-state {
                min-height: 126px;
            }
        }

        @media (max-width: 767.98px) {
            .course-page {
                padding-top: 14px;
                padding-bottom: 22px;
            }

            .course-main-wrapper {
                width: calc(100% - 18px);
            }

            .course-hero-overlay,
            .course-sidebar-card,
            .course-main-wrapper .card {
                border-radius: 22px;
            }

            .course-hero-overlay {
                padding: 18px;
            }

            .nav-course-sections {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
            }

            .nav-course-sections .nav-item:nth-child(3) {
                grid-column: 1 / -1;
            }

            .nav-course-sections .nav-link {
                min-height: 42px;
                padding-inline: 10px;
                font-size: .8rem;
            }

            .materi-row {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 9px;
            }

            .materi-duration {
                margin-left: 0 !important;
                white-space: normal !important;
            }

            .mentor-profile-box {
                min-height: auto;
            }
        }


        @media (max-width: 767.98px) {
            .neo-preview-overlay {
                padding: 12px 10px !important;
            }

            .neo-preview-dialog {
                width: min(680px, calc(100vw - 20px));
                max-height: calc(100dvh - 24px);
            }

            .neo-preview-card {
                max-height: calc(100dvh - 24px);
                border-radius: 20px;
            }

            .neo-preview-header {
                min-height: 48px;
                padding: 11px 12px;
            }

            .neo-preview-title {
                font-size: .86rem;
            }

            .neo-preview-body {
                max-height: calc(100dvh - 72px);
                padding: 8px;
            }

            .neo-preview-body .ratio {
                min-height: 190px;
                border-radius: 16px;
            }

            .neo-preview-floating-close {
                top: 10px !important;
                right: 10px !important;
                width: 42px;
                height: 42px;
            }
        }

        @media (max-width: 575.98px) {
            .course-main-wrapper {
                width: calc(100% - 14px);
            }

            .course-hero-overlay {
                padding: 16px;
            }

            .card-body {
                padding: 16px !important;
            }

            .card-header {
                padding: 16px !important;
            }

            .fs-hero {
                font-size: 1.42rem;
            }

            .course-badge-pill {
                min-height: 28px;
                padding-inline: 10px;
                font-size: .7rem;
            }

            .course-page .btn-primary,
            .btn-outline-custom {
                min-height: 43px;
                border-radius: 14px !important;
            }

            .stats-item,
            .custom-list li {
                font-size: .84rem;
            }

            .modal-dialog {
                margin: .65rem;
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
                                {!! nl2br(e($kelas->deskripsi_lengkap)) !!}
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
                                                                <span class="mt-1" style="font-size: 0.8rem; color: var(--gray-600);">
                                                                    {{ $bagian->deskripsi }}
                                                                </span>
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