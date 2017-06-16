<?php
namespace Admin\Controller;

class ContactController extends BaseController{
	
	public function index(){
		
		$map=[];
		// 搜索
		if(!empty(I('keywords'))){
			$keywords=I('keywords');
			$map['address']=['like',"%{$keywords}%"];
		}
		
		// 分页
		$total=M('contact')->where($map)->count();
		$showpage=2;
		// 实例化page
		$page = new \Think\Page($total,$showpage);
		$this->assign('page',$page->show());
		
		// 查询数据
		$contact = M('contact')->where($map)->page(I('p',1),$showpage)->select();
		$this->assign('list',$contact);
		
		// 加载视图
		$this->display();
	}
	public function add(){
		
		// 判断是否有提交数据
		if(IS_POST){
			
			// 验证规则
			$validate=[
				['address','require','地址不能为空'],
				['phone','require','电话不能为空'],
				['phone','8,11','电话号码只能8-11位',1,'length'],
				['email','require','邮箱不能为空'],
				['http','require','网址不能为空'],
				['qq','require','QQ不能为空'],
				['qq','6,15','QQ号只能6-15位',1,'length'],
			];
			
			// 验证并接收数据
			$res = M('contact')->validate($validate)->create();
			// 判断验证是否通过
			if($res===false){
				return $this->error(M('contact')->getError());
			}
			
			// 添加数据
			$id = M('contact')->add();
			if(empty($id)){
				return $this->error('添加失败');
			}
			return $this->success('添加成功',U('index'));
		}
		
		// 加载视图
		$this->display();
	}
	
	public function edit(){
		
		// 判断是否有传递id
		if(empty(I('get.id'))){
			return $this->error('非法操作');
		}
		
		// 判断是否有提交数据
		if(IS_POST){
			
			// 验证规则
			$validate=[
				['address','require','地址不能为空'],
				['phone','require','电话不能为空'],
				['phone','8,11','电话号码只能8-11位',1,'length'],
				['email','require','邮箱不能为空'],
				['http','require','网址不能为空'],
				['qq','require','QQ不能为空'],
				['qq','6,15','QQ号只能6-15位',1,'length'],
			];
			
			// 验证并接收数据
			$res = M('contact')->validate($validate)->create();
			// 判断验证是否通过
			if($res===false){
				return $this->error(M('contact')->getError());
			}
			
			// 修改数据
			$row = M('contact')->where(['id'=>I('get.id')])->save();
			if(empty($row)){
				return $this->error('修改失败');
			}
			return $this->success('修改成功',U('index'));
		}
		
		// 查询要修改的数据
		$contact = M('contact')->where(['id'=>I('get.id')])->find();
		$this->assign('contact',$contact);
		
		// 加载视图
		$this->display('add');
	}
	
	public function delete(){
		
		// 判断是否有传递id
		if(empty(I('get.id'))){
			return $this->error('非法操作');
		}
		
		$row = M('contact')->delete(I('id'));
		if(empty($row)){
			return $this->error('删除失败');
		}
		return $this->success('删除成功',U('index'));
	}
}