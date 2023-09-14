@extends('admin.layouts.Adminlayout')

@section('title', 'Danh sách mã giảm giá')
<!-- Content Wrapper. Contains page content -->
@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quản lý mã giảm giá</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modal-add"><i
                        class="bi bi-plus-circle-fill"></i> Thêm 1 mã giảm giá</button>
            </div>
            <div class="col-12 d-flex justify-content-center mb-2">

            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tổng cộng : {{ $countcoupon }} mã</h3>
                        <div class="card-tools" style="width: 45%;">
                            <form action="{{ route('searchcoupon') }}" method="get" class="input-group input-group-sm">
                                <input type="text" name="searchcoupon" class="form-control float-right"
                                    placeholder="Tìm kiếm" value="{{ request('searchcoupon')}}">
                            </form>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 65vh;">
                        <div class="d-flex flex-column justify-content-between" style="height: 95%;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Mã giảm giá</th>
                                        <th class="text-center">Áp dụng</th>
                                        <th class="text-center">Người dùng</th>
                                        <th class="text-center">Kiểu</th>
                                        <th>Bắt đầu</th>
                                        <th>Hết hạn</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coupon as $row)
                                    <tr>
                                        <td class="font-weight-bold" style="color: red">{{ $row->code }}</td>
                                        @if($row->applicable_to == 'cart')
                                        <td class="text-center">Đơn hàng</td>
                                        @else
                                        <td class="text-center">Sản phẩm</td>
                                        @endif
                                        @if($row->iduser)
                                        <td class="text-center font-weight-bold">{{ $row->user->email }}</td>
                                        @else
                                        <td class="text-center font-weight-bold">Tất cả</td>
                                        @endif
                                        @if($row->discount_type = 'percentage')
                                        <td class="text-center">Phần trăm(%)</td>
                                        @else
                                        <td class="text-center">Số tiền($)</td>
                                        @endif
                                        <td>{{ $row->starttime }}</td>
                                        <td>{{ $row->endtime }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-in4" data-id="{{ $row->idcoupon }}"
                                                data-start="{{ $row->starttime }}" data-end="{{ $row->endtime }}"
                                                data-appli="{{ $row->applicable_to }}" data-iduser="{{ $row->iduser }}"
                                                data-pro="{{ $row->product_list }}"
                                                data-cate="{{ $row->category_list }}"
                                                data-dis="{{ $row->discount_type }}"
                                                data-mini="{{ $row->minimum_order_amount }}"
                                                data-max="{{ $row->max_discount_amount }}"
                                                data-amo="{{ $row->discount_amount }}" data-used="{{ $row->used }}"
                                                data-code="{{ $row->code }}">
                                                <i class="bi bi-info-lg"></i>
                                                Thông tin
                                            </button>
                                            <button class="btn btn-success btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-change" data-id="{{ $row->idcoupon }}"
                                                data-start="{{ $row->starttime }}" data-end="{{ $row->endtime }}"
                                                data-appli="{{ $row->applicable_to }}" data-iduser="{{ $row->iduser }}"
                                                data-pro="{{ $row->product_list }}"
                                                data-cate="{{ $row->category_list }}"
                                                data-dis="{{ $row->discount_type }}"
                                                data-user="{{ isset($row->user->username) ? $row->user->username : '' }}"
                                                data-mini="{{ $row->minimum_order_amount }}"
                                                data-max="{{ $row->max_discount_amount }}"
                                                data-amo="{{ $row->discount_amount }}" data-used="{{ $row->used }}"
                                                data-code="{{ $row->code }}">
                                                <i class="bi bi-pencil"></i>
                                                Sửa
                                            </button>
                                            <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                data-target="#modal-delete" data-id="{{ $row->idcoupon }}"
                                                data-code="{{ $row->code }}">
                                                <i class="bi bi-trash"></i> Xóa
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $coupon->links() }}
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
@include('admin.page.layoutmodalcoupon.addcoupon')

@include('admin.page.layoutmodalcoupon.changecoupon')

@include('admin.page.layoutmodalcoupon.deletecoupon')

@include('admin.page.layoutmodalcoupon.informationcoupon')

@endsection

@section('js')
<script>
$(document).ready(function() {
    $('#modal-in4').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var code = button.data('code');
        var start = button.data('start');
        var end = button.data('end');
        var app = button.data('appli');
        if (app == 'cart') {
            app = 'Đơn hàng';
        } else {
            app = 'Sản phẩm';
        }
        var iduser = button.data('iduser');
        if (iduser == '') {
            iduser = 'Tất cả';
        }
        var pro = button.data('pro');
        var cate = button.data('cate');
        var dis = button.data('dis');
        if (dis == 'percentage') {
            dis = 'Theo phần trăm';
        } else {
            dis = 'Theo mức tiền';
        }
        var mini = button.data('mini');
        var max = button.data('max');
        var amo = button.data('amo');
        var used = button.data('used');
        var modal = $(this);
        modal.find('span[name="code"]').text(code);
        modal.find('span[name="starttime"]').text(start.split(':').slice(0, 2).join(':'));
        modal.find('span[name="endtime"]').text(end.split(':').slice(0, 2).join(':'));
        modal.find('span[name="applicable_to"]').text(app);
        modal.find('span[name="iduser"]').text(iduser);
        if (pro == 1) {
            modal.find('span[name="product_list"]').hide();
            modal.find('#in4listpro').attr('data-idcoupon', id);
            modal.find('#in4listpro').show();
            $(".hidein4").removeClass("hideproduct");
            $("#hidein4cate").addClass("hideproduct");
        } else {
            modal.find('#in4listpro').hide();
            $(".hidein4").addClass("hideproduct");
            modal.find('span[name="product_list"]').text('Tất cả sản phẩm');
            modal.find('span[name="product_list"]').show();
        }
        if (cate == 1) {
            modal.find('span[name="category_list"]').hide();
            modal.find('#in4listcate').attr('data-idcoupon', id);
            modal.find('#in4listcate').show();
            $(".hidein4").removeClass("hideproduct");
            $("#hidein4pro").addClass("hideproduct");
        } else {
            modal.find('#in4listcate').hide();
            $(".hidein4").addClass("hideproduct");
            modal.find('span[name="category_list"]').text('Tất cả sản phẩm');
            modal.find('span[name="category_list"]').show();
        }
        modal.find('span[name="discount_type"]').text(dis);
        modal.find('span[name="minimum_order_amount"]').text(mini + ' $');
        modal.find('span[name="max_discount_amount"]').text(max + ' $');
        if (dis == 'Theo phần trăm') {
            modal.find('span[name="discount_amount"]').text(amo + ' %');
        } else {
            modal.find('span[name="discount_amount"]').text(amo + ' $');

        }
        modal.find('span[name="used"]').text(used + ' lần');
    });

    $('#modal-change').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var code = button.data('code');
        var start = button.data('start');
        var end = button.data('end');
        var app = button.data('appli');
        var iduser = button.data('iduser');
        var user = button.data('user');
        var pro = button.data('pro');
        var cate = button.data('cate');
        var dis = button.data('dis');
        var mini = button.data('mini');
        var max = button.data('max');
        var amo = button.data('amo');
        var used = button.data('used');
        var modal = $(this);
        modal.find('input[name="code"]').val(code);
        modal.find('input[name="idcoupon"]').val(id);
        modal.find('input[name="finduser"]').val(user);
        modal.find('input[name="sendiduser"]').val(iduser);
        modal.find('input[name="applicable_to"][value="' + app + '"]').prop('checked', true);
        if (app == "product") {
            modal.find(".productorcate").removeClass("hideproduct");
        } else {
            modal.find(".productorcate").addClass("hideproduct");
        }
        if (iduser) {
            modal.find('input[name="iduser"][value="1"]').prop('checked', true);
            $("#user-input2").show();
        } else {
            modal.find('input[name="iduser"][value="0"]').prop('checked', true);
            $("#user-input2").hide();
        }
        modal.find('input[name="discount_type"][value="' + dis + '"]').prop('checked', true);
        modal.find('input[name="minimum_order_amount"]').val(mini);
        modal.find('input[name="max_discount_amount"]').val(max);
        modal.find('input[name="discount_amount"]').val(amo);
        modal.find('input[name="starttime"]').val(start.split(':').slice(0, 2).join(':'));
        modal.find('input[name="endtime"]').val(end.split(':').slice(0, 2).join(':'));

        if (pro == '1') {

            $.ajax({
                url: '{{ route("product.count") }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id,
                },
                success: function(response) {
                    var html = response.html;
                    var product = response.product;
                    $('#listproduct2').val(product);
                    $("#product-input2").text('Đã chọn ' + html + ' sản phẩm');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

            $("#product-input2").show();
            modal.find('#product-input2').attr('data-idcoupon', id);
            modal.find('input[name="product_list_or_cate_list"][value="1"]').prop('checked', true);
        } else {
            modal.find('input[name="product_list_or_cate_list"][value="2"]').prop('checked', true);
            $("#product-input2").hide();
        }
        if (cate == '1') {

            $.ajax({
                url: '{{ route("cate.count") }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id,
                },
                success: function(response) {
                    var html = response.html;
                    var category = response.category;
                    $('#listcate2').val(category);
                    $("#cate-input2").text('Đã chọn ' + html + ' mục');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

            $("#cate-input2").show();
            modal.find('#cate-input2').attr('data-idcoupon', id);
            modal.find('input[name="product_list_or_cate_list"][value="3"]').prop('checked', true);
        } else {
            modal.find('input[name="product_list_or_cate_list"][value="4"]').prop('checked', true);
            $("#cate-input2").hide();
        }

        $("input[name='product_list_or_cate_list']").change(function() {
            if ($(this).val() === "1") {
                $("#product-input2").show();
                $("#cate-input2").hide();
            } else if ($(this).val() === "3") {
                $("#product-input2").hide();
                $("#cate-input2").show();
            } else {
                $("#product-input2").hide();
                $("#cate-input2").hide();
            }
        });
    });

    $('#modal-delete').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Change" được nhấn
        var id = button.data('id');
        var code = button.data('code');
        var modal = $(this);
        modal.find('span[name="code"]').text(code);
        modal.find('input[name="idcoupon"]').val(id);

    });

    $("#user-input, #user-input2, #cate-input, #product-input, #not, #yes, #not2, #yes2").hide();

    $(".productorcate").addClass("hideproduct");

    $("input[name='applicable_to']").change(function() {
        if ($(this).val() === "product") {
            // Nếu radio button "Cá nhân" được chọn, hiển thị ô input
            $(".productorcate").removeClass("hideproduct");
            $(".requiredcheck").removeAttr("required");
        } else {
            $(".productorcate").addClass("hideproduct");
            $(".requiredcheck").addAttr("required");
        }
    });

    $("input[name='iduser']").change(function() {
        if ($(this).val() === "product") {
            // Nếu radio button "Cá nhân" được chọn, hiển thị ô input
            $("#user-input").show();
        } else {
            // Nếu radio button khác được chọn, ẩn ô input
            $("#user-input").hide();
        }
    });

    $("input[name='product_list_or_cate_list']").change(function() {
        if ($(this).val() === "1") {
            $("#product-input").show();
            $("#cate-input").hide();
        } else if ($(this).val() === "3") {
            $("#product-input").hide();
            $("#cate-input").show();
        } else {
            $("#product-input").hide();
            $("#cate-input").hide();
        }
    });

    $("#cate-input").click(function() {
        $("#modal-add").modal('hide');
    });

    $("#product-input").click(function() {
        $("#modal-add").modal('hide');
    });

    $("#modal-addcate, #modal-addproduct").on('hidden.bs.modal', function() {
        $("#modal-add").modal('show');
        $(".sidebar-mini").addClass("modal-open");
    });

    //lấy danh sách danh mục(nếu có)
    $("#listcatebtn").click(function() {
        // Tạo một mảng để lưu giá trị của các checkbox đã chọn
        var selectedValues = [];

        // Lặp qua tất cả các checkbox đã chọn và thêm giá trị vào mảng
        $(".listcate-checkbox:checked").each(function() {
            selectedValues.push($(this).val());
        });

        // Cập nhật giá trị của trường input ẩn
        $("#listcate").val(selectedValues.join(","));

        var selectedCount = selectedValues.length;

        // Thay đổi nội dung thẻ <p> "Chọn danh sách"
        if (selectedCount > 0) {
            $("#cate-input").text("Đã chọn " + selectedCount + " mục");
        } else {
            $("#cate-input").text("Chưa chọn mục nào");
        }

        $("#modal-add").modal('show');
        $("#modal-addcate").modal('hide');
    });

    $("#listproductbtn").click(function() {
        var selectedValues = [];

        $(".listproduct-checkbox:checked").each(function() {
            selectedValues.push($(this).val());
        });

        $("#listproduct").val(selectedValues.join(","));

        var selectedCount = selectedValues.length;

        if (selectedCount > 0) {
            $("#product-input").text("Đã chọn " + selectedCount + " sản phẩm");
        } else {
            $("#product-input").text("Chưa chọn sản phẩm nào");
        }

        $("#modal-add").modal('show');
        $("#modal-addproduct").modal('hide');
    });

    $("#cate-input2").click(function() {
        $("#modal-change").addClass('anthan');

    });

    $("#product-input2").click(function() {
        $("#modal-change").addClass('anthan');
    });

    $("#modal-addcate2, #modal-addproduct2").on('hidden.bs.modal', function() {
        $("#modal-change").removeClass('anthan');
        $(".sidebar-mini").addClass("modal-open");
    });

    $("#in4listpro").click(function() {
        $("#modal-in4").addClass('anthan');

    });

    $("#in4listcate").click(function() {
        $("#modal-in4").addClass('anthan');
    });

    $("#modal-addcate3, #modal-addproduct3").on('hidden.bs.modal', function() {
        $("#modal-in4").removeClass('anthan');
        $(".sidebar-mini").addClass("modal-open");
    });

    $("#listcatebtn2").click(function() {
        var selectedValues = [];

        $(".listcate-checkbox:checked").each(function() {
            selectedValues.push($(this).val());
        });

        $("#listcate2").val(selectedValues.join(","));

        var selectedCount = selectedValues.length;

        if (selectedCount > 0) {
            $("#cate-input2").text("Đã chọn " + selectedCount + " mục");
        } else {
            $("#cate-input2").text("Chưa chọn mục nào");
        }

        $("#modal-addcate2").modal('hide');
    });

    $("#listproductbtn2").click(function() {
        var selectedValues = [];

        $(".listproduct-checkbox:checked").each(function() {
            selectedValues.push($(this).val());
        });

        $("#listproduct2").val(selectedValues.join(","));

        var selectedCount = selectedValues.length;

        if (selectedCount > 0) {
            $("#product-input2").text("Đã chọn " + selectedCount + " sản phẩm");
        } else {
            $("#product-input2").text("Chưa chọn sản phẩm nào");
        }

        $("#modal-addproduct2").modal('hide');
    });

    //kiểm tra người dùng
    $("#user-input").on("input", function() {
        var inputValue = $(this).val();

        if (inputValue.trim() !== "") {
            $.ajax({
                url: '{{ route("user.search") }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    searchuser: inputValue
                },
                success: function(response) {
                    var re = response.re;
                    var iduser = response.iduser;
                    $("#sendiduser").val(response.iduser);
                    if (re == 'yes') {
                        $("#yes").show();
                        $("#not").hide();

                    } else {
                        $("#not").show();
                        $("#yes").hide();
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        } else {
            $("#yes").hide();
            $("#not").hide();
        }
    });

    $("#user-input2").on("input", function() {
        var inputValue = $(this).val();

        if (inputValue.trim() !== "") {
            $.ajax({
                url: '{{ route("user.search") }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    searchuser: inputValue
                },
                success: function(response) {
                    var re = response.re;
                    var iduser = response.iduser;
                    $("#sendiduser2").val(response.iduser);
                    if (re == 'yes') {
                        $("#yes2").show();
                        $("#not2").hide();

                    } else {
                        $("#not2").show();
                        $("#yes2").hide();
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        } else {
            $("#yes2, #not2").hide();
        }
    });

    $("#coupon-form").submit(function(event) {
        // Thực hiện kiểm tra điều kiện của bạn ở đây
        if ($("#user-radio").is(":checked") && $("#sendiduser").val() == "") {
            // Điều kiện không đáp ứng, ngăn gửi biểu mẫu
            event.preventDefault();
            toastr.error(
                '<b>Vui lòng nhập đúng thông tin người dùng</b>'
            )
        }

        if ($("#product-radio").is(":checked") && $("#listproduct").val() == "") {
            event.preventDefault();
            toastr.error(
                '<b>Vui lòng chọn ít nhất 1 sản phẩm</b>'
            )
        }

        if ($("#cate-radio").is(":checked") && $("#listcate").val() == "") {
            event.preventDefault();
            toastr.error(
                '<b>Vui lòng chọn ít nhất 1 danh mục</b>'
            )
        }
        var startDatetime = new Date($("input[name='starttime']").val());
        var endDatetime = new Date($("input[name='endtime']").val());
        var currentDate = new Date();

        if (endDatetime <= startDatetime) {
            event.preventDefault();
            toastr.error(
                '<b>Ngày kết thúc không được sớm hơn ngày bắt đầu</b>'
            )
        }

        if (endDatetime <= currentDate) {
            event.preventDefault();
            toastr.error(
                '<b>Ngày kết thúc không được sớm hơn thời gian hiện tại</b>'
            )
        }

    });

    $("#coupon-form2").submit(function(event) {
        // Thực hiện kiểm tra điều kiện của bạn ở đây
        if ($("#user-radio2").is(":checked") && $("#sendiduser2").val() == "") {
            // Điều kiện không đáp ứng, ngăn gửi biểu mẫu
            event.preventDefault();
            toastr.error(
                '<b>Vui lòng nhập đúng thông tin người dùng</b>'
            )
        }

        if ($("#product-radio2").is(":checked") && $("#listproduct2").val() == "") {
            event.preventDefault();
            toastr.error(
                '<b>Vui lòng chọn ít nhất 1 sản phẩm</b>'
            )
        }

        if ($("#cate-radio2").is(":checked") && $("#listcate2").val() == "") {
            event.preventDefault();
            toastr.error(
                '<b>Vui lòng chọn ít nhất 1 danh mục</b>'
            )
        }
        var startDatetime = new Date($("#changestarttime").val());
        var endDatetime = new Date($("#changeendtime").val());
        var currentDate = new Date();

        if (endDatetime <= startDatetime) {
            event.preventDefault();
            toastr.error(
                '<b>Ngày kết thúc không được sớm hơn ngày bắt đầu</b>'
            )
        }

        if (endDatetime <= currentDate) {
            event.preventDefault();
            toastr.error(
                '<b>Ngày kết thúc không được sớm hơn thời gian hiện tại</b>'
            )
        }

    });

    $("#code-input").on("input", function() {
        var inputValue = $(this).val();

        if (inputValue.trim() !== "") {
            if (inputValue.length < 6) {
                $(".checkcode").text("Mã phải chứa ít nhất 6 kí tự");
                $(".checkcode").show();
            } else {
                $.ajax({
                    url: '{{ route("code.check") }}',
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        searchcode: inputValue
                    },
                    success: function(response) {
                        var re = response.re;
                        if (re == 'yes') {
                            $(".checkcode").text("Mã có thể sử dụng");
                            $(".checkcode").show();
                        } else {
                            $(".checkcode").text("Mã đã tồn tại! Vui lòng nhập mã khác");
                            $(".checkcode").show();
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }

        } else {
            $(".checkcode").hide();
        }
    });


    $('#modal-change').on('hidden.bs.modal', function() {
        $("#yes2, #not2,#product-input2,#cate-input2").hide();
    });


    $("#cate-input2").on("click", function() {
        var idcoupon = $(this).data("idcoupon");
        $.ajax({
            url: '{{ route("cate.list") }}',
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                idcoupon,
            },
            success: function(response) {
                var html = response.html;
                $("#listcategory_coupon").html(html);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $("#product-input2").on("click", function() {
        var idcoupon = $(this).data("idcoupon");
        $.ajax({
            url: '{{ route("product.list") }}',
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                idcoupon,
            },
            success: function(response) {
                var html = response.html;
                $("#listproduct_coupon").html(html);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $("#in4listcate").on("click", function() {
        var idcoupon = $(this).data("idcoupon");
        $.ajax({
            url: '{{ route("in4cate.list") }}',
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                idcoupon,
            },
            success: function(response) {
                var html = response.html;
                $("#listcategory_couponin4").html(html);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $("#in4listpro").on("click", function() {
        var idcoupon = $(this).data("idcoupon");
        $.ajax({
            url: '{{ route("in4product.list") }}',
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                idcoupon,
            },
            success: function(response) {
                var html = response.html;
                $("#listproduct_couponin4").html(html);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});
</script>

@endsection