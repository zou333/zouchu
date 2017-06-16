<?php
namespace Admin\Controller;

class ArticleController extends BaseController{
	
	public function index(){
		
		$talto = M('news')->count();
		$showpage=2;
		// 实例化page类
		$page = new \Think\Page($talto,$showpage); 
		$this->assign('page',$page->show());
		
		// 查询新闻
		$news = M('news')->page(I('p',1),$showpage)->select();

		// 分配变量到视图
		$this->assign('list',$news);
			
		// 加载视图
		$this->display();
	}
	
	public function add(){
		
		// 判断是否有提交数据
		if(IS_POST){
			// 验证规则
			$validate=[
				['news_name','require','新闻标题不能为空'],
				['news_name','news_name','新闻标题已存在',1,'confirm'],
				['image','require','主图不能为空'],
				['content','require','文章不能为空']
			];
			
			// 添加时间
			$_POST['create_time']=time();
			
			// 验证并接收数据
			$res = M('news')->validate($validate)->create();
			if($res===false){
				return $this->error(M('news')->getError());
			}
			
			// 添加数据
			$row = M('news')->add();
			if(empty($row)){
				return $this->error('添加失败');
			}
			return $this->success('添加成功',U('Article/index'));
			
		}	
		// 加载视图
		$this->display();
	}
	
	public function delete(){
		
		$id=I('get.id');
		// 判断是否有传递id过来
		if(empty($id)){
			return $this->error('非法操作');
		}
		
		$row = M('news')->delete($id);
		if(empty($row)){
			return $this->error('删除失败');
		}
		return $this->success('删除成功',U('index'));
	}
	public function edit(){
		
		$id=I('get.id');
		// 判断是否有传递id过来
		if(empty($id)){
			return $this->error('非法操作');
		}
		
		// 判断是否有提交数据
		if(IS_POST){
			
			$validate=[
				['news_name','require','新闻标题不能为空'],
				['news_name','news_name','新闻标题已存在',1,'confirm'],
				['image','require','主图不能为空'],
				['content','require','文章不能为空']
			];
			// 添加时间
			$_POST['create_time']=time();
			
			// 验证并接收数据
			$res = M('news')->validate($validate)->create();
			// 判断验证是否通过
			if($res===false){
				return $this->error(M('news')->getError());
			}
			
			// 修改数据
			$row = M('news')->where(['id'=>$id])->save();
			if(empty($row)){
				return $this->error('修改失败');
			}
			return $this->success('修改成功',U('index'));
		}
		
		// 查询要修改的数据
		$news = M('news')->where(['id'=>$id])->find();
		
		$this->assign('news',$news);
		
		// 加载视图
		$this->display('add');
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