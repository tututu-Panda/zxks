layui.config({
    base: '../../static/js/'
}).use(['layer', 'form','validator','laydate'], function() {
    var layer = layui.layer,
        $ = layui.jquery,
        laydate = layui.laydate,
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
            end.start = datas //将结束日的初始值设定为开始日
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

    // 添加题目    //选择题60分,填空题40分


    // 添加选择题
    $(".add1").on('click',function(){
       var testpaper_type = $(".testpaper_type").val();
       // 如果没有选择科目则提示
       if(testpaper_type === ""){
           layer.msg('请先选择科目', {time: 3000,icon: 2});
       }else{
           // 打开相应的题库
           var index = layer.open({
               type:2,
               title:['添加题目','text-align:center;'],
               area:['1100px','500px'],
               resize:false,
               maxmin:true,
               content:adddb+"?testpaper_type="+testpaper_type+"&type=1",
               end:function(){
                   // location.reload();
               }
           });
           layer.full(index);
       }

       return false;
    });


    // 添加填空题
    $(".add2").on('click',function(){
        var testpaper_type = $(".testpaper_type").val();
        // 如果没有选择科目则提示
        if(testpaper_type === ""){
            layer.msg('请先选择科目', {time: 3000,icon: 2});
        }else{
            // 打开相应的题库
            var index = layer.open({
                type:2,
                title:['添加题目','text-align:center;'],
                area:['1100px','500px'],
                resize:false,
                maxmin:true,
                content:adddb+"?testpaper_type="+testpaper_type+"&type=2",
                end:function(){
                    // location.reload();
                }
            });
            layer.full(index);
        }

        return false;
    });


    // 提交试卷
    form.on('submit(comfirm)',function (rec) {
        // console.log($("form").serialize());
        $.post(addpaper,$("form").serialize(),function(data){
            if(data.status === false) {
                layer.msg(data.data,{icon:2},{time:3000});
            }else {
                layer.msg(data.data, {time: 3000,icon: 1},function () {
                   location.reload();
                   form.render('form');
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