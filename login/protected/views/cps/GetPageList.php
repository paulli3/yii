<div class="contTop">

        <div class="contBtm"><!--div class="list hasLayout"><div class="title"><h2 class="aOrange"></h2><em><a href="http://www.lehihi.com/" class="f12px aOrange" target="_blank">查看更多&raquo;</a></em></div><ul><li><img src="http://p1.lehihi.com/2012/10/18/507f742a9e808.jpg" width="160" height="65" alt="新梦幻之城CPS" /><p>新梦幻之城CPS</p></li><li><img src="http://p1.lehihi.com/2012/09/25/5061762b8f767.jpg" width="160" height="65" alt="大侠传CPS" /><p>大侠传CPS</p></li><li><img src="http://p1.lehihi.com/2012/04/11/4f84e69fb91a6.jpg" width="160" height="65" alt="龙将CPS" /><p>龙将CPS</p></li></ul></div-->

          <div class="income  hasLayout">

			<div class="title">
              <h2>链接明细:</h2>
            </div>            


<?php 
if ($list):
?>

<table class="common">
	<tr>
		<th>游戏</th>
		<th>区服</th>
		<th>链接地址</th>
<!--		<th>页面类型</th>-->
<!--		<th>操作</th>-->
	</tr>
	<?php foreach ($list as $k => $v):?>
	<tr>
		<td><?php echo $games[$v['gid']];?></td>
		<td><?php echo $v['sid'] ? $servers[$v['gid']][$v['sid']] : ($v['sid']==0 ? '全部服务器' : $v['sid']);//$servers[$v['gid']][$v['sid']];?></td>
		
		<td><a href="<?php echo $v['link'];?>" target="blank"><?php echo $v['link'];?></a></td>
<!--		<td><?php echo $v['pid'];?></td>-->
		<!-- <td>
		<a href="<?php echo url('cps/getpage',array('id'=>$v['id']));?>" onclick="showWindow('useredit<?php echo $v['id'];?>',this.href);">编辑</a>  -->
<!--			 <a href="<?php echo url('cps/getpage',array('id'=>$v['id']));?>" onclick="load(this.href);return false;">删除</a> </td>		-->
	</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="5">
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
<?php endif;?>
            <div class="blank48"></div>

          </div>

        </div>

      </div>
      










