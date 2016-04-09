<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>用户信息 - Toilove Admin管理系统</title>
    <!-- ico/css/js -->
    <link rel="shortcut icon" href="/toilove.com/Public/img/favicon.ico" />
    <link rel="stylesheet" href="/toilove.com/Public/css/system.bootstrap.min.css">
    <script src="/toilove.com/Public/js/system.jquery-2.1.1.min.js"></script>
    <script src="/toilove.com/Public/js/system.bootstrap.min.js"></script>
    <!--下面是自己的ico、css和js表-->
    <link href="/toilove.com/Public/admin/css/admin.css" rel="stylesheet" type="text/css" >
</head>
<body>
<nav id="main-top" class="navbar navbar-default navbar-fixed-top" role="navigation">
    <header class="navbar-header">
        <a href="<?php echo U('index/index');?>"><img src="/toilove.com/Public/admin/img/admin_logo.png"/></a>
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
<article id="main-left">
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
<article id="main-right">

<nav class="nav-title">
    <h4>用户信息 <small>在这里可以查看用户的信息</small></h4>
    <section class="pull-right">
        <div class="input-group">
            <span class="input-group-addon">信息类型</span>
            <select class="form-control text-center" name="us_type" onchange="load_list(this.value);">
                <option value="3" <?php if(($on_type) == "3"): ?>selected<?php endif; ?> >管理员</option>
                <option value="2" <?php if(($on_type) == "2"): ?>selected<?php endif; ?> >QQ用户</option>
                <option value="1" <?php if(($on_type) == "1"): ?>selected<?php endif; ?> >访客统计</option>
            </select>
        </div>
    </section>
</nav>
<table id="list-user" class="table table-striped"></table>
<script type="text/javascript">
// 根据状态加载数据
function load_list(type){
    $.get("<?php echo U('user_list');?>?type="+type,function(list){$("table#list-user").html(list);});
}
// 首次访问自动加载列表
window.onload=load_list($("select[name=us_type]").val());
</script>

</article>
</body>
</html>