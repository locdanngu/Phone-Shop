@extends('admin.layouts.Adminlayout')

@section('title', 'Danh sách loại hàng')
<!-- Content Wrapper. Contains page content -->
@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quản lý loại hàng</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modal-add"><i
                        class="bi bi-plus-circle-fill"></i> Thêm 1 loại mới</button>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tổng cộng : {{ $counttype }} loại</h3>
                        <div class="card-tools" style="width: 45%;">
                            <form action="{{ route('searchtype') }}" method="get"
                                class="input-group input-group-sm">
                                <input type="text" name="searchtype" class="form-control float-right"
                                    placeholder="Tìm kiếm" value="{{ request('searchtype')}}">
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
                                        <th>Tên loại</th>
                                        <th class="text-center">Số sản phẩm</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($type as $row)
                                    <tr>
                                        <td class="font-weight-bold" style="color:red">{{ $row->nametype }}</td>
                                        </td>
                                        <td class="text-center font-weight-bold"><a
                                                href="{{ route('searchproduct', ['searchproduct' => $row->nametype]) }}">{{ $row->product_count }}</a>
                                        </td>
                                        <td>
                                            <button class="btn btn-success btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-change" data-id="{{ $row->idtype }}"
                                                data-name="{{ $row->nametype }}">
                                                <i class="bi bi-pencil"></i>
                                                Sửa
                                            </button>
                                            @if($row->product_count== 0)
                                            <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-delete" data-id="{{ $row->idtype }}"
                                                data-name="{{ $row->nametype }}"
                                                data-count="{{ $row->product_count }}">
                                                <i class="bi bi-trash"></i> Xóa
                                            </button>
                                            @else
                                            <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-delete-cant" data-id="{{ $row->idtype }}"
                                                data-name="{{ $row->nametype }}" data-count="{{ $row->product_count }}">
                                                <i class="bi bi-trash"></i> Xóa
                                            </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $type->appends(['searchtype' => request('searchtype')])->links() }}
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
        <form class="modal-content" action="{{ route('type.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tạo loại hàng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên loại hàng</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="nametype">
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
        <form class="modal-content" action="{{ route('type.change') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa loại hàng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="idtype">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên loại hàng</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="nametype">
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
        <form class="modal-content" action="{{ route('type.delete') }}" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Xóa 1 loại hàng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="idtype">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên loại hàng</span>
                    <span name="nametype" class="spanpopup"></span>
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
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Xóa 1 loại hàng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="idtype">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên loại hàng</span>
                    <span name="nametype" class="spanpopup"></span>
                </div>
            </div>
            <p class="font-weight-bold ml-3" style="color:red">Bạn không thể xóa loại hàng nếu có nhiều sản phẩm thuộc loại hàng đó</p>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-danger" disabled>Xóa</button>
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
    $('#modal-change').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var name = button.data('name');
        var modal = $(this);
        modal.find('input[name="nametype"]').val(name);
        modal.find('input[name="idtype"]').val(id);
    });

    $('#modal-delete').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var name = button.data('name');
        var modal = $(this);
        modal.find('span[name="nametype"]').text(name);
        modal.find('input[name="idtype"]').val(id);
    });

    $('#modal-delete-cant').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var name = button.data('name');
        var modal = $(this);
        modal.find('span[name="nametype"]').text(name);
        modal.find('input[name="idtype"]').val(id);
    });
});
</script>

@endsection