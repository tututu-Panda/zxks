layui.config({
    base: '../../static/js/'
}).use(['layer', 'form','validator'], function() {
    var layer = layui.layer,
        $ = layui.jquery,
        form = layui.form();



    // 全选
    $(".checkall").on('click',function () {
        $("input[name='ids']").each(function() {
            $(this).prop("checked", true);
        });
        form.render('checkbox');
    });


    // 反选
    $(".recheck").click(function () {
        $("input[name='ids']").each(function() {
            if($(this).prop('checked')){
                $(this).prop("checked", false);
            }else{
                $(this).prop("checked", true);
            }
        });
        form.render('checkbox');
    });


    // 获得最初选中的值
    if(type_name === "选择题"){
        var chioceIds = parent.getChoice();
        strs=chioceIds.split(","); //字符分割
        $("input[name='ids']").each(function() {
            // 如果存在该id,则选中
           if(strs.indexOf($(this).val()) > -1){
               $(this).prop("checked", true);
           }
        });
    }

    else if(type_name === "填空题"){
        var fillIds = parent.getFill();
        strs=fillIds.split(","); //字符分割
        $("input[name='ids']").each(function() {
            // 如果存在该id,则选中
            if(strs.indexOf($(this).val()) > -1){
                $(this).prop("checked", true);
            }
        });
    }


    // 添加题目
    $(".add").click(function(){
        // 获得选中的值
        obj = document.getElementsByName("ids");
        // 定义id集
        check_val = [];
        for(k in obj){
            if(obj[k].checked)
                check_val.push(obj[k].value);
        }
        // 如果id集为空,则返回错误
        if(check_val == ""){
            layer.msg("请先选择!");
            return false;
        }
        if(type_name === "选择题"){
            // 选择题最多12到
            if(check_val.length > 12){
                layer.msg("选择题最多12道!");
            }else{
                var tf = parent.setChoice(check_val);
                if(tf == "true"){
                    layer.msg('添加成功!', {time: 2000,icon: 1});
                }
            }
        }
        else{
            if(check_val.length > 8){
                layer.msg("填空题最多8道!");
            }else{
                var tf = parent.setFill(check_val);
                if(tf == "true"){
                    layer.msg('添加成功!', {time: 2000,icon: 1});
                }
            }
        }
    });

    // 删除题目
    $(".del").click(function(){
        // 获得选中的值
        obj = document.getElementsByName("ids");
        check_val = [];
        for(k in obj){
            if(obj[k].checked)
                check_val.push(obj[k].value);
        }
        if(check_val == ""){
            layer.msg("请先选择!");
            return false;
        }
        if(type_name === "选择题"){
            // 得到已经选中的值
            var tf = parent.delChoice(check_val);
            if(tf == "true"){
                layer.msg('删除成功!', {time: 2000,icon: 1},function () {
                    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                    parent.layer.close(index);
                });
            }
        }else{
            // 得到已经选中的值
            var tf = parent.delFill(check_val);
            if(tf == "true"){
                layer.msg('删除成功!', {time: 2000,icon: 1},function () {
                    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                    parent.layer.close(index);
                });
            }
        }

    });



});