@extends('layouts.account')

@section('content')
    <div class="row heading-bg">

    <h5 class="mt-10">{{ $team->settings->company_name }}</h5>
    <!-- Row -->
    </div>
    <!-- /Row -->
    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default card-view panel-refresh">
                <div class="refresh-container">
                    <div class="la-anim-1"></div>
                </div>
                <div class="panel-heading">
                    <div class="pull-left">
                        <form id="filtering" class="form-inline" action="{{ route('reports') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <select name="city_id" id="city"  class="form-control">
                                    <option value="all">-- {{ __('All Cities') }} --</option>
                                    @foreach($cities as $city)
                                        <option @if(isset($request->city_id) && $request->city_id == $city->id) selected @endif
                                                value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                <select name="branch_id" id="branch" onchange="form.submit()" class="form-control">
                                    <option value="all">-- {{ __('All Branches') }} --</option>
                                    @foreach($branches as $branch)
                                        <option @if(isset($request->branch_id) && $request->branch_id == $branch->id) selected @endif
                                        value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                                <select name="point_id" id="point" onchange="form.submit()" class="form-control">
                                    <option value="all">-- {{ __('All Points') }} --</option>
                                    @foreach($points as $point)
                                        <option @if(isset($request->point_id) && $request->point_id == $point->id) selected @endif
                                        value="{{ $point->id }}">{{ $point->name }}</option>
                                    @endforeach
                                </select>
                                <input class="form-control input-daterange-datepicker"  type="text" name="date_range"
                                       value="{{ isset($request->date_range) ?$request->date_range:'01-01-2021 - 12-31-2021' }}">
                                <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="pull-right">
                        <a href="#" class="pull-left inline-block refresh mr-15">
                            <i class="zmdi zmdi-replay"></i>
                        </a>
                        <a href="#" class="pull-left inline-block full-screen mr-15">
                            <i class="zmdi zmdi-fullscreen"></i>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3"></div>
                        </div>
                        @foreach($questions as $question)
                            <div class="col-md-4 text-center pb-30">
                                <canvas  id="chart_{{ $question->id }}" height="180"></canvas>
                                <br/>
                                <h5 class="text-center">{{ $question->question }}</h5>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Row -->
    <!-- Row -->

    <!-- Row -->
@endsection
@section('styles')
    <!-- Bootstrap Daterangepicker CSS -->
    <link href="{{ url('assets/dist/vendors') }}/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
    <link href="{{ url('assets/dist/vendors') }}/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ url('assets/dist/vendors') }}/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Daterangepicker CSS -->
@endsection
@section('scripts')


    <!-- Data table JavaScript -->
    <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/jszip/dist/jszip.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/pdfmake/build/vfs_fonts.js"></script>

    <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('assets/dist/') }}/js/export-table-data.js"></script>


    <script type="text/javascript" src="{{ url('assets/dist/vendors') }}/bower_components/moment/min/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="{{ url('assets/dist/vendors') }}/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Bootstrap Daterangepicker JavaScript -->
    <script src="{{ url('assets/dist/vendors') }}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Form Picker Init JavaScript -->
    <!-- ChartJS JavaScript -->
    <script src="{{ url('assets/dist/vendors') }}/chart.js/Chart.min.js"></script>
<script>

    $(document).on('change','#city',function () {
        $('#branch').val('all')
        $('#point').val('all')
        $('#filtering').submit();
    });
    $(document).on('change','#branch',function () {
        $('#point').val('all');
        $('#filtering').submit();
    });

    $('.input-daterange-datepicker').daterangepicker({
        format:'DD-MM-YYYY',
    });

    @foreach($questions as $question)
    if( $('#chart_{{ $question->id }}').length > 0 ){
        var ctx7 = document.getElementById("chart_{{ $question->id }}").getContext("2d");
        var gredient1 = ctx7.createLinearGradient(50, 50, 0, 200);
        gredient1.addColorStop(0,'#15E2BE');
        gredient1.addColorStop(1,'#009C81');
        var gredient2 = ctx7.createLinearGradient(50, 50, 0, 200);
        gredient2.addColorStop(0,'#242B3E');
        gredient2.addColorStop(1,'#274599');
        var data7 = {
            labels: [
                "{{ explode(',',$question->answers)[0] }}",
                "{{ explode(',',$question->answers)[1] }}"
            ],
            datasets: [
                {
                    data: [
                        {{ $question->answerscount($request,explode(',',$question->answers)[0])->count() }},
                        {{ $question->answerscount($request,explode(',',$question->answers)[1])->count() }}
                    ],
                    backgroundColor: [
                        gredient1,
                        gredient2
                    ],
                    hoverBackgroundColor: [
                        "#15E2BE",
                        "#242B3E"
                    ]
                }]
        };

        var doughnutChart = new Chart(ctx7, {
            type: 'doughnut',
            data: data7,
            options: {
                animation: {
                    duration:	3000
                },
                responsive: true,
                legend: {
                    labels: {
                        fontFamily: "Roboto",
                        fontColor:"#878787"
                    }
                },
                tooltip: {
                    backgroundColor:'rgba(33,33,33,1)',
                    cornerRadius:0,
                    footerFontFamily:"'Roboto'"
                },
                elements: {
                    arc: {
                        borderWidth: 0
                    }
                }
            }
        });
    }
    @endforeach

</script>
@endsection