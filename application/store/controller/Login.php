<?php
namespace app\store\controller;
use think\Controller;
use app\store\model\Store;
class Login extends Controller
{
    public function index()
    {
        if(request()->isPost()){
            $store=new Store();
            $data=input('post.');
            $num=$store->login($data);
            if($num==3){
                $this->success('信息正确，正在为您跳转...','index/index');
            }elseif($num==4){
                $this->error('验证码错误','index');
            }
            else{
                $this->error('用户名或者密码错误','index');
            }

        }
        return $this->fetch('login');
    }

    



}
