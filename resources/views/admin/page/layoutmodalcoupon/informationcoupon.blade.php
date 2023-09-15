<div class="modal fade" id="modal-in4">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thông tin mã giảm giá</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                <div class="input-group mb-3 hidein4" id="hidein4pro">
                    <span class="input-group-text" id="inputGroup-sizing-default">Sản phẩm</span>
                    <span name="product_list" class="spanpopup"></span>
                    <button class="btn btn-secondary ml-3" id="in4listpro" type="button" data-toggle="modal"
                        data-target="#modal-addproduct3">Danh sách sản phẩm</button>
                    <button class="btn btn-secondary ml-3" id="in4listcate" type="button" data-toggle="modal"
                        data-target="#modal-addcate3">Danh sách danh mục</button>
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
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-addcate3">
    <!-- Không đóng popup khi nhấn bên ngoài -->
    <div class="modal-dialog">
        <div class="modal-content" action="" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Danh sách danh mục có thể áp dụng</h4>
            </div>
            <div class="modal-body fixgrid" id="listcategory_couponin4">
                @foreach($category as $ca)
                <label class="d-flex flex-column align-items-center">
                    <img src="{{ $ca->imagecategory }}" alt="" height="50" style="width:fit-content">
                    {{ $ca->namecategory }}
                </label>
                @endforeach
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-addproduct3">
    <!-- Không đóng popup khi nhấn bên ngoài -->
    <div class="modal-dialog">
        <div class="modal-content" action="" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Danh sách sản phẩm có thế áp dụng</h4>
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
                            </tr>
                        </thead>
                        <tbody id="listproduct_couponin4">
                            @foreach($product as $pr)
                            <tr>
                                <td class="font-weight-bold" style="color:red">{{ $pr->nameproduct }}</td>
                                <td class="text-center"><img src="{{ $pr->imageproduct }} " alt="" height="50"></td>
                                <td class="font-weight-bold" style="color:red">{{ $pr->price }} $</td>
                                <td class="font-weight-bold">{{ $pr->category->namecategory }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>