@extends('user.layouts.Userlayout')

@section('title', trans('messages.historypage'))

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>{{ trans('messages.historypage') }}</h2>
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
            <h3>{{ trans('messages.status') }}:
                @if($order->status == 'wait' || $order->status == 'paypal')
                <span style="color:brown">{{ trans('messages.wait') }}</span>
                @elseif($order->status == 'cancel')
                <span style="color:red">{{ trans('messages.deny') }}</span>
                @elseif($order->status == 'done')
                <span style="color:green">{{ trans('messages.success') }}</span>
                @elseif($order->status == 'ship')
                <span style="color:green">{{ trans('messages.delivery') }}</span>
                @else
                <span>Unknown</span> <!-- Hoặc bạn có thể sử dụng nội dung mặc định khác -->
                @endif
            </h3>
            @if($order->pay != null)
            @if($order->pay == 'bank')
            <h3>Payment: <span>{{ trans('messages.bank') }}</span></h3>
            @else
            <h3>Payment: <span>Paypal</span></h3>
            @endif
            @endif


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


            <h3>{{ trans('messages.apply') }} {{ trans('messages.coupon') }}: {{ $countcoupon }}</h3>
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
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <h3>{{ trans('messages.address') }}:</h3>
            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="card-body table-responsive p-0">
                        <div class="d-flex flex-column justify-content-between">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
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
                                    <tr class="cart_item">
                                        <td class="product-thumbnail">
                                            <span class="amount">{{ $address->address }}</span>
                                        </td>

                                        <td class="product-name">
                                            <span class="amount">{{ $address->state_country }}</span>
                                        </td>

                                        <td class="product-price">
                                            <span class="amount">{{ $address->country }}</span>
                                        </td>

                                        <td class="product-quantity">
                                            <span class="amount">{{ $address->town_city }}</span>
                                        </td>
                                        <td class="product-quantity">
                                            <span class="amount">{{ $address->companyname }}</span>
                                        </td>
                                        <td class="product-quantity">
                                            <span class="amount">{{ $address->postcode }}</span>
                                        </td>
                                        <td class="product-quantity">
                                            <span class="amount">{{ $address->apartment }}</span>
                                        </td>
                                    </tr>
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


        </div>
    </div>
</div>
@endsection


@section('popup')


@endsection


@section('js')
<script>

</script>

@endsection