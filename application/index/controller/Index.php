<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Db;

class Index extends Controller
{
    public function index()
    {	
        // 存session获取html样式标准,以及分类遍历
        $name = Session::get('index.name');
        $nickname = Session::get('index.nickname');
        $id = Session::get('index.id');
        $list['name'] = $name;
        $list['nickname'] = $nickname;
        $list['id'] = $id;
        $banner = db('banner')->field('pic')->where('display',1)->select();
        $category = db('category')->where('pid = 0 and display = 1')->paginate(5);
        $hot = db('yshop_show')->field('sid,icon,comment')->where('face = 1 and status = 1')->select();
        return view('index@index/index',[
        'banner' => $banner, 
        'category' => $category,
        'list' => $list, 
        'hot' => $hot
        ]);
    }

    public function delIndex(){
        // 删除session页面不显示登录样式
    	Session::delete('index');
    	$banner = db('banner')->field('pic')->where('display',1)->select();
        $category = db('category')->where('pid = 0 and display = 1')->paginate(5);

        return view('index@index/index',[
        'banner' => $banner, 
        'category' => $category
        ]);
    }
}
