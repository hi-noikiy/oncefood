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

        Db::startTrans();
        try{
            $id = db('role')->insertGetId($data);
            $data = ['rid' => $id , 'nid' => '1'];
            Db::name('role_node')->insert($data);
            // 提交事务
            Db::commit();

        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();

        }

        if (empty($e)) {
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
        $result = Db::name('role')->where('id',$id)->find();
        $data = $request->post();
        unset($data['_method']);
        $data['id'] = $id;
        // 比较传入数据 和 数据库数据是否一致
        $diff = array_diff($result,$data);
        
        if (empty($diff)) {
            return $this->success('数据未修改,保存成功!',url('admin/role/index'));
        }


        $list = db('role')->where('id',$id)->update($data);

        if ($list) {
           return $this->success('更新成功',url('admin/role/index'));
        }else{
            return $this->error('更新失败');
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
        // 判断$id 在 user_role里是否存在?
        $data = Db::name('user_role')->where('rid', $id)->find();

        if ($data) {
            // 存在则提示无法删除
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = '该角色已绑定用户,无法删除!';
            return json($info);
        }else{
            // 开启事务删除表关联
            Db::startTrans();
            try {
                $result = db('role')->delete($id);
                $res = db('role_node')->where('rid', $id)->delete();

                Db::commit();
            } catch (Exception $e) {
                Db::rollback();
            }

        }
        if (empty($e)) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = 'ID为: ' . $id . '的用户删除成功!';
            return json($info);
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = '数据出错,已回调!';
            return json($info);
            // 这里问下老师,为什么没有进入回这个区间?
        }
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

        return view('admin@role/nodeList',[
            'title' => '分配权限',
            'name' => $name, 
            'nid' => $list, 
            'node' => $node
        ]);
    }

   /**
    * 执行权限分配
    * @param Request $Request [请求]
    */
    public function UpdataNode(Request $Request)
    {
        $data = $Request->post();

        if (empty($data['node'])) {
            return $this->error('权限不能为空');
        }
            Db::startTrans();
            try {
                $result = db('role_node')->where('rid',$data['id'])->delete();

                foreach ($data['node'] as $v) {
                    $res['nid'] = $v;
                    $res['rid'] = $data['id'];
                    $result = db('role_node')->insert($res);
                }

                Db::commit();
            } catch (Exception $e) {
                
                Db::rollback();
                
            }

            if (empty($e)) {
                return $this->success('分配成功',url('admin/role/index'));
            }else{
                return $this->error('分配失败');
            }

    }
}
