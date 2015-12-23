<?php
include_once('../../config.php'); //连接数据库 
$action = $_GET['action']; 
if($action==""){ //读取数据，返回json 
		$sql1="select sum(`res`)  from `weixin_vote`;";
		$query1=mysql_query($sql1,$link) or die(mysql_error());
		$sumvotes=mysql_fetch_row($query1);
		$sumvotes=$sumvotes[0];

		$sumvote = mysql_query("select count(*) from `weixin_flag` WHERE `vote` != '0';");
		$sum=mysql_fetch_row($sumvote);
		$sum=$sum[0];
		$i=0;
		$data = mysql_query("select * from weixin_vote"); 
        while($row1=mysql_fetch_array($data)){ 
		
		if($i==0){ 
			$arr[] = array( 
			  'id' => $row1['id'],
			  'name' => $row1['name'],
			  'y' => intval($row1['res']),
			  'sumperson'=>$sum,
			  'sumvotes'=>intval($sumvotes),
			);  
		}else{ 
		$arr[] = array( 
			  'id' => $row1['id'],
			  'name' => $row1['name'],
			  'y' => intval($row1['res'])
				); 
			}
		$i++;
    	} 
    echo json_encode($arr); 
}else if($action=="reset"){
	   $sqll = "update weixin_flag set status=2 where status=1"; 
       $queryy = mysql_query($sqll);
		if($queryy)
       	 echo '2'; 
}else if($action=="ready"){
		$data = mysql_query("select count(*) from weixin_flag where (status=2 or status=3) and fakeid>0"); 
		$arr =mysql_fetch_array($data);
    echo json_encode($arr); 
}else if($action=="ok"){ //标识中奖号码 
    $id = $_POST['id']; 
    $grade = $_POST['grade']; 
    $sql = "update weixin_flag set status=1,cjstatu=0,cjgrade=$grade where id=$id"; 
    $query = mysql_query($sql); 
	if($xuanzezu[10]){ 
    $query2 = mysql_query("select * from weixin_flag where id = $id"); 
	$row2=mysql_fetch_array($query2);
	    file_get_contents(Web_ROOT . "/moni/xiaobai.php?action=cj&type=win&tofakeid={$row2['fakeid']}");
	}
    if($query){ 
        echo '1'; 
    } 
} 

?>