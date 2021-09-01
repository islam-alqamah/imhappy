@extends('layouts.print_account')

@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-20">
            <div id="print" class="panel panel-default card-view panel-refresh">
                <div class="refresh-container">
                    <div class="la-anim-1"></div>
                </div>
                <div class="panel-heading dont-print">
                    <div class="pull-left">
                        <form  id="filtering" class="form-inline" action="{{ route('charts') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <select name="city_id" id="city"  class="form-control">
                                    <option value="all">{{ __('City') }}</option>
                                    @foreach($cities as $city)
                                        <option @if(isset($request->city_id) && $request->city_id == $city->id) selected @endif
                                                value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                <select name="branch_id" id="branch" onchange="form.submit()" class="form-control">
                                    <option value="all">{{ __('Branch') }}</option>
                                    @foreach($branches as $branch)
                                        <option @if(isset($request->branch_id) && $request->branch_id == $branch->id) selected @endif
                                        value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                                <input class="form-control input-daterange-datepicker"  type="text" name="date_range"
                                       value="{{ isset($request->date_range) ?$request->date_range: \Carbon\Carbon::now()->subDays(30)->format('m/d/Y').' - '.\Carbon\Carbon::now()->format('m/d/Y') }}">
                                <button type="submit" class="btn btn-primary btn-outline fancy-button btn-0">{{ __('Filter') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="pull-right">
                        <a href="#" class="pull-left inline-block refresh mr-15">
                            <i class="zmdi zmdi-replay"></i>
                        </a>
                        <a href="#" id="cmd" class="pull-left inline-block  mr-15">
                            <i class="zmdi zmdi-print"></i>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <canvas id="feedback-chart" class="" style="height:400px;width: 1300px"></canvas>
                                <h5 class="text-center">{{ __('Daily Stats') }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <canvas id="feedback-chart1" class="" style="height:313px;width: 650px"></canvas>
                                <h5 class="text-center">{{ __('Hourly Stats') }}</h5>
                            </div>
                            <div class="col-md-6">
                                <canvas id="feedback-chart2" class="" style="height:313px;width:650px"></canvas>
                                <h5 class="text-center">{{ __('Weekly Stats') }}</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">

                                <canvas id="feedback-chart3" class="" style="height:313px; width: 1300px"></canvas>
                                <h5 class="text-center">{{ __('Monthly Stats') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Row -->
    <!-- Row -->

    <!-- Row -->
@endsection
@section('styles')
    <!-- Bootstrap Daterangepicker CSS -->
    <link href="{{ url('assets/dist/vendors') }}/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
    <link href="{{ url('assets/dist/vendors') }}/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>

@endsection
@section('scripts')
    <script type="text/javascript" src="{{ url('assets/dist/vendors') }}/bower_components/moment/min/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="{{ url('assets/dist/vendors') }}/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Bootstrap Daterangepicker JavaScript -->
    <script src="{{ url('assets/dist/vendors') }}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Form Picker Init JavaScript -->
    <!-- ChartJS JavaScript -->
    <script src="{{ url('assets/dist/vendors') }}/chart.js/Chart.min.js"></script>
    <script>
        // wkhtmltopdf 0.12.5 crash fix.
        // https://github.com/wkhtmltopdf/wkhtmltopdf/issues/3242#issuecomment-518099192
        'use strict';
        (function(setLineDash) {
            CanvasRenderingContext2D.prototype.setLineDash = function() {
                if(!arguments[0].length){
                    arguments[0] = [1,0];
                }
                // Now, call the original method
                return setLineDash.apply(this, arguments);
            };
        })(CanvasRenderingContext2D.prototype.setLineDash);
        Function.prototype.bind = Function.prototype.bind || function (thisp) {
            var fn = this;
            return function () {
                return fn.apply(thisp, arguments);
            };
        };
    </script>

<script>



    $(document).on('change','#city',function () {
        $('#branch').val('all')
        $('#filtering').submit();
    });
    $('.input-daterange-datepicker').daterangepicker({
        format:'DD-MM-YYYY',
    });

    if( $('#feedback-chart').length > 0 ){
        var eChart_1 = echarts.init(document.getElementById('feedback-chart'));
        var option = {
            animation: false,
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
                                            $result = round($total_po / $total * 100 ,2);
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
                                            $result = round($total_av / $total * 100 ,2);
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
                                        $upper = ($total_ex*100) +
                                                  ($total_av*50) ;
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


    if( $('#feedback-chart1').length > 0 ){
        var eChart_1 = echarts.init(document.getElementById('feedback-chart1'));
        var option = {
            animation: false,
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
                show:false,
                data:['{{ _('Excellent') }}', '{{ _('Average') }}','{{ __('Poor') }}'],
                x : 'left',
                y : 'bottom'
            },
            toolbox: {
                show: false,
                orient: 'vertical',
                left: 'right',
                top: 'center',
                showTitle: false,
                feature: {
                    mark: {show: true},
                    magicType: {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                    restore: {show: true},
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
                            @foreach($poor_h as $key=>$value)
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
                            @foreach($poor_h as $key=>$value)
                                    @php
                                        $total =  ($excellent_h[$key]->count()+
                                              $average_h[$key]->count()+
                                              $poor_h[$key]->count());
                                    @endphp
                                "{{   $total  }}",
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
                            @foreach($poor_h as $key=>$value)
                                    @php
                                        $total =  ($excellent_h[$key]->count()+
                                              $average_h[$key]->count()+
                                              $poor_h[$key]->count());
                                    @endphp
                                "{{   $total  }}",
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
                        show:false,
                        opacity:0,
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
                    boundaryGap: [2, 2]
                }
            ],
            series: [
                {
                    name:'Poor %',
                    type:'bar',
                    stack: 'st1',
                    data:(function (){
                        var res = [
                            @foreach($poor_h as $key=>$value)
                                    @php
                                        $total =  ($excellent_h[$key]->count()+
                                              $average_h[$key]->count()+
                                              $poor_h[$key]->count());
                                        if($total > 0)
                                            $result = round($value->count()/$total * 100,1);
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
                    showSymbol: false,
                    opacity:0,
                    stack: '21',
                    data:(function (){
                        var res = [
                            @foreach($poor_h as $key=>$value)
                                "{{   $value->count()  }}",
                            @endforeach
                        ];
                        return res;
                    })()
                },
                {
                    name:'Average %',
                    type:'bar',
stack: 'st1',
                    data:(function (){
                        var res = [
                            @foreach($poor_h as $key=>$value)
                                    @php
                                    if(isset($excellent_h[$key])){
                                        $total =  ($excellent_h[$key]->count()+
                                              $average_h[$key]->count()+
                                              $poor_h[$key]->count());
                                        if($total > 0)
                                            $result = round($average_h[$key]->count()/$total * 100,1);
                                        else
                                            $result = 0;
                                       } else{ $result = 0 ; }
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
                    stack: '23',
                    showSymbol: false,
                    data:(function (){
                        var res = [
                            @foreach($poor_h as $key=>$value)
                                "{{   $average_h[$key]->count()  }}",
                            @endforeach
                        ];
                        return res;
                    })()
                },
                {
                    name:'Excellent %',
                    type:'bar',
                    stack:'st1',
                    data:(function (){
                        var res = [
                            @foreach($poor_h as $key=>$value)
                                    @php
                                    if(isset($excellent_h[$key])){
                                        $total =  ($excellent_h[$key]->count()+
                                              $average_h[$key]->count()+
                                              $poor_h[$key]->count());
                                        if($total > 0)
                                            $result = round($excellent_h[$key]->count()/$total * 100,1);
                                        else
                                            $result = 0;
                                        }else{
                                                $result =0 ;
                                        }
                                    @endphp
                                " {{   $result  }} ",
                            @endforeach
                        ];
                        return res;
                    })()
                },
                {
                    name:'Total',
                    type:'line',
                    stack: '22',
                    showSymbol: false,

                    data:(function (){
                        var res = [
                            @foreach($poor_h as $key=>$value)
                                "{{   $excellent_h[$key]->count()  }}",
                            @endforeach
                        ];
                        return res;
                    })()
                },

                {
                    name:'Happy Index %',
                    type:'line',
                    stack:'20',


                    lineStyle:{
                        color:'#0035f1'
                    },
                    data:(function (){
                        var res = [
                            @foreach($poor_h as $key=>$value)
                                    @php
                                    if(isset($excellent_h[$key])){
                                        $total =  ($excellent_h[$key]->count()+
                                              $average_h[$key]->count()+
                                              $poor_h[$key]->count());
                                        $upper = ($excellent_h[$key]->count()*100) +
                                                  ($average_h[$key]->count()*50) ;
                                        if($total > 0)
                                            $result = round($upper / $total ,1);
                                        else
                                            $result = 0;
                                        }else{ $result=0; }
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
    if( $('#feedback-chart2').length > 0 ){
        var eChart_1 = echarts.init(document.getElementById('feedback-chart2'));
        var option = {
            animation: false,
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
                orient: 'vertical',
                left: 'right',
                top: 'center',
                showTitle: false,
                feature: {
                    mark: {show: true},
                    magicType: {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                    restore: {show: true},
                }
            },
            dataZoom: {
                show: false,
                start: 0,
                end: 100
            },
            <?php
                $days = ["Sunday"=>1,"Monday"=>2,"Tuesday"=>3,"Wednesday"=>4,"Thursday"=>5,"Friday"=>6,"Saturday"=>7]
                ?>
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
                            @foreach($days as $key=>$value)
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
                            @foreach($days as $key=>$value)
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
                            @foreach($days as $key=>$value)
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
                    boundaryGap: [2, 2]
                }
            ],
            series: [
                {
                    name:'Poor %',
                    type:'bar',

                    stack: 'st1',
                    data:(function (){
                        var res = [
                            @foreach($days as $keyp=>$value)
                                    @php

                                           $total_ex = isset($excellent_d[$keyp])?$excellent_d[$keyp]->count():0;
                                        $total_av = isset($average_d[$keyp])?$average_d[$keyp]->count():0;
                                        $total_po = isset($poor_d[$keyp])?$poor_d[$keyp]->count():0;
                                        $total =  $total_ex + $total_av + $total_po;
                                           if($total > 0 && isset($poor_d[$keyp]))
                                               $result = round($poor_d["$keyp"]->count()/$total * 100,1);
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
                    showSymbol:false,
                    stack: '22',
                    data:(function (){
                        var res = [
                            @foreach($days as $key=>$value)
                                @if(isset($poor_d[$key]))
                                "{{   $poor_d[$key]->count()  }}",
                            @else
                                "0",
                            @endif
                            @endforeach
                        ];
                        return res;
                    })()
                },
                {
                    name:'Average %',
                    type:'bar',
                    stack:'st1',
                    data:(function (){
                        var res = [
                            @foreach($days as $keyv=>$value)
                                    @php

                                       $total_ex = isset($excellent_d[$keyv])?$excellent_d[$keyv]->count():0;
                                        $total_av = isset($average_d[$keyv])?$average_d[$keyv]->count():0;
                                        $total_po = isset($poor_d[$keyv])?$poor_d[$keyv]->count():0;
                                        $total =  $total_ex + $total_av + $total_po;
                                        if($total > 0 && isset($average_d[$keyv]))
                                            $result = round($average_d["$keyv"]->count()/$total * 100,2);
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
                    showSymbol:false,
                    stack: '22',
                    data:(function (){
                        var res = [
                            @foreach($days as $key=>$value)
                                @if(isset($average_d[$key]))
                                "{{   $average_d[$key]->count()  }}",
                                @else
                                "0",
                                @endif
                            @endforeach
                        ];
                        return res;
                    })()
                },

                {
                    name:'Excellent %',
                    type:'bar',
                    stack: 'st1',
                    data:(function (){
                        var res = [
                            @foreach($days as $key=>$value)
                                    @php

                                        $total_ex = isset($excellent_d[$key])?$excellent_d[$key]->count():0;
                                        $total_av = isset($average_d[$key])?$average_d[$key]->count():0;
                                        $total_po = isset($poor_d[$key])?$poor_d[$key]->count():0;
                                        $total =  $total_ex + $total_av + $total_po;
                                           if($total > 0 && $total_ex)
                                               $result = round($total_ex/$total * 100,2);
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
                    showSymbol:false,
                    stack: '22',
                    data:(function (){
                        var res = [
                            @foreach($days as $key=>$value)
                                @if(isset($excellent_d["$key"]))
                                "{{   $excellent_d["$key"]->count()  }}",
                                @else
                                "0",
                                @endif
                            @endforeach
                        ];
                        return res;
                    })()
                },
                {
                    name:'Happy Index %',
                    type:'line',
                    stack:'20',
                    data:(function (){
                        var res = [
                            @foreach($days as $key=>$value)
                                    @php

                                        $total_ex = isset($excellent_d[$key])?$excellent_d[$key]->count():0;
                                        $total_av = isset($average_d[$key])?$average_d[$key]->count():0;
                                        $total_po = isset($poor_d[$key])?$poor_d[$key]->count():0;
                                        $total =  $total_ex + $total_av + $total_po ;
                                        $upper = ($total_ex*100) +
                                                  ($total_av*50) ;
                                        if($total > 0 && $total_ex )
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
    if( $('#feedback-chart3').length > 0 ){
        var eChart_1 = echarts.init(document.getElementById('feedback-chart3'));
        var option = {
            animation: false,
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
            color: [
                new echarts.graphic.LinearGradient(0, 1, 0, 0, [{
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
                data:['Poor %','Total' , 'Average %','Total','Excellent %','Total','Happy Index'],
                x : 'left',
                y : 'bottom'
            },
            toolbox: {
                show: false,
                orient: 'vertical',
                left: 'right',
                top: 'center',
                showTitle: false,
                feature: {
                    mark: {show: true},
                    magicType: {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                    restore: {show: true},
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
                        <?php
                            $months = ["January"=>1,"February"=>2,"March"=>3,"April"=>4,"May"=>5
                                ,"June"=>6,"July"=>7,"August"=>8,"September"=>9,"October"=>10,"November"=>11,"December"=>12];
                        ?>
                        var res = [
                            @foreach($months as $key=>$value)
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
                            @foreach($months as $key=>$value)
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
                            @foreach($months as $key=>$value)
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
                    stack:'st1',
                    data:(function (){
                        var res = [
                            @foreach($months as $key=>$value)
                                    @php

                                            $total_ex = isset($excellent_m[$key])?$excellent_m[$key]->count():0;
                                        $total_av = isset($average_m[$key])?$average_m[$key]->count():0;
                                        $total_po = isset($poor_m[$key])?$poor_m[$key]->count():0;
                                        $total =  $total_ex + $total_av + $total_po ;
                                            if($total > 0)
                                                $result = round($total_po / $total * 100,2);
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
                    showSymbol:false,
                    stack: '22',
                    data:(function (){
                        var res = [
                            @foreach($months as $key=>$value)
                                @if(isset($poor_m[$key]))
                                "{{   $poor_m[$key]->count()  }}",
                                @else
                                    "0",
                                @endif
                            @endforeach
                        ];
                        return res;
                    })()
                },
                {
                    name:'Average %',
                    type:'bar',
                    stack:'st1',
                    data:(function (){
                        var res = [
                            @foreach($months as $key=>$value)
                                    @php
       $total_ex = isset($excellent_m[$key])?$excellent_m[$key]->count():0;
                                        $total_av = isset($average_m[$key])?$average_m[$key]->count():0;
                                        $total_po = isset($poor_m[$key])?$poor_m[$key]->count():0;
                                        $total =  $total_ex + $total_av + $total_po ;
        if($total > 0)
            $result = round($total_av/$total * 100,2);
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
                    stack: '22',
                    showSymbol:false,
                    data:(function (){
                        var res = [
                            @foreach($months as $key=>$value)
                                @if(isset($average_m[$key]))
                                "{{   $average_m[$key]->count()  }}",
                                @else
                                    "0",
                                @endif
                            @endforeach
                        ];
                        return res;
                    })()
                },
                {
                    name: 'Excellent',
                    type:'bar',
                    stack:'st1',
                    data:(function (){
                        var res = [
                            @foreach($months as $key=>$value)
                                    @php

        $total_ex = isset($excellent_m[$key])?$excellent_m[$key]->count():0;
                                        $total_av = isset($average_m[$key])?$average_m[$key]->count():0;
                                        $total_po = isset($poor_m[$key])?$poor_m[$key]->count():0;
                                        $total =  $total_ex + $total_av + $total_po ;
        if($total > 0)
            $result = round($total_ex/$total * 100,2);
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
                    showSymbol:false,
                    stack: '22',
                    data:(function (){
                        var res = [
                            @foreach($months as $key=>$value)
                                    @if(isset($excellent_m[$key]))
                                "{{   $excellent_m[$key]->count()  }}",
                            @else
                                "0",
                            @endif
                            @endforeach
                        ];
                        return res;
                    })()
                },
                {
                    name:'Happy Index %',
                    type:'line',
                    stack:'20',
                    data:(function (){
                        var res = [
                            @foreach($months as $key=>$value)
                                    <?php

                                        $total_ex = isset($excellent_m[$key])?$excellent_m[$key]->count():0;
                                        $total_av = isset($average_m[$key])?$average_m[$key]->count():0;
                                        $total_po = isset($poor_m[$key])?$poor_m[$key]->count():0;
                                        $total =  $total_ex + $total_av + $total_po ;
                                        $upper = ($total_ex*100) +
                                                  ($total_av*50) ;
                                        if($total > 0)
                                            $result = round($upper / $total ,1);
                                        else
                                            $result = 0;

                                    ?>
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

<script>
    $('#cmd').click(function (){
        PrintElem('print');
    });
    function PrintElem(elem)
    {

        window.print();

    }
</script>

@endsection