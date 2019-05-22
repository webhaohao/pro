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
            session('sid',$id);
            return $this->redirect('/index/index');
      }
}