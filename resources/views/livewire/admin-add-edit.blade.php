@section('title')
    @if($urlPath)
        @if (str_contains($urlPath,'add'))
            @lang('static.actions.add') Admin
        @else
            @if($admin[0])
                {{$admin[0]->name}}  @lang('static.actions.edit') Admin
            @endif
        @endif
    @else
        @lang('static.actions.add') Admin
    @endif
@endsection
@section('pageName')
    @if($urlPath)
        @if (str_contains($urlPath,'add'))
            @lang('static.actions.add') Admin
        @else
            @if($admin[0])
                {{$admin[0]->name}}  @lang('static.actions.edit') Admin
            @endif
        @endif
    @else
        @lang('static.actions.add') Admin
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
                                    <img src="{{asset('/storage/uploads/admins/'.$admin[0]->profilePhoto)}}"
                                         class="img-fluid img-thumbnail"
                                         alt="{{$admin[0]->name}}"/>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>@lang('static.formFields.labels.changepicture')</label>
                                            <input
                                                accept="image/*"
                                                wire:model="formFields.profilePhoto"
                                                type="file"
                                            />
                                        </div>
                                        @error('formFields.profilePhoto') <span
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
                                                wire:model="formFields.profilePhoto"
                                                type="file"
                                                required
                                            />
                                        </div>
                                        @error('formFields.profilePhoto') <span
                                            class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">@lang('static.formFields.labels.name')</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'300'])</p>

                                    <input type="text" class="form-control" maxlength="300"
                                           wire:model.debounce.500ms="formFields.name"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$admin[0]->name}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.name') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">@lang('static.formFields.labels.email')</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'300'])</p>

                                    <input type="text" class="form-control" maxlength="300"
                                           wire:model.debounce.500ms="formFields.email"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$admin[0]->email}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.email') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">@lang('static.formFields.labels.password')</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.max',['symbol'=>'50'])</p>

                                    <input type="password" class="form-control" maxlength="50"
                                           wire:model.debounce.500ms="formFields.password"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$admin[0]->password}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.password') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">@lang('static.formFields.labels.select.selectrol')</h4>
                                    <p class="card-title-desc">@lang('static.formFields.validation.select',['role'=>'admin rolunu'])</p>
                                    <select class="form-control" wire:model="formFields.role">
                                        @if(str_contains($urlPath,'edit'))
                                            @foreach($adminRoles as $role)
                                                <option value="{{$role['id']}}"
                                                        @if($role['id'] == $admin[0]->role)
                                                        selected
                                                        value="{{$admin[0]->role}}"
                                                    @endif
                                                >
                                                    {{$role['name']}}
                                                </option>
                                            @endforeach
                                        @else
                                            <option selected
                                                    value="">@lang('static.formFields.labels.select.selectrol')</option>
                                            @foreach($adminRoles as $role)
                                                <option value="{{$role['id']}}">
                                                    {{$role['name']}}
                                                </option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @error('formFields.role') <span
                                        class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">@lang('static.formFields.labels.select.selectcustomer')</h4>
                                    <p class="card-title-desc">
                                        @lang('static.formFields.validation.select',['role'=>'müştərini'])
                                    </p>
                                    <select class="form-control" wire:model="formFields.customer_id">
                                        @if(str_contains($urlPath,'edit'))
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}"
                                                        @if($customer->id == $admin[0]->customer_id)
                                                        selected
                                                        value="{{$admin[0]->customer_id}}"
                                                    @endif
                                                >
                                                    @if(app()->getLocale()=='az')
                                                        {{$customer->az_name}}
                                                    @elseif(app()->getLocale()=='en')
                                                        {{$customer->en_name}}
                                                    @elseif(app()->getLocale()=='ru')
                                                        {{$customer->ru_name}}
                                                    @endif
                                                </option>
                                            @endforeach
                                        @else
                                            <option selected
                                                    value="">@lang('static.formFields.labels.select.selectcustomer')</option>
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}">
                                                    @if(app()->getLocale()=='az')
                                                        {{$customer->az_name}}
                                                    @elseif(app()->getLocale()=='en')
                                                        {{$customer->en_name}}
                                                    @elseif(app()->getLocale()=='ru')
                                                        {{$customer->ru_name}}
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
                    <div class="row">
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
