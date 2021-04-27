@extends('layouts.account')

@section('content')
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">{{ __('Settings') }}</h5>
        </div>

        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li><a href="#"><span>{{ __('Account') }}</span></a></li>
                <li class="active"><span>{{ __('Settings') }}</span></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-wrap">
                                    <form action="{{ route('account.settings.save') }}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="name">
                                                {{ __('Company Name') }}
                                            </label>
                                            <input type="hidden" name="id" value="{{ $settings->id }}">
                                            <input type="text" value="{{ $settings->company_name }}" name="name" class="form-control" id="name" placeholder="{{ __('Company Name') }}">
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
                                                {{ __('Response Minutes Delay') }} <small>0 is disabled</small>
                                                <a href="#" data-toggle="tooltip" title="Response Minutes Delay is the time which the user can send another feedback response."><i class="fa fa-question-circle"></i> </a>
                                            </label>
                                            <input type="text" value="{{ $settings->response_time_delay }}" name="response_time_delay"
                                                   class="form-control" id="response_time_delay" placeholder="{{ __('Minutes') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="name">
                                                {{ __('Telegram Group Id') }}
                                                 <a href="#" data-toggle="tooltip"
                                                    title="(1) Go in your Telegram Group.
                                                    (2) Add new User (Invite). (3) Search for 'getidsbot' => @getidsbot.
                                                    (4) Message: /start@getidsbot
                                                    -- Now you see the ID. looks like 1068773197, which is -1001068773197 for bots (with -100 prefix)!!!"><i class="fa fa-question-circle"></i> </a>
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
                                        <button type="submit" class="btn btn-success pull-right ">{{ __('Save') }}</button>
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