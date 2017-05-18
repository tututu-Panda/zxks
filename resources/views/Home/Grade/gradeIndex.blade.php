@extends('Home.layouts.layout')
@section('title')
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
                            <p>成绩分析</p>
                        </div>
                        <div class="ui teal segment">
                            <div class="echarts1" id="echarts-test" style="height:300px;"></div>
                        </div>
                    </div>
                    <div class="ui stacked segments test-type1" style="margin-left: 2%;margin-top: 3%;">
                        <div class="ui segment">
                            <p>每次成绩</p>
                        </div>
                        <div class="ui pink segment">
                            <div class="echarts1" id="echarts-test2" style="height:300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        @endsection
        @section('script')
            <script src="{{ URL::asset('static/jsbars/echarts.min.js') }}"></script>
            <script src="{{ URL::asset('static/js/home_gradeIndex.js') }}"></script>
            @parent
            <script type="text/javascript">
                $(document).ready(function() {
                    $(".start").click(function() {
                        window.location.href = "subTest";
                    });
                });
            </script>
@endsection