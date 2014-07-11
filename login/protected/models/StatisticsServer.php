<?php

define("DLOGPATH",app()->basePath.DS.'runtime'.DS."Sdata/file");

class StatisticsServer extends CActiveRecord
{
	const REGISTER		=	1000;
	const LOGIN			=	1001;
	const PAY			=	1002;
	const LOGPATH		=	DLOGPATH;
	const PLANT_7433	=	1;			//7433的平台ID
	
	static function format()
 	{
 		
 	} 	
 	
 	 static function write($d)
 	{
// 		$data = app()->request->get('data');
//		$d = explode("|", $data);
//		$platID = array_shift($d);
//		$uid = array_shift($d);
//		$actionID = array_shift($d);
//		$remoteTime = array_shift($d);
//echo $d."\n";
		file_put_contents(self::LOGPATH,$d."\n",FILE_APPEND);
 	}
	/**
 	 *	数据入库的时候，支付数据的额外操作 
 	 * @param unknown_type $data
 	 */
 	public function extra_1002($data)
 	{
 		list($d['uid'],$d['gameid'],$d['serverid'],$d['amount'],$d['remotetime'],$d['username'],$d['orderid'],$d['paytype']) = explode("|", $data['value']);
 		
 		
 		
 		$recode = TablePay::model()->find('orderid=:orderid',array(":orderid"=>$d['orderid']));
 		if ($recode){
 			return; //确保入库的时候一次只入一个
 		}
 		
 		$model = TableUserlogin::model();
 		$userRecode = $model->findByPk($d['uid']);
 		if (!$userRecode){//如果不存在这个用户，退出
 			return ;
 		}
 		

 		$d['linkid'] =$userRecode->linkid; 
 		$d['time'] = time();
 		TablePay::model()->setIsNewRecord(1);
 		TablePay::model()->attributes = $d ;
 		$flag = TablePay::model()->save();
		if ($flag){
			TablePay::model()->primaryKey = null;
		}
 	}
 	/**
 	 *	数据入库的时候，注册的额外操作 
 	 * @param unknown_type $data
 	 */
 	public function extra_1000($data)
 	{
 		list($d['uid'],$d['linkid'],$d['name'],$d['registerIP'],$d['registerTime']) = explode("|", $data['value']);
 		if (!$d['uid'])return;//没有用户id，直接结束
 		
 		$model = TableUserlogin::model();
 		$recode = $model->findByPk($d['uid']);
 		
 		if ($recode){
 			$model = $recode;
 		} else {
 			//Yii::log($data, 'err_extra1000','api');
 			//return false; //已经注册，不需要操作
 			$model->setIsNewRecord(1);
 		}
 		$model->attributes = $d ;
 		$model->save();
 	}
 	/**
 	 * 数据日志入库的时候,登录的额外操作
 	 * @param $data
 	 */
 	public static function extra_1001($data)
 	{
 		list($d['uid'],$d['remoteTime'],$d['loginIP']) = explode("|", $data['value']);
 		$d['time'] = time();
 		$mdata = TableUserlogin::model()->findByPk($d['uid']);
 		if ($mdata && $d ){
 			$mdata->attributes=$d;
 			
 			$mdata->save();
 		}else{
// 			TableUserlogin::model()->setIsNewRecord(1);
// 			TableUserlogin::model()->attributes=$d;
// 			TableUserlogin::model()->save();
 		}

 	}
 	
 	/**
 	 * 分析日志文档
 	 */
 	static function parseTxT()
 	{
 		if (!file_exists(DLOGPATH))return;
 		$newname = DLOGPATH.date("-Y-m-d-H-i-s");
 		$f = rename(DLOGPATH, $newname);
 		//$newname = DLOGPATH;
 		$fh = fopen($newname, 'rb');
 		$time = time();
 		if ($fh!==false) {
 			
	 		 while (!feof($fh)) {
	 		 	$buffer = fgets($fh, 1024);
	            $data = explode("|", $buffer);
	            $d['platID'] 	 = array_shift($data);
	            $d['typeid'] 		 = array_shift($data);
	            $d['remotetime'] = array_shift($data);
	           	$d['value']		 = trim( implode("|", $data) );
	            $d['time'] 		 = $time;
	            $d['id'] 		 = "";
	            
	            if (!$d['typeid'])continue;
	            
	           	TableDayLog::model()->attributes = $d;
	           	TableDayLog::model()->setIsNewRecord(1);
	           	TableDayLog::model()->save();
	           	TableDayLog::model()->primaryKey = 0;
           		if (method_exists(__CLASS__, "extra_{$d['typeid']}")){
           			call_user_func_array(array(__CLASS__,"extra_{$d['typeid']}"), array($d));//附加的额外操作
           		}
	           	
	        }
        }
        fclose($fh);
 	}

 	 
 	
 	
}


