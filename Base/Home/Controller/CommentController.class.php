<?php
namespace Home\Controller;

use Common\Controller\CommonController;

class CommentController extends CommonController {

    // 文章页 end in 2016/03/15
    public function index(){
        $this -> display();
    }

    // sent email out.
    public function send(){
    	$title 		= I('post.title');
    	$address 	= I('post.address');
    	$name 		= I('post.name');
    	$company 	= I('post.company');
    	$post 		= I('post.post');
    	$phone 		= I('post.phone');
    	$fax 		= I('post.fax');
    	$text 		= I('post.text');

    	$test 		= '';
    	$fulltext	= '标题：'.$title.'<br/>地址：'.$address.'<br/>姓名：'.$name.
    					'<br/>单位：'.$company.'<br/>电邮：'.$post.'<br/>电话：'.$phone.
    					'<br/>传真：'.$fax.'<br/>内容：<br/>'.$text;
//    	$test  = 'wanglei_leo@163.com';
//        $title = '邮件功能正常使用';
//        $fulltext  = '这是一封测试的邮件，当你看见这封邮件时，你的配置是正确的。<br/>系统邮件，请勿回复！';
        if(send_mail($test,$title,$fulltext)) 
        	$this -> success('发送成功！');
        else 
        	$this -> error('发送失败！');
    }
}