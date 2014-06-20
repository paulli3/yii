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
