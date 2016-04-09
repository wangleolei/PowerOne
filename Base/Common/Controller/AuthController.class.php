<?php
namespace Common\Controller;

use Think\Controller;

class AuthController extends Controller{
    // 页面基础信息获取及验证 -> end in 2016/03/01
    protected function _initialize(){
        if(session("admin.auth"))$session = session("admin.auth");
        elseif(session("admin.login")){
            // 获取登陆用户信息，用作登陆凭证
            $session             = session("admin.login");
            $session["on_time"]  = date("Y/m/d H:i");
            $session["on_ip"]    = get_client_ip();
            $session["on_os"]    = get_client_os();
            $place = new \Org\Util\IP();
            $session["on_place"] = ip_to_place($session["on_ip"],$place);
            session("admin.auth",$session);
            session("admin.login",null);
            update_login($session["ad_id"]);
        }
        if($session){
            // 这里还有权限管理，后续添加
            $this -> assign("auth",$session);
        }
        else $this -> error("非法访问，正在前往登陆页面！",U("login/index"));
    }
}