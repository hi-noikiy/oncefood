<?php 
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use think\Session;
	class Register extends Controller
	{
		public function index()
  	  	{
        	return view('index@register/register');
  	    }


    public function getMsg()
  		{   
  			$msg = randCode();
  			Session::set('msg',$msg);
			  $result = sendTemplateSMS('18621695842',array($msg,50),"1");
	        if ($result) {
	            $data['status'] = true;
				      return json($data);
        	}
		}

		public function check(Request $request)
		{
			    $info = $request->post();
       		$a = Session::get('msg');
       		if($a!=$info['msg']){
       			$this->error('验证码错误！');
            	exit;
       		}
          $list = db('zuser')->field('name')->where('name',$info['name'])->find();
          if($list != null){
            $this->error('该用户名已注册！');
            exit;
          }
          
          $list = db('zuser')->field('tel')->where('tel',$info['tel'])->find();
          if($list != null){
            $this->error('该电话已注册！');
            exit;
          }

          $info['pwd'] = md5($info['pwd']);
       		unset($info['repass'],$info['msg']);
       		$data = db('zuser')->insert($info);

       		if($data>0){
            $this->success('恭喜您,注册成功!', 'index/index/index');
  	 	 	  } else {
            $this->error('可惜了,注册失败!');
       	 	}
		}


















	}