@section('title','Pw Users')
@section('pageName','Pw Users')
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

                                <h4 class="card-title">Pay And Win istifadəçilər siyahısı</h4>
                                <p>
                                    Bu Siyahıdan istifadəçilərin vəziyyətini yoxlaya bilərsiniz.
                                </p>

                                @if (session()->has('message'))
                                    <div class="alert alert-warning" role="alert">
                                        <strong>{{session('message')}}</strong>
                                    </div>
                                @endif

                                <div wire:loading>
                                    <div class="alert alert-info" role="alert">
                                        <strong>Əməliyyat icra edilir...</strong>
                                    </div>
                                </div>

                                <table id="datatable-buttons"
                                       class="table table-striped table-bordered dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                    <thead>

                                    <tr>
                                        <th>Profil şəkli</th>
                                        <th>Ad soyad</th>
                                        <th>Telefon nömrəsi</th>
                                        <th>Kart sayı</th>
                                        <th>Alışveriş sayı</th>
                                        <th>Pin</th>
                                        <th>Qeydiyyat tarixi</th>
                                        <th>Düymələr</th>
                                    </tr>

                                    </thead>

                                    <tbody>
                                    @foreach ($users as $user)
                                        @if($user->disabled)
                                            <tr disabled aria-disabled="disabled" class="disabled bg-soft-dark">
                                                <td>
                                                    @if(array_key_exists('profPic',$userDatas[$user->uid]['userInfos']))
                                                        <img src="{{$userDatas[$user->uid]['userInfos']['profPic']}}"
                                                             alt="{{$user->email}}"
                                                             class="rounded-circle avatar-md">
                                                    @else
                                                        <img src="{{asset('assets/commons/images/icon-ios.png')}}"
                                                             alt="Pw Logo" class="rounded-circle avatar-md">
                                                    @endif
                                                </td>
                                                <td class="text-muted">
                                                    @if($user->email)
                                                        {{$user->email}}
                                                    @else
                                                        'Pay And Win'
                                                    @endif
                                                </td>
                                                <td class="text-muted">
                                                    @if($user->phoneNumber)
                                                        {{$user->phoneNumber}}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="text-muted">
                                                    @if(array_key_exists('cards', $userDatas[$user->uid]))
                                                        @php($cardCount=0)
                                                        @if(array_key_exists('bonuses', $userDatas[$user->uid]))
                                                            @php($cardCount+=count($userDatas[$user->uid]['bonuses']))
                                                        @endif
                                                        @php($cardCount+=count($userDatas[$user->uid]['cards']))
                                                        {{$cardCount}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td class="text-muted">
                                                    @if(array_key_exists('checks', $userDatas[$user->uid]))
                                                        {{count($userDatas[$user->uid]['checks'])}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td class="text-muted">
                                                    @if(array_key_exists('pinArena', $userDatas[$user->uid]))
                                                        {{$userDatas[$user->uid]['pinArena']['1']['cardInfo']['price']}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td class="text-muted">
                                                    {{\Carbon\Carbon::createFromTimestampUTC($user->metadata->lastRefreshAt->getTimestamp())}}
                                                </td>
                                                <td class="text-muted">
                                                    <div
                                                        class="btn-group center justify-center text-center align-center">
                                                        <button class="btn btn-lg btn-danger"
                                                                data-toggle="tooltip"
                                                                data-placement="top" title="Sil"
                                                                wire:click="delete('{{$user->uid}}')"
                                                        >
                                                            <i class="mdi mdi-trash-can-outline"></i>
                                                        </button>
                                                        <button
                                                            data-toggle="tooltip"
                                                            data-placement="top" title="Blokdan çıxart!"
                                                            class="btn btn-lg btn-primary waves-effect waves-light"
                                                            wire:click="blockorUnblock('{{$user->uid}}')"
                                                        >
                                                            <i class="mdi mdi-block-helper"></i>
                                                        </button>
                                                        <a class="btn btn-lg btn-info"
                                                           data-toggle="tooltip"
                                                           data-placement="top" title="Daha çox..."
                                                           href="{{route('pwuserinfo',$user->uid)}}">
                                                            <i class="mdi mdi-eye-outline"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>
                                                    @if(array_key_exists('profPic',$userDatas[$user->uid]['userInfos']))
                                                        <img src="{{$userDatas[$user->uid]['userInfos']['profPic']}}"
                                                             alt="{{$user->email}}"
                                                             class="rounded-circle avatar-md">
                                                    @else
                                                        <img src="{{asset('assets/commons/images/icon-ios.png')}}"
                                                             alt="Pw Logo" class="rounded-circle avatar-md">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($user->email)
                                                        {{$user->email}}
                                                    @else
                                                        'Pay And Win'
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($user->phoneNumber)
                                                        {{$user->phoneNumber}}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(array_key_exists('cards', $userDatas[$user->uid]))
                                                        @php($cardCount=0)
                                                        @if(array_key_exists('bonuses', $userDatas[$user->uid]))
                                                            @php($cardCount+=count($userDatas[$user->uid]['bonuses']))
                                                        @endif
                                                        @php($cardCount+=count($userDatas[$user->uid]['cards']))
                                                        {{$cardCount}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(array_key_exists('checks', $userDatas[$user->uid]))
                                                        {{count($userDatas[$user->uid]['checks'])}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(array_key_exists('pinArena', $userDatas[$user->uid]))
                                                        {{$userDatas[$user->uid]['pinArena']['1']['cardInfo']['price']}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    {{\Carbon\Carbon::createFromTimestampUTC($user->metadata->createdAt->getTimestamp())}}
                                                </td>
                                                <td>
                                                    <div
                                                        class="btn-group center justify-center text-center align-center">
                                                        <button class="btn btn-lg btn-danger"
                                                                data-toggle="tooltip"
                                                                data-placement="top" title="Sil"
                                                                wire:click="delete('{{$user->uid}}')"
                                                        >
                                                            <i class="mdi mdi-trash-can-outline"></i>
                                                        </button>
                                                        <button
                                                            data-toggle="tooltip"
                                                            data-placement="top" title="Blok et!"
                                                            class="btn btn-lg btn-secondary waves-effect waves-light"
                                                            wire:click="blockorUnblock('{{$user->uid}}')"
                                                        >
                                                            <i class="mdi mdi-block-helper"></i>
                                                        </button>
                                                        <a class="btn btn-lg btn-info"
                                                           data-toggle="tooltip"
                                                           data-placement="top" title="Daha çox..."
                                                           href="{{route('pwuserinfo',$user->uid)}}">
                                                            <i class="mdi mdi-eye-outline"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
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
    <!-- Modal -->
    <div class="modal fade" id="blockModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">İstifadəçini bloklayın!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>İstifadəçinin mobil applikasiyaya daxil olmasını bloklamaq üçün "Blok Et" düyməsini sıxın!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" wire:click="block" class="btn btn-danger waves-effect waves-light">Blok Et
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="unBlockModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">İstifadəçini blokdan çıxarın!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>İstifadəçinin mobil applikasiyaya daxil olmasını blokdan çıxarmaq üçün "Blokdan Çıxar" düyməsini
                        sıxın!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" wire:click="unBlock" class="btn btn-success waves-effect waves-light">Blokdan
                        Çıxar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

