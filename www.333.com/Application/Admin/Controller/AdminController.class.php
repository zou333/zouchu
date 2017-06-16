<?php
namespace Admin\Controller;

// 管理员
class AdminController extends BaseController{
	
	// 列表页
	public function index(){
		
		// 搜索
		$map=[];
		if(! empty(I('keywords'))){
			$keywords = I('keywords');
			$map['user_name']=['like',"%{$keywords}%"];
		}
		
		// 总的记录数
		$totalRows = M('admin')->where($map)->count();
		
		// 每页显示记录数
		$listRows = 1;
		
		// 实例化page类
		$page = new \Think\Page($totalRows,$listRows);
		
		// 分配变量到视图并显示分页
		$this->assign('page',$page->show());
		
		// 查询数据
		$list = M('admin')->field('id,user_name')->where($map)->page(I('p',1),$listRows)->select();
		
		// 分配变量到视图
		$this->assign('list',$list);
		
		// 加载视图
		$this->display();
	}
	
	public function add(){
		
		// 判断是否有提交数据
		if(IS_POST){
			
			// 验证规则
			$validate = [
				['user_name','require','账号不能为空'],
				['password','require','密码不能为空'],
				['user_name','user_name','账号已存在',1,'unique'],
				['password','password1','密码不一致',1,'confirm'],
				['user_name','6,18','账号长度6-18个字符',3,'length'],
				['password','6,18','密码长度6-18个字符',3,'length'],
			];
			// 验证并接收数据
			$res = M('admin')->validate($validate)->create();
			
			// 判断验证是否成功
			if($res === false){
				return $this->error(M('admin')->getError());
			}
			// 把密码加密
			$res['password'] = md5(I('password'));
			
			// 添加数据
			$id  = M('admin')->add($res);
			
			// 判断是否添加成功
			if(empty($id)){
				return $this->error('添加失败');
			}return $this->success('添加成功',U('index'));
		}
		
		// 加载视图
		$this->display();
	}
	
	public function edit(){
		// 判断get到的id是否为空
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}
		
		// 判断是否有提交数据
		if(IS_POST){
			
			// 验证规则
			$validate = [
				['pasword','require','密码不能为空'],
				['password','password1','密码不一致',1,'confirm'],
				['password','6,18','密码长度6-18个字符',3,'length'],
			];
			
			// 修改数据时，验证字段唯一的时候，要把主键添加进去
			
			// 验证并接收数据
			$res = M('admin')->validate($validate)->create();
			
			// 判断验证是否成功
			if($res === false){
				return $this->error(M('admin')->getError());
			}
			
			$res['password'] = md5($res['password']); 
			
			// 修改数据
			$row = M('admin')->where(['id'=>I('get.id')])->save($res);
			
			// 判断是否修改成功
			if(empty($row)){
				return $this->error('修改失败');
			}return $this->success('修改成功',U('index'));
		}
		
		// 查询要修改的数据
		$admin = M('admin')->find(I('get.id'));
		
		// 匹配变量到视图
		$this->assign('admin',$admin);
		
		// 加载视图
		$this->display('add');
	}
	
	public function delete(){
		
		// 判断get到的id是否为空
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}
		
		// 删除数据
		$row = M('admin')->delete(I('get.id'));
		
		// 判断是否删除成功
		if(empty($row)){
			return $this->error('删除失败');
		}return $this->success('删除成功',U('index'));
	}
}