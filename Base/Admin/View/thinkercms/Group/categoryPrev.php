<?php if (!defined('THINK_PATH')) exit; include ($this->admin_tpl('head'));echo $this->creatSubmenu();?>
<?php load_easyui('gray');?>
<style type="text/css">
.tree-node{
	height:25px;
	}
.tree-node-selected{
	background:none;
	color:#333;
	}
.tree-node{
	border-bottom:#eee 1px dashed;
	}
.tree-prev{
	width:300px; position:relative;float:right; text-align:right;
	}					
</style>
<div class="pad-lr-10">
	<div style=" display:none;">
		<a href="#" class="easyui-linkbutton" id="CollapseAll" onclick="collapseAll()">CollapseAll</a>
		<a href="#" class="easyui-linkbutton" id="ExpandAll" onclick="expandAll()">ExpandAll</a>
	</div>
<fieldset>
<form action="" method="post">
		<ul class="easyui-tree" data-options="animate:true,lines:true">
		<?php foreach($menu_arr as $v){
			if($v['parentid']==0)
			{
			?>
			<li  data-options="state:'closed'">
				<span> <?php echo $v['name'];?>
                <div class="tree-prev">
                <label><input data-parentid="<?php echo $v['parentid'];?>" data-id="<?php echo $v['id'];?>" type="checkbox" name="view[]" value="<?php echo $v['id'];?>" <?php if(strpos($rules['view'],','.$v['id'].',')!==false)echo 'checked';?>/> 查看</label> 
                <label><input data-parentid="<?php echo $v['parentid'];?>" data-id="<?php echo $v['id'];?>" type="checkbox" name="add[]" value="<?php echo $v['id'];?>" <?php if(strpos($rules['add'],','.$v['id'].',')!==false)echo 'checked';?>/> 发布</label> 
                <label><input data-parentid="<?php echo $v['parentid'];?>" data-id="<?php echo $v['id'];?>" type="checkbox" name="edit[]" value="<?php echo $v['id'];?>" <?php if(strpos($rules['edit'],','.$v['id'].',')!==false)echo 'checked';?>/> 修改</label> 
                <label><input data-parentid="<?php echo $v['parentid'];?>" data-id="<?php echo $v['id'];?>" type="checkbox" name="delete[]" value="<?php echo $v['id'];?>" <?php if(strpos($rules['delete'],','.$v['id'].',')!==false)echo 'checked';?>/> 删除</label>
                </div>
                </span>
				<?php echo $this->gettree2($v['id'],$rules);?>
			</li>
			<?php }
			}?>			
		</ul>
		<input type="hidden" name="groupid" value="<?php echo $_GET['id']?>"/>
		<input type="submit" name="dosubmit" id="dosubmit" class="hidden" value="tijiao"/>
</form>	
</fieldset>	
</div>
<script type="text/javascript">

	function collapseAll(){
		$('.easyui-tree').tree('collapseAll');
	}
	function expandAll(){
		$('.easyui-tree').tree('expandAll');
	}
	function expandTo(){
		var node = $('#tt').tree('find',113);
		$('.easyui-tree').tree('expandTo', node.target).tree('select', node.target);
	}
	function getSelected(){
		var node = $('#tt').tree('getSelected');
		if (node){
			var s = node.text;
			if (node.attributes){
				s += ","+node.attributes.p1+","+node.attributes.p2;
			}
			alert(s);
		}
	}
	
$(document).ready(function(e) {
	checks('view');	
	checks('add');
	checks('edit');	
	checks('delete');	
});

function checks(type)
{
	$("[name='"+type+"[]']").click(function()
	{
		if($(this).attr('checked')){
			var obj=$(this).parent().parent().parent().parent().parent().find("[name='"+type+"[]']").attr('checked',true);
			var parentid=$(this).attr('data-parentid');
			if(parentid!=0)check_parent(parentid,type);
			}
		else{
			$(this).parent().parent().parent().parent().parent().find("[name='"+type+"[]']").attr('checked',false);
			}		
	})	
}

function check_parent(id,type)
{
	$('[data-id='+id+']').filter("[name='"+type+"[]']").attr('checked',true);
	var parentid=$('[data-id='+id+']').filter("[name='"+type+"[]']").attr('data-parentid');
	if(parentid)check_parent(parentid,type);
}	
</script>
</body>
</html>