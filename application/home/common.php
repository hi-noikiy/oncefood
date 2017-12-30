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
// 应用公共文件
function sendTemplateSMS($to, $datas, $tempId)
{
    $accountSid = '8aaf07086077a6e60160a0578728144a';

    //主帐号Token
    $accountToken = '554af18cf59a49aa8a519741d5858e90';

    //应用Id
    $appId = '8aaf07086077a6e60160a05787771450';

    //请求地址，格式如下，不需要写https://
    $serverIP = 'app.cloopen.com';

    //请求端口
    $serverPort = '8883';

    //REST版本号
    $softVersion = '2013-12-26';

    // 初始化REST SDK
    $rest = new Rest($serverIP, $serverPort, $softVersion);
    $rest->setAccount($accountSid, $accountToken);
    $rest->setAppId($appId);

    // 发送模板短信
    echo "Sending TemplateSMS to $to <br/>";
    $result = $rest->sendTemplateSMS($to, $datas, $tempId);
    if ($result == NULL) {
        echo "result error!";

    }
    if ($result->statusCode != 0) {
        echo "error code :" . $result->statusCode . "<br>";
        echo "error msg :" . $result->statusMsg . "<br>";
        //TODO 添加错误处理逻辑
    } else {
        echo "Sendind TemplateSMS success!<br/>";
        // 获取返回信息
        $smsmessage = $result->TemplateSMS;
        echo "dateCreated:" . $smsmessage->dateCreated . "<br/>";
        echo "smsMessageSid:" . $smsmessage->smsMessageSid . "<br/>";
        //TODO 添加成功处理逻辑
    }
}