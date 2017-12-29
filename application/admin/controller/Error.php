<?php
namespace app\admin\controller;
use think\Request

class Error
{
    public function _empty(Request $request)
    {
        $c = $request->controller();
        return ' 您当前访问的: ' . $c . '地址不存在~';
    }
}