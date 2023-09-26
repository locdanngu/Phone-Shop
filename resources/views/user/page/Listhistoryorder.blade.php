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
        <div class="row">

            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="card-body table-responsive p-0">
                        <div class="d-flex flex-column justify-content-between">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">{{ trans('messages.idorder') }}</th>
                                        <th class="product-name">{{ trans('messages.total') }}</th>
                                        <th class="product-price">{{ trans('messages.date') }}</th>
                                        <th class="product-price">{{ trans('messages.status') }}</th>
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
                                            <span
                                                class="amount font-weight-bold red">{{ $currencySymbol }} {{ number_format($o->beforecoupon, 2) }}</span>
                                        </td>
                                        <td>
                                            <span class="amount">{{ $o->created_at }}</span>
                                        </td>
                                        @if($o->status == 'wait' || $o->status == 'paypal')
                                        <td>
                                            <span class="amount" style="color:brown">{{ trans('messages.wait') }}</span>
                                        </td>
                                        @elseif($o->status == 'cancel')
                                        <td>
                                            <span class="amount" style="color:red">{{ trans('messages.deny') }}</span>
                                        </td>
                                        @elseif($o->status == 'done')
                                        <td>
                                            <span class="amount"
                                                style="color:green">{{ trans('messages.success') }}</span>
                                        </td>
                                        @elseif($o->status == 'ship')
                                        <td>
                                            <span class="amount"
                                                style="color:green">{{ trans('messages.delivery') }}</span>
                                        </td>
                                        @endif
                                        <td class="actions" style="display: flex;justify-content:center">
                                            <a href="{{ route('historyorder.page', ['idorder' => $o->idorder]) }}"
                                                class="btnchangeuser"><i class="bi bi-eye-fill"></i>
                                                {{ trans('messages.watch') }}</a>
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