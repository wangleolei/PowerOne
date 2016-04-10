<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ($site['site_name']); if($site['site_name_suffix']): ?>- <?php echo ($site['site_name_suffix']); endif; ?></title>
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


<nav class="main-nav-bottom visible-xs">
    <a href="<?php echo U('/');?>" <?php echo ($on_url['index']); ?>><span class="glyphicon ">最新动态</span></a>
    <a href="<?php echo U('/articles');?>" <?php echo ($on_url['articles']); ?>><span class="glyphicon ">技术分享</span></a>
    <a href="<?php echo U('/');?>" <?php echo ($on_url['']); ?>><span class="glyphicon ">作品分享</span></a>
    <a href="<?php echo U('/');?>" <?php echo ($on_url['']); ?>><span class="glyphicon ">我们</span></a>
</nav>
    
<nav class="container hidden-xs">
    <ul class="nav nav-justified">
        <li><a href="<?php echo U('/index');?>">首页</a></li>
        <li><a href="<?php echo U('/index');?>">最新动态</a></li>
        <li><a href="<?php echo U('/articles');?>">技术分享</a></li>
        <li><a href="<?php echo U('/index');?>">作品分享</a></li>
        <li><a href="<?php echo U('/index');?>">留言板</a></li>
        <li><a href="#">关于我们</a></li>
    </ul>
</nav>
  


    <div id="module-slide" class="module module-slide-1 carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#module-slide" data-slide-to="0" class="active"></li>
            <li data-target="#module-slide" data-slide-to="1"></li>
            <li data-target="#module-slide" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <?php if(is_array($slide)): $i = 0; $__LIST__ = $slide;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$slideData): $mod = ($i % 2 );++$i;?><div class="item <?php if(($key) == "0"): ?>active<?php endif; ?>"><a href="<?php echo U('/article/'.$slideData['no_to_article']);?>"><img src="<?php echo ($site['site_url']); echo ($slideData['no_cover_img']); ?>" alt="<?php echo ($slideData['no_title']); ?>"></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
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
                    <h3 class="panel-title"><a href="#">最新动态</a></h3>

                </div>
                <div class="panel-body panel-home">
                    <p>自己制造小软件开发优化中，haha尽请期待。。。</p>
                    <ul class="menu1">
                        <?php if(is_array($softtop5)): $i = 0; $__LIST__ = $softtop5;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$softtop5data): $mod = ($i % 2 );++$i;?><section class="indexarticle">
                                <li><a href="<?php echo U('/lookblog');?>/<?php echo ($softtop5data["blog_number"]); ?>"><?php echo ($notice['no_content']); ?></a>
                                    <div ><span><i class="glyphicon glyphicon-time"></i><?php echo (timestamp_to_timeline($notice['no_time'])); ?></span></div>
                                </li>
                            </section><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <div class="module text-center at2"><span><a href="<?php echo U('/articles');?>" class="btn btn-link">>>了解详情</a></span></div>
                </div>
            </div>
        
    </div>
    <div class="col-md-6 right">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="#">技术分享</a></h3>
            </div>
            <div class="panel-body panel-home">
                <p>技术知识分享，版本整理中...</p>
                <ul class="menu1">
                    <?php if(is_array($article)): $i = 0; $__LIST__ = $article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$articledata): $mod = ($i % 2 );++$i;?><section class="indexarticle">
                            <li><a href="<?php echo U('/lookblog');?>/<?php echo ($articledata["blog_number"]); ?>"><?php echo ($articledata["ar_title"]); ?></a>
                            </li>
                        </section><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="module text-center at2"><span><a href="<?php echo U('/articles');?>" class="btn btn-link">>>了解详情</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 left">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="#">作品分享</a></h3>
            </div>
            <div class="panel-body panel-home">
                <p>自己制造小软件开发优。格式如下。。</p>
                <ul class="menu1">
                    <li><a href="/First HTML5.html">第一个 HTML5 例子</a></li>
                    <li><a href="/mycode/inq0.php">第一个MF error查询系统</a><span class='pull-right'>00-00-00</span></li>
                    <li><a href="/mycode/inq.php">MF error查询系统手机界面优化中</a><span class='pull-right'>00-00-00</span></li>
                    <li><a href="<?php echo U('/errorcode');?>">MF error 维护系统</a><span class='pull-right'>00-00-00</span></li>
                </ul>
                <ul class="menu1">
                    <?php if(is_array($newtop5)): $i = 0; $__LIST__ = $newtop5;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$newtop5data): $mod = ($i % 2 );++$i;?><section class="indexarticle">
                            <li><a href="<?php echo U('/lookblog');?>/<?php echo ($newtop5data["blog_number"]); ?>"><?php echo ($newtop5data["blog_name"]); ?></a></li>
                        </section><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="module text-center at2"><span><a href="<?php echo U('/articles');?>" class="btn btn-link">>>了解详情</a></span>
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
    <div class="container">
        <p>Copyright &copy; <?php echo ($site['site_time']); ?> - <?php echo ($site['on_year']); ?> <?php echo ($site['site_name']); ?> &amp; 版权所有</p>
        <p class="pull-right"><?php echo ($site['site_record']); ?></p>
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