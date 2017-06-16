$(function(){
	// 选中样式的改变
	$('.pay-box').click(function(){
		$(this).children('label').css('background','url(images/pay_checked_icon.png) no-repeat');
		$(this).parents().siblings().find('label').css('background','url(images/pay_unchecked_icon.png) no-repeat');
	});
	// 输入密码的验证
	var code = $('.pay-password input');
	var len = code.length;
	var patte = /^\d{1}$/;
	code.each(function(i){
		$(this).keydown(function(){
			// input[type=text]
			$(this).prop('type','text');
		});
		$(this).keyup(function(evt){
			// 设置从第一个input开始输入密码
			if(i > 0){
				var prevVal = $(this).prev('input').val();
				if(prevVal == ''){
					code.each(function(){
						$(this).val('');
						$('.pay-password input').first('input').focus();
					});
					return false;
				};
			};
			// 密码为number的验证
			var val = $(this).val();
			if(patte.test(val)){
				// input[type=password]
				$(this).prop('type','password');
				if((val.length == 1) && (i < len - 1)){
					$(this).next('input').focus();
				};	
			}else{
				$(this).val('');
			};
			// 回车键删除功能
			if(evt.keyCode == 8){
				if(i > 0){
					$(this).val('');
					$(this).prev('input').focus().val('');
				};
			};
		});
	});	
});