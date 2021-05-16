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
            <div class="panel panel-default card-view">
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
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover display  pb-30" >
                                    <thead>
                                    <tr>
                                        <th>{{ __('Date / Time') }}</th>

                                        <th>{{ __('IP Address') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        <th>{{ __('Feedback') }}</th>
                                        <th>{{ __('Rate') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($responses as $response)
                                    <tr>
                                        <td>{{ $response->created_at }}</td>

                                        <td>{{ $response->user_ip }}</td>
                                        <td>{{ $response->email }}</td>
                                        <td>{{ $response->phone }}</td>
                                        <td>{{ $response->feedback }}</td>
                                        <td>
                                            <p align="center">
                                                <img alt="{{ $response->rate }}" width="30"
                                                                   src="{{ url('assets/img/').'/'.$response->rate.'.png' }}">
                                            </p>
                                            <p align="center">{{ $response->rate }}</p>
                                        </td>
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

    <!-- Data table JavaScript -->
    @if(App::getLocale()=='ar')
        <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables/media/js/ar.jquery.dataTables.min.js"></script>
    @else
        <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    @endif    <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/jszip/dist/jszip.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/pdfmake/build/vfs_fonts.js"></script>

    <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
    @if(App::getLocale()=='ar')
        <script src="{{ url('assets/dist/') }}/js/ar.export-table-data.js"></script>
    @else
        <script src="{{ url('assets/dist/') }}/js/export-table-data.js"></script>
    @endif

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
    </script>
@endsection