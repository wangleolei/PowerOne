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
 //           if($session['pa_class'])$class['on'] = $session['pa_class'];
 //           $class['data'] = M('parameter_class') -> select(); 
            $cvt = D('Common/Codedvalue');
            $cvt01000 = $cvt->getbyindex(58,1000);
            $this -> assign('class',$cvt01000);
            $this -> display();
        }
    }

    // 列表 -> end in 2016/02/25
    public function parameter_list(){
        if (IS_AJAX) {
//            $session = session('admin.parameter');
            $index = I('get.class');
            $cvt = D('Common/Codedvalue');
            $cvt01000 = $cvt->getbyindex2($index);
//            session('admin.parameter',$session);
//            unset($session);
//            $parameter = M('parameter') -> where($where) -> select();
            $this -> assign('parameter',$cvt01000);
//            $this -> assign('on_class',3);
//            $this -> assign('on_class',$where['pa_class']);
            $this -> display();
        }
        else $this -> error('你的操作有错误！');
    }

    // 保存设置 -> end in 2016/02/25
    public function operat(){
        if(I('post.operat')=='save')
        {
            $session   = session('admin.parameter');
//            $parameter = M('parameter') -> where('pa_class='.$session['pa_class']) -> select();
            for($i=0;$i<count($parameter);$i++){
                if($parameter[$i]['pa_form'] == 4){
                    $upload = upload_file($parameter[$i]['pa_id']);
                    if($upload)$save['pa_value'] = $upload;
                }
                elseif(I('post.'.$parameter[$i]['pa_attribute'])!=$parameter[$i]['pa_value'])$save['pa_value'] = I('post.'.$parameter[$i]['pa_attribute']);
//                if($save)M('parameter') -> where('pa_id='.$parameter[$i]['pa_id']) -> save($save);

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

    // 删除参数 -> end in 20160508
    public function parameter_delete(){
        if (IS_AJAX) {
            if(I('get.id'))$id = I('get.id');
            else $state=1;
            if($state)$this -> ajaxReturn($state);
            else
            {
                $cvt = D('Common/Codedvalue');
                $delcvt = $cvt->delbyseq($id);
                $state=0;
                $this -> ajaxReturn($state);
            }
        }
        else $this -> error('你的操作有错误！');
    }
// 修改参数 -> end in 20160508
    public function parameter_upd(){
        if (IS_AJAX) {
            if(I('post.index'))
            {
                $data['index'] = I('post.index');
                if (I('post.id')) $id = I('post.id');
                else $id = 0;
            }
            else $state=1;

            $data['control_code'] = I('post.control');
            $data['sort_value'] = I('post.sort_value');
            $data['int_value'] = I('post.int_value');
            $data['ext_value'] = I('post.ext_value');
            $data['oth_value'] = I('post.oth_value');
            $data['short_desc'] = I('post.short_desc');
            $data['long_desc'] = I('post.long_desc');
            if($state)$this -> ajaxReturn($state);
            else
            {
                $cvt = D('Common/Codedvalue');
                $cvt->updbyseq($id,$data);
                $state=0;
                $this -> ajaxReturn($state);
            }
        }
        else $this -> error('你的操作有错误！');
    }

    // 修改参数 -> end in 20160508
    public function testing(){
        

                
            $id = 0;

            //$data['seq_number'] = 9;
            $data['index'] = 1000;
            $data['control_code'] = 58;
            $data['sort_value'] = 4;
            $data['int_value'] = 4;
            $data['ext_value'] = "e";
            $data['oth_value'] = "o";
            $data['short_desc'] = "s";
            $data['long_desc'] = "l";
            
                $cvt = D('Common/Codedvalue');
                $res = $cvt->add($data);
                //$res = M('Codedvalue')->data($data)->add();
                $state=0;
            var_dump($res);
   }
}