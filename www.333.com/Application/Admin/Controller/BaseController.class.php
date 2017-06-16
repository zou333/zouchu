<?php
namespace Admin\Controller;

// 基本控制器
class BaseController extends \Think\Controller{
	
	public function _initialize(){
		$this->checkLogin();
	}
	
	public function checkLogin(){
		if(! session('?admin')){
			return $this->error('请登录',U('Login/index'));
		}
	}
} 
