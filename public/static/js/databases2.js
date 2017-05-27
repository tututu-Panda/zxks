/**
 * Created by Liang on 2017/5/22.
 */
layui.config({
    base: '../../static/js/'
}).use(['layer', 'form', 'laypage'], function() {
    var layer = layui.layer,
        $ = layui.jquery,
        form = layui.form(),
        laypage = layui.laypage,
        validator = layui.validator;

    form.render();
    //分页
    laypage({
        cont: 'page',
        pages: pages //总页数
        ,
        groups: 5 //连续显示分页数
        ,
        skip: true, //是否开启跳页
        curr: curr,//获得当前页码
        jump: function(obj, first) {
            //得到了当前页，用于向服务端请求对应数据
            var curr = obj.curr;
            var id = $("#testdb_id").val();
            var searchword = "&type_id="+type+"&level_id="+level+"&keyword="+keyword;
            if(!first) {
                window.location.href=listUrl+'/'+id+"?&requestPage="+curr+searchword;
            }
        }
    });

    $('.addSingle').on('click', function(){
        var id = $("#testdb_id").val();
            // alert(data.msg);
                var index = layer.open({
                    type: 2,
                    title:['添加单个题目', 'text-align:center;'],
                    // skin: 'layui-layer-rim my-input', //加上边框
                    area:['1100px', '500px'],  //宽高
                    resize: false,      //是否允许拉伸
                    //scrollbar: false,
                    maxmin: true,
                    content: addQuestionUrl+"/"+id,
                    end: function (){
                        location.reload();
                    }
                });
                layer.full(index);
    });
    // form.on('submit(search)',function(){
    //     var id = $(this).data('id');
    //     $.get(listUrl+'/'+id,$('#searchForm').serialize(),function(data){
    //
    //     });
    // });
    $('#search').on('click', function(data){
        var keyword = $("#keyword").val();
        var type = $("#type").val();
        var level = $("#level").val();
        var id = $("#testdb_id").val();
        var searchword = "?";

        if(keyword=="" && type=="" && level=="") {
            layer.alert('请先输入内容', {time: 3000});
        }else {
            if(type != "") {
                searchword = searchword+"&type_id="+type;
            }
            if(level != "") {
                searchword = searchword+"&level_id="+level;
            }
            if(keyword != "") {
                searchword = searchword+"&keyword="+keyword;
            }

            window.location.href=listUrl+'/'+id+searchword;
        }
        return false;
    });
    $('#searchAll').on('click', function(){
        var id = $("#testdb_id").val();
        window.location.href=listUrl+"/"+id;
    });

    $('.editQue').on('click', function(){
        var id = $(this).data('id');  //获取的是该到题目的id
        // alert(data.msg);
        var index = layer.open({
            type: 2,
            title:['编辑题目', 'text-align:center;'],
            // skin: 'layui-layer-rim my-input', //加上边框
            area:['1100px', '500px'],  //宽高
            resize: false,      //是否允许拉伸
            //scrollbar: false,
            maxmin: true,
            content: editQuestionUrl+"/"+id,
            end: function (){
                location.reload();
            }
        });
        layer.full(index);
    });
    $('.delQue').on('click', function(){

        var id = $(this).data('id');
        layer.confirm('确定删除该题目吗~请三思~~?', {
            icon: 3,
            btn: ['确定', '取消']
        }, function(){
            $.ajax({
                url: deleteQuesUrl,
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
});