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
/***************************yzw手机短信****************************/
use app\ydemo\Rest;
use app\ydemo\PHPMailer;
use app\ydemo\Exception;
// 应用公共文件
//function sendTemplateSMS($to, $datas, $tempId)
//{
//    $accountSid = '8aaf07086077a6e60160a0578728144a';
//
//    //主帐号Token
//    $accountToken = '554af18cf59a49aa8a519741d5858e90';
//
//    //应用Id
//    $appId = '8aaf07086077a6e60160a05787771450';
//
//    //请求地址，格式如下，不需要写https://
//    $serverIP = 'app.cloopen.com';
//
//    //请求端口
//    $serverPort = '8883';
//
//    //REST版本号
//    $softVersion = '2013-12-26';
//
//    // 初始化REST SDK
//    $rest = new Rest($serverIP, $serverPort, $softVersion);
//    $rest->setAccount($accountSid, $accountToken);
//    $rest->setAppId($appId);
//
//    // 发送模板短信
//    echo "Sending TemplateSMS to $to <br/>";
//    $result = $rest->sendTemplateSMS($to, $datas, $tempId);
////    if ($result == NULL) {
////        echo "result error!";
////
////    }
////    if ($result->statusCode != 0) {
////        echo "error code :" . $result->statusCode . "<br>";
////        echo "error msg :" . $result->statusMsg . "<br>";
////        //TODO 添加错误处理逻辑
////    } else {
////        echo "Sendind TemplateSMS success!<br/>";
////        // 获取返回信息
////        $smsmessage = $result->TemplateSMS;
////        echo "dateCreated:" . $smsmessage->dateCreated . "<br/>";
////        echo "smsMessageSid:" . $smsmessage->smsMessageSid . "<br/>";
////        //TODO 添加成功处理逻辑
////    }
//}
/********************************qq登录*******************************************/
/************************************邮箱登录**********************************************/
//function sendMail($email){
//    $mail = new PHPMailer(); //建立邮件发送类
//    $mail->CharSet = "UTF-8";
//    $address ="yinzhanwei1008@163.com";
//    $mail->IsSMTP(); // 使用SMTP方式发送
//    $mail->Host = "smtp.163.com"; // 您的企业邮局域名
//    $mail->SMTPAuth = true; // 启用SMTP验证功能
//    $mail->Username = "yinzhanwei1008@163.com"; // 邮局用户名(请填写完整的email地址)
//    $mail->Password = "yinzhanwei123"; // 邮局密码
//    $mail->Port=25;
//    $mail->From = "yinzhanwei1008@163.com"; //邮件发送者email地址
//    $mail->FromName = "波课";
//    $mail->AddAddress($email, "title");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
//    //$mail->AddReplyTo("", "");
//
//    //$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
//    $mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
//
//    $mail->Subject = "您的验证码是:"; //邮件标题
//    $mail->Body = "895652"; //邮件内容，上面设置HTML，则可以是HTML
//
//    if(!$mail->Send())
//    {
//        echo "邮件发送失败. <p>";
//        echo "错误原因: " . $mail->ErrorInfo;
//        exit;
//    }else{
//
//        return '邮箱发送成功';
//
//    }
//}