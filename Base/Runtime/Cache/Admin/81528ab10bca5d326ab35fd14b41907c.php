<?php if (!defined('THINK_PATH')) exit(); if(is_array($parameter)): $i = 0; $__LIST__ = $parameter;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$parameterData): $mod = ($i % 2 );++$i;?><tr>
        <td><label for="<?php echo ($parameterData['pa_attribute']); ?>" class="control-label"><?php echo ($parameterData['pa_explain']); ?></label></td>
        <td>
        <?php switch($parameterData['pa_form']): case "1": ?><input type="text" id="<?php echo ($parameterData['pa_attribute']); ?>" name="<?php echo ($parameterData['pa_attribute']); ?>" class="form-control" value="<?php echo ($parameterData['pa_value']); ?>" ><?php break;?>
        <?php case "2": ?><textarea id="<?php echo ($parameterData['pa_attribute']); ?>" name="<?php echo ($parameterData['pa_attribute']); ?>" class="form-control" rows="2" ><?php echo ($parameterData['pa_value']); ?></textarea><?php break;?>
        <?php case "3": ?><input type="password" id="<?php echo ($parameterData['pa_attribute']); ?>" name="<?php echo ($parameterData['pa_attribute']); ?>" class="form-control" value="<?php echo ($parameterData['pa_value']); ?>" ><?php break;?>
        <?php case "4": ?><input type="file" id="<?php echo ($parameterData['pa_attribute']); ?>" name="upload<?php echo ($parameterData['pa_id']); ?>" ><?php break;?>
        <?php case "5": ?><label><input type="radio" name="<?php echo ($parameterData['pa_attribute']); ?>" value="true" <?php if($parameterData['pa_value'] == 'true'): ?>checked<?php endif; ?> > 开启</label>
            <label><input type="radio" name="<?php echo ($parameterData['pa_attribute']); ?>" value="false" <?php if($parameterData['pa_value'] == 'false'): ?>checked<?php endif; ?> > 关闭</label><?php break;?>
        <?php default: endswitch;?>
        </td>
        <td><?php echo ($parameterData['pa_form_explain']); ?></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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