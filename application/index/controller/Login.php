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
			$status = $_GET['status'];
			// if(!empty($status)){
			// }
			$data = db('zuser')->where('name',$name)->where('pwd',md5($pwd))->find();
			if ( $data > 0 ) {
  			Session::set('index.name',$name);
  			Session::set('index.pwd',$pwd);
            $list['status'] = false;
       		} else {
            $list['status'] = true;
  			}
            return json($list);

        }

        public function selectPwd()
        {
        	return view('index@Login/select');
        }

	}