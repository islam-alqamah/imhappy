@extends('layouts.account')

@section('content')


    <div class="row">

        <div class="col-md-12 mt-20">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark"> {{ __('All Points') }}</h6>
                    </div>
                    <div class="pull-right">

                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap" >
                                <table id="example" class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Point ID') }}</th>
                                        <th>{{ __('Branch Name') }}</th>
                                        <th>{{ __('QR-Code') }}</th>
                                        <th>{{ __('Point Name') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Text') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Responses') }}</th>
                                        <th>{{ __('Options') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($points as $point)
                                        @if($point->branch)
                                        <tr>
                                            <td>{{ $point->id }}</td>
                                            <td>
                                                <a href="{{ route('branches.branches.points',['branch'=>$point->branch->id]) }}" target="_blank">
                                                    {{ $point->branch->name }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url($point->qrcode) }}" target="_blank">
                                                    <img src="{{ url($point->qrcode) }}" width="80"></a>
                                            </td>
                                            <td>
                                                <a href="{{ url('view/point/'.$point->id) }}">{{ $point->name }}</a>
                                            </td>
                                            <td>{{ $point->title }}</td>
                                            <td>{{ $point->text }}</td>
                                            <td>{{ $point->type=='survey'?'Touchless':'QR-Code' }}</td>
                                            <td>
                                                <?php

                                                if($point->type == 'survey'){
                                                    $questions = $point->form->questions;
                                                    $answers = 0;
                                                    foreach ($questions as $question){
                                                        $answers += \App\Models\QuestionAnswer::where('question_id',$question->id)->get()->count();
                                                    }
                                                    if($questions->count()){
                                                        echo $answers/$questions->count();
                                                    }else{
                                                        echo 0;
                                                    }
                                                }else{
                                                ?>
                                                {{ (isset($point->form->responses))?$point->form->responses->count():0 }}
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td >
                                                <div class="btn-group">
                                                    <div class="dropdown">
                                                        <button aria-expanded="false" data-toggle="dropdown" style="border:none" class="btn btn-default btn-circle btn-outline dropdown-toggle" type="button">
                                                            <i class="fa fa-bars"></i> <span class="caret"></span></button>
                                                        <ul role="menu" class="dropdown-menu">
                                                            <li>
                                                                <a href="{{ route('branches.points.editor',['point'=>$point->id,'branch'=>$point->branch->id]) }}">
                                                                    <i class="fa fa-edit"></i> {{ __('Editor')}}
                                                                </a>
                                                            </li>
                                                            <li class="divider"></li>

                                                            <li>
                                                                <a target="_blank" href="{{ url('view/point/'.$point->id) }}">
                                                                    <i class="fa fa-laptop"></i> {{ __('Preview')}}
                                                                </a>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li><a href="{{ route('branches.points.responses',['point'=>$point->id]) }}">
                                                                    <i class="fa fa-eye"></i>    {{ __('View Responses')}}    </a></li>
                                                            <li class="divider"></li>
                                                            <li><a class="del-btn" data-toggle="modal" data-target="#delete_{{$point->id}}" href="#">
                                                                    <i class="icon-trash"></i> {{ __('Delete') }}    </a></li>

                                                        </ul>
                                                    </div>
                                                </div>

                                                <div id="delete_{{$point->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h5 class="modal-title" id="myModalLabel">{{ __('Delete Point') }} - {{ $point->name }}</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <p align="center"> {{ __('By deleting this point all saved data will be removed.') }}</p>
                                                                        <p align="center" class="msg"> {{ __('Please export before deleting to prevent any loss of data.') }}</p>
                                                                        <p align="center" class="msg-confirmation" style="display: none;"> {{ __('Are you sure you want to delete ?') }} </p>
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
                                                                            <a href="{{ route('branches.points.delete',['point'=>$point->id]) }}"
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
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
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