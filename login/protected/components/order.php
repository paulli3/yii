<?php
class Order extends CWidget
{
	public $param=array();
	public $uid=0;
	
	public function init()
	{
		
	}
	
	public function getOrder()
	{
		if ($this->param['type']=='ajax' && $id=$this->param['pkid']){
			return TableOrder::model()->findAll("order_id=:id",array(':id'=>$id));
		}else{
			return $record = TableOrder::model()->getAllByUid($this->uid);	
		}
		
	}
	
	public function run()
	{
		$this->render('order',array(
			'data'	=> $this->getOrder()
		));
	}
}