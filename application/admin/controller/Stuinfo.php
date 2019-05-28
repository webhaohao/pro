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
            //检查模板是否符合风格
            if($arrExcel[0][0]!="姓名" || ($arrExcel[0][1]!="学号" && $arrExcel[0][1]!="工号")){
                return 'fail';
            }
            $key = array('uname','stusno');
            foreach($arrExcel as $i=>$vals){
                $arrExcel[$i] = array_combine($key,$vals);
            }
            //删除数组第一项
            array_shift($arrExcel);
            $limit = 500;
            $count = ceil(count($arrExcel)/$limit);
            for($i=1;$i<=$count;$i++){
                    $offset=($i-1)*$limit;
                    $data=array_slice($arrExcel,$offset,$limit);
                    db('stuinfo')->insertAll($data);
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
            if(!input('stusno')&&!input('uname')){
                $list = Stu::paginate(10);
            }
            else{
                input('stusno')&& $map['stusno'] =['eq',input('stusno')];
                input('uname') && $map['uname'] = ['eq',input('uname')];
                $list = Stu::where($map)->paginate($listRows = 10, $simple = false, $config = [
                    'query'=>request()->param()
                ]);
            }
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
