@extends('content.pengguna.layouts')

@section('pengguna_css')
    <style>
        :root {
            --class-primary: #009ef7;
            --class-primary-dark: #008bd8;
            --class-primary-soft: #eaf6ff;
            --class-success: #22c55e;
            --class-success-dark: #16a34a;
            --class-success-soft: #ecfdf5;
            --class-warning: #f59e0b;
            --class-warning-dark: #d97706;
            --class-warning-soft: #fffbeb;
            --class-danger: #ef4444;
            --class-danger-soft: #fef2f2;
            --class-bg: #f8fafc;
            --class-surface: #ffffff;
            --class-soft: #f1f5f9;
            --class-border: #e5e7eb;
            --class-text: #111827;
            --class-muted: #64748b;
        }

        .neo-myclass-page {
            width: 100%;
            color: var(--class-text);
        }

        .neo-myclass-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
        }

        .neo-myclass-title {
            color: var(--class-text);
            font-weight: 900;
            letter-spacing: -.035em;
            margin-bottom: 7px;
        }

        .neo-myclass-subtitle {
            color: var(--class-muted);
            font-weight: 600;
            line-height: 1.65;
            margin-bottom: 0;
            max-width: 680px;
        }

        .neo-myclass-badge {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 15px;
            border-radius: 999px;
            color: var(--class-primary);
            background: var(--class-primary-soft);
            border: 1px solid rgba(0, 158, 247, 0.14);
            font-weight: 900;
            white-space: nowrap;
        }

        .neo-empty-card {
            border: 1px solid var(--class-border);
            border-radius: 22px;
            background: var(--class-surface);
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
            position: relative;
            overflow: hidden;
        }

        .neo-empty-card::before,
        .neo-empty-card::after {
            display: none !important;
            content: none !important;
        }

        .neo-empty-inner {
            position: relative;
            z-index: 1;
            padding: 52px 24px;
            text-align: center;
        }

        .neo-empty-icon {
            width: 78px;
            height: 78px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 22px;
            color: var(--class-primary);
            background: var(--class-primary-soft);
            border: 1px solid rgba(0, 158, 247, 0.14);
            margin-bottom: 24px;
        }

        .neo-empty-icon i {
            font-size: 34px;
        }

        .neo-empty-title {
            color: var(--class-text);
            font-weight: 900;
            margin-bottom: 10px;
        }

        .neo-empty-desc {
            color: var(--class-muted);
            font-weight: 600;
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
            border: 1px solid var(--class-border);
            border-radius: 22px;
            background: var(--class-surface);
            box-shadow: 0 14px 34px rgba(15, 23, 42, 0.055);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: .18s ease;
        }

        .neo-course-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 46px rgba(15, 23, 42, 0.08);
            border-color: rgba(0, 158, 247, 0.18);
        }

        .neo-course-image-wrap {
            padding: 12px 12px 0;
        }

        .neo-course-image-box {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 9;
            border-radius: 18px;
            overflow: hidden;
            background: var(--class-bg);
            border: 1px solid var(--class-border);
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
            color: var(--class-primary);
            background: rgba(255, 255, 255, .94);
            backdrop-filter: blur(8px);
            font-size: 10px;
            font-weight: 900;
            letter-spacing: .04em;
            text-transform: uppercase;
            border: 1px solid rgba(255, 255, 255, .65);
        }

        .neo-status-badge.is-finished {
            color: var(--class-success-dark);
            background: rgba(236, 253, 245, .94);
            border-color: rgba(34, 197, 94, .20);
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
            color: var(--class-text);
            font-size: 15px;
            font-weight: 900;
            line-height: 1.45;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: .18s ease;
            text-decoration: none;
        }

        .neo-course-title a:hover {
            color: var(--class-primary);
        }

        .neo-progress-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 9px;
        }

        .neo-progress-label {
            color: var(--class-muted);
            font-size: 12px;
            font-weight: 900;
        }

        .neo-progress-value {
            color: var(--class-text);
            font-size: 12px;
            font-weight: 900;
        }

        .neo-progress-track {
            height: 10px;
            border-radius: 999px;
            background: var(--class-soft);
            overflow: hidden;
        }

        .neo-progress-bar {
            height: 100%;
            border-radius: 999px;
            background: var(--class-primary);
        }

        .neo-course-date {
            min-height: 42px;
            color: var(--class-muted);
            font-size: 12px;
            font-weight: 600;
            line-height: 1.6;
            margin: 16px 0 18px;
        }

        .neo-course-date strong {
            color: var(--class-text);
            font-weight: 900;
        }

        .neo-course-actions {
            margin-top: auto;
        }

        .neo-btn-course {
            width: 100%;
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 0;
            border-radius: 14px;
            padding: 0 16px;
            font-size: 13px;
            font-weight: 900;
            transition: .18s ease;
            text-decoration: none;
        }

        .neo-btn-primary {
            color: #ffffff;
            background: var(--class-primary);
            box-shadow: 0 12px 26px rgba(0, 158, 247, 0.20);
        }

        .neo-btn-primary:hover {
            color: #ffffff;
            background: var(--class-primary-dark);
            transform: translateY(-1px);
        }

        .neo-btn-success {
            color: #ffffff;
            background: var(--class-success);
            box-shadow: 0 12px 26px rgba(34, 197, 94, 0.18);
        }

        .neo-btn-success:hover {
            color: #ffffff;
            background: var(--class-success-dark);
            transform: translateY(-1px);
        }

        .neo-btn-soft {
            min-height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 20px;
            border: 1px solid var(--class-border);
            border-radius: 14px;
            color: var(--class-primary);
            background: #ffffff;
            font-weight: 900;
            transition: .18s ease;
            text-decoration: none;
        }

        .neo-btn-soft:hover {
            color: var(--class-primary-dark);
            background: var(--class-primary-soft);
            border-color: rgba(0, 158, 247, 0.24);
            transform: translateY(-1px);
        }

        .neo-alert {
            border: 1px solid var(--class-border);
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 18px;
            font-weight: 800;
            line-height: 1.6;
            background: #ffffff;
        }

        .neo-alert-success {
            color: var(--class-success-dark);
            background: var(--class-success-soft);
            border-color: rgba(34, 197, 94, 0.18);
        }

        .neo-alert-danger {
            color: #dc2626;
            background: var(--class-danger-soft);
            border-color: rgba(239, 68, 68, 0.18);
        }

        .neo-rating-box {
            padding: 14px;
            border-radius: 18px;
            background: var(--class-bg);
            border: 1px solid var(--class-border);
        }

        .neo-rating-title {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--class-text);
            font-size: 13px;
            font-weight: 900;
            margin-bottom: 6px;
        }

        .neo-rating-title i {
            color: var(--class-warning);
        }

        .neo-rating-help {
            color: var(--class-muted);
            font-size: 11.5px;
            font-weight: 600;
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
            min-height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            border-radius: 12px;
            color: #a16207;
            background: #ffffff;
            border: 1px solid rgba(245, 158, 11, 0.18);
            font-size: 12px;
            font-weight: 900;
            cursor: pointer;
            transition: .18s ease;
        }

        .neo-rating-stars label i {
            font-size: 14px;
        }

        .neo-rating-stars input:checked + label,
        .neo-rating-stars label:hover {
            color: #ffffff;
            background: var(--class-warning);
            border-color: var(--class-warning);
        }

        .neo-rating-textarea {
            width: 100%;
            min-height: 72px;
            resize: vertical;
            border: 1px solid var(--class-border);
            outline: none;
            border-radius: 14px;
            padding: 12px 14px;
            color: var(--class-text);
            background: #ffffff;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.6;
            transition: .18s ease;
        }

        .neo-rating-textarea:focus {
            border-color: rgba(245, 158, 11, 0.45);
            box-shadow: 0 0 0 .2rem rgba(245, 158, 11, 0.10);
        }

        .neo-rating-textarea::placeholder {
            color: rgba(107, 114, 128, .72);
        }

        .neo-btn-rating {
            margin-top: 10px;
            color: #ffffff;
            background: var(--class-warning);
            box-shadow: 0 12px 26px rgba(245, 158, 11, 0.18);
        }

        .neo-btn-rating:hover {
            color: #ffffff;
            background: var(--class-warning-dark);
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
            border-radius: 14px;
            color: #a16207;
            background: var(--class-warning-soft);
            border: 1px solid rgba(245, 158, 11, 0.18);
            font-size: 12px;
            font-weight: 900;
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
                border-radius: 20px;
            }

            .neo-course-image-box {
                border-radius: 16px;
            }

            .neo-course-body {
                padding: 16px;
            }

            .neo-course-title {
                min-height: auto;
            }

            .neo-empty-card {
                border-radius: 20px;
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