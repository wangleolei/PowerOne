<?php
// Common（公共）方法库
// 方法规则：所有不涉及表操作的方法

// 站点功能类
// 功能：一些常用的功能

// 生成验证码 | 匹配验证码
// 功能：随机生成一个验证码 | 对验证码进行验证
function verify($code){
    if($code){
        $verify = new \Think\Verify();
        return $verify->check($code);
    }
    else
    {
        $verify = new \Think\Verify();
        $verify->codeSet  = "0123456789";
        $verify->fontSize = "18px";
        $verify->imageH   = "40";
        $verify->length   = "4";
        $verify->useCurve = false;
        $verify->useNoise = false;
        $verify->entry();

    }
}


// 获取数据类
// 功能：输入0个或多个变量，得到特定的数据
// 
// 该类方法目录
// get_client_os 系统获取
// 

// 获取访客的操作系统
// 功能：根据访客http协议获取访客操作系统
function get_client_os(){
    $Agent=$_SERVER["HTTP_USER_AGENT"];
    if(eregi("win",$Agent))
    {
        if    (eregi("nt 5.1",$Agent))$os="Win XP";
        elseif(eregi("nt 6.1",$Agent))$os="Win 7";
        elseif(eregi("nt 6.2",$Agent))$os="Win 8";
        elseif(eregi("nt 6.3",$Agent))$os="Win 8.1";
        elseif(eregi("nt 10" ,$Agent))$os="Win 10";
        elseif(eregi("32"    ,$Agent))$os="Win 32";
        else $os="Windows";
    }
    elseif(eregi("Mi",$Agent))$os="小米";
    elseif(eregi("Android",$Agent))
    {
        if    (eregi("LG"  ,$Agent))$os="LG";
        elseif(eregi("M1"  ,$Agent))$os="魅族";
        elseif(eregi("M3"  ,$Agent))$os="魅族";
        elseif(eregi("M4"  ,$Agent))$os="魅族";
        elseif(eregi("MX4" ,$Agent))$os="魅族4";
        elseif(eregi("H"   ,$Agent))$os="华为";
        elseif(eregi("vivo",$Agent))$os="Vivo";
        else $os="Android";
    }
    elseif(eregi("iPhone",$Agent))$os="苹果";
    elseif(eregi("linux" ,$Agent))$os="Linux";
    elseif(eregi("unix"  ,$Agent))$os="Unix";
    else $os="其他设备";
    return $os;
}

// os系统名称 -> 系统图标
function get_os_icon($os){
    $phone = array('小米','LG','魅族','魅族4','华为','Vivo','Android','苹果');
    if(in_array($os,$phone))return 'phone';
    else return 'blackboard';
}

// 数据转换类
// 功能：将一个数据转换成另一个数据，比如：121.35.208.107 -> 广东深圳
// 
// 类方法目录
// 
// ip_to_place              : IP        -> 地名
// timestamp_to_timeline    ：时间戳    -> 时间轴
// string_to_letter         ：字符串    -> 首字母

// IP地址       -> 实际地址  -> end in 2016/03/01
// 127.0.0.1    -> 本机地址
/* IP地址 -> 获取访客的IP */
function ip_to_place($ip,$place){
    if($ip=='127.0.0.1'||$ip=='0.0.0.0')$data = '本机地址';
    else
    {
        $ip = $place -> find($ip);
        for ($i=1;$i<count($ip);$i++){
            if($ip[$i]!=$ip[$i-1])$data = $data .$ip[$i];
        }
    }
    return $data;
}

// 时间戳                -> 数据轴      -> end in 2016/03/01
// 2015-10-10 12:10:10   -> 前天 12:10
// strtotime()：将时间格式(2015/10/10 12:11)转换为时间戳格式
function timestamp_to_timeline($time,$type){
    if($type)$time = strtotime($time);
    $day = floor((time() - strtotime(date('Y/m/d 00:00:00',$time)))/3600/24);
    if($day>2){
        $year = date('Y') - date('Y',$time);
        if($year)return date('Y/m/d H:i',$time);
        else return date('m/d H:i',$time);break;
    }
    else
    {
        switch($day){
            case  1 : return date('昨天 H:i',$time);break;
            case  2 : return date('前天 H:i',$time);break;
            default :
            {
                $min        = floor((time()-$time)/60);
                $h          = floor($min/60);
                if($h)       return $h.'小时前';
                elseif($min) return $min.'分钟前';
                else         return '刚刚';
            }
        }
    }
}

// 发送邮件
// 参数 $to收件人 $title邮件标题 $content邮件内容
// ParameterController 使用
// www.thinkphp.cn/extend/273.html
function send_mail($to,$title,$content){ 
//    $data = M('parameter') -> where('pa_class=3') -> select();
    $cvt = D('Common/Codedvalue');
    $cvt1003 = $cvt->getdescbyindex($control_code,1003);
    for($i=0;$i<count($cvt1003);$i++){
        $parameter[$cvt1003[$i]['short_desc']] = $cvt1003[$i]['long_desc'];
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
        if ($to) $mail->AddAddress($to);
        else $mail->AddAddress($parameter['email_to']);
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
//随机字符生成
function randomkeys($length) {
    $returnStr='';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
    for($i = 0; $i < $length; $i ++) {
        $returnStr .= $pattern {mt_rand ( 0, 61 )}; //生成php随机数
    }
    return $returnStr;
}
//从记录集中取出二维数组中 其中一列：PHP 5.5+ 是系统自带函数
//array_column(array,column_key,index_key);  
//array 必需。指定要使用的多维数组（记录集）。
//column_key  必需。需要返回值的列。可以是索引数组的列的整数索引，或者是关联数组的列的字符串键值。该参数也可以是 NULL，此时将返回整个数组（配合index_key 参数来重置数组键的时候，非常管用）。
//index_key   可选。作为返回数组的索引/键的列。
function array_column($input, $columnKey, $indexKey = NULL)   {     $columnKeyIsNumber = (is_numeric($columnKey)) ? TRUE : FALSE;     $indexKeyIsNull = (is_null($indexKey)) ? TRUE : FALSE;     $indexKeyIsNumber = (is_numeric($indexKey)) ? TRUE : FALSE;     $result = array();       foreach ((array)$input AS $key => $row)     {        if ($columnKeyIsNumber)       {         $tmp = array_slice($row, $columnKey, 1);         $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : NULL;       }       else      {         $tmp = isset($row[$columnKey]) ? $row[$columnKey] : NULL;       }       if ( ! $indexKeyIsNull)       {         if ($indexKeyIsNumber)         {           $key = array_slice($row, $indexKey, 1);           $key = (is_array($key) && ! empty($key)) ? current($key) : NULL;           $key = is_null($key) ? 0 : $key;         }         else        {           $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;         }       }         $result[$key] = $tmp;     }       return $result;   } 

//

