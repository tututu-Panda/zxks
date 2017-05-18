var myChart1 = echarts.init(document.getElementById('echarts-test'));
myChart1.setOption({
    title : {
        text: '某某试卷分析',
        subtext: '纯属虚构',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        left: 'left',
        data: ['分析one','分析two','分析three','分析four','分析five']
    },
    series : [
        {
            name: '访问来源',
            type: 'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:335, name:'分析one'},
                {value:310, name:'分析two'},
                {value:234, name:'分析three'},
                {value:135, name:'分析four'},
                {value:1548, name:'分析five'}
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
});

var myChart2 = echarts.init(document.getElementById('echarts-test2'));
myChart2.setOption({

    title: {
        text: '某某成绩趋势',
        subtext: '纯属虚构'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data:['测试科目1','测试科目2']
    },
    toolbox: {
        show: true,
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            dataView: {readOnly: false},
            magicType: {type: ['line', 'bar']},
            restore: {},
            saveAsImage: {}
        }
    },
    xAxis:  {
        type: 'category',
        boundaryGap: false,
        data: ['一','二','三','四','五','六','日']
    },
    yAxis: {
        type: 'value',
        axisLabel: {
            formatter: '{value} 分'
        }
    },
    series: [
        {
            name:'测试科目1',
            type:'line',
            data:[30, 40, 50, 60, 70, 80,90],
            markPoint: {
                data: [
                    {type: 'max', name: '最大值'},
                    {type: 'min', name: '最小值'}
                ]
            },
            markLine: {
                data: [
                    {type: 'average', name: '平均值'}
                ]
            }
        },
        {
            name:'测试科目2',
            type:'line',
            data:[20,30,60,80,50,90,50],
            markPoint: {
                data: [
                    {name: '周最低', value: -2, xAxis: 1, yAxis: -1.5}
                ]
            },
            markLine: {
                data: [
                    {type: 'average', name: '平均值'},
                    [{
                        symbol: 'none',
                        x: '90%',
                        yAxis: 'max'
                    }, {
                        symbol: 'circle',
                        label: {
                            normal: {
                                position: 'start',
                                formatter: '最大值'
                            }
                        },
                        type: 'max',
                        name: '最高点'
                    }]
                ]
            }
        }
    ]
});