<?php
namespace app\admin\controller;
use Admin\Controller\CommonController;
use app\config\model\Admin;
use app\config\model\filebed;
use app\config\model\key_password;
use think\Controller;
use \think\Request;
use \think\View;
class Login extends Controller {
    public function index(){
        return view('index');
//        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    public function test(){
        return view('test');
    }
    public function verify(){
        $data['username'] = Request::instance()->post('username','');
        $data['password'] = Request::instance()->post('password','');
        $admin_model = new Admin();
        $result = $admin_model->get_AdminInfo($data);
        if ($result!=null){
            session('admin',$data);
        }
        $this->redirect('/admin.php/admin/index');
    }
    /**
     * 登出操作
     */
    public function logout() {
//        Session::set();
        session('admin', null);
        $this->redirect('/admin.php/admin/index');
        exit();
//        $this->get_session();
    }
}
