<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class MoodController extends CommonController {

    // 文章页 end in 2016/03/13
    public function index(){
        $sum  = M('notice') -> where('no_type=1') -> count();
        $page = new \Org\Powerone\Page($sum,9,0,true);
        $button = $page->show();
        if(($page->pages)>1){
            $this -> assign('button',$button);
            $this -> assign('pages',$page->pages);
        }
        // 文章信息
        $data  = M('notice') -> where('no_type=1') -> order('no_time desc') -> limit($page->limit,$page->single) -> select();
        $place = new \Org\Util\IP();
        $mood  = change_mood($data,$place);
        $this -> assign('mood',$mood);
        $this -> display();
    }
}