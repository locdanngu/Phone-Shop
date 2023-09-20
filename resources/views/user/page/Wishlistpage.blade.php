@extends('user.layouts.Userlayout')

@section('title', 'Wish list')

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Wish list</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            @include('user.layouts.Leftbar')


            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">
                        @if($ccart_product != 0)
                        <form method="post" action="#">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="capnhatdanhsachcart">
                                    @foreach($cart as $c)
                                    <tr class="cart_item" data-product-id="{{ $c->idcart_product }}">
                                        <td class="product-remove">
                                            <a title="Remove this item" class="remove" href="#" type="button"
                                                data-toggle="modal" data-target="#modal-deleteproduct"
                                                data-id="{{ $c->idcart_product }}"
                                                data-name="{{ $c->product->nameproduct }}">×</a>
                                        </td>

                                        <td class="product-thumbnail">
                                            <a
                                                href="{{ route('product.page', ['nameproduct' => $c->product->nameproduct]) }}"><img
                                                    width="145" height="145" alt="poster_1_up" class="shop_thumbnail"
                                                    src="{{ $c->product->imageproduct }}"></a>
                                        </td>

                                        <td class="product-name">
                                            <a
                                                href="{{ route('product.page', ['nameproduct' => $c->product->nameproduct]) }}">{{ $c->product->nameproduct }}</a>
                                        </td>

                                        <td class="product-price">
                                            <span class="amount">${{ $c->product->price }}</span>
                                        </td>

                                        <td class="product-quantity" style="padding:0 5px">
                                            <div class="quantity buttons_added">
                                                <input type="button" class="minus" value="-" data-quantity="1"
                                                    data-id="{{ $c->idcart_product }}">
                                                <input type="number" size="4" class="input-text qty text" title="Qty"
                                                    value="{{ $c->quantity }}" step="1" min="1"
                                                    data-id="{{ $c->idcart_product }}">
                                                <input type="button" class="plus" value="+" data-quantity="1"
                                                    data-id="{{ $c->idcart_product }}">
                                            </div>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="amount"
                                                style="color:red; font-weight:bold">${{ number_format($c->quantity * $c->product->price, 2) }}</span>
                                        </td>
                                    </tr>

                                    @endforeach
                                    <tr>
                                        <td class="actions" colspan="6" style="text-align:end">
                                            <!-- <div class="coupon">
                                                <label for="coupon_code">Coupon:</label>
                                                <input type="text" placeholder="Coupon code" value="" id="coupon_code"
                                                    class="input-text" name="coupon_code">
                                                <input type="submit" value="Apply Coupon" name="apply_coupon"
                                                    class="button">
                                            </div> -->
                                            <!-- <input type="submit" value="Update Cart" name="update_cart" class="button"> -->
                                            <input type="submit" value="Checkout" name="proceed"
                                                class="checkout-button button alt wc-forward">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>


                        <div class="cart-collaterals">
                            <div class="cross-sells">
                                <h2>You may be interested in...</h2>
                                <ul class="products">
                                    @foreach($random as $rd)
                                    <li class="product">
                                        <a href="{{ route('product.page', ['nameproduct' => $rd->nameproduct]) }}">
                                            <img style="height: 250px;" alt="T_4_front"
                                                class="attachment-shop_catalog wp-post-image"
                                                src="{{ $rd->imageproduct }}">
                                            <h3 class="fixheight2">{{ $rd->nameproduct }}</h3>
                                            <span class="price"><span class="amount">${{ $rd->price }}</span></span>
                                        </a>

                                        <a class="add_to_cart_button" rel="nofollow"
                                            href="{{ route('product.page', ['nameproduct' => $rd->nameproduct]) }}">Select
                                            options</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>


                            <div class="cart_totals ">
                                <h2>Cart Totals</h2>

                                <table cellspacing="0">
                                    <tbody>
                                        <!-- <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">£15.00</span></td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping and Handling</th>
                                            <td>Free Shipping</td>
                                        </tr> -->

                                        <tr class="order-total" id="capnhattotalprice">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount"
                                                        style="font-weight:bold;color:red">${{ $scart_product }}</span></strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                            




                            


                        </div>
                        @else
                        <div class="box">
                            <h2>Your cart is empty! <a href="{{ route('shop.page') }}">Go to shop now</a></h2>
                            <i class="bi bi-emoji-frown-fill"></i>
                        </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('popup')
<div class="modal fade" id="modal-deleteproduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Deleteproduct</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="color:red; font-weight: bold">Delete this product?</h3>
                <span name="nameproduct"></span>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-danger" id="deleteproduct">Delete</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


@endsection

@section('js')
<script>
$('body').on('click', '.plus', function() {
    var inputElement = $(this).siblings('.qty');
    var quantity = parseInt(inputElement.val()) + parseInt($(this).data('quantity'));

    if (quantity > 0) {
        inputElement.val(quantity);

        var productId = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: "{{ route('updateproductcart') }}",
            data: {
                _token: '{{ csrf_token() }}',
                id: productId,
                code: 0,
            },
            success: function(response) {
                var html = response.html;
                $("#capnhatcart").html(html);
                var html2 = response.html2;
                $("#capnhattotalprice").html(html2);
            }
        });
    }

    updateSubtotal(inputElement);
});

// Xử lý sự kiện khi nhấn nút "minus"
$('body').on('click', '.minus', function() {
    var inputElement = $(this).siblings('.qty');
    var quantity = parseInt(inputElement.val()) - parseInt($(this).data('quantity'));

    // Kiểm tra giới hạn số lượng nếu cần
    if (quantity > 0) {
        inputElement.val(quantity);

        var productId = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: "{{ route('updateproductcart') }}",
            data: {
                _token: '{{ csrf_token() }}',
                id: productId,
                code: 1,
            },
            success: function(response) {
                var html = response.html;
                $("#capnhatcart").html(html);
                var html2 = response.html2;
                $("#capnhattotalprice").html(html2);
            }
        });
    }

    updateSubtotal(inputElement);
});

function updateSubtotal(inputElement) {
    var quantity = parseInt(inputElement.val());
    var price = parseFloat(inputElement.closest('tr').find('.product-price .amount').text().replace('$', ''));

    var subtotal = quantity * price;
    inputElement.closest('tr').find('.product-subtotal .amount').text('$' + subtotal.toFixed(2));
}

$('body').on('change', '.qty', function() {
    var inputElement = $(this);
    var quantity = parseInt(inputElement.val());
    var price = parseFloat(inputElement.closest('tr').find('.product-price .amount').text().replace('$', ''));

    if (quantity < 0) {
        quantity = 0;
    }

    var productId = $(this).data('id');

    $.ajax({
        type: 'POST',
        url: "{{ route('updateproductcart') }}",
        data: {
            _token: '{{ csrf_token() }}',
            id: productId,
            quantity: quantity,
            code: 2,
        },
        success: function(response) {
            var html = response.html;
            $("#capnhatcart").html(html);
            var html2 = response.html2;
            $("#capnhattotalprice").html(html2);
        }
    });


    var subtotal = quantity * price;
    inputElement.closest('tr').find('.product-subtotal .amount').text('$' + subtotal.toFixed(2));
});



var globalId;

$('#modal-deleteproduct').on('shown.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Nút "Change" được nhấn
    var id = button.data('id');
    var name = button.data('name');
    var modal = $(this);
    globalId = id;
    modal.find('span[name="nameproduct"]').text(name);
});

$('#deleteproduct').on('click', function(event) {
    var id = globalId;
    console.log(id);
    $.ajax({
        type: 'POST',
        url: "{{ route('deleteproductcart') }}",
        data: {
            _token: '{{ csrf_token() }}',
            id: id,
        },
        success: function(response) {
            var html = response.html;
            $("#capnhatcart").html(html);
            var html2 = response.html2;
            $("#capnhattotalprice").html(html2);
            // Xóa phần tử HTML của sản phẩm khỏi danh sách
            $('#capnhatdanhsachcart tr[data-product-id="' + id + '"]').remove();
            toastr.success('Sản phẩm đã được xóa khỏi giỏ hàng.');
            $('#modal-deleteproduct').modal('hide');
        }
    });
});
</script>
@endsection