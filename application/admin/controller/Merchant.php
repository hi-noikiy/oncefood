<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;


class Merchant extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = Db::name('company')->field('id,name,tel,address,status')->paginate(10);
        
        return view('admin@Merchant/Mer',[
            'title' => '商户列表',  
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
        //
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
        $list = Db::name('company as c,lamp_yshop as y')->field('c.id,c.name,c.qq,c.email,group_concat(y.name)as sname')->where('c.id = '.$id.' and c.id = y.cid')->select();

        return view('admin@Merchant/detail',[
            'title' => '详细信息', 
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
        $result = db('company')->where('id',$id)->setField('status', '2');
        
        if ($result) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = 'ID为: ' . $id . '的用户已通过审核!';
            return json($info);
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
}
