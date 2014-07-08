<?php


class TableLinks extends CActiveRecord
{
	/**
	 * 日志表
	 * Returns the static model of the specified AR class.
	 * @return TableLinks
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
		return '{{links}}';
	}
	
	public function getDbConnection()
	{
		return Yii::app()->db_7433;		//另一个库的链接
	}
	
	/**
	 * 通过用户id，获取用户的所有连接
	 * @param unknown_type $uid 
	 */
	public function getLinkIDByUserID($uid)
	{
		$data = $this->findAll("uid=:uid",array(":uid"=>$uid));
		foreach ($data as $k => $v)
		{
			$pid[] = $v['id'];
		}
		return $pid;
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
	
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gid ,sid,link,pid,uid', 'safe'),   //更新操作的时候，都会检查这里的
//			array('typeid,platID,time,remotetime', 'numerical'),
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
	
	
	
	/**
	 * 根据gid，sid 获取游戏链接地址
	 */
	private function getPageLinkGid($gid)
	{
		$cfg = array(
			'800001' => app()->request->getHostInfo()."/cps/page"
			//'800001' => "http://localhost/admin/yii/login/html/index.html"
		);
		
		return $cfg[$gid] ? $cfg[$gid] : $cfg['800001'];
	}
	
	/**
	 * 根据游戏id，服务器id，来获取游戏页面地址
	 * @param unknown_type $gid
	 * @param unknown_type $sid
	 * @param unknown_type $page
	 * param $realsid 真实的serverid
	 */
	public function getPageLinkBySidByGameId($gid,$sid,$pageType="")
	{
		$url = $this->getPageLinkGid($gid);
		//$realsid = $realsid ? $realsid : 0; 
		if (strlen($sid) == 0){
			$sid="s0";
		}
		if ($sid != "s0"){
			$table = new TableCps();
			$sids = $table->getServerById($gid);
			$realsid = $table->getRealServerIdByShortName($sid, $sids);	
		}else{
			$realsid = 0;
		}
		
		
		
		$d = $this->find("gid=:gid and sid=:sid and pid=:pid", array(':gid'=>$gid,':sid'=>$realsid,':pid'=>$pageType));
		if ($d){
			
			return array('url'=> $d->link,'linkid'=> $d->id);
		}else{
			
			
			$this->setIsNewRecord(1);
			$this->gid = $gid;
			$this->sid = $realsid;
			$this->pid = $pageType;	//页面类型
			$this->uid = user()->getId();
			$this->save();
			$this->link = $url ."?" .  http_build_query( array('gid'=>$gid,'sid'=>$sid,'pid'=>$this->getPrimaryKey()) );
			$this->save();
			return array('url'=>$this->link,'linkid'=>$this->getPrimaryKey());
		}	
		
	}
	
	
	
}
