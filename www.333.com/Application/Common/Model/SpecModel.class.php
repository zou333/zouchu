<?php
namespace Common\Model;

// 规格模型
class SpecModel extends \Think\Model\RelationModel{
	
	// 关联表
	protected $_link = [
		'spec_items'=>[
			'mapping_type'=>self::HAS_MANY,
			'foreign_key'=>'spec_id',
			],
			
		'goods_type'=>[
			'mapping_type'=>self::BELONGS_TO,
			'foreign_key'=>'type_id',
		]
		
	];
	
	// 验证规则
	protected $_validate = [
		['spec_name','require','规格名不能为空'],
		['spec_name','spec_name','规格名已存在',1,'confirm'],
		['type_id','require','商品所属类型不能为空'],
		['items','require','规格选项不能为空'],
	];
	
	public function spec_add(){
		
		// 验证并接收数据
		$res = $this->create();
		
		// 判断是否验证成功
		if($res === false){
			return $this->getError();
		}
		
		// 添加规格选项
		// 接收数据
		$items= I('post.items');
		
		// 把字符串转换成数组
		$tempArray = explode("\r\n",$items);
		
		// 去除数组中的空格
		$tempArray = array_map('trim',$tempArray);
		
		// 去除重复的值
		$tempArray = array_unique($tempArray);
		
		$temp=[];
		foreach($tempArray as $key => $value){
			// 去除数组中的空格里的值
			$at = trim($value);
			if(! empty($at)){
				// 追加数组
				$temp[]=['items'=>$value];
			}
		}
		
		if(empty($temp)){
			return '规格选项不能为空';
		}
		
		$res['spec_items']= $temp;
		
		// 添加数据
		$id = $this->relation(true)->add($res);
		// 判断是否添加成功
		if(empty($id)){
			return '添加失败';
		}
		return (int)$id; // 强行转换成整型
	}
	
	public function spec_edit(){
			
			$res = $this->create();
			if($res === false){
				return $this->getError();
			}
			
			// 修改规格选项
			// 接收数据
			$itemsArray = I('post.items');
			
			// 把规格选项字符串转换成数组
			$itemsArray = explode("\r\n",$itemsArray);
			// 去除数组中的空格
			$itemsArray = array_map('trim',$itemsArray);
			
			// 去除重复的值
			$itemsArray = array_unique($itemsArray);
			
			// 查询数据库已存在的规格选项
			$old =M('spec_items')->where(['spec_id'=>$res['id']])->getField('id,items');
			
			// 查询需要删除的数据
			$del = array_diff($old,$itemsArray);
			
			// 查询需要新增的数据
			$add = array_diff($itemsArray,$old);
			
			$new=[];
			foreach($add as $key =>$value){
				$new[]=['items'=>$value];
			}
			
			// 判断规格名称是否为空
			// if(empty($new)){
				// return '规格选项不能为空';
			// }
			
			
			// dump($new);
			// exit;
			
			// 需要删除的数据不为空时才执行删除操作
			if(!empty($del)){
				// 先删除需要删除的规格选项
				$del_row = M('spec_items')->where([
					'spec_id'=>$res['id'],
					'items'=>['in',$del],
				])->delete();
			}
			
			// 追加数组
			$res['spec_items'] = $new;
			
			// dump($res);
			// exit;
			
			// 修改数组
			$row = $this->relation(true)->save($res);
			
			// dump($row);
			// exit;
			
			if(empty($row) && empty($del_row) && empty($add)){
				return '修改失败';
			}
			return (int)$row;
	}
	
	public function spec_delete(){
		
		// 事物（方法一）---大数据中不要使用事物
		// $this->begin();
		$this->startTrans(); // 开启事物
		
		$spec_items = M('spec_items')->where(['spec_id'=>I('get.id')])->select();
		
		if(!empty($spec_items)){
			// 删除规格选项
			$row = M('spec_items')->where(['spec_id'=>I('get.id')])->delete();
			
			if(empty($row)){
				$this->rollback(); // 事物回滚
				return '删除失败';
			}
		}
		
		// 删除规格选项一并删除商品套餐 ----未完成
		
		// 删除规格名称
		$row = $this->where(['id'=>I('get.id')])->delete();
		
		if(empty($row)){
			$this->rollback(); // 事物回滚
			return '删除失败';
		}
		$this->commit(); // 事物确认
		return (int)$row;
		
		// 方法二
		// $res = $this->relation('spec_items')->where(['id'=>I('get.id')])->delete();
		
		// return (int)$res;
		
	}
	
	
	
	
}