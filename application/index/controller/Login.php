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

		public function login()
		{

			$name = $_GET['name'];
			$pwd = $_GET['pwd'];
    		// $pwd = md5($pwd);
			$data = db('zuser')->where('name',$name)->where('pwd',md5($pwd))->find();
			if ($data > 0 ) {
            $list['status'] = false;
       		} else {
            $list['status'] = true;
  			}
            return json($list);

        }
	}