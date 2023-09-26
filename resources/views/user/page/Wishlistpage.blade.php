@extends('user.layouts.Userlayout')

@section('title', 'Wish list')

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>{{ trans('messages.wishlistbtn') }}</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            @include('user.layouts.Leftbar')


            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">
                        @if(count($listwish) != 0)
                        <form method="post" action="#">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">{{ trans('messages.product') }}</th>
                                        <th class="product-price">{{ trans('messages.price') }}</th>
                                        <th class="product-quantity">{{ trans('messages.categorypage') }}</th>
                                        <th class="product-quantity">{{ trans('messages.add') }}</th>
                                        <th class="product-remove">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody id="capnhatdanhsachcart">
                                    @foreach($listwish as $l)
                                    <tr class="cart_item" data-product-id="{{ $l->idwishlist }}">
                                        <td class="product-remove">
                                            <a title="Remove this item" class="remove" href="#" type="button"
                                                data-toggle="modal" data-target="#modal-deleteproduct"
                                                data-id="{{ $l->idwishlist }}"
                                                data-name="{{ $l->product->nameproduct }}">×</a>
                                        </td>

                                        <td class="product-thumbnail">
                                            <a
                                                href="{{ route('product.page', ['nameproduct' => $l->product->nameproduct]) }}"><img
                                                    width="145" height="145" alt="poster_1_up" class="shop_thumbnail"
                                                    src="{{ $l->product->imageproduct }}"></a>
                                        </td>

                                        <td class="product-name">
                                            <a
                                                href="{{ route('product.page', ['nameproduct' => $l->product->nameproduct]) }}">{{ $l->product->nameproduct }}</a>
                                        </td>

                                        <td class="product-price">
                                            <span class="amount">${{ $l->product->price }}</span>
                                        </td>

                                        <td class="product-quantity">
                                            <a
                                                href="{{ route('shop.page', ['searchproduct' => $l->product->category->namecategory]) }}">{{ $l->product->category->namecategory }}</a>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="amount">{{ $l->created_at }}</span>
                                        </td>
                                        <td class="product-subtotal">
                                            <a class="add_to_cart_button them-sp-vao-gio" href="#"
                                                data-idproduct="{{ $l->idproduct }}"><i
                                                    class="bi bi-cart-plus-fill"></i></a>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </form>


                        <div class="cart-collaterals">
                            <div class="cross-sells">
                                <h2>{{ trans('messages.youmaybe') }}...</h2>
                                <ul class="products">
                                    @foreach($random as $rd)
                                    <li class="product">
                                        <a href="{{ route('product.page', ['nameproduct' => $rd->nameproduct]) }}">
                                            <img alt="T_4_front" class="attachment-shop_catalog wp-post-image"
                                                src="{{ $rd->imageproduct }}">
                                            <h3 class="fixheight2">{{ $rd->nameproduct }}</h3>
                                            <span class="price"><span class="amount">${{ $rd->price }}</span></span>
                                        </a>

                                        <a class="add_to_cart_button" rel="nofollow"
                                            href="{{ route('product.page', ['nameproduct' => $rd->nameproduct]) }}">{{ trans('messages.seedetail') }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @else
                        <div class="box">
                            <h2>{{ trans('messages.wishlistempty') }}! <a href="{{ route('shop.page') }}">{{ trans('messages.gotoshopnow') }}</a></h2>
                            <i class="bi bi-emoji-frown-fill"></i>
                        </div>

                        @endif
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
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="color:red; font-weight: bold">Delete this product?</h3>
                <span name="nameproduct"></span>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-danger" id="deleteproduct">Delete</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


@endsection

@section('js')
<script>
var globalId;

$('#modal-deleteproduct').on('shown.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Nút "Change" được nhấn
    var id = button.data('id');
    var name = button.data('name');
    var modal = $(this);
    globalId = id;
    modal.find('span[name="nameproduct"]').text(name);
});

$('#deleteproduct').on('click', function(event) {
    var id = globalId;
    $.ajax({
        type: 'POST',
        url: "{{ route('deleteproductwishlist') }}",
        data: {
            _token: '{{ csrf_token() }}',
            id: id,
        },
        success: function(response) {
            // Xóa phần tử HTML của sản phẩm khỏi danh sách
            $('#capnhatdanhsachcart tr[data-product-id="' + id + '"]').remove();
            toastr.success('Delete product successful.');
            $('#modal-deleteproduct').modal('hide');
        }
    });
});
</script>
@endsection