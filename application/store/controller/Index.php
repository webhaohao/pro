<?php
namespace app\store\controller;
use app\store\controller\Base;
class Index extends Base
{
	
    public function index()
    {
        return $this->fetch();
    }
    public function logout(){
        session(null);
        $this->success('退出成功！','Login/index');
    }
}
