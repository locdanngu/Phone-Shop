@extends('user.layouts.Userlayout')

@section('title', 'Checkout')

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shopping Cart</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="product-content-right">


                    <div class="card-body table-responsive p-0">
                        <div class="d-flex flex-column justify-content-between">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-quantity">Coupon</th>
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
                                        <td class="product-price">
                                            @if($c->idcoupon)
                                            <span class="amount">{{ $c->coupon->code }}</span>
                                            @else
                                            <span class="amount">None</span>
                                            @endif
                                        </td>
                                        <td class="product-price">
                                            <span class="amount"
                                                style="color:red; font-weight:bold">${{ number_format($c->quantity * $c->product->price, 2) }}</span>
                                        </td>
                                    </tr>

                                    @endforeach
                                    <tr>
                                        <td class="actions" colspan="7" style="text-align:end">
                                            <div class="coupon">
                                                <label for="coupon_code">Coupon:</label>
                                                <input type="text" placeholder="Coupon code" value="" id="coupon_code"
                                                    class="input-text" name="coupon_code">
                                                <a href="#" class="btnchangeuser">APPLY COUPON</a>
                                            </div>


                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>





                    <div class="woocommerce">
                        <div class="woocommerce-info">Have a coupon? <a class="showcoupon" data-toggle="collapse"
                                href="#coupon-collapse-wrap" aria-expanded="false"
                                aria-controls="coupon-collapse-wrap">Click here to enter your code</a>
                        </div>

                        <form id="coupon-collapse-wrap" method="post" class="checkout_coupon collapse">

                            <p class="form-row form-row-first">
                                <input type="text" value="" id="coupon_code" placeholder="Coupon code"
                                    class="input-text" name="coupon_code">
                            </p>

                            <p class="form-row form-row-last">
                                <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                            </p>

                            <div class="clear"></div>
                        </form>



                        <h3 id="order_review_heading">Your order</h3>

                        <div id="order_review" style="position: relative;">
                            <table class="shop_table">
                                <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            Ship Your Idea <strong class="product-quantity">× 1</strong> </td>
                                        <td class="product-total">
                                            <span class="amount">£15.00</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>

                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">£15.00</span>
                                        </td>
                                    </tr>

                                    <tr class="shipping">
                                        <th>Shipping and Handling</th>
                                        <td>

                                            Free Shipping
                                            <input type="hidden" class="shipping_method" value="free_shipping"
                                                id="shipping_method_0" data-index="0" name="shipping_method[0]">
                                        </td>
                                    </tr>


                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">£15.00</span></strong> </td>
                                    </tr>

                                </tfoot>
                            </table>


                            <div id="payment">
                                <ul class="payment_methods methods">
                                    <li class="payment_method_bacs">
                                        <input type="radio" data-order_button_text="" checked="checked" value="bacs"
                                            name="payment_method" class="input-radio" id="payment_method_bacs">
                                        <label for="payment_method_bacs">Direct Bank Transfer </label>
                                        <div class="payment_box payment_method_bacs">
                                            <p>Make your payment directly into our bank account. Please use your
                                                Order ID as the payment reference. Your order won’t be shipped until
                                                the funds have cleared in our account.</p>
                                        </div>
                                    </li>
                                    <li class="payment_method_cheque">
                                        <input type="radio" data-order_button_text="" value="cheque"
                                            name="payment_method" class="input-radio" id="payment_method_cheque">
                                        <label for="payment_method_cheque">Cheque Payment </label>
                                        <div style="display:none;" class="payment_box payment_method_cheque">
                                            <p>Please send your cheque to Store Name, Store Street, Store Town,
                                                Store State / County, Store Postcode.</p>
                                        </div>
                                    </li>
                                    <li class="payment_method_paypal">
                                        <input type="radio" data-order_button_text="Proceed to PayPal" value="paypal"
                                            name="payment_method" class="input-radio" id="payment_method_paypal">
                                        <label for="payment_method_paypal">PayPal <img alt="PayPal Acceptance Mark"
                                                src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png"><a
                                                title="What is PayPal?"
                                                onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"
                                                class="about_paypal"
                                                href="https://www.paypal.com/gb/webapps/mpp/paypal-popup">What is
                                                PayPal?</a>
                                        </label>
                                        <div style="display:none;" class="payment_box payment_method_paypal">
                                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a
                                                PayPal account.</p>
                                        </div>
                                    </li>
                                </ul>

                                <div class="form-row place-order">

                                    <input type="submit" data-value="Place order" value="Place order" id="place_order"
                                        name="woocommerce_checkout_place_order" class="button alt">


                                </div>

                                <div class="clear"></div>

                            </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection