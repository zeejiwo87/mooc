<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="X-CSRF-TOKEN" content="{{ csrf_token() }}">
    <title>Course Playing - {{ $pendaftaran->kelas_judul ?? 'Kelas' }}</title>

    <script>
        (() => {
            const isNoise = (args = []) => {
                const text = args.map((v) => {
                    if (typeof v === 'string') return v;
                    if (v && typeof v === 'object' && 'message' in v) return v.message;
                    return '';
                }).join(' ');

                return [
                    'cdn.tailwindcss.com should not be used in production',
                    'ERR_BLOCKED_BY_CLIENT',
                    'youtubei/v1/log_event',
                    'pagead/viewthroughconversion',
                    'play.google.com/log'
                ].some((pattern) => text.includes(pattern));
            };

            const originalWarn = console.warn;
            const originalError = console.error;

            console.warn = function (...args) {
                if (isNoise(args)) return;
                return originalWarn.apply(console, args);
            };

            console.error = function (...args) {
                if (isNoise(args)) return;
                return originalError.apply(console, args);
            };
        })();
    </script>

    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            600: '#009ef7',
                            700: '#0085d1',
                            800: '#0071b5',
                            900: '#005f99',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        };
    </script>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap');

    :root {
        --cp-primary: #009ef7;
        --cp-primary-dark: #008bd8;
        --cp-primary-soft: #eaf6ff;
        --cp-bg: #f8fafc;
        --cp-surface: #ffffff;
        --cp-soft: #f1f5f9;
        --cp-border: #e5e7eb;
        --cp-text: #111827;
        --cp-muted: #64748b;
        --cp-success: #22c55e;
        --cp-danger: #ef4444;
        --cp-warning: #f59e0b;
    }

    * {
        -webkit-tap-highlight-color: transparent;
    }

    html {
        scroll-behavior: smooth;
    }

    body.neo-course-player {
        margin: 0;
        background: var(--cp-bg) !important;
        color: var(--cp-text);
        font-family: 'Poppins', Inter, ui-sans-serif, system-ui, sans-serif;
        letter-spacing: -0.01em;
    }

    .neo-container {
        width: min(1240px, calc(100% - 32px));
        margin-left: auto;
        margin-right: auto;
    }

    .neo-card,
    .neo-card-soft,
    .neo-inset {
        border: 1px solid var(--cp-border) !important;
        background: var(--cp-surface) !important;
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.055) !important;
    }

    .neo-card {
        border-radius: 22px;
    }

    .neo-card-soft,
    .neo-inset {
        border-radius: 16px;
    }

    .neo-inset {
        background: var(--cp-bg) !important;
        box-shadow: none !important;
    }

    .neo-btn,
    .neo-btn-primary {
        min-height: 40px;
        border-radius: 12px !important;
        font-weight: 800 !important;
        transition: .18s ease;
        box-shadow: none !important;
    }

    .neo-btn {
        border: 1px solid var(--cp-border) !important;
        background: #ffffff !important;
        color: var(--cp-text) !important;
    }

    .neo-btn:hover:not(:disabled) {
        color: var(--cp-primary) !important;
        background: var(--cp-primary-soft) !important;
        border-color: rgba(0, 158, 247, 0.24) !important;
        transform: translateY(-1px);
    }

    .neo-btn-primary {
        border: 0 !important;
        background: var(--cp-primary) !important;
        color: #ffffff !important;
        box-shadow: 0 12px 26px rgba(0, 158, 247, 0.20) !important;
    }

    .neo-btn-primary:hover:not(:disabled) {
        background: var(--cp-primary-dark) !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    .neo-btn:disabled,
    .neo-btn-primary:disabled {
        opacity: .55;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    .neo-navbar {
        background: rgba(255, 255, 255, 0.94) !important;
        backdrop-filter: blur(16px);
        border-bottom: 1px solid var(--cp-border) !important;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.045);
    }

    .neo-navbar h1 {
        color: var(--cp-text);
        font-weight: 900;
        letter-spacing: -0.035em;
        line-height: 1.15;
    }

    .neo-navbar p {
        color: var(--cp-muted);
        font-weight: 500;
    }

    .neo-hero {
        margin-top: 18px;
        overflow: hidden;
    }

    .neo-hero-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(420px, .9fr);
        gap: 18px;
        align-items: stretch;
    }

    .neo-progress-track {
        height: 10px;
        border-radius: 999px;
        overflow: hidden;
        background: var(--cp-soft);
    }

    .neo-progress-fill {
        height: 100%;
        border-radius: 999px;
        background: var(--cp-primary);
        transition: width .45s ease;
    }

    .neo-badge {
        border: 1px solid var(--cp-border);
        border-radius: 999px;
        background: #ffffff;
        color: var(--cp-muted);
    }

    .neo-main {
        padding-top: 18px;
        padding-bottom: 32px;
    }

    .neo-grid {
        display: grid;
        grid-template-columns: 360px minmax(0, 1fr);
        gap: 18px;
        align-items: start;
    }

    .neo-sidebar-wrap {
        position: relative;
        top: auto;
        height: auto;
    }

    .neo-sidebar-card {
        overflow: hidden;
    }

    .neo-sidebar-header,
    .neo-player-header {
        border-bottom: 1px solid var(--cp-border);
        background: transparent;
    }

    #sidebarList {
        background: transparent;
        max-height: none;
        overflow: visible;
    }

    #sidebarSummary {
        border-radius: 12px;
        background: var(--cp-primary);
        color: #ffffff;
        box-shadow: none;
    }

    .accordion-toggle {
        border: 0 !important;
        background: transparent !important;
        border-radius: 14px !important;
    }

    .accordion-toggle:hover {
        background: var(--cp-bg) !important;
    }

    .section-wrapper {
        border: 1px solid var(--cp-border) !important;
        border-radius: 16px;
        background: #ffffff !important;
        overflow: hidden;
    }

    button[data-progres] {
        border: 1px solid var(--cp-border) !important;
        border-radius: 14px !important;
        background: #ffffff !important;
        color: var(--cp-text) !important;
        box-shadow: none !important;
        transition: .18s ease;
    }

    button[data-progres]:hover {
        background: var(--cp-bg) !important;
        transform: translateY(-1px);
    }

    button[data-progres].is-active {
        color: var(--cp-primary) !important;
        background: var(--cp-primary-soft) !important;
        border-color: rgba(0, 158, 247, 0.24) !important;
    }

    .neo-player-card {
        min-height: 620px;
        overflow: hidden;
    }

    #materiTitle {
        color: var(--cp-text);
        font-weight: 900;
        letter-spacing: -0.035em;
        line-height: 1.2;
    }

    #materiMeta span {
        border: 1px solid var(--cp-border) !important;
        border-radius: 999px !important;
        background: #ffffff !important;
        color: var(--cp-muted) !important;
    }

    #materiContent {
        background: transparent !important;
    }

    .materi-prose {
        padding: 26px;
        border-radius: 18px;
        background: #ffffff;
        border: 1px solid var(--cp-border);
        box-shadow: none;
    }

    .neo-empty-content {
        min-height: 450px;
    }

    iframe,
    video {
        border: 1px solid var(--cp-border) !important;
        border-radius: 18px !important;
        box-shadow: none !important;
    }

    .video-lock-card,
    .exam-lock-card {
        border: 1px solid var(--cp-border) !important;
        border-radius: 20px !important;
        background: #ffffff !important;
        box-shadow: none !important;
        overflow: hidden;
    }

    .video-lock-player {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 9;
        border-radius: 18px;
        overflow: hidden;
        background: #111827;
    }

    .video-lock-player iframe,
    .video-lock-player video {
        width: 100% !important;
        height: 100% !important;
        border-radius: 18px !important;
    }

    .video-lock-control {
        border: 1px solid var(--cp-border) !important;
        border-radius: 12px !important;
        background: #ffffff !important;
        color: var(--cp-text) !important;
        font-weight: 800 !important;
        box-shadow: none !important;
        transition: .18s ease;
    }

    .video-lock-control:hover:not(:disabled) {
        color: var(--cp-primary) !important;
        background: var(--cp-primary-soft) !important;
        border-color: rgba(0, 158, 247, 0.24) !important;
        transform: translateY(-1px);
    }

    .video-lock-control:disabled {
        opacity: .55;
        cursor: not-allowed;
    }

    .video-lock-status,
    .exam-lock-warning {
        border: 1px solid var(--cp-border) !important;
        border-radius: 16px;
        background: var(--cp-bg);
        box-shadow: none;
    }

    .exam-lock-pulse {
        animation: examPulse 1.8s ease-in-out infinite;
    }

    @keyframes examPulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.06);
            opacity: .82;
        }
    }

    .quiz-question {
        border: 1px solid var(--cp-border) !important;
        border-radius: 18px !important;
        background: #ffffff !important;
        box-shadow: none !important;
    }

    .quiz-option-card {
        border: 1px solid var(--cp-border) !important;
        border-radius: 14px !important;
        background: #ffffff !important;
        box-shadow: none !important;
        transition: .18s ease;
    }

    .quiz-option-card:hover {
        background: var(--cp-bg) !important;
    }

    .quiz-option-card.is-selected {
        color: var(--cp-primary) !important;
        background: var(--cp-primary-soft) !important;
        border-color: rgba(0, 158, 247, 0.28) !important;
    }

    .quiz-option-card.is-correct {
        color: #047857 !important;
        background: #ecfdf5 !important;
        border-color: rgba(34, 197, 94, 0.28) !important;
    }

    .quiz-option-card.is-wrong {
        color: #b91c1c !important;
        background: #fef2f2 !important;
        border-color: rgba(239, 68, 68, 0.28) !important;
    }

    .quiz-review-badge {
        border-radius: 999px;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 900;
        white-space: nowrap;
    }

    .quiz-review-badge.correct {
        background: #dcfce7;
        color: #047857;
    }

    .quiz-review-badge.wrong {
        background: #fee2e2;
        color: #b91c1c;
    }

    .quiz-review-badge.neutral {
        background: #e0f2fe;
        color: #0369a1;
    }

    .swal2-popup {
        border-radius: 20px !important;
        background: #ffffff !important;
        box-shadow: 0 24px 70px rgba(15, 23, 42, 0.14) !important;
    }

    .swal2-confirm,
    .swal2-cancel {
        border-radius: 12px !important;
        font-weight: 800 !important;
    }

    @media (min-width: 1280px) {
        .neo-player-card {
            min-height: 650px;
        }
    }

    @media (max-width: 1199.98px) {
        .neo-hero-grid {
            grid-template-columns: 1fr;
        }

        .neo-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 1023.98px) {
        .neo-container {
            width: calc(100% - 20px);
        }

        .neo-card {
            border-radius: 20px;
        }

        #sidebarPanel {
            display: block !important;
            overflow: hidden;
            max-height: 0;
            opacity: 0;
            transform: translateY(-8px);
            pointer-events: none;
            transition:
                max-height .42s ease,
                opacity .28s ease,
                transform .32s ease,
                margin .32s ease;
            margin-bottom: 0;
        }

        #sidebarPanel.is-open {
            max-height: 1300px;
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
            margin-bottom: 14px;
        }

        #sidebarList {
            max-height: 62vh;
            overflow-y: auto;
        }

        .neo-player-card {
            min-height: auto;
        }
    }

    @media (max-width: 640px) {
        .neo-container {
            width: calc(100% - 14px);
        }

        .neo-card {
            border-radius: 18px;
        }

        .neo-player-header .action-buttons {
            width: 100%;
        }

        .neo-player-header .action-buttons button {
            width: 100%;
        }

        .materi-prose {
            padding: 18px;
            border-radius: 16px;
        }

        .neo-empty-content {
            min-height: 380px;
        }

        .video-lock-player,
        .video-lock-player iframe,
        .video-lock-player video,
        iframe,
        video {
            border-radius: 16px !important;
        }
    }
</style>
</head>

<body class="neo-course-player min-h-screen font-sans text-gray-900 antialiased text-[15px] md:text-base">
    @php
        $kelasJudul = $pendaftaran->kelas_judul ?? 'Kelas';
        $progressPersen = (float) ($pendaftaran->persentase_progres ?? 0);
        $status = $pendaftaran->status ?? 'aktif';
    @endphp

    <header class="neo-navbar sticky top-0 z-50">
        <div class="neo-container">
            <div class="flex flex-wrap items-center justify-between gap-3 py-3">
                <div>
                    <h1 class="text-base md:text-lg">{{ $kelasJudul }}</h1>
                    <p class="text-[11px] md:text-xs">Pembelajaran online interaktif</p>
                </div>

                <a href="{{ route('pengguna.kelas_saya') }}"
                    class="neo-btn px-4 py-2 text-xs sm:text-sm transition">
                    Kembali
                </a>
            </div>
        </div>
    </header>

    <section class="neo-container neo-card neo-hero">
        <div class="px-4 sm:px-5 lg:px-6 py-5">
            <div class="neo-hero-grid">
                <div class="neo-inset p-4 md:p-5 flex flex-col justify-center">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs text-gray-500 font-semibold mb-1">Progres Pembelajaran</p>
                            <h2 class="text-xl md:text-2xl font-black tracking-tight text-gray-900">
                                Tetap semangat, kamu hampir sampai!
                            </h2>
                            <p class="text-xs md:text-sm text-gray-500 mt-2">
                                Lanjutkan materi secara berurutan agar progres pembelajaran tetap rapi.
                            </p>
                        </div>

                        <span id="heroProgressLabel"
                            class="neo-card-soft text-sm font-black px-3 py-2 text-primary-600 whitespace-nowrap">
                            {{ number_format($progressPersen, 1) }}%
                        </span>
                    </div>

                    <div class="neo-progress-track mt-4">
                        <div id="heroProgressBar" class="neo-progress-fill"
                            style="width: {{ $progressPersen }}%;"></div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2 text-xs mt-4">
                        <span class="neo-badge inline-flex items-center gap-1.5 px-3 py-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            Pembelajaran aktif
                        </span>

                        <span class="neo-badge inline-flex items-center gap-1.5 px-3 py-1.5">
                            <span class="w-2 h-2 rounded-full bg-sky-400"></span>
                            Progres tersimpan otomatis
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div class="neo-inset p-4 flex flex-col justify-between min-h-[128px]">
                        <p class="text-[11px] text-gray-500 font-semibold">Status</p>
                        <div>
                            <div class="text-base font-black text-primary-600 capitalize">{{ $status }}</div>
                            <p class="text-[11px] text-gray-500 mt-1">Kelas aktif</p>
                        </div>
                    </div>

                    <div class="neo-inset p-4 flex flex-col justify-between min-h-[128px]">
                        <p class="text-[11px] text-gray-500 font-semibold">Total Materi</p>
                        <div>
                            <div id="heroTotalMateri" class="text-lg font-black text-primary-600">-</div>
                            <p class="text-[11px] text-gray-500 mt-1">Materi tersedia</p>
                        </div>
                    </div>

                    <div class="neo-inset p-4 flex flex-col justify-between min-h-[128px]">
                        <p class="text-[11px] text-gray-500 font-semibold">Selesai</p>
                        <div>
                            <div id="heroMateriSelesai" class="text-lg font-black text-primary-600">-</div>
                            <p class="text-[11px] text-gray-500 mt-1">Materi terselesaikan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="neo-container neo-main">
        <div class="neo-grid">
            <aside class="neo-sidebar-wrap">
                <button id="toggleSidebarBtn"
                    class="neo-btn-primary w-full mb-3 lg:hidden px-4 py-2.5 text-sm flex items-center justify-between">
                    <span>Daftar Materi</span>
                    <svg class="w-4 h-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div id="sidebarPanel" class="neo-card neo-sidebar-card">
                    <div class="neo-sidebar-header px-4 py-4 flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-black text-gray-900">Daftar Materi</h2>
                            <p class="text-[11px] text-gray-500 mt-0.5">Urutkan fokus belajarmu</p>
                        </div>

                        <div id="sidebarSummary"
                            class="w-10 h-10 flex items-center justify-center text-[11px] font-black">
                            -
                        </div>
                    </div>

                    <div id="sidebarList" class="p-3 md:p-3.5">
                        <div class="py-5 text-center">
                            <div
                                class="mx-auto w-8 h-8 border-4 border-gray-300 border-t-primary-600 rounded-full animate-spin mb-2">
                            </div>
                            <p class="text-xs text-gray-500">Memuat materi...</p>
                        </div>
                    </div>
                </div>
            </aside>

            <section class="neo-card neo-player-card">
                <div class="neo-player-header px-4 md:px-5 py-4">
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <h3 id="materiTitle" class="text-lg md:text-xl mb-1">
                                Pilih materi untuk mulai
                            </h3>

                            <div id="materiMeta" class="flex flex-wrap items-center gap-1.5 text-[11px]">
                                <span class="px-2.5 py-1 font-bold">-</span>
                            </div>
                        </div>

                        <div class="action-buttons flex flex-col sm:flex-row flex-wrap gap-2 lg:justify-end w-full lg:w-auto">
                            <button id="prevBtn"
                                class="neo-btn px-4 py-2 text-[11px] sm:text-xs disabled:opacity-50"
                                disabled>
                                Sebelumnya
                            </button>

                            <button id="nextBtn"
                                class="neo-btn px-4 py-2 text-[11px] sm:text-xs disabled:opacity-50"
                                disabled>
                                Berikutnya
                            </button>

                            <button id="markDoneBtn"
                                class="neo-btn-primary px-5 py-2 text-[11px] sm:text-xs disabled:opacity-50"
                                disabled>
                                Tandai Selesai
                            </button>
                        </div>
                    </div>
                </div>

                <div id="materiContent" class="p-4 md:p-5">
                    <div class="neo-inset neo-empty-content flex flex-col items-center justify-center text-center p-6">
                        <div class="w-14 h-14 rounded-full neo-card-soft flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>

                        <h4 class="text-sm font-black text-gray-900 mb-1">Belum ada materi dipilih</h4>
                        <p class="text-xs text-gray-500">Pilih materi dari daftar di sebelah kiri untuk memulai pembelajaran.</p>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        (() => {
            const pendaftaranToken = '{{ $pendaftaranToken ?? '' }}';
            const csrf = document.querySelector('meta[name="X-CSRF-TOKEN"]')?.content;

            const routes = {
                menu: "{{ route('pengguna.mulai_belajar', ['token' => '__TOKEN__']) }}".replace('__TOKEN__', pendaftaranToken),
                materi: "{{ route('pengguna.materi_belajar', ['token' => '__TOKEN__', 'progress_token' => '__PROGRES__']) }}",
                update: "{{ route('pengguna.progres_kelas.update', ['token' => '__TOKEN__', 'progress_token' => '__PROGRES__']) }}",
                startQuiz: "{{ route('pengguna.kuis.mulai', ['token' => '__TOKEN__', 'progress_token' => '__PROGRES__']) }}",
                submitQuiz: "{{ route('pengguna.kuis.submit', ['token' => '__TOKEN__', 'progress_token' => '__PROGRES__']) }}",
                rating: "{{ route('pengguna.kelas_saya.rating', ['token' => '__TOKEN__']) }}".replace('__TOKEN__', pendaftaranToken),
                sertifikat: "{{ route('pengguna.sertifikat', ['token' => '__TOKEN__']) }}".replace('__TOKEN__', pendaftaranToken),
                logout: "{{ route('logout') }}",
            };

            const els = {
                sidebar: document.getElementById('sidebarList'),
                sidebarSummary: document.getElementById('sidebarSummary'),
                materiTitle: document.getElementById('materiTitle'),
                materiMeta: document.getElementById('materiMeta'),
                materiContent: document.getElementById('materiContent'),
                sidebarPanel: document.getElementById('sidebarPanel'),
                toggleSidebarBtn: document.getElementById('toggleSidebarBtn'),
                heroProgressBar: document.getElementById('heroProgressBar'),
                heroProgressLabel: document.getElementById('heroProgressLabel'),
                heroTotalMateri: document.getElementById('heroTotalMateri'),
                heroMateriSelesai: document.getElementById('heroMateriSelesai'),
                markDoneBtn: document.getElementById('markDoneBtn'),
                prevBtn: document.getElementById('prevBtn'),
                nextBtn: document.getElementById('nextBtn'),
            };

            const state = {
                progres: [],
                flatMateri: [],
                ringkasan: null,
                currentProgresId: null,
                openBagian: {},
                loadingMateri: null,
                sidebarOpen: false,
                currentNav: null,
                youtubeApiPromise: null,
                videoGuard: {
                    player: null,
                    interval: null,
                    maxAllowedTime: 0,
                    completed: false,
                    warningShown: false,
                    playerType: null,
                    videoId: '',
                    storageKey: '',
                    lastSavedAt: 0,
                },
                examLock: {
                    active: false,
                    started: false,
                    terminating: false,
                    currentProgresId: null,
                },
                quizTimer: {
                    interval: null,
                    active: false,
                    expired: false,
                    submitting: false,
                    deadlineAt: null,
                    durationSeconds: 0,
                    remainingSeconds: null,
                },
            };

            const ICON_MATERI = {
                video: `<svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
                kuis: `<svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>`,
                text: `<svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>`,
            };

            const h = (value) => String(value ?? '').replace(/[&<>"'`=\/]/g, (s) => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;',
                '`': '&#96;',
                '=': '&#61;',
                '/': '&#47;',
            }[s] || s));

            const decodeHtml = (value) => {
                const textarea = document.createElement('textarea');
                textarea.innerHTML = value ?? '';
                return textarea.value;
            };

            const safeHtml = (value) => {
                const wrapper = document.createElement('div');
                wrapper.innerHTML = decodeHtml(value ?? '');
                wrapper.querySelectorAll('script').forEach(el => el.remove());
                return wrapper.innerHTML;
            };

            const toNumber = (value, fallback = 0) => {
                const parsed = Number(value);
                return Number.isFinite(parsed) ? parsed : fallback;
            };

            const toBooleanFlag = (value) => {
                if (typeof value === 'boolean') return value;
                if (typeof value === 'number') return value !== 0;
                if (typeof value === 'string') {
                    const normalized = value.trim().toLowerCase();
                    return ['1', 'true', 'yes', 'y', 't', 'locked'].includes(normalized);
                }
                return false;
            };

            const getProgresId = (item) => item?.token || item?.id_progres_kelas;

            const showAlert = ({
                title,
                message,
                icon = 'info',
                confirmText = 'Tutup',
                confirmColor = '#0284c7'
            }) => {
                if (!window.Swal) {
                    alert(message || title);
                    return;
                }

                Swal.fire({
                    title,
                    html: `<p class="text-gray-600">${h(message || '')}</p>`,
                    icon,
                    confirmButtonText: confirmText,
                    confirmButtonColor: confirmColor
                });
            };


            async function showRatingModalAfterComplete() {
                if (!window.Swal) {
                    window.location.href = routes.sertifikat;
                    return;
                }

                const result = await Swal.fire({
                    title: 'Kelas Selesai 🎉',
                    html: `
                        <div style="text-align:left">
                            <div style="padding:14px;background:#ecfdf5;border:1px solid #a7f3d0;border-radius:14px;margin-bottom:14px">
                                <p style="font-weight:800;color:#064e3b;margin:0 0 4px">Selamat, kamu sudah menyelesaikan kelas ini.</p>
                                <p style="font-size:13px;color:#047857;margin:0">Beri rating terlebih dahulu untuk membuka sertifikat.</p>
                            </div>

                            <label style="display:block;font-size:13px;font-weight:800;color:#1f2937;margin-bottom:8px">Rating kelas</label>

                            <div id="ratingStarsWrapper" style="display:grid;grid-template-columns:repeat(5,1fr);gap:8px;margin-bottom:14px">
                                ${[1, 2, 3, 4, 5].map((value) => `
                                    <button
                                        type="button"
                                        class="rating-star-btn"
                                        data-rating="${value}"
                                        style="border:1px solid #fde68a;background:#fffbeb;color:#d97706;border-radius:12px;padding:12px 6px;font-weight:900;cursor:pointer;transition:.2s">
                                        ★ ${value}
                                    </button>
                                `).join('')}
                            </div>

                            <input type="hidden" id="modalRatingValue" value="">

                            <label style="display:block;font-size:13px;font-weight:800;color:#1f2937;margin-bottom:8px">Ulasan</label>
                            <textarea
                                id="modalRatingUlasan"
                                maxlength="1000"
                                placeholder="Tulis ulasan singkat, opsional..."
                                style="width:100%;min-height:92px;border:1px solid #e5e7eb;border-radius:14px;padding:12px;font-size:13px;outline:none;resize:vertical"></textarea>
                        </div>
                    `,
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Simpan Rating',
                    cancelButtonText: 'Nanti',
                    confirmButtonColor: '#0284c7',
                    cancelButtonColor: '#6b7280',
                    reverseButtons: true,
                    allowOutsideClick: false,
                    didOpen: () => {
                        const buttons = Array.from(document.querySelectorAll('.rating-star-btn'));
                        const hiddenInput = document.getElementById('modalRatingValue');

                        buttons.forEach((btn) => {
                            btn.addEventListener('click', () => {
                                const rating = btn.dataset.rating;
                                hiddenInput.value = rating;

                                buttons.forEach((item) => {
                                    const active = Number(item.dataset.rating) <= Number(rating);
                                    item.style.background = active ? '#f59e0b' : '#fffbeb';
                                    item.style.color = active ? '#ffffff' : '#d97706';
                                    item.style.borderColor = active ? '#f59e0b' : '#fde68a';
                                });
                            });
                        });
                    },
                    preConfirm: () => {
                        const rating = document.getElementById('modalRatingValue')?.value;
                        const ulasan = document.getElementById('modalRatingUlasan')?.value || '';

                        if (!rating) {
                            Swal.showValidationMessage('Silakan pilih rating terlebih dahulu.');
                            return false;
                        }

                        return {
                            rating: Number(rating),
                            ulasan,
                        };
                    }
                });

                if (!result.isConfirmed || !result.value) {
                    return;
                }

                Swal.fire({
                    title: 'Menyimpan rating...',
                    html: '<p style="color:#6b7280">Mohon tunggu sebentar.</p>',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => Swal.showLoading(),
                });

                try {
                    const data = await fetchJson(routes.rating, {
                        method: 'POST',
                        body: JSON.stringify({
                            rating: result.value.rating,
                            ulasan: result.value.ulasan,
                        }),
                    });

                    const sertifikatUrl = data.sertifikat_url || routes.sertifikat;

                    const done = await Swal.fire({
                        title: 'Rating Tersimpan!',
                        html: `
                            <div style="text-align:center">
                                <p style="color:#4b5563;margin-bottom:14px">Terima kasih. Sertifikat kamu sekarang sudah bisa dibuka.</p>
                                <div style="padding:14px;background:#f0f9ff;border:1px solid #bae6fd;border-radius:14px">
                                    <p style="font-size:13px;font-weight:800;color:#075985;margin:0">Klik tombol di bawah untuk melihat sertifikat.</p>
                                </div>
                            </div>
                        `,
                        icon: 'success',
                        confirmButtonText: 'Lihat Sertifikat',
                        confirmButtonColor: '#16a34a',
                        allowOutsideClick: false,
                    });

                    if (done.isConfirmed) {
                        window.location.href = sertifikatUrl;
                    }
                } catch (err) {
                    console.error(err);

                    await Swal.fire({
                        title: 'Gagal Menyimpan Rating',
                        html: `<p style="color:#4b5563">${h(err.message)}</p>`,
                        icon: 'error',
                        confirmButtonText: 'Tutup',
                        confirmButtonColor: '#dc2626',
                    });
                }
            }

            const isFullscreenActive = () => Boolean(
                document.fullscreenElement ||
                document.webkitFullscreenElement ||
                document.mozFullScreenElement ||
                document.msFullscreenElement
            );

            const requestFullscreenMode = async () => {
                const root = document.documentElement;
                const request =
                    root.requestFullscreen ||
                    root.webkitRequestFullscreen ||
                    root.mozRequestFullScreen ||
                    root.msRequestFullscreen;

                if (!request) {
                    throw new Error('Browser ini belum mendukung mode fullscreen.');
                }

                await request.call(root);
            };

            const exitFullscreenMode = async () => {
                const exit =
                    document.exitFullscreen ||
                    document.webkitExitFullscreen ||
                    document.mozCancelFullScreen ||
                    document.msExitFullscreen;

                if (exit && isFullscreenActive()) {
                    await exit.call(document).catch(() => {});
                }
            };

            const resetCurrentQuizAnswers = () => {
                document.querySelectorAll('.quiz-option').forEach((input) => {
                    input.checked = false;
                });

                document.querySelectorAll('.quiz-option-card').forEach((label) => {
                    label.classList.remove('is-selected');
                });
            };

            const setExamLockUi = (isLocked) => {
                document.body.classList.toggle('exam-lock-active', isLocked);

                if (els.prevBtn) els.prevBtn.disabled = isLocked || !els.prevBtn.dataset.target;
                if (els.nextBtn) els.nextBtn.disabled = isLocked || !els.nextBtn.dataset.target;
                if (els.markDoneBtn) els.markDoneBtn.disabled = true;

                els.sidebar?.querySelectorAll('button[data-progres], .accordion-toggle').forEach((btn) => {
                    btn.disabled = isLocked;
                    btn.classList.toggle('opacity-50', isLocked);
                    btn.classList.toggle('cursor-not-allowed', isLocked);
                });

                if (els.toggleSidebarBtn) {
                    els.toggleSidebarBtn.disabled = isLocked;
                    els.toggleSidebarBtn.classList.toggle('opacity-50', isLocked);
                }
            };

            const stopExamLock = async ({ exitFullscreen = false } = {}) => {
                state.examLock.active = false;
                state.examLock.started = false;
                state.examLock.currentProgresId = null;
                setExamLockUi(false);

                if (exitFullscreen) {
                    await exitFullscreenMode();
                }
            };

            const resetQuizTimer = () => {
                if (state.quizTimer.interval) {
                    clearInterval(state.quizTimer.interval);
                }

                state.quizTimer = {
                    interval: null,
                    active: false,
                    expired: false,
                    submitting: false,
                    deadlineAt: null,
                    durationSeconds: 0,
                    remainingSeconds: null,
                };
            };

            const formatQuizTime = (seconds = 0) => {
                const total = Math.max(Math.ceil(Number(seconds) || 0), 0);
                const minutes = Math.floor(total / 60);
                const rest = total % 60;

                return `${String(minutes).padStart(2, '0')}:${String(rest).padStart(2, '0')}`;
            };

            const updateQuizTimerDisplay = (remainingSeconds = 0) => {
                const safeRemaining = Math.max(Math.ceil(Number(remainingSeconds) || 0), 0);
                const label = document.getElementById('quizTimerLabel');
                const badge = document.getElementById('quizTimerBadge');
                const bar = document.getElementById('quizTimerBar');
                const status = document.getElementById('quizTimerStatus');

                if (label) label.textContent = formatQuizTime(safeRemaining);

                if (badge) {
                    badge.classList.toggle('text-red-700', safeRemaining <= 10);
                    badge.classList.toggle('text-primary-700', safeRemaining > 10);
                }

                if (bar) {
                    const duration = Math.max(Number(state.quizTimer.durationSeconds || 0), 1);
                    const percent = Math.max(Math.min((safeRemaining / duration) * 100, 100), 0);
                    bar.style.width = `${percent}%`;
                    bar.classList.toggle('bg-red-500', safeRemaining <= 10);
                }

                if (status) {
                    if (safeRemaining <= 0) {
                        status.textContent = 'Waktu habis. Jawaban yang sudah dipilih sedang dikirim otomatis.';
                    } else if (safeRemaining <= 10) {
                        status.textContent = 'Waktu hampir habis. Sistem akan mengirim otomatis saat timer 00:00.';
                    } else {
                        status.textContent = 'Kerjakan kuis sebelum waktu habis. Jawaban yang belum dipilih akan dianggap salah.';
                    }
                }
            };

            const collectQuizAnswers = () => {
                const optionInputs = Array.from(els.materiContent.querySelectorAll('.quiz-option'));
                const soalIds = [...new Set(optionInputs.map(o => o.dataset.soal).filter(Boolean))];
                const answeredIds = [...new Set(optionInputs.filter(o => o.checked).map(o => o.dataset.soal).filter(Boolean))];

                const jawaban = optionInputs
                    .filter(input => input.checked)
                    .map(input => ({
                        id_soal: Number(input.dataset.soal),
                        id_soal_jawaban: Number(input.dataset.answer),
                    }))
                    .filter(item => Number.isFinite(item.id_soal) && Number.isFinite(item.id_soal_jawaban));

                return {
                    optionInputs,
                    soalIds,
                    answeredIds,
                    unanswered: soalIds.filter(id => !answeredIds.includes(id)),
                    jawaban,
                };
            };

            const lockQuizInputsAfterTimeout = () => {
                els.materiContent.querySelectorAll('.quiz-option').forEach((input) => {
                    input.disabled = true;
                });

                ['resetQuizAnswers', 'submitQuizBtn', 'quizPrev', 'quizNext', 'startExamLockBtn'].forEach((id) => {
                    const btn = document.getElementById(id);

                    if (btn) {
                        btn.disabled = true;
                        btn.classList.add('opacity-50', 'cursor-not-allowed');
                    }
                });
            };

            const handleQuizTimeExpired = async () => {
                if (state.quizTimer.submitting) return;

                state.quizTimer.expired = true;
                state.quizTimer.submitting = true;

                if (state.quizTimer.interval) {
                    clearInterval(state.quizTimer.interval);
                    state.quizTimer.interval = null;
                }

                updateQuizTimerDisplay(0);
                lockQuizInputsAfterTimeout();

                if (window.Swal) {
                    Swal.fire({
                        title: 'Waktu Habis',
                        html: '<p class="text-gray-600">Jawaban yang sudah dipilih sedang dikirim otomatis. Soal yang belum dijawab akan dihitung salah.</p>',
                        icon: 'warning',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => Swal.showLoading(),
                    });
                }

                try {
                    await submitQuizAnswers({
                        autoSubmit: true,
                    });
                } finally {
                    state.quizTimer.submitting = false;
                }
            };

            const startQuizTimer = (timerMeta = {}) => {
                resetQuizTimer();

                const durationSeconds = Math.max(toNumber(timerMeta.durationSeconds), 0);
                const remainingRaw = timerMeta.remainingSeconds;
                const remainingSeconds = remainingRaw === null || remainingRaw === undefined
                    ? durationSeconds
                    : Math.max(toNumber(remainingRaw, durationSeconds), 0);

                if (durationSeconds <= 0) {
                    updateQuizTimerDisplay(0);
                    return;
                }

                state.quizTimer.active = true;
                state.quizTimer.durationSeconds = durationSeconds;
                state.quizTimer.remainingSeconds = remainingSeconds;
                state.quizTimer.deadlineAt = Date.now() + (remainingSeconds * 1000);

                updateQuizTimerDisplay(remainingSeconds);

                if (timerMeta.timeIsUp || remainingSeconds <= 0) {
                    setTimeout(() => handleQuizTimeExpired(), 350);
                    return;
                }

                state.quizTimer.interval = setInterval(() => {
                    const remaining = Math.max(Math.ceil((state.quizTimer.deadlineAt - Date.now()) / 1000), 0);
                    state.quizTimer.remainingSeconds = remaining;

                    updateQuizTimerDisplay(remaining);

                    if (remaining <= 0) {
                        handleQuizTimeExpired();
                    }
                }, 500);
            };

            const terminateExamSession = async (reason = 'Sesi kuis dibatalkan karena keluar dari Mode Ujian Aman.') => {
                if (!state.examLock.active || state.examLock.terminating) return;

                state.examLock.terminating = true;
                resetCurrentQuizAnswers();

                state.examLock.active = false;
                state.examLock.started = false;
                state.examLock.currentProgresId = null;
                setExamLockUi(false);

                const redirectLogout = () => {
                    window.location.href = routes.logout;
                };

                if (window.Swal) {
                    Swal.fire({
                        title: 'Sesi Kuis Dibatalkan',
                        html: `
                            <div class="text-left space-y-3">
                                <div class="p-4 bg-red-50 border border-red-200 rounded-xl">
                                    <p class="font-bold text-red-800 mb-1">Mode Ujian Aman terputus.</p>
                                    <p class="text-sm text-red-700">${h(reason)}</p>
                                </div>
                                <p class="text-sm text-gray-600">
                                    Jawaban yang belum dikirim sudah direset. Anda akan otomatis logout.
                                </p>
                            </div>
                        `,
                        icon: 'error',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        timer: 1400,
                        didClose: redirectLogout,
                    });

                    setTimeout(redirectLogout, 1700);
                    return;
                }

                alert(`${reason}\n\nJawaban direset dan akun akan logout.`);
                redirectLogout();
            };

            const startExamLock = async () => {
                if (!state.currentProgresId) return false;

                try {
                    await requestFullscreenMode();

                    state.examLock.active = true;
                    state.examLock.started = true;
                    state.examLock.terminating = false;
                    state.examLock.currentProgresId = state.currentProgresId;

                    setExamLockUi(true);

                    return true;
                } catch (err) {
                    showAlert({
                        title: 'Fullscreen Gagal',
                        message: err.message || 'Browser menolak mode fullscreen. Izinkan fullscreen untuk memulai kuis.',
                        icon: 'error',
                        confirmText: 'Tutup',
                        confirmColor: '#dc2626',
                    });

                    return false;
                }
            };

            const setupExamLockGuards = () => {
                document.addEventListener('fullscreenchange', () => {
                    if (state.examLock.active && !isFullscreenActive()) {
                        terminateExamSession('Anda keluar dari fullscreen saat kuis sedang berjalan.');
                    }
                });

                document.addEventListener('webkitfullscreenchange', () => {
                    if (state.examLock.active && !isFullscreenActive()) {
                        terminateExamSession('Anda keluar dari fullscreen saat kuis sedang berjalan.');
                    }
                });

                document.addEventListener('visibilitychange', () => {
                    if (state.examLock.active && document.hidden) {
                        terminateExamSession('Anda meninggalkan tab kuis atau membuka tab/aplikasi lain.');
                    }
                });

                window.addEventListener('blur', () => {
                    if (state.examLock.active) {
                        setTimeout(() => {
                            if (state.examLock.active && !document.hasFocus()) {
                                terminateExamSession('Browser kehilangan fokus saat kuis sedang berjalan.');
                            }
                        }, 250);
                    }
                });

                window.addEventListener('beforeunload', (event) => {
                    if (state.examLock.active) {
                        resetCurrentQuizAnswers();
                        event.preventDefault();
                        event.returnValue = '';
                        return '';
                    }

                    return undefined;
                });

                document.addEventListener('contextmenu', (event) => {
                    if (state.examLock.active) {
                        event.preventDefault();
                    }
                });

                document.addEventListener('copy', (event) => {
                    if (state.examLock.active) event.preventDefault();
                });

                document.addEventListener('cut', (event) => {
                    if (state.examLock.active) event.preventDefault();
                });

                document.addEventListener('paste', (event) => {
                    if (state.examLock.active) event.preventDefault();
                });

                document.addEventListener('keydown', (event) => {
                    if (!state.examLock.active) return;

                    const key = String(event.key || '').toLowerCase();
                    const forbidden =
                        key === 'f12' ||
                        key === 'escape' ||
                        ((event.ctrlKey || event.metaKey) && ['r', 'u', 's', 'p', 'n', 't', 'w'].includes(key)) ||
                        (event.ctrlKey && event.shiftKey && ['i', 'j', 'c'].includes(key)) ||
                        (event.altKey && ['tab', 'f4'].includes(key));

                    if (forbidden) {
                        event.preventDefault();
                        event.stopPropagation();

                        terminateExamSession(
                            key === 'escape'
                                ? 'Tombol ESC terdeteksi saat kuis sedang berjalan.'
                                : 'Shortcut terlarang terdeteksi saat kuis sedang berjalan.'
                        );
                    }
                }, true);
            };


            const renderLoading = (target, title = 'Memuat...', subtitle = '') => {
                if (!target) return;

                target.innerHTML = `
                    <div class="neo-inset flex flex-col items-center justify-center py-8 text-center">
                        <div class="mx-auto w-10 h-10 border-4 border-gray-300 border-t-primary-600 rounded-full animate-spin mb-3"></div>
                        <p class="text-sm text-gray-500 font-bold">${title}</p>
                        ${subtitle ? `<p class="text-xs text-gray-400 mt-1">${subtitle}</p>` : ''}
                    </div>
                `;
            };

            async function fetchJson(url, options = {}) {
                const resp = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                    },
                    ...options,
                });

                if (!resp.ok) {
                    const err = await resp.json().catch(() => ({}));
                    throw new Error(err.error || err.message || `Request gagal (${resp.status})`);
                }

                const json = await resp.json();

                if (json && Object.prototype.hasOwnProperty.call(json, 'success')) {
                    if (!json.success) {
                        throw new Error(json.message || 'Permintaan gagal');
                    }

                    const payload = json.data ?? {};

                    if (json.message && payload && typeof payload === 'object' && !Array.isArray(payload)) {
                        payload._message = json.message;
                    }

                    return payload;
                }

                return json;
            }

            const normalizeQuizTimerPayload = (payload = {}, fallbackMeta = {}) => {
                const raw = payload?.timer || payload?.timerMeta || payload?.status || payload || {};

                const durationSeconds = Math.max(toNumber(
                    raw.durationSeconds ??
                    raw.duration_seconds ??
                    raw.durasi_detik ??
                    raw.durasiDetik ??
                    fallbackMeta.durationSeconds ??
                    fallbackMeta.durasi_detik,
                    0
                ), 0);

                const remainingValue =
                    raw.remainingSeconds ??
                    raw.remaining_seconds ??
                    raw.sisa_detik ??
                    raw.sisaDetik ??
                    raw.sisa_waktu ??
                    fallbackMeta.remainingSeconds ??
                    fallbackMeta.sisa_detik ??
                    durationSeconds;

                const remainingSeconds = Math.max(toNumber(remainingValue, durationSeconds), 0);

                const timeIsUp = toBooleanFlag(
                    raw.timeIsUp ??
                    raw.time_is_up ??
                    raw.waktu_habis ??
                    raw.waktuHabis ??
                    fallbackMeta.timeIsUp ??
                    fallbackMeta.waktu_habis
                ) || (durationSeconds > 0 && remainingSeconds <= 0);

                return {
                    durationSeconds,
                    remainingSeconds,
                    timeIsUp,
                };
            };

            async function startQuizTimerFromBackend(fallbackMeta = {}) {
                if (!state.currentProgresId) {
                    throw new Error('Progres kuis tidak ditemukan. Muat ulang halaman lalu coba lagi.');
                }

                const url = routes.startQuiz
                    .replace('__TOKEN__', pendaftaranToken)
                    .replace('__PROGRES__', state.currentProgresId);

                const data = await fetchJson(url, {
                    method: 'POST',
                    body: JSON.stringify({}),
                });

                return normalizeQuizTimerPayload(data, fallbackMeta);
            }

            const normalizeVideoUrl = (url) => {
                if (!url) return '';

                try {
                    const parsed = new URL(url);
                    const host = parsed.hostname.replace(/^www\./, '');

                    if (host.includes('youtu.be')) {
                        const id = parsed.pathname.replace(/\//g, '');
                        return id ? `https://www.youtube.com/embed/${id}` : url;
                    }

                    if (host.includes('youtube.com')) {
                        const id = parsed.searchParams.get('v') || parsed.pathname.split('/').filter(Boolean).pop();
                        return id ? `https://www.youtube.com/embed/${id}` : url;
                    }

                    if (host.includes('vimeo.com')) {
                        const id = parsed.pathname.split('/').filter(Boolean).pop();
                        return id ? `https://player.vimeo.com/video/${id}` : url;
                    }

                    return url;
                } catch (err) {
                    return url;
                }
            };

            const rebuildFlatMateri = () => {
                state.flatMateri = state.progres.flatMap(p => {
                    const bagian = p.bagian || {};

                    return (bagian.materi || []).map(m => {
                        const progresId = getProgresId(m);

                        return {
                            ...m,
                            id_progres_kelas: progresId,
                            token: progresId,
                            bagian_id: bagian.id_bagian_kelas,
                            bagian_judul: bagian.bagian_judul,
                            bagian_urutan: bagian.urutan_bagian_kelas,
                        };
                    });
                });
            };

            const flattenMateri = () => state.flatMateri;

            function renderHero(ringkasan) {
                if (!ringkasan) return;

                const persen = Number(ringkasan.persentase || 0);

                if (els.heroProgressBar) els.heroProgressBar.style.width = `${persen}%`;
                if (els.heroProgressLabel) els.heroProgressLabel.textContent = `${persen.toFixed(1)}%`;
                if (els.sidebarSummary) els.sidebarSummary.textContent = `${ringkasan.materi_selesai}/${ringkasan.total_materi}`;
                if (els.heroTotalMateri) els.heroTotalMateri.textContent = ringkasan.total_materi ?? '-';
                if (els.heroMateriSelesai) els.heroMateriSelesai.textContent = ringkasan.materi_selesai ?? '-';
            }

            const applySidebarVisibility = () => {
                if (!els.sidebarPanel) return;

                const mq = window.matchMedia('(min-width: 1024px)');

                if (mq.matches) {
                    state.sidebarOpen = true;
                }

                const shouldShow = mq.matches || state.sidebarOpen;

                els.sidebarPanel.classList.toggle('is-open', shouldShow);

                if (els.toggleSidebarBtn) {
                    els.toggleSidebarBtn.classList.toggle('hidden', mq.matches);

                    const text = els.toggleSidebarBtn.querySelector('span');
                    const icon = els.toggleSidebarBtn.querySelector('svg');

                    if (text && !mq.matches) {
                        text.textContent = state.sidebarOpen ? 'Sembunyikan daftar materi' : 'Tampilkan daftar materi';
                    }

                    if (icon && !mq.matches) {
                        icon.style.transform = state.sidebarOpen ? 'rotate(180deg)' : 'rotate(0deg)';
                    }
                }
            };

            const syncAccordionState = () => {
                const accordions = els.sidebar?.querySelectorAll('[data-accordion-content]');

                accordions?.forEach((content) => {
                    const id = content.dataset.accordionContent;
                    const isOpen = state.openBagian[id] ?? false;

                    content.classList.toggle('max-h-screen', isOpen);
                    content.classList.toggle('opacity-100', isOpen);
                    content.classList.toggle('max-h-0', !isOpen);
                    content.classList.toggle('opacity-0', !isOpen);
                });

                const icons = els.sidebar?.querySelectorAll('[data-accordion-icon]');

                icons?.forEach((icon) => {
                    const id = icon.dataset.accordionIcon;
                    const isOpen = state.openBagian[id] ?? false;

                    icon.classList.toggle('rotate-90', isOpen);
                });
            };

            const toggleAccordion = (bagianId) => {
                const willOpen = !(state.openBagian[bagianId] ?? false);

                state.openBagian = {};

                if (willOpen) state.openBagian[bagianId] = true;

                syncAccordionState();
            };

            const updateSidebarActive = (progresId) => {
                if (!progresId) return;

                const buttons = els.sidebar?.querySelectorAll('[data-progres]');

                if (!buttons) return;

                buttons.forEach((btn) => {
                    const active = btn.dataset.progres === String(progresId);
                    btn.classList.toggle('is-active', active);
                });
            };

            function renderSidebar() {
                if (!state.progres.length) {
                    els.sidebar.innerHTML =
                        '<div class="py-6 text-center text-gray-400 text-sm">Belum ada materi tersedia</div>';
                    return;
                }

                const html = state.progres.map(item => {
                    const bagian = item.bagian || {};
                    const materiList = bagian.materi || [];
                    const selesaiCount = materiList.filter(m => m.selesai).length;
                    const total = materiList.length || 1;
                    const percent = ((selesaiCount / total) * 100).toFixed(0);
                    const isOpen = state.openBagian[bagian.id_bagian_kelas] ?? false;

                    const materiHtml = materiList.map(m => {
                        const progresId = getProgresId(m);
                        const isActive = progresId === state.currentProgresId;
                        const sudahSelesai = toBooleanFlag(m.selesai) || toBooleanFlag(m.materi_selesai) || toBooleanFlag(m.kuis_selesai);
                        const canOpenForReviewOrRewatch = toBooleanFlag(m.bisa_diakses) || sudahSelesai;
                        const disabled = !canOpenForReviewOrRewatch;

                        return `
                            <button
                                class="w-full text-left p-3 transition-all ${isActive ? 'is-active' : ''} ${disabled ? 'opacity-50 cursor-not-allowed' : ''}"
                                data-progres="${progresId}"
                                data-locked="${disabled ? '1' : '0'}"
                            >
                                <div class="flex items-start gap-3">
                                    <div class="shrink-0 mt-0.5">${ICON_MATERI[m.tipe] || ICON_MATERI.text}</div>

                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-black truncate">${h(m.materi_judul)}</div>

                                        <div class="flex flex-wrap items-center gap-2 mt-1.5">
                                            <span class="text-xs text-gray-500">Materi ${h(m.urutan)}</span>

                                            ${m.selesai
                                                ? '<span class="text-xs text-green-700 font-bold">Selesai</span>'
                                                : '<span class="text-xs text-gray-400">Belum selesai</span>'
                                            }

                                            ${disabled
                                                ? '<span class="text-xs text-gray-400 font-bold">Terkunci</span>'
                                                : (sudahSelesai ? '<span class="text-xs text-primary-700 font-bold">Bisa dibuka ulang</span>' : '')
                                            }
                                        </div>
                                    </div>
                                </div>
                            </button>
                        `;
                    }).join('');

                    return `
                        <div class="section-wrapper mb-3 last:mb-0">
                            <button class="accordion-toggle w-full px-4 py-3 flex items-center justify-between text-left transition"
                                data-accordion="${bagian.id_bagian_kelas}">
                                <div class="flex-1">
                                    <div class="text-xs font-bold text-gray-500 mb-0.5">Bagian ${h(bagian.urutan_bagian_kelas)}</div>
                                    <div class="text-sm font-black text-gray-900">${h(bagian.bagian_judul)}</div>

                                    <div class="flex items-center gap-2 mt-2">
                                        <div class="flex-1 neo-progress-track h-1.5">
                                            <div class="neo-progress-fill h-1.5" style="width:${percent}%;"></div>
                                        </div>
                                        <span class="text-xs text-gray-500 whitespace-nowrap">${selesaiCount}/${total}</span>
                                    </div>
                                </div>

                                <svg data-accordion-icon="${bagian.id_bagian_kelas}"
                                    class="w-5 h-5 text-gray-400 transition-transform ${isOpen ? 'rotate-90' : ''}"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>

                            <div class="overflow-hidden transition-all duration-300 ${isOpen ? 'max-h-screen opacity-100' : 'max-h-0 opacity-0'}"
                                data-accordion-content="${bagian.id_bagian_kelas}">
                                <div class="p-3 space-y-2">
                                    ${materiHtml}
                                </div>
                            </div>
                        </div>
                    `;
                }).join('');

                els.sidebar.innerHTML = html;

                els.sidebar.querySelectorAll('.accordion-toggle').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const id = btn.dataset.accordion;
                        toggleAccordion(id);
                    });
                });

                els.sidebar.querySelectorAll('button[data-progres]').forEach(btn => {
                    btn.addEventListener('click', () => {
                        if (btn.dataset.locked === '1') {
                            showAlert({
                                title: 'Materi Terkunci',
                                message: 'Materi ini terkunci. Selesaikan materi sebelumnya terlebih dahulu.',
                                icon: 'info',
                                confirmText: 'Mengerti'
                            });

                            return;
                        }

                        const targetProgres = btn.getAttribute('data-progres');

                        updateSidebarActive(targetProgres);
                        loadMateri(targetProgres);

                        if (!window.matchMedia('(min-width: 1024px)').matches) {
                            state.sidebarOpen = false;
                            applySidebarVisibility();
                        }
                    });
                });

                syncAccordionState();
            }

            function resolveNav(navOverride = null) {
                if (navOverride) return navOverride;

                const list = flattenMateri();
                const idx = list.findIndex(m => getProgresId(m) === state.currentProgresId);
                const prev = idx > 0 ? list[idx - 1] : null;
                const next = idx >= 0 && idx < list.length - 1 ? list[idx + 1] : null;

                return {
                    materi_sebelumnya: prev ? {
                        id_progres_kelas: getProgresId(prev),
                        token: getProgresId(prev),
                        bisa_diakses: prev.bisa_diakses,
                    } : null,
                    materi_selanjutnya: next ? {
                        id_progres_kelas: getProgresId(next),
                        token: getProgresId(next),
                        bisa_diakses: next.bisa_diakses,
                    } : null,
                };
            }

            function updateNavControls(navOverride = null) {
                const nav = resolveNav(navOverride);
                const prev = nav.materi_sebelumnya;
                const next = nav.materi_selanjutnya;

                state.currentNav = nav;

                const canOpenNavItem = (item) => Boolean(item) && (
                    toBooleanFlag(item.bisa_diakses) ||
                    toBooleanFlag(item.selesai) ||
                    toBooleanFlag(item.materi_selesai) ||
                    toBooleanFlag(item.kuis_selesai)
                );

                if (els.prevBtn) {
                    const canPrev = canOpenNavItem(prev);
                    els.prevBtn.disabled = !canPrev;
                    els.prevBtn.dataset.target = canPrev ? getProgresId(prev) : '';
                }

                if (els.nextBtn) {
                    const canNext = canOpenNavItem(next);
                    els.nextBtn.disabled = !canNext;
                    els.nextBtn.dataset.target = canNext ? getProgresId(next) : '';
                }
            }

            function enhanceRichContent() {
                const container = els.materiContent.querySelector('.materi-prose');

                if (!container) return;

                container.querySelectorAll('iframe, embed, object').forEach(el => {
                    el.setAttribute('allowfullscreen', '');
                    el.loading = 'lazy';
                    el.classList.add('w-full', 'rounded-xl');
                });

                container.querySelectorAll('video, audio').forEach(el => {
                    el.setAttribute('controls', '');
                    el.classList.add('rounded-xl');
                });

                container.querySelectorAll('img').forEach(el => {
                    el.loading = 'lazy';
                    el.classList.add('rounded-xl');
                });
            }

            function renderTextMateri(content) {
                const richContent = safeHtml(content || '');

                els.materiContent.innerHTML = `
                    <div class="materi-prose prose prose-slate prose-sm max-w-none
                        prose-headings:text-slate-900 prose-p:text-slate-700
                        prose-a:text-primary-700 prose-a:font-semibold prose-a:underline
                        prose-strong:text-slate-900 prose-pre:bg-slate-900 prose-pre:text-slate-100
                        prose-img:rounded-xl">
                        ${richContent || '<p class="text-gray-500">Konten materi belum tersedia.</p>'}
                    </div>
                `;

                enhanceRichContent();
            }

            const extractYouTubeVideoId = (url) => {
                if (!url) return '';

                try {
                    const parsed = new URL(url);
                    const host = parsed.hostname.replace(/^www\./, '');
                    const paths = parsed.pathname.split('/').filter(Boolean);

                    if (host === 'youtu.be') {
                        return paths[0] || '';
                    }

                    if (host.includes('youtube.com') || host.includes('youtube-nocookie.com')) {
                        if (parsed.searchParams.get('v')) return parsed.searchParams.get('v');

                        const embedIndex = paths.indexOf('embed');
                        if (embedIndex >= 0 && paths[embedIndex + 1]) return paths[embedIndex + 1];

                        const shortsIndex = paths.indexOf('shorts');
                        if (shortsIndex >= 0 && paths[shortsIndex + 1]) return paths[shortsIndex + 1];

                        return paths[0] || '';
                    }

                    return '';
                } catch (err) {
                    return '';
                }
            };

            const updateVideoStatus = (message, tone = 'info') => {
                const status = document.getElementById('videoLockStatusText');
                const dot = document.getElementById('videoLockStatusDot');

                if (status) status.textContent = message;

                if (dot) {
                    dot.className = 'w-2.5 h-2.5 rounded-full shrink-0';

                    if (tone === 'success') dot.classList.add('bg-emerald-500');
                    else if (tone === 'danger') dot.classList.add('bg-red-500');
                    else if (tone === 'warning') dot.classList.add('bg-amber-500');
                    else dot.classList.add('bg-sky-500');
                }
            };

            const setVideoMarkDoneState = ({ completed = false, alreadyDone = false } = {}) => {
                if (!els.markDoneBtn) return;

                els.markDoneBtn.classList.remove('hidden');

                if (alreadyDone) {
                    els.markDoneBtn.disabled = true;
                    els.markDoneBtn.textContent = 'Sudah Selesai';
                    return;
                }

                if (completed) {
                    els.markDoneBtn.disabled = false;
                    els.markDoneBtn.textContent = 'Tandai Selesai';
                    return;
                }

                els.markDoneBtn.disabled = true;
                els.markDoneBtn.textContent = 'Tonton Video Dulu';
            };

            const formatVideoSeconds = (seconds = 0) => {
                const total = Math.max(Math.floor(Number(seconds) || 0), 0);
                const minutes = Math.floor(total / 60);
                const rest = total % 60;

                return `${minutes}:${String(rest).padStart(2, '0')}`;
            };

            const resetVideoGuard = () => {
                if (state.videoGuard.interval) {
                    clearInterval(state.videoGuard.interval);
                }

                if (state.videoGuard.player && typeof state.videoGuard.player.destroy === 'function') {
                    try {
                        state.videoGuard.player.destroy();
                    } catch (err) {
                        console.warn(err);
                    }
                }

                state.videoGuard = {
                    player: null,
                    interval: null,
                    maxAllowedTime: 0,
                    completed: false,
                    warningShown: false,
                    playerType: null,
                    videoId: '',
                    storageKey: '',
                    lastSavedAt: 0,
                };
            };

            const getVideoProgressStorageKey = (videoId = '') => {
                const safeToken = String(pendaftaranToken || 'guest');
                const safeProgres = String(state.currentProgresId || 'materi');
                const safeVideo = String(videoId || 'default').replace(/[^a-zA-Z0-9_-]/g, '_');

                return `mooc_video_progress:${safeToken}:${safeProgres}:${safeVideo}`;
            };

            const loadVideoProgressFromLocal = (videoId = '') => {
                try {
                    const key = getVideoProgressStorageKey(videoId);
                    const raw = localStorage.getItem(key);

                    if (!raw) {
                        return {
                            seconds: 0,
                            duration: 0,
                            completed: false,
                        };
                    }

                    const data = JSON.parse(raw);

                    return {
                        seconds: Math.max(Number(data.seconds) || 0, 0),
                        duration: Math.max(Number(data.duration) || 0, 0),
                        completed: Boolean(data.completed),
                    };
                } catch (err) {
                    console.warn('Gagal membaca progres video:', err);

                    return {
                        seconds: 0,
                        duration: 0,
                        completed: false,
                    };
                }
            };

            const saveVideoProgressToLocal = (videoId = '', seconds = 0, duration = 0, completed = false) => {
                if (!state.currentProgresId) return;

                const safeSeconds = Math.max(Number(seconds) || 0, 0);
                const safeDuration = Math.max(Number(duration) || 0, 0);

                try {
                    const key = getVideoProgressStorageKey(videoId);

                    localStorage.setItem(key, JSON.stringify({
                        seconds: safeSeconds,
                        duration: safeDuration,
                        completed: Boolean(completed),
                        updated_at: Date.now(),
                    }));
                } catch (err) {
                    console.warn('Gagal menyimpan progres video:', err);
                }
            };

            const clearVideoProgressFromLocal = (videoId = '') => {
                try {
                    localStorage.removeItem(getVideoProgressStorageKey(videoId));
                } catch (err) {
                    console.warn('Gagal menghapus progres video:', err);
                }
            };

            const ensureYouTubeIframeApi = () => {
                if (window.YT && typeof window.YT.Player === 'function') {
                    return Promise.resolve(window.YT);
                }

                if (state.youtubeApiPromise) {
                    return state.youtubeApiPromise;
                }

                state.youtubeApiPromise = new Promise((resolve, reject) => {
                    const existingScript = document.querySelector('script[src="https://www.youtube.com/iframe_api"]');
                    const previousReady = window.onYouTubeIframeAPIReady;

                    window.onYouTubeIframeAPIReady = () => {
                        if (typeof previousReady === 'function') {
                            try { previousReady(); } catch (err) { console.warn(err); }
                        }

                        resolve(window.YT);
                    };

                    if (!existingScript) {
                        const script = document.createElement('script');
                        script.src = 'https://www.youtube.com/iframe_api';
                        script.async = true;
                        script.onerror = () => reject(new Error('Gagal memuat YouTube IFrame API.'));
                        document.head.appendChild(script);
                    }
                });

                return state.youtubeApiPromise;
            };

            const completeVideoWatch = (alreadyDone = false) => {
                state.videoGuard.completed = true;

                const activeVideoId = state.videoGuard.videoId || '';
                const duration = Math.max(Number(state.videoGuard.duration || 0), 0);
                const seconds = duration > 0
                    ? duration
                    : Math.max(Number(state.videoGuard.maxAllowedTime || 0), 0);

                if (activeVideoId) {
                    saveVideoProgressToLocal(activeVideoId, seconds, duration, true);
                }

                setVideoMarkDoneState({ completed: true, alreadyDone });
                updateVideoStatus(
                    alreadyDone
                        ? 'Materi video ini sudah pernah diselesaikan.'
                        : 'Video selesai. Tombol Tandai Selesai sekarang aktif.',
                    'success'
                );
            };

            const guardYouTubePlayer = (player, alreadyDone = false) => {
                if (!player || typeof player.getCurrentTime !== 'function') return;

                let current = 0;
                let duration = 0;
                let playbackRate = 1;

                try {
                    current = Number(player.getCurrentTime() || 0);
                    duration = Number(player.getDuration() || 0);
                    playbackRate = Number(player.getPlaybackRate ? player.getPlaybackRate() : 1);

                    if (duration > 0) {
                        state.videoGuard.duration = duration;
                    }
                } catch (err) {
                    return;
                }

                if (Number.isFinite(playbackRate) && playbackRate !== 1 && typeof player.setPlaybackRate === 'function') {
                    try {
                        player.setPlaybackRate(1);
                        updateVideoStatus('Kecepatan video dikunci di 1x.', 'warning');
                    } catch (err) {
                        console.warn(err);
                    }
                }

                if (!state.videoGuard.completed && current > state.videoGuard.maxAllowedTime + 2) {
                    const fallbackTime = Math.max(state.videoGuard.maxAllowedTime, 0);

                    try {
                        player.seekTo(fallbackTime, true);
                    } catch (err) {
                        console.warn(err);
                    }

                    updateVideoStatus('Tidak bisa skip maju. Video dikembalikan ke posisi terakhir yang valid.', 'danger');
                    return;
                }

                if (current > state.videoGuard.maxAllowedTime) {
                    state.videoGuard.maxAllowedTime = current;
                }

                const now = Date.now();
                if (!alreadyDone && !state.videoGuard.completed && current > 1 && now - Number(state.videoGuard.lastSavedAt || 0) > 900) {
                    state.videoGuard.lastSavedAt = now;
                    saveVideoProgressToLocal(
                        state.videoGuard.videoId || '',
                        state.videoGuard.maxAllowedTime,
                        duration,
                        false
                    );
                }

                if (!state.videoGuard.completed && duration > 0 && current >= duration - 1.25) {
                    completeVideoWatch(alreadyDone);
                }
            };

            const setupYouTubeLockedPlayer = async ({ videoId, playerDomId, alreadyDone = false }) => {
                try {
                    const YTApi = await ensureYouTubeIframeApi();

                    if (!document.getElementById(playerDomId)) return;

                    const player = new YTApi.Player(playerDomId, {
                        videoId,
                        width: '100%',
                        height: '100%',
                        playerVars: {
                            autoplay: 0,
                            controls: 0,
                            disablekb: 1,
                            fs: 0,
                            iv_load_policy: 3,
                            modestbranding: 1,
                            playsinline: 1,
                            rel: 0,
                        },
                        events: {
                            onReady: (event) => {
                                state.videoGuard.player = event.target;
                                state.videoGuard.playerType = 'youtube';
                                state.videoGuard.videoId = videoId;
                                state.videoGuard.storageKey = getVideoProgressStorageKey(videoId);
                                state.videoGuard.maxAllowedTime = 0;
                                state.videoGuard.completed = alreadyDone;

                                try {
                                    event.target.setPlaybackRate(1);
                                } catch (err) {
                                    console.warn(err);
                                }

                                const savedProgress = loadVideoProgressFromLocal(videoId);
                                const duration = Math.max(Number(event.target.getDuration?.() || savedProgress.duration || 0), 0);
                                const resumeAt = Math.max(Number(savedProgress.seconds) || 0, 0);
                                const completedFromLocal = Boolean(savedProgress.completed);

                                state.videoGuard.duration = duration;

                                if (!alreadyDone && completedFromLocal) {
                                    state.videoGuard.completed = true;
                                    state.videoGuard.maxAllowedTime = duration > 0 ? duration : resumeAt;
                                    setVideoMarkDoneState({ completed: true, alreadyDone: false });
                                    updateVideoStatus('Video sudah pernah selesai ditonton. Kamu bisa belajar ulang dari awal kapan saja.', 'success');
                                } else if (!alreadyDone && resumeAt > 3) {
                                    const target = duration > 0 ? Math.min(resumeAt, Math.max(duration - 2, 0)) : resumeAt;

                                    state.videoGuard.maxAllowedTime = target;

                                    try {
                                        event.target.seekTo(target, true);
                                        updateVideoStatus(`Video dilanjutkan dari ${formatVideoSeconds(target)}.`, 'info');
                                    } catch (err) {
                                        console.warn(err);
                                    }
                                }

                                setVideoMarkDoneState({
                                    completed: alreadyDone || completedFromLocal,
                                    alreadyDone,
                                });
                                updateVideoStatus(
                                    alreadyDone
                                        ? 'Materi video sudah selesai. Kamu bisa membuka dan menonton ulang materi ini kapan saja.'
                                        : 'Video siap. Pause, mundur, dan ulang dari awal diperbolehkan. Skip maju dan speed selain 1x tetap dikunci.',
                                    alreadyDone ? 'success' : 'info'
                                );

                                document.getElementById('videoPlayPauseBtn')?.addEventListener('click', () => {
                                    try {
                                        const playerState = event.target.getPlayerState();

                                        if (playerState === YTApi.PlayerState.PLAYING) {
                                            event.target.pauseVideo();
                                            updateVideoStatus('Video dijeda. Lanjutkan jika sudah siap.', 'info');
                                        } else {
                                            event.target.playVideo();
                                            updateVideoStatus('Video berjalan. Kecepatan tetap dikunci 1x.', 'info');
                                        }
                                    } catch (err) {
                                        console.warn(err);
                                    }
                                });

                                document.getElementById('videoRewindBtn')?.addEventListener('click', () => {
                                    try {
                                        const target = Math.max(Number(event.target.getCurrentTime() || 0) - 10, 0);
                                        event.target.seekTo(target, true);
                                        updateVideoStatus(target <= 0 ? 'Video sudah berada di awal.' : `Video dimundurkan ke ${formatVideoSeconds(target)}.`, 'info');
                                    } catch (err) {
                                        console.warn(err);
                                    }
                                });

                                document.getElementById('videoRestartBtn')?.addEventListener('click', () => {
                                    try {
                                        event.target.seekTo(0, true);
                                        updateVideoStatus('Video diulang dari awal. Kamu tetap tidak bisa skip maju melebihi bagian yang sudah ditonton.', 'info');
                                    } catch (err) {
                                        console.warn(err);
                                    }
                                });

                                state.videoGuard.interval = setInterval(() => {
                                    guardYouTubePlayer(event.target, alreadyDone);
                                }, 500);
                            },
                            onStateChange: (event) => {
                                if (event.data === YTApi.PlayerState.ENDED) {
                                    completeVideoWatch(alreadyDone);
                                }

                                if (event.data === YTApi.PlayerState.PLAYING) {
                                    try {
                                        event.target.setPlaybackRate(1);
                                    } catch (err) {
                                        console.warn(err);
                                    }
                                }
                            },
                            onPlaybackRateChange: (event) => {
                                try {
                                    event.target.setPlaybackRate(1);
                                    updateVideoStatus('Kecepatan video dikembalikan ke 1x.', 'warning');
                                } catch (err) {
                                    console.warn(err);
                                }
                            },
                            onError: () => {
                                updateVideoStatus('Video YouTube gagal dimuat. Periksa link video atau koneksi internet.', 'danger');
                            },
                        },
                    });

                    state.videoGuard.player = player;
                } catch (err) {
                    console.error(err);
                    updateVideoStatus(err.message || 'Gagal memuat player YouTube.', 'danger');
                }
            };

            const setupHtml5LockedPlayer = ({ videoEl, alreadyDone = false }) => {
                if (!videoEl) return;

                const html5VideoId = videoEl.currentSrc || videoEl.querySelector('source')?.src || 'html5_video';

                state.videoGuard.player = videoEl;
                state.videoGuard.playerType = 'html5';
                state.videoGuard.videoId = html5VideoId;
                state.videoGuard.storageKey = getVideoProgressStorageKey(html5VideoId);
                state.videoGuard.maxAllowedTime = 0;
                state.videoGuard.completed = alreadyDone;

                videoEl.playbackRate = 1;
                videoEl.defaultPlaybackRate = 1;

                videoEl.addEventListener('loadedmetadata', () => {
                    const savedProgress = loadVideoProgressFromLocal(html5VideoId);
                    const duration = Math.max(Number(videoEl.duration || savedProgress.duration || 0), 0);
                    const resumeAt = Math.max(Number(savedProgress.seconds) || 0, 0);

                    state.videoGuard.duration = duration;

                    if (!alreadyDone && savedProgress.completed) {
                        state.videoGuard.completed = true;
                        state.videoGuard.maxAllowedTime = duration > 0 ? duration : resumeAt;
                        setVideoMarkDoneState({ completed: true, alreadyDone: false });
                        updateVideoStatus('Video sudah pernah selesai ditonton. Kamu bisa belajar ulang dari awal kapan saja.', 'success');
                        return;
                    }

                    if (!alreadyDone && resumeAt > 3) {
                        const target = duration > 0 ? Math.min(resumeAt, Math.max(duration - 2, 0)) : resumeAt;
                        state.videoGuard.maxAllowedTime = target;
                        videoEl.currentTime = target;
                        updateVideoStatus(`Video dilanjutkan dari ${formatVideoSeconds(target)}.`, 'info');
                    }
                });

                const enforce = () => {
                    if (videoEl.playbackRate !== 1) {
                        videoEl.playbackRate = 1;
                        updateVideoStatus('Kecepatan video dikunci di 1x.', 'warning');
                    }

                    const current = Number(videoEl.currentTime || 0);

                    if (!state.videoGuard.completed && current > state.videoGuard.maxAllowedTime + 2) {
                        videoEl.currentTime = Math.max(state.videoGuard.maxAllowedTime, 0);
                        updateVideoStatus('Tidak bisa skip maju. Video dikembalikan ke posisi terakhir yang valid.', 'danger');
                        return;
                    }

                    if (current > state.videoGuard.maxAllowedTime) {
                        state.videoGuard.maxAllowedTime = current;
                    }

                    const duration = Math.max(Number(videoEl.duration || 0), 0);
                    const now = Date.now();

                    if (!alreadyDone && !state.videoGuard.completed && current > 1 && now - Number(state.videoGuard.lastSavedAt || 0) > 900) {
                        state.videoGuard.lastSavedAt = now;
                        saveVideoProgressToLocal(
                            html5VideoId,
                            state.videoGuard.maxAllowedTime,
                            duration,
                            false
                        );
                    }
                };

                videoEl.addEventListener('ratechange', enforce);
                videoEl.addEventListener('timeupdate', enforce);
                videoEl.addEventListener('ended', () => completeVideoWatch(alreadyDone));

                document.getElementById('videoPlayPauseBtn')?.addEventListener('click', () => {
                    if (videoEl.paused) {
                        videoEl.play();
                        updateVideoStatus('Video berjalan. Kecepatan tetap dikunci 1x.', 'info');
                    } else {
                        videoEl.pause();
                        updateVideoStatus('Video dijeda. Lanjutkan jika sudah siap.', 'info');
                    }
                });

                document.getElementById('videoRewindBtn')?.addEventListener('click', () => {
                    const target = Math.max(Number(videoEl.currentTime || 0) - 10, 0);
                    videoEl.currentTime = target;
                    updateVideoStatus(target <= 0 ? 'Video sudah berada di awal.' : `Video dimundurkan ke ${formatVideoSeconds(target)}.`, 'info');
                });

                document.getElementById('videoRestartBtn')?.addEventListener('click', () => {
                    videoEl.currentTime = 0;
                    updateVideoStatus('Video diulang dari awal. Kamu tetap tidak bisa skip maju melebihi bagian yang sudah ditonton.', 'info');
                });

                setVideoMarkDoneState({ completed: alreadyDone, alreadyDone });
                updateVideoStatus(
                    alreadyDone
                        ? 'Materi video sudah selesai. Kamu bisa membuka dan menonton ulang materi ini kapan saja.'
                        : 'Video siap. Pause, mundur, dan ulang dari awal diperbolehkan. Skip maju dan speed selain 1x tetap dikunci.',
                    alreadyDone ? 'success' : 'info'
                );
            };

            function renderVideoMateri(materi, options = {}) {
                resetVideoGuard();

                const originalUrl = materi.url_video || '';
                const url = normalizeVideoUrl(originalUrl);
                const youtubeId = extractYouTubeVideoId(originalUrl) || extractYouTubeVideoId(url);
                const alreadyDone = toBooleanFlag(options.selesai);
                const playerDomId = `youtubeLockedPlayer_${Date.now()}`;

                setVideoMarkDoneState({ completed: false, alreadyDone });

                const player = youtubeId
                    ? `<div class="video-lock-player">
                            <div id="${playerDomId}" class="w-full h-full"></div>
                       </div>`
                    : `<div class="video-lock-player">
                            <video id="html5LockedVideo" class="w-full h-full" playsinline preload="metadata">
                                <source src="${h(url)}">
                                Browser tidak mendukung pemutar video.
                            </video>
                       </div>`;

                els.materiContent.innerHTML = `
                    <div class="space-y-4">
                        <div class="video-lock-card p-3 md:p-4 space-y-4">
                            ${player}

                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
                                <div class="video-lock-status px-4 py-3 flex items-start gap-3 flex-1">
                                    <span id="videoLockStatusDot" class="w-2.5 h-2.5 rounded-full bg-sky-500 shrink-0 mt-1.5"></span>
                                    <div>
                                        <p id="videoLockStatusText" class="text-sm font-bold text-gray-800">
                                            Menyiapkan video terkunci...
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            Video dikunci 1x. Pause, mundur sampai awal, dan ulang dari awal boleh. Skip maju dan percepat video tidak diperbolehkan.
                                        </p>
                                    </div>
                                </div>

                                <div class="flex flex-wrap items-center gap-2 shrink-0">
                                    <button id="videoPlayPauseBtn" type="button" class="video-lock-control px-4 py-2 text-xs">
                                        Play / Pause
                                    </button>

                                    <button id="videoRewindBtn" type="button" class="video-lock-control px-4 py-2 text-xs">
                                        Mundur 10 Detik
                                    </button>

                                    <button id="videoRestartBtn" type="button" class="video-lock-control px-4 py-2 text-xs">
                                        Ulang dari Awal
                                    </button>

                                    <span class="neo-badge px-3 py-2 text-xs font-black text-gray-600">
                                        Speed 1x
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="neo-inset p-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-primary-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>

                                <p class="text-sm text-gray-700">
                                    Tonton video sampai selesai. Tombol <strong>Tandai Selesai</strong> baru aktif setelah video benar-benar selesai.
                                </p>
                            </div>
                        </div>
                    </div>
                `;

                if (youtubeId) {
                    setupYouTubeLockedPlayer({ videoId: youtubeId, playerDomId, alreadyDone });
                    return;
                }

                setupHtml5LockedPlayer({
                    videoEl: document.getElementById('html5LockedVideo'),
                    alreadyDone,
                });
            }

            function renderQuizMateri({
                kuis,
                progres,
                materiRow,
                attemptsLeft,
                maxAttempts,
                bestScore,
                sudahSelesaiKuis,
                quizLockedStatus,
            }) {
                const soalList = kuis?.soal || [];
                const kuisHistory = kuis?.riwayat || [];
                const kuisStatus = kuis?.status || {};
                const safeAttemptsLeft = Math.max(toNumber(attemptsLeft), 0);
                const safeMaxAttempts = Math.max(toNumber(maxAttempts, 1), 1);
                const safeBestScore = Math.max(toNumber(bestScore), 0);
                const totalAttempts = Math.max(toNumber(kuisStatus.total_percobaan), 0);
                const timerDurationSeconds = Math.max(
                    toNumber(kuisStatus.durasi_detik, 0) ||
                    (toNumber(kuis?.meta?.durasi_menit, 0) * 60),
                    0
                );
                const timerRemainingRaw = kuisStatus.sisa_detik;
                const timerRemainingSeconds = timerRemainingRaw === null || timerRemainingRaw === undefined || timerRemainingRaw === ''
                    ? timerDurationSeconds
                    : Math.max(toNumber(timerRemainingRaw, timerDurationSeconds), 0);
                const timerTimeIsUp = toBooleanFlag(kuisStatus.waktu_habis) ||
                    (timerDurationSeconds > 0 && timerRemainingSeconds <= 0);
                const timerMeta = {
                    durationSeconds: timerDurationSeconds,
                    remainingSeconds: timerRemainingSeconds,
                    timeIsUp: timerTimeIsUp,
                };
                const hasAnsweredProgress = (s) => s?.progres && s.progres.id_soal_jawaban !== null && s.progres.id_soal_jawaban !== undefined && s.progres.id_soal_jawaban !== '';
                const kuisLulus = toBooleanFlag(kuisStatus.lulus) || toBooleanFlag(kuisStatus.percobaan_terakhir?.lulus);
                const kuisTerkunci = toBooleanFlag(kuisStatus.terkunci) || safeAttemptsLeft <= 0;
                const bolehMengulang = toBooleanFlag(kuisStatus.boleh_mengulang) && !kuisLulus && !kuisTerkunci;
                const isReview = (Boolean(kuis?.mode_review) || kuisLulus) && kuisLulus;
                const isLocked = isReview || (typeof quizLockedStatus === 'boolean' ? quizLockedStatus : kuisTerkunci);

                if (isLocked) {
                    stopExamLock();
                    resetQuizTimer();
                }

                const selectedAnswerId = (s) => isReview && hasAnsweredProgress(s) ? s.progres.id_soal_jawaban : null;
                const isQuestionCorrect = (s) => isReview && hasAnsweredProgress(s) && Boolean(s.progres?.benar);

                const soalHtml = soalList.map((s, idx) => {
                    const userAnswer = selectedAnswerId(s);
                    const questionCorrect = isQuestionCorrect(s);
                    const correctAnswer = (s.jawaban || []).find((j) => Boolean(j.benar));

                    const reviewHeader = isReview
                        ? `<span class="quiz-review-badge ${questionCorrect ? 'correct' : 'wrong'}">
                                ${questionCorrect ? 'Jawaban Benar' : 'Jawaban Salah'}
                           </span>`
                        : `<span class="neo-badge text-xs px-3 py-1 font-bold">${soalList.length} soal</span>`;

                    const opsiHtml = (s.jawaban || []).map((j) => {
                        const isUserChoice = Number(userAnswer) === Number(j.id_soal_jawaban);
                        const isCorrectChoice = Boolean(j.benar);
                        const labelClasses = [
                            'quiz-option-card',
                            'flex',
                            'items-start',
                            'gap-3',
                            'p-3.5',
                            'transition-all',
                        ];

                        if (!isLocked) labelClasses.push('cursor-pointer');
                        if (isUserChoice) labelClasses.push('is-selected');
                        if (isReview && isCorrectChoice) labelClasses.push('is-correct');
                        if (isReview && isUserChoice && !isCorrectChoice) labelClasses.push('is-wrong');

                        const badges = isReview
                            ? `<div class="flex flex-wrap items-center gap-1.5 mt-2">
                                    ${isUserChoice ? `<span class="quiz-review-badge neutral">Jawaban Anda</span>` : ''}
                                    ${isCorrectChoice ? `<span class="quiz-review-badge correct">Kunci Jawaban</span>` : ''}
                                    ${isUserChoice && isCorrectChoice ? `<span class="quiz-review-badge correct">Benar</span>` : ''}
                                    ${isUserChoice && !isCorrectChoice ? `<span class="quiz-review-badge wrong">Salah</span>` : ''}
                               </div>`
                            : '';

                        return `
                            <label class="${labelClasses.join(' ')}">
                                <input type="radio"
                                    class="mt-1 text-primary-600 focus:ring-primary-600 quiz-option"
                                    data-soal="${s.id_soal}"
                                    data-answer="${j.id_soal_jawaban}"
                                    name="soal_${s.id_soal}"
                                    ${isUserChoice ? 'checked' : ''}
                                    ${isLocked ? 'disabled' : ''}>

                                <span class="flex-1 min-w-0">
                                    <span class="block text-sm text-gray-700 leading-relaxed">${h(j.teks_jawaban)}</span>
                                    ${badges}
                                </span>
                            </label>
                        `;
                    }).join('');

                    const explanationHtml = isReview
                        ? `<div class="neo-card-soft mt-4 p-4">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 ${questionCorrect ? 'text-emerald-600' : 'text-red-600'} shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>

                                    <div class="flex-1">
                                        <p class="text-sm font-black ${questionCorrect ? 'text-emerald-700' : 'text-red-700'} mb-1">
                                            ${questionCorrect ? 'Jawaban kamu benar.' : 'Jawaban kamu salah.'}
                                        </p>
                                        ${correctAnswer ? `<p class="text-xs text-gray-600 mb-2">Kunci jawaban: <strong>${h(correctAnswer.teks_jawaban)}</strong></p>` : ''}
                                        ${s.penjelasan
                                            ? `<div class="text-sm text-gray-700 leading-relaxed">${safeHtml(s.penjelasan)}</div>`
                                            : `<p class="text-xs text-gray-500">Belum ada pembahasan untuk soal ini.</p>`
                                        }
                                    </div>
                                </div>
                           </div>`
                        : '';

                    return `
                        <div class="quiz-question ${idx === 0 ? 'block' : 'hidden'} p-4" data-step="${idx}">
                            <div class="flex items-center justify-between gap-2 mb-4">
                                <div class="flex items-center gap-2">
                                    <span class="flex items-center justify-center w-9 h-9 rounded-full bg-primary-600 text-white text-sm font-black">
                                        ${idx + 1}
                                    </span>
                                    <span class="text-sm font-bold text-gray-500">Soal ${idx + 1}</span>
                                </div>

                                ${reviewHeader}
                            </div>

                            <div class="text-gray-900 mb-5 leading-relaxed text-sm font-medium">
                                ${h(s.teks_soal)}
                            </div>

                            <div class="space-y-2.5">
                                ${opsiHtml}
                            </div>

                            ${explanationHtml}
                        </div>
                    `;
                }).join('') || '<div class="neo-inset text-center py-8 text-gray-500">Belum ada soal tersedia.</div>';

                const riwayatHtml = kuisHistory.length
                    ? kuisHistory.map((entry) => {
                        const isBest = Number(entry.nilai ?? 0) === Number(safeBestScore);

                        return `
                            <div class="neo-card-soft flex items-center justify-between gap-3 p-3">
                                <div>
                                    <p class="text-sm font-black text-gray-800">Percobaan ${h(entry.percobaan_ke)}</p>
                                    <p class="text-xs text-gray-500">${h(entry.diserahkan_pada || '-')}</p>
                                </div>

                                <div class="text-right">
                                    <div class="text-lg font-black ${isBest ? 'text-primary-600' : 'text-gray-800'}">
                                        ${h(entry.nilai ?? 0)}%
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        ${h(entry.jawaban_benar ?? 0)}/${h(entry.total_soal ?? 0)} benar${entry.lulus ? ' - Lulus' : ''}
                                    </p>
                                    ${isBest
                                        ? '<span class="inline-flex items-center px-2 py-0.5 rounded-full bg-primary-50 text-primary-700 text-xs font-black mt-1">Terbaik</span>'
                                        : ''
                                    }
                                </div>
                            </div>
                        `;
                    }).join('')
                    : `<div class="neo-inset text-center py-6">
                            <p class="text-sm text-gray-500">Belum ada percobaan.</p>
                            <p class="text-xs text-gray-400 mt-1">Kerjakan kuis untuk melihat riwayat.</p>
                        </div>`;

                const reviewSummary = isReview
                    ? `<div class="neo-card-soft p-4">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                                <div>
                                    <p class="text-sm font-black text-gray-900">Mode Review Kuis</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        ${kuisLulus
                                            ? 'Kuis sudah lulus. Kamu bisa melihat koreksi benar dan salah.'
                                            : bolehMengulang
                                                ? 'Nilai belum memenuhi batas kelulusan. Lihat koreksi, lalu klik tombol Ulangi Kuis untuk mencoba lagi.'
                                                : 'Nilai belum memenuhi batas kelulusan dan batas percobaan sudah tercapai. Jawaban dikunci.'
                                        }
                                    </p>
                                </div>

                                <div class="grid grid-cols-3 gap-2 text-center text-xs">
                                    <div class="neo-inset px-3 py-2">
                                        <p class="text-gray-500 font-bold">Nilai</p>
                                        <p class="text-primary-600 font-black text-base">${safeBestScore}%</p>
                                    </div>
                                    <div class="neo-inset px-3 py-2">
                                        <p class="text-gray-500 font-bold">Percobaan</p>
                                        <p class="text-gray-900 font-black text-base">${totalAttempts}</p>
                                    </div>
                                    <div class="neo-inset px-3 py-2">
                                        <p class="text-gray-500 font-bold">Status</p>
                                        <p class="${kuisLulus ? 'text-emerald-600' : 'text-red-600'} font-black text-base">
                                            ${kuisLulus ? 'Lulus' : 'Belum Lulus'}
                                        </p>
                                    </div>
                                </div>
                            </div>
                       </div>`
                    : '';

                const kelasSudahSelesaiUntukRating = Boolean(state.ringkasan?.bisa_sertifikat) ||
                    Number(state.ringkasan?.persentase || 0) >= 100;

                const reviewRatingAction = isReview && kuisLulus && kelasSudahSelesaiUntukRating
                    ? `<div class="neo-card-soft p-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <div>
                                    <p class="text-sm font-black text-gray-900">Sudah melihat hasil koreksi?</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Periksa dulu jawaban benar dan salah. Setelah itu, beri rating untuk membuka sertifikat.
                                    </p>
                                </div>

                                <button id="openRatingAfterReviewBtn" class="neo-btn-primary px-5 py-2.5 text-sm whitespace-nowrap">
                                    Beri Rating & Buka Sertifikat
                                </button>
                            </div>
                       </div>`
                    : '';

                const reviewRetakeAction = isReview && bolehMengulang
                    ? `<div class="neo-card-soft p-4 border border-amber-200 bg-amber-50">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <div>
                                    <p class="text-sm font-black text-amber-900">Nilai belum lulus</p>
                                    <p class="text-xs text-amber-700 mt-1">
                                        Kamu masih punya ${safeAttemptsLeft} percobaan. Klik tombol ini untuk mengulang kuis.
                                    </p>
                                </div>

                                <button id="retryQuizBtn" class="neo-btn-primary px-5 py-2.5 text-sm whitespace-nowrap">
                                    Ulangi Kuis
                                </button>
                            </div>
                       </div>`
                    : '';

                els.materiContent.innerHTML = `
                    <div class="space-y-5">
                        <div class="neo-card-soft p-4 space-y-4">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <h4 class="text-lg font-black text-gray-900 mb-1">${h(kuis?.meta?.judul || 'Kuis')}</h4>
                                    <p class="text-sm text-gray-500">${h(kuis?.meta?.deskripsi || 'Jawab semua pertanyaan dengan benar.')}</p>
                                </div>

                                <div class="flex flex-wrap items-center gap-2 text-xs">
                                    <span class="neo-badge px-3 py-2 font-black">${soalList.length} soal</span>
                                    <span class="neo-badge px-3 py-2 font-black">Sisa ${safeAttemptsLeft}/${safeMaxAttempts}</span>
                                    <span class="neo-badge px-3 py-2 font-black">Terbaik ${safeBestScore}%</span>
                                    ${!isLocked && timerDurationSeconds > 0
                                        ? `<span class="neo-badge px-3 py-2 font-black text-primary-700">
                                                Durasi: ${formatQuizTime(timerDurationSeconds)}
                                           </span>`
                                        : ''
                                    }
                                </div>
                            </div>

                            <div class="neo-inset p-3 text-sm ${isReview ? 'text-primary-700' : isLocked ? 'text-red-700' : 'text-gray-700'}">
                                ${isReview
                                    ? 'Kuis sudah selesai. Halaman ini hanya untuk melihat koreksi jawaban benar dan salah.'
                                    : isLocked
                                        ? 'Batas percobaan tercapai. Jawaban dikunci.'
                                        : `Kuis ini memakai <strong>Mode Ujian Aman</strong>. Setelah dimulai, halaman wajib tetap fullscreen sampai jawaban dikirim.`
                                }
                            </div>

                            ${!isLocked && timerDurationSeconds > 0 ? `
                                <div class="neo-inset p-4">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
                                        <div>
                                            <p class="text-sm font-black text-gray-900">Timer Kuis</p>
                                            <p id="quizTimerStatus" class="text-xs text-gray-500 mt-1">
                                                Timer belum berjalan. Klik tombol Mulai Kuis Mode Aman untuk memulai waktu pengerjaan.
                                            </p>
                                        </div>

                                        <div id="quizTimerBadge" class="neo-card-soft px-4 py-2 text-lg font-black text-primary-700">
                                            <span id="quizTimerLabel">${formatQuizTime(timerRemainingSeconds)}</span>
                                        </div>
                                    </div>

                                    <div class="neo-progress-track">
                                        <div id="quizTimerBar" class="neo-progress-fill"
                                            style="width: ${timerDurationSeconds > 0 ? Math.max(Math.min((timerRemainingSeconds / timerDurationSeconds) * 100, 100), 0) : 0}%;"></div>
                                    </div>
                                </div>
                            ` : ''}
                        </div>

                        ${reviewSummary}

                        ${reviewRetakeAction}

                        ${reviewRatingAction}

                        ${!isLocked ? `
                            <div id="examLockIntro" class="exam-lock-card p-5">
                                <div class="flex flex-col lg:flex-row lg:items-center gap-5">
                                    <div class="w-16 h-16 rounded-full neo-card-soft flex items-center justify-center shrink-0 exam-lock-pulse">
                                        <svg class="w-8 h-8 text-primary-600" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M12 11c1.104 0 2-.896 2-2V7a2 2 0 10-4 0v2c0 1.104.896 2 2 2zm6 0h-1V7a5 5 0 00-10 0v4H6a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2v-7a2 2 0 00-2-2z"/>
                                        </svg>
                                    </div>

                                    <div class="flex-1">
                                        <p class="text-xs font-black uppercase tracking-[0.18em] text-primary-600 mb-1">
                                            Mode Ujian Aman
                                        </p>
                                        <h5 class="text-xl font-black text-gray-900 mb-2">
                                            Kuis wajib dikerjakan dalam mode fullscreen
                                        </h5>
                                        <p class="text-sm text-gray-600 leading-relaxed">
                                            Jika keluar dari fullscreen, pindah tab, minimize browser, atau membuka aplikasi lain,
                                            sesi kuis langsung dibatalkan, jawaban direset, dan akun otomatis logout.
                                        </p>
                                    </div>
                                </div>

                                <div class="exam-lock-warning p-4 mt-5">
                                    <div class="grid md:grid-cols-3 gap-3 text-sm">
                                        <div class="flex items-start gap-2">
                                            <span class="w-6 h-6 rounded-full bg-red-500 text-white flex items-center justify-center text-xs font-black shrink-0">1</span>
                                            <p class="text-gray-700">Jangan tekan ESC atau keluar fullscreen.</p>
                                        </div>
                                        <div class="flex items-start gap-2">
                                            <span class="w-6 h-6 rounded-full bg-red-500 text-white flex items-center justify-center text-xs font-black shrink-0">2</span>
                                            <p class="text-gray-700">Jangan pindah tab atau aplikasi lain.</p>
                                        </div>
                                        <div class="flex items-start gap-2">
                                            <span class="w-6 h-6 rounded-full bg-red-500 text-white flex items-center justify-center text-xs font-black shrink-0">3</span>
                                            <p class="text-gray-700">Jawaban hanya aman setelah tombol Kirim ditekan.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-5">
                                    <p class="text-xs text-gray-500">
                                        Pastikan perangkat siap sebelum menekan tombol mulai.
                                    </p>

                                    <button id="startExamLockBtn" class="neo-btn-primary px-6 py-3 text-sm">
                                        Mulai Kuis Mode Aman
                                    </button>
                                </div>
                            </div>
                        ` : ''}

                        <div id="quizExamContent" class="${!isLocked ? 'hidden' : ''} space-y-5">
                            <div class="space-y-4">
                                <div id="quizList" class="space-y-4">
                                    ${soalHtml}
                                </div>

                                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                                    <div class="flex items-center gap-2">
                                        <button id="quizPrev" class="neo-btn px-4 py-2 text-xs" disabled>
                                            Sebelumnya
                                        </button>

                                        <button id="quizNext" class="neo-btn px-4 py-2 text-xs" ${soalList.length <= 1 ? 'disabled' : ''}>
                                            Berikutnya
                                        </button>
                                    </div>

                                    <div class="flex flex-col sm:flex-row gap-2">
                                        <button id="resetQuizAnswers" class="neo-btn px-4 py-2 text-sm ${isLocked ? 'hidden' : ''}">
                                            Reset Jawaban
                                        </button>

                                        <button id="submitQuizBtn" class="neo-btn-primary px-6 py-2.5 text-sm ${isLocked ? 'hidden' : ''}"
                                            ${isLocked ? 'disabled' : ''}>
                                            Kirim Jawaban
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="neo-card-soft p-4">
                                <div class="flex items-center justify-between gap-3 mb-3">
                                    <div>
                                        <p class="text-sm font-black text-gray-900">Riwayat Percobaan</p>
                                        <p class="text-xs text-gray-500">Lihat perkembangan nilai terbaikmu.</p>
                                    </div>

                                    <span class="neo-badge px-3 py-1.5 text-xs font-black">Terbaik: ${safeBestScore}%</span>
                                </div>

                                <div class="space-y-2">
                                    ${riwayatHtml}
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                setupQuizInteractions(isLocked, timerMeta);
            }


            function setupQuizInteractions(isLocked, timerMeta = {}) {
                const quizOptions = els.materiContent.querySelectorAll('.quiz-option');

                quizOptions.forEach(opt => {
                    opt.addEventListener('change', (e) => {
                        const soal = e.target.dataset.soal;

                        document.querySelectorAll(`input[name="soal_${soal}"]`).forEach(input => {
                            input.closest('label')?.classList.remove('is-selected');
                        });

                        e.target.closest('label')?.classList.add('is-selected');
                    });
                });

                const questions = Array.from(document.querySelectorAll('.quiz-question'));
                let index = 0;

                const setStep = (targetIndex) => {
                    if (!questions.length) return;

                    index = Math.min(Math.max(targetIndex, 0), questions.length - 1);

                    questions.forEach((el, idx) => {
                        el.classList.toggle('hidden', idx !== index);
                        el.classList.toggle('block', idx === index);
                    });

                    const prevBtn = document.getElementById('quizPrev');
                    const nextBtn = document.getElementById('quizNext');

                    if (prevBtn) prevBtn.disabled = index === 0;
                    if (nextBtn) nextBtn.disabled = index === questions.length - 1;
                };

                const openQuizExamContent = () => {
                    document.getElementById('examLockIntro')?.classList.add('hidden');
                    document.getElementById('quizExamContent')?.classList.remove('hidden');
                    setStep(0);
                };

                const startBtn = document.getElementById('startExamLockBtn');

                if (startBtn && !isLocked) {
                    startBtn.addEventListener('click', async () => {
                        startBtn.disabled = true;
                        startBtn.innerHTML = 'Membuka fullscreen...';

                        const started = await startExamLock();

                        if (!started) {
                            startBtn.disabled = false;
                            startBtn.innerHTML = 'Mulai Kuis Mode Aman';
                            return;
                        }

                        startBtn.innerHTML = 'Memulai timer...';

                        try {
                            const serverTimerMeta = await startQuizTimerFromBackend(timerMeta);

                            openQuizExamContent();
                            startQuizTimer(serverTimerMeta);

                            startBtn.innerHTML = 'Mode Ujian Aktif';
                        } catch (err) {
                            console.error(err);

                            resetQuizTimer();
                            await stopExamLock({ exitFullscreen: true });

                            startBtn.disabled = false;
                            startBtn.innerHTML = 'Mulai Kuis Mode Aman';

                            showAlert({
                                title: 'Gagal Memulai Kuis',
                                message: err.message || 'Timer kuis gagal dimulai. Silakan coba lagi.',
                                icon: 'error',
                                confirmText: 'Tutup',
                                confirmColor: '#dc2626',
                            });
                        }
                    });
                }

                document.getElementById('quizPrev')?.addEventListener('click', () => setStep(index - 1));
                document.getElementById('quizNext')?.addEventListener('click', () => setStep(index + 1));

                const resetBtn = document.getElementById('resetQuizAnswers');
                const submitBtn = document.getElementById('submitQuizBtn');

                if (resetBtn && !isLocked) {
                    resetBtn.addEventListener('click', () => {
                        Swal.fire({
                            title: 'Reset Jawaban?',
                            html: '<p class="text-gray-600">Semua jawaban yang dipilih akan dihapus.</p>',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, reset',
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#ef4444',
                            cancelButtonColor: '#6b7280',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                resetCurrentQuizAnswers();
                                setStep(0);
                            }
                        });
                    });
                }

                if (submitBtn && !isLocked) {
                    submitBtn.addEventListener('click', () => submitQuizAnswers());
                }

                resetQuizTimer();

                if (!isLocked) {
                    updateQuizTimerDisplay(timerMeta.remainingSeconds ?? timerMeta.durationSeconds ?? 0);
                }

                document.getElementById('openRatingAfterReviewBtn')?.addEventListener('click', async () => {
                    await showRatingModalAfterComplete();
                });

                document.getElementById('retryQuizBtn')?.addEventListener('click', async () => {
                    await loadMateri(state.currentProgresId, true);
                });

                setStep(0);
            }

            function renderMateriContent(payload) {
                const { materi, kuis, progres } = payload;
                const payloadProgresId = getProgresId(payload);
                const materiRow = flattenMateri().find(m => getProgresId(m) === payloadProgresId);
                const kuisStatus = kuis?.status || {};

                state.currentProgresId = payloadProgresId;

                const tipe = materi?.tipe || payload.tipe_materi;

                if (tipe !== 'kuis' && state.examLock.active) {
                    stopExamLock();
                }

                if (tipe !== 'kuis') {
                    resetQuizTimer();
                }

                if (tipe !== 'video') {
                    resetVideoGuard();
                }

                const progresSelesai = toBooleanFlag(progres?.selesai) || toBooleanFlag(materiRow?.selesai);

                let attemptsLeft = 0;
                let maxAttempts = 1;
                let bestScore = 0;
                let quizLockedStatus = false;
                let sudahSelesai = progresSelesai;

                if (tipe === 'kuis') {
                    const totalAttempts = Math.max(toNumber(kuisStatus.total_percobaan), 0);
                    const rawRemaining = kuisStatus.percobaan_sisa;
                    const hasExplicitRemaining = rawRemaining !== undefined && rawRemaining !== null && rawRemaining !== '';
                    const explicitRemaining = hasExplicitRemaining ? toNumber(rawRemaining, NaN) : NaN;

                    maxAttempts = Math.max(toNumber(kuisStatus.maksimal_percobaan, 1), 1);

                    const derivedRemaining = Math.max(maxAttempts - totalAttempts, 0);

                    attemptsLeft = Number.isFinite(explicitRemaining) && explicitRemaining >= 0
                        ? explicitRemaining
                        : derivedRemaining;

                    bestScore = Math.max(toNumber(kuisStatus.nilai_tertinggi), 0);

                    const kuisLulus = toBooleanFlag(kuisStatus.lulus) || toBooleanFlag(kuisStatus.percobaan_terakhir?.lulus);
                    const kuisTerkunci = toBooleanFlag(kuisStatus.terkunci);
                    const modeReviewKuis = Boolean(kuis?.mode_review) && kuisLulus;

                    quizLockedStatus = modeReviewKuis || kuisLulus || kuisTerkunci;
                    sudahSelesai = kuisLulus;
                }

                if (els.markDoneBtn) {
                    const nonQuiz = tipe !== 'kuis';

                    els.markDoneBtn.disabled = !state.currentProgresId || sudahSelesai || !nonQuiz;
                    els.markDoneBtn.classList.toggle('hidden', !nonQuiz);
                    els.markDoneBtn.textContent = sudahSelesai ? 'Sudah Selesai' : 'Tandai Selesai';
                }

                if (els.materiTitle) {
                    els.materiTitle.textContent = materi?.judul || materiRow?.materi_judul || 'Materi';
                }

                if (els.materiMeta) {
                    const selesaiForMeta = tipe === 'kuis' ? sudahSelesai : progresSelesai;

                    els.materiMeta.innerHTML = `
                        <span class="px-2.5 py-1 font-bold uppercase">${h(tipe || 'Materi')}</span>
                        <span class="px-2.5 py-1 font-bold">${selesaiForMeta ? 'Selesai' : 'Belum selesai'}</span>
                        ${materiRow ? `<span class="px-2.5 py-1 font-bold">Urutan ke-${h(materiRow.urutan)}</span>` : ''}
                    `;
                }

                if (!tipe || tipe === 'text' || tipe === 'artikel') {
                    renderTextMateri(materi?.content);
                    return;
                }

                if (tipe === 'video') {
                    renderVideoMateri(materi || {}, {
                        selesai: progresSelesai,
                    });
                    return;
                }

                if (tipe === 'kuis') {
                    renderQuizMateri({
                        kuis,
                        progres,
                        materiRow,
                        attemptsLeft,
                        maxAttempts,
                        bestScore,
                        sudahSelesaiKuis: sudahSelesai,
                        quizLockedStatus,
                    });

                    return;
                }

                els.materiContent.innerHTML = `
                    <div class="neo-inset text-center py-10 text-gray-500">
                        <p>Tipe materi ini belum didukung.</p>
                    </div>
                `;
            }

            async function loadMenu() {
                renderLoading(els.sidebar, 'Memuat materi...');

                try {
                    const data = await fetchJson(routes.menu);

                    state.progres = data.progres || [];

                    rebuildFlatMateri();

                    state.ringkasan = data.ringkasan;

                    renderHero(state.ringkasan);

                    const current = getProgresId(data.navigasi?.materi_saat_ini) ||
                        getProgresId(flattenMateri().find(m => toBooleanFlag(m.bisa_diakses) || toBooleanFlag(m.selesai) || toBooleanFlag(m.materi_selesai) || toBooleanFlag(m.kuis_selesai)));

                    if (current) {
                        const currentRow = flattenMateri().find(m => getProgresId(m) === current);

                        if (currentRow?.bagian_id) {
                            state.openBagian = {
                                [currentRow.bagian_id]: true
                            };
                        }
                    }

                    renderSidebar();
                    applySidebarVisibility();

                    if (current) {
                        updateSidebarActive(current);
                        await loadMateri(current, false);
                    }
                } catch (err) {
                    console.error(err);

                    els.sidebar.innerHTML =
                        `<div class="neo-inset p-4 text-red-700 text-sm">${h(err.message)}</div>`;

                    showAlert({
                        title: 'Gagal Memuat',
                        message: err.message,
                        icon: 'error'
                    });
                }
            }

            async function loadMateri(progresId, scroll = true, options = {}) {
                if (!progresId) return;

                if (
                    state.examLock.active &&
                    state.examLock.currentProgresId &&
                    String(progresId) !== String(state.examLock.currentProgresId)
                ) {
                    await terminateExamSession('Anda mencoba meninggalkan kuis saat Mode Ujian Aman sedang berjalan.');
                    return;
                }

                if (state.loadingMateri === progresId) return;

                state.loadingMateri = progresId;

                const baseUrl = routes.materi
                    .replace('__TOKEN__', pendaftaranToken)
                    .replace('__PROGRES__', progresId);

                const queryParams = new URLSearchParams();

                if (options.quizReview || options.mode === 'quiz-review') {
                    queryParams.set('mode', 'quiz-review');
                }

                const url = queryParams.toString()
                    ? `${baseUrl}?${queryParams.toString()}`
                    : baseUrl;

                renderLoading(els.materiContent, 'Memuat materi...', 'Mohon tunggu sebentar.');

                try {
                    const data = await fetchJson(url);
                    const payloadProgresId = getProgresId(data) || progresId;

                    renderMateriContent({
                        ...data,
                        id_progres_kelas: payloadProgresId,
                        token: payloadProgresId,
                        selesai: data.progres?.selesai ?? flattenMateri().find(m => getProgresId(m) === payloadProgresId)?.selesai,
                    });

                    updateSidebarActive(payloadProgresId);

                    if (state.currentProgresId) {
                        const currentRow = flattenMateri().find(m => getProgresId(m) === state.currentProgresId);

                        if (currentRow?.bagian_id) {
                            state.openBagian = {
                                [currentRow.bagian_id]: true
                            };

                            syncAccordionState();
                        }
                    }

                    updateNavControls(data.navigasi);

                    if (scroll) {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    }
                } catch (err) {
                    console.error(err);

                    els.materiContent.innerHTML = `
                        <div class="neo-inset text-center py-10 px-4">
                            <div class="w-16 h-16 rounded-full neo-card-soft flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>

                            <h4 class="text-lg font-black text-gray-900 mb-2">Gagal memuat materi</h4>
                            <p class="text-sm text-gray-500 mb-4">${h(err.message)}</p>

                            <button onclick="location.reload()" class="neo-btn-primary px-5 py-2.5 text-sm">
                                Muat ulang halaman
                            </button>
                        </div>
                    `;

                    showAlert({
                        title: 'Gagal Memuat Materi',
                        message: err.message,
                        icon: 'error'
                    });
                } finally {
                    state.loadingMateri = null;
                }
            }

            async function markDone() {
                if (!state.currentProgresId) return;

                const url = routes.update
                    .replace('__TOKEN__', pendaftaranToken)
                    .replace('__PROGRES__', state.currentProgresId);

                const result = await Swal.fire({
                    title: 'Tandai Selesai?',
                    html: '<p class="text-gray-600">Anda yakin sudah menyelesaikan materi ini?</p>',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, tandai selesai',
                    cancelButtonText: 'Belum',
                    confirmButtonColor: '#0284c7',
                    cancelButtonColor: '#6b7280',
                    reverseButtons: true
                });

                if (!result.isConfirmed) return;

                els.markDoneBtn.disabled = true;
                els.markDoneBtn.innerHTML = 'Menyimpan...';

                try {
                    const data = await fetchJson(url, {
                        method: 'POST',
                        body: JSON.stringify({
                            selesai: true
                        }),
                    });

                    await Swal.fire({
                        title: 'Berhasil!',
                        html: `<p class="text-gray-600">${h(data._message || data.message || 'Progres berhasil disimpan!')}</p>`,
                        icon: 'success',
                        confirmButtonText: 'Lanjutkan',
                        confirmButtonColor: '#0284c7',
                        timer: 1500
                    });

                    await loadMenu();

                    if (state.currentProgresId) {
                        await loadMateri(state.currentProgresId, false);
                    }
                } catch (err) {
                    console.error(err);

                    showAlert({
                        title: 'Gagal Menyimpan',
                        message: err.message,
                        icon: 'error'
                    });
                } finally {
                    els.markDoneBtn.disabled = false;
                    els.markDoneBtn.innerHTML = 'Tandai Selesai';
                }
            }

            async function submitQuizAnswers(optionsSubmit = {}) {
                if (!state.currentProgresId) return;

                const autoSubmit = Boolean(optionsSubmit.autoSubmit);
                const submittedQuizProgresId = state.currentProgresId;
                const {
                    optionInputs,
                    soalIds,
                    answeredIds,
                    unanswered,
                    jawaban,
                } = collectQuizAnswers();

                if (!optionInputs.length) {
                    if (!autoSubmit) {
                        showAlert({
                            title: 'Tidak Ada Soal',
                            message: 'Tidak ada soal yang dapat dikirim.',
                            icon: 'warning'
                        });
                    }

                    return;
                }

                if (!autoSubmit) {
                    const hasUnanswered = unanswered.length > 0;
                    const confirmResult = window.Swal
                        ? await Swal.fire({
                            title: hasUnanswered ? 'Masih Ada Soal Kosong' : 'Kirim Jawaban?',
                            html: `
                                <div class="text-left space-y-3">
                                    <p class="text-gray-600">
                                        ${hasUnanswered
                                            ? `Ada <strong>${unanswered.length}</strong> soal yang belum dijawab. Jika tetap dikirim, soal kosong akan dihitung salah.`
                                            : 'Pastikan semua jawaban sudah benar. Setelah dikirim, percobaan akan terhitung.'
                                        }
                                    </p>

                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg">
                                            <p class="text-xs text-blue-600 mb-1">Soal terjawab</p>
                                            <p class="text-lg font-bold text-blue-900">${answeredIds.length}/${soalIds.length}</p>
                                        </div>

                                        <div class="p-3 ${hasUnanswered ? 'bg-amber-50 border-amber-200' : 'bg-emerald-50 border-emerald-200'} border rounded-lg">
                                            <p class="text-xs ${hasUnanswered ? 'text-amber-600' : 'text-emerald-600'} mb-1">Status</p>
                                            <p class="text-sm font-bold ${hasUnanswered ? 'text-amber-900' : 'text-emerald-900'}">
                                                ${hasUnanswered ? `${unanswered.length} kosong` : 'Lengkap'}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            `,
                            icon: hasUnanswered ? 'warning' : 'question',
                            showCancelButton: true,
                            confirmButtonText: hasUnanswered ? 'Tetap kirim' : 'Kirim sekarang',
                            cancelButtonText: 'Periksa lagi',
                            confirmButtonColor: hasUnanswered ? '#f59e0b' : '#0284c7',
                            cancelButtonColor: '#6b7280',
                            reverseButtons: true,
                            focusCancel: true
                        })
                        : { isConfirmed: window.confirm(hasUnanswered
                            ? `Ada ${unanswered.length} soal kosong. Tetap kirim?`
                            : 'Kirim jawaban sekarang?'
                        ) };

                    if (!confirmResult.isConfirmed) return;
                }

                const url = routes.submitQuiz
                    .replace('__TOKEN__', pendaftaranToken)
                    .replace('__PROGRES__', state.currentProgresId);

                const btn = document.getElementById('submitQuizBtn');

                if (btn) {
                    btn.disabled = true;
                    btn.innerHTML = autoSubmit ? 'Mengirim otomatis...' : 'Mengirim...';
                }

                lockQuizInputsAfterTimeout();

                try {
                    const data = await fetchJson(url, {
                        method: 'POST',
                        body: JSON.stringify({
                            jawaban,
                            otomatis_karena_waktu_habis: autoSubmit,
                        }),
                    });

                    const hasil = data.hasil || {};
                    const status = data.status || {};
                    const bestScore = status.nilai_tertinggi ?? hasil.nilai ?? 0;
                    const currentScore = hasil.nilai ?? 0;
                    const isPassed = hasil.lulus ?? false;
                    const canRetry = toBooleanFlag(status.boleh_mengulang);
                    const isTimeUpResult = autoSubmit || toBooleanFlag(hasil.waktu_habis) || toBooleanFlag(status.waktu_habis);

                    resetQuizTimer();
                    await stopExamLock({ exitFullscreen: true });

                    if (window.Swal) {
                        await Swal.fire({
                            title: isTimeUpResult
                                ? 'Waktu Habis'
                                : (isPassed ? 'Selamat! Anda Lulus!' : (canRetry ? 'Nilai Belum Lulus' : 'Percobaan Habis')),
                            html: `
                                <div class="text-left space-y-3">
                                    ${isTimeUpResult ? `
                                        <div class="p-3 bg-amber-50 border border-amber-200 rounded-lg">
                                            <p class="text-sm font-bold text-amber-900">
                                                Jawaban otomatis dikirim karena waktu kuis sudah habis.
                                            </p>
                                            <p class="text-xs text-amber-700 mt-1">
                                                Soal yang belum dijawab dihitung salah.
                                            </p>
                                        </div>
                                    ` : ''}

                                    <div class="p-4 ${isPassed ? 'bg-emerald-50 border-emerald-200' : 'bg-amber-50 border-amber-200'} border rounded-lg">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-sm font-medium ${isPassed ? 'text-emerald-700' : 'text-amber-700'}">Nilai Anda</span>
                                            <span class="text-3xl font-bold ${isPassed ? 'text-emerald-900' : 'text-amber-900'}">${currentScore}%</span>
                                        </div>

                                        <p class="text-xs ${isPassed ? 'text-emerald-600' : 'text-amber-600'}">
                                            Jawaban benar: ${hasil.jawaban_benar ?? 0}/${hasil.total_soal ?? '-'}
                                        </p>

                                        <p class="text-xs text-gray-500 mt-1">
                                            Terjawab: ${hasil.terjawab ?? answeredIds.length}/${hasil.total_soal ?? soalIds.length}
                                        </p>
                                    </div>

                                    ${!isPassed ? `
                                        <div class="p-3 ${canRetry ? 'bg-amber-50 border-amber-200' : 'bg-red-50 border-red-200'} border rounded-lg">
                                            <p class="text-sm font-bold ${canRetry ? 'text-amber-900' : 'text-red-900'}">
                                                ${canRetry
                                                    ? 'Nilai belum memenuhi batas kelulusan. Silakan pelajari materi lagi sebelum mengulang kuis.'
                                                    : 'Nilai belum memenuhi batas kelulusan dan batas percobaan sudah habis.'
                                                }
                                            </p>
                                        </div>
                                    ` : ''}

                                    <div class="grid grid-cols-2 gap-2 text-sm">
                                        <div class="p-3 bg-gray-50 rounded-lg">
                                            <p class="text-xs text-gray-500 mb-1">Percobaan</p>
                                            <p class="font-bold text-gray-900">Ke-${hasil.percobaan_ke ?? '-'}</p>
                                        </div>

                                        <div class="p-3 bg-gray-50 rounded-lg">
                                            <p class="text-xs text-gray-500 mb-1">Nilai Terbaik</p>
                                            <p class="font-bold text-primary-700">${bestScore}%</p>
                                        </div>
                                    </div>
                                </div>
                            `,
                            icon: isPassed ? 'success' : (canRetry ? 'warning' : 'error'),
                            confirmButtonText: isPassed ? 'Lihat Koreksi' : 'Pelajari Materi Lagi',
                            confirmButtonColor: '#0284c7',
                            allowOutsideClick: false,
                        });
                    }

                    await loadMenu();

                    if (!isPassed) {
                        // Peserta gagal tidak boleh melihat koreksi. Backend juga sudah mengubah materi
                        // menjadi belum selesai, jadi halaman ini akan kembali menampilkan materi utama.
                        await loadMateri(submittedQuizProgresId, false);
                        return;
                    }

                    await loadMateri(submittedQuizProgresId, false, {
                        quizReview: true,
                    });

                    const kelasSudahSelesai = Boolean(state.ringkasan?.bisa_sertifikat) ||
                        Number(state.ringkasan?.persentase || 0) >= 100;

                    if (kelasSudahSelesai && window.Swal) {
                        await Swal.fire({
                            title: 'Lihat Hasil Koreksi',
                            html: `
                                <div class="text-left space-y-3">
                                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl">
                                        <p class="font-bold text-blue-900 mb-1">Jawaban benar dan salah sudah ditampilkan.</p>
                                        <p class="text-sm text-blue-700">
                                            Silakan cek koreksi kuis terlebih dahulu. Setelah selesai melihat hasilnya,
                                            klik tombol <strong>Beri Rating & Buka Sertifikat</strong> di halaman review kuis.
                                        </p>
                                    </div>
                                </div>
                            `,
                            icon: 'info',
                            confirmButtonText: 'Lihat Hasil Jawaban',
                            confirmButtonColor: '#0284c7',
                        });

                        return;
                    }

                    const nextId = getProgresId(data.navigasi?.materi_selanjutnya);

                    if (nextId && data.navigasi.materi_selanjutnya.bisa_diakses) {
                        setTimeout(() => loadMateri(nextId), 1000);
                    }
                } catch (err) {
                    console.error(err);

                    if (window.Swal) {
                        Swal.close();
                    }

                    showAlert({
                        title: autoSubmit ? 'Gagal Mengirim Otomatis' : 'Gagal Mengirim',
                        message: err.message,
                        icon: 'error'
                    });

                    if (state.currentProgresId) {
                        await loadMateri(state.currentProgresId, false);
                    }
                } finally {
                    if (btn) {
                        btn.disabled = false;
                        btn.innerHTML = 'Kirim Jawaban';
                    }
                }
            }


            els.markDoneBtn.addEventListener('click', markDone);

            els.prevBtn.addEventListener('click', (e) => {
                const target = e.currentTarget.dataset.target;

                if (target) loadMateri(target);
            });

            els.nextBtn.addEventListener('click', (e) => {
                const target = e.currentTarget.dataset.target;

                if (target) loadMateri(target);
            });

            if (els.toggleSidebarBtn) {
                els.toggleSidebarBtn.addEventListener('click', () => {
                    state.sidebarOpen = !state.sidebarOpen;
                    applySidebarVisibility();
                });

                window.matchMedia('(min-width: 1024px)').addEventListener('change', () => {
                    if (!window.matchMedia('(min-width: 1024px)').matches) {
                        state.sidebarOpen = false;
                    }

                    applySidebarVisibility();
                });
            }

            setupExamLockGuards();

            applySidebarVisibility();
            loadMenu();
        })();
    </script>
</body>

</html>