<?php


namespace app\common\logic;


use think\Controller;

class System extends Controller
{
    /**
     * 栏目管理业务逻辑处理层
     * $var  $model   栏目管理model层对象
     * $var  $validate   栏目管理验证器对象
     */
        protected $model;
        protected $validate;

        protected function initialize(){

            $this->model = model('SystemCategory');
            $this->validate = validate('System');

        }
        //栏目管理添加
        public function systemCategoryAdd($data){
            //验证数据
            if (!$this->validate->scene('categoryAdd')->check($data)){
                return ['status'=>false,'message'=>$this->validate->getError(),'data'=>null];
            }
            //栏目是否已存在？
            $CategoryStatus = $this->model->getSystemCategoryByName($data);
            if ($CategoryStatus['status']==false){
                return ['status'=>false,'message'=>$CategoryStatus['message'],'data'=>null];
            }elseif($CategoryStatus['status']==true && $CategoryStatus['data']){
                return ['status'=>false,'message'=>'栏目名与其他栏目重复','data'=>$CategoryStatus['data']];
            }
            //添加
            return $this->model->systemCategoryAdd($data);
        }
            //栏目管理更新
        public function systemCategoryUpdate($data){
            //验证数据
            if (!$this->validate->scene('categoryAdd')->check($data)){
                return ['status'=>false,'message'=>$this->validate->getError(),'data'=>null];
            }
            //栏目是否已存在？
            $CategoryStatus = $this->model->getSystemCategoryByName($data);
            if ($CategoryStatus['status']==false){
                return ['status'=>false,'message'=>$CategoryStatus['message'],'data'=>null];
            }elseif($CategoryStatus['status']==true && $CategoryStatus['data']&& $data['name']!=$this->model->getSystemCategoryById($data['id'])['data']['name']){
                return ['status'=>false,'message'=>'栏目名与其他栏目重复','data'=>$CategoryStatus['data']];
            }
            //更新
            return $this->model->systemCategoryUpdate($data);
        }
        //获取栏目，并进行数据组装
        public function getSystemCategory(){
            //获取所有的栏目
            $allCategory = $this->model->getAllSystemCategory();
            if ($allCategory['status']==false){
                return ['status'=>false,'message'=>$allCategory['message'],'data'=>null];
            }
            //将数据对象转为数组进行组装
            $allCategoryArr = $allCategory['data'][0]->toArray()['data'];
            //return $allCategoryArr;
            //使用getCategorySon将数据进行无限分类
            function getCategorySon($data,$pid,$level){

                $arr = [];
                foreach ($data as $item=>$value){
                        if ($value['parent_id']==$pid){
                            $value['level']='-|'.$value['level'];
                            $value['son']=getCategorySon($data,$value['id'],$level+1);
                            $arr[] = $value;
                        }
                }
                return $arr;
            }
            //将组装好的数据返回至控制器
            return [getCategorySon($allCategoryArr,0,0),$allCategory['data'][1]];
        }
}