<?php
namespace app\home\controller;


use think\Controller;
use think\Session;

class Admain extends Controller
{
    public function _initialize()
    {
        if (empty(Session::get('home_username'))){
            $this->redirect('home/login/index');
        }

    }
}