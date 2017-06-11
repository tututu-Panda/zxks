
@extends('Admin.layouts.layout')
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('static/css/rwdgrid.min.css') }}">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <style>
        body{
            color:#797979;
            background:#f1f2f7;
            padding:0px !important;
            margin:0px !important;
            font-size:12px;
            font-family: "微软雅黑","Microsoft YaHei","Microsoft YaHei UI", "Segoe UI", Arial, Verdana, Sans-Serif, sans-serif;}
        .layui-input{
            height: 30px;
        }
        .my-input .layui-input{
            height: 38px;
        }
        .my-input .layui-form-label{
            width: 90px;
        }
        .courseList{
            margin-top: 10px;
        }
        .layui-form-select{
            width: 80%; /*     调整select的宽度*/
        }

    </style>
@endsection

@section('content')
<div>
    <fieldset class="layui-elem-field">
        <legend>题库统计</legend>
        <div class="" style="height: 200px;padding-left: 12%">
            <div id="chart1" class="layui-inline" style="width: 30%;height:100%;"></div>
            <div id="chart2" class="layui-inline" style="width: 30%;height:100%; margin-left: 15%"></div>
        </div>
    </fieldset>
    <fieldset class="layui-elem-field">
        <legend>题目列表</legend>
        <div class="container-fluid">
            <div class="layui-input-block"></div>
            <!--<div class="" style="background-color:#fbfbfb;height: auto;border-radius: 10px;">-->
            <!--<div id="testDetil" class="main" style="width: 100%; min-height: 450px;"></div>-->
            <!--</div>-->
            <form class="layui-form" action="" id="searchForm">
                <blockquote class="layui-elem-quote">
                    <a href="javascript:;" class="layui-btn layui-btn-small addSingle">
                        <i class="layui-icon">&#xe608;</i> 添加单个题目
                    </a>
                    {{--<a href="javascript:;" class="layui-btn layui-btn-small addList">--}}
                        {{--<i class="layui-icon">&#xe608;</i> 导入题目--}}
                    {{--</a>--}}

                    <div class=" layui-input-block" style="display: inline-block; margin-left: 2px; vertical-align: bottom;">
                        <div class="layui-form-pane courseList">
                            <label class="layui-form-label" style="padding: 4px 1px;">选择难度</label>
                            <div class="layui-input-inline">
                                <select id="level" name="level_id" lay-verify>
                                    <option value=""></option>
                                    <option value="1" @if($level == 1) selected @endif>简单</option>
                                    <option value="2"@if($level == 2) selected @endif>一般</option>
                                    <option value="3"@if($level == 3) selected @endif>困难</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" layui-input-block" style="display: inline-block; margin-left: 2px; vertical-align: bottom;">
                        <div class="layui-form-pane courseList">
                            <label class="layui-form-label" style="padding: 4px 1px;">选择题型</label>
                            <div class="layui-input-inline">
                                <select id="type" name="type_id" lay-verify>
                                    <option value=""></option>
                                    <option value="1" @if($typeLevel == 1) selected @endif>选择题</option>
                                    <option value="2" @if($typeLevel == 2) selected @endif>填空题</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="testdb_id" value="{{ $type['id'] }}">

                    <div class="layui-input-block" style="display: inline-block; margin-left: 2px; min-height: inherit; vertical-align: bottom;">
                        <input type="text" name="keyword" id="keyword" required lay-verify class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" style="height: 30px; line-height: 30px;" value="{{ $keyword }}">
                    </div>
                    <a href="javascript:;" data-id="{{ $type['id'] }}" style="display: inline-block; margin-top: 5px; margin-left: 2px; min-height: inherit; vertical-align: bottom;" class="layui-btn layui-btn-small" lay-submit lay-filter="search" id="search">
                        <i class="layui-icon" >&#xe615;</i> 搜索
                    </a>
                    <a href="javascript:;" data-id="{{ $type['id'] }}" style="display: inline-block; margin-top: 5px; margin-left: 2px; min-height: inherit; vertical-align: bottom;" class="layui-btn layui-btn-small" id="searchAll">
                        <i class="layui-icon">&#xe615;</i> 查看全部
                    </a>
                </blockquote>
            </form>
            <fieldset class="layui-elem-field">
                <!--<legend>学院列表</legend>-->
                <div class="layui-field-box">
                    <table class="site-table table-hover">
                        <colgroup>
                            <col width="5%">
                            <col width="10%">
                            <col width="26%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="15%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>所属题库</th>
                            <th>题干</th>
                            <th>题目类型</th>
                            <th>题目难度</th>
                            <th>创建时间</th>
                            <th>备注</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($que as $v)
                            <tr>
                                <td>{{ $v['id'] }}</td>
                                <td>{{ $type['name'] }}</td>
                                <td>{{ $v['question'] }}</td>
                                @if($v['question_type'] == 1)
                                    <td>选择题</td>
                                    @elseif($v['question_type'] == 2)
                                    <td>填空题</td>
                                    @endif
                                @if($v['difficult'] == 1)
                                    <td>简单</td>
                                @elseif($v['difficult'] == 2)
                                    <td>一般</td>
                                    @elseif($v['difficult'] == 3)
                                    <td>困难</td>
                                @endif
                                <td>{{ $v['create_time'] }}</td>
                                <td>{{ $v['comment'] }}</td>
                                <td>
                                    <a href="javascript:;" data-id="{{ $v['id'] }}" class="layui-btn layui-btn-mini editQue">编辑</a>
                                    <a href="javascript:;" data-id="{{ $v['id'] }}" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini delQue">删除</a>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>

                </div>
            </fieldset>

            <div class="" style="margin-left: 38%;position: static;bottom: 0;">
                <div id="page" ></div>
            </div>

        </div>
    </fieldset>
</div>
@endsection
@section('js')
    <script src="{{ URL::asset('static/jsbars/echarts.min.js') }}"></script>
    <script>
        var addQuestionUrl = "{{ url('admin/DataBase/addQuestion') }}";
        var listUrl = "{{ url('admin/DataBase/baseDetail') }}";
        var editQuestionUrl = "{{ url('admin/DataBase/editQuestion') }}";
        var deleteQuesUrl = "{{ url('admin/DataBase/deleteQues') }}";
        var type = "{{ $typeLevel }}";
        var level = "{{ $level }}";
        var keyword = "{{ $keyword }}";
        var pages = "{{ $pages }}";
        var curr = "{{ $requestPage }}";
    </script>
    <script src="{{ URL::asset('static/js/databases2.js') }}"></script>
    <script>
        var myChart = echarts.init(document.getElementById('chart1'));
        var myChart1 = echarts.init(document.getElementById('chart2'));

        // 指定图表的配置项和数据
        var option1 = {

            tooltip: {},
            legend: {
                data:['难度']
            },
            xAxis: {
                data: ["简单","普通","困难"]
            },
            yAxis: {},
            series: [{
                name: '难度',
                type: 'bar',
                data: [{{ $difficult }}]
            }],
            color:['#1AA094', '#c4ccd3']
        };
        // 指定图表的配置项和数据
        var option2 = {

            tooltip: {},
            legend: {
                data:['类型']
            },

            xAxis: {
                data: ["选择","填空"]
            },
            yAxis: {},
            series: [{
                name: '类型',
                type: 'bar',
                data: [{{ $qtype }}]
            }],
            color:['#1AA094', '#c4ccd3']
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option1);
        myChart1.setOption(option2);
    </script>
@endsection