<?php
$openid = $_GET['wecha_id'];
session_start();
if(isset($_SESSION['openid']) && $_SESSION['openid'] == true){
	$openid = $_SESSION['openid'];
}else{
if($openid != ''){
	$_SESSION['openid']= $openid ;
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include("isweixin.php");
include("db.php");
?>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

<title>投票系统</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="../files/css/semantic.min.css" type="text/css">
<script type="text/javascript" src="../files/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../files/js/semantic.min.js"></script>
<script>
var votecannum=<?=$xuanzezu[25]?>;
var hasvoted=0;
</script>
<script type="text/javascript" src="js/vote.js"></script>
</head>
<body id='vote'>

<div class="main container">
<div class="ui page grid">
<div class="column">

		<h2 class="ui top attached green segment votehead">
		   <?=$xuanzezu[16]?><small>(请选择<red><?=$xuanzezu[25]?></red>个选项)</small>
				</h2>
		<div class="ui attached segment content">
		<form method='post' action="function.php?do=vote">
		
		<?php 
		echo '<input name="openid" value="'.$openid.'" hidden />';
		$sql_vote_check = "SELECT * FROM `weixin_flag` where `openid` = '{$openid}'";
		$query_vote_check = mysql_query($sql_vote_check);
		$vote_check = mysql_fetch_row($query_vote_check);
		if($vote_check <= 0 ){
			echo "<script>window.location='luru.php';</script>";
		}
		$class=array('','red','blue','green');
		$sql1="select sum(`res`)  from `weixin_vote`;";
		$query1=mysql_query($sql1,$link) or die(mysql_error());
		$sum=mysql_fetch_row($query1);
		$sum=$sum[0];
		if($sum == 0){$sum = 1;}
			$sql="SELECT * FROM  `weixin_vote` order by res desc";
			$query=mysql_query($sql);
		if($vote_check[3]==0){
			while($q=mysql_fetch_row($query)){
			$i++;
			$persent=sprintf("%.2f", ($q[2]/$sum)*100 );
?>				
				<div class="select">
				 <div class="ui ribbon <?=$class[$i]?> label">
					<?=$q[1]?>
					</div>
					
					<div class="ui grid">
					<div class="selecs" style="width:100%;height:3rem;z-index:9;position:absolute"></div>
						<div class = "two wide column"><a class="ui <?=$class[$i]?> label"><?=$i?></a></div>
						<div class="ui <?=$class[$i]?> progress thirteen wide column">
							
							<div class="bar"  style="width: <?=$persent?>%;"><div class="voteright" ><?=$persent?>%(<?=$q[2]?>票)</div></div>
						</div>
						<div class = "one wide column"><input type="checkbox" value="<?=$q[0]?>" class="ui radio checkbox votecheck" name="voteid[]"/></div>
					</div>
				</div>
<?php }
}else{
		while($q=mysql_fetch_row($query)){
			$i++;
			$persent=sprintf("%.2f", ($q[2]/$sum)*100 );
?>
				<div class="select">
				 <div class="ui ribbon <?=$class[$i]?> label">
					<?php 
					$votedarr=explode(",",$vote_check[3]);
						if(in_array($q[0],$votedarr)){
						echo $q[1]."【已投】";
						}else{echo $q[1];}
					?>
					</div>
					
					<div class="ui grid">
						<div class = "two wide column"><a class="ui <?=$class[$i]?> label"><?=$i?></a></div>
						<div class="ui <?=$class[$i]?> progress fourteen wide column">
							
							<div class="bar"  style="width: <?=$persent?>%;"><div class="voteright" style="right: 5%;"><?=$persent?>%(<?=$q[2]?>票)</div></div>
						</div>
					</div>
				</div>
<?php }}?>


		</div>
		<?php 
				if($vote_check[3]==0){

				echo '<button class="fluid ui  bottom attached green button" type="submit">投票</button></form>';
				}else{
				echo '</form><button id="closewindow" class="fluid ui  bottom attached red button">关闭本页面</button>';
				}
				
				?>
		
	</div>


</div>

		<small class="footer">
			<center>
			  本投票由极智微信互动大屏幕提供
			  </center>
		</small>
 </div>
</body>
</html>
