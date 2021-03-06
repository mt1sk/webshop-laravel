@if ($paginator->hasPages())
    <ul class="blog-pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            {{--<li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a href="javascript:;" aria-hidden="true">
                    <i class="fa fa-angle-left"></i>
                </a>
            </li>--}}
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="fa fa-angle-left"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><a>{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page"><a href="javascript:;">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        @else
            {{--<li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <a href="javascript:;" aria-hidden="true">
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>--}}
        @endif
    </ul>
    <div class="product-pagination">
        <span class="grid-item-list">
            Showing {{$paginator->firstItem()}} to {{$paginator->lastItem()}} of {{$paginator->total()}} ({{$paginator->lastPage()}} Pages)
        </span>
    </div>
@endif
