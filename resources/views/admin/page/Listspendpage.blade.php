@extends('admin.layouts.Adminlayout')

@section('title', 'Danh sách chi tiêu')
<!-- Content Wrapper. Contains page content -->
@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quản lý chi tiêu</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modal-add"><i
                        class="bi bi-plus-circle-fill"></i> Thêm 1 chi tiêu mới</button>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">Tổng cộng : {{ $sum }} $</h3>
                        <div class="card-tools">
                            <form action="{{ route('spend.search') }}" method="get"
                                class="input-group input-group-sm m-0">
                                <div class="d-flex justify-content-center">
                                    {!! Form::selectYear('year', date('Y'), date('Y') - 50, request('year', null),
                                    ['placeholder' => '-----', 'name' => 'year']) !!}
                                    {!! Form::selectMonth('month', request('month', null), ['placeholder' => '-----',
                                    'name' => 'month']) !!}
                                    {!! Form::selectRange('day', 1, 31, request('day', null), ['placeholder' => '-----',
                                    'name' => 'day']) !!}
                                </div>
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
                                        <th>Ngày</th>
                                        <th>Số tiền</th>
                                        <th>Lý do</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($spend as $sp)
                                    <tr>
                                        <td class="font-weight-bold">{{ $sp->created_at }}</td>
                                        <td class="font-weight-bold" style="color:red">{{ $sp->money }} $</td>
                                        <td>{{ $sp->reason }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-change" data-id="{{ $sp->idspend }}"
                                                data-reason="{{ $sp->reason }}" data-money="{{ $sp->money }}">
                                                <i class="bi bi-pencil"></i>
                                                Sửa
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
<div class="modal fade" id="modal-change">
    <div class="modal-dialog">
        <form action="{{ route('spend.change') }}" method="post" class="modal-content">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Thông tin chi tiêu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="idspend">
            <div class="modal-body" id="in4order">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Lý do</span>
                    <textarea type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="reason"
                        style="height:8em"></textarea>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Số tiền($)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" name="money" id="pricevnd">
                </div>

            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-success">Chỉnh sửa</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('spend.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tạo 1 chi tiêu mới</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Lý do</span>
                    <textarea type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="reason"
                        style="height:8em"></textarea>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Số tiền($)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" name="money" id="pricevnd">
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


@endsection


@section('js')
<script>
$(document).ready(function() {
    $('#modal-change').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var money = button.data('money');
        var reason = button.data('reason');
        var modal = $(this);
        modal.find('input[name="idspend"]').val(id);
        modal.find('input[name="money"]').val(money);
        modal.find('textarea[name="reason"]').val(reason);
    });
});
</script>

@endsection