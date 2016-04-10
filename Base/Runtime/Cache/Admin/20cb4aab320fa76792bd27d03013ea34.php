<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>已发布文档 - Toilove Admin管理系统</title>
    <!-- ico/css/js -->
    <link rel="shortcut icon" href="/powerone/Public/img/favicon.ico" />
    <link rel="stylesheet" href="/powerone/Public/css/system.bootstrap.min.css">
    <script src="/powerone/Public/js/system.jquery-2.1.1.min.js"></script>
    <script src="/powerone/Public/js/system.bootstrap.min.js"></script>
    <!--下面是自己的ico、css和js表-->
    <link href="/powerone/Public/admin/css/admin.css" rel="stylesheet" type="text/css" >
</head>
<body>
<nav id="main-top" class="navbar navbar-default navbar-fixed-top" role="navigation">
    <header class="navbar-header">
        <a href="<?php echo U('index/index');?>"><img src="/powerone/Public/admin/img/admin_logo.png"/></a>
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
<article id="main-left1" class="col-md-2">
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

    <nav class="nav-title">
        <h4>已发布文档 <small>这里显示所有的已发布的资讯文档，您可以对其进行各项操作</small></h4>
        <section class="pull-right" style="width:370px;">
            <div class="input-group">
                <span class="input-group-addon">选择栏目</span>
                <select class="form-control" name="ar_class" onchange="load_list(this.value)">
                    <option value="0" >查看全部</option>
                    <?php if(is_array($class['data'])): $i = 0; $__LIST__ = $class['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$classData): $mod = ($i % 2 );++$i;?><option value="<?php echo ($classData['ar_class']); ?>" <?php if(($class['on']) == $classData['ar_class']): ?>selected<?php endif; ?> ><?php echo ($classData['ar_c_title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </section>
    </nav>
    <table id="list-article" class="table table-striped"></table>
    <script type="text/javascript">
    // 根据状态加载数据
    function load_list(value){
        $.get("<?php echo U('article_list');?>?class="+value,function(list){$("table#list-article").html(list);});
    }
    // 首次访问自动加载列表
    window.onload=load_list($("select[name=ar_class]").val());
    </script>

</article>
</body>
</html>