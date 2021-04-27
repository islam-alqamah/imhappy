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

        <!-- item -->
        <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-30">
            <div class="panel panel-pricing mb-0">
                <div class="panel-heading">
                    <i class="ti-wallet"></i>
                    <h6>standard</h6>
                    <span class="panel-price"><span class="pricing-dolor">$</span>25</span>
                </div>
                <div class="panel-body text-center pl-0 pr-0">
                    <hr class="mb-30">
                    <ul class="list-group mb-0 text-center">
                        <li class="list-group-item"><i class="fa fa-check"></i> Personal use</li>
                        <li><hr class="mt-5 mb-5"></li>
                        <li class="list-group-item"><i class="fa fa-check"></i> Touchless + Feed back</li>
                        <li><hr class="mt-5 mb-5"></li>
                        <li class="list-group-item"><i class="fa fa-check"></i> 27/7 support</li>
                    </ul>
                </div>
                <div class="panel-footer pb-35">
                    <a class="btn btn-success btn-rounded btn-lg" href="#">subscribe now</a>
                </div>
            </div>
        </div>
        <!-- /item -->
        <!-- item -->
        <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-30">
            <div class="panel panel-pricing mb-0">
                <div class="panel-heading">
                    <i class=" ti-crown"></i>
                    <h6>business</h6>
                    <span class="panel-price"><span class="pricing-dolor">$</span>55</span>
                </div>
                <div class="panel-body text-center pl-0 pr-0">
                    <hr class="mb-30">
                    <ul class="list-group mb-0 text-center">
                        <li class="list-group-item"><i class="fa fa-check"></i> Personal use</li>
                        <li><hr class="mt-5 mb-5"></li>
                        <li class="list-group-item"><i class="fa fa-check"></i> QR Feedback</li>
                        <li><hr class="mt-5 mb-5"></li>
                        <li class="list-group-item"><i class="fa fa-check"></i> 27/7 support</li>
                    </ul>
                </div>
                <div class="panel-footer pb-35">
                    <form method="post" action="{{ route('account.new.subscription') }}">
                        @csrf
                        <input type="hidden" name="currency" value="SAR">
                        <input type="hidden" name="amount" value="55">
                        <input type="hidden" name="order_id" value="9988">
                        <button class="btn btn-success btn-rounded btn-lg" type="submit">subscribe now</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /item -->
        <!-- item -->
        <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-30">
            <div class="panel panel-pricing mb-0">
                <div class="panel-heading">
                    <i class=" ti-shield"></i>
                    <h6>corporate</h6>
                    <span class="panel-price"><span class="pricing-dolor">$</span>89</span>
                </div>
                <div class="panel-body text-center pl-0 pr-0">
                    <hr class="mb-30">
                    <ul class="list-group mb-0 text-center">
                        <li class="list-group-item"><i class="fa fa-check"></i> Personal use</li>
                        <li><hr class="mt-5 mb-5"></li>
                        <li class="list-group-item"><i class="fa fa-check"></i> Unlimited </li>
                        <li><hr class="mt-5 mb-5"></li>
                        <li class="list-group-item"><i class="fa fa-check"></i> 27/7 support</li>
                    </ul>
                </div>
                <div class="panel-footer pb-35">
                    <form method="post" action="{{ route('account.new.subscription') }}">
                        @csrf
                        <input type="hidden" name="currency" value="SAR">
                        <input type="hidden" name="amount" value="89">
                        <input type="hidden" name="order_id" value="8987">
                        <button class="btn btn-success btn-rounded btn-lg" type="submit">subscribe now</button>
                    </form>

                </div>
            </div>
        </div>
        <!-- /item -->

    </div>
@endsection