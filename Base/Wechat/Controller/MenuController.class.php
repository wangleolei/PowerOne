<?php
namespace Wechat\Controller;
use Think\Controller;
class MenuController extends Controller {
    public function index(){
    	$this->display();
    }
    	/****************推送Menu到微信平台*****************/
	public function create() {
		$appid = I('post.appid'); 
		$appsecret = I('post.appsecret');
		$menu_content = I('post.menu_content');

		//$data ='{"button":[{"name":"关于我们","sub_button":[{"type":"click","name":"公司简介","key":"公司简介"},{"type":"click","name":"社会责任","key":"社会责任"},{"type":"click","name":"联系我们","key":"联系我们"}]},{"name":"产品服务","sub_button":[{"type":"click","name":"微信平台","key":"微信平台"},{"type":"click","name":"微博应用","key":"微博应用"},{"type":"click","name":"手机网站","key":"手机网站"}]},{"name":"技术支持","sub_button":[{"type":"click","name":"文档下载","key":"文档下载"},{"type":"click","name":"技术社区","key":"技术社区"},{"type":"click","name":"服务热线","key":"服务热线"}]}]}';
		$data = html_entity_decode($menu_content);

		echo  $data;
		//$weixin = new \Think\Weixin_adv("wx23fd7c74957292e0", "d4624c36b6795d1d99dcf0547af5443d");
		//$weixin = new \Think\Weixin_adv($appid, $appsecret);
        $weixin = new \Common\Logic\WechatadvLogic($appid, $appsecret);    //
        //$weixin = D('Common/Wechatadv','Logic');
        //$weixin->initialize($appid, $appsecret);
		$res = $weixin->create_menu($data);
		var_dump($res);
//		if ($res['errcode'] == 0) {
//			$this -> success('操作成功！', 'index',5);
//		}else{
//			$this -> error('操作失败：'.$res['errorcode']);
//		}

	}
}