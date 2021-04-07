<!Doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="@lang('static.titles.normal')" name="description" />
    <meta content="PayAndWin" name="author" />
    <link rel="shortcut icon" href="{{ asset('assets/commons/images/favicon.png') }}">
    <title>@yield('title','Ödənin və qazanın nəzarət paneli')</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('/assets/admin/cssjslib/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" />
    <!-- Icons Css -->
    <link href="{{ asset('/assets/admin/cssjslib/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('/assets/admin/cssjslib/css/app.min.css') }}" id="app-style" rel="stylesheet"
        type="text/css" />

    @livewireStyles

    <style>
        .turbolinks-progress-bar {
            height: 3px;
            background-color: #7c9d32;
        }

    </style>
    @yield('css')
</head>

<body data-sidebar="dark">
    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{ route('dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/commons/images/icon-white.png') }}" alt="Pay And Win logo"
                                    height="40" />
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/commons/images/icon-white.png') }}" alt="Pay And Win logo"
                                    height="40" />
                            </span>
                        </a>

                        <a href="{{ route('dashboard') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/commons/images/icon-white.png') }}" alt="Pay And Win logo"
                                    height="40" />
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/commons/images/icon-white.png') }}" alt="Pay And Win logo"
                                    height="40" />
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="dripicons-menu"></i>
                    </button>

                    <div class="d-none d-sm-block ml-2">
                        <h4 class="page-title font-size-18">@yield('pageName')</h4>
                    </div>

                </div>


                <div class="d-flex">

                    <div class="dropdown d-none d-md-block ml-2">
                        @if (app()->getLocale() == 'az')
                            <button type="button" class="btn header-item waves-effect" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img class="mr-2" src="{{ asset('assets/admin/cssjslib/images/flags/az_flag.png') }}"
                                    alt="Header Language" height="16">
                                Az <span class="mdi mdi-chevron-down"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">

                                <!-- item-->
                                <a href="{{ route('locale', 'ru') }}" class="dropdown-item notify-item">
                                    <img src="{{ asset('assets/admin/cssjslib/images/flags/russia_flag.jpg') }}"
                                        alt="user-image" class="mr-1" height="12">
                                    <span class="align-middle"> Ru </span>
                                </a>
                                <a href="{{ route('locale', 'en') }}" class="dropdown-item notify-item">
                                    <img src="{{ asset('assets/admin/cssjslib/images/flags/us_flag.jpg') }}"
                                        alt="user-image" class="mr-1" height="12">
                                    <span class="align-middle"> En </span>
                                </a>

                            </div>
                        @elseif(app()->getLocale()=='en')
                            <button type="button" class="btn header-item waves-effect" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img class="mr-2" src="{{ asset('assets/admin/cssjslib/images/flags/us_flag.jpg') }}"
                                    alt="Header Language" height="16">
                                En <span class="mdi mdi-chevron-down"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">

                                <!-- item-->
                                <a href="{{ route('locale', 'ru') }}" class="dropdown-item notify-item">
                                    <img src="{{ asset('assets/admin/cssjslib/images/flags/russia_flag.jpg') }}"
                                        alt="user-image" class="mr-1" height="12">
                                    <span class="align-middle"> Ru </span>
                                </a>
                                <a href="{{ route('locale', 'az') }}" class="dropdown-item notify-item">
                                    <img src="{{ asset('assets/admin/cssjslib/images/flags/az_flag.png') }}"
                                        alt="user-image" class="mr-1" height="12">
                                    <span class="align-middle"> Az </span>
                                </a>

                            </div>
                        @elseif (app()->getLocale()=='ru')
                            <button type="button" class="btn header-item waves-effect" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img class="mr-2"
                                    src="{{ asset('assets/admin/cssjslib/images/flags/russia_flag.jpg') }}"
                                    alt="Header Language" height="16">
                                Ru <span class="mdi mdi-chevron-down"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">

                                <!-- item-->
                                <a href="{{ route('locale', 'en') }}" class="dropdown-item notify-item">
                                    <img src="{{ asset('assets/admin/cssjslib/images/flags/us_flag.jpg') }}"
                                        alt="user-image" class="mr-1" height="12">
                                    <span class="align-middle"> En </span>
                                </a>
                                <a href="{{ route('locale', 'az') }}" class="dropdown-item notify-item">
                                    <img src="{{ asset('assets/admin/cssjslib/images/flags/az_flag.png') }}"
                                        alt="user-image" class="mr-1" height="12">
                                    <span class="align-middle"> Az </span>
                                </a>

                            </div>
                        @endif
                    </div>
                    <div class="dropdown d-none d-lg-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="mdi mdi-fullscreen"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block ml-2">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @auth
                                <img class="rounded-circle header-profile-user"
                                    src="{{ asset('/storage/uploads/admins/' . auth()->guard('admins')->user()->profilePhoto) }}"
                                    alt="{{ auth()->guard('admins')->user()->name }}">
                            @endauth
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            @auth
                                <a class="dropdown-item" href="{{ route('profile', auth()->guard('admins')->user()->id) }}"><i
                                        class="dripicons-user font-size-16 align-middle mr-2"></i>
                                    @lang('static.titles.profile')</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logOut') }}"><i
                                        class="dripicons-exit font-size-16 align-middle mr-2"></i>
                                    @lang('static.actions.logout')</a>
                            @endauth
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="mdi mdi-spin mdi-cog"></i>
                        </button>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        @if (auth()->guard('admins')->user()->role != 4)
                            <li>
                                <a href="{{ route('dashboard') }}" class="waves-effect">
                                    <i class="dripicons-device-desktop"></i>
                                    <span>@lang('static.menu.dashboard')</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->guard('admins')->user()->role != 4)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="dripicons-photo-group"></i>
                                    <span> @lang('static.menu.customers') </span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="{{ route('customers') }}">
                                        @lang('static.menu.customers')
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route("products")}}">
                                    Products
                                    </a>
                                </li>
                                    <li>
                                        <a href="{{ route('posts') }}">
                                            @lang('static.menu.media.campaigns')
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('locations') }}">
                                            <span>@lang('static.menu.locations')</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('comments') }}">
                                            <span>@lang('static.menu.comments')</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (auth()->guard('admins')->user()->role == 3)
                            <li>
                                <a href="{{ route('pwusers') }}" class="waves-effect">
                                    <i class="dripicons-user-group"></i>
                                    <span>@lang('static.menu.pwusers')</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->guard('admins')->user()->role == 3 || auth()->guard('admins')->user()->role == 1)
                            <li>
                                <a href="{{ route('admins') }}" class="waves-effect">
                                    <i class="dripicons-user-id"></i>
                                    <span>@lang('static.menu.admins')</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->guard('admins')->user()->role != 4)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="dripicons-browser-upload"></i>
                                    <span> @lang('static.menu.forwebsite.website') </span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('settings') }}">@lang('static.menu.forwebsite.settings')</a>
                                    </li>
                                    <li><a href="{{ route('about') }}">@lang('static.menu.forwebsite.about')</a></li>
                                    <li><a
                                            href="{{ route('faqsandtermofuse') }}">@lang('static.menu.forwebsite.faqsandtermofuse')</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('buckets') }}" class="waves-effect">
                                <i class="dripicons-cart"></i>
                                <span>@lang('static.menu.buckets')</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        @yield('content')
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title px-3 py-4">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
                <h5 class="m-0">@lang('static.menu.settings')</h5>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />

            <div class="p-4">
                <div class="mb-2">
                    <img src="{{ asset('assets/admin/cssjslib/images/layouts/layout-1.jpg') }}"
                        class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                    <label class="custom-control-label"
                        for="light-mode-switch">@lang('static.actions.modes.lightmode')</label>
                </div>

                <div class="mb-2">
                    <img src="{{ asset('assets/admin/cssjslib/images/layouts/layout-2.jpg') }}"
                        class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch"
                        data-bsStyle="{{ asset('assets/admin/cssjslib/css/bootstrap-dark.min.css') }}"
                        data-appStyle="{{ asset('assets/admin/cssjslib/css/app-dark.min.css') }}" />
                    <label class="custom-control-label"
                        for="dark-mode-switch">@lang('static.actions.modes.darkmode')</label>
                </div>

                <div class="mb-2">
                    <img src="{{ asset('assets/admin/cssjslib/assets/images/layouts/layout-3.jpg') }}"
                        class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="custom-control custom-switch mb-5">
                    <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch"
                        data-appStyle="{{ asset('assets/admin/cssjslib/css/app-rtl.min.css') }}" />
                    <label class="custom-control-label"
                        for="rtl-mode-switch">@lang('static.actions.modes.rtlmode')</label>
                </div>

            </div>

        </div>
        <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    © 2020
                    @php($year = \Carbon\Carbon::now()->year)
                        @if ($year != 2020)
                            <span class="copyright">
                                - {{ $year }}
                            </span>
                        @endif
                        Pay And Win
                    </div>
                </div>
            </div>
        </footer>
        @livewireScripts
        <!-- JAVASCRIPT -->
        <script src="{{ asset('/js/app.js') }}"></script>
        <script src="{{ asset('/assets/admin/cssjslib/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/cssjslib/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/cssjslib/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/cssjslib/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/cssjslib/libs/node-waves/waves.min.js') }}"></script>

        <script src="{{ asset('/assets/admin/cssjslib/js/app.js') }}"></script>

        @yield('js')
    </body>

    </html>
