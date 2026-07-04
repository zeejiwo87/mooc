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

        .neo-home-wrapper {
            position: relative;
            padding-top: 18px;
            margin-bottom: 3rem;
        }

        .course-card,
        .card-fade-in {
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        }

        .course-card:hover,
        .card-fade-in:hover {
            transform: translateY(-4px);
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
            min-height: 120px;
        }

        .modal-content {
            border: 0;
            border-radius: 24px;
            overflow: hidden;
            background: var(--neo-surface);
            box-shadow:
                12px 12px 28px var(--neo-dark),
                -12px -12px 28px var(--neo-light);
        }

        .modal-header {
            border-bottom: 1px solid rgba(120, 113, 108, 0.14);
            padding: 0.9rem 1rem;
            background: var(--neo-surface);
        }

        .modal-body {
            background: var(--neo-surface);
        }

        .btn-close {
            border-radius: 12px;
            background-color: var(--neo-surface);
            box-shadow:
                4px 4px 9px var(--neo-dark-soft),
                -4px -4px 9px var(--neo-light);
            opacity: 1;
        }

        .neo-section-card,
        .hero-card,
        .category-neo-card,
        .cta-neo-card {
            background: var(--neo-surface) !important;
            border: 0 !important;
            border-radius: 28px !important;
            box-shadow:
                10px 10px 24px var(--neo-dark),
                -10px -10px 24px var(--neo-light) !important;
        }

        .separator.separator-dashed {
            border-color: rgba(120, 113, 108, 0.22) !important;
        }

        .btn.btn-primary,
        .btn.btn-light-primary,
        .btn.btn-dark {
            border-radius: 14px;
            border: 0;
            transition: 0.2s ease;
        }

        .btn.btn-primary {
            background: var(--neo-primary) !important;
            color: #ffffff !important;
            box-shadow:
                5px 5px 12px rgba(120, 113, 108, 0.24),
                -5px -5px 12px rgba(255, 255, 255, 0.68);
        }

        .btn.btn-primary:hover,
        .btn.btn-primary:focus {
            background: var(--neo-primary-dark) !important;
            transform: translateY(-1px);
        }

        .btn.btn-light-primary {
            background: var(--neo-surface) !important;
            color: var(--neo-primary) !important;
            box-shadow:
                5px 5px 12px var(--neo-dark-soft),
                -5px -5px 12px var(--neo-light);
        }

        .btn.btn-light-primary:hover,
        .btn.btn-light-primary:focus {
            color: var(--neo-primary-dark) !important;
            transform: translateY(-1px);
        }

        .btn.btn-dark {
            background: #1f2937 !important;
            color: #ffffff !important;
            box-shadow:
                5px 5px 12px rgba(120, 113, 108, 0.24),
                -5px -5px 12px rgba(255, 255, 255, 0.68);
        }

        .btn.btn-dark:hover,
        .btn.btn-dark:focus {
            background: #111827 !important;
            transform: translateY(-1px);
        }

        .btn.btn-light,
        .btn.btn-sm.btn-light {
            background: var(--neo-surface) !important;
            color: var(--neo-text) !important;
            border: 0 !important;
            box-shadow:
                4px 4px 10px var(--neo-dark-soft),
                -4px -4px 10px var(--neo-light);
        }

        .btn.btn-light:hover,
        .btn.btn-sm.btn-light:hover {
            color: var(--neo-primary) !important;
            transform: translateY(-1px);
        }

        .text-primary,
        .text-info,
        .text-success {
            color: var(--neo-primary) !important;
        }

        .hero-card {
            position: relative;
            overflow: hidden;
            margin-top: 0;
            background:
                radial-gradient(circle at 0% 0%, rgba(255, 255, 255, 0.72), transparent 42%),
                radial-gradient(circle at 100% 100%, rgba(0, 158, 247, 0.12), transparent 48%),
                var(--neo-surface) !important;
        }

        .hero-card::before {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            top: -100px;
            right: -110px;
            background: radial-gradient(circle, rgba(0, 158, 247, 0.14), transparent 66%);
            pointer-events: none;
        }

        .hero-card::after {
            content: "";
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: radial-gradient(circle at 10% 80%, rgba(255, 255, 255, 0.7), transparent 62%);
            bottom: -150px;
            left: -150px;
            pointer-events: none;
        }

        .hero-card .card-body {
            position: relative;
            z-index: 1;
        }

        .hero-heading {
            letter-spacing: 0.01em;
        }

        .hero-subtext {
            max-width: 640px;
        }

        .hero-search {
            border-radius: 999px;
            background: var(--neo-surface);
            box-shadow:
                inset 5px 5px 12px var(--neo-inset-dark),
                inset -5px -5px 12px var(--neo-inset-light);
            padding: .35rem .5rem .35rem .75rem;
            overflow: hidden;
        }

        .hero-search .input-group-text {
            background: transparent;
            border: 0;
        }

        .hero-search .form-control {
            border: 0;
            background: transparent;
            box-shadow: none !important;
            color: var(--neo-text);
        }

        .hero-search .form-control::placeholder {
            color: #94a3b8;
        }

        .hero-search .form-control:focus {
            background: transparent;
        }

        .hero-search .btn {
            border-radius: 999px;
        }

        .hero-quick-label {
            font-size: .85rem;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .hero-pill {
            border-radius: 999px;
            background: var(--neo-surface) !important;
            box-shadow:
                7px 7px 16px var(--neo-dark-soft),
                -7px -7px 16px var(--neo-light);
        }

        .hero-pill small {
            font-size: .7rem;
        }

        .hero-card img {
            filter: drop-shadow(10px 14px 18px rgba(120, 113, 108, 0.18));
        }

        .neo-section-heading {
            padding: 22px 24px;
            border-radius: 24px;
            background: var(--neo-surface);
            box-shadow:
                inset 4px 4px 10px rgba(120, 113, 108, 0.12),
                inset -4px -4px 10px rgba(255, 255, 255, 0.75);
        }

        .neo-section-heading h2 {
            margin-bottom: 0.4rem;
        }

        #kelas-baru .card,
        #kelas-baru .course-card {
            background: var(--neo-surface) !important;
            border: 0 !important;
            border-radius: 24px !important;
            box-shadow:
                8px 8px 18px var(--neo-dark-soft),
                -8px -8px 18px var(--neo-light) !important;
            overflow: hidden;
        }

        #kelas-baru .card:hover,
        #kelas-baru .course-card:hover {
            box-shadow:
                11px 11px 24px var(--neo-dark),
                -11px -11px 24px var(--neo-light) !important;
        }

        #kelas-baru .card .card-body,
        #kelas-baru .course-card .card-body {
            background: transparent !important;
        }

        #kelas-baru img {
            border-radius: 18px;
        }


        #kelas-baru .neo-course-cover {
            position: relative;
            border-radius: 22px;
            overflow: hidden;
        }

        #kelas-baru .neo-course-cover img {
            border-radius: 0 !important;
        }

        #kelas-baru .neo-course-cover-overlay {
            position: absolute;
            inset: 0;
            z-index: 1;
            background:
                linear-gradient(180deg, rgba(17, 24, 39, 0.18) 0%, rgba(17, 24, 39, 0.05) 42%, rgba(17, 24, 39, 0.58) 100%),
                radial-gradient(circle at 50% 50%, transparent 0%, rgba(0, 0, 0, 0.24) 100%);
            pointer-events: none;
        }

        #kelas-baru .neo-course-cover .position-absolute {
            z-index: 3;
        }

        #kelas-baru .neo-course-badge,
        #kelas-baru .neo-level-badge,
        #kelas-baru .neo-course-cover .badge {
            border: 0 !important;
            border-radius: 999px !important;
            background: rgba(236, 235, 234, 0.94) !important;
            color: var(--neo-primary) !important;
            font-weight: 800 !important;
            text-shadow: none !important;
            box-shadow:
                4px 4px 10px rgba(17, 24, 39, 0.22),
                -4px -4px 10px rgba(255, 255, 255, 0.20) !important;
            backdrop-filter: blur(12px);
        }

        #kelas-baru .neo-level-badge {
            color: var(--neo-text) !important;
        }

        #kelas-baru .neo-course-badge i,
        #kelas-baru .neo-level-badge i,
        #kelas-baru .neo-course-cover .badge i {
            color: inherit !important;
        }

        #kelas-baru .neo-play-btn {
            width: 54px;
            height: 54px;
            border: 0 !important;
            border-radius: 50% !important;
            background: rgba(236, 235, 234, 0.95) !important;
            color: var(--neo-primary) !important;
            box-shadow:
                8px 8px 18px rgba(0, 0, 0, 0.30),
                -5px -5px 12px rgba(255, 255, 255, 0.22) !important;
        }

        #kelas-baru .neo-play-btn i {
            color: inherit !important;
        }

        .category-neo-card {
            min-height: 100%;
            color: inherit;
            transition: transform .18s ease, box-shadow .18s ease;
        }

        .category-neo-card:hover {
            transform: translateY(-4px);
            box-shadow:
                11px 11px 24px var(--neo-dark),
                -11px -11px 24px var(--neo-light) !important;
        }

        .category-neo-card .card-body {
            background: transparent;
        }

        .category-neo-card h5 {
            color: var(--neo-text) !important;
        }

        .category-neo-card p {
            color: var(--neo-muted) !important;
        }

        .category-neo-card .category-arrow {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--neo-surface);
            box-shadow:
                4px 4px 9px var(--neo-dark-soft),
                -4px -4px 9px var(--neo-light);
        }

        .alert.alert-primary {
            border: 0;
            border-radius: 22px;
            background: var(--neo-surface) !important;
            color: var(--neo-text);
            box-shadow:
                inset 5px 5px 12px var(--neo-inset-dark),
                inset -5px -5px 12px var(--neo-inset-light);
        }

        .cta-neo-card {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 0% 0%, rgba(255, 255, 255, 0.74), transparent 40%),
                radial-gradient(circle at 100% 100%, rgba(0, 158, 247, 0.12), transparent 46%),
                var(--neo-surface) !important;
        }

        .cta-neo-card::before {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            right: -120px;
            top: -100px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0, 158, 247, 0.12), transparent 65%);
            pointer-events: none;
        }

        .cta-neo-card .card-body {
            position: relative;
            z-index: 1;
        }

        @media (max-width: 991.98px) {
            .neo-home-wrapper {
                padding-top: 16px;
            }

            .hero-card,
            .neo-section-card,
            .cta-neo-card {
                border-radius: 24px !important;
                box-shadow:
                    8px 8px 18px var(--neo-dark-soft),
                    -8px -8px 18px var(--neo-light) !important;
            }

            .hero-card .card-body,
            .cta-neo-card .card-body {
                padding: 2rem !important;
            }

            .hero-card::before,
            .hero-card::after,
            .cta-neo-card::before {
                opacity: 0.75;
            }

            .hero-search {
                border-radius: 22px;
                padding: .65rem;
            }

            .hero-search .input-group-text {
                padding-left: .75rem;
            }

            .hero-search .btn {
                border-radius: 16px;
            }

            .neo-section-heading {
                padding: 20px;
                border-radius: 22px;
            }
        }

        @media (max-width: 767.98px) {
            .hero-card .card-body,
            .cta-neo-card .card-body {
                padding: 1.5rem !important;
            }

            .hero-heading {
                font-size: 2rem !important;
            }

            .hero-subtext {
                font-size: 1rem !important;
            }

            .hero-search {
                display: flex;
                flex-wrap: wrap;
                gap: .35rem;
            }

            .hero-search .input-group-text {
                width: 42px;
                justify-content: center;
                padding: 0;
            }

            .hero-search .form-control {
                min-width: 0;
                flex: 1 1 calc(100% - 48px);
            }

            .hero-search .btn {
                width: 100%;
                margin-top: .25rem;
                min-height: 44px;
            }

            .neo-section-heading {
                display: block !important;
            }

            .neo-section-heading .btn {
                width: 100%;
                margin-top: 1rem;
            }

            #kategori .col-6 {
                width: 100%;
            }

            .cta-neo-card .btn {
                width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .neo-home-wrapper {
                padding-top: 12px;
                margin-bottom: 2rem !important;
            }

            .hero-card,
            .cta-neo-card,
            .category-neo-card {
                border-radius: 20px !important;
            }

            .hero-heading {
                font-size: 1.75rem !important;
            }

            .hero-card .card-body,
            .cta-neo-card .card-body {
                padding: 1.25rem !important;
            }

            .hero-search {
                box-shadow:
                    inset 4px 4px 10px var(--neo-inset-dark),
                    inset -4px -4px 10px var(--neo-inset-light);
            }

            .hero-quick-label {
                width: 100%;
            }

            .category-neo-card .card-body {
                padding: 1.25rem !important;
            }
        }
    </style>
@endsection

@section('content')
    <div class="mb-10 mb-xl-15 neo-home-wrapper">

        {{-- HERO SECTION --}}
        <div class="card hero-card border-0 mb-10 mb-lg-15">
            <div class="card-body p-10 p-lg-15">
                <div class="row g-10 align-items-center">
                    <div class="col-lg-7">
                        {{-- Heading --}}
                        <h1 class="fw-bolder mb-4 fs-2x fs-lg-1x lh-sm hero-heading text-gray-900">
                            Belajar Tanpa Batas,<br>
                            <span class="fw-bold opacity-75 text-primary">Kapan Saja, Di Mana Saja</span>
                        </h1>

                        {{-- Sub copy --}}
                        <p class="fs-5 fw-semibold text-gray-600 mb-6 hero-subtext">
                            Platform pembelajaran daring dengan akses ke materi berkualitas,
                            sistem penilaian otomatis, dan sertifikat digital yang diakui.
                        </p>

                        {{-- Highlight info bar --}}
                        <div class="d-flex flex-wrap align-items-center gap-4 mb-7">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill fs-3 me-2 text-success"></i>
                                <span class="fw-semibold text-gray-700">Akses kapan saja</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-shield-check fs-3 me-2 text-info"></i>
                                <span class="fw-semibold text-gray-700">Sertifikat resmi kampus</span>
                            </div>
                        </div>

                        {{-- Search Form --}}
                        <form action="{{ route('kursus.index') }}" method="GET" class="mb-7">
                            <div class="input-group input-group-lg hero-search">
                                <span class="input-group-text ps-0">
                                    <i class="bi bi-search fs-3 text-gray-500"></i>
                                </span>
                                <input type="text" name="q"
                                    class="form-control form-control-lg"
                                    placeholder="Cari kelas, dosen, atau kategori..." autocomplete="off">
                                <button type="submit" class="btn btn-primary fw-bold px-7">
                                    <span class="d-none d-sm-inline">Jelajahi Kelas</span>
                                    <i class="bi bi-arrow-right-circle fs-3 ms-sm-2"></i>
                                </button>
                            </div>
                            <div class="form-text text-gray-500 mt-2">
                                Tips: coba ketik nama mata kuliah, dosen, atau topik yang ingin kamu kuasai.
                            </div>
                        </form>

                        {{-- Quick Links --}}
                        <div class="d-flex flex-wrap gap-3 align-items-center mb-8">
                            <span class="text-gray-700 fw-semibold d-flex align-items-center hero-quick-label">
                                <i class="bi bi-lightning-charge-fill text-warning fs-3 me-2"></i>
                                Mulai cepat:
                            </span>
                            <a href="#kategori" class="btn btn-sm btn-light btn-active-light-primary fw-bold rounded-pill">
                                <i class="bi bi-grid-3x3-gap me-1"></i> Kategori
                            </a>
                            <a href="#kelas-baru" class="btn btn-sm btn-primary btn-active-primary fw-bold rounded-pill">
                                <i class="bi bi-fire me-1"></i> Kelas baru
                            </a>
                        </div>
                    </div>

                    {{-- Hero Badges --}}
                    <div class="col-lg-5 d-none d-lg-flex justify-content-center align-items-center">
                        <div class="d-flex flex-column align-items-start gap-4">
                            <div class="d-inline-flex align-items-center px-5 py-4 rounded-pill hero-pill">
                                <i class="bi bi-check-circle-fill fs-3 me-3 text-primary"></i>
                                <span class="fw-semibold small text-gray-800">
                                    Lanjutkan belajar kapan pun kamu mau
                                </span>
                            </div>

                            <div class="d-inline-flex align-items-center px-5 py-4 rounded-pill hero-pill">
                                <i class="bi bi-check-circle-fill fs-3 me-3 text-primary"></i>
                                <span class="fw-semibold small text-gray-800">
                                    Progres belajar tersimpan otomatis
                                </span>
                            </div>

                            <div class="d-inline-flex align-items-center px-5 py-4 rounded-pill hero-pill">
                                <i class="bi bi-check-circle-fill fs-3 me-3 text-primary"></i>
                                <span class="fw-semibold small text-gray-800">
                                    Sertifikat digital siap diunduh
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KELAS BARU --}}
        <div id="kelas-baru" class="mb-10 mb-lg-15">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-5 mb-8 neo-section-heading">
                <div>
                    <h2 class="fs-2x fw-bolder text-gray-900 mb-2">Kelas Terbaru</h2>
                    <p class="fs-6 text-gray-600 mb-0 mw-500px">
                        Rekomendasi kelas yang sedang banyak diikuti oleh mahasiswa dan dosen Universitas Nurul Jadid.
                    </p>
                </div>
                <a href="{{ route('kursus.index') }}" class="btn btn-primary btn-sm fw-bold">
                    Lihat semua kelas
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

            <div class="row g-5 g-xl-8">
                @include('content.kursus._courses_list', ['kursus' => $baruClasses])
            </div>
        </div>

        {{-- SEPARATOR --}}
        <div class="separator separator-dashed my-10 my-lg-15"></div>

        {{-- KATEGORI --}}
        <div id="kategori" class="mb-10 mb-lg-15">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-5 mb-8 neo-section-heading">
                <div>
                    <h2 class="fs-2x fw-bolder text-gray-900 mb-2">Jelajahi Kategori</h2>
                    <p class="fs-6 text-gray-600 mb-0 mw-500px">
                        Pilih jalur belajar yang sesuai dengan minat dan program studimu.
                    </p>
                </div>
                <a href="#" class="btn btn-light-primary btn-sm fw-bold">
                    Lihat semua kategori
                    <i class="bi bi-arrow-right-short ms-1"></i>
                </a>
            </div>

            <div class="row g-5 g-xl-8">
                @forelse($categories as $category)
                    <div class="col-6 col-md-4 col-xl-3">
                        <a href="{{ route('kursus.index', ['filter_kategori' => $category->id_kategori]) }}"
                            class="card h-100 text-decoration-none card-fade-in category-neo-card">
                            <div class="card-body p-6 d-flex flex-column">
                                <div class="mb-3">
                                    <h5 class="fs-5 fw-bold text-gray-900 mb-1">
                                        {{ $category->nama }}
                                    </h5>
                                    <p class="fs-7 text-gray-600 mb-0">
                                        {{ Str::limit($category->deskripsi ?? 'Jelajahi berbagai kelas dalam kategori ini.', 60) }}
                                    </p>
                                </div>
                                <div class="mt-auto d-flex align-items-center justify-content-between pt-2">
                                    <span class="text-primary fw-semibold fs-8 text-uppercase">
                                        Lihat kelas
                                    </span>
                                    <span class="category-arrow">
                                        <i class="bi bi-arrow-right-short text-primary fs-3"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-primary d-flex align-items-center p-5">
                            <i class="bi bi-info-circle fs-2x me-4"></i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1">Belum Ada Kategori</h4>
                                <span>Kategori kelas akan tersedia segera. Nantikan pembaruan berikutnya.</span>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- SEPARATOR --}}
        <div class="separator separator-dashed my-10 my-lg-15"></div>

        {{-- CTA SECTION --}}
        <div class="card border-0 shadow-sm rounded-3 card-fade-in cta-neo-card">
            <div class="card-body p-8 p-lg-12">
                <div class="row g-8 align-items-center">
                    <div class="col-lg-8">
                        <h3 class="fs-2x fw-bolder text-gray-900 mb-4">
                            Siap memulai perjalanan belajar di MOOC Universitas Nurul Jadid?
                        </h3>
                        <p class="fs-5 text-gray-700 mb-4 mw-700px">
                            Daftar dan gabung bersama ribuan pembelajar lainnya.
                            Bangun portofolio akademik dan profesionalmu melalui kelas dan sertifikat terbaik.
                        </p>

                        <div class="d-flex flex-wrap gap-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-bar-chart-line-fill fs-3 text-primary me-2"></i>
                                <span class="fw-semibold text-gray-700">
                                    Pantau progres belajar dengan dashboard pribadi.
                                </span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-star-fill fs-3 text-warning me-2"></i>
                                <span class="fw-semibold text-gray-700">
                                    Kumpulkan sertifikat untuk CV dan portofolio.
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <div class="d-flex flex-column flex-sm-row flex-lg-column gap-3 justify-content-lg-end">
                            <a href="{{ route('daftar') }}" class="btn btn-primary btn-lg fw-bold">
                                <i class="bi bi-person-plus fs-3 me-2"></i>
                                Daftar Sekarang
                            </a>
                            <a href="{{ route('kursus.index') }}" class="btn btn-dark btn-lg fw-bold">
                                <i class="bi bi-collection-play fs-3 me-2"></i>
                                Jelajahi Kelas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- MODAL PREVIEW KURSUS --}}
    <div class="modal fade" id="coursePreviewModal" tabindex="-1" aria-labelledby="coursePreviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="coursePreviewModalLabel">Preview Kursus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe id="coursePreviewIframe" src="" title="Course Preview" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        @if(session()->has('successlogin'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{session()->get('successlogin')}}",
                timer: 1500,
                showConfirmButton: false
            });
        @endif

        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId.length > 1) {
                    const target = document.querySelector(targetId);
                    if (target) {
                        e.preventDefault();

                        const headerOffset = 120;
                        const elementPosition = target.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        const previewModalEl = document.getElementById('coursePreviewModal');
        const previewIframe = document.getElementById('coursePreviewIframe');
        const previewTitleEl = document.getElementById('coursePreviewModalLabel');

        function getYoutubeEmbedUrl(url) {
            if (!url) return '';

            if (url.includes('youtube.com/embed')) {
                return url.includes('?') ? url + '&autoplay=1' : url + '?autoplay=1';
            }

            let embedUrl = url;

            try {
                const parsed = new URL(url);

                if (parsed.hostname.includes('youtu.be')) {
                    const videoId = parsed.pathname.replace('/', '');
                    embedUrl = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';
                }

                if (parsed.hostname.includes('youtube.com')) {
                    const videoId = parsed.searchParams.get('v');
                    if (videoId) {
                        embedUrl = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';
                    }
                }
            } catch (e) {
                embedUrl = url;
            }

            return embedUrl;
        }

        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('.course-preview-trigger[data-video-url]');
            if (!trigger) return;

            e.preventDefault();

            const videoUrl = trigger.getAttribute('data-video-url');
            const courseName = trigger.getAttribute('data-course-title') || 'Preview Kursus';

            if (!videoUrl || !previewModalEl || !previewIframe) return;

            const embedUrl = getYoutubeEmbedUrl(videoUrl);
            previewIframe.src = embedUrl;

            if (previewTitleEl) {
                previewTitleEl.textContent = courseName;
            }

            const modalInstance = bootstrap.Modal.getOrCreateInstance(previewModalEl);
            modalInstance.show();
        });

        if (previewModalEl) {
            previewModalEl.addEventListener('hidden.bs.modal', function() {
                if (previewIframe) {
                    previewIframe.src = '';
                }
            });
        }
    </script>
@endsection