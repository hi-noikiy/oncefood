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