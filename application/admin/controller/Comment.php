<?php
namespace app\admin\controller;
use app\config\model\User;
use app\config\model\Experiment;
use think\Controller;
use \think\Request;
use \think\View;
class Comment extends Common{
    public function index(){
        return view('index');
    }

}
