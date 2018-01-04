<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Cate extends AdminBase
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = db('category')->field(true)->paginate(10);
      
        return view('admin@cate/tables',[
            'title' => '分类列表',
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
        return view('admin@Cate/create',[
            'title' => '添加分类'
        ]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $Request)
    {   
        // 表单验证用JS
        $data = $Request->post();
        $list = db('category')->insert($data);

        if ($list) {
           return $this->success('添加成功',url('admin/cate/index'));
        }else{
            return $this->error('添加失败');
        }
    }

    /**
     * 加载添加子分类页
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $list = Db::name('category')->field('pid,path')->where('id = '.$id)->find();
        $list['pid'] = $id;
        $list['path'] = $list['path'].$id.',';

        return view('admin@cate/SonAdd',[
            'title' => '创建子分类', 
            'list' => $list
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
        $list = db('category')->where('id',$id)->find();

        return view('admin@cate/edit',[
            'title' => '编辑分类', 
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
    public function update(Request $Request, $id)
    {
        // 表单验证用JS
        $result = Db::name('category')->where('id',$id)->find();
        $data = $Request->post();
        unset($data['_method']);
        $data['id'] = $id;
        // 比较传入数据 和 数据库数据是否一致
        $diff = array_diff($result,$data);
        
        if (empty($diff)) {
            return $this->success('数据未修改,保存成功!',url('admin/cate/index'));
        }

       $list = db('category')->where('id',$id)->update($data);

       if ($list) {
           return $this->success('编辑成功',url('admin/cate/index'));
       }else{
            return $this->error('编辑失败');
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
        $data = Db::name('category')->where('pid', $id)->find();
        if ($data) {
            // 存在则提示无法删除
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = '该分类下存在子分类,无法删除!';
            return json($info);
        }

        $result = db('category')->delete($id);
        if ($result > 0) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = 'ID为: ' . $id . '的分类删除成功!';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = 'ID为: ' . $id . '的分类删除失败,请重试!';
        };
        return json($info);
    }
}
