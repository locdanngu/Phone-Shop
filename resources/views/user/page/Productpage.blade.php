@extends('user.layouts.Userlayout')

@section('title', 'Product page')

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shop</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            @include('user.layouts.Leftbar')

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <a href="{{ route('home.page') }}">Home</a>
                        <a
                            href="{{ route('shop.search', ['searchproduct' => $product->category->namecategory]) }}">{{ $product->category->namecategory }}</a>
                        <span>{{ $product->nameproduct }}</span>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <img src="{{ $product->imageproduct }}" alt="">
                                </div>

                                <!-- <div class="product-gallery">
                                    <img src="img/product-thumb-1.jpg" alt="">
                                    <img src="img/product-thumb-2.jpg" alt="">
                                    <img src="img/product-thumb-3.jpg" alt="">
                                </div> -->
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name">{{ $product->nameproduct }}</h2>
                                <div class="product-inner-price">
                                    <ins>${{ $product->price }}</ins> <del>${{ $product->oldprice }}</del>
                                </div>

                                <div class="cart">
                                    <div class="quantity">
                                        <input type="number" class="input-text qty text" title="Qty" value="1"
                                            name="quantity" min="1" step="1">
                                    </div>
                                    <button class="add_to_cart_button" id="btn-add-to-cart"
                                        data-idproduct="{{ $product->idproduct }}">Add to cart</button>

                                </div>

                                <button class="add_to_cart_button" style="margin:.5em 0"
                                    data-idproduct="{{ $product->idproduct }}">Add to wishlist</button>
                                <div class="product-inner-category">
                                    <p>Category: <a
                                            href="{{ route('shop.search', ['searchproduct' => $product->category->namecategory]) }}">{{ $product->category->namecategory }}</a>.
                                        Tags: <a href="">awesome</a>, <a href="">best</a>, <a href="">sale</a>, <a
                                            href="">shoes</a>. </p>
                                </div>

                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home"
                                                role="tab" data-toggle="tab">Description</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab"
                                                data-toggle="tab">Reviews</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>Product Description</h2>
                                            <p>{{ $product->detail }}</p>

                                            <!-- <p>Mauris placerat vitae lorem gravida viverra. Mauris in fringilla ex.
                                                Nulla facilisi. Etiam scelerisque tincidunt quam facilisis lobortis. In
                                                malesuada pulvinar neque a consectetur. Nunc aliquam gravida purus, non
                                                malesuada sem accumsan in. Morbi vel sodales libero.</p> -->
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <h2>Reviews</h2>
                                            <div class="submit-review">
                                                <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                <p><label for="email">Email</label> <input name="email" type="email">
                                                </p>
                                                <div class="rating-chooser">
                                                    <p>Your rating</p>

                                                    <div class="rating-wrap-post">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p><label for="review">Your review</label> <textarea name="review" id=""
                                                        cols="30" rows="10"></textarea></p>
                                                <input type="submit" value="Submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="related-products-wrapper" id="review">
                        <h2 class="related-products-title">All product reviews</h2>
                        <div class="reviewlist" id="capnhatreview">
                            @foreach($review as $r)
                            <div class="review">
                                <h5 class="username">{{ $r->name }} - {{ $r->email }}</h5>
                                <h5>{{ $r->review}}</h5>
                                <div class="rating-wrap-post" style="display: flex;align-items: center">
                                    @for ($i = 0; $i < $r->rating; $i++)
                                        <i class="fa fa-star" style="margin-right:.25em"></i>
                                        @endfor
                                        <h6 style="margin:0"> ({{ $r->created_at }})</h6>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <input type="submit" value="more review" class="watchmore">
                    </div>


                    <div class="related-products-wrapper">
                        <h2 class="related-products-title">Related Products</h2>
                        <div class="related-products-carousel">
                            @foreach($random as $rd)
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="{{ $rd->imageproduct }}" alt="" style="height:300px">
                                    <div class="product-hover">
                                        <a href="#" class="add-to-cart-link them-sp-vao-gio"
                                            data-idproduct="{{ $rd->idproduct }}"><i class="fa fa-shopping-cart"></i>
                                            Add to
                                            cart</a>
                                        <a href="{{ route('product.page', ['nameproduct' => $rd->nameproduct]) }}"
                                            class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a
                                        href="{{ route('product.page', ['nameproduct' => $rd->nameproduct]) }}">{{ $rd->nameproduct }}</a>
                                </h2>

                                <div class="product-carousel-price">
                                    <ins>${{ $rd->price }}</ins> <del>${{ $rd->oldprice }}</del>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
<script>
$(document).ready(function() {
    $('#btn-add-to-cart').on('click', function() {
        var id = $(this).data('idproduct');
        var quantity = $('input[name="quantity"]').val();

        $.ajax({
            type: 'POST',
            url: "{{ route('addcartwithquantity') }}",
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                quantity: quantity,
            },
            success: function(response) {
                var re = response.re;
                var html = response.html;

                if (re == 1) {
                    toastr.success(
                        '<b>The product already exists, the quantity has been updated</b>'
                    )
                } else {
                    toastr.success(
                        '<b>Product added to cart</b>'
                    )
                }

                $("#capnhatcart").html(html);
            }
        });
    });

    $('#review').hide();

    // Bắt sự kiện khi tab "Reviews" được nhấn
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        // Kiểm tra xem tab "Reviews" đã được nhấn
        if (e.target.getAttribute('href') === '#profile') {
            // Hiển thị nội dung của tab "Reviews" bằng cách sử dụng id "review"
            $('#review').show();
        } else {
            // Ẩn nội dung của tab "Reviews" khi tab khác được nhấn
            $('#review').hide();
        }
    });
});
</script>

@endsection