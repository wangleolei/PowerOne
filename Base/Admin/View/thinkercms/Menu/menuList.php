<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('head'));echo $this->creatSubmenu();?>
<form name="myform" action="<?php echo U('listorder')?>" method="post">
	<div class="pad-lr-10">
		<div class="table-list">
			<table width="100%" cellspacing="0">
				<thead>
					<tr>
						<th width="80">排序</th>
						<th width="100">id</th>
						<th  align="left">菜单名称</th>
						<th width="180">管理操作</th>
					</tr>
				</thead>
				<tbody>
					<?php echo $categorys;?>
				</tbody>
			</table>
			<div class="btn">
				<input type="submit" class="button button-tkp button-tiny" name="dosubmit" value="排序" />
			</div>
		</div>
	</div>
	</div>
</form>
</body>
</html>