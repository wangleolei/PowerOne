<?php
namespace Wechat\Controller;
use Think\Controller;
use Think\Model;

class IndexController extends Controller {
	    	   //-------配置
	private	$AppID = 'wx23fd7c74957292e0';
	private	$AppSecret = 'd4624c36b6795d1d99dcf0547af5443d';
	private	$callback  =  'http://www.powerone.cn/wechat/index/feedback/'; //回调地址
    public function index(){


		$this->display();			 					// 输出模型
    }
    public function setup(){


		//微信登录
		session_start();
		//-------生成唯一随机串防CSRF攻击
		$state  = md5(uniqid(rand(), TRUE));
		$_SESSION["wx_state"]    =   $state; //存到SESSION
		$callback = urlencode($this->callback);
		$wxurl = "https://open.weixin.qq.com/connect/qrconnect?appid=".$this->AppID."&redirect_uri={$callback}&response_type=code&scope=snsapi_login&state={$state}#wechat_redirect";
		header("Location: $wxurl");
    }
 
    public function feedback(){
		//回调地址：
		if($_GET['state']!=$_SESSION["wx_state"]){
      		exit("5001");
		}		
		$AppID = 'wx33333333334d4';
		$AppSecret = 'd4624c363333330547af5443d';
		$url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$AppID.'&secret='.$AppSecret.'&code='.$_GET['code'].'&grant_type=authorization_code';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
		$json =  curl_exec($ch);
		curl_close($ch);

		$arr=json_decode($json,1);

		//得到 access_token 与 openid
		print_r($arr);    

		$url='https://api.weixin.qq.com/sns/userinfo?access_token='.$arr['access_token'].'&openid='.$arr['openid'].'&lang=zh_CN';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
		$json =  curl_exec($ch);
		curl_close($ch);
		$arr=json_decode($json,1);
		//得到 用户资料
		print_r($arr);    


    }




}