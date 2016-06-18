<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('/Admin/head'));echo $this->creatSubmenu();?>

<div class="pad-lr-10">
	<div class="table-list">
		<table width="100%" cellspacing="0">
			<thead>
				<tr>
					<th align="left" width="200">文件名称</th>
					<th align="left"></th>
					<th width="150">文件大小</th>
					<th width="150">备份时间</th>
					<th width="150">卷号</th>
					<th width="150" align="center">管理操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($fileArray as $v){?>
				<tr>
					<td align="left"><?php echo $v['name'];?></td>
					<td align="left"></td>
					<td align="center"><?php echo $v['size'];?></td>
					<td align="center"><?php echo date('Y-m-d H:i:s',$v['time']);?></td>
					<td align="center"><?php echo $v['number'];?></td>
					<td align="center"><a href="<?php echo U('Database/restoreData',array('sqlfilepre' => $v['pre']), '');?>">数据恢复</a> | <a href="<?php echo U('Database/delSqlFiles',array('sqlfilename' => $v['name'],'tm' =>1), '');?>">删除备份</a></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
		<div class="btn" style="position:relative;">
			<div style="width:50%; text-align:right; font-weight:bold; position:absolute; right:0px; top:0px;">
				备份文件数量：<?php echo count($fileArray);?>，占空间大小：<?php echo get_byte($size);?></div>
			</div>
	</div>
</div>
</body>
</html>