@extends('layouts.point-layout')

@section('content')
       <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <form action="{{ route('feedback.submit',['form'=>$point->form->id]) }}" method="post">
                            @csrf
                            <p align="center">
                                <img width="150" height="90" src="{{ url($point->team->settings->logo) }}">
                            </p>
                            <p align="center">{{ $point->branch->name }} - {{ $point->name }}</p>

                            <h3 class="mt-15 text-center">{{ $point->title }}</h3>

                            <h5 class="mt-10" id="rate-heading">{{ $point->form->rate_label }}</h5>

                            <div class="btn-group mt-15 mr-10">

                                <button type="button" data-target="#excellent" class="btn btn-rate btn-default btn-outline btn-rounded">
                                    <img src="{{ url('assets/img/excellent.png') }}" width="40">
                                    <input type="radio" required class="rate-radio" name="rate" style="display: none"  value="excellent"  >
                                </button>

                                <button type="button" data-target="#average" class="btn btn-rate btn-default btn-outline btn-rounded">
                                    <img src="{{ url('assets/img/average.png') }}" width="40">
                                    <input type="radio"  class="rate-radio" name="rate" style="display: none" value="average" >
                                </button>

                                <button type="button" data-target="#verypoor" class="btn btn-rate btn-default btn-rounded btn-outline">
                                    <img src="{{ url('assets/img/verypoor.png') }}" width="40">
                                    <input type="radio"  class="rate-radio" name="rate" style="display: none" value="verypoor" >
                                </button>

                            </div>
                            @php
                                $Fields = (isset($point->form->fields))?json_decode($point->form->fields,true):['email'=>'yes','feedback'=>'no'];
                            @endphp
                            @if(array_key_exists('email',$Fields))
                            <div id="email-field" class="input-group mt-10">
                                <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                <input type="email" @if($Fields['email']=='yes') required @endif name="email" class="form-control" id="email" placeholder="{{ __('Email Address') }}">
                            </div>
                            @endif
                            @if(array_key_exists('phone',$Fields))
                            <div id="phone-field" class="input-group mt-10">
                                <div class="input-group-addon"><i class="icon-phone"></i></div>
                                <input type="text" @if($Fields['phone']=='yes') required @endif name="phone" class="form-control" id="" placeholder="{{ __('Phone Number') }}">
                            </div>
                            @endif
                            @if(array_key_exists('feedback',$Fields))
                            <div  id="feedback-field" class=" mt-10">
                                <textarea class="form-control  mt-10" @if($Fields['feedback']=='yes') required @endif name="feedback" rows="5" placeholder="{{ __('Your Feedback') }}"></textarea>
                            </div>
                            @endif
                            <button id="submit-btn" class="btn btn-lg btn-rounded btn-primary btn-block mt-10 theme-color">{{ $point->form->submit_text }}</button>
                        </form>
                    </div>
                </div>
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