@section('title',$userData->name)
@section('pageName')
    @lang('static.pages.pininfo.title',['user'=>$userData->name])
@endsection
<div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-xl-1">
                        <a href="{{route('pwuserinfo',$userData->uid)}}"
                           class="btn btn-lg btn-outline-info">
                            <i class="mdi mdi-keyboard-backspace"></i>
                        </a>
                    </div>
                    <div class="col-md-4 col-xl-4">
                        @if(property_exists($userData,'profilePhoto'))
                            <img src="{{asset('uploads/users/'.$userData->profilePhoto)}}"
                                    alt="{{$userData->name}}"
                                    class="rounded-circle avatar-md">
                        @else
                            <img src="{{asset('assets/commons/images/icon-ios.png')}}"
                                    alt="Pw Logo" class="rounded-circle avatar-md">
                        @endif
                        <span class="text-capitalize font-size-30 font-weight-bolder">
                            @if($userData->name)
                                {{$userData->name}}
                            @else
                                'Pay And Win'
                            @endif
                        </span>
                    </div>
                    <div class="col-md-4 col-xl-5 right flex-row-reverse text-right ">
                        <p class="text-right">

                        <span
                            class="font-size-15">Telefon nömrəsi: <strong>{{$userData->phoneNumber}}</strong> </span>
                        </p>
                        <p class="text-right">
                            <span>Sonuncu aktivlik tarixi:
                                @php($lastSeen=\Carbon\Carbon::createFromTimestampUTC($userData->created_at->getTimestamp()))
                                @php(\Carbon\Carbon::setLocale('az'))
                                <strong class="text-primary">{{$lastSeen->diffForHumans()}}</strong> </span>
                        </p>
                        <p class="text-right">
                            @php($pininfos=json_decode($pininfo->cardInfos))
                            <span
                                class="font-size-15">Pinlərinin sayı:
                                 <strong>{{$pininfos->price}}</strong> </span>
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
                                        @if ($pininfo)
                                        <div>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <strong>
                                                                    @lang('static.page.profile.pininfo.table.organization')
                                                                </strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>@lang('static.page.shopping.cartlist.tableheader.qyt')</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>@lang('static.page.shopping.wishlist.tableheader.price')</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>@lang('static.page.profile.pininfo.table.date')</strong>
                                                            </th>
                                                            <th class="text-right">
                                                                <strong>@lang('static.page.profile.pininfo.table.bonus')</strong>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($payinfo as $info)
                                                            <tr>
                                                                <td>

                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('payed-product-info',) }}">
                                                                    Get</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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
                                        @if (true)
                                            <div>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    <strong>@lang('static.page.profile.pininfo.table.organization')</strong>
                                                                </th>
                                                                <th class="text-center">
                                                                    <strong>@lang('static.page.shopping.cartlist.tableheader.qyt')</strong>
                                                                </th>
                                                                <th class="text-center">
                                                                    <strong>@lang('static.page.shopping.wishlist.tableheader.price')</strong>
                                                                </th>
                                                                <th class="text-center">
                                                                    <strong>@lang('static.page.profile.pininfo.table.date')</strong>
                                                                </th>
                                                                <th class="text-right">
                                                                    <strong>@lang('static.page.profile.pininfo.table.bonus')</strong>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr></tr>
                                                        </tbody>
                                                    </table>
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
