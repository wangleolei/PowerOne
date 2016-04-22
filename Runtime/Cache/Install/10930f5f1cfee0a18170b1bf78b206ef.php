<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ke361 安装</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="/taobaoke/Public/static/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="/taobaoke/Public/static/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="/taobaoke/Public/Install/css/install.css" rel="stylesheet">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="assets/js/html5shiv.js"></script>
        <![endif]-->
        <script src="/taobaoke/Public/static/jquery-1.10.2.min.js"></script>
        <script src="/taobaoke/Public/static/bootstrap/js/bootstrap.js"></script>
    </head>

    <body data-spy="scroll" data-target=".bs-docs-sidebar">
        <!-- Navbar
        ================================================== -->
        <div class="navbar navbar-inverse ">
            <div class="navbar-inner">
                <div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					    <a class="navbar-brand" target="_blank" href="http://www.361dream.com">Ke361</a>
					</div>
				
				  
                  
                    <nav class="collapse navbar-collapse">
                    	<ul id="step" class="nav navbar-nav">
                    		
    <li class="active"><a href="javascript:;">安装协议</a></li>
    <li class="active"><a href="javascript:;">环境检测</a></li>
    <li class="active"><a href="javascript:;">创建数据库</a></li>
    <li class="active"><a href="javascript:;"><?php if(($_SESSION['update']) == "1"): ?>升级<?php else: ?>安装<?php endif; ?></a></li>
    <li class="active"><a href="javascript:;">完成</a></li>

                    	</ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="jumbotron masthead">
            <div class="container">
                
    <h1>完成</h1>
    <p><?php if(($_SESSION['update']) == "1"): ?>升级<?php else: ?>安装<?php endif; ?>完成！</p>
	<?php if(isset($info)): echo ($info); endif; ?>

            </div>
        </div>


        <!-- Footer
        ================================================== -->
        <footer class="footer navbar">
            <div class="container">
                <div>
                	
    <a class="btn btn-primary btn-large" href="admin.php">登录后台</a>
    <a class="btn btn-success btn-large" href="index.php">访问首页</a>

                </div>
            </div>
        </footer>
    </body>
</html>