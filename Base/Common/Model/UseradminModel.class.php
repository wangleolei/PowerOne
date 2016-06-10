<?php
namespace Common\Model;
use Think\Model;

class UseradminModel extends Model{
//  输入username 查找该记录
    public function findbyusername($username){
        $where['ad_username'] = $username;
        $result =  $this -> where($where) -> find();
        return $result;
               
    }
//  email 查找该记录
    public function findbyemail($email){
        $where['ad_email'] = $email;
        $result = $this -> where($where) -> find();
        return $result;
    }
//  新增
    public function add($data){
     //       $this->seq_number = 9;
        //$M = M('Codedvalue');
        //$this->data($data)->add();
        $this->data($data)->add();
        return $result;
    }
//  修改密码
    public function updatepassword($id,$password){
        $data['ad_password'] = md5($password);
        $condition['ad_id'] = $id;
        $result = $this->where($condition)->save($data);
        return $result;
    }

}