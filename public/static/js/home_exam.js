layui.config({
    base: '../../static/js/'
}).use(['layer', 'form'], function() {
    var layer = layui.layer,
        $ = layui.jquery,
        form = layui.form(),
        validator = layui.validator;

    //选择了考试的试卷进行考试
    $('.start-test').on('click',function() {
        var index = layer.open({
            type:2,
            title:['考试页面','text-align:center'],
            area: ['100%', '100%'],
            content:examTesturl,
            maxmin: true,
        });
        layer.full(index);
    });
    form.render();

});
