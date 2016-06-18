<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('head'));echo $this->creatSubmenu();load_formvalidator();?>

<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:200,height:50}, function(){this.close();$(obj).focus();})}});
		$("#title").formValidator({onshow:"请输入分组名称",onfocus:"请输入分组名称",oncorrect:"输入正确"}).inputValidator({min:1,onerror:"请输入分组名称"});
	})
//-->
</script>
<div class="common-form pad-10">
<form name="myform" id="myform" action="<?php echo U('Group/groupEdit?id='.$_GET['id']);?>" method="post">
<table width="100%" class="table_form contentWrap">
      <tr>
        <th width="80">分组名称：</th>
        <td><input type="text" name="info[title]" id="title" class="input-text" value="<?php echo $info['title'];?>"></td>
      </tr> 	  
	  <tr>
        <th>状态：</th>
        <td><input type="radio" name="info[status]" value="1" <?php if($info['status']==1)echo 'checked';?>> 启用<input type="radio" name="info[status]" value="0" <?php if($info['status']==0)echo 'checked';?>> 禁用</td>
      </tr>
</table>	  
<!--table_form_off-->
<input type="submit" id="dosubmit" class="dialog" name="dosubmit" value="提交"/>

</div>
</body>
</html>