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
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/toruskit.css') }}" /> --}}
        <!-- End layout styles -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
         <!-- Scripts -->
            @vite('resources/js/app.js')

        <script src="https://kit.fontawesome.com/d1faa25a2e.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container-scroller bg-dark" id="app">
            <member-side-bar-component :user='{!! json_encode(Auth::user()) !!}' :member='{!! json_encode(Auth::user()->member) !!}'></member-side-bar-component>
            <div class="container-fluid page-body-wrapper">
                <member-nav-bar-top-component :user='{!! json_encode(Auth::user()) !!}'></member-nav-bar-top-component>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row mb-4">
                            <div class="col-auto">
                            <a class="btn btn-primary d-lg-none py-3" href="{{ route('member.journey') }}"> <i class="mdi mdi-rocket"></i> MY TASKS</a>
                            </div>
                        </div>
                        <breadcumb-component parent-page="My" page-title="{{ str_replace('member.', '', \Request::route()->getName())}}"></breadcumb-component>
                        @if(!Auth::user()->member->status)
                        <div class="row">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                data-tor="show:rotateX.from(90deg) show:@--tor-translateZ(-5rem;0rem) show:pull.down(half) perspective-self(3000px) slow">
                                <div class="center-v"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                        </path>
                                    </svg> Your account activity is currently suspended due to insufficient funds. You will not be able to complete your tasks</div>
                                <hr>
                                <p class="mb-0 small opacity-70">Please contact customer service to regularize your account.</p><button type="button"
                                    class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Current Balance</h5>
                                        <div class="row">
                                            <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                                <div class="d-flex d-sm-block d-md-flex align-items-center">
                                                    <h2 class="mb-0">$ {{ Auth::user()->member->balance }}</h2>
                                                </div>
                                                @if(Auth::user()->member->balance<= 0) <h6 class="text-danger font-weight-normal">Please fund your account
                                                </h6>
                                                @else
                                                    <h6 class="text-muted font-weight-normal">Minimum Withdrawal : ${{ Auth::user()->member->min_withdrawal
                                                        }}</h6>
                                                    <h6 class="text-muted font-weight-normal">Maximum Withdrawal : ${{ Auth::user()->member->max_withdrawal
                                                        }}</h6>
                                                    @endif
                                            </div>
                                            <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                                                <i class="icon-lg mdi mdi-wallet text-primary ms-auto"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Completed Tasks</h5>
                                        <div class="row">
                                            <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                                <div class="d-flex d-sm-block d-md-flex align-items-center">
                                                    <h2 class="mb-0">{{Auth::user()->member->completed_tasks }} / 40</h2>
                                                    {{-- <p class="text-success ms-2 mb-0 font-weight-medium">+8.3%</p> --}}
                                                </div>
                                                @if(Auth::user()->member->completed_tasks<40) <h6 class="text-danger font-weight-normal"> Please
                                                    complete all your daily tasks</h6>
                                                    @else
                                                    <h6 class="text-success font-weight-normal"> All daily tasks are completed</h6>
                                                    @endif
                                            </div>
                                            <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                                                <i class="icon-lg mdi mdi-rocket text-info ms-auto"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                            @yield('content')
                        @endif
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