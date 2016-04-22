<?php
namespace Home\Controller;

use Think\Controller;

class ToolController extends Controller {

    // QQ登录
    public function login(){
        $Qlogin = new \Org\Toilove\Qlogin(C('QQ_APP_ID'),C('QQ_APP_KEY'),C('QQ_APP_URL'));
        $Qlogin -> get_code();
    }

    // 退出登陆
    public function exitqq(){
        if(IS_AJAX){
            session('home.user',null);
            if(session('home.user'))$state = 1;
            else $state = 0;
            $this -> ajaxReturn($state);
        }
        else $this -> error('你的操作有错误！');
    }

}