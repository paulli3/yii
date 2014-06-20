<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name . ' - 登录';
$this->breadcrumbs=array(
	'About',
);

?>
<div id="loginform"></div>
<form action="" method="post" id="form" onsubmit="ajaxpost(this.id,'loginform');return false;">
	<input type="hidden" name="hidden">
	<table>
		
		                		
		<tr class="<?php echo $model->getError('UserName') ? 'error' : '';?>">
			<td align="right">用户名</td><td>
			<?php echo CHtml::textField("data[UserName]",$model->UserName ? $model->UserName : '用户名' , $htmlOptions)?>
			<span><?php echo $model->getError('UserName');?></span> </td>
		</tr>
		<tr class="<?php echo $model->getError('passWd') ? 'error' : '';?>">
			<td align="right">密码</td><td>
			<?php echo CHtml::textField("data[passWd]",$model->passWd ? $model->passWd : '密码' , $htmlOptions)?>
			<span><?php echo $model->getError('passWd');?></span> </td>
		</tr>
		<tr>
			<td><button type="submit">确定</button></td>
		</tr>
	</table>
	
</form>

<script>

function inputFocusNull(obj)
{
	obj = typeof obj == 'object' ? obj : document.getElementById(obj);
	if (!obj)return;
	obj.onfocus=function(){
		$(this).parent().addClass('hover');
		this.value = this.defaultValue == this.value ? '' : this.value;
	};
	obj.onblur=function(){
		$(this).parent().removeClass('hover');
		this.value = this.value == '' ? this.defaultValue : this.value;
	};
}
inputFocusNull('data_UserName');
inputFocusNull('data_passWd');
</script>
