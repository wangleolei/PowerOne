<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class ClassesController extends CommonController {

    // 文章页 end in 2016/03/13
    public function index(){
        $Articleclass = D('Common/Articleclass');
        if(I('get.class'))
        {
            $input_class = I('get.class'); 
            if(!is_numeric($input_class)) {
                $class['on'] = 0;
                E('加载失败'); return;
            }
            if(strlen($input_class) == 2){
                $class['on'] = $input_class;
                $input_subclass = $input_class;
            }elseif (strlen($input_class) == 4) {
                $class['on'] = $input_class;
                $input_subclass = substr($input_class,0,2);
                $input_class = substr($input_class,0,2);
            }else{
                $class['on'] = 0;
                E('加载失败'); return;
            }
            //位置和目录
            $current_path = $Articleclass->getpath($input_subclass);
            $this -> assign('current_path', $current_path);

            //目录-文章类别
            $class['data'] = $Articleclass->getsubclasstree($input_class);
            //var_dump($class1);
            $this -> assign('class',$class);

            //得到class list 
            $classlist = $Articleclass->getsubclass($input_subclass);  

            $where['ar_class'] = array('in', $classlist);
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
        
        //display
        $this -> display();
    }


}