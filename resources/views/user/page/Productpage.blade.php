@extends('user.layouts.Userlayout')

@section('title', trans('messages.product'))

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>{{ trans('messages.product') }}</h2>
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
                        <a href="{{ route('home.page') }}">{{ trans('messages.homepage') }}</a>
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
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name">{{ $product->nameproduct }}</h2>
                                <div class="product-inner-price">
                                    <ins>{{ $currencySymbol }} @convertCurrency($product->price)</ins>
                                    <del>{{ $currencySymbol }} @convertCurrency($product->oldprice)</del>
                                </div>

                                <div class="cart">
                                    <div class="quantity">
                                        <input type="number" class="input-text qty text" title="Qty" value="1"
                                            name="quantity" min="1" step="1">
                                    </div>
                                    @if($user)
                                    <button class="add_to_cart_button" id="btn-add-to-cart"
                                        data-idproduct="{{ $product->idproduct }}">{{ trans('messages.addtocart') }}</button>
                                    @else
                                    <button class="add_to_cart_button" type="button" data-toggle="modal"
                                        data-target="#modal-login">{{ trans('messages.addtocart') }}</button>
                                    @endif
                                </div>
                                @if($user)
                                <button class="add_to_cart_button" id="btn-add-to-wishlist" style="margin:.5em 0"
                                    data-idproduct="{{ $product->idproduct }}">{{ trans('messages.addtowishlist') }}</button>
                                @else
                                <button class="add_to_cart_button" style="margin:.5em 0" type="button"
                                    data-toggle="modal"
                                    data-target="#modal-login">{{ trans('messages.addtowishlist') }}</button>
                                @endif
                                <div class="product-inner-category">
                                    <p>{{ trans('messages.categorypage') }}: <a
                                            href="{{ route('shop.search', ['searchproduct' => $product->category->namecategory]) }}">{{ $product->category->namecategory }}</a>.
                                        {{ trans('messages.typepage') }}: <a
                                            href="{{ route('shop.search', ['searchproduct' => $product->type->nametype]) }}">{{ $product->type->nametype }}</a>.
                                    </p>
                                </div>

                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home"
                                                role="tab" data-toggle="tab">{{ trans('messages.description') }}</a>
                                        </li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab"
                                                data-toggle="tab">{{ trans('messages.review') }}</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>{{ trans('messages.productde') }}</h2>
                                            <?php
                                            // Lấy nội dung từ biến $product->detail và thực hiện xuống hàng sau mỗi dấu gạch ngang đầu câu
                                            $detail = $product->detail;
                                            $detail = str_replace('- ', '<br>- ', $detail);
                                            ?>

                                            <p>{!! $detail !!}</p>

                                            <!-- <p>Mauris placerat vitae lorem gravida viverra. Mauris in fringilla ex.
                                                Nulla facilisi. Etiam scelerisque tincidunt quam facilisis lobortis. In
                                                malesuada pulvinar neque a consectetur. Nunc aliquam gravida purus, non
                                                malesuada sem accumsan in. Morbi vel sodales libero.</p> -->
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <h2>{{ trans('messages.review') }}</h2>
                                            <div class="submit-review">
                                                @if(!$user)
                                                <p><label for="name">{{ trans('messages.yourname') }}</label> <input
                                                        name="name" type="text" id="namereview"></p>
                                                <p><label for="email">Email</label> <input name="email" type="email"
                                                        id="emailreview">
                                                </p>
                                                @endif
                                                <div class="rating">
                                                    <p class="noidung3">{{ trans('messages.yourrating') }}</p>
                                                    <div class="star-rating">
                                                        <input type="radio" id="5-stars" name="rating" value="5" />
                                                        <label for="5-stars" class="star">&#9733;</label>
                                                        <input type="radio" id="4-stars" name="rating" value="4" />
                                                        <label for="4-stars" class="star">&#9733;</label>
                                                        <input type="radio" id="3-stars" name="rating" value="3" />
                                                        <label for="3-stars" class="star">&#9733;</label>
                                                        <input type="radio" id="2-stars" name="rating" value="2" />
                                                        <label for="2-stars" class="star">&#9733;</label>
                                                        <input type="radio" id="1-star" name="rating" value="1" />
                                                        <label for="1-star" class="star">&#9733;</label>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="{{ $product->idproduct }}"
                                                    id="idproductreview">
                                                <p><label for="review"></label>{{ trans('messages.yourreview') }}
                                                    <textarea name="review" id="reviewreview" cols="30"
                                                        rows="10"></textarea>
                                                </p>
                                                @if(!$user)
                                                <input type="submit" value="{{ trans('messages.submit') }}"
                                                    id="sendreview1">
                                                @else
                                                <input type="submit" value="{{ trans('messages.submit') }}"
                                                    id="sendreview2">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="related-products-wrapper" id="review">
                        <h2 class="related-products-title">{{ trans('messages.allproductreview') }}</h2>
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
                        @if(count($review) >= 5)
                        <input type="submit" value="more review" class="watchmore" id="morereview">
                        @endif
                    </div>


                    <div class="related-products-wrapper">
                        <h2 class="related-products-title">{{ trans('messages.relatedproduct') }}</h2>
                        <div class="related-products-carousel">
                            @foreach($random as $rd)
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="{{ $rd->imageproduct }}" alt="" style="height:300px">
                                    <div class="product-hover">
                                        @if($user)
                                        <a href="#" class="add-to-cart-link them-sp-vao-gio"
                                            data-idproduct="{{ $rd->idproduct }}"><i class="bi bi-cart"></i>
                                            {{ trans('messages.addtocart') }}</a>
                                        @else
                                        <a href="#" class="add-to-cart-link" type="button" data-toggle="modal"
                                            data-target="#modal-login"><i class="bi bi-cart"></i>
                                            {{ trans('messages.addtocart') }}</a>
                                        @endif
                                        <a href="{{ route('product.page', ['nameproduct' => $rd->nameproduct]) }}"
                                            class="view-details-link"><i class="bi bi-share-fill"></i>
                                            {{ trans('messages.seedetail') }}</a>
                                    </div>
                                </div>

                                <h2><a
                                        href="{{ route('product.page', ['nameproduct' => $rd->nameproduct]) }}">{{ $rd->nameproduct }}</a>
                                </h2>

                                <div class="product-carousel-price">
                                    <ins>{{ $currencySymbol }} @convertCurrency($rd->price)</ins>
                                    <del>{{ $currencySymbol }} @convertCurrency($rd->oldprice)</del>
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
                    toastr.success('<b>{{ trans('messages.addtocarttoastrsuc2') }}</b>'
                    )
                } else {
                    toastr.success('<b>{{ trans('messages.addtocarttoastrsuc1') }}</b>'
                    )
                }

                $("#capnhatcart").html(html);
            }
        });
    });


    $('#btn-add-to-wishlist').on('click', function() {
        var id = $(this).data('idproduct');

        $.ajax({
            type: 'POST',
            url: "{{ route('addwishlist') }}",
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
            },
            success: function(response) {
                var re = response.re;
                if (re == 1) {
                    toastr.error('<b>{{ trans('messages.addproductwl1') }}</b>'
                    )
                } else {
                    toastr.success('<b>{{ trans('messages.addproductwl2') }}</b>'
                    )
                }
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

    $('#sendreview1').on('click', function() { //Chưa đăng nhập
        var name = $('#namereview').val();
        var email = $('#emailreview').val();
        var id = $('#idproductreview').val();
        var reviewreview = $('#reviewreview').val();
        var selectedRating = $('input[name="rating"]:checked').val();

        if (reviewreview == null || selectedRating == null || name == null || email == null) {
            toastr.error('{{ trans('messages.plsin4') }}');
        }

        if (reviewreview != null && selectedRating != null && name != null && email != null ){
            $.ajax({
            type: 'POST',
            url: "{{ route('addreview') }}",
            data: {
                _token: '{{ csrf_token() }}',
                name: name,
                email: email,
                review: reviewreview,
                rating: selectedRating,
                id: id,
            },
            success: function(response) {
                var html = response.html;
                $('#capnhatreview').prepend(html);
                toastr.success('{{ trans('messages.reviewaddsuc') }}');
                $('#namereview').val('');
                $('#emailreview').val('');
                $('#reviewreview').val('');
                $('input[name="rating"]').prop('checked', false);
            }
        });
        }

        

    });

    $('#sendreview2').on('click', function() { //Đã đăng nhập
        var reviewreview = $('#reviewreview').val();
        var selectedRating = $('input[name="rating"]:checked').val();
        var id = $('#idproductreview').val();

        if (reviewreview == null || selectedRating == null) {
            toastr.error('{{ trans('messages.plsin4') }}');
        }

        $.ajax({
            type: 'POST',
            url: "{{ route('addreview') }}",
            data: {
                _token: '{{ csrf_token() }}',
                review: reviewreview,
                rating: selectedRating,
                id: id,
            },
            success: function(response) {
                var html = response.html;
                $('#capnhatreview').prepend(html);
                toastr.success('{{ trans('messages.reviewaddsuc') }}');
                $('#reviewreview').val('');
                $('input[name="rating"]').prop('checked', false);
            }
        });

    });

    $('#morereview').on('click', function() {
        var id = $('#idproductreview').val();
        $.ajax({
            type: 'POST',
            url: "{{ route('morereview') }}",
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
            },
            success: function(response) {
                var html = response.html;
                $('#capnhatreview').html(html);
                $('#morereview').hide();
            }
        });
    });
});
</script>

@endsection