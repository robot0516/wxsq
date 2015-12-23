<?php include('navigation.php');
?>
      <!-- End Navigation -->

 <div class="container-fluid main-content">
 <div class="row">
 	<div class=" col-lg-12">
    <center>
   	<div class="gallery-filters btn-group">
                  <a class="btn btn-sm btn-primary-outline selected" id="ww" data-filter=".waitshenhe" href="#">未审核</a><a class="btn btn-sm btn-primary-outline" data-filter=".texts" href="#">文字消息</a><a class="btn btn-sm btn-primary-outline" data-filter=".imgs" href="#">图片消息</a>
                </div>  
                
                <div class="gallery-filters btn-group success-filters">
                  <a class="btn btn-sm btn-success-outline" data-filter="*" href="#">ALL</a>
                </div>
                <div class="gallery-filters btn-group warning-filters">
                  <a class="btn btn-sm btn-warning-outline" id="ss" data-filter=".shenhe" href="#">已审核</a><a class="btn btn-sm btn-warning-outline" data-filter=".stexts" href="#">文字消息</a><a class="btn btn-sm btn-warning-outline" data-filter=".simgs" href="#">图片消息</a>
                </div>
                </center>
                </div>
                </div>
      <div class="social-wrapper">
      
  <div id="social-container"></div>
  <div class="row">
    <div class="col-lg-12">
      <div class="btn btn-lg btn-block btn-default" id="load-more">
        <i class="icon-spinner icon-spin"></i>Loading content
      </div>
    </div>
  </div>
  <div id="hidden-items">

    <!-- Share Form -->
    <div class="item widget-container share-widget fluid-height clearfix waitshenhe shenhe stexts texts imgs simgs">
      <div class="widget-content padded">
        <textarea id="sysinform" class="form-control" placeholder="发布系统公告..." rows="4"></textarea>
              <div style="padding-top:10px">
              <button id="issueSysinform" class="btn btn-lg btn-block btn-primary">发布公告</button>
   			 </div>
      </div>
    </div>
    <!-- end Share Form --><!-- Profile Widget -->
    <div class="item widget-container fluid-height profile-widget waitshenhe shenhe stexts texts imgs simgs">
      <div class="widget-content padded">
        <div class="profile-info clearfix">
          <img width="70" height="70" class="social-avatar pull-left" src="../img/0.jpg" />
          <div class="profile-details">
            <a class="user-name" href="#"><strong>互动大屏幕上墙报告</strong></a>
            <p>
             我将会告诉你本次活动的消息信息！
            </p>
            <p>
            你也可以在这里修改是否自动审核！
            </p>
          </div>
        </div>
        <div class="profile-stats">
          <div class="col-xs-4">
            <a href="#" id='waitshenhenum'>
                         <?php
			$query1=mysql_query("SELECT count(*) FROM  `weixin_wall` where `ret` = 0",$link) or die(mysql_error());
			$q=mysql_fetch_row($query1);
					?>

              <h2>
                <?=$q[0]?>
              </h2>
            </a>
            <p>
              待审核
            </p>
          </div>
          <div class="col-xs-4">
            <a href="#" id='shenhenum'>
                                     <?php
			$query1=mysql_query("SELECT count(*) FROM  `weixin_wall` where `ret` = 1",$link) or die(mysql_error());
			$q=mysql_fetch_row($query1);
					?>
              <h2>
                 <?=$q[0]?>
              </h2>
            </a>
            <p>
              已审核
            </p>
          </div>
          <div class="col-xs-4">
          <h2>
               <div class="toggle-switch switch-small" id="autoShenhe" data-off="warning" data-on="success" style="margin-bottom:8px">
                <input <?php if ($xuanzezu[9] == 0){echo "checked";}?> type="checkbox">
              </div>
              </h2>
            <p>
              自动审核
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- end Profile Widget -->
    
    <?php 
 include('biaoqing.php');
	 $sql="SELECT * FROM  `weixin_wall` order by id desc LIMIT 25";

			$query=mysql_query($sql);
			while($q=mysql_fetch_row($query)){
				$q[5]=pack('H*',$q[5]);
				$q=emoji_unified_to_html(emoji_softbank_to_unified($q));
				$q[4] = biaoqing($q[4]);
				//判断是否是审核过的
				if($q[7] == 0){
				//判断是否带图片，空为无
				if($q[9] == ''){
				?>
    <!-- Text Post -->
    <div class="item widget-container fluid-height social-entry texts waitshenhe" id="<?=$q[0]?>">
      <div class="widget-content padded">
        <div class="profile-info clearfix">
          <img width="50" height="50" class="social-avatar pull-left" src="<?=$q[6]?>" />
          <div class="profile-details">
            <a class="user-name"><strong><?=$q[5]?></strong></a>
            <p>
              <em>第<?=$q[0]?>条 type:文字消息</em>
            </p>
          </div>
        </div>
        <p class="content">
          <?=$q[4]?>
        </p>
          <div class="btn btn-sm btn-default-outline" id="sutooltip-top" data-content="审核通过此条消息">
            <a href="shenhe.do.php?do=shenhe&cid=<?php echo $q[0];?>"><i class="icon-ok-sign"></i></a>
          </div>
          <div class="btn btn-sm btn-default-outline" data-placement="top" id="sutooltip-top" data-content="删除此条消息">
            <a href="javascript:if(confirm('确定删除吗？将无法恢复！')){location.href='shenhe.do.php?do=del&cid=<?php echo $q[0];?>'}"><i class="icon-remove"></i></a>
        </div>
      </div>
    </div>
    <!-- end Text Post -->
	<?php }else{?>
    <!-- Media Post -->
    <div class="item widget-container clearfix social-entry imgs waitshenhe" id="<?=$q[0]?>">
      <div class="widget-content">
        <div class="profile-info clearfix padded">
          <img width="50" height="50" class="social-avatar pull-left" src="<?=$q[6]?>" />
          <div class="profile-details">
            <a class="user-name"><strong><?=$q[5]?></strong></a>
            <p>
              <em>第<?=$q[0]?>条 type:图片消息</em>
            </p>
          </div>
        </div>
        <img width="350" class="social-content-media" src="http://dc.wxbox.cn/pic.php?p=<?=$q[9]?>" />
        <div class="padded">
                  <div class="btn btn-sm btn-default-outline" id="sutooltip-top" data-content="审核通过此条消息">
            <a href="shenhe.do.php?do=shenhe&cid=<?php echo $q[0];?>"><i class="icon-ok-sign"></i></a>
          </div>
          <div class="btn btn-sm btn-default-outline" data-placement="top" id="sutooltip-top" data-content="删除此条消息">
            <a href="javascript:if(confirm('确定删除吗？将无法恢复！')){location.href='shenhe.do.php?do=del&cid=<?php echo $q[0];?>'}"><i class="icon-remove"></i></a>

          </div>
        </div>
      </div>
    </div>
    <!-- end Media Post -->
    <?php }}else{
		//此处为审核过的消息
						//判断是否带图片，空为无
				if($q[9] == ''){
				?>
    <!-- Text Post -->
    <div class="item widget-container fluid-height social-entry stexts shenhe" id="<?=$q[0]?>">
      <div class="widget-content padded">
        <div class="profile-info clearfix">
          <img width="50" height="50" class="social-avatar pull-left" src="<?=$q[6]?>" />
          <div class="profile-details">
            <a class="user-name"><strong><?=$q[5]?></strong></a>
            <p>
              <em>第<?=$q[0]?>条 type:文字消息</em>
            </p>
          </div>
        </div>
        <p class="content">
          <?=$q[4]?>
        </p>
               <div class="alert alert-warning">
                     此消息为已经审核通过的消息
                    </div>   

      </div>
    </div>
    <!-- end Text Post -->
	<?php }else{?>
    <!-- Media Post -->
    <div class="item widget-container clearfix social-entry simgs shenhe" id="<?=$q[0]?>">
      <div class="widget-content">
        <div class="profile-info clearfix padded">
          <img width="50" height="50" class="social-avatar pull-left" src="<?=$q[6]?>" />
          <div class="profile-details">
            <a class="user-name"><strong><?=$q[5]?></strong></a>
            <p>
              <em>第<?=$q[0]?>条 type:图片消息</em>
            </p>
          </div>
        </div>
        <img width="350" class="social-content-media" src="http://dc.wxbox.cn/pic.php?p=<?=$q[9]?>" />
        <div class="padded">
               <div class="alert alert-warning">
                      此消息为已经审核通过的消息
                    </div>   
        </div>
      </div>
    </div>
    <!-- end Media Post -->
    <?php }
		?>
		
		
		<?php }
	}
	?>
  </div>
</div>
    </div>
  </body>

</html>