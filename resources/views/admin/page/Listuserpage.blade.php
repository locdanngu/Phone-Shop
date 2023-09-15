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
                                        <td>{{ $u->username }}</td>
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
                                            <button class="btn btn-warning btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-delete-cant">
                                                <i class="bi bi-wrench"></i> Thao tác
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
<!-- Modal trả lời đơn tư vấn -->
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('category.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tạo danh mục</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên danh mục</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="namecategory">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Logo</span>
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
        <form class="modal-content" action="{{ route('category.change') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa danh mục</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="idcategory">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên danh mục</span>
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
                <button type="submit" class="btn btn-success">Hoàn tất</button>
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
                <h4 class="modal-title">Xóa 1 danh mục</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="idcategory">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên danh mục</span>
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

<div class="modal fade" id="modal-delete-cant">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('category.delete') }}" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Xóa 1 danh mục</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="idcategory">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên danh mục</span>
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

    $('#modal-delete-cant').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var name = button.data('name');
        var image = button.data('image');
        var modal = $(this);
        modal.find('span[name="namecategory"]').text(name);
        modal.find('input[name="idcategory"]').val(id);
        modal.find('img.imageblog2').attr('src', image);
    });
});
</script>

@endsection