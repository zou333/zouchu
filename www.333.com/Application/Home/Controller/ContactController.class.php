<?php
namespace Home\Controller;
// 联系我们
class ContactController extends \Think\Controller{
	
	public function contact(){
		
		// 标题
		$title = '联系我们';
		$this->assign('title',$title);
		
		// 查询联系我们
		$contact = M('contact')->order('id desc')->limit('1,1')->find();
		// 分配变量到视图
		$this->assign('contact',$contact);
		
		// 查询品牌
		$brand = M('brand')->order('id desc')->limit('1,1')->find();
		// 分配变量到视图
		$this->assign('brand',$brand);
		
		// 加载视图
		$this->display();
	}
	
	// 地图
	public function map(){
		// 加载视图
		$this->display('map');
	}
	
	// 留言添加
	public function add(){
		 
		// 判断是否是ajax请求
		if(IS_AJAX){
			
			$validate=[
				['name','require','姓名不能为空'],
				['phone','require','电话号码不能为空'],
				['content','require','内容不能为空'],
				['code','require','验证码不能为空'],
			];
			
			$_POST['create_time']=time();
			
			// 验证并接收数据
			$res = M('message')->validate($validate)->create();
			if($res===false){
				return $this->error(M('message')->getError());
			}
			
			// 判断验证码是否正确
			$verify = new \Think\Verify;
			if(! $verify->check(I('post.code'))){
				return $this->error('验证码不正确');
			}
			
			// 添加留言
			$id = M('message')->add();
			
			if(empty($id)){
				die('留言失败');
			}
			die('true');
			
			
		} 
		
	}
	
	// 验证码
	public function verify(){
		
		// 实例化验证码类
		$verify = new \Think\Verify();
		
		$verify->imageW = 130;
		$verify->imageH = 40;
		$verify->length = 1;
		
		// 输出验证码并把验证码的值保存的session中
		$verify->entry();
	}
}