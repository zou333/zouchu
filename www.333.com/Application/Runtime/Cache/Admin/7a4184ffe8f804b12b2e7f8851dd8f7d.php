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
 
<form method="get" action="<?php echo U();?>" id="listform">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
    <div class="padding border-bottom">
      <ul class="search" style="padding-left:10px;">
        <li> <a class="button border-main icon-plus-square-o" href="<?php echo U('add');?>"> 添加内容</a> </li>
        <li>搜索：</li>
        <li>
          <input type="text" placeholder="请输入搜索关键字" name="keywords" class="input" style="width:250px; line-height:17px;display:inline-block" />
          <a href="javascript:void(0)" class="button border-main icon-search" onclick="brsearch()" > 搜索</a></li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="100" style="text-align:left; padding-left:20px;">ID</th>
        <th width="100" style="text-align:left; padding-left:20px;">时间</th>
        <th style="text-align:left; padding-left:20px;">主图</th>
        <th style="text-align:left; padding-left:20px;">新闻标题</th>
        <th style="text-align:left; padding-left:20px;">内容</th>
        <th width="310">操作</th>
      </tr>
	  <?php if(is_array($list)): foreach($list as $key=>$value): ?><tr>
          <td width="100" style="text-align:left; padding-left:20px;"><font color="#00CC99"><?php echo ($value['id']); ?></font></td>
          <td width="100" style="text-align:left; padding-left:20px;"><?php echo date('Y-m-d',$value['create_time']);?></td>
		  <td style="text-align:left; padding-left:20px;"><img src="/<?php echo ($value['image']); ?>" height="80px;"></td>
          <td style="text-align:left; padding-left:20px;"><?php echo mb_substr($value['news_name'],'0','30',"utf-8");?>...</td>
          <td style="text-align:left; padding-left:20px;"><?php echo mb_substr($value['content'],'0','50',"utf-8");?>...</td>
          <td><div class="button-group"> <a class="button border-main" href="<?php echo U('edit',['id'=>$value['id']]);?>"><span class="icon-edit"></span> 修改</a> <a class="button border-red" href="javascript:void(0)" onclick="return brand_del(<?php echo ($value['id']); ?>)"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr><?php endforeach; endif; ?>
      <tr>
        <td colspan="8"><div class="pagelist"><?php echo ($page); ?></div></td>
      </tr>
    </table>
  </div>
</form>
<script>
function brand_del(id){

	<!-- 删除确认框 -->
	if(confirm('确认要删除该品牌吗？')){
		<!-- 如果确认，就给跳转地址 -->
		url='<?php echo U("delete",["id"=>"idstr"]);?>'.replace('idstr',id);
		window.location.href = url;
	}
}

function brsearch(){
$('form').submit();
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