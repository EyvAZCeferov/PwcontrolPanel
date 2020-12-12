@section('title',$user[0]->name)
@section('pageName',$user[0]->name)
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('/assets/admin/cssjslib/libs/bootstrap-editable/css/bootstrap-editable.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection
@section('js')
    <script src="{{asset('/assets/admin/cssjslib/libs/bootstrap-editable/js/index.js')}}"></script>

    <!-- Init js-->
    <script src="{{asset('/assets/admin/cssjslib/js/pages/form-xeditable.init.js')}}"></script>
@endsection
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
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
                    <div class="card">
                        <div class="card-body">

                            <div class="media">
                                <img
                                    class="d-flex mr-3 rounded-circle avatar-md"
                                    src="{{asset('/storage/uploads/admins/'.$user[0]->profilePhoto)}}"
                                    alt="{{$user[0]->name}}"/>
                                <div class="media-body">
                                    <h5 class="font-size-16 mb-1">
                                        <a href="#" id="inline-username" data-type="text" data-pk="1"
                                           data-title="Enter username">{{$user[0]->name}}</a>
                                    </h5>
                                    <p class="text-muted font-size-14 font-weight-medium font-secondary mb-0">
                                        @switch($user[0]->role)
                                            @case(1)
                                            @lang('static.adminroles.viewer')
                                            @break
                                            @case(2)
                                            @lang('static.adminroles.customer')
                                            @break
                                            @case(3)
                                            @lang('static.adminroles.top_admin')
                                            @break
                                            @case(4)
                                            @lang('static.adminroles.bucketviewer')
                                            @break
                                            @default
                                        @endswitch
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex justify-content-around">
                                <input type="text" value="formFields.name" wire:model="formFields.name"
                                       class="form-control">
                                @error('formFields.name') <span
                                    class="error">{{ $message }}</span> @enderror
                                <input type="text" value="formFields.email" wire:model="formFields.email"
                                       class="form-control">
                                @error('formFields.email') <span
                                    class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="d-flex justify-content-around">

                                <input type="text" placeholder="@lang('static.formFields.labels.pass.oldpassword')"
                                       wire:model="formFields.password.oldpassword"
                                       class="form-control">
                                @error('formFields.password.oldpassword') <span
                                    class="error">{{ $message }}</span> @enderror
                                <input type="text" placeholder="@lang('static.formFields.labels.pass.password1')"
                                       wire:model="formFields.password.password"
                                       class="form-control">
                                @error('formFields.password.password') <span
                                    class="error">{{ $message }}</span> @enderror
                                <input type="text" placeholder="@lang('static.formFields.labels.pass.password2')"
                                       wire:model="formFields.password.password_confirmation"
                                       class="form-control">
                                @error('formFields.password.password_confirmation') <span
                                    class="error">{{ $message }}</span> @enderror
                                <button class="btn btn-primary" wire:click="change">
                                    <i class="mdi mdi-check"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
