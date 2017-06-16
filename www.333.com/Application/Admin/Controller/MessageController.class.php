<?php
namespace Admin\Controller;

class MessageController extends BaseController{
	
	public function index(){
		
		// 查询留言
		$message = M('message')->select();
		$this->assign('list',$message);
		
		// 加载视图
		$this->display();
	}
	
	public function delete(){
		
		// 判断是否有传递参数
		if(empty(I('get.id'))){
			return $this->error('非法操作');
		}
		
		// 删除数据
		$row = M('message')->delete(I('get.id'));
		if(empty($row)){
			return $this->error('删除失败');
		}
		return $this->success('删除成功',U('index'));
	}
}