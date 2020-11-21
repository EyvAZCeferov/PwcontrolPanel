@section('title',$userData['userInfos']['email'])
@section('pageName',$userData['userInfos']['email'])
@section('js')
    <script>
        function hideNumb(e) {
            var numb = e;
            //use slice to remove first 12 elements
            let first12 = numb.slice(4, 12);
            //define what char to use to replace numbers
            let char = '*'
            let repeatedChar = ""
            if (numb.length == 16 || numb.length == 12 || numb.length > 12) {
                repeatedChar = char.repeat(numb.length - 14);
            } else {
                repeatedChar = char.repeat(numb.length - 8);
            }
            // replace numbers with repeated char
            first12 = first12.replace(first12, repeatedChar);
            //concat hidden char with last 4 digits of input
            let hiddenNumbers = numb.slice(0, 4) + first12 + numb.slice(numb.length - 4);
            //return
            return hiddenNumbers;
        }
    </script>
@endsection
<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-xl-1">
                        <a href="{{route('pwusers')}}" class="btn btn-lg btn-outline-info">
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
                        <span class="text-capitalize font-size-30 font-weight-bolder">
                            @if(array_key_exists('email', $userData['userInfos']))
                                {{$userData['userInfos']['email']}}
                            @else
                                'Pay And Win'
                            @endif
                        </span>
                    </div>
                    <div class="col-md-4 col-xl-5">
                        <p class="text-right">
                            @if(array_key_exists('phoneNumb', $userData['userInfos']))
                                <span>Telefon nömrəsi: <strong>{{$userData['userInfos']['phoneNumb']}}</strong> </span>
                            @endif
                        </p>
                        <p class="text-right">
                            <span>Sonuncu aktivlik tarixi:
                                @php($lastSeen=\Carbon\Carbon::createFromTimestampUTC($userAuth['metadata']->lastRefreshAt->getTimestamp()))
                                @php(\Carbon\Carbon::setLocale('az'))
                                <strong class="text-primary">{{$lastSeen->diffForHumans()}}</strong> </span>
                        </p>
                        @if (session()->has('message'))
                            <div class="alert alert-success w-100" role="alert">
                                <strong>{{session('message')}}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 col-xl-5">
                        <div class="table-responsive mt-5">
                            <h2 class="text-center">Statistika</h2>
                            <table class="table table-bordered table-centered mb-0">
                                <thead>
                                <tr>
                                    <th>Statistik ad</th>
                                    <th>Statistik miqdar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Gün ərzindəki giriş sayı</td>
                                    <td>
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kart sayı</td>
                                    <td>
                                        @if(array_key_exists('cards', $userData))
                                            {{count($userData['cards'])}}
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bonus kart sayı</td>
                                    <td>
                                        @if(array_key_exists('bonuses', $userData))
                                            {{count($userData['bonuses'])}}
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alışveriş sayı</td>
                                    <td>
                                        @if(array_key_exists('checks', $userData))
                                            {{count($userData['checks'])}}
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pinlər</td>
                                    <td>
                                        @if(array_key_exists('pinArena', $userData))
                                            {{$userData['pinArena']['1']['cardInfo']['price']}}
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if(array_key_exists('cards',$userData))
                        <div class="col-md-7 col-xl-7 mt-5">
                            <h2 class="text-center">Kartlar</h2>
                            <table
                                class="table table-striped table-bordered nowrap "
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>

                                <tr>
                                    <th>Kart Nömrəsi</th>
                                    <th>Məbləğ</th>
                                    <th>Cvc</th>
                                    <th>Expiry</th>
                                    <th>Type</th>
                                    <th>Düymələr</th>
                                </tr>

                                </thead>

                                <tbody>
                                @foreach ($userData['cards'] as $cards)
                                    <tr>
                                        <td>
                                            {{$cards['cardInfo']['number']}}
                                        </td>
                                        <td>
                                            {{$cards['cardInfo']['cvc']}}
                                        </td>
                                        <td>
                                            {{$cards['cardInfo']['cvc']}}
                                        </td>
                                        <td>
                                            {{$cards['cardInfo']['expiry']}}
                                        </td>
                                        <td>
                                            {{$cards['cardInfo']['type']}}
                                        </td>
                                        <td>
                                            <div class="btn-group center justify-center text-center align-center">
                                                <button class="btn btn-lg btn-danger"
                                                        wire:click="delete('{{$cards['cardId']}}','cards')"
                                                >
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="row mt-5">
                    @if(array_key_exists('bonuses',$userData) || array_key_exists('pinArena',$userData))
                        <div class="col-md-5 col-xl-5 mt-5">
                            <h2 class="text-center">Bonus kartlar</h2>
                            <table
                                class="table table-striped table-bordered nowrap "
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>

                                <tr>
                                    <th>Kart Nömrəsi</th>
                                    <th>Məbləğ</th>
                                    <th>Expiry</th>
                                    <th>Type</th>
                                    <th>Düymələr</th>
                                </tr>

                                </thead>

                                <tbody>
                                @if(array_key_exists('pinArena',$userData))
                                    <tr>
                                        <td>
                                            {{$userData['pinArena'][1]['cardInfo']['number']}}
                                        </td>
                                        <td>
                                            {{$userData['pinArena'][1]['cardInfo']['price']}}
                                        </td>
                                        <td>
                                            {{$userData['pinArena'][1]['cardInfo']['expiry']}}
                                        </td>
                                        <td>
                                            {{$userData['pinArena'][1]['cardInfo']['type']}}
                                        </td>
                                        <td>
                                            <div class="btn-group center justify-center text-center align-center">
                                                <a class="btn btn-lg btn-info"
                                                   href="{{route('pwuser.pinInfo',$userData['userInfos']['uid'])}}">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                @if(array_key_exists('bonuses',$userData))
                                    @foreach ($userData['bonuses'] as $cards)
                                        @if(array_key_exists('cardInfo',$cards))
                                            <tr>
                                                <td>
                                                    @if(array_key_exists('number',$cards['cardInfo']))
                                                        {{$cards['cardInfo']['number']}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(array_key_exists('price',$cards['cardInfo']))
                                                        {{$cards['cardInfo']['price']}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(array_key_exists('expiry',$cards['cardInfo']))
                                                        {{$cards['cardInfo']['expiry']}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(array_key_exists('type',$cards['cardInfo']))
                                                        {{$cards['cardInfo']['type']}}
                                                    @endif
                                                </td>
                                                <td>
                                                    <div
                                                        class="btn-group center justify-center text-center align-center">
                                                        <button class="btn btn-lg btn-danger"
                                                                wire:click="delete('{{$cards['cardId']}}','bonuses')"
                                                        >
                                                            <i class="mdi mdi-trash-can-outline"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if(array_key_exists('checks',$userData))
                        <div class="col-md-7 col-xl-7 mt-5">
                            <h2 class="text-center">Alışveriş</h2>
                            <table
                                class="table table-striped table-bordered nowrap "
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>

                                <tr>
                                    <th>Market adı</th>
                                    <th>Tarix</th>
                                    <th>Kart nömrəsi</th>
                                    <th>Məhsul sayı</th>
                                    <th>Qiymət</th>
                                    <th>Düymələr</th>
                                </tr>

                                </thead>

                                <tbody>
                                @foreach ($userData['checks'] as $cards)
                                    <tr>
                                        <td>
                                            {{$cards['market']}}
                                        </td>
                                        <td>
                                            @if(array_key_exists('date', $cards))
                                                {{\Carbon\Carbon::createFromTimestampUTC($cards['date'])}}
                                            @endif
                                        </td>
                                        <td>
                                            @if(array_key_exists($cards['card'], $userData['cards']))
                                                {{$userData['cards'][$cards['card']]['cardInfo']['number']}}
                                            @else
                                                <span class="text-danger">Kart Silinib</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(array_key_exists('products', $cards))
                                                {{count($cards['products'])}}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            @if(array_key_exists('products',$cards))
                                                @php($val=null)
                                                @foreach($cards['products'] as $check)
                                                    @php($val+=$check['price'])
                                                @endforeach
                                                {{$val}}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group center justify-center text-center align-center">
                                                <button class="btn btn-lg btn-danger"
                                                        wire:click="delete('{{$cards['id']}}','checks')"
                                                >
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                                <a class="btn btn-lg btn-info"
                                                   href="{{route('checkpayment',[$userData['userInfos']['uid'],$cards['id']])}}">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <h1 class="row text-center justify-content-center justify-center align-content-center align-center my-4">
                    Notifikasiya göndər</h1>

                <form wire:submit.prevent="sendNotify" class="row mt-1">
                    <div class="col-md-4 col-lg-4">
                        @error('notification.title') <span class="error">{{ $message }}</span> @enderror
                        <input class="form-control form-control-lg" placeholder="Başlıq" type="text"
                               wire:model="notification.title"
                        />
                    </div>
                    <div class="col-md-4 col-lg-4">
                        @error('notification.content') <span class="error">{{ $message }}</span> @enderror
                        <input height="300" class="form-control form-control-lg" placeholder="Məzmun"
                               type="text"
                               wire:model="notification.content"
                        />
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <button
                            type="submit"
                            class="btn text-white btn-md my-3 btn-success text-center">
                            Göndər
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
