<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
class role extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = db('role')->field(true)->select();

        return view('admin@role/role',[
            'title' => '角色列表',
            'data' => $list
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('admin@role/create',[
            'title' => '角色创建'
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
        $data = $request->post();

        $list = db('role')->insert($data);

        if ($list) {
            return $this->success('成功',url('admin/role/index'));
        }else{
            return $this->error('失败');
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
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $list = db('role')->where('id',$id)->find();

        return view('admin@role/edit',[
            'title' => '角色修改',
            'list' => $list
        ]);
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
        $data = $request->post();
        unset($data['_method']);

        $list = db('role')->where('id',$id)->update($data);

       if ($list) {
           return $this->success('成功',url('admin/role/index'));
       }else{
            return $this->error('失败');
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
        //
    }
    /**
     * [加载权限明细]
     * @param  [type] $id [用户ID]
     * @return \think\Response
     */
    public function nodeList($id)
    {
        $name = Db::name('role')->field('id,name')->where('id',$id)->find();
        $nid = Db::name('role_node')->field('nid')->where('rid',$id)->group('nid')->select();
        $node = Db::name('node')->field('id,name')->where('status','1')->select();


        foreach ($nid as $v) {
          $list[] = $v['nid'];
        }
        // var_dump($list);
        // die;
        return view('admin@role/nodeList',[
            'title' => '分配权限',
            'name' => $name, 
            'nid' => $list, 
            'node' => $node
        ]);
    }

    /**
     * [执行变更权限]
     * @param [type] $id [description]
     */
    public function UpdataNode(Request $Request)
    {
        $data = $Request->post();

        if (empty($data['node'])) {
            return $this->error('权限不能为空');
        }


            $result = db('role_node')->where('rid',$data['id'])->delete();

            foreach ($data['node'] as $v) {
                $res['nid'] = $v;
                $res['rid'] = $data['id'];
                $result = db('role_node')->insert($res);
            }

            if ($result) {
                return $this->success('分配成功',url('admin/role/index'));
            } else {
                return $this->error('分配失败');
            }
            
           

            


    }
}
