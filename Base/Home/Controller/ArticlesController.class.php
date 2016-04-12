<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class ArticlesController extends CommonController {

    // 文章页 end in 2016/03/13
    public function index(){
        if(I('get.class'))
        {
            $where['ar_class'] = I('get.class');
            $classlist1 = array(I('get.class'));
            $classlist2 = $this->getsubclass(I('get.class'));
            $classlist3 = $this->array_column($classlist2, 'ar_class');
            $classlist4 = array_merge($classlist1,$classlist3);

//            var_dump($classlist4);
            $where['ar_class'] = array('in', $classlist4);
        }
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
        //if($where['ar_class'])$class['on'] = $where['ar_class'];
        if(I('get.class'))$class['on'] = I('get.class');
        else $class['on'] = 0;
        $class['data'] = $this->getclasstree(I('get.class'));
        //$class['data'] = M('article_class') -> select();
        $this -> assign('class',$class);
        $this -> display();
    }

    function getsubclass($parent_class){
        $condition['ar_link'] = $parent_class;
        $subclass = M('article_class') -> where($condition) -> field('ar_class') -> select();
        return $subclass;
    }
    
    function getclasstree($class){
        $condition1['ar_class'] = $class;
        $condition2['ar_link'] = $class;
        $inputarray = array($class);
        $parentclass = M('article_class') -> field('ar_link') -> where($condition1) -> find();
        if ($parentclass && $parentclass['ar_link'] != 0) {
            $condition2['ar_link'] = $parentclass['ar_link'];
 //           $inputarray = $this->array_column($parentclass, 'ar_link');
            $inputarray = $parentclass;
        }
        $subclass = M('article_class') -> where($condition2) -> field('ar_class') -> select();
        $array_temp = $this->array_column($subclass, 'ar_class');
        $classtree_array = array_merge($inputarray,$array_temp);
        $condition3['ar_class'] = array('in', $classtree_array);
//        var_dump($classtree_array);
        $output_classtree = M('article_class') -> where($condition3) -> select();
        return $output_classtree;
        }
        function array_column($input, $columnKey, $indexKey = NULL)   {     $columnKeyIsNumber = (is_numeric($columnKey)) ? TRUE : FALSE;     $indexKeyIsNull = (is_null($indexKey)) ? TRUE : FALSE;     $indexKeyIsNumber = (is_numeric($indexKey)) ? TRUE : FALSE;     $result = array();       foreach ((array)$input AS $key => $row)     {        if ($columnKeyIsNumber)       {         $tmp = array_slice($row, $columnKey, 1);         $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : NULL;       }       else      {         $tmp = isset($row[$columnKey]) ? $row[$columnKey] : NULL;       }       if ( ! $indexKeyIsNull)       {         if ($indexKeyIsNumber)         {           $key = array_slice($row, $indexKey, 1);           $key = (is_array($key) && ! empty($key)) ? current($key) : NULL;           $key = is_null($key) ? 0 : $key;         }         else        {           $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;         }       }         $result[$key] = $tmp;     }       return $result;   } 

}