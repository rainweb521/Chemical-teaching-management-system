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

class User extends Model{
    /**
     * 主键默认自动识别
     */
//    protected $pk = 'uid';
// 设置当前模型对应的完整数据表名称
    protected $table = 'user';
    public function get_UserInfo($where=null){
        $data = User::where($where)->find();
        if ($data!=null){
            return $data->getData();
        }else{
            return $data;
        }
    }
    public function insert_UserInfo($data){
        User::save($data);
        $u_id = $this->get_UserInfo($data);
        return $u_id['u_id'];
    }
    public function save_UserInfo($data,$where){
        User::save($data,$where);
    }
    public function get_User_New_List($num,$where=null){
        $list = User::where($where)->limit($num)->select();
        return $list;
    }
    public function get_UserList($where=null){
        $list = User::where($where)->select();
        return $list;
    }
    public function delete_UserInfo($where){
        User::where($where)->delete();
    }


}