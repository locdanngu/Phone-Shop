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
                        <a href="{{ route('listorder.page') }}" class="small-box-footer">Thông tin <i
                                class="bi bi-arrow-right"></i></a>
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
                        <a href="{{ route('listproduct.page') }}" class="small-box-footer">Thông tin <i
                                class="bi bi-arrow-right"></i></a>
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
                        <a href="{{ route('listuser.page') }}" class="small-box-footer">Thông tin <i
                                class="bi bi-arrow-right"></i></a>
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
                        <a href="{{ route('listcategory.page') }}" class="small-box-footer">Thông tin <i
                                class="bi bi-arrow-right"></i></a>
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
                        <h3 class="card-title">Doanh thu năm: {{ $doanhthuyear }} $</h3>
                        <h3 class="card-title">Doanh thu tháng: {{ $doanhthumonth }} $</h3>
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
    <div class="container-fluid">


        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thu nhập năm nay({{$currentYear }})
                        </h6>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tất cả sản phẩm({{$cproduct}})</h6>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div>
                            <canvas id="myChart2"></canvas>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
$(function() {
    'use strict'

    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true

    var donTuvanCounts = <?php echo $dauvaoTotal; ?>;
    var $thongkedonChart = $('#thongkedauvao-chart')
    // eslint-disable-next-line no-unused-vars
    var thongkedonChart = new Chart($thongkedonChart, {
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                'September', 'October', 'November', 'December'
            ],
            datasets: [{
                type: 'line',
                data: donTuvanCounts,

                backgroundColor: 'transparent',
                borderColor: '#007bff',
                pointBorderColor: '#007bff',
                pointBackgroundColor: '#007bff',
                fill: false
                // pointHoverBackgroundColor: '#007bff',
                // pointHoverBorderColor    : '#007bff'
            }, ]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    // display: false,
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,
                        suggestedMax: 200
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
    })
})

const ctx = document.getElementById('myChart');
const ctx2 = document.getElementById('myChart2');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'April', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
            'Dec'
        ],
        datasets: [{
            label: 'Đầu vào của năm nay',
            data: <?php echo $dauvaoTotal; ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',
                'rgba(255, 159, 64, 0.7)',
                'rgba(255, 205, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 102, 86, 0.7)',
                'rgba(255, 205, 86, 0.7)',
                'rgba(255, 25, 86, 0.7)',
                'rgba(25, 5, 86, 0.7)',
                'rgba(255, 205, 90, 0.7)',
                'rgba(201, 203, 207, 0.7)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)',
                'rgb(153, 102, 255)',
                'rgb(153, 102, 255)',
                'rgb(153, 102, 255)',
                'rgb(153, 102, 255)',
                'rgb(153, 102, 255)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value, index, values) {
                        return '$' + value;
                    }
                }
            }
        }
    }
});


new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: [
            <?php echo $categoryvalue; ?>
        ],
        datasets: [{
            label: 'Số sản phẩm danh mục',
            data: <?php echo $result; ?>,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(4, 1, 235)',
                'rgb(5, 162, 25)',
                'rgb(4, 12, 25)',
                'rgb(74, 15, 205)',
                'rgb(54, 62, 235)',
                'rgb(54, 162, 23)',
                'rgb(4, 162, 3)',
                'rgb(200, 50, 100)',
                'rgb(10, 120, 180)',
                'rgb(30, 150, 60)',
                'rgb(220, 40, 120)',
                'rgb(80, 180, 10)',
                'rgb(90, 50, 220)',
                'rgb(160, 70, 50)',
                'rgb(10, 80, 160)',
                'rgb(40, 160, 20)',
                'rgb(140, 70, 20)',
            ],
            hoverOffset: 4
        }]
    },

});
</script>

@endsection