<?php if (!defined('THINK_PATH')) exit(); if($on_state == 1): ?><thead>
<tr>
    <th style="width: 110px;">ID</th>
    <th style="width: 120px;">状态</th>
    <th style="width: 500px;">文档标题</th>
    <th style="width: 146px;">发布时间</th>
    <th style="width: 110px;" class="text-right">点击量</th>
    <th style="width: 150px;" class="text-right">执行操作</th>
</tr>
</thead>
<tbody>
<?php if(is_array($article)): $i = 0; $__LIST__ = $article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$articleData): $mod = ($i % 2 );++$i;?><tr>
    <td><?php echo ($articleData['ar_id']); ?></td>
    <td>
        <?php switch($articleData['ar_position']): case "1": ?><button class="btn btn-xs btn-default" onclick="article_state(this,'position',3);" value="<?php echo ($articleData['ar_id']); ?>" >顶</button>
            <button class="btn btn-xs btn-info" onclick="article_state(this,'position',0);" value="<?php echo ($articleData['ar_id']); ?>" >荐</button><?php break;?>
        <?php case "2": ?><button class="btn btn-xs btn-danger" onclick="article_state(this,'position',0);" value="<?php echo ($articleData['ar_id']); ?>" >顶</button>
            <button class="btn btn-xs btn-default" onclick="article_state(this,'position',3);" value="<?php echo ($articleData['ar_id']); ?>" >荐</button><?php break;?>
        <?php case "3": ?><button class="btn btn-xs btn-danger" onclick="article_state(this,'position',1);" value="<?php echo ($articleData['ar_id']); ?>" >顶</button>
            <button class="btn btn-xs btn-info" onclick="article_state(this,'position',2);" value="<?php echo ($articleData['ar_id']); ?>" >荐</button><?php break;?>
        <?php default: ?>
            <button class="btn btn-xs btn-default" onclick="article_state(this,'position',2);" value="<?php echo ($articleData['ar_id']); ?>" >顶</button>
            <button class="btn btn-xs btn-default" onclick="article_state(this,'position',1);" value="<?php echo ($articleData['ar_id']); ?>" >荐</button><?php endswitch;?>
        <?php if($articleData['ar_wechat'] > 0): ?><button class="btn btn-xs btn-success" onclick="article_state(this,'wechat',0);" value="<?php echo ($articleData['ar_id']); ?>" >微</button>
        <?php else: ?>
            <button class="btn btn-xs btn-default" onclick="article_state(this,'wechat',1);" value="<?php echo ($articleData['ar_id']); ?>" >微</button><?php endif; ?>
        <?php if($articleData['ar_file'] > 0): ?><span class="label label-success" title="文档中存在附件">附</span><?php endif; ?>
    </td>
    <td><?php echo ($articleData['ar_title']); ?></td>
    <td><?php echo (date("Y/m/d H:i",$articleData['ar_time'])); ?></td>
    <td class="text-right"><?php echo ($articleData['ar_hits']); ?></td>
    <td class="text-right">
        <a href="<?php echo U('article_publish?id='.$articleData['ar_id']);?>" class="btn btn-xs btn-warning" >编辑</a>
        <button type="button" class="btn btn-xs btn-danger" onclick="if(confirm('文档将进入回收站，确定要删除吗？'))article_state(this,'state',3,'ar_class');" value="<?php echo ($articleData['ar_id']); ?>">删除</button>
    </td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</tbody>
<?php else: ?>
<thead>
<tr>
    <th style="width: 110px;">ID</th>
    <th style="width: 470px;">文档标题</th>
    <th style="width: 180px;">类别</th>
    <th style="width: 140px;">最后编辑于</th>
    <th style="width: 236px;" class="text-right">执行操作</th>
</tr>
</thead>
<tbody>
<?php if(is_array($article)): $i = 0; $__LIST__ = $article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$articleData): $mod = ($i % 2 );++$i;?><tr>
    <td><?php echo ($articleData['ar_id']); ?></td>
    <td><?php echo ($articleData['ar_title']); ?></td>
    <td><?php echo (get_class_name($articleData['ar_class'])); ?></td>
    <td><?php echo (date("Y/m/d H:i",$articleData['ar_last_time'])); ?></td>
    <td class="text-right">
        <input hidden type="text" name="se_type" value="<?php echo ($setingData["id"]); ?>" >
        <?php switch($on_state): case "2": ?><button type="button" class="btn btn-xs btn-success " onclick="article_state(this,'state',1);" value="<?php echo ($articleData['ar_id']); ?>" >正式发布</button>
        <button type="button" class="btn btn-xs btn-danger" onclick="article_state(this,'state',3);" value="<?php echo ($articleData['ar_id']); ?>" >扔入回收站</button><?php break;?>
        <?php case "3": ?><button type="button" class="btn btn-xs btn-success " onclick="article_state(this,'state',1);" value="<?php echo ($articleData['ar_id']); ?>" >恢复</button>
        <button type="button" class="btn btn-xs btn-info" onclick="article_state(this,'state',2);" value="<?php echo ($articleData['ar_id']); ?>" >加入草稿箱</button><?php break; endswitch;?>
        <a href="<?php echo U('article_publish?id='.$articleData['ar_id']);?>" class="btn btn-xs btn-warning" >编辑</a>
        <button type="button" class="btn btn-xs btn-danger" onclick="article_delete(this,'ar_state');" value="<?php echo ($articleData['ar_id']); ?>">删除</button>
    </td>
</tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
<?php if($button != null): ?><tfoot><tr><td colspan="6" class="text-center"><?php echo ($button); ?></td></tr></tfoot>
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
        $.get("<?php echo U('article_list');?>?page="+to,function(list){$("table#list-article").html(list);});
    });
</script><?php endif; ?>
<script type="text/javascript">
// 更改文档状态 位置/发布
function article_state(obc,paramet,value,select){
    switch(paramet){
        case "position":
        {
            var url  = "<?php echo U('article_position');?>";
            if(select)var name = select;
            else var name = "ar_class";
            break;
        }
        case "state":
        {
            var url  = "<?php echo U('article_state');?>";
            if(select)var name = select;
            else var name = "ar_state";
            break;
        }
        case "wechat":   //  20160507
        {
            var url  = "<?php echo U('article_wechat');?>";
            if(select)var name = select;
            else var name = "ar_class";
            break;
        }
    }
    var copy = $(obc).clone();
    var id   = $(obc).val();
    $(obc).addClass("disabled").removeAttr("onclick");
    $.get(url,{id:id,value:value},function(state){
        if(state){
            switch(state){
                case 1: alert("新增链接失败！数据库写入失败！");break;
                case 2: alert("找不到该记录！");break;
                default:alert("新增失败，未知的错误原因！");
            }
            $(obc).replaceWith(copy);
        }
        else load_list($("select[name="+name+"]").val()); 
    });
}
// 删除该文档
function article_delete(obc,paramet){
    if(confirm("确定要删除吗？数据将无法恢复！"))
    {
        var copy = $(obc).clone();
        var id   = $(obc).val();
        $(obc).addClass("disabled").removeAttr("onclick").html("删除中...");
        $.get("<?php echo U('article_delete');?>?id="+id,function(state){
            if(state){
                alert("找不到该记录！");
                $(obc).replaceWith(copy);
            }
            else load_list($("select[name="+paramet+"]").val()); 
        });
    }
}
</script>