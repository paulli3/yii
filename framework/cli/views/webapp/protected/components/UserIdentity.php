<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_uid = 0;
	private $_userInfo = array();
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
		$record=TableUser::model()->findByAttributes(array('username'=>$this->username));  
		if(!isset($record[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($this->password!==$record['userpass'])
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->_uid = $record->_uid;
			$this->_userInfo = $record;
			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode;
	}
	
	
	
	
	public function getId(){
		return $this->_uid;
	}
}