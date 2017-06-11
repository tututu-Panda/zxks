layui.config({
    base: '../../static/js/'
}).use(['laypage', 'layer','form','laydate'], function() {
    var $ = layui.jquery,
        laypage = layui.laypage,
        layer = layui.layer,
        form = layui.form();


    // 科目选择框前添加图标
    var icon = "<label class='beg-login-icon' >" +
        "<i class='fa fa-bars' aria-hidden='true'></i></label>";
    $(".layui-select-title").append(icon);

    // 考试时间
    var start = {
        istime: true,
        format: 'YYYY-MM-DD hh:mm:ss',
        festival: false,
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas; //将结束日的初始值设定为开始日
        }
    };

    var end = {
        istime: true,
        format: 'YYYY-MM-DD hh:mm:ss',
        festival: false,
        choose: function(datas){
            start.max = datas; //结束日选好后，重置开始日的最大日期
        }
    };

    document.getElementById('beginDate').onclick = function(){
        start.elem = this;
        laydate(start);
    };
    document.getElementById('endDate').onclick = function(){
        end.elem = this;
        laydate(end);
    };

    // 编辑选择题
    $(".edit1").on('click',function(){
        var testpaper_type = $(".testpaper_type").val();

        // 打开相应的题库
        var index = layer.open({
            type:2,
            title:['添加题目','text-align:center;'],
            area:['1100px','500px'],
            resize:false,
            maxmin:true,
            content:editdb+"?testpaper_type="+testpaper_type+"&type=1",
            end:function(){
                // location.reload();
            }
        });
        layer.full(index);


        return false;
    });

    // 编辑填空题
    $(".edit2").on('click',function(){
        var testpaper_type = $(".testpaper_type").val();

        // 打开相应的题库
        var index = layer.open({
            type:2,
            title:['添加题目','text-align:center;'],
            area:['1100px','500px'],
            resize:false,
            maxmin:true,
            content:editdb+"?testpaper_type="+testpaper_type+"&type=2",
            end:function(){
                // location.reload();
            }
        });
        layer.full(index);


        return false;
    });

    // 提交试卷
    form.on('submit(update)',function (rec) {
        // 获得时间
        var endtime = $("#endDate").val();
        var starttime = $("#beginDate").val();

        // 开始时间戳
        date = starttime.substring(0,19);
        date = date.replace(/-/g,'/');
        var stime = new Date(date).getTime();

        // 结束时间戳
        date = endtime.substring(0,19);
        date = date.replace(/-/g,'/');
        var etime = new Date(date).getTime();

        // 时间戳相减
        var time = etime-stime;
        // 获得相差的小时数
        var hour = time/(1000 * 3600);
        // alert(hour);
        // console.log($("form").serialize());
        if(hour !== 2){
            layer.msg('开始与结束时间相差为固定2个小时!',{icon:2},{time:3000});
            return false;
        }
        $.post(upadtepaper,$("form").serialize(),function(data){
            if(data.status === false) {
                layer.msg(data.data,{icon:2},{time:3000});
            }else {
                layer.msg(data.data, {time: 3000,icon: 1},function () {
                    location.reload();
                });
            }
        })
        // 捕获错误信息
            .error(function (data) {
                var errors = $.parseJSON(data.responseText);
                $.each( errors, function( key, value ) {
                    layer.msg(value[0],{icon:2},{time:3000});
                    return false;
                });

            });
        return false;
    });




});