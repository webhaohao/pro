<?php 
namespace app\index\controller;
use app\index\controller\Base;

class index extends Base{
      public function index(){
           if(input('storeid') && session('login_time')){
                  session('sid',input('storeid'));
                  $store = db('storeman')->where('id',input('storeid'))->find();
                  $this->assign('store',$store); 
                  return $this -> fetch();
           } 
           else{
                  return $this->redirect('/index/login');
           }
        
      }
      public function selectBysno(){
            $res = db('stuinfo')->where('stusno',input('stusno'))->find();
            return json($res);
      }
}