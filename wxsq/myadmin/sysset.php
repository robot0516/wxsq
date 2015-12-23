<?php include('navigation.php');
 ?>
      <!-- End Navigation -->
	  
      <div class="container main-content">
        <!-- DataTables Example -->
          <div class="col-lg-6">
		            <div class="row">

            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="icon-comments-alt"></i>互动大屏幕设置
              </div>
      <div class="widget-content padded form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-4">自动审核:</label>
            <div class="col-md-7">
               <div class="toggle-switch" id="autoShenhe" data-off="warning" data-on="success" style="margin-bottom:8px">
                <input <?php if ($xuanzezu[9] == 0){echo "checked";}?> type="checkbox">
              </div>
            </div>
            </div>
          <div class="form-group">
            <label class="control-label col-md-4">循环播放:</label>
            <div class="col-md-7">
               <div class="toggle-switch" id="circulation" data-off="warning" data-on="success" style="margin-bottom:8px">
                <input <?php if ($xuanzezu[22]){echo "checked";}?> type="checkbox">
              </div>
            </div>
            </div>
          <div class="form-group">
            <label class="control-label col-md-4">前台刷新间隔（秒）:</label>
            <div class="col-md-7">
               <form action="shenhe.do.php?do=refreshtime" id="feikong-form1" method="post"> 
               <div class="input-group">
                <input class="form-control" value="<?=$xuanzezu[23]?>" name="name" type="text"/><span class="input-group-btn"><button class="btn btn-primary" type="submit">修改</button></span>
                 </div>
        		 </form> 
                 </div>
           	</div>
          <div class="form-group">
            <label class="control-label col-md-4">发送消息间隔（秒）:</label>
            <div class="col-md-7">
               <form action="shenhe.do.php?do=interval" id="feikong-form1" method="post"> 
               <div class="input-group">
                <input class="form-control" value="<?=$xuanzezu[11]?>" name="name" type="text"/><span class="input-group-btn"><button class="btn btn-primary" type="submit">修改</button></span>
                 </div>
        		 </form> 
                 </div>
           	</div>
                 <div class="alert alert-warning">
                      <button class="close" data-dismiss="alert" type="button">×</button>话题修改为空则为无话题，直接发送即可。
                    </div>
          <div class="form-group">
            <label class="control-label col-md-4">互动大屏幕话题:</label>
            <div class="col-md-7">
               <form action="shenhe.do.php?do=huati" method="post"> 
               <div class="input-group">
                <input class="form-control" value="<?=$xuanzezu[0]?>" name="name" type="text"/><span class="input-group-btn"><button class="btn btn-primary" type="submit">修改</button></span>
                 </div>
        		 </form> 
           		</div>
           </div>
                 <div class="alert alert-warning">
                      <button class="close" data-dismiss="alert" type="button">×</button>此处为互动大屏幕顶部滚动的信息内容。
                    </div>
          <div class="form-group">
            <label class="control-label col-md-3">互动大屏幕欢迎语1:</label>
            <div class="col-md-8">
               <form action="shenhe.do.php?do=huanying1" method="post" id="feikong-form2"> 
               <div class="input-group">
                <input class="form-control" value="<?=$huanying1?>" name="name" type="text"/><span class="input-group-btn"><button class="btn btn-primary" type="submit">修改</button></span>
                 </div>
        		 </form> 
                 </div>
           	</div>
          <div class="form-group">
            <label class="control-label col-md-3">互动大屏幕欢迎语2:</label>
            <div class="col-md-8">
               <form action="shenhe.do.php?do=huanying2" method="post" id="feikong-form3"> 
               <div class="input-group">
                <input class="form-control" value="<?=$huanying2?>" name="name" type="text"/><span class="input-group-btn"><button class="btn btn-primary" type="submit">修改</button></span>
                 </div>
        		 </form> 
           	</div>
           </div>

                </div>
            </div>
			</div>
			<div class="row">
			<div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="icon-comments-alt"></i>手动登陆
              </div>
				<div class="widget-content padded form-horizontal">
				
				      <div class="alert alert-success" id="labal-logened">
                      <button class="close" data-dismiss="alert" type="button">×</button>您当前已处于登陆状态，不需要手动登陆，无需次操作！
                    </div>
				      <div class="alert alert-warning" id="labal-needlogin" style="display:none;">
                      <button class="close" data-dismiss="alert" type="button" >×</button>您当前属于未登陆状态，如果您的账号在登陆微信公众平台有验证码，会导致自动登陆失败，可以在此处进行手动登陆。
                    </div>
			 <form action="shenhe.do.php?do=monilogin" method="post" id="feikong-form7"> 
					<div class="form-group">
					<label class="control-label col-md-3">微信登录账号:</label>
							<div class="col-md-8">
							<input class="form-control" value=<?=USER?> disabled name="wxuser" id="wxuser" type="text"/>
							</div>			
				   </div>
					<div class="form-group">
					<label class="control-label col-md-3">微信登录密码:</label>
							<div class="col-md-8">
							<input class="form-control" value="" disabled name="wxpwd" type="password" id="codepwd"/>
							</div>			
				   </div>
					<input class="form-control" value="" name="codecookie" type="hidden" id="codecookie"/>
					<div class="form-group">
					<label class="control-label col-md-3">验证码:</label>
							<div class="col-md-4">
							<input class="form-control" value="" name="verify" disabled type="text" id="codetext"/>
							</div>	
                            <div id="img-logened" style="display:none">
							<img src="" class="col-md-4"/>
                            </div>
				   </div>
				<button class="btn btn-lg btn-block " id="button-logened" disabled>手动登陆</button>
        		 </form> 

                </div>
            </div>
			</div>
			<div class="row">
			<div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="icon-comments-alt"></i>技术支持
              </div>
				<div class="widget-content padded form-horizontal">
				
				      <div class="alert alert-success" id="labal-logened">
                      <button class="close" data-dismiss="alert" type="button">×</button>本功能由极智技术提供技术支持<a href="http:///"></a>
                    </div>
				  
			
                </div>
            </div>
			</div>
        </div>
        
        <!-- end DataTables Example -->        
        
          <div class="col-lg-6">
          <div class="row">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="se7en-flag"></i>　功能管理
              </div>
      <div class="widget-content padded form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-3">摇一摇开关:</label>
            <div class="col-md-8">
               <div class="toggle-switch" id="shake_open" data-off="danger" data-on="success" style="margin-bottom:8px">
                <input  <?php if ($xuanzezu[12]){echo "checked";}?>  <?php if (!$shake){echo "disabled";}?> type="checkbox">
              </div>
                   </div>
                   </div>
          <div class="form-group">
            <label class="control-label col-md-3">摇一摇触发词:</label>
            <div class="col-md-8">
               <form action="shenhe.do.php?do=changeconfig&cof=shakekeyword" method="post" id="validate-form"> 
               <div class="input-group">
                <input class="form-control" <?php if(!$shake){echo "disabled";}?> value="<?=$xuanzezu[13]?>" name="name" type="text"/><span class="input-group-btn"><button class="btn btn-success" type="submit">修改</button></span>
                 </div>
        		 </form> 
                   </div>
                   </div>
          <div class="form-group">
            <label class="control-label col-md-3">投票开关:</label>
            <div class="col-md-8">
               <div class="toggle-switch" id="vote_open" data-off="danger" data-on="success" style="margin-bottom:8px">
                <input <?php if ($xuanzezu[14]){echo "checked";}?> <?php if(!$vote){echo "disabled";}?> type="checkbox">
              </div>
                   </div>
                   </div>
          <div class="form-group">
            <label class="control-label col-md-3">投票触发词:</label>
            <div class="col-md-8">
               <form action="shenhe.do.php?do=changeconfig&cof=votekeyword" method="post" id="validate-form"> 
               <div class="input-group">
                <input class="form-control" <?php if(!$vote){echo "disabled";}?> value="<?=$xuanzezu[15]?>" name="name" type="text"/><span class="input-group-btn"><button class="btn btn-success" type="submit">修改</button></span>
                 </div>
        		 </form> 
                   </div>
                   </div>
      </div>
          </div></div>
          
          
      <div class="row">
          <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="icon-user"></i>系统设置
          </div>
      <div class="widget-content padded form-horizontal">
	  <div class="row">
                 <div class="alert alert-warning">
                      <button class="close" data-dismiss="alert" type="button">×</button>回复小尾巴是指在微信的回复中最下面所带的内容。
                    </div>
          <div class="form-group">
            <label class="control-label col-md-3">回复小尾巴:</label>
            <div class="col-md-8">
               <form action="shenhe.do.php?do=changeconfig&cof=endtail" method="post" id="feikong-form4"> 
               <div class="input-group">
                <input class="form-control" value="<?=$xuanzezu[4]?>" name="name" type="text"/><span class="input-group-btn"><button class="btn btn-success" type="submit">修改</button></span>
                 </div>
        		 </form> 
           	</div>
           </div>
<div class="widget-content padded">
                <button class="btn btn-lg btn-block btn-primary" onclick="javascript:if(confirm('确定清空所有互动大屏幕数据吗？将无法恢复！')){location.href='shenhe.do.php?do=del_all'}">清空互动大屏幕内容</button>
                <button class="btn btn-lg btn-block btn-danger" onclick="javascript:if(confirm('确定清空所有数据吗？将无法恢复！')){location.href='shenhe.do.php?do=del_vote'}">清空所有用户信息</button>
                <button class="btn btn-lg btn-block btn-warning" id='changepwd'>修改管理员密码</button>
                </div>
          
           </div>
         </div>
      </div>


        </div>
      <div class="row">
          <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="icon-user"></i>万能融合设置
          </div>
      <div class="widget-content padded form-horizontal">
	  <div class="row">
				   <div class="alert alert-warning">
                      <button class="close" data-dismiss="alert" type="button">×</button>万能融合插件可以融合进任何平台，只需填写第三方平台提供的url和token。
					  <br>
						<div style="color:red">
						注意：开启万能融合后，融合配置中的触发字必须填写，否则无效。<br>
						　　　开启后，在微信端对接我们提供的url和token。<br>
						　　　其他使用说明点击万能融合配置查看！<br>
						</div>
                    </div>
				<div class="widget-content padded">

				  <div class="form-group">
					<label class="control-label col-md-3">万能融合开关:</label>
					<div class="col-md-8">
					   <div class="toggle-switch" id="fusion_open" data-off="danger" data-on="success" style="margin-bottom:8px">
						<input <?php if ($xuanzezu[18]){echo "checked";}?> type="checkbox">
					  </div>
						   </div>
					 </div>
				<div class="widget-content padded" id = "setinfo" <?php if (!$xuanzezu[18]){echo "hidden";}?>>
                    <button class="btn btn-lg btn-block btn-primary" data-toggle="modal" href="#fusionchange" id='fusionset'>万能融合配置</button>
                </div>

					<div class="form-group">
					<label class="control-label col-md-3">URL:</label>
							<div class="col-md-8">
								<label><?=Web_ROOT?>/weixin/</label>
							</div>			
				   </div>
					<div class="form-group">
					<label class="control-label col-md-3">TOKEN:</label>
							<div class="col-md-8">
								<label>xiaobai</label>
							</div>			
				   </div>

                </div>
          
           </div>
         </div>
      </div>
           <div class="modal fade" id="fusionchange">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title">
                          配置万能融合接口
                        </h4>
                      </div>
                      <div class="modal-body">
        <center><a href="index.php"><img width="200" height="70" src="images/logo-login%402x.png" /></a></center>
        <p></p>
        		<div class="alert alert-warning">
                      <button class="close" data-dismiss="alert" type="button">×</button>说明：<br>
					  1、万能融合接口开启后，必须设置关键字触发字，用于触发 互动大屏幕活动系统 。<br>
					  2、下面的url和token，填写您的其他第三方平台（如：微擎，微盟等）提供的url和token（与微信端配置的模式一样）。<br>
					  3、当用户回复内容为关键字时，讲进入互动大屏幕活动系统，回复【退出】退出本系统。其余回复都将与您第三方的回复一样，支持所有消息类型。<br>
					  
                    </div>
        <p></p>
        <form  method="post" action="shenhe.do.php?do=fasionconfig" enctype="multipart/form-data" >
          <div class="form-group" style="height:2.4em">
          <label class="control-label col-md-3" style="text-align:right;">触发词:</label>
            <div class="col-md-8">
            <input class="form-control" name="fusionkeyword" value="<?=$xuanzezu[19]?>" placeholder="触发互动大屏幕关键字（必填，非空）" type="text">
            </div>
          </div>
          <div class="form-group" style="height:2.4em">
          <label class="control-label col-md-3" style="text-align:right;">第三方URL:</label>
            <div class="col-md-8">
            <input class="form-control" name="fusionurl" value="<?=$xuanzezu[20]?>" placeholder="第三方url" type="text">
          </div></div>
          <div class="form-group" style="height:2.4em">
          <label class="control-label col-md-3" style="text-align:right;">第三方TOKEN:</label>
            <div class="col-md-8">
            <input class="form-control" name="fusiontoken" value="<?=$xuanzezu[21]?>" placeholder="第三方token" type="text">
          </div></div>
          </div>
       
                      <div class="modal-footer">
                        <input class="btn btn-primary" type="submit" value="保存更改"><button class="btn btn-default-outline" data-dismiss="modal" type="button">Close</button>
                         </form>
                      </div>
                    </div>
                  </div>
                </div>

        </div>


          </div>
        <!-- end DataTables Example -->

  </div>
</div>
    </div>
    <script type="text/javascript">
$(function(){
	activatelogin();
});
	</script>
  </body>

</html>