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
            $array = array('ar_class','ar_position','ar_title','ar_keywords','ar_description','ar_source','ar_hits');
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

}