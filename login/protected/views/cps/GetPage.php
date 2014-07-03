<div class="contTop">

        <div class="contBtm"><!--div class="list hasLayout"><div class="title"><h2 class="aOrange"></h2><em><a href="http://www.lehihi.com/" class="f12px aOrange" target="_blank">查看更多&raquo;</a></em></div><ul><li><img src="http://p1.lehihi.com/2012/10/18/507f742a9e808.jpg" width="160" height="65" alt="新梦幻之城CPS" /><p>新梦幻之城CPS</p></li><li><img src="http://p1.lehihi.com/2012/09/25/5061762b8f767.jpg" width="160" height="65" alt="大侠传CPS" /><p>大侠传CPS</p></li><li><img src="http://p1.lehihi.com/2012/04/11/4f84e69fb91a6.jpg" width="160" height="65" alt="龙将CPS" /><p>龙将CPS</p></li></ul></div-->

          <div class="list hasLayout">

            <div class="title">

              <h2>获取推广链接 &nbsp; (游戏CPS)按消费提成</h2>

            </div>

<!--            <p>推广ID： 430</p>-->

            <!--p>推广链接1(注册页面)： <a href="http://www.lehihi.com/index.php/User/reg?tgid=120413" target="_blank">http://www.lehihi.com/index.php/User/reg?tgid=120413</a>&nbsp;<input type="button" class="" value=" 复制 " onclick="copyCode('http://www.lehihi.com/index.php/User/reg?tgid=120413');" /></p><p>推广链接2(游戏页面)： <a href="http://www.lehihi.com/tg/?tgid=120413" target="_blank">http://www.lehihi.com/tg/?tgid=120413</a>&nbsp;<input type="button" class="" value=" 复制 " onclick="copyCode('http://www.lehihi.com/tg/?tgid=120413');" /></p><div class="blank24"></div-->

            <p>自定义推广链接：</p>

            <p>以下功能，如果您看不懂，可以让客服给您推广链接</p>

            <p> 显示页面：

    		<select name="pageId" onchange="page.selectPage($('#pageID option:selected'))" id="pageID">
				<?php foreach ($selectList as $k => $v):?>
				<option value="<?php echo $k;?>" url="<?php echo $v['url'];?>"><?php echo $v['name'];?></option>
				<?php endforeach;?>
			</select>

            </p>

            <p> 进入游戏：

              <?php 
				echo CHtml::listBox('game', $select, $gameList, array('onchange'=>'page.selectGameID(this.value);ajaxget("'.url('cps/GetServersByGame').'?gid="+this.value,"serverlistBox")','size'=>1));
			?>

              &nbsp; 可选，注册后进入的游戏 </p>

            <p> 对应区服：
			 <span id="serverlistBox"></span>

              &nbsp;可选，默认进该游戏最新区</p>

            <p>

              <input class="btn6" value="生成"  onclick="page.createLink()" type="button">

            </p>

            <p>链接：
			<div id="li"> <input id="tg_url" style="width:500px;border:1px solid #666;padding:5px;" type="text" value=""> </div>
              

              &nbsp;

              <input class="" value=" 复制 " onclick="copyCode($('#tg_url')[0]);" type="button">

            </p>

            <script>

function copyCode(a){

	if(!document.all){

		alert("非IE浏览器请手动复制");

		return ;

	}

	if(typeof(a) == 'object'){

		var obj = a

		obj.focus();

		obj.select();

		document.execCommand("copy");

	}else{

		clipboardData.setData('Text',a);

	}

	alert("已复制到您的剪切版！");

}

</script>

            <div class="blank48"></div>

          </div>

        </div>

      </div>
      
<script>
var page = {
	pageID 		: '',
	pageUrl 	: '',
	gameID 		: '',
	serverID 	: '',
	selectPage : function(obj){
		this.pageID=obj.val();
		
		this.pageUrl = obj.attr('url');
	},
	selectGameID : function(gid){
		this.gameID=gid;
	},
	selectSid : function(sid)
	{
		this.serverID = sid;
	},
	createLink : function()
	{ 
		var APIURL = "<?php echo url("cps/getpage",array('post'=>1));?>";
		ajaxget(APIURL+"&g=" + this.gameID + "&s=" + this.serverID + "&p=" + this.pageID,"li");
		//var url = this.pageUrl + 
		
		//$("#link").val(url);
	}	
};
</script>