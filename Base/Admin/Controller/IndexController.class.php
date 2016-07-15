<?php
namespace Admin\Controller;

use Common\Controller\AuthController;

class IndexController extends AuthController {
    
    public function index(){
        // 当前页面功能名
        /*$data = M('news') -> select();
        for ($i=0; $i < count($data); $i++) {
            $where['mo_id'] = $data[$i]['mo_id'];
            $save['mo_time'] = strtotime($data[$i]['mo_time']);
            M('news') -> where($where) -> save($save);
        }*/
        /*$data = M('article1') -> select();
        for ($i=0; $i < count($data); $i++) {
            $add['ar_state']        = 1;
            $add['ar_class']        = $data[$i]['ar_class'];
            $add['ar_position']     = 2;
            $add['ar_title']        = $data[$i]['ar_title'];
            $add['ar_keywords']      = $data[$i]['ar_keywords'];
            $add['ar_description']  = $data[$i]['ar_nav'];
            $add['ar_cover_img']    = $data[$i]['ar_img'];
            if($data[$i]['ar_source'])$add['ar_source'] = $data[$i]['ar_source'];
            $add['ar_hits']         = $data[$i]['ar_see'];
            $add['ar_user']         = 1;
            $add['ar_time']         = strtotime($data[$i]['ar_time']);
            $add['ar_last_user']    = 1;
            $add['ar_last_time']    = strtotime($data[$i]['ar_over_time']);
            $addData['ar_id']   = M('article') -> add($add);
            $addData['ar_body'] = $data[$i]['ar_content'];
            M('Articledata') -> add($addData);
        }*/
        
        $this -> display();
    }

    public function uploadify()
    {   
//        if (!empty($_FILES)) {
            //import("@.ORG.UploadFile");
            //$upload = new \Org\UploadFile();
//            $upload->maxSize = 2048000;
 //           $upload->allowExts = array('jpg','jpeg','gif','png');
//            $upload->savePath = './upload/';
//            $upload->thumb = true; //设置缩略图
//            $upload->imageClassPath = "@.ORG.Image";
//            $upload->thumbPrefix = "130_,75_,24_"; //生成多张缩略图
//            $upload->thumbMaxWidth = "130,75,24";
//            $upload->thumbMaxHeight = "130,75,24";
//            $upload->saveRule = uniqid; //上传规则
//            $upload->thumbRemoveOrigin = true; //删除原图
//            $info = $upload->upload();
//            if(!$info){
//                $this->error($upload->getErrorMsg());//获取失败信息
//            } else {
//                $info = $upload->getUploadFileInfo();//获取成功信息
//            }
//            echo $info[0]['savename'];    //返回文件名给JS作回调用
            
            
//        }
//        $this->ajaxReturn($_FILES['photo']);
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg', 'bpm');// 设置附件上传类型
        $upload->saveRule = '';
        $upload->rootPath  =      './upload/test1/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传单个文件 
        $info   =   $upload->uploadOne($_FILES['test']);
        //$info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
            echo $info['savepath'].$info['savename'];
        }
        var_dump($info);
        $this->ajaxReturn($info['savepath'].$info['savename']);

    }

    

}