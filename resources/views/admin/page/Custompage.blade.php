@extends('admin.layouts.Adminlayout')

@section('title', 'Phân quyền nhân viên')
<!-- Content Wrapper. Contains page content -->
@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Phân quyền nhân viên</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tổng cộng : {{ $countstaff }} nhân viên</h3>
                        <div class="card-tools" style="width: 45%;">
                            <form action="{{ route('staff.search') }}" method="get" class="input-group input-group-sm">
                                <input type="text" name="searchstaff" class="form-control float-right"
                                    placeholder="Tìm kiếm" value="{{ request('searchstaff')}}">
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
                                        <th>Tài khoản</th>
                                        <th>Họ tên</th>
                                        <th class="text-center">Quản lý sản phẩm</th>
                                        <th class="text-center">Mã giảm giá</th>
                                        <th class="text-center">Người dùng</th>
                                        <th class="text-center">Đơn hàng</th>
                                        <th class="text-center">Doanh thu</th>
                                        <th>CSKH</th>
                                        <th>Quyền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($staff as $u)
                                    <tr>
                                        <td class="font-weight-bold">{{ $u->adminname }}</td>
                                        <td>{{ $u->name }}</td>
                                        <td class="text-center">
                                            @if($u->product == 1)
                                            <i class="bi bi-check2"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($u->coupon == 1)
                                            <i class="bi bi-check2"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($u->user == 1)
                                            <i class="bi bi-check2"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($u->order == 1)
                                            <i class="bi bi-check2"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($u->revenue == 1)
                                            <i class="bi bi-check2"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($u->contact == 1)
                                            <i class="bi bi-check2"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-change" data-id="{{ $u->idadmin }}"
                                                data-name="{{ $u->adminname }}" data-product="{{ $u->product }}"
                                                data-coupon="{{ $u->coupon }}" data-user="{{ $u->user }}"
                                                data-order="{{ $u->order }}" data-revenue="{{ $u->revenue }}"
                                                data-contact="{{ $u->contact }}">
                                                <i class="bi bi-wrench"></i> Quyền hạn
                                            </button>
                                            <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-lock" data-id="{{ $u->idadmin }}"
                                                data-name="{{ $u->adminname }}">
                                                <i class="bi bi-trash"></i>Xóa tài khoản
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $staff->links() }}
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
<div class="modal fade" id="modal-change">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('staffphanquyen') }}" method="post" id="formchangepass">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa quyền hạn</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="iduser">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên tài khoản</span>
                    <span name="username" class="spanpopup font-weight-bold" style="color:red"></span>
                </div>
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>Quyền hạn</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Quản lý sản phẩm, danh mục, loại hàng</td>
                            <td>
                                <input type="checkbox" name="product" id="" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td>Quản lý mã giảm giá</td>
                            <td>
                                <input type="checkbox" name="coupon" id="" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td>Quản lý tài khoản người dùng</td>
                            <td>
                                <input type="checkbox" name="user" id="" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td>Quản lý đơn hàng</td>
                            <td>
                                <input type="checkbox" name="order" id="" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td>Quản lý doanh thu</td>
                            <td>
                                <input type="checkbox" name="revenue" id="" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td>Liên hệ khách hàng</td>
                            <td>
                                <input type="checkbox" name="contact" id="" value="1">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-lock">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('staff.delete') }}" method="post" id="formchangepass">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Xóa tài khoản nhân viên</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="iduser">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên tài khoản</span>
                    <span name="username" class="spanpopup font-weight-bold" style="color:red"></span>
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
        var product = button.data('product');
        var coupon = button.data('coupon');
        var user = button.data('user');
        var order = button.data('order');
        var revenue = button.data('revenue');
        var contact = button.data('contact');
        var modal = $(this);
        modal.find('input[name="iduser"]').val(id);
        modal.find('span[name="username"]').text(name);
        if (product == 1) {
            modal.find('input[name="product"]').prop('checked', true);
        } else {
            modal.find('input[name="product"]').prop('checked', false);
        }

        if (coupon == 1) {
            modal.find('input[name="coupon"]').prop('checked', true);
        } else {
            modal.find('input[name="coupon"]').prop('checked', false);
        }

        if (user == 1) {
            modal.find('input[name="user"]').prop('checked', true);
        } else {
            modal.find('input[name="user"]').prop('checked', false);
        }

        if (order == 1) {
            modal.find('input[name="order"]').prop('checked', true);
        } else {
            modal.find('input[name="order"]').prop('checked', false);
        }

        if (revenue == 1) {
            modal.find('input[name="revenue"]').prop('checked', true);
        } else {
            modal.find('input[name="revenue"]').prop('checked', false);
        }

        if (contact == 1) {
            modal.find('input[name="contact"]').prop('checked', true);
        } else {
            modal.find('input[name="contact"]').prop('checked', false);
        }
    });

    $('#modal-lock').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var name = button.data('name');
        var status = button.data('status');
        var modal = $(this);
        modal.find('input[name="iduser"]').val(id);
        modal.find('span[name="username"]').text(name);
        modal.find('select[name="status"] option[value="' + status + '"]').prop('selected', true);
    });


});
</script>

@endsection