<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class SearchController extends CommonController {

    // 文章页 end in 2016/03/14
    public function index(){
        if(I('get.search')){
            $this -> assign('search',I('get.search'));
            $where['ar_title'] = array('like','%'.I('get.search').'%');
            $where['ar_state'] = 1;
            // 数据分页
            $sum = M('article') -> where($where) -> count();
            if($sum){
                $page = new \Org\Powerone\Page($sum,10,0,true);
                $button = $page->show();
                if(($page->pages)>1){
                    $this -> assign('button',$button);
                    $this -> assign('pages',$page->pages);
                }
                $article = M('article') -> where($where) -> order('ar_time desc') -> limit($page->limit,$page->single) -> select();
                $this -> assign('article',$article);
            }
            $this -> display();
        }
        else $this -> error('错误！');
    }

}