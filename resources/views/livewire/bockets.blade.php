@section('title')
    @lang('static.pages.bucket.title')
@endsection
@section('pageName')
    @lang('static.pages.bucket.title')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{asset('/assets/admin/cssjslib/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('/assets/admin/cssjslib/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}"
          rel="stylesheet"
          type="text/css"/>

    <!-- Responsive datatable examples -->
    <link
        href="{{asset('/assets/admin/cssjslib/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
        rel="stylesheet"
        type="text/css"/>
@endsection
@section('js')
    <!-- Required datatable js -->
    <script src="{{asset('/assets/admin/cssjslib/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/assets/admin/cssjslib/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{asset('/assets/admin/cssjslib/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script
        src="{{asset('/assets/admin/cssjslib/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/assets/admin/cssjslib/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('/assets/admin/cssjslib/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('/assets/admin/cssjslib/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('/assets/admin/cssjslib/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('/assets/admin/cssjslib/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('/assets/admin/cssjslib/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Responsive examples -->
    <script
        src="{{asset('/assets/admin/cssjslib/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script
        src="{{asset('/assets/admin/cssjslib/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{asset('/assets/admin/cssjslib/js/pages/datatables.init.js')}}"></script>
    <script src="{{asset('/assets/admin/cssjslib/libs/node-waves/waves.min.js')}}"></script>
@endsection
<div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if (session()->has('message'))
                                    <div class="alert alert-info" role="alert">
                                        <strong>{{session('message')}}</strong>
                                    </div>
                                @endif

                                <div wire:loading>
                                    <div class="alert alert-info" role="alert">
                                        <strong>@lang('static.actions.processing')</strong>
                                    </div>
                                </div>
                            </div>

                            <table id="datatable-buttons"
                                   class="table table-striped table-bordered dt-responsive nowrap mdi-null"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>

                                <tr>
                                    <th>@lang('static.formFields.labels.name')</th>
                                    <th>@lang('static.pages.usercheck.checkinfo.numberofproducts')</th>
                                    <th>@lang('static.pages.bucket.endtime')</th>
                                    <th>@lang('static.pages.usercheck.checkinfo.totalprice')</th>
                                    @if(auth()->user()->role==3 || auth()->user()->role==4)
                                        <th>@lang('static.actions.buttons')</th>
                                    @endif
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($buckets as $bucket)
                                    <tr>
                                        <td>
                                            {{$bucket->profileName}}
                                        </td>
                                        <td>
                                            {{count($bucket->products)}}
                                        </td>
                                        <td>
                                           <span
                                               class="text-danger">{{\Carbon\Carbon::createFromTimestamp($bucket->endTime)}}</span>
                                        </td>
                                        <td>
                                            {{$bucket->price}}
                                        </td>
                                        <td>
                                            <div
                                                class="btn-group center justify-center text-center align-center">
                                                <button class="btn btn-lg btn-danger"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="@lang('static.actions.cancel')"
                                                        wire:click="cancel('{{$bucket->id}}')"
                                                >
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                                <button class="btn btn-lg btn-warning waves-effect waves-light"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="@lang('static.actions.prepare')"
                                                        wire:click="prepare('{{$bucket->id}}')"
                                                >
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                                <button class="btn btn-lg btn-warning waves-effect waves-light"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="@lang('static.actions.ready')"
                                                        wire:click="ready('{{$bucket->id}}')"
                                                >
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                                <a
                                                    data-toggle="tooltip"
                                                    data-placement="top" title="@lang('static.actions.more')"
                                                    class="btn btn-lg btn-info waves-effect waves-light"
                                                    href={{route('bucketsBrowse',$bucket->id)}}
                                                >
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
