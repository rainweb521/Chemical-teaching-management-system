<?php
namespace app\admin\controller;
use app\config\model\CommentM;
use app\config\model\ExperimentM;
use app\config\model\User;
use think\Controller;
use \think\Request;
use \think\View;
class Index extends Common{
    public function index(){
        $experiment = new ExperimentM();
        $user_model = new User();
        $comment_model = new CommentM();
        $data['view'] = $experiment->get_View();
        $data['ex_num'] = count($experiment->get_ExperimentList(['add_time'=>date('Y-m-d')]));
        $data['user_num'] = count($user_model->get_UserList(['registration_time'=>date('Y-m-d')]));
        $comment_data = $comment_model->get_CommentM_List2(['add_time'=>date('Y-m-d')]);
        $data['comm_num'] = count($comment_data);
        $user_data = $user_model->get_UserList(['last_time'=>date('Y-m-d')]);
//        var_dump($comment_data);exit();
        return view('index',array('data'=>$data,'comment'=>$comment_data,'user'=>$user_data));
//        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    public function test(){
        return view('test');
    }
}
