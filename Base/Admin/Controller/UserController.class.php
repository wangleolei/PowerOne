<?php
namespace Admin\Controller;

use Common\Controller\AuthController;

class UserController extends AuthController {

    // 用户主页 -> end in 2016/02/27
    public function index(){
        if(IS_AJAX)session('admin.user',null);
        else
        {
            $session = session('admin.user');
            if($session['us_type'])$on_type = $session['us_type'];
            else $on_type = 2;
            $this -> assign('on_type',$on_type);
            $this -> display();
        }
    }

    // 用户列表 -> end in 2016/02/27
    public function user_list(){
        if (IS_AJAX){
            $session = session('admin.user');
            // 当前页
            if(I('get.type')&&(I('get.type')!=$session['us_type']))$session['now_page'] = $now_page = 1;
            elseif(I('get.page'))$session['now_page'] = $now_page = I('get.page');
            elseif($session['now_page'])$now_page = $session['now_page'];
            else $session['now_page'] = $now_page = 1;
            // 当前类型
            if(I('get.type'))$session['us_type'] = I('get.type');
            elseif(!$session['us_type'])$session['us_type'] = 1;
            $this->assign('us_type',$session['us_type']);
            switch ($session['us_type']) {
                case 1: case 2:
                {
                    $table_name       = 'user';
                    $where['us_type'] = $session['us_type'];
                    break;
                }
                case 3: $table_name = 'useradmin';
            }
            session('admin.user',$session);
            if($session['us_type']!='1'){
                // 数据分页
                $sum  = M($table_name) -> where($where) -> count();
                $page = new \Org\Powerone\Page($sum,12);
                $page->ulcss = 'page-ul';
                $page->licss = 'page-on';
                $page->now   = $now_page;
                $button = $page->show();
                if(($page->pages)>1){
                    $this -> assign('button',$button);
                    $this -> assign('pages',$page->pages);
                }
                if($session['us_type']=='2')$order = 'us_last_time desc';
                //用户数据
                $user = M($table_name) -> where($where) -> order($order) -> limit($page->limit,$page->single) -> select();
                if($session['us_type']=='2'){
                    $place = new \Org\Util\IP();
                    for($i=0;$i<count($user);$i++){
                        $user[$i]['place'] = ip_to_place($user[$i]['us_last_ip'],$place);
                    }
                }
                $this->assign('user',$user);
                unset($where);
                unset($user);
            }
            unset($session);
            $this -> display();
        }
        else $this -> error('你的操作有错误！');
    }
    

}