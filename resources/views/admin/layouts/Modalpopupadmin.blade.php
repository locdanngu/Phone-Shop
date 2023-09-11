<!-- Modal đăng xuất -->
<div class="modal fade" id="modal-logout">
    <div class="modal-dialog">
        <form class="modal-content fix" action="{{ route('logoutadmin') }}" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Đăng xuất khỏi hệ thống</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bạn thực sự muốn rời đi?</p>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary" >Đăng xuất</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>