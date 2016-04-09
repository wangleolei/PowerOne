<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head> 
    <!-- 文档参数标签 -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- seo标签、基础参数 -->
    <title><?php echo ($article['ar_title']); if($site['site_name_suffix']): ?>- <?php echo ($site['site_name_suffix']); endif; ?></title>
    <meta name="keywords" content="<?php echo ($article['ar_keywords']); ?>,<?php echo ($site['site_keywords']); ?>" />
    <meta name="description" content="<?php echo ($article['ar_description']); ?>" />
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
  

<!-- 头图片 -->

<header class="main-header container hidden-xs">
    <h4><i class=""></i><small>您现在的位置: 首页 -> 技术分享 - > <?php echo ($article['ar_title']); ?></small></h4>
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
        <!-- 这是开始内容 -->
            <div class="module">
            <div class="module-title-2"><b>文章类别</b><small>Class</small><span><i class="glyphicon glyphicon-share-alt"></i>查看特定栏目文章</span></div>
            <ul class="module-right-list">
                <?php if($class['on'] == 0): ?><li class="on-list">全部文章<a class="btn btn-xs btn-primary disabled">当前栏目</a></li>
                <?php else: ?>
                    <li>全部文章<a href="<?php echo U('/articles');?>" class="btn btn-xs btn-success">点击进入</a></li><?php endif; ?>
                <?php if(is_array($class['data'])): $i = 0; $__LIST__ = $class['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$classData): $mod = ($i % 2 );++$i; if(($class['on']) == $classData['ar_class']): ?><li class="on-list"><?php echo ($classData['ar_c_title']); ?><a class="btn btn-xs btn-primary disabled">当前栏目</a></li>
                    <?php else: ?>
                        <li><?php echo ($classData['ar_c_title']); ?><a href="<?php echo U('/articles/'.$classData['ar_class']);?>" class="btn btn-xs btn-success">点击进入</a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
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
        <!-- 这是最后内容 -->
    </div>
    <div class="col-md-8 right">
    <article class="detail">
        <h4><?php echo ($article['ar_title']); ?></h4>
        <h5><span>发布时间：<?php echo (timestamp_to_timeline($article['ar_time'])); ?></span><span>栏目：<?php echo (get_class_title($article['ar_class'])); ?></span></h5>
        <hr/>
        <article><?php echo ($article['ar_body']); ?></article>
        <ul class="module-page-1 pull-right">
            <?php if($button['first'] != null): ?><li><a href="<?php echo U('/article/'.$article['ar_id']);?>">首页</a></li><?php endif; ?>
            <?php if($button['previous'] != null): ?><li><a href="<?php if($button['previous'] == 1): echo U('/article/'.$article['ar_id']); else: echo U('/article/'.$article['ar_id'].'_'.$button['previous']); endif; ?>">上一页</a></li><?php endif; ?>
            <?php if(is_array($button['num'])): $i = 0; $__LIST__ = $button['num'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$numData): $mod = ($i % 2 );++$i; if(($numData) == $button['on']): ?><li class="active"><a><?php echo ($numData); ?></a></li>
                <?php else: ?>
                <li><a href="<?php if($numData == 1): echo U('/article/'.$article['ar_id']); else: echo U('/article/'.$article['ar_id'].'_'.$numData); endif; ?>"><?php echo ($numData); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <?php if($button['next'] != null): ?><li><a href="<?php echo U('/article/'.$article['ar_id'].'_'.$button['next']);?>">下一页</a></li><?php endif; ?>
            <?php if($button['end'] != null): ?><li><a href="<?php echo U('/article/'.$article['ar_id'].'_'.$button['end']);?>">末页</a></li><?php endif; ?>
        </ul>
        <section>
            <?php if($article['ar_source'] != null): ?><h5><span>版权说明：</span>本文为【<?php echo ($article['ar_source']); ?>】原创文章，转载请说明出处。</h5>
            <?php else: ?>
            <h5><span>版权说明：</span>本文为【<?php echo ($site['site_name']); ?>】原创文章，转载请说明出处。</h5>
            <h5><span>文章地址：</span><?php echo ($site['site_url']); echo ($site['site_catalog']); ?>/article/<?php echo ($article['ar_id']); ?>.html</h5><?php endif; ?>
        </section>
        <footer>
            <h4 class="bdsharebuttonbox">
                <a title="分享到QQ好友" class="bds_sqq" data-cmd="sqq"></a>
                <a title="分享到QQ空间" class="bds_qzone" data-cmd="qzone"></a>
                <a title="分享到微信" class="bds_weixin" data-cmd="weixin"></a>
                <a title="分享到新浪微博" class="bds_tsina" data-cmd="tsina"></a>
                <a title="分享到腾讯微博" class="bds_tqq" data-cmd="tqq"></a>
                <a title="分享到人人网" class="bds_renren" data-cmd="renren"></a>
            </h4>
            <h4 class="pull-right hidden-xs">
                <?php if($article['previous'] == null): ?><a class="btn btn-info btn-sm disabled">当前是第一篇</a>
                <?php else: ?><a href="<?php echo U('/article/'.$article['previous']);?>" class="btn btn-info btn-sm">上一篇</a><?php endif; ?>
                <?php if($article['next'] == null): ?><a class="btn btn-info btn-sm disabled">当前是最后一篇</a>
                <?php else: ?><a href="<?php echo U('/article/'.$article['next']);?>" class="btn btn-info btn-sm">下一篇</a><?php endif; ?>
            </h4>
        </footer>
        <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
    </article>
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