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
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
        @if(Request::is('admin/create/deal') || Request::is('admin/create/deal-category') || str_contains(url()->current(), 'admin/edit/deal')) <link rel="stylesheet" href="{{ asset('assets/css/toruskit.css') }}" /> @endif
        <!-- End layout styles -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
         <!-- Scripts -->
            @vite('resources/js/app.js')

        <script src="https://kit.fontawesome.com/d1faa25a2e.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container-scroller bg-dark" id="app">
            <admin-side-bar-component :user='{!! json_encode(Auth::user()) !!}'></admin-side-bar-component>
            <div class="container-fluid page-body-wrapper">
                <admin-nav-bar-top-component :user='{!! json_encode(Auth::user()) !!}'></admin-nav-bar-top-component>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row mb-4">
                            <a class="btn btn-inverse-primary mx-2 my-1" href="/admin/create/member" style="width: auto"> <i class="mdi mdi-account-plus"></i> New Member</a>
                            <a href="/admin/create/deal" class="my-1 btn btn-inverse-primary mx-2" style="width: auto"> <i class="mdi mdi-airplane"></i> New Deal</a>
                            <a href="/admin/create/system-user" class="btn btn-inverse-primary mx-2 my-1" style="width: auto">  <i class="mdi mdi-shield-outline"></i> New System User</a>
                            {{-- <a href="/admin/create/system-role" class="btn btn-inverse-primary mx-2 text-white" style="width: auto"> <i
                                    class="mdi mdi-shield-outline"></i> New System Role</a> --}}
                            <a href="/admin/create/customer-service" class="btn btn-inverse-primary mx-2 my-1" style="width: auto"> <i class="mdi mdi-headset"></i> New Customer Service</a>
                        </div>
                        <breadcumb-component parent-page="Admin" page-title="{{ str_replace('admin.', '', \Request::route()->getName())}}">
                        </breadcumb-component>
                        <info-bar-top-component head="Don't forget that you must create at least 40 deals before adding a new member or allowing a customer to create an account."
                            subhead="Otherwise an error will be generated because the tasks are automatically added for the customer when the account is created"></info-bar-top-component>
                        @yield('content')
                    </div>
                </div>
            </div>
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
    </body>

</html>