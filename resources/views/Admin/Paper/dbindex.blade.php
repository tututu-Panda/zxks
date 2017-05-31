@extends('Admin.layouts.layout')

@section('css')
    <style>
        tr td {
            text-align: center;
        }

        .layui-table th {
            text-align: center;
        }

        .footerdiv{
            padding-top:20px;
            padding-bottom: 8px;
            padding-left: 5px;
        }
        .layui-elem-quote {
            margin-top: 10px;
            margin-bottom: 10px;
        }

    </style>
@endsection

@section('title','添加题目')

@section('content')
    <div class="admin-main">
        <blockquote class="layui-elem-quote">
            <form class="layui-form">
                <div class="layui-form-pane">
                    <label class="layui-form-label " style="width: auto;padding:4px 15px;">输入试卷id或名称</label>
                    <div class="layui-input-block" style="display: inline-block; margin-left: 0px; min-height: inherit; vertical-align: bottom;">
                        <input type="text" name="keyword" id="keyword" required class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" value="" style="height:30px; line-height:30px;">
                    </div>
                    <a href="javascript:;" class="layui-btn layui-btn-small" id="search" style="margin-left: 10px;">
                        <i class="layui-icon">&#xe615;</i> 搜索
                    </a>
                </div>
            </form>
        </blockquote>

        <fieldset class="layui-elem-field">
            <legend>添加{{$type_name}}</legend>

            <table class="layui-table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>题干</th>
                    <th>类型</th>
                </tr>
                </thead>
                <tbody>
                @foreach($question_list as $question)
                <tr>
                    <td><input type="checkbox" name="ids" value="{{$question['id']}}" lay-skin="primary">{{$question['id']}}</td>
                    <td>{{$question['question']}}</td>
                    <td>{{$type_name}}</td>
                </tr>

                {{--<tr>--}}
                    {{--<td>--}}
                        {{--<input type="checkbox" name="ids" value="2" lay-skin="primary">1</td>--}}
                    {{--<td>test</td>--}}
                    {{--<td>{{$type_name}}</td>--}}
                {{--</tr>--}}
                @endforeach
                </tbody>
            </table>
            <div class="footerdiv">
                <button class="layui-btn layui-btn-small layui-btn-normal checkall">全选</button>
                <button class="layui-btn layui-btn-small layui-btn-normal recheck">反选</button>
                <button class="layui-btn layui-btn-small add">添加</button>
                <button class="layui-btn layui-btn-small layui-btn-danger del">删除</button>
            </div>
        </fieldset>


    </div>

@endsection

@section('js')
    <script>
        var type_name = "{{$type_name}}";
    </script>
    <script src="{{asset("static/js/dbIndex.js")}}"></script>
@endsection