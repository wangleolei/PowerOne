<?php
//This is the interface to handle messages from wechat.
namespace Wechat\Controller;
use Think\Controller;
use Think\Model;

class InterfaceController extends Controller {
    public function index(){
    	$wechatObj = D('Common/Wechatapi','Logic'); //实例化UserLogic  ，方法一
    	$wechatObj->settoken('weixin');
    	//$wechatObj = new \Common\Logic\WechatapiLogic("weixin");  //方法二

    	$wechatObj->load('book');
        //$res = $weixin->create_menu($data);


//        if (!isset($_GET['echostr'])) {
            $wechatObj->responseMsg();
//        }else{
//            $wechatObj->valid();
//        }

    }

} 