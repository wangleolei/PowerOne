<?php
namespace Admin\Controller;

use Common\Controller\AuthController;

class ParameterController extends AuthController {

    // 设置主页 -> end in 2016/02/25
    public function index(){
        if(IS_AJAX)session('admin.parameter',null);
        else
        {
            $session = session('admin.parameter');
            if($session['pa_class'])$class['on'] = $session['pa_class'];
            $class['data'] = M('parameter_class') -> select();
            $this -> assign('class',$class);
            $this -> display();
        }
    }

    // 列表 -> end in 2016/02/25
    public function parameter_list(){
        if (IS_AJAX) {
            $session = session('admin.parameter');
            if(I('get.class'))$session['pa_class'] = $where['pa_class'] = I('get.class');
            elseif($session['pa_class'])$where['pa_class'] = $session['pa_class'];
            else $session['pa_class'] = $where['pa_class'] = 1;
            session('admin.parameter',$session);
            unset($session);
            $parameter = M('parameter') -> where($where) -> select();
            $this -> assign('parameter',$parameter);
            unset($parameter);
            $this -> assign('on_class',$where['pa_class']);
            unset($where);
            $this -> display();
        }
        else $this -> error('你的操作有错误！');
    }

    // 保存设置 -> end in 2016/02/25
    public function operat(){
        if(I('post.operat')=='save')
        {
            $session   = session('admin.parameter');
            $parameter = M('parameter') -> where('pa_class='.$session['pa_class']) -> select();
            for($i=0;$i<count($parameter);$i++){
                if($parameter[$i]['pa_form'] == 4){
                    $upload = upload_file($parameter[$i]['pa_id']);
                    if($upload)$save['pa_value'] = $upload;
                }
                elseif(I('post.'.$parameter[$i]['pa_attribute'])!=$parameter[$i]['pa_value'])$save['pa_value'] = I('post.'.$parameter[$i]['pa_attribute']);
                if($save)M('parameter') -> where('pa_id='.$parameter[$i]['pa_id']) -> save($save);
                unset($save);
            }
            $this -> success('操作成功！');
        }
        else $this -> error('你的操作有错误！');
    }

    // 测试邮件 -> end in 2016/02/25
    public function test_email(){
        if(IS_AJAX){
            if (I('get.test')){
                $test  = I('get.test');
                $title = '邮件功能正常使用';
                $text  = '这是一封测试的邮件，当你看见这封邮件时，你的配置是正确的。<br/>系统邮件，请勿回复！';
                if(SendMail($test,$title,$text))$this -> ajaxReturn(0);
            }
        }
    }


}