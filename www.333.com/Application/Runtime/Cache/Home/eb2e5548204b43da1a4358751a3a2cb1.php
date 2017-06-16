<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo ($title); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="/Public/Home/libs/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/common.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css">
	<script type="text/javascript" src="/Public/Home/js/jquery.js"></script>
	<script type="text/javascript" src="/Public/Home/libs/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src='/Public/Home/js/hammer.min.js'></script>
</head>
<body>
<?php switch($title): case "商城首页": ?><!-- sm-header开始 -->
	<div class="sm-header visible-xs">
		<div class="container">
			<div class="col-xs-3 sm-logo"><a href="index.html"></a></div>
			<div class="col-xs-8 sm-search">
				<form class="center-block">
					<input type="text" name="" value="请输入关键词" onfocus="if (this.value=='请输入关键词') value=''" onblur="if (this.value=='') value='请输入关键词'"/>
					<button type="submit">搜索</button>
				</form>5
			</div>
			<div class="col-xs-1 sm-navbar">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#sm-subnav" aria-expanded="true" id='navOp'>  
			            <span class="sr-only">Toggle navigation</span>  
			            <span class="icon-bar"></span>  
			            <span class="icon-bar"></span>  
			            <span class="icon-bar"></span>  
		          </button>
				<ul id="sm-subnav" class="collapse">
				    <li><a href="/">首页</a></li>
					<li><a href="about_us.html">品牌介绍</a></li>
					<li><a href="<?php echo U('Goods/index');?>">产品中心</a></li>
					<li><a href="news.html">新闻中心</a></li>
					<li><a href="user.html">会员中心</a></li>
					<li><a href="contact_us.html">联系我们</a></li>
		    		<li><a href="login.html">登录/注册</a></li>
				    <li><a href="shop_cart.html">购物车</a></li>
				</ul> 
			</div>
		</div>
	</div>
	<!-- sm-header结束 --><?php break;?>
	<?php default: ?>
	<!-- header开始 -->
	<div class='header hidden-xs'>
		<div class='container'>
			<div class='row'>
				<div class='col-sm-2 col-md-2 col-lg-2'>
					<a href="/Public/Home/index.html"><img class="logo" src="/Public/Home/images/logo.png" alt='logo加载失败' title=""></a>
				</div>
				<div class='col-sm-10 col-md-10 col-lg-10'>
					<div class='login'>
						<a href="/Public/Home/login.html">登录</a>
						<span>/</span>
						<a href="/Public/Home/register.html">注册</a>
						<form>
							<input type="text" name="">
							<button type="submit"><img src="/Public/Home/images/search.png" title="" alt=""></button>
						</form>
						<a href="/Public/Home/shop_cart.html"><img src="/Public/Home/images/shopping.png" alt="" title="">购物车</a>
					</div>
					<div class='nav'>
						<ul class="nav-pills">
							<li><a href="/Public/Home/index.html" class="home">首页</a></li>
							<li><a href="/Public/Home/about_us.html">品牌介绍</a></li>
							<li class="current"><a href="/Public/Home/product.html">产品中心</a></li>
							<li><a href="/Public/Home/news.html">新闻中心</a></li>
							<li><a href="/Public/Home/user.html">会员中心</a></li>
							<li><a href="/Public/Home/contact_us.html">联系我们</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- header结束 --><?php endswitch;?>
	
 <link rel="stylesheet" type="text/css" href="/Public/Home/css/contact_us.css">
<script type="text/javascript" src='/Public/Home/js/contact_us.js'></script>
<!-- main开始 -->
<div class="main">
	<div class="container">
		<h2>联系我们</h2>
		<h3>Contact us</h3>
		<p>当前位置：<a href="index.html">首页</a>><span>联系我们</span></p>
		<div class="content">
			<div class="map">
				<iframe src="<?php echo U('Contact/map');?>" frameborder="0" scrolling="no"></iframe>
			</div>
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-6 information">
					<p><span>网址：<?php echo ($contact['http']); ?></span><span>电话：<?php echo ($contact['phone']); ?></span></p>
					<p><span>QQ：<?php echo ($contact['qq']); ?></span><span>邮箱：<?php echo ($contact['email']); ?></span></p>
					<p>地址：<?php echo ($contact['address']); ?></p>
					<ul class="hidden-xs">
						<li>
							<span><?php echo ($brand['brand_name']); ?>官方微信</span>
							<i class="official-code"></i>
						</li>
						<li>
							<span>客服微信</span>
							<i class="custom-service-code"></i>
						</li>
					</ul>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 message">
					<form method="post" action="">
						<label>
							<input class="name" type="text" name="name" value="请输入您的姓名" onfocus="if (this.value=='请输入您的姓名') value=''" onblur="if (this.value=='') value='请输入您的姓名'" id="username" data-toggle="popover" data-placement="bottom" >
							<input class="phone" type="text" name="phone" value="请输入您的手机" onfocus="if (this.value=='请输入您的手机') value=''" onblur="if (this.value=='') value='请输入您的手机'" id="phone" data-toggle="popover" data-placement="bottom" >
						</label>
						<label>
							<textarea id="message" name="content" data-toggle="popover" data-placement="bottom" >请输入您想对我们说的话...</textarea>
						</label>
						<label>
							<input class="validatebox" type="text" name="code" maxlength="5" value="请输入验证码" onfocus="if (this.value=='请输入验证码') value=''" onblur="if (this.value=='') value='请输入验证码'" id="verify" data-toggle="popover" data-placement="top" >
							<span class="id-code"><img src="<?php echo U('Contact/verify');?>" onclick="this.src=this.src+'?'"/></span>
						</label>
						<label>
							<button type="button" onclick="sub(this)">提交</button>
							<button type="reset">重置</button>
						</label>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- main结束 -->
<script>
function sub(o){
	var name=$('input[name="name"]').val();
	var phone=$('input[name="phone"]').val();
	var content=$('textarea[name="content"]').val();
	var code=$('input[name="code"]').val();
	
	if(name=="请输入您的姓名" || phone=="请输入您的手机" || code=="请输入验证码" || content=="请输入您想对我们说的话..."){
		
		alert('姓名or电话号码or验证码or内容不能为空');
		return false; 
	}
	
	$.ajax({
		type:'post',
		url:'<?php echo U("Contact/add");?>',
		data:{
			name:name,
			phone:phone,
			content:content,
			code:code,
		},
		dataType:'text',
		success:function(data){
			if(data!='true'){
				alert(data);
			}else{
				alert('留言成功');
				window.location.href=<?php echo U('Contact/contact');?>;
			}
		},
		error:function(e){
			alert('网络异常');
		}
	});
}


</script>

<!-- footer开始 -->
	<div class="footer">
		<p>OPYRIGHT ©2016 CHING MUKALL RIGHTS RESERVED</p>
		<p>粤ICP备14063069号</p>
	</div>
	<!-- footer结束 -->


</body>
</html>