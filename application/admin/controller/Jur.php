<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class jur extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = db('node')->field(true)->select();

        return view('admin@jur/jur',[
            'title' => '权限列表',
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
        return view('admin@Jur/create',[
            'title' => '创建节点'
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
        $list = db('node')->insert($data);

        if ($list) {
            return $this->success('成功',url('admin/jur/index'));
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
        $list = db('node')->where('id',$id)->find();

        return view('admin@jur/edit',[
            'title' => '修改权限', 
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

       $list = db('node')->where('id',$id)->update($data);

       if ($list) {
           return $this->success('成功',url('admin/jur/index'));
       }else{
            return $this->error('失败');
       }
         
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id 指定删除的ID
     * @return \think\Response
     */
    public function delete($id)
    {
        
        $result = db('node')->delete($id);
        if ($result > 0) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = 'ID为: ' . $id . '的用户删除成功!';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = 'ID为: ' . $id . '的用户删除失败,请重试!';
        }
        return json($info);
    }
       
}
