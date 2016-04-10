<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head> 
    <!-- 文档参数标签 -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- seo标签、基础参数 -->
    <title>最新动态<?php if($site['site_name_suffix']): ?>- <?php echo ($site['site_name_suffix']); endif; ?></title>
    <meta name="keywords" content="<?php echo ($site['site_keywords']); ?>" />
    <meta name="description" content="<?php echo ($site['site_description']); ?>" />
    <meta name="version" content="<?php echo ($site['site_version']); ?>" />
    <meta name="author" content="<?php echo ($site['site_author']); ?>" />
    
    <!-- ico/css/js -->
    <link rel="shortcut icon" href="/powerone/Public/img/favicon.ico" />
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="/powerone/Public/css/system.home.css" rel="stylesheet">
</head>
<body>
<!--[if lte IE 8]>
<p style="margin-top: 10%;text-align: center;font-size: 1.2em;">
    你正在使用一个<strong>过时</strong>的浏览器。请升级你的浏览器保证其支持H5和CSS3的新特性再观看此页面，谢谢。</p>
</p>
<![endif]-->
<nav class="main-nav ">
    <section class="container ">
    <div class="module-right-search">
        <a href="<?php echo U('/');?>" title="首页"><img src="/powerone/upload/base/image/system/logo.png" alt="LOGO图" /></a>

    </div>
  </section>
</nav>

<nav class="main-nav-bottom visible-xs">
    <a href="<?php echo U('/mood');?>" <?php echo ($on_url['mood']); ?>><span class="glyphicon ">最新动态</span></a>
    <a href="<?php echo U('/articles');?>" <?php echo ($on_url['articles']); ?>><span class="glyphicon ">技术分享</span></a>
    <a href="<?php echo U('/');?>" <?php echo ($on_url['']); ?>><span class="glyphicon ">作品分享</span></a>
    <a href="<?php echo U('/');?>" <?php echo ($on_url['']); ?>><span class="glyphicon ">我们</span></a>
</nav>
    
<nav class="container hidden-xs">
    <ul class="nav nav-justified">
        <li><a href="<?php echo U('/index');?>">首页</a></li>
        <li><a href="<?php echo U('/mood');?>">最新动态</a></li>
        <li><a href="<?php echo U('/articles');?>">技术分享</a></li>
        <li><a href="<?php echo U('/index');?>">作品分享</a></li>
        <li><a href="<?php echo U('/index');?>">留言板</a></li>
        <li><a href="#">关于我们</a></li>
    </ul>
</nav>
  

<!-- 头图片 -->

<header class="main-header container hidden-xs">
    <h4><i class="glyphicon "></i><small>最新动态</small></h4>
    <div class="pull-right">
        <?php if($user['us_login_on']): ?><img class="img-circle" src="<?php echo ($user['us_portrait']); ?>" alt="QQ用户头像">
        <p><b><?php echo ($user['us_nickname']); ?></b>，欢迎访问PowerOne，<a>点此退出登录</a></p>
        <?php else: ?>
        <!--
        <a href="<?php echo U('/tool/login');?>"><img src="<?php echo ($site['site_url']); echo ($site['site_catalog']); ?>/Public/img/login.png" alt="QQ登陆按钮"></a>
        --><?php endif; ?>
    </div>
</header>
<!-- 头图片 -->
<section class="main-content container">
    <div class="col-md-4 left">
        <div class="module">
            <div class="module-title-2"><b>内容搜索</b><small>Search</small></div>
            <div class="module-right-search">
                <header><input type="text" name="search" class="form-control" placeholder="输入搜索的文章名"></header>
                <footer><a class="btn btn-default">搜索</a></footer>
            </div>
        </div>
        <!-- 这是搜索下方内容 -->
        
    <div class="module">
        <div class="module-title-2"><b>Notice</b><small>最新公告</small><span><i class="glyphicon glyphicon-time"></i><?php echo (timestamp_to_timeline($notice['no_time'])); ?></span></div>
        <div class="module-right-notice"><?php echo ($notice['no_content']); ?></div>
    </div>

        
        <!-- 这是about下方内容 -->
        <div class="module module-right-tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#box-recom" data-toggle="tab">推荐文章</a></li>
                <li><a href="#box-hits" data-toggle="tab">点击排行</a></li>
                <li><a href="#box-time" data-toggle="tab">最新发布</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="box-recom">
                    <ul>
                        <?php if(is_array($right['box']['recom'])): $i = 0; $__LIST__ = $right['box']['recom'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$recomData): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('/article/'.$recomData['ar_id']);?>"><?php echo ($recomData['ar_title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="box-hits">
                    <ul>
                        <?php if(is_array($right['box']['hits'])): $i = 0; $__LIST__ = $right['box']['hits'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hitsData): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('/article/'.$hitsData['ar_id']);?>"><?php echo ($hitsData['ar_title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="box-time">
                    <ul>
                        <?php if(is_array($right['box']['time'])): $i = 0; $__LIST__ = $right['box']['time'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$timeData): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('/article/'.$timeData['ar_id']);?>"><?php echo ($timeData['ar_title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- 这是BOX下方内容 -->
        <!-- 这是最后内容 -->
    </div>
    <div class="col-md-8 right">
    <div class="module module-right-search visible-xs" style="margin-top: 10px;">
        <header><input type="text" name="search" class="form-control" placeholder="输入搜索的文章名"></header>
        <footer><a class="btn btn-default">搜索</a></footer>
    </div>
    <div class="module">
    <?php if(is_array($mood)): $i = 0; $__LIST__ = $mood;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$moodData): $mod = ($i % 2 );++$i;?><article class="module-mood-1">
            <header><img src="<?php echo ($moodData['no_portrait']); ?>" alt="这是头像" class="img-circle"></header>
            <div><span></span></div>
            <footer>
                <h4> 
                    <time><?php echo ($moodData['no_nickname']); ?><small><?php echo (timestamp_to_timeline($moodData['no_time'])); ?></small></time>
                    <span class="pull-right hidden-xs"><i class="glyphicon glyphicon-map-marker"></i><?php echo ($moodData['no_place']); ?><i class="glyphicon glyphicon-<?php echo ($moodData['no_icon']); ?>"></i><?php echo ($moodData['no_os']); ?></span>
                </h4>
                <div><?php echo ($moodData['no_content']); ?></div>
            </footer>
        </article><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <ul class="module-page-1 pull-right">
        <?php if($button['first'] != null): ?><li><a href="<?php echo U('/mood');?>">首页</a></li><?php endif; ?>
        <?php if($button['previous'] != null): ?><li><a href="<?php if($button['previous'] == 1): echo U('/mood'); else: echo U('/mood_'.$button['previous']); endif; ?>">上一页</a></li><?php endif; ?>
        <?php if(is_array($button['num'])): $i = 0; $__LIST__ = $button['num'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$numData): $mod = ($i % 2 );++$i; if(($numData) == $button['on']): ?><li class="active"><a><?php echo ($numData); ?></a></li>
            <?php else: ?><li><a href="<?php if($numData == 1): echo U('/mood'); else: echo U('/mood_'.$numData); endif; ?>"><?php echo ($numData); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        <?php if($button['next'] != null): ?><li><a href="<?php echo U('/mood_'.$button['next']);?>">下一页</a></li><?php endif; ?>
        <?php if($button['end'] != null): ?><li><a href="<?php echo U('/mood_'.$button['end']);?>">末页</a></li><?php endif; ?>
    </ul>
    <div class="clear"></div>
</div>
</section>
<footer class="main-footer">
    <div class="container">
        <h5><span><a href="http://www.miitbeian.gov.cn">辽ICP备15011308号</a></span></h5>
    </div>
</footer>
<!-- 公共js -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- 这是页面自定义script -->
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
    /* 退出QQ登陆 */
    $("header.main-header p>a").click(function(){
        if(confirm("确定要退出登陆吗？")){
            $.get("<?php echo U('/tool/exitqq');?>",function(state){
                if(state)alert("退出失败！");
                else window.location.reload();
            });
        }
    });
</script>
</body>
</html>