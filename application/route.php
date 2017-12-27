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
 * 后台主页路由
 */
Route::resource('index','admin/main');

/**
 * 分类路由
 */
Route::resource('cate','admin/Cate');

/**
 * 用户管理路由
 */
Route::resource('Rbac','admin/Rabc');

/**
 * 角色管理路由
 */
Route::get('node/[:id]','admin/Role/nodeList');
Route::post('UpNode','admin/Role/UpdataNode');
Route::resource('Role','admin/Role');

/**
 * 权限管理路由
 */
Route::resource('Jur','admin/Jur');



