<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;
/**
 * yzw 商户
 */
Route::post('home/log','home/login/log');
Route::get('home/login','home/login/index');
Route::get('home/mail','home/login/mail');
Route::get('home/top','home/login/top');
Route::get(':name$','home/login/index');
//登录界面的资源路由
Route::resource('login','home/Login');
//商家后台ycompany的路由
Route::resource('home/ycompany','home/Ycompany');
//商家后台ynode的路由
Route::resource('home/ynode','home/Ynode');
Route::post('update','home/ynode/updateStatus');
//商家后台yrole的路由
Route::resource('home/yrole','home/Yrole');
Route::post('upda','home/yrole/updateStatus');
/********************************************************************/
/**
 * 前台默认路由
 */

Route::rule('/','index/index/index');
/**
 * 后台默认路由
 */
Route::get('admin','admin/index/index');

/**
 * 后台主页路由
 */
Route::resource('index','admin/main');
Route::post('logindo','admin/main/logindo');


/**
 * 分类路由
 */
Route::resource('cate','admin/Cate');

/**
 * 用户管理路由
 */
Route::post('UpRole','admin/Rabc/UpRloe');
Route::resource('Rabc','admin/Rabc');

/**
 * 角色管理路由
 */
// Route::get('node/[:id]','admin/Role/nodeList');
Route::post('UpNode','admin/Role/UpdataNode');
Route::resource('Role','admin/Role');

/**
 * 权限管理路由
 */
Route::resource('Jur','admin/Jur');




