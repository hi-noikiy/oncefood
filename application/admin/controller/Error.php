<?php
namespace app\admin\controller;
use think\Request;
use think\Controller;

class Error extends controller
{
    public function _empty(Request $request)
    {
        // $c = $request->controller();
        // return ' 您当前访问的: ' . $c . '地址不存在~';
         return view('admin@Error/404');
    }
}