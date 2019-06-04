<?php 
namespace app\index\controller;
use think\Controller;

class Login extends Controller{
      public function index(){
          $list=db('storeman')->select();  
          $this->assign('list',$list);
          return $this -> fetch();
      }
      public function login(){
            $id = input('id');
            $pwd = input('pwd');
            $res = db('storeman')->where('id',$id)->find();
            if($res['pwd']==md5($pwd)){
                  session('login_time',time());
                  session('sid',$res['id']); 
                  echo 'succ';
            }
            else{
                 echo 'error'; 
            }
      }
}