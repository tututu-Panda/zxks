/**
 * Created by Liang on 2017/5/18.
 */
layui.config({
    base: '../../static/js/'
}).use(['layer', 'form','validator'], function() {
    var layer = layui.layer,
        $ = layui.jquery,
        form = layui.form(),
        validator = layui.validator;
    var index1;
        $('#modify').on('click',function() {
            index1 = layer.open({
                type:1,
                title:'修改基本信息',
                shadeClose: true,
                shade: 0.2,
                fix:true,
                shift: 2,
                maxmin: true,
                skin: 'layui-layer-rim', //加上边框
                area: ['420px', '500px'],
                content:$('.modify-form'),
            });
        });
    form.on('submit(editSave)',function(data) {
        $.ajax({
            url: editHandleUrl,
            type: 'POST',
            data: data.field,
            error: function(request){
                layer.msg("请求服务器超时", {time: 1000, icon: 5});
            },
            success: function(data){
                if (data.success){
                    layer.msg(data.msg, {
                        time: 1000
                    }, function(){
                        layer.close(index1);
                        window.location.href = afterUrl;
                    });
                }else{
                    layer.msg(data.msg, {
                        time: 1000
                    });
                }
            }
        });

        return false;
    });
});