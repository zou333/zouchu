$(function(){
	$('input[type="checkbox"]').click(function(){
		var state = $(this).prop('checked');
		console.log(state);
		if(state){
			$(this).parent().css({
				'background':'url(images/checked_box.png) no-repeat',
				'background-position': '85px'
			});
		}else{
			$(this).parent().css({
				'background':'url(images/check_box.png) no-repeat',
				'background-position': '85px'
			});
		};
	});
	$('.address-info').click(function(){
		$(this).addClass('default').siblings().removeClass('default');
	});
	$('.delete').click(function(){
		if(confirm('确定是否删除')){
			$(this).parents('.address-info').next().addClass('default');
			$(this).parents('.address-info').remove();
		};
	});
	// 地址信息验证
	$('label button[type="submit"]').click(function(){
		var name = $.trim($("#username").val());
		var street = $.trim($("#street").val());
		var phone = $.trim($("#phone").val());
		// 用户名验证
		if(name == '' || name == '输入收件人姓名'){
			$("#username").popover('show');
			return false;
		}else{
			$("#username").popover('hide');
		}
		// 街道的验证
		if(street == '' || street == '输入街道或小区名称'){
			$("#street").popover('show');
			return false;
		}else{
			$("#street").popover('hide');
		}
		
		// 手机号码验证
		if(phone == '' || phone == '输入电话号码'){
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
	});
	// textarea聚焦和失去焦点
	$("#street").focus(function(){
		var street = $.trim($("#street").val());
		if(street == '输入街道或小区名称'){
			$(this).val('');
		}
	});
	$("#street").blur(function(){
		var street = $.trim($("#street").val());
		if(street == ''){
			$(this).val('输入街道或小区名称');
		}
	});
});