@extends('Admin.layouts.layout')
@section('css')
<style type="text/css">
    .layui-unselect{
        height: 30px;
        line-height: 30px;
        width: 100px;
    }


</style>
@endsection
<div class="editForm" style="margin-top: 20px;">
    <form class="layui-form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="id"  name="id" value="{{ $info->id }}" />
        <div class="layui-form-item">
            <label class="layui-form-label">题库名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入题库名称" class="layui-input" style="width:80%;" value="{{ $info->name }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所属学科</label>
            <div class="layui-input-block">
                <select name="test_id" lay-verify="">
                    <option value=""></option>
                    @foreach($testType as $type)
                        <option value="{{ $type->id }}" @if($info->id == $type->id) selected @endif>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block" >
                <input type="text" calue="{{ $info->comment }}" name="comment" lay-verify="comment" autocomplete="off" placeholder="请输入备注（可为空）" class="layui-input" style="width:80%;">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="editSave">保存</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
@section('js')
    <script>
        var editHandleUrl = "{{url('admin/DataBase/editTypeHandle')}}";
        var afterurl = "{{url('admin/DataBase/index')}}";
    </script>
    <script src="{{ URL::asset('static/js/databases.js') }}"></script>
@endsection