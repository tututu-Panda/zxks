layui.config({
	base: '../../static/js/'
}).use(['layer', 'form','validator'], function() {
	var layer = layui.layer,
	$ = layui.jquery,
	form = layui.form(),
	validator = layui.validator;
	form.on('submit(login)',function(rec){
		if(!validator.IsNotEmpty(rec.field['name']) || !validator.IsNotEmpty(rec.field['password'])){
			layer.msg('账号或密码不能为空!');
		}else if($.trim(rec.field['password']).length<6 || $.trim(rec.field['password']).length>16){
			layer.msg('密码的长度为6-16位');
			$('input[name=password]').focus();
		}else{

            //ajax验证验证码
            $.post(checkurl,{code:rec.field['verify_code'],_token:rec.field['_token']},function(data, textStatus, xhr){
                if(!data.success){
                    layer.alert('验证码错误!', {
                        icon: 2,
                        title:'提示',
                    });
                }else{
                    $.post(loginurl,{account:rec.field['account'],password:rec.field['password'],_token:rec.field['_token']}, function(data, textStatus, xhr) {
                        if(!data.success){
                            layer.alert(data.data, {
                                icon: 2,
                                title:'提示',
                            });
                        }else{
                            var index = layer.load(0, {shade: false});
                            window.location.href=loginrec;
                            layer.close(index);
                        }
                    });
                }
            });


		}
	   return false;
	});


});
