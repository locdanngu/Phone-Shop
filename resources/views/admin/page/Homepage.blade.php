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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $countorder }}</h3>

                            <p>Đơn hàng mới</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('listorder.page') }}" class="small-box-footer">Thông tin <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $cproduct }}</h3>
                            <!-- <sup style="font-size: 20px">%</sup> -->
                            <p>Sản phẩm</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('listproduct.page') }}" class="small-box-footer">Thông tin <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $cuser }}</h3>

                            <p>Người dùng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('listuser.page') }}" class="small-box-footer">Thông tin <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $ccategory }}</h3>

                            <p>Danh mục</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('listcategory.page') }}" class="small-box-footer">Thông tin <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </section>


    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex">
                        <h3 class="card-title">Doanh thu năm: $</h3>
                        <h3 class="card-title">Doanh thu tháng: $</h3>
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