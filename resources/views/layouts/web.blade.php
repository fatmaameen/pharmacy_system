<!DOCTYPE html>
<html lang="en" data-layout="twocolumn" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none"
    data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>مستشفي الشيخ زايد ال نهيان-مخازن</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('web/assets/images/Logo-1.png') }}" type="png">


    <!-- jsvectormap css -->
    <link href="{{ asset('web/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('web/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('web/assets/js/layout.js') }}"></script>



    <!-- Icons Css
       <link href="{{ asset('web/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    -->
    <link href="{{ asset('web/assets/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('web/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    {{-- <link href="{{ asset('web/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('web/assets/css/app-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('web/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('web/assets/css/custom-rtl.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        * {
            font-family: 'Cairo';
        }

        body {
            font-family: 'Cairo';
            font-size: 1.0em;

        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Cairo';
        }
    </style>

    @stack('css')
</head>

<body dir="rtl">

    @yield('content')

    {{-- <button type="button" class="btn btn-success" onclick="goBack()">رجوع</button> --}}

    <!-- JAVASCRIPT -->
    <script src="{{ asset('web/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('web/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('web/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('web/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <!-- Vector map-->
    <script src="{{ asset('web/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>

    <script src="{{ asset('web/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('web/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('web/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('web/assets/js/app.js') }}"></script>

    {{-- <script>
        function goBack() {
            window.history.back();
        }
    </script> --}}


    @stack('js')
</body>

</html>
