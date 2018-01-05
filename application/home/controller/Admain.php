<?php
namespace app\home\controller;


use think\Controller;
use think\Request;
use think\Session;

class Admain extends Controller
{
    public function _initialize()
    {
        if (empty(Session::get('home_username'))){
            $this->redirect('home/login/index');
        }

    }
//    判断空方法
    public function _empty(Request $request)
    {
        $m = $request->action();
        return view('admin@Error/404');
    }
}