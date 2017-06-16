$(function(){
	// 还原保存的账号密码
	$('#username').prop('value',localStorage.username);
	$('#password').val(localStorage.password);
	// 记住密码checkbox状态
	if(localStorage.member==='true'){
		$('.login-auto input').prop('checked',true);
	}else{
		$('.login-auto input').prop('checked',false);
	}
	// 密码类型的转换
	$('#password').keyup(function(){
		$('#password').prop('type','password');
	});
	var pwd=$.trim($('#password').val());
	if(pwd =='' || pwd == '密码'){
		$('#password').prop('type','text');
	}else{
		$('#password').prop('type','password');
	}
	// 点击改变状态
	var state = $('.login-auto input').prop('checked');
	if(state){
		$('.login-auto').css('background','url(images/login_checked.png) no-repeat 0 3px');
	}else{
		$('.login-auto').css('background','url(images/login_check.png) no-repeat 0 3px');
	}
	$('.login-auto input').click(function(){
		var state = $(this).prop('checked');
		if(state){
			$(this).parent().css('background','url(images/login_checked.png) no-repeat 0 3px');
		}else{
			$(this).parent().css('background','url(images/login_check.png) no-repeat 0 3px');
		}
	});
});
// 登录框验证函数
function checkForm(){
	var name=$.trim($('#username').val());
	var pwd=$.trim($('#password').val());
	// 验证帐号或密码是否为空
	if(name =='' || name == '邮箱/手机/用户名'){
		$("#username").popover('show');
		return false;
	}else{
		$("#username").popover('hide');
	}
	if(pwd =='' || pwd == '密码'){
		$("#password").popover('show');
		return false;
	}else{
		$("#password").popover('hide');
	}
	// 记住、清除账号密码
	var member=$('.login-auto input').prop('checked');
	localStorage.member=member;
	if(member){
		// 记住
		localStorage.username=name;
		localStorage.password=pwd;
	}else{
		// 清除
		localStorage.username='邮箱/手机/用户名';
		localStorage.password='密码';
	}
	return true;
};
