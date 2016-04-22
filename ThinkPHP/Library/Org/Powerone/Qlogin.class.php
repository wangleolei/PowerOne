<?php
// +----------------------------------------------------------------------
// | Toilove个人博客 [ 让学习之路更轻松 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015 - now  http://toilove.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 伊始 <774694235@qq.com> <http://www.toilove.com>
// +----------------------------------------------------------------------
// | 更多 分享尽在 Toilove.com
// +----------------------------------------------------------------------

namespace Org\Powerone;

class Qlogin{

    // APP ID
    private $app_id;
    // APP KEY
    private $app_key;
    // 回调地址
    private $back_url;

    // 架构函数，输入信息
    public function __construct($id,$key,$url){
        $this->app_id   = $id;
        $this->app_key  = $key;
        $this->back_url = $url;
    }

    //获取信息
    public function get_info(){
        $code   = $_GET['code'];
        $token  = $this->get_token($code);
        $openid = $this->get_openid($token);
        $param['access_token']       = $token;
        $param['oauth_consumer_key'] = $this->app_id;
        $param['openid']             = $openid;
        $url   = "https://graph.qq.com/user/get_user_info";
        $param = http_build_query($param);
        $url   = $url."?".$param;
        $info  = $this->get_data($url);
        $array = json_decode($info,true);
        return $array;
    }

    // 第一步 登录，回调站点附带 $_GET['code'];
    public function get_code(){
        $url = "https://graph.qq.com/oauth2.0/authorize";
        $param['response_type'] = "code";
        $param['client_id']     = $this->app_id;
        $param['redirect_uri']  = $this->back_url;
        $param['scope']         = "get_user_info";
        $param = http_build_query($param);
        $url   = $url."?".$param;
        header("Location:".$url);
    }

    // 第二步 根据code获取用户token
    private function get_token($code){
        $param['grant_type']    = "authorization_code";
        $param['client_id']     = $this->app_id;
        $param['client_secret'] = $this->app_key;
        $param['redirect_uri']  = $this->back_url;
        $param['code']          = $code;
        $url    = "https://graph.qq.com/oauth2.0/token";
        $param  = http_build_query($param);
        $url    = $url."?".$param;
        $return = $this->get_data($url);
        parse_str($return,$data);
        return $data['access_token'];
    }

    // 第三步 根据用户token获取openid
    private function get_openid($token){
        $url      = "https://graph.qq.com/oauth2.0/me?access_token=".$token;
        $callback = $this->get_data($url);
        if(strpos($callback, "callback") !== false){
            $start = strpos($callback,"(");
            $stop  = strrpos($callback, ")");
            $json  = substr($callback,$start+1,$stop-$start-1);
            $array = json_decode($json,true);
            return $array['openid'];
        }
        else exit("错误代码：100007");
    }

    // 模拟会话 GET方式
    private function get_data($url){
        $ch = curl_init($url);
        // CURLOPT_RETURNTRANSFER > 如果成功只将结果返回，不自动输出任何内容，如果失败返回FALSE
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        // CURLOPT_TIMEOUT > 这个会话最多持续几秒
        curl_setopt($ch,CURLOPT_TIMEOUT,6);
        // 执行会话
        $data = curl_exec($ch);
        // 结束会话
        curl_close($ch);
        return $data;
    }

}