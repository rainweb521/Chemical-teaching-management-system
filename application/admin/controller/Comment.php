<?php
namespace app\admin\controller;
use app\config\model\CommentM;
use app\config\model\User;
use app\config\model\ExperimentM;
use think\Controller;
use \think\Request;
use \think\View;
class Comment extends Common{
    public function index(){
        $comment_model = new CommentM();
        $list = $comment_model->get_CommentM_List3();

        return view('index',['list'=>$list]);
    }

}
