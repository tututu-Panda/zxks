@extends('Admin.layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('static/css/total.css')}}">
    @endsection


@section('title','成绩统计')


@section('content')
    <div class="admin-main">
        <blockquote class="layui-elem-quote">
            <form class="layui-form" action="" method="post">

                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">筛选学科</label>
                        <div class="layui-input-inline">
                            <select name="select_subject" lay-verify="required" lay-filter="subject">
                                <option value="">直接选择或搜索</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">筛选年级</label>
                        <div class="layui-input-inline">
                            <select name="select_grade" lay-search="" lay-verify="" lay-filter="grade">
                                <option value="" selected="">直接选择或搜索</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">筛选班级</label>
                        <div class="layui-input-inline">
                            <select name="select_class" class="select_class" lay-verify="" lay-search="" lay-filter="class">
                                <option value="" >直接选择或搜索</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">试卷名称</label>
                        <div class="layui-input-inline">
                            <select name="select_class" class="select_class" lay-verify="" lay-search="" lay-filter="class">
                                <option value="" >直接选择或搜索</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button  class="layui-btn layui-btn-small" lay-submit="" lay-filter="submit2" id="search" >
                    <i class="layui-icon">&#xe615;</i> 搜索
                </button >


            </form>
        </blockquote>
        <fieldset class="layui-elem-field">
            <legend>成绩统计</legend>
            <div id="java">
                <div id="java_pillar"></div>
                <div id="java_circle"></div>
            </div>
        </fieldset>
    

    </div>
    @endsection

@section('js')
    <script src="{{asset("static/js/total.js")}}"></script>
    <script src="{{asset("static/js/echarts.js")}}"></script>
    <script src="{{asset("static/js/macarons.js")}}"></script>
    <script>
        var pillar = echarts.init(document.getElementById('java_pillar'));
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '试卷总体分析'
            },
//            tooltip: {},
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            legend: {
                data:['人数']
            },
            xAxis: {
                data: ["10","20","30","40","50","60","70","80","90","100"]
            },
            yAxis: {},
            series: [{
                name: '人数',
                type: 'bar',
                data: [5, 20, 36, 10, 10, 20,54,14,12,2]
            }],
            itemStyle: {
                normal: {

                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: 'rgba(17, 168,171, 1)'
                    }, {
                        offset: 1,
                        color: 'rgba(17, 168,171, 0.1)'
                    }]),
                    shadowColor: 'rgba(0, 0, 0, 0.1)',
                    shadowBlur: 10
                }
            }
        };
        // 使用刚指定的配置项和数据显示图表。
        pillar.setOption(option);
    </script>
    <script>
        var circle = echarts.init(document.getElementById('java_circle'),'macarons');
        option = {
            title: {
                text: "试卷及格情况分析",
                textStyle: {
                    fontWeight: 'bolder',              //标题颜色
                    color: '#000'
                },
                x: "center"
            },
            tooltip: {
                trigger: "item",
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                x: "left",
                data: ["不及格", "及格", "满分"]
            },
            label: {
                normal: {
                    formatter: "{b} ({d}%)",
                    position: "insideTopRight"
                }
            },
            labelLine: {
                normal: {
                    smooth: .6
                }
            },
            toolbox: {
                show: !0,
                feature: {

                    dataView: {
                        show: !0,
                        readOnly: !1
                    },


                    saveAsImage: {
                        show: !0
                    }
                }
            },
            calculable: !0,
            series: [{
                name: "总体比例",
                type: "pie",
                roseType: "area",
                label: {
                    normal: {
                        show: !0
                    },
                    emphasis: {
                        show: !0
                    }
                },
                lableLine: {
                    normal: {
                        show: !0
                    },
                    emphasis: {
                        show: !0
                    }
                },
                data: [{
                    value: 305,
                    name: "满分"
                }, {
                    value: 234,
                    name: "及格"
                }, {
                    value: 145,
                    name: "不及格"
                }]
            }]
        };
        circle.setOption(option);
    </script>

    @endsection