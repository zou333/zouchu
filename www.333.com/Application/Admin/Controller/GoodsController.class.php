<?php
// return  在函数的内部用return返回一个值或者为空来结束函数的运行
// 返回数组时要用die(json_encode())储存值

namespace Admin\Controller;

class GoodsController extends  BaseController{
	
	public function index(){
		
		// 搜索
		$map=[];
		if(! empty(I('keywords'))){
			$keywords=I('keywords');
			$map['goods_name']=['like',"%{$keywords}%"];
		}
		
		$tolo = M('goods')->where($map)->count();
		$showpage=5;
		// 实例化分类页
		$page = new \Think\Page($tolo,$showpage);
		// 分配变量到视图并显示分页
		$this->assign('page',$page->show());
		
		// 查询商品与商品相关表的信息（关联查询）
		$goods = D('Goods')->where($map)->page(I('p',1),$showpage)->relation(true)->select();
		
		// dump($goods);
		// 分配变量到视图
		$this->assign('goods',$goods);
		
		// 加载视图
		$this->display();
	}
	
	public function add(){
		
		if(IS_POST){
			
			$id=D('Goods')->goods_add();
			
			// dump(I('pic'));
			// exit;
			
			if(IS_STRING($id)){
				return $this->error($id);
			}
			return $this->success('添加成功',U('Goods/index'));
		}
		
		// 查询品牌
		$brand = M('brand')->field('id,brand_name')->select();
		// 分配变量到视图
		$this->assign('brand',$brand);
		
		// 查询分类
		$cate = M('category')->field('id,cate_name,parent_id')->select();
		// 调用无极分类
		$tree = cate_tree($cate);
		// 分配变量到视图
		$this->assign('cate',$tree);
		
		// 加载视图
		$this->display();
	}
	
	public function delete(){ // 多表删除用事物方法
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}
		
		$row = D('Goods')->goods_delete();
		if(IS_STRING($row)){
			return $this->error($row);
		}
		return $this->error('删除成功',U('index'));
	}
	
	public function edit(){
		
		$id=I('get.id');
		
		if(empty($id)){
			return $this->error('非法操作');
		}
		
		
		// 找出要修改的商品数据和商品有关联的数据
		
		$goods=D('Goods')->where(['id'=>$id])->relation(true)->find();
		// dump($goods);return;
		$this->assign('goods',$goods);
		
		// 判断是否有该商品
		if(empty($goods)){
			return $this->error('没有该商品');
		}
		
		// 判断是否有提交数据
		if(IS_POST){
			
			// 修改数据
			$row = D('Goods')->goods_edit();
			// dump($row);return;
			
			// exit;
			if(IS_STRING($row)){
				return $this->error($row);
			}
			return $this->success('修改成功',U('index'));
		}
		
		// 找出要修改的商品套餐
		$spec_id=[];
		$spec_price = [];
		foreach($goods['goods_spec'] as $key => $value){
			$spec_key = explode(',',$value['spec_key']); // 字符串转数组
			// 把spec_key合并进$spec_id中
			$spec_id = array_merge($spec_id,$spec_key);
			$spec_price[$value['spec_key']]=$value['spec_price'];
		}
		
		// 去除重复的商品id
		$spec_id=array_unique($spec_id);
		
		// 处理选择规格选项
		
		$del_items = $this->del_items($spec_id,$spec_price);
		
		$this->assign('spec_group',$del_items);
		
		// 查询品牌
		$brand = M('brand')->field('id,brand_name')->select();
		
		// dump($brand);
		// 分配变量到视图
		 $this->assign('brand',$brand);
		
		// 查询分类
		 $cate = M('category')->field('id,cate_name,parent_id')->select();
		// 调用无极分类
		 $tree = cate_tree($cate);
		 // dump($tree);
		// 分配变量到视图
		$this->assign('cate',$tree);
		
		$this->display('add');
	}
	
	/* $filesname 文件对象名
		处理上传
	*/
	public function upload($filesname='pic'){
		
		// 实例化上传类
		 $upload = new \Think\Upload();
		 
		// 设置附件上传大小
		$upload->maxSize = 3145728 ; 
		
		// 设置附件上传类型
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
		
		// 设置附件上传根目录
		$upload->rootPath = 'Public/Upload/';
		
		// 判断根目录是否存在，如果不存在，则创建文件夹
		if(!is_dir($upload->rootPath)){
			mkdir($upload->rootPath);
		}
		
		 // 上传单个文件 
		 $info = $upload->uploadOne($_FILES[$filesname]);
		 
		 // 判断是否上传成功
		 if($info === false){
			die(json_encode(['error'=>1,'wrong'=>$upload->getError()]));
		 }
		 
		 
		 // 取得路径，用于存进数据库  savepath-->保存路径 savename-->上传文件的保存规则/图片名
		 $path = $upload->rootPath .$info['savepath'].$info['savename'];
		 
		 die(json_encode(['code'=>0,'path'=>$path]));
	}
	
	// 添加规格
	public function add_spec(){
		
		// 查询商品模型
		$goods_type = M('goods_type')->select();
		
		foreach($goods_type as $key => $value){
			$goods_type[$key]['spec'] = D('Spec')->where(['type_id'=>$value['id']])->relation('spec_items')->select();
		}
		
		// 分配视图
		$this->assign('goods_type',$goods_type);
		
		// 加载视图
		$this->display();
	}
	
	// 处理选择规格选项
	public function del_items($spec_id=[],$spec_price=[]){
		
		
		// 接收ajax传过来的id
		$id= IS_AJAX ? I('id') : $spec_id;
		if(!empty($id)){
		// 根据id查到spec_id
		$spec_items = M('spec_items')->where(['id'=>['in',$id]])->select();
		
		// 将选择规格中相同的规格选项放到一个数组
		$temp_id=[];
		$items=[];
		foreach($spec_items as $key => $value){
			$temp_id[$value['spec_id']][]=$value['id'];
			// 把自身作为主键，以便查询规格选项名
			$items[$value['id']] = & $spec_items[$key];
		}
		
		// 获取数组的排列组合做成套餐
		$items_group = get_array_group($temp_id);
		
		// 取出所有选择上的规格spec_id
		$spec_id = array_keys($temp_id); //array_keys() 拿到数组中的所有键名
		
		// 根据规格spec_id查询出规格数据信息拿到规格名
		$spec = M('Spec')->where(['id'=>['in',$spec_id]])->select();
		
		$html='<table>';
		$th='<tr>';
		// 书写table表格且把拿到的规格名拼接进去
		foreach($spec as $key => $value){
			$th.='<th>'.$value['spec_name'].'</th>';
		}
		$th.='<th>价格</th></tr>';
		$html.=$th;
		
		$td='<tr style="margin-bottom:5px;">';
		foreach($items_group as $key => $value){
			foreach($value as $i){
				$td.='<td>'.$items[$i]['items'].'</td>';
			}
			// 对规格选项id做升序排列使得价格表单里面的值正常排列
			asort($value); //asort() 对数组做升序排列
			$items_id_str =implode(',',$value);
			
			$price='';
			if(isset($spec_price[$items_id_str])){ // 判断价格是否存在
				$price=$spec_price[$items_id_str];
			}
			
			$td.='<td><input type="text" name="items_price['.$items_id_str.']" style="margin-bottom:5px;" value="'.$price.'"></td></tr>';
		}
		
		$html.=$td;
		
		$html.='</table>';
		
		if(IS_AJAX){
			die($html);
		}
		return $html;
		}
	}
	
	
}