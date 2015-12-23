<link rel="stylesheet" href="cj_plug/images/cjcss.css" type="text/css">
<div class="fl-lottery lotteryLayer ui transition hidden" id="cj_layer">
  <div class="fl-inner fl-bg">
    <div class="inner-cont clearfix">
      <div class="prize-box">
        <span class="props props-color"></span>
        <div class="outer-prize">
          <div class="wrap-prize">
            <div class="list-top clearfix">
              <p class="pro-num">获奖人数<em class="winUserNum"><img src="cj_plug/images/loading.gif" /></em></p>
              <span>获奖名单</span>
            </div>
            <div class="list-box">
              <p class="list-tit">
                <span>获奖序号</span>
                <span>微信昵称</span>
              </p>
              <div class="priname-box">
                <ul class="prize-list winUserList">
                </ul>
              </div>
            </div>
            <div class="und-btn"><a href="javascript:void(0);" class="btn-color btn-reset" id="cj_resetBtn"><span>重新抽奖</span></a></div>
          </div>
        </div>
      </div>
      <div class="lottery-box">
        <div class="box-ltop">
          <span class="lott-wt">现场抽奖</span>
          <p class="lott-w"><span>参加抽奖人数</span><em class="join-num lotteryUserNum"><img src="cj_plug/images/loading.gif" /></em></p>
        </div>
        <div class="rock-box">
          <span class="rock-head"><img src="cj_plug/images/pair-default.jpg" class="lotteryImg" width="178" height="178" alt=""></span>
          <span class="rock-name lotteryName">... ...</span>
          <input type="hidden" id="cj_mid" value="">
        </div>
<div class="btn-clear clearfix">
        <div class="choose-num " id="lotteryNumBox">
            <span>一次抽取</span>
            <select name="" id="lotteryNumSel">
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
              <option value="30">30</option>
              <option value="50">50</option>
            </select>
            <span>人</span>
          </div>
          
        <p class="btn-rock"><a href="javascript:void(0);" class="btn-start startLotteryBtn"><span>正在准备数据...</span><img style="display:none;" src="cj_plug/images/loading.gif" /></a></p>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/cj.js"></script>
