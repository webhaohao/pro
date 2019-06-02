<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
     public function _initialize(){
          $this->checkUserSession();
     }
     public function checkUserSession() {  
          //设置超时为10分  
          $nowtime =time();
          $s_time = session('login_time');
          if (($nowtime - $s_time) > 600) {  
              session(null);
              $this->error('当前用户未登录或登录超时，请重新登录', 'login/index');  
          } else {  
              session('login_time',$nowtime);
          }  
     }  
}
