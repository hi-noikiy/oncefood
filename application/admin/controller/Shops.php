<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class shops extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = Db::name('yshop as a,lamp_company as b')->field('a.name,a.id,a.address,a.tel,a.datetime,a.area,a.status,b.name as cname')->where('a.cid = b.id')->paginate(10);
        
        return view('admin@shops/shops',[
            'title' => '商铺列表',
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
        $data = Db::name('yshop')->field('status')->where('id',$id)->find();
        $status['status'] = $data['status']==1?2:1;

        $result = db('yshop')->where('id',$id)->setField($status);
       
        if ($result && $status['status'] == 1) {
            $info = $status;
            $info['id'] = $id;
            $info['info'] = '该店铺已上线!';
            return json($info);
        }else{
            $info = $status;
            $info['id'] = $id;
            $info['info'] = '该店铺已下线!';

            return json($info);
        }
    }

}
