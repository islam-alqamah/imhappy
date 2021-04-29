@extends('layouts.admin')

@section('content')
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">
                <button href="#" data-toggle="modal" data-target="#template-form" class="btn  btn-circle btn-icon-anim btn-success btn-sm">
                    <i class="fa fa-plus"></i>
                </button>
                {{ __('Survey Templates') }}</h5>
        </div>

        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}">{{ __('Dashboard') }}</a></li>
                <li><a href="#"><span>{{ __('Survey') }}</span></a></li>
                <li class="active"><span>{{ __('Templates') }}</span></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>

    <div class="row">
        <div id="template-form" class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h6 class="panel-title txt-dark">{{ __('Add New Template') }}</h6>
                    </div>
                    <form action="{{ route('admin.survey.template.new',['template'=> (isset($template) )? $template->id:0]) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label mb-10" for="city">
                                    {{ __('Template Name') }}
                                </label>
                                <input type="text" value="{{ (isset($template))?$template->name:'' }}" required name="name" class="form-control input-sm" id="city" placeholder="{{ __('Template Name') }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10" for="city">
                                    {{ __('Template Title') }}
                                </label>
                                <textarea type="text" required name="title" class="form-control input-sm" id="city" placeholder="{{ __('Template Title') }}">{{ (isset($template))?$template->title:'' }}</textarea>
                            </div>
                            <div class="questions" style="border: 1px solid #eeeeee">
                                @if(isset($template))
                                    @foreach(json_decode($template->questions) as $question=>$answers)
                                        <div class="question" style="">
                                            <button type="button" class="btn btn-circle btn-sm btn-outline btn-danger remove pull-right" >
                                                <i class="ti-trash"></i></button>
                                            <div class="form-group">
                                                <label>{{ __('Question') }}</label>
                                                <textarea name="question[]" required class="form-control input-sm question-input" placeholder="{{ __('Enter Your Question') }}">{{ $question }}</textarea>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12"><label>{{ __('Answers') }}</label></div>
                                                <div class="col-sm-12">
                                                    <input type="hidden" name="answers[]" value="{{ $answers }}" class="formatted-answers" >
                                                    @foreach(explode(',',$answers) as $answer)
                                                        <input name="answer" value="{{ $answer }}" style="width: 40%;float: left ;margin: 0 10px"  required class="form-control input-sm input-answer" placeholder="{{ __('Enter Answer') }}">
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="question" style="">
                                        <button type="button" class="btn btn-circle btn-sm btn-outline btn-danger remove pull-right" >
                                            <i class="ti-trash"></i></button>
                                        <div class="form-group">
                                            <label>{{ __('Question') }}</label>
                                            <input name="question[]" required class="form-control input-sm question-input" placeholder="{{ __('Enter Your Question') }}">
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12"><label>{{ __('Answers') }}</label></div>
                                            <div class="col-sm-12">
                                                <input type="hidden" name="answers[]" class="formatted-answers" >
                                                <input name="answer" style="width: 40%;float: left ;margin: 0 10px"  required class="form-control input-sm input-answer" placeholder="{{ __('Enter Answer') }}">
                                                <input name="answer" style="width: 40%;float: left" required class="form-control input-sm input-answer" placeholder="{{ __('Enter Answer') }}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button"
                                    class="btn add_quest btn-sm btn-rounded btn-primary float-right">
                                <i class="ti-plus"></i> {{ __('Add More ') }}  </button>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success pull-right "><i class="fa fa-floppy-o"></i> {{ __('Save') }}</button>
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">
                                {{ __('Close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


                    <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Template Name') }}</th>
                                        <th>{{ __('Template Title') }}</th>
                                        <th>{{ __('Questions') }}</th>
                                        <th>{{ __('Options') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($templates as $template)
                                        <tr>
                                            <td>{{ $template->name }}</td>
                                            <td>{{ $template->title }}</td>
                                            @php
                                                $questions = json_decode($template->questions,true);
                                            @endphp
                                            <td>
                                                @foreach($questions as $question=>$answer)
                                                    <small>{{ $question }}  <span class="badge badge-primary"> {{ $answer }} </span> </small><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                <button data-toggle="modal" data-target="#edit-template-{{ $template->id }}" class="btn btn-icon-anim btn-circle btn-sm btn-warning">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <div id="edit-template-{{ $template->id }}" class="modal fade" tabindex="-1" role="dialog"
                                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h6 class="panel-title txt-dark">{{ __('Edit Template') }} - {{ $template->name }}</h6>
                                                            </div>
                                                            <form action="{{ route('admin.survey.template.new',['template'=> (isset($template) )? $template->id:0]) }}" method="post">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="city">
                                                                            {{ __('Template Name') }}
                                                                        </label>
                                                                        <input type="text" value="{{ (isset($template))?$template->name:'' }}" required name="name" class="form-control input-sm" id="city" placeholder="{{ __('Template Name') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="city">
                                                                            {{ __('Template Title') }}
                                                                        </label>
                                                                        <textarea type="text" required name="title" class="form-control input-sm" id="city" placeholder="{{ __('Template Title') }}">{{ (isset($template))?$template->title:'' }}</textarea>
                                                                    </div>
                                                                    <div class="questions" style="border: 1px solid #eeeeee">
                                                                        @if(isset($template))
                                                                            @foreach(json_decode($template->questions) as $question=>$answers)
                                                                                <div class="question" style="">
                                                                                    <button type="button" class="btn btn-circle btn-sm btn-outline btn-danger remove pull-right" >
                                                                                        <i class="ti-trash"></i></button>
                                                                                    <div class="form-group">
                                                                                        <label>{{ __('Question') }}</label>
                                                                                        <textarea name="question[]" required class="form-control input-sm question-input" placeholder="{{ __('Enter Your Question') }}">{{ $question }}</textarea>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-12"><label>{{ __('Answers') }}</label></div>
                                                                                        <div class="col-sm-12">
                                                                                            <input type="hidden" name="answers[]" value="{{ $answers }}" class="formatted-answers" >
                                                                                            @foreach(explode(',',$answers) as $answer)
                                                                                                <input name="answer" value="{{ $answer }}" style="width: 40%;float: left ;margin: 0 10px"  required class="form-control input-sm input-answer" placeholder="{{ __('Enter Answer') }}">
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        @else
                                                                            <div class="question" style="">
                                                                                <button type="button" class="btn btn-circle btn-sm btn-outline btn-danger remove pull-right" >
                                                                                    <i class="ti-trash"></i></button>
                                                                                <div class="form-group">
                                                                                    <label>{{ __('Question') }}</label>
                                                                                    <textarea name="question[]" required class="form-control input-sm question-input" placeholder="{{ __('Enter Your Question') }}"></textarea>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-12"><label>{{ __('Answers') }}</label></div>
                                                                                    <div class="col-sm-12">
                                                                                        <input type="hidden" name="answers[]" class="formatted-answers" >
                                                                                        <input name="answer" style="width: 40%;float: left ;margin: 0 10px"  required class="form-control input-sm input-answer" placeholder="{{ __('Enter Answer') }}">
                                                                                        <input name="answer" style="width: 40%;float: left" required class="form-control input-sm input-answer" placeholder="{{ __('Enter Answer') }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <button type="button"
                                                                            class="btn add_quest btn-sm btn-rounded btn-primary float-right">
                                                                        <i class="ti-plus"></i> {{ __('Add More ') }}  </button>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success pull-right "><i class="fa fa-floppy-o"></i> {{ __('Save') }}</button>
                                                                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">
                                                                        {{ __('Close') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <a  href="{{ route('admin.survey.template.delete',['template'=>$template->id]) }}"
                                                    onclick="return confirm('{{ __('Are you sure ?') }}')" class="btn btn-sm btn-icon-anim btn-circle btn-danger">
                                                    <i class="icon-trash"></i>
                                                </a>
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
    <style>
        .question{
            margin:5px;padding: 5px; border:1px dashed #eeeeee
        }

    </style>
@endsection


@section('scripts')
<script>
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
@endsection