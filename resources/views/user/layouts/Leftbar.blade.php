<div class="col-md-4">
    <div class="single-sidebar">
        <h2 class="sidebar-title">{{ trans('messages.searchproduct') }}</h2>
        <form action="{{ route('shop.search') }}" method="get">
            <input type="text" placeholder="{{ trans('messages.searchproduct') }}..." value="{{ request('searchproduct') }}"
                name="searchproduct">
            <input type="submit" value="{{ trans('messages.search') }}">
        </form>
    </div>

    <div class="single-sidebar">
        <h2 class="sidebar-title">{{ trans('messages.product') }}</h2>
        @foreach($list as $l)
        <div class="thubmnail-recent">
            <img src="{{ $l->imageproduct }}" class="recent-thumb" alt="">
            @if(strlen($l->nameproduct) > 30)
            <h2><a href="{{ route('product.page', ['nameproduct' => $l->nameproduct]) }}">{!!
                    mb_substr(strip_tags($l->nameproduct), 0, 30) !!}...</a>
            </h2>
            @else
            <h2><a href="{{ route('product.page', ['nameproduct' => $l->nameproduct]) }}">{{ $l->nameproduct }}</a>
            </h2>
            @endif

            <div class="product-sidebar-price">
                <ins>${{ $l->price }}</ins> <del>${{ $l->oldprice }}</del>
            </div>
        </div>
        @endforeach
    </div>

    <div class="single-sidebar">
        <h2 class="sidebar-title">{{ trans('messages.recentpost') }}</h2>
        <ul>
            @foreach($recent as $re)
            <li><a href="{{ route('product.page', ['nameproduct' => $re->nameproduct]) }}">{{ $re->nameproduct }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>