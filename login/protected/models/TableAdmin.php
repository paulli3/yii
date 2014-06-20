<?php


class TableAdmin extends CActiveRecord
{
	const STUTAS_AVAILABLE=1;		//账号状态可用的
	const STUTAS_UNAVAILABLE=0;		//账号状态不可用
	
	private $_identity;
	private $rememberMe = 0;
	public $passWd2;
	/**
	 * Returns the static model of the specified AR class.
	 * @return TableAdmin
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

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
//	private function  insetOneDemo()
//	{
//		$this->username='sample post';
//		$this->password='content for the sample post';
//		$this->time=time();
//		$this->save();
//	}
	
	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->UserName,$this->passWd);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}
	
	

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->UserName,$this->passWd);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			user()->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
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
			//array('passWd2', 'compare', 'compareAttribute' => 'passWd','on'=>'edit'),
			//
			
//			array('mname,department,amount', 'required'),
//			array('status', 'in', 'range'=>array(1,2,3)),
//			array('title', 'length', 'max'=>128),
//			array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'),
//			array('tags', 'normalizeTags'),
//
//			array('title, status', 'safe', 'on'=>'search'),
		);
	}

//	/**
//	 * 定义量表查询的规则
//	 * @return array relational rules.
//	 * self::BELONGS_TO
//	 * self::HAS_ONE, 
//	 * self::HAS_MANY 
//	 * self::MANY_MANY
//	 */
//	public function relations()
//	{
//		return array();
//	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */


	public function test()
	{
		//获得一条数据
		$a=$this->find('uid=:uid', array(':uid'=>1));
		var_dump($a->username);
		
		/*
		 * 也可以如此操作
		 * $criteria=new CDbCriteria;
			$criteria->select='title';  // 只选择 'title' 列
			$criteria->condition='postID=:postID';
			$criteria->params=array(':postID'=>10);
			$post=Post::model()->find($criteria); // $params 不需要了
			
			
			也可以如此操作
			$post=Post::model()->find(array(
			    'select'=>'title',
			    'condition'=>'postID=:postID',
			    'params'=>array(':postID'=>10),
			));
		 * */
	}
	
	
	
	
	
}
