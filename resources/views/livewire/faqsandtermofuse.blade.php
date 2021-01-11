@section('title')
@lang('static.menu.forwebsite.faqsandtermofuse')
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.1/Sortable.min.js"></script>
    <script>
        $(function () {
            $("#faqs_order").sortable({
                update: function () {
                    var whychooseus_order = $("#faqs_order").sortable('serialize');
                    $.get("{{route('faqsorder')}}?" + faqs_order, function (response) {
                        console.log(response);
                    });
                }
            });
        });
@endsection
<div>
    <div>
        <div wire:ignore.self class="modal slide addFaqs" tabindex="2" role="dialog"
             aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0"
                            id="myExtraLargeModalLabel">@lang('static.pages.settings.faqsTermUseTitle.tabs.faqs')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (session()->has('message'))
                            <div class="alert alert-warning" role="alert">
                                <strong>{{session('message')}}</strong>
                            </div>
                        @endif
                        <form class="custom-validation mt-1"
                              wire:submit.prevent="faqsAdd">
                            <div class="row">
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>@lang('static.pages.settings.about.tabContent.form.labels.coverImage')</label>
                                            <input
                                                accept="image/*"
                                                wire:model.lazy="formFields.faqs.image"
                                                type="file"
                                                class="form-control"
                                            />
                                        </div>
                                        @error('formFields.faqs.image') <span
                                            class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Başlıq</label>
                                    <input
                                        wire:model.lazy="formFields.faqs.az_title"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>заглавие</label>
                                    <input
                                        wire:model.lazy="formFields.faqs.ru_title"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Title</label>
                                    <input
                                        wire:model.lazy="formFields.faqs.en_title"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Açıqlama</label>
                                    <textarea
                                        wire:model.lazy="formFields.faqs.az_description"
                                        rows="4"
                                        class="form-control"
                                    ></textarea>
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Description</label>
                                    <textarea
                                        wire:model.lazy="formFields.faqs.en_description"
                                        rows="4"
                                        class="form-control"
                                    ></textarea>
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Раскрытие</label>
                                    <textarea
                                        wire:model.lazy="formFields.faqs.ru_description"
                                        rows="4"
                                        class="form-control"
                                    ></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 center align-center justify-center">
                                    <button class="btn btn-primary mx-auto" type="submit">
                                        @lang('static.actions.add')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    @if (session()->has('message'))
                        <div class="alert alert-warning" role="alert">
                            <strong>{{session('message')}}</strong>
                        </div>
                    @endif
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">@lang('static.menu.forwebsite.faqsandtermofuse')</h4>

                            <!-- Nav tabs -->
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-toggle="tab" href="#home-1"
                                       role="tab">@lang('static.pages.settings.faqsTermUseTitle.tabs.faqs')</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#profile-1"
                                       role="tab">@lang('static.pages.settings.faqsTermUseTitle.tabs.termofuse')</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                                            <div
                                                class="btn-group center mx-auto justify-center text-center align-center">
                                                <button class="btn btn-lg btn-primary waves-effect waves-light"
                                                        data-toggle="modal"
                                                        data-target=".addFaqs"
                                                        title="@lang('static.pages.settings.about.tabContent.buttons.addFaqs')"
                                                >
                                                    <i class="mdi mdi-book-plus-multiple"></i>
                                                </button>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <table
                                                    class="table w-100 col-lg-12 col-md-12 col-sm-12">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('static.formFields.labels.picture')</th>
                                                        <th>@lang('static.formFields.labels.name')</th>
                                                        <th>@lang('static.formFields.labels.description')</th>
                                                        <th>@lang('static.formFields.labels.order')</th>
                                                        @if(auth()->guard('admins')->user()->role==3)
                                                            <th>@lang('static.actions.buttons')</th>
                                                        @endif
                                                    </tr>
                                                    </thead>
                                                    <tbody
                                                        @if($faqs)
                                                        id="faqs_order"
                                                        @endif
                                                    >
                                                    @foreach($faqs as $item)
                                                        <tr id="faqs_order_{{$item->id}}">
                                                            <td>
                                                                <img alt="{{$item->image}}"
                                                                        width="100"
                                                                        src="{{asset('/storage/uploads/about/faqs/'.$item->image)}}"/>
                                                            </td>
                                                            <td>
                                                                {{$item->az_title}}
                                                            </td>
                                                            <td>
                                                                {{$item->az_description}}
                                                            </td>
                                                            <td>
                                                                {{$item->order}}
                                                            </td>
                                                            @if(auth()->guard('admins')->user()->role==3)
                                                                <td>
                                                                    <div
                                                                        class="btn-group center justify-center text-center align-center">
                                                                        <button class="btn btn-lg btn-danger"

                                                                                title="@lang('static.actions.delete')"
                                                                                wire:click="deleteContent('{{$item->id}}','faqs')"
                                                                        >
                                                                            <i class="mdi mdi-trash-can-outline"></i>
                                                                        </button>
                                                                        <a
                                                                            data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="@lang('static.actions.edit')"
                                                                            class="btn btn-lg btn-warning waves-effect waves-light"
                                                                            href={{route('editAdmin',$item->id)}}
                                                                        >
                                                                            <i class="mdi mdi-circle-edit-outline"></i>
                                                                        </a>
                                                                    </div>
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
                                <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                                    <div class="row">
                                        <form wire:submit.prevent="termofuseupdate" class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <label>Açıqlama</label>
                                                <textarea
                                                    wire:model.lazy="formFields.termofuseupdate.az_description"
                                                    rows="4"
                                                    class="form-control w-100"
                                                >{{ $termofuse->az_description }}</textarea>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <label>Description</label>
                                                <textarea
                                                    wire:model.lazy="formFields.termofuseupdate.en_description"
                                                    rows="4"
                                                    class="form-control"
                                                >{{ $termofuse->en_description }}</textarea>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <label>Раскрытие</label>
                                                <textarea
                                                    wire:model.lazy="formFields.termofuseupdate.ru_description"
                                                    rows="4"
                                                    class="form-control"
                                                >{{ $termofuse->ru_description }}</textarea>
                                            </div>
                                            <div class="col-lg-12 col-md-12 center align-center justify-center">
                                                <button class="btn btn-primary mx-auto" type="submit">
                                                    @lang('static.formFields.buttons.update')
                                                </button>
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
    </div>

</div>
