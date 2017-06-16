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
 
<style>
#spec-list{}
#spec-list .tab{height:20px;border-bottom:1px solid #999;overflow:hidden;padding:0}
#spec-list .tab li{float:left;padding:0 20px;margin:0;line-height:20px;cursor:pointer}
#spec-list .tab .cur{background:#dedede}
#spec-list .table .body{padding:10px;display:none}
#spec-list .table .body.cur{display:block}
#spec-list .table .body dl{clear:both;}
#spec-list .table .body dl dt,#spec-list .table .body dl dd{float:left}
#spec-list .table .body dl dt{width:50px;text-align:right;padding-right:10px}
#spec-list .table .body dl dd{padding:0 10px;border:1px solid #dedede;margin-right:5px;cursor:pointer}
#spec-list .table .body dl dd.cur{background:#01a1ff;color:white;border:1px solid #01a1ff}
</style>

<div id="spec-list">
	<ul class="tab">
		<?php if(is_array($goods_type)): foreach($goods_type as $tk=>$value): ?><li <?php if(($tk) == "0"): ?>class="cur"<?php endif; ?>><?php echo ($value['type_name']); ?></li><?php endforeach; endif; ?>
	</ul>
	<div class="table">
		<?php if(is_array($goods_type)): foreach($goods_type as $k=>$val): ?><div class="body <?php if(($k) == "0"): ?>cur<?php endif; ?>">
			<?php if(is_array($val['spec'])): foreach($val['spec'] as $key=>$v): ?><dl>
				<dt><?php echo ($v['spec_name']); ?></dt>
				<?php if(is_array($v['spec_items'])): foreach($v['spec_items'] as $key=>$i): ?><dd data-items-id="<?php echo ($i['id']); ?>"><?php echo ($i['items']); ?></dd><?php endforeach; endif; ?>
				<p style="clear:both"></p>
			</dl><?php endforeach; endif; ?>
		</div><?php endforeach; endif; ?>
	</div>
	<button  type="button" onclick="add_spec_items()">添加规格</button>
	<button type="button" onclick="removespec()">取消</button>
</div>
<script>
function add_spec_items(){
	var items_id=[];
	// 遍历出选中的规格选项
	$('#spec-list .body dd.cur').each(function(){ //each() 遍历
		items_id.push($(this).attr('data-items-id')); //push() 从某元素末尾插入
	}); //attr() 改变自定义属性
	
	// 判断最终是否有选择规格选项
	if(items_id.length==0){
		layer.msg('请选择规格选项',{icon:5});
		return;
	}
	
	$.ajax({
		type:'post',
		url:'<?php echo U("Goods/del_items");?>',
		data:{id:items_id},
		dataType:'html', //dataType是传递过去后返回来的数据类型
		success:function(data){ // data 是dataType返回来的内容
			console.log(data);
			<!-- $('#add_spec_body').html(data); -->
			<!-- removespec(); -->
		},
		error:function(e){
			
		}
	});
}

function removespec(){
	layer.closeAll();
}

$('#spec-list .tab li').click(function(){
	$(this).addClass('cur').siblings('li').removeClass('cur');
	
	var index=$('#spec-list .tab li').index(this);
	
	$('#spec-list .table .body').css({display:'none'});
	$('#spec-list .table .body').eq(index).css({display:'block'});
});

$('dd').click(function(){
	$(this).parents('.body').siblings().find('dd').removeClass('cur');
	$(this).toggleClass('cur');
	
});

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