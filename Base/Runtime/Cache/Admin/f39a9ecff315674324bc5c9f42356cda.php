<?php if (!defined('THINK_PATH')) exit(); if($on_state == 1): ?><tr>
    <td><input type="text" form="link_add" class="form-control" name="li_title" placeholder="网站名称" maxlength="16" required /></td>
    <td><input type="text" form="link_add" class="form-control" name="li_url" placeholder="网站链接，含http" maxlength="32" required /></td>
    <td><input type="text" form="link_add" class="form-control" name="li_email" placeholder="联系邮箱" maxlength="32" required /></td>
    <td class="text-right">
        <form id="link_add"><button type="button" class="btn btn-success" onclick="link_add(this);" >新增</button></form>
    </td>
</tr><?php endif; ?>
<?php if(is_array($link)): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$linkData): $mod = ($i % 2 );++$i;?><tr>
        <td><input type="text" form="link_save<?php echo ($linkData['li_id']); ?>" class="form-control" name="li_title" placeholder="网站名称" maxlength="32" required value="<?php echo ($linkData['li_title']); ?>" /></td>
        <td><input type="text" form="link_save<?php echo ($linkData['li_id']); ?>" class="form-control" name="li_url" placeholder="网站链接" maxlength="64" required value="<?php echo ($linkData['li_url']); ?>" /></td>
        <td><input type="text" form="link_save<?php echo ($linkData['li_id']); ?>" class="form-control" name="li_email" placeholder="联系邮箱" maxlength="64" required value="<?php echo ($linkData['li_email']); ?>" /></td>
        <td class="text-right">
        <form id="link_save<?php echo ($linkData['li_id']); ?>" >
            <input type="text" name="li_id" value="<?php echo ($linkData['li_id']); ?>" hidden />
            <?php switch($on_state): case "1": ?><button type="button" class="btn btn-warning" onclick="link_save(this);" value="<?php echo ($linkData['li_id']); ?>" >保存修改</button><?php break;?>
            <?php case "2": ?><button type="button" class="btn btn-success" onclick="link_save(this);" value="<?php echo ($linkData['li_id']); ?>" >保存并通过</button>
            <button type="button" class="btn btn-warning" onclick="link_refuse(this);" value="<?php echo ($linkData['li_id']); ?>" >拒绝</button><?php break;?>
            <?php case "3": ?><button type="button" class="btn btn-warning" onclick="link_save(this);" value="<?php echo ($linkData['li_id']); ?>" >保存并通过</button><?php break; endswitch;?>
            <button type="button" class="btn btn-danger" onclick="link_delete(this);" value="<?php echo ($linkData['li_id']); ?>" >删除友链</button>
        </form>
        </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
<script type="text/javascript">
<?php switch($on_state): case "1": ?>// 新增链接
function link_add(obc){
    var copy = $(obc).clone();
    $(obc).addClass("disabled").removeAttr("onclick").html("新增链接中...");
    $.post("<?php echo U('link_add');?>",$("#link_add").serialize(),function(state){
        if(state){
            switch(state){
                case 1: alert("新增链接失败！数据库写入失败！");break;
                case 2: alert("名称、链接、邮箱是必填！");break;
                default:alert("新增失败，未知的错误原因！");
            }
            $(obc).replaceWith(copy);
        }
        else
        {
            $("#link_add")[0].reset();
            load_list($("select[name=li_state]").val());
        }
    });
}<?php break;?>
<?php case "2": ?>// 拒绝链接
function link_refuse(obc){
    var value = $(obc).val();
    var copy = $(obc).clone();
    $(obc).addClass("disabled").removeAttr("onclick").html("操作中...");
    $.get("<?php echo U('link_refuse');?>?id="+value,function(state){
        if(state){
            alert("无法找到该链接！");
            $(obc).replaceWith(copy);
        }
        else load_list($("select[name=li_state]").val());
    });
}<?php break; endswitch;?>
// 保存链接
function link_save(obc){
    var value = $(obc).val();
    var copy = $(obc).clone();
    $(obc).addClass("disabled").removeAttr("onclick").html("正在保存...");
    $.post("<?php echo U('link_save');?>",$("#link_save"+value).serialize(),function(state){
        if(state){
            switch(state){
                case 1: alert("数据没有改动！");break;
                case 2: alert("名称、链接、邮箱是必填！");break;
                case 3: alert("无法找到该链接！");break;
            }
            $(obc).replaceWith(copy);
        }
        else load_list($("select[name=li_state]").val());
    });
}
// 删除链接
function link_delete(obc){
    if(confirm("确定要删除吗？数据将无法恢复！"))
    {
        var value = $(obc).val();
        var copy  = $(obc).clone();
        $(obc).addClass("disabled").removeAttr("onclick").html("删除中...");
        $.get("<?php echo U('link_delete');?>?id="+value,function(state){
            if(state){
                alert("无法找到该链接！");
                $(obc).replaceWith(copy);
            }
            else load_list($("select[name=li_state]").val());
        });
    }
}
</script>