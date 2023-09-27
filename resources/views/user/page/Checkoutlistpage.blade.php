@extends('user.layouts.Userlayout')

@section('title', trans('messages.checkoutbtn'))

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>{{ trans('messages.listcheckout') }}</h2>
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
                                        <th class="product-price">{{ trans('messages.coupon') }}</th>
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
                                            <span class="amount">{{ $currencySymbol }} @convertCurrency($o->beforecoupon)</span>
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
                                            <span class="amount">{{ trans('messages.none') }}</span>
                                        </td>
                                        @endif
                                        <td class="actions" style="display: flex;justify-content:center">
                                            <a href="{{ route('checkout.page', ['idorder' => $o->idorder]) }}"
                                                class="btnchangeuser"><i class="bi bi-eye-fill"></i> {{ trans('messages.watch') }}</a>
                                            <a href="#" type="button" data-toggle="modal"
                                                data-target="#modal-deleteproduct" class="btnchangeuser"
                                                data-id="{{ $o->idorder }}">
                                                <i class="bi bi-trash-fill"></i> {{ trans('messages.delete') }}</a>
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
<div class="modal fade" id="modal-deleteproduct">
    <div class="modal-dialog">
        <form action="{{ route('deletecheckout') }}" method="post" class="modal-content">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('messages.deletecheckout') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="color:red; font-weight: bold">{{ trans('messages.thisaction') }}</h3>
                <input type="hidden" name="idorder">
                <span name="idorder"></span>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="submit" class="btn btn-danger">{{ trans('messages.delete') }}</button>
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
    var modal = $(this);
    modal.find('span[name="idorder"]').text('{{ trans('messages.idorder') }}: ' + id);
    modal.find('input[name="idorder"]').val(id);
});
</script>

@endsection