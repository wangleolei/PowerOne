<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class ArticlesController extends CommonController {

    // 文章页 end in 2016/03/13
    public function index(){
        if(I('get.class'))$where['ar_class'] = I('get.class');
        $where['ar_state'] = 1;
        // 数据分页
        $sum  = M('article') -> where($where) -> count();
        $page = new \Org\Powerone\Page($sum,10,0,true);
        $button = $page->show();
        if(($page->pages)>1){
            $this -> assign('button',$button);
            $this -> assign('pages',$page->pages);
        }
        // 文章信息
        $article = M('article') -> where($where) -> order('ar_time desc') -> limit($page->limit,$page->single) -> select();
        $this -> assign('article',$article);
        // 文章类别
        if($where['ar_class'])$class['on'] = $where['ar_class'];
        else $class['on'] = 0;
        $class['data'] = M('article_class') -> select();
        $this -> assign('class',$class);
        $this -> display();
    }
}