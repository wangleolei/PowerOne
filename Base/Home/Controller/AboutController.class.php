<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class AboutController extends CommonController {

    // 文章页 end in 2016/03/14
    public function index(){
    	$notice = D('Notice');
    	//$notice = D('Common/notice');
    	$about = $notice->findbytype(4);
    	$this -> assign('about',$about);
        $this -> display();

    }
    
}