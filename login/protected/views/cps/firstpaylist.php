<div class="contTop">

        <div class="contBtm"><!--div class="list hasLayout"><div class="title"><h2 class="aOrange"></h2><em><a href="http://www.lehihi.com/" class="f12px aOrange" target="_blank">查看更多&raquo;</a></em></div><ul><li><img src="http://p1.lehihi.com/2012/10/18/507f742a9e808.jpg" width="160" height="65" alt="新梦幻之城CPS" /><p>新梦幻之城CPS</p></li><li><img src="http://p1.lehihi.com/2012/09/25/5061762b8f767.jpg" width="160" height="65" alt="大侠传CPS" /><p>大侠传CPS</p></li><li><img src="http://p1.lehihi.com/2012/04/11/4f84e69fb91a6.jpg" width="160" height="65" alt="龙将CPS" /><p>龙将CPS</p></li></ul></div-->

          <div class="income  hasLayout">

			<div class="title">
              <h2>首冲明细:</h2>
            </div>            


<?php 	if ($datalist):?>
<table class="common br">
	<tr>
		<th>用户ID</th>
		<th>金额</th>
		<th>用户名</th>
		<th>状态</th>
		
	</tr>
	
	<?php
	$status = array(
		'1'		=>	'<font color=green>成功</font>',
		'-100'	=>	'<font color="#999">用户不存在</font>'
	);

	foreach ($datalist as $k => $v):	?>
	
	<tr>
		<td><?php echo $v['uid'];?></td>
		<td><?php echo $v['money'];?></td>
		<td><?php echo $v['username'];?></td>
		<td><?php echo $status[$v['status']];?></td>
	</tr>
	
	
	<?php endforeach;

	?>
	
	
		
	
	
</table>
<?php 	else :?>
<center>没有首次充值信息哦</center>
<?php 
	endif;
	?>
            <div class="blank48"></div>

          </div>

        </div>

      </div>
      












