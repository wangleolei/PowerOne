<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('head'));echo $this->creatSubmenu();load_formvalidator();?>
<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:200,height:50}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"请输入菜单名称",onfocus:"请输入菜单名称",oncorrect:"输入正确"}).inputValidator({min:1,onerror:"请输入菜单名称"});
		$("#m").formValidator({onshow:"请输入模块名",onfocus:"请输入模块名",oncorrect:"输入正确"}).inputValidator({min:1,onerror:"请输入模块名"});
		$("#c").formValidator({onshow:"请输入文件名",onfocus:"请输入文件名",oncorrect:"输入正确"}).inputValidator({min:1,onerror:"请输入文件名"});
		$("#a").formValidator({tipid:'a_tip',onshow:"请输入方法名",onfocus:"请输入方法名",oncorrect:"输入正确"}).inputValidator({min:1,onerror:"请输入方法名"});
	})
//-->
</script>
<div class="common-form pad-10">
<form name="myform" id="myform" action="<?php echo U('Menu/edit?menuid='.$_GET['menuid']);?>" method="post">
<table width="100%" class="table_form contentWrap">
      <tr>
        <th width="200">上级菜单：</th>
        <td><select name="info[parentid]" style="width:200px;">
 <option value="0">作为一级菜单</option>
 <?php echo $select_categorys;?>
</select></td>
      </tr>
      <tr>
        <th>菜单名称：</th>
        <td><input type="text" name="info[name]" id="name" class="input-text" value="<?php echo $info['name'];?>"></td>
      </tr>
	<tr>
        <th>模块名：</th>
        <td><input type="text" name="info[m]" id="m" class="input-text" value="<?php echo $info['m'];?>"></td>
      </tr>
	<tr>
        <th>控制器名：</th>
        <td><input type="text" name="info[c]" id="c" class="input-text" value="<?php echo $info['c'];?>"></td>
      </tr>
	<tr>
        <th>方法名：</th>
        <td><input type="text" name="info[a]" id="a" class="input-text" value="<?php echo $info['a'];?>">  <span id="a_tip"></span>通过AJAX 传递的方法，请使用 ajax_开头，方法不做权限验证请以public_开头</td>
      </tr>
	<tr>
        <th>附加参数：</th>
        <td><input type="text" name="info[data]" class="input-text" value="<?php echo $info['data'];?>">如果传递的参数需要权限验证,使用pow_开头,获取动态get变量的值用get_变量名称</td>
      </tr>
	<tr>
        <th>是否在主导航中显示：</th>
        <td><input type="radio" name="info[display]" value="1"<?php echo $info['display']==1 ? 'checked' : ''; ?>> 是<input type="radio" name="info[display]" value="0" <?php echo $info['display']==0 ? 'checked' : ''; ?>> 否</td>
      </tr>
</table>	  
<fieldset style="margin-top:10px;">
	<legend>副导航</legend>
<table width="100%" class="table_form contentWrap pad-10">	  
	<tr>
        <th width="200">是否在副菜单中展示：</th>
        <td><input type="radio" name="info[project1]" value="1" <?php echo $info['project1']==1 ? 'checked' : ''; ?>> 是<input type="radio" name="info[project1]" value="0" <?php echo $info['project1']==0 ? 'checked' : ''; ?>> 否</td>
      </tr>
	<tr>
	<tr>
        <th>是否为重点显示：</th>
        <td><input type="radio" name="info[project3]" value="1" <?php echo $info['project3']==1 ? 'checked' : ''; ?>> 是<input type="radio" name="info[project3]" value="0" <?php echo $info['project3']==0 ? 'checked' : ''; ?>> 否</td>
      </tr>	
	<tr>
        <th width="200">是否为弹出窗口：</th>
        <td><input type="radio" name="info[project2]" value="1" <?php echo $info['project2']==1 ? 'checked' : ''; ?>> 是<input type="radio" name="info[project2]" value="0" <?php echo $info['project2']==0 ? 'checked' : ''; ?>> 否</td>
      </tr>
	<tr>
	<tr>
        <th width="200">弹出窗口大小：</th>
        <td>高：<input type="text" name="info[project4]" value="<?php echo $info['project4'];?>" style="width:40px !important;">px 宽：<input type="text" name="info[project5]" value="<?php echo $info['project5'];?>" style="width:40px !important;">px</td>
      </tr>
	<tr>
	<tr>
        <th width="200">是否在新窗口打开：</th>
        <td><input type="radio" name="info[target]" value="1" <?php echo $info['target']==1 ? 'checked' : ''; ?>> 是<input type="radio" name="info[target]" value="0" <?php echo $info['target']==0 ? 'checked' : ''; ?>> 否</td>
      </tr>	
	<tr>
        <th width="200">此窗口是否显示副导航：</th>
        <td><input type="radio" name="info[project6]" value="1" <?php echo $info['project6']==1 ? 'checked' : ''; ?>> 是<input type="radio" name="info[project6]" value="0" <?php echo $info['project6']==0 ? 'checked' : ''; ?>> 否</td>
      </tr>
	<tr>		
	</table>   
</fieldset>
    <div class="bk15"></div>
    <div class="btn"><input type="submit" id="dosubmit" class="button button-tkp button-tiny" name="dosubmit" value="提交"/></div>
</form>
</div>
</body>
</html>