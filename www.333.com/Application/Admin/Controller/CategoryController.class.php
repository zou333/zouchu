<?php
namespace Admin\Controller;

//分类
class CategoryController extends BaseController{
	
	public function index(){
		
		// 搜索
		$map=[];
		if(! empty(I('keywords'))){
			$keywords = I('keywords');
			$map['cate_name'] = ['like',"%{$keywords}%"];
		}
		
		
		// 查询数据
		$list = M('category')->field('id,cate_name,parent_id')->where($map)->select();
		
		// 调用无极分类函数
		$tree = cate_tree($list);
		
		// 分配变量到视图
		$this->assign('list',$tree);
		
		// 加载视图
		$this->display();
	}
	
	public function add(){
		
		// 判断是否有提交数据
		if(IS_POST){
			
			// 验证规则
			$validate = [
				['cate_name','require','分类名称不能为空'],
			];
			
			// 验证并接收数据
			$res =M('category')->validate($validate)->create();
			if($res === false){
				return $this->error(M('category')->getError());
			}
			
			// 添加数据
			$id =M('category')->add();
			if(empty($id)){
				return $this->error('添加失败');
			}return $this->success('添加成功',U('index'));
		}
		
		// 查询分类
		$cate = M('category')->field('id,cate_name,parent_id')->select();
		
		// //传址无极分类
		// // 定义空数组
		// $refer = [];
		// $tree = [];
		
		// // 取出分类数组
		// foreach($cate as $key => $value){
			// // 将当前数组的第key项为当前项的id，给当前的下一级使用
			// $refer[$value['id']] = & $cate[$key];
		// }
		// print_r($refer);
		// return;
		
		// // 取出分类数组 找到第一级以及它的子孙
		// foreach($cate as $key => $value){
			
			// if($value['parent_id']==0){
				// $tree[] = & $cate[$key];
			// }else{
				// if(!empty($refer[$value['parent_id']])){
					// $parent = & $refer[$value['parent_id']];
					// $parent['child'] = & $refer[$value['id']];
				// }
			// }
		// }
		
		
		// 调用无极分类函数
		$data = cate_tree($cate);
		
		// 分配变量到视图
		$this->assign('cate',$data);
		
		
		// 加载视图
		$this->display();
	}
	public function edit(){
		
		
		
		//判断是否有提交数据
		if(IS_POST){
			
			// 验证规则
			$validate = [
				['cate_name','require','分类名不能为空'],
			];
			
			// 修改数据时，验证字段唯一的时候，要把主键添加进去
			
			// 验证并接收数据
			$res = M('category')->validate($validate)->create();
			
			// 判断验证是否成功
			if($res === false){
				return $this->error(M('category')->getError());
			}
			
			// 修改数据
			$row = M('category')->where(['id'=>I('get.id')])->save();
			
			// 判断是否修改成功
			if(empty($row)){
				return $this->error('修改失败');
			}return $this->success('修改成功',U('index'));
		}
		
		// 查询要修改的数据
		$cate = M('category')->where(['id'=>I('get.id')])->find();
		
		// 查询所有分类
		$allCate = M('category')->field('id,cate_name,parent_id')->select();
		
		// 调用无极分类函数
		$tree = cate_tree($allCate);
		
		
		// 防止修改分类等级时在同层次中降低等级而混乱
		$level=0;
		// 取出分类数组
		
		//print_r($tree);
			
		foreach($tree as $key => $value){
			
			// 找到当前分类的等级
			if($value['id']==I('get.id')){
				$level = $value['level'];
				unset($tree[$key]);
				// 跳过同等级的循环
				continue;
			}
			
			if($level>0){// 比当前项的等级还低的情况
				if($value['level'] > $level){ 
					unset($tree[$key]);
				}
				else{ // 比当前项的等级还高的情况
					break; // 退出整个循环
				}
				
			}
			
		}
		
		// 分配变量到视图
		$this->assign('cate',$tree);
		
		// 分配变量到视图
		$this->assign('info',$cate);
		
		// 加载视图
		$this->display('add');
	}
	
	public function delete(){
		
		// 判断是否为空
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}
		
		// 删除分类时，查询该分类下是否有子分类，如果有子分类就让客户删除所有的子分类后再该分类
		$cate = M('category')->field('id,cate_name,parent_id')->where(['parent_id'=>I('get.id')])->find();
		
		// 判断该分类下是否有子分类
		if(!empty($cate)){
			return $this->error('请将该分类下所有的子分类删除后再删除该分类');
		}
		
		//查询该分页下是否亦商品，如果有商品，则让客户手动将该分页下的商品全部删除后再删除该分页
		$cate_goods = M('0201_goods')->field('id')->where(['id'=>I('get.id')])->find();
		if(! empty($category)){
			return $this->error('请将该分类下所有的商品删除后再删除该分类');
		}
		
		// 删除数据
		$row = M('category')->where(['id'=>I('get.id')])->delete();
		
		// 判断删除是否成功
		if(empty($row)){
			return $this->error('删除失败');
		}return $this->success('删除成功',U('index'));
		
	}



}