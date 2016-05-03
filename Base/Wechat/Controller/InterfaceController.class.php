<?php
//This is the interface to handle messages from wechat.
namespace Wechat\Controller;
use Think\Controller;
use Think\Model;

class InterfaceController extends Controller {
    public function index(){
//测试例子。接口地址：http://www.powerone.cn/powerone/wechat/interface
    	$wechatObj = D('Common/Wechatapi','Logic'); //实例化WechaAPI  ，方法一
    	$wechatObj->settoken('weixin'); //token为weixin。
    	//$wechatObj = new \Common\Logic\WechatapiLogic("weixin");  //方法二

    	$wechatObj->load('Testing'); //加载集成的新功能
        //$res = $weixin->create_menu($data);


//        if (!isset($_GET['echostr'])) {
            $wechatObj->responseMsg();
//        }else{
//            $wechatObj->valid();
//        }

    }

//wanglei_leo的接口测试号   的接口地址 : http://www.powerone.cn/powerone/wechat/interface/testing
    public function testing(){
    	$wechatObj = D('Common/Wechatapi','Logic'); 
    	$wechatObj->settoken('weixin');
    	$wechatObj->load('Testing'); 
        $wechatObj->responseMsg();
    }

} 