@extends('layouts.account')

@section('content')
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-3 col-xs-12">

            <h6 class="txt-dark">
                {{ $point->branch->name }} - {{ $point->name }}
            </h6>

        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li><a href="#"><span>{{ __('Branches') }}</span></a></li>
                <li><a href="{{ route('branches.branches') }}"><span>{{ __('Branches') }}</span></a></li>
                <li><a href="{{ route('branches.branches.points',['branch'=>$point->branch->id]) }}">
                        <span>{{ $point->branch->name }}</span></a></li>
                <li class="active"><span>{{ $point->name }}</span></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-wrapper collapse in">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <form id="filtering" class="form-inline" action="{{ route('branches.points.responses',['point'=>$point->id]) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control input-daterange-datepicker"  type="text" name="date_range"
                                           value="{{ isset($request->date_range) ?$request->date_range:'01-01-2021 - 12-31-2021' }}">
                                    <button type="submit" class="btn btn-primary btn-sm">{{ __('Filter') }}</button>
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

@endsection

@section('styles')
    <link href="{{ url('assets/dist/vendors') }}/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ url('assets/dist/vendors') }}/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ url('assets/dist/vendors') }}/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Daterangepicker CSS -->
    <link href="{{ url('assets/dist/vendors') }}/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
    <link href="{{ url('assets/dist/vendors') }}/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>

@endsection

@section('scripts')

    <script type="text/javascript" src="{{ url('assets/dist/vendors') }}/bower_components/moment/min/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="{{ url('assets/dist/vendors') }}/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Bootstrap Daterangepicker JavaScript -->
    <script src="{{ url('assets/dist/vendors') }}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Form Picker Init JavaScript -->
    <!-- ChartJS JavaScript -->
    <script src="{{ url('assets/dist/vendors') }}/chart.js/Chart.min.js"></script>
    <script>


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