<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/10/24
 * Time: 18:01
 */
namespace app\config\model;

use phpDocumentor\Reflection\Types\Null_;
use think\Model;

class CommentM extends Model{
    /**
     * 主键默认自动识别
     */
//    protected $pk = 'uid';
// 设置当前模型对应的完整数据表名称
    protected $table = 'comment';
    public function get_CommentMInfo($where=null){
        $data = CommentM::where($where)->find();
        return $data->getData();
    }
    public function get_Comments_Num($where=null){
        $where['state'] = 1;
        $list = CommentM::where($where)->select();
        return count($list);
    }
    public function insert_CommentMInfo($data){
        CommentM::save($data);
        $e_id = $this->get_CommentMInfo($data);
        return $e_id['e_id'];
    }
    public function save_ExperimentInfo($data,$where){
        CommentM::save($data,$where);
    }
    public function get_CommentM_New_List($num,$where=null){
        $where['state'] = 1;
        $list = CommentM::where($where)->limit($num)->select();
        return $list;
    }
    public function get_CommentM_List2($where=null){
        $where['state'] = 1;
        $list = CommentM::where($where)->select();
        return $list;
    }
    public function get_CommentM_List($where=null){
        $where['state'] = 1;
        $where['status'] = 1;
        $list = CommentM::where($where)->select();
        $data_list = array();
        foreach ($list as $line){
            $line = ($line->getData());
            $data = array();
            $data['lord'] = array();
            $data['from'] = array();
            if ($line['node']!=0){
                array_push($data['lord'], $line);
                $node = $this->get_CommentMInfo(array('node'=>$line['node']));
                array_push($data['from'], $node);
            }else{
                array_push($data['lord'], $line);
            }
            array_push($data_list,$data);
        }
        return $data_list;
    }
    public function delete_CommentMInfo($id){
        $data = $this->get_filebedInfo(array('id'=>$id));
        $data['state'] = 3;
        $data['out_time'] = date('Y-m-d');
        Experiment::save($data,['id'=>$id]);
    }
    public function get_Blank(){
        $data['title'] = '';
        $data['profile'] = '';
        $data['content'] = '';
        $data['add_time'] = '';
        $data['focus'] = '';
        $data['material'] = '';
        $data['state'] = 1;
        $data['status_grade'] = Request::instance()->port('status_grade',1);
        $data['status_react'] = Request::instance()->port('status_grade',1);
        $data['uploader'] = Request::instance()->port('uploader','');
    }
    /**
     * 给文件添加有效期，默认为 7 天
     */
    public function set_Out_time($where,$day){
        $data = $this->get_filebedInfo($where);
        $data['state'] = 1;
        $data['out_time'] = date("Y-m-d", strtotime('+'.$day." day ".$data['out_time']));
        Experiment::save($data,$where);
    }
    /**
     * 将文件设置为过期，但不删除文件
     */
    public function set_Out($where){
        $data = $this->get_filebedInfo($where);
        $data['state'] = 0;
        $data['out_time'] = date('Y-m-d');
        CommentM::save($data,$where);
    }
    /**
     * 将文件置顶，也就是一直不过期，将日期设为0000-00-00
     */
    public function set_Top($where){
        $data = $this->get_filebedInfo($where);
        $data['out_time'] = '0000-00-00';
        $data['state'] = 1;
        CommentM::save($data,$where);
    }
}