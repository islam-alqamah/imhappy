@extends('layouts.account')

@section('content')
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">{{ __('Plans') }}</h5>
        </div>

        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li class="active"><span>{{ __('Plans') }}</span></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <!-- item -->
                @foreach($plans as $plan)
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center mb-30">
                        <div class="panel panel-pricing card-view mb-0">
                            <div class="panel-heading">
                                <i class="ti-wallet"></i>
                                <h6>{{ $plan->title }}</h6>
                                <span class="panel-price">{{ $plan->price }}<span class="pricing-dolor">SAR</span></span>
                            </div>
                            <div class="panel-body text-center pl-0 pr-0">
                                <hr class="mb-30">
                                <ul class="list-group mb-0 text-center">
                                    <li class="list-group-item"><i class="fa fa-check"></i> {{ $plan->branches }}
                                        {{__('Branches')}}</li>
                                    <li><hr class="mt-5 mb-5"></li>
                                    <li class="list-group-item"><i class="fa fa-check"></i> {{ $plan->points }} {{ __('Points') }}</li>
                                    <li><hr class="mt-5 mb-5"></li>
                                    <li class="list-group-item"><i class="fa fa-check"></i>
                                        {{ implode(",",json_decode($plan->channels)) }}
                                    </li>
                                    <li><hr class="mt-5 mb-5"></li>
                                    <li class="list-group-item"><i class="fa fa-check"></i> {{ __('27/7 support') }}</li>
                                </ul>
                            </div>
                            <div class="panel-footer pb-35">
                                <form method="post" action="{{ route('account.new.subscription') }}">
                                    @csrf
                                    <input type="hidden" name="currency" value="SAR">
                                    <input type="hidden" name="amount" value="{{$plan->price}}">
                                    <input type="hidden" name="order_id" value="9988">
                                    <button class="btn btn-primary btn-outline fancy-button btn-0 btn-rounded btn-lg" type="submit">
                                        {{ __('Subscribe Now') }}</button>
                                </form>                </div>
                        </div>
                    </div>
                    <!-- /item -->
                @endforeach

            </div>
        </div>
    </div>

@endsection