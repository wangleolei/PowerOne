<?php
namespace Common\Model;
use Think\Model;

class NoticeModel extends Model{
//	no_type  1:说说   2:公告  3: 轮播图
	function noticelist($no_type,$start,$number){
		$control_code = cookie('control_code'); 
		$condition['control_code'] = $control_code;
		$condition['no_type'] = $no_type;
		return $this -> where($condition) -> order('no_time desc') -> limit($start, $number) -> select();
	}
//	no_type  1:说说   2:公告  3: 轮播图, 4 : 关于
	function findbytype($no_type){
		$control_code = cookie('control_code'); 
		$condition['control_code'] = $control_code;
		$condition['no_type'] = $no_type;
		$notice  = $this -> where($condition) -> find();
		return $notice;
	}


}