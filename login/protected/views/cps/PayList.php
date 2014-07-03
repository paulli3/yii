<div class="contTop">

        <div class="contBtm"><!--div class="list hasLayout"><div class="title"><h2 class="aOrange"></h2><em><a href="http://www.lehihi.com/" class="f12px aOrange" target="_blank">查看更多&raquo;</a></em></div><ul><li><img src="http://p1.lehihi.com/2012/10/18/507f742a9e808.jpg" width="160" height="65" alt="新梦幻之城CPS" /><p>新梦幻之城CPS</p></li><li><img src="http://p1.lehihi.com/2012/09/25/5061762b8f767.jpg" width="160" height="65" alt="大侠传CPS" /><p>大侠传CPS</p></li><li><img src="http://p1.lehihi.com/2012/04/11/4f84e69fb91a6.jpg" width="160" height="65" alt="龙将CPS" /><p>龙将CPS</p></li></ul></div-->

          <div class="income  hasLayout">

			<div class="title">
              <h2>支付明细:</h2>
            </div>            



<table class="common br">
	<tr>
		<th>序号</th>
		<th>订单ID</th>
		<th>linkFrom</th>
		<th>用户ID</th>
		<th>用户名</th>
		<th>金额</th>
		<th>所属游戏</th>
		<th>游戏所属服务器</th>
		<th>充值时间</th>
		<th>支付渠道</th>
	</tr>
	
	<?php	foreach ($paylist as $k => $v):	?>
	
	<tr>
		<td><?php echo $v['id'];?></td>
		<td><?php echo $v['orderid'];?></td>
		<td><?php echo $v['linkid'];?></td>
		<td><?php echo $v['uid'];?></td>
		<td><?php echo $v['username'];?></td>
		<td><?php echo $v['amount'];?></td>
		<td><?php echo $games[$v['gameid']];?></td>
		<td><?php echo $servers[$v['gameid']][$v['serverid']];?></td>
		<td><?php echo mydate($v['time']);?></td>
		<td><?php echo $v['paytype'];?></td>
	</tr>
	
	
	<?php endforeach;?>
	<tr>
		<td colspan="10">
			<?php 
				$this->widget('LinkPager',array(   
					'header'=>'',   
					'firstPageLabel' => '首页',  
			 		'lastPageLabel' => '末页',   
					'prevPageLabel' => '上一页',   
					'nextPageLabel' => '下一页',   
					'pages' => $pages,   
					'htmlOptions' => array('onclick'=>'load(this.href);return false;'),
					'maxButtonCount'=>13   
					)  
				);  
			?>
		</td>
	</tr>
</table>
            <div class="blank48"></div>

          </div>

        </div>

      </div>
      












