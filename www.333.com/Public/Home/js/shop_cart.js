$(function(){
	// 全选的实现	
	$('.shop-cart-title label input').click(function(){
		var state = $(this).prop('checked');
		if (state){
			$(this).parent('label').css('background','url(images/checked_box.jpg) no-repeat');
			// 单个checkbox图标的改变
			$('.shop-cart label input').prop('checked',true);
			$(this).parents().find('label').css('background','url(images/checked_box.jpg) no-repeat');	
		}else{
			$(this).parent('label').css('background','url(images/check_box.jpg) no-repeat');
			// 单个checkbox图标的改变
			$('.shop-cart label input').prop('checked',false);
			$(this).parents().find('label').css('background','url(images/check_box.jpg) no-repeat');
		}
		// 已选商品数量
		countNum();
		// 求总价
		countPrice();
	});
	// 单选的实现及全选
	$('.shop-cart label input').click(function(){
		var state = $(this).prop('checked');
		var totalLen = $('.shop-cart label input').length;
		var checkedLen = $('.shop-cart label input:checked').length;	
		// 单个checkbox图标的改变
		if(state){
			$(this).parent('label').css('background','url(images/checked_box.jpg) no-repeat');
		}else{
			$(this).parent('label').css('background','url(images/check_box.jpg) no-repeat');
		};
		// 单个checkbox图标改变全选
		if(checkedLen==totalLen){
			$('.shop-cart-title label input').prop('checked',true);
			$('.shop-cart-title label').css('background','url(images/checked_box.jpg) no-repeat');
		}else{
			$('.shop-cart-title label input').prop('checked',false);
			$('.shop-cart-title label').css('background','url(images/check_box.jpg) no-repeat');
		};
		// 已选商品数量
		countNum();
		// 求总价
		countPrice();
	});
	// 数量的加减
	// 减法
	$('.text .num .sub').click(function(){
		var number = $(this).siblings('input').val();
		if(number>1){
			number = number - 1;
			$(this).siblings('input').prop('value',number);
		}
		// 小计
		var unitPrice = $(this).parents('.shop-cart').children().siblings('.subPrice').find('.unitPrice').text();
		unitPrice = parseFloat(unitPrice.substring(1,7));
		subtotal = '￥'+(unitPrice * number).toFixed(2);
		$(this).parents('.shop-cart').children().siblings().find('.subtotal').text(subtotal);
		// 已选商品数量
		countNum();
		// 求总价
		countPrice();	
	});
	// 加法
	$('.text .num .add').click(function(){
		var number = $(this).siblings('input').prop('value');
		number = + number + 1;
		$(this).siblings('input').prop('value',number);
		// 小计
		var unitPrice = $(this).parents('.shop-cart').children().siblings('.subPrice').find('.unitPrice').text();
		unitPrice = parseFloat(unitPrice.substring(1,7));
		subtotal = '￥'+(unitPrice * number).toFixed(2);
		$(this).parents('.shop-cart').children().siblings().find('.subtotal').text(subtotal);
		// 已选商品数量
		countNum();
		// 求总价
		countPrice();
	});
	// 自动输入数量
	$('.num input').keyup(function(evt){
		var val = $(this).val();
		if(evt.keyCode == 8){
			return false;
		};
		if(isNaN(val)){
			$(this).val(1);
		}else{
			$(this).val(val<1?1:val);
		};
		// 小计
		var number = $(this).val();
		var unitPrice = $(this).parents('.shop-cart').children().siblings('.subPrice').find('.unitPrice').text();
		unitPrice = parseFloat(unitPrice.substring(1,7));
		subtotal = '￥'+(unitPrice * number).toFixed(2);
		$(this).parents('.shop-cart').children().siblings().find('.subtotal').text(subtotal);
		// 已选商品数量
		countNum();
		// 求总价
		countPrice();
	});
	// value=''时,失去焦点
	$('.num input').blur(function(){
		var val = $(this).val();
		if(val == ''){
			$(this).val(1);
		}else{
			$(this).val(Math.ceil(val));
		};
	});
	// 总价
	function countPrice(){
		var totalPrice = 0.00;
		var checkedObj = $('.shop-cart label input:checked');
		checkedObj.each(function(i){
			var checkedText = $(this).parents('.select-box').siblings().find('.subtotal').text();
			checkedText = parseFloat(checkedText.substring(1,7));
			totalPrice = (+ totalPrice + checkedText);
		});	
		$('.shop-foot p .totalPrice').text(totalPrice.toFixed(2));
	};
	// 计算商品总数
	function countNum(){
		var checkedObj = $('.shop-cart label input:checked');
		var checkedLen = $('.shop-cart label input:checked').length;
		var totalNum = 0;
		if(checkedLen == 0){
			$('.shop-foot p .numTotal').text('0');
			$('.shop-foot p .totalPrice').text('0.00');
		};
		checkedObj.each(function(i){
			var num = $(this).parents('.select-box').siblings().find('input').val();
			num = parseFloat(num);
			totalNum = + totalNum + num;
			$('.shop-foot p .numTotal').text(totalNum);
		});
	};
	// 删除功能	
	$('.delete').click(function(){
		if(confirm('是否删除')){
			$(this).parents('.shop-cart').remove();
			// 已选商品数量
			var checkedLen = $('.shop-cart .select-box label input:checked').length;
			var totalLen = $('.shop-cart label input').length;
		
			// 单个checkbox图标改变全选
			if(checkedLen==totalLen){
				$('.shop-cart-title label input').prop('checked',true);
				$('.shop-cart-title label').css('background','url(images/checked_box.jpg) no-repeat');
			}else{
				$('.shop-cart-title label input').prop('checked',false);
				$('.shop-cart-title label').css('background','url(images/check_box.jpg) no-repeat');
			};
			// 已选商品数量
			countNum();
			// 求总价
			countPrice();
			//滚动条
			var len = $(".shop-cart").length;
			if(len < 3){
				$(".mCSB_scrollTools").css("display",'none');
				$(".shop-box").css('height',len*212+(len-1)*30+'px');
				$(".mCSB_container").css('top',0);
			}	
		}
	});
	// 小屏幕
	// 单选样式的改变
	$('ol li label input').click(function(){
		var state = $(this).prop('checked');
		if(state){
			$(this).parent().css('background','url(images/checked_box.jpg) no-repeat');
		}else{
			$(this).parent().css('background','url(images/check_box.jpg) no-repeat');
		}
		// 选中数量
		totalNum();
		// 总价
		total();
	});
	$('ol li .sub').click(function(){
		totalNum();
		total();
	});
	$('ol li .add').click(function(){
		totalNum();
		total();
	});
	// 计算总价
	function total(){
		var checkedObj = $('ol li label input:checked');
		var totalPrice = 0.00;
		checkedObj.each(function(i){
			var unitPrice = $(this).parents('.pro-img').siblings().find('.unitPrice').text();
			var number = $(this).parents('.pro-img').siblings().find('input').val();
			unitPrice = parseFloat(unitPrice.substring(1,7));
			number = parseFloat(number);
			totalPrice = totalPrice + (unitPrice * number);
			$('.shop-foot p .totalPrice').text(totalPrice.toFixed(2));
		});
	}
	// 计算商品总数
	function totalNum(){
		var checkedObj = $('ol li label input:checked');
		var checkedLen = $('ol li label input:checked').length;
		var totalNum = 0;
		if(checkedLen == 0){
			$('.shop-foot p .numTotal').text('0');
			$('.shop-foot p .totalPrice').text('0.00');
		};
		checkedObj.each(function(i){
			var num = $(this).parents('li').siblings().find('input').val();
			num = parseFloat(num);
			totalNum = + totalNum + num;
			$('.shop-foot p .numTotal').text(totalNum);
		});
	}
	//滚动条
	var len = $(".shop-cart").length;
	if(len >= 3){
		$(".shop-box").mCustomScrollbar();
	}
}); 


