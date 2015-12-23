<?php include('navigation.php');
include("db.php"); ?>
<link href="../files/css/semantic.min.css" media="all" rel="stylesheet" type="text/css" />
      <!-- End Navigation -->

      <div class="container main-content">
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
<div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="icon-table"></i>抽奖管理
                <div class="pull-right" style=" color:#333">
                中奖发送消息提醒：
               <div class="toggle-switch switch-small" id="autopush" data-off="warning" data-on="success" style="margin-bottom:8px">
                <input <?php if ($xuanzezu[10] == 1){echo "checked";}?> type="checkbox">
              </div>
                </div>
              </div>
              <div class="alert alert-warning">
                      <button class="close" data-dismiss="alert" type="button">×</button>声明：抽奖管理采用主动推送消息，只是为了方便活动方与用户的沟通交流，请勿频繁发送或骚扰微信用户，一切后果与作者无关。
                    </div>
              <div class="widget-content padded clearfix">
                <table class="table table-striped"  id="datatable-editable">
                  <thead>
                    <tr><th class="hidden-xs">
                      序号
                    </th>
                    <th>
                      昵称
                    </th>
                    <th>
                      sn验证码
                    </th>
                    <th class="hidden-xs">
                      状态
                    </th>
                    <th>
                      操作
                    </th>
                  </tr></thead>
                  <tbody>
                                  		   <?php
					 include('biaoqing.php');
				   $toupiao="SELECT * FROM  `weixin_flag` where status=1 ";
					$querytp=mysql_query($toupiao,$link) or die(mysql_error());
					while($q=mysql_fetch_row($querytp)){
					$q[4]=pack('H*',$q[4]);
					$q=emoji_unified_to_html(emoji_softbank_to_unified($q));
					?>
                    <tr>
                      <td class="hidden-xs">
                        <?=$q[0]?>
                      </td>
                      <td>
                        <img class="ui avatar image" src="<?=$q[5]?>"><?=$q[4]?>
                      </td>
                      <td>
                        <?=$q[7]?>
                      </td>
                      <td class="hidden-xs">
                      <?php 
					  	if ($q[11]){
							echo '<span class="label label-success">已发</span>';
							}else{
							echo '<span class="label label-warning">待办</span>';
								}
					  ?>
                      </td>
                      <td>
                      <?php 
					  	if ($q[11]){
							echo '验证　发奖';
							}else{
							echo '<a href="shenhe.do.php?do=cj_verify&cid='.$q[7].'">验证</a>　<a href=shenhe.do.php?do=cj_award&cid='.$q[0].'"">发奖</a>';
								}
					  ?>
                      </td>
                      
                    </tr>
                     <?php }?>
                    
                  </tbody>
                </table>
              </div>
            </div>
        <!-- end DataTables Example -->
  </div>
</div>
    </div>
  </body>

</html>