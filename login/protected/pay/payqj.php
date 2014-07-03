<?php
class payqj
{
	const KEY_PAY 	= "4c265d72f57635dba6688bc717149545";
	const PLAT_ID	= "36";
	const KEY_LOGIN = "";
	private $sid;
	private $payurl,$loginurl,$checkuserurl;
	
	public function __construct($sid)
	{
		$this->sid = $sid;
		$this->payurl 		= "http://{$sid}.qj.7433.com/pay.php";
		$this->loginurl 	= "http://{$sid}.qj.7433.com/check.php";
		$this->checkuserurl = "http://{$sid}.qj.7433.com/checkuser.php";
	}
	
	public function _hash($num="")
	{
		$str = "";
		$num = $num ? $num : 6;
		for ($i=0;$i<$num;++$i)
		{
			$str .= rand(0, 9);
		}
		return $str;
	}
	/**
	 * 开始支付接口
	 */
	public function pay($money,$uid)
	{
		$orderid = "7433CPS|".date('YMDhis').$this->_hash(6);
		 $data = array(
	        'money' => $money,
	        'orderid' => $orderid,
	        'paypoint' => $money * 10,
	        'platid' => self::PLAT_ID,
	        'platuid' => $uid,
	        'sid' => self::PLAT_ID . trim($this->sid,"s"),
	        'tm' => time(),
	    );
	    $sign = md5(format($data).$key);
	    $data['sig']=$sign;
	    $apiUrl = $this->payurl."?".format($data);
	    $flag = file_get_contents($apiUrl);
	    Yii::log("\nREQ=>$apiUrl\nRET=>$flag\n", 'info','firstpay');
	    return $flag;
	}
	
	private function format($arr)
	{
	    foreach($arr as $k=>$v){
	        $ret .= $fh.$k."=".$v;
	        $fh = "&";
	    }
	    return $ret;
	}
	
	
	
}