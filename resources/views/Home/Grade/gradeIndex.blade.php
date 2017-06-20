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
    .active_h {
        color:#00B5AD;
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
    <?php $name = session('stu_name_s'); ?>
    <div class="index-body">
        <div class="ui grid">
            <div class="three wide column">
                <div class="test">
                    <div class="ui teal vertical  menu left" style="width: 100%">
                        <div class="ui item" style="height: 120px;">
                            <img class="ui avatar image" style="height:82px;width: 82px; border-radius: 50%;" src="{{ URL::asset('static/img/default1.jpg') }}"> {{ $name }}

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
                            <p><a href="" class="active_h">成绩查看</a></p>
                        </div>
                        <div class="ui teal segment" style="min-height: 65vh;">
                            {{--<div class="echarts1" id="echarts-test" style="height:300px;"></div>--}}
                            <div class="grade-table">
                                <h4 class="ui horizontal divider header">
                                    <i class="bar chart icon"></i>
                                    历次考试
                                </h4>
                                <table class="ui  celled table site-table table-hover">
                                    <thead>
                                    <tr style="text-align: center;"><th>编号</th>
                                        <th>试卷名称</th>
                                        <th>最终分数</th>
                                        <th>开始时间</th>
                                        <th>结束时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody style="text-align: center;">
                                    @foreach($listData as $v)
                                        <tr>
                                            <td>{{ $v->scoreId }}</td>
                                            <td>{{ $v->paperName }}</td>
                                            <td>{{ $v->score }}</td>
                                            <td>{{ $v->sTime }}</td>
                                            <td>{{ $v->eTime }}</td>
                                            <td><a href="javascript:;" data-id="{{ $v->paperId }}" class="layui-btn layui-btn-normal layui-btn-small detail">查看详情</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="" style="margin-left: 38%;position: static;bottom: 0;">
                                    <div id="page" ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="ui stacked segments test-type1" style="margin-left: 2%;margin-top: 3%; margin-bottom: 2%;">--}}
                        {{--<div class="ui segment">--}}
                            {{--<p>每次成绩</p>--}}
                        {{--</div>--}}
                        {{--<div class="ui pink segment">--}}
                            {{--<div class="echarts1" id="echarts-test2" style="height:300px;"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
</div>


        @endsection
        @section('script')
            <script src="{{URL::asset('static/layui/layui.js')}}"></script>
            <script src="{{ URL::asset('static/jsbars/echarts.min.js') }}"></script>
            <script src="{{ URL::asset('static/js/home_gradeIndex.js') }}"></script>
            @parent
            <script type="text/javascript">
                var detailUrl = "{{ url('home/Grade/gradeDetail') }}";
                var pages = "{{ $pages }}";
                var listUrl = "gradeIndex";
                var curr = "{{ $requestPage }}";
            </script>
            <script type="text/javascript">
                layui.config({

                }).use(['layer', 'laypage'], function() {
                    var layer = layui.layer,
                            $ = layui.jquery,
                            laypage = layui.laypage;


                    //跳转详情
                    $('.detail').on('click', function(){
                        var paperId = $(this).data('id');
                        window.location.href = detailUrl+'/'+paperId;
                    });
                    //分页
                    laypage({
                        cont: 'page',
                        pages: pages //总页数
                        ,
                        groups: 5 //连续显示分页数
                        ,
                        skip: true, //是否开启跳页
                        curr: curr,//获得当前页码
                        jump: function(obj, first) {
                            //得到了当前页，用于向服务端请求对应数据
                            var curr = obj.curr;
                            if(!first) {
                                window.location.href=listUrl+"?requestPage="+curr;
                            }
                        }
                    });
                });
            </script>
@endsection