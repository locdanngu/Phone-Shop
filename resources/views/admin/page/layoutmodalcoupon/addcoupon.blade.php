<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('coupon.add') }}" method="post" enctype="multipart/form-data"
            id="coupon-form">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tạo mã giảm giá</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="sendiduser" id="sendiduser">
            <input type="hidden" name="listproduct" id="listproduct">
            <input type="hidden" name="listcate" id="listcate">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mã giảm giá</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" required name="code" id="code-input">
                </div>
                <p class="font-weight-bold checkcode" style="color:red">Mã đã tồn tại! Vui lòng nhập mã khác</p>
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
                                <input type="radio" name="iduser" value="product" id="user-radio" required>
                                Cá nhân
                            </label>
                            <label class="label">
                                <input type="radio" name="iduser" value="cart" required>
                                Tất cả
                            </label>
                        </div>
                    </div>
                    <div class="d-flex checkuser align-items-center">
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default"
                            placeholder="Nhập Id, username, email hoặc số điện thoại" style="width: 90%;"
                            id="user-input">
                        <i class="bi bi-x-circle-fill ml-3" id="not" style="color:red"></i>
                        <i class="bi bi-check-circle-fill ml-3" id="yes" style="color: #007bff"></i>
                    </div>

                </div>
                <div class="input-group mb-3 d-flex justify-content-between fixmobileuser productorcate">
                    <div class="w-50 d-flex fixmobileuser2">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width: 30% !important;">Sản
                            phẩm</span>
                        <div class="d-flex align-items-center">
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="1" id="product-radio"
                                    class="requiredcheck">
                                Danh sách
                            </label>
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="2" class="requiredcheck">
                                Tất cả
                            </label>
                        </div>
                    </div>
                    <p class="btn btn-secondary" id="product-input" type="button" data-toggle="modal"
                        data-target="#modal-addproduct">Chưa chọn sản phẩm nào</p>
                </div>
                <div class="input-group mb-3 d-flex justify-content-between fixmobileuser productorcate">
                    <div class="w-50 d-flex fixmobileuser2">
                        <span class="input-group-text" id="inputGroup-sizing-default"
                            style="width: 30% !important;">Danh mục</span>
                        <div class="d-flex align-items-center">
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="3" id="cate-radio"
                                    class="requiredcheck">
                                Danh sách
                            </label>
                            <label class="label">
                                <input type="radio" name="product_list_or_cate_list" value="4" class="requiredcheck">
                                Tất cả
                            </label>
                        </div>
                    </div>
                    <p class="btn btn-secondary" id="cate-input" type="button" data-toggle="modal"
                        data-target="#modal-addcate">Chưa chọn mục nào</p>
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
                <button type="submit" class="btn btn-primary">Lưu thông tin</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>