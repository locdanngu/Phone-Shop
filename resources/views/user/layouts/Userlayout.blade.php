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
    @yield('js')

</body>

</html>