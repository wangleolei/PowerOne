<?php
namespace Wechat\Controller;
use Think\Controller;
class SenallController extends Controller {
    public function index(){
    	$table = M('about');                        // 实例化一个模型，表为about
    	$aboutme = $table -> where('about_class = 0') -> order('about_number asc') -> select();     
    	$this -> assign('aboutme',$aboutme);         // 获取about表中关于我（0）的数据进行分配
        $aboutsite = $table -> where('about_class = 1') -> order('about_number asc') -> select();   
        $this -> assign('aboutsite',$aboutsite);     // 获取about表中关于站点(1)的数据进行分配
    	$this->display();
    }
}