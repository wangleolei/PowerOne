<?php if (!defined('THINK_PATH')) exit;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?php echo C('system_name');?> - 后台管理中心</title>
<link href="<?php echo C('CSS_PATH');?>reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo C('CSS_PATH');?>zh-cn-system.css" rel="stylesheet" type="text/css" />
<link href="<?php echo C('CSS_PATH');?>table_form.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles1.css" title="styles1" media="screen" />
	<link rel="alternate stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles2.css" title="styles2" media="screen" />
	<link rel="alternate stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles3.css" title="styles3" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles4.css" title="styles4" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>Font-Awesome/css/font-awesome.min.css" />
<script language="javascript" type="text/javascript" src="<?php echo C('JS_PATH');?>jquery.min.js"></script>
<?php ?>
<script language="javascript" type="text/javascript" src="<?php echo C('JS_PATH');?>admin_common.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo C('JS_PATH');?>styleswitch.js"></script>
<?php load_buttons();?>
<?php if($this->is_submenu){?>
<style type="text/css">
.subnav{ position:fixed; top:0px;left:0px;right:0px; z-index:1;background:#fff;}
body{ padding-top:52px;}
</style>
<?php }?>
<?php if(!(MODULE_NAME=='Content' && CONTROLLER_NAME=='Content')){?>
<script type="text/javascript">
var obj=window.top.document;
$(obj).find("#display_center_id").hide();
</script>
<?php }?>
</head>
<body>
<style type="text/css">
	html{_overflow-y:scroll;}
	.subnav{ right: 0px; left:0px; background:#fff;}		
</style>