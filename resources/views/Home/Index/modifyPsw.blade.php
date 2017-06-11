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

    .test {
        float: left;
        width: 100%;
        margin-left: 5%;
        margin-top: 10%;
    }
    .modify-form {
        margin-top:10%;
        margin-left: 34%;
        width: 30%;
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
                                <a class="item" href="{!! route('Home.Index.index') !!}"><span class="navbar-item"><i class="icon home"></i>&nbsp;首页</span></a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="header"><span class="navbar-header">个人管理</span></div>
                            <div class="menu" >
                                <a class="item" href="{!! route('Home.Index.personInfo') !!}"><span class="navbar-item"><i class="icon user"></i>&nbsp;个人资料</span></a>
                                <a class="item active"><span class="navbar-item"><i class="icon lock"></i>&nbsp;修改密码</span></a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="header"><span class="navbar-header">成绩管理</span></div>
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
                   <div class="modify-form">
                       <form class="ui form" id="pswForm">
                           <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                           <div class="field">
                               <label>原密码：</label>
                               <input type="password" name="oldPassword" placeholder="请输入原密码" id="old">
                           </div>
                           <div class="field">
                               <label>新密码：</label>
                               <input type="password" name="newPassword" placeholder="请输入新密码" id="new">
                           </div>
                           <div class="field">
                               <label>再次输入密码：</label>
                               <input type="password" name="renewPassword" placeholder="请再次输入原密码" id="renew">
                           </div>
                           <button class="ui blue button" id="savePsw">保存</button>
                       </form>
                   </div>



                </div>

            </div>


        </div>
    </div>


        @endsection
        @section('script')
            @parent
            <script type="text/javascript" src="{{ URL::asset('static/layui/layui.js')}}"></script>
            <script>
                //var Handleurl = "{{ url('home/Index/PswHandle') }}";
                var HandleUrl = "PswHandle";
            </script>
            <script>
                layui.use(['layer'], function() {
                    var $ = layui.jquery,
                            layer = layui.layer;
                    $("#savePsw").click(function() {
                        if(pswForm.oldPassword.value == "" || pswForm.newPassword.value == "" || pswForm.renewPassword.value == "") {
                            layer.msg('请将密码信息填写完整！',{time:2000});
                        }else if(pswForm.newPassword.value !=  pswForm.renewPassword.value) {
                            layer.msg('新密码与重复密码不一致！',{time:2000});
                        }else {
                            $.ajax({
                                url: HandleUrl,
                                type:'POST',
                                data: $("#pswForm").serialize(),
                                success: function(data) {
                                    if(data.status){
                                        layer.msg(data.msg,{time:1000,});
                                        window.location.href = "logout";
                                    }else {
                                        layer.alert(data.msg, {
                                            icon: 2,
                                            title:'提示',
                                        },function() {
                                            location.reload();
                                        });
                                    }
                                }
                            });
                        }
                        return false;
                    });
                });
            </script>
@endsection