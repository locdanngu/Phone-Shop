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
                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal"
                    data-target="#modal-add-brief"><i class="bi bi-plus-circle-fill"></i> Thêm 1 sản phẩm mới</button>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tổng cộng :  Sản phẩm</h3>
                        <div class="card-tools" style="width: 45%;">
                            <div class="input-group input-group-sm">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Tìm kiếm" id="search">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 65vh;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá cũ</th>
                                    <th>Giá mới($)</th>
                                    <th>Giá mới(VND)</th>
                                    <th>Mô tả sản phẩm</th>
                                    <th>Hãng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td style="color:red;font-weight:800"></td>
                                    <td><img src="" alt="" height="50"></td>
                                    <td></td>
                                    <td class="font-weight-bold" style="color:red"> $</td>
                                    <td class="font-weight-bold" style="color:red"> đ</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" type="button" data-toggle="modal"
                                            data-target="#modal-change-brief">
                                            <i class="bi bi-pencil"></i>
                                            Sửa
                                        </button>
                                        <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                            data-target="#modal-delete-brief">
                                            <i class="bi bi-trash"></i> Xóa
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
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
<div class="modal fade" id="modal-add-brief">
    <div class="modal-dialog">
        <form class="modal-content" action="" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tạo dịch vụ brief</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên brief</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="name">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Nội dung brief</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="content">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tiêu đề brief</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="title">
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


<div class="modal fade" id="modal-change-brief">
    <div class="modal-dialog">
        <form class="modal-content" action="" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa brief</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="id">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên brief</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="name">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Nội dung brief</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="content">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tiêu đề brief</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="title">
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


<div class="modal fade" id="modal-delete-brief">
    <div class="modal-dialog">
        <form class="modal-content" action="" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Xóa dịch vụ brief</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="id">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên brief</span>
                    <span name="name" class="spanpopup"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Nội dung brief</span>
                    <span name="content" class="spanpopup"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tiêu đề brief</span>
                    <span name="title" class="spanpopup"></span>
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
    $('#modal-change-brief').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var name = button.data('name');
        var content = button.data('content');
        var title = button.data('title');
        var modal = $(this);
        modal.find('input[name="name"]').val(name);
        modal.find('input[name="id"]').val(id);
        modal.find('input[name="content"]').val(content);
        modal.find('input[name="title"]').val(title);
    });

    $('#modal-delete-brief').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var name = button.data('name');
        var content = button.data('content');
        var title = button.data('title');
        var modal = $(this);
        modal.find('span[name="name"]').text(name);
        modal.find('input[name="id"]').val(id);
        modal.find('span[name="content"]').text(content);
        modal.find('span[name="title"]').text(title);
    });


    
});
</script>

@endsection