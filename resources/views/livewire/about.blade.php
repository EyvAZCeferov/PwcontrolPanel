@section('title')
    @lang('static.menu.forwebsite.about')
@endsection
@section('pageName')
    @lang('static.menu.forwebsite.about')
@endsection

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.1/Sortable.min.js"></script>
    <script>
        $(function () {
            $("#whychooseus_order").sortable({
                update: function () {
                    var whychooseus_order = $("#whychooseus_order").sortable('serialize');
                    $.get("{{route('whychoseusorder')}}?" + whychooseus_order, function (response) {
                        console.log(response);
                    });
                }
            });
        });
        $(function () {
            $("#teams_order").sortable({
                update: function () {
                    var teams_order = $("#teams_order").sortable('serialize');
                    $.get("{{route('teammemberorder')}}?" + teams_order, function (response) {
                        console.log(response);
                    });
                }
            });
        })
    </script>
@endsection

<div>
    <div>
        <div>
            <div wire:ignore.self class="modal slide showWhyChooseUs" tabindex="2" role="dialog"
                 aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0"
                                id="myExtraLargeModalLabel">@lang('static.pages.settings.about.tabContent.buttons.showWhyChooseUs')</h5>
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
                                  wire:submit.prevent="whyChooseUsUpdate">
                                <div class="row">
                                    <div class="card col-lg-4 col-md-6 col-sm-12">
                                        @if ( array_key_exists('cover_image',$formFields['whychooseus']['table']) )
                                            <img
                                                src="{{asset('/storage/uploads/about/whychooseus/table/'.$formFields['whychooseus']['table']['cover_image'])}}"
                                                class="img-fluid img-thumbnail"
                                                alt="{{$formFields['whychooseus']['table']['az_title']}}"/>
                                        @endif
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>@lang('static.pages.settings.about.tabContent.form.labels.coverImage')</label>
                                                <input
                                                    accept="image/*"
                                                    wire:model.lazy="formFields.whychooseus.table.cover_image"
                                                    type="file"
                                                    class="form-control"
                                                />
                                            </div>
                                            @error('formFields.whychooseus.table.cover_image') <span
                                                class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="card col-lg-4 col-md-6 col-sm-12">
                                        <label>Başlıq</label>
                                        <input
                                            wire:model.lazy="formFields.whychooseus.table.az_title"
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                    <div class="card col-lg-4 col-md-6 col-sm-12">
                                        <label>заглавие</label>
                                        <input
                                            wire:model.lazy="formFields.whychooseus.table.ru_title"
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                    <div class="card col-lg-4 col-md-6 col-sm-12">
                                        <label>Title</label>
                                        <input
                                            wire:model.lazy="formFields.whychooseus.table.en_title"
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                    <div class="col-lg-12 col-md-12 center align-center justify-center">
                                        <button class="btn btn-primary mx-auto" type="submit">
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
        <div wire:ignore.self class="modal slide addWhyChooseUsItem" tabindex="2" role="dialog"
             aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0"
                            id="myExtraLargeModalLabel">@lang('static.pages.settings.about.tabContent.buttons.addWhyChooseUsItem')</h5>
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
                              wire:submit.prevent="whyChooseUsItemAdd">
                            <div class="row">
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    @if ( array_key_exists('icon' , $formFields['whychooseus']['items']))
                                        <img
                                            src="{{asset('/storage/uploads/about/whychooseus/items/'.$formFields['whychooseus']['items']['icon'])}}"
                                            class="img-fluid img-thumbnail"
                                            alt="{{$formFields['whychooseus']['items']['az_title']}}"/>
                                    @endif
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>@lang('static.pages.settings.about.tabContent.form.labels.coverImage')</label>
                                            <input
                                                accept="image/*"
                                                wire:model.lazy="formFields.whychooseus.items.icon"
                                                type="file"
                                                class="form-control"
                                            />
                                        </div>
                                        @error('formFields.whychooseus.items.icon') <span
                                            class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Başlıq</label>
                                    <input
                                        wire:model.lazy="formFields.whychooseus.items.az_title"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>заглавие</label>
                                    <input
                                        wire:model.lazy="formFields.whychooseus.items.ru_title"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Title</label>
                                    <input
                                        wire:model.lazy="formFields.whychooseus.items.en_title"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Açıqlama</label>
                                    <textarea
                                        wire:model.lazy="formFields.whychooseus.items.az_description"
                                        class="form-control"
                                    ></textarea>
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Title</label>
                                    <textarea
                                        wire:model.lazy="formFields.whychooseus.items.ru_description"
                                        class="form-control"
                                    ></textarea>
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Description</label>
                                    <textarea
                                        wire:model.lazy="formFields.whychooseus.items.en_description"
                                        class="form-control"
                                    ></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 center align-center justify-center">
                                    <button class="btn btn-primary mx-auto" type="submit">
                                        @lang('static.formFields.buttons.update')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div wire:ignore.self class="modal slide addTeamMember" tabindex="2" role="dialog"
             aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0"
                            id="myExtraLargeModalLabel">@lang('static.pages.settings.about.tabContent.buttons.addTeamMember')</h5>
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
                              wire:submit.prevent="teammemberAdd">
                            <div class="row">
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    @if ( array_key_exists('image' , $formFields['teams']))
                                        <img
                                            src="{{asset('/storage/uploads/about/teams/'.$formFields['teams']['image'])}}"
                                            class="img-fluid img-thumbnail"
                                            alt="{{$formFields['teams']['az_title']}}"/>
                                    @endif
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>@lang('static.pages.settings.about.tabContent.form.labels.coverImage')</label>
                                            <input
                                                accept="image/*"
                                                wire:model.lazy="formFields.teams.image"
                                                type="file"
                                                class="form-control"
                                            />
                                        </div>
                                        @error('formFields.teams.image') <span
                                            class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Başlıq</label>
                                    <input
                                        wire:model.lazy="formFields.teams.az_title"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>заглавие</label>
                                    <input
                                        wire:model.lazy="formFields.teams.ru_title"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Title</label>
                                    <input
                                        wire:model.lazy="formFields.teams.en_title"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Açıqlama</label>
                                    <textarea
                                        wire:model.lazy="formFields.teams.az_description"
                                        class="form-control"
                                    ></textarea>
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Title</label>
                                    <textarea
                                        wire:model.lazy="formFields.teams.ru_description"
                                        class="form-control"
                                    ></textarea>
                                </div>
                                <div class="card col-lg-4 col-md-6 col-sm-12">
                                    <label>Description</label>
                                    <textarea
                                        wire:model.lazy="formFields.teams.en_description"
                                        class="form-control"
                                    ></textarea>
                                </div>
                            </div>
                            {{--Normal Social Section--}}
                            <div class="row mx-auto text-center socialGroup">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="facebook"> @lang('static.formFields.labels.select.sosialSelect') :
                                            Facebook</label>
                                        <input type="text" class="form-control"
                                               id="facebook"
                                               wire:model="formFields.teams.social.facebook"
                                        />
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="instagram"> @lang('static.formFields.labels.select.sosialSelect') :
                                            Instagram</label>
                                        <input type="text" class="form-control"
                                               id="instagram"
                                               wire:model="formFields.teams.social.instagram"
                                        />
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="email"> @lang('static.formFields.labels.select.sosialSelect') :
                                            E-mail</label>
                                        <input type="text" class="form-control"
                                               id="email"
                                               wire:model="formFields.teams.social.email"
                                        />
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="twitter"> @lang('static.formFields.labels.select.sosialSelect') :
                                            Twitter</label>
                                        <input type="text" class="form-control"
                                               id="twitter"
                                               wire:model="formFields.teams.social.twitter"
                                        />
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="whatsapp"> @lang('static.formFields.labels.select.sosialSelect') :
                                            Whatsapp</label>
                                        <input type="text" class="form-control"
                                               id="whatsapp"
                                               wire:model="formFields.teams.social.whatsapp"
                                        />
                                    </div>
                                </div>

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

                            <h4 class="card-title">@lang('static.pages.settings.about.title')</h4>

                            <!-- Nav tabs -->
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-toggle="tab" href="#home-1"
                                       role="tab">@lang('static.pages.settings.about.tabs.about')</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#profile-1"
                                       role="tab">@lang('static.pages.settings.about.tabs.whychooseus')</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#messages-1"
                                       role="tab">@lang('static.pages.settings.about.tabs.teams')</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active p-3" id="home-1" role="tabpanel">

                                    @if ($this->about->images !=null)
                                        <div class="w-100"
                                             style="scroll-behavior: auto; overflow-scrolling: touch; overflow-y: hidden; overflow-x: scroll;">
                                            @foreach(json_decode($this->about->images) as $image)
                                                <div class="d-inline-block w-25 position-relative">
                                                    <img
                                                        src="{{asset('/storage/uploads/about/aboutImages/'.$image)}}"
                                                        class="img-fluid img-thumbnail border border-primary w-100 position-relative"
                                                        alt="{{$image}}"/>
                                                    <button
                                                        title="Şəkili Sil!"
                                                        wire:click="deleteImage('{{$image}}','about')"
                                                        data-title="Şəkili Sil"
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
                                          wire:submit.prevent="aboutUpdate">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-3">
                                                <div class="card">

                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>@lang('static.formFields.labels.pictures')</label>
                                                            <input
                                                                wire:model="formFields.about.images"
                                                                type="file"
                                                                multiple
                                                                class="form-control"
                                                                accept="image/*"
                                                            />
                                                        </div>
                                                        @error('formFields.images') <span
                                                            class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-3">
                                                <div class="card">

                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Başlıq</label>
                                                            <input
                                                                wire:model="formFields.about.az_title"
                                                                value="{{ $about->az_title }}"
                                                                type="text"
                                                                class="form-control"
                                                            />
                                                        </div>
                                                        @error('formFields.az_title') <span
                                                            class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-3">
                                                <div class="card">

                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>заглавие</label>
                                                            <input
                                                                wire:model="formFields.about.ru_title"
                                                                type="text"
                                                                value="{{ $about->ru_title }}"
                                                                class="form-control"
                                                            />
                                                        </div>
                                                        @error('formFields.ru_title') <span
                                                            class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-3">
                                                <div class="card">

                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                            <input
                                                                wire:model="formFields.about.en_title"
                                                                type="text"
                                                                value="{{ $about->en_title }}"
                                                                class="form-control"
                                                            />
                                                        </div>
                                                        @error('formFields.en_title') <span
                                                            class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-3">
                                                <div class="card">

                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Motivasiya</label>
                                                            <input
                                                                wire:model="formFields.about.az_motive"
                                                                type="text"
                                                                value="{{ $about->az_motive }}"
                                                                class="form-control"
                                                            />
                                                        </div>
                                                        @error('formFields.az_motive') <span
                                                            class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-3">
                                                <div class="card">

                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Motivation</label>
                                                            <input
                                                                wire:model="formFields.about.en_motive"
                                                                type="text"
                                                                value="{{ $about->en_motive }}"
                                                                class="form-control"
                                                            />
                                                        </div>
                                                        @error('formFields.en_motive') <span
                                                            class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-3">
                                                <div class="card">

                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Мотивация</label>
                                                            <input
                                                                wire:model="formFields.about.ru_motive"
                                                                type="text"
                                                                value="{{ $about->ru_motive }}"
                                                                class="form-control"
                                                            />
                                                        </div>
                                                        @error('formFields.ru_motive') <span
                                                            class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-3">
                                                <div class="card">

                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Açıqlama</label>
                                                            <textarea
                                                                wire:model="formFields.about.az_description"
                                                                rows="3"
                                                                class="form-control"
                                                            >
                                                            {{ $about->az_description }}
                                                            </textarea>
                                                        </div>
                                                        @error('formFields.az_description') <span
                                                            class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-3">
                                                <div class="card">

                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Раскрытие</label>
                                                            <textarea
                                                                wire:model="formFields.about.ru_description"
                                                                rows="3"
                                                                class="form-control"
                                                            >
                                                                {{ $about->ru_description }}
                                                            </textarea>
                                                        </div>
                                                        @error('formFields.ru_description') <span
                                                            class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-3">
                                                <div class="card">

                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea
                                                                wire:model="formFields.about.en_description"
                                                                rows="3"
                                                                class="form-control"
                                                            >
                                                                {{ $about->en_description }}
                                                            </textarea>
                                                        </div>
                                                        @error('formFields.en_description') <span
                                                            class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 center align-center justify-center">
                                                <button class="btn btn-primary mx-auto" type="submit">
                                                    @lang('static.formFields.buttons.update')
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                                            <div
                                                class="btn-group center mx-auto justify-center text-center align-center">
                                                <button class="btn btn-lg btn-info waves-effect waves-light"
                                                        data-toggle="modal"
                                                        data-target=".showWhyChooseUs"
                                                        title="@lang('static.pages.settings.about.tabContent.buttons.showWhyChooseUs')"
                                                >
                                                    <i class="mdi mdi-account-multiple-check-outline"></i>
                                                </button>
                                                <button class="btn btn-lg btn-primary waves-effect waves-light"
                                                        data-toggle="modal"
                                                        data-target=".addWhyChooseUsItem"
                                                        title="@lang('static.pages.settings.about.tabContent.buttons.addWhyChooseUsItem')"
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
                                                        @if($whychooseus[0]->getItems()->count()>0)
                                                        id="whychooseus_order"
                                                        @endif
                                                    >
                                                    @if($whychooseus[0]->getItems()->count()>0)
                                                        @foreach($whychooseus[0]->getItems->sort() as $item)
                                                            <tr id="whychooseus_order_{{$item->id}}">
                                                                <td>
                                                                    <img alt="{{$item->icon}}"
                                                                         width="100"
                                                                         src="{{asset('/storage/uploads/about/whychooseus/items/'.$item->icon)}}"/>
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
                                                                                    wire:click="deleteContent('{{$item->id}}','whychooseus')"
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
                                                    @else
                                                        <tr>
                                                            <p class="text-danger font-size-lg">
                                                                @lang('static.formFields.actions.nullData')
                                                            </p>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane p-3" id="messages-1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                                            <div
                                                class="btn-group center mx-auto justify-center text-center align-center">
                                                <button class="btn btn-lg btn-primary waves-effect waves-light"
                                                        data-toggle="modal"
                                                        data-target=".addTeamMember"
                                                        title="@lang('static.pages.settings.about.tabContent.buttons.addTeamMember')"
                                                >
                                                    <i class="fa fa-user-plus"></i>
                                                </button>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <table
                                                    class="table w-100 col-lg-12 col-md-12 col-sm-12">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('static.formFields.labels.picture')</th>
                                                        <th>@lang('static.formFields.labels.name')</th>
                                                        <th>@lang('static.formFields.labels.email')</th>
                                                        <th>@lang('static.formFields.labels.order')</th>
                                                        @if(auth()->guard('admins')->user()->role==3)
                                                            <th>@lang('static.actions.buttons')</th>
                                                        @endif
                                                    </tr>
                                                    </thead>
                                                    <tbody
                                                        @if($teams->count()>0)
                                                        id="teams_order"
                                                        @endif
                                                    >
                                                    @if($teams->count()>0)
                                                        @foreach($teams->sort() as $item)
                                                            <tr id="teams_order_{{$item->id}}">
                                                                <td>
                                                                    <img alt="{{$item->image}}"
                                                                         width="100"
                                                                         src="{{asset('/storage/uploads/about/teams/'.$item->image)}}"/>
                                                                </td>
                                                                <td>
                                                                    {{$item->az_title}}
                                                                </td>
                                                                <td>
                                                                    {{$item->social}}
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
                                                                                    wire:click="deleteContent('{{$item->id}}','teams')"
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
                                                    @else
                                                        <tr>
                                                            <p class="text-danger font-size-lg">
                                                                @lang('static.formFields.actions.nullData')
                                                            </p>
                                                        </tr>
                                                    @endif
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
        </div>
    </div>
</div>
