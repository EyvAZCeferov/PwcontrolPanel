@section('title','Kalendar')
@section('pageName','Kalendar')
@section('css')
    <!-- Plugin css -->
    <link href="{{asset('/assets/admin/cssjslib/libs/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection
@section('js')
    <!-- plugin js -->
    <script src="{{asset('/assets/admin/cssjslib/libs/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('/assets/admin/cssjslib/libs/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('/assets/admin/cssjslib/libs/fullcalendar/fullcalendar.min.js')}}"></script>
    <!-- Calendar init -->
    {{--    <script src="{{asset('/assets/admin/cssjslib/js/pages/calendar.init.js')}}"></script>--}}
    <script>
        $('#calendar').fullCalendar({
            header: {
                right: 'prev,next,today',
                left: 'title',
            },
            buttonText: {
                today: 'Bugün',
            },
            navLinks: true,
            navLinkDayClick: function (date, jsEvent) {
                console.log('day', date.toISOString());
                console.log('coords', jsEvent.pageX, jsEvent.pageY);
            },
            editable: false,
            eventLimit: true,
            locale: 'az',
            weekends: false,
            dayNamesShort: ['Be', 'Ça', 'Ç', 'Ca', 'C', 'Ş', 'B'],
            dayNames: ['Bazar Ertəsi', 'Çərşənbə Axşamı', 'Çərşənbə', 'Cümə Axşamı', 'Cümə', 'Şənbə', 'Bazar'],
            monthNames: ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'İyun', 'İyul', 'Avqust', 'Sentyabr', 'Oktyabr', 'Noyabr', 'Dekabr'],
            events: [
                @foreach($posts as $post)
                {
                    id: '{{$post->id}}',
                    title: '{{$post->az_name}}',
                    start: '{{ $post->startTime}}',
                    end: '{{$post->endTime}}',
                    color: '#7c9d32',
                    padding: '23px',
                    url: '{{route('postsBrowse',$post->id)}}'
                },
                @endforeach
            ]
        });
    </script>
@endsection
<div>
    <div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div id='calendar'></div>
                                        <div style='clear:both'></div>
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
