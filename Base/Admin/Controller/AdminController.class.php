<?php
namespace Admin\Controller;

use Common\Controller\AuthController;

class AdminController extends AuthController {

    // 用户主页 -> end in 2016/02/27
    public function index(){

            $this -> display();
    }

    // 注册新的管理员
    public function register(){
        if (IS_AJAX){
            $control_code   = 58;
            $ad_state       = 1;
            $ad_group       = I('post.user_group_input');
            $ad_username    = I('post.user_name_input');
            $ad_password    = I('post.user_password_input1');
            $ad_email       = I('post.user_email_input');
            $ad_nickname    = I('post.user_nickname_input');
                              //user_realname_input
            //$ad_portrait =  I('post.');//头像
            //$ad_last_time = I('post.');
            //$ad_last_ip
            //$ad_last_os
            $admin_table = D('Common/Useradmin');
            $admin_table->set_control_code($control_code);
            $admin_table->set_ad_state    ($ad_state    );
            $admin_table->set_ad_group    ($ad_group    );
            $admin_table->set_ad_username ($ad_username );
            $admin_table->set_ad_password ($ad_password );
            $admin_table->set_ad_email    ($ad_email    );
            $admin_table->set_ad_nickname ($ad_nickname );
            //$admin_table->set_ad_portrait ($ad_portrait );
            //$admin_table->set_ad_last_time($ad_last_time);
            //$admin_table->set_ad_last_ip  ($ad_last_ip  );
            //$admin_table->set_ad_last_os  ($ad_last_os  );
            $result = $admin_table->insert();

            $this -> ajaxReturn(json_encode($result));
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