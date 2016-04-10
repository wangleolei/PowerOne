<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class IndexController extends CommonController {

    // 文章页 end in 2016/03/14
    public function index(){
        // 最新的 3 个轮播图
        $slide = M('notice') -> where('no_type=3') -> order('no_time desc') -> select();
        $this -> assign('slide',$slide);
        // 5篇最新更新的文章
        $data = M('article') -> where('ar_state=1') -> order('ar_time desc') -> limit(8) -> select();
        $this -> assign('article',$data);
        // 文章信息
        $data  = M('notice') -> where('no_type=1') -> order('no_time desc') -> limit($page->limit,$page->single) -> select();
        $place = new \Org\Util\IP();
        $mood  = change_mood($data,$place);
        $this -> assign('mood',$mood);
        
        $this -> display();
    }

}