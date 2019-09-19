<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/7/13
 * Time: 18:13
 */

namespace app\common\logic;


use think\Controller;

class Login extends Controller
{
    //管理员登录逻辑处理
    public function adminLogin($data){
        $adminData = model('Admin')->getAdminByName($data);
        if ($adminData['status']==false){
            return ['status'=>false,'message'=>$adminData['message']];
        }elseif(!$adminData['data']){
            return ['status'=>false,'message'=>'用户不存在！'];
        }elseif(md5($data['password'].$adminData['data']['code'])!=$adminData['data']['password']){
            return ['status'=>false,'message'=>'密码输入错误！'];
        }elseif($adminData['data']['status']!=1){
            return ['status' => false, 'message' => '该用户已被禁用！'];
        }else{
            return $adminData;
        }
    }
}