@extends('layouts.point-layout')

@section('content')
       <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <form action="{{ route('survey.submit',['form'=>$point->form->id]) }}" method="post">
                            @csrf
                            <p align="center">
                                <img width="150" height="90" src="{{ url($point->team->settings->logo) }}">
                            </p>
                            <p align="center">{{ $point->branch->name }} - {{ $point->name }}</p>

                            <h3 class="mt-15 text-center">{{ $point->title }}</h3>

                            <h5 class="mt-10" id="rate-heading">{{ $point->form->rate_label }}</h5>

                            @foreach($point->form->questions as $item)
                                <div class="question" >
                                    <h4>{{ $item->question }}</h4>
                                    <?php
                                    $answers = @explode(',',$item->answers);
                                    ?>
                                    @foreach($answers as $key=>$answer)
                                        <button class="check-btn btn btn-primary btn-rounded btn-outline theme-color" type="button">
                                            @if($key == 0) <i class="fa fa-thumbs-up font-24"></i> @endif
                                            @if($key == 1) <i class="fa fa-thumbs-down font-24"></i> @endif
                                            {{$answer}}
                                            <input required style="display: none"  name="answer[{{$item->id}}]" type="radio" value="{{ $answer }}">
                                        </button>
                                    @endforeach
                                </div>
                            @endforeach
                            <button id="submit-btn" class="btn btn-lg btn-primary btn-rounded btn-block mt-10 theme-color">{{ $point->form->submit_text }}</button>
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
           border-color: {{ $point->form->theme_color }} !important;
       }
       .clicked{
           color:#ffffff;
       }
       .theme-color.btn-outline{
           background-color: {{ $point->form->theme_color }} !important;
           border-color: {{ $point->form->theme_color }} !important;
           color: {{ $point->form->theme_color }} !important;
       }
       .question{
           padding: 10px;
       }
       .question h4{
           margin: 5px;
       }
   </style>
@endsection

@section('scripts')
    <script src="{{ url('assets/dist/vendors') }}/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/switchery/dist/switchery.min.js"></script>


    <script>
        $(document).on('click','.check-btn',function () {
            $(this).parent('.question').children('.check-btn').removeClass('clicked');
            $(this).parent('.question').children('.check-btn').addClass('btn-outline');
            $(this).addClass('clicked');
            $(this).removeClass('btn-outline');
            $(this).parent('.question').children('.check-btn').children('input[type="radio"]').removeAttr('checked');
            $(this).children('input[type="radio"]').prop('checked',true);
        });
    </script>
@endsection