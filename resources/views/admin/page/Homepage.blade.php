@extends('admin.layouts.Adminlayout')

@section('title', 'Trang chủ Admin')

@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Trang điều hành</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex">
                        <h3 class="card-title">Doanh thu năm  đ</h3>
                        <h3 class="card-title">Doanh thu tháng  đ</h3>
                    </div>
                    <div class="position-relative mb-4 p-4">
                        <canvas id="thongkedauvao-chart" height="500"></canvas>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    
    <!-- /.content -->
</div>

@endsection

@section('js')


@endsection