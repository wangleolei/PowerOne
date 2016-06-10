<?php
namespace Common\Model;
use Think\Model;

class CodedvalueModel extends Model{
//   index to retreive index list.
    public function getbyindex2($index){
        $condition['index'] = $index;
        $result = $this->where($condition) ->select();
        return $result;
               
    }
//	输入control code and index to retreive index list.
	public function getbyindex($control,$index){
        if  ($control) $condition['control_code'] = $control;
        else  $condition['control_code'] = 58;
        $condition['index'] = $index;
        $result = $this->where($condition) ->select();
        return $result;
               
	}
//  输入control code, index, ext_value to retreive .
    public function getbyext($control,$index,$ext){
        if  ($control) $condition['control_code'] = $control;
        else  $condition['control_code'] = 58;
        $condition['index'] = $index;
        $condition['ext_value'] = $ext;
        $result = $this->where($condition) ->select();
        return $result;
    }
//  输入control code, index, ext_value to retreive .
    public function findbyext($control,$index,$ext){
        if  ($control) $condition['control_code'] = $control;
        else  $condition['control_code'] = 58;
        $condition['index'] = $index;
        $condition['ext_value'] = $ext;
        $result = $this->where($condition) ->find();
        return $result;
    }
//  输入control code, index, int_value to retreive short and long description.
    public function getdescbyint($control,$index,$int){
        if  ($control) $condition['control_code'] = $control;
        else  $condition['control_code'] = 58;
        $condition['index'] = $index;
        $condition['int_value'] = $int;
        $result = $this->where($condition) ->field('short_desc, long_desc') ->order('sort_value')->select();
        return $result;
    }
//  输入control code, index, 得到 short_desc
    public function getshortbyindex($control,$index){
        if  ($control) $condition['control_code'] = $control;
        else  $condition['control_code'] = 58;
        $condition['index'] = $index;
        $result = $this->where($condition)->field('short_desc') ->order('sort_value')->select();
        return $result;
    }
//  输入control code, index, 得到short and long description
    public function getdescbyindex($control,$index){
        if  ($control) $condition['control_code'] = $control;
        else  $condition['control_code'] = 58;
        $condition['index'] = $index;
        $result = $this->where($condition)->field('short_desc, long_desc') ->order('sort_value')->select();
        return $result;
    }
//  输入control code, index, 得到short and long description
    public function getlast3byindex($control,$index){
        if  ($control) $condition['control_code'] = $control;
        else  $condition['control_code'] = 58;
        $condition['index'] = $index;
        $result = $this->where($condition)->field('oth_value, short_desc, long_desc') ->order('sort_value')->select();
        return $result;
    }
//  输入seq_number, 删除
    public function delbyseq($id){
        $condition['seq_number'] = $id;
        $result = $this->where($condition)->delete();
        return $result;
    }
    //  输入data, 修改
    public function updbyseq($id,$data){
        if ($id == 0 || !$id) {
            //$data['seq_number'] = 9;
            $result = M('Codedvalue')->data($data)->add();
            //$this->add($data);
        }
        else{
            $data['seq_number'] = $id;
            $condition['seq_number'] = $id;
            $result = $this->where($condition)->save($data);
        }
        return $result;
    }
    //  输入data, 新增
    public function add($data){
     //       $this->seq_number = 9;
        //$M = M('Codedvalue');
        //$this->data($data)->add();
        $this->data($data)->add();
        return $result;
    }

}