<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('category.delete') }}" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Xóa 1 hãng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="idcategory">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tên hãng</span>
                    <span name="namecategory" class="spanpopup"></span>
                </div>
                <div class="input-group mb-3 d-flex align-items-center">
                    <span class="input-group-text" id="inputGroup-sizing-default">Ảnh nền</span>
                    <img src="" alt="" style="height:100px;margin-left:1em" class="imageblog2">
                </div>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-danger">Xóa</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>