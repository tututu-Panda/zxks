/**
 * Created by pjy on 17-5-20.
 */
layui.config({
    base: '../../static/js/'
}).use(['laypage', 'layer','form'], function() {
    var $ = layui.jquery,
        laypage = layui.laypage,
        layer = layui.layer,
        form = layui.form();


    // 分页内容
    // laypage({
    //     cont: 'page',
    //     pages: pages //总页数
    //     ,
    //     groups: 5 //连续显示分页数
    //     ,
    //     curr: curr,//获得当前页码
    //     jump: function(obj, first) {
    //         //得到了当前页，用于向服务端请求对应数据
    //
    //         var curr = obj.curr;
    //         if(!first) {
    //             layer.load(2, {
    //                 shade: [0.1,'#fff'] //0.1透明度的白色背景
    //             });
    //             window.location.href=listurl+"?requestPage="+curr+"&select_dept="+dept+"&select_year="+year+"&select_phones="+phones+"&select_month="+month;
    //         }
    //     }
    // });


    // 学科事件监听
    form.on('select(subject)', function(data){
        $.ajax({
            url:paperurl,
            type:"POST",
            data:{
                'subject':data.value
            },
            beforeSend: function(){
                //
            },
            success:function(data2)
            {

                //将option框清空,避免for循环重复
                $(".select_paper").find("option").each(function(){
                    if(!$(this).val() == "")
                        $(this).remove();
                });
                //动态添加option
                for (var i = data2.length - 1; i >= 0; i--) {
                    $(".select_paper").append("<option value="+data2[i]['id']+">"+data2[i]['name']+"</option>");
                }
                form.render('select');
            },
            error: function(){
                layer.msg('请求服务器超时', {time: 1000,icon: 2});
            }
        });
    });


    // 搜索事件
    form.on('submit(search)',function(){
        $.get(listurl,$('form').serialize(),function(data){
        });
    });


    $(".details").on('click',function(){
        var account_id = $(this).data('id');          // 学生id
        var testpaper_id = $(this).data('value');      // 试卷id
        var index = layer.open({
            type:2,
            title:['详细信息','text-align:center;'],
            area:['1100px','500px'],
            resize:false,
            maxmin:true,
            content:details+"?testpape_id="+testpaper_id+"&account_id="+account_id,
            end:function(){
                location.reload();
            }
        });
        layer.full(index);
    });












});