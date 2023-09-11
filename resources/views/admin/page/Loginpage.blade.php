<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Log in</title>
    @include('admin.layouts.Linkadmin')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">

            <!-- <a href="#"><img src="images/icon.png" height=50 width=50><b> Admin</b> Mocha</a> -->
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Đăng nhập để bắt đầu phiên làm việc</p>

                <form action="{{ route('loginadmin') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Tên đăng nhập" name="adminname" required
                            value="{{ old('adminname') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Mật khẩu" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="bi bi-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('adminname')
                    <div class="input-group">
                        <p style="color:red">{{ $message }}</p>
                    </div>
                    @enderror
                    @error('error')
                    <div class="input-group">
                        <p style="color:red">{{ $message }}</p>
                    </div>
                    @enderror
                    <div class="row d-flex justify-content-center">
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập hệ thống</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <div class="social-auth-links text-center mb-3">
        <p>- Hoặc -</p>
        <a href="#" class="btn btn-block btn-primary">
        <i class="bi bi-facebook mr-2"></i> Đăng nhập bằng Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="bi bi-google mr-2"></i> Đăng nhập bằng Google+
        </a>
      </div> -->
                <!-- /.social-auth-links -->

                <!-- <p class="mb-1">
        <a href="forgot-password.html">Tôi quên mật khẩu</a>
      </p> -->
                <!-- <p class="mt-3 d-flex justify-content-center">
                    <a href=" " class="text-center">Chuyển đến trang đăng ký</a>
                </p> -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

</body>

</html>