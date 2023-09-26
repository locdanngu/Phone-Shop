@extends('user.layouts.Userlayout')

@section('title', trans('messages.shoppage'))

@section('body')
<div class="single-product-area">
    <!-- <div class="zigzag-bottom"></div> -->
    <div class="container">
        <div class="row" style="display: flex; flex-direction: column;">
            <div class="col-md-12">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">{{ trans('messages.searchproduct') }}</h2>
                    <form action="{{ route('shop.search') }}" method="get">
                        <input type="text" placeholder="{{ trans('messages.searchproduct') }}..."
                            value="{{ request('searchproduct') }}" name="searchproduct">
                        <input type="submit" value="{{ trans('messages.search') }}">
                    </form>
                    @if(request('searchproduct') || request('page'))
                    <h3 style="margin-top:1em"><span class="font-weight-bold"
                            style="color:red">{{ $countproduct }}</span> {{ trans('messages.validproduct') }}</h3>
                    @endif
                </div>
            </div>
            <div class="gridlist">
                @foreach($product as $pr)
                <div class="listproduct">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="{{ $pr->imageproduct }}" alt="">
                        </div>
                        @if(strlen($pr->nameproduct) > 30)
                        <h2 class="text-center fixheight"><a
                                href="{{ route('product.page', ['nameproduct' => $pr->nameproduct]) }}">{!!
                                mb_substr(strip_tags($pr->nameproduct), 0, 30) !!}...</a>
                        </h2>
                        @else
                        <h2 class="text-center fixheight"><a
                                href="{{ route('product.page', ['nameproduct' => $pr->nameproduct]) }}">{{ $pr->nameproduct }}</a>
                        </h2>
                        @endif

                        <div class="product-carousel-price">
                            <ins>{{ app()->getLocale() === 'vi' ? 'VND ' : '$ '}}
                                {{ $pr->price }}</ins>
                            <del>{{ app()->getLocale() === 'vi' ? 'VND ' : '$ '}}{{ $pr->oldprice }}</del>
                        </div>

                        <div class="product-option-shop">
                            @if($user)
                            <a class="add_to_cart_button them-sp-vao-gio" href="#"
                                data-idproduct="{{ $pr->idproduct }}">{{ trans('messages.addtocart') }}</a>
                            @else
                            <a class="add_to_cart_button" href="#" type="button" data-toggle="modal"
                                data-target="#modal-login">{{ trans('messages.addtocart') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="product-pagination text-center">
                    {{ $product->links('user.layouts.Pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection