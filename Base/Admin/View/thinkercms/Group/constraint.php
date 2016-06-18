<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('/Admin/head'));echo $this->creatSubmenu();load_calender();?>
<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform">
	<div class="table-list">
		<table width="100%" cellspacing="0">
			<thead>
				<tr>
					<th  align="left" width="20"><input type="checkbox" value="" id="check_box" onclick="selectall('ids[]');"></th>
					<th align="left" width="30">id</th>
					<th align="left" width="250">名称</th>
					<th align="left">描述</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($lists as $v){?>
				<tr>
					<td align="left"><input type="checkbox" value="<?php echo $v['id'];?>" name="ids[]" <?php if(in_array($v['id'],$constraints))echo'checked';?>></td>
					<td align="left"><?php echo $v['id'];?></td>
					<td align="left"><?php echo $v['name']; ?></td>
					<td align="left"><?php echo $v['info'];?></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<input type="submit" id="dosubmit" class="dialog" name="dosubmit" value="提交"/>
</form>	
		<div id="pages">
	<?php echo $show;?>	
	</div>	
</div>
</body>
</html>