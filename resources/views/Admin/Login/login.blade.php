<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>登录-Login</title>
    <link rel="stylesheet" href="{{URL::asset('static/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{URL::asset('static/css/login.css')}}" media="all">
</head>
<body class="beg-login-bg">
<div class="beg-login-box">
    <header>
        <h1>管理员登录</h1>
    </header>
    <div class="beg-login-main">
        <form  class="layui-form" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="layui-form-item">
                <label class="beg-login-icon">
                    <i class="layui-icon">&#xe612;</i>
                </label>
                <input type="text" name="account"  autocomplete="off" placeholder="输入账号" class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="beg-login-icon">
                    <i class="layui-icon">&#xe642;</i>
                </label>
                <input type="password" name="password"  autocomplete="off" placeholder="输入密码" class="layui-input">
            </div>
            <div class="layui-form-item" id='code-box'>
                <label  class="beg-login-icon">
                    <i class="layui-icon">&#xe64e;</i>
                </label>
                <input type="text" name="verify_code"  autocomplete="off" placeholder="输入验证码" class="layui-input login-code-input beg-pull-left" >
                <img  src="{{ URL('/admin/login/captcha/1') }}" class='vary loin-code-box-img beg-pull-right' title="点击刷新" onclick="this.src='{{ url('/admin/login/captcha') }}/'+Math.random();">
            </div>
            <div class="layui-form-item">
                <div class="beg-pull-left beg-login-remember">
                    <label>记住帐号？</label>
                    <input type="checkbox" name="rememberMe" value="true" lay-skin="switch" checked title="记住帐号">
                </div>
                <div class="beg-pull-right">
                    <button class="layui-btn layui-btn-primary" lay-submit lay-filter="login">
                        <i class="layui-icon">&#xe650;</i> 登录 </button>
                </div>
            </div>
        </form>
    </div>
    <footer>
        <p>3tu  @  2017</p>
    </footer>
</div>
<script src="{{URL::asset('static/layui/layui.js')}}"></script>
<script type="text/javascript">
    var loginurl = "{{url('/admin/loginCheck')}}";
    var loginrec = "{{url('/admin')}}";
    var checkurl = "{{url('/admin/checkVerify')}}";
</script>
<script src="{{URL::asset('static/js/login.js')}}"></script>

</body>
</html>