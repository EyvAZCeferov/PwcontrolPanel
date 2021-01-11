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
    <title>{{ $post->az_name }}</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('/assets/admin/cssjslib/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" />
    <!-- Icons Css -->
    <link href="{{ asset('/assets/admin/cssjslib/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('/assets/admin/cssjslib/css/app.min.css') }}" id="app-style" rel="stylesheet"
        type="text/css" />
</head>

<body data-sidebar="dark">
    <!-- Begin page -->


    <div class="page-content">

        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-body">

                        <div class="media mb-5">
                            <img class="d-flex mr-3 rounded-circle  avatar-sm"
                                src="{{ asset('assets/commons/images/icon.png') }}"
                                alt="Pay And Win Logo">
                            <div class="media-body align-self-center">
                                <h4 class="font-size-14 m-0">Pay And Win</h4>
                                <small class="text-muted">payandwin@pw.az</small>
                            </div>
                        </div>

                        <h4 class="mt-0 font-size-16">{{ $post->az_name }}</h4>

                        <p>{{ $post->created_at }}</p>
                        <p>
                            {{ $post->az_description }}
                        </p>
                        <hr />

                        <div class="row">
                            @foreach(json_decode($post->images) as $image)
                                <div class="col-xl-2 col-md-4 col-6">
                                    <div class="card mb-4">
                                        <img class="card-img-top img-fluid"
                                        src="{{asset('/storage/uploads/posts/'.$post->clasor.'/'.$image)}}"
                                            alt="{{ $image }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a href="http://localhost:8001/customers/{{ $post->getCustomer->id }}/campaigns/{{ $post->slug }}" class="btn btn-secondary waves-effect mt-4"><i
                                class="mdi mdi-eye"></i> Daha çox</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- End row -->
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-body">

                        <div class="media mb-5">
                            <img class="d-flex mr-3 rounded-circle  avatar-sm"
                                src="{{ asset('assets/commons/images/icon.png') }}"
                                alt="Pay And Win Logo">
                            <div class="media-body align-self-center">
                                <h4 class="font-size-14 m-0">Pay And Win</h4>
                                <small class="text-muted">payandwin@pw.az</small>
                            </div>
                        </div>

                        <h4 class="mt-0 font-size-16">{{ $post->ru_name }}</h4>

                        <p>{{ $post->created_at }}</p>
                        <p>
                            {{ $post->ru_description }}
                        </p>
                        <hr />

                        <div class="row">
                            @foreach(json_decode($post->images) as $image)
                                <div class="col-xl-2 col-md-4 col-6">
                                    <div class="card mb-4">
                                        <img class="card-img-top img-fluid"
                                        src="{{asset('/storage/uploads/posts/'.$post->clasor.'/'.$image)}}"
                                            alt="{{ $image }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a href="http://localhost:8001/customers/{{ $post->getCustomer->id }}/campaigns/{{ $post->slug }}" class="btn btn-secondary waves-effect mt-4"><i
                                class="mdi mdi-eye"></i> Больше</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- End row -->
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-body">

                        <div class="media mb-5">
                            <img class="d-flex mr-3 rounded-circle  avatar-sm"
                                src="{{ asset('assets/commons/images/icon.png') }}"
                                alt="Pay And Win Logo">
                            <div class="media-body align-self-center">
                                <h4 class="font-size-14 m-0">Pay And Win</h4>
                                <small class="text-muted">payandwin@pw.az</small>
                            </div>
                        </div>

                        <h4 class="mt-0 font-size-16">{{ $post->en_name }}</h4>

                        <p>{{ $post->created_at }}</p>
                        <p>
                            {{ $post->en_description }}
                        </p>
                        <hr />

                        <div class="row">
                            @foreach(json_decode($post->images) as $image)
                                <div class="col-xl-2 col-md-4 col-6">
                                    <div class="card mb-4">
                                        <img class="card-img-top img-fluid"
                                            src="{{asset('/storage/uploads/posts/'.$post->clasor.'/'.$image)}}"
                                            alt="{{ $image }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a href="http://localhost:8001/customers/{{ $post->getCustomer->id }}/campaigns/{{ $post->slug }}" class="btn btn-secondary waves-effect mt-4"><i
                                class="mdi mdi-eye"></i> More</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- End row -->

        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

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
        </div>
        <!-- JAVASCRIPT -->
        <script src="{{ asset('/js/app.js') }}"></script>
        <script src="{{ asset('/assets/admin/cssjslib/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/cssjslib/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/cssjslib/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/cssjslib/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/cssjslib/libs/node-waves/waves.min.js') }}"></script>

        <script src="{{ asset('/assets/admin/cssjslib/js/app.js') }}"></script>

    </body>

    </html>
