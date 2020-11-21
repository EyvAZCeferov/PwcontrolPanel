<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <title>@lang('static.titles.login')</title>
</head>
<body class="account-bg">

<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="{{route('login')}}"><img src="{{asset('assets/commons/images/icon-ios.png')}}"
                                                                  height="100" alt="logo"></a>
                            </div>
                        </div>
                        <div class="p-3">
                            <h4 class="font-size-18 text-muted mt-2 text-center">
                                @lang('static.pages.login.welcome')
                            </h4>
                            <p class="text-muted text-center mb-4">@lang('static.pages.login.signPw')</p>
                            @if (session()->has('message'))
                                <div class="alert alert-info" role="alert">
                                    <strong>{{session('message')}}</strong>
                                </div>
                            @endif
                            <form class="form-horizontal" method="POST" action="{{route('login')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="username">@lang('static.formFields.labels.email')</label>
                                    <input type="email" class="form-control"
                                           name="email"
                                           id="email"
                                           placeholder="@lang('static.formFields.inputs.email')">
                                </div>

                                <div class="form-group">
                                    <label for="userpassword">@lang('static.formFields.labels.password')</label>
                                    <input type="password"
                                           class="form-control"
                                           name="password"
                                           id="userpassword"
                                           placeholder="@lang('static.formFields.inputs.password')">
                                </div>

                                <div class="form-group row mt-4">
                                    <div class="col-sm-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input"
                                                   checked
                                                   id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">
                                                @lang('static.formFields.labels.remember_me')
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-center">
                                        <button class="btn btn-primary w-md waves-effect waves-light"
                                                type="submit">
                                            @lang('static.formFields.buttons.login')
                                        </button>
                                    </div>
                                </div>

                            </form>

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
</body>
</html>
