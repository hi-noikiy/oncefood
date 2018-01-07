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
//        banner图片管理
        $yshop_banner = Db::name('yshop_banner')->where(['sid'=>$id])->select();
//        var_dump($yshop_banner);die;
        //        室内环境图片管理
        $yshop_show = Db::name('yshop_show')->where(['sid'=>$id])->select();
        return view('home@photo/index',[
            'banner' => '轮播图管理',
            'show' =>'室内环境',
            'banners' =>$yshop_banner,
            'shows' =>$yshop_show
        ]);
    }

    /**
     * 上传环境图片的和介绍的源表单页.
     *
     * @return \think\Response
     */
    public function create($id)
    {

        return view('home@photo/evr',[
            'banner' => '环境图上传',
            'banners' => $id
        ]);
    }

    /**
     * @param Request $request
     * 添加室内环境
     */
    public function evrsave(Request $request)
    {
        $id = $request->post('id');
        $comment = $request->post('comment');
        $face = $request->post('face');
        // var_dump($face);die;
        $file = $request->file('image');
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->validate(['size'=>156780,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . 'evr');
            if($info){
                $icon = str_replace("\\","/",$info->getSaveName());
//                $icon = $info->getSaveName();
                $data = [
                    'icon' => $icon,
                    'sid' => $id,
                    'comment' => $comment,
                    'face' => $face
                ];
                $yshop_show = Db::name('yshop_show')->data($data)->insert();
                if($yshop_show > 0 ){

                    $this->error('添加室内环境成功');
                    
                }else{

                    $this->error('添加室内环境失败');
                }

            }else{
                $msg =  $file->getError();
                $this->error($msg);
            }
        }

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
        $id = $request->post('id');
//        var_dump($id);die;
        $file = $request->file('image');
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->validate(['size'=>156780,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . 'banner');
            if($info){
                $icon = str_replace("\\","/",$info->getSaveName());

//                $icon = $info->getSaveName();
                $data = [
                    'icon' => $icon,
                    'sid' => $id,
                    'face' => 2
                ];
                $yshop_banner = Db::name('yshop_banner')->data($data)->insert();
                if($yshop_banner > 0 ){
//                    $info['status'] = true;
//                    $info['info'] = '添加成功';
                    $this->error('添加轮播图成功');
                }else{
//                    $info['status'] = false;
//                    $info['info'] = '添加失败';
                    $this->error('添加室轮播失败');
                }

            }else{
                $msg =  $file->getError();
                $this->error($msg);
            }
        }
    }

    /**
     * 显示上传banner的资源
     *获取轮播图表的sid。sid和商铺表的id相等
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {

        return view('home@photo/upbanner',[
            'banner' => '轮播图上传',
            'banners' =>$id
        ]);
    }
//    删除轮播图图片
    public function delete(Request $request)
    {
        if (!Request::instance()->isAjax()){
            $this->error('你迷路了');
        }
        $id = $request->post('id');
        $yshop_banner = Db::name('yshop_banner')->delete($id);
        if($yshop_banner > 0){
            $info['status'] = true;
            $info['info'] = '删除'.$id.'的数据成功';
//            $this->error('删除成功');
        }else{
            $info['status'] = false;
            $info['info'] = '删除'.$id.'的数据失败';
//            $this->error('删除失败');、

        }
        return json($info);

    }
    //    删除轮播图图片
    public function evrdelete(Request $request)
    {
        if (!Request::instance()->isAjax()){
            $this->error('你迷路了');
        }
        $id = $request->post('id');
        $yshop_banner = Db::name('yshop_show')->delete($id);
        if($yshop_banner > 0){
            $info['status'] = true;
            $info['info'] = '删除'.$id.'的数据成功';
//            $this->error('删除成功');
        }else{
            $info['status'] = false;
            $info['info'] = '删除'.$id.'的数据失败';
//            $this->error('删除失败');、

        }
        return json($info);

    }
    /**
     * 更改状态
     * @param Request $request
     * @return \think\response\Json
     */
    public function updateSave(Request $request)
    {
        $uid = $request->post('uid');
        $data = Db::name('yshop_banner')->field('display')->find($uid);
        $status['display'] = $data['display'] == 1?2:1;
        $result = Db::name('yshop_banner')->where(['id'=>$uid])->setField($status);
        if($result && $status['display'] == 1){
            $info= $status;
            $info['id'] = $uid;
            $info['info'] = '启用';
        }else{
            $info = $status;
            $info['id'] = $uid;
            $info['info'] = '禁用';
        }
        return json($info);
    }
    /**
     * 更改状态
     * @param Request $request
     * @return \think\response\Json
     */
    public function ban(Request $request)
    {
        $uid = $request->post('uid');
        $data = Db::name('yshop_show')->field('display')->find($uid);
        $status['display'] = $data['display'] == 1?2:1;
        $result = Db::name('yshop_show')->where(['id'=>$uid])->setField($status);
        if($result && $status['display'] == 1){
            $info= $status;
            $info['id'] = $uid;
            $info['info'] = '启用';
        }else{
            $info = $status;
            $info['id'] = $uid;
            $info['info'] = '禁用';
        }
        return json($info);
    }
    /**
     * 更改封面状态
     * @param Request $request
     * @return \think\response\Json
     */
    public function face(Request $request)
    {
        $uid = $request->post('uid');
        $data = Db::name('yshop_show')->field('face')->find($uid);
        $status['face'] = $data['face'] == 1?2:1;
        $result = Db::name('yshop_show')->where(['id'=>$uid])->setField($status);
        if($result && $status['face'] == 1){
            $info= $status;
            $info['id'] = $uid;
            $info['info'] = '封面';
        }else{
            $info = $status;
            $info['id'] = $uid;
            $info['info'] = '非封面';
        }
        return json($info);
    }

}
