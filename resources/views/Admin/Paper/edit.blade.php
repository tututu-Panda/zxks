@extends('Admin.layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('static/css/setpaper.css')}}">
    @endsection

@section('title','编辑试卷')

@section('content')
    <div class="admin-main">
        <fieldset class="layui-elem-field">
            <legend>编辑试卷</legend>
            <div class="container">
                <form class="layui-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="is_use" value="1">
                    <input type="hidden" name="id" value="{{$testpaper_info['id']}}">
                    <input type="hidden" name="exam_time" value="120">
                    <div class="left">

                        <div class="layui-form-item">
                            <label class="layui-form-label ">选择科目</label>
                            <div class="layui-input-inline">
                                <select disabled class="testpaper_type" name="type">
                                    <option value="">请选择科目</option>
                                    <option disabled value="1" @if($testpaper_info['type'] == 1) selected @endif>JAVA</option>
                                    <option disabled value="2" @if($testpaper_info['type'] == 2) selected @endif>C</option>
                                </select>
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">试卷总分</label>
                            <div class="layui-input-inline">
                                <label class="beg-login-icon" style="padding: 0px">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </label>
                                <input name="full_score" autocomplete="off" class="layui-input layui-disabled" disabled type="text" value="{{$testpaper_info['full_score']}}" >
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">开始时间</label>
                            <div class="layui-input-inline">
                                <label class="beg-login-icon" style="padding: 0px">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </label>
                                <input class="layui-input" placeholder="开始日期" id="beginDate" name="beginDate" readonly="true" value="{{$testpaper_info['beginDate']}}">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">编辑选择题</label>
                            <div class="layui-input-inline">
                                <button class="layui-btn layui-btn-primary edit1">
                                    <i class="fa fa-calendar" aria-hidden="true" onclick="return false;" style="padding-right: 8px"></i>选择题
                                </button>
                            </div>
                            <input type="hidden" id="choice_ids" name="choice_ids" value="{{$testpaper_info['choice_ids']}}">
                        </div>



                    </div>

                    <div class="right">

                        <div class="layui-form-item">
                            <label class="layui-form-label">试卷名称</label>
                            <div class="layui-input-inline">
                                <label class="beg-login-icon" style="padding: 0px">
                                    <i class="fa fa-info" aria-hidden="true"></i>
                                </label>
                                <input name="name" placeholder="请输入试卷名称" autocomplete="off" class="layui-input" type="text" value="{{$testpaper_info['name']}}">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">及格分数</label>
                            <div class="layui-input-inline">
                                <label class="beg-login-icon" style="padding: 0px">
                                    <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                </label>
                                <input name="pass_score" autocomplete="off" class="layui-input layui-disabled" disabled type="text" value="{{$testpaper_info['pass_score']}}">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">结束时间</label>
                            <div class="layui-input-inline">
                                <label class="beg-login-icon" style="padding: 0px">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </label>
                                <input class="layui-input" placeholder="结束日期" id="endDate" name="endDate" readonly="true" value="{{$testpaper_info['endDate']}}">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">编辑填空题</label>
                            <div class="layui-input-inline">
                                <button class="layui-btn layui-btn-primary edit2" onclick="return false;" >
                                    <i class="fa fa-calendar" aria-hidden="true" style="padding-right: 8px"></i>填空题
                                </button>
                                <input type="hidden" id="fill_ids" name="fill_ids" value="{{$testpaper_info['fill_ids']}}">
                            </div>
                        </div>

                    </div>

                    <div  class="layui-form-item" align="center">
                        <div class="layui-input-block" style="margin-left: 0px">
                            <button class="layui-btn" lay-submit lay-filter="update">确认</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>
    </div>
    @endsection

@section('js')
    <script>
        var editdb = "{{URL("admin/Paper/dbindex")}}";
    </script>

    <script>
        // 选择题
        var adddb = "{{URL("admin/Paper/dbindex")}}";
        var upadtepaper = "{{URL("admin/Paper/upadtepaper")}}";

        // 得到选择题id
        function setChoice(ids){
            var choiceIds = [];
            var result = "true";
            // 第一次正常添加
            if(choiceIds.length == 0){
                choiceIds.push(ids);
            }
            // 第二次添加检查重复
            else{
                var exist = '';
                for (var i = 0; i < ids.length; i++){
//                 如果存在重复则提示
                    if(choiceIds.indexOf(ids[i]) <= -1 ){
                        exist = "T";
                        alert("题目存在重复,请检查!");
                        result = 'false';
                        break;
                    }
                }
                if(exist != ""){

                }else{
                    for (var i = 0; i < ids.length; i++){
                        choiceIds.push(ids[i]);
                    }
                }

            }
            // 将值传给input框
            document.getElementById('choice_ids').value=choiceIds;
            return result;
        }


        // 获得选择题选项
        function getChoice(){
            var choiceIds = document.getElementById('choice_ids').value;
            return choiceIds;
        }

        // 删除选择题选项
        function delChoice(ids){
            var s = document.getElementById('choice_ids').value;
            choiceIds = s.split(",");
            var result = "true";
            var exist = '';
            for (var i = 0; i < ids.length; i++){
//                 如果存在重复则提示
                if(choiceIds.indexOf(ids[i]) <= -1 ){
                    exist = "T";
                    alert("题目不存在列表,请选择后删除!");
                    result = 'false';
                    break;
                }
            }
            if(exist != ""){

            }else{
                for (var i = 0; i < ids.length; i++){
                    var index = choiceIds.indexOf(ids[i]);
                    choiceIds.splice(index,1);
                }
                document.getElementById('choice_ids').value = choiceIds;
            }
            return result;

        }

    </script>

    <script>
        //　填空题
        // 得到选择题id
        function setFill(ids){
            var FillIds = [];
            var result = "true";
            // 第一次正常添加
            if(FillIds.length == 0){
                FillIds.push(ids);
            }
            // 第二次添加检查重复
            else{
                var exist = '';
                for (var i = 0; i < ids.length; i++){
//                 如果存在重复则提示
                    if(FillIds.indexOf(ids[i]) <= -1 ){
                        exist = "T";
                        alert("题目存在重复,请检查!");
                        result = 'false';
                        break;
                    }
                }
                if(exist != ""){

                }else{
                    for (var i = 0; i < ids.length; i++){
                        FillIds.push(ids[i]);
                    }
                }

            }
            // 将值传给input框
            document.getElementById('fill_ids').value=FillIds;
            return result;
        }


        // 获得选择题选项
        function getFill(){
            var FillIds = document.getElementById('fill_ids').value;
            return FillIds;
        }

        // 删除选择题选项
        function delFill(ids){
            var s = document.getElementById('fill_ids').value;
            FillIds = s.split(",");
            var result = "true";
            var exist = '';
            for (var i = 0; i < ids.length; i++){
//                 如果存在重复则提示
                if(FillIds.indexOf(ids[i]) <= -1 ){
                    exist = "T";
                    alert("题目不存在列表,请选择后删除!");
                    result = 'false';
                    break;
                }
            }
            if(exist != ""){

            }else{
                for (var i = 0; i < ids.length; i++){
                    var index = FillIds.indexOf(ids[i]);
                    FillIds.splice(index,1);
                }
                document.getElementById('fill_ids').value = FillIds;
            }
            return result;

        }

    </script>

    <script src="{{asset("static/js/editPaper.js")}}"></script>
    @endsection