$(function(){
	$('.delete').click(function(){
		if(confirm('是否删除')){
			$(this).parents('tr').remove();
		};
	});
	$('ol li button').click(function(){
		if(confirm('是否删除')){
			$(this).parents('ol').remove();
		};
	});
});