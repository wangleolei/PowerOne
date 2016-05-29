<?php
namespace Common\Controller;

use Think\Controller;

class CommonController extends Controller{
    // 自动加载函数
    public function _initialize(){
        $control_code = cookie('control_code'); 
        if ($control_code != '58' && $control_code != '98') {
            cookie('control_code','58',3600); // 指定cookie保存时间
        }
        if(I('get.l') == 'zh-cn') cookie('control_code','58',3600); // 指定cookie保存时间
        if(I('get.l') == 'en-us') cookie('control_code','98',3600); // 指定cookie保存时间
        $control_code = cookie('control_code'); 
        /****************** 记录登录状态 ******************/ 
        // 1：是否用用户记录，有则第2步，无则第3步
        // 2：是否有get code记录，有则获取登陆QQ，更新用户记录，无则结束判断
        // 3：获取用户信息存入
        if(session('home.user')){
            $user   = session('home.user');
            if(I('get.code')){
                $Qlogin = new \Org\Toilove\Qlogin(C('QQ_APP_ID'),C('QQ_APP_KEY'),C('QQ_APP_URL'));
                $info   = $Qlogin -> get_info();
                $user['us_nickname'] = $info['nickname'];
                $user['us_portrait'] = $info['figureurl_qq_2'];
                $user['us_login_on'] = true;
                session('home.user',$user);
                update_user($user);
                $this -> redirect('/');
            }
        }
        else
        {
            $where['us_last_ip'] = get_client_ip();
            $user = M('user') -> where($where) -> order('us_last_time desc') -> find();
            if($user)M('user') -> where($where) -> setInc('us_login_sum');
            else
            {
                $user['us_type'] = 1;
                $user['us_add_time'] = time();
                $user['us_last_ip']  = $where['us_last_ip'];
                $user['us_last_os']  = get_client_os();
                $user['us_id']       = M('user') -> add($user);
            }
            session('home.user',$user);
        }
        $this -> assign('user',$user);
        // 获得站点属性
        $site            = get_parameter(1);
        $site['on_year'] = date('Y');
        $this -> assign('site',$site);
        // 公告数据
        $notice = M('notice') -> where('no_type=2') -> order('no_time desc') -> find();
        $this -> assign('notice',$notice);
        // 右侧 box
        // 推荐文章、点击排行、最新发布
        $where['ar_state'] = 1;
        $right['box']['hits'] = M('article')->where($where)->order('ar_hits desc')->limit(9)->field('ar_id,ar_title,ar_cover_img')->select();
        $right['box']['time'] = M('article')->where($where)->order('ar_time desc')->limit(9)->field('ar_id,ar_title,ar_cover_img')->select();
        $where['ar_position'] = array('in','1,3');
        $right['box']['recom']= M('article')->where($where)->order('ar_time desc')->limit(9)->field('ar_id,ar_title,ar_cover_img')->select();
        // 友情链接
        $right['link'] = M('link')->where('li_state=1')->order('li_time asc')->field('li_url,li_title')->select();
        $this -> assign('right',$right);
        // 当前页面
        switch (__SELF__) {
            case U('/')         : $on_url['index']    = 'class="now"';break;
            case U('/news')     : $on_url['news']     = 'class="now"';break;
            case U('/articles/1') : $on_url['articles/1'] = 'class="now"';break;
            case U('/articles/2') : $on_url['articles/2'] = 'class="now"';break;
            case U('/comment')  : $on_url['comment']  = 'class="now"';break;
        }
        $this -> assign('on_url',$on_url);
        // 
        //var_dump(__SELF__);
        // 实例化coded value
        $cvt = D('Common/Codedvalue');
        //system url
        //$cvt1001 =  $cvt->getshortbyindex(58,1001);
        //$this->assign('cvt1001',$cvt1001);
        //电脑菜单CVT10000
        $cvt10000 = $cvt->getdescbyindex($control_code,10000);
        $numbers = count($cvt10000);
        for ($i=0; $i < $numbers ; $i++) { //电脑菜单二级菜单，要求主菜单int and sort从1到10顺序增加
            $cvt10002 = $cvt->getdescbyint($control_code,10002,$i+1);
            if($cvt10002) $cvt10000[$i]['cvt10002'] = $cvt10002;
        }
        
        $this->assign('cvt10000',$cvt10000);
        //手机菜单CVT10001
        $cvt10001 = $cvt->getlast3byindex($control_code,10001);
        for ($i=0; $cvt10001[$i] ; $i++) { 
             if ($cvt10001[$i]['long_desc'] != __SELF__) {
                 $cvt10001[$i]['oth_value'] = "";
             }
         }
/*        foreach($cvt10001 as $key=>$value){
            if(__SELF__ == $value['long_desc']){
                $value['oth_value'] = "now";
                var_dump($cvt10001);
            }
        }
*/        
        $this->assign('cvt10001',$cvt10001);
    }
    /**************************************************************/
}