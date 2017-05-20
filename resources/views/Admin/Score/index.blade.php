@extends('Admin.layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('static/css/Score.css')}}">
    <style>
        .layui-input{
            height: 30px;
        }
        .my-input .layui-input{
            height: 38px;
        }
        .my-input .layui-form-label{
            width: 150px;
        }
        .courseList{
            margin-top: 10px;
        }
        .layui-form-select{
            width: 80%; /*     调整select的宽度*/
        }
    </style>
    @endsection

@section('title','成绩统计')

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
                        <label class="layui-form-label" style="padding: 4px 1px;">学号或名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="keywords" required lay-verify="keywords" placeholder="请输入学号或名称" autocomplete="off" class="layui-input" >
                        </div>
                    </div>
                </div>

                <button  class="layui-btn layui-btn-small" lay-submit="" lay-filter="submit2" id="search" style="margin-left:55px;">
                    <i class="layui-icon">&#xe615;</i> 搜索
                </button >


            </form>
        </blockquote>

        <fieldset class="layui-elem-field">
            <legend>成绩信息</legend>
            <div class="layui-field-box">
                <table class="site-table table-hover">
                    <thead>
                    <tr>
                        <th>学科</th>
                        <th>年级</th>
                        <th>班级</th>
                        <th>学号</th>
                        <th>得分</th>
                        <th>操作</th>

                    </tr>
                    </thead>
                    <tbody>
                    <volist name="data" id="item" key="k" >
                        <tr>
                            <td>java</td>
                            <td>2015级</td>
                            <td>154</td>
                            <td>2015081153</td>
                            <td>90</td>

                            <td>
                            <a href="javascript:;" data-id="{$vo.id}" class="layui-btn layui-btn-mini edit">编辑</a>
                            <a href="javascript:;" data-id="{$vo.id}" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
                            </td>
                        </tr>
                    </volist>
                    </tbody>
                </table>

            </div>
        </fieldset>
    </div>
    @endsection


@section('js')
    <script src="{{asset("static/js/Score.js")}}"></script>
    @endsection