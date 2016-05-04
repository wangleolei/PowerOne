<?php
namespace Common\Logic;
//use Think\Model;
/*

*/

//class WechatapiLogic extends Model
class WechatapiLogic
{
	var $token = "";
    var $module;


    //构造函数，获取Access Token
	public function __construct($token = NULL)
	{
        if($token){
            $this->token = $token;
            if (isset($_GET['echostr'])) {
                $this->valid();
            }
        }

	}
    //构造函数，获取Access Token方法
    public function settoken($token = NULL)
    {
        if($token){
            $this->token = $token;
            if (isset($_GET['echostr'])) {
                $this->valid();
            }
        }

    }

    //验证签名
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = $this->token;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if($tmpStr == $signature){
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $this->logger("R ".$postStr);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            $result = "";
            switch ($RX_TYPE)
            {
                case "event":
                    //$result = $this->receiveEvent($postObj);
                    $content = $this->module->receiveEvent($postObj);
                    //$result = $this->transmitText($postObj, $content);
                    if(is_array($content)){
                        $result = $this->transmitNews($postObj, $content );
                    }
                    else{
                        $result = $this->transmitText($postObj, $content);
                    }
                    break;
                case "text":
                    //$result = $this->receiveText($postObj);
                    $content = $this->module->receiveText($postObj);
                    if(is_array($content)){
                        $result = $this->transmitNews($postObj, $content );
                    }
                    else{
                        $result = $this->transmitText($postObj, $content);
                    }
                    
                    break;
            }
            $this->logger("T ".$result);
            echo $result;
        }else {
            echo "";
            exit;
        }
    }

    public function load($module)
    {
        $this->module = D('Wechat/'.$module, 'Logic'); 
//        $result->receiveEvent($object, $content);
//        return $result;
    }

    private function receiveEvent($object)
    {
        switch ($object->Event)
        {
            case "subscribe":
                $content = "欢迎关注MF ERROR查询系统，Error code还在继续收录中，该系统使用说明请参照http://powerone.cn/po/lookblog/52 ";
                break;
            case "scancode_waitmsg";
                $content = "Key:".$object->EventKey."<br>ScanResult:".$object->ScanCodeInfo->ScanResult."   ScanType:".$object->ScanCodeInfo->ScanType;
                break;
            case "scancode_push";
                $content = "Key:".$object->EventKey."<br>ScanResult:".$object->ScanCodeInfo->ScanResult;
                break;
        }
        $result = $this->transmitText($object, $content);
        return $result;
    }

    private function receiveText($object)
    {
        $keyword = trim($object->Content);
        switch (substr($keyword, 0,1))
        {
            case "@":
                $subkeyword = trim(substr($keyword, 1));
                $url = "http://apix.sinaapp.com/weather/?appkey=".$object->ToUserName."&city=".urlencode($subkeyword);
                $output = file_get_contents($url);
                $content = json_decode($output, true);
                $result = $this->transmitNews($object, $content);
                break;
            case "+":
                $postdata = trim(substr($keyword, 1));
                
                //$user = "admin"; 
                //$pass = "admin"; 
                //$curlPost = "user=$user&pass=$pass"; 
                $curlPost = $postdata; 
                $ch = curl_init(); 
                //初始化一个CURL对象 
                curl_setopt($ch, CURLOPT_URL, "http://leonardowong.gicp.net:55139/Minibank/WechatServlet"); 
                //curl_setopt($ch, CURLOPT_URL, "http://www.baidu.com"); 
                //设置你所需要抓取的URL 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                //设置curl参数，要求结果是否输出到屏幕上，为true的时候是不返回到网页中 假设上面的0换成1的话，那么接下来的$data就需要echo一下。 
                curl_setopt($ch, CURLOPT_POST, 1); 
                //post提交 
                curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost); 
                $data = curl_exec($ch); 
                //运行curl,请求网页。 
                curl_close($ch);

                $content = $data;

                //$content = "Your! 试试别的吧。";
                $result = $this->transmitText($object, $content);
                break;
            default:
                $error_code=$keyword;
                require_once('mycode/module/inq2.php');
                If ($Language == "DB2       " )
                    {$content = $Language. ": ". $Reason. "详情参见: http://powerone.cn/mycode/inq.php?l=". rtrim($Language)."&c=".$Error_code;}
                else 
                    {$content = $Language. ": ". $Description. "详情参见: http://powerone.cn/mycode/inq.php?l=". rtrim($Language)."&c=".$Error_code;}
                if ($Reason == "" && $Description == "")
                    {$content = "Your error code is not valid or not collected in system! 试试别的吧。";}
                $result = $this->transmitText($object, $content);
        }
        return $result;
    }

    private function transmitText($object, $content)
    {
        if (!isset($content) || empty($content)){
            return "";
        }
        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }

    private function transmitNews($object, $newsArray)
    {
        if(!is_array($newsArray)){
            return "";
        }
        $itemTpl = "    <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
    </item>
";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $newsTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<Content><![CDATA[]]></Content>
<ArticleCount>%s</ArticleCount>
<Articles>
$item_str</Articles>
</xml>";

        $result = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
    }

    private function logger($log_content)
    {
      
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
