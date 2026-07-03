@php
    use Illuminate\Support\Str;
@endphp

@forelse ($kursus as $k)
    @php
        $totalMenit = (int) ($k->total_durasi_menit ?? 0);
        $hours = intdiv($totalMenit, 60);
        $minutes = $totalMenit % 60;

        $durationFormatted = trim(
            ($hours > 0 ? $hours . ' jam ' : '') .
            ($minutes > 0 ? $minutes . ' mnt' : '')
        );

        $jumlahVideo = (int) ($k->jumlah_video ?? $k->jumlah_materi ?? 0);
        $jumlahMateri = (int) ($k->jumlah_materi ?? 0);
        $totalPeserta = (int) ($k->total_pendaftaran ?? 0);
        $totalReview = (int) ($k->total_review ?? 0);
        $rating = (float) ($k->rating ?? 0);

        $tingkatLabel = [
            'pemula' => 'Pemula',
            'menengah' => 'Menengah',
            'lanjutan' => 'Lanjutan',
        ][(string) $k->tingkat] ?? Str::title((string) $k->tingkat);

        $bannerUrl = $k->banner
            ? route('view-file', ['folder' => 'banner', 'filename' => $k->banner])
            : asset('assets/media/illustrations/fallback.jpg');

        $previewUrl = $k->video_intro_url ?? null;

        $kategoriNama = $k->kategori_nama ?? null;
        $kategoriSubNama = $k->kategori_sub_nama ?? null;
    @endphp

    <div class="col-md-6 col-lg-4 mb-10">
        <div class="card course-card neo-course-card flex-column h-100">
            <div class="course-card-img-wrapper">
                <div class="card-header min-h-200px bgi-no-repeat bgi-size-cover bgi-position-center position-relative p-0 neo-course-cover
                    {{ $previewUrl ? 'cursor-pointer course-preview-trigger' : '' }}"
                    @if ($previewUrl)
                        data-video-url="{{ $previewUrl }}"
                        data-course-title="{{ e($k->judul) }}"
                        data-course-level="{{ e($tingkatLabel) }}"
                        data-course-category="{{ e($kategoriNama ?? '-') }}"
                        data-course-duration="{{ e($durationFormatted ?: 'N/A') }}"
                        data-course-lessons="{{ e($jumlahVideo . ' video') }}"
                        data-course-rating="{{ e(number_format($rating, 1)) }}"
                        data-course-banner="{{ $bannerUrl }}"
                    @endif
                    style="background-image: url('{{ $bannerUrl }}')">

                    <div class="neo-course-cover-overlay"></div>

                    <div class="position-absolute top-0 start-0 end-0 p-3 z-index-2">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <div class="d-flex flex-wrap gap-2">
                                @if ($kategoriNama)
                                    <span class="badge neo-course-badge">
                                        <i class="bi bi-folder-symlink me-1"></i>{{ $kategoriNama }}
                                    </span>
                                @endif

                                @if ($kategoriSubNama)
                                    <span class="badge neo-course-badge neo-course-badge-soft">
                                        <i class="bi bi-layers me-1"></i>{{ $kategoriSubNama }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="position-absolute bottom-0 start-0 end-0 p-3 z-index-2">
                        <div class="d-flex justify-content-between align-items-end gap-3">
                            <span class="badge neo-level-badge">
                                <i class="bi bi-bar-chart-steps me-1"></i>{{ $tingkatLabel }}
                            </span>

                            @if ($previewUrl)
                                <button type="button"
                                    class="btn btn-icon neo-play-btn course-preview-trigger"
                                    data-video-url="{{ $previewUrl }}"
                                    data-course-title="{{ e($k->judul) }}"
                                    data-course-level="{{ e($tingkatLabel) }}"
                                    data-course-category="{{ e($kategoriNama ?? '-') }}"
                                    data-course-duration="{{ e($durationFormatted ?: 'N/A') }}"
                                    data-course-lessons="{{ e($jumlahVideo . ' video') }}"
                                    data-course-rating="{{ e(number_format($rating, 1)) }}"
                                    data-course-banner="{{ $bannerUrl }}"
                                    aria-label="Putar preview {{ e($k->judul) }}">
                                    <i class="bi bi-play-fill"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="course-card-body-wrapper">
                <div class="card-body d-flex flex-column p-4">
                    <a href="{{ route('kursus.detail', $k->slug) }}"
                        class="text-gray-900 text-hover-primary fs-5 fw-bolder mb-3 text-decoration-none course-title-link">
                        {{ $k->judul }}
                    </a>

                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <div class="neo-mini-info" title="Total durasi video">
                            <i class="bi bi-clock"></i>
                            <span>{{ $durationFormatted ?: 'N/A' }}</span>
                        </div>

                        <div class="neo-mini-info" title="Jumlah video">
                            <i class="bi bi-play-circle"></i>
                            <span>{{ $jumlahVideo }} video</span>
                        </div>

                        <div class="neo-mini-info" title="Jumlah peserta terdaftar">
                            <i class="bi bi-people"></i>
                            <span>{{ number_format($totalPeserta, 0, ',', '.') }} peserta</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        @if ($rating > 0)
                            <div class="text-warning" aria-label="Rating {{ number_format($rating, 1) }} dari 5">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($rating))
                                        <i class="bi bi-star-fill"></i>
                                    @elseif ($i <= ceil($rating))
                                        <i class="bi bi-star-half"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>

                            <span class="fw-bolder text-gray-900 ms-2">
                                {{ number_format($rating, 1) }}
                            </span>

                            <span class="text-gray-600 fs-8 ms-1">
                                ({{ number_format($totalReview, 0, ',', '.') }})
                            </span>
                        @else
                            <span class="text-gray-500 fs-7 fw-semibold">Belum ada rating</span>
                        @endif
                    </div>

                    <div class="separator separator-dashed mb-4"></div>

                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <span class="text-primary fw-bolder fs-6">Gratis</span>

                        <a href="{{ route('kursus.detail', $k->slug) }}"
                            class="btn btn-sm btn-light-primary fw-bold">
                            Detail
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12 text-center">
        <div class="alert alert-secondary d-flex flex-column align-items-center p-5">
            <i class="bi bi-search fs-3hx text-gray-500 mb-4"></i>
            <h4 class="mb-1 text-gray-800">Kursus Tidak Ditemukan</h4>
            <span class="text-gray-600">
                Coba ubah atau reset filter pencarian Anda.
            </span>
        </div>
    </div>
@endforelse