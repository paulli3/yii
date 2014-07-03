<div class="contTop">

        <div class="contBtm"><!--div class="list hasLayout"><div class="title"><h2 class="aOrange"></h2><em><a href="http://www.lehihi.com/" class="f12px aOrange" target="_blank">查看更多&raquo;</a></em></div><ul><li><img src="http://p1.lehihi.com/2012/10/18/507f742a9e808.jpg" width="160" height="65" alt="新梦幻之城CPS" /><p>新梦幻之城CPS</p></li><li><img src="http://p1.lehihi.com/2012/09/25/5061762b8f767.jpg" width="160" height="65" alt="大侠传CPS" /><p>大侠传CPS</p></li><li><img src="http://p1.lehihi.com/2012/04/11/4f84e69fb91a6.jpg" width="160" height="65" alt="龙将CPS" /><p>龙将CPS</p></li></ul></div-->

          <div class="income  hasLayout">

			<div class="title">
              <h2>用户明细:</h2>
            </div>            


<table class="common br">
	<tr>
		<th>用户ID</th>
		<th>用户名</th>
		<th>注册时间</th>
		<th>注册ip</th>
		<th>最后登录时间</th>
		<th>最后登录IP</th>
		<th>游戏角色名称</th>
	</tr>
	
	<?php	foreach ($userlist as $k => $v):	?>
	
	<tr>
		<td><?php echo $v['uid'];?></td>
		<td><?php echo $v['name'];?></td>
		<td><?php echo mydate($v['registerTime']);?></td>
		<td><?php echo $v['registerIP'];?></td>
		<td><?php echo $v['remoteTime'] ? mydate($v['remoteTime']) : '未登录';?></td>
		<td><?php echo $v['loginIP'];?></td>
		<td><?php echo '等待游戏接口';?></td>
	</tr>
	
	
	<?php endforeach;?>
	<tr>
		<td colspan="7">
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
      












