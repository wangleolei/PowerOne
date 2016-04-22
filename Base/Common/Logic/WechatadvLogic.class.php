<?php
/*
// $media_id = "TV_MqltHoimikyKKXMAuYEpApCkckLsHPw2wh8Jkfzz8ZJcCBjBfNjmwuwSM5xiP";

// $news[] = array("thumb_media_id"=>$media_id,
                // "author"=>"方倍",
                // "title"=>"微信公众平台开发入门教程",
                // "content_source_url" =>"http://m.cnblogs.com/?u=txw1958",
                // "content" =>'在这篇微信公众平台开发教程中，我们假定你已经有了PHP语言程序、MySQL数据库、计算机网络通讯、及HTTP/XML/CSS/JS等基础。</p>
// <p>我们将使用微信公众账号方倍工作室作为讲解的例子，二维码见底部。',
                // "digest" =>"微信公众平台开发经典的入门教程，学习微信公众平台开发必备！"
                // );

// foreach ($news as &$item) {
    // foreach ($item as $k => $v) {
        // $item[$k] = urlencode($v);
    // }
// }

// $data = array("articles"=>$news);
// // $url = "https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=".$this->access_token;
// var_dump($data);
// var_dump(json_encode($data));
// var_dump(urldecode(json_encode($data)));
// var_dump(json_decode(json_encode($data)));
*/

//$weixin = new Weixin_adv("wx6292681b13329528", "3079cb22ad383ae7371d12aed1b2d0cc");
// var_dump($weixin->get_groups());
//$openid = "oLVPpjqs9BhvzwPj5A-vTYAX3GLc"; //txw1958 在近宝
//$openid2 = "oLVPpjr0hd2H_YzVRUOYNhlXN-xQ"; //fangbei2013 在近宝

//$groupid = 101;


// $media1 = $weixin->upload_media("thumb","banner1.jpg");
// $media2 = $weixin->upload_media("thumb","banner2.jpg");
// $media3 = $weixin->upload_media("thumb","banner3.jpg");
// // var_dump($media1);

// $thumb_media_id1 = $media1["thumb_media_id"];
// $thumb_media_id2 = $media2["thumb_media_id"];
// $thumb_media_id3 = $media3["thumb_media_id"];

// // var_dump($weixin->send_custom_message($openid, "text", "你好"));
/*
$news[] = array("thumb_media_id"=>$thumb_media_id1,
                "author"=>"",
                "title"=>"微信公众平台开发",
                "content_source_url" =>"",
                "content" =>"",
                "digest" =>""
                );

$news[] = array("thumb_media_id"=>$thumb_media_id2,
                "author"=>"方倍工作室",
                "title"=>"微信公众平台开发入门教程",
                "content_source_url" =>"http://m.cnblogs.com/99079/3153567.html?full=1",
                "content" =>"<div>
<p>本教程是微信公众平台的入门教程，它将引导你完成如下任务：</p>
<ol>
<li>1. 创建新浪云计算平台应用</li>
<li>2. 启用微信公众平台开发模式</li>
<li>3. 基础接口消息及事件</li>
<li>4. 微信公众平台PHP SDK</li>
<li>5. 微信公众平台开发模式原理</li>
<li>6. 开发天气预报功能</li>
</ol>
</div>",
                "digest" =>"微信公众平台开发经典的入门教程，学习微信公众平台开发必经之路！"
                );

$news[] = array("thumb_media_id"=>$thumb_media_id3,
                "author"=>"方倍工作室",
                "title"=>"微信公众平台开发最佳实践",
                "content_source_url" =>"http://m.cnblogs.com/?u=txw1958",
                "content" =>"<p>本书共分10章，案例程序采用广泛流行的PHP、MySQL、XML、CSS、JavaScript、HTML5等程序语言及数据库实现。系统完整地介绍微信公众平台基础接口、自定义菜单、高级接口、微信支付、分享转发等所有相关技术，以生活类、娱乐类、企业类微信开发为切入点，讲解了30多个功能或应用案例。<br>本书按照从简单到复杂，从基础到实践的方式编排，在讲解过程中注重将原理和实践相结合。初学者可以在了解PHP和MySQL语法之后，从头至尾学习，对于其中难以理解的部分可以查阅相关资料，针对企业功能类的开发还需要具有一定的JavaScript、CSS、HTML等编程基础。<br>本书可以作为微信公众平台开发的教程。对于移动互联网及微信公众平台的相关从业人员，本书也具有极大的参考价值。</p>",
                "digest" =>"微信公众平台开发含金量最高的书籍"
                );
*/
// $mpnews = $weixin->upload_news($news);
// var_dump($mpnews);

//$mpnewsid = "1ruAJpXuae7vTHhsUST1ik0yXxJXKkMtrUbDrAN13rQBUfvoD9MuWpoaI__XFfXL";
//var_dump($weixin->mass_send_group($groupid, "mpnews", $mpnewsid));

// $news_media_id = $mpnews["media_id"];

// var_dump($weixin->mass_send_group($groupid, $type, $data));

/*
// var_dump($weixin->mass_send_group($groupid, $type, $data));
// var_dump(urldecode(json_encode($data)));

// $openid = "oLVPpjkttuZTbwDwN7vjHNlqsmPs";
// // var_dump($weixin->get_user_list());
// $openid = "oLVPpjkttuZTbwDwN7vjHNlqsmPs";
// var_dump($weixin->get_user_info($openid));
// $data ='{"button":[{"name":"关于我们","sub_button":[{"type":"click","name":"公司简介","key":"公司简介"},{"type":"click","name":"社会责任","key":"社会责任"},{"type":"click","name":"联系我们","key":"联系我们"}]},{"name":"产品服务","sub_button":[{"type":"click","name":"微信平台","key":"微信平台"},{"type":"click","name":"微博应用","key":"微博应用"},{"type":"click","name":"手机网站","key":"手机网站"}]},{"name":"技术支持","sub_button":[{"type":"click","name":"文档下载","key":"文档下载"},{"type":"click","name":"技术社区","key":"技术社区"},{"type":"click","name":"服务热线","key":"服务热线"}]}]}';
// var_dump($weixin->create_menu($data));
// var_dump($weixin->create_qrcode("QR_SCENE", "134324234"));
// var_dump($weixin->create_group("老师"));
// var_dump($weixin->update_group($openid, "100"));
// var_dump($weixin->location_geocoder(22.539968,113.954980));
// var_dump($weixin->upload_media("image","pondbay.jpg"));
// var_dump($weixin->send_custom_message($openid, "text", "asdf"));
// {
    // "filter": {
        // "group_id": 100
    // },
    // "msgtype": "mpnews",
    // "mpnews": {
        // "media_id": "cJQavsNH0QrXKvrkStPYDyXM5nySCww0nTfdaNC2Mk7IVePiG_UWn0S7vb11KPuH"
    // }
// }
*/
/*
    方倍工作室
    CopyRight 2014 All Rights Reserved
*/
//namespace Think;
namespace Common\Logic;
use Think\Model;
class WechatadvLogic extends Model
{
	var $appid = "";
	var $appsecret = "";

    //构造函数，获取Access Token
	public function __construct($appid = NULL, $appsecret = NULL)
	{
        if($appid){
            $this->appid = $appid;
        }
        if($appsecret){
            $this->appsecret = $appsecret;
        }

        //HARDCODE
        $this->lasttime = 1398947018;
        $this->access_token = "WibGd13elnkAkdBAY3fwRoXexY4-aM96oKBqBHKpcB1OqoANYNMFDmjvBeRZynFF";

        if (time() > ($this->lasttime + 7200)){
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
            $res = $this->https_request($url);
            $result = json_decode($res, true);
            //save to Database or Memcache
            $this->access_token = $result["access_token"];
            $this->lasttime = time();

//            var_dump(time());
//            var_dump($this->access_token);
        }
	}

    //获取关注者列表
	public function get_user_list($next_openid = NULL)
    {
		$url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$this->access_token."&next_openid=".$next_openid;
        $res = $this->https_request($url);
        return json_decode($res, true);
	}

    //获取用户基本信息
	public function get_user_info($openid)
    {
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->access_token."&openid=".$openid."&lang=zh_CN";
		$res = $this->https_request($url);
        return json_decode($res, true);
	}

    //创建菜单
    public function create_menu($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

    //查询菜单
    public function get_menu()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$this->access_token;
        $res = $this->https_request($url);
        return $res;
    }


    //发送客服消息，已实现发送文本，其他类型可扩展
	public function send_custom_message($touser, $type, $data)
    {
        $msg = array('touser' =>$touser);
        switch($type)
        {
			case 'text':
				$msg['msgtype'] = 'text';
				$msg['text']    = array('content'=>urlencode($data));
				break;
        }
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$this->access_token;
		return $this->https_request($url, urldecode(json_encode($msg)));
	}

    //生成参数二维码
    public function create_qrcode($scene_type, $scene_id)
    {
        switch($scene_type)
        {
			case 'QR_LIMIT_SCENE': //永久
                $data = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": '.$scene_id.'}}}';
				break;
			case 'QR_SCENE':       //临时
                $data = '{"expire_seconds": 1800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": '.$scene_id.'}}}';
				break;
        }
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        $result = json_decode($res, true);
        return "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($result["ticket"]);
    }

    //创建分组
    public function create_group($name)
    {
        $data = '{"group": {"name": "'.$name.'"}}';
        $url = "https://api.weixin.qq.com/cgi-bin/groups/create?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

    //移动用户分组
    public function update_group($openid, $to_groupid)
    {
        $data = '{"openid":"'.$openid.'","to_groupid":'.$to_groupid.'}';
        $url = "https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

    //查询所有分组
    public function get_groups()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/groups/get?access_token=".$this->access_token;
        $res = $this->https_request($url);
        return json_decode($res, true);
    }

    //查询用户所在分组
    public function get_groupid($openid)
    {
        $data = '{"openid":"'.$openid.'"}';
        $url = "https://api.weixin.qq.com/cgi-bin/groups/getid?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

    //上传多媒体文件(除图文)
    public function upload_media($type, $file)
    {
        $data = array("media"  => "@".dirname(__FILE__).'\\'.$file);
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=".$this->access_token."&type=".$type;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

    //上传图文消息素材
    public function upload_news($news)
    {
        foreach ($news as &$item) {
            foreach ($item as $k => $v) {
                $item[$k] = urlencode($v);
            }
        }

        $data = array("articles"=>$news);
        $url = "https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=".$this->access_token;
        $res = $this->https_request($url, urldecode(json_encode($data)));
        return json_decode($res, true);
    }

    //高级群发(根据分组)
    public function mass_send_group($groupid, $type, $data)
    {
        $msg = array('filter' => array('group_id'=>$groupid));
        $msg['msgtype'] = $type;

        switch($type)
        {
			case 'text':
				$msg[$type] = array('content'=> $data);
				break;
            case 'image':
            case 'voice':
            case 'mpvideo':
            case 'mpnews':
                $msg[$type] = array('media_id'=> $data);
				break;

        }
		$url = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=".$this->access_token;
		$res = $this->https_request($url, json_encode($msg));
        return json_decode($res, true);
    }

    //地理位置逆解析
    public function location_geocoder($latitude, $longitude)
    {
        $url = "http://api.map.baidu.com/geocoder/v2/?ak=B944e1fce373e33ea4627f95f54f2ef9&location=".$latitude.",".$longitude."&coordtype=gcj02ll&output=json";
        $res = $this->https_request($url);
        $result = json_decode($res, true);
        return $result["result"]["addressComponent"];
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
