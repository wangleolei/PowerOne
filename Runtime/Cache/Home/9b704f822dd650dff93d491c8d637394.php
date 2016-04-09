<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo ($site_title); ?></title>
    <meta name="keywords" content="<?php echo C('WEB_SITE_KEYWORD');?>" />
    <meta name="description" content="<?php echo C('WEB_SITE_DESCRIPTION');?>">
    
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="361dream">
 
<title><?php echo ($site_title); ?></title>

<link href="/taobaoke/Public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/taobaoke/Public/static/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<link href="/taobaoke/Public/Home/New/css/common.css" rel="stylesheet">
<link href="/taobaoke/Public/Home/css/header.css" rel="stylesheet">
<link href="/taobaoke/Public/Home/css/footer.css" rel="stylesheet">
<link href="/taobaoke/Public/Home/images/favicon.ico" rel="icon" type="image/x-icon" />

	 <link rel="stylesheet" type="text/css" href="/taobaoke/Public/Home/New/css/login.css">

   
</head>
<body>
	<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/taobaoke/Public/",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/taobaoke/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/taobaoke/Public/static/bootstrap/js/bootstrap.min.js"></script>
  
	<script>
       
  
    	   
       
   
	$(function(){
		a = $('#navbar').find('a[href="'+'<?php echo ($nav_url); ?>'+'"]').closest('li').addClass('active');  
		
		if(a.html()=='' || a.length<=0){
			$('#nav-00').closest('li').addClass('active');
		}
		$('.goods-list').find('li').each(function(){
			//$(this).width(Math.round($(this).width()));
			a = $('.goods-list').innerWidth()/4*1.35;
			//alert(a.toFixed(0));
			$(this).innerHeight(Math.round(a)-1);	
			//alert($(this).innerHeight());
		});
		$(".goods-list li").hover(
 				function(){
 				   //当鼠标放上去的时候,程序处理
 				   $(this).addClass("hover1 hover");
 				},
 				function(){
 				   //当鼠标离开的时候,程序处理
 				   $(this).removeClass("hover1 hover");
 				});
 		
 		$('.article-list').find('li').hover(
				function(){
					$(this).css('box-shadow','0px 2px 8px 3px #ccc');
				},
				function(){
					$(this).css('box-shadow','');
				}
			
		);
		
	});

function favor(goodsid){
    $.get("<?php echo U('ajax/favor');?>",{id:goodsid},function(json){
            showmsg(json.info);
    })    
}    
function showmsg(msg){
	$("#tip").remove();
	$tip = $('<div id="tip" style="font-weight:bold;position:fixed;top:240px;left: 50%;z-index:9999;background:rgb(255, 45, 94);padding:18px 30px;border-radius:8px;color:#fff;font-size:16px;">'+msg+'</div>');
    $('body').append($tip);
	$tip.stop(true).css('margin-left', -$tip.outerWidth() / 2).fadeIn(500).delay(2000).fadeOut(500);
}


</script>




	
<!-- 页头 -->
<header>
	<nav class="navbar navbar-fixed-top">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-header-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <a id="header_logo" class="navbar-brand" href="/" title="Ke361">Ke361</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
	             <li >
	                   <a id="nav-00"  href="<?php echo U('Index/index');?>" target="_self">首页</a>
	             </li>	
				<?php $__NAV__ = M('Channel')->field(true)->where("status=1")->order("sort")->select(); if(is_array($__NAV__)): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i; if(($nav["pid"]) == "0"): ?><li >
	                            <a id="nav-<?php echo ($nav["id"]); ?>"  href="<?php echo (get_nav_url($nav["url"])); ?>" target="<?php if(($nav["target"]) == "1"): ?>_blank<?php else: ?>_self<?php endif; ?>"><?php echo ($nav["title"]); ?></a>
	                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                  <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">分类 <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			          	<?php if(is_array($category_tree)): $i = 0; $__LIST__ = $category_tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Goods/cate?id='.$vo['id']);?>"><?php echo ($vo['category_name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			          </ul>
			       </li>
			       <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">专题<span class="caret"></span></a>
			          <ul class="dropdown-menu">
			          	<?php if(is_array($topic_tree)): $i = 0; $__LIST__ = $topic_tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Topic/detail?id='.$vo['id']);?>"><?php echo ($vo['topic_name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			          </ul>
			       </li>
	         </ul>
	         
	         
	         <ul class="nav navbar-nav navbar-right ng-scope">
	         			<li class="divider-vertical hidden-xs"></li>
	         		<?php if($my['uid'] > 0): ?><li>
		                    <a href="<?php echo U('User/logout');?>"><i class="glyphicon glyphicon-log-out"></i> &nbsp;退出</a>
		                </li>
		                <li>
		                	<a href="<?php echo U('User/index');?>"><i class="glyphicon glyphicon-user"></i> &nbsp;<?php echo ($my['username']); ?></a>
		                </li>
		                <?php else: ?>
		                <li>                	
		                	<a href="<?php echo U('User/login');?>" rel="nofollow">登录</a>
		                </li>
		                <li>
		                	<a href="<?php echo U('User/register');?>" rel="nofollow">注册</a>
		                </li><?php endif; ?> 
	         </ul>
	         
	         <form class="navbar-form navbar-right" role="search" action="<?php echo U('Search/index');?>" method="POST">
		        <div class="form-group">
		         	 <input type="text" name="keywords" id="keywords" class="form-control" placeholder="请输入想找的宝贝...">
		        </div>
		        	<button type="submit" class="btn btn-blue">搜索</button>
		      </form>
		</div>
	</nav>
</header>   
<!-- /页头 -->

	

	
	
	
<div class="main">
    <div class="login-main">

        <div class="login-content">
            <div class="title">
                <span class="hd">用户注册</span>
                <span class="tips">尊敬的用户，欢迎您回来！</span>
                <p class="other">已经有账号，<a href="<?php echo U('User/login');?>" rel="nofollow">立即去登录</a></p>
            </div>
            <div class="login-center">
                <div class="content-landing fl">
                    <form action="<?php echo U('User/register');?>" method="post" id="login">
                        <ul>
                            <li>
                                <label class="normal">账号：</label>
                                <input value="" class="normal-input" id="account" placeholder="用户名" name="username" autocomplete="off" type="text">
                            </li>
                            <li>
                                <label class="normal">密码：</label>
                                <input class="normal-input" placeholder="请输入密码" name="password" autocomplete="off" type="password">
                            </li>
                            <li>
                                <label class="normal">确认密码：</label>
                                <input class="normal-input" placeholder="确认密码" name="repassword" autocomplete="off" type="password">
                            </li>
                            <li>
                                <label class="normal">邮箱：</label>
                                <input class="normal-input" placeholder="请输入邮箱" name="email" autocomplete="off" type="email">
                            </li>
                            <li>
                                <label class="normal">手机：</label>
                                <input class="normal-input" placeholder="请填写手机" name="mobile" autocomplete="off" type="text">
                            </li>
                            <li>
                                <label class="normal"></label>
                                <div class="btn">
                                    <input class="sub smt-o" value="注册" autocomplete="off" type="submit">
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
                <div class="login-l-img fr">
                    <img src="/taobaoke/Public/Home/images/login-bj-ad.png">
                </div>
            </div>

        </div>
    </div>
</div>
<!--主体 end-->

	
	
	
	<!-- 页脚 -->
<div class="container">
    
   
    <div class="row">
		<dl class="col-md-3">
			<dt><?php echo ($articleSort[0]['sort_name']); ?></dt>
			<?php $d0 = $article[$articleSort[0]['sort_id']];?>
			<?php if(is_array($d0)): $i = 0; $__LIST__ = $d0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><dd><a target="_blank" href="<?php echo U('article/detail',array('aid'=>$data['aid']));?>"><i></i><?php echo cutstr($data['title'],28);?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?>     
		</dl>
		<dl class="col-md-3">
			<dt><?php echo ($articleSort[1]['sort_name']); ?></dt>
			<?php $d1 = $article[$articleSort[1]['sort_id']];?>
			<?php if(is_array($d1)): $i = 0; $__LIST__ = $d1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><dd><a target="_blank" href="<?php echo U('article/detail',array('aid'=>$data['aid']));?>"><i></i><?php echo cutstr($data['title'],28);?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?>
		</dl>
		<dl class="col-md-3">
			<dt><?php echo ($articleSort[2]['sort_name']); ?></dt>
			<?php $d2 = $article[$articleSort[2]['sort_id']];?>
			<?php if(is_array($d2)): $i = 0; $__LIST__ = $d2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><dd><a target="_blank" href="<?php echo U('article/detail',array('aid'=>$data['aid']));?>"><i></i><?php echo cutstr($data['title'],28);?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?>
		</dl>
		<dl class="col-md-3">
			<dt><?php echo ($articleSort[3]['sort_name']); ?></dt>
			<?php $d3 = $article[$articleSort[3]['sort_id']];?>
			<?php if(is_array($d3)): $i = 0; $__LIST__ = $d3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><dd><a target="_blank" href="<?php echo U('article/detail',array('aid'=>$data['aid']));?>"><i></i><?php echo cutstr($data['title'],28);?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?>
		</dl>    
    </div>
    <?php if(!empty($flinks)): ?><div class="row">
			<span class="col-md-2">友情链接：</span>
			
			<?php if(is_array($flink)): foreach($flink as $key=>$vo): ?><span class="col-md-2">
					<a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a>
				</span><?php endforeach; endif; ?>
				
	</div><?php endif; ?>
    <div class="row">
		<div class="col-md-3"><?php echo C('WEB_SITE_ICP');?></div>
	</div>	
            
</div>
<div style="display: none;" class="side_right fix">
        <div class="con">
            <a class="trigger go-top" href="javascript:;">
                <p>回到<br>顶部</p>
                <span><i class="glyphicon glyphicon-triangle-top" aria-hidden="true" style="font-size:24px;"></i></span>
            </a>
    </div>
</div>
<?php echo C('TONGJI');?>

	
	

</body>
</html>