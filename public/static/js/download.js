layui.config({
    base: rooturl+'Public/static/js/'
}).use(['layer','form','element'], function() {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        element = layui.element()


    // 获取到选择的年份
   	form.on('select(year)', function(data){
	 	var year = data.value;
	 	$.ajax({
	 		url:getmonth,
	 		type:"POST",
 		 	data: {year:year},
	 		dataType:"json",
	 		success: function (data) {

	 			//将option框清空,避免for循环重复
	 			$(".select_month").find("option").each(function(){
	 				if(!$(this).val() == "")
						$(this).remove();
				});

	 			//动态添加option
	 			for (var i = data.length - 1; i >= 0; i--) {
	 				// alert(data[i]);
	 				$(".select_month").append("<option value="+data[i]+">"+data[i]+"</option>");
	 			}
			 	// 更新选择框
			 	form.render('select');
	 		}
	 	});
	});

	// 进行数据下载
	form.on('submit(Down)', function(data){
	   var year = data.field.select_year;
	   var depart = data.field.select_depart;
	   var month = data.field.select_month;
	   var quarter = data.field.select_quarter;
	   layer.load(1);
		//此处演示关闭
		setTimeout(function(){
		  layer.closeAll('loading');
		}, 2000);

		window.location=downfile+"?year="+year+"&depart="+depart+"&month="+month+"&quarter="+quarter;




		return false;
	});



});
