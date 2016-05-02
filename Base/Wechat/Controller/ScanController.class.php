<?php
namespace Wechat\Controller;
use Think\Controller;
use Think\Model;

class ScanController extends Controller {
    public function index(){
        $openid = "oSEl8wQo-rrkCVdvf5FXtf6I_8vM";
        //$weixin = new \Think\Weixin_adv($appid, $appsecret);
        $weixin = new \Think\Weixin_adv("wx23fd7c74957292e0", "d4624c36b6795d1d99dcf0547af5443d");
        $res = $weixin->create_menu($data);
        $weixin->send_custom_message($openid, "text", "Dear customer Leo, Your debit card will be expired, please double confirm your address. Your new card will be reissued and send to your legal address next monthy. Thanks !");



    }

 
}