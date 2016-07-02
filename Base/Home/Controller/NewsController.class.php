<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class NewsController extends CommonController {

    // 文章页 end in 2016/03/13
    public function index(){
        $notice = D('Notice');
        $sum = $notice->notice_count(1);

//        $sum  = M('notice') -> where('no_type=1') -> count();
        $cvt = D('Common/Codedvalue');
        $cvt1102 = $cvt->findbyext(58,1102,'number');
        if (!$cvt1102['int_value']) {
            !$cvt1102['int_value'] = 9;
        }
        $page = new \Org\Powerone\Page($sum,$cvt1102['int_value'],0,true);
        $button = $page->show();
        if(($page->pages)>1){
            $this -> assign('button',$button);
            $this -> assign('pages',$page->pages);
        }
        // 文章信息
//        $data  = M('notice') -> where('no_type=1 and control_code=98') -> order('no_time desc') -> limit($page->limit,$page->single) -> select();
        $data = $notice->noticelist(1,$page->limit,$page->single);
        $place = new \Org\Util\IP();
        $news  = change_news($data,$place);
        $this -> assign('news',$news);
        $this -> display();
    }

// 文章页 details
    public function details(){
        $no_id = I('get.id');
        $notice = D('Notice');
        $news = $notice->get_details($no_id);
        $this -> assign('news',$news);
        $this -> display();
    }
}