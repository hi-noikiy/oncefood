<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Category extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($id)
    {
        //根据分类id加载子类id
        $gid = Db::name('category')->field('id')->where('path like "%,'.$id.',%"')->select();
//        var_dump($cid);die;
//        遍历成字串形式 6,7,8,9,0(二级分类)
        $gidList = '';
        foreach ($gid as $k => $v) {
            $gidList .= $v['id'].',';
        }
        $gidList .=$id;
//        var_dump($gidList);die;
        $yshop = Db::name('yshop')->field('id')->where(["gid "=>$gidList])->select();
//        var_dump($yshop);die;
        //查找图片介绍
//        定义一个空数组
        $yshop_show = array();
        foreach($yshop as $v){
            $sid = $v['id'];

            $yshop_show[] = Db::name('yshop_show')->field('sid,comment,icon')->where(['face'=>1,'sid'=>$sid])->select();
        }
//        var_dump($yshop_show);die;
//        轮播图
        $banner = db('banner')->field('pic')->where('display',1)->select();
        return view('index@category/index',[
            'category' => '分类',
            'show'=>$yshop_show,
            'banner' => $banner
        ]);
    }

    /**
     * 显示商铺首页.
     * @param  int  $id
     * @return \think\Response
     */
    public function create($id)
    {

        $yshop = Db::name('yshop')->where(['id'=>$id])->find();
        $yshop_banner = Db::name('yshop_banner')->field('icon')->where(['sid'=>$yshop['id'],'display'=>1])->select();
        $yshop_show = Db::name('yshop_show')->where(['sid'=>$yshop['id'],'display'=>1])->select();
        return view('index@category/shop',[
            'ban' => $yshop_banner,
            'sh' => $yshop_show

        ]);
    }

    public function order(){
        return view('index@category/order',[

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
