<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>新增通知 - Toilove Admin管理系统</title>
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
            <a href="<?php echo U('article/article_class');?>" >资讯类别管理</a>
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

    <!-- 编辑器 -->
    <script type="text/javascript" charset="utf-8" src="/powerone/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/powerone/Public/ueditor/ueditor.all.min.js"></script>
    <nav class="nav-title">
        <h4><?php if($notice != null): ?>编辑<?php else: ?>新增<?php endif; ?> <small>在这里管理【说说】【公告】【轮播图】</small></h4>
        <section class="pull-right text-right"><button class="btn btn-default" onclick="window.history.go(-1);">返回上级</button></section>
    </nav>
    <hr />
    <h5><b>发布提示</b>：发布人为当前管理员，发表时间、IP、系统将自动获取生成。</h5>
    <hr />
    <section style="width: 1136px;">
        <form id="notice_add">
            <div class="form-group ">
                <h5><b>选择发布数据的类型：</b><i>非轮播图不填后面的轮播文章ID</i></h5>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <span class="input-group-addon">类型</span>
                            <select class="form-control text-center" name="no_type">
                                <option value="1" <?php if(($on_type) == "1"): ?>selected<?php endif; ?> >说说</option>
                                <option value="2" <?php if(($on_type) == "2"): ?>selected<?php endif; ?> >公告</option>
                                <option value="3" <?php if(($on_type) == "3"): ?>selected<?php endif; ?> >轮播图</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="input-group">
                            <span class="input-group-addon">轮播文章ID</span>
                            <input type="number" class="form-control" name="no_to_article" placeholder="点击轮播图后进入的文章ID" maxlength="11" value="<?php echo ($notice['no_to_article']); ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group ">
                <h5><b>发布标题：</b><i>数据信息的标题，必填</i></h5>
                <div class="row">
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="no_title" placeholder="请输入标题" value="<?php echo ($notice['no_title']); ?>">
                    </div>
                    <div class="col-xs-6">
                        <?php if($notice != null): ?><input name="no_id" value="<?php echo ($notice['no_id']); ?>" hidden />
                        <button class="form-control btn btn-success" type="button" onclick="notice_save(this);" >保存</button>
                        <?php else: ?>
                        <button class="form-control btn btn-success" type="button" onclick="notice_add(this);" >新增</button><?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h5><b>详细内容：</b><i>为轮播图时，详细内容仅一张图片，宽高为你自己前端界面要用的图片大小。（Toilove个人博客使用的为 1170 * 360），必填</i></h5>
                <script id="editor" type="text/plain" style="height:400px;" name="no_content"><?php echo ($notice['no_content']); ?></script>
                <script type="text/javascript">var ue = UE.getEditor('editor',{initialFrameWidth: null});</script>
            </div>
        </form>
    </section>
    <script type="text/javascript">
    <?php if($notice != null): ?>function notice_save(obc){
        var copy = $(obc).clone();
        $(obc).addClass("disabled").removeAttr("onclick").html("操作中...");
        $.post("<?php echo U('operat_save');?>",$("#notice_add").serialize(),function(state){
            if(state){
                switch(state){
                    case 1: alert("新增失败！数据库写入失败！");break;
                    case 2: alert("不存在的记录！");break;
                    case 3: alert("没有修改数据！");break;
                    case 4: alert("内容里没有图片！");break;
                    default:alert("新增失败，未知的错误原因！");
                }
                $(obc).replaceWith(copy);
            }
            else
            {
                alert("保存成功！");
                location.href = "<?php echo U('index');?>";
            }
        });
    }
    <?php else: ?>
    function notice_add(obc){
        var copy = $(obc).clone();
        $(obc).addClass("disabled").removeAttr("onclick").html("操作中...");
        $.post("<?php echo U('operat_add');?>",$("#notice_add").serialize(),function(state){
            if(state){
                switch(state){
                    case 1: alert("新增失败！数据库写入失败！");break;
                    case 2: alert("类型、标题、内容是必填！");break;
                    case 3: alert("内容里没有图片！");break;
                    default:alert("新增失败，未知的错误原因！");
                }
                $(obc).replaceWith(copy);
            }
            else
            {
                alert("新增数据成功！");
                location.href = "<?php echo U('index');?>";
            }
        });
    }<?php endif; ?>
    </script>

</article>
</body>
</html>