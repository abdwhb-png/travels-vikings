<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ str_replace('_', ' ', config('app.name', 'Travels Vikings')) }}</title>
        <!-- plugins:css -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }} "
        />
        <link
            rel="stylesheet"
            href=" {{ asset('assets/vendors/css/vendor.bundle.base.css') }}"
        />
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}"
        />
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" /><link rel="stylesheet" href="{{ asset('assets/css/toruskit.css') }}" />
        <!-- End layout styles -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
        <style>
            .form-group--error {
            animation-name: shakeError;
            animation-fill-mode: forwards;
            animation-duration: .6s;
            animation-timing-function: ease-in-out;
            margin-bottom: 45px;
            box-shadow: 0 0rem 1rem rgba(145, 42, 42, 0.733)!important;
            }
            @keyframes shakeError{
            0% {
            transform: translateX(0);
            }
            15% {
            transform: translateX(0.375rem);
            }
            30% {
            transform: translateX(-0.375rem);
            }
            45% {
            transform: translateX(0.375rem);
            }
            60% {
            transform: translateX(-0.375rem);
            }
            75% {
            transform: translateX(0.375rem);
            }
            90% {
            transform: translateX(-0.375rem);
            }
            100% {
            transform: translateX(0);
            }
            }
        </style>
    </head>

    <body>
        <div class="container-scroller bg-dark" id="app">
            @yield('content')
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
        <script
            src="{{ asset('assets/js/jquery.cookie.js') }}"
            type="text/javascript"
        ></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
        <script src="{{ asset('assets/js/hoverable-collapse.j') }}s"></script>
        <script src="{{ asset('assets/js/misc.js') }}"></script>
        <script src="{{ asset('assets/js/settings.js') }}"></script>
        <script src="{{ asset('assets/js/todolist.js') }}"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
        <!-- End custom js for this page -->
        <script>
        </script>
    </body>

</html>