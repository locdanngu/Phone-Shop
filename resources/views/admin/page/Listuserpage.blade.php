@extends('admin.layouts.Adminlayout')

@section('title', 'Danh sách người dùng')
<!-- Content Wrapper. Contains page content -->
@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quản lý danh mục</h1>
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
                        <h3 class="card-title">Tổng cộng : {{ $countuser }} người dùng</h3>
                        <div class="card-tools" style="width: 45%;">
                            <form action="{{ route('searchuser') }}" method="get" class="input-group input-group-sm">
                                <input type="text" name="searchuser" class="form-control float-right"
                                    placeholder="Tìm kiếm" value="{{ request('searchuser')}}">
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
                                        <th>Id</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Họ tên</th>
                                        <th>Quốc gia</th>
                                        <th>Địa chỉ</th>
                                        <th>Thành phố</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user as $u)
                                    <tr>
                                        <td class="font-weight-bold" style="color:red">{{ $u->iduser }}</td>
                                        <td class="font-weight-bold">{{ $u->username }}</td>
                                        <td>{{ $u->firstname }} {{ $u->lastname }}</td>
                                        <td>{{ $u->country }}</td>
                                        <td>{{ $u->address }}</td>
                                        <td>{{ $u->town_city }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->phone }}</td>
                                        @if($u->status == 'ok')
                                        <td class="font-weight-bold" style="color: green">Hoạt động</td>
                                        @else
                                        <td class="font-weight-bold" style="color: red">Khóa</td>
                                        @endif
                                        <td>
                                            <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-change" data-id="{{ $u->iduser }}"
                                                data-name="{{ $u->username }}">
                                                <i class="bi bi-wrench"></i> Đổi mật khẩu
                                            </button>
                                            <button class="btn btn-warning btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-lock" data-id="{{ $u->iduser }}"
                                                data-name="{{ $u->username }}"
                                                data-status="{{ $u->status }}">
                                                <i class="bi bi-lock-fill"></i> Thao tác
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $user->links() }}
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
        <form class="modal-content" action="{{ route('user.changepass') }}" method="post" id="formchangepass">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Đổi mật khẩu người dùng</h4>
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
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mật khẩu mới</span>
                    <input type="password" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="password" autocomplete="off"
                        id="pass">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Nhập lại mật khẩu</span>
                    <input type="password" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="repassword" autocomplete="off"
                        id="repass">
                </div>

            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-success">Đổi mật khẩu</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-lock">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('user.changestatus') }}" method="post" id="formchangepass">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Đổi trạng thái user</h4>
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
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mật khẩu mới</span>
                    <select name="status" id="" class="ml-3">
                        <option value="lock">Khóa</option>
                        <option value="ok">Bình thường</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-success">Thay đổi</button>
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
        var modal = $(this);
        modal.find('input[name="iduser"]').val(id);
        modal.find('span[name="username"]').text(name);

        $("#formchangepass").submit(function(event) {
            if (modal.find('input[name="password"]').val() != modal.find(
                    'input[name="repassword"]').val()) {
                event.preventDefault();
                toastr.error(
                    '<b>Mật khẩu nhập lại không khớp</b>'
                )
            }
        });
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