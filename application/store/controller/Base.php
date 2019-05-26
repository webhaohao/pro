<?php
namespace app\store\controller;
use think\Controller;
class Base extends Controller
{
    public function _initialize(){
        if(!session('sname')){
            $this->error('请先登录系统！','Login/index');
        }
    }
}
