<?php 	
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use think\Session;

	class Personal extends Base
	{	
		private $obj;

		public function _initialize()
		{
			$this->obj = model('zuser');
		}
		
		public function index()
		{
	        $id = Session::get('index.id');
	        // $data = db('zuser')->where()->select();
			

			return view('index@personal/personal',[
					'list' => $id
			]);
		}

		public function savee(){
			$data = input('post.');
			// 调用tp5数据验证
			$validate = validate('Category');
			if(!$validate->scene('add')->check($data)){
				$this->error($validate->getError());
			}

			$res = $obj->add($data);
			if($res){
				$this->success('修改成功!');
			}else{
				$this->error('修改失败!');
			}


		}



	}
	