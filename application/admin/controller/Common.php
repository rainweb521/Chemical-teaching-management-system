<?php
namespace app\admin\controller;
use app\config\model\filebed;
use app\config\model\key_password;
use think\Controller;
use \think\Request;
use \think\View;
class Common extends Controller {
    public function __construct(){
        header("Content-type: text/html; charset=utf-8");
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        parent::__construct();
        $this->assign('title','中学化学教学管理系统');
        $this->_init();

    }
    public function set_menu_active($num){

    }
    /**
     * 初始化
     * @return
     */
    private function _init()
    {
        // 如果已经登录
        $isLogin = $this->isLogin();

        if (!$isLogin) {
            // 跳转到登录页面
            $this->redirect('/admin.php/admin/login');
//            $url = '/index.php?c=login';
//            echo "<script language=\"javascript\">";
//            echo "location.href=\"$url\"";
//            echo "</script>";
        }
    }

    /**
     * 获取登录用户信息
     * @return array
     */
    public function getLoginUser()
    {
        return session("admin");
    }

    /**
     * 判定是否登录
     * @return boolean
     */
    public function isLogin()
    {
        $user = $this->getLoginUser();
        if ($user && is_array($user)) {
            $this->assign('admin',$user);
            return true;
        }

        return false;
    }
    public function _empty(){
        echo "不存在的方法";
    }
}
