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

class Admin extends Model{
    /**
     * 主键默认自动识别
     */
//    protected $pk = 'uid';
// 设置当前模型对应的完整数据表名称
    protected $table = 'admin';
    public function get_AdminInfo($where=null){
        $data = Admin::where($where)->find();
        if ($data!=null){
            return $data->getData();
        }else{
            return $data;
        }
    }
}