<?php


namespace app\common\model;


use think\Exception;
use think\Model;

class Aboutme extends Model
{

        public function aboutmeModify($data){
            $dataArray = [
                'id'=>1,
                'thumbnail' =>$data['articleThumbnail'],
                'name'=>$data['name'],
                'career'=>$data['career'],
                'introduction'=>$data['introduction'],
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>$this->update($dataArray)];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }

        }
        public function getAboutmeThumbnail(){
            $dataId = [
                ['id','=',1],
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>self::where($dataId)->find()];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }
        }


}