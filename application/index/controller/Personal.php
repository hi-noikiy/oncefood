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

		public function savee(){
			$data = input('post.');
		// 调用tp5数据验证
			$validate = validate('Category');

			if(!$validate->scene('add')->check($data)){
				$this->error($validate->getError());
			}
			$res = db('zuser')->where('tel',$data['tel'])->update($data);
			if($res){
				$this->success('修改成功!');
			}else{
				$this->error('修改失败!');
			}


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
	