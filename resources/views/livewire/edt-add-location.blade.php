@section('title')
    @if($urlPath)
        @if (str_contains($urlPath,'add'))
            @lang('static.actions.add') @lang('static.menu.locations')
        @else
            @if($location[0])
                {{$location[0]->az_name}}   @lang('static.actions.edit') @lang('static.menu.locations')
            @endif
        @endif
    @else
        Add Location
    @endif
@endsection
@section('pageName')
    @if($urlPath)
        @if (str_contains($urlPath,'add'))
            @lang('static.actions.add') @lang('static.menu.locations')
        @else
            @if($location[0])
                {{$location[0]->az_name}}   @lang('static.actions.edit') @lang('static.menu.locations')
            @endif
        @endif
    @else
        @lang('static.actions.add') @lang('static.menu.locations')
    @endif
@endsection
<div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    @if (session()->has('message'))
                        <div class="alert alert-warning" role="alert">
                            <strong>{{session('message')}}</strong>
                        </div>
                    @endif

                    <div wire:loading>
                        <div class="alert alert-info" role="alert">
                            <strong>@lang('static.actions.processing')</strong>
                        </div>
                    </div>
                </div>

                @if (str_contains($urlPath,'edit'))
                    <div class="w-100"
                         style="scroll-behavior: auto; overflow-scrolling: touch; overflow-y: hidden; overflow-x: scroll;">
                        @foreach(json_decode($location[0]->images) as $image)
                            <div class="d-inline-block w-25 position-relative">
                                <img
                                    src="{{asset('/storage/uploads/locations/'.$location[0]->clasor.'/'.$image)}}"
                                    class="img-fluid img-thumbnail border border-primary w-100 position-relative"
                                    alt="{{$image}}"/>
                                <button
                                    title="@lang('static.formFields.buttons.deleteimage')"
                                    wire:click="deleteImage('{{$image}}')"
                                    title="@lang('static.formFields.buttons.deleteimage')"
                                    class="btn btn-danger position-absolute top-0 right-0 "
                                    style="position: absolute;top:0;right: 0; z-index: 20"
                                >
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif

                <form class="custom-validation mt-1"
                      @if (str_contains($urlPath,'edit')) wire:submit.prevent="update"
                      @else wire:submit.prevent="save" @endif>
                    <div class="row">
                        <div class="col-lg-4 col-md-3">
                            @if ( str_contains($urlPath,'edit') )
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>@lang('static.formFields.labels.selectpictures')</label>
                                        <input
                                            accept="image/*"
                                            wire:model="formFields.images"
                                            type="file"
                                            multiple
                                        />
                                    </div>
                                    @error('formFields.images') <span
                                        class="error">{{ $message }}</span> @enderror
                                </div>
                        </div>
                        @else
                            <div class="card">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label>@lang('static.formFields.labels.selectpictures')</label>
                                        <input
                                            accept="image/*"
                                            wire:model="formFields.images"
                                            type="file"
                                            required
                                            multiple
                                        />
                                    </div>
                                    @error('formFields.images') <span
                                        class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-4 col-md-3">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Açıqlama</h4>
                                <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'1000'])</p>

                                <input type="text" class="form-control" maxlength="1000"
                                       wire:model.debounce.500ms="formFields.az_description"
                                       @if (str_contains($urlPath,'edit'))
                                       value="{{$location[0]->az_description}}"
                                       @else
                                       name="defaultconfig"
                                       id="defaultconfig"
                                    @endif
                                />
                                @error('formFields.az_description') <span
                                    class="error">{{ $message }}</span> @enderror

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Description</h4>
                                <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'1000'])</p>

                                <input type="text" class="form-control" maxlength="1000"
                                       wire:model.debounce.500ms="formFields.en_description"
                                       @if (str_contains($urlPath,'edit'))
                                       value="{{$location[0]->en_description}}"
                                       @else
                                       name="defaultconfig"
                                       id="defaultconfig"
                                    @endif
                                />
                                @error('formFields.en_description') <span
                                    class="error">{{ $message }}</span> @enderror

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Описание</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'1000'])</p>

                                    <input type="text" class="form-control" maxlength="1000"
                                           wire:model.debounce.500ms="formFields.ru_description"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$location[0]->ru_description}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.ru_description') <span
                                        class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Lokasiya</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'1000'])</p>

                                    <input type="text" class="form-control" maxlength="1000"
                                           wire:model.debounce.500ms="formFields.az_location"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$location[0]->az_location}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.az_location') <span
                                        class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Location</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'1000'])</p>

                                    <input type="text" class="form-control" maxlength="1000"
                                           wire:model.debounce.500ms="formFields.en_location"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$location[0]->en_location}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.en_location') <span
                                        class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Место расположения</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'1000'])</p>

                                    <input type="text" class="form-control" maxlength="1000"
                                           wire:model.debounce.500ms="formFields.ru_location"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$location[0]->ru_location}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.ru_location') <span
                                        class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Koordinatlar </h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'50'])</p>
                                    <div class="w-100 d-block d-flex justify-content-around">
                                        <div class="w-50 d-inline-block">
                                            <h4 class="card-title">Longitude </h4>
                                            <input type="text" class="form-control" maxlength="50"
                                                   wire:model.debounce.500ms="formFields.geometry.longitude"
                                                   @if (str_contains($urlPath,'edit'))
                                                   @php($latitude=json_decode($location[0]->geometry))
                                                   value="{{$latitude->longitude}}"
                                                   @else
                                                   name="defaultconfig"
                                                   id="defaultconfig"
                                                @endif
                                            />
                                            @error('formFields.geometry.longitude') <span
                                                class="error">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="w-50 d-inline-block">
                                            <h4 class="card-title">Latitude </h4>
                                            <input type="text" class="form-control" maxlength="50"
                                                   wire:model.debounce.500ms="formFields.geometry.latitude"
                                                   @if (str_contains($urlPath,'edit'))
                                                   @php($latitude=json_decode($location[0]->geometry))
                                                   value="{{$latitude->latitude}}"
                                                   @else
                                                   name="defaultconfig"
                                                   id="defaultconfig"
                                                @endif
                                            />
                                            @error('formFields.geometry.latitude') <span
                                                class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">@lang('static.formFields.labels.select.selectcustomer') </h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.select',['role'=>'Müştərini'])</p>
                                    <select class="form-control" wire:model="formFields.customer_id">
                                        @if(str_contains($urlPath,'edit'))
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}"
                                                        @if($customer->id == $location[0]->customer_id)
                                                        selected
                                                        value="{{$location[0]->customer_id}}"
                                                    @endif
                                                >
                                                    @if(app()->getLocale()=='az')
                                                        {{$customer['az_name']}}
                                                    @elseif(app()->getLocale()=='en')
                                                        {{$customer['en_name']}}
                                                    @elseif(app()->getLocale()=='ru')
                                                        {{$customer['ru_name']}}
                                                    @endif
                                                </option>
                                            @endforeach
                                        @else
                                            <option selected value="">Müştəri seç</option>
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}">
                                                    @if(app()->getLocale()=='az')
                                                        {{$customer['az_name']}}
                                                    @elseif(app()->getLocale()=='en')
                                                        {{$customer['en_name']}}
                                                    @elseif(app()->getLocale()=='ru')
                                                        {{$customer['ru_name']}}
                                                    @endif
                                                </option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @error('formFields.customer_id') <span
                                        class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row justify-center align-center text-center">
                        <div class="col-lg-4 col-md-6 justify-center align-center text-center ">
                            <button type="submit"
                                    class="justify-center mx-auto align-center text-center btn-lg btn btn-outline-primary"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    @if(str_contains($urlPath,'add'))
                                    title="@lang('static.actions.add')"
                                    data-title="@lang('static.actions.add')"
                                    @else
                                    title="@lang('static.actions.edit')"
                                    data-title="@lang('static.actions.edit')"
                                @endif
                            >
                                @if(str_contains($urlPath,'add'))
                                    <i class="mdi mdi-content-save font-size-24"></i>
                                @else
                                    <i class="mdi mdi-lead-pencil font-size-24"></i>
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
