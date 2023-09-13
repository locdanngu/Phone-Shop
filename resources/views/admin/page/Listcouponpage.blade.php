@extends('admin.layouts.Adminlayout')

@section('title', 'Danh sách mã giảm giá')
<!-- Content Wrapper. Contains page content -->
@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quản lý mã giảm giá</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modal-add"><i
                        class="bi bi-plus-circle-fill"></i> Thêm 1 mã giảm giá</button>
            </div>
            <div class="col-12 d-flex justify-content-center mb-2">

            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tổng cộng : mã</h3>
                        <div class="card-tools" style="width: 45%;">
                            <form action="{{ route('searchcategory') }}" method="get"
                                class="input-group input-group-sm">
                                <input type="text" name="searchcategory" class="form-control float-right"
                                    placeholder="Tìm kiếm" value="{{ request('searchcategory')}}">
                            </form>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 65vh;">
                        <div class="d-flex flex-column justify-content-between" style="height: 95%;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Mã giảm giá</th>
                                        <th class="text-center">Áp dụng</th>
                                        <!-- <th class="text-center">Người dùng</th>
                                        <th class="text-center">Sản phẩm</th>
                                        <th class="text-center">Danh mục</th> -->
                                        <th class="text-center">Kiểu</th>
                                        <th>Bắt đầu</th>
                                        <th>Hết hạn</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coupon as $row)
                                    <tr>
                                        <td class="font-weight-bold" style="color: red">{{ $row->code }}</td>
                                        @if($row->applicable_to == 'cart')
                                        <td class="text-center">Đơn hàng</td>
                                        @else
                                        <td class="text-center">Sản phẩm</td>
                                        @endif
                                        <!-- @if($row->id_user)
                                        <td class="text-center font-weight-bold">{{ $row->id_user }}</td>
                                        @else   
                                        <td class="text-center font-weight-bold">Tất cả</td>  
                                        @endif
                                        @if($row->product_list = 1)
                                        <td class="text-center">Danh sách</td>
                                        @else   
                                        <td class="text-center">Tất cả</td>  
                                        @endif
                                        @if($row->category_list = 1)
                                        <td class="text-center">Danh sách</td>
                                        @else   
                                        <td class="text-center">Tất cả</td>  
                                        @endif -->
                                        @if($row->discount_type = 'percentage')
                                        <td class="text-center">Phần trăm</td>
                                        @else
                                        <td class="text-center">Mức tiền</td>
                                        @endif
                                        <td>{{ $row->starttime }}</td>
                                        <td>{{ $row->endtime }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-in4">
                                                <i class="bi bi-info-lg"></i>
                                                Thông tin
                                            </button>
                                            <button class="btn btn-primary btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-change">
                                                <i class="bi bi-pencil"></i>
                                                Sửa
                                            </button>
                                            <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-delete">
                                                <i class="bi bi-trash"></i> Xóa
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

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
        <form class="modal-content" action="{{ route('category.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tạo mã giảm giá</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mã giảm giá</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="code">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Áp dụng cho</span>
                    <div class="d-flex align-items-center">
                        <label class="label">
                            <input type="radio" name="applicable_to" value="product">
                            Sản phẩm
                        </label>
                        <label class="label">
                            <input type="radio" name="applicable_to" value="cart">
                            Đơn hàng
                        </label>
                    </div>
                </div>
                <div class="input-group mb-3 d-flex justify-content-between fixmobileuser">
                    <div class="w-50 d-flex fixmobileuser2">
                        <span class="input-group-text" id="inputGroup-sizing-default"
                            style="width: 30% !important;">Người dùng</span>
                        <div class="d-flex align-items-center">
                            <label class="label">
                                <input type="radio" name="iduser" value="product" id="user-radio">
                                Cá nhân
                            </label>
                            <label class="label">
                                <input type="radio" name="iduser" value="cart">
                                Tất cả
                            </label>
                        </div>
                    </div>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="in4user"
                        placeholder="Nhập Id, username, email hoặc số điện thoại" style="width: 50%;" id="user-input">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Sản phẩm</span>
                    <div class="d-flex align-items-center">
                        <label class="label">
                            <input type="radio" name="product_list" value="product">
                            Danh sách
                        </label>
                        <label class="label">
                            <input type="radio" name="product_list" value="cart">
                            Tất cả
                        </label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Danh mục</span>
                    <div class="d-flex align-items-center">
                        <label class="label">
                            <input type="radio" name="category_list" value="product">
                            Danh sách
                        </label>
                        <label class="label">
                            <input type="radio" name="category_list" value="cart">
                            Tất cả
                        </label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Loại giảm</span>
                    <div class="d-flex align-items-center">
                        <label class="label">
                            <input type="radio" name="discount_type" value="product">
                            Phần trăm
                        </label>
                        <label class="label">
                            <input type="radio" name="discount_type" value="cart">
                            Mức tiền
                        </label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Y/c tối thiểu</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="minimum_order_amount">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tối đa giảm</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="max_discount_amount">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Số tiền giảm</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="discount_amount">
                </div>
                <div class="input-group mb-3" style="width: 100% !important;">
                    <div class="w-50">
                        <span class="input-group-text" id="inputGroup-sizing-default"
                            style="width: 100% !important;">Ngày bắt đầu</span>
                        <input type="datetime-local" name="starttime" style="width: 100%">
                    </div>
                    <div class="w-50">
                        <span class="input-group-text" id="inputGroup-sizing-default"
                            style="width: 100% !important;">Ngày kết thúc</span>
                        <input type="datetime-local" name="endtime" style="width: 100%">
                    </div>
                </div>
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
        <form class="modal-content" action="{{ route('category.change') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa hãng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="idcategory">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên hãng</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="namecategory">
                </div>
                <div class="w-100 d-flex">
                    <div class="w-100 mb-3 d-flex flex-column align-items-center">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width:100% !important">Logo
                            hiện tại</span>
                        <img src="" alt="" style="height:100px;width: fit-content;margin-top: 2.5em" class="imageblog1">
                    </div>
                    <div class="w-100 mb-3 d-flex flex-column align-items-center">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width:100% !important">Logo
                            mới</span>
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
        <form class="modal-content" action="{{ route('category.delete') }}" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Xóa 1 hãng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="idcategory">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên hãng</span>
                    <span name="namecategory" class="spanpopup"></span>
                </div>
                <div class="input-group mb-3 d-flex align-items-center">
                    <span class="input-group-text" id="inputGroup-sizing-default">Ảnh nền</span>
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
$(document).ready(function() {
    $('#modal-change').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var name = button.data('name');
        var image = button.data('image');
        var modal = $(this);
        modal.find('input[name="namecategory"]').val(name);
        modal.find('input[name="idcategory"]').val(id);
        modal.find('img.imageblog1').attr('src', image);
    });

    $('#modal-delete').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var name = button.data('name');
        var image = button.data('image');
        var modal = $(this);
        modal.find('span[name="namecategory"]').text(name);
        modal.find('input[name="idcategory"]').val(id);
        modal.find('img.imageblog2').attr('src', image);
    });
    $("#user-input").hide();

    $("input[name='iduser']").change(function() {
        if ($(this).val() === "product") {
            // Nếu radio button "Cá nhân" được chọn, hiển thị ô input
            $("#user-input").show();
        } else {
            // Nếu radio button khác được chọn, ẩn ô input
            $("#user-input").hide();
        }
    });
});
</script>

@endsection