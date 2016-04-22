<?php if (!defined('THINK_PATH')) exit();?><html>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>Toilove Admin管理系统</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/toilove.com/Public/admin/css/reset.css">
        <link rel="stylesheet" href="/toilove.com/Public/admin/css/supersized.css">
        <link rel="stylesheet" href="/toilove.com/Public/admin/css/style.css">
        <script src="/toilove.com/Public/admin/js/jquery-1.11.0.min.js" ></script>
        <script src="/toilove.com/Public/admin/js/supersized.3.2.7.min.js" ></script>
        <script src="/toilove.com/Public/admin/js/scripts.js" ></script>
    </head>
    <body>
        <div class="page-container">
            <h1>系统登陆</h1>
            <form id="userForm">
                <input type="text" name="username" class="username" placeholder="请输入后台账号" maxlength="32" required >
                <input type="password" name="password" class="password" placeholder="请输入后台密码" maxlength="32" required >
                <img src="<?php echo U('verify');?>" class="CaptchaImg" onClick="this.src=this.src+'?'+Math.random();" title="点击更换验证码。">
                <input type="Captcha" class="Captcha" name="captcha" placeholder="请输入验证码" maxlength="4">
                <button type="submit" class="submit_button" onclick="login(this);return false;">登录</button>
            </form>
        </div>
        <script>
            function login(obc){
                var copy = $(obc).clone();
                $(obc).attr("disabled","true").removeAttr("onclick").html("登录中");
                $.post("<?php echo U('login');?>",$("#userForm").serialize(),function(state){
                    if(state){
                        switch(state){
                            case 1: alert("该账号不存在！");break;
                            case 2: alert("账户状态为不可登陆！");break;
                            case 3: alert("密码错误！");break;
                            case 4: alert("验证码错误！");break;
                        }
                        $(obc).replaceWith(copy);
                    }
                    else
                    {
                        alert("登录成功！");
                        location.href = "<?php echo U('index/index');?>";
                    }
                });
            }
            // 背景轮换
            jQuery(function($){
            $.supersized({
                // 功能
                slide_interval     : 4000,    // 转换之间的长度
                transition         : 1,    // 0 - 无，1 - 淡入淡出，2 - 滑动顶，3 - 滑动向右，4 - 滑底，5 - 滑块向左，6 - 旋转木马右键，7 - 左旋转木马
                transition_speed   : 1000,    // 转型速度
                performance        : 1,    // 0 - 正常，1 - 混合速度/质量，2 - 更优的图像质量，三优的转换速度//（仅适用于火狐/ IE浏览器，而不是Webkit的）
                // 大小和位置
                min_width          : 0,    // 最小允许宽度（以像素为单位）
                min_height         : 0,    // 最小允许高度（以像素为单位）
                vertical_center    : 1,    // 垂直居中背景
                horizontal_center  : 1,    // 水平中心的背景
                fit_always         : 0,    // 图像绝不会超过浏览器的宽度或高度（忽略分钟。尺寸）
                fit_portrait       : 1,    // 纵向图像将不超过浏览器高度
                fit_landscape      : 0,    // 景观的图像将不超过宽度的浏览器
                // 组件
                slide_links        : "blank",    // 个别环节为每张幻灯片（选项：假的，'民'，'名'，'空'）
                slides             : [    // 幻灯片影像
                                         {image : "/toilove.com/Public/admin/img/1.jpg"},
                                         {image : "/toilove.com/Public/admin/img/2.jpg"},
                                         {image : "/toilove.com/Public/admin/img/3.jpg"}
                               ]
                });
            });
        </script>
    </body>
</html>