@extends('content.pengguna.layouts')

@section('pengguna_css')
    <style>
        :root {
            --neo-bg: #e7e5e4;
            --neo-surface: #ecebea;
            --neo-primary: #009ef7;
            --neo-primary-dark: #0085d1;
            --neo-success: #22c55e;
            --neo-success-dark: #16a34a;
            --neo-text: #1f2937;
            --neo-muted: #6b7280;
            --neo-light: rgba(255, 255, 255, 0.92);
            --neo-dark: rgba(120, 113, 108, 0.22);
            --neo-dark-soft: rgba(120, 113, 108, 0.14);
            --neo-inset-dark: rgba(120, 113, 108, 0.16);
            --neo-inset-light: rgba(255, 255, 255, 0.78);
        }

        .neo-myclass-page {
            width: 100%;
            color: var(--neo-text);
        }

        .neo-myclass-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
        }

        .neo-myclass-title {
            color: var(--neo-text);
            font-weight: 900;
            letter-spacing: -.035em;
            margin-bottom: 7px;
        }

        .neo-myclass-subtitle {
            color: var(--neo-muted);
            font-weight: 700;
            line-height: 1.65;
            margin-bottom: 0;
            max-width: 680px;
        }

        .neo-myclass-badge {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 16px;
            border-radius: 999px;
            color: var(--neo-primary);
            background: var(--neo-surface);
            font-weight: 900;
            white-space: nowrap;
            box-shadow:
                inset 4px 4px 9px var(--neo-inset-dark),
                inset -4px -4px 9px var(--neo-inset-light);
        }

        .neo-empty-card {
            border: 0;
            border-radius: 30px;
            background: var(--neo-surface);
            box-shadow:
                12px 12px 28px var(--neo-dark),
                -12px -12px 28px var(--neo-light);
            position: relative;
            overflow: hidden;
        }

        .neo-empty-card::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            right: -220px;
            top: -230px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(0, 158, 247, .16), transparent 68%);
            pointer-events: none;
        }

        .neo-empty-card::after {
            content: "";
            position: absolute;
            width: 320px;
            height: 320px;
            left: -180px;
            bottom: -190px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(255, 255, 255, .78), transparent 64%);
            pointer-events: none;
        }

        .neo-empty-inner {
            position: relative;
            z-index: 1;
            padding: 52px 24px;
            text-align: center;
        }

        .neo-empty-icon {
            width: 84px;
            height: 84px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 26px;
            color: var(--neo-primary);
            background: var(--neo-surface);
            box-shadow:
                8px 8px 18px var(--neo-dark-soft),
                -8px -8px 18px var(--neo-light);
            margin-bottom: 24px;
        }

        .neo-empty-icon i {
            font-size: 38px;
        }

        .neo-empty-title {
            color: var(--neo-text);
            font-weight: 900;
            margin-bottom: 10px;
        }

        .neo-empty-desc {
            color: var(--neo-muted);
            font-weight: 700;
            line-height: 1.7;
            max-width: 560px;
            margin: 0 auto 24px;
        }

        .neo-course-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 22px;
        }

        .neo-course-card {
            height: 100%;
            border: 0;
            border-radius: 28px;
            background: var(--neo-surface);
            box-shadow:
                9px 9px 22px var(--neo-dark),
                -9px -9px 22px var(--neo-light);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: .22s ease;
        }

        .neo-course-card:hover {
            transform: translateY(-3px);
            box-shadow:
                12px 12px 28px rgba(120, 113, 108, .26),
                -12px -12px 28px rgba(255, 255, 255, .9);
        }

        .neo-course-image-wrap {
            padding: 12px 12px 0;
        }

        .neo-course-image-box {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 9;
            border-radius: 22px;
            overflow: hidden;
            background: var(--neo-surface);
            box-shadow:
                inset 5px 5px 12px var(--neo-inset-dark),
                inset -5px -5px 12px var(--neo-inset-light);
        }

        .neo-course-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .neo-status-badge {
            position: absolute;
            right: 12px;
            top: 12px;
            min-height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            border-radius: 999px;
            color: var(--neo-primary);
            background: rgba(236, 235, 234, .94);
            backdrop-filter: blur(8px);
            font-size: 10px;
            font-weight: 900;
            letter-spacing: .04em;
            text-transform: uppercase;
            box-shadow:
                4px 4px 10px rgba(0, 0, 0, .12),
                -4px -4px 10px rgba(255, 255, 255, .52);
        }

        .neo-status-badge.is-finished {
            color: var(--neo-success-dark);
        }

        .neo-course-body {
            padding: 18px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .neo-course-title {
            min-height: 48px;
            margin-bottom: 16px;
        }

        .neo-course-title a {
            color: var(--neo-text);
            font-size: 15px;
            font-weight: 900;
            line-height: 1.45;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: .2s ease;
        }

        .neo-course-title a:hover {
            color: var(--neo-primary);
        }

        .neo-progress-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 9px;
        }

        .neo-progress-label {
            color: var(--neo-muted);
            font-size: 12px;
            font-weight: 900;
        }

        .neo-progress-value {
            color: var(--neo-text);
            font-size: 12px;
            font-weight: 900;
        }

        .neo-progress-track {
            height: 12px;
            border-radius: 999px;
            background: var(--neo-surface);
            box-shadow:
                inset 4px 4px 9px var(--neo-inset-dark),
                inset -4px -4px 9px var(--neo-inset-light);
            overflow: hidden;
            padding: 3px;
        }

        .neo-progress-bar {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--neo-primary), #38bdf8);
            box-shadow: 0 0 10px rgba(0, 158, 247, .35);
        }

        .neo-course-date {
            min-height: 42px;
            color: var(--neo-muted);
            font-size: 12px;
            font-weight: 700;
            line-height: 1.6;
            margin: 16px 0 18px;
        }

        .neo-course-date strong {
            color: var(--neo-text);
            font-weight: 900;
        }

        .neo-course-actions {
            margin-top: auto;
        }

        .neo-btn-course {
            width: 100%;
            min-height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 0;
            border-radius: 17px;
            padding: 0 16px;
            font-size: 13px;
            font-weight: 900;
            transition: .22s ease;
        }

        .neo-btn-primary {
            color: #ffffff;
            background: var(--neo-primary);
            box-shadow:
                6px 6px 14px rgba(120, 113, 108, .26),
                -6px -6px 14px rgba(255, 255, 255, .72);
        }

        .neo-btn-primary:hover {
            color: #ffffff;
            background: var(--neo-primary-dark);
            transform: translateY(-1px);
        }

        .neo-btn-success {
            color: #ffffff;
            background: var(--neo-success);
            box-shadow:
                6px 6px 14px rgba(120, 113, 108, .26),
                -6px -6px 14px rgba(255, 255, 255, .72);
        }

        .neo-btn-success:hover {
            color: #ffffff;
            background: var(--neo-success-dark);
            transform: translateY(-1px);
        }

        .neo-btn-soft {
            min-height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 20px;
            border: 0;
            border-radius: 17px;
            color: var(--neo-primary);
            background: var(--neo-surface);
            font-weight: 900;
            box-shadow:
                7px 7px 16px var(--neo-dark-soft),
                -7px -7px 16px var(--neo-light);
            transition: .22s ease;
        }

        .neo-btn-soft:hover {
            color: var(--neo-primary-dark);
            transform: translateY(-1px);
        }

        .neo-alert {
            border: 0;
            border-radius: 22px;
            padding: 14px 16px;
            margin-bottom: 18px;
            font-weight: 800;
            line-height: 1.6;
            background: var(--neo-surface);
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
        }

        .neo-alert-success {
            color: var(--neo-success-dark);
        }

        .neo-alert-danger {
            color: #dc2626;
        }

        .neo-rating-box {
            padding: 14px;
            border-radius: 20px;
            background: var(--neo-surface);
            box-shadow:
                inset 5px 5px 12px var(--neo-inset-dark),
                inset -5px -5px 12px var(--neo-inset-light);
        }

        .neo-rating-title {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--neo-text);
            font-size: 13px;
            font-weight: 900;
            margin-bottom: 6px;
        }

        .neo-rating-help {
            color: var(--neo-muted);
            font-size: 11.5px;
            font-weight: 700;
            line-height: 1.55;
            margin-bottom: 12px;
        }

        .neo-rating-stars {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 7px;
            margin-bottom: 10px;
        }

        .neo-rating-stars input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .neo-rating-stars label {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            border-radius: 14px;
            color: #a16207;
            background: var(--neo-surface);
            font-size: 12px;
            font-weight: 900;
            cursor: pointer;
            box-shadow:
                5px 5px 11px var(--neo-dark-soft),
                -5px -5px 11px var(--neo-light);
            transition: .18s ease;
        }

        .neo-rating-stars label i {
            font-size: 14px;
        }

        .neo-rating-stars input:checked + label,
        .neo-rating-stars label:hover {
            color: #ffffff;
            background: #f59e0b;
            box-shadow:
                inset 3px 3px 7px rgba(120, 70, 0, .24),
                inset -3px -3px 7px rgba(255, 255, 255, .22);
        }

        .neo-rating-textarea {
            width: 100%;
            min-height: 72px;
            resize: vertical;
            border: 0;
            outline: none;
            border-radius: 16px;
            padding: 12px 14px;
            color: var(--neo-text);
            background: var(--neo-surface);
            font-size: 12px;
            font-weight: 700;
            line-height: 1.6;
            box-shadow:
                inset 4px 4px 10px var(--neo-inset-dark),
                inset -4px -4px 10px var(--neo-inset-light);
        }

        .neo-rating-textarea::placeholder {
            color: rgba(107, 114, 128, .72);
        }

        .neo-btn-rating {
            margin-top: 10px;
            color: #ffffff;
            background: #f59e0b;
            box-shadow:
                6px 6px 14px rgba(120, 113, 108, .26),
                -6px -6px 14px rgba(255, 255, 255, .72);
        }

        .neo-btn-rating:hover {
            color: #ffffff;
            background: #d97706;
            transform: translateY(-1px);
        }

        .neo-rated-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            margin-bottom: 10px;
            min-height: 38px;
            padding: 0 12px;
            border-radius: 15px;
            color: #a16207;
            background: var(--neo-surface);
            font-size: 12px;
            font-weight: 900;
            box-shadow:
                inset 4px 4px 9px var(--neo-inset-dark),
                inset -4px -4px 9px var(--neo-inset-light);
        }

        @media (max-width: 1199.98px) {
            .neo-course-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 991.98px) {
            .neo-course-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
            }

            .neo-myclass-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 767.98px) {
            .neo-myclass-header {
                margin-bottom: 20px;
            }

            .neo-myclass-title {
                font-size: 1.45rem;
            }

            .neo-myclass-subtitle {
                font-size: 13px;
            }

            .neo-myclass-badge {
                width: 100%;
            }

            .neo-course-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .neo-course-card {
                border-radius: 24px;
            }

            .neo-course-image-box {
                border-radius: 20px;
            }

            .neo-course-body {
                padding: 16px;
            }

            .neo-course-title {
                min-height: auto;
            }

            .neo-empty-card {
                border-radius: 24px;
            }

            .neo-empty-inner {
                padding: 44px 18px;
            }
        }

        @media (max-width: 420px) {
            .neo-course-image-wrap {
                padding: 10px 10px 0;
            }

            .neo-course-body {
                padding: 15px;
            }

            .neo-course-title a {
                font-size: 14px;
            }

            .neo-progress-label,
            .neo-progress-value,
            .neo-course-date {
                font-size: 11.5px;
            }

            .neo-btn-course {
                font-size: 12.5px;
            }
        }
    </style>
@endsection

@section('pengguna_content')
    @php use App\Support\IdCipher; @endphp

    <div class="neo-myclass-page">
        <div class="neo-myclass-header">
            <div>
                <h3 class="neo-myclass-title">Kelas Saya</h3>
                <p class="neo-myclass-subtitle">
                    Lanjutkan perjalanan belajarmu dan selesaikan kelas yang sudah kamu mulai.
                </p>
            </div>

            <div class="neo-myclass-badge">
                <i class="bi bi-collection-play"></i>
                <span>{{ $kelasSaya->count() }} Kelas Diikuti</span>
            </div>
        </div>

        @if (session('success'))
            <div class="neo-alert neo-alert-success">
                <i class="bi bi-check-circle me-1"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="neo-alert neo-alert-danger">
                <i class="bi bi-exclamation-circle me-1"></i>
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="neo-alert neo-alert-danger">
                <i class="bi bi-exclamation-triangle me-1"></i>
                {{ $errors->first() }}
            </div>
        @endif

        @if ($kelasSaya->isEmpty())
            <div class="neo-empty-card">
                <div class="neo-empty-inner">
                    <div class="neo-empty-icon">
                        <i class="bi bi-journal-bookmark"></i>
                    </div>

                    <h5 class="neo-empty-title">Belum ada kelas yang diikuti</h5>

                    <p class="neo-empty-desc">
                        Mulai belajar sekarang dengan memilih kelas yang sesuai minat dan tujuanmu.
                    </p>

                    <a href="{{ route('kursus.index') ?? '#' }}" class="neo-btn-soft">
                        <i class="bi bi-search"></i>
                        <span>Jelajahi Kelas</span>
                    </a>
                </div>
            </div>
        @else
            <div class="neo-course-grid">
                @foreach ($kelasSaya as $kelas)
                    @php
                        $bannerUrl = $kelas->banner
                            ? route('view-file', ['folder' => 'banner', 'filename' => $kelas->banner])
                            : asset('assets/media/illustrations/fallback.jpg');

                        $classToken = IdCipher::encode($kelas->id_pendaftaran);
                        $progress = (float) $kelas->persentase_progres;
                    @endphp

                    <div class="neo-course-card">
                        <div class="neo-course-image-wrap">
                            <div class="neo-course-image-box">
                                <img
                                    src="{{ $bannerUrl }}"
                                    alt="{{ $kelas->kelas_judul }}"
                                    class="neo-course-image"
                                    loading="lazy"
                                    decoding="async"
                                    onerror="this.src='{{ asset('assets/media/illustrations/fallback.jpg') }}';"
                                >

                                <span class="neo-status-badge {{ $kelas->status === 'selesai' ? 'is-finished' : '' }}">
                                    {{ $kelas->status }}
                                </span>
                            </div>
                        </div>

                        <div class="neo-course-body">
                            <h5 class="neo-course-title">
                                <a href="#">
                                    {{ $kelas->kelas_judul }}
                                </a>
                            </h5>

                            <div class="mb-3">
                                <div class="neo-progress-info">
                                    <span class="neo-progress-label">Progress</span>
                                    <span class="neo-progress-value">{{ $progress }}%</span>
                                </div>

                                <div class="neo-progress-track">
                                    <div
                                        class="neo-progress-bar"
                                        role="progressbar"
                                        style="width: {{ $progress }}%;"
                                        aria-valuenow="{{ $progress }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div>
                            </div>

                            <div class="neo-course-date">
                                @if ($kelas->status === 'selesai' && $kelas->selesai_pada)
                                    Selesai pada:
                                    <strong>
                                        {{ \Carbon\Carbon::parse($kelas->selesai_pada)->format('d M Y') }}
                                    </strong>
                                @else
                                    Terdaftar pada:
                                    <strong>
                                        {{ \Carbon\Carbon::parse($kelas->terdaftar_pada)->format('d M Y') }}
                                    </strong>
                                @endif
                            </div>

                            <div class="neo-course-actions">
                                @if ($kelas->status !== 'selesai')
                                    <a href="{{ route('pengguna.course_playing', $classToken) }}"
                                        class="neo-btn-course neo-btn-primary">
                                        <i class="bi bi-play-fill"></i>
                                        <span>Lanjutkan Belajar</span>
                                    </a>
                                @else
                                    @if (! (bool) ($kelas->sudah_rating ?? false))
                                        <form action="{{ route('pengguna.kelas_saya.rating', $classToken) }}" method="POST" class="neo-rating-box">
                                            @csrf

                                            <div class="neo-rating-title">
                                                <i class="bi bi-stars"></i>
                                                <span>Beri rating dulu</span>
                                            </div>

                                            <div class="neo-rating-help">
                                                Sertifikat akan terbuka setelah kamu memberi rating untuk kelas ini.
                                            </div>

                                            <div class="neo-rating-stars" aria-label="Pilih rating kelas">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <input
                                                        type="radio"
                                                        id="rating-{{ $kelas->id_pendaftaran }}-{{ $i }}"
                                                        name="rating"
                                                        value="{{ $i }}"
                                                        {{ (int) old('rating') === $i ? 'checked' : '' }}
                                                        required
                                                    >
                                                    <label for="rating-{{ $kelas->id_pendaftaran }}-{{ $i }}">
                                                        <i class="bi bi-star-fill"></i>
                                                        <span>{{ $i }}</span>
                                                    </label>
                                                @endfor
                                            </div>

                                            <textarea
                                                name="ulasan"
                                                class="neo-rating-textarea"
                                                maxlength="1000"
                                                placeholder="Tulis ulasan singkat, opsional...">{{ old('ulasan') }}</textarea>

                                            <button type="submit" class="neo-btn-course neo-btn-rating">
                                                <i class="bi bi-send-check"></i>
                                                <span>Simpan Rating</span>
                                            </button>
                                        </form>
                                    @else
                                        <div class="neo-rated-note">
                                            <i class="bi bi-star-fill"></i>
                                            <span>Rating kamu: {{ $kelas->rating_pengguna }}/5</span>
                                        </div>

                                        <a href="{{ route('pengguna.sertifikat', $classToken) }}" target="_blank"
                                            class="neo-btn-course neo-btn-success">
                                            <i class="bi bi-award"></i>
                                            <span>Lihat Sertifikat</span>
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection