<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class ArticlesController extends CommonController {

    // 文章页 end in 2016/03/13
    public function index(){
        $Articleclass = D('Common/Articleclass');
        if(I('get.class'))
        {
            //位置和目录
            $Articleclass = D('Common/Articleclass');
            $current_path = $Articleclass->getpath(I('get.class'));
            $this -> assign('current_path', $current_path);
            //得到class list
            //$where['ar_class'] = I('get.class');
            //$classlist1 = array(I('get.class'));
            //$classlist2 = $this->getsubclass(I('get.class'));
            //$classlist3 = $this->array_column($classlist2, 'ar_class');
            
            $classlist4 = $Articleclass->getsubclass(I('get.class'));

            //$classlist4 = array_merge($classlist1,$classlist3);

//            var_dump($classlist4);
            $where['ar_class'] = array('in', $classlist4);  
        }
        $where['ar_state'] = 1;
        // 数据分页 
        $articletb = D('Common/Article');
        //$sum  = M('article') -> where($where) -> count();
        $sum = $articletb->countarticle($where);
        $page = new \Org\Powerone\Page($sum,10,0,true);
        $button = $page->show();
        if(($page->pages)>1){
            $this -> assign('button',$button);
            $this -> assign('pages',$page->pages);
        }
        // 文章信息
        //$article = M('article') -> where($where) -> order('ar_time desc') -> limit($page->limit,$page->single) -> select();
        $article = $articletb->articlelist($where,$page->limit,$page->single);
        $this -> assign('article',$article);
        // 文章类别
        //if($where['ar_class'])$class['on'] = $where['ar_class'];
        if(I('get.class'))$class['on'] = I('get.class');
        else $class['on'] = 0;
        //$Articleclass = D('Common/Articleclass');
        $class['data'] = $Articleclass->getclasstree(I('get.class'));
        //$class['data'] = M('Articleclass') -> select();
        $this -> assign('class',$class);

        //display
        $this -> display();
    }


}