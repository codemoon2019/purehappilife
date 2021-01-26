
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center justify-content-sm-end">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link" aria-disabled="true" aria-label="@lang('pagination.previous')" href="#"><i class="ion-chevron-left"></i></a>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link" aria-disabled="true" aria-label="@lang('pagination.previous')" href="#"><i class="ion-chevron-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="ion-chevron-right"></i></a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link disabled"  aria-disabled="true" aria-label="@lang('pagination.next')"><i class="ion-chevron-right"></i></a>
                </li>
            @endif
        </ul>
    </nav>
@endif
