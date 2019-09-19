<?php


namespace app\common\validate;


use think\Validate;

class System extends Validate
{
    protected $rule=[
        'name'=>'require|max:25',
        'parent_id'=>'require',

    ];
    protected $message = [
        'name.require'=>'名称未设置',
        'name.max:25'=>'名称不能超过25字符',
        'parent_id.require'=>'未选择分类未设置',



    ];
    protected $scene = [
        'categoryAdd'=>['name','parent_id']
    ];

}