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
        .admin-table-page {position: fixed;z-index: 19940201;bottom: 0;width: 100%;background-color: #eee;border-bottom: 1px solid #ddd;left: 0px;text-align: center}
        .admin-table-page .page{padding-left:20px;}
        .admin-table-page .page .layui-laypage {margin: 6px 0 0 0;}
    </style>
    @endsection

@section('title','成绩统计')

@section('content')
    <div class="admin-main">
        <blockquote class="layui-elem-quote">
            <form class="layui-form">

                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">筛选学科</label>
                        <div class="layui-input-inline">
                            <select name="subject" lay-verify="required"  lay-filter="subject">
                                    <option value="1" @if($subject == 1) selected @endif>java</option>
                                    <option value="2" @if($subject == 2) selected @endif >c语言</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">筛选试卷</label>
                        <div class="layui-input-inline">
                            <select class="select_paper" name="testpaper" required lay-filter="paper">
                                @foreach($allpaper as $item)
                                    <option value="{{$item['id']}}" @if($testpaper == $item['id']) selected @endif>{{$item['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>



                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">学号或名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="keywords"  placeholder="请输入学号或名称" autocomplete="off" class="layui-input" value="{{--$keywords--}}" >
                        </div>
                    </div>
                </div>

                <button  class="layui-btn layui-btn-small" lay-filter="search" id="search" style="margin-left:55px;">
                    <i class="layui-icon">&#xe615;</i> 搜索
                </button >
                <button type="reset" class="layui-btn layui-btn-small layui-btn-warm"> <i class="fa fa-eercast" aria-hidden="true"></i> 重置 </button>


            </form>
        </blockquote>

        <fieldset class="layui-elem-field">
            <legend>成绩信息</legend>
            <div class="layui-field-box">
                <table class="site-table table-hover">
                    @if($keywords != "")
                        <span style="padding-left: 5px; font-size: 20px;">查询结果为：</span>
                    @endif
                    <thead>
                    @if($students != "")
                    <tr>
                        <th>学科</th>
                        <th>试卷名称</th>
                        <th>姓名</th>
                        <th>得分</th>
                        <th>操作</th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $stu)
                        <tr>
                            @if($stu['type'] == 1)
                            <td>java</td>
                                @else
                                <td>c</td>
                            @endif
                            <td>{{$stu['testpaper_name']}}</td>
                            <td>{{$stu['name']}}</td>
                            <td>{{$stu['score']}}</td>

                            <td>
                                {{--<a href="javascript:;" data-id="{$vo.id}" class="layui-btn layui-btn-mini edit">编辑</a>--}}
                                <a href="javascript:;" data-id="{{$stu['id']}}" data-value="{{$stu['testpaper_id']}}" class="layui-btn layui-btn-mini layui-btn-normal  details">详情</a>
                            {{--<a href="javascript:;" data-id="{$vo.id}" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>--}}
                            </td>
                        </tr>

                    @endforeach
                    @else
                        <h2>不存在该查询数据！</h2>
                        @endif
                    </tbody>
                </table>

            </div>
        </fieldset>
        <div class="admin-table-page">
            <div id="page" class="page">
            </div>
        </div>


    </div>
    @endsection


@section('js')
    <script>
        var curr = "{{$requestPage}}";
        var pages = "{{$pages}}";
    </script>
    <script src="{{asset("static/js/Score.js")}}">
    </script>
    <script>
        var paperurl = "{{url('admin/Score/getpaper')}}";
        var listurl = "{{url('admin/Score/index')}}";
        var details = "{{url('admin/Score/details')}}";
    </script>
    @endsection