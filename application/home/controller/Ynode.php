<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use think\Db;

class Ynode extends Admain
{
    /**
     * 显示所有节点列表列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $ynode = Db::name('ynode')->order('id desc')->select();
//        var_dump($ynode);die;
        return view('home@ynode/index',[
            'title' => '节点管理',
            'ynode' => $ynode
        ]);
    }

    /**
     * 显示创建节点表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
        return view('home@ynode/node_add',[
            'title' => '节点添加'
        ]);
    }

    /**
     * 保存新建节点的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
        if(!Request::instance()->isPost()){
            $this->error('你迷路了小伙组');
        }
        $p = $request->post();
        $data = [
            'name' => $p['name'],
            'mname' => $p['mname'],
            'aname' => $p['aname'],
            'status' => $p['status']
        ];
        $ynode = Db::name('ynode')->data($data)->insert();
        if ($ynode > 0){
            $this->success('添加成功','home/ynode/index');
        }else{
            $this->error('添加失败');
        }
    }

    /**
     * 更改状态
     * @param $id
     */
    public function updateStatus(Request $request)
    {
       $uid = $request->post('uid');
        $data = Db::name('ynode')->field('status')->find($uid);
        $status['status'] = $data['status'] == 1?2:1;
        $result = Db::name('ynode')->where(['id'=>$uid])->setField($status);
        if($result && $status['status'] == 1){
            $info= $status;
            $info['id'] = $uid;
            $info['info'] = '启用';
        }else{
            $info = $status;
            $info['id'] = $uid;
            $info['info'] = '禁用';
        }
        return json($info);
    }
    /**
     * 显示指定节点的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
        if(!Request::instance()->isAjax()){
            $this->error('你迷路老人');
        }
        $ynode = Db::name('ynode')->field('id,name,mname,aname,status')->find($id);
//        var_dump($ynode);die;
        if($ynode){
            $info['status'] = true;
            $info['info'] = '修改ID为'.$id.'的数据';
            $info['data'] = $ynode;
        }else{
            $info['status'] = false;
            $info['info'] = '查无此节点';
            $info['data'] = '没有数据';
        }
        return json($info);
    }

    /**
     * 显示编辑节点资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * 保存更新节点的资源
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
            'name' => $p['name'],
            'mname' => $p['mname'],
            'aname' => $p['aname'],
//            'status' => $p['status'],
        ];
        $ynode = Db::name('ynode')->where(['id'=>$p['id']])->update($data);
        if($ynode > 0){
            $this->success('修改成功','home/ynode/index');
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
        //查看是不是ajax传送
        if(!Request::instance()->isAjax()){
            $this->error('你迷路了');
        }
        $ynode = Db::name('ynode')->delete($id);
        if($ynode > 0){
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
