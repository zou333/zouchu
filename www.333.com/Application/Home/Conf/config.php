<?php
return array(
	//'配置项'=>'配置值'
	
	
	
	'TMPL_PARSE_STRING'  =>array(
		 '__PUBLIC__' => '/Public/Home/', // 更改默认的/Public 替换规则
		 '__UPLOAD__' => '/Uploads', // 增加新的上传路径替换规则
	),
	
	// 模板布局配置
	'LAYOUT_ON'=>true, // 打开模板布局
	'LAYOUT_NAME'=>'Layout/index', // 布局文件名称
);