@extends('Admin.layouts.layout')
@section('css')
<style type="text/css">


    .left{
        padding-top: 50px;
        float: left;
        clear: both;
    }
    .right{
        float: right;
        clear: both;
        padding-top: 50px;
        padding-right: 160px;
    }
    .layui-form-item::after {
        /*clear: none;*/
    }
    .layui-form-item {
        width: 30%;
        clear: none;
        margin-bottom: 15px;
    }
    .layui-input-block, .layui-input-inline {
        position: unset;
    }


</style>
    @endsection
@section('content')
    <form class="layui-form">

        <input type="hidden" name="testdb_id" value="{{ $testdb_id }}"/>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="layui-form-item left">
            <label class="layui-form-label">题目类型</label>
            <div class="layui-input-block">
                <select id="type" name="type" lay-verify='required' lay-filter="type">
                    <option value="" selected=""></option>
                    <option value="1" >选择</option>
                    {{--<option value="2" >判断</option>--}}
                    <option value="2" >填空</option>
                </select>
            </div>
        </div>

        <div class="layui-form-item left">
            <label class="layui-form-label">题目难度</label>
            <div class="layui-input-block">
                <select id="level" name="level" lay-verify='required'>
                    <option value="" selected=""></option>
                    <option value="1" >简单</option>
                    <option value="2" >普通</option>
                    <option value="3" >困难</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item left">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block">
                <input type="text" name="comment" placeholder="请输入备注可不填" autocomplete="off" class="layui-input" >
            </div>
        </div>



        <div class="layui-form-item" style="width: 100%; padding-top: 150px;">
            <label class="layui-form-label">题干</label>
            <div class="layui-input-block">
                <textarea id="content" style="display: none;"></textarea>
                <input type="hidden" value="" name="content" id="getContent" />
            </div>
        </div>
        <!-- 选择题 -->
        <div class="type_1" style="display: none">
            <div class="layui-form-item">
                <label class="layui-form-label">答案A</label>
                <div class="layui-input-block">
                    <input type="text" name="option_a" placeholder="请输入A答案" autocomplete="off" class=" layui-input" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">答案B</label>
                <div class="layui-input-block">
                    <input type="text" name="option_b" placeholder="请输入B答案" autocomplete="off" class=" layui-input" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">答案C</label>
                <div class="layui-input-block">
                    <input type="text" name="option_c" placeholder="请输入C答案" autocomplete="off" class=" layui-input" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">答案D</label>
                <div class="layui-input-block">
                    <input type="text" name="option_d" placeholder="请输入D答案" autocomplete="off" class=" layui-input" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">选择正确答案</label>
                <div class="layui-input-block">
                    <input type="radio" name="select" value="A" title="A">
                    <input type="radio" name="select" value="B" title="B">
                    <input type="radio" name="select" value="C" title="C">
                    <input type="radio" name="select" value="D" title="D">
                </div>
            </div>
        </div>

        {{--<!-- 判断题 -->--}}
        {{--<div class="type_2" style="display: none">--}}

            {{--<div class="layui-form-item">--}}
                {{--<label class="layui-form-label">该答案是否正确</label>--}}
                {{--<div class="layui-input-block">--}}
                    {{--<input type="radio" name="answerjudge" value="true"  title="正确">--}}
                    {{--<input type="radio" name="answerjudge" value="false" title="错误">--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}

        <!-- 填空题 -->
        <div class="type_2" style="display: none">
            <div class="layui-form-item">
                <label class="layui-form-label">答案</label>
                <div class="layui-input-block">
                    <input type="text" name="answer" placeholder="请输入答案" autocomplete="off" class="answer layui-input">
                    <div class="layui-form-mid layui-word-aux">如果有多种不同形式答案，请用符号"/_"分隔，如 1947/_一九四七</div>
                </div>

            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn addOne" data-type="content" lay-submit lay-filter="addOne">添加</button>
                <button type="reset" class="layui-btn layui-btn-primary reset">重置</button>
            </div>
        </div>


    </form>
    @endsection
@section('js')
    <script src="{{ URL::asset('static/js/layui-mz-min.js') }}"></script>
    <script>
        var addOneHandle = "{{ url('admin/DataBase/addQuesHandle') }}";
    </script>
    <script type="text/javascript">

        layui.use([ 'layer','layedit','form','element'], function() {
            var $ = layui.jquery,
                    layer = layui.layer,
                    form = layui.form(),
                    element = layui.element();
            // 多选项
            layui.selMeltiple($);
            // 编辑器
            var layedit = layui.layedit;

            var index = layedit.build('content',{
                height:250,
                tool: ['strong','italic','del','underline','|','left', 'center', 'right', '|', 'image'], //编辑器的工具栏
//                uploadImage: {
//                    url: uploads //接口url
//                    ,type: 'post' //默认post
//                }
            });;
            // 获得文本内容
            var active = {
                content: function(){
                    // alert(layedit.getContent(index)); //获取编辑器内容
                    // 将文本赋给hidden进行表单提交
                    $("#getContent").val(layedit.getContent(index));
                }
            };

            $('.addOne').on('click', function(){
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });



            // 获得文本区域内容

             //题目类型联动
            form.on('select(type)', function(data){
                var type_id = data.value;
                for (var i = 1; i <= 2; i++) {
                    // 初始化
                    $(".type_"+i).css('display', 'none');
                    $('.type_'+i+" :text").val("");
                    $('.type_'+i+" :radio").attr("checked",false);
                    // 当前选择的类型
                    if(type_id == i) {
                        $(".type_"+type_id).css('display', '');
                        $('.type_'+type_id+" :text").attr("lay-verify","required");
                    } else {
                        // 其他类型
                        $(".type_"+i).css('display', 'none');
                        $('.type_'+i+" :text").attr("lay-verify","none");
                        $('.type_'+i+" :text").val("");

                    }
                }
            });
//
            // 表单提交
            form.on('submit(addOne)', function(data){
                var da = data.field;
                console.log(da);

                layer.confirm('确定添加该题目?', {
                    btn: ['确定', '取消']
                }, function(){
                    $.ajax({
                        url:addOneHandle,
                        type:"POST",
                        data:data.field,
                        beforeSend: function(){
                            //
                        },
                        success:function(data2)
                        {
                            if(data2.success){
                                // 关闭当前窗口
                                layer.msg(data2.msg, {time: 3000,icon: 1}, function(){
                                    location.reload();
                                });

//                                layer.close();
                            }else {
                                layer.msg(data2.msg, {time: 3000,icon: 2});
                            }
                        },
                        error: function(){
                            layer.msg('请求服务器超时', {time: 3000,icon: 2});
                        }
                    });
                },function(){});


                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });


            // 重置按钮
            $(".reset").click(function(){
                location.reload();
            });







        });
    </script>
    @endsection