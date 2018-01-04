<?php
namespace app\index\controller;

use think\controller;
use think\Db;

class Index 
{
    public function index()
    {
        $banner = db('banner')->field('pic')->where('display',1)->select();
        $category = db('category')->where('pid = 0 and display = 1')->paginate(5);
        return view('index@index/index',[
            'banner' => $banner, 
            'category' => $category
        ]);
    }
}
