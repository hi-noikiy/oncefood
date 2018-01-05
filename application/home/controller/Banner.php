<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\File;

class Banner extends Controller
{
    /**
     * 显示指定商铺的banner图
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request,$id)
    {
        $yshop_banner = Db::name('yshop_banner')->where(['sid'=>$id])->select();

//        var_dump($yshop_banner);die;
        //
//        $list = Db::name('banner')->paginate(10);
//        $list = $list->items();
        return view('home@photo/index',[
            'banner' => '轮播图管理',
            'banners' =>$yshop_banner
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
     * 上传商铺首页轮播图的
     */
    public function save(Request $request)
    {
        $id = $request->post('pid');
        var_dump($id);die;
        $file = $request->file('image');
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->validate(['size'=>156780,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . 'banner');
            if($info){
                $icon = $info->getSaveName();
                $data = [
                    'icon' => $icon,
                    'sid' => $id
                ];
                $yshop_banner = Db::name('yshop_banner')->data($data)->insert();
                if($yshop_banner > 0 ){
//                    $info['status'] = true;
//                    $info['info'] = '添加成功';
                    $this->error('添加成功');
                }else{
//                    $info['status'] = false;
//                    $info['info'] = '添加失败';
                    $this->error('添加失败');
                }

            }else{
                $msg =  $file->getError();
                $this->error($msg);
            }
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
