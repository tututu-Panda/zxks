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
    .img_system {
        margin-top: 50px;
        text-align: center;
        margin-bottom: 10px;
    }
    .jianjie {
        font-weight: 200;
        text-indent: 2.0em;
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
                                <a class="item active" href="{!! route('Home.Index.index') !!}"><span class="navbar-item"><i class="icon home"></i>&nbsp;首页</span></a>
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
                                <a class="item" href="{{URL('home/gradeIndex')}}"><span class="navbar-item"><i class="icon wait"></i>&nbsp;成绩查看</span></a>

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
                    <div style="margin-left: 1%;margin-right:1%;margin-top: 20px;">
                        <div class="ui message">
                            <i class="close icon"></i>
                            <div class="header">
                                <div><i class="icon cloud"></i>&nbsp;尊敬的&nbsp;{{ $name }}&nbsp;同学<span id="weather"></span></div>
                            </div>
                        </div>
                    </div>

                    <div class="ui grid">
                        <div class="two column row">
                            <div class="column">
                                <div class="ui stacked segments test-type1" style="margin-left: 2%;margin-top: 3%;">
                                    <div class="ui segment">
                                        <a class="ui pink ribbon label"><i class="icon alarm Outline"></i>&nbsp;通知公告&nbsp;</a>
                                            <a class="ui red label">
                                                New!
                                            </a>
                                    </div>
                                    <div class="ui pink segment">
                                        <div style="margin-top: 50px;margin-bottom: 10px;">
                                            <div class="ui relaxed divided list">
                                                <div class="item">
                                                    <i class="large github middle aligned icon"></i>
                                                    <div class="content">
                                                        <a class="header">你还有一门考试科目马上就要开始了哦！！！</a>
                                                        <div class="description">更新于34分钟前</div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <i class="large github middle aligned icon"></i>
                                                    <div class="content">
                                                        <a class="header">请完善个人信息。</a>
                                                        <div class="description">更新于1天前</div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <i class="large github middle aligned icon"></i>
                                                    <div class="content">
                                                        <a class="header">查看成绩请移步到成绩查询</a>
                                                        <div class="description">更新于5天前</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="ui stacked segments test-type1" style="margin-left: 2%;margin-top: 3%;">
                                    <div class="ui segment">
                                        <a class="ui blue ribbon label"><i class="icon settings"></i>&nbsp;系统信息</a>

                                    </div>
                                    <div class="ui blue segment">
                                        <div class="img_system">
                                            <img src="{{ URL::asset('static/img/favicon.png') }}">
                                        </div>
                                        <div>

                                                <h2 class="ui small header">
                                                    <i class="Creative Commons icon"></i>
                                                    <div class="content">
                                                        简介：
                                                    </div>
                                                </h2>
                                            <p class="jianjie">
                                                随着现代化的迅速发展，越来越多的传统式
                                                操作都已被现代化替代，计算机考试，网上阅卷等等。所以，许多的新新化产品如雨后春笋般涌现。我们一直追求
                                                简单化，便捷化，正如我们的口号：力求以最简单的操作，做更多的事情。Online exam 在线考试系统是一个基于B/S架构的简易的考试系统，
                                                它主要面向于老师与学生，学生端主要是考试与成绩的查看分析，后台管理端管理考试，学生与学生成绩。基本功能已经具备，
                                                后续再做升级。我们的征途是星辰大海！
                                            </p>
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
    @parent
    <script src="{{URL::asset('static/jsbars/jquery.leoweather.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".start").click(function() {
            window.location.href = "subTest";
        });
        $('.message .close')
                .on('click', function() {
                    $(this)
                            .closest('.message')
                            .transition('fade')
                    ;
                })
        ;
        $('#weather').leoweather({format:'，{时段}好！<span id="colock">现在时间是：<strong>{年}年{月}月{日}日 星期{周} {时}:{分}:{秒}</strong>，</span> <b>{城市}天气</b> {天气} {夜间气温}℃ ~ {白天气温}℃'});
    });
</script>
    @endsection