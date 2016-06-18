<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('head'));echo $this->creatSubmenu();?>
<div class="pad-lr-10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="100">id</th>
            <th  align="left">菜单名称</th>
            </tr>
        </thead>
	<tbody>
	<?php echo $categorys;?>
	</tbody>
    </table>
</div>
</div>

</body>
</html>