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
                            layer.close(index1);
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
    });

});
