<?php if (!defined('THINK_PATH')) exit;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <title><?php echo C('SITE_NAME');?>- 后台管理中心首页</title>
    <link href="<?php echo C('CSS_PATH');?>reset.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo C('CSS_PATH');?>zh-cn-system.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo C('CSS_PATH');?>table_form.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles1.css" title="styles1" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles2.css" title="styles2" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles3.css" title="styles3" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles4.css" title="styles4" media="screen" />
    <script language="javascript" type="text/javascript" src="<?php echo C('JS_PATH');?>jquery.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo C('JS_PATH');?>admin_common.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo C('JS_PATH');?>styleswitch.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>Font-Awesome/css/font-awesome.min.css" />
    </head>
    <body>	
<style type="text/css">
	 html{_overflow-y:scroll}
	.notice{ margin-bottom:5px; overflow:hidden;}
	.notice:hover{cursor:pointer;}
	.notice>li{ width:20%; float:left; text-align:center; position:relative;}
	.notice>li .num{ color:#fff; min-width:12px; height:12px; left:55%; top:0px; position:absolute; background:  #F8744A; border-radius:50%; line-height:12px; padding:2px; font-size:12px !important;}
	.notice .ico i{ font-size:2.5em; }
	.notice h3{ font-size:1.2em;}
</style>
<div id="main_frameid" class="pad-10" style="_margin-right:-12px;_width:98.9%;"> 
		<?php  if(preg_match('/MSIE/',$_SERVER['HTTP_USER_AGENT'])){?>
		<div class="explain-col mb10" id="browserVersionAlert"> <i class="fa fa-bullhorn" style="color:red;"></i>由于兼容性问题请不要使用ie内核的浏览器进行操作。</div>
        <?php } ?>	        
		<div class="col-2 lf mr10" style="width:48%">
		<h6>个人信息</h6>
		<div class="content">
			<div class="pointer" onclick="window.location='<?php echo U('User/Staff/public_head');?>';">
			<img src="<?php echo (!$ishead)?'/Public/images/nophoto.gif':get_head();?>" width="48" height="48" style="float: left; border-radius: 50%;" alt="头像">
			<div style=" width: 200px; float: left; line-height: 24px; padding-left: 10px;">
			您好，<?php echo session('userinfo.username');?><br />
			所属角色：<?php echo session('userinfo.usertitle');?><br/>
			</div> 
			</div>
				<div class="bk20 hr">
				<hr />
			</div>
				上次登录时间：<?php echo date("Y-m-d H:i:s",$last_login_info['time']);?><br />
				上次登录IP：<?php echo $last_login_info['ip'];?><br />
				上次登录地点：<?php echo $last_login_info['area'];?><br />
			</div>
	</div>
	<div class="col-2 col-auto">
		<h6>天气信息</h6>
		<div class="content">
		<iframe allowtransparency="true" frameborder="0" width="565" height="122" scrolling="no" src="http://tianqi.2345.com/plugin/widget/index.htm?s=2&z=3&t=1&v=0&d=3&bd=0&k=&f=&q=1&e=1&a=1&c=54511&w=565&h=122&align=center"></iframe>
			</div>
	</div>
		<div class="bk10"></div>	
		<div class="col-2 lf mr10" style="width:48%">
		<h6 class="pointer">开发信息</h6>
		<div class="content"> 
        		官方网站：<a href="http://cms.thinkerphp.com" target="_blank">ThinkerCMS</a> <br />
				开发者：<a href="http://blog.thinkerphp.com" target="_blank">Thinker</a><br/>
				邮箱：thinkerphp@qq.com<br/>
                技术交流：<a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=2e87247cf59d71787bee7702e7abbb7cec90e7ffa7a111443b7bf7c6b3f3cd3b"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="thinkerphp" title="thinkerphp"></a>
				</div>
	</div>
			<div class="col-2 col-auto">
		<h6>使用提示</h6>
		<div id="main" class="content">
        		※ 由于兼容性问题请不要使用ie内核的浏览器进行操作。<br/>
				※ 请不要使用常用或极简密码，如发现登陆异常，请及时修改密码。<br />
				※ 显示屏不得小于1280px x 720px<br />
				※ 长时间离开建议锁屏，防止恶意操作。<br />
			</div>
	</div> 
	</div>  
<script type="text/javascript">
/*	$(function(){
		window.top.art.dialog({
    id: 'msg',
    title: '管理员信息通知',
    content: 'hello world!',
    width: 420,
    height: 240,
    left: '99.5%',
    top: '99.5%',
    fixed: true,
    drag: false,
    resize: false
	})	
		})*/
</script>   
</body>
</html>
                    