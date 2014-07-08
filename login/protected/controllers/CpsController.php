<?php

class CpsController extends Controller
{
	//public $defaultAction = 'GetPage';
	
	public function actionIndex()
	{
		$this->layout='//layouts/cps/cps';
		
		$this->render("Index",$data);
	}
	
	public function beforeAction($action){
		$allow = array(
			'api','page'
		);
		if (!user()->isGuest || in_array(strtolower($action->id), $allow)){return true;}
		
		$this->redirect(url('site/login', array('next'=>urlencode(app()->request->getUrl()))));
		
		return true;
	}
	/**
	 * 接受信息，接收上报的数据
	 */
	public function actionAPI()
	{
		$d = app()->request->getparam('d');
		$d = trim($d);
		if (!$d)return;
		StatisticsServer::write($d);
		
	}
	
	/**
	 * 用户支付列表
	 */
	public function actionPayList()
	{
		$table = new TableCps();
		
		$games = $table->getAllGame();
		
		foreach ($games as $k=>$v)
		{
			$server = $table->getServerById($v['id']);
			
			foreach ($server as $kk => $vv){
				$s[$vv['server_id']] = $vv['server_name'];
			}
			$data['servers'][$v['id']]= $s;
			$data['games'][$v['id']] = $v['product_name'];
		}
		
		$linkids = TableLinks::model()->getLinkIDByUserID(user()->getId());
		
		
		$criteria = new CDbCriteria();        
		$criteria->addInCondition('linkid', $linkids); 
		$count = TablePay::model()->count($criteria);                 
		$pager = new CPagination($count);         
		$pager->pageSize = 15;    
		$pager->applyLimit($criteria);          
		$data['paylist'] = TablePay::model()->findAll($criteria);        
		$data['pages'] = $pager;
		$this->render("PayList",$data);
	}
	/**
	 * 用户列表信息
	 */
	public function actionUserList()
	{
		$criteria = new CDbCriteria();        
		$count = TableUserlogin::model()->count($criteria);                 
		$pager = new CPagination($count);         
		$pager->pageSize = 15;    
		$pager->applyLimit($criteria);          
		$data['userlist'] = TableUserlogin::model()->findAll($criteria);        
		$data['pages'] = $pager;
		$this->render("UserList",$data);
	}
	
	/**
	 * 检查用户名是否存在
	 */
	public function actioncheckUserName()
	{
		$username = $_REQUEST['data']['username'];
		if (!$username)return;	
		$model = new TableCps();
		
		$d = $model->isUsernameExists($username);
		if ($_REQUEST['callback']){
			echo "{$_REQUEST['callback']}(" . json_encode($d). ");";die;
		}
		if ($d['isin']===0){
			echo "true";
		}else{
			echo "false";
		}
		die;
	}
	/**
	 * 显示cps页面
	 * 注册页面生成
	 */
	public function actionPage()
	{
		$this->layout = "blank";
		
		$data = app()->request->getpost('data');
		
		$model = new LoginForm();
		if ($data){
			$username 	= $data['username'];
			$password 	= $data['password'];
			$gid 		= $data['g'];
			$sid 		= $data['s'];
			$linkid 	= $data['p'];
			$model->attributes = $data;
			if ($model->validate()){
				$cps = new TableCps();//注册在这里。。
				$d = $cps->Register($username, $password, $linkid, $gid, $sid);//{"uid":true,"loginurl":"http:\/\/qj.7433.com\/s\/s245"} 
				$this->redirect($d);
			}
		}else{
			$this->render('pageRegisterNew',array('model'=>$model));	
		}
	}
	/**
	 * http://localhost/admin/yii/login/index.php/cps/parsetxt   //解析文档
	 * 分析txt 日志文档
	 */
	public function actionparseTxT()
	{
		StatisticsServer::parseTxT();
		
	}
	
	
	/**
	 * 根据游戏用户id获取serverid
	 */
	public function actionGetServersByGame()
	{
		$gid = app()->request->getParam('gid');
	
		$model = new TableCps();
		
		$data = $model->getServerById($gid);
		
		$d['s0'] = "----all server---";
		foreach ($data as $k => $v){
			$d[$v['server_short_name']] = $v['server_name'];//$v['server_short_name']
		}
//		
		$this->render('GetServersByGame',array('serverlist'=>$d));
	}
	
	/**
	 * 获取链接地址的链接列表
	 */
	public function actionGetPageList()
	{
		$data = array();
		$table = new TableCps();
		
		$games = $table->getAllGame();
		
		foreach ($games as $k=>$v)
		{
			$server = $table->getServerById($v['id']);
			
			foreach ($server as $kk => $vv){
				$s[$vv['server_id']] = $vv['server_name'];
			}
			$data['servers'][$v['id']]= $s;
			$data['games'][$v['id']] = $v['product_name'];
		}
		
		$criteria = new CDbCriteria(); 
		$criteria->addCondition("uid=".user()->getId());       
		$count = TableLinks::model()->count($criteria);                 
		$pager = new CPagination($count);         
		$pager->pageSize = 15;    
		$pager->applyLimit($criteria);          
		$artList = TableLinks::model()->findAll($criteria);     

		$data['pages'] = $pager;
		$data['list'] = $artList;
		
		$this->render('GetPageList',$data);
	}
	
	/**
	 * 获取提取页面的界面
	 */
	public function actionGetPage()
	{
		//var_dump(url('cps/page'),app()->request->getHostInfo());die;
		//$a = StatisticsClient::send_register(1);
		//var_dump($a);die;
		$model = new TableCps();
		
		if (app()->request->getquery('post'))
		{ 
			$g = app()->request->getParam('g');
			$s = app()->request->getParam('s');
			$p = app()->request->getParam('p',0); 
			
//			$servers = $model->getServerById($g);
//			$realsid = "";
//			foreach ($servers as $k => $v){
//				if ($v['server_short_name'] == $s){
//					$realsid = $v['server_id'];
//					break;
//				}
//			}
			
			$data = TableLinks::model()->getPageLinkBySidByGameId($g,$s);

			$this->render('GetPageSubmit',$data);
			
			
			return;
		}
		
		
	
		$data['selectList'] = $model->getPageType();
		
		$game = $model->getAllGame();
		
		foreach ($game as $k => $v){
			$g[$v['id']] = $v['product_name'];
		}
		
		$data['gameList'] = $g;
		
		$this->render('GetPage',$data);
		
		
	}
	
	/**
	 * 获取充值排行榜
	 */
	public function actionTopPay()
	{
		$model = new TableCps();
		
		$this->render('TopPay',$data);
	}
	
	/**
	 * 首冲页面
	 */
	public function actionFirstPay()
	{
		if ($_POST){
			$users 		= app()->request->getpost('username');
			$users = explode("\n", $users);
			$gid	 	= app()->request->getpost('game');
			$serverID 	= app()->request->getpost('serverID');
			$password 	= app()->request->getpost('password');
			showDialog(json_encode($users), '');
			
			//$this->render($view);
			//app()->end();
		}
		
		$model = new TableCps();
		
		$game = $model->getAllGame();
		
		foreach ($game as $k => $v){
			$g[$v['id']] = $v['product_name'];
		}
		$data['gamelist'] = $g;
		
		$this->render('FirstPay',$data);
		
		
	}
	
	/**
	 * bindUser
	 */	
	public function actionBinldUser()
	{
		$data['selectList'] = $model->getPageType();
		
		$this->render('BinldUser',$data);
	}
	
	/**
	 *内部充值页面 
	 * 
	 */
	public function actionPrivatePay()
	{
		$data['selectList'] = $model->getPageType();
		
		$this->render('PrivatePay',$data);
	}
	
	
	
}



class StatisticsClient
{
	const PLANT_ID		= 	1;
	const REGISTER		=	1000;
	const PAY			=	1002;
	const LOGIN			=	1001;
	
	const APIURL		=	"http://localhost/admin/yii/login/index.php/cps/api";
	
	static function send_register($uid,$param="")
	{
		$data = array(
			'pid'	=>	self::PLANT_ID,
			'act'	=>	self::REGISTER,
		);
		return self::sendRequest($data,$param);
	}

	
	
	
	private function sendRequest($data,$param="")
	{
		if (!$param)$param=array();
		$d = $data['pid']."|".$data['act']."|".time()."|".implode("|", $param);
		return self::Post(self::APIURL,array('d'=>$d));
	}
	
	private function Post($url, $post = null)
	{
	     $context = array();
	
	     if (is_array($post))
	     {
	         ksort($post);
	
	         $context['http'] = array
	         (
	             'method' => 'POST',
	             'content' => http_build_query($post, '', '&'),
	         );
	     }
	
	     return file_get_contents($url, false, stream_context_create($context));
	}
}
