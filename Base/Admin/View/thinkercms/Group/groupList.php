<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('head'));echo $this->creatSubmenu();load_easyui($theme='default');?>
<div class="pad-lr-10">
<form name="searchform" action="" method="get">
	<table width="100%" cellspacing="0" class="search-form">
    	<input type="hidden" name="p" value="1">
		<tbody>
			<tr>
				<td><div class="explain-col"> 用户类别：
						<select name="usertype">
							<option value="0" >--全部--</option>
							<?php foreach($this->usertype as $key=>$val){?>
							<option value="<?php echo $key;?>" <?php if($_GET['usertype']==$key)echo 'selected';?>><?php echo $val;?></option>
							<?php }?>
						</select>
						<input type="submit" name="search" class="button button-tkp button-tiny" value="搜 索">
					</div></td>
			</tr>
		</tbody>
	</table>
	
</form>
</div>
<form name="myform" action="<?php echo U('listorder')?>" method="post">
<div class="pad-lr-10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
			<th width="80">排序</th>		
            <th  align="left">权限名称</th>	
			<th width="100" align="left">状态</th>
			<th width="250" align="center">管理操作</th>
            </tr>
        </thead>
	<tbody>
	<?php foreach($arr as $v){?>
		<tr>
			<td align='center'><input name='listorders[<?php echo $v['id'];?>]' type='text' size='3' value='<?php echo $v['listorder'];?>' class='input-text-c'></td>
			<td><?php echo $v['title'];?></td>
			<td align="left";><span class="red"><?php echo $v['status']?'√':'×';?></span></td>
			<td align="center">
            <?php if($v['id']!=1){?>
<a href="javascript:void(0)" class="easyui-menubutton" data-options="menu:'#mm_<?php echo $v['id'];?>'">权限管理</a>|
	<div id="mm_<?php echo $v['id'];?>" class="hidden">
		<div data-options="iconCls:'icon-23'"><a href="javascript:void(0)" onClick="setting_role(<?php echo $v['id'];?>,'<?php echo $v['title'];?>')">菜单权限</a></div>
        <div data-options="iconCls:'icon-25'"><a href="javascript:void(0)" onClick="category(<?php echo $v['id'];?>,'<?php echo $v['title'];?>')">栏目权限</a></div>
        <div data-options="iconCls:'icon-24'"><a href="javascript:void(0)" onClick="constraint(<?php echo $v['id'];?>,'<?php echo $v['title'];?>')">权限约束</a></div>
       </div> 
       <?php }?>        
			<a href="<?php echo U('/Admin/Admin/AdminList?groupid='.$v['id']);?>">成员管理</a> <?php if($v['id']!=1){?>| <a href="javascript:void(0)" onClick="edit(<?php echo $v['id'];?>,'<?php echo $v['title'];?>')">修改</a> | <a href="<?php echo U('Admin/Group/groupDelete/id/'.$v['id']);?>" onClick="return myconfirm('你确定删除这个权限组？');">删除</a><?php }?></td>
		</tr>
	<?php }?>
	</tbody>
	</table>
				<div class="btn">
				<input type="submit" class="button button-tkp button-tiny" name="dosubmit" value="排序" />
			</div>	
</div>
	<div id="pages">
	<?php echo $show;?>	
	</div>			
</div>

</form>
<script type="text/javascript">
<!--
function setting_role(id, name) {
	window.top.art.dialog.open('<?php echo U('Admin/Group/groupPrev');?>?id='+id,{title:'用户组："'+name+'"菜单权限设置', width:700, height:500, lock:true,ok:function(){var iframe = this.iframe.contentWindow;var form = iframe.document.getElementById('dosubmit');form.click();return false;},cancel:true,button: [
	        {
            name: '展开',
            callback: function () {
				var iframe = this.iframe.contentWindow;
				var ExpandAll = iframe.document.getElementById('ExpandAll');
				ExpandAll.click();
				return false;
            }
        },
        {
            name: '收起',
            callback: function () {
				var iframe = this.iframe.contentWindow;
				var CollapseAll = iframe.document.getElementById('CollapseAll');
				CollapseAll.click();
				return false;
            },
            focus: true,
        },
    ]});
}

function edit(id, name) {
	window.top.art.dialog.open('<?php echo U('Admin/Group/groupEdit');?>?id='+id,{title:'用户组："'+name+'"修改',width:500,height:120,lock:true,ok:function(){var iframe = this.iframe.contentWindow;var form = iframe.document.getElementById('dosubmit');form.click();return false;},cancel:true});
}
function constraint(id, name) {
	window.top.art.dialog.open('<?php echo U('Admin/Group/Constraint');?>?id='+id,{title:'用户组："'+name+'"权限约束设置', width:700, height:500, lock:true,ok:function(){var iframe = this.iframe.contentWindow;var form = iframe.document.getElementById('dosubmit');form.click();return false;},cancel:true});
}
//文章栏目权限
function category(id,name)
{
	window.top.art.dialog.open('<?php echo U('Admin/Group/categoryPrev');?>?id='+id,{title:'用户组："'+name+'"内容栏目 权限设置', width:700, height:500, lock:true,ok:function(){var iframe = this.iframe.contentWindow;var form = iframe.document.getElementById('dosubmit');form.click();return false;},cancel:true,button: [
	        {
            name: '展开',
            callback: function () {
				var iframe = this.iframe.contentWindow;
				var ExpandAll = iframe.document.getElementById('ExpandAll');
				ExpandAll.click();
				return false;
            }
        },
        {
            name: '收起',
            callback: function () {
				var iframe = this.iframe.contentWindow;
				var CollapseAll = iframe.document.getElementById('CollapseAll');
				CollapseAll.click();
				return false;
            },
            focus: true,
        },
    ]});
}
//-->
</script>
</body>
</html>