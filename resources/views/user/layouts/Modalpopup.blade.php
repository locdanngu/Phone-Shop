<div class="modal fade" id="modal-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('messages.selectcategory') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="fixgrid">
                    @foreach($category as $ca)
                    <a href="{{ route('shop.search', ['searchproduct' => $ca->namecategory]) }}" class="ptgrid"
                        style="height:100px">
                        <img src="{{ $ca->imagecategory }}" alt="">
                        <span>{{ $ca->namecategory }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal">{{ trans('messages.closebtn') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-login">
    <div class="modal-dialog">
        <form action="{{ route('loginuser') }}" method="post" class="modal-content content__form">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('messages.dangnhapbtn') }}</h4>
            </div>
            <div style="display:flex;justify-content:center; margin-top:2em">
                <h2>u<h2 style="color: #5a88ca">Stora</h2>
                </h2>
            </div>
            <div class="modal-body">
                <div class="content__inputs">
                    <label>
                        <input required type="text" name="username" autocomplete="off">
                        <span>{{ trans('messages.username/email/phone') }}</span>
                    </label>
                    <label>
                        <input required type="password" name="password" autocomplete="off">
                        <span>{{ trans('messages.password') }}</span>
                    </label>
                </div>
                <div style="display: flex; width:100%; justify-content: center;margin-top:1em">
                    <h5 style="margin:0">{{ trans('messages.noaccount') }}? <a href="#" type="button" data-toggle="modal"
                            data-target="#modal-register">{{ trans('messages.dangkybtn') }}
                            {{ trans('messages.here') }}</a></h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" style="width: 100%;">{{ trans('messages.dangnhapbtn') }}</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-register">
    <div class="modal-dialog">
        <form action="{{ route('registeruser') }}" method="post" class="modal-content content__form">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('messages.dangkybtn') }}</h4>
            </div>
            <div style="display:flex;justify-content:center; margin-top:2em">
                <h2>u<h2 style="color: #5a88ca">Stora</h2>
                </h2>
            </div>
            <div class="modal-body">
                <div class="content__inputs">
                    <label>
                        <input required type="text" name="username" autocomplete="off" id="checkuser">
                        <span>{{ trans('messages.username') }}</span>
                    </label>
                    <h6 class="h6 noti" id="username1"><i class="bi bi-exclamation-circle-fill"></i>
                        {{ trans('messages.username1') }}</h6>
                    <h6 class="h6 noti" id="username2"><i class="bi bi-exclamation-circle-fill"></i>
                        {{ trans('messages.username2') }}</h6>
                    <h6 class="h6 noti" id="username3"><i class="bi bi-check-circle-fill"></i>
                        {{ trans('messages.username3') }}</h6>
                    <label>
                        <input required type="password" name="password" autocomplete="off" id="checkpassword">
                        <span>{{ trans('messages.password') }}</span>
                    </label>
                    <h6 class="h6 noti" id="password"><i class="bi bi-exclamation-circle-fill"></i>
                        {{ trans('messages.password1') }}</h6>
                    <label>
                        <input required type="password" name="repassword" autocomplete="off" id="checkrepassword">
                        <span>{{ trans('messages.repassword') }}</span>
                    </label>
                    <h6 class="h6 noti" id="repassword"><i class="bi bi-exclamation-circle-fill"></i>
                        {{ trans('messages.password2') }}</h6>
                    <div class="fixmobile">
                        <label>
                            <input required type="text" name="firstname" autocomplete="off">
                            <span>{{ trans('messages.firstname') }}</span>
                        </label>
                        <label>
                            <input required type="text" name="lastname" autocomplete="off">
                            <span>{{ trans('messages.lastname') }}</span>
                        </label>
                    </div>
                    <label>
                        <input required type="text" name="email" autocomplete="off" id="checkemail">
                        <span>Email</span>
                    </label>
                    <h6 class="h6 noti" id="email1"><i class="bi bi-exclamation-circle-fill"></i>
                        {{ trans('messages.email1') }}
                    </h6>
                    <h6 class="h6 noti" id="email2"><i class="bi bi-check-circle-fill"></i>
                        {{ trans('messages.email2') }}</h6>
                    <h6 class="h6 noti" id="email3"><i class="bi bi-exclamation-circle-fill"></i>
                        {{ trans('messages.email3') }}</h6>
                    <label>
                        <input required type="text" name="phone" autocomplete="off" id="checkphone">
                        <span>{{ trans('messages.phone') }}</span>
                    </label>
                    <h6 class="h6 noti" id="phone1"><i class="bi bi-exclamation-circle-fill"></i>
                        {{ trans('messages.phone1') }}
                    </h6>
                    <h6 class="h6 noti" id="phone2"><i class="bi bi-check-circle-fill"></i>
                        {{ trans('messages.phone2') }}</h6>
                </div>
                <div style="display: flex; width:100%; justify-content: center;margin-top:1em">
                    <h5 style="margin:0">{{ trans('messages.haveaccount') }}? <a href="#" type="button"
                            data-toggle="modal" data-target="#modal-login">{{ trans('messages.dangnhapbtn') }}
                            {{ trans('messages.here') }}</a></h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" style="width: 100%;">{{ trans('messages.dangkybtn') }}</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-logout">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('messages.logoutbtn') }}?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="color:red" class="font-weight-bold">{{ trans('messages.wanttoquit') }}?</h3>
            </div>
            <div class="modal-footer justify-align-content-end">
                <a href="{{ route('logoutuser') }}" class="btn btn-danger">{{ trans('messages.logoutbtn') }}</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>