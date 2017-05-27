/**
 * Created by Liang on 2017/5/19.
 */
layui.config({
    base: '../../static/js/'
}).use(['layer', 'form'], function() {
    var layer = layui.layer,
        $ = layui.jquery,
        form = layui.form(),
        validator = layui.validator;

    form.render();
    $('.add').on('click',function() {
        layer.open({
            type: 1,
            title: ['添加题库', 'text-align:center;'],
            content: $('.addForm'),
            area:['400px', '300px'],  //宽高
            resize: false,		//是否允许拉伸
            scrollbar: false,
        });
    });

    $('.edit').on('click',function() {
        var id = $(this).data('id');
        layer.open({
            type: 2,
            title: ['编辑题库', 'text-align:center;'],
            content: editForm+"/"+id,
            area:['400px', '300px'],  //宽高
            resize: false,		//是否允许拉伸
            scrollbar: false,
        });
    });
    //自定义验证规则
    form.verify({
        name: function(value) {
            if(value == "") {
                return '题库名称不能为空';
            }
        },
        test_id: function(value){
            if(value == ""){
                return '所属科目不能为空';
            }
        },
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
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                        parent.location.href = afterurl;
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
    form.on('submit(addSave)',function(data) {
        $.ajax({
            url: addHandleUrl,
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
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                        parent.location.href = afterurl;
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
    $('.del').on('click', function(){

        var id = $(this).data('id');
        layer.confirm('确定删除该题库，这样会删除该题库下所有题目?', {
            icon: 3,
            btn: ['确定', '取消']
        }, function(){
            $.ajax({
                url: deleteurl,
                type: 'POST',
                dataType: 'json',
                headers:{'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')},
                data: {'id': id},
                error: function(request){
                    layer.msg("请求服务器超时", {time: 1000, icon: 5});
                },
                success: function(data){
                    if (data.success){
                        layer.msg(data.msg, {
                            time: 1000
                        }, function(){
                            location.reload();
                        });
                    }else{
                        layer.msg(data.msg, {
                            time: 1000
                        });
                    }
                }
            });

        });
    });
    //点击查看详情的事件处理
    $('.detail').on('click', function(){
        var id = $(this).data('id');

        var index = layer.open({
            type: 2,
            title: ['题库详情', 'text-align:center;'],
            content: detailurl+"/"+id,
            area:['1100px', '500px'],  //宽高
            resize: false,		//是否允许拉伸
            //scrollbar: false,
            maxmin: true,

        });
        layer.full(index);
    });
    $('#search').on('click', function(data){
        var keyword = $("#keyword").val();
        var type = $("#type").val();
        var searchword = "?";

        if(keyword=="" && type=="") {
            layer.alert('请先输入或选择内容', {time: 3000});
        }else {
            if(type != "") {
                searchword = searchword+"&type_id="+type;
            }
            if(keyword != "") {
                searchword = searchword+"&keyword="+keyword;
            }

            window.location.href=afterurl+searchword;
        }
        return false;
    });
    $('#searchAll').on('click', function(){
        window.location.href=afterurl;
    });
});