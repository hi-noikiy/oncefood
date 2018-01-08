<?php 
namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use think\Session;

	class Register extends Controller
	{
		public function index()
  	  	{
          $name = Session::get('index.name');
          $nickname = Session::get('index.nickname');
          $id = Session::get('index.id');
          $list['name'] = $name;
          $list['nickname'] = $nickname;
          $list['id'] = $id;
          $banner = db('banner')->field('pic')->where('display',1)->select();
          $category = db('category')->where('pid = 0 and display = 1')->paginate(5);
          return view('index@register/register',[
          'banner' => $banner, 
          'category' => $category,
          'list' => $list
          ]);
  	    }

// 发送电话验证码
    public function getMsg()
  		{   
        $tel = $_GET['tel'];
        $list = db('zuser')->where('tel',$tel)->find();
        if($list>0){
          $data['status'] = false;
          return json($data);
        }
  			$msg = randsCode();
  			Session::set('msg',$msg);
			  $result = sendTemplateSMS($tel,array($msg,5000),"1");
	        if ($result) {
	            $data['status'] = true;
				      return json($data);
        	}
		}
//发送邮箱验证码
    public function email(){
       $msg = $_GET['email'];
       $list = db('zuser')->where('email',$msg)->find();
        if($list>0){
          $data['status'] = false;
          return json($data);
        }
       $rand = randCode();
       $email = qqemail($rand,$msg);
       Session::set('em',$rand);
       
       if(!empty($email)){
          $data['status'] = true;
          return json($data);
       }
    }


    // 检查用户名是否重复
    public function checkName()
    {
          $name = $_GET['name'];
          $data = db('zuser')->where('name',$name)->find();
          if($data>0){
            $list['status'] = true;
          }else{
            $list['status'] = false;
          }
          return json($list);
    }

    // 检查用户电话是否重复
    public function checkTel(){
        $tel = $_GET['tel'];
        $data = db('zuser')->where('tel',$tel)->find();
        if($data>0){
            $list['status'] = true;
          }else{
            $list['status'] = false;
          }
        return json($list);
    }

    // 检查用户邮箱是否重复
    public function checkemail(){
        $email = $_GET['email'];
        $data = db('zuser')->where('email',$email)->find();
        if($data>0){
            $list['status'] = true;
          }else{
            $list['status'] = false;
          }
        return json($list);
    }

    // 检测手机验证码是否成功
    public function selectTel(){
        $b = $_GET['ttt'];

        $a = Session::get('msg');

        if($b == $a){
          $list['status'] = true;
        }else{
          $list['status'] = false;
        }
        return json($list);
    }
    // 检测邮箱验证码是否成功
    public function selectEmail(){
        $b = $_GET['ttt'];

        $a = Session::get('em');

        if($b == $a){
          $list['status'] = true;
        }else{
          $list['status'] = false;
        }
        // $list['status'] = true;
        return json($list);
    }
    
		public function check(Request $request)
		{
        $info = $request->post();
        unset($info['repass']);
        $info['pwd'] = md5($info['pwd']);
        db('zuser')->insert($info);
		}


















	}