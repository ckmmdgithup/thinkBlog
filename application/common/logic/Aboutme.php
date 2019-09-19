<?php


namespace app\common\logic;


use think\Controller;

class Aboutme extends Controller
{
    /**
     *
     * $var  $model   model层对象
     *
     */
        protected $model;
        protected function initialize(){

            $this->model = model('Aboutme');

        }
        //检测是否更改了缩略图
        public function aboutmeModify($data){
            if (!empty($data['articleThumbnail'])){
                return $this->model->aboutmeModify($data);
            }else{
                $data['articleThumbnail']=$this->model->getAboutmeThumbnail()['data']['thumbnail'];
                return $this->model->aboutmeModify($data);
            }
        }
}