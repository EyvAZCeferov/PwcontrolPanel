@section('title','Səbət')
@section('pageName','Səbət')
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
                                    <h4 class="card-title">Səbət siyahısının silinmiş siyahısı</h4>
                                @else
                                    <h4 class="card-title">Səbət siyahısının siyahısı</h4>
                                @endif
                                <p class="justify-content-lg-around justify-content-md-around">
                                    @if($deleted)
                                        Bu siyahıda bazadan silinmiş səbət siyahısının siyahılarına nəzarət edə
                                        məlumatlarını
                                        geri qaytara, və ya birdəfəlik silə bilərsiniz.
                                    @else
                                        Bu siyahıda səbət siyahısının siyahılarına nəzarət edə əlavə edə bilərsiniz.
                                    @endif
                                    <span class="d-inline-block px-5">
                                    <input wire:model="deleted"
                                           @if($deleted)
                                           checked
                                           @endif
                                           type="checkbox"
                                           id="switch1"
                                           switch="none"/>
                                    <label for="switch1" data-on-label="Silinənlər"
                                           data-off-label="Silinməyənlər"></label>
                                </span>
                                </p>

                                @if (session()->has('message'))
                                    <div class="alert alert-info" role="alert">
                                        <strong>{{session('message')}}</strong>
                                    </div>
                                @endif

                                <div wire:loading>
                                    <div class="alert alert-info" role="alert">
                                        <strong>Əməliyyat icra edilir...</strong>
                                    </div>
                                </div>
                            </div>

                            <table id="datatable-buttons"
                                   class="table table-striped table-bordered dt-responsive nowrap mdi-null"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>

                                <tr>
                                    <th>Şəkil</th>
                                    <th>Ad</th>
                                    <th>Kateqoriya</th>
                                    <th>Müştəri</th>
                                    <th>Alınma sayı</th>
                                    <th>Qiymət</th>
                                    <th>Düymələr</th>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($buckets as $bucket)
                                    <tr>
                                        <td>
                                            <img alt="{{$bucket}}"
                                                 width="100"
                                                 src="{{asset('/storage/uploads/buckets/'.$bucket[0]->clasor.'/'.$bucket->icon)}}">
                                        </td>
                                        <td>
                                            {{$bucket->az_name}}
                                        </td>
                                        <td>
                                            @if($campaign->getCat)
                                                {{$campaign->getCat->az_name}}
                                            @else
                                                <span class="text-danger">Kateqoriya yoxdur</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($campaign->getCustomer)
                                                {{$campaign->getCustomer->az_name}}
                                            @else
                                                <span class="text-danger">Müştəri yoxdur</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{$campaign->read_count}}
                                        </td>
                                        <td>
                                            <span class="text-primary">
                                                {{\Carbon\Carbon::createFromTimestamp($campaign->startTime)}}
                                            </span>
                                            &nbsp;
                                            <span class="text-secondary">-</span>
                                            &nbsp;
                                            <span
                                                class="text-danger">{{\Carbon\Carbon::createFromTimestamp($campaign->endTime)}}</span>
                                        </td>
                                        <td>
                                            {{$campaign->price}}
                                        </td>
                                        <td>
                                            @if($deleted)
                                                <div
                                                    class="btn-group center justify-center text-center align-center">
                                                    <button class="btn btn-lg btn-danger"
                                                            data-toggle="tooltip"
                                                            data-placement="top" title="Sil! Geri qaytarılmır!"
                                                            wire:click="hardDelete('{{$campaign->id}}')"
                                                    >
                                                        <i class="mdi mdi-delete-alert"></i>
                                                    </button>
                                                    <button class="btn btn-lg btn-info"
                                                            data-toggle="tooltip"
                                                            data-placement="top" title="Geri qaytar!"
                                                            wire:click="recover('{{$campaign->id}}')"
                                                    >
                                                        <i class="mdi mdi-table-refresh"></i>
                                                    </button>
                                                </div>
                                            @else
                                                <div
                                                    class="btn-group center justify-center text-center align-center">
                                                    <button class="btn btn-lg btn-danger"
                                                            data-toggle="tooltip"
                                                            data-placement="top" title="Sil"
                                                            wire:click="delete('{{$campaign->id}}')"
                                                    >
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                    <a
                                                        data-toggle="tooltip"
                                                        data-placement="top" title="Dəyişiklik et!"
                                                        class="btn btn-lg btn-warning waves-effect waves-light"
                                                        href={{route('postsEdit',$campaign->id)}}
                                                    >
                                                        <i class="mdi mdi-circle-edit-outline"></i>
                                                    </a>
                                                    <a
                                                        data-toggle="tooltip"
                                                        data-placement="top" title="Daha çox.."
                                                        class="btn btn-lg btn-info waves-effect waves-light"
                                                        href={{route('postsBrowse',$campaign->id)}}
                                                    >
                                                        <i class="mdi mdi-eye-outline"></i>
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
