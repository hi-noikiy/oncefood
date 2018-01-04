<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\File;
use think\Db;


class Column extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = db('banner')->paginate(10);
        $list = $list->items();
        return view('admin@banner/index',[
            'list' => $list
        ]);
    }

    /**
     * 上传图片页.
     *
     * @return \think\Response
     */
    public function create()
    {
        
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
       // 获取表单上传文件
        $files = $request->file('image');
        $path = ROOT_PATH . 'public' . DS . 'static'. DS . 'index' . DS . 'images' . DS . 'banner';

        foreach($files as $file){
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->validate(['ext'=>'jpg,png,gif'])->move($path);
            if($info){
                $data[] = str_replace("\\","/",$info->getSaveName());
            }else{
                // 上传失败获取错误信息
                $msg = $file->getError();
               return $this->error($msg);
            }
        }


        Db::startTrans();
        try {
            foreach ($data as $k => $v) {
                $count = ($k + 1);
            }
            # 3.循环
            for ($i=0; $i < $count ; $i++) {
                $arr['pic'] = $data[$i];
                $list = db('banner')->insert($arr);
            }
            Db::commit();
        } catch (Exception $e) {
            Db::rollback();
        }

        if (empty($e)) {
            return $this->success('图片上传成功',url('admin/Column/index'));
        }else{
            return $this->error('图片上传失败');
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
        $data = Db::name('banner')->field('display')->where('id',$id)->find();
        $display['display'] = $data['display']==1?2:1;

        $result = db('banner')->where('id',$id)->setField($display);
       
        if ($result && $display['display'] == 1) {
            $info = $display;
            $info['id'] = $id;
            $info['info'] = '该图片已显示!';
        }else{
            $info = $display;
            $info['id'] = $id;
            $info['info'] = '该图片已隐藏!';
        }
        return json($info);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        // 判断图片是否在线
        $display = Db::name('banner')->field('display')->where('id',$id)->find();

        if ($display['display'] == 1) {
            // 显示则提示无法删除
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = '该图片正显示,无法删除!';
            return json($info);
        }

        $result = db('banner')->delete($id);
        if ($result > 0) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = 'ID为: ' . $id . '的图片删除成功!';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = 'ID为: ' . $id . '的图片删除失败,请重试!';
        };
        return json($info);
    }

    public function upload(Request $request)
    {

    }
}
