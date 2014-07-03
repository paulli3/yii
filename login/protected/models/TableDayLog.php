<?php


class TableDayLog extends CActiveRecord
{
	/**
	 * 日志表
	 * Returns the static model of the specified AR class.
	 * @return TableDayLog
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
		return '{{daylog}}';
	}
	
	public function getDbConnection()
	{
		return Yii::app()->db_7433;		//另一个库的链接
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
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('value,id', 'safe'),   //更新操作的时候，都会检查这里的
			array('typeid,platID,time,remotetime', 'numerical'),
//			array('username', 'required','message'=>'无名人士，你好!'),
//			array('mname,department,amount', 'required'),
//			array('status', 'in', 'range'=>array(1,2,3)),
//			array('title', 'length', 'max'=>128),
//			array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'),
//			array('tags', 'normalizeTags'),
//
//			array('title, status', 'safe', 'on'=>'search'),
		);
	}

	
	
	
	
	
}
