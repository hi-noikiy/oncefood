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
Route::get('home/top','home/login/top');
Route::get(':ydemo$','home/login/index');
Route::resource('login','home/Login');
/********************************************************************/
Route::get('home/mail','home/login/mail');
Route::get('home/top','home/login/top');
//分类
Route::get('category/:id','index/Category/index');
Route::rule('create/[:id]','index/Category/create');

Route::get('order','index/Category/order');
//评论

Route::get('com/:id','home/Comment/index');
Route::post('commit','home/comment/commit');
Route::post('status','home/comment/triggersave');
Route::post('message','home/comment/message');
Route::post('msgde','home/comment/messagedelete');
Route::post('editmessage','home/comment/editmessage');
Route::get('at/:id','home/comment/at');
Route::post('attr','home/comment/attr');

Route::resource('home/comment','home/Comment');
//图片的资源路由
//Route::resource('home/upload','home/banner');

//前台商铺中心的资源路由
Route::post('ban','home/Banner/ban');
Route::post('face','home/Banner/face');
Route::post('banner','home/Banner/updateSave');
Route::post('delete','home/Banner/delete');
Route::post('evrdelete','home/Banner/evrdelete');
Route::get('shop/:id','home/Banner/index');
//轮播图上传
Route::get('up/:id','home/Banner/read');
//室内环境上传
Route::get('evr/:id','home/Banner/create');
//轮播图插入数据库
Route::post('save','home/Banner/save');
//室内环境
Route::post('envir','home/Banner/evrsave');

//登录界面的资源路由
Route::resource('login','home/Login');
//商家后台ycompany的路由
Route::resource('home/ycompany','home/Ycompany');
Route::get('getCates/[:id]','home/Ycompany/getCates');
Route::get('getCate','home/Ycompany/getCate');
/**********修改商铺状态的路由************/
Route::post('up','home/ycompany/updateSave');
//展示详细信息
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
 * 后台默认静态路由
 */
Route::get('admin','admin/index/index');

/**
 * 注册页面路由 ZMJ
 */

Route::resource('reg','index/Register');

Route::get('getMessage','index/Register/getMsg');

Route::post('check','index/Register/check');
Route::get('email','index/Register/email');
Route::get('checkname','index/Register/checkname');
Route::get('checktel','index/Register/checktel');
Route::get('checkemail','index/Register/checkemail');
Route::get('selecttel','index/Register/selectTel');
Route::get('selectemail','index/Register/selectEmail');
/**
 * 登录页面路由
 */
Route::resource('index/login','index/login');
Route::post('log','index/login/login');
// 退出登录的路由
Route::get('delIndex','index/index/delIndex');
/**
 * 忘记密码路由
 */ 
Route::rule('login/spwd','index/login/selectPwd');
Route::get('findname','index/login/findName');
Route::get('sendtel','index/login/email');
Route::get('findtel','index/login/findEmail');
Route::get('composer','index/login/tel');

Route::get('returnpass/:tel','index/login/returnpass');

Route::get('changepwd','index/login/changepwd');
Route::post('indexpwd','index/login/indexpwd');
/**
 * 个人中心路由
 */
Route::resource('personal','index/personal');
Route::post('personalSave','index/Personal/savee');
// 修改密码路由

Route::get('pwdhtml','index/Personal/pwdhtml');
Route::post('savepwd','index/Personal/savepwd');
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
// Route::get('node/[:id]','admin/Role/nodeList');
Route::post('UpNode','admin/Role/UpdataNode');
Route::resource('Role','admin/Role');

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
Route::get('GoHot/[:id]','admin/Shops/hot');
/**
 * 店铺属性路由
 */
Route::resource('Attr','admin/ShopAttr');

/**
 * 栏目管理路由
 */
Route::resource('Column','admin/Column');

/**
 * 热门编辑路由
 */
Route::resource('HotShop','admin/HotShop');
Route::get('UpHot/[:id]','admin/HotShop/UpHot');
/**
 * 空路由
 */
Route::get(':name','admin/error/_empty', ['name' => '\w+']);

