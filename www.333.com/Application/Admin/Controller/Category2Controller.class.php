<?php
namespace Admin\Controller;

class Category2Controller extends BaseController{
	public function add (){
		if(IS_POST){
			$validate = [
				['cate_name','require','分类名称不能为空'],
			];
			
			$res = M('category2')->validate($validate)->create();
			if($res === false){
				return $this->error(M('category2')->getError());
			}
			
			$id = M('category2')->add();
			if(empty($id)){
				return $this->error('添加失败');
			}return $this->success('添加成功',U('index'));
		}
		
		$cate = M('category2')->field('id,cate_name,parent_id')->select();
		$data = cate_tree2($cate);
		$this->assign('cate',$data);
		
		$this->display();
	}
}