@extends('layouts.account')

@section('content')
    <h5>{{ $branch->name }}</h5>

    <div class="row heading-bg">
        <div class="col-lg-3 col-md-3 col-xs-12">

            <h6 class="txt-dark">
                <a href="{{ route('branches.points.editor',['point'=>'new','branch'=>$branch->id]) }}" class="btn  btn-circle btn-icon-anim btn-success btn-sm">
                    <i class="fa fa-plus"></i>
                </a>
                {{ __('All Points') }}
            </h6>

        </div>

        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li><a href="#"><span>{{ __('Branches') }}</span></a></li>
                <li><a href="{{ route('branches.branches') }}"><span>{{ __('Branches') }}</span></a></li>
                <li class="active"><span>{{ $branch->name }}</span></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{ __('QR-Code') }}</th>
                                        <th>{{ __('Point Name') }}</th>
                                        <th>{{ __('title') }}</th>
                                        <th>{{ __('text') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Responses') }}</th>
                                        <th>{{ __('Options') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($branch->points as $point)
                                        <tr>
                                            <td>
                                                <a href="{{ url($point->qrcode) }}" target="_blank">
                                                    <img src="{{ url($point->qrcode) }}" width="80"></a>
                                            </td>
                                            <td>
                                                <a target="_blank" href="{{ url('view/point/'.$point->id) }}">{{ $point->name }}</a>
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
                                                            if($questions->count()){echo $answers/$questions->count();}else{ echo 0; }

                                                    }else{
                                                ?>
                                                    {{ (isset($point->form->responses))?$point->form->responses->count():0 }}
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <a data-toggle="tooltip" title="{{ __('Live Editor')}}" href="{{ route('branches.points.editor',['point'=>$point->id,'branch'=>$branch->id]) }}" class="btn btn-icon-anim btn-circle btn-sm btn-success">
                                                    <i class="fa fa-file"></i>
                                                </a>
                                                <a data-toggle="tooltip" title="{{ __('View Responses')}}" href="{{ route('branches.points.responses',['point'=>$point->id]) }}" class="btn btn-icon-anim btn-circle btn-sm btn-primary">
                                                    <i class="fa fa-list"></i>
                                                </a>
                                                <a data-toggle="modal" data-target="#delete_{{$point->id}}" title="{{ __('Delete !!')}}" href="#"
                                                   onclick="return confirm('{{ __('Are you sure you want to delete this point?') }}')" class="btn btn-sm btn-icon-anim btn-circle btn-danger">
                                                    <i class="icon-trash"></i>
                                                </a>
                                                <div id="delete_{{$point->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h5 class="modal-title" id="myModalLabel">{{ __('Delete Point') }} - {{ $point->name }}</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p> {{ __('By deleting this point all saved data will be removed,
                                                                    please export before deleting to prevent any loss of data.') }}</p>
                                                                <a href="{{ route('branches.points.delete',['point'=>$point->id]) }}"
                                                                   onclick="return confirm('{{ __('Are you sure you want to delete this point?') }}')" class="btn btn-danger pull-right">
                                                                    <i class="icon-trash"></i> {{ __('Delete') }}</a>

                                                                <a target="_blank" href="{{ route('branches.points.export',['point'=>$point->id]) }}"
                                                                   class="btn btn-warning pull-right">
                                                                    <i class="fa fa-download"></i>   {{ __('Export') }}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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