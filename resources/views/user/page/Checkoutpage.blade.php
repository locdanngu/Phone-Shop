@extends('user.layouts.Userlayout')

@section('title', 'Checkout')

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>{{ trans('messages.checkoutbtn') }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="">
            <h3>{{ trans('messages.idorder') }}: {{ $order->idorder }}</h3>
            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="card-body table-responsive p-0">
                        <div class="d-flex flex-column justify-content-between">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">{{ trans('messages.image') }}</th>
                                        <th class="product-name">{{ trans('messages.product') }}</th>
                                        <th class="product-price">{{ trans('messages.price') }}</th>
                                        <th class="product-quantity">{{ trans('messages.quantity') }}</th>
                                        <th class="product-quantity">{{ trans('messages.coupon') }}</th>
                                        <th class="product-subtotal">{{ trans('messages.price') }}</th>
                                        <th class="product-subtotal">{{ trans('messages.total') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="capnhatdanhsachorder">
                                    @foreach($listorder as $c)
                                    <tr class="cart_item" data-product-id="{{ $c->idcart_product }}">
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
                                            <span class="amount">{{ $currencySymbol }} {{ $c->product->price }}</span>
                                        </td>

                                        <td class="product-quantity">
                                            <span class="amount">{{ $c->quantity }}</span>
                                        </td>
                                        <td class="product-price">
                                            @if($c->idcoupon)
                                            <span class="amount" style="font-weight:bold">{{ $c->coupon->code }}</span>
                                            @else
                                            <span class="amount"
                                                style="font-weight:bold">{{ trans('messages.none') }}</span>
                                            @endif
                                        </td>
                                        <td class="product-price">
                                            <span class="amount"
                                                style="color:red; font-weight:bold">{{ $currencySymbol }} {{ number_format($c->quantity * $c->product->price, 2) }}</span>
                                        </td>
                                        @if($c->idcoupon)

                                        <td class="product-price">
                                            <span class="amount"
                                                style="color:red; font-weight:bold">{{ $currencySymbol }} {{ number_format($c->beforecoupon, 2) }}</span>
                                        </td>
                                        @else
                                        <td class="product-price">
                                            <span class="amount"
                                                style="color:red; font-weight:bold">{{ $currencySymbol }} {{ number_format($c->quantity * $c->product->price, 2) }}</span>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <h3>{{ trans('messages.apply') }}: {{ $countcoupon }}</h3>
            <div class="woocommerce-info">{{ trans('messages.haveacoupon') }}? <a class="showcoupon"
                    data-toggle="collapse" href="#coupon-collapse-wrap" aria-expanded="false"
                    aria-controls="coupon-collapse-wrap">{{ trans('messages.enteryourcode') }}</a>
            </div>

            <div id="coupon-collapse-wrap" method="post" class="checkout_coupon collapse">

                <p class="form-row form-row-first">
                    <input type="text" value="" id="checkcoupon_code" placeholder="{{ trans('messages.coupon') }}"
                        class="input-text" name="coupon_code">
                </p>

                <p class="form-row form-row-last">
                    <input type="submit" value="{{ trans('messages.apply') }} {{ trans('messages.coupon') }}"
                        name="apply_coupon" class="button" id="checkcoupon">
                </p>
            </div>
            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="card-body table-responsive p-0">
                        <div class="d-flex flex-column justify-content-between">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-name">{{ trans('messages.apply') }}</th>
                                        <th class="product-price">{{ trans('messages.code') }}</th>
                                        <th class="product-quantity">{{ trans('messages.discountamount') }}</th>
                                        <th class="product-quantity">{{ trans('messages.maxdiscount') }}</th>
                                        <th class="product-quantity"></th>
                                    </tr>
                                </thead>
                                <tbody id="capnhatdanhsachcoupon">
                                    @if($couponcart)
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            <span class="amount"
                                                style="text-transform: uppercase;font-weight:bold">{{ $couponcart->applicable_to }}</span>
                                        </td>

                                        <td class="product-price">
                                            <span class="amount"
                                                style="font-weight:bold; color:red">{{ $couponcart->code }}</span>
                                        </td>
                                        @if($couponcart->discount_type == 'percentage')
                                        <td class="product-quantity">
                                            <span class="amount">{{ $couponcart->discount_amount }}%</span>
                                        </td>
                                        @else
                                        <td class="product-quantity">
                                            <span class="amount">{{ $couponcart->discount_amount }}{{ $currencySymbol }}</span>
                                        </td>
                                        @endif
                                        <td class="product-quantity">
                                            <span class="amount"
                                                style="color:red;font-weight:bold">{{ $currencySymbol }} {{ $couponcart->max_discount_amount }}</span>
                                        </td>
                                        <td class="actions" style="display: flex;justify-content:center">
                                            <a href="#" type="button" data-toggle="modal"
                                                data-target="#modal-deleteproduct2" class="btnchangeuser"
                                                data-id="{{ $couponcart->idcoupon }}"
                                                data-code="{{ $couponcart->code }}">
                                                <i class="bi bi-trash-fill"></i> {{ trans('messages.delete') }}</a>
                                        </td>
                                    </tr>
                                    @endif
                                    @foreach($listcoupon as $c)
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            <span class="amount"
                                                style="text-transform: uppercase;font-weight:bold">{{ $c->applicable_to }}</span>
                                        </td>

                                        <td class="product-price">
                                            <span class="amount"
                                                style="font-weight:bold; color:red">{{ $c->code }}</span>
                                        </td>
                                        @if($c->discount_type == 'percentage')
                                        <td class="product-quantity">
                                            <span class="amount">{{ $c->discount_amount }}%</span>
                                        </td>
                                        @else
                                        <td class="product-quantity">
                                            <span class="amount">{{ $c->discount_amount }}{{ $currencySymbol }}</span>
                                        </td>
                                        @endif
                                        <td class="product-quantity">
                                            <span class="amount"
                                                style="color:red;font-weight:bold">{{ $currencySymbol }} {{ $c->max_discount_amount }}</span>
                                        </td>
                                        <td class="actions" style="display: flex;justify-content:center">
                                            <a href="#" type="button" data-toggle="modal"
                                                data-target="#modal-deleteproduct" class="btnchangeuser"
                                                data-id="{{ $c->idcoupon }}" data-code="{{ $c->code }}">
                                                <i class="bi bi-trash-fill"></i> {{ trans('messages.delete') }}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>






















            <table class="shop_table">
                <thead>
                    <tr>
                        <th class="product-name"></th>
                        <th class="product-total">{{ trans('messages.total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="cart_item">
                        <td class="product-name">
                            {{ trans('messages.allproduct') }} <strong class="product-quantity"></strong> </td>
                        <td class="product-total">
                            <span class="amount font-weight-bold">{{ $currencySymbol }} {{ number_format($order->totalprice, 2) }}</span>
                        </td>
                    </tr>
                </tbody>
                <tfoot>

                    <tr class="cart-subtotal">
                        <th>{{ trans('messages.addcouponproduct') }}</th>
                        <td><span class="amount font-weight-bold"> -
                                {{ $currencySymbol }} {{ number_format($order->totalprice - $order->totalprice2, 2) }}</span>
                        </td>
                    </tr>

                    <tr class="cart-subtotal">
                        <th>{{ trans('messages.addcouponcart') }}</th>
                        <td><span class="amount font-weight-bold"> -
                                {{ $currencySymbol }} {{ number_format($order->totalprice2 - $order->beforecoupon, 2) }}</span>
                        </td>
                    </tr>

                    <tr class="shipping">
                        <th>{{ trans('messages.shippingandhandle') }}</th>
                        <td>

                            {{ trans('messages.freeshipping') }}
                            <input type="hidden" class="shipping_method" value="free_shipping" id="shipping_method_0"
                                data-index="0" name="shipping_method[0]">
                        </td>
                    </tr>


                    <tr class="order-total">
                        <th>{{ trans('messages.ordertotal') }}</th>
                        <td><strong><span
                                    class="amount red">{{ $currencySymbol }} {{ number_format($order->beforecoupon, 2) }}</span></strong>
                        </td>
                    </tr>

                </tfoot>
            </table>

            <form action="{{ route('bankpayment') }}" method="get" id="payment">





                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="card-body table-responsive p-0">
                            <div class="d-flex flex-column justify-content-between">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail"></th>
                                            <th class="product-name">{{ trans('messages.address') }}</th>
                                            <th class="product-price">{{ trans('messages.statecountry') }}</th>
                                            <th class="product-quantity">{{ trans('messages.country') }}</th>
                                            <th class="product-quantity">{{ trans('messages.towncity') }}</th>
                                            <th class="product-quantity">{{ trans('messages.companyname') }}</th>
                                            <th class="product-subtotal">{{ trans('messages.postcode') }}</th>
                                            <th class="product-subtotal">{{ trans('messages.apartment') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="capnhatdanhsachorder">
                                        @foreach($listaddress as $c)
                                        <tr class="cart_item">
                                            <td class="product-thumbnail">
                                                <input type="radio" name="address" value="{{ $c->idaddress }}" required>
                                            </td>
                                            <td class="product-thumbnail">
                                                <span class="amount">{{ $c->address }}</span>
                                            </td>

                                            <td class="product-name">
                                                <span class="amount">{{ $c->state_country }}</span>
                                            </td>

                                            <td class="product-price">
                                                <span class="amount">{{ $c->country }}</span>
                                            </td>

                                            <td class="product-quantity">
                                                <span class="amount">{{ $c->town_city }}</span>
                                            </td>
                                            <td class="product-quantity">
                                                <span class="amount">{{ $c->companyname }}</span>
                                            </td>
                                            <td class="product-quantity">
                                                <span class="amount">{{ $c->postcode }}</span>
                                            </td>
                                            <td class="product-quantity">
                                                <span class="amount">{{ $c->apartment }}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>









                <ul class="payment_methods methods">
                    <li class="payment_method_bacs">
                        <input type="radio" data-order_button_text="" checked="checked" value="bank"
                            name="payment_method" class="input-radio" id="payment_method_bacs">
                        <label for="payment_method_bacs">{{ trans('messages.bank') }} </label>
                        <div class="payment_box payment_method_bacs">
                            <p>{{ trans('messages.bank2') }}</p>
                        </div>
                    </li>
                    <input type="hidden" name="idorder" value="{{ request()->input('idorder') }}">
                    <li class="payment_method_paypal">
                        <input type="radio" data-order_button_text="Proceed to PayPal" value="paypal"
                            name="payment_method" class="input-radio" id="payment_method_paypal">
                        <label for="payment_method_paypal">PayPal <img alt="PayPal Acceptance Mark"
                                src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png"><a
                                title="What is PayPal?"
                                onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"
                                class="about_paypal"
                                href="https://www.paypal.com/gb/webapps/mpp/paypal-popup">{{ trans('messages.paypal') }}?</a>
                        </label>
                        <div style="display:none;" class="payment_box payment_method_paypal">
                            <p>{{ trans('messages.paypal2') }}</p>
                        </div>
                    </li>
                    <!-- <li class="payment_method_cheque">
                        <input type="radio" data-order_button_text="" value="cheque" name="payment_method"
                            class="input-radio" id="payment_method_cheque">
                        <label for="payment_method_cheque">Payment on delivery </label>
                        <div style="display:none;" class="payment_box payment_method_cheque">
                        </div>
                    </li> -->
                </ul>

                <div class="form-row place-order">

                    <input type="submit" data-value="Place order" value="{{ trans('messages.placeorder') }}"
                        id="place_order" name="woocommerce_checkout_place_order" class="button alt">


                </div>

                <div class="clear"></div>

            </form>
        </div>
    </div>
</div>
@endsection


@section('popup')
<div class="modal fade" id="modal-deleteproduct">
    <div class="modal-dialog">
        <form action="{{ route('deleteapplycoupon') }}" method="post" class="modal-content">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Delete this coupon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="color:red; font-weight: bold">This will remove discount codes on all products</h3>
                <input type="hidden" name="idcoupon">
                <input type="hidden" name="idorder" value="{{ request()->input('idorder') }}" id="iddonhang">
                <span name="code" style="font-weight:bold;"></span>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-deleteproduct2">
    <div class="modal-dialog">
        <form action="{{ route('deleteapplycouponcart') }}" method="post" class="modal-content">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Delete this coupon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="color:red; font-weight: bold">This will remove discount codes on you checkout</h3>
                <input type="hidden" name="idcoupon">
                <input type="hidden" name="idorder" value="{{ request()->input('idorder') }}" id="iddonhang">
                <span name="code" style="font-weight:bold;"></span>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


@endsection


@section('js')
<script>
$('#modal-deleteproduct').on('shown.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Nút "Change" được nhấn
    var id = button.data('id');
    var code = button.data('code');
    var modal = $(this);
    modal.find('span[name="code"]').text('Code coupon: ' + code);
    modal.find('input[name="idcoupon"]').val(id);
});

$('#modal-deleteproduct2').on('shown.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Nút "Change" được nhấn
    var id = button.data('id');
    var code = button.data('code');
    var modal = $(this);
    modal.find('span[name="code"]').text('Code coupon: ' + code);
    modal.find('input[name="idcoupon"]').val(id);
});


$('#checkcoupon').on('click', function(event) {
    var couponcode = $('#checkcoupon_code').val();
    var iddonhang = $('#iddonhang').val();

    if (couponcode.length < 6 || couponcode.length > 18) {
        toastr.error(
            '<b>Coupon must not be less than 6 characters and more than 18</b>'
        )
    } else {
        $.ajax({
            type: 'POST',
            url: "{{ route('checkcoupon') }}",
            data: {
                _token: '{{ csrf_token() }}',
                coupon: couponcode,
                idorder: iddonhang,
            },
            success: function(response) {

                var re = response.re;
                if (re == 0) {
                    toastr.error('Coupon does not exist.');
                } else if (re == 1) {
                    toastr.error('This coupon has not started yet.');
                } else if (re == 2) {
                    toastr.error('This coupon has expired.');
                } else if (re == 3) {
                    toastr.error('This coupon does not apply to you.');
                } else if (re == 4) {
                    toastr.error('The order does not meet the specified price.');
                } else if (re == 6) {
                    toastr.error('No applicable products.');
                } else {
                    // var html = response.html;
                    // var html2 = response.html2;
                    // $("#capnhatdanhsachcoupon").html(html);
                    // $("#capnhatdanhsachorder").html(html2);
                    // toastr.success('Apply discount coupon successfully.');
                    window.location.href = "{{ route('checkout.page') }}?idorder=" + iddonhang;
                }
            }
        });
    }


});
</script>

@endsection