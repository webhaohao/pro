<?php 
namespace app\index\controller;
use think\Controller;

class Login extends Controller{
      public function index(){
          if(request()->isPost()){
              session('uid',1);
              $this->success('登录成功！','/index');
          }
          return $this -> fetch();
      }
}