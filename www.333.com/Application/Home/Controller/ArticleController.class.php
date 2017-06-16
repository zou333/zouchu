<?php
namespace Home\Controller;

// 新闻
class ArticleController extends \Think\Controller{
	
	public function news(){
		
		$title='新闻中心';
		$this->assign('title',$title);
		
		$total = M('news')->count();
		$showpage=1;
		// 实例化分页类
		$page = new \Think\Page($total,$showpage);
		$this->assign('page',$page->show());
		
		// 查询新闻
		$news = M('news')->order('id desc')->page(I('p',1),$showpage)->select();
		$this->assign('news',$news);
		
		// 加载视图
		$this->display();
	}
}