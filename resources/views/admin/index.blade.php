@extends('layouts.admin')
@section('content')
    <div class="row mt-15">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                            <div class="sm-data-box">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
                                            <span class="txt-dark block counter"><span class="counter-anim">{{ $user_count }}</span></span>
                                            <span class="weight-500 uppercase-font block font-13">{{ __('No. Of Users') }}</span>
                                        </div>
                                        <div class="col-xs-4 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="zmdi zmdi-folder-person data-right-rep-icon " style="color:#e2155f"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                            <div class="sm-data-box">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
                                            <span class="txt-dark block counter"><span class="counter-anim">{{ $responses }}</span></span>
                                            <span class="weight-500 uppercase-font block font-13">{{ __('No. Of Responses') }}</span>
                                        </div>
                                        <div class="col-xs-4 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="zmdi zmdi-comment-list data-right-rep-icon " style="color:#af00c8"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <a href="#">
                            <div class="sm-data-box">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
                                            <span class="txt-dark block counter"><span class="counter-anim">{{ $branches }}</span></span>
                                            <span class="weight-500 uppercase-font block font-13">{{ __('Branches') }}</span>
                                        </div>
                                        <div class="col-xs-4 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="zmdi zmdi-store data-right-rep-icon " style="color:#ff6006"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <a href="#">
                            <div class="sm-data-box">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
                                            <span class="txt-dark block counter"><span class="counter-anim">{{ $revenue }}</span></span>
                                            <span class="weight-500 uppercase-font block font-13">{{ __('Revenue') }}</span>
                                        </div>
                                        <div class="col-xs-4 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="zmdi zmdi-money data-right-rep-icon " style="color:#ffbf00"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="panel panel-default card-view panel-refresh">
                <div class="refresh-container">
                    <div class="la-anim-1"></div>
                </div>
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{ __('New Users Stats') }}</h6>
                    </div>
                    <div class="pull-right">
                        <a href="#" class="pull-left inline-block refresh mr-15">
                            <i class="zmdi zmdi-replay"></i>
                        </a>
                        <a href="#" class="pull-left inline-block full-screen mr-15">
                            <i class="zmdi zmdi-fullscreen"></i>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div id="feedback-chart" class="" style="height:313px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="panel panel-default card-view panel-refresh">
                <div class="refresh-container">
                    <div class="la-anim-1"></div>
                </div>
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{ __('Packages Stats') }}</h6>
                    </div>
                    <div class="pull-right">
                        <a href="#" class="pull-left inline-block refresh mr-15">
                            <i class="zmdi zmdi-replay"></i>
                        </a>

                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pt-40 pb-35">
                        <div id="e_chart_3" class="" style="height:236px;"></div>
                        <div class="label-chatrs text-center mt-40">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-7 col-sm-12 col-xs-12">
            <div class="panel panel-default card-view panel-refresh">
                <div class="refresh-container">
                    <div class="la-anim-1"></div>
                </div>
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{ __('Latest Users') }}</h6>
                    </div>
                    <div class="pull-right">
                        <a href="#" class="pull-left inline-block refresh mr-15">
                            <i class="zmdi zmdi-replay"></i>
                        </a>
                        <a href="#" class="pull-left inline-block full-screen mr-15">
                            <i class="zmdi zmdi-fullscreen"></i>
                        </a>
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
                                        <th>{{ __('Date / Time') }}</th>
                                        <th>{{ __('User Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Company Name') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($teams as $team)
                                        <tr>
                                            <td>{{ $team->created_at }}</td>
                                            <td>{{ isset($team->user->name)?$team->user->name: '' }}</td>
                                            <td>{{ isset($team->user->email)?$team->user->email: '' }}</td>
                                            <td>{{ $team->settings->company_name }}</td>
                                            <td>{{ $team->settings->phone }}</td>
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
@push('styles')
    <style>
        .icon{
            font-size:26px;
            color:slategrey;
        }
        .u-doughnut--70 {
            width: 40px;
            height: 50px;
        }
    </style>
@endpush

@section('scripts')
    <script src="{{ url('assets/dist/vendors') }}/chart.js/Chart.min.js"></script>

    <script>

        if( $('#e_chart_3').length > 0 ){
            var eChart_3 = echarts.init(document.getElementById('e_chart_3'));
            var option3 = {
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)",
                    backgroundColor: 'rgba(33,33,33,1)',
                    borderRadius:0,
                    padding:10,
                    textStyle: {
                        color: '#fff',
                        fontStyle: 'normal',
                        fontWeight: 'normal',
                        fontFamily: "'Roboto', sans-serif",
                        fontSize: 12
                    }
                },
                legend: {
                    show:false
                },
                toolbox: {
                    show : false,
                },
                calculable : true,
                labelLine: {
                    normal: {
                        smooth: true,
                        lineStyle: {
                            width: 2
                        }
                    }
                },
                itemStyle: {
                    normal: {
                        shadowBlur: 5,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                },
                series : [
                    {
                        name:'Subscribers',
                        type:'pie',
                        radius : '80%',
                        center : ['50%', '50%'],
                        color: [
                            new echarts.graphic.LinearGradient(0, 1, 0, 0, [{
                                offset: 0,
                                color: '#CD3A3A'
                            }, {
                                offset: 1,
                                color: '#FF544F'
                            }]),
                            new echarts.graphic.LinearGradient(0, 1, 0, 0, [{
                                offset: 0,
                                color: '#FFC413'
                            }, {
                                offset: 1,
                                color: '#FFDF00'
                            }])
                            , new echarts.graphic.LinearGradient(0, 1, 0, 0, [{
                                offset: 0,
                                color: '#30B846'
                            }, {
                                offset: 1,
                                color: '#34EE51'
                            }]),
                            new echarts.graphic.LinearGradient(0, 1, 0, 0, [{
                                offset: 0,
                                color: '#30B8aa'
                            }, {
                                offset: 1,
                                color: '#34EEaa'
                            }])
                        ],
                        data:[
                            @foreach($plans as $plan)
                            {value:{{ $plan->subscribes->count() }}, name:'{{ $plan->title }}'},
                            @endforeach
                        ],
                    },
                ],
                animationType: 'scale',
                animationEasing: 'elasticOut',
                animationDelay: function (idx) {
                    return Math.random() * 1000;
                }
            };
            eChart_3.setOption(option3);
            eChart_3.resize();
        }


        if( $('#feedback-chart').length > 0 ){
            var eChart_1 = echarts.init(document.getElementById('feedback-chart'));
            var option = {
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(33,33,33,1)',
                    borderRadius:0,
                    padding:10,
                    axisPointer: {
                        type: 'cross',
                        label: {
                            backgroundColor: 'rgba(33,33,33,1)'
                        }
                    },
                    textStyle: {
                        color: '#fff',
                        fontStyle: 'normal',
                        fontWeight: 'normal',
                        fontFamily: "'Roboto', sans-serif",
                        fontSize: 12
                    }
                },
                grid:{
                    show:false,
                    top: 30,
                    bottom: 10,
                    containLabel: true,
                },
                color: [ new echarts.graphic.LinearGradient(0, 1, 0, 0, [{
                    offset: 0,
                    color: '#30B846'
                }, {
                    offset: 1,
                    color: '#34EE51'
                }]
                )],
                legend: {
                    show : false,
                    data:['{{ _('New Users') }}'],
                    x : 'left',
                    y : 'bottom'
                },
                toolbox: {
                    show: false,
                    feature: {
                        dataView: {readOnly: false},
                        restore: {},
                        saveAsImage: {}
                    }
                },
                dataZoom: {
                    show: false,
                    start: 0,
                    end: 100
                },
                xAxis: [
                    {
                        type: 'category',
                        axisLine: {
                            show:false
                        },
                        axisLabel: {
                            textStyle: {
                                color: '#878787'
                            }
                        },
                        boundaryGap: true,
                        data: (function (){
                            var res = [
                                @foreach($teamsChart as $key=>$value)
                                    "{{ $key }}",
                                @endforeach
                            ];
                            return res;
                        })()
                    }
                ],
                yAxis: [
                    {
                        axisLine: {
                            show:false
                        },
                        axisLabel: {
                            textStyle: {
                                color: '#878787'
                            }
                        },
                        splitLine: {
                            show: false,
                        },
                        type: 'value',
                        scale: true,
                        name: '',
                        max: {{ $user_count }},
                        min: 0,
                        boundaryGap: [1, 1]
                    }
                ],
                series: [


                    {
                        name:'New Users',
                        type:'bar',
                        stack:'s1',
                        data:(function (){
                            var res = [
                                @foreach($teamsChart as $key=>$value)
                                    "{{   $value  }}",
                                @endforeach
                            ];
                            return res;
                        })()
                    }
                ],
                textStyle: {
                    fontStyle: 'normal',
                    fontWeight: 'normal',
                },

            };
            var app = [];
            app.count = 11;
            eChart_1.setOption(option);
            eChart_1.resize();
        }
    </script>
@endsection