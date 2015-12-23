<link rel="stylesheet" href="vote_plug/images/votecss.css" type="text/css">
<div class="fl-lottery lotteryLayer ui transition hidden" id="vote_layer">
  <div class="fl-inner fl-bg">
    <div class="inner-cont clearfix">
		<div class="ui top green attached segment vote-top">
			  <h1 class="vote-title"><?=$xuanzezu[16]?></h1>
			    <h1 class="vote-canyu">共<a class="ui orange label" id="sumvote">loading...</a>人参与</h1>
			  <h3 class="vote-title vote-titlefu">微信关注【<?=$xiaobai_wxh?>】，发送【<?=$xuanzezu[15]?>】即可参与投票互动！</h3>
					</div>
		  <div class="ui bottom attached segment">
			<div class="vote-null"><h1>还没有人投票哟！！</h1></div>
			<div style="min-width: 550px; height: 400px; max-width: 800px; margin: 0 auto">
			<div id="pie-chart" style="min-width: 550px; height: 400px; max-width: 800px; margin: 0 auto">
			</div>
			</div>
					<div class="ui bottom right attached label vote-right"><a class="ui black circular label" id="closevote">×</a></div>

		</div>
    </div>
  </div>
</div>
<script>
var votefresht=<?=$xuanzezu[17]?>;
var voteshowway = <?=$xuanzezu[24]?>;
</script>
<script src="vote_plug/js/exporting.js"></script>
<script src="vote_plug/js/highcharts.js"></script>
<script src="vote_plug/js/vote.js"></script>