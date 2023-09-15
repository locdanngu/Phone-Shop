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
<div class="modal fade" id="modal-in4">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thông tin đơn</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="in4order">


            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
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
    $('#modal-in4').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var modal = $(this);

        $.ajax({
            url: '{{ route("order.in4") }}',
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                code: 1,
                id,
            },
            success: function(response) {
                var html = response.html;
                modal.find("#in4order").html(html);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        modal.find('input[name="idorder"]').val(id);
    });
});
</script>

@endsection