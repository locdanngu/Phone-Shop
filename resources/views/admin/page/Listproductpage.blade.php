@extends('admin.layouts.Adminlayout')

@section('title', 'Danh sách sản phẩm')
<!-- Content Wrapper. Contains page content -->
@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quản lý sản phẩm</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modal-add"><i
                        class="bi bi-plus-circle-fill"></i> Thêm 1 sản phẩm mới</button>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tổng cộng : {{ $countproduct }} Sản phẩm</h3>
                        <div class="card-tools" style="width: 45%;">
                            <form action="{{ route('searchproduct') }}" method="get" class="input-group input-group-sm">
                                <input type="text" name="searchproduct" class="form-control float-right"
                                    placeholder="Tìm kiếm" value="{{ request('searchproduct')}}">
                                <button class="btn-success" type="submit">Tìm</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 65vh;">
                        <div class="d-flex flex-column justify-content-between" style="height: 95%;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th class="text-center">Sản phẩm</th>
                                        <th class="text-center">Giá cũ($)</th>
                                        <th class="text-center">Giá mới($)</th>
                                        <th class="text-center">Giá mới(VND)</th>
                                        <th>Mô tả sản phẩm</th>
                                        <th class="text-center">Hãng</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product as $row)
                                    <tr>
                                        <td class="font-weight-bold" style="color:red">{{ $row->nameproduct }}</td>
                                        <td class="text-center"><img src="{{ $row->imageproduct }}" alt="" height="50">
                                        </td>
                                        <td class="text-center">{{ $row->oldprice }} $</td>
                                        <td class="font-weight-bold text-center" style="color:red">{{ $row->price }} $
                                        </td>
                                        <td class="font-weight-bold text-center" style="color:red">
                                            {{ number_format($row->price * 23000, 0, ',', '.') }} đ</td>
                                        @if(strlen($row->detail) > 30)
                                        <td>{!! mb_substr(strip_tags($row->detail), 0, 30) !!}...</td>
                                        @else
                                        <td>{{ $row->detail }}</td>
                                        @endif
                                        <td class="font-weight-bold text-center"><a
                                                href="{{ route('searchcategory', ['searchcategory' => $row->category->namecategory]) }}">{{ $row->category->namecategory }}</a>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-change" data-id="{{ $row->idproduct }}"
                                                data-name="{{ $row->nameproduct }}" data-old="{{ $row->oldprice }}"
                                                data-new="{{ $row->price }}" data-detail="{{ $row->detail }}"
                                                data-cate="{{ $row->idcategory }}"
                                                data-image="{{ $row->imageproduct }}">
                                                <i class="bi bi-pencil"></i>
                                                Sửa
                                            </button>
                                            <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-delete" data-id="{{ $row->idproduct }}"
                                                data-id2="{{ $row->idcategory }}" data-name="{{ $row->nameproduct }}"
                                                data-old="{{ $row->oldprice }}" data-new="{{ $row->price }}"
                                                data-detail="{{ $row->detail }}"
                                                data-cate="{{ $row->category->namecategory }}"
                                                data-image="{{ $row->imageproduct }}">
                                                <i class="bi bi-trash"></i> Xóa
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $product->links() }}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection

@section('popup')
<!-- Modal trả lời đơn tư vấn -->
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('product.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tạo thêm sản phẩm mới</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên sản phẩm</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="nameproduct">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Giá cũ($)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="oldprice">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Giá mới($)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="price">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 100% !important;">Mô
                        tả</span>

                    <textarea type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="detail"
                        style="height:8em"></textarea>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default"
                        style="width: 100% !important;">Hãng</span>
                    <select style="width: 100%;padding-left:1em;height:2.5em" name="idcategory">
                        @foreach($category as $ca)
                        <option value="{{ $ca->idcategory }}" style="height:2.5em">{{ $loop->iteration }}.
                            {{ $ca->namecategory }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Ảnh sản phẩm</span>
                    <input class="form-control" type="file" id="formFile" accept="image/*" style="max-width:100%"
                        onchange="previewImage(event)" name="image" required>
                </div>
                <img id="preview" src="" alt="" style="height:100px">
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Lưu thông tin</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-change">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('product.change') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="idproduct">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên sản phẩm</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="nameproduct">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Giá cũ($)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="oldprice">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Giá mới($)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="price">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 100% !important;">Mô
                        tả</span>
                    <textarea type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="detail"
                        style="height:8em"></textarea>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default"
                        style="width: 100% !important;">Hãng</span>
                    <select style="width: 100%;padding-left:1em;height:2.5em" name="idcategory">
                        @foreach($category as $ca)
                        <option value="{{ $ca->idcategory }}" style="height:2.5em">{{ $loop->iteration }}.
                            {{ $ca->namecategory }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-100 d-flex">
                    <div class="w-100 mb-3 d-flex flex-column align-items-center">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width:100% !important">Ảnh
                            hiện tại</span>
                        <img src="" alt="" style="height:100px;width: fit-content;margin-top: 2.5em" class="imageblog1">
                    </div>
                    <div class="w-100 mb-3 d-flex flex-column align-items-center">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width:100% !important">Ảnh
                            sản phẩm mới</span>
                        <input class="form-control" type="file" id="formFile" accept="image/*" style="max-width:100%"
                            onchange="previewImage2(event)" name="image">
                        <img id="preview2" src="" alt="" style="height:100px">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Hoàn tất</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('product.delete') }}" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Xóa 1 sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="idproduct">
            <input type="hidden" name="idcategory">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên sản phẩm</span>
                    <span name="nameproduct" class="spanpopup font-weight-bold" style="color:red"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Giá cũ($)</span>
                    <span name="oldprice" class="spanpopup"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Giá mới($)</span>
                    <span name="price" class="spanpopup font-weight-bold" style="color:red"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mô tả</span>
                    <span name="detail" class="spanpopup"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Hãng</span>
                    <span name="namecategory" class="spanpopup font-weight-bold"></span>
                </div>
                <div class="input-group mb-3 d-flex align-items-center">
                    <span class="input-group-text" id="inputGroup-sizing-default">Ảnh sản phẩm</span>
                    <img src="" alt="" style="height:100px;margin-left:1em" class="imageblog2">
                </div>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-danger">Xóa</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
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

function previewImage2(event) {
    const preview = document.getElementById('preview2');
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function() {
        preview.src = reader.result;
    }
    reader.readAsDataURL(file);
}


$(document).ready(function() {
    $('#modal-change').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var name = button.data('name');
        var oldprice = button.data('old');
        var price = button.data('new');
        var detail = button.data('detail');
        var category = button.data('cate');
        var image = button.data('image');
        var modal = $(this);
        modal.find('input[name="nameproduct"]').val(name);
        modal.find('input[name="idproduct"]').val(id);
        modal.find('input[name="oldprice"]').val(oldprice);
        modal.find('input[name="price"]').val(price);
        modal.find('textarea[name="detail"]').val(detail);
        // modal.find('input[name="namecategory"]').val(category);
        modal.find('select[name="idcategory"] option[value="' + category + '"]').prop('selected', true);
        modal.find('img.imageblog1').attr('src', image);
    });

    $('#modal-delete').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var id2 = button.data('id2');
        var name = button.data('name');
        var oldprice = button.data('old');
        var price = button.data('new');
        var detail = button.data('detail');
        var category = button.data('cate');
        var image = button.data('image');
        var modal = $(this);
        modal.find('span[name="nameproduct"]').text(name);
        modal.find('input[name="idproduct"]').val(id);
        modal.find('input[name="idcategory"]').val(id2);
        modal.find('span[name="oldprice"]').text(oldprice);
        modal.find('span[name="price"]').text(price);
        modal.find('span[name="detail"]').text(detail);
        modal.find('span[name="namecategory"]').text(category);
        modal.find('img.imageblog2').attr('src', image);
    });



});
</script>

@endsection