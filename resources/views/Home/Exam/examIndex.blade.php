@extends('Home.layouts.layout')
@section('title')
    <title>Online exam在线考试系统</title>
@endsection
<style>
    .index-body {
        min-height: 85vh;
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
            {{--左侧菜单栏--}}
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
                                <a class="item" href="{{ URL('home/gradeIndex') }}"><span class="navbar-item"><i class="icon wait"></i>&nbsp;成绩查看</span></a>

                            </div>
                        </div>
                        <div class="item">
                            <div class="header"><span class="navbar-header">考试管理</span></div>
                            <div class="menu">
                                <a class="item active" href="{!! route('Home.Exam.examIndex') !!}"><span class="navbar-item"><i class="icon mail forward"></i>选择科目考试</span></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--左侧菜单结束--}}
            {{--右边内容容器--}}
            <div class="thirteen wide column">
                <div class="somepanel">
                    <div class="ui stacked segments test-type1" style="margin-left: 2%;margin-top: 3%;margin-bottom: 2%">
                        <div class="ui segment">
                            <p>JAVA</p>
                        </div>
                        <div class="ui teal segment">
                            <div class="ui cards test-type2">
                                <div class="card single-test" style="margin: .875em 1.5em;">
                                    <div class="content">
                                        <div class="header">第一次Java测试</div>
                                        <div class="description">
                                            这里是一些介绍
                                        </div>
                                        <div class="meta">
                                            出卷人：张三
                                        </div>
                                        <div class="meta">
                                            考试时间：2017-05-18 09:00
                                        </div>
                                    </div>
                                    <div class="ui bottom attached button start-test">
                                        <i class="write icon"></i>
                                        开始考试
                                    </div>
                                </div>
                                <div class="card single-test" style="margin: .875em 1.5em;">
                                    <div class="content">
                                        <div class="header">第一次Java测试</div>
                                        <div class="description">
                                            这里是一些介绍
                                        </div>
                                        <div class="meta">
                                            出卷人：张三
                                        </div>
                                        <div class="meta">
                                            考试时间：2017-05-18 09:00
                                        </div>
                                    </div>
                                    <div class="ui bottom attached button start-test">
                                        <i class="write icon"></i>
                                        开始考试
                                    </div>
                                </div>
                                <div class="card single-test" style="margin: .875em 1.5em;">
                                    <div class="content">
                                        <div class="header">第一次Java测试</div>
                                        <div class="description">
                                            这里是一些介绍
                                        </div>
                                        <div class="meta">
                                            出卷人：张三
                                        </div>
                                        <div class="meta">
                                            考试时间：2017-05-18 09:00
                                        </div>
                                    </div>
                                    <div class="ui bottom attached button start-test">
                                        <i class="write icon"></i>
                                        开始考试
                                    </div>
                                </div>
                                <div class="card single-test" style="margin: .875em 1.5em;">
                                    <div class="content">
                                        <div class="header">第一次Java测试</div>
                                        <div class="description">
                                            这里是一些介绍
                                        </div>
                                        <div class="meta">
                                            出卷人：张三
                                        </div>
                                        <div class="meta">
                                            考试时间：2017-05-18 09:00
                                        </div>
                                    </div>
                                    <div class="ui bottom attached button start-test">
                                        <i class="write icon"></i>
                                        开始考试
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ui stacked segments test-type1" style="margin-left: 2%;margin-top: 3%;margin-bottom: 2%;">
                        <div class="ui segment">
                            <p>C</p>
                        </div>
                        <div class="ui pink segment">
                            <div class="ui cards test-type2">
                                <div class="card single-test" style="margin: .875em 1.5em;">
                                    <div class="content">
                                        <div class="header">第一次Java测试</div>
                                        <div class="description">
                                            这里是一些介绍
                                        </div>
                                        <div class="meta">
                                            出卷人：张三
                                        </div>
                                        <div class="meta">
                                            考试时间：2017-05-18 09:00
                                        </div>
                                    </div>
                                    <div class="ui bottom attached button start-test">
                                        <i class="write icon"></i>
                                        开始考试
                                    </div>
                                </div>
                                <div class="card single-test" style="margin: .875em 1.5em;">
                                    <div class="content">
                                        <div class="header">第一次Java测试</div>
                                        <div class="description">
                                            这里是一些介绍
                                        </div>
                                        <div class="meta">
                                            出卷人：张三
                                        </div>
                                        <div class="meta">
                                            考试时间：2017-05-18 09:00
                                        </div>
                                    </div>
                                    <div class="ui bottom attached button start-test">
                                        <i class="write icon"></i>
                                        开始考试
                                    </div>
                                </div>
                                <div class="card single-test" style="margin: .875em 1.5em;">
                                    <div class="content">
                                        <div class="header">第一次Java测试</div>
                                        <div class="description">
                                            这里是一些介绍
                                        </div>
                                        <div class="meta">
                                            出卷人：张三
                                        </div>
                                        <div class="meta">
                                            考试时间：2017-05-18 09:00
                                        </div>
                                    </div>
                                    <div class="ui bottom attached button start-test">
                                        <i class="write icon"></i>
                                        开始考试
                                    </div>
                                </div>
                                <div class="card single-test" style="margin: .875em 1.5em;">
                                    <div class="content">
                                        <div class="header">第一次Java测试</div>
                                        <div class="description">
                                            这里是一些介绍
                                        </div>
                                        <div class="meta">
                                            出卷人：张三
                                        </div>
                                        <div class="meta">
                                            考试时间：2017-05-18 09:00
                                        </div>
                                    </div>
                                    <div class="ui bottom attached button start-test">
                                        <i class="write icon"></i>
                                        开始考试
                                    </div>
                                </div>
                        </div>
                    </div>



                </div>

            </div>
            {{--右侧容器结束--}}
        </div>



        @endsection
        @section('script')
            @parent
            <script src="{{URL::asset('static/layui/layui.js')}}"></script>
            <script type="text/javascript">
                examTesturl = "{{ url('home/examTest') }}";
                $(document).ready(function() {

                });
            </script>
            <script src="{{ URL::asset('static/js/home_exam.js') }}"></script>
@endsection