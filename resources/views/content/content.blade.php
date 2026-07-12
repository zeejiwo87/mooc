@extends('content.layouts')

@section('css')
    <style>
        :root {
            --mooc-soft-blue: #eaf5ff;
            --mooc-soft-indigo: #eef2ff;
            --mooc-soft-yellow: #fff7df;
            --mooc-border: #e5e7eb;
            --mooc-dark: #0f172a;
            --mooc-muted: #64748b;
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

        .course-card {
            border: 1px solid rgba(226, 232, 240, 0.95) !important;
            border-radius: 1.35rem !important;
            overflow: hidden;
            background: #ffffff;
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        }

        .course-card:hover {
            transform: translateY(-5px);
            border-color: rgba(13, 110, 253, 0.30) !important;
            box-shadow: 0 22px 55px rgba(15, 23, 42, .10);
        }

        .modal-content {
            border: 0;
            border-radius: 1.35rem;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.22);
        }

        .modal-header {
            border-bottom: 1px solid var(--gray-200);
            padding: 1rem 1.25rem;
            background: #ffffff;
        }

        .modal-title {
            font-weight: 800;
            color: var(--mooc-dark);
        }

        /* =========================
           HERO SECTION CUSTOM
        ==========================*/
        .hero-card {
            background:
                linear-gradient(135deg, rgba(234, 245, 255, 0.96) 0%, rgba(238, 242, 255, 0.98) 48%, rgba(255, 247, 223, 0.90) 100%);
            border-radius: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.85);
            box-shadow: 0 25px 70px rgba(15, 23, 42, 0.08);
            position: relative;
            overflow: hidden;
        }

        .hero-card::before {
            content: "";
            position: absolute;
            width: 340px;
            height: 340px;
            border-radius: 50%;
            top: -130px;
            right: -120px;
            background:
                radial-gradient(circle, rgba(13, 110, 253, 0.20), rgba(13, 110, 253, 0.04) 58%, transparent 70%);
            pointer-events: none;
        }

        .hero-card::after {
            content: "";
            position: absolute;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            background:
                radial-gradient(circle, rgba(244, 163, 7, 0.22), rgba(244, 163, 7, 0.05) 58%, transparent 70%);
            bottom: -160px;
            left: -150px;
            pointer-events: none;
        }

        .hero-card .card-body {
            position: relative;
            z-index: 1;
        }

        .hero-kicker {
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            padding: .55rem .9rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.74);
            border: 1px solid rgba(255, 255, 255, 0.95);
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.07);
            color: var(--mooc-dark);
        }

        .hero-kicker-dot {
            width: .55rem;
            height: .55rem;
            border-radius: 999px;
            background: var(--bs-primary);
            box-shadow: 0 0 0 .35rem rgba(13, 110, 253, .12);
        }

        .hero-heading {
            letter-spacing: -0.035em;
        }

        .hero-subtext {
            max-width: 650px;
            line-height: 1.75;
        }

        .hero-highlight-card {
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(255, 255, 255, 0.95);
            border-radius: 1.15rem;
            padding: .85rem 1rem;
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.06);
        }

        .hero-highlight-icon {
            width: 2.35rem;
            height: 2.35rem;
            border-radius: .9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            flex: 0 0 auto;
        }

        .hero-search {
            border-radius: 1.15rem;
            background-color: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
            padding: .45rem;
        }

        .hero-search .input-group-text {
            background: transparent;
            border: 0;
            padding-left: 1rem;
        }

        .hero-search .form-control {
            border: 0;
            background: transparent;
            box-shadow: none !important;
            color: var(--mooc-dark);
        }

        .hero-search .form-control::placeholder {
            color: #94a3b8;
        }

        .hero-search .form-control:focus {
            background: transparent;
        }

        .hero-search .btn {
            border-radius: .95rem;
            min-height: 46px;
        }

        .hero-quick-label {
            font-size: .82rem;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .hero-quick-btn {
            border-radius: 999px !important;
            border: 1px solid rgba(226, 232, 240, 0.9) !important;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
        }

        .hero-feature-area {
            position: relative;
            min-height: 360px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-feature-area::before {
            content: "";
            position: absolute;
            width: 330px;
            height: 330px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(13, 110, 253, 0.12), transparent 68%);
            top: 5px;
            right: 20px;
            pointer-events: none;
        }

        .hero-feature-stack {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            display: flex;
            flex-direction: column;
            gap: 1.15rem;
        }

        .hero-feature-pill {
            display: flex;
            align-items: center;
            gap: 1rem;
            width: fit-content;
            min-width: 310px;
            padding: 1.08rem 1.45rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.84);
            border: 1px solid rgba(255, 255, 255, 0.96);
            box-shadow: 0 18px 42px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(14px);
        }

        .hero-feature-pill:nth-child(2) {
            margin-left: 2.8rem;
        }

        .hero-feature-pill:nth-child(3) {
            margin-left: 1rem;
        }

        .hero-feature-dot {
            width: .62rem;
            height: .62rem;
            border-radius: .15rem;
            border: 1.5px solid var(--bs-primary);
            background: rgba(255, 255, 255, 0.85);
            flex: 0 0 auto;
        }

        .hero-feature-text {
            font-size: .96rem;
            font-weight: 700;
            color: #334155;
            white-space: nowrap;
        }

        .section-panel {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 1.75rem;
            padding: 2rem;
            box-shadow: 0 16px 50px rgba(15, 23, 42, 0.045);
        }

        .section-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .35rem .75rem;
            border-radius: 999px;
            background: var(--mooc-soft-blue);
            color: var(--bs-primary);
            font-size: .78rem;
            font-weight: 800;
            letter-spacing: .06em;
            text-transform: uppercase;
            margin-bottom: .85rem;
        }

        .section-title {
            letter-spacing: -0.025em;
        }

        .section-action {
            border-radius: 999px !important;
            padding-inline: 1.1rem;
        }

        .mooc-separator {
            height: 1px;
            border: 0;
            background:
                linear-gradient(90deg, transparent, rgba(148, 163, 184, 0.35), transparent);
            margin: 3.5rem 0;
        }

        .category-card {
            border-radius: 1.4rem;
            border: 1px solid rgba(226, 232, 240, 0.96);
            background:
                linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
            box-shadow: 0 14px 38px rgba(15, 23, 42, 0.045);
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease, background .18s ease;
            overflow: hidden;
            position: relative;
        }

        .category-card::before {
            content: "";
            position: absolute;
            width: 110px;
            height: 110px;
            border-radius: 999px;
            background: rgba(13, 110, 253, 0.08);
            top: -55px;
            right: -42px;
            transition: transform .18s ease, background .18s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
            border-color: rgba(13, 110, 253, 0.30);
            background: #ffffff;
            box-shadow: 0 22px 55px rgba(15, 23, 42, 0.10);
        }

        .category-card:hover::before {
            transform: scale(1.15);
            background: rgba(13, 110, 253, 0.13);
        }

        .category-icon {
            width: 2.7rem;
            height: 2.7rem;
            border-radius: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--mooc-soft-blue);
            color: var(--bs-primary);
            position: relative;
            z-index: 1;
        }

        .category-arrow {
            width: 2rem;
            height: 2rem;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--mooc-soft-blue);
            transition: transform .18s ease, background .18s ease;
        }

        .category-card:hover .category-arrow {
            transform: translateX(3px);
            background: rgba(13, 110, 253, 0.14);
        }

        .empty-category-state {
            border: 1px dashed rgba(13, 110, 253, 0.35);
            border-radius: 1.35rem;
            background: linear-gradient(135deg, #f8fbff, #eef6ff);
        }

        @media (max-width: 991.98px) {
            .hero-card {
                border-radius: 1.6rem;
                box-shadow: 0 18px 44px rgba(15, 23, 42, 0.07);
            }

            .hero-card::before,
            .hero-card::after {
                opacity: 0.65;
            }

            .hero-feature-area {
                min-height: auto;
                justify-content: flex-start;
                margin-top: 1rem;
            }

            .hero-feature-stack {
                max-width: 100%;
            }

            .hero-feature-pill,
            .hero-feature-pill:nth-child(2),
            .hero-feature-pill:nth-child(3) {
                width: 100%;
                min-width: 0;
                margin-left: 0;
            }

            .hero-feature-text {
                white-space: normal;
            }

            .section-panel {
                border-radius: 1.45rem;
                padding: 1.5rem;
            }
        }

        @media (max-width: 575.98px) {
            .hero-card {
                border-radius: 1.35rem;
            }

            .hero-card .card-body {
                padding: 2rem !important;
            }

            .hero-search {
                border-radius: 1rem;
                box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
            }

            .hero-search .btn {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .section-panel {
                padding: 1.25rem;
            }

            .category-card .card-body {
                padding: 1.25rem !important;
            }
        }
    </style>
@endsection

@section('content')
    <div class="mb-10 mb-xl-15 mooc-page-shell">

        {{-- HERO SECTION --}}
        <div class="card hero-card border-0 mb-10 mb-lg-15">
            <div class="card-body p-10 p-lg-15">
                <div class="row g-10 align-items-center">
                    <div class="col-lg-7">
                        {{-- Heading --}}
                        <h1 class="fw-bolder mb-5 fs-2x fs-lg-1x lh-sm hero-heading text-gray-900">
                            Belajar Tanpa Batas,<br>
                            <span class="fw-bold text-primary">Kapan Saja, Di Mana Saja</span>
                        </h1>

                        {{-- Sub copy --}}
                        <p class="fs-5 fw-semibold text-gray-600 mb-7 hero-subtext">
                            Platform pembelajaran daring dengan akses ke materi berkualitas,
                            sistem penilaian otomatis, dan sertifikat digital yang diakui.
                        </p>

                        {{-- Highlight info bar --}}
                        <div class="row g-4 mb-7">
                            <div class="col-sm-6">
                                <div class="hero-highlight-card d-flex align-items-center h-100">
                                    <span class="hero-highlight-icon me-3">
                                        <i class="bi bi-check-circle-fill fs-3 text-success"></i>
                                    </span>
                                    <div>
                                        <div class="fw-bolder text-gray-900">Akses Fleksibel</div>
                                        <div class="fs-8 text-gray-600">Belajar kapan saja</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="hero-highlight-card d-flex align-items-center h-100">
                                    <span class="hero-highlight-icon me-3">
                                        <i class="bi bi-shield-check fs-3 text-info"></i>
                                    </span>
                                    <div>
                                        <div class="fw-bolder text-gray-900">Sertifikat Resmi</div>
                                        <div class="fs-8 text-gray-600">Diakui oleh kampus</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Search Form --}}
                        <form action="{{ route('kursus.index') }}" method="GET" class="mb-7">
                            <div class="input-group input-group-lg hero-search">
                                <span class="input-group-text">
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
                            <div class="form-text text-gray-500 mt-3 ps-1">
                                Tips: coba ketik nama mata kuliah, dosen, atau topik yang ingin kamu kuasai.
                            </div>
                        </form>

                        {{-- Quick Links --}}
                        <div class="d-flex flex-wrap gap-3 align-items-center">
                            <span class="text-gray-700 fw-semibold d-flex align-items-center hero-quick-label">
                                <i class="bi bi-lightning-charge-fill text-warning fs-3 me-2"></i>
                                Mulai cepat:
                            </span>
                            <a href="#kategori" class="btn btn-sm btn-light btn-active-light-primary fw-bold hero-quick-btn">
                                <i class="bi bi-grid-3x3-gap me-1"></i> Kategori
                            </a>
                            <a href="#kelas-baru" class="btn btn-sm btn-primary btn-active-primary fw-bold hero-quick-btn">
                                <i class="bi bi-fire me-1"></i> Kelas baru
                            </a>
                        </div>
                    </div>

                    {{-- Hero Right Text List --}}
                    <div class="col-lg-5">
                        <div class="hero-feature-area">
                            <div class="hero-feature-stack">
                                <div class="hero-feature-pill">
                                    <span class="hero-feature-dot"></span>
                                    <span class="hero-feature-text">Lanjutkan belajar kapan pun kamu mau</span>
                                </div>

                                <div class="hero-feature-pill">
                                    <span class="hero-feature-dot"></span>
                                    <span class="hero-feature-text">Progres belajar tersimpan otomatis</span>
                                </div>

                                <div class="hero-feature-pill">
                                    <span class="hero-feature-dot"></span>
                                    <span class="hero-feature-text">Sertifikat digital siap diunduh</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KELAS BARU --}}
        <div id="kelas-baru" class="section-panel mb-10 mb-lg-15">
            <div class="d-flex flex-wrap align-items-end justify-content-between gap-5 mb-8">
                <div>
                    <div class="section-eyebrow">
                        <i class="bi bi-stars"></i>
                        Kelas pilihan
                    </div>
                    <h2 class="fs-2x fw-bolder text-gray-900 mb-2 section-title">Kelas Terbaru</h2>
                    <p class="fs-6 text-gray-600 mb-0 mw-500px">
                        Rekomendasi kelas yang sedang banyak diikuti oleh mahasiswa dan dosen Universitas Nurul Jadid.
                    </p>
                </div>
                <a href="{{ route('kursus.index') }}" class="btn btn-primary btn-sm fw-bold section-action">
                    Lihat semua kelas
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

            <div class="row g-5 g-xl-8">
                @include('content.kursus._courses_list', ['kursus' => $baruClasses])
            </div>
        </div>

        {{-- SEPARATOR --}}
        <div class="mooc-separator"></div>

        {{-- KATEGORI --}}
        <div id="kategori" class="section-panel mb-10 mb-lg-15">
            <div class="d-flex flex-wrap align-items-end justify-content-between gap-5 mb-8">
                <div>
                    <div class="section-eyebrow">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        Jalur belajar
                    </div>
                    <h2 class="fs-2x fw-bolder text-gray-900 mb-2 section-title">Jelajahi Kategori</h2>
                    <p class="fs-6 text-gray-600 mb-0 mw-500px">
                        Pilih jalur belajar yang sesuai dengan minat dan program studimu.
                    </p>
                </div>
                <a href="#" class="btn btn-light-primary btn-sm fw-bold section-action">
                    Lihat semua kategori
                    <i class="bi bi-arrow-right-short ms-1"></i>
                </a>
            </div>

            <div class="row g-5 g-xl-8">
                @forelse($categories as $category)
                    <div class="col-6 col-md-4 col-xl-3">
                        <a href="{{ route('kursus.index', ['filter_kategori' => $category->id_kategori]) }}"
                            class="card category-card h-100 text-decoration-none card-fade-in">
                            <div class="card-body p-6 d-flex flex-column position-relative">
                                <div class="category-icon mb-4">
                                    <i class="bi bi-journal-bookmark-fill fs-3"></i>
                                </div>

                                <div class="mb-4 position-relative">
                                    <h5 class="fs-5 fw-bolder text-gray-900 mb-2">
                                        {{ $category->nama }}
                                    </h5>
                                    <p class="fs-7 text-gray-600 mb-0 lh-lg">
                                        {{ Str::limit($category->deskripsi ?? 'Jelajahi berbagai kelas dalam kategori ini.', 60) }}
                                    </p>
                                </div>

                                <div class="mt-auto d-flex align-items-center justify-content-between pt-2 position-relative">
                                    <span class="text-primary fw-bold fs-8 text-uppercase">
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
                        <div class="empty-category-state d-flex align-items-center p-6">
                            <div class="symbol symbol-50px me-4">
                                <div class="symbol-label bg-light-primary">
                                    <i class="bi bi-info-circle fs-2x text-primary"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 fw-bolder text-gray-900">Belum Ada Kategori</h4>
                                <span class="text-gray-600">Kategori kelas akan tersedia segera. Nantikan pembaruan berikutnya.</span>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- SEPARATOR --}}
        <div class="mooc-separator"></div>
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