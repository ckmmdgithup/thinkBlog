<?php


namespace app\common\logic;


use think\Controller;

class Article extends Controller
{
    /**
     * 文章管理业务逻辑处理层
     * $var  $model   文章管理model层对象
     * $var  $validate   文章管理验证器对象
     */
        protected $model;
        protected $validate;

        protected function initialize(){

            $this->model = model('Article');
            $this->validate = validate('Article');

        }
        //获取文章分类
        public function getArticleCategory(){
            $ArticleCategory = model('SystemCategory')->getArticleCategory();
            if ($ArticleCategory['status']==false){
                return $ArticleCategory['message'];
            }
            return $ArticleCategory['data'];
        }
        //文章添加
        public function articleAdd($data){
            //判断文章标题是否已经被使用过
            $articleStatus = $this->model->getArticleByTitle($data);
            if ($articleStatus['status']==false){
                return ['status'=>false,'message'=>$articleStatus['message'],'data'=>null];
            }elseif($articleStatus['status']==true && $articleStatus['data']){
                return ['status'=>false,'message'=>'文章标题已经被使用','data'=>$articleStatus['data']];
            }
            return $this->model->articleAdd($data);

        }
        //文章状态修改
        public function updateStatus($data){
            if (intval($data['id']) < 1){
                return ['status'=>false,'message'=>'输入了非法的ID'];
            }
            if (!in_array(intval($data['status']),[1,0,-1])){
                return ['status'=>false,'message'=>'输入了非法的状态'];
            }
            return $this->model->updateStatus($data);
        }
        //文章更新,检测是否更改了缩略图
        public function articleUpdate($data){
            if (!empty($data['articleThumbnail'])){
                return $this->model->articleUpdate($data);
            }else{
                $data['articleThumbnail']=$this->model->getArticleById($data['id'])['data']['article_thumbnail'];
                return $this->model->articleUpdate($data);
            }
        }
}