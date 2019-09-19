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
 * 文章管理开始
*/
use app\common\logic\Article as Logic;
class Article extends Base
{
    //获取所有文章
    public function articleList(){

            if (request()->isPost()){
                $search = input('post.searchInput');
                //return $search;
                $articleList = model('Article')->getArticleBySearch($search)['data'];
                //return $articleList;
            }else {
                $articleList = model('Article')->getArticle()['data'];
            }
            //return $articleList;
             $this->assign([
                 'articleList'=>$articleList[0],
                 'num'=>$articleList[1],
             ]);
            return $this->fetch();
    }
    //获取分类文章
    public function articleSubclassList($id){
            $articleList = model('Article')->getArticleByArticleClassify($id)['data'];
            $this->assign([
                'articleList'=>$articleList[0],
                'num'=>$articleList[1]
            ]);
            return $this->fetch('article/article_list');
    }
    //添加文章
    public function articleAdd(){
        //如果是post请求，文章添加请求
        if (request()->isPost()){
               $data = input('post.');
               //dump($data);exit();
               return (new Logic())->articleAdd($data);
        }
        //否则是打开添加页面
        return $this->fetch();
    }
    //文章更新
    public function articleUpdate(){
            $data = input('post.');
            //dump($data);exit();
            $status = (new Logic())->articleUpdate($data);
            return $status;
    }
    //修改文章状态
    public function articleStatus(){
        $data = input('get.');
        //return $data;
        $status = (new Logic())->updateStatus($data);
        return $status['message'];
    }
    //文章编辑
    public function articleEdit($id){
        $articledata = model('Article')->getArticleById($id);

        $this->assign([
            'articledata'=>$articledata['data']
        ]);
        return $this->fetch();
    }
}
