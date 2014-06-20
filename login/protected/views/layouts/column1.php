<?php $this->beginContent('//layouts/common'); ?>
<style>
body{font-size:12px;}/*background:#848484;color:#E2E2E2;*/
*{margin:0;padding:0;}
table{border-collapse:collapse;}
tr.yes{background:#666}
.b td,.b th{border:2px solid #ccc;padding:5px;text-align:center;padding:10px 0;}
.mg10{margin:10px;}
a{text-decoration:none;color:#666}

input{padding:5px;margin:5px;color:#999;border:1px solid #000; width:400px;}
input:focus{color:#666;box-shadow: 0px 1px 10px #9edeff;border:1px solid #9edeff;}
:focus{outline:0;}
tr.error span{color:red;}
tr.error input{border:1px solid red;}
tr.error  input:focus{box-shadow: 0px 1px 10px #F00000;}
button{padding:5px;}

table.common{
	border :1px solid #ccc; width:100%;
}
table.common td,table.common th{border:1px solid #ccc;padding:10px;text-align:center;}
table.common th{background:#eee;font-weight:bold;}
table.common tr:hover{background:#EFEFEF;}
.ui-widget{color:#333;}
.l{float:left;}
.left{width:10%px;min-width:150px;}
#main{float:left;width:89%;}

.yiiPager li{float:left;border:1px solid #eee;padding:3px 6px;margin:0 5px;}
.yiiPager .hidden{display:none;}
.yiiPager .selected{background:#DDD;}
</style>
<div class="header mg10">
			
</div>
<div class="contents">

</div>
   <div class="l left " id="browser">
	<?php echo $this->ExtraData['leftMenu'];?>
	
   </div>
   <div class="y" id="main">
   	<?php echo $content; ?>
   </div>
<div class="footer container">
	 		
</div>
<?php $this->endContent(); ?>
<script>
_OPT.load.F('show',["#browser"],"jquery_tree");
function load(url){
	ajaxget(url,'main');
}
</script>