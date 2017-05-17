/**
 * Created by pjy on 17-5-17.
 */


layui.config({
    base: '../../static/js/'
}).use(['layer', 'form','validator','upload'], function() {
    var layer = layui.layer,
        $ = layui.jquery,
        form = layui.form();


    // 文件上传设置
    layui.upload({
        url:upload,
        ext: 'jpg|png|gif|jpeg',
        before:function(){
            var index1 = layer.load(0,{time:3000});
        },
        success:function(data){
            if(data.status === false) {
                layer.msg("上传失败！",{icon:2},{time:3000});
            }else {
                alert(data.route);
                // $("#photo").attr("src",data.route);
                $("#photo").attr("src",data.route);
                form.render();

            }

        }

    });




});
