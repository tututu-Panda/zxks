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
@section('title','题库管理')

@section('content')

        <blockquote class="layui-elem-quote">
            <a href="#" class="layui-btn layui-btn-small add">
                <i class="layui-icon">&#xe608;</i> 添加题库
            </a>
            <div class="layui-form layui-inline">
                <div class="layui-form-pane" style="margin-left: 20px;">
                    <label class="layui-form-label" style="width: auto; padding: 4px 18px;;">所属学科</label>
                    <div class="layui-input-inline">
                        <select name="type" id="type">
                            <option></option>
                            @foreach($testType as $type)
                                <option value="{{ $type->id }}" @if($test_id == $type->id) selected @endif>{{ $type->name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="layui-input-block" style="display: inline-block; margin-left: 30px; min-height: inherit; vertical-align: bottom;">
                <input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" value="{{ $keyword }}" style="height:30px; line-height:30px;">
            </div>
            <a href="javascript:;" class="layui-btn layui-btn-small" id="search">
                <i class="layui-icon">&#xe615;</i> 搜索
            </a>
            <a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll">
                <i class="layui-icon">&#xe615;</i> 查看全部
            </a>
        </blockquote>
        <fieldset class="layui-elem-field">
            <legend>题库列表</legend>
            <div class="layui-field-box">
                <table class="site-table table-hover">
                    <thead>
                    <tr>
                        <th>题库编号</th>
                        <th>题库名称</th>
                        <th>所属学科</th>
                        <th>创建时间</th>
                        <th>备注</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($baseList as $k=> $v)
                        <tr>
                            <td>{{ $v->dabase_id }}</td>
                            <td>{{ $v->dabase_name }}</td>
                            <td>{{ $v->type_name }}</td>
                            <td>{{ $v->dabase_time }}</td>
                            <td>{{ $v->dabase_comment }}</td>
                            <td>
                                <a href="javascript:;" data-id="{{ $v->dabase_id }}" class="layui-btn layui-btn-normal layui-btn-mini detail">详情</a>
                                <a href="javascript:;" data-id="{{ $v->dabase_id }}" class="layui-btn layui-btn-mini edit">编辑</a>
                                <a href="javascript:;" data-id="{{ $v->dabase_id }}" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </fieldset>
    <div class="addForm" style="display: none;margin-top: 20px;">
        <form class="layui-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="layui-form-item">
                <label class="layui-form-label">题库名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入题库名称" class="layui-input" style="width:80%;" value="">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">所属学科</label>
                <div class="layui-input-block">
                    <select name="test_id" lay-verify="">
                        <option value=""></option>
                        @foreach($testType as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">备注</label>
                <div class="layui-input-block" >
                    <input type="text" name="comment" lay-verify="comment" autocomplete="off" placeholder="请输入备注（可为空）" class="layui-input" style="width:80%;">
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
        var editForm="{{url('admin/DataBase/editType')}}";
        var addHandleUrl = "{{url('admin/DataBase/addTypeHandle')}}";
        var deleteurl ="{{url('admin/DataBase/deleteType')}}";
        var detailurl = "{{url('admin/DataBase/baseDetail')}}";
        var afterurl = "{{url('admin/DataBase/index')}}";
    </script>
    <script src="{{ URL::asset('static/js/databases.js') }}"></script>
    @endsection
