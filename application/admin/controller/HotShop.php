<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class HotShop extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
       $list = Db::name('yshop as a,lamp_yshop_show as b')->field('a.id,a.name,b.comment,b.icon,b.status,b.id as bid ')->where('a.id = b.sid and a.hot = 2 and face = 1')->group('a.id')->paginate(10);
        return view('admin@Column/HotShop',[
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
        $list = db('yshop_show')->field('id,icon,face')->where('sid',$id)->select();
        return view('admin@column/PicEdit',[
            "list" => $list
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

        $data = Db::name('yshop_show')->field('face,sid')->where('id',$id)->find();

        if ($data['face'] == 1) {
            $info['face'] = $data['face'];
            $info['info'] = '该图片已经是封面!';
            return json($info);
        }else{
            $sid = $data['sid'];
            $sql = "update lamp_yshop_show set face = 2 where sid = ".$sid;
            $data = Db::execute($sql);
            $result = db('yshop_show')->where('id',$id)->setField('face','1');

            $info['sid'] = $data;
            $info['info'] = '封面设置成功!';
            return json($info);
        }
    }

    /**
     * [UpHot 热门上线]
     * @param Request $request [description]
     * @param [type]  $id      [description]
     */
    public function UpHot(Request $request,$id)
    {
        //查看是不是ajax传送
        if(!Request::instance()->isAjax()){
            $this->error('非法请求!');
        }

        $data = Db::name('yshop_show')->field('status')->where('id',$id)->find();
        $status['status'] = $data['status']==1?2:1;

        $result = db('yshop_show')->where('id',$id)->setField($status);

        if ($result && $status['status'] == 1) {
            $info = $status;
            $info['id'] = $id;
            $info['info'] = '该店铺已下热门板块!';
            return json($info);
        }else{
            $info = $status;
            $info['id'] = $id;
            $info['info'] = '该店铺已上热门板块!';
            return json($info);
        }
    }

}
