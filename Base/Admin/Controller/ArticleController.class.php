<?php
namespace Admin\Controller;

use Common\Controller\AuthController;

class ArticleController extends AuthController {

    // 已发布文档查看 -> end in 2016/02/28
    public function index(){
        if(IS_AJAX)session('admin.article',null);
        else
        {
            $session = session('admin.article');
            if(I('get.class'))$class['on'] = I('get.class');
            elseif($session['ar_class'])$class['on'] = $session['ar_class'];
            $class['data'] = M('Articleclass') -> select();
            $this -> assign('class',$class);
            $this -> display();
        }
    }

    // 存稿箱与回收站 -> end in 2016/02/28
    public function article_box(){
        if(IS_AJAX)session('admin.article',null);
        else
        {
            if(I('get.state'))
            {
                $state = I('get.state');
                $this -> assign('state',$state);
            }
            $this -> display();
        }
    }

    // 文档列表 -> end in 2016/02/28
    public function article_list(){
        if(IS_AJAX){
            // 获取 session
            $session = session('admin.article');
            // 当前页
            if(I('get.class')&&(I('get.class')!=$session['ar_class']))$session['now_page'] = $now_page = 1;
            elseif(I('get.state')&&(I('get.state')!=$session['ar_state']))$session['now_page'] = $now_page = 1;
            elseif(I('get.page'))$session['now_page'] = $now_page = I('get.page');
            elseif($session['now_page'])$now_page = $session['now_page'];
            else $session['now_page'] = $now_page = 1;
            // 类别
            if(I('get.class'))$session['ar_class'] = $where['ar_class'] = I('get.class');
            elseif(I('get.class')=='0')unset($session['ar_class']);
            elseif($session['ar_class'])$where['ar_class'] = $session['ar_class'];
            // 状态
            if(I('get.state'))$session['ar_state'] = $where['ar_state'] = I('get.state');
            elseif($session['ar_state'])$where['ar_state'] = $session['ar_state'];
            else $session['ar_state'] = $where['ar_state'] = 1;
            session('admin.article',$session);
            // 数据分页
            $sum  = M('article') -> where($where) -> count();
            $page = new \Org\Powerone\Page($sum,15);
            $page->ulcss = 'page-ul';
            $page->licss = 'page-on';
            $page->now   = $now_page;
            $button = $page->show();
            if(($page->pages)>1){
                $this -> assign('button',$button);
                $this -> assign('pages',$page->pages);
            }
            // 文章信息
            $article = M('article') -> where($where) -> order('ar_time desc') -> limit($page->limit,$page->single) -> select();
            $this -> assign('article',$article);
            // 当前状态
            $this -> assign('on_state',$where['ar_state']);
            $this -> display();
        }
        else $this -> error('你的操作有错误！');
    }

    // 已发布文档查看 关于推送到微信公众平台-> end in 2016/05/07
    public function wechat(){
        if(IS_AJAX){
        }
        else
        {
            $session = session('admin.article');
            if(I('get.class'))$class['on'] = I('get.class');
            elseif($session['ar_class'])$class['on'] = $session['ar_class'];
            $class['data'] = M('Articleclass') -> select();
            $this -> assign('class',$class);

            $article = D('Common/Article');
            $articlelist = $article->wechatlist();
            $this -> assign('article',$articlelist);
            $this -> display();
        }
    }
// 微信send to all 
    public function senttoall(){
        if(IS_AJAX){
            $article = D('Common/Article');
            $articlelist = $article->wechatlist();
//            foreach ($articlelist as $key => $value) {
//                $value['ar_title']
//            }

            $appid = "wx23fd7c74957292e0";
            $appsecret = "d4624c36b6795d1d99dcf0547af5443d";
            $groupid = 0;
            $type = 'text';
            $data = 'test message2';
            $weixin = new \Common\Logic\WechatadvLogic($appid, $appsecret); 
            $news[] = array("thumb_media_id"=>$thumb_media_id3,
                "author"=>"方倍工作室",
                "title"=>"微信公众平台开发最佳实践",
                "content_source_url" =>"http://m.cnblogs.com/?u=txw1958",
                "content" =>"<p>本书共分10章，案例程序采用广泛流行的PHP、MySQL、XML、CSS、JavaScript、HTML5等程序语言及数据库实现。系统完整地介绍微信公众平台基础接口、自定义菜单、高级接口、微信支付、分享转发等所有相关技术，以生活类、娱乐类、企业类微信开发为切入点，讲解了30多个功能或应用案例。<br>本书按照从简单到复杂，从基础到实践的方式编排，在讲解过程中注重将原理和实践相结合。初学者可以在了解PHP和MySQL语法之后，从头至尾学习，对于其中难以理解的部分可以查阅相关资料，针对企业功能类的开发还需要具有一定的JavaScript、CSS、HTML等编程基础。<br>本书可以作为微信公众平台开发的教程。对于移动互联网及微信公众平台的相关从业人员，本书也具有极大的参考价值。</p>",
                "digest" =>"微信公众平台开发含金量最高的书籍"
                );
$mpnews = $weixin->upload_news($news);
            $weixin->mass_send_group($groupid, $type, $data);
            $state = 0;
            //0表示成功  1 表示失败
            $this -> ajaxReturn($state);
        }
    }

    // 改变文档定位 -> end in 2016/02/29
    public function article_position(){
        if(IS_AJAX){
            if(I('get.id')){
                $save['ar_position'] = I('get.value');
                if(M('article') -> where('ar_id='.I('get.id')) -> save($save))$state = 0;
                else $state = 1;
            }
            else $state = 2;
            $this -> ajaxReturn($state);
        }
        else $this -> error('你的操作有错误！');
    }

    // 改变文档状态 -> end in 2016/02/29 
    public function article_state(){
        if (IS_AJAX) {
            if(I('get.id')&&I('get.value'))
            {
                $where['ar_id']   = I('get.id');
                $save['ar_state'] = I('get.value');
                $on = M('article')->where($where) -> getField('ar_state');
                if($on=='2'&&$save['ar_state']=='1')$save['ar_time'] = $save['ar_last_time'] = time();
            }
            else $state=2;
            if($state)$this -> ajaxReturn($state);
            else
            {
                if(M('article')->where($where)->save($save))$state=0;
                else $state=1;
                $this -> ajaxReturn($state);
            }
        }
        else $this -> error('你的操作有错误！');
    }

    // 加入微信图文 -> end in 20160507
    public function article_wechat(){
        if(IS_AJAX){
            if(I('get.id')){
                $save['ar_wechat'] = I('get.value');
                if(M('article') -> where('ar_id='.I('get.id')) -> save($save))$state = 0;
                else $state = 1;
            }
            else $state = 2;
            $this -> ajaxReturn($state);
        }
        else $this -> error('你的操作有错误！');
    }

    // 删除文档 -> end in 2016/02/29
    public function article_delete(){
        if (IS_AJAX) {
            if(I('get.id'))$id = I('get.id');
            else $state=1;
            if($state)$this -> ajaxReturn($state);
            else
            {
                M('article')->where('ar_id='.$id)->delete();
                $state=0;
                $this -> ajaxReturn($state);
            }
        }
        else $this -> error('你的操作有错误！');
    }

    // 资讯文档类别管理 -> end in 2016/02/29
    public function Article_class(){
        if(IS_AJAX)session('admin.article',null);
        else
        {
            $class = M('Articleclass') -> select();
            $this -> assign('class',$class);
            $this -> display();
        }
    }

    // 资讯文档类别管理 -> end in 2016/02/29
    public function Article_class_operat(){
        if(IS_AJAX)
        {
            if(!I('get.id'))$state=1;
            if($state)$this -> ajaxReturn($state);
            else
            {
                if(I('get.value')){
                    $save['ar_c_title'] = I('get.value');
                    $save['ar_parent'] = I('get.link');
                    $save['ar_c_url'] = I('get.url');
                    M('Articleclass') -> where('ar_class='.I('get.id')) -> save($save);
                }
                else
                {
                    M('Articleclass') -> where('ar_class='.I('get.id')) -> delete();
                    $save['ar_state'] = 3;
                    $save['ar_class'] = 1;
                    M('article') -> where('ar_class='.I('get.id')) -> save($save);
                }
                $state=0;
                $this -> ajaxReturn($state);
            }
        }
        elseif(IS_GET)
        {
            $add['ar_c_title'] = I('get.ar_c_title');
            $add['ar_parent'] = I('get.ar_parent');
            if(M('Articleclass') -> add($add))$this -> success('新增类别成功！');
            else $this -> error('存储数据失败！');
        }
        else $this -> error('你的操作有错误！');
    }

    // 文档 发表 / 编辑 -> end in 2016/02/29
    public function article_publish(){
        if(IS_AJAX)session('admin.article',null);
        else
        {
            if(I('get.id')){
                $article            = M('article') -> where('ar_id='.I('get.id')) -> find();
                $article['ar_body'] = M('Articledata') -> where('ar_id='.I('get.id')) -> getField('ar_body');
                $this -> assign('article',$article);
            }
            // 获取类别信息
            $Articleclass = M('Articleclass') -> select();
            $this -> assign('Articleclass',$Articleclass);
            $this -> display();
        }
    }

    // 文档操作 -> end in 2016/02/29
    public function article_operat(){
        if(IS_POST){
            $array = array('control_code','ar_class','ar_position','ar_title','ar_keywords','ar_description','ar_source','ar_hits');
            $cut['width']  = 140;
            $cut['height'] = 105;
            if(I('get.id')){
                $article            = M('article') -> where('ar_id='.I('get.id')) -> find();
                $article['ar_body'] = M('Articledata') -> where('ar_id='.I('get.id')) -> getField('ar_body');
                for($i=0;$i<count($array);$i++){
                    if(I('post.'.$array[$i])!=$article[$array[$i]])$save[$array[$i]] = I('post.'.$array[$i]);
                }
                if($_POST['ar_body']!=$article['ar_body']){
                    $saveData['ar_body']  = $_POST['ar_body'];
                    if(get_magic_quotes_gpc())//如果get_magic_quotes_gpc()是打开的
                    {
                    $saveData['ar_body']=stripslashes($saveData['ar_body']);//将字符串进行处理
                    }
                    $admin = session('admin.auth');
                    $save['ar_last_user'] = $admin['ad_id'];
                    $save['ar_last_time'] = time();
                }
                $upload = upload_file(I('get.id'),$cut);
                if($upload)$save['ar_cover_img'] = $upload;
                elseif(I('post.auto_cover'))$save['ar_cover_img'] = get_string_img($saveData['ar_body'],$cut);
                M('article') -> where('ar_id='.I('get.id')) -> save($save);
                M('Articledata') -> where('ar_id='.I('get.id')) -> save($saveData);
                if($article['ar_state']=='1')
                {
                    if($save['ar_class'])$url = U('index?class='.$save['ar_class']);
                    else $url = U('index?class='.$article['ar_class']);
                }
                else $url = U('article_box?state='.$article['ar_state']);
            }
            else
            {
                for($i=0;$i<count($array);$i++){
                    if(I('post.'.$array[$i])||(I('post.'.$array[$i])=='0'))$add[$array[$i]] = I('post.'.$array[$i]);
                }
                $addData['ar_body'] = $_POST['ar_body'];
                if(get_magic_quotes_gpc())//如果get_magic_quotes_gpc()是打开的
                {
                    $addData['ar_body']=stripslashes($addData['ar_body']);//将字符串进行处理
                }
                $upload = upload_file('',$cut);
                if($upload)$add['ar_cover_img'] = $upload;
                else $add['ar_cover_img'] = get_string_img($addData['ar_body'],$cut);
                $add['ar_last_time'] = time();
                switch (I('post.operat')){
                    case 'publish': 
                    {
                        $add['ar_state'] = 1;
                        $add['ar_time']  = $add['ar_last_time'];
                        $admin = session('admin.auth');
                        $add['ar_last_user'] = $admin['ad_id'];
                        $url = U('index?class='.$add['ar_class']);
                        break;
                    }
                    case 'draft': 
                    {
                        $add['ar_state'] = 2;
                        $url = U('article_box?state=2');
                        break;
                    }
                }
                $addData['ar_id'] = M('article') -> add($add);
                M('Articledata') -> add($addData);
            }
            $this -> success('操作成功！',$url);
        }
        else $this -> error('你的操作有错误！');
    }


    public function uploadify()
 {
    var_dump("tseting");
    if (!empty($_FILES)) {
        var_dump("expression");
        import("@.ORG.UploadFile");
        $upload = new \Org\UploadFile();
//        $upload = new \Think\Upload();
        $upload->maxSize = 2048000;
        $upload->allowExts = array('jpg','jpeg','gif','png');
        $upload->savePath = "./upload/image/";
        $upload->thumb = true; //设置缩略图
        $upload->imageClassPath = "@.ORG.Image";
        $upload->thumbPrefix = "130_,75_,24_"; //生成多张缩略图
        $upload->thumbMaxWidth = "130,75,24";
        $upload->thumbMaxHeight = "130,75,24";
        $upload->saveRule = uniqid; //上传规则
        $upload->thumbRemoveOrigin = true; //删除原图
        if(!$upload->upload()){
            $this->error($upload->getErrorMsg());//获取失败信息
        } else {
            $info = $upload->getUploadFileInfo();//获取成功信息
        }
        echo $info[0]['savename'];    //返回文件名给JS作回调用
    }
 }

}