<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('/Admin/head'));echo $this->creatSubmenu();load_calender();?>
<div class="pad-lr-10">
	<form name="searchform" action="" method="get">
		<table width="100%" cellspacing="0" class="search-form">
    	<input type="hidden" name="p" value="1">
			<tbody>
				<tr>
					<td><div class="explain-col"> 时间：
							<input type="text" name="begin_time" id="begin_time" onClick="WdatePicker()" value="<?php echo $_GET['begin_time'];?>" size="15" class="Wdate" readonly>
							-&nbsp;
							<input type="text" name="end_time" id="end_time" onClick="WdatePicker()" value="<?php echo empty($_GET['end_time'])?date('Y-m-d'):$_GET['end_time'];?>" size="15" class="Wdate" readonly>
							<input name="keyword" type="text" value="<?php echo $_GET['keyword'];?>" class="input-text search-text">
							<select name="type" class="search-select">
								<option value="1" <?php if($_GET['type']==1)echo 'selected';?>>账号</option>
								<option value="2" <?php if($_GET['type']==2)echo 'selected';?>>IP</option>
								<option value="3" <?php if($_GET['type']==3)echo 'selected';?>>地点</option>
							</select>
							<input type="submit" name="search" class="button button-tkp button-tiny" value="搜 索">
						</div></td>
				</tr>
			</tbody>
		</table>
	</form>
	<div class="table-list">
		<table width="100%" cellspacing="0">
			<thead>
				<tr>
					<th width="20" align="left">id</th>
					<th width="150" align="left">帐号</th>
					<th width="150" align="left">真实姓名</th>
					<th  width="150" align="left">登陆ip</th>
					<th  width="200" align="center">登陆时间</th>
					<th  align="left">登陆地点</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($list as $v){?>
				<tr>
					<td><?php echo $v['id'];?></td>
					<td align="left"><?php echo $v['username'];?></td>
					<td align="left"><?php echo $v['realname'];?></td>
					<td align="left"><?php echo $v['ip'];?></td>
					<td align="center"><?php echo date('Y-m-d H:i:s',$v['time']);?></td>
					<td align="left"><?php echo $v['area'];?></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<div id="pages"> <?php echo $show;?> </div>
</div>
</form>
</body></html>