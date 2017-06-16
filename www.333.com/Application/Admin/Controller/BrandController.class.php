<?php
namespace Admin\Controller;

//品牌控制器
class BrandController extends BaseController{
	
	// 列表页
	public function index(){
		
		// 模糊搜索查询
		$keywords = I('keywords');
		$map = [];
		if(! empty($keywords)){
			$map['brand_name'] = ['like',"%{$keywords}%"];
		}
		
		// 总记录数
		$totalRows = M('brand')->where($map)-> count();
		
		// 每页要显示的数量
		$listRows = 2;
		
		// 实例化page类
		$page = new \Think\Page($totalRows,$listRows);
		//分配变量到视图并显示分页
		$this -> assign('page',$page->show());
		
		$list = M('brand')->field('id,brand_name')->where($map)->page(I('p',1),$listRows)->order('id asc')->select();
		// 分配变量到视图
		$this -> assign('list',$list);
		
		// 加载视图
		$this->display();
	}
	
	// 添加页
	public function add(){
		
		// 判断是否有提交数据
		if(IS_POST){
			
			// 判断品牌名是否为空
			// 判断品牌名是否已存在
			$validate = [
				['brand_name','require','品牌名不能为空'], 
				// 1 必须填 unique唯一
				['brand_name','brand_name','品牌名已存在','1','unique'],
				// ['image','require','图片不能为空'],
				['content','require','简介不能为空'],
			];
			
			// create() 这个方法可以自动接收post过来的数据，并且自动过滤非数据表字段 自动验证数据 自动完成数据 
			// 验证并接收数据
			$res = M('brand')->validate($validate)->create();
			
			// 判断验证是否通过
			if($res === false){
				return $this->error(M('brand')->getError());
			}
			
			// 添加数据
			$id = M('brand')->add();
			
			// 判断是否添加成功
			if(! empty($id)){
				return $this->success('添加成功',U('index'));
			}return $this->error('添加失败');
		}
		
		// 加载视图
		$this->display();
	}
	
	public function edit(){
		
		// 判断是否有提交数据
		if(IS_POST){
			
			// 验证规则
			$validate = [
				['brand_name','require','品牌名不能为空'],
				['brand_name','brand_name','品牌名已存在',1,'unique'],
				// ['image','require','图片不能为空'],
				['content','require','简介不能为空'],
			];
			
			// 修改数据时，验证字段唯一的时候，要把主键添加进去
			$_POST['id'] = I('get.id');
			
			// 验证并接收数据
			$res = M('brand')->validate($validate)->create();
			
			// 判断验证是否成功
			if($res === false){
				return $this->error(M('brand')->getError());
			}
			
			// 修改数据
			$row = M('brand')->where(['id'=>I('get.id')])->save();
			
			// 判断修改是否成功
			if(empty($row)){
				return $this->error('修改失败');
			}return $this->success('修改成功',U('index')); 
		}
		
		// 查询要修改的数据
		$brand = M('brand')->find(I('get.id'));
		if(empty($brand)){
			return $this->error('没有找到该品牌');
		}
		
		// 分配变量到视图
		$this->assign('brand',$brand);
		
		// 加载视图
		$this->display('add');
	}
	
	public function delete(){
		
		// 判断get到的id是否为空
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}
		
		// 查询出该品牌下是否还有商品，如果还有商品，则让客户手动删除商品后再删除品牌
		$br_goods = M('0201_goods')->field('id')->where(['id'=>I('get.id')])->find();
		if(! empty($br_goods)){
			return $this->error('请先删除该品牌下的所有商品后再删除该品牌');
		}
		
		// 删除数据
		$row = M('brand')->delete(I('id'));
		
		// 判断删除是否成功
		if(empty($row)){
			return $this->error('删除失败');
		}return $this->success('删除成功',U('index'));
	}
	
	
	/*  处理上传
		$filesname 文件对象名
	*/
	public function upload($filesname='image'){
		
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
	
}
