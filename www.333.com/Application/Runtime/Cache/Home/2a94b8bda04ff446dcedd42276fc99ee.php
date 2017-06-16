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
	
 <script type="text/javascript" src='/Public/Home/js/index.js'></script>
<!-- sm-banner开始 -->
	<div id="sm-banner">
		<ul>
			<li class="cur"><a href="pro_details.html"><img src="/Public/Home/images/sm_banner1.jpg" alt="" title=""></a></li>
			<li><a href="pro_details.html"><img src="/Public/Home/images/sm_banner2.jpg" alt="" title=""></a></li>
			<li><a href="pro_details.html"><img src="/Public/Home/images/sm_banner3.jpg" alt="" title=""></a></li>
		</ul>
		<ol>
			<li class="cur"></li>
			<li></li>
			<li></li>
		</ol>
	</div>
	<!-- sm-banner结束 -->


	<div class="main-top">
		<!-- header开始 -->
		<div class='header hidden-xs'>
			<div class='container'>
				<div class='row'>
					<div class='col-sm-2 col-md-2 col-lg-2'>
						<a href="index.html"><img class="logo" src="/Public/Home/images/logo.png" alt='logo加载失败' title=""></a>
					</div>
					<div class='col-sm-10 col-md-10 col-lg-10'>
						<div class='login'>
							<a href="login.html">登录</a>
							<span>/</span>
							<a href="register.html">注册</a>
							<form>
								<input type="text" name="">
								<button type="submit"><img src="/Public/Home/images/search.png" title="" alt=""></button>
							</form>
							<a href="shop_cart.html"><img src="/Public/Home/images/shopping.png" alt="" title="">购物车</a>
						</div>
						<div class='nav'>
							<ul class="nav-pills">
								<li class="current"><a href="index.html" class="home">首页</a></li>
								<li><a href="about_us.html">品牌介绍</a></li>
								<li><a href="product.html">产品中心</a></li>
								<li><a href="news.html">新闻中心</a></li>
								<li><a href="user.html">会员中心</a></li>
								<li><a href="contact_us.html">联系我们</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- header结束 -->

		<!-- banner开始 -->
		<div id="banner" class="hidden-xs">
			<ul>
				<li class="cur"><a href="pro_details.html"><img src="/Public/Home/images/pc_banner1.jpg" alt="" title=""></a></li>
				<li><a href="pro_details.html"><img src="/Public/Home/images/pc_banner2.jpg" alt="" title=""></a></li>
				<li><a href="pro_details.html"><img src="/Public/Home/images/pc_banner3.jpg" alt="" title=""></a></li>
			</ul>
			<ol>
				<li class="cur"></li>
				<li></li>
				<li></li>
			</ol>
		</div>
		<!-- banner结束 -->
	</div>
	

	<!-- main开始 -->
	<div class="main">
		<!-- 产品左右滚动开始 -->
		<div class='pro-show'>
			<a class='prev' href="javascript:;"></a>
			<div class="view">
				<ul>
					<li>
						<a href="pro_details.html">
							<img src="/Public/Home/images/index_product1.jpg" alt="" title="">
						</a>
					</li>
					<li>
						<a href="pro_details.html">
							<img src="/Public/Home/images/index_product2.jpg" alt="" title="">
						</a>
					</li>
					<li>
						<a href="pro_details.html">
							<img src="/Public/Home/images/index_product3.jpg" alt="" title="">
						</a>
					</li>
					<li>
						<a href="pro_details.html">
							<img src="/Public/Home/images/index_product4.jpg" alt="" title="">
						</a>
					</li>
					<li>
						<a href="pro_details.html">
							<img src="/Public/Home/images/index_product1.jpg" alt="" title="">
						</a>
					</li>
					<li>
						<a href="pro_details.html">
							<img src="/Public/Home/images/index_product2.jpg" alt="" title="">
						</a>
					</li>
					<li>
						<a href="pro_details.html">
							<img src="/Public/Home/images/index_product3.jpg" alt="" title="">
						</a>
					</li>
					<li>
						<a href="pro_details.html">
							<img src="/Public/Home/images/index_product4.jpg" alt="" title="">
						</a>
					</li>
				</ul>
			</div>
			<a class='next' href="javascript:;"></a>
		</div>
		<!-- 产品左右滚动结束 -->
	</div>	
	<!-- main结束 -->

	<!-- sm-main开始 -->
	<div class="sm-main">
		<!-- sm-nav开始 -->
		<div class="sm-nav container">
			<ul>
				<li><a href="about_us.html"><img src="/Public/Home/images/sm_index1.png" alt="" title="" class="center-block">公司介绍</a></li>
				<li><a href="news.html"><img src="/Public/Home/images/sm_index2.png" alt="" title="" class="center-block">新闻中心</a></li>
				<li><a href="product.html"><img src="/Public/Home/images/sm_index3.png" alt="" title="" class="center-block">产品中心</a></li>
				<li><a href="contact_us.html"><img src="/Public/Home/images/sm_index4.png" alt="" title="" class="center-block">联系我们</a></li>
			</ul>			
		</div>
		<!-- sm-nav结束 -->

		<!-- sm-index-product开始 -->
		<div class="container sm-index-product">
			<ul>
				<li><a href="pro_details.html"><img src="/Public/Home/images/sm-index-product1.jpg" alt="" title=""><span class="pro-text01">连衣裙<span>GO!</span></span></a></li>
				<li><a href="pro_details.html"><img src="/Public/Home/images/sm-index-product2.jpg" alt="" title=""><span class="pro-text02">外套<span>GO!</span></span></a></li>
				<li><a href="pro_details.html"><img src="/Public/Home/images/sm-index-product3.jpg" alt="" title=""><span class="pro-text03">套装<span>GO!</span></span></a></li>
				<li><a href="pro_details.html"><img src="/Public/Home/images/sm-index-product4.jpg" alt="" title=""><span class="pro-text04">针织衫<span>GO!</span></span></a></li>
			</ul> 
		</div>
		<!-- sm-index-product结束 -->
	</div>
	<!-- sm-main结束 -->
<!-- footer开始 -->
	<div class="footer">
		<p>OPYRIGHT ©2016 CHING MUKALL RIGHTS RESERVED</p>
		<p>粤ICP备14063069号</p>
	</div>
	<!-- footer结束 -->


</body>
</html>