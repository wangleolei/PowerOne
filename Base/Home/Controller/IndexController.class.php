<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class IndexController extends CommonController {

    // 首页
    public function index(){
        $notice = D('Common/notice');
        $Articleclass = D('Common/Articleclass');
        $article = D('Common/article');
        $cvt = D('Common/Codedvalue');
        // 最新的 3 个轮播图

        //$slide = $notice->noticelist(3,0,3);
        //$this -> assign('slide',$slide);
        //主页控制逻辑
        $cvt1100 = $cvt->getbyindex(58,1100);
        $numbers = count($cvt1100);
        foreach ($cvt1100 as $key => $value) {
            $class_or_type = $value['int_value'];
            $function_name    = $value['ext_value'];
            $number_record = $value['oth_value'];
            $display_name  = $value['short_desc']; 
            switch ($function_name) {
                case 'nolist':
                    $result = $notice->noticelist($class_or_type,0,$number_record);
                    $this -> assign($display_name,$result);
                    break;
                
                case 'notice':
                    $result = $notice->findbytype($class_or_type);
                    $this -> assign($display_name,$result);
                    break;
                case 'article':
                    $classlist = $Articleclass->getsubclass($class_or_type);  
                    $where['ar_class'] = array('in', $classlist);
                    $where['ar_state'] = 1;
                    $result = $article->articlelist($where,0,8);
                    $this -> assign($display_name,$result);
                    break;
                case 'classes':
                    $result['data'] = $Articleclass->getsubclasstree($class_or_type);
                    $this -> assign($display_name,$result);
                    break;
            }
        }
        $current_title = "公司名字";
        $this -> assign('current_title',$current_title);
        // 8篇最新技术分享的文章
        //$Articleclass = D('Common/Articleclass');
        //$where1 = $Articleclass->getclasstreecondition(1);  
        //$article = D('Common/article');
        //$data1 = $article->articlelist($where1,0,8);
        //$this -> assign('article1',$data1);
        // 8篇最新作品分享的文章
        //$where2 = $Articleclass->getclasstreecondition(2);  
        //$data2 = $article->articlelist($where2,0,8);
        //$this -> assign('article2',$data2);
        // 文章信息
        //$data = $notice->noticelist(1,$page->limit,$page->single);
        //$place = new \Org\Util\IP();
        //$news  = change_news($data,$place);
        //$this -> assign('news',$news);
        
        $this -> display();
    }
        
}