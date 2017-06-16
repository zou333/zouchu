$(function(){
	// 留言信息验证
	$('label button[type="submit"]').click(function(){
		var name = $.trim($("#username").val());
		var password = $.trim($("#password").val());
		var rePassword = $.trim($("#rePassword").val());
		var email = $.trim($("#email").val());
		var phone = $.trim($("#phone").val());
		var message = $.trim($("#message").val());
		var verify = $.trim($("#verify").val());
		var agreement = $("#agreement").prop("checked");
		// 用户名验证
		if(name == '' || name == '请输入您的姓名'){
			$("#username").popover('show');
			return false;
		}else{
			$("#username").popover('hide');
		}
		// 手机号码验证
		if(phone == '' || phone == '请输入您的手机'){
			$("#phone").popover('show');
			return false;
		}else{
			//手机号码格式验证
			var patte = /^1[34578]\d{9}$/;
			var res = patte.test(phone);
			if(res){
				//手机号码验证通过后的处理
				$("#phone").popover('hide');
			}else{
				$("#phone").attr('data-content','手机号码格式错误');
				$("#phone").popover('show');
				return false;
			}			
		}
		// 留言验证
		if(message == '' || message == '请输入您想对我们说的话...'){
			$("#message").popover('show');
			return false;
		}else{
			$("#message").popover('hide');
		};	
		// 验证码验证
		if(verify == '' || verify == '请输入验证码'){
			$("#verify").popover('show');
			return false;
		}else{
			$("#verify").popover('hide');
		};		
	});
	// textarea聚焦和失去焦点
	$("#message").focus(function(){
		var message = $.trim($("#message").val());
		if(message == '请输入您想对我们说的话...'){
			$(this).val('');
		}
	});
	$("#message").blur(function(){
		var message = $.trim($("#message").val());
		if(message == ''){
			$(this).val('请输入您想对我们说的话...');
		}
	});
});