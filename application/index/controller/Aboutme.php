<?php
/**
 * Created by PhpStorm.
 * User: web jinxiu89@163.com
 * Date: 2019-05-18
 * Time: 11:12
 * 命名规范：文件名首字母大写
 * 类 首写字母大写
 * 函数 驼峰命名  如getInfo
 */
namespace app\index\controller;

class Aboutme extends Base
{
    public function index(){
            return $this->fetch();
    }
}
