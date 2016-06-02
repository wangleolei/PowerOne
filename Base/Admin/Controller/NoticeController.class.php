<?php
namespace Admin\Controller;

use Common\Controller\AuthController;

class NoticeController extends AuthController {

    // 通知主页 -> end in 2016/02/26 
    public function index(){
        if(IS_AJAX)session('admin.notice',null);
        else
        {
            $cvt = D('Common/Codedvalue');
            $cvt10003 = $cvt->getbyindex(58,10003);
            $this -> assign('cvt10003',$cvt10003);

            $session = session('admin.notice');
            if($session['no_type'])$on_type = $session['no_type'];
            $this -> assign('on_type',$on_type);
            $this -> display();
        }
    }

    // 通知列表 -> end in 2016/02/26
    public function notice_list(){
        if(IS_AJAX){
            $session = session('admin.notice');
            // 当前页
            if(I('get.type')&&(I('get.type')!=$session['no_type']))$session['now_page'] = $now_page = 1;
            elseif(I('get.page'))$session['now_page'] = $now_page = I('get.page');
            elseif($session['now_page'])$now_page = $session['now_page'];
            else $session['now_page'] = $now_page = 1;
            // 当类型
            if(I('get.type'))$session['no_type'] = $where['no_type'] = I('get.type');
            elseif($session['no_type'])$where['no_type'] = $session['no_type'];
            else $session['no_type'] = $where['no_type'] = 1;
            session('admin.notice',$session);
            unset($session);
            // 数据分页
            $sum  = M('notice') -> where($where) -> count();
            $page = new \Org\Powerone\Page($sum,15);
            $page->ulcss = 'page-ul';
            $page->licss = 'page-on';
            $page->now   = $now_page;
            $button = $page->show();
            if(($page->pages)>1){
                $this -> assign('button',$button);
                $this -> assign('pages',$page->pages);
            }
            //用户数据
            $notice = M('notice') -> where($where) -> order('no_time desc') -> limit($page->limit,$page->single) -> select();
            $this->assign('notice',$notice);
            $this->assign('no_type',$where['no_type']);
            unset($where);
            unset($notice);
            $this -> display();
        }
        else $this -> error('你的操作有错误！');
    }

    // 新增通知 -> end in 2016/02/26
    public function notice_add(){
        $cvt = D('Common/Codedvalue');
        $cvt10003 = $cvt->getbyindex(58,10003);
        $this -> assign('cvt10003',$cvt10003);

        $session = session('admin.notice');
        if($session['no_type'])$on_type = $session['no_type'];
        $this -> assign('on_type',$on_type);
        if(I('get.id')){
            $notice = M('notice') -> where('no_id='.I('get.id')) -> find();
            $this -> assign('notice',$notice);
        }
        $this -> display();
    }

    // 操作 新增 -> end in 2016/02/26
    public function operat_add(){
        if(IS_AJAX){
            if(I('post.no_type')&&I('post.no_title')&&I('post.no_content')){
                $add['no_type']    = I('post.no_type');
                $add['no_title']   = I('post.no_title');
                $add['no_content'] = $_POST['no_content'];
                $session = session('admin.auth');
                $add['no_user']    = $session['ad_id'];
                $add['no_time']    = time();
                $add['no_ip']      = get_client_ip();
                $add['no_os']      = get_client_os();
                if(($add['no_type']==3))
                {
                    if(I('post.no_to_article'))$add['no_to_article'] = I('post.no_to_article');
                    $add['no_cover_img'] = get_string_img($add['no_content']);
                    if(!$add['no_cover_img'])$state=3;
                }
            }
            else $state=2;
            if($state)$this -> ajaxReturn($state);
            else
            {
                if(M('notice')->add($add))$state=0;
                else $state=1;
                $this -> ajaxReturn($state);
            }
        }
        else $this -> error('你的操作有错误！');
    }

    // 操作 保存 -> end in 2016/02/27
    public function operat_save(){
        if(IS_AJAX&&I('post.no_id')){
            $notice = M('notice') -> where('no_id='.I('post.no_id')) -> find();
            if($notice){
                if($notice['no_type']!=I('post.no_type'))$save['no_type'] = I('post.no_type');
                if($notice['no_title']!=I('post.no_title'))$save['no_title'] = I('post.no_title');
                if($notice['no_content']!=I('post.no_content'))$save['no_content'] = $_POST['no_content'];
                if($save)
                {
                    if(I('post.no_type')==3)
                    {
                        if($notice['no_to_article']!=I('post.no_to_article'))$save['no_to_article'] = I('post.no_to_article');
                        if($notice['no_content'])$save['no_cover_img'] = get_string_img($save['no_content']);

                        if(!$save['no_cover_img'])$state=4;
                    }
                }
                else $state=3;
                if($save['no_type']){
                    $session = session('admin.notice');
                    $session['no_type'] = $save['no_type'];
                    session('admin.notice',$session);
                }
            }
            else $state=2;
            if($state)$this -> ajaxReturn($state);
            else
            {
                if(M('notice') -> where('no_id='.I('post.no_id')) ->save($save))$state=0;
                else $state=1;
                $this -> ajaxReturn($state);
            }
        }
        else $this -> error('你的操作有错误！');
    }

    // 操作 删除 -> end in 2016/02/27
    public function operat_delete(){
        if(IS_AJAX){
            if(I('get.id'))$where['no_id'] = I('get.id');
            else $state = 1;
            if($state)$this -> ajaxReturn($state);
            else
            {
                M('notice')->where($where)->delete();
                $state = 0;
                $this -> ajaxReturn($state);
            }
        }
        else $this -> error('你的操作有错误！');
    }
    

}