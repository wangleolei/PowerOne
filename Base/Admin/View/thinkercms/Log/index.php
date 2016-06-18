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
					<th width="100" align="left">帐号</th>
					<th width="100" align="left">真实姓名</th>
					<th width="200" align="center">操作时间</th>
                    <th width="80" align="left">处理时长</th>
                    <th width="80" align="left">占用内存</th>
                    <th width="100" align="left">模块</th>
                    <th width="80" align="left">控制器</th>
                    <th width="80" align="left">方法</th>
                    <th width="80" align="left">参数</th>
                    <th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($list as $v){?>
				<tr>
					<td><?php echo $v['id'];?></td>
					<td align="left"><?php echo $v['username'];?></td>
					<td align="left"><?php echo $v['realname'];?></td>
					<td align="center"><?php echo date('Y-m-d H:i:s',$v['time']);?></td>
                     <td align="left"><?php echo $v['timelong'];?></td>
                     <td align="left"><?php echo $v['memory'];?></td>
                    <td align="left"><?php echo $v['m'];?></td>
                    <td align="left"><?php echo $v['c'];?></td>
                    <td align="left"><?php echo $v['a'];?></td>
                    <td width="100" align="left"><?php echo $v['data'];?></td>
                    <td></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<div id="pages"> <?php echo $show;?> </div>
</div>
</form>
</body></html>