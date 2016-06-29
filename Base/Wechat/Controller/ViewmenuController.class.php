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
		//$weixin = new \Think\Weixin_adv($appid, $appsecret);
		$weixin = new \Common\Logic\WechatadvLogic($appid, $appsecret);  
		$res = $weixin->get_menu($data);
//		var_dump($weixin->get_groups());
//		$media3 = $weixin->upload_media("thumb","1462168421124465.jpg");
//		var_dump("@".dirname(__FILE__).'\\'.'1462168421124465.jpg');

//        echo dirname(__FILE__).'/1462168421124465.jpg';
/*		$uploadpic = $weixin->upload_media("thumb",dirname(__FILE__).'\1462168421124465.jpg');
		echo $uploadpic['thumb_media_id']. "          " ;
//		$news[] = array("thumb_media_id"=>$thumb_media_id3, 

		$news[] = array("thumb_media_id"=>$uploadpic['thumb_media_id'], 
                "author"=>"方倍工作室",
                "title"=>"微信公众平台开发最佳实践",
                "content_source_url" =>"http://m.cnblogs.com/?u=txw1958",
                "content" =>"<p>本书共分10章，案例程序采用广泛流行的PHP、MySQL、XML、CSS、JavaScript、HTML5等程序语言及数据库实现。系统完整地介绍微信公众平台基础接口、自定义菜单、高级接口、微信支付、分享转发等所有相关技术，以生活类、娱乐类、企业类微信开发为切入点，讲解了30多个功能或应用案例。<br>本书按照从简单到复杂，从基础到实践的方式编排，在讲解过程中注重将原理和实践相结合。初学者可以在了解PHP和MySQL语法之后，从头至尾学习，对于其中难以理解的部分可以查阅相关资料，针对企业功能类的开发还需要具有一定的JavaScript、CSS、HTML等编程基础。<br>本书可以作为微信公众平台开发的教程。对于移动互联网及微信公众平台的相关从业人员，本书也具有极大的参考价值。</p>",
                "digest" =>"微信公众平台开发含金量最高的书籍"
                );

 $mpnews = $weixin->upload_news($news);
 var_dump($mpnews);
echo "    ".$mpnews['media_id']."                ";
 
 
		$groupid = 0;
        $type = 'mpnews';
        $data = $mpnews['media_id'];
		$sentres = $weixin->mass_send_group($groupid, $type, $data);
		var_dump($sentres);
*/
		$menu_content = $res;
		$this -> assign('menu_content',$menu_content);  
        $this -> display('index');

	}
}