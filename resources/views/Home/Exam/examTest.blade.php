<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ URL::asset('static/css/home_examTest.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('static/layui/css/layui.css') }}">
</head>
<body>
    <div class="main-body">
        <div class="title">
            <span class="titleH1" style="text-align: center;">第一次测试页面</span>
        </div>
        <div class="" style="padding-top: 50px;padding-left: 30px;">
            <div class="single question">
                <form class="layui-form">
                    <div class="layui-form-item">
                       <p>1.Java语言现在的归属公司是（）</p>
                        <div class="layui-input-block" style="padding-top: 15px;">
                            <div class="radio-style">
                                <input type="radio" name="sex" value="1" title=" A.甲骨文">
                            </div>
                            <div class="radio-style">
                                <input type="radio" name="sex" value="0" title="B.微软">
                            </div>
                            <div class="radio-style">
                                <input type="radio" name="sex" value="0" title="C.百度">
                            </div>
                            <div class="radio-style">
                                <input type="radio" name="sex" value="0" title="D.阿里巴巴">
                            </div>



                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>
    <script src="{{ URL::asset('static/layui/layui.js') }}"></script>
    <script src="{{ URl::asset('static/js/home_exam.js') }}"></script>
</body>
</html>