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
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <h5 class="text-center">{{ __('Feedback Editor') }}</h5>
                        <hr>
                        <form method="post" action="{{ route('branches.editor.save',['point'=>$point->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('Theme Color') }}</label>
                                <input  type="text" id="theme-color" name="theme_color"
                                        class="colorpicker editor form-control" value="{{ (isset($point->form->theme_color))?$point->form->theme_color: '#0098a3' }}" />
                            </div>
                            <div class="form-group">
                                <label>{{ __('Rate Label') }}</label>
                                <input  type="text" id="rate-label" name="rate_label"
                                        class="editor form-control" value="{{ (isset($point->form->rate_label))?$point->form->rate_label: __('Please rate for us') }}" />

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3"> <label>{{ __('Fields') }}</label></div>
                                    <div class="col-sm-3"> <label>{{ __('Required') }}</label></div>
                                </div>
                                @php
                                    $Fields = (isset($point->form->fields))?json_decode($point->form->fields,true):['email'=>'yes','feedback'=>'no'];
                                @endphp
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="checkbox checkbox-primary mt-10">
                                            <input name="fields[]" id="email" value="email" class="field_editor editor"

                                                   type="checkbox" {{ (array_key_exists('email',$Fields))? 'checked' :'' }}>
                                            <label for="email"> {{ __('Email') }} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                            <input name="required[]"  id="email-r" value="email"  data-size="small" class="js-switch js-switch-1" data-color="#2ecd99"
                                                   {{ (isset($Fields['email']) && $Fields['email']=='yes')?'checked':'' }}  type="checkbox" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="checkbox checkbox-primary  mt-10">
                                            <input name="fields[]"  id="phone" value="phone" class="field_editor editor" type="checkbox"
                                                    {{ (array_key_exists('phone',$Fields))? 'checked' :'' }} >
                                            <label for="phone"> {{ __('Phone') }} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                            <input name="required[]" id="phone-r" value="phone"   data-size="small" class="js-switch js-switch-1" data-color="#2ecd99"
                                                   {{ (isset($Fields['phone']) && $Fields['phone']=='yes')?'checked':'' }} type="checkbox" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="checkbox checkbox-primary  mt-10">
                                            <input name="fields[]" id="feedback" value="feedback" class="field_editor editor" type="checkbox"
                                                    {{ (array_key_exists('feedback',$Fields))? 'checked' :'' }}>
                                            <label for="feedback"> {{ __('Feedback') }} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                            <input name="required[]" id="feedback-r" value="feedback"  data-size="small" class="js-switch js-switch-1" data-color="#2ecd99"
                                                   {{ (isset($Fields['feedback']) && $Fields['feedback']=='yes') ? 'checked':'' }}  type="checkbox">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Submit button text') }}</label>
                                <input  type="text" id="submit-text" name="submit_text"
                                        class="editor form-control" value="{{ (isset($point->form->submit_text))?$point->form->submit_text: __('Send Now') }}" />
                            </div>

                            <button type="submit" class="btn btn-success pull-right "><i class="fa fa-floppy-o"></i> {{ __('Save') }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <h5 class="text-center">{{ __('Live Preview') }}
                            <a target="_blank" href="{{ route('view.point',['point'=>$point->id]) }}"><i class="fa fa-laptop"></i></a></h5>
                        <hr>
<div class="panel-body" style="padding: 10px 80px">
                        <p align="center">
                            <img width="150" height="90" src="{{ url('images/logos/default.png') }}">
                        </p>
                        <p align="center">{{ $point->branch->name }}</p>

                        <h3 class="mt-15">{{ $point->title }}</h3>

                        <h5 class="mt-10" id="rate-heading">{{ __('Please rate for us') }}</h5>

                        <div class="btn-group mt-15 mr-10">
                            <button type="button" class="btn theme-color btn-default btn-rounded">
                                <img src="{{ url('assets/img/excellent.png') }}" width="40">
                            </button>
                            <button type="button" class="btn btn-default btn-outline btn-rounded">
                                <img src="{{ url('assets/img/average.png') }}" width="40">
                            </button>
                            <button type="button" class="btn btn-default btn-rounded btn-outline">
                                <img src="{{ url('assets/img/verypoor.png') }}" width="40">
                            </button>
                        </div>
                        <div id="email-field" class="input-group mt-10">
                            <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                            <input type="email" class="form-control" id="" placeholder="Enter email">
                        </div>

                        <div id="phone-field" class="input-group mt-10">
                            <div class="input-group-addon"><i class="icon-phone"></i></div>
                            <input type="text" class="form-control" id="" placeholder="Enter Phone">
                        </div>
                        <div  id="feedback-field" class=" mt-10">
                            <textarea class="form-control  mt-10" rows="5" placeholder="Enter Your Feedback"></textarea>
                        </div>
                            <button id="submit-btn" class="btn btn-lg btn-primary btn-block mt-10 theme-color">{{ __('Send Now') }}</button>
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
@endsection

@section('scripts')
    <script src="{{ url('assets/dist/vendors') }}/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/switchery/dist/switchery.min.js"></script>

    <script>
        /* Bootstrap Colorpicker Init*/
        $('#theme-color').colorpicker();
        $('#theme-color').on('focusout',function () {
            var color = $(this).val();
            $('.theme-color').css('background',color);
        })
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch-1').each(function () {
                new Switchery($(this)[0], $(this).data());
            });
        $('.field_editor').on('change',function () {
            live_fields();
        });
        $('#submit-text').on('keyup',function () {
            live_fields();
        });
        $('#rate-label').on('keyup',function () {
            live_fields();
        });
            function live_fields() {
                $('.theme-color').css('background',$('#theme-color').val());

                $('#rate-heading').text($('#rate-label').val());
                $('#submit-btn').text($('#submit-text').val());

                $('.field_editor').each(function () {
                    if($(this).prop('checked')){
                        $('#'+$(this).attr('id')+'-field').show();
                    }else{
                        $('#'+$(this).attr('id')+'-field').hide();
                    }
                });
            }
            live_fields();
    </script>
@endsection