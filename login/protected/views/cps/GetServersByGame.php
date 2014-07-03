<?php 
echo CHtml::listBox('serverID', $select, $serverlist, array('size'=>1,'onchange'=>$_REQUEST['ajaxtarget']!="userMain" ? 'page.selectSid(this.value)':'' ));

/*
 *
 * 
 * <select name="serverID" onchange="page.selectSid(this.value,this)">
<?php foreach ($serverlist as $k=>$v):?>
	
	<option value="<?php echo $v['server_id'];?>" short_name="<?php echo $v['server_short_name'];?>"><?php echo $v['server_name'];?></option>

<?php endforeach;?>
</select>
 * 
 */

?>
