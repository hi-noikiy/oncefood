<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Session;


class Main extends controller
{
    /**
     * 后台登录处理
     * @return \think\response\View
     */
    public function logindo(Request $Request)
    {

        // 安全验证用JS;
        $data = $Request->post();

        // if(!captcha_check($data['code'])){
        //     return '验证码输入有误!';
        // };
        // unset($data['code']);
        
        
        // 查询用户信息
        $user = Db::name('user')->where(['username' => $data['username'],'userpass' => md5($data['userpass'])])->find();

        // 将用户名存入session;
        Session::set('user',$data['username']);
        // 查询用户对应的权限信息
        $sql = 'select c.mname,group_concat(c.aname) as aname 
                from lamp_user_role a,lamp_role_node b,lamp_node c
                where a.uid = '.$user['id'].' and a.rid = b.rid and b.nid = c.id
                group by c.mname';

        $UserJur = Db::query($sql);

        // 存Session
        Session::set('UserJur',$UserJur);
        
        return $this->redirect('admin/main/index');

    }

    /**
     * 后台登出处理
     * @return \think\response\View
     */
    public function logout()
    {
        return $this->redirect('admin/index/index');
    }

    /**
     * 后台主页
     * @return \think\response\View
     */
    public function index()
    {
        if (Session::get('UserJur')) {
            return view('admin@main/index');
        }else{
            return view('admin@login/login');
        }
    }

    public function getMsg()
    {   
        $code = randCode();

        $result = sendTemplateSMS('15021343181',array($code,5),"1");
        
        if ($result) {
            $data['status'] = true;

            return json($data);
        }
        
    }

    public function getEmail()
    {
        $result = sendMail();
        if ($result['status'] == 'true') {
            return $this->success('邮件发送成功',url('admin/index/index'));
        }
            return $this->error('发送失败');
    }

}
