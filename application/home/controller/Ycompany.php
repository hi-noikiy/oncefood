<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Session;

class Ycompany extends Admain
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
        $yshop = Db::name('yshop')->field('id,name,tel,address,status')->where(['cid' => $cid])->select();
//        var_dump($yshop);die;
        //显示店铺信息
        return view('home@ycompany/index',[
            'title'=>'商户列表',
            'yshop' => $yshop
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
            'name' => $p['name'],
            'tel' => $p['tel'],
            'address' => $p['address'],
            'status'=>$p['status'],
            'cid' => $cid,
            'datetime' => $p['datetime'],
            'area' => $p['area']
        ];

        $yshop = Db::name('yshop')->data($data)->insert();
        if ($yshop > 0){
            $this->success('添加商铺成功','home/ycompany/index');
        }else{
            $this->error('修改失败');
        }
    }

    /**
     * 更改状态
     * @param Request $request
     * @return \think\response\Json
     */
    public function updateSave(Request $request)
    {
        $uid = $request->post('uid');
        $data = Db::name('yshop')->field('status')->find($uid);
        $status['status'] = $data['status'] == 1?2:1;
        $result = Db::name('yshop')->where(['id'=>$uid])->setField($status);
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
     * 修改  路由
     * @param Request $request
     * @return \think\response\Json
     */
    public function saveUpdate(Request $request)
    {
        $id = $request->post('id');
        $yshop = Db::name('yshop')->field('id,name,tel,address')->find($id);
        if($yshop > 0){
            $info['status'] = true;
            $info['info'] = '修改ID为'.$id.'的数据';
            $info['data'] = $yshop;
        }else{
            $info['status'] = false;
            $info['info'] = '查无此节点';
            $info['data'] = $yshop;
        }
        return json($info);
    }

    /**
     * 展示详细信息
     * @param Request $request
     */
    public function showUpdate(Request $request)
    {
        $id = $request->post('id');
        $yshop = Db::name('yshop')->field('pwd',true)->find($id);
        if($yshop > 0){
            $info['status'] = true;
            $info['info']= '查看'.$id.'的数据';
            $info['datas'] = $yshop;
        }else{
            $info['status'] = false;
            $info['info']= '查无此商铺';
            $info['datas'] = '查无此商铺数据';
        }
        return json($info);

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

    /**
     * [getCate 获取一级分类]
     * @return [type] [description]
     */
    public function getCate(Request $request)
    {
        //查看是不是ajax传送
        if(!Request::instance()->isAjax()){
            $this->error('非法请求!');
        }
        $cate = db('category')->where('pid = 0 and display = 1')->select();

        $info = $cate;
        return json($info);
    }

    /**
     * [getCates 获取子分类]
     * @param  [type] $pid [子分类ID]
     * @return [type]      [description]
     */
    public function getCates(Request $request,$pid)
    {
        //查看是不是ajax传送
        if(!Request::instance()->isAjax()){
            $this->error('非法请求!');
        }

        $cates = Db::name('category')->where('pid = '.$pid)->select();

        $info = $cates;
        return json($info);
    }
}
