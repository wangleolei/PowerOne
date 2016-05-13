<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>资讯文档管理 - PowerOne Admin管理系统</title>
    <!-- ico/css/js -->
    <link rel="shortcut icon" href="/powerone/Public/img/favicon.ico" />
    <link rel="stylesheet" href="/powerone/Public/css/system.bootstrap.min.css">
    <script src="/powerone/Public/js/system.jquery-2.1.1.min.js"></script>
    <script src="/powerone/Public/js/system.bootstrap.min.js"></script>
    <!--下面是自己的ico、css和js表-->
    <link href="/powerone/Public/admin/css/admin.css" rel="stylesheet" type="text/css" >
</head>
<body>
<div class="masthead">
    <nav class="navbar navbar-default " >
        <header class="navbar-header">
            <a href="<?php echo U('index/index');?>"><img src="/powerone/logo.png"/></a>
            <div class="pull-right visible-xs">
                <button class="btn btn-danger">注销登录</button>
            </div>
        </header>
        <footer class="pull-right text-right hidden-xs">
            <h5 class="navbar-text "><?php echo ($auth['ad_username']); ?></h5>
            <h5 class="navbar-text "><?php echo ($auth['on_time']); ?></h5>
            <a href="<?php echo U('/');?>" target="_blank" class="btn btn-info btn-sm">网站首页</a><a href="<?php echo U('index/index');?>" class="btn btn-warning btn-sm">后台首页</a><a class="btn btn-danger btn-sm" onclick="exitLogin();">注销登录</a>
        </footer>
    </nav>
</div>

<script>
    function exitLogin(){
        if(confirm("要退出当前登录吗？")){
            $.get("<?php echo U('login/exit_login');?>",function(state){
                if (state){
                    alert("退出成功！");
                    location.href = "<?php echo U('login/index');?>";
                }
                else alert("退出失败！");
            });
        }
    }
</script>
<article id="main-left" class="col-md-2">
    <section><a href="<?php echo U('/');?>" class="no_clear_session" target="_blank"><span class="glyphicon glyphicon-home"></span>网站首页</a></section>
    <section><a href="<?php echo U('index/index');?>" class="no_clear_session"><span class="glyphicon glyphicon-home"></span>后台首页</a></section>
    <section><a href="<?php echo U('user/index');?>" ><span class="glyphicon glyphicon-user"></span>用户信息</a></section>
    <section><a href="<?php echo U('notice/index');?>"><span class="glyphicon glyphicon-bullhorn"></span>说说、公告、轮播</a></section>
    <section>
        <header data-toggle="collapse" data-target="#nav-article"><a><span class="glyphicon glyphicon-list-alt"></span>资讯文档</a></header>
        <footer class="collapse" id="nav-article">
            <a href="<?php echo U('article/article_publish');?>" >编写文档</a>
            <a href="<?php echo U('article/index');?>" >已发布文档</a>
            <a href="<?php echo U('article/article_box');?>" >存稿箱与回收站</a>
            <a href="<?php echo U('article/Article_class');?>" >资讯类别管理</a>
            <a href="<?php echo U('article/wechat');?>" >推送到微信公众号</a>
        </footer>
    </section>
    <section><a href="<?php echo U('link/index');?>" ><span class="glyphicon glyphicon-link"></span>友情链接</a></section>
    <section><a href="<?php echo U('parameter/index');?>" ><span class="glyphicon glyphicon-cog"></span>系统设置</a></section>
</article>
<script type="text/javascript">
    $("#main-left a[href]").click(function(){
        if(!$(this).hasClass("no_clear_session"))$.ajax($(this).attr("href"),{async: false});
    });
</script>
<article id="main-right1" class="col-md-10">

    <nav class="nav-title">
        <h4><?php if($article != null): ?>编辑<?php else: ?>新增<?php endif; ?>文档 <small>你可以在这里<?php if($article != null): ?>编辑<?php else: ?>新增<?php endif; ?>文档</small></h4>
        <section class="pull-right text-right"><button class="btn btn-default" onclick="window.history.go(-1);">返回上级</button></section>
    </nav>
    <hr />
    <!-- 编辑器 -->
    <script type="text/javascript" charset="utf-8" src="/powerone/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/powerone/Public/ueditor/ueditor.all.min.js"></script>
    <form class="article-publish" role="form" action="<?php echo U('article_operat?id='.$article['ar_id']);?>" method="post" enctype="multipart/form-data" style="width: 100%">
        <div class="form-group row" >
            <div class="col-xs-8" >
                <div class="input-group">
                    <span class="input-group-addon">资讯标题</span>
                    <input type="text" class="form-control" placeholder="资讯标题，最多不超过32个字符" maxlength="32" name="ar_title" value="<?php echo ($article['ar_title']); ?>" required />
                </div>
            </div>
            <div class="col-xs-4">
                <div class="input-group">
                    <span class="input-group-addon">选择栏目</span>
                    <select class="form-control text-center" name="ar_class">
                        <?php if(is_array($Articleclass)): $i = 0; $__LIST__ = $Articleclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$classData): $mod = ($i % 2 );++$i;?><option value="<?php echo ($classData['ar_class']); ?>" <?php if(($classData['ar_class']) == $article['ar_class']): ?>selected<?php endif; ?> ><?php echo ($classData['ar_c_title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-8">
                <div class="input-group">
                    <span class="input-group-addon">关键词语</span>
                    <input type="text" class="form-control" placeholder="文档关键词，seo使用关键词，多个用小写逗号【,】 隔开，最多三个词，总计不超过16个字符" maxlength="16" name="ar_keywords" value="<?php echo ($article['ar_keywords']); ?>" required />
                </div>
            </div>
            <div class="col-xs-4">
                <div class="input-group">
                    <span class="input-group-addon">特殊显示</span>
                    <select class="form-control text-center" name="ar_position">
                        <option value="0" <?php if(($article['ar_position']) == "0"): ?>selected<?php endif; ?> >默认</option>
                        <option value="1" <?php if(($article['ar_position']) == "1"): ?>selected<?php endif; ?> >推荐</option>
                        <option value="2" <?php if(($article['ar_position']) == "2"): ?>selected<?php endif; ?> >置顶</option>
                        <option value="3" <?php if(($article['ar_position']) == "3"): ?>selected<?php endif; ?> >推荐并置顶</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="input-group form-group">
            <span class="input-group-addon">导航语句</span>
            <input type="text" class="form-control" placeholder="导航语句，seo使用描述文本，简述，不超过128个字符" maxlength="128" name="ar_description" value="<?php echo ($article['ar_description']); ?>" required />
        </div>
        <h5><b>封面提示1</b>：勾选“使用内容的第一张图片作封面”选项又上传单独封面了，会优先使用上传的单独封面。</h5>
        <?php if($article != null): ?><h5><b>封面提示2</b>：未勾选且未上传单独封面，将保持文档原封面不变。</h5>
        <?php else: ?>
        <h5><b>封面提示2</b>：未勾选且未上传单独封面，将随机使用系统默认封面。</h5><?php endif; ?>
        <div class="form-group row">
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="input-group-addon"><input id="auto-cover" name="auto_cover" value="true" type="checkbox" <?php if($article == null): ?>checked<?php endif; ?> /></span>
                    <label class="form-control" for="auto-cover">使用内容的第一张图片作封面（内容无图片将随机使用系统默认封面）</label>
                </div>
            </div>
            <div class="col-xs-6">
                <label for="upload-cover" class="col-xs-4 control-label text-center">单独封面</label>
                <div class="col-xs-8"><input type="file" name="upload<?php echo ($article['ar_id']); ?>" id="upload-cover"></div>
            </div>
        </div>
        <div class="form-group">
            <script id="editor" type="text/plain" style="height:400px; weight:100%" name="ar_body" ><?php echo ($article['ar_body']); ?></script>
            <script type="text/javascript">var ue = UE.getEditor('editor',{initialFrameWidth: null});</script>
        </div>
        <div class="form-group row">
            <div class="col-xs-4">
                <div class="input-group">
                    <span class="input-group-addon">点击数量</span>
                    <input type="number" min="0" class="form-control" placeholder="初始点击数量，留空起始值0" name="ar_hits" value="<?php echo ($article['ar_hits']); ?>" />
                </div>
            </div>
            <div class="col-xs-4">
                <div class="input-group">
                    <span class="input-group-addon">资讯来源</span>
                    <input type="text" class="form-control" placeholder="原创文档请留空" maxlength="16" name="ar_source" value="<?php echo ($article['ar_source']); ?>" />
                </div>
            </div>
            <div class="col-xs-4 text-right">
                <?php if($article != null): ?><input name="ar_id" value="<?php echo ($article['ar_id']); ?>" hidden />
                <button type="submit" class="btn btn-success">保存修改</button>
                <?php else: ?>
                <button type="submit" class="btn btn-info" name="operat" value="draft" >放入存稿箱</button>
                <button type="submit" class="btn btn-success" name="operat" value="publish" >正式发布</button><?php endif; ?>
            </div>
        </div>
    </form>

</article>
</body>
</html>