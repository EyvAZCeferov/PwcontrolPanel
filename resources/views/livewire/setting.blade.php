@section('title')
    @lang('static.menu.forwebsite.settings')
@endsection
@section('pageName')
    @lang('static.menu.forwebsite.settings')
@endsection
<div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">@lang('static.pages.settings.title')</h4>
                                <br/>
                                @if (session()->has('message'))
                                    <div class="alert alert-info" role="alert">
                                        <strong>{{session('message')}}</strong>
                                    </div>
                                @endif

                                <div wire:loading>
                                    <div class="alert alert-info" role="alert">
                                        <strong>@lang('static.actions.processing')</strong>
                                    </div>
                                </div>
                                <form class="custom-validation mt-1"
                                      wire:submit.prevent="updateSettings"
                                >
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                            @lang('static.pages.settings.form.labels.projectName')
                                        </label>
                                        <div class="col-sm-10">
                                            <input
                                                wire:model="formFields.projectName"
                                                value="{{$setting[0]->projectName}}"
                                                class="form-control" type="text"
                                            />
                                        </div>
                                        @error('formFields.projectName') <span
                                            class="error">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                            @lang('static.pages.settings.form.labels.adminpanelUrl')
                                        </label>

                                        <div class="col-sm-10">
                                            <input
                                                wire:model="formFields.adminUrl"
                                                value="{{$setting[0]->adminUrl}}"
                                                class="form-control" type="text"/>
                                        </div>
                                        @error('formFields.adminUrl') <span
                                            class="error">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                            @lang('static.pages.settings.form.labels.description')
                                        </label>
                                        <div class="col-sm-10">
                                            <input
                                                wire:model="formFields.description"
                                                value="{{$setting[0]->description}}"
                                                class="form-control" type="text"/>
                                        </div>
                                        @error('formFields.description') <span
                                            class="error">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                            @lang('static.pages.settings.form.labels.logo')
                                        </label>
                                        <div class="col-sm-5">
                                            <img src="{{asset('/storage/uploads/commons/logos/'.$setting[0]->logo)}}"
                                                 alt="{{$setting[0]->projectName}}"/>
                                        </div>
                                        <div class="col-sm-5">
                                            <input
                                                wire:model="formFields.logo"
                                                accept="image/*"
                                                class="form-control" type="file"/>
                                        </div>
                                        @error('formFields.logo') <span
                                            class="error">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                            @lang('static.pages.settings.form.labels.phoneNumb')
                                        </label>
                                        <div class="col-sm-10">
                                            <input
                                                wire:model="formFields.phoneNumb"
                                                value="{{$setting[0]->phoneNumb}}"
                                                class="form-control" type="text"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                            @lang('static.formFields.labels.email')
                                        </label>
                                        <div class="col-sm-10">
                                            <input
                                                wire:model="formFields.email"
                                                value="{{$setting[0]->email}}"
                                                class="form-control" type="email"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                            @lang('static.pages.settings.form.labels.facebook_page')
                                        </label>
                                        <div class="col-sm-10">
                                            <input
                                                wire:model="formFields.facebook_page"
                                                value="{{$setting[0]->facebook_page}}"
                                                class="form-control" type="text"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                            @lang('static.pages.settings.form.labels.instagram_page')
                                        </label>
                                        <div class="col-sm-10">
                                            <input
                                                wire:model="formFields.instagram_page"
                                                value="{{$setting[0]->instagram_page}}"
                                                class="form-control" type="text"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                            @lang('static.pages.settings.form.labels.twitter_page')
                                        </label>
                                        <div class="col-sm-10">
                                            <input
                                                wire:model="formFields.twitter_page"
                                                value="{{$setting[0]->twitter_page}}"
                                                class="form-control" type="text"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                            @lang('static.pages.settings.form.labels.youtube_page')
                                        </label>
                                        <div class="col-sm-10">
                                            <input
                                                wire:model="formFields.youtube_page"
                                                value="{{$setting[0]->youtube_page}}"
                                                class="form-control" type="text"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                            @lang('static.pages.settings.form.labels.copyright')
                                        </label>
                                        <div class="col-sm-10">
                                            <input
                                                wire:model="formFields.copyright"
                                                value="{{$setting[0]->copyright}}"
                                                class="form-control" type="text"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                            @lang('static.pages.settings.form.labels.coop_loc')
                                        </label>
                                        <div class="col-sm-10">
                                            <input
                                                wire:model="formFields.coop_loc"
                                                value="{{$setting[0]->coop_loc}}"
                                                class="form-control" type="text"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                            @lang('static.pages.settings.form.labels.site_address')
                                        </label>
                                        <div class="col-sm-10">
                                            <input
                                                wire:model="formFields.site_address"
                                                value="{{$setting[0]->site_address}}"
                                                class="form-control" type="text"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button
                                                class="btn mx-auto center btn-toolbar btn-outline-primary btn-lg"
                                                type="submit">
                                                <i class="mdi mdi-lead-pencil font-size-18"></i>&nbsp;
                                                @lang('static.formFields.buttons.update')
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
