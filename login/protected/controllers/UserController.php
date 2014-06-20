<?php

class UserController extends Controller
{

	/**
	 * 角色列表
	 */
	public function actionRoleList()
	{
		$criteria = new CDbCriteria();        
		$count = TableRole::model()->count($criteria);                 
		$pager = new CPagination($count);         
		$pager->pageSize = 15;    
		$pager->applyLimit($criteria);          
		$artList = TableRole::model()->findAll($criteria);        
		$this->render('viewRoleList',array('pages'=>$pager,'list'=>$artList,));
	}
	/**
	 * 删除角色
	 */
	public function actionRoleDelete()
	{
		$uid = $_REQUEST['roleID'];
		if ($uid){
			if (TableRole::model()->deleteByPk($uid)){
				showDialog('update successed', url('user/rolelist'));	
			}
		}
	}
	/**
	 * 添加修改角色信息
	 */
	public function actionRoleEdit()
	{
		$rightID=app()->request->getParam('roleID');
		$model = TableRole::model();
		if ($rightID){
			$model = $model->findByPk($rightID);
		}
		if ($_POST['data']){
			
			$_POST['data']['roleCode'] = implode( ',',$_POST['data']['roleCode']);
			$model->attributes = $_POST['data'];
			if ($model->getPrimaryKey()=='')$model->setIsNewRecord(1);
			if ($model->validate()){
				if ($model->save()){
					showPostRediect('user/rolelist');
				}
			}
		}
		$this->render('viewRoleEdit',array('model'=>$model));
	}
	
	/**
	 * 权限关联用户角色
	 */
	public function actionRightRelationRole()
	{
		
	}
	/**
	 * 权限列表查看
	 */
	public function actionRightList()
	{
		$criteria = new CDbCriteria();        
		$count = TableRight::model()->count($criteria);                 
		$pager = new CPagination($count);         
		$pager->pageSize = 15;    
		$pager->applyLimit($criteria);          
		$artList = TableRight::model()->findAll($criteria);        
		$this->render('viewRightList',array('pages'=>$pager,'list'=>$artList,));
	}
	/**
	 * 删除权限内容名称
	 */
	public function actionRightDelete()
	{
		$rightID=app()->request->getParam('rightID');
		if (TableRight::model()->deleteByPk($rightID))
		{
			showDialog('update successed', url('user/rightlist'));	
		}
	}
	/**
	 * 添加修改权限内容，名称
	 */
	public function actionRightEdit()
	{
	
		$rightID=app()->request->getParam('rightID');
		$model = TableRight::model();
		if ($rightID){
			$model = $model->findByPk($rightID);
		}
		if ($_POST['data']){
			$model->attributes = $_POST['data'];
			if ($model->getPrimaryKey()=='')$model->setIsNewRecord(1);
			if ($model->validate()){
				if ($model->save()){
					showPostRediect('user/rightlist');
				}
			}
		}
		$this->render('viwRightEdit',array('model'=>$model));
	}
	/**
	 * 删除用户
	 */
	public function actionDel()
	{
		$uid = $_REQUEST['uid'];
		if ($uid){
			if (TableAdmin::model()->deleteByPk($uid)){
				showDialog('update successed', url('user/list'));	
			}
		}
	}
	/**
	 * 编辑用户
	 */
	public function actionEdit()
	{
		if ($_REQUEST['uid']){
			$model = TableAdmin::model()->findByPk($_REQUEST['uid']);	
		}else{
			$model = TableAdmin::model();
		}
		$model->attributes = $_POST['data'];
		if ($_POST['data'] && $model->validate()){
			if (!$model->uid){
				$model->setIsNewRecord(1);
			}
			$model->passWd = authcode($model->passWd,"encode");
			if ($model->save()){
				showPostRediect('user/list');	
			}else{
				showDialog("update fail");
			}
		}
		$model->passWd = authcode($model->passWd);
		$this->render('edit',array('model'=>$model));
	}
	/**
	 * 用户列表
	 */
	public function actionList()
	{
		$criteria = new CDbCriteria();        
		$count = TableAdmin::model()->count($criteria);                 
		$pager = new CPagination($count);         
		$pager->pageSize = 15;    
		$pager->applyLimit($criteria);          
		$artList = TableAdmin::model()->findAll($criteria);        
		$this->render('list',array('pages'=>$pager,'list'=>$artList,));

	}
	
}

