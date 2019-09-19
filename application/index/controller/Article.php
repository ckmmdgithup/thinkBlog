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
namespace app\index\controller;

/**
 * 前台文章相关
*/
use app\common\logic\Article as Logic;
class Article extends Base
{
    //获取所有文章
    public function articleList(){

            $articleList = model('Article')->getNormaArticle()['data'];
            //return $articleList;
             $this->assign([
                 'articleList'=>$articleList[0],
                 'num'=>$articleList[1],
             ]);
            return $this->fetch();
    }
    //获取文章详情

    public function articleDetail($id){

        $articledata = model('Article')->getNormaArticleById($id);
        if ($articledata['data']==null){
            return abort(500, '文件不存在');
        }
        $this->assign([
            'articledata'=>$articledata['data']
        ]);
        return $this->fetch();

    }

}
