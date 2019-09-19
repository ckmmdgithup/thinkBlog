<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

/**
 *
 * 前台路由
 *
 */


Route::rule('/$','index/index/index');


Route::rule('articleList','index/article/articleList');
Route::rule('articleDetail/:id','index/article/articleDetail');

Route::rule('aboutme','index/aboutme/index');

Route::rule('diary','index/diary/index');
/**
 *
 * 后台路由
 *
*/
Route::rule('admin$','admin/index/index');

Route::rule('admin/login','admin/Login/login');
Route::rule('admin/loginOut','admin/Login/loginOut');

Route::rule('admin/adminList','admin/admin/adminList');
Route::rule('admin/adminAdd','admin/admin/adminAdd');
Route::rule('admin/adminUpdate','admin/admin/adminUpdate');
Route::rule('admin/adminEdit/:id','admin/admin/adminEdit');
Route::rule('admin/adminStatus','admin/admin/adminStatus');

Route::rule('admin/articleList','admin/article/articleList');
Route::rule('admin/articleSubclassList/:id','admin/article/articleSubclassList');
Route::rule('admin/articleAdd','admin/article/articleAdd');
Route::rule('admin/articleUpdate','admin/article/articleUpdate');
Route::rule('admin/articleStatus','admin/article/articleStatus');
Route::rule('admin/articleEdit/:id','admin/article/articleEdit');

Route::rule('admin/systemCategory','admin/system/systemCategory');
Route::rule('admin/systemCategoryAdd','admin/system/systemCategoryAdd');
Route::rule('admin/systemCategoryEdit/:id','admin/system/systemCategoryEdit');
Route::rule('admin/systemCategoryUpdate','admin/system/systemCategoryUpdate');

Route::rule('admin/aboutme','admin/aboutme/index');
Route::rule('admin/aboutmeModify','admin/aboutme/aboutmeModify');


Route::rule('admin/diary','admin/diary/index');
Route::rule('admin/diaryAdd','admin/diary/diaryAdd');
Route::rule('admin/diaryDel','admin/diary/diaryDel');
/**
 *
 * API路由
 *
 */

Route::rule('api/imageUpload','api/image/upload');

return [

];
