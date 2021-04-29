@extends('layouts.account')

@section('content')
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">{{ __('Payments History') }}</h5>
        </div>

        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li class="active"><span>{{ __('Payments History') }}</span></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default card-view panel-refresh">
                <div class="refresh-container">
                    <div class="la-anim-1"></div>
                </div>
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{ __('Payments') }}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body row pa-0">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover display  pb-30" >
                                    <thead>
                                    <tr>
                                        <th>{{ __('Invoice No.') }}</th>
                                        <th>{{ __('Subscription Date') }}</th>
                                        <th>{{ __('Transaction ID') }}</th>
                                        <th>{{ __('Plan') }}</th>
                                        <th>{{ __('Pricing Model') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Starts at') }}</th>
                                        <th>{{ __('Ends at') }}</th>
                                        <th>{{ __('Status') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($payments as $payment)
                                        <tr>
                                            <td><a href="{{ url('account/payments/').'/'.$payment->id }}">#021{{ $payment->id }}</a></td>
                                            <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $payment->tranid }}</td>
                                            <td>{{ $payment->plan->title }}</td>
                                            <td>{{ $payment->plan->interval }}</td>
                                            <td>{!!  number_format($payment->amount,2)  !!}</td>
                                            <td>
                                                @if($payment->subscribe)
                                                    {{ $payment->subscribe->starts_at }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($payment->subscribe)
                                                   {{ $payment->subscribe->ends_at }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($payment->status == 'success')
                                                    <span style="background: #2DAD00" class="badge badge-success">{{ __('Success')}}</span>
                                                @else
                                                    <span style="background: #f52828" class="badge badge-danger">{{ __('Failed')}}</span>
                                                @endif
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