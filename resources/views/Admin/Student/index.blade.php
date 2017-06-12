@extends('Admin.layouts.layout')
@section('css')
    <meta name="_token" content="{{ csrf_token() }}"/>
    <style type="text/css">
        .layui-unselect{
            height: 30px;
            line-height: 30px;
            width: 100px;
        }

        .site-table tbody tr td {text-align: center;}
        .site-table tbody tr td .layui-btn+.layui-btn{margin-left: 0px;}
        .admin-table-page {position: fixed;z-index: 19940201;bottom: 0;width: 100%;background-color: #eee;border-bottom: 1px solid #ddd;left: 0px;}
        .admin-table-page .page{padding-left:20px;}
        .admin-table-page .page .layui-laypage {margin: 6px 0 0 0;}
        .table-hover tbody tr:hover{ background-color: #EEEEEE; }
    </style>
@endsection
@section('title','学生管理')

@section('content')

    <blockquote class="layui-elem-quote">
        <a href="#" class="layui-btn layui-btn-small add">
            <i class="layui-icon">&#xe608;</i> 添加学生
        </a>

        <div class="layui-input-block" style="display: inline-block; margin-left: 30px; min-height: inherit; vertical-align: bottom;">
            <input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" value="" style="height:30px; line-height:30px;">
        </div>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="search">
            <i class="layui-icon">&#xe615;</i> 搜索
        </a>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll">
            <i class="layui-icon">&#xe615;</i> 查看全部
        </a>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>学生列表</legend>
        <div class="layui-field-box">
            <table class="site-table table-hover">
                <thead>
                <tr>
                    <th>账号</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>部门</th>
                    <th>联系方式</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($studentList as $k=> $v)
                    <tr>
                        <td>{{ $v['account'] }}</td>
                        <td>{{ $v['name'] }}</td>
                        <td>@if($v['sex'] == '1')男@elseif($v['sex'] == '0')女@endif</td>
                        <td>{{ $v['info'] }}</td>
                        <td>{{ $v['phone'] }}</td>
                        <td>{{ $v['create_time'] }}</td>
                        <td>
                            <a href="javascript:;" data-id="{{ $v['id'] }}" class="layui-btn layui-btn-normal layui-btn-mini resetPs">重置密码</a>
                            <a href="javascript:;" data-id="{{ $v['id'] }}" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="" style="margin-left: 38%;position: static;bottom: 0;">
                <div id="page" ></div>
            </div>
        </div>
    </fieldset>
    <div class="addForm" style="display: none;margin-top: 20px;">
        <form class="layui-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="layui-form-item">
                <label class="layui-form-label">账号</label>
                <div class="layui-input-block">
                    <input type="text" name="account" lay-verify="name" autocomplete="off" placeholder="请输入账号" class="layui-input" style="width:80%;" value="">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">姓名</label>
                <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入姓名" class="layui-input" style="width:80%;" value="">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">性别</label>
                <div class="layui-input-block">
                    <input type="radio" name="sex" class="layui-input" title="男" value="1" checked>
                    <input type="radio" name="sex" class="layui-input" title="女" value="0">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">部门</label>
                <div class="layui-input-block">
                    <input type="text" name="info" lay-verify="comment" autocomplete="off" placeholder="请填写部门" class="layui-input" style="width:80%;">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="addSave">保存</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>

        </form>
    </div>
@endsection
@section('js')
    <script>
        var addHandleUrl = "{{url('admin/Student/create')}}";
        var resetUrl ="{{url('admin/Student/resetPs')}}";
        var deleteUrl = "{{url('admin/Student/destroy')}}";
        var afterUrl = "{{url('admin/Student/index')}}";
        var pages = "{{ $pages }}";
        var curr = "{{ $requestPage }}";
    </script>
    <script>
        layui.use(['layer','form','laypage'], function() {
            var $ = layui.jquery,
                    layer = layui.layer,
                    laypage = layui.laypage,
                    form = layui.form();
            $('.add').on('click',function() {
                layer.open({
                    type: 1,
                    title: ['添加学生', 'text-align:center;'],
                    content: $('.addForm'),
                    area:['400px', '380px'],  //宽高
                    resize: false,		//是否允许拉伸
                    scrollbar: false,
                });
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
                        window.location.href=afterUrl+"?&requestPage="+curr;
                    }
                }
            });
            form.on('submit(addSave)',function(data) {
                $.ajax({
                    url: addHandleUrl,
                    type: 'POST',
                    data: data.field,
                    success: function(data){
                        if (data.success){
                            layer.msg(data.msg, {
                                time: 1000
                            }, function(){
                                layer.close();
                                window.location.href = afterUrl;
                            });
                        }else{
                            layer.msg(data.msg, {
                                time: 1000
                            });
                        }
                    }
                })//接收错误信息
                .error(function (data) {
                    var errors = $.parseJSON(data.responseText);
                    $.each( errors, function( key, value ) {
                        layer.msg(value[0],{icon:2},{time:3000});
                        return false;
                    });

                });

                return false;
            });
            //重置密码
            $('.resetPs').on('click', function(){

                var id = $(this).data('id');
                layer.confirm('确定重置密码为123456吗？', {
                    icon: 3,
                    btn: ['确定', '取消']
                }, function(){
                    $.ajax({
                        url: resetUrl,
                        type: 'POST',
                        dataType: 'json',
                        headers:{'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')},
                        data: {'id': id},
                        error: function(request){
                            layer.msg("请求服务器超时", {time: 1000, icon: 5});
                        },
                        success: function(data){
                            if (data.success){
                                layer.msg(data.msg, {
                                    time: 1000
                                }, function(){
                                    location.reload();
                                });
                            }else{
                                layer.msg(data.msg, {
                                    time: 1000
                                });
                            }
                        }
                    });

                });
            });
            //删除学生
            $('.del').on('click', function(){

                var id = $(this).data('id');
                layer.confirm('确定删除该学生?', {
                    icon: 3,
                    btn: ['确定', '取消']
                }, function(){
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        dataType: 'json',
                        headers:{'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')},
                        data: {'id': id},
                        error: function(request){
                            layer.msg("请求服务器超时", {time: 1000, icon: 5});
                        },
                        success: function(data){
                            if (data.success){
                                layer.msg(data.msg, {
                                    time: 1000
                                }, function(){
                                    location.reload();
                                });
                            }else{
                                layer.msg(data.msg, {
                                    time: 1000
                                });
                            }
                        }
                    });

                });
            });

        });
    </script>
@endsection
