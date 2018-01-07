<?php 	
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use think\Session;

	class Personal extends Base
	{	
		// private $obj;

		// public function _initialize()
		// {
		// 	$this->obj = model('zuser');
		// }
		
		public function index()
		{
	        $id = Session::get('index.id');
	        $data = db('zuser')->where('id',$id)->find();
			// $res = model('zuser')->find($id);
			return view('index@personal/personal',[
					'list' => $data
			]);
		}

		public function savee(Request $request){
			$data = input('post.');
			$file = $request->file('icon');
			$path = ROOT_PATH . 'public' . DS . 'uploads'. DS . 'icon';


		    $info = $file->validate(['ext'=>'jpg,png,gif'])->move($path);
		    if($info){
		        echo $info->getExtension();
		        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
		        echo $info->getSaveName();
		        // 输出 42a79759f284b767dfcb2a0197904287.jpg
		        echo $info->getFilename(); 
		    }else{
		        // 上传失败获取错误信息
		        echo $file->getError();
		    }
		    







		// 调用tp5数据验证
			// $validate = validate('Category');

			// if(!$validate->scene('add')->check($data)){
			// 	$this->error($validate->getError());
			// }
			// $res = db('zuser')->where('tel',$data['tel'])->update($data);
			// if($res){
			// 	$this->success('修改成功!');
			// }else{
			// 	$this->error('修改失败!');
			// }


		}
		// 加载修改密码页面
		public function pwdhtml(){

	        $id = Session::get('index.id');
			return view('index@personal/changepwd',[
					'id' => $id
			]);
		}
		
		//执行修改密码
		public function savepwd($id){
			$id = $id;
			$info = input('post.');
			$pwd = intval($info['pwd']);
			$rpwd = $info['repwd'];
			$length = strlen($pwd);
			if($pwd == 0){
				$this->error('密码不能为空');
			}
			if($pwd == $rpwd){
				db('zuser')->where('id',$id)->update(['pwd'=>md5($pwd)]);
				$this->success('恭喜您,密码修改成功');
			}
		}



	}
	