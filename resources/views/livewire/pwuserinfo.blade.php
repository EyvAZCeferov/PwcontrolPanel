@section('title',$userData->name)
@section('pageName',$userData->name)
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
                    <div class="col-md-4 col-xl-5">
                        <p class="text-right">
                            @if(property_exists($userData,'phoneNumber'))
                                <span>Telefon nömrəsi: <strong>{{$userData->phoneNumber}}
                                </strong> </span>
                            @endif
                        </p>
                        <p class="text-right">
                            <span>Qeydiyyat tarixi:
                                @php($lastSeen=\Carbon\Carbon::createFromTimestampUTC($userData->created_at->getTimestamp()))
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
                                    <td>Kart sayı</td>
                                    <td>
                                        {{ $userData->get_cards()->where('type','<>','pin')->where('type','<>','bonuscard')->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bonus kart sayı</td>
                                    <td>
                                        {{ $userData->get_cards()->where('type','bonuscard')->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alışveriş sayı</td>
                                    <td>
                                        {{ $userData->get_payings()->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pinlər</td>
                                    <td>
                                        @php($pinCard=json_decode($userData->get_cards()->where('type','pin')->first()->cardInfos))
                                        {{ $pinCard->price }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($userData->get_cards()->where('type','<>','pin')->where('type','<>','bonuscard')->count()>0)
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
                            @foreach ($userData->get_cards()->where('type','<>','pin')->where('type','<>','bonuscard')->get() as $card)
                                <tr>
                                    @php($cardInfos=json_decode($card->cardInfos))
                                    <td>
                                        {{$cardInfos->number}}
                                    </td>
                                    <td>
                                        {{$cardInfos->cvc}}
                                    </td>
                                    <td>
                                        {{$cardInfos->price}}
                                    </td>
                                    <td>
                                        {{$cardInfos->expiry}}
                                    </td>
                                    <td>
                                        {{$cardInfos->type}}
                                    </td>
                                    <td>
                                        <div class="btn-group center justify-center text-center align-center">
                                            <button class="btn btn-lg btn-danger"
                                                    wire:click="delete('{{$card->cardId}}','cards')"
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
                <div class="row  mt-5">
                    @if($userData->get_cards()->where('type','bonuscard')->count()>0)
                    <div class="col-md-6 col-xl-6 mt-5">
                        <h2 class="text-center">Bonus Kartlar</h2>
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
                            @foreach ($userData->get_cards()->where('type','bonuscard')->get() as $card)
                                <tr>
                                    @php($cardInfos=json_decode($card->cardInfos))
                                    <td>
                                        {{$cardInfos->number}}
                                    </td>
                                    <td>
                                        {{$cardInfos->cvc}}
                                    </td>
                                    <td>
                                        {{$cardInfos->price}}
                                    </td>
                                    <td>
                                        {{$cardInfos->expiry}}
                                    </td>
                                    <td>
                                        {{$cardInfos->type}}
                                    </td>
                                    <td>
                                        <div class="btn-group center justify-center text-center align-center">
                                            <button class="btn btn-lg btn-danger"
                                                    wire:click="delete('{{$card->cardId}}','cards')"
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
                    @if($userData->get_payings()->count()>0)
                    <div class="col-md-6 col-xl-6 mt-5">
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
                            @foreach ($userData->get_payings()->get() as $pay)
                                <tr>
                                    @php($payInfos=json_decode($pay->payInfo))
                                    <td>
                                        {{$payInfos->number}}
                                    </td>
                                    <td>
                                        {{$payInfos->cvc}}
                                    </td>
                                    <td>
                                        {{$payInfos->price}}
                                    </td>
                                    <td>
                                        {{$payInfos->expiry}}
                                    </td>
                                    <td>
                                        {{$payInfos->type}}
                                    </td>
                                    <td>
                                        <div class="btn-group center justify-center text-center align-center">
                                            <button class="btn btn-lg btn-danger"
                                                    wire:click="delete('{{$pay->pay_id}}','cards')"
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
