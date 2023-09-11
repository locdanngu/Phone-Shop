<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @include('layouts.Linkadmin')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.Headeradmin')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.Leftbar')

        
        @yield('body')


        @include('layouts.Modalpopupadmin')
        @include('layouts.Footeradmin')
    </div>

    @include('layouts.Linkscript')
    @yield('popup')
    @yield('js')
</body>

</html>