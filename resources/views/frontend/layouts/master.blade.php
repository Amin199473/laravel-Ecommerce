<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA_Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- webpack mix Assets css files -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightslider.css') }}">


    <!-- webpack mix Assets and custom js files -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- head-tags section -->
    @include('frontend.layouts.head')
    @yield('head')

</head>
<body>
    <div id="app">
        <!-- header section -->
        @include('frontend.layouts.header')

        @yield('content')

        <!-- footer section -->
        @include('frontend.layouts.footer')
    </div>

    <!-- scripts -->
    @include('frontend.layouts.script')
    @yield('scripts')
</body>
</html>
