@extends('admin.layouts.Adminlayout')

@section('title', 'Admin Change Password')
<!-- Content Wrapper. Contains page content -->
@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thay đổi mật khẩu</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-12 d-flex justify-content-between p-3">


                <div class="col-12 card card-primary">
                    <!-- <div class="card-header">
                        <h3 class="card-title">Mật khẩu tài khoản</h3>
                    </div> -->
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Mật khẩu hiện tại</label>
                                <input type="password" name="passold" class="form-control" id="passold" value=""
                                    autocomplete="off" required>
                            </div>
                            @error('passold')
                            <div class="input-group">
                                <p style="color:red">{{ $message }}</p>
                            </div>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mật khẩu mới</label>
                                <input type="password" name="passnew" class="form-control" id="passnew" value=""
                                    autocomplete="off" required>
                            </div>
                            @error('passnew')
                            <div class="input-group">
                                <p style="color:red">{{ $message }}</p>
                            </div>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nhập lại mật khẩu mới</label>
                                <input type="password" name="passconfirm" class="form-control" id="passconfirm" value=""
                                    autocomplete="off" required>
                            </div>
                            @error('passcon')
                            <div class="input-group">
                                <p style="color:red">{{ $message }}</p>
                            </div>
                            @enderror
                            @error('suc')
                            <div class="input-group">
                                <p style="color:red">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="submitBtn">Thiết lập mật khẩu mới</button>
                        </div>
                        <!-- /.card -->
                    </form>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
</div>
@endsection

@section('popup')
<!-- Modal trả lời đơn tư vấn -->



@endsection


@section('js')


@endsection