@extends('layouts.account')

@section('content')

    <div class="row">

        <div class="col-md-12 mt-20">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{ __('All Branches') }}</h6>
                    </div>
                    <div class="pull-right">
                        <button href="#" id="open_right_sidebar" class="btn btn-primary btn-outline fancy-button btn-0 btn-xs">
                            <i class="fa fa-plus" style="color: #fff"></i>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body" >
                        <div class="table-wrap" style="overflow: auto">
                                <table id="example" class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Branch Name') }}</th>
                                        <th>{{ __('City') }}</th>
                                        <th>{{ __('Points') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        <th>{{ __('Address') }}</th>

                                        <th>{{ __('Options') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($branches as $branch)
                                    <tr>
                                        <td><a href="{{ route('branches.branches.points',['branch'=>$branch->id]) }}"> {{ $branch->name }} </a></td>
                                        <td>{{ $branch->city->name }}</td>
                                        <td>{{ $branch->points->count() }}</td>
                                        <td>{{ $branch->phone }}</td>
                                        <td>{{ $branch->address }}</td>

                                        <td >
                                            <div class="btn-group">
                                                <div class="dropdown">
                                                    <button aria-expanded="false" data-toggle="dropdown" style="border: none" class="btn btn-circle btn-default btn-outline dropdown-toggle" type="button">
                                                        <i class="fa fa-bars"></i> <span class="caret"></span></button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        <li>
                                                            <a
                                                               href="{{ route('branches.branches.points',['branch'=>$branch->id]) }}">
                                                               <i class="fa fa-th"></i> {{ __('Manage Points') }}
                                                                </a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li><a  data-toggle="modal"  data-target="#edit-branch-{{ $branch->id }}" href="#">
                                                                <i class="fa fa-edit"></i> {{ __('Edit') }}    </a></li>
                                                        <li class="divider"></li>
                                                        <li><a class="del-btn" data-toggle="modal" data-target="#delete_{{$branch->id}}" href="#">
                                                                <i class="icon-trash"></i> {{ __('Delete') }}    </a></li>

                                                    </ul>
                                                </div>
                                            </div>

                                            <div id="delete_{{$branch->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h5 class="modal-title" id="myModalLabel">{{ __('Delete Branch') }} - {{ $branch->name }}</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <p align="center"> By deleting this branch all saved data will be removed.</p>
                                                                    <p align="center" class="msg"> Please export before deleting to prevent any loss of data.</p>
                                                                    <p align="center" class="msg-confirmation" style="display: none;"> Are you sure you want to delete ? </p>
                                                                    <br/>
                                                                    <p class="options-btn" align="center">
                                                                        <a target="_blank" href="{{ url('reports') }}"
                                                                           class="btn btn-primary btn-outline fancy-button btn-0" style="margin-right: 5px">
                                                                            <i class="fa fa-download"></i>   {{ __('Export') }}</a>
                                                                        <a href="#" class="btn btn-danger btn-outline fancy-button btn-0 btn-delete" >
                                                                            <i class="icon-trash"></i> {{ __('Delete') }}</a>
                                                                    </p>
                                                                    <p align="center" class="confirmation-btn" style="display: none">
                                                                        <a href="#"  data-dismiss="modal" aria-hidden="true" class="btn btn-primary btn-outline fancy-button btn-0 " >
                                                                            <i class="icon-ban"></i> {{ __('No') }}</a>
                                                                        <a href="{{ route('branches.branches.delete',['branch'=>$branch->id]) }}"
                                                                           class="btn btn-danger btn-outline fancy-button btn-0 " >
                                                                            <i class="icon-trash"></i> {{ __('Yes') }}</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div id="edit-branch-{{ $branch->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title" id="myModalLabel">{{ __('Edit Branch') }} - {{ $branch->name }}</h5>
                                                </div>
                                                <form action="{{ route('branches.branches.update') }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="city">
                                                                {{ __('Branch Name') }}
                                                            </label>
                                                            <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                                                            <input required type="text" name="name" value="{{ $branch->name }}" class="form-control" id="city" placeholder="{{ __('Branch Name') }}">

                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="city">
                                                                {{ __('City') }}
                                                            </label>

                                                            <select required name="city" class="form-control select2 ">
                                                                @foreach($cities as $city)
                                                                    <option @if($branch->city_id == $city->id) selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="phone">
                                                                {{ __('Branch Phone') }}
                                                            </label>

                                                            <input type="text" name="phone" value="{{ $branch->phone }}" class="form-control" id="phone" placeholder="{{ __('Phone') }}">

                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="address">
                                                                {{ __('Branch Address') }}
                                                            </label>

                                                            <input type="text" name="address" value="{{ $branch->address }}" class="form-control" id="address" placeholder="{{ __('Address') }}">

                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-outline fancy-button btn-0 pull-right "><i class="fa fa-floppy-o"></i> {{ __('Save') }}</button>
                                                        <button type="button" class="btn btn-danger btn-outline fancy-button btn-0 pull-left" data-dismiss="modal">
                                                            {{ __('Close') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed-sidebar-right">
        <ul class="right-sidebar" style="background: #f8f8f8">
            <li>
                <form action="{{ route('branches.branches.new') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label mb-5" for="city">
                                {{ __('Branch Name') }}
                            </label>

                            <input type="text" required name="name" class="form-control" id="city" placeholder="">

                        </div>
                        <div class="form-group  mt-25">
                            <label class="control-label mb-5" for="city">
                                {{ __('City') }}
                            </label>

                            <select required id="city" name="city" class="form-control select2 ">
                                <option value="-1"> {{ __('Select City') }}</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                                <option value="0">{{ __('-Add New City-') }}</option>
                            </select>
                        </div>
                        <div class="form-group  mt-25" id="new-city" style="display: none">
                            <label class="control-label mb-5" for="city_name">
                                {{ __('City Name') }}
                            </label>

                            <input type="text" name="city_name" class="form-control" id="city_name" placeholder="">

                        </div>
                        <div class="form-group  mt-25">
                            <label class="control-label mb-5" for="phone">
                                {{ __('Branch Phone') }}
                            </label>

                            <input type="text" name="phone" class="form-control" id="phone" placeholder="">

                        </div>

                        <div class="form-group mt-25">
                            <label class="control-label mb-5" for="address">
                                {{ __('Branch Address') }}
                            </label>

                            <input type="text" name="address" class="form-control" id="address" placeholder="">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-outline fancy-button btn-0 pull-right "><i class="fa fa-floppy-o"></i> {{ __('Save') }}</button>

                    </div>
                </form>
            </li>
        </ul>
    </div>

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
    <script>
        $(document).on('change','#city',function () {
            if($(this).val() == 0){
                $('#new-city').show();
            }else{
                $('#new-city').hide();
            }
        });
        $(document).on('click','.btn-delete',function () {
            $('.options-btn').hide();
            $('.msg').hide();
            $('.confirmation-btn').show();
            $('.msg-confirmation').show();
        });
        $(document).on('click','.del-btn',function (){
            $('.options-btn').show();
            $('.msg').show();
            $('.confirmation-btn').hide();
            $('.msg-confirmation').hide();
        });
    </script>
@endsection