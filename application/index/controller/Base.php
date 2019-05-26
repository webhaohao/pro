<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
     public function _initialize(){
      // if(!session('sid')){
      //       $this->error('请先选择仓库！','/index/Login');
      // }
  }
}
