@extends('Admin.layouts.layout')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset("static/css/bootstrap.min.css")}}">
@endsection
    <link rel="stylesheet" type="text/css" href="{{asset("static/css/Admin-main.css")}}">
@section('content')
    <div class="admin-main">
        <div class="admin">
            <div class="panel panel-headline">
                {{--<div class="panel-heading">--}}
                    {{--<h3 class="panel-title">系统时间</h3>--}}
                    {{--<p class="panel-subtitle">{{ date('Y-m-d')}}</p>--}}
                {{--</div>--}}
                <div class="panel-body">
                    {{--图标--}}
                    <div class="row">
                        <div class="col-md-3">
                            <dl>
                                <dt class="qs"><i class="fa fa-user-circle" aria-hidden="true"></i></dt>
                                <dd>{{$stuNum}}</dd>
                                <dd style="font-size: 15px;">学生数量</dd>
                            </dl>
                        </div>
                        <div class="col-md-3">
                            <dl>
                                <dt class="cs"><i class="fa fa-folder" aria-hidden="true"></i></dt>
                                <dd>{{$baseNum}}</dd>
                                <dd style="font-size: 15px;">题库数量</dd>
                            </dl>
                        </div>
                        <div class="col-md-3">
                            <dl>
                                <dt class="hs"><i class="fa fa-check-square-o" aria-hidden="true"></i></dt>
                                <dd>{{$useNum}}</dd>
                                <dd style="font-size: 15px;">启用试卷</dd>
                            </dl>
                        </div>
                        <div class="col-md-3">
                            <dl>
                                <dt class="ls"><i class="fa fa-clock-o" aria-hidden="true"></i></dt>
                                <dd>{{$stopNum}}</dd>
                                <dd style="font-size: 15px;">停用试卷</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row" style="background-color: #f5f5fa">
                    {{--访问数据--}}
                    <div class="look-data ">
                        <div class="list-title">
                            <div class="tpl-caption font-green" style="padding-left: 15px;">
                                <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                <span>在线统计</span>
                            </div>
                        </div>
                        <div id="data" style="height: 300px;"></div>
                    </div>
                </div>
            </div>

            <div class="main-panel-footer" style="background-color:#fff">
                <div class="panel-body">
                    <div class="row">

                        {{--试卷状态--}}
                        <div class="test-paper col-md-6">
                            <div class="list-title">
                                <div class="tpl-caption font-green ">
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                    <span> 试卷状态</span>
                                </div>
                            </div>
                            <div class="layui-tab layui-tab-card">
                                    <ul class="layui-tab-title tab-title" style="position: absolute;left:unset">
                                        <li class="layui-this">已启用</li>
                                        <li>已停用</li>
                                    </ul>
                                    <div class="layui-tab-content" >
                                        <div class="layui-tab-item layui-show">
                                            <table class="table table-hover">
                                                <colgroup>
                                                    <col width="50%">
                                                    <col width="50%">
                                                </colgroup>
                                                <thead>
                                                <tr>
                                                    <th>试卷名称</th>
                                                    <th>考试时间</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($usePaper as $paper)
                                                <tr class="success">
                                                    <td>{{$paper['name']}}</td>
                                                    <td>{{$paper['beginDate']}}</td>
                                                </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="layui-tab-item">
                                            <table class="table table-hover">
                                                <colgroup>
                                                    <col width="50%">
                                                    <col width="50%">
                                                </colgroup>
                                                <thead>
                                                <tr>
                                                    <th>试卷名称</th>
                                                    <th>考试时间</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if($stopPaper !="")
                                                @foreach($stopPaper as $paper)
                                                <tr class="info">
                                                    <td>{{$paper['name']}}</td>
                                                    <td>{{$paper['beginDate']}}</td>
                                                </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        {{--排行榜--}}
                        <div class="rank-list col-md-5" style="margin-left: 8.3%;">
                            <div class="list-title">
                                <div class="tpl-caption font-green ">
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                    <span> 排行榜　<span style="color: #8d99a8">--试卷平均分</span></span>
                                </div>
                            </div>
                            <div class="lis-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>排行</th>
                                            <th>用户</th>
                                            <th>平均分/套</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rank as $key=>$value)
                                        <tr
                                                @if($key==0)
                                                class="success"
                                                @elseif($key==1)
                                                    class="info"
                                                @elseif($key==2)
                                                    class="warning"
                                                @else
                                                    class="active"
                                                @endif
                                        >
                                            <td>{{$key=$key+1}}</td>
                                            <td>{{$value['name']}}</td>
                                            <td>{{$value['score']}}/{{$value['count']}}</td>
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

@section('js')
    <script src="{{asset("static/js/admin-main.js")}}"></script>
    <script src="{{asset("static/jsbars/echarts.min.js")}}"></script>
    <script>
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('data'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '今日&昨日',
                left: '50%',
                textAlign: 'center'
            },
            tooltip: {
                trigger: 'asix',
                axisPointer: {
                    lineStyle: {
                        color: '#ddd'
                    }
                },
                backgroundColor: 'rgba(255,255,255,1)',
                padding: [5, 10],
                textStyle: {
                    color: '#7588E4',
                },
                extraCssText: 'box-shadow: 0 0 5px rgba(0,0,0,0.3)'
            },
            legend: {
                right: 20,
                orient: 'vertical',
                data: ['今日','昨日']
            },
            xAxis: {
                type: 'category',
                data: ['00:00','2:00','4:00','6:00','8:00','10:00','12:00','14:00','16:00','18:00','20:00',"22:00"],
                boundaryGap: false,
                splitLine: {
                    show: true,
                    interval: 'auto',
                    lineStyle: {
                        color: ['#D4DFF5']
                    }
                },
                axisTick: {
                    show: false
                },
                axisLine: {
                    lineStyle: {
                        color: '#609ee9'
                    }
                },
                axisLabel: {
                    margin: 10,
                    textStyle: {
                        fontSize: 14
                    }
                }
            },
            yAxis: {
                type: 'value',
                splitLine: {
                    lineStyle: {
                        color: ['#D4DFF5']
                    }
                },
                axisTick: {
                    show: false
                },
                axisLine: {
                    lineStyle: {
                        color: '#609ee9'
                    }
                },
                axisLabel: {
                    margin: 10,
                    textStyle: {
                        fontSize: 14
                    }
                }
            },
            series: [{
                name: '今日',
                type: 'line',
                smooth: true,
                showSymbol: false,
                symbol: 'circle',
                symbolSize: 6,
                data: ['1200', '1400', '1008', '1411', '1026', '1288', '1300', '800', '1100', '1000', '1118', '1322'],
                areaStyle: {
                    normal: {
                        color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                            offset: 0,
                            color: 'rgba(199, 237, 250,0.5)'
                        }, {
                            offset: 1,
                            color: 'rgba(199, 237, 250,0.2)'
                        }], false)
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#f7b851'
                    }
                },
                lineStyle: {
                    normal: {
                        width: 3
                    }
                }
            }, {
                name: '昨日',
                type: 'line',
                smooth: true,
                showSymbol: false,
                symbol: 'circle',
                symbolSize: 6,
                data: ['1200', '1400', '808', '811', '626', '488', '1600', '1100', '500', '300', '1998', '822'],
                areaStyle: {
                    normal: {
                        color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                            offset: 0,
                            color: 'rgba(216, 244, 247,1)'
                        }, {
                            offset: 1,
                            color: 'rgba(216, 244, 247,1)'
                        }], false)
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#58c8da'
                    }
                },
                lineStyle: {
                    normal: {
                        width: 3
                    }
                }
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
    @endsection