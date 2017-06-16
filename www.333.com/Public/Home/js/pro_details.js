$(function(){
	// 产品颜色，尺码选择
	$('.size span').click(function(){
		$(this).addClass('selected').siblings().removeClass('selected');
	});
	$('.color span').click(function(){
		$(this).addClass('selected').siblings().removeClass('selected');
	});
	// 产品数量的加减
	$('.sub').click(function(){
		 var num = $(this).siblings('input').val();
		 num -= 1;
		 if(num<=1){
		 	num = 1;
		 };
		 $(this).siblings('input').val(num);
	});
	$('.add').click(function(){
		 var num = $(this).siblings('input').val();
		 num = + num + 1;
		 $(this).siblings('input').val(num);
	});
	// 限定input的值为数字
	$('.number input').keyup(function(evt){
		var val = $(this).val();
		if(evt.keyCode == 8){
			return false;
		};
		if(isNaN(val)){
			$(this).val(1);
		}else{
			$(this).val(val<1?1:val);
		};
	});
	$('.number input').blur(function(){
		var val = $(this).val();
		if(val == ''){
			$(this).val(1);
		}else{
			$(this).val(Math.ceil(val));
		};
	});
	// 相册功能
	// 点击小图变大图	
	$('.view ul li').hover(function(){
		$(this).addClass('cur').siblings().removeClass('cur');
		var smImg = $(this).children('img').prop('src');
		$('.album>img').prop('src',smImg);
	});
	// 鼠标点击左右滑动事件
	var liWidth = $('.view ul li').outerWidth(true);	
	var viewWidth = $('.view').outerWidth(true);
	var liLen = $('.view ul li').length;
	var totalLen = liWidth * liLen;
	$('.view ul').css('width',totalLen);
	$(window).resize(function(){
		liWidth = $('.view ul li').outerWidth(true);
		totalLen = liWidth * liLen;
		viewWidth = $('.view').outerWidth(true);
		$('.view ul').css('width',totalLen);
	});		
	// 左键点击
	$('.pro_prev').click(function(){
		if(!$('.view ul').is(':animated')){
			var oldMl = parseFloat($('.view ul').css('margin-left'));			
			$(window).resize(function(){
				$('.view ul').css('margin-left','-10px');
				oldMl = parseFloat($('.view ul').css('margin-left'));
			});
			var newMl = oldMl - liWidth;
			if(Math.abs(oldMl) + viewWidth < totalLen){
				$('.view ul').animate({
					'margin-left':newMl
				},300);
			};
		};			
	});
	// 右键点击
	$('.pro_next').click(function(){
		if(!$('.view ul').is(':animated')){
			var oldMl = parseFloat($('.view ul').css('margin-left'));			
			$(window).resize(function(){
				oldMl = parseFloat($('.view ul').css('margin-left'));
			});
			var newMl = oldMl + liWidth;
			if(newMl < 0){
				$('.view ul').animate({
					'margin-left':newMl
				},300);
			};
		};
	});
	// 小屏幕自动轮播功能
	// $(window).resize(function(){
	// 	liWidth = $('.view ul li').outerWidth(true);
	// });
	// if(liWidth == 34){
	// 	var index = 0;
	// 	var liLen = $('.view ul li').length;
	// 	var maxLen = liLen - 1;
	// 	timer = setInterval(function(){
	// 		++index;
	// 		if(index > maxLen){
	// 			index = 0;
	// 		};
	// 		$('.view ul li').eq(index).addClass('cur').siblings().removeClass('cur');
	// 		var smImg = $('.view ul li.cur').children('img').prop('src');
	// 		$('.album>img').prop('src',smImg);
	// 	},2000);
	// };
});