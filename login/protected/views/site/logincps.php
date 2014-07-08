<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name . ' - 登录';

$this->styles = array(
	'styles/cps/global.css','styles/cps/index.css',
);
?>
<div id="loginform"></div>
<div class="loginForm"  style="float:none;margin:0px auto;">
<form action="" method="post" id="form" onsubmit="ajaxpost(this.id,'loginform');return false;">
	<input type="hidden" name="next" value="<?php echo $_REQUEST['next'];?>">
	<h2 class="s1" style="margin-top:0px;">登录网站联盟</h2>
	<table>
		<tbody>
          <tr class="<?php echo $model->getError('UserName') ? 'error' : '';?>">
				<td align="right" class="f14px" width="50">用户名</td><td>
				<?php echo CHtml::textField("data[UserName]",$model->UserName ? $model->UserName : '用户名'  , array('class'=>'input1'))?>
				<span><?php echo $model->getError('UserName');?></span> </td>
			</tr>
          <tr class="<?php echo $model->getError('passWd') ? 'error' : '';?>">
				<td align="right" class="f14px" width="50">密码</td><td>
				<?php echo CHtml::passwordField("data[passWd]",$model->passWd ? $model->passWd : '' , array('class'=>'input1'))?>
				<span><?php echo $model->getError('passWd');?></span> </td>
			</tr>
          
          <tr>
            <td>&nbsp;</td>
            <td>
              <div class="ss">
                <input class="ibtnLogin" id="tguserloginsb" value="" type="submit">
                <a href="#" class="underLine" onclick="return unpwd()">忘记密码？</a></div>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><a class="ibtnReg" href="#"  onclick="return unreg()"></a></td>
          </tr>
         
        </tbody>
		                		
		
	</table>
	
</form>
</div>
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

function unreg(){
	alert("注册或审核账号请联系客服");
	return false;
}

function unpwd(){
	alert("忘记密码请联系您的专属客服");
	return false;
}


</script>
