<?php
namespace Admin\Controller;

// 规格
class SpecController extends BaseController{
	
	public function index(){
		
		// 搜索
		$map=[];
		if(! empty(I('keywords'))){
			$keywords=I('keywords');
			$map['spec_name']=['like',"%{$keywords}%"];
		}
		
		// 总记录数
		$totalRows = M('spec')->where($map)->count();
		
		// 每页显示条数
		$listRows=2;
		
		// 实例化page类(对象)
		$page = new \Think\Page($totalRows,$listRows);
		
		// 分配变量到视图
		$this->assign('page',$page->show());
		
		// 查询商品规格
		$spec = D('Spec')->relation('goods_type')->where($map)->page(I('p',1),$listRows)->select();
	
		// 分配变量视图
		$this->assign('info',$spec);
		
		//加载视图
		$this->display();
		
	}
	
	public function add(){
		
		// 判断是否有提交数据
		if(IS_POST){
			
			$res = D('Spec')->spec_add();

			// 判断返回的结果是字符串还是整型
			if(is_string($res)){
				return $this->error($res);
			}
			return $this->success('添加成功',U('index'));
			
		}
		// 查询商品类型【商品模型】
		$goods_type = M('goods_type')->field('id,type_name')->select();
		
		// 分配变量到视图
		$this->assign('goods_type',$goods_type);
		
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
			
			$_POST['id']=I('get.id');
			
			$res = D('Spec')->spec_edit();
			
			if(is_string($res)){
				return $this->error($res);
			}
			return $this->success('修改成功',U('index'));
			
		}
		
		$goods_type = M('goods_type')->select();
		
		$this->assign('goods_type',$goods_type);
		
		// 查询规格名称
		$spec = D('Spec')->relation('spec_items')->where(['id'=>I('get.id')])->find();
		
		// 查询规格选项
		$items = M('spec_items')->where(['spec_id'=>I('get.id')])->getField('id,items');
		
		// 将规格选项数组转化为字符串
		$spec['items']=implode("\r\n",$items);
	
		// 分配变量到视图
		$this->assign('spec',$spec);
		
		$this->display('add');
	}
	
	public function delete(){
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}
		
		// 方法一
		$row = D('Spec')->spec_delete();
	
		if(is_string($row)){
			return $this->error($row);
		}
		return $this->success('删除成功',U('index'));
		
		// 方法二
		// $row = D('Spec')->spec_delete();
		// if(empty($row)){
			// return $this->error($row);
		// }
		// return $this->success('删除成功',U('index'));
	}
	
	
}