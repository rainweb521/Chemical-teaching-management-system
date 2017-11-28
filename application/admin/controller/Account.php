<?php
namespace app\admin\controller;
use app\config\model\User;
use app\config\model\Experiment;
use think\Controller;
use \think\Request;
use \think\View;
class Account extends Common{
    public function index(){
        $user_model = new User();
        $list = $user_model->get_UserList();
        return view('index',array('list'=>$list));
//        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    public function show(){
        $tip = Request::instance()->post('tip',0);
        $u_id = Request::instance()->get('u_id',0);
        $user_model = new User();
        if ($tip==1){
            $u_id = Request::instance()->post('u_id',0);
            if ($u_id==0){
                $data['username'] = Request::instance()->post('username','');
                $data['email'] = Request::instance()->post('email','');
                $data['password'] = Request::instance()->post('password','');
                $data['registration_time'] = date('Y-m-d');
                $data['state'] = Request::instance()->port('state',1);
                $data['status'] = Request::instance()->port('status',1);
                $user_model->insert_UserInfo($data);
                $this->success('添加成功','/admin.php/admin/account/index');
            }else{
                $data = $user_model->get_UserInfo(array('u_id'=>$u_id));
                $data['username'] = Request::instance()->post('username','');
                $data['email'] = Request::instance()->post('email','');
                $data['password'] = Request::instance()->post('password','');
                $data['state'] = Request::instance()->port('state',1);
                $data['status'] = Request::instance()->port('status',1);
                $user_model->save_UserInfo($data,array('u_id'=>$u_id));
                $this->success('修改成功','/admin.php/admin/account/index');
            }

        }else{
            if ($u_id!=0){
                $data = $user_model->get_UserInfo(array('u_id'=>$u_id));
            }else{
                $data['username'] = '';
                $data['email'] = '';
                $data['password'] = '';
                $data['state'] = 1;
                $data['status'] = 1;
            }
            return \view('show',array('u_id'=>0,'data'=>$data));
        }
    }
    public function power(){

        return view('power');
    }
    public function test(){
        return view('test');
    }
}
