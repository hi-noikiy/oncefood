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
        $name = Session::get('index.name');
        $nickname = Session::get('index.nickname');
        $id = Session::get('index.id');
        $list['name'] = $name;
        $list['nickname'] = $nickname;
        $list['id'] = $id;
        $banner = db('banner')->field('pic')->where('display',1)->select();
        $category = db('category')->where('pid = 0 and display = 1')->paginate(5);
        return view('index@index/index',[
        'banner' => $banner, 
        'category' => $category,
        'list' => $list
        ]);
    }

    public function delIndex(){
    	Session::delete('index');
    	$banner = db('banner')->field('pic')->where('display',1)->select();
        $category = db('category')->where('pid = 0 and display = 1')->paginate(5);

        return view('index@index/index',[
        'banner' => $banner, 
        'category' => $category
        ]);
    }
}
