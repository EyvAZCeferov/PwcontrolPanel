<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="@lang('static.titles.normal')" name="description"/>
    <meta content="PayAndWin" name="author"/>
    <link rel="shortcut icon" href="{{asset('assets/commons/images/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <!-- Bootstrap Css -->
    <link href="{{asset('/assets/admin/cssjslib/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet"
    <!-- Icons Css -->
    <link href="{{asset('/assets/admin/cssjslib/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset('/assets/admin/cssjslib/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css"/>
    <title>@lang('static.titles.404')</title>
    <livewire:styles/>
    <livewire:scripts/>
    <style>
        .turbolinks-progress-bar {
            height: 3px;
            background-color: #7c9d32;
        }
    </style>
</head>

<body class="account-bg">

<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>

<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body">
                        <div class="ex-page-content text-center">
                            <h1 class="">404!</h1>
                            <h4 class="">@lang('static.pages.404.sorry')</h4>
                            <br>

                            <a class="btn btn-info mb-4 waves-effect waves-light" href="{{route('dashboard')}}"><i
                                    class="mdi mdi-home"></i> @lang('static.pages.404.backhome')</a>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>
                        © 2020 -
                        <script>
                            var year = new Date().getFullYear()
                            if (year != 2020) {
                                document.write()
                            }
                        </script>
                        Pay And Win
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- JAVASCRIPT -->
<script src="{{asset('/js/app.js')}}"></script>
<script src="{{asset('/assets/admin/cssjslib/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/assets/admin/cssjslib/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/assets/admin/cssjslib/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('/assets/admin/cssjslib/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('/assets/admin/cssjslib/libs/node-waves/waves.min.js')}}"></script>

<script src="{{asset('/assets/admin/cssjslib/js/app.js')}}"></script>
</body>

</html>
