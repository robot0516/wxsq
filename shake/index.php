<?php 

@header("Content-type: text/html; charset=utf-8");



session_start();



if(isset($_SESSION['views']) && $_SESSION['views'] == true){





} else {



$_SESSION['views'] = false;



echo "<script>window.location='../wall/login.php?url=".$_SERVER['PHP_SELF']."';</script>";

}

?>

<!DOCTYPE HTML>

<html>

<head>

<?php require ('db.php'); ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php echo $xuanzezu[5]; ?></title>

<script src="./mobile/shake/jquery.js"></script>

<script type="text/javascript" src="../files/js/semantic.min.js"></script> 

<script src="mobile/shake/jquery-ui.min.js"></script>

<script src="mobile/shake/jquery.flip.min.js"></script>

<link rel="stylesheet" href="css/shake.css" type="text/css">

<link rel="stylesheet" href="../files/css/semantic.min.css" type="text/css">

<script>

var scrwidth;

$(function(){

var hoko;

var ss=3;

var isstop = 0;

var tt;

var stime=3*1000;

function getPoint(){

    var anitime=scrwidth/<?php echo $xuanzezu[7];?>;

    var i=0;

  $.ajax({ 

  type: "post", 

  url :"date.php",

  dataType:'json', 

  data: 'judge=1',

 success: function(json){
  doit();
       function doit(){

        $("#ranking div:eq("+i+")").children('span').flip({

        speed:500,

        color: '#f93',

        content:'<p><img class="ui avatar image" src='+json[i]['avatar']+'><xb>'+json[i]['phone']+'</xb></p>',

        onBefore: function(){

        //$("#ranking div:eq("+i+")").width(json[i][1]*2);

        if(json[i]['point']*anitime >= scrwidth){

        //$("#ranking div:eq("+i+")").children('span').stop().animate({width : 745}, stime);
		
       $("#ranking div:eq("+i+")").children('span').css({"width":scrwidth,"visibility":"visible"});
		for(i=0;i<<?php echo $xuanzezu[8];?>;i++){
			$("#ranking div:eq("+i+")").children('span').html('<p><img class="ui avatar image" src='+json[i]['avatar']+'><xb>'+json[i]['phone']+'</xb></p>');
			}
        isstop = 1;
        }

       /* 流体宽度

        $(document).ready(function(){

alert(Math.round(($("#d").width()/$(document).width())*100));

});              */

		else{

        //alert(json[i]['point']*anitime+"%");

        $("#ranking div:eq("+i+")").children('span').css("width",json[i]['point']*anitime);

         //$("#ranking div:eq("+i+")").children('span').flip({speed:500});

        //$("#ranking div:eq("+i+")").children('span').stop().animate({width : json[i]['point']*anitime}, stime);

        //$("#ranking div:eq("+i+")").animate({width : json[i]['point']*3}, 3000);

		}},

        })

          i++;

          if(i<<?php echo $xuanzezu[8];?> & isstop == 0) setTimeout(doit,100);

                  }


 }



    });

   if($("#ranking div:eq(0)").children('span').width()>=scrwidth){echo(anitime);$("#final").show("fast");clearTimeout(hoko);return false;}

   hoko=setTimeout(getPoint,stime) ;

   

 } 

 

   

     function start(){ 

  

  $.ajax({ 

  type: "post", 

  url : "date.php",

  dataType:'text', 

  data: 'judge=3',

  success: function(data){}});

   }

  function end(){ 

  

  $.ajax({ 

  type: "post", 

  url : "date.php",

  dataType:'text', 

  data: 'judge=4',

  success: function(data){}});

   }

  

  function getman(){

  $.ajax({ 

  type: "post", 

  url : "date.php",

  dataType:'text', 

  data: 'judge=2',

  success: function(data){

      $("#man").html(data); 

      }

    

    });

   }

   

 function count(){

    $("#bignum").html(ss);

    ss=ss-1  

    tt=setTimeout(count,1000)

    if(ss==-1){

        $("#bignum").hide(0);

        $("#ranking").show().ready(function() {

scrwidth = $('div .progress-bar').width()-61;

        });

        clearTimeout(tt);

        start();

        getPoint();

        }

  }

  function echo(anitime){

      var str="";

      $("#ranking").hide(0);

      for(i=0;i<<?php echo $xuanzezu[8];?> ;i++){

          score=parseInt($("#ranking div:eq("+i+")").children('span').width())/anitime;

          str += "<tr>";

          str += "<td>第"+(i+1)+"名</td>";

          str += "<td>"+$("#ranking div:eq("+i+")").children('span').html();+"</td>";

          str += "<td>"+parseInt(score)+"</td>";

          str += "</tr>"

          }

       $("#finaltable").append(str);

       end();

      }

 $("#c").click(function(){

     clearInterval(yuni);

     count();

     })

  $("#qrcode").click(function(){

      $(this).hide();

      })

   

   var yuni=setInterval(getman,1000);

   

})

</script>

</head>



<body>



<div class="page">

<!-- 头部 -->

<div class="head">

<div class="head_left">

<div class="head_info">

<h1><?php echo $xuanzezu[5]; ?></h1>

</div>

<div class="head_flag"></div>

</div>



<div class="head_right">

<img alt="bababa" src="css/images/bullhorn.png" />

<h2>添加</h2><h1><?php echo $xiaobai_wxh; ?></h1><h3>在<span>主菜单</span>下发送<span><?=$xuanzezu[13]?></span>即可参与摇一摇</h3>

</div>

<div class="clear"></div>

</div>



<div id="ranking" class="ui page grid">

   <?php

   $ka="$xuanzezu[8]";

   $class=array('blue stripes','orange shine','green glow');

   for($i=0;$i<$ka;$i++){?>

   <div class='progress-bar  <?php echo $class[$i] ;?>'><su><?php echo $i + 1 ; ?></su><su2></su2>

  <span></span> </div>

  <?php 

   }

  ?>

    



</div>

<!--<div id="dd"><input id="ddd" type="button" value="初始化游戏"></div>-->

<div id="bignum" class="ui page grid">

  <div class="biginner row">

  <div class="ten wide column">

  <center>

  <img src="../wall/images/ma.jpg"></center>

  </div>

  <div class="six wide column">

    <a id="c" href="javascript:void(0)"><img style="width:100px;" src="./css/images/shake.gif"><p>开始游戏</p></a>

    <div class="manbox">已连接人数<span id="man"> 0 </span></div>

    </div>

  </div>

</div>

<div id="final" class="ui page grid">

  <table id="finaltable" class="ui celled table segment">

  <thead>

     <tr>

        <th>名次</th>

        <th>微信昵称</th>

        <th>摇晃次数</th>

     </tr>

  </thead>

     

  </table>

</div>



</div>

<audio autoplay src="" loop></audio>



  <img class="bg" src="./images/kuxuan.jpg"/>

</body>

</html>