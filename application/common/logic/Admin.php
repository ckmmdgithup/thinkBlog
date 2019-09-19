<?php


namespace app\common\logic;


use think\Controller;
/**
 * 管理员业务逻辑处理层
 * $var  $model   管理员model层对象
 * $var  $validate   管理员验证器对象
 */

class Admin extends Controller
{
    protected $model;
    protected $validate;

    protected function initialize(){

        $this->model = model('Admin');
        $this->validate = validate('Admin');

    }
    //管理员添加逻辑处理
    public function adminAdd($data){
            //判断用户密码输入是否相同
            if ($data['password']!=$data['password2']){
                return ['status'=>false,'message'=>'两次密码输入不同','data'=>null];
            }
            //使用验证器对象对用户信息进行校验
            if (!$this->validate->scene('add')->check($data)){
                return ['status'=>false,'message'=>$this->validate->getError(),'data'=>null];
            }
            //判断用户是否已经被注册过
            $adminStatus = $this->model->getAdminByName($data);
            if ($adminStatus['status']==false){
                return ['status'=>false,'message'=>$adminStatus['message'],'data'=>null];
            }elseif($adminStatus['status']==true && $adminStatus['data']){
                return ['status'=>false,'message'=>'用户已经被注册','data'=>$adminStatus['data']];
            }
            //使用model对象为用户注册
            return $this->model->adminAdd($data);

    }
    //管理员更新逻辑处理
    public function adminUpdate($data){


        if ($data['password']!=$data['password2']){
            return ['status'=>false,'message'=>'两次密码输入不同','data'=>null];
        }
        if (!$this->validate->scene('add')->check($data)){
            return ['status'=>false,'message'=>$this->validate->getError(),'data'=>null];
        }
        $adminStatus = $this->model->getAdminByName($data);
        if ($adminStatus['status']==false){
            return ['status'=>false,'message'=>$adminStatus['message'],'data'=>null];
        }elseif($adminStatus['status']==true && $adminStatus['data'] && $data['name']!=$this->model->getAdminById($data['id'])['data']['name']){
            return ['status'=>false,'message'=>'用户已经被注册','data'=>$adminStatus['data']];
        }
        return $this->model->adminUpdate($data);
    }
    //管理员状态逻辑处理
    public function updateStatus($data){
        if (intval($data['id']) < 1){
            return ['status'=>false,'message'=>'输入了非法的ID'];
        }
        if (!in_array(intval($data['status']),[1,0,-1])){
            return ['status'=>false,'message'=>'输入了非法的状态'];
        }
        return $this->model->updateStatus($data);
    }

}