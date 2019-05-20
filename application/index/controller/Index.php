<?php 
namespace app\index\controller;
use app\index\controller\Base;

class index extends Base{
      public function index(){
           return $this -> fetch();
      }
}