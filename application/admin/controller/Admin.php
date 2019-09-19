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


/**
 * 引入管理员逻辑层
*/
use app\common\logic\Admin as Logic;


class Admin extends Base
{
    /**
     * 获取全部管理员列表，或者进行管理员搜索
    */
    public function adminList(){
        if (request()->isPost()){

            $search = input('post.search');
            //dump($data);exit();
            $adminList = model('Admin')->getAdminByCondition($search);
            //dump($adminList['data']);exit();
        }else{
            $adminList = model('Admin')->getAllAdmin();
        }

        $this->assign([
            'adminList'=>$adminList['data'][0],
            'num'=>$adminList['data'][1]
        ]);
        return $this->fetch();
    }
    //添加管理员
    public function adminAdd(){
        if (request()->isPost()){
            $data = input('post.');
            $status = (new Logic())->adminAdd($data);
            if ($status['status'] == true){
                return $this->success($status['message']);
            }else{
                return $this->error($status['message']);
            }
        }
        return $this->fetch();
    }
    //管理员数据更新操作
    public function adminUpdate(){
            if (!request()->isPost()){
                return $this->error('非法的请求');
            }
            $data = input('post.');
            //dump($data);exit();
            $status = (new Logic())->adminUpdate($data);
            if ($status['status'] == true){
                return $this->success($status['message']);
            }else{
                return $this->error($status['message']);

            }
    }
    //管理员编辑页面渲染
    public function adminEdit($id){

        //print_r($id);
        $originalData = model('Admin')->getAdminById($id);

        //dump($originalData['data']);
        $this->assign([
            'originalData'=>$originalData['data']
            ]);
        return $this->fetch();
    }
    //管理员状态更新
    public function adminStatus(){

        $data = input('get.');
        $status = (new Logic())->updateStatus($data);
        if ($status['status'] == true){
            return $this->success($status['message']);
        }else{
            return $this->error($status['message']);
        }
    }
}
