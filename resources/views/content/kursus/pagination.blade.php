@if ($paginator->hasPages())
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mt-4">

        <div class="small text-muted">
            Halaman
            <span class="fw-bold text-gray-800">{{ $paginator->currentPage() }}</span>
            dari
            <span class="fw-bold text-gray-800">{{ $paginator->lastPage() }}</span>

            <span class="mx-2">•</span>

            Menampilkan
            <span class="fw-bold text-gray-800">{{ $paginator->firstItem() }}</span>
            –
            <span class="fw-bold text-gray-800">{{ $paginator->lastItem() }}</span>
            dari
            <span class="fw-bold text-gray-800">{{ $paginator->total() }}</span>
            kursus
        </div>

        <nav aria-label="Navigasi halaman kursus">
            <ul class="pagination pagination-sm mb-0 gap-1">

                {{-- Previous Page Link --}}
                <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link rounded" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="Sebelumnya">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled">
                            <span class="page-link rounded">{{ $element }}</span>
                        </li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link rounded fw-bold">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link rounded" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link rounded" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="Berikutnya">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endif