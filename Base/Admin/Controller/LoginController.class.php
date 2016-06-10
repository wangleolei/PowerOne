<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller {
    
    // 首页 -> end in 2016/02/05
    public function index() {
        if(session('admin.auth'))$this -> success('欢迎回来！',U('index/index'));
        else 
            $this -> display();
//            $this->theme('templete2')->display();
    }

    // 登陆 -> end in 2016/03/01
    public function login(){
        if(IS_AJAX)
        {
            $where['ad_username'] = I('post.username');
            $admin = M('useradmin') -> where($where) -> find();
            if($admin){
                if($admin['ad_state']=='1'){
                    $password = md5(I('post.password'));
 //                   $password = I('post.password');
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

    // 重置密码 
    public function forget(){
        if(IS_AJAX)
        {
            $captcha = I('post.captcha_forget');
            if(empty($captcha) || !verify($captcha)) {
                $state = 4;
                $this -> ajaxReturn($state);
                return;    
            }
            $email = I('post.email_input');
            $admin = D('Common/Useradmin');
            $result = $admin->findbyemail($email);
            if (!$result) {
                $state = 1;
                $this -> ajaxReturn($state);
                return; 
            }

            $newpassword = randomkeys(6);
            $upd_result = $admin->updatepassword($result['ad_id'], $newpassword);
            if (!$upd_result) {
                $state = 2;
                $this -> ajaxReturn($state);
                return; 
            }

            $title      = '密码重置（系统邮件，请勿回复）';
            $username   = $result['ad_username'];
            $password   = $newpassword;

            $fulltext   = '账号：'.$username.'<br/>密码：'.$password.'<br/><br/>'.
                        '请尽快登陆系统，并修改密码！';
            $send_result = send_mail($email,$title,$fulltext);
            if (!$send_result) {
                $state = 3;
                $this -> ajaxReturn($state);
                return; 
            }
            $state = 0;
            $this -> ajaxReturn($state);
            return;
        }
    }
//结束
}