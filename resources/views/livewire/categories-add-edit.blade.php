@section('title')
    @if($urlPath)
        @if (str_contains($urlPath,'add'))
            @lang('static.actions.add') @lang('static.menu.media.categories')
        @else
            @if($category[0])
                {{$category[0]->az_name}}   @lang('static.actions.edit') @lang('static.menu.media.categories')
            @endif
        @endif
    @else
        @lang('static.actions.add') @lang('static.menu.media.categories')
    @endif
@endsection
@section('pageName')
    @if($urlPath)
        @if (str_contains($urlPath,'add'))
            @lang('static.actions.add') @lang('static.menu.media.categories')
        @else
            @if($category[0])
                {{$category[0]->az_name}}   @lang('static.actions.edit') @lang('static.menu.media.categories')
            @endif
        @endif
    @else
        @lang('static.actions.add') @lang('static.menu.media.categories')
    @endif
@endsection
@section('js')
    @parent
    <!--tinymce js-->
    <script src="{{asset('/assets/admin/cssjslib/libs/tinymce/tinymce.min.js')}}"></script>

    <!-- init js -->
    <script src="{{asset('/assets/admin/cssjslib/js/pages/form-editor.init.js')}}"></script>
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
                                    <img
                                        src="{{asset('/storage/uploads/categories/'.$category[0]->clasor.'/'.$category[0]->icon)}}"
                                        class="img-fluid img-thumbnail"
                                        alt="{{$category[0]->az_name}}"/>
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label>@lang('static.formFields.labels.changepicture')</label>
                                            <input
                                                accept="image/*"
                                                wire:model="formFields.icon"
                                                type="file"
                                            />
                                        </div>
                                        @error('formFields.icon') <span
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
                                                wire:model="formFields.icon"
                                                type="file"
                                                required
                                            />
                                        </div>
                                        @error('formFields.icon') <span
                                            class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Ad</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'300'])</p>

                                    <input type="text" class="form-control" maxlength="300"
                                           wire:model.debounce.500ms="formFields.az_name"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$category[0]->az_name}}"
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

                                    <h4 class="card-title">Name</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'300'])</p>

                                    <input type="text" class="form-control" maxlength="300"
                                           wire:model.debounce.500ms="formFields.en_name"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$category[0]->en_name}}"
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
                        <div class="col-lg-4 col-md-3">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">имя</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'300'])</p>

                                    <input type="text" class="form-control" maxlength="300"
                                           wire:model.debounce.500ms="formFields.ru_name"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$category[0]->ru_name}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.ru_name') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Slug / Url</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'300'])</p>

                                    <input type="text" class="form-control" maxlength="300"
                                           wire:model.debounce.500ms="formFields.slug"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$category[0]->slug}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                           value="{{$formFields['slug']}}"
                                        @endif
                                    />
                                    @error('formFields.slug') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">@lang('static.formFields.labels.select.topcategory')</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.select',['role'=>'Aid olacağı kateqoriya'])</p>
                                    <select class="form-control" wire:model="formFields.top_category">
                                        @if(str_contains($urlPath,'edit'))
                                            @foreach($categories as $id_category)
                                                <option value="{{$id_category['id']}}"
                                                        @if($id_category['id'] == $category[0]->id)
                                                        selected
                                                        value="{{$category[0]->id}}"
                                                    @endif
                                                >
                                                    @if(app()->getLocale()=='az')
                                                        {{$id_category['az_name']}}
                                                    @elseif(app()->getLocale()=='en')
                                                        {{$id_category['en_name']}}
                                                    @elseif(app()->getLocale()=='ru')
                                                        {{$id_category['ru_name']}}
                                                    @endif
                                                </option>
                                            @endforeach
                                        @else
                                            <option selected
                                                    value="">@lang('static.formFields.labels.select.topcategory')</option>
                                            @foreach($categories as $id_category)
                                                <option value="{{$id_category['id']}}">
                                                    @if(app()->getLocale()=='az')
                                                        {{$id_category['az_name']}}
                                                    @elseif(app()->getLocale()=='en')
                                                        {{$id_category['en_name']}}
                                                    @elseif(app()->getLocale()=='ru')
                                                        {{$id_category['ru_name']}}
                                                    @endif
                                                </option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @error('formFields.top_category') <span
                                        class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Açıqlama</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'1000'])</p>

                                    <textarea class="textArea" wire:model="formFields.az_description"
                                              name="az_description"></textarea>

                                    @error('formFields.az_description') <span
                                        class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Description</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'1000'])</p>

                                    <textarea class="textArea" wire:model="formFields.en_description"
                                              name="en_description"></textarea>

                                    @error('formFields.en_description') <span
                                        class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Описание</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'1000'])</p>

                                    <textarea class="textArea" wire:model="formFields.ru_description"
                                              name="ru_description"></textarea>

                                    @error('formFields.ru_description') <span
                                        class="error">{{ $message }}</span> @enderror

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
    <!--tinymce js-->
    <script src="{{asset('/assets/admin/cssjslib/libs/tinymce/tinymce.min.js')}}"></script>

    <!-- init js -->
    <script src="{{asset('/assets/admin/cssjslib/js/pages/form-editor.init.js')}}"></script>
</div>
