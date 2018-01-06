<?php 	
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use think\Session;

	class Personal extends Base
	{
		
		public function index(){
			
			return view('index@personal/personal');
		}

	}
	