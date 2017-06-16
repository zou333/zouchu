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
	
 
<link rel="stylesheet" type="text/css" href="/Public/Home/css/pro_details.css">
<link rel="stylesheet" type="text/css" href="/Public/Home/css/jquery.mCustomScrollbar.css">
<script type="text/javascript" src='/Public/Home/js/pro_details.js'></script>
<script src="/Public/Home/js/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- main开始 -->
	<div class="main">
		<div class="container">
			<p>当前位置：<a href="index.html">首页</a>><a href="product.html.html">产品中心</a>><span>产品详情</span></p>
			<div class="content">
				<!-- 副导航开始 -->
				<div class="subnav">
				<?php if(is_array($cate)): foreach($cate as $key=>$value): ?><a href="<?php echo U('Goods/pro_details',['cid'=>$value['id']]);?>" <?php if(($value['id']) == $_GET['cid']): ?>class='selected'<?php endif; ?> ><?php echo ($value['cate_name']); ?></a><?php endforeach; endif; ?>
				</div>
				<!-- 副导航结束 -->

				<!-- tab选项卡开始 -->
				<div class="tab">
					<div class="row">
						<div class="col-sm-12 col-md-5 col-lg-6">
							<div class="album">
								<img src="/Public/Home/images/pro_big_album01.jpg" alt="" title="">
								<div class="album_show">
									<span class="pro_prev"><img src="/Public/Home/images/pro_prev.png" alt="" title=""></span>
										<div class="view">
											<ul>
												<li class="cur"><img src="/Public/Home/images/pro_album01.jpg" alt="" title=""></li>
												<li><img src="/Public/Home/images/pro_album02.jpg" alt="" title=""></li>
												<li><img src="/Public/Home/images/pro_album03.jpg" alt="" title=""></li>
												<li><img src="/Public/Home/images/pro_album01.jpg" alt="" title=""></li>
												<li><img src="/Public/Home/images/pro_album02.jpg" alt="" title=""></li>
												<li><img src="/Public/Home/images/pro_album03.jpg" alt="" title=""></li>
											</ul>
										</div>
									<span class="pro_next"><img src="/Public/Home/images/pro_next.png" alt="" title=""></span>	
								</div>								
							</div>
						</div>
						<div class="col-sm-12 col-md-7 col-lg-6">
							<div class="pro_info">
								<h2><?php echo ($goods['brand']['brand_name']); echo ($goods['goods_name']); echo ($goods['category']['cate_name']); ?></h2>
								<div class="pro_text">
									<div class="price">
										价格:  
										<span>￥<?php echo ($goods['shop_price']); ?></span>
									</div>
									<div class="size">
										尺码:  
										<span class="selected">S</span>
										<span>M</span><span>L</span>
									</div>
									<div class="color">
										颜色:  
										<span class="selected">黑格</span>
										<span>灰色</span>
									</div>
									<div class="number">
										数量:  
										<a href="javascript:;" class="sub">-</a>
										<input type="" name="" value="1">
										<a href="javascript:;" class="add">+</a>
									</div>
									<div class="link">
										<a href="comfirm_order.html">立即购买</a>
										<a href="shop_cart.html">加入购物车</a>
									</div>
									<div class="service">
										<span class="label">服务保证:  </span>
										<p>
											<span><i class="quality"></i>正品保证</span>
											<span><i class="on_time"></i>按时发货</span>
											<span><i class="seven_day"></i>7天无理由</span>
										<p>
									</div>
									<div class="price">
										价格:  
										<span>￥598.00</span>
									</div>
									<div class="size">
										尺码:  
										<span class="selected">S</span>
										<span>M</span><span>L</span>
									</div>
									<div class="color">
										颜色:  
										<span class="selected">黑格</span>
										<span>灰色</span>
									</div>
									<div class="number">
										数量:  
										<a href="javascript:;" class="sub">-</a>
										<input type="" name="" value="1">
										<a href="javascript:;" class="add">+</a>
									</div>
									<div class="link">
										<a href="comfirm_order.html">立即购买</a>
										<a href="shop_cart.html">加入购物车</a>
									</div>
									<div class="service">
										<span class="label">服务保证:  </span>
										<p>
											<span><i class="quality"></i>正品保证</span>
											<span><i class="on_time"></i>按时发货</span>
											<span><i class="seven_day"></i>7天无理由</span>
										<p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- tab选项卡结束 -->	
			</div>
		</div>
	</div>
	<!-- main结束 -->

<!-- footer开始 -->
	<div class="footer">
		<p>OPYRIGHT ©2016 CHING MUKALL RIGHTS RESERVED</p>
		<p>粤ICP备14063069号</p>
	</div>
	<!-- footer结束 -->


</body>
</html>