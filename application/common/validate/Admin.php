<?php


namespace app\common\validate;


use think\Validate;

class Admin extends Validate
{
        protected $rule=[
            'name'=>'require|max:25',
            'password'=>'require|max:25',
            'mobile'=>'require|mobile',
            'email'=>'require|email',


        ];
        protected $message = [
            'name.require'=>'名称未设置',
            'name.max:25'=>'名称不能超过25字符',
            'password.require'=>'密码未设置',
            'password.max:25'=>'密码不能超过25字符',
            'mobile.require'=>'手机号码未设置',
            'mobile.mobile'=>'手机号码格式不对',
            'email.require'=>'邮箱未设置',
            'email.email'=>'邮箱未设置',




        ];
        protected $scene = [
            'add'=>['name','password','mobile','email']


        ];


}