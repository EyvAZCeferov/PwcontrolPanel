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

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">
                                        @lang('static.pages.settings.form.labels.projectName')
                                    </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">
                                        @lang('static.pages.settings.form.labels.adminpanelUrl')
                                    </label>

                                    <div class="col-sm-10">
                                        <input class="form-control" type="url" value=""/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">
                                        @lang('static.pages.settings.form.labels.description')
                                    </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">
                                        @lang('static.pages.settings.form.labels.logo')
                                    </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file"/>
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
