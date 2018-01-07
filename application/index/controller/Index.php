<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Db;

class Index extends IndexBase
{
    public function index()
    {	
        
        $banner = db('banner')->field('pic')->where('display',1)->select();
        $category = db('category')->where('pid = 0 and display = 1')->paginate(5);
        $hot = db('yshop_show')->field('sid,icon,comment')->where('face = 1 and status = 1')->select();

        return view('index@index/index',[
        'banner' => $banner, 
        'category' => $category,
        'hot' => $hot
        ]);
    }

}
