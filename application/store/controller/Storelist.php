<?php
namespace app\store\controller;
use app\store\model\Storeinfo as StoreModel;
use app\store\controller\Base;
use think\Loader;
use think\Cache;
use PHPExcel_IOFactory;
class Storelist extends Base
{
	public static $pData = 'foo';
    public function lst()
    {
		$map['storeid'] = [
			'eq',session('sid')
		];	
		$list = StoreModel::where($map)->paginate($listRows = 5, $simple = false, $config = [
			'query'=>$map
		]);
		Cache::set('store',$list,3600);
		$this->assign('list',$list);
        return $this->fetch();
    }
	public function search(){
		$map['storeid'] = [
			'eq',session('sid')
		];
		input('stusno')&& $map['stusno'] =['like',input('stusno').'%'];
		input('uname') && $map['uname'] = ['like','%'.input('uname').'%'];
		input('type')!=NULL && $map['type']=['eq',input('type')];
		input('storeid')&& $map['storeid'] = ['eq',input('storeid')];
		$list = StoreModel::where($map)->paginate($listRows = 5, $simple = false, $config = [
			'query'=>$map
		]);
		Cache::set('store',$list,3600);
		$store= db('storeman')->select();
		$this->assign('store',$store);
		$this->assign('list',$list);
		return view('lst');
	}
    public function edit(){
    	$id=input('id');
    	$list=StoreModel::where('id','eq',$id)->find();
    	if(request()->isPost()){
    		$data=[
    			'id'=>input('id'),
    			'proName'=>input('proName'),
				'price' => input('price'),
				'y_price'=>input('y_price')
    		];
			// $validate = \think\Loader::validate('cate');
    		// if(!$validate->scene('edit')->check($data)){
			//    $this->error($validate->getError()); die;
			// }
            $save=db('prolist')->update($data);
    		if($save !== false){
    			$this->success('修改成功！','lst');
    		}else{
    			$this->error('修改失败！');
    		}
    		return;
    	}
    	$this->assign('list',$list);
    	return $this->fetch();
    }

    public function del(){
		$id=input('id');
		if(db('storeinfo')->delete(input('id'))){
			$this->success('删除成功！','lst');
		}else{
			$this->error('删除失败！');
		}	
	}
	//导出excel
	public function out(){
		$path = dirname(__FILE__); //找到当前脚本所在路径
		vendor("PHPExcel.PHPExcel.PHPExcel");
		vendor("PHPExcel.PHPExcel.Writer.IWriter");
		vendor("PHPExcel.PHPExcel.Writer.Abstract");
		vendor("PHPExcel.PHPExcel.Writer.Excel5");
		vendor("PHPExcel.PHPExcel.Writer.Excel2007");
		vendor("PHPExcel.PHPExcel.IOFactory");
		$objPHPExcel = new \PHPExcel();
		$objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
		$objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
		// 设置表头信息
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', '资产编号')
			->setCellValue('B1', '资产描述')
			->setCellValue('C1', '配件描述')
			->setCellValue('D1', '配件数量')
			->setCellValue('E1', '姓名')
			->setCellValue('F1', '学号')
			->setCellValue('G1','备注')
			->setCellValue('H1','领取时间');
		//$list = StoreModel::paginate(5);
		$list =Cache::get('store','');
		$count=count($list);
		for($i=2;$i<=$count+1;$i++){
			for($j=0;$j<count($list[$i-2]['partinfo']);$j++){
				$objPHPExcel->getActiveSheet()->setCellValue('A' .($i+$j), $list[$i-2]['partinfo'][$j]['serialnum']);
				$objPHPExcel->getActiveSheet()->setCellValue('B' .($i+$j), $list[$i-2]['partinfo'][$j]['serialdes']);
				$objPHPExcel->getActiveSheet()->setCellValue('C' .($i+$j), $list[$i-2]['partinfo'][$j]['partIntr']);
				$objPHPExcel->getActiveSheet()->setCellValue('D' .($i+$j), $list[$i-2]['partinfo'][$j]['count']);
				$objPHPExcel->getActiveSheet()->setCellValue('E' .($i+$j), $list[$i-2]['uname']);
				$objPHPExcel->getActiveSheet()->setCellValue('F' .($i+$j), $list[$i-2]['stusno']);
				$objPHPExcel->getActiveSheet()->setCellValue('G' .($i+$j), $list[$i-2]['partinfo'][$j]['remarks']);
				$objPHPExcel->getActiveSheet()->setCellValue('H' .($i+$j), date("Y-m-d H:i:s",$list[$i-2]['time']));
			}
		}
		/*--------------下面是设置其他信息------------------*/

		$objPHPExcel->getActiveSheet()->setTitle('productaccess');      //设置sheet的名称
		$objPHPExcel->setActiveSheetIndex(0);                   //设置sheet的起始位置
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');   //通过PHPExcel_IOFactory的写函数将上面数据写出来
		$PHPWriter = \PHPExcel_IOFactory::createWriter( $objPHPExcel,"Excel2007");
		header('Content-Disposition: attachment;filename="无纸化仓库管理.xlsx"');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		$PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件
		exit;
	}
}
