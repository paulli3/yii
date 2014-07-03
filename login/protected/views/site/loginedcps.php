<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name . ' - 登录';

$this->styles = array(
	'styles/cps/global.css','styles/cps/index.css',
);
?>
<div id="loginform"></div>
<div class="loginForm"  style="float:none;margin:0px auto;">
<h2 class="s1" style="margin-top:0px;" >登录网站联盟</h2>
	  <table border="0" cellpadding="0" cellspacing="0" width="245">
        

		 
          <tr>
            <td width="50" colspan="2"><span class="f14px1"><a href="#"><?php echo user()->getName();?></a>，你好</span></td>
          </tr>
          <tr>
            <td colspan="2"><span class="f14px">欢迎您登录7433推广平台！</span>
            </td>
          </tr>			<tr>            <td colspan="2"><span class="f14px1"><a href="<?php echo url('cps/index');?>">点击查看</a></span></span>            </td>          </tr>
          <tr>
            <td colspan="2"><a href="<?php echo url('site/loginout');?>"><img src="<?php echo MediaUrl('../styles/cps/img/i_login_btnt.gif')?>" alt="" class="tui" /></a></td>
          </tr>
          <tr>
            <td colspan="2">
            <div class="kfdh">
            	<div class="kf01"><p>客服电话：</p><h1>68821889-8032 </h1></div>
            </div>
            </td>
          </tr>
          <tr>
            <td>
<!--            			<p class="f_c_5"><a href="index.php/news/show/19" target="_blank">新手上路，推广流程和办法</a></p>-->
<!--	  		<p class="f_c_5"><a href="index.php/news/show/18" target="_blank">推广违规_注意事项</a></p>-->
<!--	  		<p class="f_c_5"><a href="index.php/news/show/17" target="_blank">佣金结算规则</a></p>-->
	              </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2"><!--p class="f12px fB textCenter">首月佣金翻倍！</p><p class="f12px fB textCenter">已有&nbsp;<span class="cBrowns f18px regNum">1955</span>&nbsp;人成功加入我们</p--></td>
          </tr>
      
		 </table>
</div>
<script>


</script>
