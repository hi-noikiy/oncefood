<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Session;
class Index
{
    public function index()
    {	
    	$name = Session::get('index.name');
    	$nickname = Session::get('index.nickname');
    	$id = Session::get('index.id');
    	$list['name'] = $name;
    	$list['nickname'] = $nickname;
    	$list['id'] = $id;
        return view('index@index/index',[
        	"list"=>$list
        	]);
    }

    public function delIndex(){
    	Session::delete('index');
    	return view('index@index/index');
    }
}
