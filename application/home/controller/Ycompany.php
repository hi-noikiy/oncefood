<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Session;

class Ycompany extends Controller
{
    /**
     * 显示商户列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //改成session获取指定用户的id
//        这个获取用户
        $cid = Session::get('cid');
//        var_dump($cid);die;
        $yshop = Db::name('yshop')->field('id,username,name,tel,address')->where(['cid' => $cid])->select();
//        var_dump($yshop);die;
        //显示店铺信息
        return view('home@ycompany/index',[
            'title'=>'商户列表',
            'yshop' => $yshop
        ]);
    }

    /**
     * 显示创建商户表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
        return view('home@ycompany/shop',[
            'title' => '添加店铺'
        ]);
    }

    /**
     * 保存新建的商铺
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
        if (!Request::instance()->isPost()){
            $this->error('你好像迷路了');
        }
        $p = $request->post();
        $cid = Session::get('cid');
        $data =[
            'username' => $p['username'],
            'name' => $p['name'],
            'pwd' => md5($p['pwd']),
            'tel' => $p['tel'],
            'address' => $p['address'],
            'status'=>$p['status'],
            'cid' => $cid
        ];
        if ($p['rpwd'] != $p['pwd']){
            $this->error('密码不一致');
        }
        $yshop = Db::name('yshop')->data($data)->insert();
        if ($yshop > 0){
            $this->success('添加商铺成功','home/ycompany/index');
        }else{
            $this->error('修改失败');
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        if(!Request::instance()->isAjax()){
                $this->error('你迷路老人');
            }
        $yshop = Db::name('yshop')->field('id,name,username,tel,address')->find($id);
        //        var_dump($ynode);die;
        if($yshop){
        $info['status'] = true;
        $info['info'] = '修改ID为'.$id.'的数据';
        $info['data'] = $yshop;


        }else{
            $info['status'] = false;
            $info['info'] = '查无此节点';
            $info['data'] = '没有数据';
        }
        return json($info);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
        if(!Request::instance()->isPut()){
            $this->error('迷路了');
        }
        $p = $request->put();
//        var_dump($p);die;
        $data = [
            'username' => $p['username'],
            'name' => $p['name'],
            'tel' => $p['tel'],
            'address' => $p['address'],
        ];
        $yshop = Db::name('yshop')->where(['id'=>$p['id']])->update($data);
        if($yshop > 0){
            $this->success('修改成功','home/ycompany/index');
        }else{
            $this->error('修改失败');
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        ////查看是不是ajax传送
        if(!Request::instance()->isAjax()){
            $this->error('你迷路了');
        }
        $yshop = Db::name('yshop')->delete($id);
        if($yshop > 0){
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = 'ID'.$id.'删除成功';
        }else{
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = 'ID'.$id.'删除失败';
        }
        return json($info);
    }
}
