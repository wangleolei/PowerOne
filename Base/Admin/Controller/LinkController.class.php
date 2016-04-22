<?php
namespace Admin\Controller;

use Common\Controller\AuthController;

class LinkController extends AuthController {

    // 链接主页 -> end in 2016/02/26
    public function index(){
        if(IS_AJAX)session('admin.link',null);
        else
        {
            $session = session('admin.link');
            if($session['li_state'])$on_state = $session['li_state'];
            $this -> assign('on_state',$on_state);
            $this -> display();
        }
    }

    // 链接列表 -> end in 2016/02/26
    public function link_list(){
        if (IS_AJAX){
            $session = session('admin.link');
            if(I('get.state'))$session['li_state'] = $where['li_state'] = I('get.state');
            elseif($session['li_state'])$where['li_state'] = $session['li_state'];
            else $session['li_state'] = $where['li_state'] = 1;
            session('admin.link',$session);
            unset($session);
            $link = M('link') -> where($where) -> select();
            $this->assign('link',$link);
            $this->assign('on_state',$where['li_state']);
            unset($where);
            unset($link);
            $this -> display();
        }
        else $this -> error('你的操作有错误！');
    }

    // 新增链接 -> end in 2016/02/26
    public function link_add(){
        if (IS_AJAX) {
            if(I('post.li_title')&&I('post.li_url')&&I('post.li_email')){
                $add['li_state'] = 1;
                $add['li_url']   = I('post.li_url');
                $add['li_title'] = I('post.li_title');
                $add['li_email'] = I('post.li_email');
                $add['li_mode']  = 2;
                $add['li_time']  = time();
                $session         = session('admin.auth');
                $add['li_admin'] = $session['ad_id'];
                unset($session);
            }
            else $state=2;
            if($state)$this -> ajaxReturn($state);
            else
            {
                if(M('link')->add($add))$state=0;
                else $state=1;
                $this -> ajaxReturn($state);
            }
        }
        else $this -> error('你的操作有错误！');
    }

    // 删除链接 -> end in 2016/02/26
    public function link_delete(){
        if (IS_AJAX) {
            if(I('get.id'))$where['li_id'] = I('get.id');
            else $state = 1;
            if($state)$this -> ajaxReturn($state);
            else
            {
                M('link')->where($where)->delete();
                $state = 0;
                $this -> ajaxReturn($state);
            }
        }
        else $this -> error('你的操作有错误！');
    }

    // 拒绝链接 -> end in 2016/02/26
    public function link_refuse(){
        if (IS_AJAX) {
            if(I('get.id'))$where['li_id'] = I('get.id');
            else $state = 1;
            if($state)$this -> ajaxReturn($state);
            else
            {
                $save['li_state'] = 3;
                M('link')->where($where)->save($save);
                $state = 0;
                $this -> ajaxReturn($state);
            }
        }
        else $this -> error('你的操作有错误！');
    }

    // 保存链接 -> end in 2016/02/26
    public function link_save(){
        if(IS_AJAX){
            if(I('post.li_id')){
                if(I('post.li_title')&&I('post.li_url')&&I('post.li_email')){
                    $save['li_url']   = I('post.li_url');
                    $save['li_title'] = I('post.li_title');
                    $save['li_email'] = I('post.li_email');
                    $save['li_state'] = 1;
                }
                else $state=2;
            }
            else $state=3;
            if($state)$this -> ajaxReturn($state);
            else
            {
                if(M('link') -> where('li_id='.I('post.li_id')) ->save($save))$state=0;
                else $state=1;
                $this -> ajaxReturn($state);
            }
        }
        else $this -> error('你的操作有错误！');
    }

}