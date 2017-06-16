<?php
namespace Admin\Controller;

// 商品模型
class GoodsTypeController extends BaseController{
	
	public function index(){
		
		// 搜索
		$map=[];
		if(!empty(I('keywords'))){
			$keywords = I('keywords');
			$map['type_name'] = ['like',"%{$keywords}%"];
		}
		
		// 总的记录数
		$totalRows = M('goods_type')->count();
		
		// 每页显示记录数
		$listRows = 2;
		
		// 实例化Page类
		$page = new \Think\Page($totalRows,$listRows);
		
		// 分配变量到视图
		$this->assign('page',$page);
		
		// 查询数据
		$list = M('goods_type')->field('id,type_name')->where($map)->page(I('p',1),$listRows)->select();
		
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
				['type_name','require','商品模型名不能为空'],
				['type_name','type_name','商品模型名已存在',1,'unique'],
			];
			
			// 验证并接收数据
			$res = M('goods_type')->validate($validate)->create();
			if($res===false){
				return $this->error(M('goods_type')->getError());
			}
			
			// 添加数据
			$id= M('goods_type')->add();
			
			// 判断是否添加成功
			if( empty($id)){
				return $this->error('添加失败');
			}
			return $this->success('添加成功',U('index'));
		}
		
		// 加载视图
		$this->display();
	}
	
	public function edit(){
		
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}
		// 判断是否有提交数据
		if(IS_POST){
			
			// 验证规则
			$validate = [
				['type_name','require','商品模型名不能为空'],
				['type_name','type_name','商品模型名已存在',1,'unique'],
			];
			
			// 修改数据时，如果验证字段唯一的时候，需要把主键添加进去
			$_POST['id']=I('get.id');
			
			// 验证并接收数据
			$res = M('goods_type')->validate($validate)->create();
			if($res === false){
				return $this->error(M('goods_type')->getError());
			}
			
			// 修改数据
			$row = M('goods_type')->where(['id'=>I('get.id')])->save();
			
			// 判断是否修改成功
			if(empty($row)){
				return $this->error('修改失败');
			}
			return $this->success('修改成功',U('index'));
		}
		
		
		// 查询要修改的数据
		$info = M('goods_type')->where(['id'=>I('get.id')])->find();
		
		// 分配变量到视图
		$this->assign('info',$info);
		
		// 加载视图
		$this->display('add');
	}
	
	public function delete(){
		// 判断
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}
			
		$row = M('goods_type')->delete(I('get.id'));
		if(empty($row)){
			return $this->error('删除失败');
		}
		return $this->success('删除成功',U('index'));
		
		
	}
}