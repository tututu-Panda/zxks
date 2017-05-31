
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


     // 搜索事件
    form.on('submit(search)',function(){
        $.get(listurl,$('form').serialize(),function(data){
        });
    });



    // 启用事件
    $(".use").on("click",function(){
       var id = $(this).data('id');

       $.post(actionurl,{id:id,action:'use',_token:$(".token").val()},function(data){
           if(data.status !== false){
               layer.msg(
                   data.msg,{
                   icon:1,
                   time:3000
                   },
                   function(){
                    location.reload();
                });
           }else{
               layer.msg(data.msg, {
                    icon:2,
                    time:3000
                   },
                   function(){
                   location.reload();
               });
           }
       });

    });


    //　禁用事件
    $(".stop").on('click',function () {
        var id = $(this).data('id');

        $.post(actionurl,{id:id,action:'stop',_token:$(".token").val()},function(data){
           if(data.status !== false){
               layer.msg(
                   data.msg,{
                   icon:1,
                   time:3000
                   },
                   function(){
                    location.reload();
                });
           }else{
               layer.msg(data.msg, {
                    icon:2,
                    time:3000
                   },
                   function(){
                   location.reload();
               });
           }
       });
    });




    // 试卷编辑事件
    $(".edit").on('click',function(){
       var id = $(this).data('id');
       var index = layer.open({
            type:2,
            title:['编辑试卷','text-align:center;'],
            area:['1100px','500px'],
            resize:false,
            maxmin:true,
            content:editurl+"?testpaper_id="+id,
            end:function(){
                location.reload();
            }
        });
        layer.full(index);
    });





});