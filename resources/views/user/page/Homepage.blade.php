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
                    @if(strlen($rd->nameproduct) > 30)
                    <h2 class="caption title">
                        <span class="primary"><strong>{!!
                                mb_substr(strip_tags($rd->nameproduct), 0, 30) !!}...</strong></span>
                    </h2>
                    @else
                    <h2 class="caption title">
                        <span class="primary"><strong>{{ $rd->nameproduct }}</strong></span>
                    </h2>
                    @endif

                    <h4 class="caption subtitle">${{ $rd->price }}</h4>
                    <a class="caption button-radius"
                        href="{{ route('product.page', ['nameproduct' => $rd->nameproduct]) }}"><span
                            class="icon"></span>{{ trans('messages.shopnow') }}</a>
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
                    <i class="bi bi-arrow-clockwise"></i>
                    <p>{{ trans('messages.30dayreturn') }}</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo2">
                    <i class="bi bi-truck"></i>
                    <p>{{ trans('messages.freeshipping') }}</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo3">
                    <i class="bi bi-lock-fill"></i>
                    <p>{{ trans('messages.securepayments') }}</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo4">
                    <i class="bi bi-gift"></i>
                    <p>{{ trans('messages.newproduct') }}</p>
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
                    <h2 class="section-title">{{ trans('messages.lastestproduct') }}</h2>
                    <div class="product-carousel">
                        @foreach($lastproduct as $lp)
                        <div class="single-product">
                            <div class="product-f-image">
                                <img src="{{ $lp->imageproduct }}" alt="">
                                <div class="product-hover" style="height: 270px;">
                                    @if($user)
                                    <a href="#" class="add-to-cart-link them-sp-vao-gio"
                                        data-idproduct="{{ $lp->idproduct }}"><i class="bi bi-cart-fill"></i>
                                        {{ trans('messages.addtocart') }}</a>
                                    @else
                                    <a href="#" class="add-to-cart-link" type="button" data-toggle="modal"
                                        data-target="#modal-login"><i class="bi bi-cart-fill"></i>
                                        {{ trans('messages.addtocart') }}</a>
                                    @endif
                                    <a href="{{ route('product.page', ['nameproduct' => $lp->nameproduct]) }}"
                                        class="view-details-link"><i class="bi bi-share-fill"></i>
                                        {{ trans('messages.seedetail') }}</a>
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
                    <h2 class="product-wid-title">{{ trans('messages.topseller') }}</h2>
                    <!-- <a href="" class="wid-view-more">View All</a> -->
                    @foreach($topseller as $top)
                    <div class="single-wid-product">
                        <a href="{{ route('product.page', ['nameproduct' => $top->nameproduct]) }}"><img
                                src="{{ $top->imageproduct }}" alt="" class="product-thumb"></a>
                        <h2><a
                                href="{{ route('product.page', ['nameproduct' => $top->nameproduct]) }}">{{ $top->nameproduct }}</a>
                        </h2>
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
                    <h2 class="product-wid-title">{{ trans('messages.recentlyview') }}</h2>
                    <!-- <a href="#" class="wid-view-more">View All</a> -->
                    @foreach($recently as $rc)
                    <div class="single-wid-product">
                        <a href="{{ route('product.page', ['nameproduct' => $rc->nameproduct]) }}"><img
                                src="{{ $rc->imageproduct }}" alt="" class="product-thumb"></a>
                        <h2><a
                                href="{{ route('product.page', ['nameproduct' => $rc->nameproduct]) }}">{{ $rc->nameproduct }}</a>
                        </h2>
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
                    <h2 class="product-wid-title">{{ trans('messages.topnew') }}</h2>
                    <!-- <a href="#" class="wid-view-more">View All</a> -->
                    @foreach($randomproduct as $rc)
                    @if($loop->index < 3) <div class="single-wid-product">
                        <a href="{{ route('product.page', ['nameproduct' => $rc->nameproduct]) }}"><img
                                src="{{ $rc->imageproduct }}" alt="" class="product-thumb"></a>
                        <h2><a
                                href="{{ route('product.page', ['nameproduct' => $rc->nameproduct]) }}">{{ $rc->nameproduct }}</a>
                        </h2>
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
    function adjustImagePadding() {
        $('.product-f-image').each(function() {
            var productHoverHeight = $(this).find('.product-hover').height();
            var imageHeight = $(this).find('img').height();
            var paddingTopValue;

            if ($(window).width() > 991 && $(window).width() < 1100) {
                paddingTopValue = (350 - imageHeight) / 2;
            } else {
                paddingTopValue = (300 - imageHeight) / 2;
            }

            $(this).find('img').css('padding-top', paddingTopValue + 'px');
            $(this).find('img').css('padding-bottom', paddingTopValue + 'px');
        });
    }

    // Gọi hàm khi tải trang và khi thay đổi kích thước cửa sổ
    adjustImagePadding();
    $(window).resize(adjustImagePadding);
});
</script>


@endsection