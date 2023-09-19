<div class="modal fade" id="modal-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Select category</h4>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-type">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Select type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('shop.search') }}" method="get" style="display: flex;">
                    <select style="width: 100%" name="searchproduct">
                        @foreach($type as $ty)
                        <option value="{{ $ty->nametype }}">{{ $loop->iteration }}.
                            {{ $ty->nametype }}</option>
                        @endforeach
                    </select>
                    <button type="submit">Submit</button>
                </form>

            </div>
            <div class="modal-footer justify-align-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
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
                <h4 class="modal-title">Login</h4>
            </div>
            <div style="display:flex;justify-content:center; margin-top:2em">
                <h2>u<h2 style="color: #5a88ca">Stora</h2>
                </h2>
            </div>
            <div class="modal-body">
                <div class="content__inputs">
                    <label>
                        <input required type="text" name="username" autocomplete="off">
                        <span>Username, Email or Phone</span>
                    </label>
                    <label>
                        <input required type="password" name="password" autocomplete="off">
                        <span>Password</span>
                    </label>
                </div>
                <div style="display: flex; width:100%; justify-content: center;margin-top:1em">
                    <h5 style="margin:0">Don't have an account? <a href="#" type="button" data-toggle="modal"
                            data-target="#modal-register">Register here</a></h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" style="width: 100%;">Login</button>
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
                <h4 class="modal-title">Register</h4>
            </div>
            <div style="display:flex;justify-content:center; margin-top:2em">
                <h2>u<h2 style="color: #5a88ca">Stora</h2>
                </h2>
            </div>
            <div class="modal-body">
                <div class="content__inputs">
                    <label>
                        <input required type="text" name="username" autocomplete="off">
                        <span>Username</span>
                    </label>
                    <h5 class="h5" id="username">Username already exists</h5>
                    <label>
                        <input required type="password" name="password" autocomplete="off">
                        <span>Password</span>
                    </label>
                    <h5 class="h5" id="password">Password must be more than 6 and less than 18 characters</h5>
                    <label>
                        <input required type="password" name="repassword" autocomplete="off">
                        <span>Re-enter password</span>
                    </label>
                    <h5 class="h5" id="repassword">The re-entered password does not match</h5>
                    <div style="display: flex; justify-content:space-between">
                        <label>
                            <input required type="password" name="firstname" autocomplete="off">
                            <span>First name</span>
                        </label>
                        <label>
                            <input required type="password" name="lastname" autocomplete="off">
                            <span>Last name</span>
                        </label>
                    </div>
                    <label>
                        <input required type="email" name="email" autocomplete="off">
                        <span>Email</span>
                    </label>
                    <h5 class="h5" id="email">Email already exists</h5>
                    <label>
                        <input required type="text" name="name" autocomplete="off">
                        <span>Phone</span>
                    </label>
                    <h5 class="h5" id="phone">Phone already exists</h5>
                </div>
                <div style="display: flex; width:100%; justify-content: center;margin-top:1em">
                    <h5 style="margin:0">Already have an account? <a href="#" type="button" data-toggle="modal"
                            data-target="#modal-login">Login here</a></h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" style="width: 100%;">Register</button>
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
                <h4 class="modal-title">Logout?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="color:red" class="font-weight-bold">You sure want to quit?</h3>
            </div>
            <div class="modal-footer justify-align-content-end">
                <a href="{{ route('logoutuser') }}" class="btn btn-danger">Logout</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>