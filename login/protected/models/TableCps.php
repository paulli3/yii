<?php
define('API_HOST', "http://www.7433.com/");

class TableCps extends CModel
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{admin}}';
	}
	/**
	 * 返回主键
	 * @see CActiveRecord::primaryKey()
	 */
	public function primaryKey()
	{
	    return 'uid';
	    // 对于复合主键，要返回一个类似如下的数组
	    // return array('pk1', 'pk2');
	}
	
	public function attributeNames()
	{
		
	}

	
	

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('passWd2', 'safe'),   //更新操作的时候，都会检查这里的
			array('roleID', 'numerical'),
			array('UserName', 'required','message'=>'请填写用户名'),
			array('passWd', 'required','message'=>'请填写密码'),

		);
	}
	
	
	
	/**
	 * platID username password , 用户注册 
	 */
	public function Register($username,$password,$linkid,$gid,$sid)
	{
		return ($this->sendRequest('cps7433','userRegister',array(
			'username'	=>	$username,
			'password' 	=> 	$password,
			'linkid' 	=> 	$linkid,
			'gid' 	=> 	$gid,
			'sid' 	=> 	$sid,
		),true));	
		/*
		 *这样子做行不通， 直接用接口的方式，没有经过浏览器，cookie没有设置成功 ,所以需要返回地址，然后跳转
		 */
	}
	/**
	 * 检查用户名是否存在
	 * @param unknown_type $username
	 */
	public function isUsernameExists($username)
	{
		return ($this->sendRequest('cps7433','isUserExists',array('username'=>$username)));	
	}
	
	/**
	 * 根据游戏id，获取服务器
	 * @param unknown_type $gid
	 */
	public function getServerById($gid)
	{
		$key = "api:getServerById:$gid";	
		
		$val = app()->cache->get($key);
		if ($val){
			return $val;
		}else{
			$data = ($this->sendRequest('cps7433','getServerByGameID',array('pid'=>$gid)));
			app()->cache->set($key,$data,3600);
			return $data;
		}
	}
	/**
	 * 通过sid，也就是 s123 之类 获取  74330132 这样的服务器ID
	 * @param unknown_type $shortName
	 */
	public function getRealServerIdByShortName($shortName,$servers)
	{
			foreach ($servers as $k => $v){
				if ($v['server_short_name'] == $shortName)
				{
					return $v['server_id'];
				}
			}
			return false;
	}
	
	
	/**
	 * 获取游戏
	 */
	public function getAllGame()
	{
		
		$key = "api:getAllGame";	
		$val = app()->cache->get($key);
		if ($val){
			return $val;
		}else{
			$data = $this->sendRequest('cps7433','getAllgame');
			app()->cache->set($key,$data,3600);
			return $data;
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	/**
	 * 发送请求
	 * @param unknown_type $c
	 * @param unknown_type $a
	 * @param unknown_type $param
	 * @param unknown_type $return		是否返回地址
	 */
	private function sendRequest($c,$a="index",$param="",$return=false)
	{
		$param = is_array($param) ? $param : array();
		$act = array($c,$a);
		$querystring = $param ? '?'.http_build_query($param) : '';
		$url = API_HOST.implode($act,"/").$querystring;
		if ($return)return $url;
		$ret = fopenSocket($url);
		Yii::log("\nREQ=>$url\nRET=>$ret\n", 'info','api');
		if (!$ret){showError('api error url=>:url,ret=>:ret',array(':url'=>$url,':ret'=>$ret));};
		$ret1 = json_decode($ret,true);
		if (!is_array($ret1))showError('api data error url=>:url,ret=>:ret',array(':url'=>$url,':ret'=>$ret));
		return $ret1;
	}	
	
	
	
	/**
	 * 获取链接地址
	 * 
	 */
	private function getLinkUrl()
	{
		return array(
			1 => "http://localhost/admin/yii/login/index.php/cps/page", //登录页面地址
			2 => "",
		);
	}
	/**
	 * 获取游戏列表
	 */
	public function getGames()
	{
		return array(
			1 => "http://www.baidu.com",
			2 => "http://www.baidu.com",
			3 => "http://www.baidu.com",
			4 => "http://www.baidu.com",
			5 => "http://www.baidu.com",
		);
	}
	/**
	 * 生成的页面类型
	 */
	public function getPageType()
	{
		return array(
			'1' => array('name' => '注册页面' ,'url'=>'http://localhost/admin/yii/login/index.php/cps/page'),
			'2' => array('name' => '登录页面' ,'url'=>'http://localhost/admin/yii/login/index.php/cps/page'),
		);
	}
	
	
	
	

	
	
}




