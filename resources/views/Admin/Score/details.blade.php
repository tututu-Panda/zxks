@extends('Admin.layouts.layout')

@section('title','详细信息')

@section('css')
    <link rel="stylesheet" href="{{asset('static/css/details.css')}}">
    <style>
        span{
            letter-spacing: 5px;
        }
    </style>
    @endsection


@section('content')

    <div id="score">
        <div id="score_pillar"></div>
    </div>
    <div id="score">
        <div id="score_pillar" style="height: 20px;text-align: center;padding-bottom:10px;">
            <b>评语</b>：@if($finalScore >=80)
                <span>该学生成绩优秀!</span>
                @elseif($finalScore >=60)
                    <span>该学生成绩良好!</span>
                @else
                    <span>该学生成绩有待提高!</span>
            @endif
        </div>
    </div>
    @endsection


@section('js')
    <script src="{{asset("static/js/details.js")}}"></script>
    <script src="{{asset("static/js/total.js")}}"></script>
    <script src="{{asset("static/js/echarts.js")}}"></script>

    <script>
        var fianlscore = "{{$finalScore}}";
        var testpaper_name = "{{$testpaper_name}}";
        var name = "{{$name}}";
        var choice = "{{$choiceNum}}";
        var fill = "{{$fillNum}}";
        var easy = "{{$easyNum}}";
        var dfficult = "{{$difficultNum}}";
    </script>

    <script>
        var pillar = echarts.init(document.getElementById('score_pillar'));
        var mainData = [];
        mainData.push({
            name: '总分',
            value: fianlscore,
            prevalue: fianlscore,
            hismax: 100
        });
        mainData.push({
            name: '选择题',
            value: choice*5,
            prevalue: choice*5,
            hismax: 60
        });
        mainData.push({
            name: '填空题',
            value: fill*5,
            prevalue: fill*5,
            hismax: 40
        });
        mainData.push({
            name: '困难题',
            value: dfficult,
            prevalue: dfficult,
            hismax: 20
        });

        mainData.push({
            name: '简易题',
            value: easy,
            prevalue: easy,
            hismax: 20
        });

        function createSeries(mainData) {
            var result = [];
            var insideLabel = {
                normal: {
                    position: 'center',
                    formatter: function(params) {
                        if (params.name == "other")
                            return "";
                        return params.value + '\n' + params.name;
                    },
                    textStyle: {
                        fontStyle: 'normal',
                        fontWeight: 'normal',
                        fontSize: 18
                    }
                }
            };
            var outsideLabel = {
                normal: {
                    show: false
                }
            };
            var itemOthers = {
                normal: {
                    color: '#ccc'
                }
            };
            for (var i = 0; i < mainData.length; i++) {
                var increase = mainData[i].value > mainData[i].prevalue;
                result.push({
                    type: 'pie',
                    center: [i * 20 + 10 + '%', '40%'],
                    radius: ['15%', '18%'],
                    label: insideLabel,
                    data: [{
                        name: 'other',
                        value: mainData[i].hismax - mainData[i].value,
                        itemStyle: itemOthers
                    }, {
                        name: mainData[i].name,
                        value: mainData[i].value,
                        prevalue: mainData[i].prevalue
                    }],

                });
            }
            return result;
        }
        option = {
            title: {
                text: name+"在"+testpaper_name+'中的具体分析',
                subtext: '这是你最关心的数据了吧？',
                x: 'center'
            },
            toolbox: {
                show: true,
                feature: {
                    dataView: {
                        show: true,
                        readOnly: true
                    },
                    saveAsImage: {
                        show: true
                    }
                }
            },
            series: createSeries(mainData)
        }
        pillar.setOption(option);
    </script>

    @endsection
