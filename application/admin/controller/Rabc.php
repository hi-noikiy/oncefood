<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
class Rabc extends AdminBase
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        $sql = " select a.id,a.username,a.name,group_concat(c.name) as role
        from lamp_user a,lamp_user_role b,lamp_role c
        where a.id = b.uid and b.rid = c.id
        group by a.id;";
        
        $list = Db::query($sql);

        return view('admin@Rabc/RABC',[
                'title' => '用户列表',
                'list' => $list
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('admin@Rabc/create',[
            'title'=>'创建用户'
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
       
       if ($data['userpass'] !== $data['repass']) {
           return $this->error('两次输入不一致',url('admin/Rabc/create'));
       }
       unset($data['repass']);
       $data['userpass'] = md5($data['userpass']);

       $result = db('user')->insertGetId($data);

        if ($result) {
            // 创建成功后,默认给一个角色;
            Db::name('user_role')->insert(['uid' => $result,'rid' => '4']);
            return $this->success('创建成功',url('admin/Rabc/index'));
        }else{
            return $this->error('创建失败');
        }
    }

    /**
     * 加载角色列表
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {

        $name = Db::name('user')->field('id,name')->find($id);
        $role = Db::name('role')->field('id,name')->where('status','1')->select();
        $rid = Db::name('user_role')->field('rid')->where('uid',$id)->select();
        
        foreach ($rid as $v) {
          $list[] = $v['rid'];
        }


        return view('admin@Rabc/rolelist',[
            'title' => '角色列表', 

            'name' => $name,
            'role' => $role,
            'rid' => $list
        ]);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $list = db('user')->where('id',$id)->find();

        return view('admin@Rabc/edit',[
            'title' => '用户修改',
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
        $data['id'] = $id;
        unset($data['_method']);
        $result = Db::name('user')->where('id',$id)->find();
        // 如果传入的数据,密码为空;就把数据库密码赋值给它;
        if (empty($data['userpass'])) {
            $data['userpass'] = $result['userpass'];
            unset($data['repass']);

            // 比较其他数据是否一致
            $diff = array_diff($result,$data);
            // 一致则不更新直接返回
            if (empty($diff)) {
                return $this->success('数据未修改,保存成功!',url('admin/Rabc/index'));
            }

            // 有更新则更新返回
            $list = db('user')->where('id',$id)->update($data);

            if ($list) {
               return $this->success('更新成功',url('admin/Rabc/index'));
            }else{
                return $this->error('更新失败');
            }
        }
        // 如果密码不为空,用JS验证表单;确保提交的数据是正常的;有更新则更新返回;
        unset($data['repass']);
        $data['userpass'] = md5($data['userpass']);
        
        $list = db('user')->where('id',$id)->update($data);

        if ($list) {
           return $this->success('更新成功',url('admin/Rabc/index'));
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

        // 先判断有没有表关联
        $uid = Db::name('user_role')->where('uid',$id)->select();

        if (empty($uid)) {
            // 没有关联项,直接删除;
            Db::name('user')->delete($id);

            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = 'ID为: ' . $id . '删除成功!';
            return json($info);
        }else{
            // 有关联删除关联;
            Db::name('user')->delete($id);
            Db::name('user_role')->where('uid',$id)->delete();

            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = '删除了ID为: ' . $id . '的账号及角色!';
            return json($info);
        }
    }

    /**
     * [UpRole description]
     */
    public function UpRole(Request $Request)
    {
        $data = $Request->post();

        if (empty($data['role'])) {
            return $this->error('权限不能为空');
        }
        Db::startTrans();
        try {
            $result = db('user_role')->where('uid',$data['id'])->delete();

            foreach ($data['role'] as $v) {
                $res['rid'] = $v;
                $res['uid'] = $data['id'];
                $result = db('user_role')->insert($res);
            }

            Db::commit();
        } catch (Exception $e) {
            
            Db::rollback();
            
        }

        if (empty($e)) {
            return $this->success('分配成功',url('admin/Rabc/index'));
        }else{
            return $this->error('分配失败');
        }
    }
}
