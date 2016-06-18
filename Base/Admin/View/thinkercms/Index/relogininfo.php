<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('head'));echo $this->creatSubmenu();load_formvalidator();?>
<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:200,height:50}, function(){this.close();$(obj).focus();})}});
		$("#passwordold").formValidator({onshow:"请输入当前密码",onfocus:"密码应该为6-20位之间",empty:false}).inputValidator({min:6,max:20,onerror:"密码应该为6-20位之间"});
		$("#password").formValidator({onshow:"不修该密码请留空",onfocus:"密码应该为6-20位之间"}).inputValidator({min:6,max:20,onerror:"密码应该为6-20位之间"});
		$("#pwdconfirm").formValidator({onshow:"不修该密码请留空",onfocus:"请输入两次密码不同。",oncorrect:"密码输入一致"}).compareValidator({desid:"password",operateor:"=",onerror:"请输入两次密码不同。"});
})
//-->
</script>
<div class="common-form pad-10">
<form name="myform" id="myform" action="" method="post">
<fieldset>
<table width="100%" class="table_form contentWrap">
      <tr>
        <th width="80">登陆帐号：</th>
        <td><?php echo session('userinfo.username')?></td>
      </tr>
	  <tr>
        <th>当前密码：</th>
        <td><input type="password" name="passwordold" id="passwordold" class="input-text"/></td>
      </tr>      
	  <tr>
        <th>新密码：</th>
        <td><input type="password" name="password" id="password" class="input-text" /></td>
      </tr>
      <tr>
        <th>确认新密码：</th>
        <td><input type="password" name="pwdconfirm" id="pwdconfirm" class="input-text"/></td>
      </tr>  		  	  
</table>
</fieldset>	  
<!--table_form_off-->
<input type="submit" id="dosubmit" class="dialog" name="dosubmit" value="提交"/>
</form>
</div>

</body>
</html>