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

    

}