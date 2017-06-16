$(function(){
	// 密码类型的转换
	$('#password').keyup(function(){
		$('#password').prop('type','password');
	});
	var pwd=$.trim($('#password').val());
	if(pwd =='' || pwd == '建议使用中文、字母、数字的组合，6-20个字符'){
		$('#password').prop('type','text');
	}else{
		$('#password').prop('type','password');
	}
	// 确认密码类型的转换
		$('#rePassword').keyup(function(){
			$('#rePassword').prop('type','password');
		});
		var pwd=$.trim($('#rePassword').val());
		if(pwd =='' || pwd == '请再次输入密码'){
			$('#rePassword').prop('type','text');
		}else{
			$('#rePassword').prop('type','password');
		}
	// 注册信息验证
	$('.content button[type="submit"]').click(function(){
		var name = $.trim($("#username").val());
		var password = $.trim($("#password").val());
		var rePassword = $.trim($("#rePassword").val());
		var email = $.trim($("#email").val());
		var phone = $.trim($("#phone").val());
		var verify = $.trim($("#verify").val());
		var agreement = $("#agreement").prop("checked");
		// 用户名验证
		if(name == '' || name == '支持中文、字母、数字的组合，4-20个字符'){
			$("#username").popover('show');
			return false;
		}else{
			// 用户名格式验证
			var patte = /^[\x00-\xffA-z0-9]{6,20}$/;
			var res = patte.test(name);
			if(res){
				$("#username").popover('hide');
			}else{
				$("#username").attr('data-content','用户名格式错误');
				$("#username").popover('show');
				return false;
			}
		}
		// 密码验证
		if(password == '' || password == '建议使用中文、字母、数字的组合，6-20个字符'){
			$("#password").popover('show');
			return false;
		}else{
			// 密码格式验证
			var patte = /^[\x00-\xffA-z0-9]{6,20}$/;
			var res = patte.test(password);
			if(res){
				$("#password").popover('hide');
			}else{
				$("#password").attr('data-content','密码格式错误');
				$("#password").popover('show');
				return false;
			}			
		}

		// 再次确认密码验证
		if(rePassword == '' || rePassword == '请再次输入密码'){
			$("#rePassword").popover('show');
			return false;
		}else{
			if(rePassword == password){
				$("#rePassword").popover('hide');
			}else{
				$("#rePassword").attr('data-content','两次密码输入不一致');
				$("#rePassword").popover('show');
				return false;
			}
		}
		// 邮箱验证
		if(email == '' || email == '请输入您的E-mail'){
			$("#email").popover('show');
			return false;
		}else{
			var patte = /^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/;
			var res = patte.test(email);
			if(res){
				// 邮箱验证通过后的处理
				$("#email").popover('hide');
			}else{
				$("#email").attr('data-content','邮箱格式错误');
				$("#email").popover('show');
				return false;
			};			
		}
		// 手机号码验证
		if(phone == '' || phone == '请输入您的手机号'){
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
		// 验证码验证
		if(verify == '' || verify == '请输入手机验证码'){
			$("#verify").popover('show');
			return false;
		}else{
			$("#verify").popover('hide');
		};
		// 是否同意协议验证
		if(agreement == false){
			$("#agreement").popover('show');
			return false;
		}else{
			$("#agreement").popover('hide');
		}		
	});
	// 协议图标的替换
	$('.agreement label').click(function(){
		var state = $('#agreement').prop('checked');
		if(state){
			$(this).css('background','url(images/checked_box.jpg) no-repeat 0 3px');
		}else{
			$(this).css('background','url(images/check_box.jpg) no-repeat 0 3px');
		};
		console.log(state);
	});
});