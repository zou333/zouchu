$(function(){
	// 首页banner图轮播
	var liObj = $('#banner ul li');
	var circleObj = $('#banner ol li');
	var liLen = liObj.length;
	var maxLen = liLen - 1;
	var index = 0;
	// banner图的自动播放函数调用
	auto();
	// banner图的鼠标悬停事件
	liObj.hover(function(){
		clearInterval(timer);
	},function(){
		auto();
	});
	// 小圆点的鼠标经过时间
	circleObj.each(function(i){
		circleObj.eq(i).mouseover(function(){
			index = i;
			imgShow();
			clearInterval(timer);
		});
	});
	// banner的自动播放函数
	function auto(){
		timer = setInterval(function(){
			++index;
			if (index > maxLen) {
				index = 0;
			}
			imgShow();
		},3000);
	};
	// banner图片的自动播放函数
	function imgShow(){
		liObj.eq(index).addClass('cur').siblings().removeClass('cur');
		circleObj.eq(index).addClass('cur').siblings().removeClass('cur');
	};
	// 小屏幕banner自动轮播
	var imgObj = $('#sm-banner ul li');
	var ringObj = $('#sm-banner ol li');
	var imgLen = imgObj.length;
	var maxLen = imgLen - 1;
	var num = 0;
	smAuto();
	// 小屏幕banner图片左右滑动
	$('#sm-banner ul li').each(function(i){
		var smLi = new Hammer($('#sm-banner ul li')[i]);
		smLi.on('swipeleft',function(ev){
			num = num + 1;
			if(num > maxLen){
				num = 0;
			};
			smShow();
		});
		smLi.on('swiperight',function(ev){
			num = num - 1;
			if(num < 0){
				num = maxLen;
			};
			smShow();
		});
		$(this)[0].addEventListener("touchstart", function(ev) {
			clearInterval(smTimer);
		});
		$(this)[0].addEventListener("touchend", function(ev) {
			smAuto();
		});
	});
	// 小屏幕banner的自动播放函数
	function smAuto(){
		smTimer = setInterval(function(){
			++num;
			if (num > maxLen) {
				num = 0;
			}
			smShow();
		},1000);
	};
	// 小屏幕banner图片的自动播放函数
	function smShow(){
		imgObj.eq(num).addClass('cur').siblings().removeClass('cur');
		ringObj.eq(num).addClass('cur').siblings().removeClass('cur');
	};

	// 首页产品图片点击移动效果
	var liWidth = $('.view ul li').outerWidth(true);
	var liLen = $('.view ul li').length;
	var totalLen = liWidth * liLen;
	var viewWidth = $('.view').outerWidth(true);
	$(window).resize(function() {
	  viewWidth = $('.view').outerWidth(true);
	});
	$('.view ul').css('width',totalLen);
	// 左键点击
	$('.prev').click(function(){
		if(!$('.view ul').is(':animated')){
			var oldMl = parseFloat($('.view ul').css('margin-left'));
			var newMl = oldMl - liWidth;
			if(Math.abs(oldMl) + viewWidth < totalLen){
				$('.view ul').animate({
					'margin-left':newMl
				},300);
			};
		};			
	});
	// 右键点击
	$('.next').click(function(){
		if(!$('.view ul').is(':animated')){
			var oldMl = parseFloat($('.view ul').css('margin-left'));
			var newMl = oldMl + liWidth;
			if(newMl <= 0){
				$('.view ul').animate({
					'margin-left':newMl
				},300);
			};
		};
	});
});