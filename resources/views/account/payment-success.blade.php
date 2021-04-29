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
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img src="{{ url('assets/img/excellent.png') }}" width="80">
                                <h4 style="color: #2DAD00;text-align: center" class="mt-10"> {{ __('Thanks for subscribing!') }}</h4>
                                <p style="color: #9FBB95;text-align: center" class="mt-10">{{ __('You have successfully subscribed to ').$subscribe->plan->title.__(' paying “'.$subscribe->plan->interval.'”.') }}</p>
                                <a href="{{ url('account/payments') }}" class="btn btn-primary fancy-button btn-0 mt-20 mr-20 btn-outline">{{ __('Go to Payments History') }}</a>
                                <a href="{{ url('dashboard') }}" class="btn btn-info fancy-button btn-0 mt-20 btn-outline">{{ __('Go to Dashboard') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection