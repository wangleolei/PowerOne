<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('/Admin/head'));echo $this->creatSubmenu();?>
<div class="pad-10">
	<div class="col-2">
		<h6>提示区：</h6>
		<div class="sbs" id="update_tips" style="height:360px; overflow:auto;">
			<ul id="file" class="sbul">
			</ul>
		</div>
	</div>
</div>
</html>