<?php
namespace Wechat\Logic;
use Think\Model;

class TestingLogic{

	public function receiveEvent($object)
    {
        switch ($object->Event)
        {
            case "subscribe":
                $content = "欢迎关注MF ERROR查询系统，Error code还在继续收录中，该系统使用说明请参照http://powerone.cn/po/lookblog/52 ";
                break;
            case "scancode_waitmsg":
                switch ($object->EventKey) {
                    case 'rselfmenu_0_0':
                        $scan_result = trim($object->ScanCodeInfo->ScanResult);
                        $lib = D('Library');
                        $temp = $lib->addbook($scan_result);
                        //$temp = $lib->addbook('http://weixin.qq.com/r/AkgYAKvE8-aMre9j9');
                        $content = $temp;
                        break;
                    default:
                        $content = "测试失败";
                }
//                $content = "Key2:".$object->EventKey."<br>ScanResult:".$object->ScanCodeInfo->ScanResult."   ScanType:".$object->ScanCodeInfo->ScanType;
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
                $content[0]['Title'] = "测试图文0";
                $content[0]['Description'] = "this is testing news 0";
                $content[0]['PicUrl'] = 'http://www.powerone.cn/powerone/Public/img/wechat.jpg';
                $content[0]['Url'] = 'http://www.powerone.cn';
                break;
            case "#":
                $content[0]['Title'] = "测试图文0";
                $content[0]['Description'] = "this is testing news 0";
                $content[0]['PicUrl'] = 'http://www.powerone.cn/powerone/Public/img/wechat.jpg';
                $content[0]['Url'] = 'http://www.powerone.cn';
                $content[1]['Title'] = "测试图文1";
                $content[1]['Description'] = "this is testing news 1";
                $content[1]['PicUrl'] = 'http://www.powerone.cn/upload/image/blog/1456665617852447.png';
                $content[1]['Url'] = 'http://www.powerone.cn/powerone/article/6.html';
                break;
            case "!":
                $lib = D('Library');
                $temp = $lib->addbook($keyword);
                $content = $temp;
                break;
            default:
                $content = "输入@或者#号查看返回图文的例子";
                
        }
        return $content;
    }

}