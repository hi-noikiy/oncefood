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
        $list = Db::name('yshop as a,lamp_company as b')->field('a.name,a.id,a.address,a.tel,a.datetime,a.area,a.status,a.hot,b.name as cname')->where('a.cid = b.id')->paginate(10);
        
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
        //查看是不是ajax传送
        if(!Request::instance()->isAjax()){
            $this->error('非法请求!');
        }

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

    public function hot(Request $request,$id)
    {
        //查看是不是ajax传送
        if(!Request::instance()->isAjax()){
            $this->error('非法请求!');
        }

        $sta = Db::name('yshop')->field('status')->where('id',$id)->find();
        if ($sta['status'] == 2) {
            $info = $sta;
            $info['info'] = '该店铺未上线!';
            return json($info);
        }
            
        $data = Db::name('yshop')->field('hot')->where('id',$id)->find();
        $status['hot'] = $data['hot']==1?2:1;

        $result = db('yshop')->where('id',$id)->setField($status);
       
        if ($result && $status['hot'] == 1) {
            $info = $status;
            $info['id'] = $id;
            $info['info'] = '该店铺已下热门!';
            return json($info);
        }else{
            $info = $status;
            $info['id'] = $id;
            $info['info'] = '该店铺已上热门!';

            return json($info);
        }
    }
}
