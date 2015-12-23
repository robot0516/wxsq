<?php

@header("Content-type: text/html; charset=utf-8");
session_start();
if(isset($_SESSION['openid']) && $_SESSION['openid'] == true){
	$openid = $_SESSION['openid'];
}else{
	echo "<script>window.location='error.php';</script>";
}
include ('isweixin.php');

include("db.php");

if(isset($_GET['do'])){

	$do = $_GET['do'];

}else{

	die("invild action");

}



switch($do){

	    case "vote":
		vote();	
 		break;

		

		}

function vote(){
    global $xuanzezu;
$id = $_POST['voteid'];
$openid = $_SESSION['openid'];
if($xuanzezu[25] != count($id)){
	echo "<script>alert('对不起，请投".$xuanzezu[25]."票！');location.href='index.php';</script>";
	die;
}
$sql_vote_check = "SELECT * FROM `weixin_flag` where `openid` = '{$openid}'";
$query_vote_check = mysql_query($sql_vote_check);
$vote_check = mysql_fetch_row($query_vote_check);
if($vote_check[3]!=0 || $vote_check <= 0){
	echo "<script>alert('您已经投过票了！');location.href='index.php';</script>";
	die;
}


$idvalues=implode(",",$id); 
    $sql_flag="UPDATE  `weixin_flag` SET  `vote` =  '{$idvalues}' WHERE `openid` = '{$openid}'";
	$succed=mysql_query($sql_flag) or die(mysql_error());
foreach ($id as $value){
	$sql_vote="UPDATE  `weixin_vote` SET  `res` =  `res`+1 WHERE `id` = '{$value}'";
	$succed=mysql_query($sql_vote) or die(mysql_error());
}
echo "<script>alert('恭喜，投票成功！');location.href='index.php';</script>";

}
	
	

?>