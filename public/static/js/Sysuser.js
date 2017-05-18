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

                $("#photo").attr("src",data.route);
                var reg = "http://localhost:8000/";
                // var reg = "http\:\/\/localhost\:\d+";
                var imgvalue = data.route;
                var value = imgvalue.replace(reg,"");
                $("#changephoto").attr("value",value);
                form.render();

            }

        }


    });


    // 进行修改
    form.on('submit(change)',function (rec) {
        $.post(updateuser,$("form").serialize(),function (data) {
            // 成功后的信息
            if(data.status === false) {
                layer.msg(data.data,{icon:2},{time:3000});
            }else {
                layer.msg(data.data,{icon:1},{time:3000},function () {
                    form.render();
                });
            }
        })
            // 捕获错误信息
            .error(function (data) {
                var errors = $.parseJSON(data.responseText);
                $.each( errors, function( key, value ) {
                    layer.msg(value[0],{icon:2},{time:3000});
                });

        });
        return false;
    });
    
    
    //进行密码修改
    $(".changepass").click(function () {
        var id = $("#id").val();
        layer.open({
                type: 2,
                title:['修改密码', 'text-align:center;'],
                content: chanpass+"/"+id,
                area: ['370px', '370px'],
                resize: false,        //是否允许拉伸
                scrollbar: false,
                end: function(){
                    location.reload();
                }
            }
        );
    })



});
