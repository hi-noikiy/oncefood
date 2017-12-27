<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
class Rabc extends Controller
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
        //
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
        //
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
}
