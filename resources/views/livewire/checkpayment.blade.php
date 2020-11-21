@php($date=\Carbon\Carbon::createFromTimestampUTC($check['date']))
@section('title')
    @lang('static.pages.usercheck.title',['time'=>$date,'user'=>$userData['userInfos']['email']])
@endsection
@section('pageName')
    @lang('static.pages.usercheck.title',['time'=>$date,'user'=>$userData['userInfos']['email']])
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
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-5 py-5 px-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">
                                        <h4 class="float-right font-size-16">
                                            <strong>@lang('static.pages.usercheck.checkinfo.sellid',['id'=>$check['id']])</strong>
                                            <a rel="nofollow"
                                               target="_blank"
                                               data-toggle="tooltip"
                                               data-placement="top" title="@lang('static.actions.more')"
                                               href="https://monitoring.e-kassa.gov.az/#/index?doc={{$check['id']}}"
                                               class="btn btn-outline-info"><i class="mdi mdi-eye-outline"></i></a>
                                        </h4>
                                        <h3 class="mt-0">
                                            <img
                                                src="{{asset('/assets/commons/images/market/'.$check['market'].'.png')}}"
                                                alt="{{$check['market']}}" height="70"/>
                                        </h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <address>
                                                <strong>@lang('static.pages.usercheck.checkinfo.organization'):</strong><br>
                                                {{$check['market']}} Market məhdud məsuliyyətli cəmiyyəti<br>
                                                AZ5008 {{$check['market']}} SUMQAYIT ŞƏHƏRİ MƏH 41A ev.- m.KOROĞLU
                                                PROSPEKTİ <br>
                                                @lang('static.pages.usercheck.checkinfo.objectcode'): 1001994141-29008
                                            </address>
                                        </div>
                                        <div class="col-6 text-right">
                                            <address>
                                                <strong>@lang('static.pages.usercheck.checkinfo.sellabout')
                                                    :</strong><br>
                                                @lang('static.pages.usercheck.checkinfo.numberofproducts'):
                                                @if(array_key_exists('products', $check))
                                                    {{count($check['products'])}}
                                                @else
                                                    0
                                                @endif <br>
                                                @lang('static.pages.usercheck.checkinfo.totalprice') :
                                                @if(array_key_exists('products',$check))
                                                    @php($val=null)
                                                    @foreach($check['products'] as $chec)
                                                        @php($val+=$chec['price'])
                                                    @endforeach
                                                    {{$val}}
                                                @else
                                                    0
                                                @endif ₼
                                                <br>
                                                Ədv *18% -
                                                @if(array_key_exists('products',$check))
                                                    @php($val=null)
                                                    @foreach($check['products'] as $chec)
                                                        @php($val+=$chec['price'])
                                                    @endforeach
                                                    {{$val*18/100}}
                                                @else
                                                    0
                                                @endif ₼
                                            </address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mt-4">
                                            <address>
                                                <strong>@lang('static.pages.usercheck.checkinfo.paymentmethod')
                                                    :</strong><br>
                                                @lang('static.pages.usercheck.checkinfo.online')
                                                - @lang('static.pages.usercheck.checkinfo.withcard') -
                                                @if(array_key_exists($check['card'], $userData['cards']))
                                                    {{$userData['cards'][$check['card']]['cardInfo']['number']}}
                                                @else
                                                    <span
                                                        class="text-danger">@lang('static.pages.usercheck.checkinfo.carddeleted')</span>
                                                @endif
                                            </address>
                                        </div>
                                        <div class="col-6 mt-4 text-right">
                                            <address>
                                                <strong>@lang('static.pages.dashboard.latesttransactions.date')
                                                    :</strong><br>
                                                {{$date}}<br><br>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="panel panel-default">
                                        <div class="p-2">
                                            <h3 class="panel-title font-size-20">
                                                <strong>@lang('static.pages.usercheck.checkinfo.products')</strong>
                                            </h3>
                                        </div>
                                        @if (array_key_exists('products',$check))
                                            <div>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <td><strong>@lang('static.formFields.labels.name')</strong>
                                                            </td>
                                                            <td>
                                                                <strong>@lang('static.pages.usercheck.checkinfo.barcode')</strong>
                                                            </td>
                                                            <td class="text-center">
                                                                <strong>@lang('static.pages.usercheck.checkinfo.qyt')</strong>
                                                            </td>
                                                            <td class="text-center">
                                                                <strong>@lang('static.pages.dashboard.latesttransactions.price')</strong>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($check['products'] as $shop)
                                                            <tr>
                                                                <td>
                                                                    @if(array_key_exists('name',$shop))
                                                                        {{$shop['name']}}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if(array_key_exists('barcode',$shop))
                                                                        {{$shop['barcode']}}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if(array_key_exists('qty',$shop))
                                                                        {{$shop['qty']}}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if(array_key_exists('price',$shop))
                                                                        {{$shop['price']}}
                                                                    @endif
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
                                                <strong>@lang('static.formFields.actions.nullData')</strong>
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
