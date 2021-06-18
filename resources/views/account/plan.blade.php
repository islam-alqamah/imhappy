@extends('layouts.account')

@section('content')
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">{{ __('Plans') }}</h5>
        </div>


    </div>
    <div class="pricing-one">


                    <ul
                            class="list-inline text-center switch-toggler-list"
                            role="tablist"
                            id="switch-toggle-tab"
                    >
                        <li class="year active"><a href="#">{{__('Annual')}}</a></li>
                        <li>
                            <!-- Rounded switch -->
                            <label class="switch on">
                                <span class="slider round"></span>
                            </label>
                        </li>
                        <li class="month"><a href="#">{{__('Monthly')}}</a></li>
                    </ul>
                    <!-- /.list-inline -->


            <style>

                .pricing-one__list li {
                    line-height: 40px;
                    font-size: 18px;
                    font-family: "Comfortaa", sans-serif;
                    font-weight: 400;
                    -webkit-transition: all 500ms ease;
                    transition: all 500ms ease;
                    color: #15E2BE; }
                .pricing-one__list li i {
                    color: #242B3E;
                    font-size: 14px;
                    padding-right: 3px; }

                .pricing-one .switch {
                    position: relative;
                    display: inline-block;
                    width: 79px;
                    height: 36px;
                    vertical-align: middle;
                    margin: 0; }

                .pricing-one .switch input {
                    display: none; }

                .pricing-one .slider {
                    position: absolute;
                    cursor: pointer;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    -webkit-transition: .4s;
                    transition: .4s;
                    background: #15E2BE; }

                .pricing-one .slider:before {
                    position: absolute;
                    content: "";
                    height: 26px;
                    width: 26px;
                    left: 6px;
                    bottom: 6px;
                    -webkit-transform: translateX(0px);
                    transform: translateX(0px);
                    background-color: #242B3E;
                    -webkit-transition: .4s;
                    transition: .4s; }

                .pricing-one .switch.off .slider:before {
                    -webkit-transform: translateX(42px);
                    transform: translateX(42px); }

                .pricing-one .slider.round {
                    border-radius: 34px; }

                .pricing-one .slider.round:before {
                    border-radius: 50%; }

                .pricing-one ul.switch-toggler-list {
                    display: -webkit-box;
                    display: flex;
                    -webkit-box-align: center;
                    align-items: center;
                    -webkit-box-pack: center;
                    justify-content: center;
                    margin-bottom: 40px; }

                .pricing-one ul.switch-toggler-list li a {
                    font-size: 18px;
                    font-weight: 400;
                    font-family: "Comfortaa", sans-serif;
                    color: #838999;
                    padding-left: 20px;
                    padding-right: 20px;
                    display: block; }

                .pricing-one ul.switch-toggler-list li.active a {
                    color: #252c41; }

                .pricing-one [class*=col-]:nth-child(2) .pricing-one__single .pricing-one__circle::before,
                .pricing-one__single:hover .pricing-one__circle::before,
                .pricing-one [class*=col-]:nth-child(2) .pricing-one__single .pricing-one__circle::after,
                .pricing-one__single:hover .pricing-one__circle::after {
                    opacity: 0.3;
                    -webkit-transform: perspective(150px) scaleX(1);
                    transform: perspective(150px) scaleX(1); }

                .pricing-one [class*=col-]:nth-child(2) .pricing-one__single::before {
                    -webkit-transform: scale(1, 1);
                    transform: scale(1, 1);
                    -webkit-transform-origin: left;
                    transform-origin: left; }

                .pricing-one__single:hover .pricing-one__btn::before,
                .pricing-one [class*=col-]:nth-child(2) .pricing-one__btn::before {
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0; }

                .pricing-one [class*=col-]:nth-child(2) .pricing-one__single h3,
                .pricing-one__single:hover h3 {
                    color: #fff; }

                .pricing-one [class*=col-]:nth-child(2) .pricing-one__list li,
                .pricing-one__single:hover .pricing-one__list li {
                    color: #b2b6c4; }

                .pricing-one [class*=col-]:nth-child(2) .overlay,
                .pricing-one__single:hover .overlay {
                    background-color: rgba(252, 252, 252, 0.05); }

                article {
                    width:100%;
                    max-width:1000px;
                    margin:0 auto;
                    position:relative;
                }
                article ul {
                    display:flex;
                    top:0px;
                    z-index:10;
                    padding-bottom:14px;
                }
                article li {
                    list-style:none;
                    flex:1;
                }
                article li:last-child {
                    border-right:1px solid #DDD;
                }



                article  table { border:none;border-collapse:collapse; table-layout:fixed; width:100%; }
                article  th { background:#F5F5F5; display:none; }
                article td, article th {
                    height:53px;
                    border-right: none;
                    border-left: none;
                }
                article td, article th { border:1px solid #DDD; padding:10px; empty-cells:show; }
                article td, article th {
                    text-align:left;
                }
                td+td, th+th {
                    text-align:center;
                    display:none;

                }
                td button{
                    font-size: 12px;
                    width: 100%;
                }
                td.default {
                    display:table-cell;
                }
                .bg-purple-s {
                    border-top:4px solid #a291f5;
                }
                .bg-blue-s {
                    border-top:4px solid #00A5B7;
                }
                .bg-green-s{
                    border-top:4px solid #007d67;
                }
                .bg-yellow-s{
                    border-top:4px solid #ffdf7e;
                }
                .sep {
                    background:#F5F5F5;
                    font-weight:bold;
                }
                .txt-l { font-size:28px; font-weight:bold; color: #15E2BE }
                .txt-top { font-size:22px;  color:#242B3E;  position:relative; top:-9px; left:-2px; }
                .tick { font-size:18px; color:#242B3E; }
                .hide-s {
                    border:0;
                    background:none;
                }
                .contatinho{
                    background:#00A5B7;
                    padding:10px 20px;
                    font-size:12px;
                    display:inline-block;
                    color:#FFF;
                    text-decoration:none;
                    border-radius:3px;
                    text-transform:uppercase;
                    margin:5px 0 10px 0;
                }

                @media (min-width: 640px) {
                    article  ul {
                        display:none;
                    }
                    article td, article th {
                        display:table-cell !important;
                        border-right: none;
                        border-left: none;
                    }
                    article td,article th {
                        width: 330px;

                    }
                    td+td, th+th {
                        width: auto;
                    }
                }
            </style>
            <div class="tabed-content">

                <div id="month">
                    <article>

                        <ul>
                            <li class="bg-purple">
                                <button>{{__('QR Code')}}</button>
                            </li>
                            <li class="bg-blue" >
                                <button>{{__('Touchless')}}</button>
                            </li>
                        </ul>

                        <table>
                            <thead>
                            <tr>
                                <th class="hide-s"></th>
                                <th class="bg-purple-s">{{__('Basic')}}</th>
                                <th class="bg-blue-s">{{__('Advanced')}}</th>
                                <th class="bg-green-s">{{__('Business')}}</th>
                                <th class="bg-yellow-s">{{__('Enterprise')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{__('Price')}}</td>
                                <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">10 </span> </td>
                                <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">24 </span> </td>
                                <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">49 </span> </td>
                                <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">99 </span> </td>
                            </tr>
                            <tr>
                                <td>{{__('Charts & Analytics')}}</td>
                                <td><span class="tick">-</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                            </tr>
                            <tr>
                                <td>{{__('Responses')}}</td>
                                <td><span class="tick">100/{{ __('Month') }}</span></td>
                                <td><span class="tick">500/{{ __('Month') }}</span></td>
                                <td><span class="tick">2500/{{ __('Month') }}</span></td>
                                <td><span class="tick">5000/{{ __('Month') }}</span></td>
                            </tr>
                            <tr>
                                <td>{{__('QR-Code')}}</td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                            </tr>
                            <tr>
                                <td>{{__('Touchless')}}</td>
                                <td><span class="tick">-</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                            </tr>
                            <tr>
                                <td>{{__('Instant response (telegram)')}}
                                    <a href="#" data-toggle="tooltip" title="" data-original-title="1- Add @IM_HAPPY_360_BOT (I’M Happy) into your group.
                                                    2- type /help
                                                    3- copy and paste the ID in this field." aria-describedby="tooltip385588"><i class="fa fa-question-circle"></i> </a>
                                </td>
                                <td><span class="tick">-</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                            </tr>
                            <tr>
                                <td class="hide-s"></td>
                                <td>
                                    <form method="post" action="{{ route('account.new.subscription') }}">
                                        @csrf
                                        <input type="hidden" name="currency" value="SAR">
                                        <input type="hidden" name="amount" value="10">
                                        <input type="hidden" name="order_id" value="10">
                                        <button class="btn btn-primary btn-outline fancy-button btn-0 btn-rounded " type="submit">
                                            {{ __('Subscribe Now') }}</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('account.new.subscription') }}">
                                        @csrf
                                        <input type="hidden" name="currency" value="SAR">
                                        <input type="hidden" name="amount" value="24">
                                        <input type="hidden" name="order_id" value="24">
                                        <button class="btn btn-primary btn-outline fancy-button btn-0 btn-rounded " type="submit">
                                            {{ __('Subscribe Now') }}</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('account.new.subscription') }}">
                                        @csrf
                                        <input type="hidden" name="currency" value="SAR">
                                        <input type="hidden" name="amount" value="49">
                                        <input type="hidden" name="order_id" value="49">
                                        <button class="btn btn-primary btn-outline fancy-button btn-0 btn-rounded " type="submit">
                                            {{ __('Subscribe Now') }}</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('account.new.subscription') }}">
                                        @csrf
                                        <input type="hidden" name="currency" value="SAR">
                                        <input type="hidden" name="amount" value="99">
                                        <input type="hidden" name="order_id" value="99">
                                        <button class="btn btn-primary btn-outline fancy-button btn-0 btn-rounded " type="submit">
                                            {{ __('Subscribe Now') }}</button>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </article>
                    <!-- /.row -->
                </div>
                <!-- /#year -->
                <div id="year">

                    <article>

                        <ul>
                            <li class="bg-purple">
                                <button>{{__('QR Code')}}</button>
                            </li>
                            <li class="bg-blue" >
                                <button>{{__('Touchless')}}</button>
                            </li>
                        </ul>


                        <table>
                            <thead>
                            <tr>
                                <th class="hide-s"></th>
                                <th class="bg-purple-s">{{__('Basic')}}</th>
                                <th class="bg-blue-s">{{__('Advanced')}}</th>
                                <th class="bg-green-s">{{__('Business')}}</th>
                                <th class="bg-yellow-s">{{__('Enterprise')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{__('Price')}}</td>
                                <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">20 </span> </td>
                                <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">34 </span> </td>
                                <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">59 </span> </td>
                                <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">109 </span> </td>
                            </tr>
                            <tr>
                                <td>{{__('Charts & Analytics')}}</td>
                                <td><span class="tick">-</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                            </tr>
                            <tr>
                                <td>{{__('Responses')}}</td>
                                <td><span class="tick">100/{{ __('Month') }}</span></td>
                                <td><span class="tick">500/{{ __('Month') }}</span></td>
                                <td><span class="tick">2500/{{ __('Month') }}</span></td>
                                <td><span class="tick">5000/{{ __('Month') }}</span></td>
                            </tr>
                            <tr>
                                <td>{{__('QR-Code')}}</td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                            </tr>
                            <tr>
                                <td>{{__('Touchless')}}</td>
                                <td><span class="tick">-</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                            </tr>
                            <tr>
                                <td>{{__('Instant response (telegram)')}}

                                    <a href="#" data-toggle="tooltip" title="" data-original-title="1- Add @IM_HAPPY_360_BOT (I’M Happy) into your group.
                                                    2- type /help
                                                    3- copy and paste the ID in this field." aria-describedby="tooltip385588"><i class="fa fa-question-circle"></i> </a>
                                </td>
                                <td><span class="tick">-</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                                <td><span class="tick">&#10004;</span></td>
                            </tr>
                            <tr>
                                <td class="hide-s"></td>
                                <td>
                                    <form method="post" action="{{ route('account.new.subscription') }}">
                                        @csrf
                                        <input type="hidden" name="currency" value="SAR">
                                        <input type="hidden" name="amount" value="20">
                                        <input type="hidden" name="order_id" value="20">
                                        <button class="btn btn-primary btn-outline fancy-button btn-0 btn-rounded " type="submit">
                                            {{ __('Subscribe Now') }}</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('account.new.subscription') }}">
                                        @csrf
                                        <input type="hidden" name="currency" value="SAR">
                                        <input type="hidden" name="amount" value="34">
                                        <input type="hidden" name="order_id" value="34">
                                        <button class="btn btn-primary btn-outline fancy-button btn-0 btn-rounded " type="submit">
                                            {{ __('Subscribe Now') }}</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('account.new.subscription') }}">
                                        @csrf
                                        <input type="hidden" name="currency" value="SAR">
                                        <input type="hidden" name="amount" value="59">
                                        <input type="hidden" name="order_id" value="59">
                                        <button class="btn btn-primary btn-outline fancy-button btn-0 btn-rounded " type="submit">
                                            {{ __('Subscribe Now') }}</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('account.new.subscription') }}">
                                        @csrf
                                        <input type="hidden" name="currency" value="SAR">
                                        <input type="hidden" name="amount" value="109">
                                        <input type="hidden" name="order_id" value="109">
                                        <button class="btn btn-primary btn-outline fancy-button btn-0 btn-rounded " type="submit">
                                            {{ __('Subscribe Now') }}</button>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </article>
                    <!-- /.row -->
                </div>
                <!-- /#month -->

            </div>
            <!-- /.tabed-content -->

    </div>


@endsection

@section('scripts')
    <script>
        if ($('#switch-toggle-tab').length) {
            var toggleSwitch = $('#switch-toggle-tab label.switch');
            var TabTitle = $('#switch-toggle-tab li');
            var monthTabTitle = $('#switch-toggle-tab li.month');
            var yearTabTitle = $('#switch-toggle-tab li.year');
            var monthTabContent = $('#month');
            var yearTabContent = $('#year');
            // hidden show deafult;
            monthTabContent.fadeIn();
            yearTabContent.fadeOut();

            function toggleHandle() {
                if (toggleSwitch.hasClass('on')) {
                    yearTabContent.fadeOut();
                    monthTabContent.fadeIn();
                    monthTabTitle.addClass('active');
                    yearTabTitle.removeClass('active');
                } else {
                    monthTabContent.fadeOut();
                    yearTabContent.fadeIn();
                    yearTabTitle.addClass('active');
                    monthTabTitle.removeClass('active');
                }
            };
            monthTabTitle.on('click', function () {
                toggleSwitch.addClass('on').removeClass('off');
                toggleHandle();
                return false;
            });
            yearTabTitle.on('click', function () {
                toggleSwitch.addClass('off').removeClass('on');
                toggleHandle();
                return false;
            });
            toggleSwitch.on('click', function () {
                toggleSwitch.toggleClass('on off');
                toggleHandle();
            });
        }

    </script>
@endsection