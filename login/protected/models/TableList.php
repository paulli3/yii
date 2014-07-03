<?php


class TableList extends CActiveRecord
{
	const STUTAS_AVAILABLE=1;		//账号状态可用的
	const STUTAS_UNAVAILABLE=0;		//账号状态不可用
	/**
	 * Returns the static model of the specified AR class.
	 * @return TableList
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
		return '{{user.list}}';
	}
	/**
	 * 返回主键
	 * @see CActiveRecord::primaryKey()
	 */
	public function primaryKey()
	{
	    return 'id';
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
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pname,time', 'safe'),   //更新操作的时候，都会检查这里的
			array('amount', 'numerical','message'=>'你想吃霸王餐?'),
			array('username', 'required','message'=>'无名人士，你好!'),
			array('mname,department,amount', 'required'),
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
