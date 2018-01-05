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
        // 密码修改完成跳转页面
        public function indexpwd(Request $request)
        {
          $info = $request->post();
          $tel = $info['tel'];
          $pwd = $info['pwd'];
          $pwd = md5($pwd);
          $data = db('zuser')->where('tel',$tel)->setField('pwd',$pwd);
          if($data == 0 ){
            $list['status'] = false;
          }else{
            $list['status'] = true;
          }
          return json($list);
        }

    		public function login(Request $request)
    		{
              $info = $request->post();
              $name = $info['name'];
              $pwd = $info['pwd'];
        		

        			$data = db('zuser')->where('name',$name)->where('pwd',md5($pwd))->find();
        			if ( $data > 0 ) {
              			Session::set('index.name',$name);
              			Session::set('index.pwd',$pwd);
              			Session::set('index.id',$data['id']);
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

        public function findName(){
            $name = $_GET['name'];
            $data = db('zuser')->where('name',$name)->find();
            if( $data>0 ){
                $list['status'] = true;
            }else{
                $list['status'] = false;
            }
            return json($list);
        }

        public function findEmail()
        {
            $tel = $_GET['tel'];
            $data = db('zuser')->where('tel',$tel)->find();

            if( $data>0 ){
                $list['status'] = true;
            }else{
                $list['status'] = false;
            }
            return json($list);
        }


        public function email()
        {

           $tel = $_GET['tel'];
            $list = db('zuser')->where('tel',$tel)->find();
            if($list == 0){
              $data['status'] = false;
              return json($data);
              die;
            }
            $msg = randsCode();
            Session::set('telmsg',$msg);
            $result = sendTemplateSMS($tel,array($msg,5000),"1");
         
            $data['status'] = true;
            return json($data);
           

        }
        public function tel()
        {
          $tel = $_GET['ttt'];
          $tel2 = Session::get('telmsg');
          $list['t1'] = $tel;
          $list['t2'] = $tel2;
          if( $tel == $tel2 ){
            $list['status'] = true;
          }else{
            $list['status'] = false;
          }
          return json($list);



        }
        // 可删去
        public function changepwd()
        {
            $tel = $_GET['tel'];

            $list['status']=true;
            return json($list);
        } 

        public function returnpass(Request $request)
        {

            $info = $request->param();
            return view('index@login/changepwd',[
              "list" => $info
            ]);
        }


        public function findPwd()
        {

        }

    }