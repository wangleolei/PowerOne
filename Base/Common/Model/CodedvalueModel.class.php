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
//  输入control code, index, ext_value to retreive unique value.
    public function getbyext($control,$index,$ext){
        if  ($control) $condition['control_code'] = $index;
        else  $condition['control_code'] = 58;
        $condition['index'] = $index;
        $condition['ext_value'] = $ext;
        $result = $this->where($condition) ->find();
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
        $condition['seq_number'] = $id;
        $result = $this->where($condition)->save($data);
        return $result;
    }
    //  输入data, 新增
    public function add($data){
        $result = $this->data($data)->add();
        return $result;
    }

}