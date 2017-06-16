<?php
/**
 *获取数组的排列组合
 *@param array $arr 需要组合的数组
 *return array
**/
function get_array_group($arr){
	// 迭代
	$group=[];
	foreach($arr as $value){
		if(empty($group)){
			//只有一项的时候,遍历出里面的值并且以数组的形式输出
			foreach($value as $val){ 
				$group[]=[$val]; // 拿到数组中第一个值
			}
		}else{
			$tmp=[];
			foreach($group as $g){
				foreach($value as $v){
					if(! is_array($g)){
						$tmp[]=[$g,$v]; // 拿到另外一些数组中第一个值
					}else{
						$g[]=$v;
						$tmp[]=$g;
						array_pop($g); // 删除数组中最后一元素
					}
				}
			}
			$group=$tmp;
		}
	}
	return $group;
}

// 无极分类树状函数
function get_tree($cateArr,$parent_id=0){
	
	// 取出分类数组
	$data=[];
	foreach($cateArr as $key => $value){
		if($value['parent_id']==$parent_id){
			$value['child']=get_tree($cateArr,$value['id']);
			$data[] = $value;
		}
	}
	return $data;
}

// 测试的
function cate_tree2($cateArr,$parent_id=0,$level=1){
	$data= [];
	foreach($cateArr as $key => $value){
		if($value['parent_id']==$parent_id){
			$value['level']=$level;
			$data[] = $value;
			
			// 优化无极分类
			unset($cateArr[$key]);
			
			$temp = cate_tree2($cateArr,$value['id'],$level+1);
			if(!empty($temp)){
				$data = array_merge($data,$temp);
			}
		}
	}
	return $data;
}


// 无极分类函数
function cate_tree($cateArr,$parent_id=0,$level=1){

	// 取出分类数组
	$data =[];
	//先取出parten_id=0的分类
	foreach($cateArr as $key=>$value){
		
		if($value['parent_id']==$parent_id){
			$value['level'] =$level;
			$data[] = $value;
			// 优化无极分类
			unset($cateArr[$key]);
			
			// 找当前的下一级
			$temp = cate_tree($cateArr,$value['id'],$level+1);
			// 判断$temp是否为空
			if(!empty($temp)){
				// 把下一级的数组合并到$data数组里
				$data = array_merge($data,$temp);
			}
		}
	}
	return $data;
}