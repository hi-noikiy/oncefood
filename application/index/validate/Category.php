<?php 
    namespace app\index\validate;
    use think\validate;


    class Category extends Validate{
        protected $rule = [
            ['name','require|max:12','用户名不能为空！|用户名长度不能超过12个字符'],
            ['sex','number|in:2,3,1'],
        ];

        protected $scene = [
            'add' => ['name','nickname','sex'],
        ];
    }