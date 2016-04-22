<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head> 
    <!-- 文档参数标签 -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- seo标签、基础参数 -->
    <title>留言天地<?php if($site['site_name_suffix']): ?>- <?php echo ($site['site_name_suffix']); endif; ?></title>
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
<nav class="main-nav">
    <section class="container">
        <a href="<?php echo U('/');?>" title="博客首页"><img src="/powerone/upload/base/image/system/logo.png" alt="LOGO图" /></a>
        <ul class="pull-right hidden-xs">
            <li><a href="<?php echo U('/');?>">站点首页</a></li>
            <li><a href="<?php echo U('/mood');?>">时光浅逝</a></li>
            <li><a href="<?php echo U('/articles');?>">博文之柜</a></li>
            <li><a href="<?php echo U('/comment');?>">留言天地</a></li>
        </ul>
    </section>
</nav>
<nav class="main-nav-bottom visible-xs">
    <a href="<?php echo U('/');?>" <?php echo ($on_url['index']); ?>><span class="glyphicon glyphicon-home"></span></a>
    <a href="<?php echo U('/mood');?>" <?php echo ($on_url['mood']); ?>><span class="glyphicon glyphicon-time"></span></a>
    <a href="<?php echo U('/articles');?>" <?php echo ($on_url['articles']); ?>><span class="glyphicon glyphicon-book"></span></a>
    <!-- <a href="<?php echo U('/comment');?>" <?php echo ($on_url['comment']); ?>><span class="glyphicon glyphicon-comment"></span></a> -->
</nav>
<header class="main-header container hidden-xs">
    <h4><i class="glyphicon glyphicon-comment"></i><small>留言天地</small></h4>
    <div class="pull-right">
        <?php if($user['us_login_on']): ?><img class="img-circle" src="<?php echo ($user['us_portrait']); ?>" alt="QQ用户头像">
        <p><b><?php echo ($user['us_nickname']); ?></b>，欢迎访问Toilove个人博客，<a>点此退出登录</a></p>
        <?php else: ?>
        <a href="<?php echo U('/tool/login');?>"><img src="<?php echo ($site['site_url']); echo ($site['site_catalog']); ?>/Public/img/login.png" alt="QQ登陆按钮"></a><?php endif; ?>
    </div>
</header>
<!-- 头图片 -->
<section class="main-content container">
    <div class="col-md-4 left">
        
    <div class="module">
        <div class="module-title-2"><b>Notice</b><small>最新公告</small><span><i class="glyphicon glyphicon-time"></i><?php echo (timestamp_to_timeline($notice['no_time'])); ?></span></div>
        <div class="module-right-notice"><?php echo ($notice['no_content']); ?></div>
    </div>

        <div class="module">
            <div class="module-title-2"><b>Search</b><small>内容搜索</small></div>
            <div class="module-right-search">
                <header><input type="text" name="search" class="form-control" placeholder="输入搜索的文章名"></header>
                <footer><a class="btn btn-default">搜索</a></footer>
            </div>
        </div>
        <!-- 这是搜索下方内容 -->
        <div class="module">
            <div class="module-title-2"><b>Abuot</b><small>关于程序</small><span><i class="glyphicon glyphicon-download-alt"></i>开源程序提供下载学习</span></div>
            <ul class="module-right-list">
                <li>前端后台<a class="btn btn-xs btn-danger disabled">Bootstrap3.3.5 - ThinkPHP3.2.3 - UTF8</a></li>
                <li>联系作者<a class="btn btn-xs btn-primary disabled">伊始：774694235@qq.com</a></li>
                <li>站点版本<a class="btn btn-xs btn-default disabled"><?php echo ($site['site_version']); ?></a></li>
            </ul>
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
        <div class="module">
            <div class="module-title-2"><b>Link</b><small>友情链接</small><span><i class="glyphicon glyphicon-link"></i>欢迎各位站长交换链接</span></div>
            <ul class="module-right-link">
                <?php if(is_array($right['link'])): $i = 0; $__LIST__ = $right['link'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$linkData): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($linkData['li_url']); ?>" target="_blank"><?php echo ($linkData['li_title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <!-- 这是最后内容 -->
    </div>
    <div class="col-md-8 right">
    <div class="module module-right-search visible-xs" style="margin-top: 10px;">
        <header><input type="text" name="search" class="form-control" placeholder="输入搜索的文章名"></header>
        <footer><a class="btn btn-default">搜索</a></footer>
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



<!-- 导航栏隐藏 -->
<script src="<?php echo ($site['site_url']); echo ($site['site_catalog']); ?>/Public/js/headroom.jquery.headroom.js"></script>
<script src="<?php echo ($site['site_url']); echo ($site['site_catalog']); ?>/Public/js/headroom.js"></script>
<script src="<?php echo ($site['site_url']); echo ($site['site_catalog']); ?>/Public/js/system.home.js"></script>
<script>
    /* 搜索框 */
    $(".module-right-search input[name=search]").change(function(){
        if($(this).val())$(".module-right-search footer a").attr("href","<?php echo ($site['site_url']); echo ($site['site_catalog']); ?>/search/"+$(this).val()+".html");
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