<style>
*{margin:0;padding:0;}
li{list-style:none;}
.main{height:100%}
html,body {height:731px; width:100%; padding:0;font-size:12px;background:#000;color:#8E8E89}
#flaswf{margin:0 auto;position:relative; height:100%; width:100%;}
.regBox{position:absolute;top:0;left:50%;margin-left:-502px;width:1004px;height:600px;text-align:left;z-index:99;background:url(<?php echo MediaUrl('page/pop.png')?>) no-repeat 185px 113px;}

.regsiter{position:absolute;width:580px;height:270px;left:235px;top:213px;text-align:left;overflow:hidden;}/**2013-9-24**/
.regsiter ul{height:169px;}
.regsiter li{padding-top:24px;*padding-top:22px;vertical-align:middle;}/**2013-9-24**/
.regsiter li label{display:inline-block;display:-moz-inline-box;*display:inline;zoom:1;width:108px;}
.textInput{vertical-align:middle;width:170px;height:18px;padding:3px;background:#FFF;border:#FFFF66 1px solid;}/**2013-9-24**/
.inputInfo{padding-left:6px;vertical-align:middle;}/**2013-9-24**/
.submitbtn{float:left;display:block;width:130px;height:36px;line-height:36px;font-size:20px;color:#FFF;font-family: "微软雅黑","黑体";text-align: center;border:none;background:url(<?php echo MediaUrl('page/anbg.gif')?>) repeat-x;cursor:pointer;}/** 2014.1.21 **/
.btBox{padding-left:64px; padding-left: 113px;padding-top: 10px;}
/** 2014.1.21 **/
.lyhdl{margin:0 0 0 20px;float:left;display:block;width:130px;height:36px;line-height:36px;font-size:20px;color:#FFF;font-family: "微软雅黑","黑体";text-align: center;background:url(<?php echo MediaUrl('page/anbg.gif')?>) repeat-x;cursor:pointer;text-decoration:none;}
</style>
<script type="text/javascript">
	function GetQueryString(name) {
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
	   	var r = window.location.search.substr(1).match(reg);
	    if (r != null) return unescape(r[2]); return null;
	}
</script>
</head>
<script src="http://res.1797wan.com/plat/static/js/jquery.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('#gid').val(GetQueryString('gid'));
	$('#sid').val(GetQueryString('sid'));
	$('#pcid').val(GetQueryString('pcid'));
	

	var _inputInfo = $(".inputInfo");
    $("#account").blur(function(){
        var reg1 = /^[a-zA-Z][a-zA-Z0-9_]{5,14}$/;
		if (!reg1.test($("#account").val())) {
				$(_inputInfo[0]).text("帐号由6-15位字母数字组成且以字母开头！").css("color","red");
				 return false;
		}
        $.getJSON("<?php echo url('cps/checkUserName');?>?callback=?",{"data[username]":$("#account").val()},function(data){
            console.log(data);
            if (data.isin==1) {
				$(_inputInfo[0]).text("对不起，账号已存在！").css("color","red");
            }else if(data.isin==0){
				$(_inputInfo[0]).text("恭喜您，您的账号可用！").css("color","#58C621");
			}
            
        })
    })
   
	$("#flaswf").html('<object id="flashAD" align="top" height="100%" width="100%" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"><param value="<?php echo MediaUrl('page/sgh.swf');?>" name="movie"/><param value="false" name="allowFullScreen"/><param name="salign" value="T" /><param name="allowScriptAccess" value="always" /><param value="high" name="quality"/><param value="noscale" name="SCALE"/><param value="transparent" name="wmode"/><embed height="100%" width="100%" allowfullscreen="false" wmode="transparent" scale="noscale" type="application/x-shockwave-flash" pluginspage=" http://www.macromedia.com/go/getflashplayer" quality="high" src="<?php echo MediaUrl('page/sgh.swf');?>"/></object>');
	
    
	
	if($('#gid').val()==26){
		var title = "攻城掠地";	
	}else if($('#gid').val()==34){
		var title = "天行剑";	
	}else if($('#gid').val()==38){
		var title = "女神联盟";	
	}else{
		var title = "7433玩游戏平台";
	}
	document.title=title; 
	
	
})

</script>
<body>
	<div id="flaswf"></div>
	<div class="regBox" style="display:none;">		  
		  <div id="show" class="regsiter">
			<form id="myform"  name="myform" action="<?php echo url('cps/page');?>" method="post" target="_parent">
			  
				<?php echo CHtml::hiddenField('data[g]',$_REQUEST['gid'], $htmlOptions);?>
				<?php echo CHtml::hiddenField('data[p]',$_REQUEST['pid'], $htmlOptions);?>
				<?php echo CHtml::hiddenField('data[s]',$_REQUEST['sid'], $htmlOptions);?>

			  <ul>
				<li>
				  <label for="username">&nbsp;&nbsp;&nbsp;&nbsp;</label>
				  <span>
				  <input type="text" id="account" name="data[username]" class="textInput"/>
				  </span><span class="inputInfo">帐号由6-15位字母数字组成且以字母开头！</span></li>
				<li>
				  <label for="username">&nbsp;&nbsp;&nbsp;&nbsp;</label>
				  <span>
				  <input type="password" id="password" name="data[password]" class="textInput"/>
				  </span><span class="inputInfo">请输入密码,长度6-20个字符！</span></li>
				<li>
				  <label for="username">&nbsp;&nbsp;&nbsp;&nbsp;</label>
				  <span>
				  <input type="password" id="confirmpasswd" name="data[password2]" class="textInput"/>
				  </span><span class="inputInfo">请再次输入密码，确保密码无误！</span></li>
			  </ul>
			  <div class="btBox">
				<input name="SubmitBtn" class="submitbtn" type="submit" value="开始游戏"/>
				<a class="lyhdl" target="_blank" href="http://www.7433.com/" style="display:none">老用户登录</a>
			  </div>
			</form>
		  </div>	
		<script>
		 
			
		function showForms(value){
			$(".regBox").show();
			if (document.getElementById('phpbox'))return;	
			var div = document.createElement("div");
			div.id="phpbox";
			div.style.cssText="filter:alpha(opacity=80); opacity: 0.8;background:#000;height:100%;width:100%;position:absolute;left:0;top:0;";
			document.body.appendChild(div);	
		}     
		</script>
	</div>  
	
<div style="width:100%;height:100%;position:absolute;left:0;top:0;z-index:2" onclick="showForms();"></div>
	