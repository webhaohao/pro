<?php
namespace app\admin\controller;
use app\admin\model\Storeinfo as StoreModel;
use app\admin\model\Partinfo as Part;
use app\admin\controller\Base;
use think\Loader;
use think\Cache;
use PHPExcel_IOFactory;
class Storelist extends Base
{
    public function lst()
    {
		
			$store= db('storeman')->select();
			//如果执行了查询操作
			if(input('search')){
					input('stusno')&& $map['stusno'] =['like',input('stusno').'%'];
					input('uname') && $map['uname'] = ['like','%'.input('uname').'%'];
					input('type')!=NULL && $map['type']=['eq',input('type')];
					input('storeid')&& $map['storeid'] = ['eq',input('storeid')];
					$list = StoreModel::where($map)->paginate($listRows = 10, $simple = false, $config = [
						'query'=>request()->param()
					]);
			}
			else{
					$list = StoreModel::where(true)->order(['id desc'])->paginate(10);
			}
			if(input('download')){
					if(input('search')){
							input('stusno')&& $map['stusno'] =['like',input('stusno').'%'];
							input('uname') && $map['uname'] = ['like','%'.input('uname').'%'];
							input('type')!=NULL && $map['type']=['eq',input('type')];
							input('storeid')&& $map['storeid'] = ['eq',input('storeid')];
							$result= StoreModel::where($map)->select();
							$this->out($result);
							return false;	
					}
					else{
							$result=StoreModel::select();
							$this->out($result);
							return false;	
					}
			}
			$this->assign('store',$store);
			//$this->assign('list',$list);
			// $list = StoreModel::where()->with('partinfo')->with('storeman')->select();
			// echo  json_encode($list);
			// die;
			return $this->fetch();
		}
	public function search(){
		input('stusno')&& $map['stusno'] =['like',input('stusno').'%'];
		input('uname') && $map['uname'] = ['like','%'.input('uname').'%'];
		input('type')!=NULL && $map['type']=['eq',input('type')];
		input('storeid')&& $map['storeid'] = ['eq',input('storeid')];
		$list = StoreModel::where($map)->paginate($listRows = 10, $simple = false, $config = [
			'query'=>request()->param()
		]);
		$result = StoreModel::where($map);
		$data[0] = $list;
		$data[1] = $result;
		//$list_s = StoreModel::where($map);
		//Cache::set('store',$list,7200);
		//$store= db('storeman')->select();
		// $this->assign('store',$store);
		// $this->assign('list',$list);
		return json($data);
	}
	public function updateData(){
			$status= input('status');
			$idlist =json_decode(input('idList'));
			$data = array();
			for($i=0;$i<count($idlist);$i++){
				$data[$i]['id'] = $idlist[$i];
				$data[$i]['status']	= $status;
			}
			$part = new Part;
			$part -> saveAll($data);
	 }
	 public function itemRemove(){
		$idlist =json_decode(input('idList'));
		db('partinfo')->delete($idlist);	
    }
    public function edit(){
			$data =file_get_contents('php://input');
			$data=json_decode($data);
			$storeinfo=[
					'storeid'=>$data->storeid,
					'type' => $data->type,
					'id' => $data->id		
			];
			$partinfo =[
					'serialnum'=>$data->serialnum,
					'serialdes'=>$data->serialdes,
					'partIntr' =>$data ->partIntr,
					'count' => $data->count,
					'remarks'=>$data->remarks,
					'id'  => $data->pid
 			];
			$res = db('storeinfo')->update($storeinfo);
			$result = db('partinfo')->update($partinfo);
			echo 'succ';
    }
	public function allData(){
			// $list = StoreModel::where(true)->with('partinfo')->with('storeman')->select();
			// foreach($list as $key=>$value){

			// }
			// dump(input('storeid'));
			// die;
			$map=array();
			input('stusno')&& $map['stusno'] =['eq',input('stusno')];
			input('uname') && $map['uname'] = ['eq',input('uname')];
			input('type')!=NULL && $map['type']=['eq',input('type')];
			input('storeid')&& $map['storeid'] = ['eq',input('storeid')];
			input('serialnum') && $map['serialnum']=['eq',input('serialnum')];
			input('status') && $map['status']=['eq',input('status')];
			$list=db('storeinfo')->alias('s')
						   ->join('partinfo p','s.id = p.sid','right')
						   ->join('storeman t','t.id = s.storeid')
						   ->Field(['p.*','p.id as pid','t.sname as sname','s.*'])
						   ->where($map)
						   ->order('s.id desc')
						   ->select();
			foreach($list as $k=>$val){
					$list[$k]['time'] = date("Y-m-d H:i:s",$val['time']);
					$list[$k]['path'] = 'http://'.$_SERVER['HTTP_HOST'].$val['path'];
			}	
			cache('list', $list, 7200);   
			echo  json_encode($list);
	}
    public function del(){
		$id=input('id');
		if(db('partinfo')->delete(input('id'))){
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
			->setCellValue('H1','仓库名称')
			->setCellValue('I1','领取时间')
			->setCellValue('J1','签名图片');
		$c = 2;
		$list =cache('list');
		$count=count($list);
		for($i=2;$i<=$count+1;$i++){
				$objPHPExcel->getActiveSheet()->setCellValue('A' .$i, $list[$i-2]['serialnum']);
				$objPHPExcel->getActiveSheet()->setCellValue('B' .$i, $list[$i-2]['serialdes']);
				$objPHPExcel->getActiveSheet()->setCellValue('C' .$i, $list[$i-2]['partIntr']);
				$objPHPExcel->getActiveSheet()->setCellValue('D' .$i, $list[$i-2]['count']);
				$objPHPExcel->getActiveSheet()->setCellValue('E' .$i, $list[$i-2]['uname']);
				$objPHPExcel->getActiveSheet()->setCellValue('F' .$i, $list[$i-2]['stusno']);
				$objPHPExcel->getActiveSheet()->setCellValue('G' .$i, $list[$i-2]['remarks']);
				$objPHPExcel->getActiveSheet()->setCellValue('H' .$i, $list[$i-2]['sname']);
				$objPHPExcel->getActiveSheet()->setCellValue('I' .$i, $list[$i-2]['time']);
				$objPHPExcel->getActiveSheet()->setCellValue('J' .$i, $list[$i-2]['path']);
				$objPHPExcel->getActiveSheet()->getCell('J'.$i)->getHyperlink()->setUrl($list[$i-2]['path']); 
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
	public function uploadExcel(){
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
						// $data=db('stuinfo')->field('uname,stusno')->select();
						// $arr = array();
						// foreach ($arrExcel as $key => $value) {
						// 				if(!in_array($value,$data)){
						// 				$arr[]=$value;
						// 		}
						// }
						// $arrExcel = $arr;
						// $limit = 500;
						// $count = ceil(count($arrExcel)/$limit);
						// for($i=1;$i<=$count;$i++){
						// 				$offset=($i-1)*$limit;
						// 				$data=array_slice($arrExcel,$offset,$limit);
						// 				db('stuinfo')->insertAll($data);
						// }
						return 'succ';
				}
	}
}
