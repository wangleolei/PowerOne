<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller {
    
    // 首页 -> end in 2016/02/05
    public function index() {
        if(session('admin.auth'))$this -> success('欢迎回来！',U('index/index'));
        else $this -> display();
    }

    // 登陆 -> end in 2016/03/01
    public function login(){
        if(IS_AJAX)
        {
            $where['ad_username'] = I('post.username');
            $admin = M('user_admin') -> where($where) -> find();
            if($admin){
                if($admin['ad_state']=='1'){
 //                   $password = md5(I('post.password'));
                    $password = I('post.password');
                    if($admin['ad_password'] == $password){
                        $captcha = I('post.captcha');
                        if(verify($captcha)){
                            session('admin.login',$admin);
                            $state = 0;
                        }
                        else $state = 4;
                    }
                    else $state = 3;
                }
                else $state = 2;
            }
            else $state = 1;
            $this -> ajaxReturn($state);
        }
        else $this -> error('你的操作有错误！');
    }

    // 验证码 -> end in 2016/02/15
    public function verify(){
        verify();
    }

    // 退出登陆 -> end in 2016/02/05
    public function exit_login(){
        if(IS_AJAX){
            session('admin',null);
            if(session('admin'))$data['state'] = 1;
            else $data['state'] = 0;
            $this -> ajaxReturn($data);
        }
        else $this -> error('你的操作有错误！');
    }


}