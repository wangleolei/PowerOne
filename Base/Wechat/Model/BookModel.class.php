<?php
namespace Wechat\Model;
use Think\Model;

//class BookModel extends Model{
class BookModel{
	public function receiveEvent($object)
    {
        switch ($object->Event)
        {
            case "subscribe":
                $content = "欢迎关注MF ERROR查询系统，Error code还在继续收录中，该系统使用说明请参照http://powerone.cn/po/lookblog/52 ";
                break;
            case "scancode_waitmsg";
                $content = "Key2:".$object->EventKey."<br>ScanResult:".$object->ScanCodeInfo->ScanResult."   ScanType:".$object->ScanCodeInfo->ScanType;
                break;
            case "scancode_push";
                $content = "Key:".$object->EventKey."<br>ScanResult:".$object->ScanCodeInfo->ScanResult;
                break;
        }
        //$result = $this->transmitText($object, $content);
        return $content;
    }

    public function receiveText($object)
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
            default:
                $content = "Your error code is not valid or not collected in system! 试试别的吧。";
                
        }
        return $content;
    }

}