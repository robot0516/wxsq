<?php
@header("Content-type: text/html; charset=utf-8");
 
define("TOKEN", "xiaobai"); //配置API，不要改
define("Web_ROOT",'http://www.010xr.com'); //改成你的域名地址，最后不要带/
$weixin_name='微信互动大屏幕';//这里可以配置你的微信公众账号名字，你也可以改下面的源码
$xiaobai_wxh = '微聚港城';//微信帐号（wall前台显示）
	/***采集微信公众平台密码配置***/
define("USER", "zjg-sht");//公众平台账号 不能带空格
define("PASS", "lin58139693");//公众平台密码  不能带空格
$screenpaw = "admin";//进入微信大屏幕的密码

define("UR", Web_ROOT);
$url=Web_ROOT.'/moni/xiaobai.php';//不用修改、这个填写你的1.php这个文件的地址
$weixin_wxq=Web_ROOT.'/wall/';//不用修改、这里填写你的互动大屏幕的地址
/*链接数据库*/
$dbname = "xiaobai";//数据库的名称

/*设置数据库信息*/
$host = "127.0.0.1";//数据库的服务器地址，一般无需更改
$port = "3306";//数据库的端口号
$user = "root";//数据库的用户名
$pwd = "010xr.com";//数据库的密码

/*接着调用mysql_connect()连接服务器*/
$link = @mysql_connect("{$host}:{$port}",$user,$pwd,true);
if(!$link) {
	   die("Connect Server Failed: " . mysql_error($link));
	  }
/*连接成功后立即调用mysql_select_db()选中需要连接的数据库*/
if(!mysql_select_db($dbname,$link)) {
	   die("Select Database Failed: " . mysql_error($link));
	  }
mysql_query("SET NAMES UTF8");
//以上连接数据库
$xuanze="SELECT * FROM  `weixin_wall_config`";
$chaxun=mysql_query($xuanze) or die(mysql_error());
$xuanzezu=mysql_fetch_row($chaxun);
$huati=$xuanzezu[0];//话题内容不用修改
$huanying1=$xuanzezu[1];
$huanying2=$xuanzezu[2];
?>