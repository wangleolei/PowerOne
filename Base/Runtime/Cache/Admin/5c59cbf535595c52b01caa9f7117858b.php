<?php if (!defined('THINK_PATH')) exit(); switch($us_type): case "3": ?><thead>
<tr>
    <th style="width: 110px;">ID</th>
    <th style="width: 110px;">状态</th>
    <th style="width: 150px;">管理组</th>
    <th style="width: 160px;">账户</th>
    <th style="width: 200px;">最后登录时间</th>
    <th style="width: 200px;">最后登录IP</th>
    <th style="width: 206px;">邮箱</th>
</tr>
</thead>
<tbody>
<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$userData): $mod = ($i % 2 );++$i;?><tr>
    <td><?php echo ($userData['ad_id']); ?></td>
    <td><?php if($userData['ad_state'] == 2): ?>禁止登陆<?php else: ?>正常<?php endif; ?></td>
    <td><?php switch($userData['ad_group']): case "1": ?>超级管理员<?php break; default: ?>体验账户<?php endswitch;?></td>
    <td><?php echo ($userData['ad_username']); ?></td>
    <td><?php echo (date("Y/m/d H:i",$userData['ad_last_time'])); ?></td>
    <td><?php echo ($userData['ad_last_ip']); ?></td>
    <td><?php echo ($userData['ad_email']); ?></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</tbody><?php break;?>
<?php case "2": ?><thead>
<tr>
    <th style="width: 66px;">头像</th>
    <th style="width: 200px;">昵称</th>
    <th style="width: 150px;">最后登录时间</th>
    <th style="width: 150px;">最后访问IP</th>
    <th style="width: 170px;">最后访问地址</th>
    <th style="width: 100px;">最后访问系统</th>
    <th style="width: 300px;" >邮箱</th>
</tr>
</thead>
<tbody>
<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$userData): $mod = ($i % 2 );++$i;?><tr>
    <td><img class="img-circle" src="<?php echo ($userData['us_portrait']); ?>" style="width:40px;height:40px;"></td>
    <td><h5><?php echo ($userData['us_nickname']); ?></h5></td>
    <td><h5><?php echo (date("Y/m/d H:i",$userData['us_last_time'])); ?></h5></td>
    <td><h5><?php echo ($userData['us_last_ip']); ?></h5></td>
    <td><h5><?php echo ($userData['place']); ?></h5></td>
    <td><h5><?php echo ($userData['us_last_os']); ?></h5></td>
    <td><h5><?php echo ($userData['us_email']); ?></h5></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</tbody><?php break;?>
<?php case "1": ?><thead><tr><th colspan="8" class="text-center">暂无此功能，正在开发中...</th></tr></thead><?php break; endswitch;?>
<?php if($button != null): ?><tfoot><tr><td colspan="8" class="text-center"><?php echo ($button); ?></td></tr></tfoot>
<script type="text/javascript">
$(".page-ul li a").removeAttr("href");
$(".page-ul li a").click(function()
    {
        var active = $('.page-ul li.page-on a').text();        // 当前页
        var button = $(this).text();                           // 点击的按钮
        switch(button)
        {
        case '上一页': var to = (parseInt(active)-1); break;
        case '下一页': var to = (parseInt(active)+1); break;
        case '尾页'  : var to = <?php echo ($pages); ?>;             break;
        case '首页'  : var to = 1;                    break;
        default      : var to = button;
        }
        $.get("<?php echo U('user_list');?>?page="+to,function(list){$("table#list-user").html(list);});
    });
</script><?php endif; ?>