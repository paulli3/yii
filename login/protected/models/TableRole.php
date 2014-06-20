<?php


class TableRole extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TableRole
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
		return '{{role}}';
	}
	/**
	 * 返回主键
	 * @see CActiveRecord::primaryKey()
	 */
	public function primaryKey()
	{
	    return 'roleID';
	    // 对于复合主键，要返回一个类似如下的数组
	    // return array('pk1', 'pk2');
	}
	


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('roleName,roleCode', 'required'),
		);
	}


	
	
	
	
}
