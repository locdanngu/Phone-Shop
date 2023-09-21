@extends('user.layouts.Userlayout')

@section('title', 'Checkout')

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Checkout</h2>
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
            <div class="woocommerce-info">Have a coupon? <a class="showcoupon" data-toggle="collapse"
                    href="#coupon-collapse-wrap" aria-expanded="false" aria-controls="coupon-collapse-wrap">Click here
                    to enter your code</a>
            </div>

            <div id="coupon-collapse-wrap" method="post" class="checkout_coupon collapse">

                <p class="form-row form-row-first">
                    <input type="text" value="" id="checkcoupon_code" placeholder="Coupon code" class="input-text"
                        name="coupon_code">
                </p>

                <p class="form-row form-row-last">
                    <input type="submit" value="Apply Coupon" name="apply_coupon" class="button" id="checkcoupon">
                </p>
            </div>
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
                                            <span class="amount">{{ $couponcart->discount_amount }}$</span>
                                        </td>
                                        @endif
                                        <td class="product-quantity">
                                            <span class="amount"
                                                style="color:red;font-weight:bold">${{ $couponcart->max_discount_amount }}</span>
                                        </td>
                                        <td class="actions" style="display: flex;justify-content:center">
                                            <a href="#" type="button" data-toggle="modal"
                                                data-target="#modal-deleteproduct" class="btnchangeuser"
                                                data-id="{{ $couponcart->idcoupon }}"
                                                data-code="{{ $couponcart->code }}">
                                                <i class="bi bi-trash-fill"></i> Delete</a>
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
                                        <td class="actions" style="display: flex;justify-content:center">
                                            <a href="#" type="button" data-toggle="modal"
                                                data-target="#modal-deleteproduct" class="btnchangeuser"
                                                data-id="{{ $c->idcoupon }}" data-code="{{ $c->code }}">
                                                <i class="bi bi-trash-fill"></i> Delete</a>
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
                        <th class="product-total">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="cart_item">
                        <td class="product-name">
                            All product <strong class="product-quantity"></strong> </td>
                        <td class="product-total">
                            <span class="amount">£15.00</span>
                        </td>
                    </tr>
                </tbody>
                <tfoot>

                    <tr class="cart-subtotal">
                        <th>Add coupon</th>
                        <td><span class="amount">£15.00</span>
                        </td>
                    </tr>
                    <tr class="cart-subtotal">
                        <th>Before coupon</th>
                        <td><span class="amount">£15.00</span>
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
                        <td><strong><span class="amount">£15.00</span></strong> </td>
                    </tr>

                </tfoot>
            </table>
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
                <h4 class="modal-title">Delete this checkout</h4>
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
                    var html = response.html;
                    var html2 = response.html2;
                    $("#capnhatdanhsachcoupon").html(html);
                    $("#capnhatdanhsachorder").html(html2);
                    toastr.success('Apply discount coupon successfully.');
                }
            }
        });
    }


});
</script>

@endsection