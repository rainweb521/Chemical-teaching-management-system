<?php
namespace app\index\controller;
use app\config\model\ExperimentM;
use app\config\model\filebed;
use app\config\model\key_password;
use app\config\model\User;
use \think\Controller;
use \think\Request;
use \think\View;
class Login extends Controller{
    public function index(){
        return \view('login',array('state'=>'登录用户'));
    }
    public function signup(){
        $tip = Request::instance()->post('tip',0);
        if ($tip==1){
            $data['username'] = Request::instance()->post('username','');
            $data['email'] = Request::instance()->post('email','');
            $data['password'] = Request::instance()->post('password','');
            $data['registration_time'] = date('Y-m-d');
            $data['state'] = 1;
            $data['status'] = 1;
            $user_model = new User();
            $user_model->insert_UserInfo($data);
            return \view('login',array('state'=>'注册成功请登录'));
        }
        return \view('signup',array('state'=>'注册新的用户'));
    }
    public function login(){
        $tip = Request::instance()->post('tip',0);
        if ($tip==1){
            $data['email'] = Request::instance()->post('email','');
            $data['password'] = Request::instance()->post('password','');
            $user_model = new User();
            $result = $user_model->get_UserInfo($data);
            if ($result==null){
                return \view('login',array('state'=>'用户名或密码错误'));
            }else{
                $result['last_time'] = date('Y-m-d');
                $user_model->save_UserInfo($result,array('u_id'=>$result['u_id']));
                session('User',$result);
                $this->redirect('/index.php/index/account');
                exit();
            }
        }
        return \view('login',array('state'=>'登录用户'));
    }
    /**
     * 登出操作
     */
    public function logout() {
        session('User', null);
//        return \view('Index/index',array());
        $this->redirect('/index.php/index/index');
        exit();
//        $this->get_session();
    }
}
