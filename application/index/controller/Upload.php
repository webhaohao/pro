<?php 
namespace app\index\controller;
use app\index\controller\Base;

class Upload extends Base{
      public function index(){
            $data=json_decode(input('data'));
            $path=$this->upload($data);
            $tableData = $data -> tableData;
            $userInfo = $data -> userInfo;
            $storeInfo = [
                'uname' => $userInfo -> uname,
                'stusno' => $userInfo -> sno,
                'path' => $path  
            ];
            $resId = db('storeinfo')->insertGetId($storeInfo);
            if($resId){
                  $arr = array();
                  foreach($tableData as $key=>$value){
                        $arr[]=[
                              'serialnum'=>$value->serialnum,
                              'serialdes'=>$value->serialdes,
                              'partIntr'=>$value->partIntr,
                              'count'=>$value->count,
                              'remarks'=>$value->remarks,
                              'sid' =>$resId
                        ];
                  }
                  $result= db('partinfo')->insertAll($arr);
                  if($result){
                        return 'succ';
                  }
            }
      }
      public function upload($data){
          $time = date('YmdHi',time());
          $filename = $time.'.png';
          $path = './sign/';
          if(!is_dir($path)){
                mkdir($path,0777,true);
          }    
          $fileRes=file_put_contents($path.$filename,base64_decode($data->datapair));
          if($fileRes){
              return $path.$filename;
          }
      }
}