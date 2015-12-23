<?php include('navigation.php');

include("db.php"); ?>
      <!-- End Navigation -->
<div class="modal fade" id="votemodal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title">
                          投票参数修改
                        </h4>
                      </div>
                      <div class="modal-body">
        <center><a href="index.php"><img width="200" height="70" src="images/logo-login%402x.png" /></a></center>
        <p></p>
        <form  method="post" action="shenhe.do.php?do=voteconfig" enctype="multipart/form-data" >
          <div class="form-group row">
					<label class="control-label col-md-4">投票标题:</label>
					<div class="col-md-8">
            <input class="form-control" name="votetiltle" value="<?=$xuanzezu[16]?>" type="text"></div>
          </div>
          <div class="form-group row">
					<label class="control-label col-md-4">前台刷新时间(秒):</label>
					<div class="col-md-8">
            <input class="form-control" name="voterefresht" value="<?=$xuanzezu[17]?>" type="text"></div>
          </div>
          <div class="form-group row">
					<label class="control-label col-md-4">每个用户投票数(数字):</label>
					<div class="col-md-8">
					<select name="votecannum">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="20">20</option>
                    </select>
            当前每人可投<?=$xuanzezu[25]?>票
            </div>
          </div>
		  
          <div class="form-group row">
					<label class="control-label col-md-4">前台投票显示方式：</label>
					<div class="col-md-8">
			  <?php 
				for($i=1;$i<=3;$i++){
					if($xuanzezu[24]==$i){
						$checked = "checked";
					}else{
						$checked = "";
					}
					if($i==1){
						$voteshowway = "扇形";
					}else if($i==2){
						$voteshowway = "柱形（横）";
					}else if($i==3){
						$voteshowway = "柱形（竖）";
					}
					echo '<label class="radio-inline"><input name="voteshowway"'.$checked.' type="radio" value="'.$i.'"><span>'.$voteshowway.'</span></label>';
				}
			  ?>
			  
			  </label>
          </div>
          </div>
          </div>
       
                      <div class="modal-footer">
                        <input class="btn btn-primary" type="submit" value="确定"><button class="btn btn-default-outline" data-dismiss="modal" type="button">关闭</button>
                         </form>
                      </div>
                    </div>
                  </div>
 </div>
      <div class="container main-content">
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
		   <?php
				   $toupiao="SELECT * FROM  `weixin_vote`";
					$querytp=mysql_query($toupiao,$link) or die(mysql_error());
					$numdel = mysql_num_rows($querytp);
					?>
                <i class="icon-table"></i>投票管理<a class="btn btn-sm btn-primary-outline pull-right" href="shenhe.do.php?do=zengjian&cid=1&numdel=<?=$numdel?>"><i class="icon-plus"></i>增加一行</a><a class="btn btn-sm btn-primary-outline pull-right" data-toggle="modal" href="#votemodal"><i class="icon-gear"></i>投票参数</a><a class="btn btn-sm btn-primary-outline pull-right" href="shenhe.do.php?do=chongzhi&cid=<?=$numdel?>"><i class="icon-ban-circle"></i>投票清零</a>
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="datatable-editable">
                  <thead>
                    <th class="check-header hidden-xs">
                      <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
                    </th>
                    <th>
                      序号
                    </th>
                    <th>
                      名称
                    </th>
                    <th class="hidden-xs">
                     	票数
                    </th>
                    <th></th>
                  </thead>
                  <tbody>
				 <?php	
				 $i=1;
				 while($q=mysql_fetch_row($querytp)){
				 ?>

                    <tr name="<?=$q[0]?>">
                      <td class="check hidden-xs">
                        <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
                      </td>
                      <td><?=$q[0]?></td>
                      <td>
                        <?=$q[1]?>
                      </td>
                      <td class="hidden-xs">
                       <?=$q[2]?>
                      </td>
                      <td class="actions">
                          <a class="edit-row" href="javascript:void(0)"><i class="icon-pencil"></i></a><a class="dete-row" href="javascript:void(0)"><i class="icon-trash"></i></a>
                      </td>
                    </tr>
			<?php $i++; }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- end DataTables Example -->
  </div>
</div>
    </div>
  </body>

</html>