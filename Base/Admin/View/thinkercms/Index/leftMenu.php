<?php if (!defined('THINK_PATH')) exit;?>

<?php
foreach($datas as $leave1){
?>
<h3 class="f14"><span class="switchs cu on" title="展开与收缩"></span><?php echo $leave1['name'];?></h3>
<ul>
<?php
$datas2=parent::admin_menu($leave1['id']);
foreach($datas2 as $leave2){	
?>
<li id="_MP<?php echo $leave2['id'];?>" class="sub_menu"><a href="javascript:_MP(<?php echo $leave2['id'];?>,'<?php echo U($leave2['m'].'/'.$leave2['c'].'/'.$leave2['a'].'/'.$leave2['data'])?>');" hidefocus="true" style="outline:none;"><?php echo $leave2['name'];?></a></li>
<?php }?>
</ul>
<?php }?>
<script type="text/javascript">
$(".switchs").each(function(i){
	var ul = $(this).parent().next();
	$(this).click(
	function(){
		if(ul.is(':visible')){
			ul.hide();
			$(this).removeClass('on');
				}else{
			ul.show();
			$(this).addClass('on');
		}
	})
});
</script>