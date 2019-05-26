<?php
namespace app\store\model;
use think\Model;
use think\Db;
class Store extends Model
{

	public function login($data){
		$captcha = new \think\captcha\Captcha();
        if (!$captcha->check($data['code'])) {
            return 4;
        } 
		$user=Db::name('storeman')->where('sname','=',$data['username'])->find();
		if($user){
			if($user['pwd'] == md5($data['password'])){
				session('sname',$user['sname']);
				session('sid',$user['id']);
				return 3; //信息正确
			}else{
				return 2; //密码错误
			}
		}else{
			return 1; //用户不存在
		}
	}

}
