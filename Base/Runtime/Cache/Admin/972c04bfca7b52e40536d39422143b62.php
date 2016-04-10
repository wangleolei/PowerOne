<?php if (!defined('THINK_PATH')) exit();?><thead>
<tr>
    <th style="width: 700px;">标题</th>
    <th style="width: 200px;">发布时间</th>
    <th style="width: 236px;" class="text-right" >操作</th>
</tr>
</thead>
<?php if($notice != null): ?><tbody>
<?php if(is_array($notice)): $i = 0; $__LIST__ = $notice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$noticeData): $mod = ($i % 2 );++$i;?><tr>
    <td><?php echo ($noticeData['no_title']); ?></td>
    <td><?php echo (date("Y/m/d H:i",$noticeData['no_time'])); ?></td>
    <td class="text-right">
    <a href="<?php echo U('notice_add','id='.$noticeData['no_id']);?>" class="btn btn-xs btn-warning" >编辑</a>
    <button type="button" class="btn btn-xs btn-danger" onclick="operat_delete(this);" value="<?php echo ($noticeData['no_id']); ?>" >删除</button>
    </td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</tbody>
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
            $.get("<?php echo U('notice_list');?>?page="+to,function(list){$("table#list-notice").html(list);});
        });
    </script><?php endif; ?>
    <script type="text/javascript">
    function operat_delete(obc){
        if(confirm("确定要删除吗？数据将无法恢复！"))
        {
            var value = $(obc).val();
            var copy  = $(obc).clone();
            $(obc).addClass("disabled").removeAttr("onclick").html("删除中...");
            $.get("<?php echo U('operat_delete');?>?id="+value,function(state){
                if(state){
                    alert("无法找到该记录！");
                    $(obc).replaceWith(copy);
                }
                else load_list($("select[name=no_type]").val());
            });
        }
    }
    </script><?php endif; ?>