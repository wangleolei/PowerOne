<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class IndexController extends CommonController {

    // 文章页 end in 2016/03/14
    public function index(){
        // 最新的 3 个轮播图
        $notice = D('Common/notice');
        $slide = $notice->noticelist(3,0,3);
        $this -> assign('slide',$slide);
        // 8篇最新技术分享的文章
        $Articleclass = D('Common/Articleclass');
        $where1 = $Articleclass->getclasstreecondition(1);  
        $article = D('Common/article');
        $data1 = $article->articlelist($where1,0,8);
        $this -> assign('article1',$data1);
        // 8篇最新作品分享的文章
        $where2 = $Articleclass->getclasstreecondition(2);  
        $data2 = $article->articlelist($where2,0,8);
        $this -> assign('article2',$data2);
        // 文章信息
        $data = $notice->noticelist(1,$page->limit,$page->single);
        $place = new \Org\Util\IP();
        $mood  = change_mood($data,$place);
        $this -> assign('mood',$mood);
        
        //$this -> display();
        //$this->theme('')->display('');
        $this->theme()->display();
    }
        
}