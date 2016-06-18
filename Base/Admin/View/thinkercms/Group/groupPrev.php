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
				<span><label><input data-parentid="<?php echo $v['parentid'];?>" data-id="<?php echo $v['id'];?>" <?php if(in_array($v['authid'],$rules))echo 'checked';?> type="checkbox" name="ids[]" value="<?php echo $v['authid'];?>"/> <?php echo $v['name'];?></label></span>
				<?php echo $this->gettree($v['id'],0,$rules);?>
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
</script>
<script type="text/javascript">
$(document).ready(function(e) {
$("li input").click(function()
{
	if($(this).attr('checked')){
		$(this).parent().parent().parent().parent().find('input').attr('checked',true);
		var parentid=$(this).attr('data-parentid');
		if(parentid!=0)check_parent(parentid);
		}
	else{
		$(this).parent().parent().parent().parent().find('input').attr('checked',false);
		}		
})	
});
function check_parent(id)
{

	$('[data-id='+id+']').eq(0).attr('checked',true);
	var parentid=$('[data-id='+id+']').eq(0).attr('data-parentid');
	if(parentid!=0)check_parent(parentid);
}
</script>
</body>
</html>