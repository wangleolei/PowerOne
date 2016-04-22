<?php
namespace Common\Model;
use Think\Model;

class NoticeModel extends Model{
//	no_type  1:说说   2:公告  3: 轮播图
	function noticelist($no_type,$start,$number){
		$condition['no_type'] = $no_type;
		return $this -> where($condition) -> order('no_time desc') -> limit($start, $number) -> select();
	}
}