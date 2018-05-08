<?php
namespace app\index\controller;
use app\config\model\CommentM;
use app\config\model\ExperimentM;
use app\config\model\filebed;
use app\config\model\key_password;
use think\Controller;
use \think\Request;
use \think\View;
class Index extends Common {
    public function index(){
        $list_new = array();
        $list_view = array();
        $list_reco = array();
        $experiment_model = new ExperimentM();
        /** 获取 最新的实验--3 */
        $list_new = $experiment_model->get_Experiment_New_List(3);
        /** 获取观看次数最多的视频---4 */
//        $list_view = $list_new;
        /** 获取 推荐的视频 */
//        $list_reco = $list_new;
        /** 获取全部的视频列表 */
        $list_all = $experiment_model->get_ExperimentList();
        return view('index',array('list_new'=>$list_new,'list_all'=>$list_all));
//        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    /** 高中视频的显示 */
    public function gao_index(){
        $experiment_model = new ExperimentM();
        /** 获取全部的视频列表 */
//        $list_all = array();
//        $line = array();
        $list1 = $experiment_model->get_ExperimentList(array('status_grade'=>1));
        $list2 = $experiment_model->get_ExperimentList(array('status_grade'=>2));
        $list3 = $experiment_model->get_ExperimentList(array('status_grade'=>3));
        $list4 = $experiment_model->get_ExperimentList(array('status_grade'=>4));
        $list5 = $experiment_model->get_ExperimentList(array('status_grade'=>5));
        $list6 = $experiment_model->get_ExperimentList(array('status_grade'=>6));
        $list7 = $experiment_model->get_ExperimentList(array('status_grade'=>7));
        $list8 = $experiment_model->get_ExperimentList(array('status_grade'=>8));
//        $list_all = $experiment_model->get_ExperimentList('status_grade<9');
        return view('gao_index',array('list1'=>$list1,'list2'=>$list2,'list3'=>$list3,'list4'=>$list4,
            'list5'=>$list5,'list6'=>$list6,'list7'=>$list7,'list8'=>$list8));
    }
    public function chu_index(){
        $experiment_model = new ExperimentM();
        /** 获取全部的视频列表 */
//        $list_all = array();
//        $line = array();
        $list1 = $experiment_model->get_ExperimentList(array('status_grade'=>8));
        $list2 = $experiment_model->get_ExperimentList(array('status_grade'=>9));
//        $list_all = $experiment_model->get_ExperimentList('status_grade<9');
        return view('chu_index',array('list1'=>$list1,'list2'=>$list2));
    }
    public function reaction(){
        $type = Request::instance()->get('type',1);
        if ($type==0){$type = 1;}
        $experiment_model = new ExperimentM();
        /** 获取全部的视频列表 */
//        $list_all = array();
//        $line = array();
        $list = $experiment_model->get_ExperimentList(array('status_react'=>$type));
//        $list2 = $experiment_model->get_ExperimentList(array('status_grade'=>9));
//        $list_all = $experiment_model->get_ExperimentList('status_grade<9');
        return view('reaction',array('list'=>$list));
    }
    public function play(){
        $e_id = Request::instance()->get('e_id',1);
        if ($e_id==0){$e_id=1;}
        $experiment_model = new ExperimentM();
        $data = $experiment_model->get_ExperimentInfo(array('e_id'=>$e_id));
        /** 修改游览次数 */
        $data['view'] = $data['view'] + 1;
        $experiment_model->save_ExperimentInfo($data,['e_id'=>$e_id]);
        /** 加载 最新视频 */
        $new_data = $experiment_model->get_Experiment_New_List(6);
        /** 加载 评论 */
        $comment_model = new CommentM();
        $comment = $comment_model->get_CommentM_List(array('e_id'=>$e_id));
        $comments = $comment_model->get_Comments_Num(array('e_id'=>$e_id));
//        var_dump($comment);
//        echo "<br><br>";
//        foreach ($comment as $line){
////            echo($line[0]['username']);
//            var_dump($line['lord'][0]["c_id"]);
//            echo "<br><br>";
//        }
//        exit();
        return \view('play',array('data'=>$data,'comments'=>$comments,'new_data'=>$new_data,'comment_list'=>$comment));
    }
    public function test(){
        $e_id = Request::instance()->get('e_id',1);
        if ($e_id==0){$e_id=1;}
        $experiment_model = new ExperimentM();
        $data = $experiment_model->get_ExperimentInfo(array('e_id'=>$e_id));
        return \view('test',array('data'=>$data));
//        return \view('test');
    }
    public function comment(){
        $tip = Request::instance()->post('tip',0);
        if ($tip==1){
            if ($this->isLogin()){
                $User = session('User');
                $data['content'] = Request::instance()->post('content','');
                $data['u_id'] = $User['u_id'];
                $data['username'] = $User['username'];
                $data['photo'] = $User['photo'];
                $data['e_id'] = Request::instance()->post('e_id',1);
                $data['e_title'] = Request::instance()->post('e_title','');
                $data['add_time'] = date('Y-m-d');
                $data['state'] = 1; /** 评论是否被系统回复 */
                $data['status'] = 1; /** 评论是否可以显示 */
                $data['node'] = 0;
                $data['type'] = 'User';
                $comment_model = new CommentM();
                $comment_model->insert_CommentMInfo($data);
                $this->success('评论成功');
            }
        }
        $this->error('您还未登录');
    }
    public function select(){
        $content = Request::instance()->post('content','');

    }
}
