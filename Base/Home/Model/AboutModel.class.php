<?php
namespace Admin\Model;
use Think\Model;

class AboutModel extends Model{
	public function setabout(){
		$number = $this -> count();
		for ($i=0; $i < $number; $i++) {
			if(I('post.'.$i))
			{
				$where['about_number'] = $i;
				$save['about_value'] = I('post.'.$i);
				$this -> where($where) -> save($save);
			}
		}
		return true;
	}
}