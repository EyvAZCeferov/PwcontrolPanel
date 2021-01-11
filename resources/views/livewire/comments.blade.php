@section('title')
    @lang('static.menu.comments')
@endsection
@section('pageName')
    @lang('static.menu.comments')
@endsection
<div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card-body">
                        @if($deleted)
                            <h4 class="card-title">@lang('static.formFields.validation.deleted',['base'=>\Lang::get('static.menu.comments')])</h4>
                        @else
                            <h4 class="card-title">@lang('static.formFields.validation.lists',['base'=>\Lang::get('static.menu.comments')])</h4>
                        @endif
                        <p class="justify-content-lg-around justify-content-md-around">
                            @if(auth()->guard('admins')->user()->role==3 || auth()->guard('admins')->user()->role==1)
                                @if($deleted)
                                    @lang('static.formFields.validation.indeletedlists',['base'=>\Lang::get('static.menu.comments')])
                                @else
                                    @lang('static.formFields.validation.notdeletedlists',['base'=>\Lang::get('static.menu.comments')])
                                @endif
                            @endif
                            @if(auth()->guard('admins')->user()->role==3 || auth()->guard('admins')->user()->role==1)
                                <span class="d-inline-block px-5">
                            <input wire:model="deleted"
                                   @if($deleted)
                                   checked
                                   @endif
                                   type="checkbox"
                                   id="switch1"
                                   switch="none"/>
                            <label for="switch1" data-on-label="@lang('static.formFields.inputs.deleted')"
                                   data-off-label="@lang('static.formFields.inputs.notdeleted')"></label>
                        </span>
                            @endif
                        </p>

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
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">@lang('static.pages.comments.descb')</h4>

                            <!-- Nav tabs -->
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-toggle="tab" href="#home-1"
                                        role="tab">@lang('static.menu.customers')</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#profile-1"
                                        role="tab">@lang('static.menu.media.campaigns')</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                                    <table id="datatable-buttons"
                                   class="table table-striped table-bordered dt-responsive nowrap mdi-null"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>@lang('static.formFields.labels.name')</th>
                                                <th>@lang('static.formFields.labels.comment')</th>
                                                <th>@lang('static.menu.customers')</th>
                                                @if(auth()->guard('admins')->user()->role==3)
                                                    <th>@lang('static.actions.buttons')</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customers as $customer)
                                            @php($message=json_decode($customer->message))
                                                <tr>
                                                    <td>
                                                        {{ $message->name }}
                                                    </td>
                                                    <td>
                                                        {{ $message->description }}
                                                     </td>
                                                     <td>
                                                         <a
                                                         href="{{ settings('site_address') }}/customers/{{ $customer->get_customer->id }}"
                                                         >
                                                        @if(app()->getLocale()=='az')
                                                            {{$customer->get_customer->az_name}}
                                                        @elseif(app()->getLocale()=='en')
                                                            {{$customer->get_customer->en_name}}
                                                        @elseif(app()->getLocale()=='ru')
                                                            {{$customer->get_customer->ru_name}}
                                                        @endif
                                                        </a>
                                                     </td>
                                                     @if(auth()->guard('admins')->user()->role==3)
                                                    <td>
                                                        @if($deleted)
                                                            <div
                                                                class="btn-group center justify-center text-center align-center">
                                                                <button class="btn btn-lg btn-danger"
                                                                        data-toggle="tooltip"
                                                                        data-placement="top"
                                                                        title="@lang('static.actions.forcedelete')"
                                                                        wire:click="hardDelete('{{$customer->id}}','customers')"
                                                                >
                                                                    <i class="mdi mdi-delete-alert"></i>
                                                                </button>
                                                                <button class="btn btn-lg btn-info"
                                                                        data-toggle="tooltip"
                                                                        data-placement="top"
                                                                        title="@lang('static.actions.recover')"
                                                                        wire:click="recover('{{$customer->id}}','customers')"
                                                                >
                                                                    <i class="mdi mdi-table-refresh"></i>
                                                                </button>
                                                            </div>
                                                        @else
                                                            <div
                                                                class="btn-group center justify-center text-center align-center">
                                                                <button class="btn btn-lg btn-danger"
                                                                        data-toggle="tooltip"
                                                                        data-placement="top"
                                                                        title="@lang('static.actions.delete')"
                                                                        wire:click="delete('{{$customer->id}}','customers')"
                                                                >
                                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </td>
                                                         @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                                    <table id="datatable-buttons"
                                   class="table table-striped table-bordered dt-responsive nowrap mdi-null"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>@lang('static.formFields.labels.name')</th>
                                                <th>@lang('static.formFields.labels.comment')</th>
                                                <th>@lang('static.menu.media.campaigns')</th>
                                                @if(auth()->guard('admins')->user()->role==3)
                                                    <th>@lang('static.actions.buttons')</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($campaigns as $campaign)
                                            @php($message=json_decode($campaign->message))
                                                <tr>
                                                    <td>
                                                        {{ $message->name }}
                                                    </td>
                                                    <td>
                                                        {{ $message->description }}
                                                     </td>
                                                     <td>
                                                        @if($campaign->getCampaign)
                                                            <a
                                                            href="{{ settings('site_address') }}/customers/{{ $campaign->getCampaign->id }}/campaigns/{{ $campaign->slug }}"
                                                            >
                                                                @if(app()->getLocale()=='az')
                                                                    {{$campaign->getCampaign->az_name}}
                                                                @elseif(app()->getLocale()=='en')
                                                                    {{$campaign->getCampaign->en_name}}
                                                                @elseif(app()->getLocale()=='ru')
                                                                    {{$campaign->getCampaign->ru_name}}
                                                                @endif
                                                        </a>
                                                        @else
                                                            <span class="text-danger">@lang('static.formFields.actions.nullData')</span>
                                                        @endif
                                                        </a>
                                                     </td>
                                                     @if(auth()->guard('admins')->user()->role==3)
                                                    <td>
                                                        @if($deleted)
                                                            <div
                                                                class="btn-group center justify-center text-center align-center">
                                                                <button class="btn btn-lg btn-danger"
                                                                        data-toggle="tooltip"
                                                                        data-placement="top"
                                                                        title="@lang('static.actions.forcedelete')"
                                                                        wire:click="hardDelete('{{$campaign->id}}','campaigns')"
                                                                >
                                                                    <i class="mdi mdi-delete-alert"></i>
                                                                </button>
                                                                <button class="btn btn-lg btn-info"
                                                                        data-toggle="tooltip"
                                                                        data-placement="top"
                                                                        title="@lang('static.actions.recover')"
                                                                        wire:click="recover('{{$campaign->id}}','campaigns')"
                                                                >
                                                                    <i class="mdi mdi-table-refresh"></i>
                                                                </button>
                                                            </div>
                                                        @else
                                                            <div
                                                                class="btn-group center justify-center text-center align-center">
                                                                <button class="btn btn-lg btn-danger"
                                                                        data-toggle="tooltip"
                                                                        data-placement="top"
                                                                        title="@lang('static.actions.delete')"
                                                                        wire:click="delete('{{$campaign->id}}','campaigns')"
                                                                >
                                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </td>
                                                         @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
