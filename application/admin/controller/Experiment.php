<?php
namespace app\admin\controller;
use app\config\model\filebed;
use app\config\model\key_password;
use think\Controller;
use \think\Request;
use \think\View;
class Experiment extends Common{
    public function index(){
        $experiment_model = new \app\config\model\Experiment();
        $list = $experiment_model->get_ExperimentList();
        return view('list',array('list'=>$list));
//        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    public function form_text(){
        $tip = Request::instance()->post('tip',0);
        if ($tip==0){
            return view('form_text',array('e_id'=>0));
        }else {
              /**  `e_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '实验信息的表',
              `title` char(255) DEFAULT NULL COMMENT '实验标题',
              `profile` text COMMENT '实验简介',
              `content` text COMMENT '实验内容',
              `add_time` char(255) DEFAULT NULL COMMENT '添加时间',
              `focus` char(255) DEFAULT NULL COMMENT '实验重点',
              `material` char(255) DEFAULT NULL COMMENT '实验器材',
              `picture` char(255) DEFAULT NULL COMMENT '实验图片',
              `video` char(255) DEFAULT NULL COMMENT '实验视频',
              `view` int(11) DEFAULT NULL COMMENT '观看次数',
              `state` tinyint(4) DEFAULT NULL COMMENT '实验状态，能否观看',
              `status` tinyint(4) DEFAULT NULL COMMENT '实验类型',
               *
              `status_grade` tinyint(4) DEFAULT NULL COMMENT '以数字的形式来显示年级',
              `grade` char(255) DEFAULT NULL COMMENT '以文本的形式显示年级',
              `status_react` tinyint(4) DEFAULT NULL COMMENT '化学反应类型的数字形式',
              `react` char(255) DEFAULT NULL COMMENT '化学反应的文字形式',
              `u_id` int(11) DEFAULT NULL,
              `uploader` char(255) DEFAULT NULL COMMENT '上传者',
              `video_time` char(255) DEFAULT NULL COMMENT '视频时长',

               */

            $data['title'] = Request::instance()->post('title','');
            $data['profile'] = Request::instance()->post('profile','');
            $data['content'] = Request::instance()->post('content','');
            $data['add_time'] = date('Y-m-d');
            $data['focus'] = Request::instance()->post('focus','');
            $data['material'] = Request::instance()->post('material','');
            $data['state'] = 1;
            $data['status_grade'] = Request::instance()->port('status_grade',1);
            $data['status_react'] = Request::instance()->port('status_grade',1);
            $data['uploader'] = Request::instance()->port('uploader','');
            $experiment_model = new \app\config\model\Experiment();
            $e_id = $experiment_model->insert_ExperimentInfo($data);
            return \view('form_video',array('e_id'=>$e_id));
        }


    }
    public function form_video(){
        $tip = Request::instance()->post('tip',0);
        if ($tip==0){
            return view('form_video',array('e_id'=>0));
        }else {
            $e_id = Request::instance()->post('e_id',0);
            $experiment_model = new \app\config\model\Experiment();
            $data = $experiment_model->get_ExperimentInfo(array('e_id'=>$e_id));
            $file_picture = request()->file('picture');
            $file_video = request()->file('video');
            if($file_picture){
                $info = $file_picture->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
//                    $data = $experiment_model->get_ExperimentInfo(array('e_id'=>$e_id));
                    $data['picture'] = '/public/uploads/'.$info->getSaveName();
//                    $experiment_model->save_ExperimentInfo($data,array('e_id'=>$e_id));
//                    $this->success('上传成功','/admin.php/admin/experiment');
                }else{
                    $this->error('上传失败，可能出现的原因：'.$file_picture->getError());
                }
            }else{
                $this->error('上传失败，可能出现的原因：'.$file_picture->getError());
            }
            if($file_video){
                $info = $file_video->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $data['video'] = '/public/uploads/'.$info->getSaveName();
                    $experiment_model->save_ExperimentInfo($data,array('e_id'=>$e_id));
                    $this->success('上传成功','/admin.php/admin/experiment');
                }else{
                    $this->error('上传失败，可能出现的原因：'.$file_video->getError());
                }
            }else{
                $this->error('上传失败，可能出现的原因：'.$file_picture->getError().$file_video->getError());
            }

        }

    }
}
