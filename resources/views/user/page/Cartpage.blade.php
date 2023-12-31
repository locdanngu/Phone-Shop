@extends('user.layouts.Userlayout')

@section('title', trans('messages.cartbtn'))

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>{{ trans('messages.cartbtn') }}</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">



            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="woocommerce">
                        @if($ccart_product != 0)
                        <form method="post" action="{{ route('checkout') }}">
                            @csrf
                            <div class="card-body table-responsive p-0">
                                <div class="d-flex flex-column justify-content-between">
                                    <table cellspacing="0" class="shop_table cart">
                                        <thead>
                                            <tr>
                                                <th class="product-remove">&nbsp;</th>
                                                <th class="product-thumbnail">{{ trans('messages.image') }}</th>
                                                <th class="product-name">{{ trans('messages.product') }}</th>
                                                <th class="product-price">{{ trans('messages.price') }}</th>
                                                <th class="product-quantity">{{ trans('messages.quantity') }}</th>
                                                <th class="product-quantity">{{ trans('messages.coupon') }}</th>
                                                <th class="product-subtotal">{{ trans('messages.total') }}</th>
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
                                                            width="145" height="145" alt="poster_1_up"
                                                            class="shop_thumbnail"
                                                            src="{{ $c->product->imageproduct }}"></a>
                                                </td>

                                                <td class="product-name">
                                                    <a
                                                        href="{{ route('product.page', ['nameproduct' => $c->product->nameproduct]) }}">{{ $c->product->nameproduct }}</a>
                                                </td>

                                                <td class="product-price">
                                                    <span class="amount">{{ $currencySymbol }}
                                                        @convertCurrency($c->product->price)</span>
                                                </td>

                                                <td class="product-quantity" style="padding:0 5px">
                                                    <div class="quantity buttons_added">
                                                        <input type="button" class="minus" value="-" data-quantity="1"
                                                            data-id="{{ $c->idcart_product }}">
                                                        <input type="number" size="4" class="input-text qty text"
                                                            title="Qty" value="{{ $c->quantity }}" step="1" min="1"
                                                            data-id="{{ $c->idcart_product }}">
                                                        <input type="button" class="plus" value="+" data-quantity="1"
                                                            data-id="{{ $c->idcart_product }}">
                                                    </div>
                                                </td>
                                                <td class="product-coupon">
                                                    @if($c->idcoupon)
                                                    <span class="amount">{{ $c->coupon->code }}</span>
                                                    @else
                                                    <span class="amount">{{ trans('messages.none') }}</span>
                                                    @endif
                                                </td>
                                                <td class="product-subtotal"
                                                    id="capnhat1product-{{ $c->idcart_product }}">
                                                    <span class="amount"
                                                        style="color:red; font-weight:bold">{{ $currencySymbol }}
                                                        @convertCurrency(($c->quantity * $c->product->price))</span>
                                                </td>
                                            </tr>

                                            @endforeach
                                            <tr>
                                                <td class="actions" colspan="7" style="text-align:end" id="hidecheckout">
                                                    @if($countaddress == 0)
                                                    <a href="{{ route('chuyenhuong') }}"
                                                        class="btnchangeuser">{{ trans('messages.checkoutbtn') }}</a>
                                                    @else
                                                    <input type="submit" value="{{ trans('messages.checkoutbtn') }}"
                                                        name="proceed" class="checkout-button button alt wc-forward">
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>





                        <div class="cart_totals ">
                            <h2>{{ trans('messages.carttotal') }}</h2>

                            <table cellspacing="0">
                                <tbody>
                                    <tr class="order-total" id="capnhattotalprice">
                                        <th>{{ trans('messages.ordertotal') }}</th>
                                        <td><strong><span class="amount"
                                                    style="font-weight:bold;color:red">{{ $currencySymbol }}
                                                    @convertCurrency($scart_product)</span></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>










                    </div>
                    @else
                    <div class="box">
                        <h2>{{ trans('messages.cartempty') }}! <a
                                href="{{ route('shop.page') }}">{{ trans('messages.gotoshopnow') }}</a></h2>
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
                <h4 class="modal-title">{{ trans('messages.deleteproduct') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="color:red; font-weight: bold">{{ trans('messages.deleteproduct2') }}</h3>
                <span name="nameproduct"></span>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-danger" id="deleteproduct">{{ trans('messages.delete') }}</button>
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
                var html3 = response.html3;
                $("#capnhat1product-" + productId).html(html3);
            }
        });
    }

    // updateSubtotal(inputElement);
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
                var html3 = response.html3;
                $("#capnhat1product-" + productId).html(html3);
            }
        });
    }

    // updateSubtotal(inputElement);
});

// function updateSubtotal(inputElement) {
//     var quantity = parseInt(inputElement.val());
//     var price = parseFloat(inputElement.closest('tr').find('.product-price .amount').text().replace('$', ''));

//     var subtotal = quantity * price;
//     inputElement.closest('tr').find('.product-subtotal .amount').text('$' + subtotal.toFixed(2));
// }

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
            var html3 = response.html3;
            $("#capnhat1product-" + productId).html(html3);
        }
    });


    // var subtotal = quantity * price;
    // inputElement.closest('tr').find('.product-subtotal .amount').text('$' + subtotal.toFixed(2));
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
            var sum = response.scart_product;
            if(sum == 0){
                $('#hidecheckout').hide();
            }
            // Xóa phần tử HTML của sản phẩm khỏi danh sách
            $('#capnhatdanhsachcart tr[data-product-id="' + id + '"]').remove();
            toastr.success('{{ trans('messages.deleteproductformcart') }}');
            $('#modal-deleteproduct').modal('hide');
        }
    });
});
</script>
@endsection