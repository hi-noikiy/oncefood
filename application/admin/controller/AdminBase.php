<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;

class AdminBase extends controller
{
    private $Request;
    private $Contr;
    private $Model;
    private $Func;


    public function _initialize()
    {   
        // 获取当前的用户访问的控制器、模型、方法;
        $this->Request = \think\Request::instance();
        $this->Contr = $this->Request->controller();
        $this->Func = $this->Request->action();
        $this->Model = $this->Request->module();
        $user = Session::get('user');

        // 判断是否有session;
        if (empty($user)) {
            return $this->redirect('admin/index/index');
        }

        // 判断用户是否为超级管理员
        if ( $user != 'admin') {
            // 提取Session数据;
            $mname = Session::get('UserJur');
            foreach ($mname as  $v) {
                $A[] = $v['mname'];
                $B[] = explode(',', $v['aname']);
            }
            $Acl = array_combine($A,$B);
            
            
            // var_dump($this->Contr);die;

            // 判断用户请求的控制器是否在Acl里
            if (empty($Acl[$this->Contr]) || !in_array($this->Func,$Acl[$this->Contr])) {
               $this->error("抱歉！没有操作权限！");

            }

        }
            
    }

    public function _empty(Request $request)
    {
        $a = $request->action();
        // $a = $request->action();
        // return ' 您当前访问的: ' . $a . '页面不存在~';
        return view('admin@Error/404');

    }
}