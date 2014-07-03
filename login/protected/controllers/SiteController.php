<?php

class SiteController extends Controller
{
	public $layout='//layouts/cps/cps';
	
	public function init()
	{
		
		//Yii::app()->language='zh_tw'; 这里设计语言
//		if (!user()->id){
//			$this->redirect(url('site/login', array('nexturl'=>urlencode(app()->request->getUrl()))));
//			
//		}
		
	}
	
	public function afterAction($action){
		if (user()->isGuest && $action->id != 'login')
		{
			$this->redirect(url('site/login', array('next'=>urlencode(app()->request->getUrl()))));
		}
		return true;
	}
	
	public function actionIndex()
	{
		
		
		
		
	}
	
	public function actionLogin()
	{	
		$this->layout='//layouts/blank';
		if (!user()->isGuest){
			$this->render('loginedcps',array('model'=>$model));
			app()->end();
		}
		
		$model = TableAdmin::model();
		$model->attributes=$_POST['data'];
		if ($_POST['data'] && $model->validate()){
			if ($model->login()){
				$nexturl = $_REQUEST['next'] ;
				$nexturl = $_REQUEST['next'] ? urldecode($_REQUEST['next']) : $_SERVER['HTTP_REFERER'];
				if (strpos($nexturl, 'loginout')!==false){$nexturl=url('cps/index');}
				
				showAutoRediect('login success',$nexturl,array('{USER}'=>user()->name));
			}else{
				showpop('user/passworld error');
			}
		}else {
			$this->render('logincps',array('model'=>$model));	
		}
	}
	
	public function actionLoginOut()
	{
		user()->logout();
	}
	
	
	
}

