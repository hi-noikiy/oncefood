<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use think\Db;

class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        return view('home@index/index',[
            'title'=>'登录注册页'
        ]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //看是否是post请求
        if(!Request::instance()->isPost()){
            $this->error('其实我想做个弹框告诉你迷路了');
        }
        $p = $request->post();
        $data = [
            'name' => $p['name'],
            'tel' => $p['tel'],
            'qq' => $p['qq'],
            'email' => $p['email'],
            'address' => $p['address'],
            'pwd' => md5($p['pwd']),
            'status' => 1,
            'display' => 1
        ];
//        var_dump($data);die;
        if($p['rpwd'] !=$p['pwd']){
            $this->error('两次密码不一致');
        }
        $company = Db::name('company')->data($data)->insert();

//        return json($company);
        if ($company > 0){
            $this->success('注册成功:)三个工作日内给你回复','home/login/index');
        }else{
            $this->error('注册失败');
        }

    }
    /**
     * 手机短信登录
     */
    public function phone(){

        var_dump('3333333333333');
       $data = sendTemplateSMS('18291042861',array(1234,3),1);
       var_dump('33333344444444444444444');
       var_dump($data);die;


    }
    /**
     * 登录
     */
    public function log(Request $request){
//        var_dump('2222222222');die;
        if(!Request::instance()->isPost()){
            $this->error('你迷路了');
        }
        $p = $request->post();
//        var_dump($p);die;
        $name = $p['name'];
        $pwd = md5($p['pwd']);
        $company = Db::name('company')->where(['name'=>$name,'pwd'=>$pwd])->find();
        if($company > 0){
            $this->success('登录成功','home/login/top');
        }else{
            $this->error('运行失败');
        }
    }

    public function top(){
        return view('home@top/index',[
            'title'=>'商家后台管理系统'
        ]);
    }

}
