<?php
@header("Content-type: text/html; charset=utf-8");
//require_once dirname(__FILE__)."/data/include.php";
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){


} else {

$_SESSION['admin'] = false;

echo "<script>window.location='login.php';</script>";
}
$url = $_SERVER['PHP_SELF'];  
$filename=explode('/',$url);
$filename = end($filename); 
include('../version.php');
include('db.php');
$cj=0;
$shake=0;
$vote=0;
if(file_exists("cj.php"))
 {
	$cj=1;
 }
if(file_exists("shake.php"))
 {
	$shake=1;
 }
if(file_exists("vote.php"))
 {
	$vote=1;
 }
?>

<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
    <title>
      极智技术互动大屏幕后台管理系统
    </title>
    <script>
var web_root= "<?php echo Web_ROOT;?>";
var root = "<?php echo "http://".$_SERVER ['HTTP_HOST'].substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'/'))?>";
</script>
    <link href="stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" /><link href="../wall/css/emoji.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/font-awesome.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/se7en-font.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/isotope.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/jquery.fancybox.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/fullcalendar.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/wizard.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/select2.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/morris.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/datatables.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/datepicker.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/timepicker.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/colorpicker.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/bootstrap-switch.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/daterange-picker.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/typeahead.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/summernote.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/pygments.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/color/green.css" media="all" rel="alternate stylesheet" title="green-theme" type="text/css" /><link href="stylesheets/color/orange.css" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css" /><link href="stylesheets/color/magenta.css" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css" /><link href="stylesheets/color/gray.css" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css" /><script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script><script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script><script src="javascripts/bootstrap.min.js" type="text/javascript"></script><script src="javascripts/raphael.min.js" type="text/javascript"></script><script src="javascripts/selectivizr-min.js" type="text/javascript"></script><script src="javascripts/jquery.mousewheel.js" type="text/javascript"></script><script src="javascripts/jquery.vmap.min.js" type="text/javascript"></script><script src="javascripts/jquery.vmap.sampledata.js" type="text/javascript"></script><script src="javascripts/jquery.vmap.world.js" type="text/javascript"></script><script src="javascripts/jquery.bootstrap.wizard.js" type="text/javascript"></script><script src="javascripts/fullcalendar.min.js" type="text/javascript"></script><script src="javascripts/gcal.js" type="text/javascript"></script><script src="javascripts/jquery.dataTables.min.js" type="text/javascript"></script><script src="javascripts/datatable-editable.js" type="text/javascript"></script><script src="javascripts/jquery.easy-pie-chart.js" type="text/javascript"></script><script src="javascripts/excanvas.min.js" type="text/javascript"></script><script src="javascripts/jquery.isotope.min.js" type="text/javascript"></script><script src="javascripts/isotope_extras.js" type="text/javascript"></script><script src="javascripts/modernizr.custom.js" type="text/javascript"></script><script src="javascripts/jquery.fancybox.pack.js" type="text/javascript"></script><script src="javascripts/select2.js" type="text/javascript"></script><script src="javascripts/styleswitcher.js" type="text/javascript"></script><script src="javascripts/wysiwyg.js" type="text/javascript"></script><script src="javascripts/summernote.min.js" type="text/javascript"></script><script src="javascripts/jquery.inputmask.min.js" type="text/javascript"></script><script src="javascripts/jquery.validate.js" type="text/javascript"></script><script src="javascripts/bootstrap-fileupload.js" type="text/javascript"></script><script src="javascripts/bootstrap-datepicker.js" type="text/javascript"></script><script src="javascripts/bootstrap-timepicker.js" type="text/javascript"></script><script src="javascripts/bootstrap-colorpicker.js" type="text/javascript"></script><script src="javascripts/bootstrap-switch.min.js" type="text/javascript"></script><script src="javascripts/typeahead.js" type="text/javascript"></script><script src="javascripts/daterange-picker.js" type="text/javascript"></script><script src="javascripts/date.js" type="text/javascript"></script><script src="javascripts/morris.min.js" type="text/javascript"></script><script src="javascripts/skycons.js" type="text/javascript"></script><script src="javascripts/fitvids.js" type="text/javascript"></script><script src="javascripts/jquery.sparkline.min.js" type="text/javascript"></script><script src="javascripts/main.js" type="text/javascript"></script><script src="javascripts/respond.js" type="text/javascript"></script>
    <script src="javascripts/shenhe.js" type="text/javascript"></script>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
  <body>
    <div class="modal-shiftfix">
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
              <li class="dropdown messages hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="se7en-pages"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a data-toggle="modal" href="../wall/" target="_blank">
                    <i class="icon-comments-alt"></i>进入互动大屏幕</a>
                  </li>
                  <li><a data-toggle="modal" href="../vote/" target="_blank">
                    <i class="icon-bar-chart"></i>进入投票</a>
                  </li>
                  <li><a data-toggle="modal" href="../shake/" target="_blank">
                    <i class="icon-mobile-phone"></i>进入摇一摇</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown settings hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="se7en-gear"></span>
                  <div class="sr-only">
                    Settings
                  </div>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="settings-link blue" href="javascript:chooseStyle('none', 30)"><span></span>Blue</a>
                  </li>
                  <li>
                    <a class="settings-link green" href="javascript:chooseStyle('green-theme', 30)"><span></span>Green</a>
                  </li>
                  <li>
                    <a class="settings-link orange" href="javascript:chooseStyle('orange-theme', 30)"><span></span>Orange</a>
                  </li>
                  <li>
                    <a class="settings-link magenta" href="javascript:chooseStyle('magenta-theme', 30)"><span></span>Magenta</a>
                  </li>
                  <li>
                    <a class="settings-link gray" href="javascript:chooseStyle('gray-theme', 30)"><span></span>Gray</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img width="34" height="34" src="../img/0.jpg" />管理员<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a data-toggle="modal" href="#myModal" id="changpass">
                    <i class="icon-user"></i>修改密码</a>
                  </li>
                  <li><a href="logout.php">
                    <i class="icon-signout"></i>退出登陆</a>
                  </li>
				    <li><a href="http://">
                    <i class="icon-signout"></i></a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>


          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="logo" href="index.php">极智技术互动大屏幕</a>
        </div>
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav">
              <li>
                <a href="index.php"><span aria-hidden="true" class="se7en-home"></span>主页</a>
              </li>
              <li><a href="shenhe.php">
                <span aria-hidden="true" class="se7en-feed"></span>审核微信</a>
              </li>
              <?php 
if($cj)
 {

            echo'  <li><a href="cj.php">
                <span aria-hidden="true" class="se7en-star"></span>抽奖管理</a>
              </li>';
}
?>
              <?php 
if($vote)
 {

            echo'<li><a href="vote.php">
                <span aria-hidden="true" class="se7en-charts"></span>投票管理</a>
              </li>';
}
?>

              
			 <?php 
if($shake)
 {

            echo'<li><a href="shake.php">
                <span aria-hidden="true" class="se7en-flag"></span>摇一摇管理</a>
              </li>';
}
?>

              
              <li><a href="sysset.php">
                <span aria-hidden="true" class="se7en-gear"></span>系统设置</a>
              </li>

            </ul>
          </div>
        </div>
      </div>
      <script>
$(function(){
	var filename = "<?php echo $filename;?>";
	$('.nav-collapse ul li a').attr('class',function(){
		if($(this).attr('href')===filename){
			return "current";
			}
		});
});
</script>
           <div class="modal fade" id="myModal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title">
                          修改管理员账号密码
                        </h4>
                      </div>
                      <div class="modal-body">
        <center><a href="index.php"><img width="200" height="70" src="images/logo-login%402x.png" /></a></center>
        <p></p>
        <form  method="post" action="shenhe.do.php?do=gaimi" enctype="multipart/form-data" >
          <div class="form-group">
            <input class="form-control" name="user" placeholder="用户名" type="text">
          </div>
          <div class="form-group">
            <input class="form-control" name="pwd" placeholder="密码" type="text">
          </div>
          </div>
       
                      <div class="modal-footer">
                        <input class="btn btn-primary" type="submit" value="Save Changes"><button class="btn btn-default-outline" data-dismiss="modal" type="button">Close</button>
                         </form>
                      </div>
                    </div>
                  </div>
                </div>