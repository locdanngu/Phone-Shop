<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @include('user.layouts.Linkuser')
</head>

<body>
    @include('user.layouts.Headeruser')


    @yield('body')



    @include('user.layouts.Footeruser')

    @include('user.layouts.Linkscript')
    @yield('popup')

    @include('user.layouts.Modalpopup')

    @yield('js')


    <script>
    $(document).ready(function() {
        $('.move-on-top-btn').hide();

        $('a[data-toggle="modal"]').on('click', function() {
            // Đóng tất cả các modal hiện tại
            $('.modal').modal('hide');
        });

        $('.noti').hide();

        $('#checkuser').on('input', function() {
            var username = $(this).val();

            // Kiểm tra xem tên người dùng có ít nhất 6 ký tự
            if (username.length >= 5 && username.length <= 18) {
                $('#username2').hide();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('checkuser') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        username: username,
                    },
                    success: function(response) {
                        var re = response.re;
                        if (re == 1) {
                            $('#username3').show();
                            $('#username1').hide();
                        } else {
                            $('#username3').hide();
                            $('#username1').show();
                        }
                    }
                });
            } else {
                // Nếu tên người dùng có ít hơn 6 ký tự, bạn có thể thực hiện các hành động phù hợp ở đây
                $('#username1').hide();
                $('#username3').hide();
                $('#username2').show();
            }
        });

    });

    $(window).scroll(function() {
        if ($(this).scrollTop() >= 300) {
            $('.move-on-top-btn').fadeIn();
        } else {
            $('.move-on-top-btn').fadeOut();
        }
    });

    $('.move-on-top-btn').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 1500);
    });
    </script>
</body>

</html>