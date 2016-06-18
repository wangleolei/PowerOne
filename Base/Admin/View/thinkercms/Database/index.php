<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('/Admin/head'));echo $this->creatSubmenu();load_calender();?>

<div class="pad-lr-10">
<form name="myform" action="<?php echo U('backup')?>" method="post" id="myform">
	<div class="table-list">
		<table width="100%" cellspacing="0">
			<thead>
				<tr>
					<th  align="left" width="20"><input type="checkbox" value="" id="check_box" onclick="selectall('key[]');"></th>
					<th align="left" width="200">表名</th>
					<th align="left">描述</th>
					<th width="150">记录行数</th>
					<th width="100">引擎</th>
					<th width="150">字符集</th>
					<th width="150">表大小</th>
					<th width="100" align="center">管理操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($dbtables as $v){?>
				<tr>
					<td align="left"><input type="checkbox" value="<?php echo $v['name'];?>" name="key[]"></td>
					<td align="left"><?php echo $v['name'];?></td>
					<td align="left"><?php echo $v['comment']; ?></td>
					<td align="center"><?php echo $v['rows'];?></td>
					<td align="center"><?php echo $v['engine'];?></td>
					<td align="center"><?php echo $v['collation'];?></td>
					<td align="center"><?php echo $v['size'];?></td>
					<td align="center"><a href="<?php echo U('optimize',array('tablename'=>$v['name']));?>">优化</a> | <a href="<?php echo U('repair',array('tablename'=>$v['name']));?>">修复</a></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
		<div class="btn" style="position:relative;">
			<input type="submit" class="button button-tkp button-tiny" name="dosubmit" value="备份" />
			<input type="submit" class="button button-tkp button-tiny" name="dosubmit" value="优化" onClick="$('#myform').attr('action','<?php echo U('optimize',array('batchFlag'=>1));?>')"/>
			<input type="submit" class="button button-tkp button-tiny" name="dosubmit" value="修复" onClick="$('#myform').attr('action','<?php echo U('repair',array('batchFlag'=>1));?>')"/>
			<div style="width:50%; text-align:right; font-weight:bold; position:absolute; right:0px; top:0px;">
				数据库中共有<?php echo $tableNum;?>张表，共<?php echo $total;?> </div>
			</div>
	</div>
</form>	
</div>
</body>
</html>