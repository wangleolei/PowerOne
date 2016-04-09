<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?>|管理平台</title>
    <link href="/taobaoke/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link href="/taobaoke/Public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    
    <link rel="stylesheet" type="text/css" href="/taobaoke/Public/Admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/taobaoke/Public/Admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/taobaoke/Public/Admin/css/module.css">
    <link rel="stylesheet" type="text/css" href="/taobaoke/Public/Admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/taobaoke/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">
   	
		
     <!--[if lt IE 9]>
    <script type="text/javascript" src="/taobaoke/Public/static/jquery-1.10.2.min.js"></script>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]>
    <!-->
    <script type="text/javascript" src="/taobaoke/Public/static/jquery-2.0.3.min.js"></script> 
	<!--<![endif]-->
	<script type="text/javascript" src="/taobaoke/Public/Admin/js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="/taobaoke/Public/Admin/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/taobaoke/Public/static/bootstrap/js/bootstrap.min.js"></script>
	
    
</head>
<body>
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <span class="logo"></span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav">
            <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (U($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- /主导航 -->
		
        <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                <li class="manager">你好，<em title="<?php echo session('user_auth_admin.username');?>"><?php echo session('user_auth.username');?></em></li>
                <li><a href="<?php echo U('User/updatePassword');?>">修改密码</a></li>
                <li><a href="<?php echo U('User/updateNickname');?>">修改昵称</a></li>
                <li><a href="<?php echo U('Public/logout');?>">退出</a></li>
            </ul>
        </div>
        <div class="web-index">
			<a href="index.php?s=Home/Index/index.html" target="_blank">网站首页</a>
		</div>
    </div>
    <!-- /头部 -->

    <!-- 边栏 -->
    <div class="sidebar">
        <!-- 子导航 -->
        
            <div id="subnav" class="subnav">
                <?php if(!empty($_extra_menu)): ?>
                    <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>
                <?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
                    <?php if(!empty($sub_menu)): if(!empty($key)): ?><h3><i class="icon icon-unfold"></i><?php echo ($key); ?></h3><?php endif; ?>
                        <ul class="side-sub-menu">
                            <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
                                    <a class="item" href="<?php echo (U($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul><?php endif; ?>
                    <!-- /子导航 --><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        
        <!-- /子导航 -->
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div id="main-content">
        <div id="top-alert" class="fixed alert alert-error" style="display: none;">
            <button class="close fixed" style="margin-top: 4px;">&times;</button>
            <div class="alert-content">这是内容</div>
        </div>
        <div id="main" class="main">
            
            <!-- nav -->
            <?php if(!empty($_show_nav)): ?><div class="breadcrumb">
                <span>您的位置:</span>
                <?php $i = '1'; ?>
                <?php if(is_array($_nav)): foreach($_nav as $k=>$v): if($i == count($_nav)): ?><span><?php echo ($v); ?></span>
                    <?php else: ?>
                    <span><a href="<?php echo ($k); ?>"><?php echo ($v); ?></a>&gt;</span><?php endif; ?>
                    <?php $i = $i+1; endforeach; endif; ?>
            </div><?php endif; ?>
            <!-- nav -->
            

            
    <div class="cf">
		<div class="fl">
            <a class="btn" href="<?php echo U('Goods/edit');?>">新 增</a>
            <a class="btn ajax-post" href="<?php echo U('Goods/status?s=1');?>" target-form="ids">上架</a>
           
            <button class="btn ajax-post confirm" url="<?php echo U('Goods/del');?>" target-form="ids">删 除</button>
        </div>

        <!-- 高级搜索 -->
		<div class="search-form fr cf">
			<div class="">
				<select class="" name="cate_id">
                                        <option value="0">选择栏目</option>
                                        <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data['id']); ?>">
                                        	<?php if($data["p_id"] > 0): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; ?>	
                                        		<?php echo ($data['category_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>                                        
                                    </select>
				<a class="sch-btn" href="javascript:;" id="search" url="<?php echo U('index');?>"><i class="btn-search"></i></a>
			</div>
		</div>
    </div>
        
        
    <div class="data-table table-striped">
           
            <table class="">
                <thead>
                    <tr >
                       <th class="row-selected row-selected"><input class="check-all" type="checkbox"/></th>
                        <th>商品名称</th>
                        <th>商品类型</th>
                        <th>价格(元)</th>
					  <th>折扣价(元)</th>
                        <th>添加人</th>
                        <th>状态</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($goodsList)): if(is_array($goodsList)): $i = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr class="pointer even" title="">
                        <td><input class="ids" type="checkbox" name="id[]" value="<?php echo ($data["goods_id"]); ?>" /></td>
                        <td><a href="<?php echo ($data['item_url']); ?>" target='_blank'><?php echo ($data['title']); ?></a></td>
                        <td><?php echo ($data['goods_type']); ?></td>
                        <td><?php echo ($data['price']); ?></td>
						<td><?php echo ($data['discount_price']); ?></td>
                        <td><?php echo ($data['add_uname']); ?></td>
                        <td><a class="confirm ajax-get" href="<?php echo U('Goods/status',array('id'=>$data['goods_id'],'status'=>$data['status']));?>" title=""><?php echo ($data['status']?'<font color="green">上架</font>':'<font color="red">下架</font>'); ?></a></td>
                        <td><?php echo date('Y-m-d H:i:s',$data['ctime']);?></td>
                        <td> 
                            <a target="_blank" href='http://pub.alimama.com/myunion.htm?spm=a2320.7388781.a214tr8.d006.IyDOZN#!/promo/self/items?q=<?php echo urlencode($data[item_url]);?>'>查看</a>
                            |
                            <a id="" href="<?php echo U('Goods/edit',array('goods_id'=>$data['goods_id']));?>" title="">编辑</a>
                            |
                            <a class="confirm ajax-get" href="<?php echo U('Goods/del?id='.$data['goods_id']);?>" title="删除">删除</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php else: ?>
				<td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
                </tbody>
            </table></div>
    <div class="page">
        <?php echo ($_page); ?>
    </div>
    
    <script type="text/javascript">
    
    $(function(){
       
      //搜索功能
    	$("#search").click(function(){
    		var url = $(this).attr('url');
            var query  = $('.search-form').find('select').serialize();
            query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
            query = query.replace(/^&/g,'');
            if( url.indexOf('?')>0 ){
                url += '&' + query;
            }else{
                url += '?' + query;
            }
    		window.location.href = url;
    	});
    });
  
    
</script>

        </div>
        <div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用<a href="http://www.361dream.com" target="_blank">Ke361</a>管理平台</div>
                <div class="fr">V<?php echo (ONETHINK_VERSION); ?></div>
            </div>
        </div>
    </div>
    <!-- /内容区 -->
    <script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "/taobaoke", //当前网站地址
            "APP"    : "/taobaoke/admin.php?s=", //当前项目地址
            "PUBLIC" : "/taobaoke/Public", //项目公共目录地址
            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="/taobaoke/Public/static/think.js"></script>
    <script type="text/javascript" src="/taobaoke/Public/Admin/js/common.js"></script>
    <script type="text/javascript">
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

            /* 左边菜单高亮 */
            url = window.location.pathname + window.location.search;
            url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
            $subnav.find("a[href='" + url + "']").parent().addClass("current");

            /* 左边菜单显示收起 */
            $("#subnav").on("click", "h3", function(){
                var $this = $(this);
                $this.find(".icon").toggleClass("icon-fold");
                $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                      prev("h3").find("i").addClass("icon-fold").end().end().hide();
            });

            $("#subnav h3 a").click(function(e){e.stopPropagation()});

            /* 头部管理员菜单 */
            $(".user-bar").mouseenter(function(){
                var userMenu = $(this).children(".user-menu ");
                userMenu.removeClass("hidden");
                clearTimeout(userMenu.data("timeout"));
            }).mouseleave(function(){
                var userMenu = $(this).children(".user-menu");
                userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
            });

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });

            // 导航栏超出窗口高度后的模拟滚动条
            var sHeight = $(".sidebar").height();
            var subHeight  = $(".subnav").height();
            var diff = subHeight - sHeight; //250
            var sub = $(".subnav");
            if(diff > 0){
                $(window).mousewheel(function(event, delta){
                    if(delta>0){
                        if(parseInt(sub.css('marginTop'))>-10){
                            sub.css('marginTop','0px');
                        }else{
                            sub.css('marginTop','+='+10);
                        }
                    }else{
                        if(parseInt(sub.css('marginTop'))<'-'+(diff-10)){
                            sub.css('marginTop','-'+(diff-10));
                        }else{
                            sub.css('marginTop','-='+10);
                        }
                    }
                });
            }
        }();
    </script>
    
</body>
</html>