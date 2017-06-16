<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="/Public/Admin/css/pintuer.css">
<link rel="stylesheet" href="/Public/Admin/css/admin.css">
<script src="/Public/Admin/js/jquery.js"></script>
<script src="/Public/Admin/js/pintuer.js"></script>
</head>
<body>
 
<script src="/Public/Admin/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script src="/Public/Admin/layer-v3.0.3/layer/layer.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Admin/uploadify/uploadify.css">
<body>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span><?php if(empty($_GET['id'])): ?>添加 <?php else: ?> 修改<?php endif; ?>内容</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="">  
      <div class="form-group">
        <div class="label">
          <label>商品名：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="<?php echo ($goods['goods_name']); ?>" name="goods_name" data-validate="required:请输入商品名" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>图片：</label>
        </div>
        <div class="field">
			<input id="file_upload" name="file_upload" type="file" multiple="true"  value="+ 浏览上传">
			<div id="queue" style="overflow=" hidden"="">
			<?php if(!empty($_GET['id'])): ?><dl id="SWFUpload_0_0" style="float:left; margin-right:10px;">
					<dt style="border:1px solid red;margin:5px 0;">
						<img src="/<?php echo ($goods['image']); ?>" width="100" height="100">
					</dt>
					<dd style="text-align:center;">
						<button onclick="masterpic(this)" type="button" style="margin-right:5px;color:red;">主图</button>
						<button onclick="removepic(this)" type="button">删除</button>
						<input type="hidden" name="pic[]" value="Public/Upload/2017-06-10/593b9c6e528ba.gif">
					</dd>
				</dl>
				<?php if(!empty($goods['goods_img'])): if(is_array($goods['goods_img'])): foreach($goods['goods_img'] as $key=>$value): ?><dl id="SWFUpload_0_0" style="float:left; margin-right:10px;">
					<dt style="border:1px solid #999;margin:5px 0;">
						<img src="/<?php echo ($value['photo']); ?>" width="100" height="100">
					</dt>
					<dd style="text-align:center;">
						<button onclick="masterpic(this)" type="button" style="margin-right:5px;">主图</button>
						<button onclick="removepic(this)" type="button">删除</button>
						<input type="hidden" name="pic[]" value="Public/Upload/2017-06-10/593b9c6e528ba.gif">
					</dd>
				</dl><?php endforeach; endif; endif; endif; ?>
			</div>
			<div id="queue" style="overflow="hidden"></div>
        </div>
      </div> 
	  <div class="form-group">
        <div class="label">
          <label>规格：</label>
        </div>
		<button type="button" onclick="add_spec(this)">添加规格</button>
		<div id="add_spec_body"><?php echo ($spec_group); ?></div>
	  </div>
	<div class="form-group">
	  <div class="label">
		<label>品牌名：</label>
	  </div>
	  <div class="field">
		<select name="brand_id" class="input w50">
		  <option value="">请选择品牌</option>
		  <?php if(is_array($brand)): foreach($brand as $key=>$value): ?><option <?php if(($value['id']) == $goods['brand_id']): ?>selected<?php endif; ?> value="<?php echo ($value['id']); ?>"><?php echo ($value['brand_name']); ?></option><?php endforeach; endif; ?>
		</select>
		<div class="tips"></div>
	  </div>
	</div>
        <div class="form-group">
          <div class="label">
            <label>分类名：</label>
          </div>
          <div class="field">
            <select name="category_id" class="input w50">
              <option value="">请选择分类</option>
			  <?php if(is_array($cate)): foreach($cate as $k=>$value): ?><option <?php if(($value['id']) == $goods['category_id']): ?>selected<?php endif; ?> value="<?php echo ($value['id']); ?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;',$value['level']-1); echo ($value['cate_name']); ?></option><?php endforeach; endif; ?>
            </select>
            <div class="tips"></div>
          </div>
        </div>
      <div class="form-group">
        <div class="label">
          <label>商品价格：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="shop_price" value="<?php echo ((isset($goods['shop_price']) && ($goods['shop_price'] !== ""))?($goods['shop_price']):'0'); ?>" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>市场价格：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="market_price" value="<?php echo ((isset($goods['market_price']) && ($goods['market_price'] !== ""))?($goods['market_price']):'0'); ?>" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>商品详情：</label>
        </div>
        <div class="field">
          <!-- <textarea name="content" class="input" style="height:450px; border:1px solid #ddd;"></textarea> -->
		  <!-- 加载编辑器的容器 -->
		<script id="container" name="content" type="text/plain">
		<?php echo ($goods['goods_desc']['content']); ?>
		</script>
		<!-- 配置文件 -->
		<script type="text/javascript" src="/Public/Admin/ueditor/ueditor.config.js"></script>
		<!-- 编辑器源码文件 -->
		<script type="text/javascript" src="/Public/Admin/ueditor/ueditor.all.js"></script>
		<!-- 实例化编辑器 -->
		<script type="text/javascript">
			var ue = UE.getEditor('container');
		</script>
			<div class="tips"></div>
        </div>
      </div>
     
      <div class="clear"></div>
      <!-- <div class="form-group"> -->
        <!-- <div class="label"> -->
          <!-- <label>点击次数：</label> -->
        <!-- </div> -->
        <!-- <div class="field"> -->
          <!-- <input type="text" class="input w50" name="views" value="" data-validate="member:只能为数字"  /> -->
          <!-- <div class="tips"></div> -->
        <!-- </div> -->
      <!-- </div> -->
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
<script type="text/javascript">
	<!-- 加载完页面后执行 -->
	$(function() {
		$('#file_upload').uploadify({
			'buttonText' : '+ 浏览上传',
			'swf'      : '/Public/Admin/uploadify/uploadify.swf',
			'uploader' : '<?php echo U("Goods/upload");?>',
			'fileObjName' : 'pic',
			'onUploadSuccess' : function(file, data, response) {
				<!-- console.log(data); -->
				var data=eval("("+data+")");
				if(data.code==0){
					var html='<dl id="'+file.id+'" style="float:left; margin-right:10px;">'+
						'<dt style="border:1px solid #999;margin:5px 0;"><img src="/'+data.path+'" width="100" height="100"></dt>'+
						'<dd style="text-align:center;">'+
							'<button onclick="masterpic(this)" type="button" style="margin-right:5px;">主图</button>'+
							'<button onclick="removepic(this)"     type="button">删除</button><input type="hidden" name="pic[]" value="'+data.path+'"></dd></dl>';
				}
				$('#queue').append(html); // append() 在选中元素后面插入内容
			}
		});
	});
	
	function masterpic(m){
		
		// 区分主图和相册
		$(m).parents('#queue').find('input[type="hidden"]').prop('name','pic[]');
		$(m).siblings('input[type="hidden"]').prop('name','image');
		
		// 点击主图时让图片边框线颜色为红色
		$(m).parents('#queue').find('dt').css({border:'1px solid #999'});
		$(m).parents('dl').find('dt').css({border:'1px solid red'});
		
		// 方法一 点击主图时让主图字体颜色为红色
		$(m).parents('#queue').find('button').css({color:''});
		$(m).css({color:'red'});
		
		
		// 方法二 点击主图时让主图隐藏
		/*$(m).parents('#queue').find('button').css({display:'block'});
		$(m).css({display:'none'});*/
		
	}
	
	<!-- function spec(o){ -->
		<!-- layer.tab({ -->
		  <!-- area: ['600px', '300px'], -->
			<!-- $(o).each("{}") -->
		  <!-- tab: [{ -->
			<!-- title: 'TAB1',  -->
			<!-- content: '内容1' -->
		  <!-- }, { -->
			<!-- title: 'TAB2',  -->
			<!-- content: '内容2' -->
		  <!-- }, { -->
			<!-- title: 'TAB3',  -->
			<!-- content: '内容3' -->
		  <!-- }] -->
		<!-- }); -->
	<!-- } -->
	
	
	function removepic(o){
		if(confirm('确定删除该图片吗 ?*?  ?^…^?')){
			$(o).parents('dl').remove();
		}
	}
	
	function add_spec(o){
		$.ajax({
			type:'get',
			url:'<?php echo U("Goods/add_spec");?>',
			datatype:'html',
			success:function(data){
				//页面层
				layer.open({
				  type: 1,
				  skin: 'layui-layer-rim', //加上边框
				  area: ['420px', '240px'], //宽高
				  content: data
				});
			},
		});
	}
	
</script>


<script type="text/javascript">

//搜索
function changesearch(){	
		
}

//单个删除
function del(id,mid,iscid){
	if(confirm("您确定要删除吗?")){
		
	}
}

//全选
$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

//批量删除
function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false;		
		$("#listform").submit();		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}

//批量排序
function sorts(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		
		$("#listform").submit();		
	}
	else{
		alert("请选择要操作的内容!");
		return false;
	}
}


//批量首页显示
function changeishome(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");		
	
		return false;
	}
}

//批量推荐
function changeisvouch(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");	
		
		return false;
	}
}

//批量置顶
function changeistop(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){		
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");		
	
		return false;
	}
}


//批量移动
function changecate(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){		
		
		$("#listform").submit();		
	}
	else{
		alert("请选择要操作的内容!");
		
		return false;
	}
}

//批量复制
function changecopy(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		var i = 0;
	    $("input[name='id[]']").each(function(){
	  		if (this.checked==true) {
				i++;
			}		
	    });
		if(i>1){ 
	    	alert("只能选择一条信息!");
			$(o).find("option:first").prop("selected","selected");
		}else{
		
			$("#listform").submit();		
		}	
	}
	else{
		alert("请选择要复制的内容!");
		$(o).find("option:first").prop("selected","selected");
		return false;
	}
}

</script>
</body>
</html>