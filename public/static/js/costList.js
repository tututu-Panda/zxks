layui.config({
    base: rooturl+'Public/static/js/'
}).use(['laypage', 'layer','form'], function() {
    var $ = layui.jquery,
        laypage = layui.laypage,
        layer = layui.layer,
        form = layui.form();

    //page
    laypage({
        cont: 'page',
        pages: pages //总页数
        ,
        groups: 5 //连续显示分页数
        ,
        curr: curr,//获得当前页码
        jump: function(obj, first) {
            //得到了当前页，用于向服务端请求对应数据

            var curr = obj.curr;
            if(!first) {
                layer.load(2, {
                    shade: [0.1,'#fff'] //0.1透明度的白色背景
                });
                window.location.href=listurl+"?requestPage="+curr+"&select_dept="+dept+"&select_year="+year+"&select_phones="+phones+"&select_month="+month;
            }
        }
    });

    // 获取到选择的年份
    form.on('select(year)', function(data){
        var year = data.value;
        $.ajax({
            url:getmonth,
            type:"POST",
            data: {year:year},
            dataType:"json",
            success: function (data) {

                //将option框清空,避免for循环重复
                $(".select_month").find("option").each(function(){
                    if(!$(this).val() == "")
                        $(this).remove();
                });

                //动态添加option
                for (var i = data.length - 1; i >= 0; i--) {
                    // alert(data[i]);
                    $(".select_month").append("<option value="+data[i]+">"+data[i]+"</option>");
                }
                // 更新选择框
                form.render('select');
            }
        });
    });

    // 点击修改动作
    $('.dataItem').on('dblclick',function(){
        var data =  $(this).data('number');
        var phone = $(this).data('phone');
        var month = $(this).data('ym');
        // layer.alert($(this).data('number'));
        layer.prompt({
                title:phone,
                value:data,
                formType: 0,
                btn:['修改','置零','取消'],
                yes:function() {
                    // 当前输入值
                    layer.confirm('确定修改？', {
                    },
                    function(){
                        var value = $("input[class=layui-layer-input]").val();
                        if(value == data){
                            location.reload();
                            return false;
                        }
                        // 修改该数值
                        $.post(editurl,{ym:month,data:value,phone:phone},function(data){
                            layer.alert(data.msg);
                            location.reload();
                        });
                        // alert(value);
                    });

                },
                btn2:function(){
                    layer.confirm('确定置零？', {
                    },
                    function(){
                        $.post(editurl,{ym:month,data:0,phone:phone},function(data){
                            layer.alert(data.msg);
                            location.reload();
                        });
                    });
                }
            });
    });

    // 获取部门手机号
    form.on('select(dept)', function(data){
        var year = data.value;
        $.ajax({
            url:getphone,
            type:"POST",
            data: {dept:year},
            dataType:"json",
            success: function (data) {

                //将option框清空,避免for循环重复
                $(".select_phones").find("option").each(function(){
                    if(!$(this).val() == "")
                        $(this).remove();
                });

                //动态添加option
                for (var i = data.length - 1; i >= 0; i--) {
                    // alert(data[i]);
                    $(".select_phones").append("<option value="+data[i]['number']+">"+data[i]['number']+"</option>");
                }
                // 更新选择框
                form.render('select');
            }
        });
    });


    //搜索内容
    form.on('submit(submit2)', function(data){

        //layer.open(JSON.stringify(data));
        var result = data.field;
        //console.log(result);
        //if(result.select_dept !== '' && result.select_year !== ''){
        //    return true;
        //}else {
        //    layer.open('年份和部门必选！');
        //    return false;
        //}
        layer.load(2, {
            shade: [0.1,'#fff'] //0.1透明度的白色背景
        });
        return true;
    });


});