@extends('layouts.account')

@section('content')

    <div class="row mt-15">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <a href="{{ url('branches/branches') }}">
                        <div class="sm-data-box">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter"><span class="counter-anim">{{ $team->branches->count() }}</span></span>
                                        <span class="weight-500 uppercase-font block font-13">{{ __('Branches') }}</span>
                                    </div>
                                    <div class="col-xs-4 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="zmdi zmdi-store data-right-rep-icon " style="color:#e2155f"></i>
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
                        <a href="{{ url('points/points/all') }}">
                        <div class="sm-data-box">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter"><span class="counter-anim">{{ $team->points->count() }}</span></span>
                                        <span class="weight-500 uppercase-font block">{{ __('Point') }}</span>
                                    </div>
                                    <div class="col-xs-4 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="icon-layers data-right-rep-icon" style="color:#af00c8"></i>
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
                        <a href="{{ url('reports') }}">
                        <div class="sm-data-box">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter"><span class="counter-anim">{{ $allresponses->count() }}</span></span>
                                        <span class="weight-300  block">{{ __('QR-Code Responses') }}</span>
                                    </div>
                                    <div class="col-xs-4 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="fa fa-qrcode data-right-rep-icon" style="color:#ff6006"></i>
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
                        <a href="{{ url('reports') }}">

                        <div class="sm-data-box">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter">
                                            <span class="counter-anim">
                                            <?php
                                                $total_ans = 0;
                                                $total_ques = 0;
                                                foreach(\App\Models\Team::find(currentTeam()->id)->points as $point){
                                                    if($point->type == 'survey'){
                                                    $questions = $point->form->questions;
                                                    $answers = 0;
                                                    foreach ($questions as $question){
                                                        $answers += \App\Models\QuestionAnswer::where('question_id',$question->id)->get()->count();
                                                    }
                                                        $total_ans +=$answers;
                                                        $total_ques += $questions->count();
                                                    }
                                                }
                                                if($total_ques){
                                                    echo round($total_ans/$total_ques);
                                                }


                                                    ?>
                                            </span></span>
                                        <span class="weight-300 block">{{ __('Touchless Responses') }}</span>
                                    </div>
                                    <div class="col-xs-4 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="fa fa-thumbs-up data-right-rep-icon"  style="color:#ffbf00"></i>
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
    <!-- /Row -->

    <!-- Row -->
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="panel panel-default card-view panel-refresh">
                <div class="refresh-container">
                    <div class="la-anim-1"></div>
                </div>
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{ __('QR-Code Stats') }}</h6>
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
                        <h6 class="panel-title txt-dark">QR-Code Total Results</h6>
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
    <!-- /Row -->
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12 col-md-7 col-sm-12 col-xs-12">
            <div class="panel panel-default card-view panel-refresh">
                <div class="refresh-container">
                    <div class="la-anim-1"></div>
                </div>
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{ __('Latest Responses') }}</h6>
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
                                        <th>{{ __('IP Address') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        <th>{{ __('Feedback') }}</th>
                                        <th>{{ __('Rate') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($responses as $response)
                                        <tr>
                                            <td>{{ $response->created_at }}</td>
                                            <td>{{ $response->user_ip }}</td>
                                            <td>{{ $response->email }}</td>
                                            <td>{{ $response->phone }}</td>
                                            <td>{{ $response->feedback }}</td>
                                            <td>
                                                <p align="center">
                                                    <img alt="{{ $response->rate }}" width="30"
                                                         src="{{ url('assets/img/').'/'.$response->rate.'.png' }}">
                                                </p>
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
    <!-- Row -->
@endsection

@section('scripts')
    <!-- ChartJS JavaScript -->
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
                    name:'Responses',
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
                        }])],
                    data:[
                        {value:{{ $total_poor }}, name:'Poor'},
                        {value:{{ $total_average }}, name:'Average'},
                        {value: {{ $total_excellent }}, name:'Excellent'},
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
                color: '#CD3A3A'
            }, {
                offset: 1,
                color: '#FF544F'
            }]),'rgba(33,33,33,0)',
                new echarts.graphic.LinearGradient(0, 1, 0, 0, [{
                    offset: 0,
                    color: '#FFC413'
                }, {
                    offset: 1,
                    color: '#FFDF00'
                }]),
                new echarts.graphic.LinearGradient(0, 1, 0, 0, [{
                    offset: 0,
                    color: '#30B846'
                }, {
                    offset: 1,
                    color: '#34EE51'
                }]),
                '#0d65c3'],
            legend: {
                show : false,
                data:['{{ _('Excellent') }}', '{{ _('Average') }}','{{ __('Poor') }}'],
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
                            @foreach($excellent as $key=>$value)
                                "{{ $key }}",
                            @endforeach
                        ];
                        return res;
                    })()
                },
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
                            @foreach($excellent as $key=>$value)
                                "{{ $key }}",
                            @endforeach
                        ];
                        return res;
                    })()
                },
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
                            @foreach($excellent as $key=>$value)
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
                    max: 100,
                    min: 0,
                    boundaryGap: [1, 1]
                },
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
                    scale: false,
                    name: '',
                    max: 100,
                    min: 0,
                    boundaryGap: [1, 1]
                }
                ,
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
                    scale: false,
                    name: '',
                    max: 100,
                    min: 0,
                    boundaryGap: [1, 1]
                }
            ],
            series: [


                {
                    name:'Poor %',
                    type:'bar',
                    stack:'s1',
                    data:(function (){
                        var res = [
                            @foreach($excellent as $key=>$value)
                                    @php
                                        $total_ex = $excellent[$key]?$excellent[$key]->count():0;
                                        $total_av = $average[$key]?$average[$key]->count():0;
                                        $total_po = $poor[$key]?$poor[$key]->count():0;
                                        $total =  $total_ex + $total_av + $total_po;
                                        if($total > 0)
                                            $result = round($poor[$key]->count() / $total * 100 ,2);
                                        else
                                            $result = 0;
                                    @endphp
                                "{{   $result  }}",
                            @endforeach
                        ];
                        return res;
                    })()
                },
                {
                    name:'Total',
                    type:'line',
                    stack:'22',
                    showSymbol: false,
                    data:(function (){
                        var res = [
                            @foreach($excellent as $key=>$value)
                                "{{ $poor[$key]->count() }}",
                            @endforeach
                        ];
                        return res;
                    })()
                }
                ,
                {
                    name:'Average %',
                    type:'bar',
                    stack:'s1',
                    data:(function (){
                        var res = [
                            @foreach($excellent as $key=>$value)
                                    @php
                                        $total_ex = $excellent[$key]?$excellent[$key]->count():0;
                                        $total_av = $average[$key]?$average[$key]->count():0;
                                        $total_po = $poor[$key]?$poor[$key]->count():0;
                                        $total =  $total_ex + $total_av + $total_po;
                                        if($total > 0)
                                            $result = round($average[$key]->count() / $total * 100 ,2);
                                        else
                                            $result = 0;
                                    @endphp
                                "{{   $result  }}",
                            @endforeach
                        ];
                        return res;
                    })()
                },{
                    name:'Total',
                    type:'line',
                    showSymbol: false,
                    stack:'22',
                    data:(function (){
                        var res = [
                            @foreach($excellent as $key=>$value)
                                "{{ $average[$key]->count() }}",
                            @endforeach
                        ];
                        return res;
                    })()
                },{
                    name:'Excellent %',
                    type:'bar',
                    stack:'s1',
                    data:(function (){
                        var res = [
                            @foreach($excellent as $key=>$value)
                                    @php
                                        $total_ex = $excellent[$key]?$excellent[$key]->count():0;
                                        $total_av = $average[$key]?$average[$key]->count():0;
                                        $total_po = $poor[$key]?$poor[$key]->count():0;
                                        $total =  $total_ex + $total_av + $total_po;
                                        if($total > 0)
                                            $result = round($value->count() / $total * 100 ,2);
                                        else
                                            $result = 0;
                                    @endphp
                                "{{   $result  }}",
                            @endforeach
                        ];
                        return res;
                    })()
                },
                {
                    name:'{{ __('Total') }}',
                    type:'line',
                    showSymbol: false,
                    stack:'22',
                    data:(function (){
                        var res = [
                            @foreach($excellent as $key=>$value)
                                "{{ $value->count() }}",
                            @endforeach
                        ];
                        return res;
                    })()
                }
                ,
                {
                    name:'Happy Index %',
                    type:'line',
                    stack:'20',
                    data:(function (){
                        var res = [
                            @foreach($excellent as $key=>$value)
                                    @php
                                        $total_ex = $excellent[$key]?$excellent[$key]->count():0;
                                        $total_av = $average[$key]?$average[$key]->count():0;
                                        $total_po = $poor[$key]?$poor[$key]->count():0;
                                        $total =  $total_ex + $total_av + $total_po;
                                        $upper = ($excellent[$key]->count()*100) +
                                                  ($average[$key]->count()*50) ;
                                        if($total > 0)
                                            $result = round($upper / $total ,1);
                                        else
                                            $result = 0;
                                    @endphp
                                "{{   $result  }}",
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