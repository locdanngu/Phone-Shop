<div class="modal fade" id="modal-change">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('category.change') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa mã giảm giá</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="sendiduser" id="sendiduser2">
            <input type="text" name="listproduct" id="listproduct2">
            <input type="text" name="listcate" id="listcate2">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mã giảm giá</span>
                    <input type="text" class="form-control font-weight-bold" style="color:red;" disabled
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="code">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Áp dụng cho</span>
                    <div class="d-flex align-items-center">
                        <label class="label">
                            <input type="radio" name="applicable_to" value="product" required id="productcoupon">
                            Sản phẩm
                        </label>
                        <label class="label">
                            <input type="radio" name="applicable_to" value="cart" required>
                            Đơn hàng
                        </label>
                    </div>
                </div>
                <div class="input-group mb-3 d-flex justify-content-between fixmobileuser">
                    <div class="w-50 d-flex fixmobileuser2">
                        <span class="input-group-text" id="inputGroup-sizing-default"
                            style="width: 30% !important;">Người dùng</span>
                        <div class="d-flex align-items-center">
                            <label class="label">
                                <input type="radio" name="iduser" value="1" id="user-radio2" required>
                                Cá nhân
                            </label>
                            <label class="label">
                                <input type="radio" name="iduser" value="0" required>
                                Tất cả
                            </label>
                        </div>
                    </div>
                    <div class="d-flex checkuser align-items-center">
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default"
                            placeholder="Nhập Id, username, email hoặc số điện thoại" style="width: 90%;"
                            id="user-input2" name="finduser">
                        <i class="bi bi-x-circle-fill ml-3" id="not2" style="color:red"></i>
                        <i class="bi bi-check-circle-fill ml-3" id="yes2" style="color: #007bff"></i>
                    </div>

                </div>
                <div class="input-group mb-3 d-flex justify-content-between fixmobileuser productorcate">
                    <div class="w-50 d-flex fixmobileuser2">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width: 30% !important;">Sản
                            phẩm</span>
                        <div class="d-flex align-items-center">
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="1" id="product-radio2"
                                    class="requiredcheck">
                                Danh sách
                            </label>
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="2" class="requiredcheck">
                                Tất cả
                            </label>
                        </div>
                    </div>
                    <p class="btn btn-secondary" id="product-input2" type="button" data-toggle="modal"
                        data-target="#modal-addproduct2">Chưa chọn sản phẩm nào</p>
                </div>
                <div class="input-group mb-3 d-flex justify-content-between fixmobileuser productorcate">
                    <div class="w-50 d-flex fixmobileuser2">
                        <span class="input-group-text" id="inputGroup-sizing-default"
                            style="width: 30% !important;">Danh mục</span>
                        <div class="d-flex align-items-center">
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="3" id="cate-radio2"
                                    class="requiredcheck">
                                Danh sách
                            </label>
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="4" class="requiredcheck">
                                Tất cả
                            </label>
                        </div>
                    </div>
                    <p class="btn btn-secondary" id="cate-input2" type="button" data-toggle="modal"
                        data-target="#modal-addcate2">Chưa chọn mục nào</p>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Loại giảm</span>
                    <div class="d-flex align-items-center">
                        <label class="label">
                            <input type="radio" name="discount_type" value="percentage" required>
                            Phần trăm
                        </label>
                        <label class="label">
                            <input type="radio" name="discount_type" value="amount" required>
                            Số tiền
                        </label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Y/c tối thiểu($)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="minimum_order_amount">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tối đa giảm($)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="max_discount_amount">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mức giảm(%/$)</span>
                    <input type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="discount_amount">
                </div>
                <div class="input-group mb-3" style="width: 100% !important;">
                    <div class="w-50">
                        <span class="input-group-text" id="inputGroup-sizing-default"
                            style="width: 100% !important;">Ngày bắt đầu</span>
                        <input type="datetime-local" name="starttime" style="width: 100%" required>
                    </div>
                    <div class="w-50">
                        <span class="input-group-text" id="inputGroup-sizing-default"
                            style="width: 100% !important;">Ngày kết thúc</span>
                        <input type="datetime-local" name="endtime" style="width: 100%" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-success">Lưu thay đổi</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-addcate2" data-backdrop="static" data-keyboard="false">
    <!-- Không đóng popup khi nhấn bên ngoài -->
    <div class="modal-dialog">
        <div class="modal-content" action="" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Chọn danh sách danh mục mới</h4>
            </div>
            <div class="modal-body fixgrid">
                @foreach($category as $ca)
                <label for="" class="d-flex flex-column align-items-center">
                    <img src="{{ $ca->imagecategory }}" alt="" height="50" style="width:fit-content">
                    {{ $ca->namecategory }}
                    <input type="checkbox" name="listcate" value="{{ $ca->idcategory }}" class="listcate-checkbox">
                </label>
                @endforeach
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="submit" class="btn btn-success" id="listcatebtn2">Đồng ý</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-addproduct2" data-backdrop="static" data-keyboard="false">
    <!-- Không đóng popup khi nhấn bên ngoài -->
    <div class="modal-dialog">
        <div class="modal-content" action="" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Chọn danh sách sản phẩm mới</h4>
            </div>
            <div class="modal-body">
                <div class="card-body table-responsive p-0" style="height: 65vh;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th class="text-center">Sản phẩm</th>
                                <th>Giá</th>
                                <th>Hãng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $pr)
                            <tr>
                                <td class="font-weight-bold" style="color:red">{{ $pr->nameproduct }}</td>
                                <td class="text-center"><img src="{{ $pr->imageproduct }} " alt="" height="50"></td>
                                <td class="font-weight-bold" style="color:red">{{ $pr->price }} $</td>
                                <td class="font-weight-bold">{{ $pr->category->namecategory }}</td>
                                <td><input type="checkbox" name="listproduct" value="{{ $pr->idproduct }}"
                                        class="listproduct-checkbox"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="submit" class="btn btn-success" id="listproductbtn2">Đồng ý</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>