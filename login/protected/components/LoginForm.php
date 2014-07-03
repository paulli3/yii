<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $password2;
	public $g;
	public $p;
	public $s;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('username, password, g,p,s', 'required'),
			
			array('password2', 'compare', 'compareAttribute' => 'password'),

		);
	}

	
}
