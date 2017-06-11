layui.config({
    base: '../../static/js/'
}).use(['layer', 'form'], function() {
    var layer = layui.layer,
        $ = layui.jquery,
        form = layui.form(),
        validator = layui.validator;
    var index1;
    //选择了考试的试卷进行考试
    $('.start-test').on('click',function() {
        var id = $(this).data('id');
        index1 = layer.open({
            type:2,
            title:['考试页面','text-align:center'],
            area: ['100%', '100%'],
            content:examTesturl+'/'+id,
            maxmin: true,
        });
        layer.full(index1);
    });
    form.render();
    //倒计时
    $("#timer").countdown({
        date: endTime,
        template: $('#template').html(),
        onComplete:function() {
            //alert("jiesu");
        }
    });
    form.on('submit(sendPaper)', function(data) {
        var temp=document.getElementsByTagName("input");
        var i;
        var val = new Array(countt);
        var flag = true;
        for(i = 0;i < countt;i++) {
            var temp_name = 'q'+i;
            val[i] = $('input[name='+temp_name+']:checked').val();
            // alert(val[i]);
            if(val[i] == null) {
                layer.msg('请检查所有的选项是否都已经勾选！', {time:3000});
                flag = false;
                return false;
            }

        }
        if(flag == true) {
            layer.confirm('确认提交试卷？', {
                btn: ['确认','取消'] //按钮
            }, function(){
                layer.msg('已提交！', {icon: 1});
                $.ajax({
                    url:sendUrl,
                    type:"POST",
                    data:data.field,
                    beforeSend: function(){
                        //
                    },
                    success:function(data2)
                    {
                        if(data2.success){
                            layer.msg(data2.msg, {time: 1000,icon: 1},function(){
                                window.location.href = afterUrl;
                            });
                        }else {
                            layer.msg(data2.msg, {time: 1000,icon: 2});
                        }
                    },
                    error: function(){
                        layer.msg('请求服务器超时', {time: 1000,icon: 2});
                    }
                });
                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            }, function(){

            });

            return false;
        }

    });

});
