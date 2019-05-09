@if ($paginator->hasPages())
    <ul class="c-pagination h-list--unstyled h-list--horizontal" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="c-pagination__item h-list--horizontal__item c-pagination__item--disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="c-pagination__link c-pagination__link--disabled" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="c-pagination__item h-list--horizontal__item">
                <a class="c-pagination__link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="c-pagination__item c-pagination__item--disabled h-list--horizontal__item" aria-disabled="true"><span class="c-pagination__link c-pagination__link--disabled">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="c-pagination__item c-pagination__item--active h-list--horizontal__item" aria-current="page"><span class="c-pagination__link c-pagination__link--active">{{ $page }}</span></li>
                    @else
                        <li class="c-pagination__item h-list--horizontal__item"><a class="c-pagination__link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="c-pagination__item h-list--horizontal__item">
                <a class="c-pagination__link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="c-pagination__item c-pagination__item--disabled h-list--horizontal__item" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="c-pagination__link c-pagination__link--disabled" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
