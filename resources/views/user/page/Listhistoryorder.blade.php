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
        <div class="row">

            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="card-body table-responsive p-0">
                        <div class="d-flex flex-column justify-content-between">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Id order</th>
                                        <th class="product-name">Total price</th>
                                        <th class="product-price">Date</th>
                                        <th class="product-price">Coupon</th>
                                        <th class="product-quantity">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $o)
                                    <tr>
                                        <td>
                                            <span class="amount">{{ $o->idorder }}</span>
                                        </td>
                                        <td>
                                            <span class="amount">${{ $o->totalprice }}</span>
                                        </td>
                                        <td>
                                            <span class="amount">{{ $o->created_at }}</span>
                                        </td>
                                        @if($o->idcoupon)
                                        <td>
                                            <span class="amount">{{ $o->coupon->code }}</span>
                                        </td>
                                        @else
                                        <td>
                                            <span class="amount">None</span>
                                        </td>
                                        @endif
                                        <td class="actions" style="display: flex;justify-content:center">
                                            <a href="{{ route('checkout.page', ['idorder' => $o->idorder]) }}"
                                                class="btnchangeuser"><i class="bi bi-eye-fill"></i> Watch</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
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


@endsection