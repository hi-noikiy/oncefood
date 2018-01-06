<?php

namespace app\home\controller;

use think\Controller;
use think\Db;
use think\Request;

class Comment extends Controller
{
    /**
     * 显示指定商铺所有介绍资源列表
     *
     * @return \think\Response
     */
    public function index($id)
    {
        //
        $yshop_comment = Db::name('yshop_comment')->where(['sid'=>$id])->select();
        return view('home@comment/index',[
            'title' => '商铺简介',
            'sid' => $id,
            'com' => $yshop_comment
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function commit(Request $request)
    {
        if(!Request::instance()->isAjax()){
            $this->error('你迷路了');
        }
        $id = $request->post('id');
        $comment = $request->post('obj');
//        var_dump($comment);die;
        $data = [
            'sid' => $id,
            'comment'=>$comment,
            'display' =>2
        ];
//        var_dump($id,$comment);die;
        $yshop_comment = Db::name('yshop_comment')->data($data)->insert();
        if($yshop_comment > 0){
            $info['status'] = true;
            $info['info'] = '发布成功';
        }else{
            $info['status']=false;
            $info['info'] = '发布失败';
        }
        return json($info);
    }

    /**
     * 简介的启用开关的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function triggersave(Request $request)
    {
        $uid = $request->post('id');
        $data = Db::name('yshop_comment')->field('display')->find($uid);
        $status['display'] = $data['display'] == 1?2:1;
        $result = Db::name('yshop_comment')->where(['id'=>$uid])->setField($status);
        if($result && $status['display'] == 1){
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
     * 显示指定的资源
     *显示详细信息
     * @param  int  $id
     * @return \think\Response
     */
    public function message(Request $request)
    {
        if(!Request::instance()->isAjax()){
            $this->error('你迷路了');
        }
        $id = $request->post('id');
        $yshop_comment = Db::name('yshop_comment')->field('comment')->find($id);
//        var_dump($yshop_comment['comment']);die;
        if($yshop_comment > 0){
            $info['status'] = true;
            $info['info'] = '查询成功';
            $info['datas'] = $yshop_comment['comment'];
         }else{
            $info['status'] = false;
            $info['info'] = '查询失败';
            $info['datas'] = '没有此数据';
        }
        return json($info);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function messagedelete(Request $request)
    {
        if (!Request::instance()->isAjax()){
            $this->error('你迷路了');
        }
        $id = $request->post('id');
        $yshop_banner = Db::name('yshop_comment')->delete($id);
        if($yshop_banner > 0){
            $info['status'] = true;
            $info['info'] = '删除'.$id.'的数据成功';
//            $this->error('删除成功');
        }else{
            $info['status'] = false;
            $info['info'] = '删除'.$id.'的数据失败';
//            $this->error('删除失败');、

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
    public function editmessage(Request $request)
    {
        $id = $request->post('id');
        $yshop_comment = Db::name('yshop_comment')->field('id,comment')->find($id);
//        var_dump($yshop_comment);die;
        if($yshop_comment > 0){
            $info['status'] = true;
            $info['info'] = '修改ID为'.$id.'的数据';
            $info['data'] = $yshop_comment;
        }else{
            $info['status'] = false;
            $info['info'] = '查无此节点';
            $info['data'] = $yshop_comment;
        }
        return json($info);
    }

    /**
     * @param Request $request
     * @param $id
     * 更新修改
     */
    public function update(Request $request,$id)
    {
        //
        if(!Request::instance()->isPut()){
            $this->error('迷路了');
        }
        $p = $request->put();

        $data = [
            'comment' => $p['comment']
        ];
        $yshop_comment = Db::name('yshop_comment')->where(['id'=>$p['id']])->update($data);
        if($yshop_comment > 0){
            $this->error('修改成功');
        }else{
            $this->error('修改失败');
        }
    }

}
