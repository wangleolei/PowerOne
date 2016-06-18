// 该js库是内容模型表现必须引用的库
/*
*	检查文章是否重复
*   参数 ajax_url 必须 ajax访问地址
*   参数 id 不是必须 当前文章id 
*   标题input 的id必须是title 
*/
function check_title(ajax_url,id)
{
	var title=$('#title').val();
	if($.trim(title)=='')
	{
		art.dialog.alert('标题不能为空！');
	}
	$.post(ajax_url,{'title':title,'id':id},function(data){
		if(data=='1')
		{
			art.dialog.alert('该标题没有重复！');
		}
		else
		{
			art.dialog.alert('该标题重复！');	
		}
	});
}