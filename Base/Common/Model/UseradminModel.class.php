<?php
namespace Common\Model;
use Think\Model;

class UseradminModel extends Model{
    private $control_code;                      
    private $ad_state;                         
    private $ad_group;                         
    private $ad_username;                      
    private $ad_password;                      
    private $ad_email;      
    private $ad_nickname;                   
    private $ad_portrait; 
    private $ad_last_time;
    private $ad_last_ip;  
    private $ad_last_os;
    public function set_control_code($control_code){
        $this->control_code = $control_code;
    }
    public function set_ad_state($ad_state){
        $this->ad_state = $ad_state;
    }
    public function set_ad_group($ad_group){
        $this->ad_group = $ad_group;
    }
    public function set_ad_username($ad_username){
        $this->ad_username = $ad_username;
    }
    public function set_ad_password($ad_password){
        $this->ad_password = md5($ad_password);
    }
    public function set_ad_email($ad_email){
        $this->ad_email = $ad_email;
    }
    public function set_ad_nickname($ad_nickname){
        $this->ad_nickname = $ad_nickname;
    }
    public function set_ad_portrait($ad_portrait){
        $this->ad_portrait = $ad_portrait;
    }
    public function set_ad_last_time($ad_last_time){
        $this->ad_last_time = $ad_last_time;
    }
    public function set_ad_last_ip($ad_last_ip){
        $this->ad_last_ip = $ad_last_ip;
    }
    public function set_ad_last_os($ad_last_os){
        $this->ad_last_os = $ad_last_os;
    }
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
    public function insert(){
        if ($this->control_code != NULL) $data['control_code'] = $this->control_code ;
        if ($this->ad_state     != NULL) $data['ad_state']     = $this->ad_state     ;
        if ($this->ad_group     != NULL) $data['ad_group']     = $this->ad_group     ;
        if ($this->ad_username  != NULL) {
            if($this->findbyusername($this->ad_username)){
                $result['resp_code'] =  90001;
                $result['resp_message'] = "用户名已存在！";
                return $result;
            }else{
                $data['ad_username']  = $this->ad_username  ;    
            }
        }
        if ($this->ad_password  != NULL) $data['ad_password']  = $this->ad_password  ;
        if ($this->ad_email     != NULL) {
            if($this->findbyemail($this->ad_email)){
                $result['resp_code'] =  90002;
                $result['resp_message'] = "email已被注册";
                return $result;
            }else{
                $data['ad_email']     = $this->ad_email     ;    
            }
        }
        if ($this->ad_nickname  != NULL) $data['ad_nickname']  = $this->ad_nickname  ;
        if ($this->ad_portrait  != NULL) $data['ad_portrait']  = $this->ad_portrait  ;
        if ($this->ad_last_time != NULL) $data['ad_last_time'] = $this->ad_last_time ;
        if ($this->ad_last_ip   != NULL) $data['ad_last_ip']   = $this->ad_last_ip   ;
        if ($this->ad_last_os   != NULL) $data['ad_last_os']   = $this->ad_last_os   ;
        $add_res = $this->data($data)->add();
        if($add_res){
            $result['resp_code'] =  0;
            $result['resp_message'] = "新增成功！";
        }else{
            $result['resp_code'] =  9003;
            $result['resp_message'] = "新增时出错！";
        }
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