<!-- <div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('coupon.delete') }}" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Xóa 1 mã giảm giá</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="idcoupon">
            <div class="modal-body">
                <p class="font-weight-bold" style="color:red">Thao tác này sẽ khiến không ai có thể dùng mã giảm giá
                    này!</p>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mã giảm giá</span>
                    <span name="code" class="spanpopup font-weight-bold" style="color:red"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Áp dụng</span>
                    <span name="applicable_to" class="spanpopup"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Người dùng</span>
                    <span name="iduser" class="spanpopup"></span>
                </div>
                <div class="input-group mb-3 hidein4">
                    <span class="input-group-text" id="inputGroup-sizing-default">Sản phẩm</span>
                    <span name="product_list" class="spanpopup"></span>
                    <button class="btn btn-secondary ml-3" id="in4listpro">Danh sách sản phẩm</button>
                </div>
                <div class="input-group mb-3 hidein4">
                    <span class="input-group-text" id="inputGroup-sizing-default">Danh mục</span>
                    <span name="category_list" class="spanpopup"></span>
                    <button class="btn btn-secondary ml-3" id="in4listcate">Danh sách danh mục</button>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Loại giảm giá</span>
                    <span name="discount_type" class="spanpopup"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Yêu cầu</span>
                    <span name="minimum_order_amount" class="spanpopup font-weight-bold" style="color:red"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tối đa</span>
                    <span name="max_discount_amount" class="spanpopup font-weight-bold" style="color:red"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mức giảm</span>
                    <span name="discount_amount" class="spanpopup font-weight-bold" style="color:red"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Đã sử dụng</span>
                    <span name="used" class="spanpopup"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Ngày bắt đầu</span>
                    <span name="starttime" class="spanpopup font-weight-bold"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Ngày kết thúc</span>
                    <span name="endtime" class="spanpopup font-weight-bold"></span>
                </div>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-danger">Xóa</button>
            </div>
        </form>
    </div>
</div> -->