<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class IndexController extends CommonController {

    // 文章页 end in 2016/03/14
    public function index(){
        // 最新的 3 个轮播图
        $slide = M('notice') -> where('no_type=3') -> order('no_time desc') -> select();
        $this -> assign('slide',$slide);
        // 8篇最新技术分享的文章
        $where1 = $this->getclasstree(1);
        $data1 = M('article') -> where($where1) -> order('ar_time desc') -> limit(8) -> select();
        $this -> assign('article1',$data1);
        // 8篇最新作品分享的文章
        $where2 = $this->getclasstree(2);
        $data2 = M('article') -> where($where2) -> order('ar_time desc') -> limit(8) -> select();
        $this -> assign('article2',$data2);
        // 文章信息
        $data  = M('notice') -> where('no_type=1') -> order('no_time desc') -> limit($page->limit,$page->single) -> select();
        $place = new \Org\Util\IP();
        $mood  = change_mood($data,$place);
        $this -> assign('mood',$mood);
        
        $this -> display();
    }
    function getclasstree($class){
        $condition1['ar_class'] = $class;
        $condition2['ar_parent'] = $class;
        $inputarray = array($class);
        $parentclass = M('article_class') -> field('ar_parent') -> where($condition1) -> find();
        if ($parentclass && $parentclass['ar_parent'] != 0) {
            $condition2['ar_parent'] = $parentclass['ar_parent'];
 //           $inputarray = $this->array_column($parentclass, 'ar_parent');
            $inputarray = $parentclass;
        }
        $subclass = M('article_class') -> where($condition2) -> field('ar_class') -> select();
        $array_temp = $this->array_column($subclass, 'ar_class');
        $classtree_array = array_merge($inputarray,$array_temp);
        $output_classtree['ar_class'] = array('in', $classtree_array);
        $output_classtree['ar_state'] = 1;
//        var_dump($classtree_array);
//        $output_classtree = M('article_class') -> where($condition3) -> select();
        return $output_classtree;
        }
        function array_column($input, $columnKey, $indexKey = NULL)   {     $columnKeyIsNumber = (is_numeric($columnKey)) ? TRUE : FALSE;     $indexKeyIsNull = (is_null($indexKey)) ? TRUE : FALSE;     $indexKeyIsNumber = (is_numeric($indexKey)) ? TRUE : FALSE;     $result = array();       foreach ((array)$input AS $key => $row)     {        if ($columnKeyIsNumber)       {         $tmp = array_slice($row, $columnKey, 1);         $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : NULL;       }       else      {         $tmp = isset($row[$columnKey]) ? $row[$columnKey] : NULL;       }       if ( ! $indexKeyIsNull)       {         if ($indexKeyIsNumber)         {           $key = array_slice($row, $indexKey, 1);           $key = (is_array($key) && ! empty($key)) ? current($key) : NULL;           $key = is_null($key) ? 0 : $key;         }         else        {           $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;         }       }         $result[$key] = $tmp;     }       return $result;   } 

}