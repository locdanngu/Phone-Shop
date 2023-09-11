<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @include('admin.layouts.Linkadmin')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.layouts.Headeradmin')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.layouts.Leftbar')

        
        @yield('body')


        @include('admin.layouts.Modalpopupadmin')
        @include('admin.layouts.Footeradmin')
    </div>

    @include('admin.layouts.Linkscript')
    @yield('popup')
    @yield('js')
</body>

</html>