<?php
include ('db.php');
include ('biaoqing.php');
$firstnum = $_GET['firstnum'];
$startnum = $_GET['startnum']-1;
$startnum =$firstnum - $startnum;
	 $sql="SELECT * FROM  `weixin_wall` order by id desc LIMIT {$startnum},5";

			$query=mysql_query($sql);
			while($q=mysql_fetch_row($query)){
				$q[5]=pack('H*',$q[5]);
				$q=emoji_unified_to_html(emoji_softbank_to_unified($q));
				$q[4] = biaoqing($q[4]);
				$add[] = array( 
				  'id' => $q[0],
				  'content' => content($q)
        	); 
			}
			   echo json_encode($add); 

	function content($q){
			
				//判断是否是审核过的
				if($q[7] == 0){
				//判断是否带图片，空为无
				if($q[9] == ''){
				$return = "
    <!-- Text Post -->
    <div class='item widget-container fluid-height social-entry texts waitshenhe' id='".$q[0]."'>
      <div class='widget-content padded'>
        <div class='profile-info clearfix'>
          <img width='50' height='50' class='social-avatar pull-left' src='".$q[6]."' />
          <div class='profile-details'>
            <a class='user-name'><strong>".$q[5]."</strong></a>
            <p>
              <em>第".$q[0]."条 type:文字消息</em>
            </p>
          </div>
        </div>
        <p class='content'>
          ".$q[4]."
        </p>
          <div class='btn btn-sm btn-default-outline' id='sutooltip-top' data-content='审核通过此条消息'>
            <a href='shenhe.do.php?do=shenhe&cid=".$q[0]."'><i class='icon-ok-sign'></i></a>
          </div>
          <div class='btn btn-sm btn-default-outline' data-placement='top' id='sutooltip-top' data-content='删除此条消息'>
            <a href='javascript:if(confirm('确定删除吗？将无法恢复！')){location.href='shenhe.do.php?do=del&cid=".$q[0]."'}'><i class='icon-remove'></i></a>
        </div>
      </div>
    </div>
    <!-- end Text Post --> ";}else{
		$return = "
    <!-- Media Post -->
    <div class='item widget-container clearfix social-entry imgs waitshenhe' id='".$q[0]."'>
      <div class='widget-content'>
        <div class='profile-info clearfix padded'>
          <img width='50' height='50' class='social-avatar pull-left' src='".$q[6]."' />
          <div class='profile-details'>
            <a class='user-name'><strong>".$q[5]."</strong></a>
            <p>
              <em>第".$q[0]."条 type:图片消息</em>
            </p>
          </div>
        </div>
        <img width='350' class='social-content-media' src='http://dc.wxbox.cn/pic.php?p=".$q[9]."' />
        <div class='padded'>
                  <div class='btn btn-sm btn-default-outline' id='sutooltip-top' data-content='审核通过此条消息'>
            <a href='shenhe.do.php?do=shenhe&cid=".$q[0]."'><i class='icon-ok-sign'></i></a>
          </div>
          <div class='btn btn-sm btn-default-outline' data-placement='top' id='sutooltip-top' data-content='删除此条消息'>
            <a href='javascript:if(confirm('确定删除吗？将无法恢复！')){location.href='shenhe.do.php?do=del&cid=".$q[0]."'}'><i class='icon-remove'></i></a>

          </div>
        </div>
      </div>
    </div>
    <!-- end Media Post -->
     ";}}else{
		//此处为审核过的消息
						//判断是否带图片，空为无
				if($q[9] == ''){
				$return = "
    <!-- Text Post -->
    <div class='item widget-container fluid-height social-entry stexts shenhe' id='".$q[0]."'>
      <div class='widget-content padded'>
        <div class='profile-info clearfix'>
          <img width='50' height='50' class='social-avatar pull-left' src='".$q[6]."' />
          <div class='profile-details'>
            <a class='user-name'><strong>".$q[5]."</strong></a>
            <p>
              <em>第".$q[0]."条 type:文字消息</em>
            </p>
          </div>
        </div>
        <p class='content'>
          ".$q[4]."
        </p>
               <div class='alert alert-warning'>
                     此消息为已经审核通过的消息
                    </div>   

      </div>
    </div>
    <!-- end Text Post -->
	
	
	";}else{
		$return ="
    <!-- Media Post -->
    <div class='item widget-container clearfix social-entry simgs shenhe' id='".$q[0]."'>
      <div class='widget-content'>
        <div class='profile-info clearfix padded'>
          <img width='50' height='50' class='social-avatar pull-left' src='".$q[6]."' />
          <div class='profile-details'>
            <a class='user-name'><strong>".$q[5]."</strong></a>
            <p>
              <em>第".$q[0]."条 type:图片消息</em>
            </p>
          </div>
        </div>
        <img width='350' class='social-content-media' src='http://dc.wxbox.cn/pic.php?p=".$q[9]."' />
        <div class='padded'>
               <div class='alert alert-warning'>
                      此消息为已经审核通过的消息
                    </div>   
        </div>
      </div>
    </div>
    <!-- end Media Post -->
    ";
	}}
   return $return;
		};
	

?>