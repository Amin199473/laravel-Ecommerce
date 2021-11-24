<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('admin.layouts.head')
    @yield('head')
</head>
<body class="sidebar-mini">
    <div id="app" class="wrapper">
        <!-- Navbar and header section -->
        @include('admin.layouts.header')

        <!-- sidebar Section  -->
        @include('admin.layouts.sidebar')

        <!-- main content from every page -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        @include('admin.layouts.footer')
    </div>


    <!-- scripts -->
    @include('admin.layouts.script')
    @yield('script')
</body>
</html>
