@extends('layouts.account')

@section('content')
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-3 col-xs-12">

            <h6 class="txt-dark">
                {{ $branch->name }} - {{ (isset($point->name))?$point->name:'' }}
            </h6>

        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li><a href="#"><span>{{ __('Branches') }}</span></a></li>
                <li><a href="{{ route('branches.branches') }}"><span>{{ __('Branches') }}</span></a></li>
                <li><a href="{{ route('branches.branches.points',['branch'=>$branch->id]) }}">
                        <span>{{ $branch->name }}</span></a></li>
                <li class="active"><span>{{ (isset($point->name))?$point->name:'' }}</span></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="tab-struct custom-tab-2 ">
                <ul role="tablist" class="nav nav-tabs" id="myTabs_15">
                    <li class="active" role="presentation">
                        <a aria-expanded="true" data-toggle="tab" role="tab" id="home_tab_15" href="#home_15">
                            {{ __('Point Preferences') }}
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a data-toggle="tab" id="profile_tab_15" role="tab" href="#profile_15" aria-expanded="false">{{ __('Content') }}</a>
                    </li>
                </ul>
                <form method="post" action="{{ route('branches.editor.save',['branch'=>$branch->id,'point'=>(isset($point->id))?$point->id:'new']) }}">
                    @csrf
                <div class="tab-content" id="myTabContent_15">
                    <div id="home_15" class="tab-pane fade active in" role="tabpanel">
                        <div class="form-group">
                            <label class="control-label mb-10" for="point-type">
                                {{ __('Point Type') }}
                            </label>
                            <select id="point-type" name="type" class="form-control">
                                <option @if(isset($point->type) && $point->type == 'feedback') selected @endif
                                value="feedback">{{ __('QR-Code') }}</option>
                                <option  @if(isset($point->type) && $point->type == 'survey') selected @endif
                                value="survey">{{ __('Touchless') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-10" for="name">
                                {{ __('Point Name') }}
                            </label>

                            <input type="text" required value="{{ (isset($point->name))?$point->name:'New Point' }}" name="name" class="form-control" id="name" placeholder="{{ __('Point Name') }}">

                        </div>
                        <div class="form-group">
                            <label>{{ __('Theme Color') }}</label>
                            <input  type="text" id="theme-color" name="theme_color"
                                    class="colorpicker editor form-control" value="{{ (isset($point->form->theme_color))?$point->form->theme_color: '#0098a3' }}" />
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-10" for="title">
                                {{ __('Point-Page Title') }}
                            </label>

                            <textarea type="text" name="title" class="form-control" id="title" placeholder="{{ __('Point-Page Title') }}">{{ (isset($point->title))?$point->title:'Page title example' }}</textarea>

                        </div>
                        <div class="form-group">
                            <label>{{ __('Sub Title') }}</label>
                            <input  type="text" id="rate-label" name="rate_label"
                                    class="editor form-control" value="{{ (isset($point->form->rate_label))?$point->form->rate_label: __('Sub Title') }}" />

                        </div>
                        <div class="form-group">
                            <label class="control-label mb-10" for="text">
                                {{ __('Thank-you message') }}
                            </label>

                            <input type="text" name="text" value="{{ (isset($point->text))?$point->text:'Thank you for rating' }}" class="form-control" id="text" placeholder="{{ __('Thank you Page Text') }}">
                        </div>
                        <div class="form-group mt-10">
                            <label>{{ __('Submit button text') }}</label>
                            <input  type="text" id="submit-text" name="submit_text"
                                    class="editor form-control" value="{{ (isset($point->form->submit_text))?$point->form->submit_text: __('Send Now') }}" />
                        </div>
                        <div class="row"> <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-outline fancy-button btn-0 btn-block">
                                    <i class="fa fa-floppy-o"></i> {{ __('Save') }}</button>
                            </div> </div>
                    </div>
                    <div id="profile_15" class="tab-pane fade" role="tabpanel">
                        <div id="feedback-editor">
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

                                <hr />
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="checkbox checkbox-primary  mt-10">
                                            <input name="dummy_data" id="dummy-data" value="dummy_data"type="checkbox">
                                            <label for="dummy-data"> {{ __('Dummy Data') }} </label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div id="survey-editor" style="display: none">
                            <div class="form-group">
                                <label>{{ __('Survey Template') }}</label>
                                <select
                                        id="surveyTemplate"
                                        class="form-control"
                                        name="survey_template">
                                    <option  selected value="0">{{ __('Choose Template') }}</option>
                                    @foreach($survey_templates as $template)
                                        <option value="{{ $template->id }}">{{ $template->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="questions" style="border: 1px solid #eeeeee;margin: 10px 0;">
                                @if(isset($point->form->questions))
                                    @foreach($point->form->questions as $item)
                                        <div class="question" style="">
                                            <button type="button" class="btn btn-circle btn-sm btn-outline btn-danger remove pull-right" >
                                                <i class="ti-trash"></i></button>
                                            <div class="form-group">
                                                <label>{{ __('Question') }}</label>
                                                <textarea name="question[]" required
                                                          class="form-control input-sm question-input"
                                                          placeholder="{{ __('Enter Your Question') }}">{!! $item->question !!}</textarea>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12"><label>{{ __('Answers') }}</label></div>
                                                <div class="col-sm-12">
                                                    <input type="hidden" name="answers[]" value="{{ $item->answers }}" class="formatted-answers" >
                                                    @foreach(explode(',',$item->answers) as $answer)
                                                        <input name="answer" value="{{ $answer }}" style="width: 40%;float: left ;margin: 0 10px"  required class="form-control input-sm input-answer" placeholder="{{ __('Enter Answer') }}">
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else

                                @endif
                            </div>
                            <button type="button"
                                    class="btn add_quest btn-sm btn-rounded btn-primary float-right">
                                <i class="ti-plus"></i> {{ __('Add Question ') }}  </button>
                        </div>

                        <div class="row"> <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-outline fancy-button btn-0 btn-block">
                                    <i class="fa fa-floppy-o"></i> {{ __('Save') }}</button>
                            </div> </div>
                    </div>

                </div>
                </form>
            </div>
        </div>
        <div class="col-md-7">

            <h5 class="text-center">{{ __('Live Preview') }}
                @if(isset($point->id))
                    <a target="_blank" href="{{ route('view.point',['point'=>$point->id]) }}">
                        <i class="fa fa-laptop"></i></a>
                @endif
            </h5>
            <div class="panel  card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="panel-body" style="padding: 10px 80px">
                        <p align="center">
                            <img width="150" height="90" src="{{ url($settings->logo) }}">
                        </p>
                        <p align="center">{{ $branch->name }}</p>

                        <h3 class="mt-15 point-title text-center">{!!  isset($point->title)?$point->title:'' !!}</h3>

                        <h5 class="mt-10 text-center" id="rate-heading">{{ __('Sub Heading') }}</h5>
                        <div id="live_preview"style="display: none" ></div>
                        <div id="live_preview_fields "class="text-center" >
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

                        </div>
                            <button id="submit-btn" class="btn btn-rounded btn-lg btn-primary btn-block mt-30 theme-color">{{ __('Send Now') }}</button>
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
    <style>
        .question{
            margin:5px;padding: 5px; border:1px dashed #eeeeee
        }

    </style>
@endsection

@section('scripts')
    <script src="{{ url('assets/dist/vendors') }}/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/switchery/dist/switchery.min.js"></script>
    <script>
        $(document).on('change','#point-type',function () {
            var type = $(this).val();
            point_type(type);
        });
        @if(isset($point->type))
        point_type('{{ $point->type }}');
        @endif
        function point_type(type) {
            if(type == 'feedback'){
                $('#feedback-editor').show();
                $('#survey-editor').hide();
                $('#live_preview').hide();
                $('#live_preview_fields').show();
                live_fields();
                live_preview();
            }else{
                $('#feedback-editor').hide();
                $('#survey-editor').show();
                $('#live_preview').show();
                $('#live_preview_fields').hide();
                live_fields();
                live_preview();
            }
        }

    </script>
    <script>
        function live_preview(){

            var live_preview = '';
            $('.question').each(function (i) {
                var question = $(this).find('.question-input').val();
                var answers = $(this).find('.input-answer');
                console.log(answers)
                live_preview += '<h5 class="mb-5 mt-5">'+question.replace(/(?:\r\n|\r|\n)/g, '<br>')+'</h5>';
                live_preview += '<p class="mb-5 mt-5">';
                answers.each(function (item,index) {
                    var thumbs = '';
                    if($(this).index() == 1){
                        thumbs = '<i class="zmdi zmdi-thumb-up font-24"></i>';
                    }
                    if($(this).index() == 2){
                        thumbs = '<i class="zmdi zmdi-thumb-down font-24"></i>';
                    }
                    live_preview += '<button type="button" class="btn btn-rounded  theme-color btn-primary btn-outline">' +
                        thumbs+' '+$(this).val()+'</button> ';
                })
                live_preview += '</p>';

            });
            $('.point-title').html($('#title').val().replace(/(?:\r\n|\r|\n)/g, '<br>'));
            $('#live_preview').html(live_preview);
            $('.theme-color').css('background',$('#theme-color').val());
            $('.theme-color').css('border-color',$('#theme-color').val());
            $('.theme-color.btn-outline').css('color',$('#theme-color').val());

        }
        @if(isset($point->form->questions) && $point->form->questions->count())
        live_preview();
        @endif
        live_preview();
        $(document).on('keyup','.question-input,.input-answer,.remove,#title',function () {
            live_preview();
        });
    </script>
    <script>
        $(document).on('change','#surveyTemplate',function () {
            var TemplateId = $(this).val();
            if(TemplateId != 0){
                $.ajax({
                    type: "get",
                    url: ApiURL + "survey/template/"+TemplateId+"/questions",
                    success: function(results)
                    {
                        var template = results.template;
                        console.log(template);
                        var data = Object.entries(results.questions);
                        if(data.length){
                            $('.questions').html('');
                            $('.point-title').html(template.title.replace(/(?:\r\n|\r|\n)/g, '<br>'));
                            $('#title').val(template.title)
                            data.forEach(function (item) {
                                var question = item[0];
                                var answer = item[1].split(',');
                                $('.questions').append(
                                    '<div class="question" style="">\n' +
                                    '         <button type="button" class="btn btn-circle btn-sm btn-outline btn-danger remove pull-right" >\n' +
                                    '             <i class="ti-trash"></i></button>\n' +
                                    '         <div class="form-group">\n' +
                                    '             <label>{{ __('Question') }}</label>\n' +
                                    '             <textarea name="question[]" required class="form-control input-sm question-input" placeholder="{{ __('Enter Your Question') }}">'+question+'</textarea>\n' +
                                    '         </div>\n' +
                                    '\n' +
                                    '         <div class="form-group row">\n' +
                                    '             <div class="col-sm-12"><label>{{ __('Answers') }}</label></div>\n' +
                                    '             <div class="col-sm-12">\n' +
                                    '                 <input type="hidden" value="'+item[1]+'" name="answers[]" class="formatted-answers" >\n' +
                                    '                 <input name="answer" value="'+answer[0]+'" style="width: 40%;float: left ;margin: 0 10px"  required class="form-control input-sm input-answer" placeholder="{{ __('Enter Answer') }}">\n' +
                                    '                 <input name="answer" value="'+answer[1]+'" style="width: 40%;float: left" required class="form-control input-sm input-answer" placeholder="{{ __('Enter Answer') }}">\n' +
                                    '             </div>\n' +
                                    '         </div>\n' +
                                    '     </div>'
                                );
                            });

                        }
                        live_preview();

                    }
                });
            }
        });


        $(document).on('click','.add_quest',function () {
            $(this).parent().children('.questions').append(
                '<div class="question" style="">\n' +
                '               <button type="button" class="btn btn-circle btn-sm btn-outline btn-danger remove pull-right" >\n' +
                '                   <i class="ti-trash"></i></button>\n' +
                '               <div class="form-group">\n' +
                '                   <label>{{ __('Question') }}</label>\n' +
                '                   <textarea name="question[]" required class="form-control input-sm question-input" placeholder="{{ __('Enter Question') }}"></textarea>\n' +
                '               </div>\n' +
                '\n' +
                '               <div class="form-group row">\n' +
                '                   <div class="col-sm-12"><label>{{ __('Answers') }}</label></div>\n' +
                '                   <div class="col-sm-12">\n' +
                '                       <input type="hidden" name="answers[]" class="formatted-answers" >\n' +
                '                       <input name="answer" style="width: 40%;float: left ;margin: 0 10px"  required class="form-control input-sm input-answer" placeholder="{{ __('Enter Answer') }}">\n' +
                '                       <input name="answer" style="width: 40%;float: left" required class="form-control input-sm input-answer" placeholder="{{ __('Enter Answer') }}">\n' +
                '                   </div>\n' +
                '               </div>\n' +
                '           </div>'
            );
        });
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch-1').each(function () {
            new Switchery($(this)[0], $(this).data());
        });
        $('.field_editor').on('change',function () {
            live_fields();
        });
        $(document).on('click','.remove',function () {
            $(this).parent('.question').remove();
        });

        $(document).on('keyup','.input-answer',function () {
            var target = $(this).parent();
            var result = target.children('.input-answer');
            var formmated_answers = [];
            result.each(function (i) {
                formmated_answers.push($(this).val());
            })
            target.children('.formatted-answers').val(formmated_answers.toString());
        });
    </script>
    <script>
        /* Bootstrap Colorpicker Init*/
        $('#theme-color').colorpicker();
        $('#theme-color').on('focusout',function () {
            var color = $(this).val();
            $('.theme-color').css('background',color);
            $('.theme-color').css('border-color',color);
            $('.theme-color.btn-outline').css('color',color);
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