<?php
namespace Common\Model;

class GoodsModel extends \Think\Model\RelationModel{
	
	protected $_link = [
		//品牌表
		'brand'=>[
			'mapping_type'=>self::BELONGS_TO,
			'class_name'=>'Brand',
			'foreign_key' => 'brand_id',
		],
		//分类表
		'category'=>[
			'mapping_type'=>self::BELONGS_TO,
			'class_name'=>'Category',
			'foreign_key' => 'category_id',
		],
		//商品详情表
		'goods_desc'=>[
			'mapping_type'=>self::HAS_ONE,
			'class_name'=>'Goods_desc',
			'foreign_key' => 'goods_id',
		],
		//商品相册表
		'goods_img'=>[
			'mapping_type'=>self::HAS_MANY,
			'class_name'=>'Goods_img',
			'foreign_key' => 'goods_id',
		],
		//商品套餐表
		'goods_spec'=>[
			'mapping_type'=>self::HAS_MANY,
			'class_name'=>'Goods_spec',
			'foreign_key' => 'goods_id',
		],
		//商品评论表
		'comment'=>[
			'mapping_type'=>self::HAS_MANY,
			'class_name'=>'Comment',
			'foreign_key' => 'goods_id',
		],
	];
	
	// 验证规则
	protected $_validate=[
				['goods_name','require','商品名称不能为空'],
				['goods_name','goods_name','商品名称已存在',1,'unique'],
				['goods_name','0,60','商品名称0,60个字符',1,'length'],
				['shop_price','require','商品价格不能为空'],
				['shop_price','currency','商品价格只能是数字'],
				['spec_price','currency','商品的规格价格只能是数字'],
				['market_price','currency','商品价格只能是数字'],
				['brand_id','require','品牌名不能为空'],
				['category_id','require','分类名不能为空'],
				['content','require','商品详情不能为空'],
				['image','require','没有主图啊！！！'],
			];
			
	public function goods_add(){
		
		// 如果没有主动选择主图，就默认相册第一张图为主图
		if(empty(I('image')) && !empty(I('pic'))){
			$_POST['image']=$_POST['pic'][0];
			unset($_POST['pic'][0]);
		}
		$_POST['create_time']=time();
		
		/*****自动验证，自动完成，接收数据*****/
		$res = $this->create(); //商品主表
		// 判断验证是否通过
		if($res===false){
			return $this->getError();
		}
		
		// 把商品详情的信息追加进去
		$res['goods_desc'] = ['content' => strip_tags($_POST['content'])];
		// 把商品相册的信息追加进去 相册是一个数组
		$pic=$_POST['pic'];
		$photo=[];
		foreach($pic as $value){
			$photo[]=['photo'=>$value,]; // 把他组装到对应表里的字段
		}
		if(! empty($photo)){
			$res['goods_img']=$photo;
		}
		
		//把商品套餐的信息追加进去
		$items_price=I('items_price');
		$goods_spec=[];
		foreach($items_price as $key => $value){
			if(! empty(trim($value))){	
				$goods_spec[]=[
					'spec_key'=>$key, // 把他组装到对应表里的字段
					'spec_price'=>$value,
				];
			}
		}
		if(!empty($goods_spec)){
			$res['goods_spec']=$goods_spec;
		}
		// dump($res);
		// dump(I());
		// exit;
		
		/**** 添加数据***/
		$id = $this->relation(true)->add($res);
		if(empty($id)){
			return '添加失败';
		}
		return (int)$id;
	}
	
	public function goods_edit(){
		
		$id=I('get.id');
		
		// 字段有唯一的时候，把主键组装进去，排除自己
		$_POST['id']=$id;
		// 时间
		$_POST['create_time']=time();
		
		/****验证并接收信息*****/
		$res = $this->create(); // 商品主表
		// 判断验证是否通过
		if($res===false){
			return $this->getError();
		}
		
		// 把商品详情的信息追加进去 
		$res['goods_desc'] = ['content' => strip_tags($_POST['content'])];
		// dump($res);
		// exit;
		
		// 商品相册的信息追加进去
		if(! empty(I('pic'))){
			// 先删除该商品之前的相册
			$imgrow = M('goods_img')->where(['goods_id'=>$id])->delete();
			$photo=[];
			foreach(I('pic') as $value){
				$photo[]=['photo'=>$value];
			}
			$res['goods_img']=$photo;
			// dump(I('pic'));
			// exit;
		}
		
		
		
		//把商品套餐的信息追加进去，如果有选择套餐的前提下
			if(! empty(I('items_price'))){
				//先删除该商品之前的套餐
				$specrow=M('goods_spec')->where(['goods'=>$id])->delete();
			}
			$items_price=I('items_price');
			$goods_spec=[];
			foreach($items_price as $key => $value){
				if(! empty(trim($value))){	
					$goods_spec[]=[
						'spec_key'=>$key, // 把他组装到对应表里的字段
						'spec_price'=>$value,
					];
				}
			}
			// 有选择套餐时才修改
			if(!empty($goods_spec)){
				$res['goods_spec']=$goods_spec;
			}
		
		// 修改数据
		$row = $this->relation(true)->where(['id'=>$id])->save($res);
	
		if(empty($row)){
			return '修改失败';
		}
		return (int)$row;
	}
	
	public function goods_delete(){
		
		$this->startTrans(); // 开启事物
		
		// 查询商品下是否有详情---先删除详情---
		$goods_desc=M('goods_desc')->where(['goods_id'=>I('get.id')])->find();
		if(!empty($goods_desc)){
			$resDesc=M('goods_desc')->where(['goods_id'=>I('get.id')])->delete();
			if(empty($resDesc)){
				$this->rollback(); // 事物回滚
				return '删除失败1';
			}
		}
		
		// 查询商品下是否有相册---先删除相册---
		$goods_img=M('goods_img')->where(['goods_id'=>I('get.id')])->select();
		if(!empty($goods_img)){
			$resImg=M('goods_img')->where(['goods_id'=>I('get.id')])->delete();
			if(empty($resImg)){
				$this->rollback(); // 事物回滚
				return '删除失败2';
			}
		}
		
		// 查询商品下是否有套餐---先删除套餐---
		$goods_spec=M('goods_spec')->where(['goods_id'=>I('get.id')])->select();
		if(!empty($goods_spec)){
			$resSpec=M('goods_spec')->where(['goods_id'=>I('get.id')])->delete();
			if(empty($resSpec)){
				$this->rollback(); // 事物回滚
				return '删除失败3';
			}
		}
		//die;
		
		// 查询商品下是否有评论---先删除评论---
		$comment=M('comment')->where(['goods_id'=>I('get.id')])->select();
		if(!empty($comment)){
			$resComment=M('comment')->where(['goods_id'=>I('get.id')])->delete();
			if(empty($resComment)){
				$this->rollback(); // 事物回滚
				return '删除失败4';
			}
		}
		
		// 删除商品
		$res=$this->where(['id'=>I('get.id')])->delete();
		if(empty($res)){
			$this->rollback(); // 事物回滚
			return '删除失败5';
		}
		$this->commit(); // 提交事物
		return (int)$res;
		
		/*
		$res = $this->relation('goods_desc,goods_img,goods_spec,comment')->where(['id'=>I('get,id')])->delete();
		if(empty($res)){
			return '删除失败';
		}
		return (int)$res;
		*/
	}
}