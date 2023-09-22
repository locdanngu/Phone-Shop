@extends('user.layouts.Userlayout')

@section('title', 'History order')

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>History order</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="">
            <h3>Id order: {{ $order->idorder }}</h3>
            <h3>Status:
                @if($order->status == 'wait' || $order->status == 'paypal')
                <span style="color:brown">Wait for confirmation</span>
                @elseif($order->status == 'cancel')
                <span style="color:red">Deny</span>
                @elseif($order->status == 'done')
                <span style="color:green">Success</span>
                @elseif($order->status == 'ship')
                <span style="color:green">Delivery</span>
                @else
                <span>Unknown</span> <!-- Hoặc bạn có thể sử dụng nội dung mặc định khác -->
                @endif
            </h3>
            @if($order->pay != null)
            @if($order->pay == 'bank')
            <h3>Payment: <span>Bank</span></h3>
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
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-quantity">Coupon</th>
                                        <th class="product-subtotal">Price</th>
                                        <th class="product-subtotal">Total</th>
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
                                            <span class="amount">${{ $c->product->price }}</span>
                                        </td>

                                        <td class="product-quantity">
                                            <span class="amount">{{ $c->quantity }}</span>
                                        </td>
                                        <td class="product-price">
                                            @if($c->idcoupon)
                                            <span class="amount" style="font-weight:bold">{{ $c->coupon->code }}</span>
                                            @else
                                            <span class="amount" style="font-weight:bold">None</span>
                                            @endif
                                        </td>
                                        <td class="product-price">
                                            <span class="amount"
                                                style="color:red; font-weight:bold">${{ number_format($c->quantity * $c->product->price, 2) }}</span>
                                        </td>
                                        @if($c->idcoupon)

                                        <td class="product-price">
                                            <span class="amount"
                                                style="color:red; font-weight:bold">${{ number_format($c->beforecoupon, 2) }}</span>
                                        </td>
                                        @else
                                        <td class="product-price">
                                            <span class="amount"
                                                style="color:red; font-weight:bold">${{ number_format($c->quantity * $c->product->price, 2) }}</span>
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


            <h3>Apply coupon: {{ $countcoupon }}</h3>
            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="card-body table-responsive p-0">
                        <div class="d-flex flex-column justify-content-between">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-name">Apply</th>
                                        <th class="product-price">Code</th>
                                        <th class="product-quantity">Discount Amount</th>
                                        <th class="product-quantity">Max discount</th>
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
                                            <span class="amount">{{ $couponcart->discount_amount }}$</span>
                                        </td>
                                        @endif
                                        <td class="product-quantity">
                                            <span class="amount"
                                                style="color:red;font-weight:bold">${{ $couponcart->max_discount_amount }}</span>
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
                                            <span class="amount">{{ $c->discount_amount }}$</span>
                                        </td>
                                        @endif
                                        <td class="product-quantity">
                                            <span class="amount"
                                                style="color:red;font-weight:bold">${{ $c->max_discount_amount }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="card-body table-responsive p-0">
                        <div class="d-flex flex-column justify-content-between">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-name">Address</th>
                                        <th class="product-price">state country</th>
                                        <th class="product-quantity">country</th>
                                        <th class="product-quantity">town city</th>
                                        <th class="product-quantity">company name</th>
                                        <th class="product-subtotal">post code</th>
                                        <th class="product-subtotal">apartment</th>
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
                        <th class="product-total">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="cart_item">
                        <td class="product-name">
                            All product <strong class="product-quantity"></strong> </td>
                        <td class="product-total">
                            <span class="amount font-weight-bold">${{ number_format($order->totalprice, 2) }}</span>
                        </td>
                    </tr>
                </tbody>
                <tfoot>

                    <tr class="cart-subtotal">
                        <th>Add coupon product</th>
                        <td><span class="amount font-weight-bold"> -
                                ${{ number_format($order->totalprice - $order->totalprice2, 2) }}</span>
                        </td>
                    </tr>

                    <tr class="cart-subtotal">
                        <th>Add coupon cart</th>
                        <td><span class="amount font-weight-bold"> -
                                ${{ number_format($order->totalprice2 - $order->beforecoupon, 2) }}</span>
                        </td>
                    </tr>

                    <tr class="shipping">
                        <th>Shipping and Handling</th>
                        <td>

                            Free Shipping
                            <input type="hidden" class="shipping_method" value="free_shipping" id="shipping_method_0"
                                data-index="0" name="shipping_method[0]">
                        </td>
                    </tr>


                    <tr class="order-total">
                        <th>Order Total</th>
                        <td><strong><span
                                    class="amount red">${{ number_format($order->beforecoupon, 2) }}</span></strong>
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