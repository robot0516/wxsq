<?php 
@$action = $_GET["action"];
@$bakurl = $_GET["url"];
if(!$bakurl){
	$bakurl = 'index.php';
	}
require 'db.php';
if($action == 'verify'){
    if($screenpaw == $_POST['paw']){
			session_start();
	$_SESSION['views'] = true;
		echo 1;
		}else{
			echo 0;
			}
}else{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>微信上墙|互动大屏幕|微信大屏幕</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="../files/js/semantic.min.js"></script>
<link rel="stylesheet" href="../files/css/semantic.min.css" type="text/css">
<script type="text/javascript"> 
if(document.all){
	alert("ie浏览器无法正常解析本页，请使用谷歌内核的流量器浏览。如（360浏览器，猎豹浏览器等）");
	window.history.back(-1); 
	//window.navigate("top.jsp"); 
	}
document.onkeydown = function(evt){
　 var evt = window.event?window.event:evt;
　if (evt.keyCode==13) {
	$('#login-submit').click();
　}
}
$(function(){
	$('#login-submit').click(function(){
		var paws = $('#login-pass').val();
		$.post("login.php?action=verify", { paw:paws},
			  function(data){
				if(data == 1){
					$('#login-form').addClass("has-success");
					window.location='<?php echo $bakurl;?>';
					}else{
						$('#login-form').addClass("has-error");
						$('#login-form').transition('shake');
						}
			  });
		});
});
</script>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link href="../files/css/flat-ui.css" rel="stylesheet">
<link href="css/login.css" rel="stylesheet">
</head>
<body>
<div class="container" style="width:60%">
        <div class="login-screen">
          <div class="login-icon col-xs-3 hidden-sm hidden-xs">
            <img src="../files/images/icons/png/Gift-Box.png" alt="Welcome to Mail App" />
            <h4 class="hidden-blg">Welcome to <small>微信大屏幕</small></h4>
          </div>

          <div class="login-form">
            <div class="form-group">
				<h4>请输入本次活动的开场密码：</h4>
            </div>

            <div class="form-group" id="login-form">
              <input type="password" class="form-control login-field" value="" placeholder="Password(默认:admin)" id="login-pass" />
              <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>

            <a class="btn btn-primary btn-lg btn-block" href="javascript:void(0);" id="login-submit">Log in</a>
            <a class="login-link" href="/" target="_blank">Powered by:极智技术丨</a>
          </div>
        </div>
</div>
</body>
</html>
<?php } ?>