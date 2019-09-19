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
namespace app\admin\controller;



class Diary extends Base
{
    public function index(){
            $diary = model('Diary')->getDiary();
            $author = model('Aboutme')->getAboutmeThumbnail();

            $this->assign([
                'diary'=>$diary['data'],
                'author'=>$author['data'],
            ]);
            return $this->fetch();
    }
    public function diaryAdd(){
        $data = input('post.');
        $data['remarks'] =  $data['remarks']?:'此时无声胜有声!';$data['remarks'];
        $status = model('Diary')->diaryAdd($data)['status'];
        return $status;
    }
    public function diaryDel(){
        $data = input('get.id');
        $status = model('Diary')->diaryDel($data);
        return $status;
    }
}
