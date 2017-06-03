@extends('Home.layouts.layout')
@section('title')
    <title>Online exam在线考试系统</title>
    <link rel="stylesheet" href="{{ URL::asset('static/jsbars/uploadify.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('static/layui/css/layui.css') }}">
@endsection
<style>
    .index-body {
        min-height: 90vh;
    }
    .info-panel {
        height: 53%;
        margin-left: 10%;
        margin-top:17%;
    }
    .info-tab .head-img {
        float: left;
        display: block;

    }
    .info-tab .other-info {
        float: left;
        display: block;
        padding-left: 100px;
    }
    .test {
        float: left;
        width: 100%;
        margin-left: 5%;
        margin-top: 10%;
    }
    .info-tab {
        width: 97%;
    }

    .other-info {
        width:80%;
    }
    .detail-info {
        float: left;
        margin-top: 10px;
        padding-left:20px;
    }
    .info-font {
        color: #9F9F9F;
    }
    .uploadhead {
        cursor: pointer;
    }
    .modify-btn {
        margin-top: 80px;
        margin-left: 20px;
    }
    /*.upload {*/
        /*position: relative;*/
        /*display: inline-block;*/
        /*background: #D0EEFF;*/
        /*border: 1px solid #99D3F5;*/
        /*border-radius: 4px;*/
        /*padding: 4px 12px;*/
        /*overflow: hidden;*/
        /*color: #1E88C7;*/
        /*text-decoration: none;*/
        /*text-indent: 0;*/
        /*line-height: 20px;*/
        /*cursor: pointer;*/
    /*}*/
    /*.upload input {*/
        /*position: absolute;*/
        /*overflow: hidden;*/
        /*right: 0;*/
        /*top: 0;*/
        /*opacity: 0;*/
        /*cursor: pointer;*/
    /*}*/
    /*.upload:hover {*/
        /*background: #AADFFD;*/
        /*border-color: #78C3F3;*/
        /*color: #004974;*/
        /*text-decoration: none;*/

    /*}*/
</style>
@section('content')

    <div class="index-body">
        <div class="ui grid">
            <div class="three wide column">
                <div class="test">
                    <div class="ui teal vertical  menu left" style="width: 100%">
                        <div class="ui item" style="height: 120px;">
                            <img class="ui avatar image" style="height:82px;width: 82px; border-radius: 50%;" src="{{ URL::asset('static/img/default1.jpg') }}"> Student

                        </div>
                        <div class="item">
                            <div class="header"><span class="navbar-header">首页</span></div>
                            <div class="menu" >
                                <a class="item" href="{!! route('Home.Index.index') !!}"><span class="navbar-item"><i class="icon home"></i>&nbsp;首页</span></a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="header"><span class="navbar-header">个人管理</span></div>
                            <div class="menu" >
                                <a class="item active" href="{!! route('Home.Index.personInfo') !!}"><span class="navbar-item"><i class="icon user"></i>&nbsp;个人资料</span></a>
                                <a class="item" href="{{ URL('home/modifyPsw') }}"><span class="navbar-item"><i class="icon lock"></i>&nbsp;修改密码</span></a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="header"><span class="navbar-header">成绩查询</span></div>
                            <div class="menu">
                                <a class="item" href="{{ URL('home/gradeIndex') }}"><span class="navbar-item"><i class="icon wait"></i>&nbsp;成绩查看</span></a>

                            </div>
                        </div>
                        <div class="item">
                            <div class="header"><span class="navbar-header">考试管理</span></div>
                            <div class="menu">
                                <a class="item" href="{!! route('Home.Exam.examIndex') !!}"><span class="navbar-item"><i class="icon mail forward"></i>选择科目考试</span></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="thirteen wide column">
                <div class="somepanel">
                    <div class="ui top attached tabular menu info-tab" style="margin-top: 2%;margin-left: 2%;width: 97%;">
                        <a class="item active" data-tab="one">
                            基本资料
                        </a>
                    </div>
                    <div class="ui bottom attached segment info-tab" style="margin-left: 2%;width: 97%;margin-bottom: 2%" data-tab="one">
                        <div class="info-panel">
                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" value="1" name="id">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <div class="head-img">
                                    <?php $headimg = "static/img/default1.jpg"; ?>
                                    @if(empty($info['photo']))
                                            <?php $headimg = asset('static/img/default1.jpg'); ?>
                                        @else
                                            <?php $headimg = $info['photo']; ?>
                                    @endif
                                    {{--@if(empty($info->photo))--}}
                                        {{--<img src="{{ URL::asset('static/img/default1.jpg') }}" style="height:120px;width: 120px; border-radius: 50%;">--}}
                                        {{--@else--}}
                                        <img src="{{ $headimg }}" id="newImg" style="height:120px;width: 120px; border-radius: 50%;">
                                    {{--@endif--}}
                                    <div class="uploadhead" style="padding-top: 30px;">
                                        <a class="upload">
                                             <input id="fileupload" type="file" name="headupload" multiple>
                                        </a>

                                    </div>


                                </div>
                            </form>

                            <div class="other-info">
                                <div class="ui grid">
                                    <div class="five wide column">
                                        <div class="detail-info"><span class="info-font"><i class="icon user"></i>账号：</span>{{ $info['account'] }}</div>
                                    </div>
                                    <div class="five wide column">
                                        <div class="detail-info"><span class="info-font"><i class="icon spy"></i>姓名：</span>{{ $info['name'] }}</div>
                                    </div>
                                    <div class="five wide column">
                                        <div class="detail-info"><span class="info-font"><i class="icon tag"></i>部门：</span>{{ $info['info'] }}</div>
                                    </div>
                                    <div class="five wide column">
                                        <div class="detail-info"><span class="info-font"><i class="icon heterosexual"></i>性别：</span>@if($info['sex'] == 1) 男 @elseif($info['sex'] == 0) 女 @endif</div>
                                    </div>
                                    <div class="five wide column">
                                        <div class="detail-info"><span class="info-font"><i class="icon mail"></i>email：</span>{{ $info['email'] }}</div>
                                    </div>
                                    <div class="five wide column">
                                        <div class="detail-info"><span class="info-font"><i class="icon mobile"></i>手机号码：</span>{{ $info['phone'] }}</div>
                                    </div>
                                    <div class="five wide column">
                                        <div class="detail-info"><span class="info-font"><i class="icon add To Calendar"></i>注册时间：</span>{{ $info['create_time'] }}</div>
                                    </div>
                                </div>
                                <div class="modify-btn"><button class="ui button" id="modify">编辑资料</button></div>
                            </div>
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </div>
        {{--这里是修改资料的表单，默认为隐藏，点击按钮时激活--}}
        <div class="modify-form" style="display: none;margin-top: 10px;">
            <form class="layui-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="id"  name="id" value="{{ $info['id'] }}" />
                <div class="layui-form-item">
                    <label class="layui-form-label">姓名：</label>
                    <div class="layui-input-block" style="width:280px;">
                        <input type="text" name="name" autocomplete="off" placeholder="请输入姓名" class="layui-input" style="width:80%;" value="{{ $info['name'] }}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">email：</label>
                    <div class="layui-input-block" style="width:280px;">
                        <input type="text" name="email" autocomplete="off" placeholder="请输入邮箱" class="layui-input" style="width:80%;" value="{{ $info['email'] }}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">性别：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="sex" value="1" title="男" @if($info['sex'] == 1) checked @endif>
                        <input type="radio" name="sex" value="0" title="女" @if($info['sex'] == 0) checked @endif>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">手机号码：</label>
                    <div class="layui-input-block" style="width:280px;">
                        <input type="text" name="phone" autocomplete="off" placeholder="请输入手机号码" class="layui-input" style="width:80%;" value="{{ $info['phone'] }}">
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
    @endsection
        @section('script')
            @parent
            <script src="{{ URL::asset('static/jsbars/jquery.uploadify.min.js')}}"></script>
            <script src="{{ URL::asset('static/layui/layui.js') }}"></script>
            <script>
                var editHandleUrl = "{{ url('home/Index/editHandle') }}";
                var afterUrl = "{{ url('home/Index/personInfo') }}";
            </script>
            <script src="{{ URL::asset('static/js/home_personInfo.js') }}"></script>
            {{--<script type="text/javascript" src="{{ URL::asset('static/layui/layui.js')}}"></script>--}}

            <script type="text/javascript">
                $(document).ready(function() {
                    $('.menu.item').tab();

                $('#fileupload').uploadify({
                    'swf':'{{ URL::asset('static/jsbars/uploadify.swf') }}',
                    'uploader' : 'uploadHeadImg',
                    formData:{
                        '_token' : "{{csrf_token()}}"
                    },
                    'cancelImg': '{{ URL::asset('static/jsbars/uploadify-cancel.png') }}',
                    'fileTypeExts': '*.gif;*.jpg;*.png',
                    'buttonText': '更换头像',
                    'height': 35,
                    'dataType':'json',
                    'queueSizeLimit': 1,
                    'onFallback': function () {
                        alert("您未安装FLASH控件，无法上传图片！请安装FLASH控件后再试。");
                    },
                    'onUploadSuccess':function(file, data, response){
                        var dataObj=eval("("+data+")"); //转换为json对象
                        $('#newImg').attr("src",dataObj.imgurl);
                    }

                });

                });
            </script>

        @endsection