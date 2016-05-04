<?php
namespace Wechat\Controller;
use Think\Controller;
class ViewmenuController extends Controller {
    public function index(){
    	$this->display();
    }
    	/****************查看推送Menu到微信平台*****************/
	public function retreive_menu() {
		$appid = I('post.appid'); 
		$appsecret = I('post.appsecret');
		$menu_content = I('post.menu_content');
		$weixin = new \Think\Weixin_adv($appid, $appsecret);
		$res = $weixin->get_menu($data);
		$menu_content = $res;
		$this -> assign('menu_content',$menu_content);  
        $this -> display('index');

	}
}