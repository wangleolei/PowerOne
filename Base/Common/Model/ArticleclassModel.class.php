<?php
namespace Common\Model;
use Think\Model;

class ArticleclassModel extends Model{
//	输入其中一个分类，查找一条线上的所有分类  并且返回 ， 并且专使用到where条件
	function getclasstreecondition($class){
        $condition1['ar_class'] = $class;
        $condition2['ar_parent'] = $class;
        $inputarray = array($class);
        //$parentclass = M('Articleclass') -> field('ar_parent') -> where($condition1) -> find();
        $parentclass = $this -> field('ar_parent') -> where($condition1) -> find();
        if ($parentclass && $parentclass['ar_parent'] != 0) {
            $condition2['ar_parent'] = $parentclass['ar_parent'];
 //           $inputarray = $this->array_column($parentclass, 'ar_parent');
            $inputarray = $parentclass;
        }
        //$subclass = M('Articleclass') -> where($condition2) -> field('ar_class') -> select();
        $subclass = $this -> where($condition2) -> field('ar_class') -> select();
        $array_temp = $this->array_column($subclass, 'ar_class');
        $classtree_array = array_merge($inputarray,$array_temp);
        $output_classtree['ar_class'] = array('in', $classtree_array);
        $output_classtree['ar_state'] = 1;
//        var_dump($classtree_array);
//        $output_classtree = M('Articleclass') -> where($condition3) -> select();
        return $output_classtree;
               
	}
//  输入class 返回该分类所有子类以及子类的子类
    function getsubclass($parent_class){
        $subclasslist = array($parent_class);
        $temp_subclasslist = $this -> getsubclass_temp($parent_class, 0);
        if ($temp_subclasslist)
            $subclasslist = array_merge($subclasslist, $temp_subclasslist);
        return $subclasslist;
    }
//  输入class 返回该分类所有子类,如果类别存储打破树状结构，这里将会出现死循环。class 新增操作需要加强validation
    private function getsubclass_temp($parent_class, $level){
        $level = $level + 1;
        if ($level > 100) return;//防止死循环，这个地方限定100层
        $condition['ar_parent'] = $parent_class;

        $temp_subclasslistlist = $this -> where($condition) -> field('ar_class') -> select();
        if(!$temp_subclasslistlist) return;
        $subclasslist = $this->array_column($temp_subclasslistlist, 'ar_class');

        $arraylength = count($subclasslist);
        for ($i=0; $i < $arraylength ; $i++) { 
            $temp2_subclasslist = $this -> getsubclass_temp($subclasslist[$i], $level);
            if ($temp2_subclasslist)
                $subclasslist = array_merge($subclasslist, $temp2_subclasslist);
        }
        return $subclasslist;
    }

//  输入其中一个分类，查找一条线上的所有分类 并且返回 (tree结构没有升级到用数组表示)。
        function getclasstree($class){
        $condition1['ar_class'] = $class;
        $condition2['ar_parent'] = $class;
        $inputarray = array($class);
        //$parentclass = M('Articleclass') -> field('ar_parent') -> where($condition1) -> find();
        $parentclass = $this -> field('ar_parent') -> where($condition1) -> find();
        if ($parentclass && $parentclass['ar_parent'] != 0) {
            $condition2['ar_parent'] = $parentclass['ar_parent'];
 //           $inputarray = $this->array_column($parentclass, 'ar_parent');
            $inputarray = $parentclass;
        }
        //$subclass = M('Articleclass') -> where($condition2) -> field('ar_class') -> select();
        $subclass = $this -> where($condition2) -> field('ar_class') -> select();
        $array_temp = $this->array_column($subclass, 'ar_class');
        $classtree_array = array_merge($inputarray,$array_temp);
        $condition3['ar_class'] = array('in', $classtree_array);
//        var_dump($classtree_array);
        //$output_classtree = M('Articleclass') -> where($condition3) -> select();
        $output_classtree = $this -> where($condition3) -> select();
        return $output_classtree;
    }
//  输入其中一个分类，查找该分类下的所有分类 并且根据所在层返回到对应数组层(tree结构用数组表示)，我们最大支持10层
    function getsubclasstree($class){
        $condition['ar_parent'] = $parent_class;
        //$temp_subclass = M('Articleclass') -> where($condition) -> field('ar_class') -> select();
        $temp_subclass = $this -> where($condition) -> field('ar_class') -> select();
        $subclass = $this->array_column($temp_subclass, 'ar_class');

        $condition1['ar_class'] = $class;
        $root_class = $this -> where($condition1) -> find();
        if(!$root_class) return;

        $root_class['subclass'] = $this -> getsubclasstree_temp($root_class, 0);
        return $root_class;
    }
//  输入class 返回该分类所有子类,如果类别存储打破树状结构，这里将会出现死循环。class 新增操作需要加强validation
    private function getsubclasstree_temp($parent_class, $level){
        $level = $level + 1;
        if ($level > 100) return;//防止死循环，这个地方限定100层
        $condition2['ar_parent'] = $parent_class['ar_class'];
        $subclass = $this -> where($condition2) -> select();
        if(!$subclass) return;

        $arraylength = count($subclass);
        for ($i=0; $i < $arraylength ; $i++) { 
            $subclass_temp = $this -> getsubclasstree_temp($subclass[$i], $level);
            if ($subclass_temp) 
                $subclass[$i]['subclass'] = $subclass_temp;
        }
        return $subclass;

    }
//输入类别，返回该分支的path. e,g   技术分享->主机相关
    function getpath($class){
            for ($i=0; $i < 10; $i++) { 
                $condition['ar_class'] = $class;
                $parentclass = $this->field('ar_parent, ar_c_title, ar_c_url')->where($condition) -> find();
                if (empty($parentclass)) {
                    $path = "failed";
                    $i = 10;
                }elseif ($parentclass['ar_parent'] == 0) {
                    if (!$path) {
                        $path = '-> '.'<a href="'.$parentclass['ar_c_url'].'">'.$parentclass['ar_c_title'].'</a>';
                    }else{
                        $path = '-> '.'<a href="'.$parentclass['ar_c_url'].'">'.$parentclass['ar_c_title'].'</a>'." -> ".$path;
                    }
                    $i = 10;
                }else{
                    if (!$path) {
                        $path = '<a href="'.$parentclass['ar_c_url'].'">'.$parentclass['ar_c_title'].'</a>';
                    }else{
                        $path = '<a href="'.$parentclass['ar_c_url'].'">'.$parentclass['ar_c_title'].'</a>'." -> ".$path;
                    }
                }
                $class = $parentclass['ar_parent'];
            }
            return $path;
    }

        //从记录集中取出二维数组中 其中一列：PHP 5.5+ 是系统自带函数
//array_column(array,column_key,index_key);  
//array 必需。指定要使用的多维数组（记录集）。
//column_key  必需。需要返回值的列。可以是索引数组的列的整数索引，或者是关联数组的列的字符串键值。该参数也可以是 NULL，此时将返回整个数组（配合index_key 参数来重置数组键的时候，非常管用）。
//index_key   可选。作为返回数组的索引/键的列。
    function array_column($input, $columnKey, $indexKey = NULL)   {     $columnKeyIsNumber = (is_numeric($columnKey)) ? TRUE : FALSE;     $indexKeyIsNull = (is_null($indexKey)) ? TRUE : FALSE;     $indexKeyIsNumber = (is_numeric($indexKey)) ? TRUE : FALSE;     $result = array();       foreach ((array)$input AS $key => $row)     {        if ($columnKeyIsNumber)       {         $tmp = array_slice($row, $columnKey, 1);         $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : NULL;       }       else      {         $tmp = isset($row[$columnKey]) ? $row[$columnKey] : NULL;       }       if ( ! $indexKeyIsNull)       {         if ($indexKeyIsNumber)         {           $key = array_slice($row, $indexKey, 1);           $key = (is_array($key) && ! empty($key)) ? current($key) : NULL;           $key = is_null($key) ? 0 : $key;         }         else        {           $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;         }       }         $result[$key] = $tmp;     }       return $result;   } 
}