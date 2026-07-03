@if ($paginator->hasPages())
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mt-3">
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <span class="badge bg-light text-primary border">
                Halaman {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </span>

            <span class="text-muted small">
                Menampilkan
                <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                –
                <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                dari
                <span class="fw-semibold">{{ $paginator->total() }}</span>
                kursus
            </span>
        </div>

        <nav aria-label="Navigasi halaman kursus">
            <ul class="pagination mb-0">
                {{-- Previous Page Link --}}
                <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Sebelumnya">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled">
                            <span class="page-link">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Berikutnya">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endif
