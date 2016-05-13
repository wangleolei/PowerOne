<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PowerOne首页<?php if($site['site_name_suffix']): ?>- <?php echo ($site['site_name_suffix']); endif; ?></title>
    <meta name="keywords" content="<?php echo ($site['site_keywords']); ?>" />
    <meta name="description" content="<?php echo ($site['site_description']); ?>" />
    <meta name="version" content="<?php echo ($site['site_version']); ?>" />
    <meta name="author" content="<?php echo ($site['site_author']); ?>" />
    <meta property="qc:admins" content="730633572147656375" />
    <link rel="shortcut icon" href="/powerone/Public/img/favicon.ico" />
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="/powerone/Public/css/system.home.css" rel="stylesheet">
</head>
<body>
<nav class="main-nav ">
    <section class="container ">
    <div class="module-right-search">
        <a href="<?php echo U('/');?>" title="首页"><img src="/powerone/upload/base/image/system/logo.png" alt="LOGO图" /></a>
                <header><input type="text" name="search" class="form-control" placeholder="输入搜索的文章名">
                </header>
                <footer><a class="btn btn-default">搜索</a></footer>
    </div>
  </section>
</nav>

<!--
<nav class="main-nav-bottom visible-xs"> 
    <a href="<?php echo U('/mood');?>" <?php echo ($on_url['mood']); ?>><span class="glyphicon ">最新动态</span></a>
    <a href="<?php echo U('/articles/1');?>" <?php echo ($on_url['articles/1']); ?>><span class="glyphicon ">技术分享</span></a>
    <a href="<?php echo U('/articles/2');?>" <?php echo ($on_url['2']); ?>><span class="glyphicon ">作品分享</span></a>
    <a href="<?php echo U('/');?>" <?php echo ($on_url['']); ?>><span class="glyphicon ">我们</span></a>
</nav>

<nav class="container hidden-xs">
    <ul class="nav nav-justified">
        <li><a href="<?php echo U('/index');?>">首页</a></li>
        <li><a href="<?php echo U('/mood');?>">最新动态</a></li>
        <li><a href="<?php echo U('/articles/1');?>">技术分享</a></li>
        <li><a href="<?php echo U('/articles/2');?>">作品分享</a></li>
        <li><a href="#">留言板</a></li>
        <li><a href="#">关于我们</a></li>
    </ul>
</nav>
-->

<nav class="main-nav-bottom visible-xs"> 
    <?php if(is_array($cvt10001)): $i = 0; $__LIST__ = $cvt10001;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><a href="<?php echo ($menu["long_desc"]); ?>"  class="<?php echo ($menu["oth_value"]); ?>"><span class="glyphicon "><?php echo ($menu["short_desc"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
</nav>
<nav class="container hidden-xs">
    <ul class="nav nav-justified">
        <?php if(is_array($cvt10000)): $i = 0; $__LIST__ = $cvt10000;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($menu["long_desc"]); ?>"><?php echo ($menu["short_desc"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</nav>


    <div id="module-slide" class="module module-slide-1 carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#module-slide" data-slide-to="0" class="active"></li>
            <li data-target="#module-slide" data-slide-to="1"></li>
            <li data-target="#module-slide" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <?php if(is_array($slide)): $i = 0; $__LIST__ = $slide;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$slideData): $mod = ($i % 2 );++$i;?><div class="item <?php if(($key) == "0"): ?>active<?php endif; ?>"><a href="<?php echo U('/article/'.$slideData['no_to_article']);?>"><img src="/powerone/upload/base/image/system/inner1.jpg" alt="<?php echo ($slideData['no_title']); ?>"></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>

<header class="main-header container hidden-xs">
    <h4><i class="glyphicon"></i><small>您现在的位置:  首页</small>
    </h4>
</header>

<section class="main-content container">
    <div class="col-md-6 left">
        
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><a href="<?php echo U('/mood');?>">最新动态</a></h3>

                </div>
                <div class="panel-body panel-home">
                    <ul class="menu1">
                        <?php if(is_array($mood)): $i = 0; $__LIST__ = $mood;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mooddata): $mod = ($i % 2 );++$i;?><section class="indexarticle">
                                <li><a href="<?php echo U('/mood_'.$mooddata['no_id']);?>"><?php echo ($mooddata["no_title"]); ?></a><span class='pull-right'><?php echo (timestamp_to_timeline($mooddata['no_time'])); ?></span>
                                </li>
                            </section><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <div class="module text-center at2"><span><a href="<?php echo U('/mood');?>" class="btn btn-link">>>了解详情</a></span></div>
                </div>
            </div>
        
    </div>
    <div class="col-md-6 right">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="<?php echo U('/articles/1');?>">技术分享</a></h3>
            </div>
            <div class="panel-body panel-home">
                <p>技术知识分享，版本整理中...</p>
                <ul class="menu1">
                    <?php if(is_array($article1)): $i = 0; $__LIST__ = $article1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article1data): $mod = ($i % 2 );++$i;?><section class="indexarticle">
                            <li><a href="<?php echo U('/article/'.$article1data['ar_id']);?>"><?php echo ($article1data["ar_title"]); ?></a><span class='pull-right'><?php echo (timestamp_to_timeline($article1data["ar_last_time"])); ?></span>
                            </li>
                        </section><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="module text-center at2"><span><a href="<?php echo U('/articles/1');?>" class="btn btn-link">>>了解详情</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 left">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="<?php echo U('/articles/2');?>">作品分享</a></h3>
            </div>
            <div class="panel-body panel-home">
                <p>自己制造小软件开发.分享如下。。</p>
                <ul class="menu1">
                    <?php if(is_array($article2)): $i = 0; $__LIST__ = $article2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article2data): $mod = ($i % 2 );++$i;?><section class="indexarticle">
                            <li><a href="<?php echo U('/article/'.$article2data['ar_id']);?>"><?php echo ($article2data["ar_title"]); ?></a><span class='pull-right'><?php echo (timestamp_to_timeline($article2data["ar_last_time"])); ?></span>
                            </li>
                        </section><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="module text-center at2"><span><a href="<?php echo U('/articles/2');?>" class="btn btn-link">>>了解详情</a></span>
                </div>
            </div>
        </div> 
    </div>


    <div class="col-md-6 right">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="#">关于我们</a></h3>
            </div>
            <div class="panel-body panel-home">
                <p>Email :  wanglei_leo@163.com</p>
                <p>微信订阅号二维码</p>
                <p><img src="/powerone/Public/img/wechat.jpg" width="151" height="151"/> </p>
                <div class="module text-center at2 pull-right"><span><a href="<?php echo U('/articles');?>" class="btn btn-link">>>了解详情</a></span>
                </div>
            </div>
    </div>
</section>

<footer class="main-footer">
    <div class="container ">
            <h5><span><a href="http://www.miitbeian.gov.cn">辽ICP备15011308号</a></span></h5>
    </div>
</footer>
<!-- 公共js -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
    /* 轮播启动 */
    $(".module-slide-1").carousel({interval: 3000});
</script>

<!-- 导航栏隐藏 -->
<script src="/powerone/Public/js/headroom.jquery.headroom.js"></script>
<script src="/powerone/Public/js/headroom.js"></script>
<script src="/powerone/Public/js/system.home.js"></script>
<script>
    /* 搜索框 */
    $(".module-right-search input[name=search]").change(function(){
        if($(this).val())$(".module-right-search footer a").attr("href","/powerone/search/"+$(this).val()+".html");
        else $(".module-right-search footer a").removeAttr("href");
    });
</script>
</body>
</html>