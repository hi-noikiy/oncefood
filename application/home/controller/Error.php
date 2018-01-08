<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class Error extends Controller
{

    public function _empty(Request $request)
    {
         $c = $request->controller();

        // return ' 您当前访问的: ' . $c . '地址不存在~';
        return view('admin@Error/404');
    }
}
