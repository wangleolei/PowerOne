<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class ArticleController extends CommonController {

    // 文章页 end in 2016/03/14
    public function index(){
        if(I('get.id')){
            $where['ar_id']    = I('get.id');
            $where['ar_state'] = 1;
            $article = M('article') -> where($where) -> find();
            if($article){
                if(!I('get.page'))M('article') -> where($where) -> setInc('ar_hits');
                $body = M('Articledata') -> where('ar_id='.$article['ar_id']) -> getField('ar_body');
                $page = new \Org\Powerone\Page($body,'_ueditor_page_break_tag_',1,true);
                $button = $page->show();
                if(($page->pages)>1){
                    $this -> assign('button',$button);
                    $this -> assign('pages',$page->pages);
                }
                $article['ar_body'] = $page->contents[$page->now-1];
                // 上一条记录与下一条记录
                $article['previous'] = M('article') -> where('ar_state=1 and ar_time<'.$article['ar_time']) -> order('ar_time desc') -> limit(1) -> getField('ar_id');
                $article['next']     = M('article') -> where('ar_state=1 and ar_time>'.$article['ar_time']) -> order('ar_time asc')  -> limit(1) -> getField('ar_id');
                $this -> assign('article',$article);
                //位置和目录
                $Articleclass = D('Common/Articleclass');
                $current_path = $Articleclass->getpath($article['ar_class']);
                $this -> assign('current_path', $current_path);
                //show screen
                $this -> display();
            }
            else $this -> error('文章不存在！');
        }
        else $this -> error('文章不存在！');
    }
    
}