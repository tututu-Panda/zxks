@extends('Admin.layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{asset("static/css/Sysuser.css")}}">
    @endsection

@section('title','个人信息')

@section('content')
    <fieldset class="layui-elem-field">
        <legend>个人信息</legend>
        <form class="layui-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div>
            <div class="item" style="margin-left: 125px; margin-top:100px;margin-bottom: 100px; ">
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <img id="photo" src="{{asset($user['photo'])}}" alt="">
                    </div>
                    <div class="layui-input-block" align="center" style="margin-top: 15px;">
                        <input type="file" name="photo" class="layui-upload-file "  />
                    </div>
                </div>
            </div>
            <div class="item inner-item">
                <div class="inner-item">

                    <label class="layui-form-label">账号:</label>
                    <div class="layui-input-block disabled">
                        <label class="beg-login-icon" style="padding: 0px">
                            <i class="layui-icon">&#xe612;</i>
                        </label>
                        <input type="text" name="account" disabled   autocomplete="off" class="layui-input" value='{{$user['account']}}'>
                    </div>
                </div>
            </div>

            <div class="item inner-item" >
                <div class="inner-item ">
                    <label class="layui-form-label">密码:</label>
                    <div class="layui-input-block disabled">
                        <label class="beg-login-icon" style="padding: 0px">
                            <i class="layui-icon">&#xe642;</i>
                        </label>
                        <input type="password" maxlength="10" name="password" disabled autocomplete="off" class="layui-input" value="xxxxxxxxxx">
                    </div>
                    <a class="changepass" style="padding: 15px; padding-left: 20px;" href="#">修改密码</a>
                </div>
            </div>

            <div class="item inner-item" >
                <div class="inner-item ">
                    <label class="layui-form-label">姓名:</label>
                    <div class="layui-input-block">
                        <label class="beg-login-icon" style="padding: 0px">
                            <i class="fa fa-tag" aria-hidden="true"></i>
                        </label>
                        <input type="text" name="name" required lay-verify="required" placeholder="请输入姓名" autocomplete="off" class="layui-input"
                        value="{{$user['name']}}">
                    </div>
                </div>
            </div>

            <div class="item inner-item" >
                <div class="inner-item ">
                    <label class="layui-form-label">email:</label>
                    <div class="layui-input-block">
                        <label class="beg-login-icon" style="padding: 0px">
                            <i class="fa fa-cloud" aria-hidden="true"></i>
                        </label>
                        <input type="text" name="email" required lay-verify="email" placeholder="请输入邮箱" autocomplete="off" class="layui-input" value="{{$user['email']}}">
                    </div>
                </div>
            </div>

            <div class="item inner-item" >
                <div class="inner-item ">
                    <label class="layui-form-label">电话:</label>
                    <div class="layui-input-block">
                        <label class="beg-login-icon" style="padding: 0px">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                        </label>
                        <input type="text" name="phone" required lay-verify="phone" placeholder="请输入姓名" autocomplete="off" class="layui-input" value="{{$user['phone']}}">
                    </div>
                </div>
            </div>

            <div class="item inner-item" >
                <div class="inner-item ">
                    <label class="layui-form-label">性别:</label>
                    <div class="layui-input-block" style="padding-left: 45px;">
                        <label class="beg-login-icon" style="padding: 0px">
                            <i class="fa fa-venus-mars" aria-hidden="true"></i>
                        </label>
                        <input type="radio" name="sex" value="男" title="男" @if($user['sex'] == 1) checked  @endif>

                        <input type="radio" name="sex" value="女" title="女" @if($user['sex'] == 0) checked  @endif>
                    </div>
                </div>
            </div>

        </div>
            <div  class="layui-form-item" align="center">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="change">修改</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </fieldset>
    @endsection

@section('js')
    <script>
        var upload="{{url('admin/Sysuser/upload')}}";

    </script>
    <script src="{{asset("static/js/Sysuser.js")}}"></script>
    @endsection
