<?php
namespace Common\Model;
use Think\Model;
// 操作table article
class ArticleModel extends Model{
	//返回文章列表
	function articlelist($condition,$start,$number){
		return $this -> where($condition) -> order('ar_time desc') -> limit($start, $number) -> select();
	}
	//返回有多少该条件的文章
	function countarticle($condition){
		return $this -> where($condition) -> count();
	}

	//返回文章列表
	function wechatlist(){
		return $this -> where('ar_wechat > 0') -> order('ar_wechat asc') -> limit($start, $number) -> select();
	}
}