<?php


namespace app\common\model;


use think\Exception;
use think\Model;

class SystemCategory extends Model

{
        //栏目添加
        public function systemCategoryAdd($data){
            $dataArray = [
                'name'=>$data['name'],
                'parent_id'=>$data['parent_id'],
                'link'=>$data['link'],
                'listorder' =>0,
                'status'=>1,
                'create_time'=>time()
            ];
            try{
                return ['status' => true, 'message' => '添加成功','data'=>$this->save($dataArray)];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }
        }
        //栏目更新
        public function systemCategoryUpdate($data){
            $dataArray = [
                'id'=>$data['id'],
                'name'=>$data['name'],
                'parent_id'=>$data['parent_id'],
                'link'=>$data['link'],
                'update_time'=>time()
            ];
            try{
                return ['status' => true, 'message' => '更新成功','data'=>$this->update($dataArray)];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }
        }
        //获取所有栏目数据
        public function getAllSystemCategory(){

            $data=[
                    ['status','=',1],
                ];

            $order = [
                'parent_id'=>'asc',
                'id'=>'asc'
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>[self::where($data)->order($order)->paginate(),self::where($data)->count()]];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }
        }
        //搜索栏目
        public function getSystemCategoryBySearch($search){

            $data=[
                ['name|id','like',"%".$search."%"],
                ['status','=',1],
            ];

            $order = [
                'parent_id'=>'asc',
                'id'=>'asc'
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>[self::where($data)->order($order)->paginate(),self::where($data)->count()]];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }
        }
        //通过name获取栏目
        public function getSystemCategoryByName($data){
            $dataName = [
                ['name','=',$data['name']],
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>self::where($dataName)->find()];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }
        }
        //通过ID 获取栏目
        public function getSystemCategoryById($id){
            $dataId = [
                ['id','=',$id],
                ['status','=',1]
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>self::where($dataId)->find()];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }
        }
        //通过pid 获取栏目
        public function getArticleCategory(){
            $dataId = [
                ['parent_id','=',8],
                ['status','=',1]
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>self::where($dataId)->select()];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }
        }
}