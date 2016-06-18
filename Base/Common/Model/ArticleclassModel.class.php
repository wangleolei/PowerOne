<?php
namespace Common\Model;
use Think\Model;

class ArticleclassModel extends Model{
    private $ar_class ;
    private $control_code ;
    private $ar_parent;
    private $ar_c_title;
    private $ar_c_url;
    private $ar_c_number;
    public function set_ar_class($ar_class){
        $this->ar_class = $ar_class;
    }
    public function set_control_code($control_code){
        $this->control_code = $control_code;
    }
    public function set_ar_parent($ar_parent){
        $this->ar_parent = $ar_parent;
    }
    public function set_ar_c_title($ar_c_title){
        $this->ar_c_title = $ar_c_title;
    }
    public function set_ar_c_url($ar_c_url){
        $this->ar_c_url = $ar_c_url;
    }
    public function set_ar_c_number($ar_c_number){
        $this->ar_c_number = $ar_c_number;
    }
    //insert a new record into table.
    public function insert(){
        if ($this->ar_class)        $new_record['ar_class']     = $this->ar_class;
        if ($this->control_code)    $new_record['control_code'] = $this->control_code;
        if ($this->ar_parent != NULL) $new_record['ar_parent']  = $this->ar_parent;
        if ($this->ar_c_title)      $new_record['ar_c_title']   = $this->ar_c_title;
        if ($this->ar_c_url)        $new_record['ar_c_url']     = $this->ar_c_url;
        if ($this->ar_c_number)     $new_record['ar_c_number']  = $this->ar_c_number;

        if(!$this -> validate_parent($this->ar_parent,1)) return false;
        $result = $this -> add($new_record);
        if(!$result) return false;
        return true;
    }
    //insert a new record into table.
    public function update(){
        if ($this->ar_class) $condition['ar_class']     = $this->ar_class;
        else return false;  
        if ($this->control_code)    $new_value['control_code'] = $this->control_code;
        if ($this->ar_parent != NULL) {
            $new_value['ar_parent']  = $this->ar_parent;
            if(!$this -> validate_parent($this->ar_parent,1)) return false;
        }
        if ($this->ar_c_title)      $new_value['ar_c_title']   = $this->ar_c_title;
        if ($this->ar_c_url)        $new_value['ar_c_url']     = $this->ar_c_url;
        if ($this->ar_c_number)     $new_value['ar_c_number']  = $this->ar_c_number;
        
        if($this -> where($condition) -> save($new_value)) return true;
        else  return false;
    }
    //validate parent, and make sure it is tree structure.
    private function validate_parent($parent_class, $control){
        $condition['control_code'] = session('control_code'); 
        $control = $control + 1;
        if ($control > 100) 
            return false;

        if ($parent_class == 0) return true;
        $condition['ar_class'] = $parent_class;
        $parentclass = $this -> field('ar_parent') -> where($condition) -> find();
        if($parentclass && $parentclass['ar_parent'] == 0 )
            return true;
        if (!$parentclass || $parentclass['ar_parent'] == $this->ar_class)
            return false;
        $result = $this -> validate_parent($parentclass['ar_parent'], $control);
        if($result) return true;
        else return false;
    }
//	输入其中一个分类，查找一条线上的所有分类  并且返回 ， 并且专使用到where条件
	function getclasstreecondition($class){
        $condition1['control_code'] = session('control_code'); 
        $condition1['ar_class'] = $class;
        $condition2['control_code'] = session('control_code'); 
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
//  输入class ，返回第一层父类
    function getfirstleveclass($class, $control){
        $condition['control_code'] = session('control_code'); 
        $control = $control + 1;
        if ($control > 100) 
            return;
        $condition['ar_class'] = $class;
        $parent_class = $this -> where($condition) -> find();
        if ($parent_class['ar_parent'] == 0 || $parent_class['ar_parent'] == NULL || !$parent_class) 
            return $parent_class['ar_class'];
        else 
            return $this -> getfirstleveclass($parent_class['ar_parent'], $control);
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
        $condition['control_code'] = session('control_code'); 
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
        $condition1['control_code'] = session('control_code'); 
        $condition1['ar_class'] = $class;
        $condition2['control_code'] = session('control_code'); 
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
        $control_code = session('control_code'); 
        $condition['ar_parent'] = $parent_class;
        //$temp_subclass = M('Articleclass') -> where($condition) -> field('ar_class') -> select();
        $temp_subclass = $this -> where($condition) -> field('ar_class') -> select();
        $subclass = $this->array_column($temp_subclass, 'ar_class');

        $condition1['ar_class'] = $class;
        $root_class = $this -> where($condition1) -> find();
        if(!$root_class) return;

        $root_class['subclass'] = $this -> getsubclasstree_temp($control_code, $root_class, 0);
        return $root_class;
    }
//  输入class 返回该分类所有子类,如果类别存储打破树状结构，这里将会出现死循环。class 新增操作需要加强validation
    private function getsubclasstree_temp($control_code, $parent_class, $level){
        if($control_code)  $condition2['control_code'] = $control_code;
        else  $condition2['control_code'] = session('control_code'); 
        $level = $level + 1;
        if ($level > 100) return;//防止死循环，这个地方限定100层
        $condition2['ar_parent'] = $parent_class['ar_class'];
        $subclass = $this -> where($condition2) -> select();
        if(!$subclass) return;

        $arraylength = count($subclass);
        for ($i=0; $i < $arraylength ; $i++) { 
            $subclass_temp = $this -> getsubclasstree_temp($control_code,$subclass[$i], $level);
            if ($subclass_temp) 
                $subclass[$i]['subclass'] = $subclass_temp;
        }
        return $subclass;

    }
//输入类别，返回该分支的path. e,g   技术分享->主机相关
    function getpath($class){
            $condition['control_code'] = session('control_code'); 
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
//输入类别号，返回该类别名称
    function getclassname($class){
        $condition['control_code'] = session('control_code'); 
        $condition['ar_class'] = $class;
        $result = $this->field('ar_c_title')->where($condition) -> find();
        $classname = $result['ar_c_title'];
        return $classname;
                
    }

        //从记录集中取出二维数组中 其中一列：PHP 5.5+ 是系统自带函数
//array_column(array,column_key,index_key);  
//array 必需。指定要使用的多维数组（记录集）。
//column_key  必需。需要返回值的列。可以是索引数组的列的整数索引，或者是关联数组的列的字符串键值。该参数也可以是 NULL，此时将返回整个数组（配合index_key 参数来重置数组键的时候，非常管用）。
//index_key   可选。作为返回数组的索引/键的列。
    function array_column($input, $columnKey, $indexKey = NULL)   {     $columnKeyIsNumber = (is_numeric($columnKey)) ? TRUE : FALSE;     $indexKeyIsNull = (is_null($indexKey)) ? TRUE : FALSE;     $indexKeyIsNumber = (is_numeric($indexKey)) ? TRUE : FALSE;     $result = array();       foreach ((array)$input AS $key => $row)     {        if ($columnKeyIsNumber)       {         $tmp = array_slice($row, $columnKey, 1);         $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : NULL;       }       else      {         $tmp = isset($row[$columnKey]) ? $row[$columnKey] : NULL;       }       if ( ! $indexKeyIsNull)       {         if ($indexKeyIsNumber)         {           $key = array_slice($row, $indexKey, 1);           $key = (is_array($key) && ! empty($key)) ? current($key) : NULL;           $key = is_null($key) ? 0 : $key;         }         else        {           $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;         }       }         $result[$key] = $tmp;     }       return $result;   } 
}