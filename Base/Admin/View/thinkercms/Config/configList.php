<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('head'));echo $this->creatSubmenu();load_formvalidator();load_buttons();?>
<style type="text/css">
.watermark-table tr td{ border-bottom:none;}
</style>
<script type="text/javascript">
<!--
	$(function(){
		SwapTab('setting','on','',5,1);
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:200,height:50}, function(){this.close();$(obj).focus();})}});		
		$("#js_path").formValidator({onshow:"请输入JS路径",onfocus:"JS路径请以“/”结尾"}).inputValidator({onerror:"JS路径输入有误"}).regexValidator({regexp:"(.+)\/$",onerror:"JS路径请以“/”结尾"});
		$("#css_path").formValidator({onshow:"请输入CSS路径",onfocus:"CSS路径请以“/”结尾"}).inputValidator({onerror:"CSS路径输入有误"}).regexValidator({regexp:"(.+)\/$",onerror:"CSS路径请以“/”结尾"});
		
		$("#img_path").formValidator({onshow:"请输入图片路径",onfocus:"图片路径请以“/”结尾"}).inputValidator({onerror:"图片路径输入有误"}).regexValidator({regexp:"(.+)\/$",onerror:"图片路径请以“/”结尾"});
			
		$("#site_host").formValidator({onshow:"请输入站点主域名",onfocus:"请输入站点主域名"}).inputValidator({onerror:"请输入站点主域名"});
		$("#upload_host").formValidator({onshow:"请输入你的图片服务器地址",onfocus:"例如：http://img.thinkerphp.com"}).inputValidator({onerror:"你输入的图片服务器地址有误"});
		$("#errorlog_size").formValidator({onshow:"请输入文件尺寸",onfocus:"请输入错误日志预警大小"}).inputValidator({onerror:"错误日志预警大小输入有误"}).regexValidator({regexp:"num",datatype:"enum",onerror:"文件尺寸为整数或小数"});
		$("#cachetime").formValidator({empty:true,onshow:"请输入网站的缓存时间，0代表永久缓存",onfocus:"请输入网站的缓存时间，0代表永久缓存"}).regexValidator({regexp:"num1",datatype:"enum",onerror:"请输入一个大于等于0的整数"});	
	})
//-->
</script>
<form action="<?php echo U('Config/edit');?>" method="post" id="myform" enctype="multipart/form-data">
<div class="pad-10">
<div class="col-tab">
<ul class="tabBut cu-li">
    <li id="tab_setting_1" class="on" onclick="SwapTab('setting','on','',6,1);">基本配置</li>
    <li id="tab_setting_2" onclick="SwapTab('setting','on','',6,2);">安全配置</li>
    <li id="tab_setting_6" onclick="SwapTab('setting','on','',6,6);">文件上传</li>
    <li id="tab_setting_4" onclick="SwapTab('setting','on','',6,4);">邮箱配置</li>
</ul>
<div id="div_setting_1" class="contentList pad-10">
<table width="100%"  class="table_form">
  <tr>
    <th width="120">系统名称</th>
    <td class="y-bg"><input type="text" class="input-text" name="system[system_name]" id="admin_email" size="30" value="<?php echo $config['system_name'];?>"/></td>
  </tr>
  <tr>
    <th width="120">系统LOGO</th>
    <td class="y-bg"><input type="text" class="input-text" name="system[system_logo]" id="admin_email" size="30" value="<?php echo $config['system_logo'];?>"/><font color="gray">默认值：/Public/images/admin_img/logo.png</font></td>
  </tr>  
  <tr>
    <th width="120">开启附件状态统计</th>
    <td class="y-bg">
    <input name="setconfig[attachment_stat]" value="1"  type="radio"   checked> 是&nbsp;&nbsp;&nbsp;&nbsp;
	<input  name="setconfig[attachment_stat]" value="0" type="radio"  > 否&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">记录附件使用状态 ，删除文章时同步删除附件。注意: 本功能会加重服务器负担</font></td>
  </tr> 	
  <tr>
    <th width="120">JS路径</th>
    <td class="y-bg"><input type="text" class="input-text" name="system[js_path]" id="js_path" size="50" value="<?php echo $config['js_path'];?>" /></td>
  </tr>
  <tr>
    <th width="120">CSS路径</th>
    <td class="y-bg"><input type="text" class="input-text" name="system[css_path]" id="css_path" size="50" value="<?php echo $config['css_path'];?>"/></td>
  </tr> 
  <tr>
    <th width="120">图片路径</th>
    <td class="y-bg"><input type="text" class="input-text" name="system[img_path]" id="img_path" size="50" value="<?php echo $config['img_path'];?>" /></td>
  </tr>
  <tr>
    <th width="120">网站域名</th>
    <td class="y-bg"><input type="text" class="input-text" name="system[site_host]" id="site_host" size="50" value="<?php echo $config['site_host'];?>" /></td>
  </tr>
  <tr>
    <th width="120">网站缓存时间</th>
    <td class="y-bg"><input type="text" class="input-text" name="system[cachetime]" id="cachetime" value="<?php echo $config['cachetime'];?>" /></td>
  </tr>   
</table>
</div>
<div id="div_setting_2" class="contentList pad-10 hidden">
	<table width="100%"  class="table_form">
  <tr>
    <th width="120">启用后台管理操作日志</th>
    <td class="y-bg">
	  <input name="system[admin_log]" value="1" type="radio" <?php echo ($config['admin_log']==1)?'checked':'';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
	  <input name="system[admin_log]" value="0" type="radio" <?php echo ($config['admin_log']==0)?'checked':'';?>> 否     </td>
  </tr>
  <tr>
    <th width="120">保存错误日志</th>
    <td class="y-bg">
	  <input name="system[LOG_RECORD]" value="1" type="radio" <?php if($config['LOG_RECORD']){echo 'checked';}?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
	  <input name="system[LOG_RECORD]" value="0" type="radio" <?php if(!$config['LOG_RECORD']){echo 'checked';}?>> 否     </td>
  </tr> 
  <tr>
    <th>错误日志预警大小</th>
    <td class="y-bg"><input type="text" class="input-text" name="system[errorlog_size]" id="errorlog_size" size="5" value="<?php echo $config['errorlog_size'];?>"/> MB</td>
  </tr>     

  <tr>
    <th>后台最大登陆失败次数</th>
    <td class="y-bg"><input type="text" class="input-text" name="system[maxloginfailedtimes]" id="maxloginfailedtimes" size="10" value="<?php echo $config['maxloginfailedtimes'];?>"/></td>
  </tr>

  <tr>
    <th>连续两次刷新最短间隔</th>
    <td class="y-bg"><input type="text" class="input-text" name="system[minrefreshtime]" id="minrefreshtime" size="10" value="<?php echo $config['minrefreshtime'];?>"/> 秒</td>
  </tr>
  <tr>
    <th>后台访问域名</th>
    <td class="y-bg"><TABLE>
    <TR>
		<TD width="300">http:// <input type="text" class="input-text" name="system[admin_url]" id="admin_url" size="30" value="<?php echo $config['admin_url'];?>"/> </TD>
		<TD align="right">例如：admin.thinkerphp.com，绑定后，只能通过该域名登陆。</TD>
    </TR>
    </TABLE> </td>
  </tr> 
</table>
</div>
<div id="div_setting_4" class="contentList pad-10 hidden">
<table width="100%"  class="table_form">
  <tr>
    <th width="120">邮件发送模式</th>
    <td class="y-bg">
     <input name="setting[mail_type]" checkbox="mail_type" value="1" onclick="showsmtp(this)" type="radio"  checked> SMTP 函数发送
	</td>
  </tr>
  <tbody id="smtpcfg" style="">
  <tr>
    <th>邮件服务器</th>
    <td class="y-bg"><input type="text" class="input-text" name="system[mail_server]" id="mail_server" size="30" value="<?php echo $config['mail_server'];?>"/></td>
  </tr>  
  <tr>
    <th>邮件发送端口</th>
    <td class="y-bg"><input type="text" class="input-text" name="system[mail_port]" id="mail_port" size="30" value="<?php echo $config['mail_port'];?>"/></td>
  </tr> 
  <tr>
    <th>发件人地址</th>
    <td class="y-bg"><input type="text" class="input-text" name="system[mail_from]" id="mail_from" size="30" value="<?php echo $config['mail_from'];?>"/></td>
  </tr>   
  <tr>
    <th>AUTH LOGIN验证</th>
    <td class="y-bg">
    <input name="system[mail_auth]" checkbox="mail_auth" value="1" type="radio" <?php echo ($config['mail_auth']==1)?'checked':'';?>> 开启	<input name="system[mail_auth]" checkbox="mail_auth" value="0" type="radio" <?php echo ($config['mail_auth']==0)?'checked':'';?>> 关闭</td>
  </tr> 

	  <tr>
	    <th>验证用户名</th>
	    <td class="y-bg"><input type="text" class="input-text" name="system[mail_user]" id="mail_user" size="30" value="<?php echo $config['mail_user'];?>"/></td>
	  </tr> 
	  <tr>
	    <th>验证密码</th>
	    <td class="y-bg"><input type="text" class="input-text" name="system[mail_password]" id="mail_password" size="30" value="<?php echo $config['mail_password'];?>"/></td>
	  </tr>

 </tbody>
  <tr>
    <th>邮件设置测试</th>
    <td class="y-bg"><input type="text" class="input-text" name="mail_to" id="mail_to" size="30" value=""/> <input type="button" class="button button-tkp button-tiny" onClick="javascript:test_mail();return false;" value="测试发送"></td>
  </tr>           
  </table>
</div>
<div id="div_setting_6" class="contentList pad-10 hidden">
<table width="100%"  class="table_form">
  <tr>
    <th width="120">文件上传模式</th>
    <td class="y-bg">
     <input name="system[FILE_UPLOAD_TYPE]" value="Local" type="radio" <?php echo ($config['FILE_UPLOAD_TYPE']=='Local')?'checked':'';?>/> 本地
	</td>
  </tr>
  <tr>
    <th width="120">文件上传绑定域名</th>
    <td class="y-bg"><input type="text" class="input-text" name="system[upload_host]" id="upload_host" size="50" value="<?php echo $config['upload_host'];?>" /></td>
  </tr>    
  <tr>
    <th width="120">上传文件大小限制</th>
    <td class="y-bg">
     <input type="text" class="input-text" name="system[UPLOAD_FILE_MAX_SIZE]" id="" size="20" value="<?php echo $config['UPLOAD_FILE_MAX_SIZE'];?>"/> 	KB
	</td>
  </tr>
  <tr>
    <th width="120">缩略图规格选项</th>
    <td class="y-bg">
     <input type="text" class="input-text" name="system[THUMB_SPEC]" id="" size="50" value="<?php echo $config['THUMB_SPEC'];?>"/>
     例如：135,800 代表缩略图规格包括135*135,800*800
	</td>
  </tr>            
 </table> 
</div>
<div class="bk15"></div>
<a href="javascript:void(0)" onclick="$('#myform').submit();" class="button button-tkp button-tiny">提交</a>
</div>
</div>
</form>
</body>
<script type="text/javascript">
function test_mail(){
	var mailto=$.trim($("#mail_to").val());
	if(mailto!='')
	{
		$.post('<?php echo U('test_mail')?>',{'mailto':mailto},function(data){
			if(data=='success')
			{
				window.top.art.dialog.alert('发送成功！');
			}
			else
			{
				window.top.art.dialog.alert(data);
			}
		})
	}	
}
function SwapTab(name,cls_show,cls_hide,cnt,cur){
    for(i=1;i<=cnt;i++){
		if(i==cur){
			 $('#div_'+name+'_'+i).show();
			 $('#tab_'+name+'_'+i).attr('class',cls_show);
		}else{
			 $('#div_'+name+'_'+i).hide();
			 $('#tab_'+name+'_'+i).attr('class',cls_hide);
		}
	}
}

function showsmtp(obj,hiddenid){
	hiddenid = hiddenid ? hiddenid : 'smtpcfg';
	var status = $(obj).val();
	if(status == 1) $("#"+hiddenid).show();
	else  $("#"+hiddenid).hide();
}
</script>
</html>