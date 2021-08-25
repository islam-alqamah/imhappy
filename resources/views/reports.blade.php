@extends('layouts.account')

@section('content')

    <!-- Row -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-20">
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
                        <div class="btn-group">
                            <div class="dropup ">
                                <button aria-expanded="true" data-toggle="dropdown" class="btn btn-primary btn-outline fancy-button btn-0 btn-xs dropdown-toggle " type="button">
                                    {{ __('Import') }} <span class="caret"></span></button>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a data-toggle="modal" data-target="#import-form" href="#">{{ __('Upload .xls File') }}</a></li>
                                    <li><a target="_blank" href="{{ route('branches.responses.export') }}">{{ __('Download Example File') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover display  pb-30" >
                                    <thead>
                                    <tr>
                                        <th>{{ __('Date / Time') }}</th>
                                        <th>{{ __('City') }}</th>
                                        <th>{{ __('Branch') }}</th>
                                        <th>{{ __('Point') }}</th>
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
                                            <td>{{ $response->branch->city->name }}</td>
                                            <td>{{ $response->branch->name }}</td>
                                            <td>{{ $response->form->point->name }}</td>
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

    <!-- /Row -->
    <!-- Row -->
    <div id="import-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myModalLabel">{{ __('Import Responses') }} </h5>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{ route('branches.responses.import') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('Please Upload xls File') }}</label>
                            <input required type="file" accept=".xlsx" name="file_to_import" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-outline fancy-button btn-0">{{ __('Import Now') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
    @if(App::getLocale()=='ar')
        <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables/media/js/ar.jquery.dataTables.min.js"></script>
    @else
        <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    @endif
    <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
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

</script>
@endsection