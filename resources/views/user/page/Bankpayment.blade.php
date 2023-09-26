@extends('user.layouts.Userlayout')

@section('title', trans('messages.bankpayment'))

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>{{ trans('messages.bankpayment') }}</h2>
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
                                        <th class="product-total">{{ trans('messages.total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{ trans('messages.allproduct') }} <strong
                                                class="product-quantity"></strong> </td>
                                        <td class="product-total">
                                            <span
                                                class="amount font-weight-bold">{{ $currencySymbol }} @convertCurrency($order->totalprice)</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>

                                    <tr class="cart-subtotal">
                                        <th>{{ trans('messages.addcouponproduct') }}</th>
                                        <td><span class="amount font-weight-bold"> -
                                        {{ $currencySymbol }} @convertCurrency(($order->totalprice - $order->totalprice2))</span>
                                        </td>
                                    </tr>

                                    <tr class="cart-subtotal">
                                        <th>{{ trans('messages.addcouponcart') }}</th>
                                        <td><span class="amount font-weight-bold"> -
                                        {{ $currencySymbol }} @convertCurrency(($order->totalprice2 - $order->beforecoupon))</span>
                                        </td>
                                    </tr>

                                    <tr class="shipping">
                                        <th>{{ trans('messages.shippingandhandle') }}</th>
                                        <td>

                                            {{ trans('messages.freeshipping') }}
                                            <input type="hidden" class="shipping_method" value="free_shipping"
                                                id="shipping_method_0" data-index="0" name="shipping_method[0]">
                                        </td>
                                    </tr>


                                    <tr class="order-total">
                                        <th>{{ trans('messages.ordertotal') }}</th>
                                        <td><strong><span
                                                    class="amount red">{{ $currencySymbol }} @convertCurrency($order->beforecoupon)</span></strong>
                                        </td>
                                    </tr>

                                </tfoot>
                            </table>


                            <div class="col-md-12">
                                <div class="product-content-right">
                                    <div class="card-body table-responsive p-0">
                                        <div class="d-flex flex-column justify-content-between">
                                            <table cellspacing="0" class="shop_table cart">
                                                <thead>
                                                    <tr>
                                                        <th class="product-name">{{ trans('messages.address') }}</th>
                                                        <th class="product-price">{{ trans('messages.statecountry') }}
                                                        </th>
                                                        <th class="product-quantity">{{ trans('messages.country') }}
                                                        </th>
                                                        <th class="product-quantity">{{ trans('messages.towncity') }}
                                                        </th>
                                                        <th class="product-quantity">{{ trans('messages.companyname') }}
                                                        </th>
                                                        <th class="product-subtotal">{{ trans('messages.postcode') }}
                                                        </th>
                                                        <th class="product-subtotal">{{ trans('messages.apartment') }}
                                                        </th>
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


                            <form action="{{ route('bankpay') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex flex-column">
                                    <p>{{ trans('messages.bill') }}: </p>
                                    <input class="form-control" type="file" id="formFile" accept="image/*"
                                        style="max-width:100%" onchange="previewImage(event)" name="image" required>
                                </div>
                                <input type="hidden" value="{{ request()->input('idorder') }}" name="idorder">
                                <input type="hidden" value="{{ $order->beforecoupon }}" name="amount">
                                <img id="preview" src="" alt="" style="height:300px">
                                <div class="d-flex flex-column mb-2">
                                    <p>{{ trans('messages.noteorder') }}: </p>
                                    <textarea name="" id="" cols="30" rows="5" name="note"></textarea>
                                </div>
                                <input type="submit" data-value="Place order" value="{{ trans('messages.submit') }}"
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
function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function() {
        preview.src = reader.result;
    }
    reader.readAsDataURL(file);
}
</script>

@endsection