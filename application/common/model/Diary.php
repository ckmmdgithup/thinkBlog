<?php


namespace app\common\model;


use think\Exception;
use think\Model;

class Diary extends Model
{

        public function diaryAdd($data){
            $dataArray = [
                'remarks' =>$data['remarks'],
                'create_time'=>time(),
                'status'=>1
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>$this->save($dataArray)];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }

        }
        public function getDiary(){
            $status = [
                ['status','>',-1],
            ];
            $order = [
                'create_time'=>'desc'
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>self::where($status)->order($order)->paginate(15)];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }
        }
        public function diaryDel($data){
            $status = [
                'id'=>$data,
                'status'=> -1
            ];
            try{
                return ['status' => true, 'message' => '更新成功','data'=>$this->update($status)];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }
        }

}