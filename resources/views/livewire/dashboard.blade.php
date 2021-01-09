@section('title')
    @lang('static.menu.dashboard')
@endsection
@section('pageName')
    @lang('static.pages.dashboard.title')
@endsection
@section('js')
    <!--Morris Chart-->
    <script src="{{asset('/assets/admin/cssjslib/libs/morris.js/morris.min.js')}}"></script>
    <script src="{{asset('/assets/admin/cssjslib/libs/raphael/raphael.min.js')}}"></script>

    <script src="{{asset('/assets/admin/cssjslib/js/pages/dashboard.init.js')}}"></script>

    <script>
        $(function () {
            Morris.Donut({
                element: 'morris-donut-example',
                data: [
                    {
                        label: "@lang('static.pages.dashboard.daystatistic.allusers')",
                        value: {{count($allUsers)}},
                        color: "#82B5FF"
                    },
                ]
            });
        });
    </script>

@endsection
<div>
    <div class="main-content">
        <div class="page-content">
            <div class="header-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 mb-4 pt-5">
                            <div id="morris-bar-example" class="morris-charts morris-chart-height"></div>
                            <div class="mt-1 text-center">
                                <button type="button" class="btn btn-outline-primary ml-1 waves-effect waves-light">Year
                                    2017
                                </button>
                                <button type="button" class="btn btn-outline-info ml-1 waves-effect waves-light">Year
                                    2018
                                </button>
                                <button type="button" class="btn btn-outline-primary ml-1 waves-effect waves-light">Year
                                    2019
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-info mt-2">{{0}}</h3> @lang('static.pages.dashboard.logincount')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-purple mt-2">9,514</h3> @lang('static.pages.dashboard.shoppingcount')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-primary mt-2">289</h3> @lang('static.pages.dashboard.campaignscount')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-danger mt-2">5,220</h3> @lang('static.pages.dashboard.ordercount')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">@lang('static.pages.dashboard.daystatistic.dayly')</h4>

                                <div class="row text-center mt-4">
                                    <div class="col-12">
                                        <h5 class="mb-2 font-size-18">{{count($allUsers)}}</h5>
                                        <p class="text-muted text-truncate">@lang('static.pages.dashboard.daystatistic.allusers')</p>
                                    </div>
                                </div>

                                <div id="morris-donut-example" class="morris-charts morris-chart-height"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">@lang('static.pages.dashboard.daysellerstatic.title')</h4>

                                <div class="row text-center mt-4">
                                    <div class="col-4">
                                        <h5 class="mb-2 font-size-18">56241</h5>
                                        <p class="text-muted text-truncate">@lang('static.pages.dashboard.daysellerstatic.bucketorder')</p>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="mb-2 font-size-18">23651</h5>
                                        <p class="text-muted text-truncate">
                                            @lang('static.pages.dashboard.daysellerstatic.byprogramselling')</p>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="mb-2 font-size-18">23651</h5>
                                        <p class="text-muted text-truncate">@lang('static.pages.dashboard.daysellerstatic.totalselling')</p>
                                    </div>
                                </div>

                                <div id="morris-area-example" class="morris-charts morris-chart-height"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">@lang('static.pages.dashboard.latesttransactions.title')</h4>

                                <div class="table-responsive">
                                    <table class="table mt-4 mb-0 table-centered table-nowrap">

                                        <tbody>
                                        <tr>
                                            <td>
                                                <img src="assets/images/users/avatar-2.jpg" alt="user-image"
                                                     class="avatar-sm rounded-circle mr-2"/> Herbert C. Patton
                                            </td>
                                            <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm</td>
                                            <td>
                                                $14,584
                                                <p class="m-0 text-muted">@lang('static.pages.dashboard.latesttransactions.price')</p>
                                            </td>
                                            <td>
                                                5/12/2016
                                                <p class="m-0 text-muted">@lang('static.pages.dashboard.latesttransactions.date')</p>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm waves-effect">
                                                    @lang('static.actions.more')
                                                </button>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">@lang('static.pages.dashboard.topviewscampaigns.title')</h4>

                                <ol class="activity-feed mb-0">
                                    <li class="feed-item">
                                        <span class="date">Sep 25</span>
                                        <span class="activity-text">Responded to need “Volunteer Activities”</span>
                                    </li>

                                    <li class="feed-item pb-0">
                                        <span class="activity-text">
                                                <a href="" class="text-primary">@lang('static.actions.more')</a>
                                            </span>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
</div>
