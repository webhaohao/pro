<?php
namespace app\Admin\controller;
use think\Controller;
use app\admin\model\Stuinfo as Stu;
use think\Loader;
use PHPExcel_IOFactory;
class Stuinfo extends Controller
{
    public function index()
    {
        if(request()->isPost()){
            $excel = request()->file('excel')->getInfo();
            vendor("PHPExcel.PHPExcel.PHPExcel");
            vendor("PHPExcel.PHPExcel.Writer.IWriter");
            vendor("PHPExcel.PHPExcel.Writer.Abstract");
            vendor("PHPExcel.PHPExcel.Writer.Excel5");
            vendor("PHPExcel.PHPExcel.Writer.Excel2007");
            vendor("PHPExcel.PHPExcel.IOFactory");
			$objPHPExcel = \PHPExcel_IOFactory::load($excel['tmp_name']);//读取上传的文件
            $arrExcel = $objPHPExcel->getSheet(0)->toArray();//获取其中的数据
            // array_splice($arrExcel, 1, 0);
            $key = array('uname','stusno');
            foreach($arrExcel as $i=>$vals){
                $arrExcel[$i] = array_combine($key,$vals);
            }
            for($i=1;$i<count($arrExcel);$i++){
                    $data = $arrExcel[$i];
                    $res = db('stuinfo')->insert($data);
            }
            return 'succ';
        }
        $list = Stu::paginate(10);
        $this -> assign(
                'list' ,$list
        );
        return $this->fetch();
    }
    public function edit(){
    	$id=input('id');
    	$stuinfo=db('stuinfo')->find($id);
    	if(request()->isPost()){
    		$data=[
    			'id'=>input('id'),
                'uname'=>input('uname'),
                'stusno'=>input('stusno')
    		];
            $save=db('stuinfo')->update($data);
    		if($save !== false){
    			$this->success('修改学生信息成功！','index');
    		}else{
    			$this->error('修改学生信息失败！');
    		}
    		return;
    	}
    	$this->assign('stuinfo',$stuinfo);
    	return $this->fetch();
    }
    public function search(){
            input('stusno')&& $map['stusno'] =['like',input('stusno').'%'];
            input('uname') && $map['uname'] = ['like','%'.input('uname').'%'];
            $list = Stu::where($map)->paginate($listRows = 10, $simple = false, $config = [
                'query'=>$map
            ]);
            $this -> assign(
                'list', $list
            );
            return $this -> fetch('index');
    }
    public function del(){
		$id=input('id');
		if(db('stuinfo')->delete(input('id'))){
			$this->success('删除成功！','index');
		}else{
			$this->error('删除失败！');
		}	
	}
}
