function redirect(url) {
	location.href = url;
}
//滚动条
$(function(){
	$(":text").addClass('input-text');
})
/**
 * 全选checkbox,注意：标识checkbox id固定为为check_box
 * @param string name 列表check名称,如 uid[]
 */
function selectall(name) {
	if ($("#check_box").attr("checked")=='checked') {
		$("input[name='"+name+"']").each(function() {
  			$(this).attr("checked","checked");
			
		});
	} else {
		$("input[name='"+name+"']").each(function() {
  			$(this).removeAttr("checked");
		});
	}
}
function openwinx(url,name,w,h) {
	if(!w) w=screen.width-4;
	if(!h) h=screen.height-95;
    window.open(url,name,"top=100,left=400,width=" + w + ",height=" + h + ",toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no");
}
//弹出对话框
function omnipotent(id,linkurl,title,close_type,w,h) {
	if(!w) w=700;
	if(!h) h=500;
	art.dialog({id:id,iframe:linkurl, title:title, width:w, height:h, lock:true},
	function(){
		if(close_type==1) {
			art.dialog({id:id}).close()
		} else {
			var d = art.dialog({id:id}).data.iframe;
			var form = d.document.getElementById('dosubmit');form.click();
		}
		return false;
	},
	function(){
			art.dialog({id:id}).close()
	});void(0);
}
function flashupload(callback)
{
window.top.art.dialog.open('/Plug/Public/swfupload.html',{title:'文件上传', width:600, height:450, lock:true,ok:function(){
		var iframe = this.iframe.contentWindow;
		var obj = iframe.document;
		var arr=get_info(obj);
		callback(arr);
		destruct(obj)
		return true;
	},cancel:true});	
}
function get_info(obj)
{
	var cu_id=$(obj).find(".cu-li .on").attr("id");
	switch(cu_id)
	{
		case 'tab_swf_1':return info1(obj);break;
		case 'tab_swf_2':return info2(obj);break;
		case 'tab_swf_3':return info3(obj);break;
		case 'tab_swf_4':return info4(obj);break;
	}
}
function info1(obj)
{
	var arr=[];
	var box=$(obj).find("#fsUploadProgress.attachment-list .img-wrap .on");

	for(var i=0;i<box.length;i++)
	{
		var info={'src':$(obj).find(box).eq(i).find("img").attr('src'),'name':$(obj).find(box).eq(i).find("img").attr('title')};
		arr.push(info);
	}
	return arr;
}
function info2(obj)
{
	var arr=[{"src":$(obj).find("#infilename").val(),'name':''}];
	return arr;
}
function info3(obj)
{
	var arr=[];
	var box=$(obj).find("#imgPreview .on");

	for(var i=0;i<box.length;i++)
	{
		var info={'src':$(obj).find(box).eq(i).find("a").attr('rel'),'name':$(obj).find(box).eq(i).find("a").attr('title')};
		arr.push(info);
	}
	return arr;
}
function info4(obj)
{
	var arr=[];
	var box=$(obj).find(".imgs-list .img-wrap .on");

	for(var i=0;i<box.length;i++)
	{
		var info={'src':$(obj).find(box).eq(i).find("img").attr('path'),'name':$(obj).find(box).eq(i).find("img").attr('title')};
		arr.push(info);
	}
	return arr;
}
function destruct(obj)
{
	$(obj).find("#fsUploadProgress.attachment-list .img-wrap .on").removeClass('on');
	$(obj).find(".imgs-list .img-wrap .on").removeClass('on');
	$(obj).find("#imgPreview .on").removeClass('on');
}
function myconfirm(tips)
{
	var href=event.target || event.srcElement;
	window.top.art.dialog.confirm(tips, function () {window.location=href;}, function () {return true;});return false;
}
function confirmurl(url,message) {
	window.top.art.dialog.confirm(message, function () {window.location=url;}, function () {return true;});return false;
}
