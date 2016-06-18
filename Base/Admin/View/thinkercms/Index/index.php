<?php if (!defined('THINK_PATH')) exit;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="off">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo C('SYSTEM_NAME');?>- 后台管理中心</title>
<link href="<?php echo C('CSS_PATH');?>reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo C('CSS_PATH');?>zh-cn-system.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles1.css" title="styles1" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles2.css" title="styles2" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles3.css" title="styles3" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles4.css" title="styles4" media="screen" />
<script language="javascript" type="text/javascript" src="<?php echo C('JS_PATH');?>jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo C('JS_PATH');?>styleswitch.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>Font-Awesome/css/font-awesome.min.css" />
<?php load_buttons();?>
<?php load_artdialog();?>
<style type="text/css">
.objbody {
	overflow: hidden
}
</style>
</head>
<body scroll="no" class="objbody">
<div id="dvLockScreen" class="ScreenLock" style="display:none">
  <div id="dvLockScreenWin" class="inputpwd">
    <h5><b class="ico ico-info"></b><span id="lock_tips">锁屏状态，请输入密码解锁</span></h5>
    <div class="input">
      <label class="lb">密码：</label>
      <input type="password" id="lock_password" class="input-text" size="20">
      <input type="submit" class="submit" value="&nbsp;" name="dosubmit" onclick="check_screenlock();return false;">
    </div>
  </div>
</div>
<div class="header" style="position:relative;">
  <div class="logo lf" style="background:url(<?php echo C('system_logo')?C('system_logo'):'';?>) no-repeat;">
  </div>
  <div class="rt-col">
    <div class="tab_style cut_line text-r"><a href="http://bbs.thinkerphp.com/forum.php?gid=1" target="_blank">社区</a><span>|</span><a href="http://cms.thinkerphp.com" target="_blank">官网</a><span>|</span> <a href="javascript:;" onclick="lock_screen()"><img src="<?php echo C('IMG_PATH');?>icon/lockscreen.png"> 锁屏</a>
      <ul id="Skin" style="display: none;">
        <li class="s1 styleswitch" rel="styles1"></li>
        <li class="s2 styleswitch" rel="styles2"></li>
        <li class="s3 styleswitch" rel="styles3"></li>
        <li class="s4 styleswitch" rel="styles4"></li>
      </ul>
    </div>
  </div>
  <div class="col-auto">
    <div class="log cut_line">您好！<?php echo session('userinfo.username');?> [<?php echo session('userinfo.usertitle');?>]<span>|</span><a href="<?php echo U('logout');?>">[退出]</a><span>|</span><a href="/" target="_blank">PC端首页</a> <span>|</span> <a href="<?php echo U('Mobile/Index/index');?>" target="_blank">移动端首页</a></div>
    <ul class="nav" id="top_menu">
      <i></i>
      <?php $i=0;?>
      <?php foreach($top_menu as $val){?>
      <li id="_M<?php echo $val['id'];?>" class="<?php echo $i?'':'on';?> top_menu"><a href="javascript:_M(<?php echo $val['id'];?>,'<?php echo U($val['m'].'/'.$val['c'].'/'.$val['a'].'/'.$val['data']);?>')" hidefocus="true" style="outline:none;"><?php echo $val['name'];?></a></li>
      <?php $i++;}?>  
    </ul>
    <div class="sc_admin_line"></div>
    <div class="shortcut cu-span" style="position:absolute; top:65px; right:20px;">
        <a href="<?php echo U('Index/recache')?>"><span>清除缓存</span></a>
        <a onclick="repasssword()" href="javascript:void(0)"><span>修改密码</span></a>
        <a href="javascript:art.dialog.open('<?php echo U('Index/map')?>',{id:'map', title:'后台地图', width:700, height:500, lock:true});void(0);">
        <span>后台地图</span></a>
    </div>  
  </div>
</div>
<div id="content">
  <div class="col-left left_menu">
    <div id="Scroll">
      <div id="leftMain"></div>
    </div>
    <a href="javascript:;" id="openClose" style="outline-style: none; outline-color: invert; outline-width: medium;" hideFocus="hidefocus" class="open" title="展开与关闭"><span class="hidden">展开</span></a> </div>
  <div class="col-1 lf cat-menu" id="display_center_id" style="display:none" height="100%">
    <div class="content">
      <iframe name="center_frame" id="center_frame" src="" frameborder="false" scrolling="auto" style="border:none" width="100%" height="auto" allowtransparency="true"></iframe>
    </div>
  </div>
  <div class="col-auto mr8">
    <div class="crumbs">
      
      当前位置：<span id="current_pos">后台管理>首页</span></div>
    <div class="col-1">
      <div class="content" style="position:relative; overflow:hidden">
        <iframe name="right" id="rightMain" src="<?php echo U('Index/firstPage')?>" frameborder="false" scrolling="auto" style="border:none; margin-bottom:20px" width="100%" height="auto" allowtransparency="true"></iframe>
        <div class="fav-nav">
          <div id="panellist">
            <?php foreach($panel_list as $panel){?>
            <span id="panel_<?php echo $panel['id'];?>"><a onclick="paneladdclass(this);" target="right" href="<?php echo U($panel['m'].'/'.$panel['c'].'/'.$panel['a'].'/'.$panel['data']);?>"><?php echo $panel['name'];?></a> <a class="panel-delete" href="javascript:delete_panel(<?php echo $panel['id'];?>);"></a></span>
            <?php }?>
          </div>
          <div id="paneladd"></div>
          <input type="hidden" id="menuid" value="">
          <input type="hidden" id="bigid" value="" />
          <div id="help" class="fav-help"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="scroll"><a href="javascript:;" class="per" title="使用鼠标滚轴滚动侧栏" onclick="menuScroll(1);"></a><a href="javascript:;" class="next" title="使用鼠标滚轴滚动侧栏" onclick="menuScroll(2);"></a></div>
<script type="text/javascript"> 
if(!Array.prototype.map)
Array.prototype.map = function(fn,scope) {
  var result = [],ri = 0;
  for (var i = 0,n = this.length; i < n; i++){
	if(i in this){
	  result[ri++]  = fn.call(scope ,this[i],i,this);
	}
  }
return result;
};

var getWindowSize = function(){
return ["Height","Width"].map(function(name){
  return window["inner"+name] ||
	document.compatMode === "CSS1Compat" && document.documentElement[ "client" + name ] || document.body[ "client" + name ]
});
}
window.onload = function (){
	if(!+"\v1" && !document.querySelector) { // for IE6 IE7
	  document.body.onresize = resize;
	} else { 
	  window.onresize = resize;
	}
	function resize() {
		wSize();
		return false;
	}
}
function wSize(){
	//这是一字符串
	var str=getWindowSize();
	var strs= new Array(); //定义一数组
	strs=str.toString().split(","); //字符分割
	var heights = strs[0]-150,Body = $('body');$('#rightMain').height(heights);   
	//iframe.height = strs[0]-46;
	if(strs[1]<980){
		$('.header').css('width',980+'px');
		$('#content').css('width',980+'px');
		Body.attr('scroll','');
		Body.removeClass('objbody');
	}else{
		$('.header').css('width','auto');
		$('#content').css('width','auto');
		Body.attr('scroll','no');
		Body.addClass('objbody');
	}
	
	var openClose = $("#rightMain").height()+39;
	$('#center_frame').height(openClose-1);
	$("#openClose").height(openClose+30);	
	$("#Scroll").height(openClose-20);
	windowW();
}
wSize();
function windowW(){
	if($('#Scroll').height()<$("#leftMain").height()){
		$(".scroll").show();
	}else{
		$(".scroll").hide();
	}
}
windowW();
//站点下拉菜单
$(function(){
	var offset = $(".tab_web").offset();
	var tab_web_panel = $(".tab-web-panel");
	$(".tab_web").mouseover(function(){
			tab_web_panel.css({ "left": +$(this).offset().left+4, "top": +offset.top+$('.tab_web').height()});
			tab_web_panel.show();
			if(tab_web_panel.height() > 200){
				tab_web_panel.children("ul").addClass("tab-scroll");
			}
		});
	$(".tab_web span").mouseout(function(){hidden_site_list_1()});
	$(".tab-web-panel").mouseover(function(){clearh();$('.tab_web a').addClass('on')}).mouseout(function(){hidden_site_list_1();$('.tab_web a').removeClass('on')});
	//默认载入左侧菜单
	$("#leftMain").load("<?php echo U('menuLeft');?>");
	
	//检查是否需要刷新center_iframe页面
	refresh_rightMain();
})
/*
* 刷新副窗口中的页面
*/
var refresh_rightMain_TimeCounter;
function refresh_rightMain()
{
	if(refresh_rightMain_TimeCounter) window.clearTimeout(refresh_rightMain_TimeCounter);//清除上一次的setTimeout,防止不断占用CPU 
	var is_refresh=readCookie('refresh_rightMain');
	if(is_refresh==1)
	{
		document.getElementById('rightMain').src=document.getElementById('rightMain').contentWindow.location.href;
		eraseCookie('refresh_rightMain');
	}
	refresh_rightMain_TimeCounter=setTimeout('refresh_rightMain()',500);
}

//隐藏站点下拉。
var s = 0;
var h;
function hidden_site_list() {
	s++;
	if(s>=3) {
		$('.tab-web-panel').hide();
		clearInterval(h);
		s = 0;
	}
}
function clearh(){
	if(h)clearInterval(h);
}
function hidden_site_list_1() {
	h = setInterval("hidden_site_list()", 1);
}

//左侧开关
$("#openClose").click(function(){
	if($(this).data('clicknum')==1) {
		$("html").removeClass("on");
		$(".left_menu").removeClass("left_menu_on");
		$(this).removeClass("close");
		$(this).data('clicknum', 0);
		// $(".scroll").show(); //关闭状态下打开，按钮显示
	} else {
		$(".left_menu").addClass("left_menu_on");
		$(this).addClass("close");
		$("html").addClass("on");
		$(this).data('clicknum', 1);
		$(".scroll").hide();
	}
	return false;
});

function _M(menuid,targetUrl) {
	$("#menuid").val(menuid);
	$("#bigid").val(menuid);
	$("#paneladd").html('<a class="panel-add" href="javascript:add_panel();"><em>添加</em></a>');
	if(menuid!=8) {
		$("#leftMain").load("/index.php?m=Admin&c=index&a=menuLeft&menuid="+menuid, {limit: 25}, function(){
		   windowW();
		 });
	} else {
		$("#leftMain").load("/index.php?m=Admin&c=index&a=menuLeft&menuid="+menuid, {limit: 25}, function(){
		   windowW();
		 });
	}
	$("#rightMain").attr('src', targetUrl);
	$('.top_menu').removeClass("on");
	$('#_M'+menuid).addClass("on");
	/*
	$.get("index.php?m=admin&c=index&a=current_pos&menuid="+menuid, function(data){
		$("#current_pos").html(data);
	});
	*/
	//当点击顶部菜单后，隐藏中间的框架
	$('#display_center_id').css('display','none');
	//显示左侧菜单，当点击顶部时，展开左侧
	$(".left_menu").removeClass("left_menu_on");
	$("#openClose").removeClass("close");
	$("html").removeClass("on");
	$("#openClose").data('clicknum', 0);
	$("#current_pos").data('clicknum', 1);
}
function _MP(menuid,targetUrl) {
	$("#menuid").val(menuid);
	$("#paneladd").html('<a class="panel-add" href="javascript:add_panel();"><em>添加</em></a>');

	$("#rightMain").attr('src', targetUrl);
	$('.sub_menu').removeClass("on fb blue");
	$('#_MP'+menuid).addClass("on fb blue");
	$.get("/index.php?m=Admin&c=Index&a=current_pos&menuid="+menuid, function(data){
		$("#current_pos").html(data+'<span id="current_pos_attr"></span>');
	});
	$("#current_pos").data('clicknum', 1);
}

setInterval("hidden_help()", 10000);
function hidden_help() {
	var htime = $("#help").data('time')+1;
	$("#help").data('time', htime);
	if(htime>2) $("#help").slideUp("slow");
}
function add_panel() {
	var menuid = $("#menuid").val();
	$.ajax({
		type: "POST",
		url: "<?php echo U("ajax_add_panel");?>",
		data: "menuid=" + menuid,
		success: function(data){
			if(data) {
				$("#panellist").append(data);
			}
		}
	});
}
function delete_panel(menuid, id) {
	$.ajax({
		type: "POST",
		url: "<?php echo U("ajax_delete_panel");?>",
		data: "menuid=" + menuid,
		success: function(data){
			$("#panel_"+menuid).remove();
		}
	});
}

function paneladdclass(id) {
	$("#panellist span a[class='on']").removeClass();
	$(id).addClass('on')
}
function lock_screen() {
	$.get("<?php echo U("ajax_lock_screen");?>");
	$('#dvLockScreen').css('display','');
}
function check_screenlock() {
	var lock_password = $('#lock_password').val();
	if(lock_password=='') {
		$('#lock_tips').html('<font color="red">密码不能为空。</font>');
		return false;
	}
	$.get("<?php echo U("login_screenlock");?>", { lock_password: lock_password},function(data){
		if(data==1) {
			$('#dvLockScreen').css('display','none');
			$('#lock_password').val('');
			$('#lock_tips').html('锁屏状态，请输入密码解锁');
		} else if(data==3) {
			$('#lock_tips').html('<font color="red">密码重试次数太多</font>');
		} else {
			strings = data.split('|');
			$('#lock_tips').html('<font color="red">密码错误，您还有'+strings[0]+'次尝试机会！</font>');
		}
	});
}
$(document).bind('keydown', 'return', function(evt){
	if(evt.keyCode==13)
	{
		check_screenlock();return false;
	}
});

(function(){
    var addEvent = (function(){
             if (window.addEventListener) {
                return function(el, sType, fn, capture) {
                    el.addEventListener(sType, fn, (capture));
                };
            } else if (window.attachEvent) {
                return function(el, sType, fn, capture) {
                    el.attachEvent("on" + sType, fn);
                };
            } else {
                return function(){};
            }
        })(),
    Scroll = document.getElementById('Scroll');
    // IE6/IE7/IE8/Opera 10+/Safari5+
    addEvent(Scroll, 'mousewheel', function(event){
        event = window.event || event ;  
		if(event.wheelDelta <= 0 || event.detail > 0) {
				Scroll.scrollTop = Scroll.scrollTop + 29;
			} else {
				Scroll.scrollTop = Scroll.scrollTop - 29;
		}
    }, false);

    // Firefox 3.5+
    addEvent(Scroll, 'DOMMouseScroll',  function(event){
        event = window.event || event ;
		if(event.wheelDelta <= 0 || event.detail > 0) {
				Scroll.scrollTop = Scroll.scrollTop + 29;
			} else {
				Scroll.scrollTop = Scroll.scrollTop - 29;
		}
    }, false);
	
})();
function menuScroll(num){
	var Scroll = document.getElementById('Scroll');
	if(num==1){
		Scroll.scrollTop = Scroll.scrollTop - 60;
	}else{
		Scroll.scrollTop = Scroll.scrollTop + 60;
	}
}

function repasssword() {
		window.top.art.dialog.open('<?php echo U('Admin/Index/relogininfo');?>',{title:'修改登陆密码',width:500,height:170,lock:true,ok:function(){var iframe = this.iframe.contentWindow;var form = iframe.document.getElementById('dosubmit');form.click();return false;},cancel:true});
}
</script>
</body>
</html>