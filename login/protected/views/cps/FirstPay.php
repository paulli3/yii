<div class="contTop">

        <div class="contBtm"><!--div class="list hasLayout"><div class="title"><h2 class="aOrange"></h2><em><a href="http://www.lehihi.com/" class="f12px aOrange" target="_blank">查看更多&raquo;</a></em></div><ul><li><img src="http://p1.lehihi.com/2012/10/18/507f742a9e808.jpg" width="160" height="65" alt="新梦幻之城CPS" /><p>新梦幻之城CPS</p></li><li><img src="http://p1.lehihi.com/2012/09/25/5061762b8f767.jpg" width="160" height="65" alt="大侠传CPS" /><p>大侠传CPS</p></li><li><img src="http://p1.lehihi.com/2012/04/11/4f84e69fb91a6.jpg" width="160" height="65" alt="龙将CPS" /><p>龙将CPS</p></li></ul></div-->

          <div class="income  hasLayout">
			<div id="ajaxpost"></div>
			<div class="title">
              <h2>首冲页面:</h2>
            </div>            


			<div class="first_div">
<form action="<?php echo url("cps/firstpay");?>" method="post"  id="form" >
说明：首充是指用户在游戏里面充值1元等即可获得游戏礼包，在此可批量操作<br>
　　　重复用户、不存在的用户名、已送首充用户会自动剔除，单用户单游戏服只会送一次首充<br>
　　　没有创建角色的账户会充值失败
<br><br>
输入用户名：(平台登陆账号，一行一个) ：<br>
　　　　　　　 <textarea name="username" id="username" cols="30" rows="10"></textarea>
剩余数量：<strong style="color:#f00;">0</strong>
<br>
选择游戏区服：
	 <?php 
				echo CHtml::listBox('game', $select, $gamelist, array('onchange'=>'ajaxget("'.url('cps/GetServersByGame').'?gid="+this.value,"serverlistBox")','size'=>1));
			?>
　区服：<span id="serverlistBox"><select name="areaid" id="serverID">
	<option value="0">--请选择区服--</option>
</select></span>
<br>
输入首充密码： <input type="password" name="password" id="password"> (不知道请询问客服专员)<br>

<a onclick="formclick();">tijiao</a>
</form>
</div>






            <div class="blank48"></div>

          </div>

        </div>

      </div>
      



<style type="text/css">
	.first_div{padding:20px;margin:20px auto 0px; height:auto;overflow:hidden;border:1px solid #ba3703;border-top:2px solid #ba3703;border-bottom:2px solid #ba3703;line-height:25px;color:#333;}
</style>
<script type="text/javascript">
function checkFirstFrom(){
	var username = document.getElementById("username");
	var gameid = document.getElementById("game");
	var areaid = document.getElementById("serverID");
	var password = document.getElementById("password");

	if(username.value=="" || username.value==null){
		alert("请输入用户名！");
		username.focus();
		return false;
	}else if(gameid.value=="0"){
		alert("请选择游戏！");
		return false;
	}else if(areaid.value=="0"){
		alert("请选择区服！");
		return false;
	}else if(password.value=="" || password.value==null){
		alert("请输入首充密码！");
		password.focus();
		return false;
	}
	return true;
}
function formclick()
{

	if (checkFirstFrom())
	{
		console.log(2);
		ajaxpost("form",'ajaxpost');
	}
	return false;
}
</script>








