<?php


class MenuList
{
	public static function getLeftMenu()
	{
		return array(
			array(
				'label'=>'用户管理',
				'menu' => array(
					array('label'=>'用户列表','link'=>"user/list"),
					array('label'=>'添加用户','link'=>"user/edit"),
					array('label'=>'权限管理','link'=>"user/rightlist"),
					array('label'=>'权限管理','link'=>"user/rightedit"),
					array('label'=>'角色管理','link'=>"user/rolelist"),
					array('label'=>'角色编辑','link'=>"user/roleedit"),
				),
			),
			array(
				'label'=>'CPS管理',
				'menu' => array(
					array('label'=>'注册查询','link'=>"cps/userlist"),
					array('label'=>'充值查询','link'=>"cps/paylist"),
					array('label'=>'提取链接','link'=>"cps/getpage"),
					array('label'=>'提取链接列表','link'=>"cps/GetPageList"),
					array('label'=>'充值排行榜','link'=>"cps/paytop"),
					array('label'=>'首次充值','link'=>"cps/firstpay"),
					array('label'=>'绑定链接','link'=>"cps/binld"),
					array('label'=>'内部充值管理','link'=>"cps/privatepay"),
				),
			),
//			array(
//				'label'=>'aaaaaaaaaaa',
//				'menu' => array(
//					array('label'=>'bbbbbbbbbbbbb1','link'=>"user/list"),
//					array('label'=>'添加用户1','link'=>"user/edit"),
//				),
//			),
//			array(
//				'label'=>'aaaaaaaaaaa',
//				'menu' => array(
//					array('label'=>'bbbbbbbbbbbbb1','link'=>"user/list"),
//					array('label'=>'添加用户1','link'=>"user/edit"),
//				),
//			),
		);
	
	}
	
	public static  function ParseLeftMenuToHTML(){
		$arr = self::getLeftMenu();
		return self::_ParseMenuToHTML($arr);
	} 
	
	private static function _ParseMenuToHTML($arr)
	{
		$html = "<ul>";
		foreach ($arr as $k => $v){
			if (!$v['link'])$html .= "<li>{$v['label']}";
			if ($v['menu']){
				
				$html .= "".self::_ParseMenuToHTML($v['menu'])."";
			}elseif ($v['link']){
				
				$html .= "<li><a href='".url($v['link'])."' onclick=\"load(this.href);return false;\">{$v['label']}</a></li>";
			}
			if (!$v['link'])$html .= "</li>";
		}
		$html .= "</ul>";
		return $html;
	}
	
	
}
