@extends('user.layouts.Userlayout')

@section('title', 'Bank Payment')

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Bank payment</h2>
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
                                                class="amount font-weight-bold">${{ number_format($sumallproduct, 2) }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>

                                    <tr class="cart-subtotal">
                                        <th>Add coupon</th>
                                        @if($sumproduct == 0)
                                        <td><span class="amount">${{ number_format(0, 2) }}</span>
                                            @else
                                        <td><span
                                                class="amount">${{ number_format($sumallproduct - $sumproduct, 2) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>Before coupon</th>
                                        @if($sumproduct == 0)
                                        <td><span
                                                class="amount font-weight-bold">${{ number_format($sumallproduct, 2) }}</span>
                                            @else
                                        <td><span
                                                class="amount font-weight-bold">${{ number_format($sumproduct, 2) }}</span>
                                            @endif
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
                                        @if($sumproduct != 0)
                                        <td><strong><span
                                                    class="amount red">${{ number_format($sumproduct, 2) }}</span></strong>
                                        </td>
                                        @else
                                        <td><strong><span
                                                    class="amount red">${{ number_format($sumallproduct, 2) }}</span></strong>
                                        </td>
                                        @endif
                                    </tr>

                                </tfoot>
                            </table>
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