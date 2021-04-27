@extends('layouts.account')

@section('content')
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">{{ __('Payment') }}</h5>
        </div>

        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li class="active"><span>{{ __('Payment') }}</span></li>
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
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h4 style="color: #ffffff"> <i class="zmdi zmdi-delete pr-15 pull-left"></i> {{ __('Payment Failed .') }}</h4>
                                                <p style="color: #ffffff">{{ __('Something went wrong while processing payment.') }}</p>
                                                <p style="color: #ffffff">{{ __('Please contact system admin.') }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="{{ route('account.plan') }}" class="btn btn-primary pull-right">{{ __('Payment History') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                {{ $subscribe->plan->title }} - {{ $subscribe->starts_at }} - {{ $subscribe->ends_at }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection