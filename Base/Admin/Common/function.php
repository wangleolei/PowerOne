<?php
// Admin 方法库
// 方法规则：Admin下所有涉及表操作及Home视图的添加CSS的方法
// 排序方式：字母 A->Z 排序
// 

// 根据ID获得栏目名称
// 参数 $id 栏目的ID
// View\Article\article_list.html 使用
function get_class_name($id){
    return M('Articleclass') -> where('ar_class='.$id) -> getField('ar_c_title');
}

// 获取文本中的图片路径
// 参数 $content 文本内容 $cut 图片裁剪大小
// ArticleController 、 NoticeController 使用
function get_string_img($content,$cut){
    preg_match("/\<img.*?src\=\"(.*?)\"[^>]*>/i",$content,$img);
    if($img[1]){
        if($cut){
            $img[1] = substr($img[1],9);
            $array = explode('/',$img[1]);
            $thumb = '/upload/image/thumb/'.$array[count($array)-1];
            $image = new \Think\Image();
            $image -> open('.'.$img[1]);
            $image -> thumb($cut['width'],$cut['height'],6)->save('.'.$thumb);
            return '/powerone'.$thumb;
        }
        else return $img[1];
    }
    else return '/powerone/upload/image/system/thumb'.rand(1,20).'.jpg';
}

// 发送邮件
// 参数 $to收件人 $title邮件标题 $content邮件内容
// ParameterController 使用
function sendMail($to,$title,$content){
//    $data = M('parameter') -> where('pa_class=3') -> select();
    for($i=0;$i<count($data);$i++){
        $parameter[$data[$i]['pa_attribute']] = $data[$i]['pa_value'];
    }
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
    else
    {
        echo '邮件功能尚未打开！';
        return false;
    }
}

// 上传文件
// 参数 $name 上传input的name $cut 图片裁剪大小
// ArticleController 、 ParameterController 使用
function upload_file($name,$cut){
    $config = array(
        'maxSize'    =>    1048576,
        'savePath'   =>    'image/',
        'saveName'   =>    time().$name,
        'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
        'autoSub'    =>    true,
        'subName'    =>    array('date','Ymd'),
        );
    $upload = new \Think\Upload($config);
    $info   = $upload->upload();
    if($info){
        $data = $upload->rootPath;
        $data = '/'.$data.$info['upload'.$name]['savepath'].$info['upload'.$name]['savename'];
//        if($cut){
            $image = new \Think\Image();
            $image -> open('.'.$data);
            $image -> thumb($cut['width'],$cut['height'],6)->save('.'.$data);
        //}
        return $data;
    }
    else return false;
}

// 更新管理员登陆信息
// 参数 $id 登陆的管理员的ID
// AuthController 使用
function update_login($id){
    $save['ad_last_time'] = time();
    $save['ad_last_ip']   = get_client_ip();
    $save['ad_last_os']   = get_client_os();
    M('useradmin') -> where('ad_id='.$id) -> save($save);
}