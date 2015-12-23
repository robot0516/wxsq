<?php
include_once('../../config.php'); //连接数据库 
include('../biaoqing.php');
$action = $_GET['action'];
if($action=="reset"){
	   $sqll = "update weixin_flag set status=2 where status=1"; 
       $queryy = mysql_query($sqll);
		if($queryy)
       	 echo '2'; 
}else if($action=="ready"){
		$data = mysql_query("select * from weixin_flag where (status=2 or status=3) and fakeid>0"); 
        while($row1=mysql_fetch_array($data)){ 
		$row1['nickname']=pack('H*',$row1['nickname']);
			$row1=emoji_unified_to_html(emoji_softbank_to_unified($row1));
        $arr[] = array( 
          'id' => $row1['id'],
          'avatar' => $row1['avatar'],
          'nickname' => $row1['nickname'],
        	); 
    	} 
    echo json_encode($arr); 
}else if($action=="ok"){ //标识中奖号码 
    $id = $_POST['id']; 
    $sql = "update weixin_flag set status=1,cjstatu=0 where id=$id"; 
    $query = mysql_query($sql); 
	if($xuanzezu[10]){ 
    $query2 = mysql_query("select * from weixin_flag where id = $id"); 
	$row2=mysql_fetch_array($query2);
	include("../../moni/cj.php");
		$contant = '恭喜恭喜！您已中奖，请按照主持人的提示，到指定地点领取您的奖品！您的获奖验证码是：【'.$row2['fakeid'].'】';
		sendmassage($token,$row2['fakeid'],$contant,$cookie,$cookies);
	}
    if($query){ 
        echo '1'; 
    } 
} 

?>