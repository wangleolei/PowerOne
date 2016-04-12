<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>资讯类别管理 - Toilove Admin管理系统</title>
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

    <form action="<?php echo U('article_class_operat');?>" method="get" >
    <nav class="nav-title">
        <h4>资讯类别管理 <small>您可以在这里对文档分类进行管理</small></h4>
        <button type="submit" class="btn btn-success pull-right">添加新的类别</button>
        <section class="pull-right" style="margin-right:10px;width:150px" >
            <input type="text" name="ar_link" class="form-control" placeholder="请输入父类编号" maxlength="10" required />
        </section>
        <section class="pull-right" style="margin-right:10px;width:170px" >
            <input type="text" name="ar_c_title" class="form-control" placeholder="请输入类别名称" maxlength="10" required />
        </section>
    </nav>
    </form>
    <hr />
    <h5><b>提示</b>：删除类别后，所属其的文档将会移至回收站。</h5>
    <hr />
    <table id="list-article-class" class="table table-striped text-center">
        <thead>
        <tr>
            <th class="text-center">编号</th>
            <th class="text-center">类名</th>
            <th class="text-center">父类编号</th>
            <th class="text-center">文档数</th>
            <th class="text-center">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$classData): $mod = ($i % 2 );++$i;?><tr>
                <td class="hidden-xs"><h5><?php echo ($classData['ar_class']); ?></h5></td>
                <td><input type="text" class="form-control text-center" name="ar_c_title<?php echo ($classData['ar_class']); ?>" value="<?php echo ($classData['ar_c_title']); ?>" maxlength="10" required /></td>
                <td><input type="text" class="form-control text-center" name="ar_link<?php echo ($classData['ar_class']); ?>" value="<?php echo ($classData['ar_link']); ?>" maxlength="10" required /></td>
                <td class="text-center hidden-xs"><h5><?php echo ($classData['ar_c_number']); ?></h5></td>
                <td class="text-center">
                    <button class="btn btn-success"  onclick="operat(this,<?php echo ($classData['ar_class']); ?>,1);">保存</button>
                    <button class="btn btn-danger" onclick="operat(this,<?php echo ($classData['ar_class']); ?>);" >删除</button>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <script type="text/javascript">
    function operat(obc,id,select){
        if(select)
        {
            var value = $("input[name=ar_c_title"+id+"]").val();
            var link = $("input[name=ar_link"+id+"]").val();
        }
        else var value = 0;
        var copy = $(obc).clone();
        $(obc).addClass("disabled").removeAttr("onclick");
        $.get("<?php echo U('article_class_operat');?>",{id:id,value:value,link:link},function(state){
            if(state)alert("找不到该记录！");
            else
            {
                alert("修改成功！");
                window.location.reload();
            } 
            $(obc).replaceWith(copy);
        });
    }
    </script>

</article>
</body>
</html>