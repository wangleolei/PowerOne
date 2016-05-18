<?php
// Home 方法库
// 方法规则：Home下所有涉及表操作及Home视图的添加CSS的方法
// 排序方式：字母 A->Z 排序
// 

// 修饰评论数据
// 参数 $data 评论原始参数 $place 实例化的IP类
// get_comment() get_comment_replay() 使用
function change_comment($data,$place){
    for($i=0; $i < count($data); $i++){
        switch ($data[$i]['co_user_type']){
            case 1:
            case 2:
            {
                $user = M('user') -> where('us_id='.$data[$i]['co_user']) -> find();
                $data[$i]['co_nickname'] = $user['us_nickname'];
                $data[$i]['co_portrait'] = $user['us_portrait'];
                break;
            }
            default:
            {
                $user = M('useradmin') -> where('ad_id='.$data[$i]['co_user']) -> find();
                $data[$i]['co_nickname'] = $user['ad_nickname'];
                $data[$i]['co_portrait'] = $user['ad_portrait'];
                break;
            }
        }
        unset($user);
        $data[$i]['co_place'] = ip_to_place($data[$i]['co_ip'],$place);
        $data[$i]['co_icon']  = get_os_icon($data[$i]['co_os']);
    }
    return $data;
}

// 修饰心情数据
// 参数 $data 心情原始数据 $place 实例化的IP类
// newsController 使用
function change_news($data,$place){
    for($i=0; $i < count($data); $i++) {
        $data[$i]['no_place'] = ip_to_place($data[$i]['no_ip'],$place);
        $user = M('useradmin') -> where('ad_id='.$data[$i]['no_user']) -> find();
        $data[$i]['no_portrait'] = $user['ad_portrait'];
        $data[$i]['no_nickname'] = $user['ad_nickname'];
        $data[$i]['no_icon']     = get_os_icon($data[$i]['no_os']);
        unset($user);
    }
    return $data;
}

// 根据ID获取文章类别的标题
// 参数 $id 文章类别的ID
// ArticleController 、IndexController 使用
function get_class_title($id){
    return M('Articleclass') -> where('ar_class='.$id) -> getField('ar_c_title');
}

// 获取评论回执
// 参数　$id 评论ID [$state 评论状态]
// change_comment() 使用
function get_comment_replay($id,$state){
    $where['co_type'] = 3;
    if($state)$where['co_state'] = $state;
    $where['co_type_to'] = $id;
    return M('comment') -> where($where) -> order('co_time desc') -> select();
}

// 获取系统设置参数
// 参数：$class 参数类型ID
// CommonController 使用
function get_parameter($class){
//    $parameter = M('parameter') -> where('pa_class='.$class) -> select();
    for($i=0;$i<count($parameter);$i++){
        $return[$parameter[$i]['pa_attribute']] = $parameter[$i]['pa_value'];
    }
    return $return;
}

// 发送邮件
// 参数 $to收件人 $title邮件标题 $content邮件内容
// ToolController 使用
function sendMail($to,$title,$content){
    $parameter = get_parameter(3);
    if($parameter['email_is']=='true'){
        vendor('phpmailer.class#phpmailer');
        $mail = new phpmailer();
        $mail->IsSMTP();
        $mail->Host     = $parameter['email_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $parameter['email_username'];
        $mail->Password = $parameter['email_password'];
        $mail->FromName = $parameter['email_name'];
        $mail->IsHTML(true);
        $mail->CharSet  = 'utf-8';
        $mail->From     = $parameter['email_from'];
        $mail->AddAddress($to);
        $mail->Subject  = $title;
        $mail->Body     = $content;
        return($mail->Send());
    }
}

// 更新qquser数据
// 参数：$qquser 登陆QQ后的qq头像qq昵称
// CommonController 使用
function update_user($user){
    $where['us_portrait'] = $user['us_portrait'];
    $record = M('user') -> where($where) -> find();
    if($record){
        $save['us_last_time'] = time();
        $save['us_last_ip']   = $user['us_last_ip'];
        $save['us_last_os']   = $user['us_last_os'];
        $save['us_login_sum'] = $record['us_login_sum']+1;
        M('user') -> where('us_id='.$record['us_id']) -> save($save);
    }
    else
    {
        $save['us_type']      = 2;
        $save['us_last_time'] = time();
        $save['us_nickname']  = $user['us_nickname'];
        $save['us_portrait']  = $user['us_portrait'];
        M('user') -> where('us_id='.$user['us_id']) -> save($save);
    }
}


// 无使用待删除方法

// 获取评论
// 参数 [$state 评论状态] [$type 评论类型默认1] [$to 对应类型ID]
function get_comment($state,$type,$to){
    if($state)$where['co_state'] = $state;
    if($type)$where['co_type'] = $type;
    else $where['co_type'] = 1;
    if($to)$where['co_type_to'] = $to;
    $data = M('comment') -> where($where) -> order('co_time desc') -> select();
    return change_comment($data);
}