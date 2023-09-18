<div class="col-md-4">
    <div class="single-sidebar">
        <h2 class="sidebar-title">Search Products</h2>
        <form action="">
            <input type="text" placeholder="Search products...">
            <input type="submit" value="Search">
        </form>
    </div>

    <div class="single-sidebar">
        <h2 class="sidebar-title">Products</h2>
        @foreach($list as $l)
        <div class="thubmnail-recent">
            <img src="{{ $l->imageproduct }}" class="recent-thumb" alt="">
            <h2><a href="{{ route('product.page', ['nameproduct' => $l->nameproduct]) }}">{{ $l->nameproduct }}</a>
            </h2>
            <div class="product-sidebar-price">
                <ins>${{ $l->price }}</ins> <del>${{ $l->oldprice }}</del>
            </div>
        </div>
        @endforeach
    </div>

    <div class="single-sidebar">
        <h2 class="sidebar-title">Recent Posts</h2>
        <ul>
            @foreach($recent as $re)
            <li><a href="{{ route('product.page', ['nameproduct' => $re->nameproduct]) }}">{{ $re->nameproduct }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>