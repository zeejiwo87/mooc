@extends('content.layouts')

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

        .neo-kursus-page {
            position: relative;
            padding-top: 18px;
            padding-bottom: 48px;
        }

        .neo-card,
        .neo-filter-card,
        .neo-list-card,
        .neo-help-card,
        .neo-page-hero {
            border: 0 !important;
            border-radius: 26px !important;
            background: var(--neo-surface) !important;
            box-shadow:
                10px 10px 24px var(--neo-dark),
                -10px -10px 24px var(--neo-light) !important;
            overflow: hidden;
        }

        .neo-page-hero {
            position: relative;
            background:
                radial-gradient(circle at 0% 0%, rgba(255, 255, 255, 0.72), transparent 42%),
                radial-gradient(circle at 100% 100%, rgba(0, 158, 247, 0.13), transparent 48%),
                var(--neo-surface) !important;
        }

        .neo-page-hero::before {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            right: -120px;
            top: -120px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0, 158, 247, 0.16), transparent 66%);
            pointer-events: none;
        }

        .neo-page-hero .card-body {
            position: relative;
            z-index: 1;
        }

        .neo-filter-sticky {
            position: sticky;
            top: 112px;
            z-index: 10;
        }

        .neo-filter-card .card-header,
        .neo-list-card .card-header {
            border-bottom: 1px solid rgba(120, 113, 108, 0.14);
            background: transparent;
        }

        .neo-filter-card .card-title,
        .neo-list-card .card-title {
            color: var(--neo-text);
            font-weight: 700;
        }

        .neo-reset-btn,
        .btn.btn-light-primary,
        .btn.btn-light,
        .btn.btn-sm.btn-light {
            border: 0 !important;
            background: var(--neo-surface) !important;
            color: var(--neo-primary) !important;
            border-radius: 14px !important;
            box-shadow:
                4px 4px 10px var(--neo-dark-soft),
                -4px -4px 10px var(--neo-light);
            transition: 0.2s ease;
        }

        .neo-reset-btn:hover,
        .btn.btn-light-primary:hover,
        .btn.btn-light:hover,
        .btn.btn-sm.btn-light:hover {
            color: var(--neo-primary-dark) !important;
            transform: translateY(-1px);
        }

        .btn.btn-primary {
            background: var(--neo-primary) !important;
            border: 0 !important;
            color: #ffffff !important;
            border-radius: 14px !important;
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

        .form-control,
        .form-select {
            border: 0 !important;
            border-radius: 15px !important;
            background: var(--neo-surface) !important;
            color: var(--neo-text) !important;
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light) !important;
        }

        .form-control:focus,
        .form-select:focus {
            border: 0 !important;
            background: var(--neo-surface) !important;
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light),
                0 0 0 0.2rem rgba(0, 158, 247, 0.12) !important;
        }

        .input-group-text {
            border: 0 !important;
            background: transparent !important;
        }

        .neo-search-box {
            border-radius: 18px;
            background: var(--neo-surface);
            box-shadow:
                inset 5px 5px 12px var(--neo-inset-dark),
                inset -5px -5px 12px var(--neo-inset-light);
            padding: 0.35rem 0.5rem;
        }

        .neo-search-box .form-control {
            box-shadow: none !important;
            background: transparent !important;
        }

        .btn-check + .btn {
            border: 0 !important;
            border-radius: 15px !important;
            background: var(--neo-surface) !important;
            color: var(--neo-text) !important;
            box-shadow:
                4px 4px 10px var(--neo-dark-soft),
                -4px -4px 10px var(--neo-light);
            transition: 0.2s ease;
        }

        .btn-check + .btn:hover {
            color: var(--neo-primary) !important;
            transform: translateY(-1px);
        }

        .btn-check:checked + .btn,
        .btn-check + .btn.active,
        .btn-check + .btn.btn-active-primary,
        .btn-check + .btn.btn-active-light-primary {
            color: var(--neo-primary) !important;
            background: var(--neo-surface) !important;
            box-shadow:
                inset 4px 4px 9px var(--neo-inset-dark),
                inset -4px -4px 9px var(--neo-inset-light) !important;
        }

        .badge.badge-light-primary {
            border-radius: 999px;
            background: var(--neo-surface) !important;
            color: var(--neo-primary) !important;
            box-shadow:
                3px 3px 8px var(--neo-dark-soft),
                -3px -3px 8px var(--neo-light);
        }

        .neo-help-card {
            position: relative;
            background:
                radial-gradient(circle at 0% 0%, rgba(255, 255, 255, 0.58), transparent 44%),
                radial-gradient(circle at 100% 100%, rgba(0, 158, 247, 0.14), transparent 52%),
                var(--neo-surface) !important;
        }

        .neo-help-icon {
            width: 60px;
            height: 60px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--neo-surface);
            color: var(--neo-primary);
            box-shadow:
                6px 6px 14px var(--neo-dark-soft),
                -6px -6px 14px var(--neo-light);
        }

        .neo-stat-pill {
            border-radius: 999px;
            background: var(--neo-surface);
            color: var(--neo-text);
            box-shadow:
                5px 5px 12px var(--neo-dark-soft),
                -5px -5px 12px var(--neo-light);
        }

        .course-card,
        .card-fade-in {
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        }

        .course-card:hover,
        .card-fade-in:hover {
            transform: translateY(-4px);
        }

        #courses-container .card,
        #courses-container .course-card {
            border: 0 !important;
            border-radius: 24px !important;
            background: var(--neo-surface) !important;
            box-shadow:
                8px 8px 18px var(--neo-dark-soft),
                -8px -8px 18px var(--neo-light) !important;
            overflow: hidden;
        }

        #courses-container .card:hover,
        #courses-container .course-card:hover {
            box-shadow:
                11px 11px 24px var(--neo-dark),
                -11px -11px 24px var(--neo-light) !important;
        }

        #courses-container .card-body {
            background: transparent !important;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }

        #courses-loading {
            min-height: 180px;
            border-radius: 22px;
            background: var(--neo-surface);
            box-shadow:
                inset 5px 5px 12px var(--neo-inset-dark),
                inset -5px -5px 12px var(--neo-inset-light);
        }

        .spinner-border {
            color: var(--neo-primary);
        }

        #pagination-container .pagination {
            gap: 8px;
            flex-wrap: wrap;
        }

        #pagination-container .page-link {
            border: 0 !important;
            border-radius: 13px !important;
            background: var(--neo-surface) !important;
            color: var(--neo-text) !important;
            box-shadow:
                4px 4px 10px var(--neo-dark-soft),
                -4px -4px 10px var(--neo-light);
        }

        #pagination-container .page-item.active .page-link {
            color: #ffffff !important;
            background: var(--neo-primary) !important;
            box-shadow:
                5px 5px 12px rgba(120, 113, 108, 0.24),
                -5px -5px 12px rgba(255, 255, 255, 0.68);
        }

        #pagination-container .page-item.disabled .page-link {
            opacity: 0.55;
        }

        .text-primary,
        .text-info,
        .text-success {
            color: var(--neo-primary) !important;
        }

        .neo-course-card {
            border: 0 !important;
            border-radius: 26px !important;
            background: var(--neo-surface) !important;
            box-shadow:
                8px 8px 18px var(--neo-dark-soft),
                -8px -8px 18px var(--neo-light) !important;
            overflow: hidden;
            transition: transform .22s ease, box-shadow .22s ease;
        }

        .neo-course-card:hover {
            transform: translateY(-5px);
            box-shadow:
                12px 12px 26px var(--neo-dark),
                -12px -12px 26px var(--neo-light) !important;
        }

        .neo-course-cover {
            border-radius: 22px;
            overflow: hidden;
        }

        .neo-course-cover-overlay {
            position: absolute;
            inset: 0;
            z-index: 1;
            background:
                linear-gradient(180deg, rgba(17, 24, 39, 0.18) 0%, rgba(17, 24, 39, 0.05) 42%, rgba(17, 24, 39, 0.58) 100%),
                radial-gradient(circle at 50% 50%, transparent 0%, rgba(0, 0, 0, 0.24) 100%);
            pointer-events: none;
        }

        .neo-course-badge,
        .neo-level-badge {
            border: 0 !important;
            border-radius: 999px !important;
            background: rgba(231, 229, 228, 0.92) !important;
            color: var(--neo-primary) !important;
            font-weight: 800;
            box-shadow:
                4px 4px 10px rgba(17, 24, 39, 0.22),
                -4px -4px 10px rgba(255, 255, 255, 0.20);
            backdrop-filter: blur(12px);
        }

        .neo-course-badge-soft {
            color: var(--neo-text) !important;
        }

        .course-preview-trigger .btn.btn-icon,
        .neo-play-btn {
            width: 54px;
            height: 54px;
            border: 0 !important;
            border-radius: 50% !important;
            background: rgba(231, 229, 228, 0.95) !important;
            color: var(--neo-primary) !important;
            box-shadow:
                8px 8px 18px rgba(0, 0, 0, 0.30),
                -5px -5px 12px rgba(255, 255, 255, 0.22) !important;
            backdrop-filter: blur(14px);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: .22s ease;
        }

        .course-preview-trigger .btn.btn-icon i,
        .neo-play-btn i {
            font-size: 2.15rem;
            line-height: 1;
            transform: translateX(2px);
        }

        .course-preview-trigger:hover .btn.btn-icon,
        .neo-play-btn:hover {
            transform: scale(1.08);
            color: #ffffff !important;
            background: var(--neo-primary) !important;
        }

        .neo-mini-info {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 30px;
            padding: 6px 10px;
            border-radius: 999px;
            background: var(--neo-surface);
            color: var(--neo-muted);
            font-size: .72rem;
            font-weight: 700;
            box-shadow:
                inset 3px 3px 7px var(--neo-inset-dark),
                inset -3px -3px 7px var(--neo-inset-light);
        }

        .neo-mini-info i {
            color: var(--neo-primary);
        }

        .course-title-link {
            line-height: 1.35;
        }

        .neo-preview-modal {
            z-index: 20000 !important;
        }

        .modal-backdrop {
            z-index: 19990 !important;
        }

        .neo-navbar,
        .header,
        #kt_header {
            z-index: 1000 !important;
        }

        .neo-preview-modal .modal-dialog {
            max-width: min(1120px, calc(100vw - 28px));
        }

        .neo-preview-modal .modal-content {
            position: relative;
            border: 0 !important;
            border-radius: 30px !important;
            overflow: hidden;
            background: #111827 !important;
            box-shadow:
                18px 18px 42px rgba(17, 24, 39, 0.46),
                -12px -12px 32px rgba(255, 255, 255, 0.15) !important;
        }

        .neo-preview-shell {
            position: relative;
            background: #111827;
        }

        .neo-preview-hero {
            position: relative;
            min-height: 560px;
            background: #111827;
        }

        .neo-preview-video {
            position: relative;
            width: 100%;
            background: #000;
        }

        .neo-preview-video::after {
            content: "";
            position: absolute;
            inset: auto 0 0 0;
            height: 34%;
            background: linear-gradient(180deg, transparent, rgba(17, 24, 39, 0.98));
            pointer-events: none;
            z-index: 2;
        }

        .neo-preview-video iframe {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 540px;
            border: 0;
            display: block;
            background: #000;
        }

        .neo-preview-close {
            position: absolute;
            top: 18px;
            right: 18px;
            z-index: 6;
            width: 44px;
            height: 44px;
            border: 0 !important;
            border-radius: 50% !important;
            background: rgba(231, 229, 228, 0.94) !important;
            color: #111827 !important;
            opacity: 1 !important;
            box-shadow:
                7px 7px 18px rgba(0, 0, 0, 0.36),
                -4px -4px 12px rgba(255, 255, 255, 0.12) !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: .2s ease;
        }

        .neo-preview-close:hover {
            transform: scale(1.06);
            background: var(--neo-primary) !important;
            color: #ffffff !important;
        }

        .neo-preview-close i {
            font-size: 1.45rem;
            line-height: 1;
        }

        .neo-preview-info {
            position: relative;
            z-index: 4;
            margin-top: -120px;
            padding: 0 28px 28px;
            color: #ffffff;
        }

        .neo-preview-title {
            max-width: 780px;
            color: #ffffff;
            font-size: clamp(1.45rem, 2.6vw, 2.35rem);
            font-weight: 900;
            letter-spacing: -0.04em;
            line-height: 1.12;
            margin-bottom: 14px;
            text-shadow: 0 8px 28px rgba(0, 0, 0, .45);
        }

        .neo-preview-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 18px;
        }

        .neo-preview-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            border-radius: 999px;
            padding: 8px 12px;
            background: rgba(231, 229, 228, 0.13);
            color: rgba(255, 255, 255, .92);
            font-size: .78rem;
            font-weight: 800;
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, .10);
        }

        .neo-preview-pill i {
            color: var(--neo-primary);
        }

        .neo-preview-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .neo-preview-detail-btn,
        .neo-preview-close-btn {
            border: 0 !important;
            border-radius: 999px !important;
            min-height: 42px;
            padding: 10px 18px !important;
            font-weight: 900 !important;
        }

        .neo-preview-detail-btn {
            background: var(--neo-primary) !important;
            color: #ffffff !important;
        }

        .neo-preview-detail-btn:hover {
            background: var(--neo-primary-dark) !important;
            color: #ffffff !important;
        }

        .neo-preview-close-btn {
            background: rgba(231, 229, 228, 0.14) !important;
            color: #ffffff !important;
            backdrop-filter: blur(12px);
        }

        .neo-preview-close-btn:hover {
            background: rgba(231, 229, 228, 0.22) !important;
            color: #ffffff !important;
        }

        .modal-backdrop.show {
            opacity: .72;
            backdrop-filter: blur(6px);
        }

        body:not(.modal-open) .modal-backdrop,
        body:not(.modal-open) .modal-backdrop.fade.show {
            display: none !important;
            pointer-events: none !important;
        }

        @media (max-width: 991.98px) {
            .neo-kursus-page {
                padding-top: 16px;
            }

            .neo-filter-sticky {
                position: relative;
                top: auto;
            }

            .neo-card,
            .neo-filter-card,
            .neo-list-card,
            .neo-help-card,
            .neo-page-hero {
                border-radius: 22px !important;
                box-shadow:
                    8px 8px 18px var(--neo-dark-soft),
                    -8px -8px 18px var(--neo-light) !important;
            }

            .neo-page-hero .card-body,
            .neo-filter-card .card-body,
            .neo-list-card .card-body {
                padding: 1.5rem !important;
            }

            .neo-preview-hero {
                min-height: auto;
            }

            .neo-preview-video iframe {
                height: 420px;
            }

            .neo-preview-info {
                margin-top: -86px;
                padding: 0 20px 22px;
            }
        }

        @media (max-width: 767.98px) {
            .neo-page-hero .card-body {
                padding: 1.35rem !important;
            }

            .neo-page-hero h1 {
                font-size: 1.85rem !important;
            }

            .neo-search-box {
                display: flex;
                flex-wrap: wrap;
                gap: 0.35rem;
                padding: 0.65rem;
            }

            .neo-search-box .input-group-text {
                width: 42px;
                justify-content: center;
                padding: 0;
            }

            .neo-search-box .form-control {
                flex: 1 1 calc(100% - 48px);
                min-width: 0;
            }

            .neo-search-box .btn {
                width: 100%;
                min-height: 44px;
            }

            .neo-list-card .card-header {
                gap: 14px;
                flex-direction: column;
                align-items: stretch !important;
            }

            .neo-list-toolbar {
                width: 100%;
                flex-direction: column;
                align-items: stretch !important;
            }

            .neo-list-toolbar .form-select {
                width: 100% !important;
            }
        }

        @media (max-width: 575.98px) {
            .neo-kursus-page {
                padding-top: 12px;
            }

            .neo-page-hero h1 {
                font-size: 1.65rem !important;
            }

            .neo-filter-card .card-header,
            .neo-list-card .card-header {
                padding-left: 1.25rem;
                padding-right: 1.25rem;
            }

            .btn-check + .btn {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .course-preview-trigger .btn.btn-icon,
            .neo-play-btn {
                width: 48px;
                height: 48px;
            }

            .neo-preview-modal .modal-dialog {
                max-width: calc(100vw - 14px);
                margin-left: auto;
                margin-right: auto;
            }

            .neo-preview-modal .modal-content {
                border-radius: 24px !important;
            }

            .neo-preview-video iframe {
                height: 300px;
            }

            .neo-preview-info {
                margin-top: -48px;
                padding: 0 16px 18px;
            }

            .neo-preview-title {
                font-size: 1.28rem;
            }

            .neo-preview-actions {
                flex-direction: column;
            }

            .neo-preview-actions .btn {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    @php
        $currentBahasa = strtoupper(request('filter_bahasa', 'ID'));
        $currentTingkat = request('filter_tingkat');
        $currentKategori = request('filter_kategori');
        $currentSort = request('sort', 'terbaru');
        $currentSearch = request('q', '');
        $currentMinRating = request('min_rating');
        $currentDurasiRange = request('durasi_range');
    @endphp

    <div class="neo-kursus-page">
        <div class="card neo-page-hero mb-8 mb-lg-10">
            <div class="card-body p-8 p-lg-10">
                <div class="row g-6 align-items-center">
                    <div class="col-lg-8">
                        <div class="d-inline-flex align-items-center px-4 py-2 mb-4 rounded-pill neo-stat-pill">
                            <i class="bi bi-collection-play fs-4 me-2 text-primary"></i>
                            <span class="fw-semibold text-gray-700">Katalog Kursus MOOC</span>
                        </div>

                        <h1 class="fw-bolder text-gray-900 mb-3">
                            Jelajahi Kursus yang Tersedia
                        </h1>

                        <p class="fs-5 text-gray-600 mb-0 mw-700px">
                            Temukan kelas sesuai minat, kategori, tingkat pembelajaran, bahasa, rating, dan durasi yang kamu butuhkan.
                        </p>
                    </div>

                    <div class="col-lg-4">
                        <form id="hero-search-form" onsubmit="return false;">
                            <div class="input-group input-group-lg neo-search-box">
                                <span class="input-group-text">
                                    <i class="bi bi-search fs-3 text-gray-500"></i>
                                </span>

                                <input type="text" id="search-input" name="q"
                                    class="form-control form-control-lg"
                                    value="{{ $currentSearch }}"
                                    placeholder="Cari kursus..." autocomplete="off">

                                <button type="button" id="hero-search-btn" class="btn btn-primary fw-bold px-6">
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5 g-xl-10">
            <div class="col-lg-3">
                <div class="neo-filter-sticky">
                    <form id="filter-form">
                        <div class="card neo-filter-card mb-5 mb-xl-8">
                            <div class="card-header">
                                <h3 class="card-title">Filter Kursus</h3>

                                <div class="card-toolbar">
                                    <button type="button" id="reset-filter-btn"
                                        class="btn btn-sm btn-icon neo-reset-btn"
                                        title="Reset semua filter">
                                        <i class="bi bi-arrow-clockwise fs-4"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div id="active-filters-container" class="mb-7" style="display: none;">
                                    <label class="form-label fw-bold fs-6">Filter Aktif:</label>
                                    <div class="d-flex flex-wrap gap-2"></div>
                                </div>

                                <div class="mb-7">
                                    <label class="form-label fw-bold fs-6 mb-3">
                                        <i class="bi bi-translate me-2 text-primary"></i>Bahasa Kursus
                                    </label>

                                    <div class="btn-group w-100" role="group">
                                        <input type="radio" class="btn-check filter-input" name="filter_bahasa"
                                            value="ID" id="lang_id" {{ $currentBahasa === 'ID' ? 'checked' : '' }}>
                                        <label class="btn btn-outline btn-outline-primary btn-active-primary" for="lang_id">
                                            <span class="fw-bold fs-8">ID</span>
                                        </label>

                                        <input type="radio" class="btn-check filter-input" name="filter_bahasa"
                                            value="AR" id="lang_ar" {{ $currentBahasa === 'AR' ? 'checked' : '' }}>
                                        <label class="btn btn-outline btn-outline-primary btn-active-primary" for="lang_ar">
                                            <span class="fw-bold fs-8">AR</span>
                                        </label>

                                        <input type="radio" class="btn-check filter-input" name="filter_bahasa"
                                            value="EN" id="lang_en" {{ $currentBahasa === 'EN' ? 'checked' : '' }}>
                                        <label class="btn btn-outline btn-outline-primary btn-active-primary" for="lang_en">
                                            <span class="fw-bold fs-8">EN</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-7">
                                    <label class="form-label fw-bold fs-6 mb-3">
                                        <i class="bi bi-bar-chart-steps me-2 text-primary"></i>Tingkat
                                    </label>

                                    <div class="d-flex flex-column gap-2">
                                        <input type="radio" class="btn-check filter-input" name="filter_tingkat"
                                            value="" id="lvl_all"
                                            {{ $currentTingkat === null || $currentTingkat === '' ? 'checked' : '' }}>
                                        <label class="btn btn-outline btn-outline-primary btn-active-light-primary text-start px-4 py-3"
                                            for="lvl_all">
                                            <div class="d-flex align-items-center justify-content-between fs-8">
                                                <span class="fw-semibold text-gray-800">Semua Tingkat</span>
                                            </div>
                                        </label>

                                        @foreach (['pemula', 'menengah', 'lanjutan', 'expert'] as $level)
                                            <input type="radio" class="btn-check filter-input" name="filter_tingkat"
                                                value="{{ $level }}" id="lvl_{{ $level }}"
                                                {{ $currentTingkat === $level ? 'checked' : '' }}>
                                            <label class="btn btn-outline btn-outline-primary btn-active-light-primary text-start px-4 py-3"
                                                for="lvl_{{ $level }}">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="fw-semibold text-gray-800 text-capitalize fs-8">
                                                        {{ $level }}
                                                    </span>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mb-7">
                                    <label class="form-label fw-bold fs-6 mb-3">
                                        <i class="bi bi-folder me-2 text-primary"></i>Kategori
                                    </label>

                                    <div class="d-flex flex-column gap-2">
                                        <input type="radio" class="btn-check filter-input" name="filter_kategori"
                                            value="" id="cat_all" {{ empty($currentKategori) ? 'checked' : '' }}>
                                        <label class="btn btn-outline btn-outline-primary btn-active-light-primary text-start px-4 py-3"
                                            for="cat_all">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="fw-semibold text-gray-800 fs-8">Semua Kategori</span>
                                            </div>
                                        </label>

                                        @foreach ($kategoriList as $kategori)
                                            <input type="radio" class="btn-check filter-input" name="filter_kategori"
                                                value="{{ $kategori->id_kategori }}" id="cat_{{ $kategori->id_kategori }}"
                                                {{ (string) $currentKategori === (string) $kategori->id_kategori ? 'checked' : '' }}>
                                            <label class="btn btn-outline btn-outline-primary btn-active-light-primary text-start px-4 py-3"
                                                for="cat_{{ $kategori->id_kategori }}">
                                                <span class="fw-semibold text-gray-800 fs-8">{{ $kategori->nama }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label fw-bold fs-6 mb-3">
                                        <i class="bi bi-funnel me-2 text-primary"></i>Filter Lanjutan
                                    </label>

                                    <div class="mb-3">
                                        <label for="min_rating" class="form-label fw-semibold fs-8 mb-1">
                                            Minimal Rating
                                        </label>
                                        <select class="form-select form-select-sm filter-input fs-8" name="min_rating"
                                            id="min_rating">
                                            <option value="">Semua rating</option>
                                            <option value="3" {{ $currentMinRating == '3' ? 'selected' : '' }}>3.0 ke atas</option>
                                            <option value="4" {{ $currentMinRating == '4' ? 'selected' : '' }}>4.0 ke atas</option>
                                            <option value="4.5" {{ $currentMinRating == '4.5' ? 'selected' : '' }}>4.5 ke atas</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="durasi_range" class="form-label fw-semibold fs-8 mb-1">
                                            Durasi Total
                                        </label>
                                        <select class="form-select form-select-sm filter-input fs-8" name="durasi_range"
                                            id="durasi_range">
                                            <option value="">Semua durasi</option>
                                            <option value="short" {{ $currentDurasiRange == 'short' ? 'selected' : '' }}>Pendek (&le; 2 jam)</option>
                                            <option value="medium" {{ $currentDurasiRange == 'medium' ? 'selected' : '' }}>Menengah (2 - 5 jam)</option>
                                            <option value="long" {{ $currentDurasiRange == 'long' ? 'selected' : '' }}>Panjang (&gt; 5 jam)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card neo-help-card">
                        <div class="card-body text-center p-7">
                            <div class="neo-help-icon mb-4">
                                <i class="bi bi-lightbulb fs-2"></i>
                            </div>

                            <h5 class="fw-bolder text-gray-900 mb-2">Butuh Bantuan?</h5>

                            <p class="text-gray-600 fs-7 mb-5">
                                Gunakan filter untuk menemukan kursus yang paling sesuai dengan kebutuhan belajar kamu.
                            </p>

                            <button type="button" class="btn btn-sm btn-light-primary fw-bold">
                                Panduan Belajar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card neo-list-card">
                    <div class="card-header align-items-center">
                        <div>
                            <h3 class="card-title mb-1">Daftar Kursus</h3>
                            <div class="text-gray-600 fs-7">
                                <span id="course-count">{{ $kursus->total() ?? 0 }} kursus</span> tersedia
                            </div>
                        </div>

                        <div class="card-toolbar neo-list-toolbar d-flex align-items-center gap-3">
                            <select id="sort-select" class="form-select form-select-sm w-250px">
                                <option value="terbaru" {{ $currentSort === 'terbaru' ? 'selected' : '' }}>Urutkan: Terbaru</option>
                                <option value="terpopuler" {{ $currentSort === 'terpopuler' ? 'selected' : '' }}>Urutkan: Terpopuler</option>
                                <option value="rating_tertinggi" {{ $currentSort === 'rating_tertinggi' ? 'selected' : '' }}>Urutkan: Rating Tertinggi</option>
                                <option value="durasi_terpendek" {{ $currentSort === 'durasi_terpendek' ? 'selected' : '' }}>Durasi: Terpendek ke Terlama</option>
                                <option value="durasi_terlama" {{ $currentSort === 'durasi_terlama' ? 'selected' : '' }}>Durasi: Terlama ke Terpendek</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-body pt-6">
                        <div id="courses-wrapper">
                            <div id="courses-loading"
                                class="d-none d-flex flex-column align-items-center justify-content-center">
                                <div class="spinner-border mb-3" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <span class="text-gray-600">Memuat kursus...</span>
                            </div>

                            <div id="courses-list-container">
                                <div class="row g-6 g-xl-9" id="courses-container">
                                    @include('content.kursus._courses_list', ['kursus' => $kursus])
                                </div>

                                <div class="mt-10" id="pagination-container">
                                    {{ $kursus->links('content.kursus.pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade neo-preview-modal" id="coursePreviewModal" tabindex="-1"
            aria-labelledby="coursePreviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="neo-preview-shell">
                        <button type="button" class="neo-preview-close" data-preview-close aria-label="Tutup Preview">
                            <i class="bi bi-x-lg"></i>
                        </button>

                        <div class="neo-preview-hero">
                            <div class="neo-preview-video">
                                <iframe id="coursePreviewIframe" src="" title="Course Preview"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen>
                                </iframe>
                            </div>

                            <div class="neo-preview-info">
                                <h5 class="neo-preview-title" id="coursePreviewModalLabel">
                                    Preview Kursus
                                </h5>

                                <div class="neo-preview-meta">
                                    <span class="neo-preview-pill">
                                        <i class="bi bi-bar-chart-steps"></i>
                                        <span id="previewCourseLevel">-</span>
                                    </span>

                                    <span class="neo-preview-pill">
                                        <i class="bi bi-folder-symlink"></i>
                                        <span id="previewCourseCategory">-</span>
                                    </span>

                                    <span class="neo-preview-pill">
                                        <i class="bi bi-clock"></i>
                                        <span id="previewCourseDuration">-</span>
                                    </span>

                                    <span class="neo-preview-pill">
                                        <i class="bi bi-play-circle"></i>
                                        <span id="previewCourseLessons">-</span>
                                    </span>

                                    <span class="neo-preview-pill">
                                        <i class="bi bi-star-fill"></i>
                                        <span id="previewCourseRating">-</span>
                                    </span>
                                </div>

                                <div class="neo-preview-actions">
                                    <a href="#" id="previewDetailBtn" class="btn neo-preview-detail-btn">
                                        Lihat Detail Kursus
                                        <i class="bi bi-arrow-right ms-2"></i>
                                    </a>

                                    <button type="button" class="btn neo-preview-close-btn" data-preview-close>
                                        Tutup Preview
                                    </button>
                                </div>
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
            const coursesContainer = document.getElementById('courses-container');
            const paginationContainer = document.getElementById('pagination-container');
            const courseCountEl = document.getElementById('course-count');
            const coursesListContainer = document.getElementById('courses-list-container');
            const coursesLoading = document.getElementById('courses-loading');
            const filterForm = document.getElementById('filter-form');
            const searchInput = document.getElementById('search-input');
            const heroSearchBtn = document.getElementById('hero-search-btn');
            const sortSelect = document.getElementById('sort-select');
            const resetBtn = document.getElementById('reset-filter-btn');
            const activeFiltersContainer = document.getElementById('active-filters-container');
            const activeFiltersWrapper = activeFiltersContainer ?
                activeFiltersContainer.querySelector('.d-flex') :
                null;
            const coursesWrapper = document.getElementById('courses-wrapper');

            let fetchController = null;

            function debounce(func, delay) {
                let timeout;

                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), delay);
                };
            }

            function addActiveFilterBadge(name, group, label, targetId) {
                if (!activeFiltersWrapper) return;

                const span = document.createElement('span');
                span.className = 'badge badge-light-primary d-inline-flex align-items-center gap-2';

                span.innerHTML = `
                    <span class="fw-semibold">${label}</span>
                    <button type="button"
                            class="btn btn-sm btn-icon btn-active-color-primary p-0"
                            data-filter-name="${name}"
                            data-filter-target="${targetId || ''}">
                        <i class="bi bi-x fs-5"></i>
                    </button>
                `;

                activeFiltersWrapper.appendChild(span);
            }

            function updateActiveFilters() {
                if (!activeFiltersContainer || !activeFiltersWrapper) return;

                activeFiltersWrapper.innerHTML = '';

                let hasActive = false;

                const q = (searchInput?.value || '').trim();

                if (q !== '') {
                    addActiveFilterBadge('q', 'Pencarian', `Cari: "${q}"`, null);
                    hasActive = true;
                }

                document.querySelectorAll('input[type="radio"].filter-input:checked').forEach(radio => {
                    if (!radio.value) return;

                    const groupLabelEl = radio.closest('.mb-7')?.querySelector('.form-label');
                    const groupLabel = groupLabelEl ? groupLabelEl.textContent.trim() : radio.name;
                    const labelText = radio.labels && radio.labels[0] ?
                        radio.labels[0].innerText.trim() :
                        radio.value;

                    addActiveFilterBadge(radio.name, groupLabel, labelText, radio.id);
                    hasActive = true;
                });

                document.querySelectorAll('select.filter-input').forEach(select => {
                    const value = select.value;

                    if (!value) return;

                    const groupLabelEl = select.closest('.mb-7')?.querySelector('.form-label');
                    const groupLabel = groupLabelEl ? groupLabelEl.textContent.trim() : select.name;
                    const labelText = select.options[select.selectedIndex]?.text?.trim() || value;

                    addActiveFilterBadge(select.name, groupLabel, labelText, select.id);
                    hasActive = true;
                });

                activeFiltersContainer.style.display = hasActive ? 'block' : 'none';
            }

            const fetchCourses = async (page = 1) => {
                if (!coursesContainer || !coursesListContainer || !filterForm) return;

                if (fetchController) {
                    fetchController.abort();
                }

                fetchController = new AbortController();

                const signal = fetchController.signal;

                if (coursesLoading) {
                    coursesLoading.classList.remove('d-none');
                }

                coursesListContainer.style.display = 'none';

                const formData = new FormData(filterForm);
                const params = new URLSearchParams(formData);

                if (searchInput) {
                    params.set('q', searchInput.value || '');
                }

                if (sortSelect) {
                    params.set('sort', sortSelect.value || 'terbaru');
                }

                params.set('page', page);

                const url = `{{ route('kursus.filter') }}?${params.toString()}`;

                try {
                    const response = await fetch(url, {
                        signal: signal,
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();

                    if (courseCountEl) {
                        courseCountEl.textContent = `${data.total} kursus`;
                    }

                    if (coursesContainer) {
                        coursesContainer.innerHTML = data.html || '';
                    }

                    if (paginationContainer) {
                        paginationContainer.innerHTML = data.pagination || '';
                    }

                    history.pushState(
                        { page: page },
                        'Kursus',
                        `{{ route('kursus.index') }}?${params.toString()}`
                    );

                    const cards = coursesContainer.querySelectorAll('.course-card');

                    cards.forEach((card, index) => {
                        card.style.animationDelay = `${index * 50}ms`;
                        card.classList.add('card-fade-in');
                    });
                } catch (error) {
                    if (error.name === 'AbortError') {
                        return;
                    }

                    console.error('Error fetching courses:', error);

                    coursesContainer.innerHTML =
                        `<div class="col-12 text-center">
                            <p class="text-danger">Gagal memuat kursus. Silakan coba lagi.</p>
                        </div>`;
                } finally {
                    if (coursesLoading) {
                        coursesLoading.classList.add('d-none');
                    }

                    coursesListContainer.style.display = 'block';
                    updateActiveFilters();
                }
            };

            if (filterForm) {
                filterForm.addEventListener('change', () => fetchCourses(1));
            }

            if (searchInput) {
                searchInput.addEventListener('keyup', debounce(() => {
                    fetchCourses(1);
                }, 500));
            }

            if (heroSearchBtn) {
                heroSearchBtn.addEventListener('click', () => fetchCourses(1));
            }

            if (sortSelect) {
                sortSelect.addEventListener('change', () => fetchCourses(1));
            }

            if (resetBtn) {
                resetBtn.addEventListener('click', () => {
                    filterForm.reset();

                    if (searchInput) searchInput.value = '';
                    if (sortSelect) sortSelect.value = 'terbaru';

                    const defaultLang = document.getElementById('lang_id');
                    if (defaultLang) defaultLang.checked = true;

                    const allLevel = document.getElementById('lvl_all');
                    if (allLevel) allLevel.checked = true;

                    const allKategori = document.getElementById('cat_all');
                    if (allKategori) allKategori.checked = true;

                    const minRatingSelect = document.getElementById('min_rating');
                    if (minRatingSelect) minRatingSelect.value = '';

                    const durasiRangeSelect = document.getElementById('durasi_range');
                    if (durasiRangeSelect) durasiRangeSelect.value = '';

                    fetchCourses(1);
                });
            }

            if (activeFiltersWrapper) {
                activeFiltersWrapper.addEventListener('click', function(e) {
                    const btn = e.target.closest('button[data-filter-name]');
                    if (!btn) return;

                    const name = btn.getAttribute('data-filter-name');
                    const targetId = btn.getAttribute('data-filter-target');

                    if (name === 'q' && searchInput) {
                        searchInput.value = '';
                    } else if (name === 'filter_tingkat') {
                        const allRadio = document.getElementById('lvl_all');
                        if (allRadio) allRadio.checked = true;
                    } else if (name === 'filter_kategori') {
                        const allRadio = document.getElementById('cat_all');
                        if (allRadio) allRadio.checked = true;
                    } else if (name === 'filter_bahasa') {
                        const defaultLang = document.getElementById('lang_id');
                        if (defaultLang) defaultLang.checked = true;
                    } else if (targetId) {
                        const el = document.getElementById(targetId);

                        if (el) {
                            if (el.type === 'checkbox' || el.type === 'radio') {
                                el.checked = false;
                            } else if (el.tagName === 'SELECT') {
                                el.value = '';
                            }
                        }
                    }

                    fetchCourses(1);
                });
            }

            if (coursesWrapper) {
                coursesWrapper.addEventListener('click', function(e) {
                    const link = e.target.closest('#pagination-container a.page-link');

                    if (!link) return;

                    e.preventDefault();

                    const url = new URL(link.href);
                    const page = url.searchParams.get('page') || 1;

                    fetchCourses(page);
                });
            }

            window.addEventListener('popstate', function() {
                const urlParams = new URLSearchParams(window.location.search);
                const page = urlParams.get('page') || 1;

                if (searchInput) {
                    searchInput.value = urlParams.get('q') || '';
                }

                if (sortSelect) {
                    sortSelect.value = urlParams.get('sort') || 'terbaru';
                }

                const bahasa = (urlParams.get('filter_bahasa') || 'ID').toUpperCase();
                const langRadio = document.querySelector(`input[name="filter_bahasa"][value="${bahasa}"]`);

                if (langRadio) {
                    langRadio.checked = true;
                }

                const tingkat = urlParams.get('filter_tingkat') || '';
                const tingkatRadio = document.querySelector(`input[name="filter_tingkat"][value="${tingkat}"]`) ||
                    document.getElementById('lvl_all');

                if (tingkatRadio) {
                    tingkatRadio.checked = true;
                }

                const kategori = urlParams.get('filter_kategori') || '';
                const kategoriRadio = document.querySelector(`input[name="filter_kategori"][value="${kategori}"]`) ||
                    document.getElementById('cat_all');

                if (kategoriRadio) {
                    kategoriRadio.checked = true;
                }

                const minRatingParam = urlParams.get('min_rating') || '';
                const minRatingSelect = document.getElementById('min_rating');

                if (minRatingSelect) {
                    minRatingSelect.value = minRatingParam;
                }

                const durasiRangeParam = urlParams.get('durasi_range') || '';
                const durasiRangeSelect = document.getElementById('durasi_range');

                if (durasiRangeSelect) {
                    durasiRangeSelect.value = durasiRangeParam;
                }

                fetchCourses(page);
            });

            const previewModalEl = document.getElementById('coursePreviewModal');
            const previewIframe = document.getElementById('coursePreviewIframe');
            const previewTitleEl = document.getElementById('coursePreviewModalLabel');
            const previewLevelEl = document.getElementById('previewCourseLevel');
            const previewCategoryEl = document.getElementById('previewCourseCategory');
            const previewDurationEl = document.getElementById('previewCourseDuration');
            const previewLessonsEl = document.getElementById('previewCourseLessons');
            const previewRatingEl = document.getElementById('previewCourseRating');
            const previewDetailBtn = document.getElementById('previewDetailBtn');

            let previewModalInstance = null;

            function disposePreviewModalInstance() {
                if (!previewModalEl || typeof bootstrap === 'undefined' || !bootstrap.Modal) {
                    previewModalInstance = null;
                    return;
                }

                try {
                    const instance = bootstrap.Modal.getInstance(previewModalEl);

                    if (instance) {
                        instance.dispose();
                    }
                } catch (error) {
                    console.warn('Preview modal dispose fallback:', error);
                }

                previewModalInstance = null;
            }

            function forceRemoveAllModalLayers() {
                if (previewIframe) {
                    previewIframe.src = '';
                }

                document.querySelectorAll('.modal-backdrop').forEach((backdrop) => {
                    backdrop.classList.remove('show');
                    backdrop.remove();
                });

                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('overflow');
                document.body.style.removeProperty('padding-right');

                document.documentElement.style.removeProperty('overflow');
                document.documentElement.style.removeProperty('padding-right');

                if (previewModalEl) {
                    previewModalEl.classList.remove('show');
                    previewModalEl.style.display = 'none';
                    previewModalEl.setAttribute('aria-hidden', 'true');
                    previewModalEl.removeAttribute('aria-modal');
                    previewModalEl.removeAttribute('role');
                }
            }

            function closePreviewModal() {
                if (!previewModalEl) return;

                try {
                    const instance = bootstrap.Modal.getInstance(previewModalEl);

                    if (instance) {
                        instance.hide();
                    }
                } catch (error) {
                    console.warn('Preview modal close fallback:', error);
                }

                setTimeout(() => {
                    disposePreviewModalInstance();
                    forceRemoveAllModalLayers();
                }, 80);

                setTimeout(() => {
                    disposePreviewModalInstance();
                    forceRemoveAllModalLayers();
                }, 250);
            }

            function getYoutubeEmbedUrl(url) {
                if (!url) return '';

                try {
                    const parsed = new URL(url);
                    const host = parsed.hostname.replace(/^www\./, '');

                    let videoId = '';

                    if (host.includes('youtu.be')) {
                        videoId = parsed.pathname.split('/').filter(Boolean)[0] || '';
                    }

                    if (host.includes('youtube.com')) {
                        if (parsed.pathname.includes('/embed/')) {
                            const embedUrl = new URL(url);
                            embedUrl.searchParams.set('autoplay', '1');
                            embedUrl.searchParams.set('rel', '0');
                            embedUrl.searchParams.set('modestbranding', '1');
                            return embedUrl.toString();
                        }

                        videoId = parsed.searchParams.get('v') || '';
                    }

                    if (videoId) {
                        return `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
                    }

                    const fallbackUrl = new URL(url);
                    fallbackUrl.searchParams.set('autoplay', '1');

                    return fallbackUrl.toString();
                } catch (e) {
                    return url;
                }
            }

            function setPreviewText(el, value, fallback = '-') {
                if (!el) return;
                el.textContent = value && String(value).trim() !== '' ? value : fallback;
            }

            function openCoursePreview(trigger) {
                if (!trigger || !previewModalEl || !previewIframe) return;
                if (typeof bootstrap === 'undefined' || !bootstrap.Modal) return;

                const videoUrl = trigger.getAttribute('data-video-url');
                const courseTitle = trigger.getAttribute('data-course-title') || 'Preview Kursus';
                const courseLevel = trigger.getAttribute('data-course-level') || '-';
                const courseCategory = trigger.getAttribute('data-course-category') || '-';
                const courseDuration = trigger.getAttribute('data-course-duration') || '-';
                const courseLessons = trigger.getAttribute('data-course-lessons') || '-';
                const courseRating = trigger.getAttribute('data-course-rating') || '-';

                const card = trigger.closest('.course-card');
                const detailUrl = card?.querySelector('a[href*="/kursus/"]')?.getAttribute('href') || '#';

                if (!videoUrl) return;

                disposePreviewModalInstance();
                forceRemoveAllModalLayers();

                setTimeout(() => {
                    previewIframe.src = getYoutubeEmbedUrl(videoUrl);

                    setPreviewText(previewTitleEl, courseTitle, 'Preview Kursus');
                    setPreviewText(previewLevelEl, courseLevel);
                    setPreviewText(previewCategoryEl, courseCategory);
                    setPreviewText(previewDurationEl, courseDuration);
                    setPreviewText(previewLessonsEl, courseLessons);
                    setPreviewText(
                        previewRatingEl,
                        courseRating && courseRating !== '0.0' ? `${courseRating} rating` : 'Belum ada rating'
                    );

                    if (previewDetailBtn) {
                        previewDetailBtn.href = detailUrl;
                    }

                    previewModalInstance = new bootstrap.Modal(previewModalEl, {
                        backdrop: true,
                        keyboard: true,
                        focus: true
                    });

                    previewModalInstance.show();
                }, 20);
            }

            document.addEventListener('click', function(e) {
                const closeBtn = e.target.closest('[data-preview-close], .neo-preview-close, .neo-preview-close-btn');

                if (closeBtn) {
                    e.preventDefault();
                    e.stopPropagation();
                    closePreviewModal();
                    return;
                }

                const trigger = e.target.closest('.course-preview-trigger[data-video-url]');

                if (!trigger) return;
                if (e.target.closest('#coursePreviewModal')) return;

                e.preventDefault();
                e.stopPropagation();

                openCoursePreview(trigger);
            }, true);

            if (previewModalEl) {
                previewModalEl.addEventListener('hide.bs.modal', function() {
                    if (previewIframe) {
                        previewIframe.src = '';
                    }
                });

                previewModalEl.addEventListener('hidden.bs.modal', function() {
                    disposePreviewModalInstance();
                    forceRemoveAllModalLayers();
                });

                previewModalEl.addEventListener('click', function(e) {
                    if (e.target === previewModalEl) {
                        e.preventDefault();
                        e.stopPropagation();
                        closePreviewModal();
                    }
                });
            }

            document.addEventListener('keydown', function(e) {
                if (e.key !== 'Escape') return;

                if (previewModalEl && previewModalEl.classList.contains('show')) {
                    closePreviewModal();
                }
            });

            const modalObserver = new MutationObserver(() => {
                const modalIsOpen = previewModalEl && previewModalEl.classList.contains('show');

                if (!modalIsOpen && !document.body.classList.contains('modal-open')) {
                    document.querySelectorAll('.modal-backdrop').forEach((backdrop) => {
                        backdrop.remove();
                    });
                }
            });

            modalObserver.observe(document.body, {
                childList: true,
                subtree: false,
                attributes: true,
                attributeFilter: ['class']
            });

            if (coursesListContainer) {
                coursesListContainer.style.display = 'block';
            }

            updateActiveFilters();
        });
    </script>
@endsection