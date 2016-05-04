<?php
namespace Wechat\Controller;
use Think\Controller;
use Think\Model;

class AuthorizeController extends Controller {
    public function index(){
    	$code = I('get.code');
    	echo "Step 1 : retreive code successful <br>";
    	echo "Code:".$code."<br><br>";
    	$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx23fd7c74957292e0&secret=d4624c36b6795d1d99dcf0547af5443d&code=".$code."&grant_type=authorization_code";
        $res = $this->https_request($url);
        $result = json_decode($res, true);
        $access_token = $result['access_token'];
        $openid = $result['openid'];
        echo "Step 2 : get access_token successful <br>";
        echo "Access_token:".$access_token."<br>";
        echo "Openid:".$openid."<br><br>";
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        $res = $this->https_request($url);
        $result = json_decode($res, true);
        $nickname = $result['nickname'];
        $sex = $result['sex'];
        $city = $result['city'];
        echo "Step 3 : retreive customer information successful <br>";
        echo "Nickname:".$nickname."<br>";
        echo "Sex:".$sex."<br>";
        echo "City:".$city."<br>";

        $this -> success('Succssful!', 'http://www.citibank.com.cn',15);

    }

        //https请求（支持GET和POST）
    protected function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}