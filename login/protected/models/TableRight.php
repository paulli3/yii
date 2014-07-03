<?php


class TableRight extends CActiveRecord
{
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return TableRight
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function test()
	{
		var_dump($this->getDbConnection()->connectionString);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{right}}';
	}
	/**
	 * 返回主键
	 * @see CActiveRecord::primaryKey()
	 */
	public function primaryKey()
	{
	    return 'rightID';
	    // 对于复合主键，要返回一个类似如下的数组
	    // return array('pk1', 'pk2');
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rightName,rightCode', 'required'),
//			array('status', 'in', 'range'=>array(1,2,3)),
//			array('title', 'length', 'max'=>128),
//			array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'),
//			array('tags', 'normalizeTags'),
//			array('title, status', 'safe', 'on'=>'search'),
		);
	}



	
	
	
	
	
}
