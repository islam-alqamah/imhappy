@extends('layouts.account')

@section('content')
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">{{ __('Profile') }}</h5>
        </div>

        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li class="active"><span>{{ __('Profile') }}</span></li>
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
                                    <form action="{{ route('account.profile.save') }}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="name">
                                                {{ __('User Name') }}
                                            </label>
                                            <input disabled type="text" value="{{ auth()->user()->name }}" name="name" class="form-control" id="name" placeholder="{{ __('Company Name') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="email">
                                                {{ __('Email') }}
                                            </label>
                                            <input disabled type="text" value="{{ auth()->user()->email }}" name="reporting_email"
                                                   class="form-control" id="email" placeholder="{{ __('Email') }}">
                                        </div>
                                        <hr/>
                                        <h4>Change Password</h4>
                                        <br/>
                                        <div class="row form-group">

                                            <div class="col-md-6">
                                                <label class="control-label mb-10" for="old-password">
                                                    {{ __('New Password') }}
                                                </label>
                                                <input type="password" name="password" class="form-control"
                                                       id="old-password" placeholder="{{ __('New Password') }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label mb-10" for="old-password">
                                                    {{ __('Confirm Password') }}
                                                </label>
                                                <input type="password" name="confirm_password" class="form-control"
                                                       id="old-password" placeholder="{{ __('Confirm Password') }}">
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-success pull-right ">{{ __('Update') }}</button>
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