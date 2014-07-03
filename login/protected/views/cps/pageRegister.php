<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name . ' - 登录';
$this->script = array(
	"validate/jquery.validate.js",
);

?>
<style>
.error{color:red;}
</style>




<div id="loginform"></div>
<form action="" method="post" id="form" onsubmit="login(this);return false;">
	<?php echo CHtml::hiddenField('data[g]',$_REQUEST['gid'], $htmlOptions);?>
	<?php echo CHtml::hiddenField('data[p]',$_REQUEST['pid'], $htmlOptions);?>
	<?php echo CHtml::hiddenField('data[s]',$_REQUEST['sid'], $htmlOptions);?>
	<table>
		<tr class="<?php echo $model->getError('username') ? 'error' : '';?>">
			<td align="right">用户名</td><td>
			<?php echo CHtml::textField("data[username]",$model->username ? $model->username : '用户名' )?>
			<span><?php echo $model->getError('username');?></span> </td>
		</tr>
		<tr class="<?php echo $model->getError('password') ? 'error' : '';?>">
			<td align="right">密码</td><td>
			<?php echo CHtml::textField("data[password]",$model->password ? $model->password : '密码' , $htmlOptions)?>
			<span><?php echo $model->getError('password');?></span> </td>
		</tr>
		<tr class="<?php echo $model->getError('password2') ? 'error' : '';?>">
			<td align="right">确认密码</td><td>
			<?php echo CHtml::textField("data[password2]",$model->password2 ? $model->password2 : '再次输入密码' , $htmlOptions)?>
			<span><?php echo $model->getError('password2');?></span> </td>
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
//inputFocusNull('data_username');
//inputFocusNull('data_password');

function login(obj)
{
	if ($("#form").validate){
		ajaxpost(obj,'loginform');
	}
}

$("#form").validate({
	rules: {
		'data[username]': {
			required:true,
//			remote: 'ajax/validator.php?p=1'
			remote: '<?php echo url('cps/checkUserName');?>'
			
		},			
		'data[password]': {
			required: true,
			minlength: 4				
		},		
		'data[password2]': {
			equalTo: "#data_password"
		}
	},
	messages: {
		'data[username]': {
			required : '请填写用户名',
			remote	:	'用户名已存在',
		},
		'data[password]': {
			required 	: '请填写密码',
			minlength	:'请至少填写4个字符',
		},
		'data[password2]': {
			equalTo 	: '密码确认失败',
		},

	}
});
</script>
