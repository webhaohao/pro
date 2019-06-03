<?php
namespace app\store\validate;
use think\Validate;
class Storeman extends Validate
{
    protected $rule = [
        'sname'  =>  'require|max:25|unique:admin',
        'pwd' =>  'require',
    ];

    protected $message  =   [
        'sname.require' => '管理员名称必须填写',
        'sname.max' => '管理员名称长度不得大于25位',
        'sname.unique' => '管理员名称不得重复',
        'pwd.require' => '管理员密码必须填写',

    ];

    protected $scene = [
        'add'  =>  ['sname'=>'require|unique:storeman','pwd'],
        'edit'  =>  ['sname'=>'require|unique:storeman'],
    ];




}
