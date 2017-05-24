<?php
namespace app\admin\validate;

use think\Validate;

class User extends Validate
{

    protected $rule = [
        'user_name' => 'require|length:5,12',
        'password'  => 'length:6,16',
    ];

    protected $message = [
        'password.length'  => '密码位数为6-16',
        'user_name.length' => '用户名位数为5-12',
    ];

}
