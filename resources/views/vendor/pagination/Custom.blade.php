@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" style="margin-right:1em;color:#B8BAC2" aria-disabled="true"><span><<</span></li>
        @else
            <li class="linkpt"><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><<</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" style="margin-right:1em" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="linkpt active" style="margin-right:1em" aria-current="page"><span>{{ $page }}</span></li>
                    @else
                        <li class="linkpt"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="linkpt"><a href="{{ $paginator->nextPageUrl() }}" rel="next">>></a></li>
        @else
            <li class="linkpt disabled" style="margin-right:1em;color:#B8BAC2" aria-disabled="true"><span>>></span></li>
        @endif
    </ul>
@endif
