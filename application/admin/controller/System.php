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

class System extends Base
{


    //获取栏目管理数据
    public function systemCategory(){
            if (request()->isPost()){
                $search = input('post.search');
                $syscat = model('SystemCategory')->getSystemCategoryBySearch($search)['data'];
            }else{
                $syscat = model('SystemCategory')->getAllSystemCategory()['data'];
            }
            $this->assign([
                    'syscat'=>$syscat[0],
                    'num'=>$syscat[1]
            ]);
            return $this->fetch();
    }
    //添加栏目管理
    public function systemCategoryAdd(){
        if (request()->isPost()){
            $data = input('post.');
            //dump($data);exit();
            $status = $this->logicsystem->systemCategoryAdd($data);
            if ($status['status']==true && $status['data']){
                return $this->success($status['message']);
            }else{
                return $this->error($status['message']);
            }
        }else{
            return $this->fetch();
        }
    }
    //栏目管理更新操作
    public function systemCategoryUpdate(){
        $data = input('post.');
        //dump($data);exit();
        $status = $this->logicsystem->systemCategoryUpdate($data);
        if ($status['status']==true && $status['data']){
            return $this->success($status['message']);
        }else{
            return $this->error($status['message']);
        }
    }
    //栏目管理编辑页面
    public function systemCategoryEdit($id){
        $editdata = model('SystemCategory')->getSystemCategoryById($id);
        if ($editdata['status']==false){
            return $this->error($editdata['message']);
        }
        if ($editdata['data']==[]){
            return $this->error('非法的ID');
        }

        $this->assign([
            'editdata'=>$editdata['data'],
        ]);
        return $this->fetch();
    }
}
