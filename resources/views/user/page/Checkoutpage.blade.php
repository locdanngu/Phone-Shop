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
        <div class="row">
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
                                <tbody>
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
                                        @if($c->coupon->discount_type == 'amount')
                                        <td class="product-price">
                                            <span class="amount"
                                                style="color:red; font-weight:bold">${{ number_format($c->quantity * ($c->product->price - $c->coupon->discount_amount), 2) }}</span>
                                        </td>
                                        @else
                                        <td class="product-price">
                                            <span class="amount"
                                                style="color:red; font-weight:bold">${{ number_format($c->quantity * ($c->product->price - $c->product->price) * $c->coupon->discount_amount / 100, 2) }}</span>
                                        </td>
                                        @endif
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
            @if($countcoupon != 0)
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
                                        <th class="product-quantity"></th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                        <td class="actions" style="display: flex;justify-content:center">
                                            <a href="#" type="button" data-toggle="modal"
                                                data-target="#modal-deleteproduct" class="btnchangeuser"
                                                data-id="{{ $couponcart->idcoupon }}" data-code="{{ $couponcart->code }}">
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
            @endif
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
                <input type="hidden" name="idorder" value="{{ request()->input('idorder') }}">
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
</script>

@endsection