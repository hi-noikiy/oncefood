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
//图片的资源路由
//Route::resource('home/upload','home/banner');
//前台商铺中心的资源路由
Route::get('shop/:id','home/Banner/index');
Route::post('save','home/Banner/save');
//登录界面的资源路由
Route::resource('login','home/Login');
//商家后台ycompany的路由
Route::resource('home/ycompany','home/Ycompany');
/**********修改商铺状态的路由************/
Route::post('up','home/ycompany/updateSave');
//     展示详细信息
Route::post('show','home/ycompany/showUpdate');
Route::post('edit','home/ycompany/saveUpdate');
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
 * 注册页面路由 ZMJ
 */

Route::resource('reg','index/Register');

Route::get('getMessage','index/Register/getMsg');

Route::post('check','index/Register/check');
Route::get('email','index/Register/email');

/**
 * 登录页面路由
 */
Route::resource('login','index/login');
Route::get('log','index/login/login');
/**
 * 忘记密码路由
 */ 
Route::rule('login/spwd','index/login/selectPwd');

/**
 * 个人中心路由
 */
Route::resource('personal','index/personal');

/************************************************/
/**
 * 后台默认静态路由 wwb
 */
Route::get('admin','admin/index/index');
Route::get('getMsg','admin/main/getMsg');
Route::get('getEmail','admin/main/getEmail');

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
Route::post('UpRole','admin/rabc/UpRole');
Route::resource('Rabc','admin/Rabc');

/**
 * 角色管理路由
 */

Route::post('UpNode','admin/Role/UpdataNode');
Route::resource('Role','admin/Role');

/**
 * 权限管理路由
 */
Route::resource('Jur','admin/Jur');

/**
 * 商户管理路由
 */
Route::resource('Mer','admin/Merchant');

/**
 * 店铺管理路由
 */
Route::resource('Shops','admin/Shops');

/**
 * 店铺属性路由
 */
Route::resource('Attr','admin/ShopAttr');

/**
 * 栏目管理路由
 */
Route::resource('Column','admin/Column');

/**
 * 空路由
 */
Route::get(':name','admin/error/_empty', ['name' => '\w+']);

