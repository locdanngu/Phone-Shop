@extends('user.layouts.Userlayout')

@section('title', 'Homepage')

@section('body')
<div class="slider-area">
    <!-- Slider -->
    <div class="block-slider block-slider4">
        <ul class="" id="bxslider-home4">
            @foreach($randomproduct as $rd)
            <li>
                <img src="{{ $rd->imageproduct }}" alt="Slide"
                    style="height:300px;width: auto;max-width:max-content;margin-left:50px">
                <div class="caption-group">
                    <h2 class="caption title">
                        <span class="primary"><strong>{{ $rd->nameproduct }}</strong></span>
                    </h2>
                    <h4 class="caption subtitle">${{ $rd->price }}</h4>
                    <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <!-- ./Slider -->
</div> <!-- End slider area -->

<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo1">
                    <i class="fa fa-refresh"></i>
                    <p>30 Days return</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo2">
                    <i class="fa fa-truck"></i>
                    <p>Free shipping</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo3">
                    <i class="fa fa-lock"></i>
                    <p>Secure payments</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo4">
                    <i class="fa fa-gift"></i>
                    <p>New products</p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Latest Products</h2>
                    <div class="product-carousel">
                        @foreach($lastproduct as $lp)
                        <div class="single-product">
                            <div class="product-f-image">
                                <img src="{{ $lp->imageproduct }}" alt="">
                                <div class="product-hover" style="height: 270px;">
                                    <a href="#" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to
                                        cart</a>
                                    <a href="{{ route('product.page', ['nameproduct' => $lp->nameproduct]) }}"
                                        class="view-details-link"><i class="fa fa-link"></i>
                                        See details</a>
                                </div>
                            </div>

                            <h2><a href="single-product.html">{{ $lp->nameproduct }}</a></h2>

                            <div class="product-carousel-price">
                                <ins>${{ $lp->price }}</ins> <del>${{ $lp->oldprice }}</del>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->

<div class="brands-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-wrapper">
                    <div class="brand-list">
                        @foreach($listcategory as $lc)
                        <img src="{{ $lc->imagecategory }}" alt="" class="listcate">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End brands area -->

<div class="product-widget-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top Sellers</h2>
                    <a href="" class="wid-view-more">View All</a>
                    @foreach($topseller as $top)
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="{{ $top->imageproduct }}" alt=""
                                class="product-thumb"></a>
                        <h2><a href="single-product.html">{{ $top->nameproduct }}</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>${{ $top->price }}</ins> <del>${{ $top->oldprice }}</del>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Recently Viewed</h2>
                    <a href="#" class="wid-view-more">View All</a>
                    @foreach($recently as $rc)
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="{{ $rc->imageproduct }}" alt=""
                                class="product-thumb"></a>
                        <h2><a href="single-product.html">{{ $rc->nameproduct }}</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>${{ $rc->price }}</ins> <del>${{ $rc->oldprice }}</del>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top New</h2>
                    <a href="#" class="wid-view-more">View All</a>
                    @foreach($recently as $rc)
                    @if($loop->index < 3) <div class="single-wid-product">
                        <a href="single-product.html"><img src="{{ $rc->imageproduct }}" alt=""
                                class="product-thumb"></a>
                        <h2><a href="single-product.html">{{ $rc->nameproduct }}</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>${{ $rc->price }}</ins> <del>${{ $rc->oldprice }}</del>
                        </div>
                </div>
                @else
                @break
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
</div> <!-- End product widget area -->
@endsection


@section('js')
<script>
$(document).ready(function() {
    $('.product-f-image').each(function() {
        var productHoverHeight = $(this).find('.product-hover').height();
        var imageHeight = $(this).find('img').height();
        var paddingTopValue = (productHoverHeight - imageHeight) / 2;
        $(this).find('img').css('padding-top', paddingTopValue + 'px');
        $(this).find('img').css('padding-bottom', paddingTopValue + 'px');
    });
});
</script>


@endsection