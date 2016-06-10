<?php
namespace Admin\Controller;

use Common\Controller\AuthController;

class MyprofileController extends AuthController {

    // 用户主页 -> end in 2016/02/27
    public function index(){
        if(IS_AJAX)session('admin.user',null);
        else
        {
            $this -> display();
        }
    }

    // 用户列表 -> end in 2016/02/27
    public function upd_password(){
        if(IS_AJAX){
            $Admin              = session("admin.auth");
            $old_password       = md5(I('post.old_password'));
            $new_password1      = I('post.new_password1');
            $new_password2      = I('post.new_password2');
            if($new_password1  != $new_password2) {
                $state = 4;
                $this -> ajaxReturn($state);
                return;
            }
            if($old_password != $Admin['ad_password']) {
                $state = 3;
                $this -> ajaxReturn($state);
                return;    
            }
            $admin_table = D('Common/Useradmin');
            $upd_result = $admin_table->updatepassword($Admin['ad_id'], $new_password1);
            if ($upd_result) {
                $Admin['ad_password'] = md5($new_password1);
                session("admin.auth",$Admin);
                $state = 0;
                $this -> ajaxReturn($state);
            }else{
                $state = 2;
                $this -> ajaxReturn($state);
            }
        }
        else
        {
            $this -> display();
        }
    }
    

}