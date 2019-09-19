<?php


namespace app\common\model;


use think\Exception;
use think\exception\PDOException;
use think\Model;

class Admin extends Model
{
    public function adminAdd($data){

        $code = mt_rand(10,10000);
        $dataArray = [

            'name'=>$data['name'],
            'password'=>md5($data['password'].$code),
            'mobile'=>$data['mobile'],
            'email'=>$data['email'],
            'remarks'=>$data['remarks'],
            'code'=>$code,
            'status'=>0,
            'create_time'=>time()

        ];
        try{
            return ['status' => true, 'message' => '添加成功','data'=>$this->save($dataArray)];
        }catch (Exception $exception){
            try {
                $this->rollback();
            } catch (PDOException $e) {

            }
            return ['status' => false, 'message' => $exception->getMessage()];
        } catch (PDOException $e) {

        }
    }
    public function adminUpdate($data){

        $code = mt_rand(10,10000);
        $dataArray = [
            'id'=>$data['id'],
            'name'=>$data['name'],
            'password'=>md5($data['password'].$code),
            'mobile'=>$data['mobile'],
            'email'=>$data['email'],
            'remarks'=>$data['remarks'],
            'code'=>$code,
            'update_time'=>time()
        ];
        try{
            return ['status' => true, 'message' => '更新成功','data'=>$this->update($dataArray)];
        }catch (Exception $exception){
            return ['status' => false, 'message' => $exception->getMessage()];
        }
    }
    public function updateStatus($data){
        $dataArray = [
            'id'=>$data['id'],
            'status'=>$data['status'],
            'update_time'=>time()
        ];
        try{
            return ['status' => true, 'message' => '更新成功','data'=>$this->update($dataArray)];
        }catch (Exception $exception){
            return ['status' => false, 'message' => $exception->getMessage()];
        }
    }

    public function getAllAdmin(){
        $data=[
            ['status','>',-1],
            ['is_root','=',0]
        ];
        $order = [
          'id'=>'desc'
        ];
        try{
            return ['status' => true, 'message' => 'success','data'=>[self::where($data)->order($order)->paginate(15),self::where($data)->count()]];
        }catch (Exception $exception){
            return ['status' => false, 'message' => $exception->getMessage()];
        }
    }
    public function getAdminByCondition($search){
        $data=[
            ['name|mobile|email','like',"%".$search."%"],
            ['status','>',-1],
            ['is_root','=',0]
        ];
        $order = [
            'id'=>'desc'
        ];
        try{
            return ['status' => true, 'message' => 'success','data'=>[self::where($data)->order($order)->paginate(3),self::where($data)->count()]];
        }catch (Exception $exception){
            return ['status' => false, 'message' => $exception->getMessage()];
        }
    }
    public function getAdminByName($data){

        $dataName = [
            ['name','=',$data['name']],

        ];
        try{
            return ['status' => true, 'message' => 'success','data'=>self::where($dataName)->find()];
        }catch (Exception $exception){
            return ['status' => false, 'message' => $exception->getMessage()];
        }
    }
    public function getAdminById($id){
        $dataId = [
            ['id','=',$id],
            ['status','>',-1]
        ];
        try{
            return ['status' => true, 'message' => 'success','data'=>self::where($dataId)->find()];
        }catch (Exception $exception){
            return ['status' => false, 'message' => $exception->getMessage()];
        }
    }

}