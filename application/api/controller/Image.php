<?php


namespace app\api\controller;


use think\Controller;

class Image extends Controller
{
    public function upload()
    {

        $file = $this->request->file('file');
        // 给定一个目录
        $info = $file->move('upload');
        $img_url=$info->getSaveName();
        if ($info) {
            return $img_url;
            //return $this->success('uploadSuccess', '', $info);
        } else {
            return '';
        }
    }
}