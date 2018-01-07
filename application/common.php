<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

use app\demo\Rest;
use app\demo\PHPMailer;

/**
 * @param $to 手机号
 * @param $datas 数组('字符串',有效时间)
 * @param $tempId 模板样式免费的只能用默认1;
 * @return mixed
 */
function sendTemplateSMS($to,$datas,$tempId)
{
    //主帐号
    $accountSid= '8aaf07085f14963d015f14e9623f0122';

//主帐号Token
    $accountToken= '014530e5c5d64c05a7369883f1b9e4dd';

//应用Id
    $appId='8aaf07085f14963d015f14e9628e0128';

//请求地址，格式如下，不需要写https://
    $serverIP='app.cloopen.com';

//请求端口
    $serverPort='8883';

//REST版本号
    $softVersion='2013-12-26';
    // 初始化REST SDK
//    global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
    $rest = new Rest($serverIP,$serverPort,$softVersion);
    $rest->setAccount($accountSid,$accountToken);
    $rest->setAppId($appId);

    // 发送模板短信
    // echo "Sending TemplateSMS to $to <br/>";
    $result = $rest->sendTemplateSMS($to,$datas,$tempId);
    return $result;
}


function randCode()
{
     $chars = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPRSTUVWXYZ23456789';         //需要用到的验证码字符，如需更多请自行添加
        /* 随机生成4位字符的验证码字符 */
        $randCode = '';
        for ( $i = 0; $i < 10; $i++ ){
            $randCode.= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $randCode;
}

function randsCode()
{
     $chars = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPRSTUVWXYZ23456789';         //需要用到的验证码字符，如需更多请自行添加
        /* 随机生成4位字符的验证码字符 */
        $randCode = '';
        for ( $i = 0; $i < 4; $i++ ){
            $randCode.= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $randCode;
}


function https_request($url)
{
    // 初始化
    $ch = curl_init();
    // 设置
    curl_setopt($ch,CURLOPT_URL,$url);
    // 检查ssl证书
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
    // 从检查本地证书检查是否ssl加密
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,$url);

    // 判断$data 判断是否post
    // 返回结果 是文件流的方式返回
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $res = curl_exec($ch);
    curl_close($ch); // close curl res
    return $res;
}

//QQ 登录
function forQQ($code)
{
    $token_url = 'https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=101448051&client_secret=64e74ebc83a1b0c0f6647ba23c0d2bcf&code='.$code.'&state=s68&redirect_uri=http://tp5.com/index/Login/qqLogin';
    $token_res = https_request($token_url);
    $data = explode('&', $token_res);
    $data = explode('=', $data[0]);
    $token = $data[1];
    $openid_url = 'https://graph.qq.com/oauth2.0/me?access_token='.$token;
    $openid_res = https_request($openid_url);
    if (strpos($openid_res, "callback") !== false)
    {
        $lpos = strpos($openid_res, "(");
        $rpos = strrpos($openid_res, ")");
        $openid_res  = substr($openid_res, $lpos + 1, $rpos - $lpos -1);
        $msg = json_decode($openid_res,true);
    }
    $openid = $msg['openid'];
    $userinfo_url = 'https://graph.qq.com/user/get_user_info?access_token='.$token.'&oauth_consumer_key=101448051&openid='.$openid;
    $info = json_decode(https_request($userinfo_url),true);
    $QQ['token'] = $token;
    $QQ['nickname']   = $info['nickname'];
    return $QQ;
}

function qqemail($rand,$msg){
    
    // require("class.phpmailer.php"); //这个是一个smtp的php文档，网上可以下载得到
    
    $mail = new PHPMailer(); //建立邮件发送类
    $mail->CharSet = "UTF-8";
    $address ="676499058@qq.com";
    $mail->IsSMTP(); // 使用SMTP方式发送
    $mail->Host = "smtp.qq.com"; // 您的企业邮局域名
    $mail->SMTPAuth = true; // 启用SMTP验证功能
    $mail->Username = "676499058@qq.com"; // 邮局用户名(请填写完整的email地址)
    $mail->Password = "bwhhdaaxahzqbccg"; // 邮局密码
    $mail->Port=587;
    $mail->From = "676499058@qq.com"; //邮件发送者email地址
    $mail->FromName = "验证码";
    $mail->AddAddress($msg, "title");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")

    //$mail->AddReplyTo("", "");

    //$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
    $mail->IsHTML(true); // set email format to HTML //是否使用HTML格式

    $mail->Subject = "您的验证码是:"; //邮件标题

    $mail->Body = $rand; //邮件内容，上面设置HTML，则可以是HTML

    if(!$mail->Send())
    {
        echo "邮件发送失败. <p>";
       echo "错误原因: " . $mail->ErrorInfo;
       exit;
    }else{

    return 'aaa';

    }

}




