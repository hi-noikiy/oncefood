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
 * 前台默认路由
 */

Route::rule('/','index/index/index');


/**
 * 后台默认静态路由
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