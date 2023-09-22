@extends('user.layouts.Userlayout')

@section('title', 'Paypal Payment')

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Paypal payment</h2>
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
                                            <span
                                                class="amount font-weight-bold">${{ number_format($order->totalprice, 2) }}</span>
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
                                            <input type="hidden" class="shipping_method" value="free_shipping"
                                                id="shipping_method_0" data-index="0" name="shipping_method[0]">
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


                            <form action="{{ route('user.pay') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ request()->input('idorder') }}" name="idorder">
                                <input type="hidden" value="{{ $order->beforecoupon }}" name="amount">  
                                <div class="d-flex flex-column mb-2">
                                    <p>Note order: </p>
                                    <textarea name="" id="" cols="30" rows="5" name="note"></textarea>
                                </div>
                                <input type="submit" data-value="Place order" value="Pay"
                                    name="woocommerce_checkout_place_order" class="button alt">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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