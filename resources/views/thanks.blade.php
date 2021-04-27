@extends('layouts.point-layout')

@section('content')
       <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                            <p align="center">
                                <img width="150" height="90" src="{{ url($point->team->settings->logo) }}">
                            </p>
                            <p align="center">{{ $point->branch->name }} - {{ $point->name }}</p>

                            <h5 class="mt-10 text-center" id="rate-heading">{{ $point->text }}</h5>

                    </div>
                </div>
            </div>
            <div class="pull-left">
            <a class="btn btn-circle btn-sm btn-primary" target="_blank" href="{{ $point->team->settings->facebook }}">
                <i class="fa fa-facebook font-18"></i> </a>
            <a class="btn btn-circle btn-sm btn-danger" target="_blank" href="{{ $point->team->settings->youtube }}">
                <i class="fa fa-youtube font-18"></i> </a>
            <a class="btn btn-circle btn-sm btn-default" target="_blank" href="{{ $point->team->settings->instagram }}">
                <i class="fa fa-instagram font-18"></i> </a>
            </div>
            <div class="pull-right">
                <a href="{{ url('/') }}"><img src="{{ url('images/logos/logo-h.png') }}" width="110"></a>
            </div>

        </div>
    </div>
@endsection

@section('styles')
   <style>
       .active-btn{
           background-color: {{ $point->form->theme_color }} !important;
       }
       .theme-color{
           background-color: {{ $point->form->theme_color }} !important;
       }
   </style>
@endsection

@section('scripts')
    <script src="{{ url('assets/dist/vendors') }}/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/switchery/dist/switchery.min.js"></script>

    <script>
        $('.btn-rate').on('click',function () {
            $('.rate-radio').removeAttr('checked');
            $('.btn-rate').removeClass('active-btn');
            $('.btn-rate').addClass('btn-outline');
            var btn_id = $(this).data('target');
            $(this).addClass('active-btn');
            $(this).removeClass('btn-outline');
            $(this).children('input[type="radio"]').prop('checked', true);
        });
    </script>
@endsection