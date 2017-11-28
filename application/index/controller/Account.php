<?php
namespace app\index\controller;
use app\config\model\Experiment;
use app\config\model\filebed;
use app\config\model\key_password;
use app\config\model\User;
use \think\Controller;
use \think\Request;
use \think\View;
class Account extends Common {
    public function index(){
        return \view('index');
    }
    public function setting(){
        return \view('setting');
    }
}
