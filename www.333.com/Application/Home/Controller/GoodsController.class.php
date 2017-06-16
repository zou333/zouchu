<?php
namespace Home\Controller;
use Think\Controller;

class GoodsController extends \Think\Controller {
	
	public function product(){
		
		// 标题
		$title = '产品中心';
		$this->assign('title',$title);
		
		$total=M('goods')->count();
		$showpage=3;
		// 实例化page类
		$page= new \Think\Page($total,$showpage);
		
		$this->assign('page',$page->show());
		
		
		// 查找商品
		$goods = D('Goods')->relation(true)->page(I('p',1),$showpage)->select();
		$this->assign('goods',$goods);
		// print_r($goods);
		
		// 查找分类
		$cate = M('category')->where(['parent_id'=>'0'])->select();
		
		$this->assign('cate',$cate);
		// dump($cate);
		
		// 加载视图
		$this->display();
	}
	
	public function pro_details(){
		
		// 标题
		$title = '产品详情';
		$this->assign('title',$title);
		
		// 查找商品和商品详情
		$goods = D('Goods')->where(['id'=>I('get.id')])->relation(true)->find();
		$this->assign('goods',$goods);
		print_r($goods);
		
		// 查找分类
		$cate = M('category')->where(['parent_id'=>'0'])->select();
		$this->assign('cate',$cate);
		
		
		// 加载视图
		$this->display();
	}
}