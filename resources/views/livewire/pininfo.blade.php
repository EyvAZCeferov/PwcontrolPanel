@section('title',$userData['userInfos']['email'])
@section('pageName')
    @lang('static.pages.pininfo.title',['user'=>$userData['userInfos']['email']])
@endsection
<div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-xl-1">
                        <a href="{{route('pwuserinfo',$userData['userInfos']['uid'])}}"
                           class="btn btn-lg btn-outline-info">
                            <i class="mdi mdi-keyboard-backspace"></i>
                        </a>
                    </div>
                    <div class="col-md-4 col-xl-4">
                        @if(array_key_exists('profPic', $userData['userInfos']))
                            <img src="{{$userData['userInfos']['profPic']}}"
                                 alt="{{$userData['userInfos']['email']}}" class="rounded-circle avatar-md">
                        @else
                            <img src="{{asset('assets/commons/images/icon-ios.png')}}"
                                 alt="Pw Logo" class="rounded-circle avatar-md">
                        @endif
                        <span class="text-capitalize font-size-30 font-weight-bolder"> @if(array_key_exists('email', $userData['userInfos']))
                                {{$userData['userInfos']['email']}}
                            @else
                                'Pay And Win'
                            @endif
                        </span>
                    </div>
                    <div class="col-md-4 col-xl-5 right flex-row-reverse text-right ">
                        <p class="text-right">
                            @if(array_key_exists('phoneNumb', $userData['userInfos']))
                                <span
                                    class="font-size-15">Telefon nömrəsi: <strong>{{$userData['userInfos']['phoneNumb']}}</strong> </span>
                            @endif
                        </p>
                        <p class="text-right">
                            <span>Sonuncu aktivlik tarixi:
                                @php($lastSeen=\Carbon\Carbon::createFromTimestampUTC($userAuth['metadata']->lastLoginAt->getTimestamp()))
                                @php(\Carbon\Carbon::setLocale('az'))
                                <strong class="text-primary">{{$lastSeen->diffForHumans()}}</strong> </span>
                        </p>
                        <p class="text-right">
                            @if(array_key_exists('pinArena', $userData))
                                <span
                                    class="font-size-15">Pinlərinin sayı: <strong>{{$userData['pinArena'][1]['cardInfo']['price']}}</strong> </span>
                            @endif
                        </p>
                        <p class="text-right">
                            <button wire:click="resetPin" class="btn btn-danger btn-lg" data-toggle="tooltip"
                                    data-placement="top" title="Məlumatları sil">
                                <i class="mdi mdi-database-remove"></i>
                            </button>
                        </p>
                        @if (session()->has('message'))
                            <div class="alert alert-success w-100" role="alert">
                                <strong>{{session('message')}}</strong>
                            </div>
                        @endif
                        <div wire:loading>
                            <div class="alert alert-info" role="alert">
                                <strong>@lang('static.actions.processing')</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-5 py-5 px-4">

                            <div class="row">
                                <div class="col-12">
                                    <div class="panel panel-default">
                                        <div class="p-2">
                                            <h3 class="panel-title font-size-20">
                                                <strong>@lang('static.pages.pininfo.bonushistory')</strong>
                                            </h3>
                                        </div>
                                        @if (array_key_exists('shoppings',$userData['pinArena'][1]))
                                            <div>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <td>
                                                                <strong>@lang('static.pages.usercheck.organization')</strong>
                                                            </td>
                                                            <td class="text-center">
                                                                <strong>@lang('static.pages.usercheck.qyt')</strong>
                                                            </td>
                                                            <td class="text-center">
                                                                <strong>@lang('static.pages.dashboard.latesttransactions.price')</strong>
                                                            </td>
                                                            <td class="text-center">
                                                                <strong>@lang('static.pages.dashboard.latesttransactions.date')</strong>
                                                            </td>
                                                            <td class="text-right">
                                                                <strong>@lang('static.pages.pininfo.bonus')</strong>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($userData['pinArena'][1]['shoppings'] as $shop)
                                                            <tr>
                                                                <td>
                                                                    @if(array_key_exists($shop['checkId'],$userData['checks']))
                                                                        {{$userData['checks'][$shop['checkId']]['market']}}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if(array_key_exists('checks',$shop))
                                                                        {{count($shop['checks'])}}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if(array_key_exists('checks',$shop))
                                                                        @php($val=null)
                                                                        @foreach($shop['checks'] as $check)
                                                                            @php($val+=$check['price'])
                                                                        @endforeach
                                                                        {{$val}}
                                                                    @else
                                                                        0
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    {{\Carbon\Carbon::createFromTimestampUTC($shop['date'])}}
                                                                </td>
                                                                <td class="text-right">
                                                                    {{$shop['bonuse']}}
                                                                    <i class="mdi mdi-arrow-up text-primary"></i>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="d-print-none">
                                                    <div class="float-right">
                                                        <a href="javascript:window.print()"
                                                           class="btn btn-success waves-effect waves-light"><i
                                                                class="fa fa-print"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-danger w-100" role="alert">
                                                <strong>Tarixçə boşdur</strong>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <!-- end row -->

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-5 py-5 px-4">

                            <div class="row">
                                <div class="col-12">
                                    <div class="panel panel-default">
                                        <div class="p-2">
                                            <h3 class="panel-title font-size-20"><strong>Ödəniş tarixçəsi</strong>
                                            </h3>
                                        </div>
                                        @if (array_key_exists('ordering',$userData['pinArena'][1]))
                                            <div>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <td><strong>Qurum</strong></td>
                                                            <td class="text-center"><strong>Miqdar</strong></td>
                                                            <td class="text-center"><strong>Qiymət</strong>
                                                            </td>
                                                            <td class="text-center"><strong>Tarix</strong>
                                                            </td>
                                                            <td class="text-right"><strong>Bonus</strong></td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($userData['pinArena'][1]['ordering'] as $shop)
                                                            <tr>
                                                                <td>
                                                                    @if(array_key_exists($shop['checkId'],$userData['checks']))
                                                                        {{$userData['checks'][$shop['checkId']]['market']}}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if(array_key_exists('checks',$shop))
                                                                        {{count($shop['checks'])}}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if(array_key_exists('checks',$shop))
                                                                        @php($val=null)
                                                                        @foreach($shop['checks'] as $check)
                                                                            @php($val+=$check['price'])
                                                                        @endforeach
                                                                        {{$val}}
                                                                    @else
                                                                        0
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    {{\Carbon\Carbon::createFromTimestampUTC($shop['date'])}}
                                                                </td>
                                                                <td class="text-right">
                                                                    {{$shop['bonuse']}}
                                                                    <i class="mdi mdi-arrow-down text-danger"></i>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="d-print-none">
                                                    <div class="float-right">
                                                        <a href="javascript:window.print()"
                                                           class="btn btn-success waves-effect waves-light"><i
                                                                class="fa fa-print"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-danger w-100" role="alert">
                                                <strong>Tarixçə boşdur</strong>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <!-- end row -->

                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
</div>
