<?php
namespace Admin\Controller;

// 登录
class LoginController extends \Think\Controller{
	
	public function index(){
		
		// IS_POST   判断是否是post请求
		// IS_GET   判断是否是get请求
		// IS_DELETE   判断是否是delete请求
		// IS_PUT   判断是否是put请求
		// REQUEST_METHOD   当前提交请求
		
		// 判断是否有提交数据
		if(IS_POST){
			
			// 接收数据
			$user_name = I('post.user_name');
			$password = I('post.password');
			$code = I('post.code');
			
			// 判断提交用户名是否为空
			if(empty($user_name)){
				return $this->error('用户名不能为空');
			}
			
			// 判断提交密码是否为空
			if(empty($password)){
				return $this->error('密码不能为空');
			}
			
			// 判断提交验证码是否为空
			if(empty($code)){
				return $this->error('验证码不能为空');
			}
			
			
			// 校验验证码是否正确
			//实例化
			$verify = new \Think\Verify;
			if(! $verify->check($code)){
				return $this->error('验证码不正确');
			}
			
			//查询用户信息
			$user = M('admin')->where(['user_name'=>$user_name])->find();
			
			// 判断用户名是否存在
			if(empty($user)){
				return $this->error('用户名不存在');
			}
			
			// 判断密码是否正确
			if(md5($password) !== $user['password']){
				return $this->error('密码不正确');
			}
			
			//unset密码
			unset($user['password']);
			
			
			// 保存登录状态
			session('admin',$user);
			
			// 跳转页面
			return $this->success('登录成功',U('/Admin/Index/index'));
		}
		
		// 加载视图
		$this->display();
		
	}
	// 验证码
	public function verify(){
		
		// 实例化Verify类
		$verify = new \Think\Verify;
		
		$verify->imageW = 100;
		$verify->imageH = 43;
		$verify->length = 1;
		
		$verify->entry();
	}
	
	public function logout(){
		
		// unset 删除session
		session('admin',null);
		return $this->success('成功退出登录',U('Login/index'));
	}
	
	
}