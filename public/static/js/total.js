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
    laypage({
        cont: 'page',
        pages: pages //总页数
        ,
        groups: 5 //连续显示分页数
        ,
        curr: curr,//获得当前页码
        jump: function(obj, first) {
            //得到了当前页，用于向服务端请求对应数据

            var curr = obj.curr;
            if(!first) {
                layer.load(2, {
                    shade: [0.1,'#fff'] //0.1透明度的白色背景
                });
                window.location.href=listurl+"?requestPage="+curr+"&select_dept="+dept+"&select_year="+year+"&select_phones="+phones+"&select_month="+month;
            }
        }
    });






});