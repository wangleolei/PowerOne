<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('head'));echo $this->creatSubmenu();?>
<form name="myform" action="<?php echo U('listorder')?>" method="post">
<div class="pad-lr-10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="120" align="left">登陆帐号</th>
			<th width="150" align="left">真实名称</th>
			<th width="150" align="left">绑定E-mail</th>
			<th width="150" align="left">用户身份</th>
			<th align="left">所属权限组</th>
			<th width="100" align="center">管理操作</th>
            </tr>
        </thead>
	<tbody>
	<?php foreach($list as $v){?>
		<tr>
			<td align="left"><?php echo $v['username'];?></td>
			<td align="left"><?php echo $v['realname'];?></td>
			<td align="left"><?php echo $v['email'];?></td>
			<td align="left"><?php echo $usertype[$v['usertype']];?></td>
			<td align="left"><?php echo $v['title'];?></td>
			<td align="center"><a href="javascript:void(0)" onClick="edit('<?php echo $v['userid'];?>','<?php echo $v['username'];?>')">修改</a> | <?php if($v['userid']!=1){?><a href="<?php echo U('Admin/Admin/adminDelete/id/'.$v['userid']);?>" onClick="return myconfirm('你确定删除该用户？')">删除</a><?php }else{?><font color="#ccc">删除</font><?php }?></td>
		</tr>
	<?php }?>
</tbody>
</table>
</div>	
	<div id="pages">
	<?php echo $show;?>	
	</div>		
</div>
</form>
<script type="text/javascript">
function edit(id, name) {
		window.top.art.dialog.open('<?php echo U('Admin/Admin/adminEdit');?>?id='+id,{title:'用户："'+name+'"修改',width:550,height:270,lock:true,ok:function(){var iframe = this.iframe.contentWindow;var form = iframe.document.getElementById('dosubmit');form.click();return false;},cancel:true});
}
</script>
</body>
</html>