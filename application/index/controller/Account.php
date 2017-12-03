<?php
namespace app\index\controller;
use app\config\model\CommentM;
use app\config\model\Experiment;
use app\config\model\filebed;
use app\config\model\key_password;
use app\config\model\User;
use \think\Controller;
use \think\Request;
use \think\View;
class Account extends Common {
    public function index(){
        $comment_model = new CommentM();
        $User = session('User');
        $data = $User;
        /** 加载评论数 */
        $data['comments'] = $comment_model->get_Comments_Num(array('u_id'=>$User['u_id']));
        $data['comments_admin'] = $comment_model->get_Comments_Num(array('u_id'=>$User['u_id'],'status'=>'2'));
        $comment_list = $comment_model->get_CommentM_List2(array('u_id'=>$User['u_id'],'status'=>'1'));
        $comment_admin = $comment_model->get_CommentM_List2(array('u_id'=>$User['u_id'],'status'=>'2'));
        $comment_new = $comment_model->get_CommentM_New_List(6,array('status'=>'1'));
        return \view('index',array('data'=>$data,'comment_list'=>$comment_list,'comment_admin'=>$comment_admin,
            'comment_new'=>$comment_new));
    }
    public function setting(){
        return \view('setting');
    }
    public function email_update(){
        $old_email = Request::instance()->post('old_email','');
        $new_email = Request::instance()->post('new_email','');
        $User = session('User');
        $account_model = new User();
        if ($User['email']==$old_email){
            $User['email'] = $new_email;
            $account_model->save_UserInfo($User,array('u_id'=>$User['u_id']));
            session('User',$User);
            $this->success('邮箱修改成功');
        }else{
            $this->error('旧邮箱输入有误');
        }
    }
    public function pass_update(){
        $old_password = Request::instance()->post('old_password','');
        $new_password = Request::instance()->post('new_password','');
        $User = session('User');
        $account_model = new User();
        if ($User['old_password']==$old_password){
            $User['password'] = $new_password;
            $account_model->save_UserInfo($User,array('u_id'=>$User['u_id']));
            session('User',$User);
            $this->success('密码修改成功');
        }else{
            $this->error('旧密码输入有误');
        }
    }
    public function other_update(){
        $User = session('User');
        $account_model = new User();
        $photo = \request()->file('photo');
        if($photo){
            $info = $photo->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
//                    $data = $experiment_model->get_ExperimentInfo(array('e_id'=>$e_id));
                $User['photo'] = '/public/uploads/'.$info->getSaveName();
                $User['sex'] = Request::instance()->post('sex','男');
                $User['birthday'] = Request::instance()->post('birthday','');
                $User['grade'] = Request::instance()->post('grade','');
                $User['address'] = Request::instance()->post('address','');
                $User['introduce'] = Request::instance()->post('introduce','');
                $account_model->save_UserInfo($User,array('u_id'=>$User['u_id']));
                session('User',$User);
                $this->success('信息修改成功');
            }else{
                $this->error('头像上传失败，可能出现的原因：'.$photo->getError());
            }
        }else{
            $this->error('头像上传失败，可能出现的原因：'.$photo->getError());
        }

    }
}
