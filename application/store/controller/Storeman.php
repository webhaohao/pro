<?php
namespace app\store\controller;
use app\store\model\Store as storeModel;
use app\store\controller\Base;
class Storeman extends Base
{


    public function lst()
    {   $model= new storeModel();
    	$list = storeModel::paginate(3);
    	$this->assign('list',$list);
        return $this->fetch();
    }

    public function add()
    {	
    	if(request()->isPost()){

			$data=[
    			'username'=>input('username'),
    			'password'=>input('password'),
    		];
    		$validate = \think\Loader::validate('store');
    		if(!$validate->scene('add')->check($data)){
			   $this->error($validate->getError()); die;
			}
    		if(db('store')->insert($data)){
    			return $this->success('添加管理员成功！','lst');
    		}else{
    			return $this->error('添加管理员失败！');
    		}
    		return;
    	}
        return $this->fetch();
    }

    public function edit(){
    	$id=input('id');
    	$store=db('storeman')->find($id);
    	if(request()->isPost()){
    		$data=[
    			'id'=>input('id'),
    			'sname'=>input('username'),
    		];
    		if(input('password')){
				$data['pwd']=md5(input('password'));
			}else{
				$data['pwd']=$store['password'];
			}
			$validate = \think\Loader::validate('store');
    		if(!$validate->scene('edit')->check($data)){
			   $this->error($validate->getError()); die;
			}
            $save=db('store')->update($data);
    		if($save !== false){
    			$this->success('修改仓库管理员成功！','lst');
    		}else{
    			$this->error('修改仓库管理员失败！');
    		}
    		return;
    	}
    	$this->assign('store',$store);
    	return $this->fetch();
    }

    public function del(){
    	$id=input('id');
    	if($id != 2){
    		if(db('store')->delete(input('id'))){
    			$this->success('删除管理员成功！','lst');
    		}else{
    			$this->error('删除管理员失败！');
    		}
    	}else{
    		$this->error('初始化管理员不能删除！');
    	}
    	
    }

	public function logout(){
        session(null);
        $this->success('退出成功！','Login/index');
    }
}
