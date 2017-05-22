@extends('Admin.layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('static/css/total.css')}}">
    @endsection


@section('title','成绩统计')


@section('content')
    <div class="admin-main">
        <blockquote class="layui-elem-quote">
            <form class="layui-form" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">筛选学科</label>
                        <div class="layui-input-inline">
                            <select name="subject" lay-verify="required" lay-filter="subject">
                                <option value="">直接选择或搜索</option>
                                <option value="1" @if($subject == 1) selected @endif>java</option>
                                <option value="2" @if($subject == 2) selected @endif >c语言</option>
                            </select>
                        </div>
                    </div>
                </div>



                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">试卷名称</label>
                        <div class="layui-input-inline">
                            <select name="testpaper" class="select_paper" required lay-filter="paper">
                                <option value="" >直接选择或搜索</option>
                                @foreach($allpaper as $item)
                                    <option value="{{$item['id']}}" @if($testpaper == $item['id']) selected @endif>{{$item['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button  class="layui-btn layui-btn-small" lay-submit="" lay-filter="search" id="search" >
                    <i class="layui-icon">&#xe615;</i> 搜索
                </button >
                @if($subject != "")
                <button  class="layui-btn layui-btn-small" id="all" onclick="window.location.href = listurl; return false;" >
                    <i class="layui-icon">&#xe615;</i> 查看全部
                </button >
                @endif
                <button type="reset" class="layui-btn layui-btn-small layui-btn-warm"> <i class="fa fa-eercast" aria-hidden="true"></i> 重置 </button>


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
    <script>


        // 获得圆形成绩
        var unqulify = "{{$circle['unqulify']}}";
        var qulify = "{{$circle['qulify']}}";
        var full = "{{$circle['full']}}";

        // 循环获得柱形成绩
        var number=new Array();
        @for($i = 0; $i <= 100; $i = $i + 10)
            number["{{$i}}"] ="{{$pillar[$i]}}";
        @endfor


        var paperurl = "{{url('admin/Score/getpaper')}}";
        var listurl = "{{url('admin/Score/total')}}";


    </script>
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
                data: [number[10], number[20],
                    number[30], number[40],
                    number[50],number[60],
                    number[70],number[80],
                    number[90],number[100]]
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
                    value: full,
                    name: "满分"
                }, {
                    value: qulify,
                    name: "及格"
                }, {
                    value: unqulify,
                    name: "不及格"
                }]
            }]
        };
        circle.setOption(option);
    </script>

    @endsection