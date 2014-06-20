<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_uid = 0;
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		//$record=TableUser::model()->findByAttributes(array('username'=>$this->username));
		$record = TableAdmin::model()->findByAttributes(array('UserName'=>$this->username));
		if (empty($record)){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}else{
			//用户名，或者是邮箱登录，需要验证密码
			if($this->password!==authcode($record['passWd']))
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			else{
				$this->_uid = $record['uid'];
				$roleRecord = TableRole::model()->findByAttributes(array('roleID'=>$record->roleID));
				$rightList = TableRight::model()->findAll(array('condition'=>" rightID in ({$roleRecord->roleCode}) "));
				//var_dump($rightList[0]->attributes);die;
				$rightStr = "";
				foreach ($rightList as $k => $v){
					$rightStr .= $v->rightCode."|";	
				}
				$rightStr = rtrim($rightStr,'|');
				$this->setState('rightCode', $rightStr);
				$this->errorCode=self::ERROR_NONE;
			}			
		}
		return $this->errorCode;
	}
	
	
	
	
	public function getId()
	{
		return $this->_uid;
	}
	
	
	/**
	 * 是否有用户登录
	 */
	public  function isUserLogin()
	{
		return $this->_uid;
	}
	
	/**
	 * 去登录页面
	 */
	public function GoToLogin()
	{ 
		$referer = Yii::app()->request->urlReferrer;

		return url("site/login",array('next'=>$referer));
	}
	/**
	 * 获取用户信息
	 */
	public static function getUserInfo()
	{
		
	}
	
	
}


