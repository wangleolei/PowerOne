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

<link href="/powerone/Public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/powerone/Public/static/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<link href="/powerone/Public/Home/New/css/common.css" rel="stylesheet">
<link href="/powerone/Public/Home/css/header.css" rel="stylesheet">
<link href="/powerone/Public/Home/css/footer.css" rel="stylesheet">
<link href="/powerone/Public/Home/images/favicon.ico" rel="icon" type="image/x-icon" />

	 <link href="/powerone/Public/Home/New/css/list.css" rel="stylesheet">
	  <link href="/powerone/Public/Home/css/article.css" rel="stylesheet">

   
</head>
<body>
	<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/powerone/Public/",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/powerone/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/powerone/Public/static/bootstrap/js/bootstrap.min.js"></script>
  
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
            
            <a id="header_logo" class="navbar-brand" href="/" title="PowerOne">PowerOne</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
	             <li >
	                   <a id="nav-00"  href="<?php echo U('Index/index');?>" target="_self">首页d</a>
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

	

	
	
	

	 <div class="banner">
     <div id="banner" class="carousel slide" data-ride="carousel">
			  
			  <ol class="carousel-indicators">
			  	<?php if(!empty($banner)): ?><li data-target="#banner" data-slide-to="0" class="active"></li>
			  		<?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if($i > 1): ?><li data-target="#banner" data-slide-to="<?php echo $i-1;?>"></li><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
    
			  </ol>	
			  <div class="carousel-inner" role="listbox">
			  
			  	<?php if(!empty($banner)): if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="item <?php if($i == 1): ?>active<?php endif; ?>">
					      <img src="<?php echo get_image_url($data['pic_url']);?>" alt="<?php echo ($data['title']); ?>">
					      <div class="carousel-caption">
				        
				     	 </div>
			  	 	 </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			</div>
			 <!-- Controls -->
			  <a class="left carousel-control" href="#banner" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#banner" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
	  </div>
</div>

	 <div class="container">
	 	<div class="row">
	 		<div class="goods-list">
        <ul >
            <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="list-unstyled">
                <div class="item">
                    <div class="goods-pic">
                        <a target="_blank" class="pic-img" href="<?php echo U('goods/info',array('id'=>$vo['goods_id']));?>">
                            <img class="lazy img-responsive" src="<?php echo ($vo["pic_url"]); ?>" alt="<?php echo ($vo["title"]); ?>" style="display: inline;">
                        </a>
                    </div>
                    <h5 class="">
                        <a class="black" target="_blank" href="<?php echo U('goods/info',array('id'=>$vo['goods_id']));?>"><?php echo ($vo["title"]); ?></a>
                        <div style="display:none;" class="icon-all">
                        </div>
                    </h5>
                    <div class="goods-price">
                        <span class="price-current">
                            <em>￥</em>
                            <?php if($vo["discount_price"] > 0): echo ($vo['discount_price']); else: echo ($vo['price']); endif; ?>
                        </span>
                        <span class="des-other">
                            <del>
                                <em>￥</em>
                                <?php echo ($vo['price']); ?>
                            </del>
                            <span class="discount">(
                                <em>
                                    <?php echo sprintf( "%.2f",$vo['discount_price']/$vo['price'])*10; ?>
                                </em>折)
                            </span>
                        </span>
                       
                    </div>
                    <!-- like -->
                    <a href="javascript:;" data-title="<?php echo ($vo["title"]); ?>" onclick="favor(<?php echo ($goods['goods_id']); ?>)" data-key="" title="加入收藏" class="y-like my-like active">
                        <i class="like-ico l-active"><span class="heart_left"></span><span class="heart_right"></span></i>
                    </a>
                    <!-- end like -->
                    <div style="display:block" class="box-hd">
                    </div>
                </div>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>  
</div>

	 	</div>
	 	
	 </div>
	 <div class="container" >
		<div class="row">
			<h3>攻略精选</h3>
		</div>
        <div class="row">
			<div class="col-md-12 article-list">
				<ul>
					<?php if(is_array($recommend_article)): $i = 0; $__LIST__ = $recommend_article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li>
							<a href="<?php echo U('Article/detail?id='.$list['id']);?>">
								<div class="cover" style="background:url('<?php echo (get_cover($list["cover_id"],path)); ?>')">
								
								</div>		
								
									<div class="title">
										<?php echo ($list["title"]); ?>
									</div>
								
								<div class="disc">
									<?php echo ($list["description"]); ?>
								</div>
								<div class="col-md-12">
									<span class="">
										<i class="glyphicon glyphicon-eye-open"></i>
										<?php echo ($list["view"]); ?>
									</span>
								</div>
							</a>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				
				

			</div>
	
        </div>
    </div>
	 

	
	
	
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