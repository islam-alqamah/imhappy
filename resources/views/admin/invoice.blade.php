@extends('layouts.admin')

@section('content')
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">{{ __('Invoice') }}</h5>
        </div>

        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li class="active"><span>{{ __('Payments') }}</span></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default card-view" id="printing-area">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Invoice</h6>
                    </div>
                    <div class="pull-right">
                        <h6 class="txt-dark"> # 021{{ $payment->id }}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <span class="txt-dark head-font inline-block capitalize-font mb-5">Billed to:</span>
                                <address class="mb-15">
                                    <span class="address-head mb-5">Future Intelligence Company - I'm Happy</span>
                                    Prince Fawaz of Saudi Arabia – Jeddah <br/>
                                    <abbr title="Phone">P:</abbr>+966 507735308
                                </address>
                            </div>
                            <div class="col-xs-4">
                                <center>
                                    <img src="{{ url('assets/img/newlogo.png') }}" width="90">
                                </center>
                            </div>
                            <div class="col-xs-4 text-right">
                                <span class="txt-dark head-font inline-block capitalize-font mb-5">Subscribed By:</span>
                                <address class="mb-15">
                                    <span class="address-head mb-5">{{ $payment->subscribe->user->team->settings->company_name }}</span>
                                    {{ $payment->subscribe->user->team->settings->address }}<br/>
                                    <abbr title="Phone">P:</abbr>{{ $payment->subscribe->user->team->settings->phone }}
                                </address>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <address>
                                    <span class="txt-dark head-font capitalize-font mb-5">Payment Method:</span>
                                    <br>
                                    Visa TranId:{{ $payment->tranid }}<br>
                                    {{ $payment->subscribe->user->team->settings->reporting_email }}
                                </address>
                            </div>
                            <div class="col-xs-6 text-right">
                                <address>
                                    <span class="txt-dark head-font capitalize-font mb-5">Payment date:</span><br>
                                    {{ $payment->created_at->format('M d , Y') }}<br><br>
                                </address>
                            </div>
                        </div>

                        <div class="seprator-block"></div>

                        <div class="invoice-bill-table">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Totals</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $payment->plan->title }}</td>
                                        <td>{{ number_format($payment->amount,2) }}</td>
                                        <td>1</td>
                                        <td>{{ number_format($payment->amount,2) }}</td>
                                    </tr>
                                    <tr class="txt-dark">
                                        <td></td>
                                        <td></td>
                                        <td>Subtotal</td>
                                        <td>{{ number_format($payment->amount,2) }}</td>
                                    </tr>
                                    <tr class="txt-dark">
                                        <td></td>
                                        <td></td>
                                        <td>Vat %15</td>
                                        <td>{{ (number_format($payment->amount,2)*15/100) }}</td>
                                    </tr>
                                    <tr class="txt-dark">
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td>{{ number_format($payment->amount,2)+(number_format($payment->amount,2)*15/100) }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-list pull-right">
                <button type="button" class="btn btn-success mr-10">
                    Send to reporting email
                </button>
                <button type="button" class="btn btn-primary btn-outline btn-icon left-icon" onclick="javascript:PrintElem('printing-area');">
                    <i class="fa fa-print"></i><span> Print</span>
                </button>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        function PrintElem(elem)
        {
            var mywindow = window.open('', 'PRINT', 'height=400,width=600');

            mywindow.document.write('<html><head><title>Invoice</title>');
            mywindow.document.write('<link href="{{ url('assets/dist/') }}/vendors/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">');
            mywindow.document.write('<link href="{{ url('assets/dist/') }}/css/style.css" rel="stylesheet" type="text/css">');
            mywindow.document.write('<body >');
            mywindow.document.write(document.getElementById(elem).innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/
            setTimeout(function(){
                mywindow.print();
                mywindow.close();
            }, 2000);


            return true;
        }
    </script>

@endsection