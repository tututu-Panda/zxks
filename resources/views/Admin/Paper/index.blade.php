@extends('Admin.layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('static/css/Paper.css')}}">
@endsection


@section('title','试卷列表')

@section('content')
    <div class="admin-main">
        <blockquote class="layui-elem-quote">
            <form class="layui-form" action="" method="post">

                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">筛选学科</label>
                        <div class="layui-input-inline">
                            <select name="select_subject" lay-verify="required" lay-filter="subject">
                                <option value="">直接选择或搜索</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">筛选年级</label>
                        <div class="layui-input-inline">
                            <select name="select_grade" lay-search="" lay-verify="" lay-filter="grade">
                                <option value="" selected="">直接选择或搜索</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">筛选班级</label>
                        <div class="layui-input-inline">
                            <select name="select_class" class="select_class" lay-verify="" lay-search="" lay-filter="class">
                                <option value="" >直接选择或搜索</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">试卷名称</label>
                        <div class="layui-input-inline">
                            <select name="select_class" class="select_class" lay-verify="" lay-search="" lay-filter="class">
                                <option value="" >直接选择或搜索</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button  class="layui-btn layui-btn-small" lay-submit="" lay-filter="submit2" id="search" >
                    <i class="layui-icon">&#xe615;</i> 搜索
                </button >


            </form>
        </blockquote>
    </div>

    <fieldset class="layui-elem-field">
        <legend>试卷列表</legend>
        <div class="layui-field-box">
            <table class="site-table table-hover">
                <thead>
                <tr>
                    <th>学科</th>
                    <th>试卷名称</th>
                    <th>知识点</th>
                    <th>操作</th>

                </tr>
                </thead>
                <tbody>
                <volist name="data" id="item" key="k" >
                    <tr>
                        <td>java</td>
                        <td>java期末考试</td>
                        <td>test</td>

                        <td>
                            <a href="javascript:;" data-id="{$vo.id}" class="layui-btn layui-btn-mini edit">编辑</a>
                            <a href="javascript:;" data-id="{$vo.id}" class="layui-btn layui-btn-mini layui-btn-normal edit">启用</a>
                            <a href="javascript:;" data-id="{$vo.id}" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">停用</a>
                        </td>
                    </tr>
                </volist>
                </tbody>
            </table>

        </div>
    </fieldset>

    @endsection

@section('js')
    <script src="{{asset("static/js/Paper.js")}}"></script>
    @endsection