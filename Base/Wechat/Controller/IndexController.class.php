<?php
namespace Wechat\Controller;
use Think\Controller;
use Think\Model;

class IndexController extends Controller {
    public function index(){


		$this->display();								// 输出模型
    }
}