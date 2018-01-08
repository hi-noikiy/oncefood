<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use think\Db;
class Yrole extends Admain
{
    /**
     * 显示资源角色节点列表
     *
     * @return \think\Response
     */
    public function index()
    {
//        查看所有角色
        $yrole = Db::name('yrole')->order('id asc')->select();
//        var_dump($yrole);die;
        $nid = array();
        foreach ($yrole as $v){
            $yrole_node = Db::name('yrole_node')->field('nid')->where(['rid'=>$v['id']])->select();
//            var_dump($yrole_node);die;
//            查看角色下的所有节点
            $node = array();
            foreach ($yrole_node as $y){
                $node[] = Db::name('ynode')->where(['id'=>$y['nid']])->value('name');
            }
//            var_dump($node);die;
            $v['node'] = $node;
            $nid[] = $v;
        }
//        var_dump($v);die;
        return view('home@yrole/index',[
            'title' => '角色管理',
            'nid' => $nid
        ]);
    }

    /**
     * @param Request $request
     * @return \think\response\Json
     */
            public function updateStatus(Request $request)
            {
        //        if(!Request::instance()->isPost()){
        //            $this->error('跳转失败');
        //        }
                $uid = $request->post('uid');
        //       var_dump($uid);die;

                $data = Db::name('yrole')->field('status')->find($uid);
        //        var_dump($data);die;
                $status['status'] = $data['status'] == 1?2:1;

        //        var_dump($status );
                $result = Db::name('yrole')->where(['id'=>$uid])->setField($status);
        //        var_dump($result);die;
        //        var_dump($result);
                if($result && $status['status'] == 1){
                    $info= $status;
                    $info['id'] = $uid;
                    $info['info'] = '启用';

                }else{
                    $info = $status;
                    $info['id'] = $uid;
                    $info['info'] = '禁用';
        //            return json($info);

                }
                return json($info);

            }
    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //显示增加页面
        return view('home@yrole/role_add',[
            'title' => '角色添加'
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
        //查看是否是post传输
        if(!Request::instance()->isPost()){
            $this->error('迷路了');
        }
        $p = $request->post();
        $data = [
            'name' => $p['name'],
            'remark' => $p['remark'],
            'status' => $p['status']
        ];
        $yrole = Db::name('yrole')->data($data)->insert();
        if($yole > 0){
            $this->success('添加成功','home/yrole/index');
        }else{
            $this->error('角色添加失败');
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
        //查看指定信息
        $yrole = Db::name('yrole')->field('id,name,remark,status')->find($id);
        if($yrole > 0){
            $info['status'] = true;
            $info['info'] = 'ID为'.$id.'的数据';
            $info['data'] = $yrole;
        }else{
            $info['status'] = false;
            $info['info'] = 'ID为'.$id.'的数据';
            $info['data'] = '查无此数据';
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
        if(!Request::instance()->isPut()){
            $this->error('迷路了');
                }
            $p = $request->put();
//                    var_dump($p);die;
            $data = [
            'name' => $p['name'],
            'remark' => $p['remark'],

            ];
            $yrole = Db::name('yrole')->where(['id'=>$p['id']])->update($data);
            if($yrole > 0){
            $this->success('修改成功','home/yrole/index');
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
        //查看是否Ajax传输
        $yrole = Db::name('yrole')->delete($id);
        if($yrole > 0){
            $info['status'] = true;
            $info['info'] = 'ID为'.$id.'删除成功';
        }else{
            $info['status'] = false;
            $info['info'] = 'ID为'.$id.'删除失败';
        }
        return json($info);
    }
}
