@section('title',$this->post[0]->az_name.' adlı kampaniya')
@section('pageName',$this->post[0]->az_name.' adlı kampaniya')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <h1 class=" py-3 title justify-center align-center text-center">Şəkillər</h1>
                    <div class="d-block w-100 d-flex justify-content-around ">
                        @foreach (json_decode($post[0]->images) as $image)
                            <img
                                src="{{asset('/storage/uploads/posts/'.$this->post[0]->clasor.'/'.$image)}}"
                                alt="{{$image}}"
                                class="w-25 d-inline-block"/>
                        @endforeach
                    </div>
                    <div class="card-body">
                        <h2 class="py-3 justify-center align-center text-center">Məlumatlar</h2>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Ad</th>
                                <th>Name</th>
                                <th>имя</th>
                                <th>Kateqoriya</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    {{$post[0]->az_name}}
                                </td>
                                <td>
                                    {{$post[0]->en_name}}
                                </td>
                                <td>
                                    {{$post[0]->ru_name}}
                                </td>
                                <td>
                                    {{$post[0]->getCat->az_name}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Açıqlama</th>
                                <th>Description</th>
                                <th>Описание</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    {{$post[0]->az_description}}
                                </td>
                                <td>
                                    {{$post[0]->en_description}}
                                </td>
                                <td>
                                    {{$post[0]->ru_description}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <h2 class="py-3 justify-center align-center text-center">Digər məlumatlar</h2>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Baxış sayı</th>
                                <th>Kampaniya başlama tarixi</th>
                                <th>Kampaniya bitmə tarixi</th>
                                <th>Qiymət</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    {{$post[0]->read_count}}
                                </td>
                                <td>
                                    {{\Carbon\Carbon::createFromTimestampUTC($post[0]->startTime)}}
                                </td>
                                <td>
                                    {{\Carbon\Carbon::createFromTimestamp($post[0]->endTime)}}
                                </td>
                                <td>
                                    {{$post[0]->price}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
