<?php if (!defined('THINK_PATH')) exit(); if(is_array($parameter)): $i = 0; $__LIST__ = $parameter;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$parameterData): $mod = ($i % 2 );++$i;?><tr>
        <td>
            <input type="text" id="control<?php echo ($parameterData['seq_number']); ?>" name="<?php echo ($parameterData['control_code']); ?>" class="form-control" value="<?php echo ($parameterData['control_code']); ?>" >
        </td>
        <td>
            <input type="text" id="index<?php echo ($parameterData['seq_number']); ?>" name="<?php echo ($parameterData['index']); ?>" class="form-control" value="<?php echo ($parameterData['index']); ?>" >
        </td>
        <td>
            <input type="text" id="sort_value<?php echo ($parameterData['seq_number']); ?>" name="<?php echo ($parameterData['sort_value']); ?>" class="form-control" value="<?php echo ($parameterData['sort_value']); ?>" >
        </td>
        <td>
            <input type="text" id="int_value<?php echo ($parameterData['seq_number']); ?>" name="<?php echo ($parameterData['int_value']); ?>" class="form-control" value="<?php echo ($parameterData['int_value']); ?>" >
        </td>
        <td>
            <input type="text" id="ext_value<?php echo ($parameterData['seq_number']); ?>" name="<?php echo ($parameterData['ext_value']); ?>" class="form-control" value="<?php echo ($parameterData['ext_value']); ?>" >
        </td>
        <td>
            <input type="text" id="oth_value<?php echo ($parameterData['seq_number']); ?>" name="<?php echo ($parameterData['oth_value']); ?>" class="form-control" value="<?php echo ($parameterData['oth_value']); ?>" >
        </td>
        <td>
            <input type="text" id="short_desc<?php echo ($parameterData['seq_number']); ?>" name="<?php echo ($parameterData['short_desc']); ?>" class="form-control" value="<?php echo ($parameterData['short_desc']); ?>" >
        </td>
        <td>
            <input type="text" id="long_desc<?php echo ($parameterData['seq_number']); ?>" name="<?php echo ($parameterData['long_desc']); ?>" class="form-control" value="<?php echo ($parameterData['long_desc']); ?>" >
        </td>
        <td class="text-right">
            <button type="button" class="btn btn-xs btn-warning" value="<?php echo ($parameterData['seq_number']); ?>" onclick="parameter_upd(this);">存</button>
            <button type="button" class="btn btn-xs btn-danger" value="<?php echo ($parameterData['seq_number']); ?>" onclick="parameter_delete(this,'pa_class');">删</button>
        </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr id="tr" hidden>
        <td>
            <input type="text" id="control" name="control" class="form-control" value="<?php echo ($parameterData['control_code']); ?>" >
        </td>
        <td>
            <input type="text" id="index" name="index" class="form-control" value="<?php echo ($parameterData['index']); ?>" >
        </td>
        <td>
            <input type="text" id="sort_value" name="sort_value'" class="form-control" value="<?php echo ($parameterData['sort_value']); ?>" >
        </td>
        <td>
            <input type="text" id="int_value" name="int_value" class="form-control" value="0" >
        </td>
        <td>
            <input type="text" id="ext_value" name="ext_value" class="form-control" value="" >
        </td>
        <td>
            <input type="text" id="oth_value" name="oth_value" class="form-control" value="" >
        </td>
        <td>
            <input type="text" id="short_desc" name="short_desc" class="form-control" value="" >
        </td>
        <td>
            <input type="text" id="long_desc" name="long_desc" class="form-control" value="" >
        </td>
        <td class="text-right">
            <button type="button" class="btn btn-xs btn-warning" value="" onclick="parameter_upd(this);">保存</button>
            
        </td>
    </tr>
<?php if($on_class == 3): ?><tr>
        <td><label for="testing" class="control-label">测试邮件（配置后,先保存再测试）</label></td>
        <td><input type="text" class="form-control" id="testing" name="testing" placeholder="输入收件箱"></td>
        <td><button type="button" class="btn btn-default" onclick="test_email(this);">发送测试</button></td>
    </tr>
    <script type="text/javascript">
    function test_email(obc){
        var value = $("input[name=testing]").val();
        if(value){
            var copy = $(obc).clone();
            $(obc).addClass("disabled").removeAttr("onclick").html("邮件发送中...");
            $.get("<?php echo U('test_email');?>?test="+value,function(state){
                if(state)alert(state);
                else alert("发送成功！");
                $(obc).replaceWith(copy);
            });
        }
        else alert("请输入收件人邮箱！");
    }
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
// 删除该参数
function parameter_delete(obc,paramet){
    if(confirm("确定要删除吗？数据将无法恢复！"))
    {
        var id   = $(obc).val();
        $.get("<?php echo U('parameter_delete');?>?id="+id,function(state){
            if(state){
                alert("找不到该记录！");
            }
            else {
                alert("删除成功！");
                load_list($("select[name="+paramet+"]").val()); 
//                load_list($("select[name=pa_class]").val());
            }
        });
    }
}
// 修改该参数
function parameter_upd(obc){
    if(confirm("请确定该操作！"))
    {
        var id   = $(obc).val();
        var control = $("#control"+id).val();
        var index = $("#index"+id).val();
        var sort_value = $("#sort_value"+id).val();
        var int_value = $("#int_value"+id).val();
        var ext_value = $("#ext_value"+id).val();
        var oth_value = $("#oth_value"+id).val();
        var short_desc = $("#short_desc"+id).val();
        var long_desc = $("#long_desc"+id).val();
        //alert(int_value);
        $.post("<?php echo U('parameter_upd');?>",
            {   id: id,
                control: control,
                index: index,
                sort_value: sort_value,
                int_value: int_value,
                ext_value: ext_value,
                oth_value: oth_value,
                short_desc: short_desc,
                long_desc: long_desc
            },
            function(state,status){
                if(state){
                    alert("该操作失败！");
                }
                else {
                    alert("成功！");
                    load_list($("select[name=pa_class]").val()); 
                }
            });
    }
}

    // 新增一条记录
function parameter_add(){
    //    $("#tr").clone().appendTo("#tbodyid");
        $("#tr").show();
}
</script>