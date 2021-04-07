@section('title')
    @lang('static.menu.customers')
@endsection
@section('pageName')
    @lang('static.menu.customers')
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
                                @if($deleted)
                                    <h4 class="card-title">
                                        @lang('static.formFields.validation.deleted',['base'=>'Müştərilərin'])
                                    </h4>
                                @else
                                    <h4 class="card-title">@lang('static.formFields.validation.lists',['base'=>'Müştərilərin'])</h4>
                                @endif
                                <p class="justify-content-lg-around justify-content-md-around">
                                    @if($deleted)
                                        @lang('static.formFields.validation.indeletedlists',['base'=>'Müştərilərin'])
                                    @else
                                        @lang('static.formFields.validation.notdeletedlists',['base'=>'Müştərilərin'])
                                    @endif
                                    <a data-toggle="tooltip"
                                       data-placement="top" title="@lang('static.actions.add')"
                                       data-title="@lang('static.actions.add')"
                                       href="{{route('addCustomers')}}"
                                       class="btn btn-lg btn-outline-primary"><i
                                            class="ion ion-md-add"></i></a>
                                    <span class="d-inline-block px-5">
                                    <input wire:model="deleted"
                                           @if($deleted)
                                           checked
                                           @endif
                                           type="checkbox"
                                           id="switch1"
                                           switch="none"/>
                                    <label for="switch1" data-on-label="@lang('static.formFields.inputs.deleted')"
                                           data-off-label="@lang('static.formFields.inputs.notdeleted')"></label>
                                </span>
                                </p>

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
                                    <th>@lang('static.formFields.labels.picture')</th>
                                    <th>@lang('static.formFields.labels.name')</th>
                                    <th>@lang('static.formFields.labels.branchcount')</th>
                                    <th>@lang('static.formFields.labels.campaignscount')</th>
                                    <th>@lang('static.formFields.labels.commentcount')</th>
                                    <th>@lang('static.formFields.labels.rating')</th>
                                    <th>@lang('static.actions.buttons')</th>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>
                                            <img alt="{{$customer->logo}}"
                                                 width="100"
                                                 src="{{asset('/storage/uploads/customers/'.$customer->logo)}}">
                                        </td>
                                        <td>
                                            @if(app()->getLocale()=='az')
                                                {{$customer->az_name}}
                                            @elseif(app()->getLocale()=='en')
                                                {{$customer->en_name}}
                                            @elseif(app()->getLocale()=='ru')
                                                {{$customer->ru_name}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($customer->get_locations !==null)
                                                {{$customer->get_locations->count()}}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            @if($customer->get_posts !==null)
                                                {{$customer->get_posts->count()}}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            @if($customer->get_comments !=null || $customer->get_comments !==null || $customer->get_comments)
                                                {{ $customer->get_comments->count() }}
                                            @else
                                                <span class="text-danger">@lang('static.formFields.actions.nullData')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($customer->get_rating)
                                                @php
                                                    $ratings=$customer->get_rating;
                                                    $ratingResult=0;
                                                    $ratingSum=0;
                                                @endphp
                                                    @foreach ($customer->get_rating as $rating )
                                                        @php($ratingSum+=$rating->rating)
                                                    @endforeach
                                                    @if ($ratingResult>0)
                                                        @php($ratingResult=$ratingSum/$ratings->count())
                                                    @endif
                                                @for($i = 0; $i < 5; $i++)
                                                    @if($i<=$ratingResult)
                                                        <i class="mdi mdi-account-star-outline fa-2x"></i>
                                                    @else
                                                        <i class="dripicons-star fa-1x"></i>
                                                    @endif
                                                @endfor
                                            @else
                                                <span class="text-danger">@lang('static.formFields.actions.nullData')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($deleted)
                                                <div
                                                    class="btn-group center justify-center text-center align-center">
                                                    <button class="btn btn-lg btn-danger"
                                                            data-toggle="tooltip"
                                                            data-placement="top" title="@lang('static.actions.forcedelete')"
                                                            wire:click="hardDelete('{{$customer->id}}')"
                                                    >
                                                        <i class="mdi mdi-delete-alert"></i>
                                                    </button>
                                                    <button class="btn btn-lg btn-info"
                                                            data-toggle="tooltip"
                                                            data-placement="top" title="@lang('static.actions.recover')"
                                                            wire:click="recover('{{$customer->id}}')"
                                                    >
                                                        <i class="mdi mdi-table-refresh"></i>
                                                    </button>
                                                </div>
                                            @else
                                                <div
                                                    class="btn-group center justify-center text-center align-center">
                                                    <button class="btn btn-lg btn-danger"
                                                            data-toggle="tooltip"
                                                            data-placement="top" title="@lang('static.actions.delete')"
                                                            wire:click="delete('{{$customer->id}}')"
                                                    >
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                    <a
                                                        data-toggle="tooltip"
                                                        data-placement="top" title="@lang('static.actions.edit')"
                                                        class="btn btn-lg btn-warning waves-effect waves-light"
                                                        href={{route('editCustomers',$customer->id)}}
                                                    >
                                                        <i class="mdi mdi-circle-edit-outline"></i>
                                                    </a>
                                                </div>
                                            @endif
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
