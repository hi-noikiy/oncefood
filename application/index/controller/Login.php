<?php 
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use think\Session;

	class Login extends Controller
	{
		public function index()
		{
			return view('index@Login/login'); 
		}

		public function login(Request $request)
		{

			$info = $request->post();
			$data = db('zuser')->where('name',$info['name'])->where('pwd',md5($info['pwd']))->find();
			if ($data === null) {
          	  	$info['status'] = true;
            	$info['data'] ='* 账号密码不匹配';
	        } else {
	            $info['status'] = false;
	          	
	        }
	        return json($info);
	        var_dump($info);die;

		}


	}