@section('title')
    @lang('static.menu.forwebsite.about')
@endsection
@section('pageName')
    @lang('static.menu.forwebsite.about')
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">@lang('static.pages.settings.about.title')</h4>

                            <!-- Nav tabs -->
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">@lang('static.pages.settings.about.tabs.about')</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab">@lang('static.pages.settings.about.tabs.whychooseus')</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#messages-1" role="tab">@lang('static.pages.settings.about.tabs.teams')</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active p-3" id="home-1" role="tabpanel">
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
                                    <p class="font-14 mb-0">
                                        Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit.
                                    </p>
                                </div>
                                <div class="tab-pane p-3" id="messages-1" role="tabpanel">
                                    <p class="font-14 mb-0">
                                        Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
