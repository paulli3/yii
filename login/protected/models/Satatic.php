<?php

define("DLOGPATH",app()->basePath.DS.'runtime'.DS."Sdata");

class Satatic
{
	const REGISTER		=	1000;
	const LOGIN			=	1001;
	const PAY			=	1002;
	const LOGPATH		=	DLOGPATH;
	const PLANT_7433	=	1;			//7433的平台ID
	
	static function format()
 	{
 		
 	} 	
 	
 	private static function write()
 	{
 		$data = app()->request->get('data');
		$d = explode("|", $data);
		$platID = array_shift($d);
		$uid = array_shift($d);
		$actionID = array_shift($d);
		$remoteTime = array_shift($d);
		file_put_contents($data, self::LOGPATH."file");
 	}
 	
}


