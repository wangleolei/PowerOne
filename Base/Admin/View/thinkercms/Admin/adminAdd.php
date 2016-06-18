<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('head'));echo $this->creatSubmenu();load_formvalidator();?>
<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:200,height:50}, function(){this.close();$(obj).focus();})}});
		$("#username").formValidator({onshow:"请输入用户名",onfocus:"用户名应该为2-20位之间"}).inputValidator({min:2,max:20,onerror:"用户名应该为2-20位之间"}).regexValidator({regexp:"ps_username",datatype:"enum",onerror:"用户名格式错误"}).ajaxValidator({
	    type : "get",
		url : "<?php echo U('ajax_check_username');?>",
		data :"",
		datatype : "html",
		async:'false',
		success : function(data){
            if( data == "1" ) {
                return true;
			} else {
                return false;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "禁止注册或用户已存在。",
		onwait : "请稍候..."
	});

		$("#password").formValidator({onshow:"请输入密码",onfocus:"密码应该为6-20位之间"}).inputValidator({min:6,max:20,onerror:"密码应该为6-20位之间"});
		$("#pwdconfirm").formValidator({onshow:"请输入确认密码",onfocus:"请输入两次密码不同。",oncorrect:"密码输入一致"}).compareValidator({desid:"password",operateor:"=",onerror:"请输入两次密码不同。"});
		$("#email").formValidator({onshow:"请输入邮箱",onfocus:"邮箱格式错误",oncorrect:"邮箱格式正确"}).inputValidator({min:2,max:32,onerror:"邮箱应该为2-32位之间"}).regexValidator({regexp:"email",datatype:"enum",onerror:"邮箱格式错误"}).ajaxValidator({
	    type : "get",
		url : "<?php echo U('ajax_check_email');?>",
		data :"",
		datatype : "html",
		async:'false',
		success : function(data){
			//document.write(data);
            if( data == "1" ) {
                return true;
			} else {
                return false;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "禁止注册或邮箱已存在",
		onwait : "请稍候..."
	});
	$("#realname").formValidator({onshow:"请输入昵称",onfocus:"昵称应该为2-20位之间"}).inputValidator({min:2,max:20,onerror:"昵称名应该为2-20位之间"}).regexValidator({regexp:"ps_username",datatype:"enum",onerror:"昵称名格式错误"})	
})
//-->
</script>
<div class="common-form pad-10">
<form name="myform" id="myform" action="" method="post">
<fieldset>
	<legend>基本信息</legend>
<table width="100%" class="table_form contentWrap">
      <tr>
        <th width="80">登陆帐号：</th>
        <td><input type="text" name="info[username]" id="username" class="input-text" value=""></td>
      </tr>
	  <tr>
        <th>密码：</th>
        <td><input type="password" name="info[password]" id="password" class="input-text"/></td>
      </tr>
      <tr>
        <th>确认密码：</th>
        <td><input type="password" name="pwdconfirm" id="pwdconfirm" class="input-text"/></td>
      </tr>
      <tr>
        <th>所属权限组：</th>
        <td>
			<select name="group[groupid]">
				<?php foreach ($auth_group as $v){?>
				<option value="<?php echo $v['id'];?>"><?php echo $v['title'];?></option>
				<?php }?>
			</select>
		</td>
      </tr>		  
      <tr>
        <th>Email：</th>
        <td><input type="text" name="info[email]" class="input-text" id="email" size="30"/></td>
      </tr>
      <tr>
        <th>真实姓名：</th>
        <td><input type="text" name="info[realname]" id="realname" class="input-text"/></td>
      </tr>	  		  	  
</table>
</fieldset>	
<input type="submit" id="dosubmit" class="dialog" name="dosubmit" value="提交"/>
</form>
</div>
</body>
</html>