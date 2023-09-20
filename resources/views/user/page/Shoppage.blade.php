@extends('user.layouts.Userlayout')

@section('title', 'Shop')


@section('body')
<div class="single-product-area">
    <!-- <div class="zigzag-bottom"></div> -->
    <div class="container">
        <div class="row" style="display: flex; flex-direction: column;">
            <div class="col-md-12">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Search Products</h2>
                    <form action="{{ route('shop.search') }}" method="get">
                        <input type="text" placeholder="Search products..." value="{{ request('searchproduct') }}"
                            name="searchproduct">
                        <input type="submit" value="Search">
                    </form>
                    @if(request('searchproduct') || request('page'))
                    <h3 style="margin-top:1em"><span class="font-weight-bold"
                            style="color:red">{{ $countproduct }}</span> valid product</h3>
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
                        <h2 class="text-center fixheight"><a
                                href="{{ route('product.page', ['nameproduct' => $pr->nameproduct]) }}">{{ $pr->nameproduct }}</a>
                        </h2>
                        <div class="product-carousel-price">
                            <ins>${{ $pr->price }}</ins> <del>${{ $pr->oldprice }}</del>
                        </div>

                        <div class="product-option-shop">
                            @if($user)
                            <a class="add_to_cart_button them-sp-vao-gio" href="#"
                                data-idproduct="{{ $pr->idproduct }}">Add to cart</a>
                            @else
                            <a class="add_to_cart_button" href="#" type="button" data-toggle="modal"
                                data-target="#modal-login">Add to cart</a>
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