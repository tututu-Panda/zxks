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
    .info-panel {
        height: 53%;
        margin-left: 10%;
        margin-top:17%;
    }
    .info-tab .head-img {
        float: left;
        display: block;
        clear: both;
    }
    .info-tab .other-info {
        float: left;
        display: block;
        padding-left: 100px;
    }
    .test {
        float: left;
        width: 100%;
        margin-left: 5%;
        margin-top: 10%;
    }
    .info-tab {
        width: 97%;
    }
    .other-info {
        width:80%;
    }
    .detail-info {
        float: left;
        margin-top: 10px;
        padding-left:20px;
    }
    .info-font {
        color: #9F9F9F;
    }
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
                                <a class="item active" href="{!! route('Home.Index.personInfo') !!}"><span class="navbar-item"><i class="icon user"></i>&nbsp;个人资料</span></a>
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
                                <a class="item" href="{!! route('Home.Exam.examIndex') !!}"><span class="navbar-item"><i class="icon mail forward"></i>选择科目考试</span></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="thirteen wide column">
                <div class="somepanel">
                    <div class="ui top attached tabular menu info-tab" style="margin-top: 3%;margin-left: 2%;width: 97%;">
                        <a class="item active" data-tab="one">
                            基本资料
                        </a>
                    </div>
                    <div class="ui bottom attached segment info-tab" style="margin-left: 2%;width: 97%;" data-tab="one">
                        <div class="info-panel">
                            <div class="head-img">
                                <img src="{{ URL::asset('static/img/default1.jpg') }}" style="height:100px;width: 100px; border-radius: 50%;">
                            </div>
                            <div class="other-info">
                                <div class="ui grid">
                                    <div class="five wide column">
                                        <div class="detail-info"><span class="info-font"><i class="icon user"></i>账号：</span>1313465</div>
                                    </div>
                                    <div class="five wide column">
                                        <div class="detail-info"><span class="info-font"><i class="icon spy"></i>姓名：</span>1313465</div>
                                    </div>
                                    <div class="five wide column">
                                        <div class="detail-info"><span class="info-font"><i class="icon tag"></i>部门：</span></div>
                                    </div>
                                    <div class="five wide column">
                                        <div class="detail-info"><span class="info-font"><i class="icon heterosexual"></i>性别：</span></div>
                                    </div>
                                    <div class="five wide column">
                                        <div class="detail-info"><span class="info-font"><i class="icon mail"></i>email：</span></div>
                                    </div>
                                    <div class="five wide column">
                                        <div class="detail-info"><span class="info-font"><i class="icon mobile"></i>手机号码：</span></div>
                                    </div>
                                    <div class="five wide column">
                                        <div class="detail-info"><span class="info-font"><i class="icon add To Calendar"></i>注册时间：</span></div>
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
            @parent
            <script type="text/javascript" src=""></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('.menu.item').tab();
                });
            </script>
        @endsection