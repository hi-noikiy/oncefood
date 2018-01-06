<?php 
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;

class Base extends controller
{
    // 不登录不能进的页面直接跳转登录页
	public function _initialize()
        {
            $id = Session::get('index.id');
            if($id == null) {
               return $this->redirect('index/login/index');
            }
        }



    

}