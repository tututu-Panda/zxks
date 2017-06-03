@extends('Home.layouts.layout')
@section('title')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('static/layui/css/layui.css')}}" media="all">
    <title>Online exam在线考试系统</title>
@endsection

<style>
    .index-body {
        min-height: 85vh;
    }

    .somepanel {
        float: left;
        width: 100%;
        min-height: 85vh;
        height: auto;
        background-color: #f3f3f4;
    }
    .index-content {
        margin-left: 10px;
    }
    .test {
        float: left;
        width: 100%;
        margin-left: 5%;
        margin-top: 10%;
    }
    .test-type1 {
        width: 97%;
    }
    .test-type2 {
        padding-top: 15px;
        padding-left: 20px;
        padding-bottom: 25px;
    }
    .grade-table {
        margin-top: 20px;
        margin-bottom: 40px;
    }
    .default-panel {
        margin-top: 30px;
        margin-left: 30px;
    }
    .info-font {
        font-size: ;
    }
    .site-table tbody tr td {text-align: center;}
    /*.site-table tbody tr td .layui-btn+.layui-btn{margin-left: 0px;}*/
    .admin-table-page {position: fixed;z-index: 19940201;bottom: 0;width: 100%;background-color: #eee;border-bottom: 1px solid #ddd;left: 0px;}
    .admin-table-page .page{padding-left:20px;}
    .admin-table-page .page .layui-laypage {margin: 6px 0 0 0;}
    .table-hover tbody tr:hover{ background-color: #EEEEEE; }
    /*.single-test {*/
    /*margin: .875em 1em;*/
    /*}*/
</style>
@section('content')
    <div class="index-body">
        <div class="ui grid">
            <div class="three wide column">
                <div class="test">
                    <div class="ui teal vertical  menu left" style="width: 100%">
                        <div class="ui item" style="height: 120px;">
                            <img class="ui avatar image" style="height:82px;width: 82px; border-radius: 50%;" src="{{ URL::asset('static/img/default1.jpg') }}"> Student

                        </div>
                        <div class="item">
                            <div class="header"><span class="navbar-header">首页</span></div>
                            <div class="menu" >
                                <a class="item" href="{!! route('Home.Index.index') !!}"><span class="navbar-item"><i class="icon home"></i>&nbsp;首页</span></a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="header"><span class="navbar-header">个人管理</span></div>
                            <div class="menu" >
                                <a class="item" href="{!! route('Home.Index.personInfo') !!}"><span class="navbar-item"><i class="icon user"></i>&nbsp;个人资料</span></a>
                                <a class="item" href="{{ URL('home/modifyPsw') }}"><span class="navbar-item"><i class="icon lock"></i>&nbsp;修改密码</span></a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="header"><span class="navbar-header">成绩查询</span></div>
                            <div class="menu">
                                <a class="item active" href="{{URl('home/gradeIndex')}}"><span class="navbar-item"><i class="icon wait"></i>&nbsp;成绩查看</span></a>

                            </div>
                        </div>
                        <div class="item">
                            <div class="header"><span class="navbar-header">考试管理</span></div>
                            <div class="menu">
                                <a class="item" href="{!! route('Home.Exam.examIndex') !!}"><span class="navbar-item"><i class="icon mail forward"></i>选择科目考试</span></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="thirteen wide column">
                <div class="somepanel">
                    <div class="ui stacked segments test-type1" style="margin-left: 2%;margin-top: 3%;">
                        <div class="ui segment">
                            <p>成绩查看 \ 成绩详情</p>
                        </div>
                        <div class="ui teal segment" style="min-height: 65vh;">
                            {{--<div class="echarts1" id="echarts-test" style="height:300px;"></div>--}}
                            <div class="grade-table">
                                <h4 class="ui horizontal divider header">
                                    <i class="bar chart icon"></i>
                                    {{ $paperName }}考试
                                </h4>
                                <div class="ui grid">
                                    <div class="echarts1 eight wide column" id="echarts-test" style="width:50%;height:60%;"></div>
                                    <div class="eight wide column" style="">
                                        <div class="default-panel">
                                            <div class="ui three small statistics">
                                                <div class="statistic">
                                                    <div class="value">
                                                        {{ $score }}
                                                    </div>
                                                    <div class="label">
                                                        分数
                                                    </div>
                                                </div>
                                                <div class="statistic">
                                                    <div class="value">
                                                        {{ $defaultC }}
                                                    </div>
                                                    <div class="label">
                                                        错题
                                                    </div>
                                                </div>
                                                <div class="statistic">
                                                    <div class="value">
                                                        {{ $choiceFault }}
                                                    </div>
                                                    <div class="label">
                                                        错题：选择错题
                                                    </div>
                                                </div>
                                                <div class="statistic">
                                                    <div class="value">
                                                        {{ $fillFault }}
                                                    </div>
                                                    <div class="label">
                                                        错题：填空错题
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="" style="margin-top: 100px;">
                                                @if($score >= 80)
                                                <p>评语：哎哟，还不错呢，同学！</p>
                                                    @elseif($score < 60)
                                                <p>评语：分数有点低呢，怎么了？</p>
                                                    @else
                                                    <p>评语：再接再厉，继续加油喔~~~</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script src="{{URL::asset('static/layui/layui.js')}}"></script>
    <script src="{{ URL::asset('static/jsbars/echarts.min.js') }}"></script>
    {{--<script src="{{ URL::asset('static/js/home_gradeIndex.js') }}"></script>--}}
    @parent
    <script type="text/javascript">
        var myChart1 = echarts.init(document.getElementById('echarts-test'));
        myChart1.setOption({
            title: {
                text: '本次试卷试题分析（单位:道）',
                subtext: '来源于统计中心',
            },
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                },
                formatter: function (params) {
                    var tar = params[1];
                    return tar.name + '<br/>' + tar.seriesName + ' : ' + tar.value;
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: {
                type : 'category',
                splitLine: {show:false},
                data : ['总题量','选择题','填空题','简单','一般','较难']
            },
            yAxis: {
                type : 'value'
            },
            series: [
                {
                    name: '辅助',
                    type: 'bar',
                    stack:  '总量',
                    itemStyle: {
                        normal: {
                            barBorderColor: 'rgba(0,0,0,0)',
                            color: 'rgba(0,0,0,0)'
                        },
                        emphasis: {
                            barBorderColor: 'rgba(0,0,0,0)',
                            color: 'rgba(0,0,0,0)'
                        }
                    },
                    data: [0, 0, 0, 0, 0, 0]
                },
                {
                    name: '题数',
                    type: 'bar',
                    stack: '总量',
                    label: {
                        normal: {
                            show: true,
                            position: 'inside'
                        }
                    },
                    data:[{{ $echarData1 }}]
                }
            ],
            color:['#3498db', '#c4ccd3']
        });
    </script>
@endsection