<?php
namespace app\admin\controller;
use app\admin\model\Storeman as StoreModel;
use app\admin\controller\Base;
class Storeman extends Base
{
    public function lst()
    {
    	// $list = ArticleModel::paginate(3);
        // $list=db('article')->alias('a')->join('cate c','c.id=a.cateid')->field('a.id,a.title,a.pic,a.author,a.state,c.catename')->paginate(3);
        $list = StoreModel::paginate(10);
    	$this->assign('list',$list);
        return $this->fetch();
    }

    public function add()
    {	
    	if(request()->isPost()){

			$data=[
    			'sname'=>input('sname'),
    			'pwd'=>md5(input('pwd')),
    		];
    		$validate = \think\Loader::validate('Storeman');
    		if(!$validate->scene('add')->check($data)){
			   $this->error($validate->getError()); die;
			}
    		if(db('storeman')->insert($data)){
    			return $this->success('添加仓库成功！','lst');
    		}else{
    			return $this->error('添加仓库失败！');
    		}
    		return;
    	}
        return $this->fetch();
    }

    public function edit(){
    	$id=input('id');
		$list=db('storeman')->where('id',$id)->find();
		if(request()->isPost()){
    		$data=[
    			'id'=>input('id'),
    			'sname'=>input('username'),
    		];
    		if(input('password')){
				$data['pwd']=md5(input('password'));
			}else{
				$data['pwd']=$list['pwd'];
			}
			$validate = \think\Loader::validate('Storeman');
    		if(!$validate->scene('edit')->check($data)){
			   $this->error($validate->getError()); die;
			}
            $save=db('storeman')->update($data);
    		if($save !== false){
    			$this->success('修改仓库管理员成功！','lst');
    		}else{
    			$this->error('修改仓库管理员失败！');
    		}
    		return;
    	}
		$this->assign('list',$list);
    	return $this->fetch();
    }

    public function del(){
    	$id=input('id');
		if(db('storeman')->delete(input('id'))){
			$this->success('删除仓库成功！','lst');
		}else{
			$this->error('删除仓库失败！');
		}
    	
    }



}
