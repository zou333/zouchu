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
	
 
<link rel="stylesheet" type="text/css" href="/Public/Home/css/news.css">
<!-- main开始 -->
	<div class="main">
		<div class="container">
			<h2>新闻中心</h2>
			<h3>News center</h3>
			<p>当前位置：<a href="index.html">首页</a>><span>新闻中心</span></p>
			<div class="content">
				<ul>
				<?php if(is_array($news)): foreach($news as $key=>$value): ?><li class="row">
						<div class="col-md-4 col-lg-4 con-image"><a href="news_details.html"></a></div>
						<div class="col-md-8 col-lg-8 con-text">
							<h4><a href="news_details.html"><?php echo mb_substr($value['news_name'],0,20,"utf-8");?></a></h4>
							<p><?php echo strip_tags($value['content']);?></p>
							<span><?php echo date('Y-m-d',$value['create_time']);?></span>
							<a href="news_details.html">查看详情>></a>
						</div>
					</li><?php endforeach; endif; ?>
				</ul>
				<div aria-label="Page navigation" class='page'>
				    <?php echo ($page); ?>
				    </ul>
				</div>
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