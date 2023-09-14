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
                        <h3 class="card-title">Tổng cộng : {{ $countcoupon }} mã</h3>
                        <div class="card-tools" style="width: 45%;">
                            <form action="{{ route('searchcoupon') }}" method="get" class="input-group input-group-sm">
                                <input type="text" name="searchcoupon" class="form-control float-right"
                                    placeholder="Tìm kiếm" value="{{ request('searchcoupon')}}">
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
                                        <th class="text-center">Người dùng</th>
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
                                        @if($row->iduser)
                                        <td class="text-center font-weight-bold">{{ $row->user->email }}</td>
                                        @else
                                        <td class="text-center font-weight-bold">Tất cả</td>
                                        @endif
                                        @if($row->discount_type = 'percentage')
                                        <td class="text-center">Phần trăm(%)</td>
                                        @else
                                        <td class="text-center">Số tiền($)</td>
                                        @endif
                                        <td>{{ $row->starttime }}</td>
                                        <td>{{ $row->endtime }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-in4" data-id="{{ $row->idcoupon }}"
                                                data-start="{{ $row->starttime }}" data-end="{{ $row->endtime }}"
                                                data-appli="{{ $row->applicable_to }}" data-iduser="{{ $row->iduser }}"
                                                data-pro="{{ $row->product_list }}"
                                                data-cate="{{ $row->category_list }}"
                                                data-dis="{{ $row->discount_type }}"
                                                data-mini="{{ $row->minimum_order_amount }}"
                                                data-max="{{ $row->max_discount_amount }}"
                                                data-amo="{{ $row->discount_amount }}" data-used="{{ $row->used }}"
                                                data-code="{{ $row->code }}">
                                                <i class="bi bi-info-lg"></i>
                                                Thông tin
                                            </button>
                                            <button class="btn btn-success btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-change" data-id="{{ $row->idcoupon }}"
                                                data-start="{{ $row->starttime }}" data-end="{{ $row->endtime }}"
                                                data-appli="{{ $row->applicable_to }}" data-iduser="{{ $row->iduser }}"
                                                data-pro="{{ $row->product_list }}"
                                                data-cate="{{ $row->category_list }}"
                                                data-dis="{{ $row->discount_type }}"
                                                data-user="{{ isset($row->user->username) ? $row->user->username : '' }}"
                                                data-mini="{{ $row->minimum_order_amount }}"
                                                data-max="{{ $row->max_discount_amount }}"
                                                data-amo="{{ $row->discount_amount }}" data-used="{{ $row->used }}"
                                                data-code="{{ $row->code }}">
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
        <form class="modal-content" action="{{ route('coupon.add') }}" method="post" enctype="multipart/form-data"
            id="coupon-form">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tạo mã giảm giá</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="sendiduser" id="sendiduser">
            <input type="hidden" name="listproduct" id="listproduct">
            <input type="hidden" name="listcate" id="listcate">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mã giảm giá</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="code" id="code-input">
                </div>
                <p class="font-weight-bold checkcode" style="color:red">Mã đã tồn tại! Vui lòng nhập mã khác</p>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Áp dụng cho</span>
                    <div class="d-flex align-items-center">
                        <label class="label">
                            <input type="radio" name="applicable_to" value="product" required id="productcoupon">
                            Sản phẩm
                        </label>
                        <label class="label">
                            <input type="radio" name="applicable_to" value="cart" required>
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
                                <input type="radio" name="iduser" value="product" id="user-radio" required>
                                Cá nhân
                            </label>
                            <label class="label">
                                <input type="radio" name="iduser" value="cart" required>
                                Tất cả
                            </label>
                        </div>
                    </div>
                    <div class="d-flex checkuser align-items-center">
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default"
                            placeholder="Nhập Id, username, email hoặc số điện thoại" style="width: 90%;"
                            id="user-input">
                        <i class="bi bi-x-circle-fill ml-3" id="not" style="color:red"></i>
                        <i class="bi bi-check-circle-fill ml-3" id="yes" style="color: #007bff"></i>
                    </div>

                </div>
                <div class="input-group mb-3 d-flex justify-content-between fixmobileuser productorcate">
                    <div class="w-50 d-flex fixmobileuser2">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width: 30% !important;">Sản
                            phẩm</span>
                        <div class="d-flex align-items-center">
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="1" id="product-radio"
                                    class="requiredcheck">
                                Danh sách
                            </label>
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="2" class="requiredcheck">
                                Tất cả
                            </label>
                        </div>
                    </div>
                    <p class="btn btn-secondary" id="product-input" type="button" data-toggle="modal"
                        data-target="#modal-addproduct">Chưa chọn sản phẩm nào</p>
                </div>
                <div class="input-group mb-3 d-flex justify-content-between fixmobileuser productorcate">
                    <div class="w-50 d-flex fixmobileuser2">
                        <span class="input-group-text" id="inputGroup-sizing-default"
                            style="width: 30% !important;">Danh mục</span>
                        <div class="d-flex align-items-center">
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="3" id="cate-radio"
                                    class="requiredcheck">
                                Danh sách
                            </label>
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="4" class="requiredcheck">
                                Tất cả
                            </label>
                        </div>
                    </div>
                    <p class="btn btn-secondary" id="cate-input" type="button" data-toggle="modal"
                        data-target="#modal-addcate">Chưa chọn mục nào</p>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Loại giảm</span>
                    <div class="d-flex align-items-center">
                        <label class="label">
                            <input type="radio" name="discount_type" value="percentage" required>
                            Phần trăm
                        </label>
                        <label class="label">
                            <input type="radio" name="discount_type" value="amount" required>
                            Số tiền
                        </label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Y/c tối thiểu($)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="minimum_order_amount">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tối đa giảm($)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="max_discount_amount">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mức giảm(%/$)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="discount_amount">
                </div>
                <div class="input-group mb-3" style="width: 100% !important;">
                    <div class="w-50">
                        <span class="input-group-text" id="inputGroup-sizing-default"
                            style="width: 100% !important;">Ngày bắt đầu</span>
                        <input type="datetime-local" name="starttime" style="width: 100%" required>
                    </div>
                    <div class="w-50">
                        <span class="input-group-text" id="inputGroup-sizing-default"
                            style="width: 100% !important;">Ngày kết thúc</span>
                        <input type="datetime-local" name="endtime" style="width: 100%" required>
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
                <h4 class="modal-title">Chỉnh sửa mã giảm giá</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="sendiduser" id="sendiduser">
            <input type="text" name="listproduct" id="listproduct">
            <input type="text" name="listcate" id="listcate">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mã giảm giá</span>
                    <input type="text" class="form-control" disabled aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" name="code">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Áp dụng cho</span>
                    <div class="d-flex align-items-center">
                        <label class="label">
                            <input type="radio" name="applicable_to" value="product" required id="productcoupon">
                            Sản phẩm
                        </label>
                        <label class="label">
                            <input type="radio" name="applicable_to" value="cart" required>
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
                                <input type="radio" name="iduser" value="1" id="user-radio2" required>
                                Cá nhân
                            </label>
                            <label class="label">
                                <input type="radio" name="iduser" value="0" required>
                                Tất cả
                            </label>
                        </div>
                    </div>
                    <div class="d-flex checkuser align-items-center">
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default"
                            placeholder="Nhập Id, username, email hoặc số điện thoại" style="width: 90%;"
                            id="user-input2" name="finduser">
                        <i class="bi bi-x-circle-fill ml-3" id="not2" style="color:red"></i>
                        <i class="bi bi-check-circle-fill ml-3" id="yes2" style="color: #007bff"></i>
                    </div>

                </div>
                <div class="input-group mb-3 d-flex justify-content-between fixmobileuser productorcate">
                    <div class="w-50 d-flex fixmobileuser2">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width: 30% !important;">Sản
                            phẩm</span>
                        <div class="d-flex align-items-center">
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="1" id="product-radio"
                                    class="requiredcheck">
                                Danh sách
                            </label>
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="2" class="requiredcheck">
                                Tất cả
                            </label>
                        </div>
                    </div>
                    <p class="btn btn-secondary" id="product-input" type="button" data-toggle="modal"
                        data-target="#modal-addproduct">Chưa chọn sản phẩm nào</p>
                </div>
                <div class="input-group mb-3 d-flex justify-content-between fixmobileuser productorcate">
                    <div class="w-50 d-flex fixmobileuser2">
                        <span class="input-group-text" id="inputGroup-sizing-default"
                            style="width: 30% !important;">Danh mục</span>
                        <div class="d-flex align-items-center">
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="3" id="cate-radio"
                                    class="requiredcheck">
                                Danh sách
                            </label>
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="4" class="requiredcheck">
                                Tất cả
                            </label>
                        </div>
                    </div>
                    <p class="btn btn-secondary" id="cate-input" type="button" data-toggle="modal"
                        data-target="#modal-addcate">Chưa chọn mục nào</p>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Loại giảm</span>
                    <div class="d-flex align-items-center">
                        <label class="label">
                            <input type="radio" name="discount_type" value="percentage" required>
                            Phần trăm
                        </label>
                        <label class="label">
                            <input type="radio" name="discount_type" value="amount" required>
                            Số tiền
                        </label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Y/c tối thiểu($)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="minimum_order_amount">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tối đa giảm($)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="max_discount_amount">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mức giảm(%/$)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="discount_amount">
                </div>
                <div class="input-group mb-3" style="width: 100% !important;">
                    <div class="w-50">
                        <span class="input-group-text" id="inputGroup-sizing-default"
                            style="width: 100% !important;">Ngày bắt đầu</span>
                        <input type="datetime-local" name="starttime" style="width: 100%" required>
                    </div>
                    <div class="w-50">
                        <span class="input-group-text" id="inputGroup-sizing-default"
                            style="width: 100% !important;">Ngày kết thúc</span>
                        <input type="datetime-local" name="endtime" style="width: 100%" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-success">Lưu thay đổi</button>
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


<div class="modal fade" id="modal-in4">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thông tin mã giảm giá</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mã giảm giá</span>
                    <span name="code" class="spanpopup font-weight-bold" style="color:red"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Áp dụng</span>
                    <span name="applicable_to" class="spanpopup"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Người dùng</span>
                    <span name="iduser" class="spanpopup"></span>
                </div>
                <div class="input-group mb-3 hidein4">
                    <span class="input-group-text" id="inputGroup-sizing-default">Sản phẩm</span>
                    <span name="product_list" class="spanpopup"></span>
                    <button class="btn btn-secondary ml-3" id="in4listpro">Danh sách sản phẩm</button>
                </div>
                <div class="input-group mb-3 hidein4">
                    <span class="input-group-text" id="inputGroup-sizing-default">Danh mục</span>
                    <span name="category_list" class="spanpopup"></span>
                    <button class="btn btn-secondary ml-3" id="in4listcate">Danh sách danh mục</button>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Loại giảm giá</span>
                    <span name="discount_type" class="spanpopup"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Yêu cầu</span>
                    <span name="minimum_order_amount" class="spanpopup font-weight-bold" style="color:red"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tối đa</span>
                    <span name="max_discount_amount" class="spanpopup font-weight-bold" style="color:red"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mức giảm</span>
                    <span name="discount_amount" class="spanpopup font-weight-bold" style="color:red"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Đã sử dụng</span>
                    <span name="used" class="spanpopup"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Ngày bắt đầu</span>
                    <span name="starttime" class="spanpopup font-weight-bold"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Ngày kết thúc</span>
                    <span name="endtime" class="spanpopup font-weight-bold"></span>
                </div>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-addcate" data-backdrop="static" data-keyboard="false">
    <!-- Không đóng popup khi nhấn bên ngoài -->
    <div class="modal-dialog">
        <div class="modal-content" action="" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Chọn danh sách danh mục</h4>
            </div>
            <div class="modal-body fixgrid">
                @foreach($category as $ca)
                <label for="" class="d-flex flex-column align-items-center">
                    <img src="{{ $ca->imagecategory }}" alt="" height="50" style="width:fit-content">
                    {{ $ca->namecategory }}
                    <input type="checkbox" name="listcate" value="{{ $ca->idcategory }}" class="listcate-checkbox">
                </label>
                @endforeach
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="submit" class="btn btn-success" id="listcatebtn">Đồng ý</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-addproduct" data-backdrop="static" data-keyboard="false">
    <!-- Không đóng popup khi nhấn bên ngoài -->
    <div class="modal-dialog">
        <div class="modal-content" action="" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Chọn danh sách sản phẩm</h4>
            </div>
            <div class="modal-body">
                <div class="card-body table-responsive p-0" style="height: 65vh;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th class="text-center">Sản phẩm</th>
                                <th>Giá</th>
                                <th>Hãng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $pr)
                            <tr>
                                <td class="font-weight-bold" style="color:red">{{ $pr->nameproduct }}</td>
                                <td class="text-center"><img src="{{ $pr->imageproduct }} " alt="" height="50"></td>
                                <td class="font-weight-bold" style="color:red">{{ $pr->price }} $</td>
                                <td class="font-weight-bold">{{ $pr->category->namecategory }}</td>
                                <td><input type="checkbox" name="listproduct" value="{{ $pr->idproduct }}"
                                        class="listproduct-checkbox"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="submit" class="btn btn-success" id="listproductbtn">Đồng ý</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection


@section('js')
<script>
$(document).ready(function() {
    $('#modal-in4').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var code = button.data('code');
        var start = button.data('start');
        var end = button.data('end');
        var app = button.data('appli');
        if (app == 'cart') {
            app = 'Đơn hàng';
        } else {
            app = 'Sản phẩm';
        }
        var iduser = button.data('iduser');
        if (iduser == '') {
            iduser = 'Tất cả';
        }
        var pro = button.data('pro');
        var cate = button.data('cate');
        var dis = button.data('dis');
        if (dis == 'percentage') {
            dis = 'Theo phần trăm';
        } else {
            dis = 'Theo mức tiền';
        }
        var mini = button.data('mini');
        var max = button.data('max');
        var amo = button.data('amo');
        var used = button.data('used');
        var modal = $(this);
        modal.find('span[name="code"]').text(code);
        modal.find('span[name="starttime"]').text(start);
        modal.find('span[name="endtime"]').text(end);
        modal.find('span[name="applicable_to"]').text(app);
        modal.find('span[name="iduser"]').text(iduser);
        if (pro == 1) {
            modal.find('span[name="product_list"]').hide();
            modal.find('#in4listpro').attr('data-idcoupon', id);
            modal.find('#in4listpro').show();
            $(".hidein4").removeClass("hideproduct");
        } else {
            modal.find('#in4listpro').hide();
            $(".hidein4").addClass("hideproduct");
            modal.find('span[name="product_list"]').text('Tất cả sản phẩm');
            modal.find('span[name="product_list"]').show();
        }
        if (cate == 1) {
            modal.find('span[name="category_list"]').hide();
            modal.find('#in4listcate').attr('data-idcoupon', id);
            modal.find('#in4listcate').show();
            $(".hidein4").removeClass("hideproduct");
        } else {
            modal.find('#in4listcate').hide();
            $(".hidein4").addClass("hideproduct");
            modal.find('span[name="category_list"]').text('Tất cả sản phẩm');
            modal.find('span[name="category_list"]').show();
        }
        modal.find('span[name="discount_type"]').text(dis);
        modal.find('span[name="minimum_order_amount"]').text(mini + ' $');
        modal.find('span[name="max_discount_amount"]').text(max + ' $');
        if (dis == 'Theo phần trăm') {
            modal.find('span[name="discount_amount"]').text(amo + ' %');
        } else {
            modal.find('span[name="discount_amount"]').text(amo + ' $');

        }
        modal.find('span[name="used"]').text(used + ' lần');

    });


    $('#modal-change').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var code = button.data('code');
        var start = button.data('start');
        var end = button.data('end');
        var app = button.data('appli');
        var iduser = button.data('iduser');
        var user = button.data('user');
        var pro = button.data('pro');
        var cate = button.data('cate');
        var dis = button.data('dis');
        var mini = button.data('mini');
        var max = button.data('max');
        var amo = button.data('amo');
        var used = button.data('used');
        var modal = $(this);
        modal.find('input[name="code"]').val(code);
        modal.find('input[name="finduser"]').val(user);
        modal.find('input[name="sendiduser"]').val(iduser);
        modal.find('input[name="applicable_to"][value="' + app + '"]').prop('checked', true);
        if (iduser) {
            modal.find('input[name="iduser"][value="1"]').prop('checked', true);
            $("#user-input2").show();
        } else {
            modal.find('input[name="iduser"][value="0"]').prop('checked', true);
            $("#user-input2").hide();
        }
        modal.find('input[name="discount_type"][value="' + dis + '"]').prop('checked', true);
        modal.find('input[name="minimum_order_amount"]').val(mini);
        modal.find('input[name="max_discount_amount"]').val(max);
        modal.find('input[name="discount_amount"]').val(amo);
        modal.find('input[name="starttime"]').val(start);
        modal.find('input[name="endtime"]').val(end);
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

    $("#user-input, #user-input2, #cate-input, #product-input, #not, #yes, #not2, #yes2").hide();

    $(".productorcate").addClass("hideproduct");

    $("input[name='applicable_to']").change(function() {
        if ($(this).val() === "product") {
            // Nếu radio button "Cá nhân" được chọn, hiển thị ô input
            $(".productorcate").removeClass("hideproduct");
            $(".requiredcheck").removeAttr("required");
        } else {
            $(".productorcate").addClass("hideproduct");
            $(".requiredcheck").addAttr("required");
        }
    });

    $("input[name='iduser']").change(function() {
        if ($(this).val() === "product") {
            // Nếu radio button "Cá nhân" được chọn, hiển thị ô input
            $("#user-input").show();
        } else {
            // Nếu radio button khác được chọn, ẩn ô input
            $("#user-input").hide();
        }
    });

    $("input[name='product_list_or_cate_list']").change(function() {
        if ($(this).val() === "1") {
            $("#product-input").show();
            $("#cate-input").hide();
        } else if ($(this).val() === "3") {
            $("#product-input").hide();
            $("#cate-input").show();
        } else {
            $("#product-input").hide();
            $("#cate-input").hide();
        }
    });

    $("#cate-input").click(function() {
        $("#modal-add").modal('hide');
    });

    $("#product-input").click(function() {
        $("#modal-add").modal('hide');
    });

    $("#modal-addcate, #modal-addproduct").on('hidden.bs.modal', function() {
        $("#modal-add").modal('show');
        $(".sidebar-mini").addClass("modal-open");
    });

    //lấy danh sách danh mục(nếu có)
    $("#listcatebtn").click(function() {
        // Tạo một mảng để lưu giá trị của các checkbox đã chọn
        var selectedValues = [];

        // Lặp qua tất cả các checkbox đã chọn và thêm giá trị vào mảng
        $(".listcate-checkbox:checked").each(function() {
            selectedValues.push($(this).val());
        });

        // Cập nhật giá trị của trường input ẩn
        $("#listcate").val(selectedValues.join(","));

        var selectedCount = selectedValues.length;

        // Thay đổi nội dung thẻ <p> "Chọn danh sách"
        if (selectedCount > 0) {
            $("#cate-input").text("Đã chọn " + selectedCount + " mục");
        } else {
            $("#cate-input").text("Chưa chọn mục nào");
        }

        $("#modal-add").modal('show');
        $("#modal-addcate").modal('hide');
    });

    //lấy danh sách sản phẩm(nếu có)
    $("#listproductbtn").click(function() {
        // Tạo một mảng để lưu giá trị của các checkbox đã chọn
        var selectedValues = [];

        // Lặp qua tất cả các checkbox đã chọn và thêm giá trị vào mảng
        $(".listproduct-checkbox:checked").each(function() {
            selectedValues.push($(this).val());
        });

        // Cập nhật giá trị của trường input ẩn
        $("#listproduct").val(selectedValues.join(","));

        var selectedCount = selectedValues.length;

        // Thay đổi nội dung thẻ <p> "Chọn danh sách"
        if (selectedCount > 0) {
            $("#product-input").text("Đã chọn " + selectedCount + " sản phẩm");
        } else {
            $("#product-input").text("Chưa chọn sản phẩm nào");
        }

        $("#modal-add").modal('show');
        $("#modal-addproduct").modal('hide');
    });

    //kiểm tra người dùng
    $("#user-input").on("input", function() {
        var inputValue = $(this).val();

        if (inputValue.trim() !== "") {
            $.ajax({
                url: '{{ route("user.search") }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    searchuser: inputValue
                },
                success: function(response) {
                    var re = response.re;
                    var iduser = response.iduser;
                    $("#sendiduser").val(response.iduser);
                    if (re == 'yes') {
                        $("#yes").show();
                        $("#not").hide();

                    } else {
                        $("#not").show();
                        $("#yes").hide();
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        } else {
            $("#yes").hide();
            $("#not").hide();
        }
    });

    $("#user-input2").on("input", function() {
        var inputValue = $(this).val();

        if (inputValue.trim() !== "") {
            $.ajax({
                url: '{{ route("user.search") }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    searchuser: inputValue
                },
                success: function(response) {
                    var re = response.re;
                    var iduser = response.iduser;
                    $("#sendiduser").val(response.iduser);
                    if (re == 'yes') {
                        $("#yes2").show();
                        $("#not2").hide();

                    } else {
                        $("#not2").show();
                        $("#yes2").hide();
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        } else {
            $("#yes2, #not2").hide();
        }
    });

    $("#coupon-form").submit(function(event) {
        // Thực hiện kiểm tra điều kiện của bạn ở đây
        if ($("#user-radio").is(":checked") && $("#sendiduser").val() == "") {
            // Điều kiện không đáp ứng, ngăn gửi biểu mẫu
            event.preventDefault();
            toastr.error(
                '<b>Vui lòng nhập đúng thông tin người dùng</b>'
            )
        }

        if ($("#product-radio").is(":checked") && $("#listproduct").val() == "") {
            event.preventDefault();
            toastr.error(
                '<b>Vui lòng chọn ít nhất 1 sản phẩm</b>'
            )
        }

        if ($("#cate-radio").is(":checked") && $("#listcate").val() == "") {
            event.preventDefault();
            toastr.error(
                '<b>Vui lòng chọn ít nhất 1 danh mục</b>'
            )
        }
        var startDatetime = new Date($("input[name='starttime']").val());
        var endDatetime = new Date($("input[name='endtime']").val());
        var currentDate = new Date();

        if (endDatetime <= startDatetime) {
            event.preventDefault();
            toastr.error(
                '<b>Ngày kết thúc không được sớm hơn ngày bắt đầu</b>'
            )
        }

        if (endDatetime <= currentDate) {
            event.preventDefault();
            toastr.error(
                '<b>Ngày kết thúc không được sớm hơn thời gian hiện tại</b>'
            )
        }

    });

    $("#code-input").on("input", function() {
        var inputValue = $(this).val();

        if (inputValue.trim() !== "") {
            if (inputValue.length < 6) {
                $(".checkcode").text("Mã phải chứa ít nhất 6 kí tự");
                $(".checkcode").show();
            } else {
                $.ajax({
                    url: '{{ route("code.check") }}',
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        searchcode: inputValue
                    },
                    success: function(response) {
                        var re = response.re;
                        if (re == 'yes') {
                            $(".checkcode").text("Mã có thể sử dụng");
                            $(".checkcode").show();
                        } else {
                            $(".checkcode").text("Mã đã tồn tại! Vui lòng nhập mã khác");
                            $(".checkcode").show();
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }

        } else {
            $(".checkcode").hide();
        }
    });


    $('#modal-change').on('hidden.bs.modal', function () {
        $("#yes2, #not2").hide();
    });
});
</script>

@endsection