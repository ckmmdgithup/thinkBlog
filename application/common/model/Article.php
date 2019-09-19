<?php


namespace app\common\model;


use think\Exception;
use think\Model;

class Article extends Model
{
        public function articleAdd($data){
            $dataArray = [
                'article_title' =>$data['articleTitle'],
                'article_classify'=>$data['articleClassify'],
                'article_thumbnail'=>$data['articleThumbnail'],
                'article_keywords'=>$data['articleKeywords'],
                'article_abstract'=>$data['articleAbstract'],
                'article_author'=>$data['articleAuthor'],
                'article_source'=>$data['articleSource'],
                'article_editor'=>$data['editorValue'],
                'status'=>0,
                'create_time'=>time()
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>$this->save($dataArray)];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }

        }
        public function articleUpdate($data){
            $dataArray = [
                'id'=>$data['id'],
                'article_title' =>$data['articleTitle'],
                'article_classify'=>$data['articleClassify'],
                'article_thumbnail'=>$data['articleThumbnail'],
                'article_keywords'=>$data['articleKeywords'],
                'article_abstract'=>$data['articleAbstract'],
                'article_author'=>$data['articleAuthor'],
                'article_source'=>$data['articleSource'],
                'article_editor'=>$data['editorValue'],
                'status'=>0,
                'update_time'=>time()
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>$this->update($dataArray)];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }

        }
        public function getArticleByTitle($data){
            $dataTitle = [
                ['article_title','=',$data['articleTitle']],
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>self::where($dataTitle)->find()];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }
        }
        public function getArticle(){
            $data = [
                ['status','>',-1],
            ];
            $order = [
                'update_time'=>'desc'
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>[self::where($data)->order($order)->paginate(15),self::where($data)->count()]];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }
        }
        public function getNormaArticle(){
            $data = [
                ['status','=',1],
            ];
            $order = [
                'update_time'=>'desc'
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>[self::where($data)->order($order)->paginate(15),self::where($data)->count()]];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }
        }
        public function getArticleByArticleClassify($data){
            $dataClassify = [
                ['article_classify','=',$data],
                ['status','>',-1],
            ];
            $order = [
                'update_time'=>'desc'
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>[self::where($dataClassify)->order($order)->paginate(15),self::where($dataClassify)->count()]];
            }catch (Exception $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }
        }
        public function getArticleBySearch($search){
            $dataSearch = [
                ['article_title|article_editor|article_author','like',"%".$search."%"],
                ['status','>',-1],
            ];
            $order = [
                ['update_time','=','desc']
            ];
            try{
                return ['status' => true, 'message' => 'success','data'=>[self::where($dataSearch)->order($order)->paginate(15),self::where($dataSearch)->count()]];
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
        public function getArticleById($id){
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
        public function getNormaArticleById($id){
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


}