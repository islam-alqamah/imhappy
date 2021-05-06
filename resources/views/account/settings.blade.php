@extends('layouts.account')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default card-view" style="background: #f8f8f8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{ __('General Settings') }}</h6>
                    </div>
                    <div class="pull-right">

                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body" >
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-wrap">
                                    <form action="{{ route('account.settings.save') }}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-10" for="name">
                                                        {{ __('Company Name') }}
                                                    </label>
                                                    <input type="hidden" name="id" value="{{ $settings->id }}">
                                                    <input type="text" value="{{ $settings->company_name }}" name="name" class="form-control" id="name" placeholder="{{ __('Company Name') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-10" for="comid">
                                                        {{ __('Company ID') }}
                                                    </label>
                                                    <input type="text" disabled value="#IMH00{{ currentTeam()->id }}" name="comid" class="form-control" id="comid" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="address">
                                                {{ __('Company Address') }}
                                            </label>
                                            <input type="text" value="{{ $settings->address }}" name="address" class="form-control" id="address" placeholder="{{ __('Company address') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="phone">
                                                {{ __('Company Phone') }}
                                            </label>
                                            <input type="text" value="{{ $settings->phone }}" name="phone" class="form-control" id="phone" placeholder="{{ __('Company phone') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="fax">
                                                {{ __('Company Fax') }}
                                            </label>
                                            <input type="text" value="{{ $settings->fax }}" name="fax" class="form-control" id="fax" placeholder="{{ __('Company fax') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="email">
                                                {{ __('Reporting Email') }}
                                            </label>
                                            <input type="text" value="{{ $settings->reporting_email }}" name="reporting_email"
                                                   class="form-control" id="email" placeholder="{{ __('Reporting Email') }}">
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-8">
                                                <label class="control-label mb-10" for="logo">
                                                    {{ __('Company Logo') }}
                                                </label>
                                                <input type="file" name="logo" class="form-control" id="logo" placeholder="{{ __('Company Logo') }}">
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <img src="{{ url($settings->logo) }}" width="100" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="response_time_delay">
                                                {{ __('Response Minutes Delay') }}
                                                <a href="#" data-toggle="tooltip" title="Response Minutes Delay is the time which the user can send another feedback response."><i class="fa fa-question-circle"></i> </a>
                                            </label>
                                            <select class="form-control" name="response_time_delay">
                                                <option @if($settings->response_time_delay==0) selected @endif value="0">Disabled</option>
                                                <option @if($settings->response_time_delay==15) selected @endif value="15">15 Minutes</option>
                                                <option @if($settings->response_time_delay==30) selected @endif value="30">30 Minutes</option>
                                                <option @if($settings->response_time_delay==60) selected @endif value="60">1 Hour</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="name">
                                                {{ __('Telegram Group Id') }}
                                                 <a href="#" data-toggle="tooltip"
                                                    title="1- Add @IM_HAPPY_360_BOT (I’M Happy) into your group.&#13;
                                                    2- type /help&#13;
                                                    3- copy and paste the ID in this field."><i class="fa fa-question-circle"></i> </a>
                                            </label>
                                            <input type="text" value="{{ $settings->telegram }}" name="telegram"
                                                   class="form-control" id="name" placeholder="{{ __('Telegram Group Id') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="fb">
                                                {{ __('Facebook Page Url') }}
                                            </label>
                                            <input type="text" value="{{ $settings->facebook }}" name="facebook"
                                                   class="form-control" id="fb" placeholder="{{ __('Facebook Page Url') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="yt">
                                                {{ __('Youtube Channel Url') }}
                                            </label>
                                            <input type="text" value="{{ $settings->youtube }}" name="youtube"
                                                   class="form-control" id="yt" placeholder="{{ __('Youtube Channel Url') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="insta">
                                                {{ __('Instagram Page Url') }}
                                            </label>
                                            <input type="text" value="{{ $settings->instagram }}" name="instagram"
                                                   class="form-control" id="insta" placeholder="{{ __('Instagram Page Url') }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-outline fancy-button btn-0 pull-right ">{{ __('Save') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection