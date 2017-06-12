<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ URL::asset('static/css/home_examTest.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('static/layui/css/layui.css') }}">
    <style>
        #timer {
            margin: 20px auto;
        }
        .timer-section {
            display: inline-block;
            margin-left: 18px;
        }
        .timer-section span {
            background-color: #ffffff;
            padding: 5px 2px;
            border-radius: 5px;
        }
        .time {
            font-weight: bold;
        }
        .question_type {
            font-size: 17px;
            font-weight: 300;
        }
        .question_name {
            font-size: 14px;
            font-weight: 400;
            color:#000000;
        }
    </style>
</head>
<body>
<div class="left-fixed">
    <blockquote class="layui-elem-quote" style="color:red;font-size: 18px;">*&nbsp;注意事项</blockquote>
        <table align="center" cellspacing="50%" style="line-height: 28px;font-size: 13px;color: #404040;margin-left: 20px;margin-right: 10px;">
            <th>
            <td colspan="2" style="text-align: center;font-size: 15px;"></td>
            </th>
            <tr>

                <td>1.&nbsp;请独立完成本试卷;</td>
            </tr>
            <tr>
                <td>2.&nbsp;请注意时间分配</td>
            </tr>
            <tr>

                <td>3.&nbsp;请将填空题答案格式正确的填在每题末尾横线上</td>
            </tr>
            <tr>
                <td>4.考试时间结束后，不能再继续答题，请点击提交</td>
            </tr>
        </table>

</div>
<div class="middle-body">
    <div class="main-body">
        <div class="title" style="margin-top: 50px;">
            <span class="titleH1" style="text-align: center;">{{ $paperName }}</span>
        </div>
        <div class="" style="padding-top: 50px;padding-left: 30px;padding-bottom: 50px;">
            <div class="single question">
                <form class="layui-form" id="examForm">
                    <input type="hidden" name="stuId" value="{{ $stuId }}"/>
                    <input type="hidden" name="paperId" value="{{ $paperId }}"/>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div style="margin-bottom: 10px;">
                        <span class="question_type">一，选择题（5分/道）</span>
                    </div>
                    <?php $i = 1; ?>
                    @foreach($choiceList as $q1)
                        <div class="layui-form-item">
                            <p class="question_name">{{ $i }}.{!! $q1['question'] !!}</p>
                            <div class="layui-input-block" style="padding-top: 15px;" >
                                <div class="radio-style">
                                    <input type="radio" name="q{{ $i }}" value="A" title="A. {{ $q1['option_a'] }}" >
                                </div>
                                <div class="radio-style">
                                    <input type="radio" name="q{{ $i }}" value="B" title="B. {{ $q1['option_b'] }}">
                                </div>
                                <div class="radio-style">
                                    <input type="radio" name="q{{ $i }}" value="C" title="C. {{ $q1['option_c'] }}">
                                </div>
                                <div class="radio-style">
                                    <input type="radio" name="q{{ $i }}" value="D" title="D. {{ $q1['option_d'] }}">
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                        @endforeach
                    <div style="margin-bottom: 10px;">
                        <span class="question_type">二，填空题（5分/道）</span>
                    </div>
                    <?php $j = 1; ?>
                    @foreach($fillList as $q2)
                        <div class="layui-form-item">
                            <p class="question_name">{{ $j }}.{!! $q2['question'] !!}&nbsp;&nbsp;&nbsp;<input type="text" name="f{{ $j }}" class="tiankong" required  lay-verify="required"></p>

                        </div>
                        <?php $j++; ?>
                    @endforeach
                    <input type="hidden" name="i" value="{{ $i }}">
                    <input type="hidden" name="j" value="{{ $j }}">
                    <div class="formSub">
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit lay-filter="sendPaper">立即提交</button>
                            </div>
                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>
</div>

<div class="right-fixed">
    <blockquote class="layui-elem-quote" style="padding-left: 1px;">&nbsp;&nbsp;&nbsp;距离考试结束时间：</blockquote>
    <div id="timer" class="text-center"></div>
</div>
    <script src="{{ URL::asset('static/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ URL::asset('static/layui/layui.js') }}"></script>

    <script type="x-template" id="template">


        <div class="hour-timer timer-section">
            <span class="time">%h</span> : <span>时</span>
        </div>
        <div class="min-timer timer-section">
            <span class="time">%i</span> : <span>分</span>
        </div>
        <div class="second-timer timer-section">
            <span class="time">%s</span> : <span>秒</span>
        </div>

    </script>
    <script>
            var countt = "{{ $i }}";
            var endTime = "{{ $endTime }}";
            var sendUrl = "{{ url('home/Exam/checkPaper') }}";
            var afterUrl = "/home/gradeIndex";
    </script>
    <script src="{{ URl::asset('static/jsbars/jquery.jcountdown.js') }}"></script>
    <script src="{{ URl::asset('static/js/home_exam.js') }}"></script>
</body>
</html>