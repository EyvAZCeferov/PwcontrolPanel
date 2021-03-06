@section('title')
    @if($urlPath)
        @if (str_contains($urlPath,'add'))
            @lang('static.actions.add') @lang('statiic.menu.customers')
        @else
            @if($customer[0])
                {{$customer[0]->az_name}}    @lang('static.actions.edit') @lang('static.menu.customers')
            @endif
        @endif
    @else
        @lang('static.actions.add') @lang('statiic.menu.customers')
    @endif
@endsection
@section('pageName')
    @if($urlPath)
        @if (str_contains($urlPath,'add'))
            @lang('static.actions.add') @lang('statiic.menu.customers')
        @else
            @if($customer[0])
                {{$customer[0]->az_name}}    @lang('static.actions.edit') @lang('static.menu.customers')
            @endif
        @endif
    @else
        @lang('static.actions.add') @lang('statiic.menu.customers')
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
                <form class="custom-validation mt-1"
                      @if (str_contains($urlPath,'edit')) wire:submit.prevent="update"
                      @else wire:submit.prevent="save" @endif>
                    <div class="row">
                        <div class="col-lg-4 col-md-3">
                            @if ( str_contains($urlPath,'edit') )
                                <div class="card">
                                    <img src="{{asset('/storage/uploads/customers/'.$customer[0]->logo)}}"
                                         class="img-fluid img-thumbnail"
                                         alt="{{$customer[0]->az_name}}"/>
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label>@lang('static.formFields.labels.changepicture')</label>
                                            <input
                                                accept="image/*"
                                                wire:model="formFields.logo"
                                                type="file"
                                            />
                                        </div>
                                        @error('formFields.logo') <span
                                            class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label>@lang('static.formFields.labels.selectpicture')</label>
                                            <input
                                                accept="image/*"
                                                wire:model="formFields.logo"
                                                type="file"
                                                required
                                            />
                                        </div>
                                        @error('formFields.logo') <span
                                            class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Müştəri adı</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'300'])</p>

                                    <input type="text" class="form-control" maxlength="300"
                                           wire:model.debounce.500ms="formFields.az_name"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$customer[0]->az_name}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.az_name') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Customer name</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'300'])</p>

                                    <input type="text" class="form-control" maxlength="300"
                                           wire:model.debounce.500ms="formFields.en_name"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$customer[0]->en_name}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.en_name') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Имя Клиента</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'300'])</p>

                                    <input type="text" class="form-control" maxlength="300"
                                           wire:model.debounce.500ms="formFields.ru_name"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$customer[0]->ru_name}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.ru_name') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Açıqlama</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'1000'])</p>

                                    <textarea row="8" class="form-control" maxlength="1000"
                                           wire:model.debounce.500ms="formFields.az_description"
                                    >
                                    @if (str_contains($urlPath,'edit'))
                                    {{$customer[0]->az_description}}
                                    @endif
                                </textarea>
                                    @error('formFields.az_description') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Description</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'1000'])</p>

                                    <textarea row="8" class="form-control" maxlength="1000"
                                           wire:model.debounce.500ms="formFields.en_description"

                                    >
                                    @if (str_contains($urlPath,'edit'))
                                    {{$customer[0]->en_description}}
                                    @endif
                                </textarea>
                                    @error('formFields.en_description') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Описание</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'1000'])</p>

                                    <textarea row="8" class="form-control" maxlength="1000"
                                           wire:model.debounce.500ms="formFields.ru_description"

                                    >
                                    @if (str_contains($urlPath,'edit'))
                                    {{$customer[0]->ru_description}}
                                    @endif
                                </textarea>
                                    @error('formFields.ru_description') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
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
