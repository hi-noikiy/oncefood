<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class ShopAttr extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = db('attr')->field(true)->paginate(10);
        return view('admin@Attr/Attr',[
            'list' => $list
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
        // 表单验证用JS写
        $data = $request->post();
        $list = db('attr')->insert($data);

        if ($list) {
            return $this->success('添加成功!','admin/ShopAttr/index');
        }else{
            return $this->error('添加失败!');
        }
    }


    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $list = db('attr')->where('id',$id)->find();
        return view('admin@Attr/edit',[
            'title' => '修改属性',
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
        $result = Db::name('attr')->where('id',$id)->find();
        $data = $request->post();
        unset($data['_method']);
        $data['id'] = $id;
        // 比较传入数据 和 数据库数据是否一致
        $diff = array_diff($result,$data);
        
        if (empty($diff)) {
            return $this->success('数据未修改,保存成功!',url('admin/ShopAttr/index'));
        }


        $list = db('attr')->where('id',$id)->update($data);

        if ($list) {
           return $this->success('更新成功',url('admin/ShopAttr/index'));
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
        $result = db('attr')->delete($id);
        if ($result > 0) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = 'ID为: ' . $id . '的用户删除成功!';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = 'ID为: ' . $id . '的用户删除失败,请重试!';
        };
        return json($info);
    }
}
