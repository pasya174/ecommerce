<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Ecommerce</title>

    <link href="{{ asset('administator/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('administator/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('administator/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('administator/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    @stack('head-admin')
    <link href="{{ asset('administator/build/css/custom.min.css') }}" rel="stylesheet">
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

</head>

<body class="nav-md">
    @include('sweetalert::alert')
    <div class="container body">
        <div class="main_container">
            @include('administator.components.sidebar')
            @include('administator.components.top-navbar')

            @yield('container')

            @include('administator.components.footer')
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('administator/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('administator/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('administator/vendors/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('administator/vendors/nprogress/nprogress.js') }}"></script>
    <script src="{{ asset('administator/vendors/iCheck/icheck.min.js') }}"></script>
    @stack('script-admin')
    <script src="{{ asset('administator/build/js/custom.min.js') }}"></script>


</body>

</html>
