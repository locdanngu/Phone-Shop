@if ($errors->has('login') || $errors->has('login2'))
<script>
$(document).ready(function() {
    $("#modal-wrongpassword").modal("show");
});
</script>
@endif


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
        $('#username2').hide();
        // Kiểm tra xem tên người dùng có ít nhất 6 ký tự
        if (username.length >= 5 && username.length <= 18) {

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

    $('#checkpassword').on('input', function() {
        var password = $(this).val();
        if (password.length < 6 || password.length > 18) {
            $('#password').show();
        } else {
            $('#password').hide();
        }
    });

    $('#checkrepassword').on('input', function() {
        var repassword = $(this).val();
        var password = $('#checkpassword').val();

        if (password != repassword) {
            $('#repassword').show();
        } else {
            $('#repassword').hide();
        }
    });

    $('#checkemail').on('input', function() {
        var email = $(this).val();

        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        if (emailPattern.test(email)) {
            $('#email3').hide();
            $.ajax({
                type: 'POST',
                url: "{{ route('checkuser') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    email: email,
                },
                success: function(response) {
                    var re = response.re;
                    if (re == 1) {
                        $('#email2').show();
                        $('#email1').hide();
                    } else {
                        $('#email2').hide();
                        $('#email1').show();
                    }
                }
            });
        } else {
            $('#email1').hide();
            $('#email2').hide();
            $('#email3').show();
        }

    });

    $('#checkphone').on('input', function() {
        var phone = $(this).val();

        $.ajax({
            type: 'POST',
            url: "{{ route('checkuser') }}",
            data: {
                _token: '{{ csrf_token() }}',
                phone: phone,
            },
            success: function(response) {
                var re = response.re;
                if (re == 1) {
                    $('#phone2').show();
                    $('#phone1').hide();
                } else {
                    $('#phone2').hide();
                    $('#phone1').show();
                }
            }
        });
    });


    $('.them-sp-vao-gio').on('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>
        var id = $(this).data('idproduct');

        $.ajax({
            type: 'POST',
            url: "{{ route('addcart') }}",
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
            },
            success: function(response) {
                var re = response.re;
                var html = response.html;
                if (re == 1) {
                    toastr.success(
                        '<b>{{ trans('messages.addtocarttoastrsuc2') }}</b>'
                    )
                } else {
                    toastr.success(
                        '<b>{{ trans('messages.addtocarttoastrsuc1') }}</b>'
                    )
                }
                $("#capnhatcart").html(html);
            }
        });
    });

    $('#sendregisteremailnoti').on('click', function(event) {
        var email = $('#registeremailnoti').val();

        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        if (emailPattern.test(email)) {

            $.ajax({
                type: 'POST',
                url: "{{ route('notiemail') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    email: email,
                },
                success: function(response) {
                    toastr.success('<b>{{ trans('messages.addemailsuc') }}</b>')
                    $("#registeremailnoti").val('');
                }
            });
        }else{
            toastr.error('<b>{{ trans('messages.wrongemail') }}</b>')
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