@extends('Admin.layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('static/css/Paper.css')}}">
    <style>
        .admin-table-page {position: fixed;z-index: 19940201;bottom: 0;width: 100%;background-color: #eee;border-bottom: 1px solid #ddd;left: 0px;text-align: center}
        .admin-table-page .page{padding-left:20px;}
        .admin-table-page .page .layui-laypage {margin: 6px 0 0 0;}
    </style>
@endsection


@section('title','试卷列表')

@section('content')
    <div class="admin-main">
        <blockquote class="layui-elem-quote">
            <form class="layui-form" >
                <input class="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">筛选学科</label>
                        <div class="layui-input-inline">
                            <select name="subject" lay-filter="subject">
                                <option value="">直接选择或搜索</option>
                                <option value="all"  @if($subject == "all") selected @endif  >全部</option>
                                <option value="1" @if($subject == 1) selected @endif >java</option>
                                <option value="2" @if($subject == 2) selected @endif  >c</option>

                            </select>
                        </div>
                    </div>
                </div>


                <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">试卷状态</label>
                        <div class="layui-input-inline">
                            <select name="is_use" class="select_class" lay-filter="is_use">
                                <option value="">直接选择或搜索</option>
                                <option value="all"  @if($is_use == "all") selected @endif  >全部</option>
                                <option value="1" @if($is_use == 1) selected @endif >启用</option>
                                <option value="0" @if($is_use == "0") selected @endif >停用</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button  class="layui-btn layui-btn-small" lay-submit="" lay-filter="search" id="search" >
                    <i class="layui-icon">&#xe615;</i> 搜索
                </button >
                <button type="reset" class="layui-btn layui-btn-small layui-btn-warm"> <i class="fa fa-eercast" aria-hidden="true"></i> 重置 </button>

            </form>
        </blockquote>


    <fieldset class="layui-elem-field">
        <legend>试卷列表</legend>
        <div class="layui-field-box">

            <table class="site-table table-hover">
                <thead>
                @if(!empty($allpaper))
                    <tr>
                        <th>学科</th>
                        <th>试卷名称</th>
                        <th>满分</th>
                        <th>及格分数</th>
                        <th>考试时间</th>
                        <th>是否启用</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($allpaper as $paper)
                    <tr>
                        <td>
                            @if($paper['type'] == 1)
                                java
                                @elseif($paper['type'] == 2)
                                c
                                @endif
                        </td>
                        <td>{{$paper['name']}}</td>
                        <td>{{$paper['full_score']}}</td>
                        <td>{{$paper['pass_score']}}</td>
                        <td>{{$paper['exam_time']}}</td>
                        <td>
                            @if($paper['is_use'] == 1)
                                正在使用
                            @elseif($paper['is_use'] == 0)
                                停用
                            @endif

                        <td>
                            <a href="javascript:;" data-id="{{$paper['id']}}" class="layui-btn layui-btn-mini edit">编辑</a>
                            <a href="javascript:;" data-id="{{$paper['id']}}" class="layui-btn layui-btn-mini layui-btn-normal use">启用</a>
                            <a href="javascript:;" data-id="{{$paper['id']}}" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini stop">停用</a>
                        </td>
                    </tr>
                    @endforeach

                @else
                    <h1>不存在该数据！</h1>
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
        var is_use = "{{$is_use}}";
        var subject = "{{$subject}}";
    </script>
    <script>
         var paperurl = "{{url('admin/Score/getpaper')}}";
         var listurl = "{{url('admin/Paper/index')}}";
         var actionurl = "{{url('admin/Paper/action')}}";
         var editurl = "{{url('admin/Paper/edit')}}";
    </script>
    <script src="{{asset("static/js/Paper.js")}}"></script>
    @endsection