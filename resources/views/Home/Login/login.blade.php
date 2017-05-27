<!DOCTYPE html>
<html>
<head>
	<title>登录页面</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('static/SemanticUI/semantic.min.css')}}">
	<style type="text/css">
		body {
            width: 100%;
            height: 100%;
            background: url("{{ URL::asset('static/img/banner3.png')}}");
            background-size:cover;
        }
        .index.content {

        }
		.ui.inverted.blue.header, .ui.header{
		  font-weight: normal;
		  font-size: 18px;
		}
		.ui.raised.segment {
		  width: 400px;
		  font-family: 'microsoft yahei' ,Arial,sans-serif;
		}
        .ui.segment {
            background:rgba(255,255,255,.8);
        }
        .ui.form {
            text-align: left;
        }
		.ui.teal.button {
		  margin-left: 230px;
		}
		.footer {
		  text-align: left;
		  font-size:12px;
		}
		 
		.text {
		  display: inline;
		}
		.reme {
			position: absolute;
			bottom: -6px;
			font-size: 12px;
		}
        .title {
            clear: both;
            diplay: block;
            margin-top: 250px;
            float: left;
        }
        .library {
            display: block;
            font-size: 2.75em;
            font-weight: bold;
            font-family: Lato,'Helvetica Neue',Arial,Helvetica,sans-serif;
            color: #ffffff;
            line-height: 1;
        }
        .library2 {
            font-size: 1.00em;
            color:#ffffff;
            font-weight: 200;
        }
        .fromlog {
            float: left;
            padding-top: 200px;
            margin-left:150px;
        }
	</style>
</head>
<body>
<div class="index content">
    <div class="ui grid centered container">
        <div class="title">
            <h1 class="ui inverted header">
                <span class="library">Online exam</span>
                <div class="ui hidden divider"></div>
                <span class="library2">我们力求以最简单的操作，做更多的事情</span>
            </h1>
            <div class="ui hidden divider"></div>
            <div class="ui hidden divider"></div>

        </div>
        <div class="fromlog">
            <div class="ui raised segment">
                <h3 class="ui inverted blue block header" style="text-align: center;"> 在线考试系统登录 </h3>
                <div class="ui basic segment">
                    <div class="column">
                        <div class="ui blue stacked segment">
                            <div class="ui form">
                                <form method="post"  id="loginForm">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <div class="field">
                                        <label> 用户 </label>
                                        <div class="ui left labeled icon input">
                                            <input type="text" placeholder="请输入用户名" name="account">
                                            <i class="user icon"></i>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label> 密码 </label>
                                        <div class="ui left labeled icon input">
                                            <input type="password" placeholder="请输入密码" name="password">
                                            <i class="lock icon"></i>
                                        </div>
                                    </div>
                                    <div class="inline field">
                                        <div class="ui checkbox">
                                            <input id="remember" type="checkbox">
                                            <label for="remember"> 记住密码 </label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <p class="reme" data-tooltip="请联系网站管理员" data-position="left center" data-varition="mini">忘记密码？</p>
                                        <div class="ui teal button submit" id="loginBtn"> 登录 </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>

                    <div class="ui divider"></div>
                    <div class="footer">
                        {{--<div class="text"> 没有账号？ </div>--}}
                        {{--<div class="ui vertical animated orange mini button signup">--}}
                            {{--<div class="visible content"> 立刻注册 </div>--}}
                            {{--<div class="hidden content">--}}
                                {{--<i class="users icon"></i>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="{{ URL::asset('static/js/jquery-3.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('static/SemanticUI/semantic.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('static/layui/layui.js')}}"></script>
<script>
    layui.use(['layer'], function() {
        var $ = layui.jquery,
                layer = layui.layer;
        $("#loginBtn").click(function() {
            if(loginForm.account.value == "" || loginForm.password.value == "") {
                layer.msg('请将登录信息填写完整！',{time:2000});
            }else {
                $.ajax({
                    url: "checkLogin",
                    type:'POST',
                    data: $("#loginForm").serialize(),
                    success: function(data) {
                        if(data.success){
                            layer.msg('登录成功！',{time:1000,});
                            window.location.href = "index";
                        }else {
                            layer.alert('账号不存在或账号密码填写错误', {
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
{{--<script type="text/javascript">--}}
	{{--$(document).ready(function() {--}}
	  {{--$("#loginBtn").click(function() {--}}
        {{--if(loginForm.account.value == "" || loginForm.password.value == "") {--}}
            {{--layer.msg('请将登录信息填写完整！',{time:2000});--}}
        {{--}else {--}}
            {{--$.ajax({--}}
                {{--url: 'checkLogin',--}}
                {{--type:'POST',--}}
                {{--data: $("#loginForm").serialize(),--}}
                {{--success: function(data) {--}}
                    {{--if(data.success){--}}
                        {{--layer.msg('登录成功！',{time:1000,});--}}
                        {{--window.location.href = "index";--}}
                    {{--}else {--}}
                        {{--layer.alert('账号不存在或账号密码填写错误', {--}}
                            {{--icon: 2,--}}
                            {{--title:'提示',--}}
                        {{--},function() {--}}
                            {{--location.reload();--}}
                        {{--});--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}
        {{--return false;--}}
        {{--});--}}


    {{--});--}}
{{--</script>--}}
</body>
</html>