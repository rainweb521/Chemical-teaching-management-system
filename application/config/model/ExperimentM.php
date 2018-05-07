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

class ExperimentM extends Model{
    /**
     * 主键默认自动识别
     */
//    protected $pk = 'uid';
// 设置当前模型对应的完整数据表名称
    protected $table = 'experiment';
    public function get_ExperimentInfo($where=null){
        $data = ExperimentM::where($where)->find();
        return $data->getData();
    }
    public function insert_ExperimentInfo($data){
        ExperimentM::save($data);
        $e_id = $this->get_ExperimentInfo($data);
        return $e_id['e_id'];
    }
    public function save_ExperimentInfo($data,$where){
        ExperimentM::save($data,$where);
    }
    public function get_Experiment_New_List($num,$where=null){
        $list = ExperimentM::where($where)->limit($num)->select();
        return $list;
    }
    public function get_ExperimentList($where=null){
        $list = ExperimentM::where($where)->select();
        return $list;
    }
    public function delete_ExperimentInfo($id){
        /** 因为懒得写了，所以这里只删除了数据库中的记录，并没有真正的删除视频和图片文件 */
        ExperimentM::where(array('e_id'=>$id))->delete();
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

}