


@extends("Admin.layouts.layout")
@section('css')
<style type="text/css">
    blockquote, body, button, dd, div, dl, dt, form, h1, h2, h3, h4, h5, h6, input, li, ol, p, pre, td, textarea, th, ul {
        margin: 0;
        padding:2px 0px;
    }
    .beg-login-icon {
        position: absolute;
        color: #cccccc;
        top: 14px;
        left: 8px;
    }
    .layui-input {
        padding-left: 27px;
    }
</style>
@endsection

@section('title','修改密码')

@section('content')
    <div class="admin-main">
        <form class="layui-form">

            <input type="hidden" name="id" value="{{$id}}">

            <div class="layui-form-item">
                <label class="layui-form-label">原密码</label>
                <div class="layui-input-block">
                    <label class="beg-login-icon" >
                        <i class="fa fa-key" aria-hidden="true"></i>
                    </label>
                    <input type="password" name="old_pass" value="" required lay-verify="required" placeholder="请输入原密码" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">新密码</label>
                <div class="layui-input-block">
                    <label class="beg-login-icon" >
                        <i class="fa fa-rocket" aria-hidden="true"></i>
                    </label>
                    <input type="password" id="password" name="new_password" required lay-verify="password" placeholder="请输入新密码" autocomplete="off" class="layui-input" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">确认密码</label>
                <div class="layui-input-block">
                    <label class="beg-login-icon" >
                        <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
                    </label>
                    <input type="password" id="repassword" name="confirm_password" required lay-verify="repassword" placeholder="请确认密码" autocomplete="off" class="layui-input" >
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="chanpass">保存</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>

        </form>
    </div>
    @endsection



@section('js')
    <script>
        var editurl="{{url('admin/Sysuser/chanpass')}}";
        var static="{{asset('static')}}";
    </script>
    <script type="text/javascript">


        layui.config({
            base: static+'/js/'
        }).use(['layer', 'form','validator'], function() {
            var layer = layui.layer,
                $ = layui.jquery,
                form = layui.form();

            // 表单验证
            form.verify({

                password: [
                    /^[\S]{6,12}$/,
                    '密码必须6到12位，且不能出现空格'
                ],
                repassword:function(value){
                    var pass = $('#password').val();
                    if(value !== pass){
                        return '两次密码不一致';
                    }
                }
            });


            form.on('submit(chanpass)',function(data){
                layer.confirm('确认修改？', {
                    btn: ['确认','取消'] //按钮
                }, function(){
                    $.ajax({
                        url:editurl,
                        type:"POST",
                        data:$('form').serialize(),
                        beforeSend: function(){
                            //
                        },
                        success:function(data2)
                        {
                            if(data2.status){

                                layer.msg(data2.msg, {time: 3000,icon: 1},function(){
                                    var index = parent.layer.getFrameIndex(window.name);
                                    parent.layer.close(index);
                                });
                            }else {
                                layer.msg(data2.msg, {time: 3000,icon: 2});
                            }
                        },
                        error: function(){
                            layer.msg('请求服务器超时', {time: 3000,icon: 2});
                        }
                    });
                    return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
                }, function(){

                });

                return false;
            });



        });

    </script>
    @endsection